<?php
session_start();

if(isset($_POST['Login_Submit'])) {
    $email = $_POST['Email'];
    $pass = $_POST['Password'];   
    
    require_once '../Config/config.php'; 
    
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT * FROM users WHERE Email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($pass, $user["Password"])) {
            $_SESSION["Name"] = $user["Name"];
            $_SESSION["User_Id"] = $user["User_Id"];
            $_SESSION["Role"] = $user["Role"];
            $_SESSION["Email"] = $user["Email"];
            
            echo "<script>alert('Login successful!'); window.location='../../Html/index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Incorrect password!'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('No user found with this email!'); window.history.back();</script>";
        exit();
    }
    
    $stmt->close();
    mysqli_close($con);
}
?>