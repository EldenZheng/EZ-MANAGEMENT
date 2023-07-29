<?php
// Programmer Name : Elden Zheng, BSc(Hons) Software Engineering, TP058070, APD3F2211SE
// Program Name: mail.php
// Description: to send mail
// First Written on: Saturday, 1-Jul-2023
// Edited on: Friday, 21-Jul-2023
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer-master/src/Exception.php';
  require 'PHPMailer-master/src/PHPMailer.php';
  require 'PHPMailer-master/src/SMTP.php';

function send_mail($recipient,$subject,$message, $empName, $name)
{
  // Create a new PHPMailer instance
  $mail = new PHPMailer();
  // Set SMTP settings
  $mail->IsSMTP();
  $mail->SMTPDebug  = 0;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "ez.management.noreply@gmail.com";
  $mail->Password   = "trancajfenmyfpqk";

  // Set email content
  $mail->IsHTML(true);
  $mail->AddAddress($recipient, $empName);
  $mail->SetFrom("ez.management.noreply@gmail.com", $name);
  $mail->Subject = $subject;
  $content = $message;

  $mail->MsgHTML($content); 
  if(!$mail->Send()) {
    return false;
  } else {
    return true;
  }

}

?>