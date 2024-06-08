<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarNow Staff Maintenance</title>
    <link rel="stylesheet" href="Appointment.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <?php
    include("connection.php");

    if (isset($_POST['submit-button'])) {

        $car_plate = $_POST['hidden-carPlate'];
        $time = $_POST['hidden-appointmentTime'];
        $date = $_POST['hidden-appointmentDate'];
        $service_type = $_POST['hidden-car-issue'];
        $booking_confirmation = "Booking Registered";
        $car_description = $_POST['hidden-description'];

        $query = "INSERT INTO booking (car_plate, service_type, booking_date, booking_time, booking_confirmation, booking_description) 
        VALUES ('$car_plate', '$service_type', '$date', '$time', '$booking_confirmation', '$car_description')";
        $queryrun = mysqli_query($con, $query);

        if ($queryrun) {
            echo '<script type="text/javascript"> alert("Booking Registered") </script>';
        } else {
            die("Error: " . mysqli_error($con));
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

        
  
        <div class="details-section">
            <div class="details" id="details">
                <h1>Car Details</h1>
                    <label for="carPlate">CarPlate</label>
                    <input type="text" id="carPlate" name="carPlate" placeholder="Enter Car Plate" required><br>
                    <label for="appointmentDate">Appointment Date:</label>
                    <input type="date" id="appointmentDate" name="appointmentDate" required>
                    <label for="appointmentTime">Appointment Time:</label>
                    <select id="appointmentTime" name="appointmentTime" required>
                        <option>Please Select</option>
                        <option>9.00 am</option>
                        <option>10.00 am</option>
                        <option>11.00 am</option>
                        <option>12.00 pm</option>
                        <option>1.00 pm</option>
                        <option>2.00 pm</option>
                        <option>3.00 pm</option>
                        <option>4.00 pm</option>
                        <option>5.00 pm</option>
                    </select>
                    <button id="start" onclick="startMaintenance()">Start</button>
            </div>
            <div class="record-section" id="record-section">
                <h1>Car Maintenance</h1>
                <form id="car-maintenance-form" onsubmit="handleSubmit(event)">
                    <label for="car-issue">Types of Service:</label>
                    <select id="car-issue" name="car-issue">
                        <option value="Please Select">Please Select</option>
                        <option value="Periodical Service">Periodical Service</option>
                        <option value="Other Services">Other Services</option>
                    </select>      
                    <label for="car-issue-description" placeholder=>Description:</label>
                    <textarea id="car-issue-description" name="car-issue-description" placeholder="Leave comment if you wanted to "></textarea>
                    <button type="submit" id="submit">Confirm</button>
                </form>
                <button class="back-details"onclick="backToDetails()">Back</button>
            </div>
        </div>
        

        <div class="payment-section" id="payment-section">
            <h1>Confirm Your Appointment</h1>
            <form method="post" action="appointment2.php">
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
            <h1>Congratulation!</h1>
            <p>Your Booking is completed!</p>
            <button id="done" name="booking-button" onclick="doneBooking()">OK</button>
        </div>
    </div>

    <script src="appointment.js"></script>
</body>

</html>
