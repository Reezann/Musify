
<div class="viewContainer">
    <?php
        $songsQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album_id = 0");
        display_songs($songsQuery,$conn);
    ?>
</div>


