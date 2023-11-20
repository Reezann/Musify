<?php
session_start();
include "config.php";
$error = [];

if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $password = $_POST['password'];

    $select = "SELECT * FROM users WHERE username='$uname' AND password='$password'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_array($result);

        // Setting session variables
        $_SESSION['uname'] = $uname;
        $_SESSION['user_id'] = $res['id'];

        header('location: index.php');

    } else {
        $error[] = 'Incorrect username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="stylee.css" >
     
</head>
<body>
    <div class="form-container">
        <form action="" method="post" class="form">
            <h3>Login</h3>
            <?php
            if (!empty($error)) {
                foreach ($error as $err) {
                    echo '<span class="error-msg">' . $err . '</span>';
                }
            }
            ?>
            <input type="text" name="uname" placeholder="Enter your username" class="box" required>
            <input type="password" name="password" placeholder="Enter password" class="box" required>
            <input type="submit" value="Login now" name="submit" class="form-btn">
            <p>Don't have an account?<br> <a href="register.php">Register now</a></p>
        </form>
    </div>
</body>
</html>
