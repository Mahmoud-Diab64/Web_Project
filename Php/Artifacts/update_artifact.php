<?php
// update_artifact.php
session_start();

if (isset($_POST['submit'])) {

    $artId       = $_POST['Art_Id'];
    $name        = $_POST['Name'];
    $locId       = $_POST['Loc_Id'];      
    $cateId      = $_POST['Cate_Id'];     
    $desc        = $_POST['Descrption'];
    $shortDesc   = $_POST['Short_Desc'];
    $foundAt     = $_POST['FoundAt'];
    $artAge      = $_POST['Art_Age'];
    $oldImg      = $_POST['Old_Img'];

    require_once '../Config/config.php';

    // Check if new image uploaded
    if (!empty($_FILES['Img']['name'])) {
        $imgName = $_FILES['Img']['name'];
        $tmpName = $_FILES['Img']['tmp_name'];
        $folder  = "../../UploadsForArtifacts/" . $imgName;

        if (move_uploaded_file($tmpName, $folder)) {
            // Delete old image if exists
            if (!empty($oldImg) && file_exists("../../UploadsForArtifacts/" . $oldImg)) {
                unlink("../../UploadsForArtifacts/" . $oldImg);
            }
            
            // Update with new image - using correct column names
            $sql = "UPDATE artifacts SET 
                    Loc_Id = ?, 
                    Cate_Id = ?, 
                    Name = ?, 
                    Descrption = ?, 
                    Short_Desc = ?, 
                    Img = ?, 
                    FoundAt = ?, 
                    Art_Age = ?
                    WHERE Art_Id = ?";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("iissssiii",
                $locId,
                $cateId,
                $name,
                $desc,
                $shortDesc,
                $imgName,
                $foundAt,
                $artAge,
                $artId
            );
        } else {
            echo "<script>alert('Error uploading new image');</script>";
            exit();
        }
    } else {
        // Update without changing image - using correct column names
        $sql = "UPDATE artifacts SET 
                Loc_Id = ?, 
                Cate_Id = ?, 
                Name = ?, 
                Descrption = ?, 
                Short_Desc = ?, 
                FoundAt = ?, 
                Art_Age = ?
                WHERE Art_Id = ?";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("iisssiii",
            $locId,
            $cateId,
            $name,
            $desc,
            $shortDesc,
            $foundAt,
            $artAge,
            $artId
        );
    }

    if ($stmt->execute()) {
        echo "<script>alert('Artifact Updated Successfully');
        window.location='../../Html/Show_art.php';</script>";
    } else {
        echo "<script>alert('Database Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $con->close();

} else {
    echo "<script>alert('Invalid request'); window.location='../../Html/Show_Artifacts.php';</script>";
}
?>