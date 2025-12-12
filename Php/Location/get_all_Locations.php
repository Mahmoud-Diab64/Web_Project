<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/config.php';

try {
    $sql = "SELECT Loc_ID, Site FROM location ORDER BY Loc_ID DESC";
    $result = $con->query($sql);

    if ($result === false) {
        throw new Exception($con->error);
    }

    $locations = array();

    while ($row = $result->fetch_assoc()) {
        $locations[] = array(
            'id' => $row['Loc_ID'],
            'site' => $row['Site']
        );
    }

    echo json_encode(array(
        'success' => true,
        'data' => $locations,
        'count' => count($locations)
    ));

} catch (Exception $e) {
    echo json_encode(array(
        'success' => false,
        'error' => $e->getMessage()
    ));
}

$con->close();
?>