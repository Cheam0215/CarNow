<?php include ('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/admin_page.css" rel="stylesheet">
    <link href="styles/admin_feedback.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="scripts/dashboard.js" defer></script>
    <!--<script src="scripts/admin_feedback.js" defer></script>-->
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


        $query4 = "SELECT COUNT(feedback_id) AS total_of_feedback from feedback;";
        $result4= mysqli_query($con, $query4);

        if ($result4) {
            // Fetch the total donation amount
            $row = mysqli_fetch_assoc($result4);
            $totalFeedbacks = $row['total_of_feedback'];
    
        } else {
            // Display donation as $0 if the table is empty
            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); // Add this line for debugging
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
                <a href="admin_page.php">
                    <span class="material-symbols-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>

                <a href="admin_user.php?user_id=2">
                    <span class="material-symbols-sharp">
                        person_outline
                    </span>
                    <h3>User</h3>
                </a>

                <a href="admin_inventory.php">
                    <span class="material-symbols-sharp">
                    inventory_2
                    </span>
                    <h3>Inventory</h3>
                </a>
                <a href="admin_feedback.php" class="active">
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
                        <h1>Feedbacks</h1>
                    </div>
                </div>

            <div class="insights">
                <div class="data data-1">
                    <span class="material-symbols-sharp">
                        calendar_today
                    </span>
                    <span class="info">
                        <h3><?php echo $totalFeedbacks?></h3>
                        <p>Number of Feedbacks</p>
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

           

            <div class="search-container">
                <div class="name-container">
                    <form id="search-form" method="post">
                        <input name="feedback" type="text" placeholder="Search by Feedback ID or Name" id="search-input">
                        <div class="rating-search">
                            <label for="rating-filter">Filter by Rating : </label>
                            <select name="rating-filter" id="rating-filter">
                                <option value="">All</option>
                                <option value="Very Poor">Very Poor</option>
                                <option value="Poor">Poor</option>
                                <option value="Average">Average</option>
                                <option value="Good">Good</option>
                                <option value="Outstanding">Outstanding</option>
                            </select>

                        </div>
                        
                        <button type="submit" name="search-feedback"><span class="material-symbols-outlined">search</span></button>
                    </form>

                </div>
                
            </div>

    <div class="feedback-container">
        <table class="feedback-table">
            <thead>
                <tr>
                    <th>Feedback ID</th>
                    <th>Maintenance ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                      if (isset($_POST['search-feedback'])) {
                        $searchFeedback = $_POST['feedback'];
                        $ratingFilter = $_POST['rating-filter'];
                        $queryFeedback = "SELECT f.feedback_id, u.username, u.email, f.maintenance_id, f.description, f.rating FROM feedback f
                                          INNER JOIN user u ON f.user_id = u.user_id
                                          WHERE (f.feedback_id LIKE '%$searchFeedback%' OR u.username LIKE '%$searchFeedback%')";

                        if (!empty($ratingFilter)) {
                          $queryFeedback .= " AND f.rating = '$ratingFilter'";
                        }
                      } else {
                        $queryFeedback = "SELECT f.feedback_id, u.username, u.email, f.maintenance_id, f.description, f.rating FROM feedback f
                                        INNER JOIN user u ON f.user_id = u.user_id";
                      }
                      $resultFeedback = mysqli_query($con, $queryFeedback);

                      if ($resultFeedback) {
                        while ($rowFeedback = mysqli_fetch_assoc($resultFeedback)) {
                          echo "<tr>";
                          echo "<td>F00" . $rowFeedback['feedback_id'] . "</td>";
                          echo "<td>M00" . $rowFeedback['maintenance_id'] . "</td>";
                          echo "<td>" . $rowFeedback['username'] . "</td>";
                          echo "<td>" . $rowFeedback['email'] . "</td>";
                          echo "<td>" . $rowFeedback['description'] . "</td>";
                          echo "<td>" . $rowFeedback['rating'] . "</td>";
                          echo "<td><a onclick='return confirm(\"Are you sure you want to delete this feedback?\")' href='delete_feedback.php?feedback_id=" . $rowFeedback['feedback_id'] . "' class='delete'>
                                    <span class='material-symbols-outlined'>delete</span>
                                </a></td>";
                          echo "</tr>";
                        }
                      } else {
                        echo "<tr><td colspan='5'>No feedbacks found</td></tr>";
                      }
                    ?>
                </tr>
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
                        <?php if ($profilePic == NULL): ?>
                            <img src="images/profile-icon.png" alt="User Avatar">
                        <?php else: ?>
                            <img src="user_image/<?php echo $profilePic; ?>" alt="User Avatar">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

      
    </div>

    
</body>
</html>