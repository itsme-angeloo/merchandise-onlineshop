<?php
    session_start();
    require '../db/db_connection.php';


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login_email = $_POST['email'];
        $login_pass = $_POST['password'];

        if(isset($_POST['login'])){

            $stmt = $conn->prepare('SELECT * FROM users WHERE email=?');
            $stmt->bind_param('s', $login_email);
            $stmt->execute();
            $results = $stmt->get_result();
            
            while($row = $results->fetch_assoc()){
                if(password_verify($login_pass, $row['password'])){
                    if($row['user_type'] == 'customer'){
                        $_SESSION['customer-id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $login_email;
                        $_SESSION['loggedin'] = true;

                        header('Location: ../public/customer_page.php?category=All');
                        exit;  
                    }else if($row['user_type'] == 'admin'){
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $login_email;
                        $_SESSION['loggedin'] = true;

                        header('Location: ../public/customer_page.php'); // Change it to admin
                        exit;  
                    }
                    
                }else{
                    $_SESSION['loggedin'] = false;
                    $_SESSION['login-error'] = 'Email and Password does not match!';
                    header('Location: ../public/login.php');
                }
            }
        }
    }
?>