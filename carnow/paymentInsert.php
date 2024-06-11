<?php
if (isset($_POST['payment_button'])) {
    include("connection.php");

    $timestamp = time();
    $amount = floatval($_POST['total']);
    $payment_method = $_POST['payment_method'];

    $sql = "INSERT INTO payment (user_id, maintenance_id, time, payment_status, amount, payment_method)
            VALUES (1, 1, '$timestamp', 'PAID', '$amount', '$payment_method')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    } else {
        echo "<script>alert('Payment Successful!');window.location.href='payment_page.php';</script>";
    }
} else {
    echo "<script>alert('Payment Failed!');window.location.href='payment_page.php';</script>";
}
?>
