<?php
// Clean any previous output
ob_clean();

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Method not allowed. Only POST requests are accepted.'
    ]);
    exit();
}

// Suppress any output from the database connection
ob_start();
require_once 'db.connect.php';
ob_end_clean();

$data = json_decode(file_get_contents('php://input'), true);

// Check if JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid JSON format.'
    ]);
    exit();
}

if (
    $data &&
    isset($data['name'], $data['email'], $data['phone'], $data['service_name'], $data['date'])
) {
    $name = trim(htmlspecialchars($data['name']));
    $email = trim(filter_var($data['email'], FILTER_SANITIZE_EMAIL));
    $phone = trim(htmlspecialchars($data['phone']));
    $service = trim(htmlspecialchars($data['service_name']));
    $date = trim(htmlspecialchars($data['date']));

    // Validate required fields are not empty after trimming
    if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($date)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'All fields are required and cannot be empty.'
        ]);
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Please enter a valid email address.'
        ]);
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO bookings (customer_name, customer_email, customer_phone_number, service_name, booking_date) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: Unable to prepare statement.'
        ]);
        exit();
    }

    $stmt->bind_param("sssss", $name, $email, $phone, $service, $date);

    if ($stmt->execute()) {
        $booking_id = $conn->insert_id;
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Booking received successfully! We will contact you soon.',
            'data' => [
                'booking_id' => $booking_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'service' => $service,
                'date' => $date
            ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to save booking. Please try again later.'
        ]);
    }

    $stmt->close();
    $conn->close();

} else {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid or missing input data. Please fill in all required fields.'
    ]);
}
?>