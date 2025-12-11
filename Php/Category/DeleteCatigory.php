<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

require_once '../Config/config.php';

if (!$con) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

try {
    $cate_id = $_POST['cate_id'];
    
    $checkSql = "SELECT COUNT(*) as count FROM artifacts WHERE Cate_Id = ?";
    $checkStmt = $con->prepare($checkSql);
    $checkStmt->bind_param("i", $cate_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $count = $result->fetch_assoc()['count'];
    $checkStmt->close();
    
    if ($count > 0) {
        echo json_encode([
            'success' => false, 
            'message' => "Cannot delete: $count artifacts using this category"
        ]);
        exit();
    }
    
    $imgSql = "SELECT Img FROM categories WHERE Cate_Id = ?";
    $imgStmt = $con->prepare($imgSql);
    $imgStmt->bind_param("i", $cate_id);
    $imgStmt->execute();
    $imgResult = $imgStmt->get_result();
    $imgData = $imgResult->fetch_assoc();
    $imgStmt->close();
    
    $sql = "DELETE FROM categories WHERE Cate_Id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $cate_id);
    
    if ($stmt->execute()) {
        if ($imgData && !empty($imgData['Img'])) {
            $imgPath = "../../../UploadsForCategory/" . $imgData['Img'];
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
        
        echo json_encode([
            'success' => true, 
            'message' => 'Category deleted successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to delete category'
        ]);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ]);
}

$con->close();
?>