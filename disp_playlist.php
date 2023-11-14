<div class="gridViewContainer">
    <?php
        $u_id = $_SESSION['user_id'];
        // fetch and display playlists
        $query = mysqli_query($conn, "SELECT * FROM playlist WHERE user_id = $u_id");

        while($row = mysqli_fetch_array($query)){
            echo "<div class='gridViewItem'>
                <a href='disp_album_songs.php?playlist_id=" . $row['id'] . "'>
                    <img src=''>
                    <div class='gridViewInfo'>" . $row['name'] . "</div>
                </a>
            </div>";
        }
    ?>
</div>


