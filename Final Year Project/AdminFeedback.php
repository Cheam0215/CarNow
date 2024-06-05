<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "car_maintenance_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT id, name, email, feedback FROM feedback";
    $result = $conn->query($sql);

    $feedbacks = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $feedbacks[] = $row;
        }
    }
    echo json_encode($feedbacks);
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = intval($data['id']);

    $sql = "DELETE FROM feedback WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Feedback deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>