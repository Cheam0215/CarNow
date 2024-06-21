<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Adminpage.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <style>


body{
    display:flex;
    color: var(--color-dark);
    background-color: var(--color-background);
}

#search-form {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 25px;
    margin-top: 50px;
   
}

#search-input {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px 0 0 4px;
    outline: none;
    width: 900px;
    border-radius: 20px;
 
  
  
}

#search-input:focus {
    border-color: #007BFF;
}

button {
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    width: 100px;

}

button:hover {
    background-color: #0056b3;
}
    

.Information{
    border: 2px solid black;
    border-radius: 20px;
    width: 390px;
    height: auto;
    margin-right: 7px;
    box-shadow: 0 0px 4px 0 rgba(0, 145, 255, 0.3), 0 0px 12px 6px rgba(58, 94, 122, 0.15);
    margin-left:7px;

}

.user_container{
    display: flex;
    box-shadow: 0 4px 4px 0 rgba(0, 145, 255, 0.3), 0 8px 12px 6px rgba(58, 94, 122, 0.15);
}

.button_user{
    display: flex;
    gap: 20px;
    margin-left: 20px;
    margin-bottom: 20px;
    margin-top: 20px;
}

.user_container{
    border-radius: 20px;
    border: 2px solid black;
    padding: 15px 15px;
    height: 675px;
    
}
.Add{
    margin-left: 325px;
    width: 140px;
 
 
}

.Sheet_bar{
    margin-left: 20px;
}

.Delete {
    margin-left: 650px;
    width: 100px;
    height:35px;
    margin-top: 5px;
}

table {
    width: 700px;
    border-collapse: collapse;
    margin-right: 30px;
    box-shadow: 0 2px 4px rgba(5, 5, 5, 0.548);
    box-shadow: 0 4px 4px 0 rgba(0, 145, 255, 0.3), 0 8px 12px 6px rgba(58, 94, 122, 0.15);
}



thead {
    background-color: rgba(12, 8, 16, 0.419);
    color: white;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}



.delete-btn {
    padding: 6px 12px;
    background-color: #dc3545;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

.delete-btn:hover {
    background-color: #c82333;
}

.avatar-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: -15px;
}

.avatar {
    width: 130px;
    height: 135px;
    border-radius: 50%;
    object-fit: cover; 
    border: 2px solid #007BFF; 
    margin-top: 15px;
}
.name-info{
    align-items: center;
    justify-content: center;
    display: flex;
    margin-top: 13px;
    font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 26px;
    margin-left: -15px;
    margin-bottom: 8px;
}



.G1,.G2 {
    text-align: left;
    margin-bottom: 15px; 
    
}

.G5 {
    text-align: left;
    margin-bottom: 9px; 
    display: flex;
    
}

.personal-info{
    display: flex;
    
 
   
}

.Service-history{
    position: absolute;
    bottom: 16px;
    left: 132px;
    color: black;
    text-decoration: none;
    cursor: pointer;
    
    
    
}

.left{
    width: 220px;
    height: 167px;
  
}

.left1{
    width: auto;
    height: 150px;
    overflow-y: auto;
  
}

.right{
    width: 220px;
    height: 167px;
  
}

.header{
    margin-bottom: 17px;

}


.G2{
    margin-top: 28px;
}

.Car-detials{
    margin-bottom: 17px;
    margin-top: 30px;
}

.Information{
    position: relative;
    padding-left: 20px;

}


