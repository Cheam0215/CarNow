<?php
  if(isset($_POST['add-staff-button'])){
    include("connection.php");
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $target_dir = "user_image/";

    $target_file = $target_dir . basename($_FILES["user_image"]["name"]);

    if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {

        $file_name = basename($_FILES["user_image"]["name"]); 
        $sql = "INSERT INTO user (
          username,
          email,
          password,
          contact_number,
        ic_number,
        user_image,
        role
        )
         VALUES (
          '$_POST[name]',
          '$_POST[email]',
          '$hashed_password',
            '$_POST[contact_number]',
            '$_POST[ic_number]',
            '".$file_name."',
            '$_POST[role]')";
          


          if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
          } else {
            echo "<script>alert('" . strtoupper($_POST['role']) . " information added successfully!');window.location.href='admin_user.php?user_id=1';</script>";
          }
          } else {
            $sql = "INSERT INTO user (
              username,
              email,
              password,
              contact_number,
            ic_number,
            role
            )
             VALUES (
              '$_POST[name]',
              '$_POST[email]',
              '$hashed_password',
                '$_POST[contact_number]',
                '$_POST[ic_number]',
                '$_POST[role]')";


          if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
          } else {
              echo "<script>alert('" . strtoupper($_POST['role']) . " information added successfully!');window.location.href='admin_user.php?user_id=1';</script>";
          }
          } }
?>
