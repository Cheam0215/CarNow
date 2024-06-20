<?php include("session.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Appointments</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles/my_booking.css" >
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/mainpage.css">
    <script src="scripts/header.js" defer></script>
    <script src="scripts/my_booking.js" defer></script>
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
                        <li><a href="book_appointment.php" id="serviceButton">Book a Service</a></li>
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


<?php

include ("connection.php");
$sql = "SELECT  m.maintenance_id, 
                b.booking_date,b.booking_id,b.service_type,b.booking_time,
                c.car_plate,c.brand,c.model,
                p.time,p.amount,p.payment_id,
                u.username FROM user u 
JOIN car c ON u.user_id = c.user_id
JOIN booking b ON c.car_plate = b.car_plate
JOIN maintenance m ON b.booking_id = m.booking_id
JOIN payment p ON u.user_id= p.user_id GROUP BY m.maintenance_id" ;

$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
   
    echo '<div id="myModal" class="modal">';
    echo '    <!-- Modal content -->';
    echo '    <div class="modal-content">';
    echo '        <span class="close" onclick="closeModal()">&times;</span>';
    echo '        <form action="submit_feedback.php" method="POST">';
    echo '            <p> Feedback</p>';
    echo '            <div class="divider"></div>';
    echo '            <label for="service-rating">Service Rating</label>';
    echo '            <select id="service-rating" name="service_rating">';
    echo '                <option value="Outstanding">Outstanding</option>';
    echo '                <option value="Good">Good</option>';
    echo '                <option value="Average">Average</option>';
    echo '                <option value="Poor">Poor</option>';
    echo '                <option value="Very Poor">Very Poor</option>';
    echo '            </select>';
    echo '            <label for="description">Description</label>';
    echo '            <textarea id="description" name="description" required></textarea>';
    echo '            <input type="hidden" id="maintenance_id" name="maintenance_id">';
    echo '            <input type="hidden" name="sessionID" value="' . $_SESSION['mySession'] . '">';
    echo '            <button type="submit" name="submit-feedback">Submit</button>';
    echo '        </form>';
    echo '    </div>';
    echo '</div>';
}
    
?>

<section>
  <ul class="tabs">
    <li>Previous Appointments</li>
    <li>Current Appointments</li>
    <li>Upcoming Appointments</li>
  </ul>
  <div class="container">
    <div class="content">
    <?php
    include ("connection.php");

    $sql = "SELECT  m.maintenance_id, 
      b.booking_date,b.booking_id,b.service_type,b.booking_time,
      c.car_plate,c.brand,c.model,
      p.time,p.amount,p.payment_id,
      u.user_id FROM user u 
      JOIN car c ON u.user_id = c.user_id
      JOIN booking b ON c.car_plate = b.car_plate
      JOIN maintenance m ON b.booking_id = m.booking_id
      JOIN payment p ON u.user_id= p.user_id 
      WHERE m.progress = 'Done' AND p.payment_status = 'PAID'
      GROUP BY m.maintenance_id";

    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $car_plate = $row['car_plate'];
        $brand = $row['brand'];
        $model = $row['model'];
        $amount = $row['amount'];
        $booking_id = $row['booking_id'];
        $service_type = $row['service_type'];
        $date = $row['booking_date'];
        $time = $row['booking_time'];
        $payment_id = $row['payment_id'];
        $maintenance_id = $row['maintenance_id'];
        //Previous Appointments

        echo '<div class="appointment">';
        echo '  <div class="car-info">';
        echo '    <b><p>' . $car_plate . '</p></b>';
        echo '    <div class="car-image">';
        echo '      <img src="images/car-icon.png" alt="Car">';
        echo '    </div>';
        echo '    <p><b>'.$brand.' '. $model . '</b></p>';
        echo '  </div>';
        echo '  <div class="service-info">';
        echo '    <p><b>Service Type: </b>' . $service_type . '</p>';
        echo '    <p><b>Service Date: </b>' . $date . '</p>';
        echo '    <p><b>Service Time: </b>' . $time . '</p>';
        echo '    <p><b>Amount Paid: </b>RM ' . $amount . '</p>';
        echo '  </div>';
        echo '  <div class="actions">';
        
        include ("connection.php");

        $sql = "SELECT * FROM feedback WHERE maintenance_id = '$maintenance_id'";
        $result = $con->query($sql);

        if ($result && $result->num_rows > 0) {
          echo '    <button class="buttons" onclick="openModal(' . $maintenance_id . ')">Feedback <span class="material-symbols-outlined">forum</span></button>';
        }
        
        echo '    <button  onclick="window.location.href=\'Receipt(DONE).php?main_id=' . $maintenance_id . '\'" class="buttons">Receipt<span class="material-symbols-outlined">
