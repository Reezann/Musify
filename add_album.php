<?php
session_start();
include "config.php";
include "nav.php";
include "common_functions.php";

// add album-songs
if (isset($_POST['add_song'])) {

    if (isset($_POST['albumId'])) {
        $titles = $_POST['title'];
        $paths = $_POST['path'];
        $no = $_POST['no'];
        $albumId = $_POST['albumId'];
        $artistId = $_POST['artistId']; // Retrieve artistId from the form
        $image = $_POST['image']; // Retrieve image path from the form

        for ($i = 0; $i < $no; $i++) {
            $title = $titles[$i];
            $path = $paths[$i];

            $q3 = "INSERT INTO `songs`(`title`, `path`,`image`,`album_id`,`artist_id`) VALUES ('$title', '$path','$image','$albumId','$artistId')";
            $queryy = mysqli_query($conn, $q3);
        }
        
        // Display alert after adding songs
        echo '<script>alert("Songs added successfully!");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylee.css">
</head>

<body>

    <?php
    $query1 = null; // Initialize $query1
    $query2 = null; // Initialize $query2
    $albumId = null; // Initialize $albumId
    $artistId = null; // Initialize $artistId

    if (!isset($_POST['add_album']) || isset($_POST['add'])) {
        echo "<div class='formm'>
        <form method='post'>
        <label>Album Name:</label>
            <input type='text' class='form-control' name='titlee' placeholder='Enter the album name' required><br>
        <label>Image:</label>
            <input type='text' class='form-control' name='imagee' placeholder='Enter the album image path' required><br>
        <label>Artist:</label>
            <input type='text' class='form-control' name='artist' placeholder='Enter artist name:' required><br>
        <label>Number of Songs:</label>
            <input type='number' class='form-control' name='no' placeholder='Enter number of songs' required><br>
            <button type='submit' class='btn btn-success' name='add_album'>Add Album</button><br>
            <a class='btn btn-info' href='index.php'>Cancel</a><br>
        </form>
    </div>";
    }


    // add album details
    if (isset($_POST['add_album'])) {
        $artistId = check_artist($_POST['artist'], $conn);

        $title = $_POST['titlee'];
        $image = $_POST['imagee'];
        $no = $_POST['no'];
        $q2 = "INSERT INTO `album`(`title`, `img`,`artist_id`) VALUES ('$title', '$image','$artistId')";
        $query2 = mysqli_query($conn, $q2);
        if ($query2) {
            $albumId = mysqli_insert_id($conn);
            echo "hello $albumId";

            if ($query2) {
                echo "<div class='formm'>";
                echo '<form method="post" onsubmit="return preventResubmission();">'; // Updated form tag with onsubmit attribute
                echo '<input type="hidden" name="albumId" value="' . $albumId . '">';
                echo '<input type="hidden" name="artistId" value="' . $artistId . '">';
                echo '<input type="hidden" name="no" value="' . $no . '">';
                echo '<input type="hidden" name="image" value="' . $image . '">';

                for ($counter = 1; $counter <= $no; $counter++) {

                    echo " <label>Title of Song $counter:</label>
                        <input type='text' class='form-control' name='title[]' placeholder='Enter title of song' required>

                        <label>Path of Song $counter:</label>
                        <input type='text' class='form-control' name='path[]' placeholder='Enter Music path' required>
                        <p><br></p>";
                }
                echo "<button type='submit' class='btn btn-success' name='add_song'>Add Songs</button><br>";
                echo '</form>';
                echo "</div>";
            }
        }
        
        // Display alert after adding album
        echo '<script>alert("Album added successfully!");</script>';
    }
    include "display_album.php";
    ?>

    <script>
        // Function to prevent form resubmission
        function preventResubmission() {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            return true;
        }
    </script>

</body>

</html>
