<?php
session_start();

require_once '../Config/config.php';

error_reporting(E_ALL);
ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request");
}

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}


if (!isset($_POST['site']) || empty(trim($_POST['site']))) {
    die("Location name is required");
}

$site = trim($_POST['site']);

$checkSql = "SELECT Loc_ID FROM location WHERE Site = ?";
$checkStmt = $con->prepare($checkSql);
$checkStmt->bind_param("s", $site);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    die("Location already exists");
}
$checkStmt->close();

$sql = "INSERT INTO location (Site) VALUES (?)";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Database error: " . $con->error);
}

$stmt->bind_param("s", $site);

if ($stmt->execute()) {

    
    $_SESSION['success'] = "Location added successfully";

    
    header("Location:../../Html/Location.php");
    exit();

} else {
    die("Failed to insert location: " . $stmt->error);
}



?>
