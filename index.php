<?php 
  session_start();
    include "config.php";
    include "common_functions.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="stylee.css" >

</head>
<body>
    
  <?php

    include('nav.php');
 
    $songsQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album_id = 0");
    display_songs($songsQuery,$conn);
    
    include("display_album.php");
    ?>

</body>
</html>