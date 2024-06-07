<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarNow Staff Maintenance</title>
    <link rel="stylesheet" href="Appointment.css">
    <!-- UniIcon CDN Link  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


    <?php
        include("connection.php");

        if (isset($_POST['submit-button'])) {

            $car_plate = $_POST['carPlate'];
            $time = $_POST['appointmentTime'];
            $date = $_POST['appointmentDate'];
            $service_type = $_POST['car-issue'];
            $booking_confirmation = "Booking Registered";

            $check_booking_query = "SELECT * FROM booking WHERE booking_date = '$date' AND booking_time = '$time'";
            $check_booking_query_run = mysqli_query($con, $check_booking_query);

            if(mysqli_num_rows($check_booking_query_run) > 0) {
                echo '<script type="text/javascript"> alert("Booking Already Exists") </script>';
            } else {
                $query = "INSERT INTO booking (car_plate, service_type, booking_date, booking_time, booking_confirmation) 
                VALUES ('$car_plate', '$service_type', '$date', '$time', '$booking_confirmation')";
                $queryrun = mysqli_query($con, $query);

                if ($queryrun) {
                    echo '<script type="text/javascript"> alert("Booking Registered") </script>';
                } else {
                    die("Error: " . mysqli_error($con));
                }
            }
        }

    ?>

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

        <form method="POST" action="appointment2.php">
            <div class="details-section">
                <div class="details" id="details">
                        <h1>Car Details</h1>
                        <label for="carPlate">CarPlate</label>
                        <input type="text" id="carPlate" name="carPlate" placeholder="Enter Car Plate" required><br>
                        <label for="appointmentDate">Appointment Date:</label>
                        <input type="date" id="appointmentDate" name="appointmentDate" required>
                        <label for="appointmentTime">Appointment Time:</label>
                        <input type="time" id="appointmentTime" name="appointmentTime" required>
                        <button id="start" onclick="startMaintenance()">Start</button>
                </div>
                <div class="record-section" id="record-section">
                    <h1>Car Maintenance</h1>
                    <form id="car-maintenance-form" onsubmit="handleSubmit(event)">
                        <label for="car-issue">Types of Service:</label>
                        <select id="car-issue" name="car-issue">
                            <option value="Periodical Service">Periodical Service</option>
                            <option value="Other Services">Other Services</option>
                        </select>
                        <button type="submit" id="submit">Confirm</button>
                    </form>
                </div>
            </div>
        </form>
        <div class="payment-section" id="payment-section">
            <h1>Confirm Your Appointment</h1>
            <div class="invoice">
                <p>Type of Service: <span id="car-issue-done"></span></p>
                <p>Car Plate: <span id="car-plate"></span></p>
                <p>Appointment Date: <span id="appointment-date"></span></p>
                <p>Appointment Time: <span id="appointment-time"></span></p>
            </div>
            <button id="done" name="submit-button" onclick="completePayment()">Submit</button>
        </div>
        <div class="done-section" id="done-section">
            <i class="icon uil uil-check-circle"></i>
            <h1>Congratulation!</h1>
            <p>Your Booking is completed!</p>
            <p>Your booking was completed on: <span id="payment-date"></span></p>
            <button id="done" name="booking-button" onclick="doneBooking()">OK</button>
        </div>
    </div>

    <script src="appointment.js"></script>
</body>

</html>
