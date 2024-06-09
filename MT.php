<?php
include("MTsession.php");
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

</head>

<body>
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
                include("connection.php");

                if(isset($_POST['booking_id']) && isset($_POST['car_plate'])) {
                    $bookingId = $_POST['booking_id'];
                    $carPlate = $_POST['car_plate'];

                    echo "<input type='hidden' id='bookingId' value='$bookingId'>";
                    echo "<input type='hidden' id='carPlate' value='$carPlate'>";

                    $sql = "SELECT * FROM booking WHERE booking_id = '$bookingId' AND car_plate = '$carPlate'";
                    $result = mysqli_query($con, $sql);

                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='booking-details'>";
                            echo "<p>Booking ID: " . $row['booking_id'] . "</p>";
                            echo "<p>Car Plate: " . $row['car_plate'] . "</p>";
                            echo "<p>Service Type: " . $row['service_type'] . "</p>";
                            echo "<p>Booking Description: " . $row['booking_description'] . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No booking details found.</p>";
                    }
                } else {
                    echo "<p>Booking ID and car plate are not provided.</p>";
                }
                ?>
                <button id="start" onclick="startMaintenance()">Start</button>
            </div>

            <div class="record-section" id="record-section">
                <form id="car-maintenance-form" method="POST" action="MT.php" onsubmit="handleSubmit(event)">
                    <h3>Car Issues</h3>
                    <?php
                        if(isset($bookingId) && isset($carPlate)) {
                            $sql = "SELECT * FROM booking WHERE booking_id = '$bookingId' AND car_plate = '$carPlate'";
                            $result = mysqli_query($con, $sql);

                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<div class='booking-details'>";
                                    echo "<p>Booking ID: " . $row['booking_id'] . "</p>";
                                    echo "<p>Car Plate: " . $row['car_plate'] . "</p>";
                                    echo "<p>Service Type: " . $row['service_type'] . "</p>";
                                    echo "<p>Booking Description: " . $row['booking_description'] . "</p>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<p>No booking details found.</p>";
                            }
                        } else {
                            echo "<p>Booking ID and car plate are not provided.</p>";
                        }
    
                        if (isset($_POST['submit-button'])) {                         
                            $bookingId =  $_POST['booking_id'];
                            $service_details = $_POST['car-issue'];
                            echo "<input type='hidden' id='bookingId' value='$bookingId'>";
                            
                            $query = "INSERT INTO maintenance (booking_id, service_details, progress)
                                    VALUES ('$bookingId', '$service_details', 'In Progress')";
                            $queryrun = mysqli_query($con, $query);
                
                            if ($queryrun) {
                                echo '<script type="text/javascript"> alert("Maintenance Recorded") </script>';
                            } else {
                                die("Error: " . mysqli_error($con));
                            }
                            
                            }          
                    ?>
                    
                    <div id="car-issues-container">
                        <div class="car-issue-row">
                            <select name="car-issue"><span id="car-issue"></span>
                                <option value="Change of Engine Oil">Change of Engine Oil</option>
                                <option value="Change of Transmission Fluid">Change of Transmission Fluid</option>
                                <option value="Oil Filter Renewal">Oil Filter Renewal</option>
                                <option value="Air Filter Renewal">Air Filter Renewal</option>
                                <option value="Refill Coolant">Refill Coolant</option>
                                <option value="Change of Spark Plugs">Change of Spark Plugs</option>
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
            <form method="post" action="MT.php">
                <div class="invoice">
                    <p>Type of Service: <span id="car-issue-done"></span></p>
                    <input type="hidden" name="hidden-car-issue" id="hidden-car-issue">
                    <p>Car Plate: <span id="car-plate"></span></p>
                    <input type="hidden" name="hidden-carPlate" id="hidden-carPlate">
                    <p>Appointment Date: <span id="appointment-date"></span></p>
                    <input type="hidden" name="hidden-appointmentDate" id="hidden-appointmentDate">
                    <p>Appointment Time: <span id="appointment-time"></span></p>
                    <input type="hidden" name="hidden-appointmentTime" id="hidden-appointmentTime">
                    <p>Service Description: <span id="description"></span></p>
                    <input type="hidden" name="hidden-description" id="hidden-description">
                </div>
                <button id="done" name="submit-button" onclick="completePayment()">Submit</button>
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

    <script src="Scripts/MT.js"></script>
</body>

</html>