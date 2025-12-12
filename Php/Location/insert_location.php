<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = 'Invalid request method';
    header('Location: ../../Admin/Add_Location.php');
    exit();
}

require_once '../Config/config.php';

// Check database connection
if (!$con) {
    $_SESSION['error'] = 'Database connection failed: ' . mysqli_connect_error();
    header('Location: ../../Html/Add_Location.php');
    exit();
}

try {
    // Validate input
    if (!isset($_POST['site']) || empty(trim($_POST['site']))) {
        $_SESSION['error'] = 'Location name is required';
        header('Location: ../../Html/Add_Location.php');
        exit();
    }
    
    $site = trim($_POST['site']);
    
    // Validate site name length
    if (strlen($site) < 2) {
        $_SESSION['error'] = 'Location name must be at least 2 characters';
        header('Location: ../../Html/Add_Location.php');
        exit();
    }
    
    if (strlen($site) > 255) {
        $_SESSION['error'] = 'Location name is too long (max 255 characters)';
        header('Location: ../../Html/Add_Location.php');
        exit();
    }
    
    // Check if location already exists
    $checkSql = "SELECT Loc_ID FROM location WHERE Site = ?";
    $checkStmt = $con->prepare($checkSql);
    
    if (!$checkStmt) {
        $_SESSION['error'] = 'Database error: ' . $con->error;
        header('Location: ../../Html/Add_Location.php');
        exit();
    }
    
    $checkStmt->bind_param("s", $site);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        $_SESSION['error'] = 'Location name already exists! Please choose a different name.';
        $checkStmt->close();
        $con->close();
        header('Location: ../../Html/Add_Location.php');
        exit();
    }
    $checkStmt->close();
    
    // Insert new location
    $insertSql = "INSERT INTO location (Site) VALUES (?)";
    $insertStmt = $con->prepare($insertSql);
    
    if (!$insertStmt) {
        $_SESSION['error'] = 'Database error: ' . $con->error;
        $con->close();
        header('Location: ../../Html/Add_Location.php');
        exit();
    }
    
    $insertStmt->bind_param("s", $site);
    
    if ($insertStmt->execute()) {
        $_SESSION['success'] = 'Location added successfully! ✅';
        $insertStmt->close();
        $con->close();
        header('Location: ../../Html/Location.php');
        exit();
    } else {
        $_SESSION['error'] = 'Failed to add location: ' . $insertStmt->error;
        $insertStmt->close();
        $con->close();
        header('Location: ../../Html/Add_Location.php');
        exit();
    }
    
} catch (Exception $e) {
    $_SESSION['error'] = 'Exception: ' . $e->getMessage();
    if (isset($con)) {
        $con->close();
    }
    header('Location: ../../Html/Add_Location.php');
    exit();
}

?>
