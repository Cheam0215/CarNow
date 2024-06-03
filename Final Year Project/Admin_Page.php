<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Adminpage.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <title>Admin Webpage</title>
</head>
<body>
    <?php
        include("connection.php");
        $query = "SELECT SUM(m.price - i.cost) AS total_profit
        FROM maintenance m
        JOIN inventory i ON m.item_id = i.item_id
        WHERE m.item_id = i.item_id;";
        $result= mysqli_query($con, $query);

        if ($result ) {
            // Fetch the total donation amount
            $row = mysqli_fetch_assoc($result);
            $totalProfit = $row['total_profit'];
    
            // Display the total donation amount
            if ($totalProfit !== null) {
                $totalProfit = "$" . number_format($totalProfit, 2);
            } else {
                $totalProfit = "$" . number_format(0, 2);
            }
        } else {
            // Display donation as $0 if the table is empty
            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); // Add this line for debugging
        }

        $query2 = "SELECT SUM(price) AS total_revenue from maintenance;";
        $result2= mysqli_query($con, $query2);

        if ($result2) {
            // Fetch the total donation amount
            $row = mysqli_fetch_assoc($result2);
            $totalRevenue = $row['total_revenue'];
    
            // Display the total donation amount
            if ($totalRevenue !== null) {
                $totalRevenue = "$" . number_format($totalRevenue, 2);
            } else {
                $totalRevenue = "$" . number_format(0, 2);
            }
        } else {
            // Display donation as $0 if the table is empty
            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); // Add this line for debugging
        }

        $query3 = "SELECT SUM(cost) AS total_cost from inventory;";
        $result3= mysqli_query($con, $query3);

        if ($result3) {
            // Fetch the total donation amount
            $row = mysqli_fetch_assoc($result3);
            $totalCost = $row['total_cost'];
    
            // Display the total donation amount
            if ($totalCost !== null) {
                $totalCost = "$" . number_format($totalCost, 2);
            } else {
                $totalCost = "$" . number_format(0, 2);
            }
        } else {
            // Display donation as $0 if the table is empty
            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); // Add this line for debugging
        }


        $query4 = "SELECT COUNT(maintenance_id) AS total_of_sales from maintenance;";
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
            // Display donation as $0 if the table is empty
            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); // Add this line for debugging
        }



    ?>
    
    <div class="container">

        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="Pic/Logo.jpg" alt="Logo">
                    <h2>Car<span class="now">Now</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="Admin_Page.html" class="active">
                    <span class="material-symbols-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#">
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
                <a href="#">
                    <span class="material-symbols-sharp">
                    inventory_2
                    </span>
                    <h3>Inventory</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-sharp">
                    chat
                    </span>
                    <h3>Feedback</h3>
                </a>
                
                <a href="#">
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
                        <div class="breadcrumb">
                            <div>
                                <a href="#">Analytics</a>
                            </div>
                        </div>
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
                                    
        </main>



        <div class="right-section">
            <div class="nav">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>CHIEU</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="Pic/user.png">
                    </div>
                </div>
            </div>
        </div>

      
    </div>








    <script src="orders.js"></script>
    <script src="index.js"></script>
</body>
</html>