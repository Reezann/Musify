<?php
    include"config.php";
    if(isset($_POST['submit'])){
        $title=$_POST['title'];
        $path=$_POST['path'];
        $image=$_POST['image'];
        $q="INSERT INTO `songs`(`title`,`path`,`image`) VALUES ('$title','$path','$image') ";

        $query=mysqli_query($conn,$q);
    }
?>

</php>
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
        
    <button type="submit" class="btn btn-success" name="submit">Submit</button><br>
    <a class="btn btn-info" type="submit" name="cancel" href="admin_index.php">Cancel</a><br>
    </form>
</div>

<?php
    include"songs.php";
?>

</form>
  </body>
</html>