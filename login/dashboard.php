<?php
// Database connection settings
@include 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>My Website</title>
      <!-- Font Awesome CDN links -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

      <!-- Other CSS and JavaScript files -->
      <link rel="stylesheet" href="css/user_header.css">
      <script src="js/script.js"></script>
   </head>

<body>
      
   <header class="header" style="padding: 0.1px 1px;">

      <section class="flex">
        
        <img src="img/logo.jpeg" alt="logo" height="45" style="margin-right:500px;" />

         <div class="icons">
              <div id="menu-btn" class="fas fa-bars"></div>
              <div id="search-btn" class="fas fa-search"></div>
              <div id="user-btn" class="fas fa-user"></div>
             
         </div>
     
         <div class="profile">
             
              <div class="flex-btn">
                 <a href="login.php" class="option-btn">login</a>
                 <a href="register.php" class="option-btn">register</a>
              </div>
            
         </div>
     
      </section>
     
   </header>
     
     
     
   <div class="side-bar" style="background-color:purple; height: 100vh;
        width: 20rem;">
     
        <div class="close-side-bar">
           <i class="fas fa-times"></i>
        </div>
     
      
     
        <nav class="navbar" >
           <a href="dashboard.php" ><i class="fas fa-home" style="color:white;"></i><span style="color:white;font-size:14px;">Home</span></a>
           <a href="search.php"><i class="fa fa-briefcase"  style="color:white;"></i><span style="color:white;font-size:14px;">Search Job</span></a>
           <a href=""><i class="fa fa-calculator"  style="color:white;"></i><span style="color:white;font-size:14px;">Salary Comparison</span></a>
           <a href=""><i class="fas fa-chalkboard-user"  style="color:white;"></i><span style="color:white;font-size:14px;">Training Recommendation</span></a>
           <a href=""><i class="fas fa-question"  style="color:white;"></i><span style="color:white;font-size:14px;">About us</span></a>
           <a href=""><i class="fas fa-headset"  style="color:white;"></i><span style="color:white;font-size:14px;">Contact us</span></a>
           <a href="logout.php"><i class="fa fa-sign-out"  style="color:white;"></i><span style="color:white;font-size:14px;">Sign Out</span></a>
        </nav>

        <!-- search -->
        
     
   </div>


     

</body>
</html>