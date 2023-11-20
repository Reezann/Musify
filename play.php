<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylee.css">

    <script src="https://kit.fontawesome.com/065ccc13d0.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
session_start();
include "common_functions.php";
include("config.php");

if (isset($_GET['song_id'])) {
    $s_id = $_GET['song_id']; // Retrieve the 'id' from the URL parameter
    $query1 = mysqli_query($conn, "SELECT * FROM songs WHERE id = $s_id");
    
  if ($query1) {
       $row = mysqli_fetch_assoc($query1); // Fetch the row as an associative array

    $album_id = $row['album_id'];
        $query2 = mysqli_query($conn, "SELECT artist.name FROM artist, songs WHERE artist.id = " . $row['artist_id'] . "");
        if($query2){
            $row1 = mysqli_fetch_assoc($query2);
        }
    }
}

if (isset($row)) {
    echo "
        <div class='container'>
            <div class='music-player'>
                <nav>
                    <div class='circle'>";
                            echo"<i onclick='goBack()' class='fa-solid fa-angle-left'></i>
                    </div>
                </nav>
                <img src='" . $row['image'] . "' class='song-img' alt='NOT FOUND'>
                <h1>" . $row['title'] . " </h1>
                <p>" . $row1['name'] . "</p>
                <audio controls>
                    <source src='" . $row['path'] . "' type='audio/mpeg'>
                </audio>
            </div>
        </div>";
}
?>
</body>
</html>
<script>
    function goBack() {
    window.history.back();
}
</script>
