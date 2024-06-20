<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Carnow";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['main_id'])) {

    $id = intval($_GET['main_id']);

    
    $sql = "DELETE FROM user WHERE user_id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User deleted successfully'); window.location.href = 'admintest.php?user_id=18';</script>";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Main ID not provided.";
}


$conn->close();
?>
