<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!--custom css file link -->
    <link rel="stylesheet" href="style.css" >
    <link rel="stylesheet" href="style-a.css" >

</head>
<body>
    
  <?php
  session_start();
    include('config.php');
    include('nav.php');
    include("display_songs.php");
    include("display_album.php");
    ?>

</body>
</html>