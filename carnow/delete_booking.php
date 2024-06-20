<?php
  include("connection.php");
  
  if (isset($_GET['booking_id'])){
    $id = $_GET['booking_id'];
    $sql = "DELETE FROM booking WHERE booking_id = '$id'";
    
    $result = mysqli_query($con,$sql);
    mysqli_close($con);

    echo "<script>alert('Appointment deleted!');window.location.href='my_booking.php'</script>";
  }

  else {
    echo "<script>alert('Please select an appointment to delete!');window.location.href='my_booking.php';</script>";
  }
?>