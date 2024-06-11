<?php
  include("connection.php");
  
  if (isset($_GET['feedback_id'])){
    $id = $_GET['feedback_id'];
    $sql = "DELETE FROM feedback WHERE feedback_id = $id";
    
    $result = mysqli_query($con,$sql);
    mysqli_close($con);

    echo "<script>alert('Feedback deleted!');window.location.href='admin_feedback.php'</script>";
  }

  else {
    echo "<script>alert('Please select an item to delete!');window.location.href='admin_feedback.php';</script>";
  }
?>