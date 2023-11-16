
<?php
//add album-songs
  if (isset($_POST['add_song'])) {
    
    if(isset($_POST['albumId'])){
        $titles = $_POST['title'];
        $paths = $_POST['path'];
        $no = $_POST['no']; 
        $albumId = $_POST['albumId']; 
        $artistId = $_POST['artistId']; // Retrieve artistId from the form
        $image = $_POST['image']; // Retrieve image path from the form

        for ($i = 0; $i < $no; $i++) {
            $title = $titles[$i];
            $path = $paths[$i];

            $q3 = "INSERT INTO `songs`(`title`, `path`,`image`,`album_id`,`artist_id`) VALUES ('$title', '$path','$image','$albumId','$artistId')";
            $queryy = mysqli_query($conn, $q3);
        }
    }
    //add songs
    else{
    $artist = $_POST['artist'];
    $select = "SELECT id FROM artist WHERE name='$artist'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch the result
        $artistId = $row['id']; // Get the 'id' value
    } else {
        $q1 = "INSERT INTO `artist`(`name`) VALUES ('$artist')";
        $query1 = mysqli_query($conn, $q1);
        $artistId = mysqli_insert_id($conn);
    }

    $title = $_POST['title'];
    $path = $_POST['path'];
    $image = $_POST['image'];
    $q = "INSERT INTO `songs`(`title`, `path`, `image`, `artist_id`) VALUES ('$title', '$path', '$image', '$artistId') ";
    $query = mysqli_query($conn, $q);
    }   
  }

?>



<?php
//add album details
    if (isset($_POST['add_album'])) {
        $artist = $_POST['artist'];
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

        $title = $_POST['titlee'];
        $image = $_POST['imagee'];
        $no = $_POST['no'];
        $q2 = "INSERT INTO `album`(`title`, `img`,`artist_id`) VALUES ('$title', '$image','$artistId')";
        $query2 = mysqli_query($conn, $q2);
        if($query2){
            $albumId = mysqli_insert_id($conn);
            echo"hello $albumId";    

            if ($query2) {
                echo '<form method="post">'; // New form for song details
                echo '<input type="hidden" name="albumId" value="' . $albumId . '">'; // Pass the album ID
                echo '<input type="hidden" name="artistId" value="' . $artistId . '">'; // Pass the artist ID
                echo '<input type="hidden" name="no" value="' . $no . '">'; // Pass the value of $no to the second form
                echo '<input type="hidden" name="image" value="' . $image . '">'; // Pass the path of $image to the second form

                for ($counter = 1; $counter <= $no; $counter++) {
                    echo "<div class='formm'>
                        <label>Title of Song $counter:</label>
                        <input type='text' class='form-control' name='title[]' placeholder='Enter title of song' required>

                        <label>Path of Song $counter:</label>
                        <input type='text' class='form-control' name='path[]' placeholder='Enter Music path' required>
                        <p><br></p>";
                }
                echo "<button type='submit' class='btn btn-success' name='add_song'>Add Songs</button><br>";
                echo '</form>'; // Close the song details form
            }

        }
    }
?>



<!-- adding song to playlist -->
<?php
    if(isset($_POST['add_playlist'])) {
        $songID = $_POST['id']; // The song ID from the form
        $playlistName = $_POST['add_playlist']; // The selected playlist name
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