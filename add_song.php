
<?php
  session_start();
  include "config.php";
  include "common_functions.php";

  if(isset($_POST['add_song'])){
    $artistId=check_artist($_POST['artist'],$conn);

    $title = $_POST['title'];
    $path = $_POST['path'];
    $image = $_POST['image'];
    $q = "INSERT INTO `songs`(`title`, `path`, `image`, `artist_id`) VALUES ('$title', '$path', '$image', '$artistId') ";
    $query = mysqli_query($conn, $q);

    // Check if the query was successful
    if ($query) {
      echo '<script>alert("Song added successfully!");</script>';
    } else {
      echo '<script>alert("Error adding song. Please try again.");</script>';
    }
  }   
  // Clear the session variable after displaying the alert
 unset($_SESSION['song_added']);

?>

<!doctype html>
<html lang="en">
  <head>
  <title>Create</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylee.css">

  </head>
  
<body>
<?php
    include"nav.php";
?>
<div class="formm">
    <form method="post" >
        <label >Title:</label>
        <input type="text" class="form-control" name="title" placeholder="Enter title of song." required><br>

        <label >Path:</label>
        <input type="text" class="form-control" name="path" placeholder="Enter Music path" required><br>

        <label >Image:</label>
        <input type="text" class="form-control" name="image" placeholder="Enter image path" required><br>

        <label >Artist:</label>
        <input type="text" class="form-control" name="artist" placeholder="Enter artist name" required><br>
        
    <button type="submit" class="btn btn-success" name="add_song">Add Song</button><br>
    <a class="btn btn-info" type="submit" name="cancel" href="index.php">Cancel</a><br>
    </form>
</div>

<?php
    $songsQuery = mysqli_query($conn, "SELECT * FROM songs WHERE album_id = 0");
    display_songs($songsQuery,$conn);
?>

</form>
  </body>
</html>