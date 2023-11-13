<?php
include "config.php";
include "a_nav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style-a.css">
    
</head>
<body>

<?php
$query1 = null; // Initialize $query1
$query2 = null; // Initialize $query2
$albumId = null; // Initialize $albumId
$artistId = null; // Initialize $artistId

if (!isset($_POST['submit']) || isset($_POST['add'])) {
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
        <button type='submit' class='btn btn-success' name='submit'>Submit Album</button><br>
        <a class='btn btn-info' href='admin_index.php'>Cancel</a><br>
    </form>
</div>";
}

if (isset($_POST['submit'])) {
    $artist=$_POST['artist'];
    $q1 = "INSERT INTO `artist`(`name`) VALUES ('$artist')";
    $query1 = mysqli_query($conn, $q1);
    if($query1){
        $artistId = mysqli_insert_id($conn);

        $title = $_POST['titlee'];
        $image = $_POST['imagee'];
        $no = $_POST['no'];
        $q2 = "INSERT INTO `album`(`title`, `img`,`artist_id`) VALUES ('$title', '$image','$artistId')";
        $query2 = mysqli_query($conn, $q2);
        if($query2){
            $albumId = mysqli_insert_id($conn);
            echo"hello $albumId";    

            if ($query2) {
                echo '<form method="post">'; // New form for song details
                echo '<input type="hidden" name="albumId" value="' . $albumId . '">'; // Pass the album ID
                echo '<input type="hidden" name="artistId" value="' . $artistId . '">'; // Pass the artist ID
                echo '<input type="hidden" name="no" value="' . $no . '">'; // Pass the value of $no to the second form
                echo '<input type="hidden" name="image" value="' . $image . '">'; // Pass the path of $image to the second form

                for ($counter = 1; $counter <= $no; $counter++) {
                    echo "<div class='formm'>
                        <label>Title of Song $counter:</label>
                        <input type='text' class='form-control' name='title[]' placeholder='Enter title of song' required>

                        <label>Path of Song $counter:</label>
                        <input type='text' class='form-control' name='path[]' placeholder='Enter Music path' required>
                        <p><br></p>";
                }
                echo "<button type='submit' class='btn btn-success' name='add'>Add Songs</button><br>";
                echo '</form>'; // Close the song details form
            }

        }
    }
  
}
if (isset($_POST['add'])) {
    $titles = $_POST['title'];
    $paths = $_POST['path'];
    $no = $_POST['no']; // Retrieve $no from the second form
    $albumId = $_POST['albumId']; // Retrieve albumId from the form
    $artistId = $_POST['artistId']; // Retrieve artistId from the form
    $image = $_POST['image']; // Retrieve image path from the form

    for ($i = 0; $i < $no; $i++) {
        $title = $titles[$i];
        $path = $paths[$i];

        $q3 = "INSERT INTO `songs`(`title`, `path`,`image`,`album_id`,`artist_id`) VALUES ('$title', '$path','$image','$albumId','$artistId')";
        $queryy = mysqli_query($conn, $q3);
    }
    if ($queryy) {
        // Handle successful submission
        exit();
    }
}

include "display_album.php";
?>
</body>
</html>