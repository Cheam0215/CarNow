<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Carnow";



$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact_number = $_POST['contact_number'];
    $ic_number = $_POST['ic_number'];
    $picture = $_POST['picture'];

 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO user (username, email, password, contact_number, ic_number, picture, role) 
            VALUES ('$name', '$email', '$hashed_password', '$contact_number', '$ic_number', '$picture', 'staff')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New staff created successfully!');window.location.href='admintest.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
}
?>