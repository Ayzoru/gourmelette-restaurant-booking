<?php

include 'header.php';

session_start();

$admin_id = $_SESSION['adminID'];

if (!isset($admin_id)) {
    header('location: adminLogin.php');
    exit(); // Add an exit here to stop further execution if not logged in
}

// Delete reservation if 'delete' parameter is present in the URL
if (isset($_GET['delete'])) {
    $reservation_id = $_GET['delete'];
    $delete_query = $connect->prepare("DELETE FROM `reservation` WHERE reserv_id = ?");
    $delete_query->bind_param("i", $reservation_id);
    if ($delete_query->execute()) {
        // Redirect to the same page after deletion
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Display error message if deletion fails
        echo "Error: Unable to delete reservation.";
    }
}

if (isset($_POST['update_info'])) {
    // Retrieve form data
    $new_fname = $_POST['f_name'];
    $new_lname = $_POST['l_name'];
    $new_number = $_POST['telephone']; // Assuming this is the correct column name
    $new_reservation_date = $_POST['rdate'];
    $new_time_zone = $_POST['time_zone'];
    $new_guests = $_POST['num_guests'];
    $new_table_number = $_POST['table_number'];
    $customer_id = $_POST['customer_id'];

    // Perform the update operation using an SQL query
    $update_query = $connect->prepare("UPDATE `reservation` SET f_name = ?, l_name = ?, telephone = ?, rdate = ?, time_zone = ?, num_guests = ?, table_number = ? WHERE reserv_id = ?");
    $update_query->bind_param("ssssisii", $new_fname, $new_lname, $new_number, $new_reservation_date, $new_time_zone, $new_guests, $new_table_number, $customer_id);
    $update_query->execute();
}

if (isset($_POST['search'])) {
    $search_term = '%' . $_POST['search_term'] . '%';
    $search_query = $connect->prepare("SELECT * FROM `reservation` WHERE f_name LIKE ? OR l_name LIKE ?");
    $search_query->bind_param("ss", $search_term, $search_term);
    $search_query->execute();
    $result = $search_query->get_result();
} else {
    // Fetch all reservations from the database if no search is performed
    $select_reservations = $connect->prepare("SELECT * FROM `reservation`");
    $select_reservations->execute();
    $result = $select_reservations->get_result();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmelette | View Bookings</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="admin_style.css">

</head>

<body>

    <!-- Reservation Information section starts  -->

    <section class="reservation-info">

        <h1 class="heading">Reservation Information</h1>

        <!-- Search form -->
        <form action="" method="POST" class="search-form">
            <input type="text" name="search_term" placeholder="Search by username" value="<?= $_POST['search'] ?? ''; ?>">
            <!-- Change the button type to "submit" -->
            <button type="submit" name="search">Search</button>
        </form>

        <div class="box-container">

            <?php
            if ($result->num_rows > 0) {
                while ($fetch_reservation = $result->fetch_assoc()) {
            ?>
                    <div class="box">
                        <form action="" method="POST">
                            <p>Customer First Name: <input type="text" name="f_name" value="<?= $fetch_reservation['f_name']; ?>"></p>
                            <p>Customer Last Name: <input type="text" name="l_name" value="<?= $fetch_reservation['l_name']; ?>"></p>
                            <p>Customer Number: <input type="text" name="telephone" value="<?= $fetch_reservation['telephone']; ?>"></p>
                            <p>Reservation Date: <input type="text" name="rdate" value="<?= $fetch_reservation['rdate']; ?>"></p>
                            <p>Time Zone: <input type="text" name="time_zone" value="<?= $fetch_reservation['time_zone']; ?>"></p>
                            <p>Number of Guests: <input type="text" name="num_guests" value="<?= $fetch_reservation['num_guests']; ?>"></p>
                            <p>Table Number: <input type="text" name="table_number" value="<?= $fetch_reservation['table_number']; ?>"></p>
                            <!-- Retain other customer details -->
                            <p>Registered Date: <?= $fetch_reservation['reg_date']; ?></p>
                            <p>Comments: <?= $fetch_reservation['comment']; ?></p>
                            <input type="hidden" name="customer_id" value="<?= $fetch_reservation['reserv_id']; ?>">
                            <div class="flex-btn">
                                <input type="submit" value="Update" class="btn" name="update_info">
                                <a href="seebookings.php?delete=<?= $fetch_reservation['reserv_id']; ?>" class="delete-btn" onclick="return confirm('Delete this boking?');">delete</a>
                            </div>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No reservations found!</p>';
            }
            ?>

        </div>

    </section>

    <div class="back-button">
        <a href="adminDashboard.php" class="btn">Back</a>
    </div>

    <!-- Reservation Information section ends -->

    <!-- custom js file link  -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
