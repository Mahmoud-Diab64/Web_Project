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

$artId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($artId <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid artifact ID: ' . $artId
    ]);
    exit();
}

try {
    $sql = "SELECT a.*,
        c.Cate_Name,
        l.Site as Loc_Name
        FROM artifacts a
        LEFT JOIN categories c ON a.Cate_Id = c.Cate_Id
        LEFT JOIN location l ON a.Loc_Id = l.Loc_ID
        WHERE a.Art_Id = ?";
    
    $stmt = $con->prepare($sql);
    
    if (!$stmt) {
        echo json_encode([
            'success' => false,
            'message' => 'Prepare failed: ' . $con->error
        ]);
        exit();
    }
    
    $stmt->bind_param("i", $artId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $artifact = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'artifact' => $artifact
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Artifact not found'
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