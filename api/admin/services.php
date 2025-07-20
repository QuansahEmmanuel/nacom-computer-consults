<?php

header('Content-Type: application/json');
require_once('../../includes/db.php');

$method = $_SERVER['REQUEST_METHOD'];

// Handle routes by HTTP method
if ($method === 'GET') {
    getAllServices($conn);
} elseif ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';

    switch ($action) {
        case 'add':
            addService($conn, $input);
            break;
        case 'edit':
            editService($conn, $input);
            break;
        case 'delete':
            deleteService($conn, $input);
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

$conn->close();


// ===== FUNCTIONS =====

function getAllServices($conn)
{
    $sql = "SELECT id, name, price, description FROM services ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $services = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
    }

    echo json_encode(['status' => 'success', 'services' => $services]);
}

function addService($conn, $input)
{
    $name = trim($input['service_name'] ?? '');
    $price = trim($input['service_price'] ?? '');
    $description = trim($input['service_description'] ?? '');

    if (empty($name) || empty($price) || empty($description)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        return;
    }

    $stmt = $conn->prepare("INSERT INTO services (name, price, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $description);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Service added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }

    $stmt->close();
}

function editService($conn, $input)
{
    $id = intval($input['service_id'] ?? 0);
    $name = trim($input['service_name'] ?? '');
    $price = trim($input['service_price'] ?? '');
    $description = trim($input['service_description'] ?? '');

    if ($id <= 0 || empty($name) || empty($price) || empty($description)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required for editing.']);
        return;
    }

    $stmt = $conn->prepare("UPDATE services SET name = ?, price = ?, description = ? WHERE id = ?");
    $stmt->bind_param("sdsi", $name, $price, $description, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Service updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update service.']);
    }

    $stmt->close();
}

function deleteService($conn, $input)
{
    $id = intval($input['service_id'] ?? 0);

    if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Service ID is required for deletion.']);
        return;
    }

    $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Service deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete service.']);
    }

    $stmt->close();
}