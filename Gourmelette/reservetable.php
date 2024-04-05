<?php
// Start the session
session_start();

// Include the header file
include 'header.php';

//between function
function between($val, $x, $y){
    $val_len = strlen($val);
    return ($val_len >= $x && $val_len <= $y)?TRUE:FALSE;
}

if(isset($_POST['reserv-submit'])) { 

    $user= $_SESSION['userID'];
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $date= $_POST['date'];
    $time= $_POST['time'];
    $guests= $_POST['num_guests'];
    $tele = $_POST['tele'];
    $comments = $_POST['comments'];
    
    if($guests==1 || $guests==2){
        $tables=1;
    }  
    else{
    $tables=ceil(($guests-2)/2);
    }

    $table = $_POST['selectedTable']; //Get the selected table from the form data
    
    if(empty($fname) || empty($lname) || empty($date) || empty($time) || empty($guests) || empty($tele)) {
        header("Location: reservetable.php?error3=emptyfields");
        exit();
    }
        else if(!preg_match("/^[a-zA-Z ]*$/", $fname) || !between($fname,2,20)) {
        header("Location: reservetable.php?error3=invalidfname");
        exit();
    }
        else if(!preg_match("/^[a-zA-Z ]*$/", $lname) || !between($lname,2,40)) {
        header("Location: reservetable.php?error3=invalidlname");
        exit();
    }
        else if(!preg_match("/^[0-9]*$/", $guests) || !between($guests,1,3)) {
        header("Location: reservetable.php?error3=invalidguests");
        exit();
    }
        else if(!preg_match("/^[a-zA-Z0-9]*$/", $tele) || !between($tele,6,20)) {
        header("Location: reservetable.php?error3=invalidtele");
        exit();
    }    
        else if(!preg_match("/^[a-zA-Z 0-9]*$/", $comments) || !between($comments,0,200)) {
        header("Location: reservetable.php?error3=invalidcomment");
        exit();
    }
    



    

    else{
        $sql = "SELECT COUNT(*) FROM reservation WHERE rdate='$date' AND time_zone='$time' AND table_number='$tables'";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_reservations = $row["COUNT(*)"];
        }
        
        
    //Checks the number of reservations compare with table nummbers
    
    if ($current_reservations >= $tables) {
        header("Location: reservetable.php?error3=full");
    }
          
           
    
    else {
    
         $sql = "INSERT INTO reservation(f_name, l_name, num_guests, num_tables, rdate, time_zone, telephone, comment, user_fk, table_number) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($connect);
                 if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: reservetable.php?error3=sqlerror1");
                    exit();
                }
                else {       
                    mysqli_stmt_bind_param($stmt, "ssssssssss", $fname, $lname, $guests, $tables, $date, $time, $tele, $comments, $user, $table);
                    mysqli_stmt_execute($stmt);
                    header("Location: reservetable.php?reservation=success");
                    exit();
                }
        }
    }
    
   mysqli_stmt_close($stmt);
   mysqli_close($connect);
}




?>



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
    <title>Gourmelette | Reserve Table</title>
