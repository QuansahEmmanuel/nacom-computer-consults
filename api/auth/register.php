<?php

// Include database connection
include_once("db.connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitize and retrieve inputs
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
    $password = $_POST['password'] ?? '';

    // Validate required fields
    if (empty($email) || empty($password)) {
        header("Location: ../frontend/register_user.php?msg=All fields are required!");
        exit;
    }

    // Check if email already exists
    $checkQuery = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            header("Location: ../frontend/register_user.php?msg=User already exists with this email!");
            exit;
        }
        $stmt->close();
    } else {
        // Log error instead of echoing for production
        error_log("Error preparing check statement: " . $conn->error);
        header("Location: ../frontend/register_user.php?msg=An error occurred during registration.");
        exit;
    }

    // Hash password securely
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare INSERT statement
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            // Registration successful
            header("Location: ../frontend/index.php");
            exit;
        } else {
            header("Location: ../frontend/register_user.php?msg=Failed to register user!");
            exit;
        }
    } else {
        error_log("Error preparing insert statement: " . $conn->error);
        header("Location: ../frontend/register_user.php?msg=An error occurred during registration.");
        exit;
    }

    $stmt->close();
    $conn->close();
}