<?php
header('Content-Type: application/json');
require_once('../../includes/db.php');

// Initialize totals
$totalBookings = 0;
$totalEnquiries = 0;
$totalServices = 0;
$recentBookings = [];

// Get total bookings
$bookingSql = "SELECT COUNT(*) as total FROM bookings";
$bookingResult = $conn->query($bookingSql);
if ($bookingResult && $row = $bookingResult->fetch_assoc()) {
    $totalBookings = (int)$row['total'];
}

// Get total enquiries
$enquirySql = "SELECT COUNT(*) as total FROM enquiries";
$enquiryResult = $conn->query($enquirySql);
if ($enquiryResult && $row = $enquiryResult->fetch_assoc()) {
    $totalEnquiries = (int)$row['total'];
}

// Get total services
$serviceSql = "SELECT COUNT(*) as total FROM services";
$serviceResult = $conn->query($serviceSql);
if ($serviceResult && $row = $serviceResult->fetch_assoc()) {
    $totalServices = (int)$row['total'];
}

// Get recent 5 bookings with correct column names
$sql = "SELECT customer_name AS customer, service_name AS service, booking_date, booking_status AS status 
        FROM bookings 
        ORDER BY booking_date DESC 
        LIMIT 5";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recentBookings[] = $row;
    }
}

// ✅ Final combined JSON response
echo json_encode([
    'status' => 'success',
    'total_bookings' => $totalBookings,
    'total_enquiries' => $totalEnquiries,
    'total_service' => $totalServices,
    'recent_bookings' => $recentBookings
]);

$conn->close();
?>