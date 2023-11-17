<?php
session_start();
include("config.php");
include "common_functions.php";
include "delete.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>   
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='style-a.css'>
    <link rel='stylesheet' href='style.css'>

    <script src='https://kit.fontawesome.com/065ccc13d0.js' crossorigin='anonymous'></script>
</head>
<body>
    <div class="viewContainer">
    <?php
        include "nav.php"; 
    
        if (isset($_GET['album_id'])) {
            $album_id = $_GET['album_id'];
            $songsQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album_id='$album_id'");
            display_songs($songsQuery, $conn);
        }

        if (isset($_GET['playlist_id'])) {
            $id = $_GET['playlist_id'];
            $songsQuery = mysqli_query($conn, "SELECT * FROM songs S, playlistsongs P WHERE (P.playlist_id='$id' AND P.song_id=S.id)");
            display_songs($songsQuery, $conn);
        }
    ?>
    </div>
</body>
</html>

