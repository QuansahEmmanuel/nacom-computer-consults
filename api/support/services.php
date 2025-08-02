<?php

 require_once('../../includes/db.php');
 
    $sql = "SELECT * FROM services ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $bookings = [];
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $bookings
    ]);         