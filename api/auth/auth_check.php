<?php
// includes/auth_check.php
session_start();

// Check if user is logged in
// If not, redirect to login page with a message
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php?msg=Please log in to access the dashboard.");
    exit;
}

// Access username and role
$username = $_SESSION['username'];
$role     = $_SESSION['role'];