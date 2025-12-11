<?php
// get_Location_By_Id.php
header('Content-Type: application/json');
require_once '../Config/config.php';

// Get location ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No location ID provided'
    ]);
    exit;
}

$id = intval($_GET['id']);

try {
    // Fetch location data
    $sql = "SELECT Loc_ID as id, Site as site FROM location WHERE Loc_ID = ?";
    $stmt = $con->prepare($sql);
    
    if ($stmt === false) {
        throw new Exception("Error preparing statement: " . $con->error);
    }
    
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Location not found'
        ]);
        exit;
    }
    
    $location = $result->fetch_assoc();
    
    echo json_encode([
        'success' => true,
        'data' => $location
    ]);
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$con->close();
?>