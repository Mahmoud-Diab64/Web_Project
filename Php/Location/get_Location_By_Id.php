<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/config.php';

if (!isset($_GET['id'])) {
    echo json_encode(array(
        'success' => false,
        'error' => 'Location ID is required'
    ));
    exit;
}

$id = intval($_GET['id']);

if ($id <= 0) {
    echo json_encode(array(
        'success' => false,
        'error' => 'Invalid location ID'
    ));
    exit;
}

try {
    $sql = "SELECT Loc_ID, Site FROM location WHERE Loc_ID = ?";
    $stmt = $con->prepare($sql);
    
    if ($stmt === false) {
        throw new Exception($con->error);
    }
    
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $location = $result->fetch_assoc();
        echo json_encode(array(
            'success' => true,
            'data' => array(
                'id' => $location['Loc_ID'],
                'site' => $location['Site']
            )
        ));
    } else {
        echo json_encode(array(
            'success' => false,
            'error' => 'Location not found'
        ));
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode(array(
        'success' => false,
        'error' => $e->getMessage()
    ));
}

$con->close();
?>