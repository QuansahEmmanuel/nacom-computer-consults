<?php
require_once('../../includes/db.php');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['name'], $data['email'], $data['subject'], $data['message'])) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    exit;
}

$name = trim($data['name']);
$email = trim($data['email']);
$subject = trim($data['subject']);
$message = trim($data['message']);

if (!$name || !$email || !$subject || !$message) {
    echo json_encode(['status' => 'error', 'message' => 'All fields must be filled.']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO enquiries (customer_name, customer_email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Enquiry submitted successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Database error.']);
}

$stmt->close();
$conn->close();