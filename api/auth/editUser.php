<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once('../../includes/db.php');

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (
    !isset($data['user_id']) || 
    !isset($data['username']) || 
    !isset($data['email']) || 
    !isset($data['role']) || 
    !isset($data['status'])
) {
    echo json_encode(["status" => "error", "message" => "Missing required fields."]);
    exit;
}

$user_id = intval($data['user_id']);
$username = trim($data['username']);
$email = trim($data['email']);
$role = trim($data['role']);
$status = trim($data['status']);
$password = isset($data['password']) ? trim($data['password']) : "";

// Update query (optional password update)
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username = ?, email = ?, role = ?, status = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $username, $email, $role, $status, $hashedPassword, $user_id);
} else {
    $sql = "UPDATE users SET username = ?, email = ?, role = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $email, $role, $status, $user_id);
}

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "User updated successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to update user."]);
}

$stmt->close();
$conn->close();