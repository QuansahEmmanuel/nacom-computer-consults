<?php
header('Content-Type: application/json');
require_once('../../includes/db.php');

// PHPMailer
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';
require '../../PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Read input
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['enquiry_id'], $data['agent_id'], $data['message'])) {
    echo json_encode(["success" => false, "message" => "Missing required input data."]);
    exit;
}

$enquiry_id = (int) $data['enquiry_id'];
$agent_id = (int) $data['agent_id'];
$message = trim($data['message']);

// Get customer email and name
$stmt = $conn->prepare("SELECT customer_name, customer_email FROM enquiries WHERE id = ?");
$stmt->bind_param("i", $enquiry_id);
$stmt->execute();
$result = $stmt->get_result();
$enquiry = $result->fetch_assoc();
$stmt->close();

if (!$enquiry) {
    echo json_encode(["success" => false, "message" => "Enquiry not found."]);
    exit;
}

$client_name = $enquiry['customer_name'];
$client_email = $enquiry['customer_email'];

// Step 1: Save reply
$saveSuccess = false;
$stmt = $conn->prepare("INSERT INTO enquiry_replies (enquiry_id, agent_id, reply) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $enquiry_id, $agent_id, $message);
$saveSuccess = $stmt->execute();
$stmt->close();

if (!$saveSuccess) {
    echo json_encode(["success" => false, "message" => "Failed to save reply to database."]);
    exit;
}

// Step 2: Send email using Gmail SMTP
$mail = new PHPMailer(true);
$emailSent = false;

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'emmanuelquansah764@gmail.com';
    $mail->Password   = 'lxhi bwfe ytpq diyd'; // Gmail app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('emmanuelquansah764@gmail.com', 'NACOM Support');
    $mail->addAddress($client_email, $client_name);

    $mail->isHTML(true);
    $mail->Subject = "Reply to your enquiry";
    $mail->Body    = "<p>Dear <strong>{$client_name}</strong>,</p><p>{$message}</p><p>Best regards,<br>NACOM Support Team</p>";
    $mail->AltBody = "Dear {$client_name},\n\n{$message}\n\nBest regards,\nNACOM Support Team";

    $mail->send();
    $emailSent = true;
} catch (Exception $e) {
    error_log("Email failed: " . $mail->ErrorInfo); // logs error
}

// Final response
echo json_encode([
    "success" => true,
    "reply_saved" => $saveSuccess,
    "email_sent" => $emailSent,
    "message" => $emailSent ? "Reply sent and email delivered." : "Reply saved, but email failed to send."
]);

$conn->close();