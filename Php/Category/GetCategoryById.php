<?php
// Php/Category/GetCategoryById.php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once '../Config/config.php';

if (!$con) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit();
}

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'No ID provided']);
    exit();
}

$cate_id = (int)$_GET['id'];

if ($cate_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid category ID']);
    exit();
}

try {
    $sql = "SELECT * FROM categories WHERE Cate_Id = ?";
    $stmt = $con->prepare($sql);
    
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $con->error]);
        exit();
    }
    
    $stmt->bind_param("i", $cate_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'category' => $category
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Category not found'
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