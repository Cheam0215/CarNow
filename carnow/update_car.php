<?php
include("connection.php");

if (isset($_POST['update-car-button'])) {
  $carPlate = $_POST['carPlate'];
  $updateSql = "UPDATE car SET
    brand = '$_POST[carBrand]',
    model = '$_POST[model]',
    color = '$_POST[color]',
    year = '$_POST[year]'
    WHERE car_plate = '$carPlate'";

  if (!mysqli_query($con, $updateSql)) {
    die('Error updating car information: ' . mysqli_error($con));
  } else {
    echo "<script>alert('Car information updated successfully!');window.location.href='my_profile.php';</script>";
  }
}
?>
