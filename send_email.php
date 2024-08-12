<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
$name = $_POST['name'];
$email = $_POST['email'];
$query = $_POST['query'];
if ($name == "" || $email == "") {

    echo 'enter email and name correctly';
} else {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host  = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '*******';        //add username             //SMTP username
            $mail->Password   = '*******';         //add password                      //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients

            $mail->setFrom($email, $name);
            $mail->addAddress("*******", 'reciever');     //Add a recipient
            $mail->addReplyTo($email, $name);
            $mail->addCC($email, $name);


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "From: {$name} <{$email}>";
            $mail->Body    = $query;


            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent";
        }
    } else {
        echo "enter a valid email address";
    }
}
