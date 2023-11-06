<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-a.css">
    <script src="https://kit.fontawesome.com/065ccc13d0.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL parameter
    $result = mysqli_query($conn, "SELECT * FROM songs WHERE id = $id");
    
    if ($result) {
        $row = mysqli_fetch_assoc($result); // Fetch the row as an associative array
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
                    <div class='circle'>
                        <i class='fa-solid fa-angle-left'></i>
                    </div>
                    <div class='circle'>
                        <i class='fa-solid fa-bars'></i>
                    </div>
                </nav>
                <img src='" . $row['image'] . "' class='song-img' alt='NOOOOT'>
                <h1>hellloooo</h1>
                <p>Luis Fonsi</p>
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
