<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once('../../includes/db.php');


$sql = "SELECT id, username, email, role, status, created_at FROM users";
$result = $conn->query($sql);

$users = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode(["status" => "success", "data" => $users]);

$conn->close();