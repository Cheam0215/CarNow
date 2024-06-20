<?php
include("session.php");
include("connection.php");

if (!isset($_SESSION['mySession'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['start'])) {
    $bookingId = $_POST['booking_id'];
    $carPlate = $_POST['car_plate'];
    $query = "SELECT MAX(maintenance_id) AS max_id FROM maintenance";
    $getUserID = "SELECT user.user_id FROM user 
                    INNER JOIN car ON user.user_id = car.user_id 
                    WHERE car.car_plate = '$carPlate'";
    $resultID = mysqli_query($con, $getUserID);
    $rowID = mysqli_fetch_assoc($resultID);
    $getUserID = $rowID['user_id'];
    $result = mysqli_query($con, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        $maxMaintenanceId = $row['max_id'];
        $newMaintenanceId = $maxMaintenanceId + 1;

        $query = "INSERT INTO maintenance (maintenance_id, booking_id, item_id, progress)
                  VALUES ('$newMaintenanceId', '$bookingId',1, 'In Service')";
        $paymentQuery = "INSERT INTO payment (maintenance_id, user_id, payment_status)
                         VALUES ('$newMaintenanceId', '$getUserID', 'UNPAID')";
        $queryRun = mysqli_query($con, $query);
        $paymentQueryRun = mysqli_query($con, $paymentQuery);

        if (!$queryRun || !$paymentQueryRun) {
            die("Error: " . mysqli_error($con));
        } else {
            $updateQuery = "UPDATE booking SET booking_confirmation = 'In Service' WHERE booking_id = '$bookingId'";
            
            mysqli_query($con, $updateQuery);
            echo "<script>alert('Maintenance started successfully!');</script>";
            
        }
    }
}

if (isset($_POST['continue'])) {
    $bookingId = $_POST['booking_id'];
    $carPlate = $_POST['car_plate'];
    $query = "SELECT maintenance_id FROM maintenance WHERE booking_id = '$bookingId' AND progress = 'In Service'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Maintenance already in progress!');</script>"; 
    } else {
        echo "<script>alert('Maintenance record not found!');</script>";
    }
}


if (isset($_POST['submit-button'])) {
    $bookingId = $_POST['booking_id'];
    $quantityUsedArray = is_array($_POST['quantity_used']) ? $_POST['quantity_used'] : [];
    $sessionID = $_SESSION['mySession'];
    
    // Retrieve the maintenance id before deletion
    $maintenanceIdQuery = "SELECT maintenance_id FROM maintenance WHERE booking_id = '$bookingId'";
    $maintenanceIdResult = mysqli_query($con, $maintenanceIdQuery);
    $maintenanceId = mysqli_fetch_assoc($maintenanceIdResult)['maintenance_id'];

    $deleteQuery = "DELETE FROM maintenance WHERE booking_id = '$bookingId'";
    mysqli_query($con, $deleteQuery);

    $newMaintenanceId = $maintenanceId;
    // Loop through the submitted items 
    foreach ($quantityUsedArray as $itemId => $quantityUsed) {
        if ($quantityUsed > 0) {
            $itemQuery = "SELECT item_name FROM inventory WHERE item_id = '$itemId'";
            $itemResult = mysqli_query($con, $itemQuery);
            $itemName = mysqli_fetch_assoc($itemResult)['item_name'];
            $serviceDetails = "Change of $itemName";
            
            $query = "INSERT INTO maintenance (maintenance_id, booking_id, item_id, service_details, quantity_used, progress)
                        VALUES ('$maintenanceId', '$bookingId', '$itemId', '$serviceDetails', '$quantityUsed', 'Done')";
            $queryrun = mysqli_query($con, $query);
            if (!$queryrun) {
                die("Error: " . mysqli_error($con));
            }
            else{
                $updateQuery = "UPDATE booking SET booking_confirmation = 'Done' WHERE booking_id = '$bookingId'";
                mysqli_query($con, $updateQuery);
                
                $subtractQuery = "UPDATE inventory SET quantity = quantity - '$quantityUsed' WHERE item_id = '$itemId'";
                mysqli_query($con, $subtractQuery);
            }
        }   
    }
    echo "<script>alert('Maintenance completed successfully!');</script>"; 
}
    


