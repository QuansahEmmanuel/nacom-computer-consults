<?php
// Include database connection
require_once('../../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* ----------------------------------------------------------
       1.  Collect & sanitise input, including the ROLE field
    ---------------------------------------------------------- */
    $email    = filter_input(INPUT_POST, 'email',    FILTER_SANITIZE_EMAIL) ?? '';
    $password = $_POST['password'] ?? '';
    $role     = strtolower(trim($_POST['role'] ?? ''));      // e.g. "admin", "support", "customer"

    /* ----------------------------------------------------------
       2.  Allow only recognised roles (add / remove as needed)
    ---------------------------------------------------------- */
    $allowedRoles = ['admin', 'support', 'customer'];

    if (empty($email) || empty($password) || empty($role)) {
        header("Location: ../../views/auth/register.php?msg=All fields are required!");
        exit;
    }

    if (!in_array($role, $allowedRoles, true)) {
        header("Location: ../../views/auth/register.php?msg=Invalid role selected!");
        exit;
    }

    /* ----------------------------------------------------------
       3.  Ensure the email is unique
    ---------------------------------------------------------- */
    $checkQuery = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            header("Location: ../../views/auth/register.php?msg=User already exists with this email!");
            exit;
        }
        $stmt->close();
    } else {
        error_log("Error preparing check statement: " . $conn->error);
        header("Location: ../../views/auth/register.php?msg=An error occurred during registration.");
        exit;
    }

    /* ----------------------------------------------------------
       4.  Hash the password & insert the user with their role
    ---------------------------------------------------------- */
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Make sure your `users` table has a `role` column (VARCHAR or ENUM)
    $sql = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $email, $hashedPassword, $role);

        if ($stmt->execute()) {
            header("Location: ../../views/auth/login.php");
            exit;
        } else {
            header("Location: ../../views/auth/register.php?msg=Failed to register user!");
            exit;
        }
    } else {
        error_log("Error preparing insert statement: " . $conn->error);
        header("Location: ../../views/auth/register.php?msg=An error occurred during registration.");
        exit;
    }

    $stmt->close();
    
    $conn->close();
}