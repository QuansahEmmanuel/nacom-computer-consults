<?php
// Database connection
include 'db.connect.php';

// Set header for JSON response
header("Content-Type: application/json");

// Get raw JSON from the request body
$input = file_get_contents('php://input');

// Decode JSON into an associative array
$data = json_decode($input, true);

// Check if JSON was parsed correctly
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid JSON"
    ]);
    http_response_code(400);
    exit;
}

// Extract fields
$name = $data['name'] ?? null;
$email = $data['email'] ?? null;
$subject = $data['subject'] ?? null;
$message = $data['message'] ?? null;

// Validate required fields
if (!$name || !$email || !$subject || !$message) {
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    http_response_code(400);
    exit;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO enquiries (customer_name, customer_email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if (!$stmt->execute()) {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $stmt->error
    ]);
    http_response_code(500);
    exit;
}

// Success response
echo json_encode([
    "status" => "success",
    "message" => "Enquiry submitted successfully! We will get back to you soon."
]);

// Close statement
$stmt->close();
?>