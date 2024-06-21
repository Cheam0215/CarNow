<?php

if(isset($_POST['add-item-button'])){
  include("connection.php");

  // Validation function to check if item already exists
  function itemExists($con, $itemName, $itemBrand) {
      $query = "SELECT COUNT(*) AS item_count FROM inventory WHERE item_name = ? AND item_brand = ?";
      $stmt = mysqli_prepare($con, $query);
      mysqli_stmt_bind_param($stmt, "ss", $itemName, $itemBrand);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $count);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);
      return $count > 0;
  }

  $itemName = $_POST['itemName'];
  $itemBrand = $_POST['itemBrand'];

  if (itemExists($con, $itemName, $itemBrand)) {
      echo "<script>alert('Item with the same name and brand already exists.');window.location.href='admin_inventory.php';</script>";
  } else {
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
            '".$itemName."',
            '".$_POST['quantity']."',
            '".$_POST['cost']."',
            '".$itemBrand."',
            '".$file_name."')";

            if (!mysqli_query($con, $sql)) {
              die('Error: ' . mysqli_error($con));
            } else {
              echo "<script>alert('Item information added successfully!');window.location.href='admin_inventory.php';</script>";
            }
      }
  }
}
?>