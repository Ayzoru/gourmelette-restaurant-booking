<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="yummy.css">
    <link rel="shortcut icon" href="./images/1stlogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!--Swiper cdn link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmelette | Admin Login</title>
</head>
<body>
    <!--Back-End-->
    <?php
    //call file to connect server gourmelette
    include ("header.php");
    ?>

    <?php
    //This section processes submission from the login form
    //Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD']== 'POST')
    {
    //Validate the userID
    if (!empty($_POST['email']))
    {
        $email = mysqli_real_escape_string($connect, $_POST['email']);
    }
    else
    {
        $email = FALSE;
        echo '<p class ="error"> You forgot to enter your email.</p>';
    }
    //validate the userPassword
    if (!empty($_POST['pass']))
    {
        $p = mysqli_real_escape_string($connect, $_POST['pass']);
    }
    else
    {
        $p = FALSE;
        echo '<p class ="error"> You forgot to enter your password.</p>';
    }

    //if no problems 
    if ($email && $p)
    {
        //Retrieve the userID, userPassword, userName, userPhoneNo, userEmail
        $q= "SELECT adminID, adminPassword, adminEmail FROM admin WHERE 
        (adminEmail = '$email' AND adminPassword = '$p')";

        //run the query and assign it to the variable result
        $result = mysqli_query($connect, $q);

        //count the number of rows that match the amdinID/userPassword combination 
        //if one database row (record) matches the input:
        if (@mysqli_num_rows($result)==1)
        {
            session_start();
            $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        //Redirect to home page
        header("Location: adminDashboard.php");
        
        //cancel the rest of the script

        mysqli_free_result($result);
        mysqli_close($connect);
        //no match was made
        exit();
    }
    else
    {
        echo '<script>alert("Invalid Login! The admin email address or admin password does not match any of our records.")
        window.location.href = "adminLogin.php";</script>';
        
    }

    //if there was a problem
    }
    else 
    {
        echo '<p class="error">Please try again.</p>';
    }
    mysqli_close($connect);
    }
    //end of submit conditional
    ?>

    <section class="admin-login form-container">
        <form action="adminLogin.php" method="post">
            <h3>Admin Login</h3>
            <input type="email" name="email" required placeholder="enter your email here" class="box"
            maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="enter your password here" class="box"
            maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="login" class="btn">
        </form>
    </section>
</body>
</html>