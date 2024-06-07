<?php
  session_start();

  if (!isset($_SESSION['mySession'])){
    echo "<script>alert('You are not logged in');window.location.href='index.php';</script>";
  }



?>