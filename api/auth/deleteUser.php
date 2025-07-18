<?php
require_once('../../includes/db.php');


header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User ID is required']);
    exit;
}

$userId = intval($data['user_id']);

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete user']);
}

$stmt->close();
$conn->close();