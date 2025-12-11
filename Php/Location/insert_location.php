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
    if (!isset($_POST['id']) || !isset($_POST['site'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit();
    }
    
    $id = (int)$_POST['id'];
    $site = trim($_POST['site']);
    
    if (empty($site)) {
        echo json_encode(['success' => false, 'message' => 'Location name is required']);
        exit();
    }
    
    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid location ID']);
        exit();
    }
    
    $checkSql = "SELECT Loc_ID FROM location WHERE Site = ? AND Loc_ID != ?";
    $checkStmt = $con->prepare($checkSql);
    
    if (!$checkStmt) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $con->error]);
        exit();
    }
    
    $checkStmt->bind_param("si", $site, $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Location name already exists']);
        $checkStmt->close();
        $con->close();
        exit();
    }
    $checkStmt->close();
    
    $sql = "UPDATE location SET Site = ? WHERE Loc_ID = ?";
    $stmt = $con->prepare($sql);
    
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $con->error]);
        $con->close();
        exit();
    }
    
    $stmt->bind_param("si", $site, $id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0 || $stmt->affected_rows === 0) {
            $_SESSION['success'] = 'Location updated successfully';
            echo json_encode([
                'success' => true,
                'message' => 'Location updated successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No changes made or location not found'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update location: ' . $stmt->error
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