</head>
<body>
    
    <header>
        <div class="header">
            <div class="logo">
                <a href="reservation.php">
                    <img src="./images/GourmeletteWide2.jpeg" alt="gourmelttelogo">
                </a>
            </div>
            <div class="bar">
                <i class="fa-solid fa-bars"></i>
                <i class="fa-solid fa-xmark" id="hdcross"></i>
            </div>
            <div class="nav">
                <ul>
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
                    //log out button when user is logged in
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
    
    <div class="container">
        <h3 class="text-center"><br>New Reservation Form</h3>
        <div class="row">
            <div class="col-md 6 offset-md3">
                
            <?php
                if(isset($_SESSION['userID'])){
                    echo '<p class="text-white bg-dark text-center">Welcome '. $_SESSION['userName'] .', Create your reservation here!</p>';
                    
                //error handling:
                    
                    if(isset($_GET['error3'])){
                        if($_GET['error3'] == "emptyfields") {   //douleuei bazw ta errors apo ta headers.. prp na bgalw to requiered
                            echo '<h5 class="bg-danger text-center">Fill all fields, Please try again!</h5>';
                        }
                        else if($_GET['error3'] == "invalidfname") {   
                            echo '<h5 class="bg-danger text-center">Invalid First Name, Please try again!</h5>';
                        }
                        else if($_GET['error3'] == "invalidlname") {   
                            echo '<h5 class="bg-danger text-center">Invalid Last Name, Please try again!</h5>';
                        }
                        else if($_GET['error3'] == "invalidtele") {   
                            echo '<h5 class="bg-danger text-center">Invalid Telephone, Pleast try again!</h5>';
                        }
                        else if($_GET['error3'] == "invalidcomment") {   
                            echo '<h5 class="bg-danger text-center">Invalid Comment, Pleast try again!</h5>';
                        }
                        else if($_GET['error3'] == "invalidguests") {   
                            echo '<h5 class="bg-danger text-center">Invalid Guests, Pleast try again!</h5>';
                        }
                        else if($_GET['error3'] == "full") {   
                            echo '<h5 class="bg-danger text-center">Reservations are full this date and timezone, Please try again!</h5>';
                        }
                    }
                        if(isset($_GET['reservation'])) {   
                        if($_GET['reservation'] == "success"){ 
                            echo '<h5 class="bg-success text-center">Your reservation was successfull!</h5>';
                        }
                        }
                        echo'<br>';



                    

                    
                    
                    //reservation form  
                    echo '  
                        
                    <div class="signup-form">
                        <form action="reservetable.php" method="post">
                            <div class="form-group">
                            <label>First Name</label>
                                <input type="text" class="form-control" name="fname" placeholder="First Name" required="required">
                                <small class="form-text text-muted">First name must be 2-20 characters long</small>
                            </div>
                            <div class="form-group">
                            <label>Last Name</label>
                                <input type="text" class="form-control" name="lname" placeholder="Last Name" required="required">
                                <small class="form-text text-muted">Last name must be 2-20 characters long</small>
                            </div>   
                            <div class="form-group">
                            <label>Enter Date</label>
                            <input type="date" class="form-control" name="date" placeholder="Date" required="required">
                            </div>
                            <div class="form-group">
                                <label>Choose Preferred Dining Time</label>
                                <select class="form-control" name="time">
                                <option>10:00 - 12:00</option>
                                <option>12:00 - 16:00</option>
                                <option>16:00 - 10:00</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <label>Enter number of Guests</label>
                            <input type="number" class="form-control" min="1" name="num_guests" placeholder="Guests" required="required">
                                <small class="form-text text-muted">Minimum value is 1</small>
                            </div>

                            <div class="form-group">
                            <label for="guests">Enter your Telephone Number</label>
                                <input type="telephone" class="form-control" name="tele" placeholder="Telephone" required="required">
                                <small class="form-text text-muted">Telephone must be 6-20 characters long</small>
                            </div>
                            <div class="form-group">
                            <label>Enter extra Comments</label>
                                <textarea class="form-control" name="comments" placeholder="Comments" rows="3"></textarea>
                                <small class="form-text text-muted">Comments must be less than 200 characters</small>
                            </div>  
                            
                            <input type="hidden" id="selectedTable" name="selectedTable">

                            <h3 class="text-center">Select Table</h3>
                            <div class="tables">
                                <div class="table" onclick="bookTable(this)" data-table-number="1" data-booked="false">
                                    <img src="./images/table2.png" alt="Dining Table 1">
                                </div>

                                <div class="table" onclick="bookTable(this)" data-table-number="2" data-booked="false">
                                    <img src="./images/table4.png" alt="Dining Table 2">
                                </div>

                                <div class="table" onclick="bookTable(this)" data-table-number="3" data-booked="false">
                                    <img src="./images/table2.png" alt="Dining Table 3">
                                </div>

                                <div class="table" onclick="bookTable(this)" data-table-number="4" data-booked="false">
                                    <img src="./images/table4.png" alt="Dining Table 4">
                                </div>

                                <div class="table" onclick="bookTable(this)" data-table-number="5" data-booked="false">
                                    <img src="./images/table2.png" alt="Dining Table 5">
                                </div>

                                <div class="table" onclick="bookTable(this)" data-table-number="6" data-booked="false">
                                    <img src="./images/table4.png" alt="Dining Table 6">
                                </div>
                            </div>

      
                            <div class="form-group">
                            <button type="submit" name="reserv-submit" class="btn btn-dark btn-lg btn-block">Submit Reservation</button>
                            </div>
                        </form>
                        <br><br>
                    </div>
                    ';  
                    }

                    else {
                        echo '	<p class="text-center text-danger"><br>You are currently not logged in!<br></p>
                    <p class="text-center">In order to make a reservation you have to create an account!<br><br><p>';  
                        
                    }
            ?>




            </div>
        </div>
    </div>
        
    <script>
         function bookTable(table) {
    var isBooked = table.getAttribute('data-booked'); // Get the booked status of the table
    if (isBooked === 'true') {
        alert('This table is booked! Please select another table.'); // Display a popup if the table is booked
        return;
    }
    
    table.classList.toggle('booked');
    var tableNumber = table.getAttribute('data-table-number'); // Get the table number from the data attribute
    document.getElementById('selectedTable').value = tableNumber; // Set the hidden input field to the selected table number
    
    // Update the booked status of the table
    if (isBooked === 'false') {
        table.setAttribute('data-booked', 'true');
    } else {
        table.setAttribute('data-booked', 'false');
    }
}
    </script>
   
</body>
</html>