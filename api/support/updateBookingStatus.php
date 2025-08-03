<?php
// Enable errors for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Include database connection
require_once('../../includes/db.php');

// Read and decode raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Validate
$booking_id = $data['booking_id'] ?? null;
$status = $data['status'] ?? null;

if (!$booking_id || !$status) {
    echo json_encode(['success' => false, 'message' => 'Booking ID or status missing.']);
    exit;
}

// Prepare and execute update
$stmt = $conn->prepare("UPDATE bookings SET booking_status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $booking_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Status updated.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update status.']);
}

$stmt->close();
$conn->close();