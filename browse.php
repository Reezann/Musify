<?php
 session_start();
    include("config.php");
    include_once "common_functions.php";
    include "delete.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPOTIFY</title>
    <link rel="stylesheet" href="style-a.css"> 
    <link rel="stylesheet" href="style.css"> 

    
</head>
<body>
    <?php
    include("nav.php");
    include("display_songs.php");
    include("display_album.php");
    ?>
</body>
</html>
