<?php
session_start();
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

require_once '../Config/config.php';

if (!$con) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit();
}

try {
    if (!isset($_POST['cate_id']) || !isset($_POST['Name']) || !isset($_POST['old_img'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit();
    }
    
    $cate_id = (int)$_POST['cate_id'];
    $name = trim($_POST['Name']);
    $old_img = $_POST['old_img'];
    
    if (empty($name)) {
        echo json_encode(['success' => false, 'message' => 'Category name is required']);
        exit();
    }
    
    if ($cate_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid category ID']);
        exit();
    }
    
    $checkSql = "SELECT Cate_Id FROM categories WHERE Cate_Name = ? AND Cate_Id != ?";
    $checkStmt = $con->prepare($checkSql);
    
    if (!$checkStmt) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $con->error]);
        exit();
    }
    
    $checkStmt->bind_param("si", $name, $cate_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Category name already exists']);
        $checkStmt->close();
        $con->close();
        exit();
    }
    $checkStmt->close();
    
    $img_name = $old_img; 
    
    if (isset($_FILES['Img']) && $_FILES['Img']['error'] === UPLOAD_ERR_OK) {
        $imgTmpName = $_FILES['Img']['tmp_name'];
        $imgSize = $_FILES['Img']['size'];
        $imgOriginalName = $_FILES['Img']['name'];
        
        if ($imgSize > 5 * 1024 * 1024) {
            echo json_encode(['success' => false, 'message' => 'Image size must be less than 5MB']);
            $con->close();
            exit();
        }
        
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $imgType = finfo_file($finfo, $imgTmpName);
        finfo_close($finfo);
        
        if (!in_array($imgType, $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => 'Only JPG, PNG and GIF images are allowed']);
            $con->close();
            exit();
        }
        
        $imgExtension = pathinfo($imgOriginalName, PATHINFO_EXTENSION);
        $uniqueImgName = uniqid('cat_', true) . '.' . $imgExtension;
        
        $uploadPath = "../../UploadsForCategory/" . $uniqueImgName;
        
        if (move_uploaded_file($imgTmpName, $uploadPath)) {
            $oldImgPath = "../../UploadsForCategory/" . $old_img;
            if (file_exists($oldImgPath) && $old_img !== $uniqueImgName) {
                @unlink($oldImgPath);
            }
            
            $img_name = $uniqueImgName;
        } else {
            echo json_encode(['success' => false, 'message' => 'Error uploading new image. Check folder permissions.']);
            $con->close();
            exit();
        }
    }
    
    $sql = "UPDATE categories SET Cate_Name = ?, Img = ? WHERE Cate_Id = ?";
    $stmt = $con->prepare($sql);
    
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $con->error]);
        $con->close();
        exit();
    }
    
    $stmt->bind_param("ssi", $name, $img_name, $cate_id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0 || $stmt->affected_rows === 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Category updated successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No changes made or category not found'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update category: ' . $stmt->error
        ]);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Exception: ' . $e->getMessage()
    ]);
}

$con->close();
?>