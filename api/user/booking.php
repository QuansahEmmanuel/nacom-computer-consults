<?php
require_once('../../includes/db.php');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['name'], $data['email'], $data['phone'], $data['service_name'], $data['date'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
    exit();
}

$name = trim($data['name']);
$email = trim($data['email']);
$phone = trim($data['phone']);
$service = trim($data['service_name']);
$date = trim($data['date']);

if (!$name || !$email || !$phone || !$service || !$date) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
    exit();
}

$stmt = $conn->prepare("INSERT INTO bookings (customer_name, customer_email, customer_phone_number, service_name, booking_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $service, $date);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Booking received! We will give you a feedback very soon',
        'data' => [
            'booking_id' => $conn->insert_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'service' => $service,
            'date' => $date
        ]
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save booking.']);
}

$stmt->close();
$conn->close();
?>