// Fetch user details
$sessionID = $_SESSION['mySession'];
$query = "SELECT username FROM user WHERE user_id = '$sessionID'";
$result = mysqli_query($con, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
} else {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarNow Staff Maintenance</title>
    <link rel="stylesheet" href="Styles/MT.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <script src="scripts/MT.js" defer></script>
</head>
<body>
    <div class="container">
    <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="logo_image/carnowLogo.png" alt="Logo" class="now">
                </div>

            </div>

            <div class="sidebar">
                <a href="booking(staff).php" >
                    <span class="material-symbols-sharp">
                        book
                    </span>
                    <h3>Booking</h3>
                </a>
                <a href="MT.php" class="active">
                    <span class="material-symbols-sharp">
                        inventory
                    </span>
                    <h3>Service</h3>
                </a>

                <a href="MThistory.php">
                    <span class="material-symbols-sharp">
                        history
                    </span>
                    <h3>History</h3>
                </a>
                
                <a href="logout.php" class="logout-button">
                    <span class="material-symbols-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
                                
            </div>

        </aside>

        <div class="right-section">
            <div class="nav">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo $username ?></b></p>
                        <small class="text-muted">Staff</small>
                    </div>
                    <div class="profile-photo">
                        <img src="images/profile-icon.png">
                    </div>
                </div>
            </div>
        </div>

        <div class="main">
            <ul>
                <li>
                    <i class="icon uil uil-book"></i>
                    <div class="progress one" id="progress-one">
                        <p>1</p>
                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Details</p>
                </li>
                <li>
                    <i class="icon uil uil-wrench"></i>
                    <div class="progress two" id="progress-two">
                        <p>2</p>
                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">In Progress</p>
                </li>
                <li>
                    <i class="icon uil uil-check-circle"></i>
                    <div class="progress three" id="progress-three">
                        <p>3</p>
                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Done</p>
                </li>
            </ul>

            <div class="details-section">
                <div class="details" id="details">
                    <h1>Booking Details</h1>
                    <?php
                    if (isset($_POST['booking_id']) && isset($_POST['car_plate'])) {
                        $bookingId = $_POST['booking_id'];
                        $carPlate = $_POST['car_plate'];

                        echo "<input type='hidden' id='bookingId' value='$bookingId'>";
                        echo "<input type='hidden' id='carPlate' value='$carPlate'>";

                        $sql = "SELECT * FROM booking WHERE booking_id = '$bookingId' AND car_plate = '$carPlate'";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='booking-details'>";
                                echo "<p>Booking ID: B0" . $row['booking_id'] . "</p>";
                                echo "<p>Car Plate: " . $row['car_plate'] . "</p>";
                                echo "<p>Service Type: " . $row['service_type'] . "</p>";
                                echo "<p>Booking Description: " . $row['booking_description'] . "</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>No booking details found.</p>";
                        }
                    } else {
                        echo "<p>Booking ID and car plate are not provided. <br> Please back to Booking page to start Service.</p>";
                    }
                    ?>
                    <button id="start" onclick="startMaintenance()">Start</button>
                </div>

                <div class="record-section" id="record-section">
                    <form id="car-maintenance-form" method="POST" action="MT.php" onsubmit="handleSubmit(event)">
                        
                    <h3>Service Details</h3>
                        <?php
                        if (isset($bookingId) && isset($carPlate)) {
                            $sql = "SELECT * FROM booking b
                                    INNER JOIN maintenance m on b.booking_id = m.booking_id 
                                    WHERE b.booking_id = '$bookingId' AND b.car_plate = '$carPlate'";
                            $result = mysqli_query($con, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result) ;
                                    echo "<div class='booking-details'>";
                                    echo "<p>Booking ID: B0" . $row['booking_id'] . "</p>";
                                    echo "<p>Car Plate: " . $row['car_plate'] . "</p>";
                                    echo "<p>Service Type: " . $row['service_type'] . "</p>";
                                    echo "<p>Booking Description: " . $row['booking_description'] . "</p>";
                                    echo "</div>";
                                
                            } else {
                                echo "<p>No booking details found.</p>";
                            }
                        } else {
                            echo "<p>Booking ID and car plate are not provided. <br> Please back to Booking page to start Service.</p>";
                        }
                        ?>

                        <div id="car-issues-container">
                            <div class="car-issue-row">
                                <select name="car-issue" id="car-issue">
                                    <?php
                                    $sql = "SELECT * FROM inventory";
                                    $result = mysqli_query($con, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $itemName = $row['item_name'];
                                            $serviceDetail = "Change of " . $itemName;
                                            echo "<option value='$itemName'>$serviceDetail</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </select>
                                <button type="button" class="add-issue-btn" onclick="addIssue()">+</button>
                            </div>
                        </div>
                        <input type="hidden" id="bookingId" name="booking_id" value="<?php echo $bookingId; ?>">
                        <input type="hidden" id="carPlate" name="car_plate" value="<?php echo $carPlate; ?>">
                        <button type="next" id="next">Confirm</button>
                    </form>
                    <button class="back-details" onclick="backToDetails()">Back</button>
                </div>
            </div>

            <div class="payment-section" id="payment-section">
                <h1>Select Inventory</h1>
                <form method="post" action="">
                    <div class="invoice">
                        <input type="hidden" id="bookingId" name="booking_id" value="<?php echo $bookingId; ?>">
                        <input type="hidden" name="hidden-car-issue" id="hidden-car-issue" >
                        
                        <?php
                        $sql = "SELECT * FROM inventory";
                        $result = mysqli_query($con, $sql);
                        ?>

                        <table>
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                    <th>Quantity Used</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $itemId = $row['item_id'];
                                    $itemName = $row['item_name'];
                                    $itemBrand = $row['item_brand'];
                                    $quantity = $row['quantity'];
                                    $cost = $row['cost'];

                                    echo "<tr>
                                        <td class='item_preview'>
                                            <div class='item_id' name='item-id'><b>I00" . $itemId . "</b></div>
                                            <img src='item_image/" . $row["item_image"] . "' alt='" . $itemName . "' class='item_image'>
                                            <div class='item_name'><b>" . $itemName . "</b></div>
                                        </td>
                                        <td>" . $itemBrand . "</td>
                                        <td>" . $quantity . "</td>
                                        <td>MYR " . $cost . ".00</td>
                                        <td>
                                            <input type='number' name='quantity_used[" . $itemId . "]' min='0' max='" . $quantity . "'>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo '<h1 style="text-align:center;">Item not found</h1><br>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" id="maintenanceID" name="maintenanceID" value="<?php echo $row['maintenance_id']; ?>">
                    <button id="done" name="submit-button" type="submit">Submit</button>
                </form>
                <button class="back-record" onclick="backToRecord()">Back</button>
            </div>

            <div class="done-section" id="done-section">
                <i class="icon uil uil-check-circle"></i>
                <h1>Congratulations!</h1>
                <p>Your Booking is completed!</p>
                <button id="done" name="booking-button" onclick="doneBooking()">OK</button>
            </div>
        </div>
    </div>    
</body>
</html>