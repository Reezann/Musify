<?php

    $conn = mysqli_connect('localhost','root','','musify');

    if($conn->connect_error){
        die("Connection failed".$conn->connection_error);
    }
    echo " ";

?>