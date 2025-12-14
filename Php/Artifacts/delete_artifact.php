<?php
session_start();

if (isset($_POST['submit'])) {

    $artId = intval($_POST['Art_Id']);
    $imgName = $_POST['Img'];

    require_once '../Config/config.php';

    if (!$con) {
        echo "<script>alert('Database connection failed');
        window.location='../../Html/Show_art.php';</script>";
        exit();
    }

    $sql = "DELETE FROM artifacts WHERE Art_Id = ?";
    $stmt = $con->prepare($sql);
    
    if (!$stmt) {
        echo "<script>alert('Database Error: " . $con->error . "');
        window.location='../../Html/Show_art.php';</script>";
        exit();
    }
    
    $stmt->bind_param("i", $artId);

    if ($stmt->execute()) {
        if (!empty($imgName) && file_exists("../../UploadsForArtifacts/" . $imgName)) {
            unlink("../../UploadsForArtifacts/" . $imgName);
        }
        
        echo "<script>alert('Artifact Deleted Successfully');
        window.location='../../Html/Show_art.php';</script>";
    } else {
        echo "<script>alert('Database Error: " . $stmt->error . "');
        window.location='../../Html/Show_art.php';</script>";
    }

    $stmt->close();
    $con->close();

} else {
    echo "<script>alert('Invalid request'); window.location='../../Html/Show_art.php';</script>";
}
?>