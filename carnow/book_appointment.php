<?php include("session.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="styles/mainpage.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/book_appointment.css">
    
    <script src="scripts/book_appointment.js" defer></script>
    <script src="scripts/header.js" defer></script>

    <?php
    include("connection.php");

    if (isset($_POST['submit-button'])) {

        $car_plate = $_POST['hidden-carPlate'];
        $time = $_POST['hidden-appointmentTime'];
        $date = $_POST['hidden-appointmentDate'];
        $service_type = $_POST['hidden-car-issue'];
        $booking_confirmation = "Pending";
        $car_description = $_POST['hidden-description'];

        $check_booking_query = "SELECT * FROM booking WHERE booking_date = '$date' AND booking_time = '$time'";
        $check_booking_query_run = mysqli_query($con, $check_booking_query);

        if(mysqli_num_rows($check_booking_query_run) > 0) {
            echo '<script type="text/javascript"> alert("Your chosen booking time is already reserved! Please select another timeslot!") </script>';
        } else{
            $query = "INSERT INTO booking (car_plate, service_type, booking_date, booking_time, booking_confirmation, booking_description) 
            VALUES ('$car_plate', '$service_type', '$date', '$time', '$booking_confirmation', '$car_description')";
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
    <header class="main">
        <div class="navbar">
            <div class="icon">
                <a href="mainpage.php">
                    <img src="logo_image/logo-white.png" alt="Logo" class="logo">
                </a>
            </div>
            <div class="menu">
                <nav class="navigation">
                    <ul>
                        <li><a href="mainpage.php">Home</a></li>
                        <li><a href="mainpage.php#about-us">About us</a></li>
                        <li><a href="#" id="serviceButton">Book a Service</a></li>
                        <li><a href="my_booking.php">My Bookings</a></li>
                        <?php if(isset($_SESSION['mySession'])): 
                            include("connection.php");
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
                            <li>
                                <div class="profile-menu">
                                    <button onclick="myFunction()" class="dropbtn"><?php echo htmlspecialchars(explode(' ', $username)[0]); ?>
                                        <span class="material-symbols-outlined">account_circle</span>
                                        <span class="material-symbols-outlined">keyboard_arrow_down</span>
                                    </button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="my_profile.php">My Profile</a>
                                        <a href="logout.php">Logout</a>
                                    </div>
                                </div>
                            </li>
                        <?php else: ?>
                            <li><button onclick="window.location.href='login.php'" class="login-button">Login</button></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="content">
        
        <div class="booking-form">
        <ul id="ul-booking">
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
                    <label for="carPlate">Car : </label>
                    <?php
                    $sessionID = $_SESSION['mySession'];
                    $query = "SELECT car_plate FROM car WHERE user_id = '$sessionID'";
                    $result = mysqli_query($con, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                      echo '<select id="carPlate" name="carPlate" required>';
                      echo '<option value="">Select Car Plate</option>';
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['car_plate'] . '">' . $row['car_plate'] . '</option>';
                      }
                      echo '</select>';
                    } else {
                        echo '<script>alert("Please register a car before booking an appointment!");window.location.href="my_profile.php"</script>';
                    }
                    ?>
                    
                    <label for="appointmentDate">Appointment Date : </label>
                    <input type="date" id="appointmentDate" name="appointmentDate" min="<?php echo date('Y-m-d'); ?>" required>
                    <label for="appointmentTime">Appointment Time : </label>
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
                    <textarea id="car-issue-description" name="car-issue-description" placeholder="Leave remarks "></textarea>
                    <button type="submit" id="submit">Confirm</button>
                </form>
                <button class="back-details"onclick="backToDetails()">Back</button>
            </div>
        </div>
        

        <div class="payment-section" id="payment-section">
            <h1>Confirm Your Appointment</h1>
            <form method="post" action="book_appointment.php">
                <div class="invoice">
                    <p><b>Type of Service : </b><span id="car-issue-done"></span></p>
                    <input type="hidden" name="hidden-car-issue" id="hidden-car-issue">
                    <p><b>Car Plate : </b><span id="car-plate"></span></p>
                    <input type="hidden" name="hidden-carPlate" id="hidden-carPlate">
                    <p><b>Appointment Date : </b><span id="appointment-date"></span></p>
                    <input type="hidden" name="hidden-appointmentDate" id="hidden-appointmentDate">
                    <p><b>Appointment Time : </b><span id="appointment-time"></span></p>
                    <input type="hidden" name="hidden-appointmentTime" id="hidden-appointmentTime">
                    <p><b>Service Description : </b><span id="description"></span></p>
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
        
    </div>
    <footer class="bottom">
        <h5 class="bottom-text">
            Car Monitoring And Service (Car Now), Inc. is a 501(c)(3) organisation registered in Malaysia. (Tax ID #06-0726487)
        </h5>
    </footer>
</body>
</html>
