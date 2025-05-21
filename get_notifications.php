<?php
require 'connect.php';

// استقبال البيانات
$data = json_decode(file_get_contents("php://input"), true);
$receiver_id = intval($data['receiver_id']);

$response = [];

$sql = "SELECT message, created_at FROM notifications WHERE receiver_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $receiver_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $response[] = $row;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
