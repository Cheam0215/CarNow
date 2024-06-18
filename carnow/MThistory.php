<?php
include("session.php");
include("connection.php");

if (!isset($_SESSION['mySession'])) {
    header("Location: login.php");
    exit;
}

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance History</title>
    <link rel="stylesheet" href="Styles/MThistory.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <script src="scripts/MThistory.js" defer></script>
</head>
<body>
    <div class="container">
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="logo_image/carnowLogo.png" alt="Logo" class="now">
                </div>
            </div>
            <div class="sidebar">
                <a href="booking(staff).php">
                    <span class="material-symbols-sharp">book</span>
                    <h3>Booking</h3>
                </a>
                <a href="MT.php">
                    <span class="material-symbols-sharp">inventory</span>
                    <h3>Service</h3>
                </a>
                <a href="MThistory.php" class="active">
                    <span class="material-symbols-sharp">history</span>
                    <h3>History</h3>
                </a>
                <a href="logout.php" class="logout-button">
                    <span class="material-symbols-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <div class="right-section">
            <div class="nav">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo $username ?></b></p>
                        <small class="text-muted">Staff</small>
                    </div>
                    <div class="profile-photo">
                    <img src="images/profile-icon.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="main">
            <h1>Service History</h1>
            <div class="search-bar">
                <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for service records..">
            </div>
            <div class="maintenance-history">
                <?php
                $sql = "SELECT * FROM maintenance WHERE user_id = '$sessionID' ";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table id='historyTable'>";
                    echo "<thead>
                          <tr>
                          <th>Service ID</th>
                          <th>Car Plate</th>
                          <th>Service Details</th>
                          <th>Quantity Used</th>
                          <th>Progress</th>
                          <th> Service Date</th>
                          </tr>
                          </thead>
                          <tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                              <td>" . $row["maintenance_id"] . "</td>
                              <td>" . $row["car_plate"] . "</td>
                              <td>" . $row["service_details"] . "</td>
                              <td>" . $row["quantity_used"] . "</td>
                              <td>" . $row["progress"] . "</td>
                              <td>" . $row["service_date"] . "</td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo '<h2 style="text-align:center;">No Service records found.</h2>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
