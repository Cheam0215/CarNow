<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/admin_page.css">
    <link rel="stylesheet" href="styles/admin_user.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="scripts/admin_user.js" defer></script> 
</head>
<body>
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
        <a href="Admin_Page.php">
            <span class="material-symbols-sharp">
                dashboard
            </span>
            <h3>Dashboard</h3>
        </a>


        <a href="admin_user.php?user_id=1" class="active">
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

<?php
include ("connection.php");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT
c.car_plate,c.brand,c.model,c.color,c.year,
u.username,u.email,u.contact_number,u.ic_number,u.user_id,u.role FROM user u LEFT JOIN  
    car c ON u.user_id = c.user_id
    GROUP BY u.user_id ";


$result = $con->query($sql);


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();{
    $car_plate = $row['car_plate']; 
    $brand = $row['brand'];
    $model = $row['model'];
    $color = $row['color'];
    $year = $row['year'];
    $username = $row['username'];
    $email = $row['email'];
    $contact_number = $row['contact_number'];
    $ic_number = $row['ic_number'];
    $user_id = $row ['user_id'];
    $role = $row ['role'];
   

echo'<div>';
    echo '<div class="search-container" id="s">';
    echo '    <form id="search-form" onsubmit="return false;">';
    echo '        <input type="text" placeholder="Search.." id="search-input" onkeyup="searchTable()">';
    echo '    </form>';
    echo '</div>';

    echo '<div class="user_container" id="s">';
    echo '    <div class="user_button_name">';
    echo '        <div class="button_user">';
    echo '<button class="Users" id="showUsers">Users</button>';
    echo '<button class="Staffs" id="showStaffs">Staffs</button>';
    
    echo '            <button class="Add" id="openBtn">Add user</button>';
    echo '        </div>';
    echo '        <div class="User">';
    echo '            <div class="Sheet_bar"  id="tableContainer">';
    echo '                <table id="userTable">';
    echo '                    <thead>';
    echo '                        <tr>';
    echo '                            <th>Name</th>';
    echo '                            <th>User ID</th>';
    echo '                            <th>User Email</th>';
    echo '                            <th>Action</th>';
    echo '                        </tr>';
    echo '                    </thead>';
    echo '                    <tbody id="animatedElement">';
  



    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $email = $row['email'];
            $role = $row['role'];

            echo '<tr class="' . $role . '" id="content' . $user_id . '"  data-id="' . $row["user_id"] . '">';
            echo '    <td>' . $username . '</td>';
            echo '    <td>' . $user_id . '</td>';
            echo '    <td>' . $email . '</td>';
            if ($role != "admin") {
                echo '    <td><button onclick="deleteUser(event, ' . $user_id . ')" class="delete-btn">Delete</button></td>';
            } else {
                echo '    <td></td>'; 
            }
            
            echo '</tr>';
        }
    }
    
    if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    $stmt = $con->prepare("SELECT
        u.username, u.email, u.contact_number, u.ic_number, u.user_id,u.user_image,u.password
        FROM user u 
        WHERE u.user_id = ?");

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();{

    $username = $row['username'];
    $email = $row['email'];
    $contact_number = $row['contact_number'];
    $ic_number = $row['ic_number'];
    $user_id = $row ['user_id'];
    $picture = $row ['user_image'];
    $password = $row ['password'];


    echo '                    </tbody>';
    echo '                </table>';
    echo '            </div>';
    echo '        </div>';
    echo '    </div>';
    echo '    <div class="Information" id="userDetails">';
    echo '        <div class="avatar-container">';
    echo '<img src="' . ($picture ? 'user_image/' . $picture : 'images/profile-icon.png') . '" alt="User Avatar" class="avatar">';
    echo '        </div>';
    echo '        <div class="name-info">';
    echo '           '.$username.'';
    echo '        </div>';
    echo '        <div class="personal-info">';
    echo '            <div class="left">';
    echo '                <div class="header"><strong>Personal Details</strong></div>';
    echo '                <div class="G1">';
    echo '                    <div><strong>Customer ID:</strong></div>';
    echo '                    <div>'.$user_id.'</div>';
    echo '                </div>';
    echo '                <div class="G1">';
    echo '                    <div><strong>Name:</strong></div>';
    echo '                    <div>'.$username.'</div>';
    echo '                </div>';
    echo '                <div class="G1">';
    echo '                    <div><strong>IC Number:</strong></div>';
    echo '                    <div>'.$ic_number.'</div>';
    echo '                </div>';
    echo '            </div>';
    echo '            <div class="right">';
    echo '                <div class="G2">';
    echo '                    <div><strong>Phone Number:</strong></div>';
    echo '                    <div>'.$contact_number.'</div>';
    echo '                </div>';
    echo '                <div class="G1">';
    echo '                    <div><strong>Email Address:</strong></div>';
    echo '                    <div>'.$email.'</div>';
    echo '                </div>';
    echo '            </div>';
    echo '        </div>';
    echo '        <h3 class="Car-detials"><strong>Car Details</strong> </h3>';
    echo '        <div class="personal-info">';
    echo '            <div class="left1">';

       

    $sql = "SELECT car_plate, brand, model FROM car WHERE user_id = $user_id";
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $car_plate = $row['car_plate'];
            $brand = $row['brand'];
            $model = $row['model'];
         
    
            echo '    <div class="G5">';
            echo '        <div class="space">';
            echo '            <div><strong>  '.$brand.'  '.$model.'</strong></div>';
            echo '        </div>';
            echo '        <div>';
            echo '            <button class="button-64" role="button"><span class="text">'.$car_plate.'</span></button>';
            echo '        </div>';
            echo '    </div>';

}
    }
            echo '    <div class="Service-history">';
            echo '      <a href="#" id="updateInfoLink">Update Information</a>';
            echo '    </div>';
            echo '</div>';
            echo '</div>';
    
            echo '</div>';
            echo '</div>';
        
    
    

       

    echo '<div id="popOutWindow" class="popout">';
    echo '    <div class="popout-content">';
    echo '        <span id="closeBtn">&times;</span>';
    echo '        <h2>Register user</h2>';
    echo '        <form id="staffForm" method="POST" action="admin_register.php" enctype="multipart/form-data">';
    echo '            <label for="name">Name:</label>';
    echo '            <input type="text" id="name" name="name" required><br><br>';
    echo '            <label for="email">Email:</label>';
    echo '            <input type="email" id="email" name="email" required><br><br>';
    echo '            <label for="password">Password:</label>';
    echo '            <input type="text" id="password" name="password" required><br><br>';
    echo '            <label for="contact_number">Contact Number:</label>';
    echo '            <input type="text" id="contact_number" name="contact_number" required><br><br>';
    echo '            <label for="role">Role:</label>';
    echo '            <input type="text" id="role" name="role" required><br><br>';
    echo '            <label for="ic_number">IC Number:</label>';
    echo '            <input type="text" id="ic_number" name="ic_number" required><br><br>';
    echo '            <label for="picture">Picture:</label>';
    echo '            <input type="file" id="picture" name="user_image"><br><br>';
    echo '            <button type="submit" name="add-staff-button" id="addStaffBtn">Add Staff</button>';
    echo '        </form>';
    echo '    </div>';
    echo '</div>';

    echo '<div id="updatePopOutWindow" class="popout" style="display:none;">';
    echo '    <div class="popout-content">';
    echo '        <span id="closeUpdateBtn">&times;</span>';
    echo '        <h2>Update User Information</h2>';
    echo '        <form id="updateStaffForm" method="POST" action="admin_user_update.php" enctype="multipart/form-data">';
    echo '            <input type="hidden" id="user_id" name="user_id" value="' . $user_id. '" required><br><br>';
    echo '            <label for="updateName">Name:</label>';
    echo '            <input type="text" id="updateName" name="name" value="' . $username . '" required><br><br>';
    echo '            <label for="updateEmail">Email:</label>';
    echo '            <input type="email" id="updateEmail" name="email" value="' .$email. '" required><br><br>';
    echo '            <label for="updatePassword">Password:</label>';
    echo '            <input type="text" id="updatePassword" name="password" value="' . $password . '" required><br><br>';
    echo '            <label for="updateContactNumber">Contact Number:</label>';
    echo '            <input type="text" id="updateContactNumber" name="contact_number" value="' .$contact_number. '" required><br><br>';
    echo '            <label for="updateRole">Role:</label>';
    echo '            <input type="text" id="updateRole" name="role" value="' . $role . '" required><br><br>';
    echo '            <label for="updateIcNumber">IC Number:</label>';
    echo '            <input type="text" id="updateIcNumber" name="ic_number" value="' .$ic_number . '" required><br><br>';
    echo '            <label for="updatePicture">Picture:</label>';
    echo '            <input type="file" id="updatePicture" name="user_image" value="' .$picture. '" ><br><br>';
    echo '            <input type="submit" name="update_user" >';
    echo '        </form>';
    echo '    </div>';
    echo '</div>';

}
}
    }
    }
    
}

$con->close();
?>
</body>
</html>