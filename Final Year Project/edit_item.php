<?php
include("connection.php");

if (isset($_POST['edit-item-button'])) {
    $item_id = $_POST['item_id'];
    $getImageNameSql = "SELECT item_image FROM inventory WHERE item_id = '$item_id'";
    $result = mysqli_query($con, $getImageNameSql);

    if (!$result) {
        die('Error fetching current image name: ' . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    $currentImageName = $row['item_image'];
    $newImageName = $currentImageName;

    if (!empty($_FILES['item-image']['name'])) {
        $oldImagePath = "item_image/" . $currentImageName;
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        $target_dir = "item_image/";
        $target_file = $target_dir . basename($_FILES["item-image"]["name"]);

        if (move_uploaded_file($_FILES["item-image"]["tmp_name"], $target_file)) {
            $newImageName = basename($_FILES["item-image"]["name"]);
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }

    $updateSql = "UPDATE inventory SET
        item_name = '$_POST[itemName]',
        item_brand = '$_POST[itemBrand]',
        quantity = '$_POST[quantity]',
        cost = '$_POST[cost]',
        item_image = '$newImageName'
        WHERE item_id = '$item_id'";

    if (!mysqli_query($con, $updateSql)) {
        die('Error updating item details: ' . mysqli_error($con));
    } else {
        echo "<script>alert('Item updated successfully!');window.location.href='admin_inventory.php';</script>";
    }
}
?>
