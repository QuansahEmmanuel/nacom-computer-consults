<?php
header('Content-Type: application/json');
require_once('../../includes/db.php');

$action = $_GET['action'] ?? '';

if ($action === 'view') {
    viewBookings($conn);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid action"
    ]);
}

// ============================
// VIEW BOOKINGS FUNCTION
// ============================
function viewBookings($conn) {
    $whereClauses = [];

    // Collect and sanitize filters
    $customer = isset($_GET['customer']) ? $conn->real_escape_string($_GET['customer']) : '';
    $status   = isset($_GET['status']) ? $conn->real_escape_string($_GET['status']) : '';

    // Filter by customer
    if (!empty($customer)) {
        $whereClauses[] = "(b.customer_name LIKE '%$customer%' OR b.customer_email LIKE '%$customer%' OR b.customer_phone_number LIKE '%$customer%')";
    }

    // Filter by status
    if (!empty($status)) {
        $whereClauses[] = "b.booking_status = '$status'";
    }

    // Combine filters
    $whereSQL = "";
    if (count($whereClauses) > 0) {
        $whereSQL = "WHERE " . implode(" AND ", $whereClauses);
    }

    $sql = "
        SELECT 
            b.id,
            b.customer_name,
            b.customer_email,
            b.customer_phone_number,
            b.service_name,
            b.booking_status,
            b.booking_date,
            b.resolution_status,
            b.created_at,
            u.username AS assigned_agent_name
        FROM bookings b
        LEFT JOIN users u ON b.assigned_agent_id = u.id
        $whereSQL
        ORDER BY b.created_at DESC
    ";

    $result = $conn->query($sql);

    if (!$result) {
        echo json_encode([
            "status" => "error",
            "message" => "Query failed: " . $conn->error
        ]);
        return;
    }

    $bookings = [];

    while ($row = $result->fetch_assoc()) {
        $bookings[] = [
            "id" => $row['id'],
            "customer_name" => $row['customer_name'],
            "customer_email" => $row['customer_email'],
            "customer_phone_number" => $row['customer_phone_number'],
            "service_name" => $row['service_name'],
            "booking_status" => $row['booking_status'],
            "booking_date" => $row['booking_date'],
            "resolution_status" => $row['resolution_status'],
            "created_at" => $row['created_at'],
            "assigned_agent_name" => $row['assigned_agent_name']
        ];
    }

    echo json_encode([
        "status" => "success",
        "data" => $bookings
    ]);
}

// ========================================================================
// Assign Agent
// ========================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'assign_agent') {
    $data = json_decode(file_get_contents("php://input"), true);
    $bookingId = $data['booking_id'];
    $agentId = $data['agent_id'];

    $stmt = $conn->prepare("UPDATE bookings SET assigned_agent_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $agentId, $bookingId);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Assignment failed"]);
    }
    exit;
}

// ========================================================================
// Edit Assigned Agent
// ========================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'edit_assigned_agent') {
    $data = json_decode(file_get_contents("php://input"), true);
    $bookingId = $data['booking_id'];
    $agentId = $data['agent_id'];

    $stmt = $conn->prepare("UPDATE bookings SET assigned_agent_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $agentId, $bookingId);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Agent updated"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to update agent"]);
    }
    exit;
}

// ========================================================================
// Delete Booking
// ========================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'delete') {
    $data = json_decode(file_get_contents("php://input"), true);
    $bookingId = $data['booking_id'];

    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $bookingId);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Booking deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to delete booking"]);
    }
    exit;
}