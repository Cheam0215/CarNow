<?php
$con = mysqli_connect("localhost","root","","carnow1");

if (mysqli_connect_errno())
  {
  echo "There is an error in your database: " . mysqli_connect_error();
  }
?>