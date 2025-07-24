<?php
// CORS and JSON headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Database connection
require_once('../../includes/db.php');

// SQL query to get only support agents
$sql = "SELECT id, username, email, role, status, created_at 
        FROM users 
        WHERE role = 'support'";
$result = $conn->query($sql);

$supportAgents = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $supportAgents[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $supportAgents
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No support agents found."
    ]);
}

$conn->close();