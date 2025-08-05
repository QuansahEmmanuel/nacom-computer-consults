<?php
header('Content-Type: application/json');
require_once('../../includes/db.php');

// Get enquiry_id from query string
$enquiryId = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;

if ($enquiryId <= 0) {
    echo json_encode(['error' => 'Invalid enquiry ID']);
    exit;
}

// SQL to get replies for specific enquiry_id
$sql = "
    SELECT 
        er.id,
        er.enquiry_id,
        er.agent_id,
        u.username AS agent_name,
        er.reply,
        er.reply_date
    FROM enquiry_replies er
    INNER JOIN users u ON er.agent_id = u.id
    WHERE er.enquiry_id = $enquiryId
    ORDER BY er.reply_date DESC
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['error' => 'Database query error: ' . mysqli_error($conn)]);
    exit;
}

$replies = [];

while ($row = mysqli_fetch_assoc($result)) {
    $replies[] = $row;
}

echo json_encode($replies);
?>