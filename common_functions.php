<!-- checking if artist already exists -->
<?php
 function check_artist($artist,$conn){

    $select = "SELECT id FROM artist WHERE name='$artist'";
    $result1 = mysqli_query($conn, $select);

    if (mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1); // Fetch the result
        $artistId = $row['id']; // Get the 'id' value
    } else {
        $q1 = "INSERT INTO `artist`(`name`) VALUES ('$artist')";
        $query1 = mysqli_query($conn, $q1);
        $artistId = mysqli_insert_id($conn);
    }
return $artistId;
}
?>


<!-- adding song to playlist -->
<?php
    if(isset($_POST['add_playlist'])) {
        $songID = $_POST['id']; // The song ID from the form
        $playlistName = $_POST['add_playlist']; // The selected playlist name
        $u_id = $_SESSION['user_id'];
        //retrieve the playlist ID based on the name
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

<!-- displaying songs -->
<?php
 function display_songs($songsQuery, $conn) {
    echo'<div class="viewContainer">';
    while ($row = mysqli_fetch_array($songsQuery)) {
        echo "<div class='viewItem'>
            <a href='play.php?song_id=" . $row['id'] . "'>
                <img src='" . $row['image'] . "'>
                <div class='viewInfo'>" . $row['title'] . "</div>
            </a>";

            echo "<form method='post' class='btnn'>";
            //delete option for playlist
            if (isset($_GET['playlist_id']) ){
                           echo" <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='btn' name='delete_playlist_song'>Delete</button>";
                        //</form>";
               
            }
            else{
                //delete option for admin
                if (isset($_SESSION['uname']) && $_SESSION['uname'] == 'admin') {
                    echo "<form method='post'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' class='btn' name='delete'>Delete</button>";
                    //</form>";
                }
                
                echo "<form method='post'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <select name='add_playlist' class='btn' onchange='this.form.submit()'>
                    <option disabled selected>+ Playlist</option>";
                
                // display playlists option
                $u_id = $_SESSION['user_id'];
                $query = mysqli_query($conn, "SELECT * FROM playlist WHERE user_id = $u_id");
                while ($playlist_row = mysqli_fetch_array($query)) {
                    echo "<option value='" . $playlist_row['name'] . "'>" . $playlist_row['name'] . "</option>";
                }
                echo "</select>";
                //</form>";  
            }
            echo"</form>";
            echo"</div>";
    }
    echo"</div>";
 }
?>



<?php 
    // Check if a song should be deleted
    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        //delete from playlist
        $deleteSql = "DELETE FROM `playlistsongs` WHERE id = $id";
        $conn->query($deleteSql);
        // Delete from song database
        $deleteSql = "DELETE FROM `songs` WHERE id = $id";
        $conn->query($deleteSql);

        // Set a JavaScript variable to indicate the deletion
        echo '<script>var songDeleted = true;</script>';
    }
 ?>

 <!--deleting song from playlist-->
 <?php
    if (isset($_POST['delete_playlist_song']) && isset($_POST['id'])){
        $id = $_POST['id'];
        $deleteSql = "DELETE FROM `playlistsongs` WHERE id = $id";
        $conn->query($deleteSql);

        // Set a JavaScript variable to indicate the deletion
        echo '<script>var songDeleted = true;</script>';
    }
?>



<script>
    <?php
    //Check if the song was deleted and add JavaScript to reload the page
    if (isset($_POST['delete']) && isset($_POST['id'])) {
        echo 'if (typeof songDeleted !== "undefined" && songDeleted) {';
        echo'  <script>var songDeleted = true;
        location.reload();</script>';
 
    }
    ?>
</script> 