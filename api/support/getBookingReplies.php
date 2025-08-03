<?php
// Set response headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include DB connection
require_once('../../includes/db.php');

// Get booking_id from query parameter
$bookingId = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;

if (!$bookingId) {
    echo json_encode([
        "success" => false,
        "message" => "Booking ID is required."
    ]);
    exit;
}

try {
    // Prepare and execute query to fetch replies
    $stmt = $conn->prepare("
        SELECT er.subject, er.message, er.reply_date, u.username AS agent_name
        FROM booking_replies er
        JOIN users u ON er.agent_id = u.id
        WHERE er.booking_id = ?
        ORDER BY er.reply_date DESC
    ");
    $stmt->execute([$bookingId]);
$result = $stmt->get_result();

$replies = [];
while ($row = $result->fetch_assoc()) {
    $replies[] = $row;
}


    echo json_encode([
        "success" => true,
        "replies" => $replies
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}