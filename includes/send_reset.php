<?php
    require '../vendor/autoload.php';
    require 'config.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function sendResetEmail($email, $token){
         $mail = new PHPMailer(true);

         try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = GMAIL_USERNAME;
            $mail->Password = GMAIL_PASSWORD;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom(GMAIL_USERNAME, "Geloverse.dev Online Shop");
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Password Reset Request";
            $mail->Body = 'Click here to reset your password: <a href="http://localhost/onlineshop-merchandise/public/change_userpass.php?token=' . $token . '"> Reset Password</a>';

            $mail->send();
            return true;
         }catch(Exception $e){
            error_log('Message could not be sent: Mailer Error:  . {$mail->ErrorInfo}');
            return false;
         }
    }

?>