<div class="viewContainer">
    <?php 
    
    // Check if a song should be deleted
    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        
        // Delete the row
        $deleteSql = "DELETE FROM `songs` WHERE id = $id";
        $conn->query($deleteSql);
    
        // Reset the id values
        $resetSql = "SET @counter = 0;";
        $conn->query($resetSql);
        $updateSql = "UPDATE `songs` SET id = @counter := @counter + 1;";
        $conn->query($updateSql);

        // Set a JavaScript variable to indicate the deletion
        echo '<script>var songDeleted = true;</script>';
    }
    ?>

<?php
    // Check if a song should be deleted
    if (isset($_POST['add'])) {
        $id = $_POST['id'];
       
    }
    ?>

    <?php
    // Fetch and display songs
    $songsQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album_id = 0");
    
    while ($row = mysqli_fetch_array($songsQuery)) {
        echo "<div class='viewItem'>
            <a href='play.php?id=" . $row['id'] . "'>
                <img src='" . $row['image'] . "'>
                <div class='viewInfo'>" . $row['title'] . "</div>
            </a>";
            if(isset($_SESSION['uname']) && $_SESSION['uname'] == 'admin') {
                echo "<form method='post'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button type='submit' class='btn' name='delete'>Delete</button>
                </form>";
            } else {
                echo "<form method='post'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button type='submit' class='btn' name='add'>+ Playlist</button>
                </form>";
            }
        echo"</div>";
    }
    ?>
</div>

<script>
    <?php
    // Check if the song was deleted and add JavaScript to reload the page
    if (isset($_POST['delete']) && isset($_POST['id'])) {
        echo 'if (typeof songDeleted !== "undefined" && songDeleted) {';
        echo'  <script>var songDeleted = true;</script>';
        echo '    location.reload();';
        echo '}';
    }
    ?>
</script>
