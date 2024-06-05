<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "car_maintenance_db";

$conn = new mysqli($servername, $username, $password, $dbname);
FSH
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = intval($_GET['user_id']);

$sql = "SELECT name, email FROM users WHERE id=$user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode([]);
}