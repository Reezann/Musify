<?php

  include"config.php";
  session_start();

  if(isset($_POST['submit'])){

    $uname=$_POST['uname'];
    $password=$_POST['password'];

    $select="SELECT * FROM users WHERE username='$uname' AND password='$password'";
    $result=mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['uname']=$uname;
        header('location:header.php');
    }
    else{
        $error[]='Incorrect username or password';
      }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

     <!--custom css file link-->
     <link rel="stylesheet" href="style.css" >

</head>
<body >
    
    <div class="form-container">

        <form action=""method="post" class="form">
            <h3>Login now</h3>
            <?php
                if (isset($error)) {
                    foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                    }
                }
            ?>
            <input type="text" name="uname" placeholder="enter your username" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <input type="submit" value="login  now" name="submit" class="form-btn">
            <p>Don't have a account?<a href="register.php">Register now</a></p>
        </form>

    </div>

</body>
</html>