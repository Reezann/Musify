
<?php
session_start();
  include "config.php";
  include "common_functions.php";

  if (isset($_POST['create'])) {
        $name = $_POST['name'];
        if(isset($_SESSION['user_id'])) {
            $id1=$_SESSION['user_id'];
            $q = "INSERT INTO `playlist`(`name`, `user_id`) VALUES ('$name', '$id1') ";
        $query = mysqli_query($conn, $q);
        }
        
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylee.css">

  </head>
  
<body>
<?php
    include "nav.php";
?>
<div class="formm">
    <form method="post" >
        <label >Title:</label>
        <input type="text" class="form-control" name="name" placeholder="Enter playlist name." required><br>
        
    <button type="submit" class="btn btn-success" name="create">Submit</button><br>
    <a class="btn btn-info" type="submit" name="cancel" href="your_music.php">Cancel</a><br>
    </form>
</div>

<div class="gridViewContainer">
    <?php
    // fetch and display playlists
        $u_id = $_SESSION['user_id'];
        
        $query = mysqli_query($conn, "SELECT * FROM playlist WHERE user_id = $u_id");

        while($row = mysqli_fetch_array($query)){
            echo "<div class='gridViewItem'>
                <a href='disp_album_songs.php?playlist_id=" . $row['id'] . "'>
                    <img src='Images/playlist.jpg'>
                    <div class='gridViewInfo'>" . $row['name'] . "</div>
                </a>
            </div>";
        }
    ?>
</div>

</form>
  </body>
</html>