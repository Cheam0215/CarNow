<?php include("session.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="styles/mainpage.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/my_profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .dropbtn:hover {
            transform: scale(1);
        }
    </style>
    
    <script src="scripts/header.js" defer></script>
    <script src="scripts/my_profile.js" defer></script>


    <?php
    include("connection.php");
    $user_image = null;
    $username = null;
    if (isset($_SESSION['mySession'])) {
        $sessionID = $_SESSION['mySession'];
        $query = "SELECT * FROM user WHERE user_id = '$sessionID'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $email = $row['email'];
        $contact_number = $row['contact_number'];
        $ic_number = $row['ic_number'];
        $user_image = $row['user_image'];
        $password = $row['password'];
        
    }       
    
    ?>

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
                        <?php if ($username): ?>
                            <li><a href="mainpage.php">Home</a></li>
                            <li><a href="mainpage.php#about-us">About us</a></li>
                            <li><a href="book_appointment.php" id="serviceButton">Book a Service</a></li>
                            <li><a href="#">My Bookings</a></li>
                            <li>
                                <div class="profile-menu">
                                    <a href="my_profile.php" class="dropbtn" ><?php echo htmlspecialchars(explode(' ', $username)[0]); ?>
                                        <span class="material-symbols-outlined">account_circle</span> 
                                    </a>
                                </div>
                            </li>
                        <?php else: ?>
                            <li><a href="#services">Our Services</a></li>
                            <li><a href="#about-us">About us</a></li>
                            <li><a href="#FAQ">FAQS</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                            <li><button onclick="window.location.href='login.php'" class="login-button">Login</button></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>


       
    <div class="container1">
    <div class="sidebar">
        <form method="post" action="my_profile_update.php" id="profile-form" enctype="multipart/form-data">
            <div id="image_profile">
                <input type="file" name="user_image" id="image" >
                <?php if ($user_image == null): ?>
                    <img src="images/profile-icon.png" alt="User Avatar">
                <?php else: ?>
                    <img src="user_image/<?php echo $user_image; ?>" alt="User Avatar">
                <?php endif; ?>
                <img src="images/edit-profile.png" alt="Edit Profile" class="edit-profile">
                </div>
            <div class="user-info">
                <h2><?php echo $username ?></h2>
                <p><?php echo $email ?></p>
            </div>
            <nav>
                <a id="account" class="active" onclick=showAccount()>Account</a>
                <a id="cars" class="" onclick=showCars() >My Cars</a>
                <a href="logout.php">Logout</a>
            </nav>
    </div>
    <div class="content" id="content-div">
        <h3 id="account-header">Account Setting</h3>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $username ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $password ?>" required>
                <div class="show-password">
                    <label id="show-password">Show Password</label>
                    <input type="checkbox" id="show_password" name="show_password" onclick="togglePasswordVisibility()">
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $contact_number ?>" required>
            </div>
            <div class="form-group">
                <label for="icNum">IC Number</label>
                <input id="icNum" name="icNum" value="<?php echo $ic_number ?>" readonly>
                <input type="hidden" name="sessionID" value="<?php echo $sessionID ?>">
            </div>
            <div class="buttons" id="buttons-form">
                <button type="button" class="cancel">Cancel</button>
                <button name="save" type="submit" id="saveButton" onclick="return confirm('Are you sure you want to make the changes?')">Save</button>
            </div>
        </form>



        <div class="cars-info hide">
            <div class="top-part">
                <h3 id="cars-header" >My Cars</h3>
                <button id="car-button-add" class="car-button-add"><a id="add-button">Add<span class="material-symbols-outlined">add_circle</span></a></button>
            </div>
            
            <div class="car-cards">
            
            <?php
            if ($username) {
                $query = "SELECT * FROM car WHERE user_id = '$sessionID'";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $car_plate = $row['car_plate'];
                        $car_brand = $row['brand'];
                        $car_model = $row['model'];
                        $car_color = $row['color'];
                        $car_year = $row['year'];
                        ?>
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/car-icon.png" class="img-fluid rounded-start" alt="Car Icon">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><b><?php echo $car_brand . ' ' . $car_model; ?></b></h5>
                                        <p class="card-text"><strong>Plate: </strong><?php echo $car_plate; ?></p>
                                        <p class="card-text"><strong>Year: </strong><?php echo $car_year; ?></p>
                                        <p class="card-text"><strong>Color: </strong><?php echo $car_color; ?></p>
                                        <div class="action-buttons">
                                        <form style="display:inline" id="edit-form-fetch" class="edit_form">
                                            <button type="submit" name="edit" class="edit-btn" id="edit">
                                                <span class='material-symbols-outlined'>edit</span>
                                            </button>
                                            <input type="hidden" name="car-plate" value="<?php echo $car_plate ?>">
                                            <input type="hidden" name="car-brand" value="<?php echo $car_brand ?>">
                                            <input type="hidden" name="car-model" value="<?php echo $car_model ?>">
                                            <input type="hidden" name="car-year" value="<?php echo $car_year ?>">
                                            <input type="hidden" name="car-color" value="<?php echo $car_color ?>">
                                        </form>
                                            <a class="delete" onclick="return confirm('Are you sure you want to delete this car?')" href="delete_car.php?car_plate=<?php echo $car_plate; ?>"><span class='material-symbols-outlined'>delete</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No cars found.</p>";
                }
            }
            ?>
            </div>
        </div>
        </div>
    
</div>

<form class="add-car" method="post" action="add_car.php" enctype="multipart/form-data">
    <div class="add-car-form">
        <div class="close-button">
            <i id="close" class="fa fa-close" style="font-size:24px"></i>
        </div>

        <div id="first-form-group" class="form-group-add">
            <label for="car-plate">Car Plate</label>
            <input type="text" name="car-plate" id="car-plate" required oninput="this.value = this.value.toUpperCase()">
        </div>
        <div class="form-group-add">
            <label for="car-brand">Brand</label>
            <select name="car-brand" id="car-brand" required>
                <option value="Proton">Proton</option>
                <option value="Perodua">Perodua</option>
                <option value="Toyota">Toyota</option>
            </select>
        </div>
        <div class="form-group-add">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" required>
        </div>
        <div class="form-group-add">
            <label for="year">Year</label>
            <input type="text" name="year" id="year" required min="1">
        </div>
        <div class="form-group-add">
            <label for="color">Color</label>
            <input type="text" name="color" id="color" required min="10">
            <input type="hidden" name="sessionID" value="<?php echo $sessionID ?>">
        </div>
        <div id="form-add" class="form-group-add">
            <button type="submit" name="add-car-button" class="car-button-add" ><a id="add">Add<span class="material-symbols-outlined">add_circle</span></a></button>
        </div>
    </div>
</form>

<form class="edit-car" id="form-result" method="post" action="update_car.php" enctype="multipart/form-data"></form>

    <footer class="bottom">
        <h5 class="bottom-text">
            Car Monitoring And Service (Car Now), Inc. is a 501(c)(3) organisation registered in Malaysia. (Tax ID #06-0726487)
        </h5>
    </footer>
    
</body>
</html>
