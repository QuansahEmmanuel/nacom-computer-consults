<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// PHPMailer includes
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';
require '../../PHPMailer-master/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../../includes/db.php');

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);
$booking_id = $data['booking_id'] ?? null;
$subject = trim($data['subject'] ?? '');
$message = trim($data['message'] ?? '');

session_start();
$agent_id = $_SESSION['user_id'] ?? null;


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

if (!$booking_id || !$subject || !$message || !$agent_id) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required data.']);
    exit;
}

// Get customer email
$stmt = $conn->prepare("SELECT customer_name, customer_email FROM bookings WHERE id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();
$stmt->close();

if (!$booking) {
    echo json_encode(['status' => 'error', 'message' => 'Booking not found.']);
    exit;
}

$customer_name = $booking['customer_name'];
$customer_email = $booking['customer_email'];

// Send email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'emmanuelquansah764@gmail.com';
    $mail->Password   = 'lxhi bwfe ytpq diyd';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('emmanuelquansah764@gmail.com', 'Nacom Computer Consults');
    $mail->addAddress($customer_email, $customer_name);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = nl2br($message);
    $mail->AltBody = strip_tags($message);

    $mail->send();

    // Save reply
    $stmt = $conn->prepare("INSERT INTO booking_replies (booking_id, agent_id, subject, message, reply_date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiss", $booking_id, $agent_id, $subject, $message);
    $stmt->execute();
    $stmt->close();

    // Update booking status
    $stmt = $conn->prepare("UPDATE bookings SET booking_status = 'Contacted' WHERE id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['status' => 'success', 'message' => 'Email sent and saved successfully.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}