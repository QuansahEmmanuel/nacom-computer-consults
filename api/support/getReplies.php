<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../includes/db.php');

if (!isset($_GET['enquiry_id'])) {
    echo json_encode([]);
    exit;
}

$enquiry_id = intval($_GET['enquiry_id']);

$sql = "SELECT r.reply, r.reply_date, u.username AS agent_name
        FROM enquiry_replies r
        JOIN users u ON r.agent_id = u.id
        WHERE r.enquiry_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $enquiry_id);
$stmt->execute();
$result = $stmt->get_result();

$replies = [];
while ($row = $result->fetch_assoc()) {
    $replies[] = $row;
}

echo json_encode($replies);
?>