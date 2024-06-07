<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles/payment.css">
  <script src="scripts/payment.js" defer></script>
</head>
<body>
<h1 >Service Summary</h1>
<div class="container">

<table >
    <thead>
        <tr>
            <th>Item ID</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price (MYR)</th>
        </tr>
    </thead>
    <tbody>
    <?php

    
        include("connection.php");
        $sql = "SELECT maintenance.item_id, maintenance.quantity_used, inventory.item_name, inventory.cost,inventory.item_image
                FROM maintenance
                INNER JOIN inventory ON maintenance.item_id = inventory.item_id
                WHERE maintenance.maintenance_id = 1
                ORDER BY inventory.cost ";

        $subtotal = 0;
        
        $result = mysqli_query($con, $sql);
        

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $item_total = $row["cost"] * $row["quantity_used"]; 
            $labourFee = 50;
            $subtotal += $item_total;
            $total = $subtotal + $labourFee; 
              echo "<tr>
                      <td>I00" . $row["item_id"] . "</td>
                      <td class='images'><img class='item-image' src='item_image/" . $row["item_image"] . "' alt='" . $row["item_name"] . "'> " . $row["item_name"] . "</td>
                      <td> " . $row['quantity_used'] . ".00</td>
                      <td>" .$item_total. ".00</td>
                    </tr>";
          }
      } else {  
          echo '<h1 style="text-align:center;">Your service did not cost a dime!(</h1><br>';
      }
    ?>

        
    </tbody>
</table>

<div class="payment-container">
        <h2>PAYMENT SUMMARY</h2>
        <hr>

        <div class="payment-info">
            <div class="payment-info-row">
                <span>Subtotal</span>
                <span>MYR <?php echo $subtotal;?>.00</span>
            </div>
            <div class="payment-info-row">
                <span>Labor Fee</span>
                <span>MYR <?php echo $labourFee?>.00</span>
            </div>
            <div class="payment-info-row">
                <span>Total</span>
                <span>MYR <?php echo $total?>.00</span>
            </div>

        </div>
        <div class="payment-methods">
            <button  class="paypal-button">Pay with <b class="pay">Pay</b><b class="pal">Pal</b></button>
            <button class="tng-button">Pay with <img src = "logo_image/tnglogo.png"></button>
        </div>
        



</div>

</div>

<div class="loading">
    <div class="loader"></div>
</div>

<form action="paymentInsert.php" method="post">
    <div id="paypal-gateway">
        <div class="close-button">
            <i id="close" class="fa fa-close" style="font-size:24px"></i>
        </div>
        <div class="logopaypal">
            <img src="logo_image/paypal_logo.png" alt="PayPal">
        </div>

        <div class="payment-info">
            <div class="payment-info-row">
                <span>Subtotal</span>
                <span>MYR <?php echo $subtotal; ?>.00</span>
            </div>
            <div class="payment-info-row">
                <span>Labour Fee</span>
                <span>MYR <?php echo $labourFee; ?>.00</span>
            </div>
            <div class="payment-info-row">
                <span>Total</span>
                <span>MYR <?php echo $total; ?>.00</span>
                <input type="hidden" name="total" value="<?php echo $total; ?>">
            </div>
        </div>
        <button type="submit" name="payment_button" class="paypal-button">Pay Now</button>
    </div>
</form>

<form action="paymentInsert.php" method="post">
    <div id="tng-gateway">
        <div class="close-button">
            <i id="close" class="fa fa-close" style="font-size:24px"></i>
        </div>
        
        <div class="logotng">
            <img src="logo_image/tnglogo.png" alt="Touch 'n Go">
        </div>

        <div class="payment-info">
            <div class="payment-info-row">
                <span>Subtotal</span>
                <span>MYR <?php echo $subtotal; ?>.00</span>
            </div>
            <div class="payment-info-row">
                <span>labourFee</span>
                <span>MYR <?php echo $labourFee; ?>.00</span>
            </div>
            <div class="payment-info-row">
                <span>Total</span>
                <span>MYR <?php echo $total; ?>.00</span>
                <input type="hidden" name="total" value="<?php echo $total; ?>">
            </div>
        </div>
        <button type="submit" name="payment_button" class="tng-button">Approve</button>
    </div>
</form>


</body>
</html>