<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css" class="css">
</head>
<body>
    <div class="forgotpass-page">
        <form action="../includes/forgot_user_pass.php" method="POST">
            <p class="brand-name">geloverse.dev</p>
            <div class="forgotpass-greet">
                <h1>Forgot your password?</h1>
                <p>Enter your email below</p>
            </div>
            <div class="email-in user-in">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Enter Email..." required>
            </div>
            <button type="submit" name="login">Submit</button>
            <p class="forgotpass-link">Go back to <a href="login.php">Log in</a></p>
        </form>
    </div>
</body>
</html>