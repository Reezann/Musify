<div class="gridViewContainer">
    <?php 
        $songsQuery = mysqli_query($conn, "SELECT * FROM songs");

        while ($row = mysqli_fetch_array($songsQuery)) {
            echo "<div class='gridViewItem'>
                <a href='play.php?id=" . $row['id'] . "'>
                    <img src='" . $row['image'] . "'>
                    <div class='gridViewInfo'>" . $row['title'] . "</div>
                </a>
            </div>";
        }
    ?>
</div>
