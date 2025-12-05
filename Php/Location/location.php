<?php
session_start();

if (isset($_POST['submit'])) {
    $site = $_POST['site'];

        require_once '../Config/config.php';

        $sql = "INSERT INTO location ('site') VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $site);

        if($stmt->execute()) {
            echo "<script>alert('location Added Successfully'); 
            window.location='../../Html/index.php';</script>";
        } else {
            echo "<script>alert('Database Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        $conn->close();
}
?>
