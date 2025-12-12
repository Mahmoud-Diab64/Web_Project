<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "heritage";

$con=mysqli_connect($host,$user,$pass,$db,3307);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
