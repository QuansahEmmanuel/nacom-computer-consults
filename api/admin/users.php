<?php


require_once('../../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'support_agents') {
    $result = $conn->query("SELECT id, username FROM users WHERE role = 'support' AND status = 'active'");
    $agents = [];

    while ($row = $result->fetch_assoc()) {
        $agents[] = $row;
    }

    echo json_encode(["data" => $agents]);
    exit;
}