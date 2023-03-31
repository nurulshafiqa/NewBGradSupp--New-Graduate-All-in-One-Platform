<?php
// Database connection settings
@include 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query to check if the email and password exist in the database
    $sql = "SELECT * FROM student WHERE student_email = '$email' AND student_password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Set session variables
        session_start();
        $_SESSION["email"] = $email;

        // Redirect to dashboard page
        header("location: dashboard.php");
    } else {
        // Display error message
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewBGradSupp</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
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

<!-- login form start -->
<section class="login" id="">
    
    <div class="form-container">

        <?php if(isset($error)) { ?>
            <div><?php echo $error; ?></div>
        <?php } ?>

        <form method="post" action="">
        
            <h2>Sign In</h2>
            <i class="fas fa-user"></i><input type="email" placeholder="enter your email" name="email" class="box"> 
            <i class="fas fa-lock"></i><input type="password" placeholder="enter your password" name="password" class="box">
            <a href="#">Forget password</a>
            <input type="submit" name="submit" value="Login" class="btn">
        
        </form>
    </div>
</section>
    


</body>
</html>