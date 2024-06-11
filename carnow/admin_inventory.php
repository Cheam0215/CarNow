<?php include ('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/admin_page.css" rel="stylesheet">
    <link href="styles/admin_inventory.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts/admin_inventory.js" defer></script>
    <title>Admin Inventory</title>
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


        $query4 = "SELECT COUNT(item_id) AS total_items from inventory;";
        $result4= mysqli_query($con, $query4);

        if ($result4) {
            $row = mysqli_fetch_assoc($result4);
            $total_items = $row['total_items'];
    
            if ($total_items !== null) {
                $total_items = number_format($total_items, 0);
            } else {
                $total_items = number_format(0, 2);
            }
        } else {

            echo "<h1>No Record Thus Far</h1>";
            echo "Error: " . mysqli_error($con); 
        }

        $query5 = "SELECT image ,username from user where role = 'admin';";
        $result5= mysqli_query($con, $query5);

        if ($result5) {
            $row = mysqli_fetch_assoc($result5);
            $profilePic = $row['image'];
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
                <a href="admin_inventory.php" class="active">
                    <span class="material-symbols-sharp" >
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
                        <h1>Inventory</h1>
                    </div>
                </div>

            <div class="insights">
                <div class="data data-1">
                    <span class="material-symbols-sharp">
                        category
                    </span>
                    <span class="info">
                        <h3><?php echo $total_items?></h3>
                        <p>Number of Items</p>
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
          
      <?php

      ?>

        <div class="inventory">

            <div class="search-bar">
                <div class="search-bar-left">
                <form method="post">
                    <input type="text" placeholder="Search Item by Name, ID or Brand" name="search">
                    <button class="search-button" type="submit" name="search-button">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                    </form>
                </div>
                <div class="search-bar-right">
                    <button class="add-button">
                        <a>Add<span class="material-symbols-outlined">add_circle</span></a>
                    </button>
                </div>
                
               
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("connection.php");

                        // Define the number of items per page
                        $items_per_page = 3;
                
                        // Get the current page number from the URL, default is page 1
                        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $offset = ($current_page - 1) * $items_per_page;

                        if (isset($_POST['search-button'])) {
                            $search = $_POST['search'];
                            $sql = "SELECT * FROM inventory 
                                    WHERE item_name 
                                    LIKE '%$search%' OR item_brand LIKE '%$search%' OR item_id LIKE '%$search%'
                                    LIMIT $offset, $items_per_page ";

                            $total_items_query = "SELECT COUNT(*) as total FROM inventory 
                                                    WHERE item_name 
                                                    LIKE '%$search%' OR item_brand LIKE '%$search%' OR item_id LIKE '%$search%'";
                        }
                        else {
                            $sql = "SELECT * FROM inventory LIMIT $offset, $items_per_page";
                            $total_items_query = "SELECT COUNT(*) as total FROM inventory";
                        }
                
                        // Get the total number of items
                        $total_items_result = mysqli_query($con, $total_items_query);
                        $total_items_row = mysqli_fetch_assoc($total_items_result);
                        $total_items = $total_items_row['total'];
                
                        // Calculate the total number of pages  
                        $total_pages = ceil($total_items / $items_per_page);
                        $result = mysqli_query($con, $sql);
                            ;

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                <td class='item_preview'>
                                <div class='item_id'><b>I00" . $row['item_id'] . "</b></div>
                                <img src='item_image/" . $row["item_image"] . "' alt='" . $row["item_name"] . "' class='item_image'>
                                <div class='item_name'><b>" . $row["item_name"] . "</b></div>
                                </td>
                                <td>" . $row["item_brand"] . "</td>
                                <td>" . $row["quantity"] . "</td>
                                <td>MYR " . $row["cost"] . ".00</td>
                                <td class='action-buttons'>
                                <form class='edit-form' method='post'>
                                    <input type='hidden' name='item_id' value='".$row['item_id']."'>
                                    <button class='edit' type='submit' name='submit_button'>
                                        <span class='material-symbols-outlined'>edit</span>
                                    </button>
                                </form>
                                <a onclick='return confirm(\"Are you sure you want to delete this item?\")' href='delete_inventory.php?item_id=" . $row['item_id'] . "' class='delete'>
                                    <span class='material-symbols-outlined'>delete</span>
                                </a>
                                </td>
                            </tr>";
                            }
                        } else {
                            echo '<h1 style="text-align:center;">Item not found</h1><br>';
                        }
                    ?>
                </tbody>
            </table>

            <?php
            // Display pagination links
            if ($total_pages > 1) {
                echo '<div class="pagination">';
                if ($current_page > 1) {
                    echo '<a href="?page=' . ($current_page - 1) . '">Previous</a>';
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="current-page">' . $i . '</span>';
                    } else {
                        echo '<a href="?page=' . $i . '">' . $i . '</a>';
                    }
                }
                if ($current_page < $total_pages) {
                    echo '<a href="?page=' . ($current_page + 1) . '">Next</a>';
                }
                echo '</div>';
            }
            ?>

        </main>

        </div>

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

    <form class="add-item" method="post" action="add_item.php" enctype="multipart/form-data">
                <div class="add-item-form">
                    <div class="close-button">
                        <i id="close" class="fa fa-close" style="font-size:24px"></i>
                    </div>

                    <div id="first-form-group" class="form-group">
                        <label for="item-name">Item Name</label>
                        <input type="text" name="itemName" id="item-name" required>
                    </div>
                    <div class="form-group">
                        <label for="item-brand">Brand</label>
                        <select name="itemBrand" id="item-brand" required>
                            <option value="Proton">Proton</option>
                            <option value="Perodua">Perodua</option>
                            <option value="Toyota">Toyota</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost (MYR) </label>
                        <input type="number" name="cost" id="cost" required min="10">
                    </div>
                    <div class="form-group">
                        <label for="item-image">Image</label>
                        <input type="file" name="item-image" id="item-image" required>
                    </div>
                    <div id="form-add" class="form-group">
                        <button type="submit" name="add-item-button" class="add-button"><a>Add<span class="material-symbols-outlined">add_circle</span></a></button>
                    </div>
                </div>
            </form>

        
            <?php
             
             if (isset($_POST['submit_button'])) {
                include("connection.php");
                $item_id = $_POST['item_id'];
                $sql = "SELECT * FROM inventory WHERE item_id = $item_id";
                $result_edit = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result_edit);
            
                echo "<form class='edit-item' method='post' action='edit_item.php' enctype='multipart/form-data'>";
                echo "<div class='edit-item-form'>";
                echo "<div class='close-button'>";
                echo "<i id='close' class='fa fa-close' style='font-size:24px'></i>";
                echo "</div>";
                echo "<div id='first-form-group' class='form-group'>";
                echo "<label for='item-name'>Item Name</label>";
                echo "<input type='text' name='itemName' id='item-name' value='".$row['item_name']."' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='item-brand'>Brand</label>";
                echo "<select name='itemBrand' id='item-brand' required>";
                echo "<option value='Proton' ".($row['item_brand'] == 'Proton' ? 'selected' : '').">Proton</option>";
                echo "<option value='Perodua' ".($row['item_brand'] == 'Perodua' ? 'selected' : '').">Perodua</option>";
                echo "<option value='Toyota' ".($row['item_brand'] == 'Toyota' ? 'selected' : '').">Toyota</option>";
                echo "</select>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='quantity'>Quantity</label>";
                echo "<input type='number' name='quantity' id='quantity' value='".$row['quantity']."' required min='1'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='cost'>Cost (MYR)</label>";
                echo "<input type='number' name='cost' id='cost' value='".$row['cost']."' required min='10'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='item-image'>Image</label>";
                echo "<input type='file' name='item-image' id='item-image'>";
                echo "<br>";
                echo "<p>Current file: " . $row['item_image'] . "</p>"; 
                echo "</div>";
                echo "<div class='form-group-edit'>";
                echo "<input type='hidden' name='item_id' value='".$row['item_id']."'>";
                echo "<button type='submit' name='edit-item-button' class='edit-button'>Edit</button>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
            }
            ?>
            
              
            
            
            

</body>
</html>