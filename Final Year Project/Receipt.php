<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Receipt</title>
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
        }
        .header, .section, .footer {
            margin-bottom: 20px;
        }
        .header img  {
            max-width: 170px;
        }
        .section-title {
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-table th, .details-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .details-table th {
            background-color: #f0f0f0;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 300px;
            margin-top: 30px;

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
                width: 100%;
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

    
    </style>
</head>
<body>

<div class="container" id="receipt-content">
    <div class="header">
        <img src="Logo.png" alt="Service Center Logo">
        <h1>Carnow Sdn.Bhd</h1>
        <p>Address: PT 24337, Aman Kerayong Makmur, Mukim Triang, 28200 Bandar Bera, Pahang</p>
        <p>Phone: +603 3362 0398  | Email: Carnow@servicecenter.com | Website: Carnow.servicecenter.com</p>
    </div>

    
    <div class="section">
        <div class="section-title">Receipt Information</div>
        <p><strong>Receipt Number:</strong> 001234</p>
        <p><strong>Date of Service:</strong> June 6, 2024</p>
        <p><strong>Date of Issue:</strong> June 6, 2024</p>
    </div>

    <div class="section">
        <div class="section-title">Customer Information</div>
        <p><strong>Name:</strong> John Doe</p>
        <p><strong>Ic Number:</strong> 031211-04-0231</p>
        <p><strong>Phone:</strong> (123) 456-7890</p>
        <p><strong>Email:</strong> john.doe@example.com</p>
    
    </div>


    <div class="section">
        <div class="section-title">Vehicle Information</div>
        <p><strong>Make and Model:</strong> Toyota Camry</p>
        <p><strong>Year:</strong> 2020</p>
        <p><strong>Color:</strong>Black</p>
        <p><strong>Car Plate:</strong> ABC-1234</p>
    </div>

  
    <div class="section">
        <div class="section-title">Service Details</div>
        <table class="details-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Parts Cost</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Oil Change</td>
                    <td>$30.00</td>
                    <td>$70.00</td>
                </tr>
                <tr>
                    <td>Tire Rotation</td>
                    <td>$0.00</td>
                    <td>$20.00</td>
                </tr>
                <tr>
                    <td>Labor cost</td>
                    <td>RM0.00</td>
                    <td>RM50.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Cost Breakdown</div>
        <p><strong>Total Amount Due:</strong> $87.20</p>
        <p><strong>Amount Paid:</strong> $87.20</p>
        <p><strong>Payment Method:</strong> Paypal</p>
    </div>

    <div class="section">
        <div class="section-title">Notes and Disclaimers</div>
        <p>Thank you for your business! Please retain this receipt for your records.</p>
        <p>All services are subject to the terms and conditions provided at the time of service.</p>
    </div>

   
    <div class="section">
        <div class="section-title">Feedback and Contact Information</div>
        <p>We value your feedback! Please let us know how we did by visiting .</p>
        <p>If you have any follow-up questions or issues, please contact us at +603 3362 0398  or email us at Carnow@servicecenter.com.</p>
    </div>


    <div class="buttons" id="button-section">
        
        <a href="#" class="button" onclick="downloadPDF()">Download as PDF</a>
        <a href="dashboard.html" class="button">Back to Dashboard</a>
    </div>
</div>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Carnow";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
    b.date,
    c.car_plate,c.brand,c.model,c.color,c.year,
    i.item_name,i.cost,
    m.quantity_used
    p.payment_id,p.time,p.amount,p.payment_method
    u.username,u.email,u.contact_number,u.ic_number
FROM 
    booking b
JOIN 
    car c ON b.car_id = c.car_id
JOIN 
    inventory i ON c.inventory_id = i.inventory_id
JOIN 
    maintenance m ON c.car_id = m.car_id
JOIN 
    payment p ON b.payment_id = p.payment_id
JOIN 
    user u ON b.user_id = u.user_id";

    $result = $conn->query($sql);


if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $date = $row[' b.date'];
        $car_plate = $row[' c.car_plate']; 
        $brand = $row['c.brand'];
        $model = $row['c.model'];
        $color = $row['c.color'];
        $year = $row['c.year'];
        $item_name = $row['i.item_name'];
        $amount = $row['i.amount'];
        $payment_id = $row[' p.payment_id'];
        $time = $row['p.time'];
        $amount = $row['p.amount'];
        $username = $row[' u.username'];
        $email = $row['u.email'];
        $contact_number = $row['u.contact_number'];
        $ic_number = $row['u.ic_number'];
        $quantity = $row['m.quantity_used'];
        $payment_method = $ row ['p.payment_method']
       


        $sum = $cost * $quantity;



      
echo '<div class="container" id="receipt-content">';
echo '    <div class="header">';
echo '        <img src="Logo.png" alt="Service Center Logo">';
echo '        <h1>Carnow Sdn.Bhd</h1>';
echo '        <p>Address: PT 24337, Aman Kerayong Makmur, Mukim Triang, 28200 Bandar Bera, Pahang</p>';
echo '        <p>Phone: +603 3362 0398  | Email: Carnow@servicecenter.com | Website: Carnow.servicecenter.com</p>';
echo '    </div>';

echo '    <div class="section">';
echo '        <div class="section-title">Receipt Information</div>';
echo '        <p><strong>Receipt Number:</strong>'.$payment_id.' </p>';
echo '        <p><strong>Date of Service:</strong> '.$date.'</p>';
echo '        <p><strong>Date of Issue:</strong> '.$time.'</p>';
echo '    </div>';

echo '    <div class="section">';
echo '        <div class="section-title">Customer Information</div>';
echo '        <p><strong>Name:</strong>'.$username.'</p>';
echo '        <p><strong>Ic Number:</strong> '.$ic_number.'</p>';
echo '        <p><strong>Phone:</strong> '.$contact_number.'</p>';
echo '        <p><strong>Email:</strong>'.$email.'</p>';
echo '    </div>';

echo '    <div class="section">';
echo '        <div class="section-title">Vehicle Information</div>';
echo '        <p><strong>Make and Model:</strong> '.$brand.' '.$model.'</p>';
echo '        <p><strong>Year:</strong> '.$year.'</p>';
echo '        <p><strong>Color:</strong>'.$color.'</p>';
echo '        <p><strong>Car Plate:</strong> '.$car_plate.'</p>';
echo '    </div>';

echo '    <div class="section">';
echo '        <div class="section-title">Service Details</div>';
echo '        <table class="details-table">';
echo '            <thead>';
echo '                <tr>';
echo '                    <th>Description</th>';
echo '                    <th>Parts Cost</th>';
echo '                    <th>Total</th>';
echo '                </tr>';
echo '            </thead>';
echo '            <tbody>';
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
         echo '                <tr>';
         echo '                    <td>'.$item_name.'</td>';
         echo '                    <td>'.$cost.'</td>';
         echo '                    <td>'.$sum.'</td>';
         echo '                </tr>';
echo '            </tbody>';
echo '        </table>';
echo '    </div>';

echo '    <div class="section">';
echo '        <div class="section-title">Cost Breakdown</div>';
echo '        <p><strong>Total Amount Due:</strong> '.$amount.'</p>';
echo '        <p><strong>Amount Paid:</strong>'.$amount.'</p>';
echo '        <p><strong>Payment Method:</strong> '.$payment_method.'</p>';
echo '    </div>';

echo '    <div class="section">';
echo '        <div class="section-title">Notes and Disclaimers</div>';
echo '        <p>Thank you for your business! Please retain this receipt for your records.</p>';
echo '        <p>All services are subject to the terms and conditions provided at the time of service.</p>';
echo '    </div>';

echo '    <div class="section">';
echo '        <div class="section-title">Feedback and Contact Information</div>';
echo '        <p>We value your feedback! Please let us know how we did by visiting .</p>';
echo '        <p>If you have any follow-up questions or issues, please contact us at +603 3362 0398  or email us at Carnow@servicecenter.com.</p>';
echo '    </div>';

echo '    <div class="buttons" id="button-section">';
echo '        <a href="#" class="button" onclick="downloadPDF()">Download as PDF</a>';
echo '        <a href="Mainpage.html" class="button">Back to Dashboard</a>';
echo '    </div>';
echo '</div>';}

} else {
    echo "0 results";
}

$conn->close();

?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
     async function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const receiptContent = document.getElementById('receipt-content');
        const buttonSection = document.getElementById('button-section');

        buttonSection.style.display = 'none';

        // Use html2canvas to capture the receipt content as an image
        const canvas = await html2canvas(receiptContent);
        const imgData = canvas.toDataURL('image/png');

        // Create a new jsPDF instance
        const doc = new jsPDF('p', 'pt', 'a4');

        // Add the captured image to the PDF
        doc.addImage(imgData, 'PNG', 0, 0, doc.internal.pageSize.getWidth(), doc.internal.pageSize.getHeight());

        // Save the PDF
        doc.save('receipt.pdf');

        // Show the button section again
        buttonSection.style.display = 'flex';
    }
</script>

</body>
</html>
