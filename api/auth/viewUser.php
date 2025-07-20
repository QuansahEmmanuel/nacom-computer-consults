<?php
// CORS and JSON headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Database connection
require_once('../../includes/db.php');

// SQL query to get all user details, including password (for editing)
$sql = "SELECT id, username, email, role, status, created_at, password FROM users";
$result = $conn->query($sql);

$users = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $users
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No users found."
    ]);
}

$conn->close();