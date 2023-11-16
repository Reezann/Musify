
<?php
session_start();
 include("config.php");
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
        include "common_functions.php";
        include "delete.php";
    
    if (isset($_GET['album_id']) ) {
    $album_id = $_GET['album_id']; // Retrieve the 'id' from the URL parameter
    $songsQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album_id='$album_id'");

        while ($row = mysqli_fetch_array($songsQuery)) {
            echo "<div class='viewItem'>
                <a href='play.php?id=" . $row['id'] . "'>
                    <img src='" . $row['image'] . "'>
                    <div class='viewInfo'>" . $row['title'] . "</div>
                </a>";
                if (isset($_SESSION['uname']) && $_SESSION['uname'] == 'admin') {
                    //delete option for admin
                    echo "<form method='post'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' class='btn' name='delete'>Delete</button>
                    </form>";
                }
                    echo "<form method='post'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <select name='add_playlist' class='btn' onchange='this.form.submit()'>
                        <option disabled selected>+ Playlist</option>";
            
                    if (isset($_SESSION['user_id'])) {
                        $u_id = $_SESSION['user_id'];
                        // fetch and display playlists
                        $query = mysqli_query($conn, "SELECT * FROM playlist WHERE user_id = $u_id");
                        while ($playlist_row = mysqli_fetch_array($query)) {
                            echo "<option value='" . $playlist_row['name'] . "'>" . $playlist_row['name'] . "</option>";
                        }
                    }
            
                    echo "</select>
                    </form>";
                echo"</div>";
        }
 
    }
    if (isset($_GET['playlist_id']) ){
        $id = $_GET['playlist_id']; // Retrieve the 'id' from the URL parameter
    
        $songsQuery = mysqli_query($conn, "SELECT * FROM songs S,playlistsongs P WHERE (P.playlist_id='$id' AND P.song_id=S.id)");
    
            while ($row = mysqli_fetch_array($songsQuery)) {
                echo "<div class='viewItem'>
                    <a href='play.php?id=" . $row['id'] . "'>
                        <img src='" . $row['image'] . "'>
                        <div class='viewInfo'>" . $row['title'] . "</div>
                    </a>";
                        //delete option for admin
                        echo "<form method='post'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='btn' name='delete_playlist_song'>Delete</button>
                        </form>";
                        echo"</div>";
                    }    
                
            
    }
    
?>
</div>
</body>
</html>