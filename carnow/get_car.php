<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carPlate = htmlspecialchars($_POST['car-plate']);
    $carBrand = htmlspecialchars($_POST['car-brand']);
    $carModel = htmlspecialchars($_POST['car-model']);
    $carYear = htmlspecialchars($_POST['car-year']);
    $carColor = htmlspecialchars($_POST['car-color']);

    echo '<div class="add-car-form" id="edit-car-form">';
    echo '<div class="close-button">';
    echo '<i id="close" class="fa fa-close" style="font-size:24px"></i>';
    echo '</div>';

    echo '<div id="first-form-group" class="form-group-add">';
    echo '<label for="car-plate">Car Plate</label>';
    echo '<input type="text" name="carPlate" id="car-plate" value="' . $carPlate . '" readonly>';
    echo '</div>';

    echo '<div class="form-group-add">';
    echo '<label for="car-brand">Brand</label>';
    echo '<select name="carBrand" id="car-brand" required>';
    echo '<option value="Proton" ' . ($carBrand == "Proton" ? "selected" : "") . '>Proton</option>';
    echo '<option value="Perodua" ' . ($carBrand == "Perodua" ? "selected" : "") . '>Perodua</option>';
    echo '<option value="Toyota" ' . ($carBrand == "Toyota" ? "selected" : "") . '>Toyota</option>';
    echo '</select>';
    echo '</div>';

    echo '<div class="form-group-add">';
    echo '<label for="model">Model</label>';
    echo '<input type="text" name="model" id="model" value="' . $carModel . '" required>';
    echo '</div>';

    echo '<div class="form-group-add">';
    echo '<label for="year">Year</label>';
    echo '<input type="text" name="year" id="year" value="' . $carYear . '" required min="1">';
    echo '</div>';

    echo '<div class="form-group-add">';
    echo '<label for="color">Color</label>';
    echo '<input type="text" name="color" id="color" value="' . $carColor . '" required>';
    echo '</div>';

    echo '<div id="form-add" class="form-group-add">';
    echo '<button type="submit" name="update-car-button" class="update-btn"><a style="display:flex"id="update">Update<span class="material-symbols-outlined">update</span></a></button>';
    echo '</div>';
    echo '</div>';
}
?>
