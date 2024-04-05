<?php


//delete reservation

if(isset($_POST['delete-submit'])) {
 
 require 'header.php';
 
 $reservation_id = $_POST['reserv_id'];
    
 $sql = "DELETE FROM reservation WHERE reserv_id =$reservation_id";
if (mysqli_query($connect, $sql)) {
    header("Location: reservationinfo.php?delete=success");
} else {
    header("Location: reservationinfo.php?delete=error");
}
}



//delete tables




mysqli_close($conn);
?>

    


