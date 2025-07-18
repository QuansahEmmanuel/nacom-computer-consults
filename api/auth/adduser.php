<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


require_once('../../includes/db.php');


// Get raw POST data and decode JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['username'], $data['email'], $data['role'], $data['status'], $data['password'])) {
    echo json_encode(["status" => "error", "message" => "Incomplete data."]);
    exit();
}



$username = $conn->real_escape_string($data['username']);
$email = $conn->real_escape_string($data['email']);
$role = $conn->real_escape_string($data['role']);
$status = $conn->real_escape_string($data['status']);
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, role, status, password) VALUES ('$username', '$email', '$role', '$status', '$password')";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "User added successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}

$conn->close();