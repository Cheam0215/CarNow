<?php
    include("connection.php");
    $maintenanceID = $_POST['maintenance_id'];
    $serviceRating = $_POST['service_rating'];
    $description = $_POST['description'];
    $userID = $_POST['sessionID'];

    $sql = "INSERT INTO feedback (user_id, maintenance_id, rating, description)
        VALUES ('$userID', '$maintenanceID', '$serviceRating', '$description')";

if (!mysqli_query($con, $sql)) {
    die('Error: ' . mysqli_error($con));
  } else {
    echo "<script>alert('Thank you for your feedback!');window.location.href='my_booking.php';</script>";
  }
?>
