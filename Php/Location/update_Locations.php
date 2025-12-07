<?php
// fetch_location.php - Separate PHP Logic File
require_once '../Php/Config/config.php';

// Get location ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: Location.php");
    exit;
}

$id = intval($_GET['id']);

// Fetch location data
$sql = "SELECT Loc_ID, Site FROM location WHERE Loc_ID = ?";
$stmt = $con->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $con->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Location not found!";
    header("Location: Location.php");
    exit;
}

$location = $result->fetch_assoc();
$stmt->close();
$con->close();
?>