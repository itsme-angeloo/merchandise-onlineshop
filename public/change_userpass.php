<?php
    session_start();
    require '../db/db_connection.php';

    $token = $_GET['token'] ?? '';

    if(!$token){
        die('Invalid or Missing token');
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $confirm_pass = $_POST['confirm-pass'];
        $password = $_POST['new-pass'];

        if(isset($_POST['change-pass'])){
            if(!$confirm_pass || !$password){
            $error = 'Please Fill in the fields';
        }elseif($password !== $confirm_pass){
            $error = 'Password do not match!';
        }else{

            $mysqlstmt = $conn->prepare('SELECT * FROM users WHERE token = ? AND token_expires < NOW()');
            $mysqlstmt->bind_param('s', $token);
            $mysqlstmt->execute();
            $result = $mysqlstmt->get_result(); //This shit stress me out
            echo "Rows found: " . $result->num_rows; // Debug line

            $user = $result->fetch_assoc();

            if ($user){
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $update = $conn->prepare("UPDATE users SET password = ?, token = NULL, token_expires = NULL WHERE id=?");
                $update->bind_param('si', $hashed_password, $user['id']);
                $update->execute();

                header('Location: login.php');
                $_SESSION['success'] = 'Your password has been reset successfully!';
                exit;
            }else{
                $error = 'Invalid or Expired Token';
            }
        }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../css/login.css" class="css">
</head>
<body>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <div class="forgotpass-page">
        <form action="" method="POST">
            <p class="brand-name">geloverse.dev</p>
            <div class="forgotpass-greet">
                <h1>Change your Password</h1>
                <p>Note: Save or write it down you password</p>
            </div>
            <div class="pass-in user-in">
                <label for="email">Password</label>
                <input type="text" name="new-pass" placeholder="Enter password..." required>
            </div>
            <div class="pass-in user-in">
                <label for="email">Confirm Password</label>
                <input type="text" name="confirm-pass" placeholder="Confirm password..." required>
            </div>
            <button type="submit" name="change-pass">Change Password</button>
            <p class="forgotpass-link">Go back to <a href="login.php">Log in</a></p>
        </form>
    </div>
</body>
</html>