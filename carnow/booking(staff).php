<?php include ('session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking(Staff)</title>
    <link rel="stylesheet" href="Styles/booking(staff).css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />

    <script src="scripts/booking(staff).js" defer></script> 
</head>

<?php
    include("connection.php");
    $query5 = "SELECT user_image ,username from user where role = 'staff';";
    $result5= mysqli_query($con, $query5);

    if ($result5) {
        $row = mysqli_fetch_assoc($result5);
        $profilePic = $row['user_image'];
        $username = $row['username'];
    } else {
        echo "<h1>No Record Thus Far</h1>";
        echo "Error: " . mysqli_error($con); 
    }
?>

<body>
    <div class="container">
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="logo_image/carnowLogo.png" alt="Logo" class="now">
                </div>

            </div>

            <div class="sidebar">
                <a href="booking(staff).php" class="active">
                    <span class="material-symbols-sharp">
                        book
                    </span>
                    <h3>Booking</h3>
                </a>
                <a href="MT.php">
                    <span class="material-symbols-sharp">
                        inventory
                    </span>
                    <h3>Service</h3>
                </a>

                <a href="#">
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
                        <img src="user_user_image/<?php echo $profilePic?>">
                    </div>
                </div>
            </div>
        </div>


        <div class="main">
            <h1>Booking Details</h1>
            <div class="toggle-buttons">
                <button id="pendingButton" class="toggle-button active" onclick="showSection('pending')">Pending</button>
                <button id="bookedButton" class="toggle-button" onclick="showSection('booked')">Booked</button>
                <button id="inServiceButton" class="toggle-button" onclick="showSection('inService')">In Service</button>
            </div>       
        
            <div class="section" id="pendingSection">
                <h2>Pending</h2>
                <div class="pending" id="pending">
                    <?php
                    include("connection.php");

                    $sql = "SELECT * FROM booking WHERE booking_confirmation = 'Pending'";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>";
                        echo "<tr>
                        <th>Booking ID</th>
                        <th>Car Plate</th>
                        <th>Service Type</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Description</th>
                        <th>Actions</th>
                        </tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $statusClass = strtolower($row["booking_confirmation"]);
                            echo "<tr>
                            <td>" . $row["booking_id"] . "</td>
                            <td>" . $row["car_plate"] . "</td>
                            <td>" . $row["service_type"] . "</td>
                            <td><div><p class='$statusClass'>" . $row["booking_confirmation"] . "</p></div></td>
                            <td>" . $row["booking_date"] . "</td>
                            <td>" . $row["booking_time"] . "</td>
                            <td>" . $row["booking_description"] . "</td>
                            <td>
                                <form method='post' action='updatebooking.php'>
                                <input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>
                                <input type='hidden' name='car_plate' value='" . $row['car_plate'] . "'>
                                <button type='submit' name='approvebutton' class='approvebutton'>Approve</button>
                                <button type='submit' name='rejectbutton' class='rejectbutton'>Reject</button>
                                </form>
                            </td>
                            </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo '<h1 style="text-align:center;">There are no bookings.</h1><br>';
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="bookedSection" style="display: none;">
                <h2>Booked</h2>
                <div class="booked" id="booked">
                <?php
                $sql1 = "SELECT * FROM booking WHERE booking_confirmation = 'Confirmed'";
                $result1 = mysqli_query($con, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    echo "<table>";
                    echo "<tr>
                    <th>Booking ID</th>
                    <th>Car Plate</th>
                    <th>Service Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                    <th>Actions</th>
                    </tr>";
                    while ($row = mysqli_fetch_assoc($result1)) {
                        $statusClass = strtolower($row["booking_confirmation"]);
                        echo "<tr>
                        <td>" . $row["booking_id"] . "</td>
                        <td>" . $row["car_plate"] . "</td>
                        <td>" . $row["service_type"] . "</td>
                        <td><div><p class='$statusClass'>" . $row["booking_confirmation"] . "</p></div></td>
                        <td>" . $row["booking_date"] . "</td>
                        <td>" . $row["booking_time"] . "</td>
                        <td>" . $row["booking_description"] . "</td>
                        <td>
                            <form method='post' action='MT.php'>
                            <input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>
                            <input type='hidden' name='car_plate' value='" . $row['car_plate'] . "'>
                            <button type='submit' name='start' class='start'>Start</button>
                            </form>
                        </td>
                        </tr>";
                    }
                    echo "</table>";
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        include("connection.php");
                        
                        if (isset($_POST['start'])) {
                            $bookingId = $_POST['booking_id'];
                            $car_plate = $_POST['car_plate'];
                            $query = "SELECT MAX(maintenance_id) AS max_id FROM maintenance";
                            $result = mysqli_query($con, $query);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $maxMaintenanceId = $row['max_id'];
                                $newMaintenanceId = $maxMaintenanceId + 1;
                    
                                $query = "INSERT INTO maintenance (maintenance_id, booking_id, progress)
                                          VALUES ('$newMaintenanceId', '$bookingId', 'In Service')";
                                $queryrun = mysqli_query($con, $query);
                    
                                if (!$queryrun) {
                                    die("Error: " . mysqli_error($con));
                                } else {
                                    $updateQuery = "UPDATE booking SET booking_confirmation = 'In Service' WHERE booking_id = '$bookingId'";
                                    mysqli_query($con, $updateQuery);
                                    echo "<input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>";
                                    echo "<input type='hidden' id='car_plate' value='".$row['car_plate']."'>";
                                    echo "<script>alert('Maintenance started successfully!');window.location.href='MT.php';</script>";  
                                    exit();
                                }
                            }
                        }
                    }
                } else {
                    echo '<h1 style="text-align:center;">There are no bookings.</h1><br>';
                }
                
                ?>
                </div>
            </div>
            <div class="section" id="inServiceSection" style="display: none;">
                <h2>In Service</h2>
                <div class="inService" id="inService">
                <?php
                $sql2 = "SELECT * FROM booking WHERE booking_confirmation = 'In Service'";
                $result2 = mysqli_query($con, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    echo "<table>";
                    echo "<tr>
                    <th>Booking ID</th>
                    <th>Car Plate</th>
                    <th>Service Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                    <th>Actions</th>
                    </tr>";
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $statusClass = strtolower($row["booking_confirmation"]);
                        echo "<tr>
                        <td>" . $row["booking_id"] . "</td>
                        <td>" . $row["car_plate"] . "</td>
                        <td>" . $row["service_type"] . "</td>
                        <td><div><p class='$statusClass'>" . $row["booking_confirmation"] . "</p></div></td>
                        <td>" . $row["booking_date"] . "</td>
                        <td>" . $row["booking_time"] . "</td>
                        <td>" . $row["booking_description"] . "</td>
                        <td>
                            <form method='post' action='MT.php'>
                            <input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>
                            <input type='hidden' name='car_plate' value='" . $row['car_plate'] . "'>
                            <button type='submit' name='continue' class='continue'>Continue</button>
                            </form>
                        </td>
                        </tr>";
                    }
                    echo "</table>";
                } else {
                    echo '<h1 style="text-align:center;">There are no service ongoing now.</h1><br>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>