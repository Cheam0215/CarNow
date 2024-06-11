<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carnow1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = intval($_GET['user_id']);

$sql = "SELECT time, maintenance_id, amount FROM payment WHERE user_id=$user_id";
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