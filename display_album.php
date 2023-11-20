<?php

echo"<div class='gridViewContainer'>";

    $query = mysqli_query($conn,"SELECT * FROM album");

    while($row = mysqli_fetch_array($query)){
        echo "<div class='gridViewItem'>
            <a href='disp_album_songs.php?album_id=" . $row['id'] . "'>
                <img src='" . $row['img'] . "'>
                <div class='gridViewInfo'>" . $row['title'] . "</div>
            </a>
        </div>";
    }
    

echo"</div>";
?>