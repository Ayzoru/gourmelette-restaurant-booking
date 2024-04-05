<?php

include 'header.php';

session_start();

$admin_id = $_SESSION['adminID'];

if (!isset($admin_id)) {
    header('location: adminLogin.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_admin = $connect->prepare("DELETE FROM `admin` WHERE adminID = ?");
    $delete_admin->bind_param("i", $delete_id); // Bind parameter
    $delete_admin->execute();
    // Display confirmation popup and then show success message
    echo "<script>
        if (confirm('Admin Account Successfully Deleted')) {
            window.location.href = 'adminAccounts.php';
        }
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmelette | Admin Accounts</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="admin_style.css">

</head>

<body>

    <!-- admins accounts section starts  -->

    <section class="accounts">

        <h1 class="heading">admins account</h1>

        <div class="box-container">

            <div class="box">
                <p>register new admin</p>
                <a href="adminRegister.php" class="option-btn">register</a>
            </div>

            <?php
            $select_account = $connect->prepare("SELECT * FROM `admin`");
            $select_account->execute();
            $select_account->store_result(); // Store result
            if ($select_account->num_rows > 0) { // Use num_rows to check the number of rows
                $select_account->bind_result($adminID, $name, $id); // Bind result variables
                while ($select_account->fetch()) {
            ?>
                    <div class="box">
                        <p> admin id : <span><?= $adminID; ?></span> </p>
                        <p> email : <span><?= $name; ?></span> </p>
                        <div class="flex-btn">
                            <a href="adminAccounts.php?delete=<?= $adminID; ?>" class="delete-btn" onclick="return confirm('Delete this account?');">delete</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no accounts available</p>';
            }
            ?>

        </div>

    </section>

    <div class="back-button">
        <a href="adminDashboard.php" class="btn">Back</a>
    </div>


    <!-- admins accounts section ends -->

    <!-- custom js file link  -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
