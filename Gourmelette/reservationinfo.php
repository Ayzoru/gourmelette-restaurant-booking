<?php
// Start the session
session_start();

// Include header file
require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="yummy.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="./images/1stlogo.png" type="image/x-icon">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Swiper CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmelette | Reservation Info</title>
</head>
<body>
    
    <header>
        <!-- Header section -->
        <div class="header">
            <!-- Logo -->
            <div class="logo">
                <a href="reservation.php">
                    <img src="./images/GourmeletteWide2.jpeg" alt="gourmelttelogo">
                </a>
            </div>
            <!-- Navigation bar -->
            <div class="bar">
                <!-- Navigation bar icons -->
                <i class="fa-solid fa-bars"></i>
                <i class="fa-solid fa-xmark" id="hdcross"></i>
            </div>
            <!-- Navigation links -->
            <div class="nav">
                <ul>
                    <!-- Navigation links -->
                    <a href="reservation.php">
                        <li>Gourmet Menu</li>
                    </a>
                    <a href="reservation.php">
                        <li>About Us</li>
                    </a>
                    <a href="reservetable.php">
                        <li>Reserve Table</li>
                    </a>
                    <a href="reservation.php">
                        <li>Contact Us</li>
                    </a>
                    <a href="reservationinfo.php">
                        <li>Reservation Info</li>
                    </a>
                    <?php
                    // Logout button when user is logged in
                    if(isset($_SESSION['userID'])){
                        echo '
                        <form class="navbar-form navbar-right" action="logout.php" method="post">
                            <button type="submit" name="logout-submit" class="btn-outline-dark logout">Logout</button>
                        </form>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </header>
    
    <br><br>
    <div class="container">
        <!-- View Reservations heading -->
        <h3 class="text-center"><br>View Reservations<br></h3>     

        <?php
        if(isset($_SESSION['userID'])){
            // Message for logged in user
            echo '<p class="text-white bg-dark text-center">'. $_SESSION['userName'] .', Here you can check your reservation history</p><br>';
            
            // Check if deletion message is set
            if(isset($_GET['delete'])){
                if($_GET['delete'] == "error") {
                    // Error message
                    echo '<h5 class="bg-danger text-center">Error!</h5>';
                }
                if($_GET['delete'] == "success"){ 
                    // Success message
                    echo '<h5 class="bg-success text-center">Delete was successful</h5>';
                }
            }  

            // Include the database connection file
            require 'header.php';

            // Fetch reservations for the current user
            $user = $_SESSION['userID'];
            $sql = "SELECT * FROM reservation WHERE user_fk = $user";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                echo '
                <!-- Reservation table -->
                <table class="table table-hover table-responsive-sm text-center">
                    <thead>
                        <tr class="reservation-row">
                            <th scope="col">Full Name</th>
                            <th scope="col">Guests</th>
                            <th scope="col">Reservation Date</th>
                            <th scope="col">Time Zone</th>
                            <th scope="col">Table Number</th>
                            <th scope="col">Register Date</th>
                            <th scope="col">Comments</th>
                            <th class="table-danger" scope="col"></th>
                        </tr>
                    </thead>';

                while($row = $result->fetch_assoc()) {
                    echo "
                    <tbody>
                        <tr class='reservation-row'>
                            <form action='delete.php' method='POST'>
                                <input name='reserv_id' type='hidden' value=".$row["reserv_id"].">
                                <th scope='row'>".$row["f_name"]." ".$row["l_name"]."</th>
                                <td>".$row["num_guests"]."</td>
                                <td>".$row["rdate"]."</td>
                                <td>".$row["time_zone"]."</td>
                                <td>".$row["table_number"]."</td>
                                <td>".$row["reg_date"]."</td>
                                <td><textarea class='comment-text' readonly>".$row["comment"]."</textarea></td>
                                <td class='table-danger'><button type='submit' name='delete-submit' class='btn-danger btn-sm cancel-btn'>Cancel</button></td>
                            </form>
                        </tr>
                    </tbody>";
                }   
                echo "</table>";
            } else {
                // Message when reservation list is empty
                echo "<p class='text-white text-center bg-danger'>Your reservation list is empty!<p>";
            }

            // Close database connection
            mysqli_close($connect);
        } else {
            // Message when user is not logged in
            echo '<p class="text-center text-danger"><br>You are currently not logged in!<br></p>
                  <p class="text-center">In order to make a reservation you have to create an account!<br><br><p>';   
        }    
        ?>
    </div>
    <br><br>
</body>
</html>
