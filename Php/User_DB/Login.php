<?php
session_start();

if(isset($_POST['submit'])) {

    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    require_once '../Config/config.php'; 
    if(!$conn) {
        die(mysqli_connect_error());
    }

    $sql = "SELECT * FROM users WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($pass === $user["Password"]) {
            $_SESSION["Name"] = $user["Name"];
            echo "<script>alert('Login successful!'); window.location='index.html';</script>";
            header('location:../Html/Home.php');
        } else {
            echo "<script>alert('Incorrect password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('No user found with this email!'); window.history.back();</script>";
    }
}
?>