<?php

if(isset($_POST['submit'])) {

    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    $conn = mysqli_connect("localhost", "root", "", "Heritage", "3307");

    if(!$conn) {
        die(mysqli_connect_error());
    }
    $query = "INSERT INTO `users`(`Name`, `Email`, `Password`, `Role`) 
        VALUES ('$name', '$email', '$pass', 'User')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));

}

?>
