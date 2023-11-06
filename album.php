<?php
    include "config.php";
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $image = $_POST['image'];
        $no = $_POST['no'];
        $q = "INSERT INTO `album`(`title`, `img`) VALUES ('$title', '$image')";
        $query = mysqli_query($conn, $q);
        
        if ($query) {
          header("location: add-album.php?no=$no&title=$title");
          exit();
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
    include "nav.php";
?>
<div class="formm">
    <form method="post">
        <label>Title:</label>
        <input type="text" class="form-control" name="title" placeholder="Enter title of album." required><br>

        <label>Image:</label>
        <input type="text" class="form-control" name="image" placeholder="Enter image path" required><br>

        <label >songs:</label>
        <input type="number" class="form-control" name="no" placeholder="Enter number of songs" required><br>

        <button type="submit" class="btn btn-success" name="submit">Submit</button><br>
        <a class="btn btn-info" href="admin_index.php">Cancel</a><br>
    </form>
</div>
</body>
</html>












<!-- <?php
    // include"config.php";
    // if(isset($_POST['submit'])){
    //     $title=$_POST['title'];
    //     $image=$_POST['image'];
    //     $q="INSERT INTO `album`(`title`,`img`) VALUES ('$title','$image') ";

    //     $query=mysqli_query($conn,$q);
    // }
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
/*<?php
  //  include"nav.php";
?> */
<div class="formm">
    <form method="post" >
        <label >Title:</label>
        <input type="text" class="form-control" name="title" placeholder="Enter title of album." required><br>

        <label >songs:</label>
        <input type="number" class="form-control" name="path" placeholder="Enter number of songs" required><br>

        <label >Image:</label>
        <input type="text" class="form-control" name="image" placeholder="Enter image path" required><br>
        
    <button type="submit" class="btn btn-success" name="submit">Submit</button><br>
    <a class="btn btn-info" type="submit" name="cancel" href="admin.php">Cancel</a><br>
    </form>
</div>


</form>
  </body>
</html> -->