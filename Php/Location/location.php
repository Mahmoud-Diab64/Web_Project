<?php
session_start();

if (isset($_POST['submit'])) {

    $name = $_POST['Name'];
    $site = $_POST['site'];

        require_once '../Config/config.php';

        $sql = "INSERT INTO categories (Cate_Name, Img) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $imgName);

        if($stmt->execute()) {
            echo "<script>alert('Category Added Successfully'); 
            window.location='../../Html/index.php';</script>";
        } else {
            echo "<script>alert('Database Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        $conn->close();
}
?>
