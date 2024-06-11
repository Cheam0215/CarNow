<?php include("session.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles/mainpage.css">
    <link rel="stylesheet" href="styles/header.css">
    <script src="scripts/header.js" defer></script>
    
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
                        <li><a href="about_us.php">About us</a></li>
                        <li><a href="book_appointment.php" id="serviceButton">Book a Service</a></li>
                        <li><a href="#">My Bookings</a></li>
                        <?php if(isset($_SESSION['mySession'])): 
                            include("connection.php");
                            $sessionID = $_SESSION['mySession'];
                            $query = "SELECT username FROM user WHERE user_id = '$sessionID'";
                            $result = mysqli_query($con, $query);
                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $username = $row['username'];
                            } else {
                                header("Location: logout.php");
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
        <div class="background-logo">


        </div>
    </div>
    <footer class="bottom">
        <h5 class="bottom-text">
            Car Monitoring And Service (Car Now), Inc. is a 501(c)(3) organisation registered in Malaysia. (Tax ID #06-0726487)
        </h5>
    </footer>
</body>
</html>
