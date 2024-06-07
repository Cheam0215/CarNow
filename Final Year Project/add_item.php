<?php

  if(isset($_POST['add-item-button'])){
    include("connection.php");


    $target_dir = "item_image/";

    $target_file = $target_dir . basename($_FILES["item-image"]["name"]);

    if (move_uploaded_file($_FILES["item-image"]["tmp_name"], $target_file)) {

        $file_name = basename($_FILES["item-image"]["name"]); 
        $sql = "INSERT INTO inventory (
          item_name,
          quantity,
          cost,
          item_brand,
          item_image
          )
         VALUES (
          '$_POST[itemName]',
          '$_POST[quantity]',
          '$_POST[cost]',
          '$_POST[itemBrand]',
          '".$file_name."')";


          if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
          } else {
            echo "<script>alert('Item information added successfully!');window.location.href='admin_inventory.php';</script>";
          }
          } else {
          echo "<script>alert('There was an error uploading your file.');window.location.href='admin_inventory.php';</script>";
          }
          } else {
          echo "Sorry, there was an error uploading your file.";
          }
?>