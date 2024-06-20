<?php include ('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/admin_page.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="scripts/dashboard.js" defer></script>
    <title>Admin Webpage</title>
</head>
<body>
<?php
        include("connection.php");
        $query = "SELECT SUM(amount) AS gross
        FROM payment";

        $result= mysqli_query($con, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalRevenue = $row['gross'];
            $totalProfit = $totalRevenue * 0.25;

            if ($totalProfit !== null) {
                $totalProfit = "$" . number_format($totalProfit, 2);
            } else {
                $totalProfit = "$" . number_format(0, 2);
            }

            if ($totalRevenue !== null) {
                $totalRevenue = "$" . number_format($totalRevenue, 2);
            } else {
                $totalRevenue = "$" . number_format(0, 2);
            }


        } else {

            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); 
        }

        $query3 = "SELECT SUM(cost) AS total_cost from inventory;";
        $result3= mysqli_query($con, $query3);

        if ($result3) {
            $row = mysqli_fetch_assoc($result3);
            $totalCost = $row['total_cost'];
    

            if ($totalCost !== null) {
                $totalCost = "$" . number_format($totalCost, 2);
            } else {
                $totalCost = "$" . number_format(0, 2);
            }
        } else {

            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); 
        }


        $query4 = "SELECT COUNT(payment_id) AS total_of_sales from payment;";
        $result4= mysqli_query($con, $query4);

        if ($result4) {
            // Fetch the total donation amount
            $row = mysqli_fetch_assoc($result4);
            $totalSales = $row['total_of_sales'];
    
            // Display the total donation amount
            if ($totalSales !== null) {
                $totalSales = number_format($totalSales, 0);
            } else {
                $totalSales = "$" . number_format(0, 2);
            }
        } else {
            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); 
        }


        $query5 = "SELECT user_image ,username from user where role = 'admin';";
        $result5= mysqli_query($con, $query5);

        if ($result5) {
            $row = mysqli_fetch_assoc($result5);
            $profilePic = $row['user_image'];
            $username = $row['username'];
        } else {
            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); 
        }



    ?>
    
    <div class="container">

        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="logo_image/carnowLogo.png" alt="Logo">
                    <h2>Car<span class="now">Now</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="admin_page.php" class="active">
                    <span class="material-symbols-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="admin_page.php">
                    <span class="material-symbols-sharp">
                        summarize
                    </span>
                    <h3>Report</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-sharp">
                        person_outline
                    </span>
                    <h3>User</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-sharp">
                        badge
                    </span>
                    <h3>Staff</h3>
                </a>
                <a href="admin_inventory.php">
                    <span class="material-symbols-sharp">
                    inventory_2
                    </span>
                    <h3>Inventory</h3>
                </a>
                <a href="admin_feedback.php">
                    <span class="material-symbols-sharp">
                    chat
                    </span>
                    <h3>Feedback</h3>
                </a>
                
                <a href="logout.php">
                    <span class="material-symbols-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
                
            </div>

        </aside>

        <main class="content">
                <div class="header">
                    <div class="left">
                        <h1>Dashboard</h1>

                    </div>
                </div>

            <div class="insights">
                <div class="data data-1">
                    <span class="material-symbols-sharp">
                        calendar_today
                    </span>
                    <span class="info">
                        <h3><?php echo $totalSales?></h3>
                        <p>Number of Sales</p>
                    </span>
                </div>

                <div class="data data-2">
                    <span class="material-symbols-sharp">
                        monitoring
                    </span>
                    <span class="info">
                        <h3><?php echo $totalRevenue ?></h3>
                        <p>Revenue</p>
                    </span>
                </div>

                <div class="data data-3">
                    <span class="material-symbols-sharp">
                        paid
                    </span>
                    <span class="info">
                        <h3><?php echo $totalProfit ?></h3>
                        <p>Profit</p>
                    </span>
                </div>

                <div class="data data-4">
                    <span class="material-symbols-sharp">
                        attach_money
                    </span>
                    <span class="info">
                        <h3><?php echo $totalCost?></h3>
                        <p>Cost</p>
                    </span>
                </div>
                    
            </div>

            <div class="chart">
                <h2>Revenue Chart</h2>
                <canvas id="chart"></canvas>
            </div>

            <div class="recent-orders">
                <h2>Recent Payments</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>User Name</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include("connection.php");

                            $query2 = "SELECT payment_id, username, time, amount, payment_method, payment_status FROM payment 
                            JOIN user ON payment.user_id = user.user_id

                            ORDER BY time DESC LIMIT 10;";
                            $result2 = mysqli_query($con, $query2);

                            if ($result2) {
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['payment_id'] . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['amount'] . "</td>";
                                    echo "<td>" . $row['payment_method'] . "</td>";
                                    echo "<td>" . $row['time'] . "</td>";
                                    echo "<td>" . $row['payment_status'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<h1>No Record Thus Far</h1>";
                                echo "Error: " . mysqli_error($con); 
                            }
                        ?>
                    </tbody>
                </table>
            </div>


                                    
        </main>



        <div class="right-section">
            <div class="nav">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo $username ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="user_image/<?php echo $profilePic?>">
                    </div>
                </div>
            </div>
        </div>

      
    </div>


</body>
</html>