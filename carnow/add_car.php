<?php

  if(isset($_POST['add-car-button'])){
    include("connection.php");
    $carPlate = $_POST['car-plate'];
    $query = "SELECT * FROM car WHERE car_plate = '$carPlate'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
      echo "<script>alert('Car has already been registered before ! ');window.location.href='my_profile.php';</script>";
    } else {
      $userID = $_POST['sessionID'];
      $carBrand = $_POST['car-brand'];
      $carModel = $_POST['model'];
      $carYear = $_POST['year'];
      $carColor = $_POST['color'];
    }

    $sql = "INSERT INTO car (
      car_plate,
      user_id,
      brand,
      model,
      year,
      color
      )
     VALUES (
      '$carPlate',
      '$userID',
      '$carBrand',
      '$carModel',
      '$carYear',
      '$carColor')";

      if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
      } else {
        echo "<script>alert('Car information added successfully!');window.location.href='my_profile.php';</script>";
      }
  } else {
      echo "Please submit the form. Thank you.";
  }
?>