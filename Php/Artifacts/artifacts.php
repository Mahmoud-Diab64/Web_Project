<?php
session_start();

if (isset($_POST['submit'])) {

    $name        = $_POST['Name'];
    $locId       = $_POST['Loc_Id'];      
    $cateId      = $_POST['Cate_Id'];     
    $desc        = $_POST['Decrption'];
    $shortDesc   = $_POST['Short_Desc'];
    $foundAt     = $_POST['FoundAt'];
    $artAge      = $_POST['Art_Age'];

    $imgName = $_FILES['Img']['name'];
    $tmpName = $_FILES['Img']['tmp_name'];
    $folder  = "../../UploadsForArtifacts/" . $imgName;

    if (move_uploaded_file($tmpName, $folder)) {

        require_once '../Config/config.php';

        $sql = "INSERT INTO artifacts 
                (Loc_Id, Cate_Id, Name, Decrption, Short_Desc, Img, FoundAt, Art_Age)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("iisssssi",
            $locId,
            $cateId,
            $name,
            $desc,
            $shortDesc,
            $imgName,
            $foundAt,
            $artAge
        );

        if ($stmt->execute()) {
            echo "<script>alert('Artifact Added Successfully');
            window.location='../../Html/index.php';</script>";
        } else {
            echo "<script>alert('Database Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        $con->close();

    } else {
        echo "<script>alert('Error uploading image');</script>";
    }
}
?>
