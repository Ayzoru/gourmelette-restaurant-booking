<?php

include 'header.php';

session_start();

$admin_id = $_SESSION['adminID'];

if (!isset($admin_id)) {
    header('location: adminLogin.php');
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = sha1($_POST['pass']);

    $select_admin = $connect->prepare("SELECT * FROM `admin` WHERE adminEmail = ?");
    $select_admin->bind_param("s", $email);
    $select_admin->execute();
    $result = $select_admin->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Admin email already exists!');</script>";
    } else {
        $insert_admin = $connect->prepare("INSERT INTO `admin`(adminEmail, adminPassword) VALUES(?,?)");
        $insert_admin->bind_param("ss", $email, $pass);
        $insert_admin->execute();
        // Display popup message
        echo "<script>alert('New Admin Registered Successfully');</script>";
        // Delay the redirection by 1 second
        echo "<script>setTimeout(function(){ window.location.href = 'adminDashboard.php'; }, 1000);</script>";
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmelette | Admin Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="admin_style.css">

</head>

<body>

    <!-- register admin section starts  -->

    <section class="form-container">

        <form action="" method="POST">
            <h3>Register New Admin</h3>
            <input type="email" name="email" required placeholder="Enter your email" class="box">
            <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="60" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Must contain at least one number, one uppercase and lowercase letter, one special character, and at least 8 or more characters" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Register Now" name="submit" class="btn">
        </form>

    </section>

    <div class="back-button">
        <a href="adminDashboard.php" class="btn">Back</a>
    </div>

    <!-- register admin section ends -->

    <!-- custom js file link  -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
