
<?php
  session_start();
  include "config.php";
  include "common_functions.php";
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
        
    <button type="submit" class="btn btn-success" name="add_song">Submit</button><br>
    <a class="btn btn-info" type="submit" name="cancel" href="admin_index.php">Cancel</a><br>
    </form>
</div>

<?php
    include"display_songs.php";
?>

</form>
  </body>
</html>