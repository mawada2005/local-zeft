<?php
$servername = "2.tcp.eu.ngrok.io";
$username = "root";
$password = "";
$database = "local shop";
$port = 13524;

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
