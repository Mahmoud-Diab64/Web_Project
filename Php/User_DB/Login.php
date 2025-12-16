<?php
session_start();

if(isset($_POST['Login_Submit'])) {
    $email = trim($_POST['Email']);
    $pass = $_POST['Password'];   
    
    
    if(empty($email) || empty($pass)) {
        echo "<script>
                alert('Please fill in all fields!');
                window.history.back();
              </script>";
        exit();
    }
    
    require_once '../Config/config.php'; 
    
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    try {
       
        $sql = "SELECT * FROM users WHERE Email = ?";
        $stmt = $con->prepare($sql);
        
        if(!$stmt) {
            throw new Exception("Query preparation failed: " . $con->error);
        }
        
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
                $_SESSION["logged_in"] = true;

        
                if ($user["Role"] === "Admin" || $user["Role"] === "admin") {
                    echo "<script>
                            alert('Welcome Admin! Login successful ✅');
                            window.location.href='../../Html/dashboard.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Welcome! Login successful ✅');
                            window.location.href='../../Html/index.php';
                          </script>";
                }
                exit();
            } else {
                echo "<script>
                        alert('Incorrect password! ❌');
                        window.history.back();
                      </script>";
                exit();
            }
        } else {
            echo "<script>
                    alert('No user found with this email! ❌');
                    window.history.back();
                  </script>";
            exit();
        }
        
        $stmt->close();
        
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . addslashes($e->getMessage()) . "');
                window.history.back();
              </script>";
        exit();
    } finally {
        if(isset($con) && $con) {
            mysqli_close($con);
        }
    }
} else {
    
    header('Location: ../../Html/login.php');
    exit();
}
?>