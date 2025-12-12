<?php
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    if ($id <= 0) {
        echo "<script>
            alert('Invalid location ID');
            window.location='../../Html/location.php';
        </script>";
        exit;
    }
    
    require_once '../Config/config.php';
    
    $check_sql = "SELECT Loc_ID FROM location WHERE Loc_ID = ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows === 0) {
        echo "<script>
            alert('Location not found');
            window.location='../../Html/location.php';
        </script>";
        $check_stmt->close();
        $con->close();
        exit;
    }
    $check_stmt->close();
    
    $sql = "DELETE FROM location WHERE Loc_ID = ?";
    $stmt = $con->prepare($sql);
    
    if ($stmt === false) {
        echo "<script>
            alert('Error preparing query: " . $con->error . "');
            window.location='../../Html/location.php';
        </script>";
        exit;
    }
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>
            alert('Location deleted successfully ✅');
            window.location='../../Html/location.php';
        </script>";
    } else {
        echo "<script>
            alert('Database error: " . $stmt->error . "');
            window.location='../../Html/location.php';
        </script>";
    }
    
    $stmt->close();
    $con->close();
} else {
    header("Location: ../../Html/location.php");
    exit;
}
?>
