<?php
require 'connect.php';

// إذا عندك user_id مخزن في الجلسة:
session_start();
$user_id = $_SESSION['user_id'] ?? 0;

$stmt = $conn->prepare("SELECT message, created_at FROM notifications WHERE receiver_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

header('Content-Type: application/json');
echo json_encode($notifications);
?>
