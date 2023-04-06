<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>


<header class="header" style="padding: 0.1px 1px;">

   <section class="flex">
   
   <div class="icons">
   
         <div id="menu-btn" class="fas fa-bars" style="justify-content:space-around;"></div>
        
      </div>
      
   <img src="images/logonew.png" alt="logo" height="45" style="margin-right:950px;" />
 
   <?php
            $select_profile = $conn->prepare("SELECT * FROM `student` WHERE STUDENT_ID = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
    <h2 style="text-transform: capitalize;"><?= $fetch_profile['STUDENT_NAME']; ?></h1><span></span>
   <div class="icons">

         <!-- <div style="display:inline-block;"> <?= $fetch_profile['STUDENT_NAME']; ?></div> -->
         <div id="user-btn" style="display:inline-block; border-radius:50%; overflow:hidden;"> <img src="images/<?= $fetch_profile['STUDENT_IMAGE']; ?>" width="50" height="50"></div>
         
      </div>
      <?php
            }
         ?>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `student` WHERE STUDENT_ID = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <!-- <img src="images/<?= $fetch_profile['STUDENT_IMAGE']; ?>" alt="">
         <h3><?= $fetch_profile['STUDENT_NAME']; ?></h3> -->
         <span>student</span>
         <a href="updatestudent.php" class="btn">view profile</a>
        
         <a href="components/logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         <?php
            }else{
         ?>
         <h3>please login or register</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
         <?php
            }
         ?>
      </div>


   </section>

</header>



<div class="side-bar" style="background-color:purple; height: 100vh;
   width: 20rem;">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <style>
        h2{
         font-size: 10px;
         font-family: 'Times New Roman', Times, serif;
         font-weight: bold;
         color: black;
      }
   /* .side-bar .navbar a{
   display:block;
   padding: 2rem;
   margin: .5rem 0;
   font-size: 1.8rem;
}

.side-bar .navbar a i{
   color: var(--main-color);
   margin-right: 1.5rem;
   transition: .2s linear;
}

.side-bar .navbar a span{
   color: var(--light-color);
}

.side-bar .navbar a:hover{
   background-color: purple;
}

.side-bar .navbar a:hover i{
   margin-right: 2.5rem;
} */
   </style>

 

   <nav class="navbar" >
      <a style="text-decoration: none;" href="home.php" ><i class="fas fa-home" style="color:white;"></i><span style="color:white;font-size:14px; ">Home</span></a>
      <a style="text-decoration: none;" href=""><i class="fa fa-briefcase"  style="color:white;"></i><span style="color:white;font-size:14px;">Search Job</span></a>
      <a style="text-decoration: none;" href=""><i class="fa fa-calculator"  style="color:white;"></i><span style="color:white;font-size:14px;">Salary Comparison</span></a>
      <a style="text-decoration: none;" href="training.php"><i class="fas fa-chalkboard-user"  style="color:white;"></i><span style="color:white;font-size:14px;">Training Recommendation</span></a>
      <a style="text-decoration: none;" href=""><i class="fas fa-question"  style="color:white;"></i><span style="color:white;font-size:14px;">About us</span></a>
      <a style="text-decoration: none;" href=""><i class="fas fa-headset"  style="color:white;"></i><span style="color:white;font-size:14px;">Contact us</span></a>
      <a style="text-decoration: none;" href="components/logout.php"><i class="fa fa-sign-out"  style="color:white;"></i><span style="color:white;font-size:14px;">Sign Out</span></a>
   </nav>

</div>

