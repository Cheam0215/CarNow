
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking(Staff)</title>
    <link rel="stylesheet" href="Styles/booking(staff).css"> 


</head>

<body>
    <div class="main">
        <h1>Booking Details</h1>
        <div class="toggle-buttons">
            <button id="pendingButton" class="toggle-button active" onclick="showSection('pending')">Pending</button>
            <button id="bookedButton" class="toggle-button" onclick="showSection('booked')">Booked</button>
        </div>
        <div class="container">
            <div class="section" id="pendingSection">
                <h2>Pending</h2>
                <div class="pending" id="pending">
                    <?php
                    include("connection.php");
                    $sql = "SELECT * FROM booking WHERE booking_confirmation = 'Pending'";

                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>";
                        echo "<tr><th>Booking ID</th><th>Car Plate</th><th>Service Type</th><th>Status</th><th>Date</th><th>Time</th><th>Description</th><th>Actions</th></tr>";
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
                        echo '<h1 style="text-align:center;">There are no applicants.</h1><br>';
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="bookedSection" style="display: none;">
                <h2>Booked</h2>
                <div class="booked" id="booked">
                <?php
                $sql1 = "SELECT * FROM booking WHERE booking_confirmation = 'Confirm'";
                $result1 = mysqli_query($con, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    echo "<table>";
                    echo "<tr><th>Booking ID</th><th>Car Plate</th><th>Service Type</th><th>Status</th><th>Date</th><th>Time</th><th>Description</th><th>Actions</th></tr>";
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
                } else {
                    echo '<h1 style="text-align:center;">There are no bookings.</h1><br>';
                }

                if (isset($_POST['start'])) {
                    $bookingId = $_POST['booking_id'];

                    // Query to get the maximum maintenance_id
                    $query = "SELECT MAX(maintenance_id) AS max_id FROM maintenance";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($result);
                    $maxMaintenanceId = $row['max_id'];

                    // Generate new maintenance_id
                    $newMaintenanceId = $maxMaintenanceId + 1;

                    // Insert new maintenance record
                    $sql2 = "INSERT INTO maintenance (maintenance_id, booking_id, progress) 
                            VALUES ('$newMaintenanceId', '$bookingId', 'In Progress')";
                    $result2 = mysqli_query($con, $sql2);

                    if ($result2) {
                        echo "Maintenance record created successfully.";
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                }
                ?>

                </div>
            </div>
        </div>
    </div>
    <script src="Scripts/booking(staff).js"></script>
</body>

</html>
