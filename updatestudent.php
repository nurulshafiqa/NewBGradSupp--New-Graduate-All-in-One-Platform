<?php 


include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Student Details</title>
   <link rel="icon" type="image/x-icon" href="images/logonew1.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <link href="https://bootswatch.com/5/minty/bootstrap.min.css" rel="stylesheet" type="text/css">


   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/sidebar.css">
   
   <style>
      body{
         padding-left: 20rem;
      }
      form{
         background-color:white;
          width: 70%;
          height: 100%;
          margin: 0 auto;
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

      label{
          color:black;
          font-size: 13px;
          /* font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif */
      }

      input[type="text"]{
          display: block;
          border: 2px solid lavender;
          background-color: var(--light-bg);
          width: 95%;
          padding: 8px;
          /* margin: 2px auto; */
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
          font-size: 13px;
      }
      input[type="number"]{
          display: block;
          border: 2px solid lavender;
          background-color: var(--light-bg);
          width: 95%;
          padding: 8px;
          /* margin: 2px auto; */
          outline: none;
          font-size: 15px;
      }

      input[type="date"]{
          display: block;
          border: 2px solid lavender;
          background-color: var(--light-bg);
          width: 95%;
          padding: 8px;
          /* margin: 2px auto; */
          font-size: 13px;
          outline: none;
      }

      input[type="file"]{
          display: block;
          border: 2px solid lavender;
          background-color: var(--light-bg);
          width: 95%;
          padding: 8px;
          /* margin: 2px auto; */
          outline: none;
          font-size: 13px;
      }


      #studname1, #studemail1, #studcountry1, #studphone1,
      #studyear1, #studcgpa1, #major1, #minor1, #weakness1,#oldpass1,#newpass1,#cpass1,#date1,#file1{

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
      /* #ID1:hover{
          border-color: blue;
      } */
      #studname1:hover, #studemail1:hover, #studcountry1:hover, #studphone1:hover,
      #studyear1:hover, #studcgpa1:hover, #major1:hover,#date1:hover, 
      #minor1:hover, #weakness1:hover,#oldpass1:hover,#newpass1:hover,#cpass1:hover,#file1:hover{
          border-color: blue;
      }

      

   </style>

</head>
<body>

