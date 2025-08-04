<?php
header('Content-Type: application/json');
require_once('../../includes/db.php');

// Validate booking_id input
if (!isset($_GET['booking_id']) || !is_numeric($_GET['booking_id'])) {
    echo json_encode(['error' => 'Invalid or missing booking_id']);
    exit;
}

$bookingId = intval($_GET['booking_id']);

try {
    $stmt = $conn->prepare("
        SELECT 
            br.subject,
            br.message,
            br.reply_date,
            br.agent_id,
            u.username AS agent_name
        FROM booking_replies br
        LEFT JOIN users u ON br.agent_id = u.id
        WHERE br.booking_id = ?
        ORDER BY br.reply_date ASC
    ");

    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    $replies = [];

    while ($row = $result->fetch_assoc()) {
        $replies[] = [
            'subject' => $row['subject'],
            'message' => $row['message'],
            'reply_date' => $row['reply_date'],
            'agent_id' => $row['agent_id'],
            'agent_name' => $row['agent_name'] ?? 'Unknown'
        ];
    }

    echo json_encode($replies);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
?>