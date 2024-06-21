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
  
    $user_id = $_POST['user_id']; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact_number = $_POST['contact_number'];
    $ic_number = $_POST['ic_number'];
    $picture = $_POST['picture'];
    $role = $_POST['role'];

    
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $password_sql = "password = '$hashed_password',";
    } 


    $sql = "UPDATE user SET 
                username = '$name', 
                email = '$email', 
                $password_sql
                contact_number = '$contact_number', 
                ic_number = '$ic_number', 
                picture = '$picture', 
                role = '$role' 
            WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User updated successfully!');window.location.href='admintest.php?user_id=$user_id';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}

?>
