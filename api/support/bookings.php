<?php
// Define base path
$baseDir = dirname(__DIR__, 2);

require_once('../../includes/db.php');
require_once('../../api/auth/auth_check.php');

// Set content type
header('Content-Type: application/json');

// Check login
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized.']);
    exit;
}

$agent_id = $_SESSION['user_id'];

if (!$conn) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'DB connection failed.']);
    exit;
}

// ✅ Use service_name directly — no JOIN needed
$sql = "SELECT 
            id, 
            customer_name, 
            customer_email, 
            service_name,           -- ✅ This exists in bookings table
            booking_date, 
            booking_status, 
            resolution_status 
        FROM bookings 
        WHERE assigned_agent_id = ? 
        ORDER BY booking_date DESC";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . mysqli_error($conn)]);
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $agent_id);

if (!mysqli_stmt_execute($stmt)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Execute failed: ' . mysqli_stmt_error($stmt)]);
    exit;
}

$result = mysqli_stmt_get_result($stmt);
$bookings = [];

while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}

echo json_encode([
    'success' => true,
    'bookings' => $bookings
]);

mysqli_stmt_close($stmt);
?>