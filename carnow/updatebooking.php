<?php

if (isset($_POST['approvebutton'])) {
    include("connection.php");

    $sql = "UPDATE booking SET
    booking_confirmation = 'Confirmed'
    WHERE booking_id = '$_POST[booking_id]'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    } else {
        echo "<script>alert('Booking updated successfully!');window.location.href='booking(staff).php';</script>";
    }

} elseif (isset($_POST['rejectbutton'])) {
    include("connection.php");

    $sql = "UPDATE booking SET
    booking_confirmation = 'Rejected'
    WHERE booking_id = '$_POST[booking_id]'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    } else {
        echo "<script>alert('Booking updated successfully!');window.location.href='booking(staff).php';</script>";
    }

}

?>
