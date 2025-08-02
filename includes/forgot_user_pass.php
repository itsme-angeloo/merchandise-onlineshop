<?php
    require 'send_reset.php';
    require '../db/db_connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $user_email = $_POST['email'];
        
        $token = bin2hex(random_bytes(32));
        $token_expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $conn->prepare('UPDATE users SET token = ?, token_expires = ? WHERE email=?');
        $stmt->execute([$token, $token_expires, $user_email]);

        if(sendResetEmail($user_email, $token)){
            echo 'Check your email for the reset link.';
        }else {
            echo "Failed to send reset email.";
        }
    }
?>