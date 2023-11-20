<?php
    session_start();
    include("config.php");
    include "common_functions.php";

?>

<!DOCTYPE html>
<html lang='en'>
<head>   
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='stylee.css'>

</head>
<body>

    <?php
        include "nav.php"; 
    
        if (isset($_GET['album_id'])) {
            $album_id = $_GET['album_id'];
            $songsQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album_id='$album_id'");
            display_songs($songsQuery, $conn);
        }

        if (isset($_GET['playlist_id'])) {
            $id = $_GET['playlist_id'];
            $songsQuery = mysqli_query($conn, "SELECT S.* FROM songs S, playlistsongs P WHERE (P.playlist_id='$id' AND P.song_id=S.id)");
            display_songs($songsQuery, $conn);
        }
    ?>

</body>
</html>

