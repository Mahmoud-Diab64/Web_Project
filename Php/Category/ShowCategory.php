<?php
header('Content-Type: application/json');

require_once '../Config/config.php';

if (!$con) {
    echo json_encode([
        'success' => false, 
        'message' => 'Database connection failed'
    ]);
    exit();
}

try {
    $sql = "SELECT c.*, COUNT(a.Art_Id) as artifact_count 
            FROM categories c
            LEFT JOIN artifacts a ON c.Cate_Id = a.Cate_Id
            GROUP BY c.Cate_Id
            ORDER BY c.Cate_Id DESC";
    
    $result = $con->query($sql);
    
    $categories = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    
    echo json_encode([
        'success' => true,
        'categories' => $categories
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$con->close();
?>