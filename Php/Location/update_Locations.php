<?php
// update_Locations.php
header('Content-Type: application/json');
require_once '../Config/config.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
    exit;
}

// Validate inputs
if (!isset($_POST['id']) || !isset($_POST['site'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Missing required fields'
    ]);
    exit;
}

$id = intval($_POST['id']);
$site = trim($_POST['site']);

// Validate site name
if (empty($site)) {
    echo json_encode([
        'success' => false,
        'message' => 'Location name cannot be empty'
    ]);
    exit;
}

try {
    // Check if location exists
    $checkSql = "SELECT Loc_ID FROM location WHERE Loc_ID = ?";
    $checkStmt = $con->prepare($checkSql);
    
    if ($checkStmt === false) {
        throw new Exception("Error preparing check statement: " . $con->error);
    }
    
    $checkStmt->bind_param("i", $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows === 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Location not found'
        ]);
        exit;
    }
    
    $checkStmt->close();
    
    // Update location
    $updateSql = "UPDATE location SET Site = ? WHERE Loc_ID = ?";
    $updateStmt = $con->prepare($updateSql);
    
    if ($updateStmt === false) {
        throw new Exception("Error preparing update statement: " . $con->error);
    }
    
    $updateStmt->bind_param("si", $site, $id);
    
    if ($updateStmt->execute()) {
        if ($updateStmt->affected_rows > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Location updated successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No changes made'
            ]);
        }
    } else {
        throw new Exception("Error updating location: " . $updateStmt->error);
    }
    
    $updateStmt->close();
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$con->close();
?>