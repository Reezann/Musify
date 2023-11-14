<!-- deleting a song -->
<?php 
    
    // Check if a song should be deleted
    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        
        // Delete the row
        $deleteSql = "DELETE FROM `songs` WHERE id = $id";
        $conn->query($deleteSql);

        // Set a JavaScript variable to indicate the deletion
        echo '<script>var songDeleted = true;</script>';
    }
 ?>

<!-- adding song to playlist -->
<?php
if(isset($_POST['select'])) {
    $songID = $_POST['id']; // The song ID from the form
    $playlistName = $_POST['select']; // The selected playlist name
    $u_id = $_SESSION['user_id'];
    // Logic to retrieve the playlist ID based on the name
    $query = mysqli_query($conn, "SELECT id FROM playlist WHERE name = '$playlistName' AND user_id = $u_id");
    $playlist = mysqli_fetch_assoc($query);

    if ($playlist) {
        $playlistID = $playlist['id'];

        // Logic to add the song to the playlist
        $insertSql = "INSERT INTO playlistsongs (playlist_id, song_id) VALUES ($playlistID, $songID)";
        $result = $conn->query($insertSql);
    }
}
?>

<div class="viewContainer">
    
    <?php
        // displaying songs not from album
        $songsQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album_id = 0");
        
        while ($row = mysqli_fetch_array($songsQuery)) {
            echo "<div class='viewItem'>
                <a href='play.php?id=" . $row['id'] . "'>
                    <img src='" . $row['image'] . "'>
                    <div class='viewInfo'>" . $row['title'] . "</div>
                </a>";
                if (isset($_SESSION['uname']) && $_SESSION['uname'] != 'admin') {
                    echo "<form method='post'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <select name='select' class='btn' onchange='this.form.submit()'>
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
                } else {
                    //delete option for admin
                    echo "<form method='post'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' class='btn' name='delete'>Delete</button>
                    </form>";
                }
                echo "</div>";
        }
    ?>
</div>



<script>
    <?php
    //Check if the song was deleted and add JavaScript to reload the page
    if (isset($_POST['delete']) && isset($_POST['id'])) {
        echo 'if (typeof songDeleted !== "undefined" && songDeleted) {';
        echo'  <script>var songDeleted = true;</script>';
        echo '    location.reload();';
        echo '}';
    }
    ?>
</script> 