.button-64 {
  align-items:end;
  background-image: linear-gradient(144deg,#AF40FF, #5B42F3 50%,#00DDEB);
  border: 0;
  border-radius: 8px;
  box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
  box-sizing: border-box;
  color: #FFFFFF;
  display: flex;
  font-family: Phantomsans, sans-serif;
  font-size: 10px;
  justify-content: center;
  line-height: 1em;
  max-width: 100%;
  min-width: 100px;
  padding: 3px;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  cursor: pointer;
  margin-left: 20px;
  margin-bottom: 8px;
  margin-right: 15px;

}

.button-64:active,
.button-64:hover {
  outline: 0;
}

.button-64 span {
  background-color: rgb(5, 6, 45);
  padding: 8px 13px;
  border-radius: 6px;
  width: 100%;
  height: 100%;
  transition: 300ms;
}

.button-64:hover span {
  background: none;
}

@media (min-width: 768px) {
  .button-64 {
    font-size: 10px;
    min-width: 126px;
    min-height: 20px;
  }
}

.space{
    width: 250px;
}

.Users,.Staffs,.Add{
    background-color: rgb(75, 75, 75);
    height: 40px;
    box-shadow: 0 4px 4px 0 rgba(0, 145, 255, 0.3), 0 8px 12px 6px rgba(58, 94, 122, 0.15);
    outline: none; 
    font-size: 11px;
}

.Users:hover,.Staffs:hover,.Add:hover{
    background-color: silver;
    color: black;
    font-size: 13px;
}

.contact{
    margin-top:25px;
}

#tableContainer {
    max-height: 600px; 
    overflow-y: auto; 
}


#openBtn {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

.popout {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);

}

.popout-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 10px;
    margin-top:5px;
}

#closeBtn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

#closeBtn:hover,
#closeBtn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

form {
    display: flex;
    flex-direction: column;
}

form label {
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="email"] {
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form input[type="submit"] {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #45a049;
}

.active {
    background-color:Aliceblue ; 
    color: blue; 
    border: 1px solid #007bff; 

}

#closeUpdateBtn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
    </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


     
</head>
<body>
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
c.car_plate,c.brand,c.model,c.color,c.year,
u.username,u.email,u.contact_number,u.ic_number,u.user_id,u.role FROM user u LEFT JOIN  
    car c ON u.user_id = c.user_id
    GROUP BY u.user_id ";


$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();{
    $date = $row['date'];
    $car_plate = $row['car_plate']; 
    $brand = $row['brand'];
    $model = $row['model'];
    $color = $row['color'];
    $year = $row['year'];
    $item_name = $row['item_name'];
    $amount = $row['amount'];
    $payment_id = $row['payment_id'];
    $time = $row['time'];
    $username = $row['username'];
    $email = $row['email'];
    $contact_number = $row['contact_number'];
    $ic_number = $row['ic_number'];
    $quantity = $row['quantity_used'];
    $payment_method = $row ['payment_method'];
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
            if ($user_id != 18) {
                echo '    <td><button onclick="deleteUser(event, ' . $user_id . ')" class="delete-btn">Delete</button></td>';
            } else {
                echo '    <td></td>'; 
            }
            
            echo '</tr>';
}
        }
    }
    
    if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    $stmt = $conn->prepare("SELECT
        c.car_plate, c.brand, c.model, c.color, c.year,
        u.username, u.email, u.contact_number, u.ic_number, u.user_id,u.picture,u.password
        FROM user u 
        LEFT JOIN car c ON u.user_id = c.user_id
        WHERE u.user_id = ?");

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();{
    $date = $row['date'];
    $car_plate = $row['car_plate']; 
    $brand = $row['brand'];
    $model = $row['model'];
    $color = $row['color'];
    $year = $row['year'];
    $item_name = $row['item_name'];
    $amount = $row['amount'];
    $payment_id = $row['payment_id'];
    $time = $row['time'];
    $username = $row['username'];
    $email = $row['email'];
    $contact_number = $row['contact_number'];
    $ic_number = $row['ic_number'];
    $quantity = $row['quantity_used'];
    $payment_method = $row ['payment_method'];
    $user_id = $row ['user_id'];
    $picture = $row ['picture'];
    $password = $row ['password'];


    echo '                    </tbody>';
    echo '                </table>';
    echo '            </div>';
    echo '        </div>';
    echo '    </div>';
    echo '    <div class="Information" id="userDetails">';
    echo '        <div class="avatar-container">';
    echo '            <img src='.$picture.' alt="User Avatar" class="avatar">';
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
    echo '        <h3 class="Car-detials"><strong>Car Detials</strong> </h3>';
    echo '        <div class="personal-info">';
    echo '            <div class="left1">';

       
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
    echo '        <h2>Registe user</h2>';
    echo '        <form id="staffForm" method="POST" action="register.php">';
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
    echo '            <input type="text" id="picture" name="picture" required><br><br>';
    echo '            <input type="submit" value="Register">';
    echo '        </form>';
    echo '    </div>';
    echo '</div>';

    echo '<div id="updatePopOutWindow" class="popout" style="display:none;">';
    echo '    <div class="popout-content">';
    echo '        <span id="closeUpdateBtn">&times;</span>';
    echo '        <h2>Update User Information</h2>';
    echo '        <form id="updateStaffForm" method="POST" action="Update.php">';
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
    echo '            <input type="text" id="updatePicture" name="picture" value="' .$picture. '" required><br><br>';
    echo '            <input type="submit" value="Update">';
    echo '        </form>';
    echo '    </div>';
    echo '</div>';

}
}
    }
    }
    


 else {
    echo "0 results";
}

