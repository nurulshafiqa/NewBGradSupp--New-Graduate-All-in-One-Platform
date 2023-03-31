<?php
// Database connection settings
@include 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewBGradSupp</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">

</head>
<body>

<!-- Navigation -->
<header class="header">

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <img src="img/logo.jpeg" alt="logo" height="45" style="margin-right:500px;" />

    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#services">Services</a>
    </nav>

    <div class="icons">
        <a href="index.php" class="fas fa-home"></a>
        <a href="login.php" class="fas fa-user"></a>
    </div>

</header>
<!-- Navigation end-->

<!--- Home section start -->
<section class="home" id="home">

    <div class="row"> 
        <div class="content">
            <h3>NewBGrad</h3>
            <span>Start your career here</span>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores molestiae, illo repudiandae aliquam,
            provident dolore sint pariatur nulla totam aspernatur consequatur! Doloribus sapiente nobis soluta ipsam inventore, 
            laborum provident nostrum.</p>
            <a href="login.php" class="btn">Sign In</a>
        </div>    
    </div>
    
</section>
<!--- Home section end -->

<!--- About section start -->
<section class="about" id="about">
    
    <h1 class="heading"> <span>about</span> us </h1>

    <div class="row">

        <div class="video-container">
            <video src="img/about.mp4" loop autoplay muted></video>
            <h3>Start your future</h3>
        </div>

        <div class="content">
            <h3>Why choose us?</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores molestiae, illo repudiandae aliquam,
            provident dolore sint pariatur nulla totam aspernatur consequatur! Doloribus sapiente nobis soluta ipsam inventore, 
            laborum provident nostrum.</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores molestiae, illo repudiandae aliquam,
            provident dolore sint pariatur nulla totam aspernatur consequatur! Doloribus sapiente nobis soluta ipsam inventore, 
            laborum provident nostrum.</p>
            <a href="login.php" class="btn">Learn more</a>
        </div>

    </div>
</section>
<!--- About section end -->


<!--- services start -->
<section class="services" id="services">

<h1 class="heading"> <span>Service</span> Provided</h1>

    <div class="row">

        <div class="icons">
            <img src="img/icon job.png" alt="">
            <div class="info">
                <h3>Search job</h3>
                <span>all job related</span>
            </div>
        </div>

        <div class="icons">
            <img src="img/icon salary.png" alt="">
            <div class="info">
                <h3>Salary Comparison</h3>
                <span>estimate your salary</span>
            </div>
        </div>

        <div class="icons">
            <img src="img/icon course.png" alt="">
            <div class="info">
                <h3>Training & skill suggestion</h3>
                <span>enhance your skill</span>
            </div>
        </div>
    </div>
    
</section>
<!--- services end -->

<!--- Footer start -->
<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>Quick links</h3>
            <a href="#">home</a>
            <a href="#">about</a>
            <a href="#">services</a>
        </div>

        <div class="box">
            <h3>Extra links</h3>
            <a href="login.php">My account</a>
        </div>

        <div class="box">
            <h3>Contact info</h3>
            <a href="#">+601-234-5678</a>
            <a href="#">NewBGrad@gmail.com</a>
            <a href="#">Gelugor, Penang, Malaysia</a>
        </div>

    </div>

    <hr class="light-100">
    <div class="credit"> NewBGrad@gmail.com <span> @ </span>| all rights reserved | </div>


</section>


</body>
</html>







