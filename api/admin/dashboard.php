<?php
header('Content-Type: application/json');
require_once('../../includes/db.php');

// Initialize totals
$totalBookings = 0;
$totalEnquiries = 0;
$totalServices = 0;

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

// Send JSON response
echo json_encode([
    'status' => 'success',
    'total_bookings' => $totalBookings,
    'total_enquiries' => $totalEnquiries,
    'total_service' => $totalServices
]);

$conn->close();