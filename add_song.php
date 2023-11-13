
<?php
  include "config.php";

  if (isset($_POST['submit'])) {
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

?>

<!doctype html>
<html lang="en">
  <head>
  <title>Create</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style-a.css">

  </head>
  
<body>
<?php
    include"a_nav.php";
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
        
    <button type="submit" class="btn btn-success" name="submit">Submit</button><br>
    <a class="btn btn-info" type="submit" name="cancel" href="admin_index.php">Cancel</a><br>
    </form>
</div>

<?php
    include"display_songs.php";
?>

</form>
  </body>
</html>