<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Now - Login</title>
    <script src="scripts/login.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles/login.css">
<?php
session_start();

if (!isset($_SESSION['form_submitted'])) {
    $_SESSION['form_submitted'] = false;
}

function validate_ic($ic) {
    $regex = '/^[0-9]{6}-[0-9]{2}-[0-9]{4}$/';
    
    if (preg_match($regex, $ic)) {
        return true;
    } else {
        return false;
    }
}

function validate_password($password) {
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    
    if (preg_match($regex, $password)) {
        return true;
    } else {
        return false;
    }
}

include("connection.php");

if(isset($_POST['sign-up-button'])){
    $_SESSION['form_submitted'] = true;

    $username = $_POST['username'];
    $email = $_POST['useremail'];
    $password = ($_POST['userpassword']);
    $confirm_password = ($_POST['confirmpassword']);       
    $usercontact = $_POST['usercontact'];
    $useric = $_POST['useric'];
    $role = "user";

    $check_email_query = "SELECT * FROM user WHERE email = '$email'";
    $check_email_result = mysqli_query($con, $check_email_query);
    $existing_email_count = mysqli_num_rows($check_email_result);

    if ($existing_email_count > 0) {
        echo '<script type="text/javascript"> alert("Email already exists. Please use a different email.") </script>';
    } else if (!validate_ic($useric)) {
        echo '<script type="text/javascript"> alert("Invalid IC Number. Please enter a valid IC Number.") </script>';
    } else if ($password != $confirm_password) {
        echo '<script type="text/javascript"> alert("Please make sure your confirm password is samea as your password!!.") </script>';
    } else if (!validate_password($password)) {
        echo '<script type="text/javascript"> alert("Password must contain at least 8 characters, one uppercase letter, one lowercase letter, and one number.") </script>';
    }
        else {
        $query = "INSERT INTO user (username, email, password, contact_number, ic_number, role) 
        VALUES ('$username', '$email', '$password', '$usercontact', '$useric', '$role')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            echo '<script type="text/javascript"> alert("User Registered") </script>';
        } else {
            die("Error: " . mysqli_error($con));
        }
    }
}

if (isset($_POST['sign-in-button'])) {
    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];

    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $rowcount = mysqli_num_rows($result);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script type="text/javascript"> alert("Invalid email format.") </script>';
        exit;
    }

    if ($rowcount == 1) {
        $_SESSION['mySession'] = $row['user_id'];
        switch ($row['role']) {
            case 'user':
                header("Location: mainpage.php");
                exit();
            case 'staff':
                header("Location: booking(staff).php");
                exit();
            case 'admin':
                header("Location: admin_page.php");
                exit();
            default:
                header("Location: mainpage.php");
                exit();
        }
    } else {
        echo '<script type="text/javascript"> alert("Invalid Credentials. Please Try Again.") </script>';
    }
}
?>
</head>
<body style="background:hsl(0, 0%, 15%)">

<div class="container" id="container">
    <div class="form-container sign-up">
        <form action="login.php" method="post">
            <h1>Create Account</h1>
            <div class="social-icons"></div>
            
            <input type="text" name="username" placeholder="Name" required>
            <input type="email" placeholder="Email" name="useremail" required>
            <input type="password" placeholder="Password" name="userpassword" required>
            <input type="password" placeholder="Confirm Password" name="confirmpassword" required>
            <input type="tel" placeholder="Contact Number" name="usercontact" required>
            <input type="text" placeholder="IC Number Eg.040215-10-0575" name="useric" required>
            <button type="submit" name="sign-up-button">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form action="login.php" method="post">
            <h1>Sign In</h1>
            <div class="social-icons"></div>

            <input type="email" placeholder="Email" name="useremail" required>
            <input type="password" placeholder="Password" name="userpassword" required>
            <button type="submit" name="sign-in-button">Sign In</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Back!</h1>
                <p>Enter your personal details to use all of site features</p>
                <button class="hidden" id="login">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Hello, Friend!</h1>
                <p>Register with your personal details to use all of site features</p>
                <button class="hidden" id="register">Sign Up</button>
            </div>
        </div>
    </div>
</div>


</body>
</html>
