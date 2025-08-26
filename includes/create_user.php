<?php 
    require '../db/db_connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_name = htmlspecialchars($_POST['username']);
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $user_agree = isset($_POST['agree']) ? $_POST['agree'] : null;

        $created_at = date('Y-m-d H:i:s');
        

        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        if(isset($_POST['signup'])){
            if($user_password != $confirm_password){
                echo '<script>alert("Password do not match. Please try again!")</script>';
            }else if($user_agree != 'yes'){
                echo '<script>alert("You must agree to the Terms and Conditions to proceed.")</script>';
            }else if($user_password === $confirm_password && $user_agree == 'yes'){
                $stmt = $conn->prepare('INSERT INTO users(username, email, password, created_at) VALUES(?,?,?,?)');
                $stmt->bind_param('ssss', $user_name, $user_email, $hashed_password, $created_at);
                $stmt->execute();
                $stmt->close();

                header('Location: ../public/login.php');
                exit;
            }
            
        }
    }

?>