<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'images/'.$rename;

   $select_user = $conn->prepare("SELECT * FROM `student` WHERE student_email = ?");
   $select_user->execute([$email]);
   
   if($select_user->rowCount() > 0){
      $message[] = 'email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `student`(student_id, student_name, student_email, student_password, student_image) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         
         $verify_user = $conn->prepare("SELECT * FROM `student` WHERE student_email = ? AND student_password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);
         
         if($verify_user->rowCount() > 0){
            setcookie('user_id', $row['student_id'], time() + 60*60*24*30, '/');
            header('location:login.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

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

      <div class="profile">
         
         <h3 style="font-size: 14px;">Sign In or Sign Up</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn" >Sign In</a>
            <a href="register.php" class="option-btn">Sign Up</a>
         </div>
         <?php
            
         ?>
      </div>


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
      #file1{
          display: block;
          border: 2px solid lavender;
          background-color: var(--light-bg);
          width: 95%;
          padding: 8px;
          /* margin: 2px auto; */
          outline: none;
          font-size: 15px;
      }

      #studname{
          display: block;
          border: 2px solid lavender;
          background-color: var(--light-bg);
          width: 95%;
          padding: 8px;
          /* margin: 2px auto; */
          outline: none;
          font-size: 15px;
      }


      #studemail, #studpass, #cstudpass, #studname, #file1{

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
   
      #studemail:hover, #studpass:hover, #cstudpass:hover, #studname:hover, #file1:hover{
          border-color: blue;
      }
      </style>
<section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
   <h1 style="text-align:center;margin-left:30px;font-size:18px;text-transform:capitalize;color:purple; padding-bottom: 3rem;padding-top:3rem;">Welcome to NewBGradSupp. Sign Up for an account now.</h1>
   <p style="font-size: 15px; font-weight:bold;color:black;">Name <span>*</span></p>
   <input type="text" name="name" id="studname" placeholder="Enter Your Full Name" maxlength="200" required class="box">
   <p style="font-size: 15px; font-weight:bold;color:black;">Email <span>*</span></p>
   <input type="email" name="email" id="studemail" placeholder="Enter Your Email" maxlength="100" required class="box">
   <p style="font-size: 15px; font-weight:bold;color:black;">Password <span>*</span></p>
   <input type="password" name="pass" id="studpass" placeholder="Enter Your Password" maxlength="50" required class="box">
   <p style="font-size: 15px; font-weight:bold;color:black;">Confirm Password <span>*</span></p>
   <input type="password" name="cpass" id="studpass" placeholder="confirm your password" maxlength="50" required class="box">
      <p style="font-size: 15px; font-weight:bold;color:black;">Select Your Image<span>*</span></p>
      <input type="file" name="image" id="file1" accept="image/*" required class="box">
      <p class="link" style="font-size:14px;">Already have an account? <a href="login.php">Click here to sign in</a></p>
      <input type="submit" name="submit" value="Sign Up" class="btn" style="width:30%;float:right;">
   </form>

</section>












<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>