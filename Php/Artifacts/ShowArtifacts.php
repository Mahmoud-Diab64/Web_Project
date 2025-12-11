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
    $sql = "SELECT a.*,
        c.Cate_Name,
        l.Loc_Name
        FROM artifacts a
        LEFT JOIN categories c ON a.Cate_Id = c.Cate_Id
        LEFT JOIN locations l ON a.Loc_Id = l.Loc_Id
        ORDER BY a.Art_Id DESC;";
    
    $result = $con->query($sql);
    
    $artifacts = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $artifacts[] = $row;
        }
    }
    
    echo json_encode([
        'success' => true,
        'artifacts' => $artifacts
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$con->close();
?>