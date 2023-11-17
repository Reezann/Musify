<?php
   session_start();
   include 'config.php';
   // include 'nav.php';
   $user_id=$_SESSION['user_id'];
   $query="SELECT * FROM users WHERE id=$user_id";
   $result=mysqli_query($conn,$query);
   if(mysqli_num_rows($result)>0){
      $data=mysqli_fetch_array($result);
   }
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-a.css">
 </head>
 <body>
   <?php
      echo "<div>Name = '" . $data['name'] . "' ";
   ?>
 </body>
 </html>