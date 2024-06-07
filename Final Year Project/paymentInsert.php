<?php


if (isset($_POST['payment_button'])) {
  include("connection.php");
  $timestamp = time();
  $amount = $_POST['total'];

  $sql = "INSERT INTO payment (user_id, maintenance_id, time, payment_status, amount)
                VALUES (1, 1, '$timestamp', 'PAID', '$amount')";


  if (!mysqli_query($con, $sql)) { 
    die('Error: ' . mysqli_error($con));
  } else {
    echo "<script>alert('Payment Succesful!');window.location.href='paymentV2.php';</script>";
  }
}

else{
  echo "<script>alert('Payment Failed!');window.location.href='paymentV2.php';</script>";
}
?>  