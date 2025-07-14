<?php
session_start(); // Always start session at the top
include_once("db.connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitize inputs
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    // Validate required fields
    if (empty($email) || empty($password)) {
        header("Location: ../frontend/admin/login.php?msg=Email and password are required.");
        exit;
    }

    // Query the database for the user
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            // Bind result variables
            $stmt->bind_result($user_id, $db_email, $db_hashed_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $db_hashed_password)) {
                // Password is correct — start session

                // Store user data in session
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $db_email;

                // Redirect to dashboard or homepage
                header("Location: ../frontend/admin/index.html");
                exit;
            } else {
                // Invalid password
                header("Location: ../frontend/admin/login.php?msg=Invalid password.");
                exit;
            }
        } else {
            // No such user
            header("Location: ../frontend/admin/login.php?msg=No user found with that email.");
            exit;
        }

        $stmt->close();
    } else {
        // Error preparing statement
        error_log("Login statement error: " . $conn->error);
        header("Location: ../frontend/admin/login.php?msg=An error occurred. Please try again.");
        exit;
    }

    $conn->close();
} else {
    // Invalid request method
    header("Location: ../frontend/admin/login.php");
    exit;
}