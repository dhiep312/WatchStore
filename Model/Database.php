<?php
$conn = mysqli_connect('127.0.0.1','root','12345678','db_asm');

if (!$conn) {
    echo 'Connection error :' . mysqli_connect_error();
}
?>