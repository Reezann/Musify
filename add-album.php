<?php
include "config.php";

$no = $_GET['no'];
$title = $_GET['title'];

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $path = $_POST['path'];
    $q = "INSERT INTO `songs`(`title`,`path`) VALUES ('$title','$path')";
    $query = mysqli_query($conn, $q);
}

?>

<!DOCTYPE html>
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

<?php
$counter = 1;
while ($counter <= $no) {
    echo "<div class='formm'>
          <form method='post'>
              <label>Title:</label>
              <input type='text' class='form-control' name='title' placeholder='Enter title of song.' required><br>

              <label>Path:</label>
              <input type='text' class='form-control' name='path' placeholder='Enter Music path' required><br>

              <button type='submit' class='btn btn-success' name='submit'>Submit</button><br>
              <a class='btn btn-info' type='submit' name='cancel' href='admin.php'>Cancel</a><br>
          </form>
        </div>";
    $counter++;
}

?>

</body>
</html>
