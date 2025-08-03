<?php
header('Content-Type: application/json');
require_once('../../includes/db.php');

$data = json_decode(file_get_contents("php://input"), true);
$enquiry_id = $data['enquiry_id'];

$stmt = $conn->prepare("UPDATE enquiries SET status='resolved' WHERE id=?");
$stmt->bind_param("i", $enquiry_id);
$stmt->execute();

echo json_encode(["success" => true, "message" => "Marked as resolved."]);