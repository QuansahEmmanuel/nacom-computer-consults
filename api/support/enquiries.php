<?php
header('Content-Type: application/json');
require_once('../../includes/db.php');

// Get the user_id from the query string
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_id === 0) {
    echo json_encode(['error' => 'Invalid or missing user ID']);
    http_response_code(400);
    exit;
}

// Prepare query to get enquiries assigned to this user
$stmt = $conn->prepare("SELECT * FROM enquiries WHERE support_agent_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$enquiries = [];
while ($row = $result->fetch_assoc()) {
    $enquiries[] = $row;
}

echo json_encode($enquiries);