<?php

// Including header file
include 'header.php';

// Starting session
session_start();

// Getting admin ID from session
$admin_id = $_SESSION['adminID'];

// Redirecting to admin login page if admin ID is not set
if (!isset($admin_id)) {
    header('location: adminLogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmelette | Admin Dashboard</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="admin_style.css">

</head>

<body>

    <!-- Admin dashboard section starts  -->

    <section class="dashboard">

        <h1 class="heading">gourmelette admin dashboard</h1>

        <div class="box-container">

            <!-- Box displaying total admins -->
            <div class="box">
                <?php
                    // Query to count total admins
                    $select_admins = $connect->prepare("SELECT COUNT(*) FROM `admin`");
                    $select_admins->execute();
                    $result_admins = $select_admins->get_result();
                    $row_admins = $result_admins->fetch_assoc();
                    $numbers_of_admins = $row_admins['COUNT(*)'];
                ?>
                <!-- Displaying total admins -->
                <h3>Welcome!</h3>
                <p>Total admins: <?= $numbers_of_admins; ?></p>
                <!-- Button to view admins -->
                <a href="adminAccounts.php" class="btn">View Admins</a>
            </div>

            <!-- Box displaying total reservations -->
            <div class="box">
                <?php
                    // Query to count total reservations
                    $select_reservations = $connect->prepare("SELECT COUNT(*) FROM `reservation`");
                    $select_reservations->execute();
                    $result_reservations = $select_reservations->get_result();
                    $row_reservations = $result_reservations->fetch_assoc();
                    $numbers_of_reservations = $row_reservations['COUNT(*)'];
                ?>
                <!-- Displaying total reservations -->
                <h3><?= $numbers_of_reservations; ?></h3>
                <p>Total bookings</p>
                <!-- Button to view bookings -->
                <a href="seebookings.php" class="btn">View Bookings</a>
            </div>

            <!-- Box displaying total users -->
            <div class="box">
                <?php
                    // Query to count total users
                    $select_users = $connect->prepare("SELECT COUNT(*) FROM `user`");
                    $select_users->execute();
                    $result_users = $select_users->get_result();
                    $row_users = $result_users->fetch_assoc();
                    $numbers_of_users = $row_users['COUNT(*)'];
                ?>
                <!-- Displaying total users -->
                <h3><?= $numbers_of_users; ?></h3>
                <p>User accounts</p>
                <!-- Button to view users -->
                <a href="useraccount.php" class="btn">See Users</a>
            </div>

        </div>

    </section>

    <!-- Button to logout and return to home -->
    <div class="back-button">
        <a href="home.html" class="btn">Logout and Return to Home</a>
    </div>

    <!-- Admin dashboard section ends -->

    <!-- Custom JavaScript file link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
