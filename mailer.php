<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';




$mail = new PHPMailer(true);


   
   
   
   
   
   
   
   
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   =
    'example@example.com';                     //SMTP username
    $mail->Password   = 'YourPassword';                               //SMTP password
    $mail->SMTPSecure = 'ssl';
    
    
    
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    
 $mail->isHTML(true);
  $mail->SMTPDebug = 3;
