<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `student` WHERE student_email = ? AND student_password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
     setcookie('user_id', $row['STUDENT_ID'], time() + 60*60*24*30, '/');
     header('location:home.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/login.css">

</head>

<body>


<header class="header" style="padding: 0.1px 1px;width:100%;">

   <section class="flex">
   
 
      
   <img src="images/logonew.png" alt="logo" height="45" style="margin-right:950px;" />
 
   <!-- <a href="" class="logo" style="font-size: 14px;margin-right:1000px;">NewBGradSupp</a>  -->

    
   <div class="icons">
   <a href="index.php"> <div id="home-btn" class="fa fa-home" ></div></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <!-- <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `student` WHERE STUDENT_ID = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="images/<?= $fetch_profile['STUDENT_IMAGE']; ?>" alt="">
         <h3><?= $fetch_profile['STUDENT_NAME']; ?></h3>
         <span>student</span>
         <a href="updatestudent.php" class="btn">view profile</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
         <a href="components/logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         <?php
           // }else{
         ?>
         <h3 style="font-size: 14px;">Sign In or Sign Up</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn" >Sign In</a>
            <a href="register.php" class="option-btn">Sign Up</a>
         </div>
         <?php
            }
         ?>
      </div> -->

      


   </section>

</header>

<style>
     body{
      background-color: lavender;
     }
      form{
         background-color:white;
          width: 150%;
          height: 100%;
          /* margin: 2px 2px; */
          border-radius: 10px;
          border-color: 10px solid grey;
      }
      h1{
         padding-bottom: 1.8rem;
         border-bottom: var(--border);
         font-size: 2.5rem;
         color: var(--black);
         text-transform: capitalize;
         margin-bottom: 3rem;
      }

   
      input[type="email"]{
          display: block;
          border: 2px solid lavender;
          background-color: var(--light-bg);
          width: 95%;
          padding: 8px;
          /* margin-left:10px; */
          outline: none;
          font-size: 13px;
      }
      input[type="password"]{
          display: block;
          border: 2px solid lavender;
          background-color: var(--light-bg);
          width: 95%;
          padding: 8px;
          /* margin: 2px auto; */
          outline: none;
          font-size: 15px;
      }


      #studemail, #studpass{

          width: 95%;
          padding: 8px;
          /* margin: 2px auto; */
          padding: 12px 20px;
          box-sizing: border-box;
          border: 2px solid lavender;
          background-color: var(--light-bg);
          resize: none;
          font-size: 13px;
      }
   
      #studemail:hover, #studpass:hover{
          border-color: blue;
      }
      </style>





<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="login">
   <h1 style="margin-left:30px;font-size:18px;text-transform:capitalize;color:purple; padding-bottom: 3rem;padding-top:3rem;">Welcome to NewBGradSupp. Please Sign In.</h1>
      <!-- <h3 style="font-size: 16px; font-weight:bold; color:purple;">Welcome to NewBGradSupp. Please Sign In.</h3> -->
      <p style="font-size: 15px; font-weight:bold;color:black;">Email <span>*</span></p>
      <input type="email" name="email" id="studemail" placeholder="Enter Your Email" maxlength="100" required class="box">
      <p style="font-size: 15px; font-weight:bold;color:black;">Password <span>*</span></p>
      <input type="password" name="pass" id="studpass" placeholder="Enter Your Password" maxlength="50" required class="box">
      <p class="link"  style="font-size: 14px;">Don't have an account? </p>
      <p style="font-size: 15px; text-align:center;"><a href="register.php"  >Click to create an account now</a></p>
      <br><br>
      <input type="submit" name="submit" value="Sign In" class="btn" style="width:30%;float:right;">
   </form>

</section>












<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>