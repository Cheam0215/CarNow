<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Receipt</title>
    <link rel="stylesheet" href="styles/my_receipt.css">
    
</head>
<body>
    <?php

    include ("connection.php");
    if (isset($_GET['main_id'])) {
        $id = $_GET['main_id'];

       
    $sql = "SELECT  m.maintenance_id, m.item_id, m.quantity_used, m.booking_id,
                    b.booking_date, b.booking_time, b.car_plate, 
                    c.brand, c.model, c.color, c.year,
                    p.amount, p.payment_id, p.payment_method,
                    i.item_name, i.cost,
                    u.username, u.email, u.contact_number, u.ic_number
                    FROM maintenance m
                    INNER JOIN booking b ON m.booking_id = b.booking_id
                    INNER JOIN car c ON b.car_plate = c.car_plate
                    INNER JOIN inventory i ON m.item_id = i.item_id
                    INNER JOIN payment p ON m.maintenance_id = p.maintenance_id
                    INNER JOIN user u ON c.user_id = u.user_id
                    WHERE  m.maintenance_id = '$id'";


    $result = $con->query($sql);




    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();{

        $date = $row['booking_date'];
        $car_plate = $row['car_plate']; 
        $brand = $row['brand'];
        $model = $row['model'];
        $color = $row['color'];
        $year = $row['year'];
        $item_name = $row['item_name'];
        $amount = $row['amount'];
        $payment_id = $row['payment_id'];
        $time = $row['booking_time'];
        $username = $row['username'];
        $email = $row['email'];
        $contact_number = $row['contact_number'];
        $ic_number = $row['ic_number'];
        $quantity = $row['quantity_used'];
        $payment_method = $row ['payment_method'];

       


    echo '<div class="container" id="receipt-content">';
        echo '<div class="header">';
        echo '    <img src="logo_image/carnowLogo.png" alt="Service Center Logo">';
        echo '    <h1>Carnow Sdn.Bhd</h1>';
        echo '    <p>Address: PT 24337, Aman Kerayong Makmur, Mukim Triang, 28200 Bandar Bera, Pahang</p>';
        echo '    <p>Phone: +603 3362 0398  | Email: Carnow@servicecenter.com | Website: Carnow.servicecenter.com</p>';
        echo '</div>';

        echo '<div class="section">';
        echo '    <div class="section-title">Receipt Information</div>';
        echo '    <p><strong>Receipt Number:</strong> '.$payment_id.'</p>';
        echo '    <p><strong>Date of Service:</strong> '.$date.'</p>';
        echo '    <p><strong>Date of Issue:</strong> '.$time.'</p>';
        echo '</div>';

        echo '<div class="section">';
        echo '    <div class="section-title">Customer Information</div>';
        echo '    <p><strong>Name:</strong> '.$username.'</p>';
        echo '    <p><strong>IC Number:</strong> '.$ic_number.'</p>';
        echo '    <p><strong>Phone:</strong> '.$contact_number.'</p>';
        echo '    <p><strong>Email:</strong> '.$email.'</p>';
        echo '</div>';

        echo '<div class="section">';
        echo '    <div class="section-title">Vehicle Information</div>';
        echo '    <p><strong>Make and Model:</strong> '.$brand.' '.$model.'</p>';
        echo '    <p><strong>Year:</strong> '.$year.'</p>';
        echo '    <p><strong>Color:</strong> '.$color.'</p>';
        echo '    <p><strong>Car Plate:</strong> '.$car_plate.'</p>';
        echo '</div>';

        echo '<div class="section">';
        echo '    <div class="section-title">Service Details</div>';
        echo '    <table class="details-table">';
        echo '        <thead>';
        echo '            <tr>';
        echo '                <th>Description</th>';
        echo '                <th>Parts Cost</th>';
        echo '                <th>Total</th>';
        echo '            </tr>';
        echo '        </thead>';
        echo '        <tbody>';

        $result->data_seek(0); 
        while ($row = $result->fetch_assoc()) {
            $item_name = $row['item_name'];
            $quantity = $row['quantity_used'];
            $cost = $row['cost'];
            $total = $cost * $quantity;

            echo '            <tr>';
            echo '                <td>'.$item_name.'</td>';
            echo '                <td>'.$cost.'</td>';
            echo '                <td>'.$total.'</td>';
            echo '            </tr>';
        }

        echo '        </tbody>';
        echo '    </table>';
        echo '</div>';

        echo '<div class="section">';
        echo '    <div class="section-title">Cost Breakdown</div>';
        echo '    <p><strong>Total Amount Due:</strong> '.$amount.'</p>';
        echo '    <p><strong>Amount Paid:</strong> '.$amount.'</p>';
        echo '    <p><strong>Payment Method:</strong> '.$payment_method.'</p>';
        echo '</div>';

        echo '<div class="section">';
        echo '    <div class="section-title">Notes and Disclaimers</div>';
        echo '    <p>Thank you for your business! Please retain this receipt for your records.</p>';
        echo '    <p>All services are subject to the terms and conditions provided at the time of service.</p>';
        echo '</div>';

        echo '<div class="section">';
        echo '    <div class="section-title">Feedback and Contact Information</div>';
        echo '    <p>We value your feedback! Please let us know how we did by visiting .</p>';
        echo '    <p>If you have any follow-up questions or issues, please contact us at +603 3362 0398 or email us at Carnow@servicecenter.com.</p>';
        echo '</div>';

        echo '<div class="buttons" id="button-section">';
        echo '    <a href="#" class="button" onclick="downloadPDF()">Download as PDF</a>'; 
        echo '    <a href="my_booking.php" class="button">Back to Dashboard</a>';
        echo '</div>';
    echo    '</div>';}
    }


    }
    
        
        
     else {
        echo "0 results";
    }

    $con->close();
        ?>
   


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
    async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const receiptContent = document.getElementById('receipt-content');
    const buttonSection = document.getElementById('button-section');

    buttonSection.style.display = 'none';


    const canvas = await html2canvas(receiptContent);
    const imgData = canvas.toDataURL('image/png');


    const doc = new jsPDF('p', 'pt', 'a4');


    doc.addImage(imgData, 'PNG', 0, 0, doc.internal.pageSize.getWidth(), doc.internal.pageSize.getHeight());


    doc.save('receipt.pdf');


    buttonSection.style.display = 'flex';
    }
    </script>

</body>
</html>
