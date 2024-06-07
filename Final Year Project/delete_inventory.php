<?php
  include("connection.php");
  
  if (isset($_GET['item_id'])){
    $id = $_GET['item_id'];
    $sql = "DELETE FROM inventory WHERE item_id = $id";
    
    $result = mysqli_query($con,$sql);
    mysqli_close($con);

    echo "<script>alert('Item deleted!');window.location.href='admin_inventory.php'</script>";
  }

  else {
    echo "<script>alert('Please select an item to delete!');window.location.href='admin_inventory.php';</script>";
  }
?>