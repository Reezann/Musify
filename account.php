<?php
   session_start();
   include 'config.php';
   include 'nav.php';

   $user_id = $_SESSION['user_id'];

   // Refresh data after update
   $query = "SELECT * FROM users WHERE id=$user_id";
   $result = mysqli_query($conn, $query);
   if (mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_array($result);
   }

   // Update user information if the form is submitted
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['upd_name'])) {
         // Handle name update
         $newName = mysqli_real_escape_string($conn, $_POST['newName']);
         $updateQuery = "UPDATE users SET name='$newName' WHERE id=$user_id";
         mysqli_query($conn, $updateQuery);
      }

      if (isset($_POST['upd_email'])) {
         // Handle email update
         $newEmail = mysqli_real_escape_string($conn, $_POST['newEmail']);
         $updateQuery = "UPDATE users SET email='$newEmail' WHERE id=$user_id";
         mysqli_query($conn, $updateQuery);
      }

      if (isset($_POST['upd_password'])) {
         // Handle password update
         $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
         $updateQuery = "UPDATE users SET password='$newPassword' WHERE id=$user_id";
         mysqli_query($conn, $updateQuery);
      }

      // Refresh data after update
      $query = "SELECT * FROM users WHERE id=$user_id";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
         $data = mysqli_fetch_array($result);
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="stylee.css">

   <style>
      /* Add your CSS styles here */
      .Container {
         height:auto;
         margin: auto;
         width:800px;
         padding: 20px;
         border-radius: 10px;
         background-color: #bb184c0d;
      }

      .Container div {
         margin-bottom: 10px;
         padding:10px 5px;
      }

      .Container label {
         font-weight: bold;
         font-size: 30px;
         color: #bb184b;
         display: inline-block;
      }

      .Container form{
         display: inline;
         margin: 0;
         cursor: pointer;
      }

      .Container form input{
         margin: 0;
         cursor: pointer;
      }

      input{
         font-size: 25px;
         font-weight:bold;
         background-color:#bb184c1d;
         height:25px;
         border-radius: 5px;
         padding: 5px;
      }

      .Container form {
         margin-top: 20px;
      }

      button {
         cursor:pointer;
         background-color:#bb184c96;
         height:25px;
         font-size: 18px;
         font-weight:bold;
         border-radius: 5px;
         padding: 5px;
      }
   </style>
</head>
<body>
   <div class="Container">
      <div>
         <label>Name:</label>
         <form method="post">
            <input type="text" id="newName" name="newName" value="<?php echo $data['name']; ?>">
            <button type="submit" name="upd_name" class="inn" value="Update">Update</button>
         </form>
      </div>
      <div>
         <label>Username:</label>
         <input type="text" id="newName" name="newName" value="<?php echo $data['username']; ?>">
      </div>
      <div>
         <label>Email:</label>
         <form method="post">
            <input type="email" id="newEmail" name="newEmail" value="<?php echo $data['email']; ?>">
            <button type="submit" name="upd_email" class="inn" value="Update">Update</button>
         </form>
      </div>
      <div>
         <label for="newPassword">Password:</label>
         <form method="post">
            <input type="password" id="newPassword" name="newPassword" value="<?php echo $data['password']; ?>">
            <button type="submit" name="upd_password" class="inn" value="Update">Update</button>
            <input type="radio" onclick="togglePassword()">
         </form>
      </div>
      <div>
         <label>SignUp Date:</label>
         <p style="display: inline;background-color:#bb184c1d;height:25px;font-size:25px;font-weight:bold;border-radius: 5px;"><?php echo $data['SignUpDate']; ?></p>
      </div>
   </div>

   <script>
      function togglePassword() {
         var x = document.getElementById("newPassword");
         if (x.type === "password") {
            x.type = "text";
         } else {
            x.type = "password";
         }
      }
   </script>
</body>
</html>
