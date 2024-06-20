<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height:auto;
        }
        .header, .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .search-bar, .filters {
            margin-bottom: 20px;
        }
        .appointment-list {
            width: 100%;
            border-collapse: collapse;
        }
        .appointment-list th, .appointment-list td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .appointment-list th {
            background-color: #f0f0f0;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .button:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
            .buttons {
                flex-direction: column;
                align-items: center;
            }
            .button {
                margin-bottom: 10px;
                width: 100%;
                text-align: center;
            }
        }

        .Title{
        display: flex;
        height:50px;
        border-bottom: 2px solid black;
    
        padding-bottom: 0px;
    }

    .Car-name{
        position:absolute;
        margin-left: 35px;
        color: rgb(0, 1, 2);
        margin-top: 6px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-weight: lighter;
        font-size: 40px;
        text-shadow: 0 0 10px silver;
        margin-bottom: 0;
        opacity: 0.7; 

    }

    .Car-amount{
        position:absolute;
        margin-left: 810px;
        color: rgb(0, 0, 0);
        margin-top: 13px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-weight:lighter;
        font-size: 30px;
        text-shadow: 0 0 10px silver;
        margin-bottom: 0;
        opacity: 0.7; 

    }
    
    .Bookingfor{
        margin-top: 32px;
        margin-bottom: 0;
        margin-left: 15px;
    }

   
    .Status{
        margin-top: 6px;
        border: 2px solid black;
        background-color: green;
        padding-top: 12px;
        padding-left: 45px;
        padding-right: 0px;
        width: 110px;
        height: 30px;
        margin-left: 800px;
        border-radius: 100px;
       

    }

    .bookingpreviouscontainer{
        border: 2px solid black;
        width:auto;
        height: 180px;
        border-radius: 20px;
        margin-top: 20px;
    }
  
        .container {
            max-width: 1200px;
            margin: auto;
        }
        .btn-open-modal {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-open-modal:hover {
            background-color: #45a049;
        }
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }
        .modal.show {
            display: block; /* Show the modal */
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .divider {
            width: 100%;
            height: 1px;
            background-color: #ccc;
            margin: 20px 0;
        }
        .checkbox-container {
            display: flex;
            align-items: center;
        }
        .checkbox {
            margin-right: 10px;
        }
        .custom-checkbox {
            font-weight: bold;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        select, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            resize: none; 
        }

        .button1 {
  cursor: pointer;
  font-size: 10px;
  border-radius: 16px;
  border: none;
  padding: 2px;
  background: radial-gradient(circle 80px at 80% -10%, #ffffff, #181b1b);
  position: relative;
  z-index:0;
  margin-left:13px;
}
.button1::after {
  content: "";
  position: absolute;
  width: 40%;
  height: 50%;
  border-radius: 120px;
  top: 0;
  right: 0;
  box-shadow: 0 0 20px #ffffff38;
  z-index: -1;
}

.blob1 {
  position: absolute;
  width: 70px;
  height: 100%;
  border-radius: 16px;
  bottom: 0;
  left: 0;
  background: radial-gradient(
    circle 60px at 0% 100%,
    #3fe9ff,
    #0000ff80,
    transparent
  );
  box-shadow: -10px 10px 30px #0051ff2d;
}

.inner {
  padding: 10px 16px;
  border-radius: 14px;
  color: #fff;
  z-index: 3;
  position: relative;
  background: radial-gradient(circle 80px at 80% -50%, #777777, #0f1111);
}
.inner::before {
  content: "";
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  border-radius: 14px;
  background: radial-gradient(
    circle 60px at 0% 100%,
    #00e1ff1a,
    #0000ff11,
    transparent
  );
  position: absolute;
}

.section{
    position: relative;
}

.button_bar{
    position: absolute;
    margin-top: 80px;
    margin-left: 910px;
   
}
.Infor{
    position: absolute;
    margin-left: 350px;
    font-size: 17px;
    opacity: 0.5; 

}
.Infor-1{
    position: absolute;
    margin-left: 610px;
    font-size: 17px;
    opacity: 0.5; 
        
}
.pic{
    position: absolute;
    width: 295px;
    height: 110px;
    border: 2px solid black;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    margin-top: 7px;
    margin-left: 20px;
   
}
.img{display: block;}

.section{
    height: auto;
}

    

    </style>
    
</head>
<body>
<?php

include('connection.php');

$sql = "SELECT p.amount, p.payment_method, b.booking_id, b.booking_date, b.booking_time, b.service_type, c.car_plate, c.brand, c.model
        FROM payment p
        INNER JOIN maintenance m ON p.maintenance_id = m.maintenance_id
        INNER JOIN booking b ON b.booking_id = m.booking_id
        INNER JOIN car c ON c.car_plate = b.car_plate
        GROUP BY c.car_plate

            ";

$result = mysqli_query($con, $sql);

if ($result && $result->num_rows > 0) {
    echo '<!-- The Modal -->';
    echo '<div id="myModal" class="modal">';
    echo '    <!-- Modal content -->';
    echo '    <div class="modal-content">';
    echo '        <span class="close">&times;</span>';
    echo '        <p>Feedback</p>';
    echo '        <div class="divider"></div>';
    echo '        <label for="service-rating">Service Rating</label>';
    echo '        <select id="service-rating">';
    echo '            <option value="outstanding">Outstanding</option>';
    echo '            <option value="good">Good</option>';
    echo '            <option value="average">Average</option>';
    echo '            <option value="poor">Poor</option>';
    echo '        </select>';
    echo '        <label for="description">Description</label>';
    echo '        <textarea id="description" rows="4" required></textarea>';
    echo '        <button type="submit" onclick="submitFeedback()">Submit</button>';
    echo '    </div>';
    echo '</div>';

    echo '<div class="container">';
    echo '    <!-- Header Section -->';
    echo '    <div class="header">';
    echo '        <h1>Previous Appointments</h1>';
    echo '    </div>';

    echo '    <!-- Search and Filter Section -->';
    echo '    <div class="section search-bar">';
    echo '        <input type="text" id="search" placeholder="Search appointments...">';
    echo '    </div>';

    echo '    <!-- Appointment List Section -->';
    echo '    <div class="section">';
    echo '        <div class="section-title">Appointment List</div>';
    echo '        <div class="bookingpreviouscontainer">';

    $result->data_seek(0); 
    while ($row = $result->fetch_assoc()) {
        echo '            <div class="Booking-status">';
        echo '                <div class="Title">';
        echo '                    <p class="Car-name">'.$row['brand'].' '.$row['model'].'</p>';
        echo '                    <p class="Car-amount"> Paid Amount:'.$row['amount'].', '.$row['payment_method'].'</p>';
        echo '                </div>';
        echo '                <div class="button_bar">';
        echo '                    <button onclick="window.location.href=\'Receipt(DONE).php\'" class="button1">';
        echo '                        <div class="blob1"></div>';
        echo '                        <div class="blob2"></div>';
        echo '                        <div class="inner">Receipt</div>';
        echo '                    </button>';
        echo '                    <button class="button1 btn-open-modal" onclick="openModal()">';
        echo '                        <div class="blob1"></div>';
        echo '                        <div class="blob2"></div>';
        echo '                        <div class="inner">Give Feedback</div>';
        echo '                    </button>';
        echo '                </div>';
        echo '                <div class="pic"><img src="Car.jpeg" alt="Car Image"></div>';
        echo '                <div class="Infor">';
        echo '                    <p>Booking ID: '.$row['booking_id'].'</p>';
        echo '                    <p>Car Plate: '.$row['car_plate'].'</p>';
        echo '                    <p>Service type: '.$row['service_type'].'</p>';
        echo '                </div>';  
        echo '                <div class="Infor-1">';
        echo '                    <p>Service date: '.$row['booking_date'].'</p>';
        echo '                    <p>Service time: '.$row['booking_time'].'</p>';
        echo '                </div>';
        echo '            </div>';
    }

    echo '        </div>';
    echo '    </div>';
    echo '</div>';
} else {
    echo "0 results";
}

mysqli_close($con);
?>


<script>
      function openModal() {
            var modal = document.getElementById("myModal");
            modal.classList.add("show");
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.classList.remove("show");
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            closeModal();
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                closeModal();
            }
        }

        // Function to handle feedback form submission
        function submitFeedback() {
            var serviceRating = document.getElementById("service-rating").value;
            var description = document.getElementById("description").value;
            var revealIdentity = document.getElementById("reveal-identity").checked;

            if (!serviceRating) {
                alert("Please select a service rating.");
                return;
            }
            if (!description) {
                alert("Please enter a description.");
                return;
            }

            // Handle form submission logic here (e.g., send data to the server)
            console.log({
                serviceRating: serviceRating,
                description: description,
                revealIdentity: revealIdentity
            });

            // Close the modal after submission
            closeModal();
        }
</script>

</body>
</html>

    