<?php include 'components/user_header.php'; ?>
<?php
    if (isset($_POST['edit'])){
      $select_user = $conn->prepare("SELECT * FROM `student` WHERE STUDENT_ID = ? LIMIT 1");
    $select_user->execute([$user_id]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    $prev_pass = $fetch_user['STUDENT_PASSWORD'];
    $prev_image = $fetch_user['STUDENT_IMAGE'];

    $name = $_POST['studname'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    if(!empty($name)){
    $update_name = $conn->prepare("UPDATE `student` SET STUDENT_NAME = ? WHERE STUDENT_ID = ?");
    $update_name->execute([$name, $user_id]);
    $message[] = 'Student name updated successfully!';
    }

    $email = $_POST['studemail'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    if(!empty($email)){
        $select_email = $conn->prepare("SELECT STUDENT_EMAIL FROM `student` WHERE STUDENT_EMAIL = ?");
        $select_email->execute([$email]);
        if($select_email->rowCount() > 0){
          $message[] = 'email already taken!';
        }else{
          $update_email = $conn->prepare("UPDATE `student` SET STUDENT_EMAIL = ? WHERE STUDENT_ID = ?");
          $update_email->execute([$email, $user_id]);
          $message[] = 'student email updated successfully!';
        }
    }

    $date = $_POST['date'];
    $date = filter_var($date, FILTER_SANITIZE_STRING);

    if(!empty($date)){
    $update_date = $conn->prepare("UPDATE `student` SET STUDENT_BIRTHDATE = ? WHERE STUDENT_ID = ?");
    $update_date->execute([$date, $user_id]);
    $message[] = 'Student birthdate updated successfully!';
    }

    $studcountry = $_POST['studcountry'];
    $studcountry = filter_var($studcountry, FILTER_SANITIZE_STRING);

    if(!empty($studcountry)){
    $update_country = $conn->prepare("UPDATE `student` SET STUDENT_COUNTRY = ? WHERE STUDENT_ID = ?");
    $update_country->execute([$studcountry, $user_id]);
    $message[] = 'Student country updated successfully!';
    }

    $studphone = $_POST['studphone'];
    $studphone = filter_var($studphone, FILTER_SANITIZE_STRING);

    if(!empty($studphone)){
    $update_studphone = $conn->prepare("UPDATE `student` SET STUDENT_PHONE = ? WHERE STUDENT_ID = ?");
    $update_studphone->execute([$studphone, $user_id]);
    $message[] = 'Student phone number updated successfully!';
    }

    $studyear = $_POST['studyear'];
    $studyear = filter_var($studyear, FILTER_SANITIZE_STRING);

    if(!empty($studyear)){
    $update_studyear = $conn->prepare("UPDATE `student` SET STUDENT_YEAR_ENROLLED = ? WHERE STUDENT_ID = ?");
    $update_studyear->execute([$studyear, $user_id]);
    $message[] = 'Current academic year updated successfully!';
    }

    $studcgpa = $_POST['studcgpa'];
    $studcgpa = filter_var($studcgpa, FILTER_SANITIZE_STRING);

    if(!empty($studcgpa)){
    $update_studcgpa = $conn->prepare("UPDATE `student` SET STUDENT_CGPA = ? WHERE STUDENT_ID = ?");
    $update_studcgpa->execute([$studcgpa, $user_id]);
    $message[] = 'Student CGPA updated successfully!';
    }

    $major = $_POST['major'];
    $major = filter_var($major, FILTER_SANITIZE_STRING);

    if(!empty($major)){
    $update_major = $conn->prepare("UPDATE `student` SET STUDENT_MAJOR = ? WHERE STUDENT_ID = ?");
    $update_major->execute([$major, $user_id]);
    $message[] = 'Student major updated successfully!';
    }

    $minor = $_POST['minor'];
    $minor = filter_var($minor, FILTER_SANITIZE_STRING);

    if(!empty($minor)){
    $update_minor = $conn->prepare("UPDATE `student` SET STUDENT_MINOR = ? WHERE STUDENT_ID = ?");
    $update_minor->execute([$minor, $user_id]);
    $message[] = 'Student minor updated successfully!';
    }

    $weakness = $_POST['weakness'];
    $weakness = filter_var($weakness, FILTER_SANITIZE_STRING);

    if(!empty($weakness)){
    $update_weakness = $conn->prepare("UPDATE `student` SET STUDENT_WEAKNESS = ? WHERE STUDENT_ID = ?");
    $update_weakness->execute([$weakness, $user_id]);
    $message[] = 'Student weakness updated successfully!';
    }

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/'.$rename;

    if(!empty($image)){
        if($image_size > 2000000){
          $message[] = 'image size too large!';
        }else{
          $update_image = $conn->prepare("UPDATE `student` SET `STUDENT_IMAGE` = ? WHERE STUDENT_ID = ?");
          $update_image->execute([$rename, $user_id]);
          move_uploaded_file($image_tmp_name, $image_folder);
          if($prev_image != '' AND $prev_image != $rename){
              unlink('images/'.$prev_image);
          }
          $message[] = 'image updated successfully!';
        }
    }

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    if($old_pass != $empty_pass){
        if($old_pass != $prev_pass){
          $message[] = 'old password not matched!';
        }elseif($new_pass != $cpass){
          $message[] = 'confirm password not matched!';
        }else{
          if($new_pass != $empty_pass){
              $update_pass = $conn->prepare("UPDATE `student` SET STUDENT_PASSWORD = ? WHERE STUDENT_ID = ?");
              $update_pass->execute([$cpass, $user_id]);
              $message[] = 'password updated successfully!';
          }else{
              $message[] = 'please enter a new password!';
          }
        }
    }

  }

    ?>
    <br>
<script src="js/script.js"></script>


                  
<section class="training-form">

  
  <form method="POST" action="" enctype="multipart/form-data">
   <h1 style="margin-left:30px;font-size:18px;text-transform:uppercase;color:purple; padding-bottom: 3rem;padding-top:3rem;">Update Student Details</h1>


   <fieldset>
  <!-- <input type="hidden" name="studentid" id="stud_id">

  <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="ID" class="form-label mt-4" style="display:none;">ID</label>
      <input type="hidden" class="form-control" name="ID"  id="ID1"  placeholder="Enter Training ID">
     
    </div> -->
   
    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="name" class="form-label mt-4">Student Name</label>
      <input type="text" class="form-control" name="studname"  id="studname1"  value="<?= $fetch_profile['STUDENT_NAME']; ?>" >
     
    </div>

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="email" class="form-label mt-4">Student Email</label>
      <input type="text" class="form-control" name="studemail"  id="studemail1" value="<?= $fetch_profile['STUDENT_EMAIL']; ?>">
     
    </div>

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="date" class="form-label mt-4">Birthdate</label>
      <input type="date" class="form-control" name="date" id="date1" placeholder="Enter date" value="<?= $fetch_profile['STUDENT_BIRTHDATE']; ?>" >
    </div>

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="country" class="form-label mt-4">Student Country</label>
      <input type="text" class="form-control" name="studcountry"  id="studcountry1"  placeholder="Enter Your Country" value="<?= $fetch_profile['STUDENT_COUNTRY']; ?>">
     
    </div>

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="phone" class="form-label mt-4">Phone Number</label>
      <input type="tel" class="form-control" name="studphone"  id="studphone1"  placeholder="Enter Your Phone Number (0123456789)"  value="<?= $fetch_profile['STUDENT_PHONE']; ?>">
    </div>

    

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="year" class="form-label mt-4">Current Academic Year</label>
      <input type="number" class="form-control" name="studyear"  id="studyear1"  placeholder="Enter Your current academic year" value="<?= $fetch_profile['STUDENT_YEAR_ENROLLED']; ?>">
     
    </div>

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="cgpa" class="form-label mt-4">Student CGPA</label>
      <input type="text" class="form-control" name="studcgpa"  id="studcgpa1"  placeholder="Enter Your CGPA (4.0)"  pattern="[0-4]{1}.[0-9]{2}" value="<?= $fetch_profile['STUDENT_CGPA']; ?>" required>
    </div>


    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="major" class="form-label mt-4"> Student Major</label>
      <select class="form-select" name="major" id="major1"  >
        <option selected=""  ><?= $fetch_profile['STUDENT_MAJOR']; ?></option>
        <option style="color:blue;">Software Engineering</option>
        <option style="color:blue;">Computing Infrastructure</option>
        <option style="color:blue;">Intelligent Computing</option>
      </select>
    </div>

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="minor" class="form-label mt-4"> Student Minor</label>
      <select class="form-select" name="minor" id="minor1"  >
        <option  selected="" ><?= $fetch_profile['STUDENT_MINOR']; ?></option>
        <option style="color:blue;">Thinking Techniques</option>
        <option style="color:blue;">Critical Thinking</option>
        <option style="color:blue;">Electronics</option>
        <option style="color:blue;">Psychology</option>
        <option style="color:blue;">Mathematics</option>
        <option style="color:blue;">Graphic Design</option>
      </select>
    </div>

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="weakness" class="form-label mt-4"> Student Weakness</label>
      <select class="form-select" name="weakness" id="weakness1" >
        <option selected=""><?= $fetch_profile['STUDENT_WEAKNESS']; ?></option>
        <option style="color:blue;">Communication skill</option>
        <option style="color:blue;">Time management</option>
        <option style="color:blue;">Programming</option>
        <!-- <option style="color:blue;">Psychology</option>
        <option style="color:blue;">Mathematics</option>
        <option style="color:blue;">Graphic Design</option> -->
      </select>
    </div>

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="password" class="form-label mt-4">Old Password</label>
      <input type="password" class="form-control" name="old_pass"  id="oldpass1"  placeholder="Enter Your new password" >
     
    </div>
    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="password" class="form-label mt-4">New Password</label>
      <input type="password" class="form-control" name="new_pass"  id="newpass1"  placeholder="Enter Your new password" >
     
    </div>
    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="password" class="form-label mt-4">Confirm Password</label>
      <input type="password" class="form-control" name="cpass"  id="cpass1"  placeholder="Enter Your new password" >
     
    </div>

    <div class="form-group" style="width:70% ; margin: 0 auto;">
      <label for="formFile" class="form-label mt-4">Student Image</label>
      <input class="form-control" type="file" id="file1"name="image">
    </div>
 
 
    
    <div style="margin: 30px 150px;" >
    <input type="hidden" name="studentid" value="<?php echo $studentid; ?>" >
    <button type="submit" class="btn btn-primary" name="edit" style="background-color: var(--main-color);float:right; font-size:12px; width:20%;padding:5px;">Save</button>
    <br><br>
    <br><br>
    <div></div>
  </fieldset>
      </form>

</section>


            
</body>
</html>