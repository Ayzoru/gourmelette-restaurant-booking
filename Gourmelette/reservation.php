<?php
// Start the session
session_start();

// Include the header file
include 'header.php';
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
    <title>Gourmelette | Home</title>
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
                    <a href="#g-category">
                        <li>Gourmet Menu</li>
                    </a>

                    <a href="#about">
                        <li>About Us</li>
                    </a>

                    <a href="reservetable.php">
                        <li>Reserve Table</li>
                    </a>

                    <a href="#contacts">
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
                    <button type="submit" name="logout-submit" class="btn2 btn-outline-dark logout">Logout</button>
                    </form>';
                    }
                    
                    ?>


                </ul>
            </div>
        </div>
    </header>


    <section class="home">
        <div class="swiper main_slide">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>Gourmet Style</span>
                        <h3>Egg dishes recreated in a fancy way</h3>
                        <a href="#g-category" class="btn">View Menu</a>
                    </div>
                    <div class="image">
                        <img src="./images/EggDish1.png" alt="">
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="content">
                        <span class="reservetext">Reserve a table now</span>
                        <h3 class="comfytext">comfortable dining space</h3>
                        <a href="reservetable.php" class="btn">Reserve Now</a>
                    </div>
                    <div class="image">
                        <img src="./images/diningtable.png" alt="">
                    </div>
                </div>

                <div class="swiper-slide slide" >
                    <div class="content">
                        <span>Available 24/7</span>
                        <h3>view and book anytime, anywhere</h3>
                        <a href="#contacts" class="btn">Contact Us</a>
                    </div>
                    <div class="image">
                        <img src="./images/eggburger.png" alt="">
                    </div>
                </div>
            </div>
            <!--
            <div>
                
                <h1>Egg dishes recreated in a fancy way!</h1>
                <p>Is this your first time here? We serve the best egg dishes but created with style</p>

                <button class="trynow">Try Now</button>
            </div>
            <div>
                <img src="./images/EggDish1.jpeg" alt="">
            </div>
            -->
            <div class="swiper-pagination"></div>

        </div>
    </section>

    <!--About us Section-->


    <section class="aboutus" id="about">
        <div class="container">
            <h3 class="text-center">Gourmelette</h3>
            <div class="row">
        <!--Carousel Slide-->
        <div class="col-sm"><br><br>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
           <ol class="carousel-indicators">
             <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
             <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
             <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
           </ol>
          <div class="carousel-inner">
             <div class="carousel-item active">
               <img class="d-block w-100" src="./images/1stlogo.png" alt="First slide">
             </div>
             <div class="carousel-item">
             <img class="d-block w-100" src="./images/friedrice.jpeg" alt="Second slide">
             </div>
             <div class="carousel-item">
             <img class="d-block w-100" src="./images/EggDish1.jpeg" alt="Third slide">
             </div>
          </div>
           <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="sr-only">Previous</span>
           </a>
           <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="sr-only">Next</span>
           </a>
         </div><br><br>
       </div>
  
  <!--end of carousel-->
        <div class="col-sm">
            <div class="arranging"><br><hr>
                <h4 class="text-center">About Us</h4>
                <p class="story"><br>Welcome to Gourmelette, your ultimate destination for egg-styled culinary delights! 
                    Our journey began with a simple love for eggs and the infinite possibilities they present 
                    in the culinary world. From hearty main courses to delectable desserts, our menu is a testament 
                    to the versatility and deliciousness of eggs.<br><br> Each dish at Gourmelette is crafted with 
                    passion, creativity, and a commitment to quality, offering a unique dining experience that 
                    celebrates the humble egg in all its glory. Whether you’re an egg enthusiast or a curious foodie, 
                    we invite you to join us at Gourmelette and explore the world of egg-styled dishes like never
                     before. Bon Appétit!



                    <br><br><br></p><hr>
            </div>
        </div>
            </div><br>
        </div>
    </section>

    <div class="video-section">
        <h3 class="title">User Manual</h3>
        <video controls class="video1">
            <source src="./video/Gourmelette _ Home - Google Chrome 2024-04-05 03-58-25.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>





    <!-- Gourmet Categories -->
    <section class="gcategory" id="g-category">
        <h1 class="title">Gourmet Category</h1>

        <div class="box-container">
            <div class="box">
                <a href="#osavoury">
                    <img src="./images/main-dish.png" alt="">
                    <h3>Omelette Savoury</h3>
                </a>
            </div>
            <div class="box">
                <a href="#bev">
                    <img src="./images/beverages.png" alt="">
                    <h3>Beverages</h3>
                </a>
            </div>
            <div class="box">
                <a href="#dess">
                    <img src="./images/desserts.png" alt="">
                    <h3>Desserts</h3>
                 </a>
            </div>
        </div>

    </section>
    <!-- Gourmet Categories End  -->

    <!-- Menu Section  -->
    <section class="menu">
    <div class="omelettesavoury" id="osavoury">
        <h1 class="title">Omelette Savoury</h1>
        
        <div class="box-container">

            <div class="box">
                <img src="./images/caramel.jpeg" alt="">
                <div class="cat">Classic Gourmelette</div>
                <div class="name">Our classic breakfast dish</div>
            </div>

            <div class="box">
                <img src="./images/friedrice.jpeg" alt="">
                <div class="cat">Gourmelette Fried Rice</div>
                <div class="name">Fried rice with omelette</div>
            </div>

            <div class="box">
                <img src="./images/spaghetti.jpeg" alt="">
                <div class="cat">Eggscelent Spaghetti</div>
                <div class="name">Spaghetti carbonara with our classic egg</div>
            </div>

            <div class="box">
                <img src="./images/burger.jpeg" alt="">
                <div class="cat">Gourmelette Burger</div>
                <div class="name">Our classic burger with gourmet style egg</div>
            </div>
     
     

        </div>

    </div>

    <div class="beverages" id="bev">
        <h1 class="title">Beverages</h1>
        
        <div class="box-container">

            <div class="box">
                <img src="./images/milkshake.jpeg" alt="">
                <div class="cat">Chocolate Milkshake</div>
                <div class="name">Creamy chocolate milkshake</div>
            </div>

            <div class="box">
                <img src="./images/orangejuice.jpeg" alt="">
                <div class="cat">Orange Juice</div>
                <div class="name">Classic orange juice</div>
            </div>

            <div class="box">
                <img src="./images/tea.jpeg" alt="">
                <div class="cat">Tea</div>
                <div class="name">Hot Tea for chilly days</div>
            </div>

            <div class="box">
                <img src="./images/carrot.jpeg" alt="">
                <div class="cat">Carrot Juice</div>
                <div class="name">Sweet milky carrot juice</div>
            </div>
     
     

        </div>

    </div>

    <div class="desserts" id="dess">
        <h1 class="title">Desserts</h1>
        
        <div class="box-container">

            <div class="box">
                <img src="./images/cake1.jpeg" alt="">
                <div class="cat">Orange Cake</div>
                <div class="name">Orange Cake with whipped cream</div>
            </div>

            <div class="box">
                <img src="./images/cake2.jpeg" alt="">
                <div class="cat">Strawberry-Choc</div>
                <div class="name">Chocolate cake with strawberry topping</div>
            </div>

            <div class="box">
                <img src="./images/cake3.jpeg" alt="">
                <div class="cat">Vanilla Cake</div>
                <div class="name">Creamy vanilla butter cake</div>
            </div>

            <div class="box">
                <img src="./images/cake4.jpeg" alt="">
                <div class="cat">Blueberry Cheesecake</div>
                <div class="name">Cheesecake with fruity toppings</div>
            </div>
     
     

        </div>

    </div>

    </section>
    <!-- Menu Section End  -->

      <!-- Background Music -->
      <section class="audio">
        <div class="title">Our Background Music</div>
        <audio controls src="./audio/gourmelette-bgm.mp3" class="audio1"></audio>
    </section>

    <!-- Contact Us -->
    <footer class="footer" id="contacts">

        <section class="box-container">
     
           <div class="box">
 
              <h3>our email</h3>
              <a href="mailto:gourmelette@gmail.com">gourmelette@gmail.com</a>
              <a href="mailto:aizul@gmail.com">aizul@gmail.com</a>
           </div>
     
           <div class="box">

              <h3>opening hours</h3>
              <p>9:00am to 10:00pm </p>
           </div>
     
           <div class="box">

              <h3>address</h3>
              <a href="https://www.google.com/maps">rome, italy</a>
           </div>
     
           <div class="box">

              <h3>our number</h3>
              <a href="tel:011-27162832">011-27162832</a>
              <a href="tel:022-31235212">022-31235212</a>
           </div>
     
        </section>
     
        <div class="credit">&copy; copyright @ 2024 by <span>aizulfadhli</span> | all rights reserved!</div>
     
     </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".main_slide", {
            loop:true,
            pagination: {
            el: ".swiper-pagination",
            clickable:true,
            },
            });
    </script>

    <!--Script for Carousel-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>