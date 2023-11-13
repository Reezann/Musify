
<?php
 include("config.php");
if (isset($_GET['id'])) {
    include"a_nav.php";
    echo"<!DOCTYPE html>
    <html lang='en'>
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='admin/style-a.css'>
    <script src='https://kit.fontawesome.com/065ccc13d0.js' crossorigin='anonymous'></script>
    </head>
    <body>";

    $id = $_GET['id']; // Retrieve the 'id' from the URL parameter

    echo"<h1>$id </h1><div class='viewContainer'>";

    $songsQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album_id='$id'");

        while ($row = mysqli_fetch_array($songsQuery)) {
            echo "<div class='viewItem'>
                <a href='play.php?id=" . $row['id'] . "'>
                    <img src='" . $row['image'] . "'>
                    <div class='viewInfo'>" . $row['title'] . "</div>
                </a>
            </div>";
        }
    echo"</div>
    </body>
    </html>";
}



?>
