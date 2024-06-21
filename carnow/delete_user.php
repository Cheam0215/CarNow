<?php

include ("connection.php");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_GET['main_id'])) {

    $id = intval($_GET['main_id']);

    
    $sql = "DELETE FROM user WHERE user_id = $id";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('User deleted successfully'); window.location.href = 'admin_user.php?user_id=1';</script>";
    } else {
        echo "Error deleting user: " . $con->error;
    }
} else {
    echo "Main ID not provided.";
}


$con->close();
?>