receipt
</span></button>';
        echo '  </div>';
        echo '</div>';
      }
    } else {
      echo '<div class="appointment">';
      echo '<p>No previous appointments found.</p>';
      echo '</div>';
    }
    ?>
    </div>
<!-- current appointments -->
    <div class="content">
    <?php
    include ("connection.php");

    $sql = "SELECT  m.maintenance_id, m.progress,
      b.booking_date,b.booking_id,b.service_type,b.booking_time,
      c.car_plate,c.brand,c.model,
      p.payment_status,
      u.user_id FROM user u 
    JOIN car c ON u.user_id = c.user_id
    JOIN payment p ON u.user_id= p.user_id
    JOIN booking b ON c.car_plate = b.car_plate
    JOIN maintenance m ON b.booking_id = m.booking_id
    
    WHERE m.progress = 'In Service' OR (m.progress = 'Done' AND payment_status = 'UNPAID')
    GROUP BY m.maintenance_id";

    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $car_plate = $row['car_plate'];
        $brand = $row['brand'];
        $model = $row['model'];
        $progress = $row['progress'];
        $booking_id = $row['booking_id'];
        $service_type = $row['service_type'];
        $date = $row['booking_date'];
        $time = $row['booking_time'];
        
        $maintenance_id = $row['maintenance_id'];

        echo '<div class="appointment">';
        echo '  <div class="car-info">';
        echo '    <p>' . $car_plate . '</p>';
        echo '    <div class="car-image">';
        echo '      <img src="images/car-icon.png" alt="Car">';
        echo '    </div>';
        echo '    <p>'.$brand.' '. $model . '</p>';
        echo '  </div>';
        echo '  <div class="service-info">';
        echo '    <p><b>Service Type: </b>' . $service_type . '</p>';
        echo '    <p><b>Service Date: </b>' . $date . '</p>';
        echo '    <p><b>Service Time: </b>' . $time . '</p>';
        
        if ($progress == 'Done') {
            echo '    <button onclick="window.location.href=\'payment_page.php?maintenance_id=' . $maintenance_id . '&user_id=' . $_SESSION['mySession'] . '\'" class="buttons">Pay<span class="material-symbols-outlined">
payments
</span></button>';
        }
        echo '  </div>';
        echo '</div>';
      }
    } else {
      echo '<div class="appointment">';
      echo '<p>No current appointments found.</p>';
      echo '</div>';
    }
    ?>
    </div>

    <div class="content">
    <?php
    include ("connection.php");

    $sql = "SELECT  
          b.booking_date,b.booking_id,b.service_type,b.booking_time,
          c.car_plate,c.brand,c.model,
          u.user_id 
        FROM user u 
        JOIN car c ON u.user_id = c.user_id
        JOIN booking b ON c.car_plate = b.car_plate
        WHERE b.booking_confirmation = 'Confirmed'";
    

    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $car_plate = $row['car_plate'];
        $brand = $row['brand'];
        $model = $row['model'];
        $booking_id = $row['booking_id'];
        $service_type = $row['service_type'];
        $date = $row['booking_date'];
        $time = $row['booking_time'];


        echo '<div class="appointment">';
        echo '  <div class="car-info">';
        echo '    <p>' . $car_plate . '</p>';
        echo '    <div class="car-image">';
        echo '      <img src="images/car-icon.png" alt="Car">';
        echo '    </div>';
        echo '    <p>'.$brand.' '. $model . '</p>';
        echo '  </div>';
        echo '  <div class="service-info">';
        echo '    <p><b>Service Type: </b>' . $service_type . '</p>';
        echo '    <p><b>Service Date: </b>' . $date . '</p>';
        echo '    <p><b>Service Time: </b>' . $time . '</p>';
        echo '  </div>';
        echo '  <div class="actions">';
        echo '    <button onclick="if(confirm(\'Are you sure you want to cancel this appointment?\')){window.location.href=\'delete_booking.php?booking_id=' . $booking_id . '\'}" class="buttons">Cancel<span class="material-symbols-outlined">
delete
</span></button>';

        echo '  </div>';
        echo '</div>';
      }
    } else {
      echo '<div class="appointment">';
      echo '<p>No upcoming appointments found.</p>';
      echo '</div>';
    }
    ?>
    </div>
  </div>
</section>
      
<script>

function openModal(maintenanceId) {
    var modal = document.getElementById('myModal');
    modal.classList.add('show');
    document.getElementById('maintenance_id').value = maintenanceId;
}

function closeModal() {
    var modal = document.getElementById('myModal');
    modal.classList.remove('show');
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName('close')[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    closeModal();
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        closeModal();
    }
}


     
        
</script>

</body>
</html>

    


