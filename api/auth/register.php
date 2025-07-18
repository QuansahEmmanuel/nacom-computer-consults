<?php
// Include database connection
require_once('../../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Collect & sanitise input
    $username = trim($_POST['username'] ?? '');
    $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
    $password = $_POST['password'] ?? '';
    $role     = strtolower(trim($_POST['role'] ?? ''));
    $status   = strtolower(trim($_POST['status'] ?? 'inactive'));  // Default to 'inactive'

    // 2. Validate required fields
    $allowedRoles   = ['admin', 'support', 'customer'];
    $allowedStatus  = ['active', 'inactive'];

    if (empty($username) || empty($email) || empty($password) || empty($role) || empty($status)) {
        header("Location: ../../views/auth/register.php?msg=All fields are required!");
        exit;
    }

    if (!in_array($role, $allowedRoles, true)) {
        header("Location: ../../views/auth/register.php?msg=Invalid role selected!");
        exit;
    }

    if (!in_array($status, $allowedStatus, true)) {
        header("Location: ../../views/auth/register.php?msg=Invalid status selected!");
        exit;
    }

    // 3. Check for duplicate email
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

    // 4. Insert user
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password, role, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssss", $username, $email, $hashedPassword, $role, $status);

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
}