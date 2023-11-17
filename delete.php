
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