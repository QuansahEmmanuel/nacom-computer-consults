<?php
// bookOurService.php

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $name = htmlspecialchars($data['name']);
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($data['phone']);
    $service = htmlspecialchars($data['service_name']);
    $date = htmlspecialchars($data['date']);

   

    echo json_encode(['status' => 'success', 'message' => 'Booking received']);
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>