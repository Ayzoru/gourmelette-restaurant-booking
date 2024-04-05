<?php

include 'header.php';

session_start();

$admin_id = $_SESSION['adminID'];

if (!isset($admin_id)) {
    header('location:adminLogin.php');
}

$search = '';
if (isset($_POST['search'])) {
    $search = '%' . $_POST['search'] . '%';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = $connect->prepare("DELETE FROM `user` WHERE `userID` = ?");
    $delete_query->bind_param("i", $delete_id);
    if ($delete_query->execute()) {
        // Redirect to the same page after deletion
        header('Location: useraccount.php');
        exit();
    } else {
        // Display error message if deletion fails
        echo "Error: Unable to delete user.";
    }
}

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $new_username = $_POST['new_username'];
    $new_userEmail = $_POST['new_userEmail'];
    $new_userPassword = $_POST['new_userPassword'];

    // Perform the update operation using an SQL query
    $update_query = $connect->prepare("UPDATE `user` SET userName = ?, userEmail = ?, userPassword = ? WHERE userID = ?");
    $update_query->bind_param("sssi", $new_username, $new_userEmail, $new_userPassword, $user_id);
    if ($update_query->execute()) {
        echo "<script>alert('User Details Successfully Updated');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmelette | User Accounts</title>
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="admin_style.css">
</head>

<body>



    <section class="accounts">
        <h1 class="heading">Users Account</h1>
        <div class="box-container">
                <!-- Search form -->
        <form method="POST" action="" class="search-form">
            <input type="text" name="search" placeholder="Search user" value="<?= $_POST['search'] ?? ''; ?>">
            <input type="submit" value="Search">
        </form>

            <?php
            $select_account = $connect->prepare("SELECT * FROM `user` WHERE `userName` LIKE ?");
            $select_account->bind_param("s", $search);
            $select_account->execute();
            $result = $select_account->get_result();
            if ($result->num_rows > 0) {
                while ($fetch_accounts = $result->fetch_assoc()) {
            ?>
                    <div class="box">
                        <form action="" method="POST">
                            <p>User ID: <span><?= $fetch_accounts['userID']; ?></span></p>
                            <div class="input-group">
                                <label for="new_username">Username:</label>
                                <input type="text" name="new_username" value="<?= $fetch_accounts['userName']; ?>">
                            </div>
                            <div class="input-group">
                                <label for="new_userEmail">User Email:</label>
                                <input type="email" name="new_userEmail" value="<?= $fetch_accounts['userEmail']; ?>">
                            </div>
                            <div class="input-group">
                                <label for="new_userPassword">User Password:</label>
                                <input type="text" name="new_userPassword" value="<?= $fetch_accounts['userPassword']; ?>">
                            </div>
                            <input type="hidden" name="user_id" value="<?= $fetch_accounts['userID']; ?>">
                            <input type="submit" name="update" value="Update" class="btn">
                        </form>
                        <a href="useraccount.php?delete=<?= $fetch_accounts['userID']; ?>" class="delete-btn" onclick="return confirm('Delete this account?');">Delete</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No accounts available</p>';
            }
            ?>

        </div>
    </section>

    <div class="back-button">
        <a href="adminDashboard.php" class="btn">Back</a>
    </div>

    <!-- Custom JavaScript file link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
