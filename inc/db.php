<?php 
$conn = mysqli_connect('localhost:3307','root','','pfe4'); 
if (!$conn) {
    echo 'ERROR:' . mysqli_connect_error();
}

