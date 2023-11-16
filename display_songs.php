
<?php 
include "config.php";
    include "common_functions.php";
    include "delete.php";
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
                    
                 echo "</div>";
        }

    ?>
</div>


