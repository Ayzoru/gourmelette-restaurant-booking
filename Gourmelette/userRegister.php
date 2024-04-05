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
    <title>Gourmelette | Customer Register</title>
</head>
<body>
    <!--Back-End-->
    <?php
    //call file to connect server gourmelette
    include ("header.php");
    ?>

    <?php
    //This query inserts a record in the gourmelette table
    //has the form been submitted?
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $error = array(); //initialize an error array

        //check for a userName
        if (empty ($_POST['name']))
        {
            $error[] = 'You forgot to enter your name';
        }
        else
        {
            $n = mysqli_real_escape_string ($connect, trim ($_POST ['name']));
        }
        
        //check for a userEmail
        if (empty ($_POST['email']))
        {
            $error[] = 'You forgot to enter your email';
        }
        else
        {
            $e = mysqli_real_escape_string ($connect, trim ($_POST ['email']));
        }

        //check for a userPassword
        if (empty ($_POST['pass']))
        {
            $error[] = 'You forgot to enter the password';
        }
        else
        {
            $p = mysqli_real_escape_string ($connect, trim ($_POST ['pass']));
        }


        //register the user in the database
        //make the query
        $q = "INSERT INTO user (userPassword, userName, userEmail)
         VALUES ('$p', '$n', '$e')";
        $result = @mysqli_query ($connect, $q); //run the query
        if ($result) //if it run
        {
            //print a message
            echo '<script>alert("Successfully Registered! You may now login.")
            window.location.href = "login.php";</script>';
            
            exit();
        }
        else
        {
            //if it didn't run
            //message
            echo '<h1>System Error</h1>';
            //debugging message
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }//end of it (result)
    
        mysqli_close($connect); //close the database connection
        exit();
    } 
    //end of the main submit conditional
    ?>










    <!--Front-End-->
    <header>
        <div class="header">
            <div class="logo">
                <a href="home.html">
                    <img src="./images/GourmeletteWide2.jpeg" alt="gourmelttelogo">
                </a>
            </div>
            <div class="bar">
                <i class="fa-solid fa-bars"></i>
                <i class="fa-solid fa-xmark" id="hdcross"></i>
            </div>
            <div class="nav">
                <ul>
                    <a href="home.html">
                        <li>Gourmet Menu</li>
                    </a>

                    <a href="home.html">
                        <li>About Us</li>
                    </a>

                    <a href="home.html">
                        <li>Reserve Table</li>
                    </a>

                    <a href="home.html">
                        <li>Contact Us</li>
                    </a>

                    <a href="home.html">
                        <li>Account</li>
                    </a>
                </ul>
            </div>
            
        </div>
    </header>
    
    <!-- header section ends -->
    <section class="form-container">
        <form action="userRegister.php" method="post">
            <h3>Customer Register</h3>
            <input type="text" name="name" required placeholder="enter your name" class="box"
            maxlength="50">
            <input type="email" name="email" required placeholder="enter your email here" class="box"
            maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="Enter your password here" class="box" maxlength="60" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Must contain at least one number, one uppercase and lowercase letter, one special character, and at least 8 or more characters" oninput="this.value = this.value.replace(/\s/g, '')">

            <input type="submit" value="register" class="btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </section>
</body>
</html>