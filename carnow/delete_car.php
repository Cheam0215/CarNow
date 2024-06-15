<?php
  include("connection.php");
  
  if (isset($_GET['car_plate'])){
    $id = $_GET['car_plate'];
    $sql = "DELETE FROM car WHERE car_plate = '$id'";
    
    $result = mysqli_query($con,$sql);
    mysqli_close($con);

    echo "<script>alert('Car deleted!');window.location.href='my_profile.php'</script>";
  }

  else {
    echo "<script>alert('Please select a car to delete!');window.location.href='my_profile.php';</script>";
  }
?>