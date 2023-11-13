
<?php
session_start();
  include "config.php";

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
        <input type="text" class="form-control" name="name" placeholder="Enter playlist name." required><br>
        
    <button type="submit" class="btn btn-success" name="create">Submit</button><br>
    <a class="btn btn-info" type="submit" name="cancel" href="user.php">Cancel</a><br>
    </form>
</div>

<?php
    // include"display_songs.php";
?>

</form>
  </body>
</html>