<?php

include("connection.php");

if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $getImageNameSql = "SELECT user_image FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $getImageNameSql);

    if (!$result) {
        die('Error fetching current image name: ' . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    $currentImageName = $row['user_image'];
    $newImageName = $currentImageName;

    if (!empty($_FILES['user_image']['name'])) {
        $oldImagePath = "user_image/" . $currentImageName;
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        $target_dir = "user_image/";
        $target_file = $target_dir . basename($_FILES["user_image"]["name"]);

        if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
            $newImageName = basename($_FILES["user_image"]["name"]);
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }

    $updateSql = "UPDATE user SET
        username = '$_POST[name]',
        email = '$_POST[email]',
        password = '$_POST[password]',
        contact_number = '$_POST[contact_number]',
        role = '$_POST[role]',
        ic_number = '$_POST[ic_number]',
        user_image = '$newImageName'
        WHERE user_id = '$user_id'";

    if (!mysqli_query($con, $updateSql)) {
        die('Error updating user details: ' . mysqli_error($con));
    } else {
        echo "<script>alert('User Information updated successfully!');window.location.href='admin_user.php?user_id=1';</script>";
    }
}

?>
