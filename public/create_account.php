<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
    <link rel="stylesheet" href="../css/login.css" class="css">
</head>
<body>
    <div class="signup-page">
        <form action="../includes/create_user.php" method="POST" class="fade-in">
            <p class="brand-name">geloverse.dev</p>
            <div class="login-greet">
                <h1>Hello there!</h1>
                <p>Create an account to continue</p>
            </div>
            <div class="username-in user-in">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter Username..." required>
            </div>
            <div class="email-in user-in">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Enter Email..." required>
            </div>
            <div class="pass-in user-in">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Password..." required>
            </div>
             <div class="confirmpass-in user-in">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm-password" placeholder="Confirm Password..." required>
            </div>
            <div class="agree-terms">
                <input type="checkbox" name="agree" value="yes">
                <p>I agree to the Terms and Conditions and Privacy Policy</p>
            </div>
            <button type="submit" name="signup">Sign up</button>
            <p class="login-link">Already have an account? <a href="login.php">Log-in</a> now</p>
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