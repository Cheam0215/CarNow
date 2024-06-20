<?php
if (isset($_POST['payment_button'])) {
    include("connection.php");
    $maintenance_id = $_POST['maintenance_id'];
    $user_id = $_POST['user_id'];
    $deletePayment = "DELETE FROM payment WHERE maintenance_id = $maintenance_id";
    mysqli_query($con, $deletePayment);


    $timestamp = date('Y-m-d H:i:s'); // Get current date and time
    $amount = floatval($_POST['total']);
    $payment_method = $_POST['payment_method'];

    $sql = "INSERT INTO payment (user_id, maintenance_id, time, payment_status, amount, payment_method)
            VALUES ($user_id, $maintenance_id, '$timestamp', 'PAID', '$amount', '$payment_method')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    } else {
        echo "<script>alert('Payment Successful!');window.location.href='my_bookingnew.php';</script>";
    }
} else {
    echo "<script>alert('Payment Failed!');window.location.href='my_bookingnew.php';</script>";
}
?>
