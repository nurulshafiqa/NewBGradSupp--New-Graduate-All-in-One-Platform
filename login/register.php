<?php
// Database connection settings
@include 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate input data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

  if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    $error_message = "Please fill in all the fields.";
  } else if ($password !== $confirm_password) {
    $error_message = "Passwords do not match.";
  } else {
    // Check if email already exists in the database
    $sql = "SELECT * FROM student WHERE student_email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $error_message = "Email already exists.";
    } else {
      // Save data to the database
      $sql = "INSERT INTO student (student_name, student_email, student_password) VALUES ('$name', '$email', '$password')";
      if ($conn->query($sql) === TRUE) {
        header("Location: login.php"); // Redirect to login page
        exit();
      } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
}

$conn->close();
?>

<!-- HTML form -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

<!-- Navigation start -->
<header class="header">

    <img src="img/logo.jpeg" alt="logo" height="45" style="margin-right:500px;" />

    <div class="icons">
        <a href="index.php" class="fas fa-home"></a>
    </div>

</header>
<!-- Navigation end -->

<!-- register form -->
<section class="register" id="">

  <div class="form-container">
      
      <form method="post" action="">

          <h3>Enroll Student</h3>

          <input type="text" placeholder="enter your name" name="name" class="box">

          <input type="email" placeholder="enter your email" name="email" class="box">

         <input type="password" placeholder="enter your password" name="password" class="box">
          
         <input type="password" placeholder="enter your password" name="confirm_password" class="box">

          <?php if (isset($error_message)) { ?>
              <div class="error"><?php echo $error_message; ?></div>
          <?php } ?>

          <input type="submit" name="submit" value="Login" class="btn">
      </form>

  </div>
</section>

</body>
</html>