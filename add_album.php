<?php
session_start();
include "config.php";
include "nav.php";
include "common_functions.php";
    include "delete.php";
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
            <button type='submit' class='btn btn-success' name='add_album'>Submit Album</button><br>
            <a class='btn btn-info' href='admin_index.php'>Cancel</a><br>
        </form>
    </div>";
    }

    include "display_album.php";
?>
</body>
</html>