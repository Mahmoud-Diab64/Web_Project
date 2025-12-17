<?php
session_start();

if (isset($_POST['submit'])) {

    if(empty($_POST['Name']) || empty($_POST['Loc_Id']) || empty($_POST['Cate_Id'])) {
        echo "<script>
                alert('Please fill all required fields! ❌');
                window.history.back();
              </script>";
        exit();
    }

    $name        = trim($_POST['Name']);
    $locId       = intval($_POST['Loc_Id']);      
    $cateId      = intval($_POST['Cate_Id']);     
    $desc        = trim($_POST['desc']);
    $shortDesc   = trim($_POST['Short_Desc']);
    $foundAt     = trim($_POST['FoundAt']);
    $artAge      = !empty($_POST['Art_Age']) ? intval($_POST['Art_Age']) : null;

    if(!isset($_FILES['Img']) || $_FILES['Img']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>
                alert('Please select an image! ❌');
                window.history.back();
              </script>";
        exit();
    }

    $imgName = $_FILES['Img']['name'];
    $tmpName = $_FILES['Img']['tmp_name'];
    $fileSize = $_FILES['Img']['size'];
    
    if($fileSize > 5 * 1024 * 1024) {
        echo "<script>
                alert('Image size must be less than 5MB! ❌');
                window.history.back();
              </script>";
        exit();
    }
    
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $fileType = $_FILES['Img']['type'];
    
    if(!in_array($fileType, $allowedTypes)) {
        echo "<script>
                alert('Only JPG, PNG, and GIF images are allowed! ❌');
                window.history.back();
              </script>";
        exit();
    }
    
    $extension = pathinfo($imgName, PATHINFO_EXTENSION);
    $uniqueName = uniqid('artifact_', true) . '.' . $extension;
    $folder = "../../UploadsForArtifacts/" . $uniqueName;

    if (!file_exists("../../UploadsForArtifacts/")) {
        mkdir("../../UploadsForArtifacts/", 0777, true);
    }

    if (move_uploaded_file($tmpName, $folder)) {

        require_once '../Config/config.php';

        if(!$con) {
            echo "<script>
                    alert('Database connection failed! ❌');
                    window.history.back();
                  </script>";
            exit();
        }

        try {
            $sql = "INSERT INTO artifacts 
                    (Loc_Id, Cate_Id, Name, Descrption, Short_Desc, Img, FoundAt, Art_Age)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $con->prepare($sql);
            
            if(!$stmt) {
                throw new Exception("Query preparation failed: " . $con->error);
            }
            
            $stmt->bind_param("iisssssi",
                $locId,
                $cateId,
                $name,
                $desc,
                $shortDesc,
                $uniqueName,
                $foundAt,
                $artAge
            );

            if ($stmt->execute()) {
                $_SESSION['success'] = 'Artifact added successfully!';
                echo "<script>
                        window.location.href='../../Html/Show_art.php';
                      </script>";
            } else {
                if(file_exists($folder)) {
                    unlink($folder);
                }
                throw new Exception("Database insert failed: " . $stmt->error);
            }

            $stmt->close();
            $con->close();

        } catch (Exception $e) {
            echo "<script>
                    alert('Error: " . addslashes($e->getMessage()) . "');
                    window.history.back();
                  </script>";
            exit();
        }

    } else {
        echo "<script>
                alert('Error uploading image! Please check folder permissions. ❌');
                window.history.back();
              </script>";
        exit();
    }
} else {
    header('Location: ../../Admin/Add_Artifacts.php');
    exit();
}
?>