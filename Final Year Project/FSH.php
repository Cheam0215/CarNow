<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "car_maintenance_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = intval($_GET['user_id']);

$sql = "SELECT date, service, payment FROM service_history WHERE user_id=$user_id";
$result = $conn->query($sql);

$service_history = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $service_history[] = $row;
    }
}

echo json_encode($service_history);

$conn->close();
?>