<?php

  include"config.php";  // Include a configuration file, which is likely used to establish a database connection.
  
  session_start(); // Start a PHP session to store user data.

    // Initialize variables to store user input and errors.
    $name = "";
    $uname= "";
    $email = "";
    $password = "";
    $cpassword = "";
    $error = [];
  
  if(isset($_POST['submit'])){ // Check if the registration form was submitted.
    
    // Retrieve form input data.
    $name=$_POST['name'];
    $uname=$_POST['uname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpass=$_POST['cpassword'];

    // Check if a user with the same email or username already exists in the database.
    $select="SELECT * FROM users WHERE email='$email'OR username='$uname'";
    $result=mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0){
      $error[]='User already exists.';
    }
    else{
      if($password!=$cpass){
        $error[]='pass not matched.';
      }
      else{
        // If the user doesn't exist and passwords match, insert the user's data into the database.
        $insert="INSERT INTO users(name,username,email,password) VALUES('$name','$uname','$email','$password')";
        mysqli_query($conn,$insert);
        header('location:header.php');// Redirect to the header.php page upon successful registration.
      }
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!--custom css file link-->
    <link rel="stylesheet" href="style.css">

</head>
<body >
  <div class="form-container">
    
    <form action="" method="post" >
        <h3>Register now</h3>
        <?php
          if (isset($error)) {
            foreach($error as $error){
              echo '<span class="error-msg">'.$error.'</span>';
            }
          }
        ?>
        <input type="text" name="name" placeholder="enter name" class="box" required>
        <input type="text" name="uname" placeholder="enter username" class="box" required>
        <input type="email" name="email" placeholder="enter email" class="box" required>
        <input type="password" name="password" placeholder="enter password" class="box" required>
        <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
        <input type="submit" value="register now" name="submit" class="form-btn">
        <p>Already have an account? <a href="login.php">login now</a></p>


    </form>

  </div>  
</body>
</html>