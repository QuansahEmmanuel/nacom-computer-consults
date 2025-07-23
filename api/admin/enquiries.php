<?php
header('Content-Type: application/json');
// Consider if you really need * for Access-Control-Allow-Origin in production
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Ensure the path to db.php is correct relative to this file
// *** IMPORTANT: Update this path to match your actual file structure ***
require_once('../../includes/db.php'); // Adjust path if necessary

$method = $_SERVER['REQUEST_METHOD'];

// Helper function to send JSON response and exit
function sendResponse($status, $data = null, $message = '') {
    $response = ['status' => $status];
    if ($data !== null) {
        // The frontend JS (fetchSupportAgents) looks for res.data.agents.
        // For consistency, we'll send the main data payload (enquiries list, agents list)
        // under the 'data' key.
        // When assigning, we send specific details, which is fine.
        $response['data'] = $data;
    }
    if (!empty($message)) {
        $response['message'] = $message;
    }
    echo json_encode($response);
    exit;
}

// Improved helper function to validate enquiry/agent ID
function validateId($id) {
    // Checks if it's a number, and casting to int and back to string doesn't change it, and it's positive.
    return is_numeric($id) && (string)(int)$id === (string)$id && (int)$id > 0;
}

// --- Main Logic ---
if ($method === 'GET') {
    // Check if requesting support agents
    if (isset($_GET['agents']) && $_GET['agents'] == '1') {
        // Get all active support agents
        // *** IMPORTANT: Ensure the WHERE clause correctly identifies your support users ***
        // Based on your initial schema, role='support' and status='active'
        $sql = "SELECT id, username AS name, email FROM users WHERE role = 'support' AND status = 'active' ORDER BY username ASC";
        $result = $conn->query($sql);

        if (!$result) {
            sendResponse('error', null, 'Database error fetching agents: ' . $conn->error);
        }

        $agents = [];
        while ($row = $result->fetch_assoc()) {
            // Sanitize output
            $agents[] = [
                'id' => (int)$row['id'],
                'name' => htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'),
                'email' => htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8')
            ];
        }
        // Send the agents array. The frontend expects it under res.data.
        sendResponse('success', $agents, 'Support agents retrieved successfully');
    }
    // Check if requesting a specific enquiry
    elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (!validateId($id)) {
            sendResponse('error', null, 'Invalid enquiry ID provided.');
        }
        $id = (int)$id;

        $sql = "SELECT e.id, e.customer_name, e.customer_email, e.subject, e.message,
                       e.status, e.created_at, e.updated_at, e.support_agent_id,
                       u.username AS agent_name, u.email AS agent_email
                FROM enquiries e
                LEFT JOIN users u ON e.support_agent_id = u.id
                WHERE e.id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            sendResponse('error', null, 'Database prepare error: ' . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $stmt->close();
            sendResponse('error', null, 'Enquiry not found.');
        }

        $row = $result->fetch_assoc();
        // Sanitize output
        $enquiry = [
            'id' => (int)$row['id'],
            'customer_name' => htmlspecialchars($row['customer_name'], ENT_QUOTES, 'UTF-8'),
            'customer_email' => htmlspecialchars($row['customer_email'], ENT_QUOTES, 'UTF-8'),
            'subject' => htmlspecialchars($row['subject'], ENT_QUOTES, 'UTF-8'),
            'message' => htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8'),
            'status' => $row['status'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
            'support_agent_id' => $row['support_agent_id'] ? (int)$row['support_agent_id'] : null,
            'agent_name' => $row['agent_name'] ? htmlspecialchars($row['agent_name'], ENT_QUOTES, 'UTF-8') : null,
            'agent_email' => $row['agent_email'] ? htmlspecialchars($row['agent_email'], ENT_QUOTES, 'UTF-8') : null
        ];
        $stmt->close();
        sendResponse('success', $enquiry, 'Enquiry retrieved successfully');
    }
    else {
        // Fetch all enquiries with agent information
        $sql = "SELECT e.id, e.customer_name, e.customer_email, e.subject, e.message,
                       e.status, e.created_at, e.updated_at, e.support_agent_id,
                       u.username AS agent_name, u.email AS agent_email
                FROM enquiries e
                LEFT JOIN users u ON e.support_agent_id = u.id
                ORDER BY e.created_at DESC";
        $result = $conn->query($sql);

        if (!$result) {
            sendResponse('error', null, 'Database error fetching enquiries: ' . $conn->error);
        }

        $enquiries = [];
        while ($row = $result->fetch_assoc()) {
             // Sanitize output
            $enquiries[] = [
                'id' => (int)$row['id'],
                'customer_name' => htmlspecialchars($row['customer_name'], ENT_QUOTES, 'UTF-8'),
                'customer_email' => htmlspecialchars($row['customer_email'], ENT_QUOTES, 'UTF-8'),
                'subject' => htmlspecialchars($row['subject'], ENT_QUOTES, 'UTF-8'),
                'message' => htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8'),
                'status' => $row['status'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'support_agent_id' => $row['support_agent_id'] ? (int)$row['support_agent_id'] : null,
                'agent_name' => $row['agent_name'] ? htmlspecialchars($row['agent_name'], ENT_QUOTES, 'UTF-8') : null,
                'agent_email' => $row['agent_email'] ? htmlspecialchars($row['agent_email'], ENT_QUOTES, 'UTF-8') : null
            ];
        }
        sendResponse('success', $enquiries, 'Enquiries retrieved successfully');
    }
}
elseif ($method === 'POST') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        sendResponse('error', null, 'Invalid JSON data received: ' . json_last_error_msg());
    }

    // --- Handle Delete Request ---
    if (isset($data['action']) && $data['action'] === 'delete' && isset($data['id'])) {
        $id = $data['id'];

        if (!validateId($id)) {
            sendResponse('error', null, 'Invalid enquiry ID provided for deletion.');
        }
        $id = (int)$id;

        // Check if enquiry exists
        $checkStmt = $conn->prepare("SELECT id FROM enquiries WHERE id = ?");
        if (!$checkStmt) {
            sendResponse('error', null, 'Database prepare error (check exists): ' . $conn->error);
        }
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $checkStmt->close();
            sendResponse('error', null, 'Enquiry not found for deletion.');
        }
        $checkStmt->close();

        // Perform the delete
        $deleteStmt = $conn->prepare("DELETE FROM enquiries WHERE id = ?");
        if (!$deleteStmt) {
            sendResponse('error', null, 'Database prepare error (delete): ' . $conn->error);
        }
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            if ($deleteStmt->affected_rows > 0) {
                $deleteStmt->close();
                sendResponse('success', null, 'Enquiry deleted successfully.');
            } else {
                $deleteStmt->close();
                sendResponse('error', null, 'No enquiry was deleted (unexpected).');
            }
        } else {
            $error = $deleteStmt->error;
            $deleteStmt->close();
            sendResponse('error', null, 'Delete operation failed: ' . $error);
        }
    }
    // **************************************************************************
    // *** CORRECTED: Agent Assignment/Unassignment Logic                       ***
    // **************************************************************************
    // --- Handle Agent Assignment/Unassignment ---
    // Simplified and corrected the condition. Now it specifically checks for 'assign' action and 'id'.
    elseif (isset($data['action']) && $data['action'] === 'assign' && isset($data['id'])) {

        // Get enquiry ID - Frontend sends 'id'
        $enquiryId = $data['id'];
        // Get agent ID - Frontend sends 'support_agent_id'
        $agentId = isset($data['support_agent_id']) ? $data['support_agent_id'] : null;

        // Validate Enquiry ID
        if (!validateId($enquiryId)) {
            sendResponse('error', null, 'Invalid enquiry ID provided for assignment.');
        }
        $enquiryId = (int)$enquiryId;

        // Check if the enquiry exists
        $checkStmt = $conn->prepare("SELECT id FROM enquiries WHERE id = ?"); // Only need ID to check existence
        if (!$checkStmt) {
            sendResponse('error', null, 'Database prepare error (check enquiry exists): ' . $conn->error);
        }
        $checkStmt->bind_param("i", $enquiryId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows === 0) {
            $checkStmt->close();
            sendResponse('error', null, 'Enquiry not found for assignment.');
        }
        $checkStmt->close(); // Close check statement

        // Validate agent ID if provided (for assignment)
        if ($agentId !== null && $agentId !== '' && $agentId !== 0) {
            if (!validateId($agentId)) {
                sendResponse('error', null, 'Invalid agent ID provided for assignment.');
            }
            $agentId = (int)$agentId;

            // Check if the agent exists and is active
            // *** IMPORTANT: Ensure the WHERE clause correctly identifies your support users ***
            // Example: role='support' AND status='active'
            $agentStmt = $conn->prepare("SELECT id, username FROM users WHERE id = ? AND role = 'support' AND status = 'active'");
            if (!$agentStmt) {
                sendResponse('error', null, 'Database prepare error (check agent): ' . $conn->error);
            }
            $agentStmt->bind_param("i", $agentId);
            $agentStmt->execute();
            $agentResult = $agentStmt->get_result();

            if ($agentResult->num_rows === 0) {
                $agentStmt->close();
                sendResponse('error', null, 'Selected agent is invalid or inactive.');
            }

            $agentData = $agentResult->fetch_assoc();
            $agentName = $agentData['username'];
            $agentStmt->close();
        } else {
            // Unassigning - Explicitly set to null if not a valid ID or if empty
            $agentId = null;
            $agentName = null;
        }

        // Update the assignment and status
        if ($agentId === null) {
            // Unassign agent and set status to unassigned
            $updateStmt = $conn->prepare("UPDATE enquiries SET support_agent_id = NULL, status = 'unassigned', updated_at = NOW() WHERE id = ?");
            if (!$updateStmt) {
                sendResponse('error', null, 'Database prepare error (unassign): ' . $conn->error);
            }
            $updateStmt->bind_param("i", $enquiryId);
            $message = 'Agent unassigned successfully.';
        } else {
            // Assign agent and set status to assigned
            $updateStmt = $conn->prepare("UPDATE enquiries SET support_agent_id = ?, status = 'assigned', updated_at = NOW() WHERE id = ?");
            if (!$updateStmt) {
                sendResponse('error', null, 'Database prepare error (assign): ' . $conn->error);
            }
            $updateStmt->bind_param("ii", $agentId, $enquiryId);
            $message = "Enquiry assigned to {$agentName} successfully.";
        }

        if ($updateStmt->execute()) {
            if ($updateStmt->affected_rows > 0) {
                $updateStmt->close();
                // Send back relevant information for frontend update if needed
                sendResponse('success', [
                    'enquiry_id' => $enquiryId,
                    'agent_id' => $agentId,
                    'agent_name' => $agentName,
                    'status' => $agentId ? 'assigned' : 'unassigned'
                ], $message);
            } else {
                $updateStmt->close();
                sendResponse('success', null, 'No changes made - assignment may already be correct.');
            }
        } else {
            $error = $updateStmt->error;
            $updateStmt->close();
            sendResponse('error', null, 'Assignment update failed: ' . $error);
        }
    }
    // **************************************************************************
    // *** END OF CORRECTION                                                    ***
    // **************************************************************************

    // --- Handle New Enquiry Creation ---
    elseif (isset($data['customer_name']) && isset($data['customer_email']) && isset($data['subject']) && isset($data['message'])) {
        $customerName = trim($data['customer_name']);
        $customerEmail = trim($data['customer_email']);
        $subject = trim($data['subject']);
        $message = trim($data['message']);

        if (empty($customerName) || empty($customerEmail) || empty($subject) || empty($message)) {
            sendResponse('error', null, 'All fields (name, email, subject, message) are required.');
        }

        if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
            sendResponse('error', null, 'Invalid email address format.');
        }

        $insertStmt = $conn->prepare("INSERT INTO enquiries (customer_name, customer_email, subject, message, status, created_at, updated_at) VALUES (?, ?, ?, ?, 'unassigned', NOW(), NOW())");
        if (!$insertStmt) {
            sendResponse('error', null, 'Database prepare error (create): ' . $conn->error);
        }
        // Use 'ssss' for four string parameters
        $insertStmt->bind_param("ssss", $customerName, $customerEmail, $subject, $message);

        if ($insertStmt->execute()) {
            $newId = $conn->insert_id;
            $insertStmt->close();
            sendResponse('success', ['id' => $newId], 'Enquiry created successfully.');
        } else {
            $error = $insertStmt->error;
            $insertStmt->close();
            sendResponse('error', null, 'Failed to create enquiry: ' . $error);
        }
    }
    else {
        // This block catches unmatched POST requests
        sendResponse('error', null, 'Invalid request data format or unsupported action for POST.');
    }
}
// The reference code uses GET for 'view' and POST for actions like 'assign_agent'.
// Your original code used POST for everything. Let's stick with the POST approach
// for actions as it's generally preferred for data modification.
// If you *want* to use GET for viewing specific things (like agents or a single enquiry),
// that's handled in the GET block above.
else {
    // This handles unsupported methods (like PUT, PATCH if they were used)
    sendResponse('error', null, 'Unsupported request method: ' . $method);
}

$conn->close();
?>