$conn->close();
?>
    <script> 
      
      function searchTable() {

    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.getElementById("userTable");
    tr = table.getElementsByTagName("tr");


    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none"; 
        td = tr[i].getElementsByTagName("td")[0]; 
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().startsWith(filter)) {
                tr[i].style.display = ""; 
            }
        }
    }
}


document.addEventListener('DOMContentLoaded', function() {
    var openBtn = document.getElementById('openBtn');
    var popOutWindow = document.getElementById('popOutWindow');
    var closeBtn = document.getElementById('closeBtn');

    openBtn.onclick = function() {
        popOutWindow.style.display = 'block';
    }

    closeBtn.onclick = function() {
        popOutWindow.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == popOutWindow) {
            popOutWindow.style.display = 'none';
        }
    }
});



$(document).ready(function() {
    $('#animatedElement').on('click', 'tr', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: 'admintest.php',
            type: 'GET',
            data: { user_id: userId },
            success: function(response) {
                var $responseHtml = $(response); 
                var userDetailsHtml = $responseHtml.find('#userDetails').html(); 
                $('#userDetails').html(userDetailsHtml); 

                var updatePopOutWindowHtml = $responseHtml.find('#updatePopOutWindow').html(); 
                $('#updatePopOutWindow').html(updatePopOutWindowHtml); 

                
                document.getElementById('updateInfoLink').onclick = function() {
                    document.getElementById('updatePopOutWindow').style.display = 'block';
                };

                document.getElementById('closeUpdateBtn').onclick = function() {
                    document.getElementById('updatePopOutWindow').style.display = 'none';
                };

                window.onclick = function(event) {
                    if (event.target == document.getElementById('updatePopOutWindow')) {
                        document.getElementById('updatePopOutWindow').style.display = 'none';
                    }
                };
            }
        });
    });
});





function deleteUser(event, user_id) {
    event.stopPropagation(); 
    if (confirm('Are you sure you want to delete this user?')) {

        window.location.href = 'DELETE.php?main_id=' + user_id;
    }
}



document.addEventListener('DOMContentLoaded', function() {
    var showUsersBtn = document.getElementById('showUsers');
    var showStaffsBtn = document.getElementById('showStaffs');
    var rows = document.querySelectorAll('#userTable tbody tr');

    showUsersBtn.addEventListener('click', function() {
        filterRows('user');
        setActiveButton(showUsersBtn);
    });

    showStaffsBtn.addEventListener('click', function() {
        filterRows('staff');
        setActiveButton(showStaffsBtn);
    });

    function filterRows(role) {
        rows.forEach(function(row) {
            if (row.classList.contains(role)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function setActiveButton(activeBtn) {
        [showUsersBtn, showStaffsBtn].forEach(function(btn) {
            if (btn === activeBtn) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }
});


document.getElementById('updateInfoLink').onclick = function() {
                    document.getElementById('updatePopOutWindow').style.display = 'block';
                };

                document.getElementById('closeUpdateBtn').onclick = function() {
                    document.getElementById('updatePopOutWindow').style.display = 'none';
                };

                window.onclick = function(event) {
                    if (event.target == document.getElementById('updatePopOutWindow')) {
                        document.getElementById('updatePopOutWindow').style.display = 'none';}}






</script>


        </script>
</body>
</html>