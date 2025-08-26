<?php
   session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>geloverse.dev login</title>
    <link rel="stylesheet" href="../css//login.css" class="css">
</head>
<body>
    <div class="login-page">
        <form action="../includes/log_user.php" method="POST" class="fade-in">
            <p class="brand-name">geloverse.dev</p>
            <div class="login-greet">
                <h1>Hello</h1>
                <p>Login to continue</p>
                <?php 
                    if(!empty($_SESSION['login-error'])){
                        echo '<p style="color:red; font-weight: 700">'. $_SESSION['login-error'] .'</p>';
                    }
                ?>
            </div>
            <div class="email-in user-in">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Enter Email..." required>
            </div>
            <div class="pass-in user-in">
                <label for="password">Password</label>
                <input type="text" name="password" placeholder="Enter Password..." required>
            </div>
            <div class="forgot-pass">
                <a href="forgot_pass.php">Forgot Password?</a>
            </div>
            <button type="submit" name="login">Log in</button>
            <p class="signup-link">Don't have an account? <a href="create_account.php">Sign-up</a> now</p>
        </form>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.fade-in').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 50) {
                el.classList.add('visible');
                }
            });
        });
    </script>
</body>
</html>