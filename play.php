
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-a.css">

    <script src="https://kit.fontawesome.com/065ccc13d0.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
session_start();
include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL parameter
    $query1 = mysqli_query($conn, "SELECT * FROM songs WHERE id = $id");
    
    if ($query1) {
        $row = mysqli_fetch_assoc($query1); // Fetch the row as an associative array
        $album_id = $row['album_id'];
        $query2 = mysqli_query($conn, "SELECT artist.name FROM artist, songs WHERE artist.id = " . $row['artist_id'] . " LIMIT 1");
        if($query2){
            $row1 = mysqli_fetch_assoc($query2);
        }
    } else {
        // Handle the case where there's an issue with the query
    }
} else {
    // Handle the case where 'id' is not set in the URL
}

if (isset($row)) {
    echo "
        <div class='container'>
            <div class='music-player'>
                <nav>
                    <div class='circle'>";
                    if (isset($_SESSION['user_id'])){
                        echo "<a href='browse.php'><i class='fa-solid fa-angle-left'></i></a>";

                    }
                    else{
                        if($album_id!=0){
                            echo "<a href='disp_album_songs.php?id=$album_id'><i class='fa-solid fa-angle-left'></i></a>";
                        }
                        else{
                             echo"<a href='add_song.php'><i class='fa-solid fa-angle-left'></i></a>";
                        }
                    }

                echo"    </div>
                    <div class='circle'>
                        <i class='fa-solid fa-bars'></i>
                    </div>
                </nav>
                <img src='" . $row['image'] . "' class='song-img' alt='NOOOOT'>
                <h1>" . $row['title'] . " </h1>
                <p>" . $row1['name'] . "</p>
                <audio controls>
                    <source src='" . $row['path'] . "' type='audio/mpeg'>
                </audio>
            </div>
        </div>";
} else {
    // Handle the case where no row was found for the specified 'id'
}
?>
</body>
</html>
