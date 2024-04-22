<?php

// Send email message (SMTP MAİL)

function sendMail_smtp($who, $msg, $name, $subject){

  require_once('./inc/class.phpmailer.php');

  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = 'mail.turkexpo.org';
  $mail->Port = 465;
  $mail->SMTPSecure = 'ssl';
  $mail->Subject = $subject;
  $mail->Username = 'info@turkexpo.org';
  $mail->Password = 'i7hQ1iFEW541QW';
  $mail->SetFrom($mail->Username, "TurkExpo");
  $mail->AddAddress($who, $name);
  $mail->CharSet = 'UTF-8';
  $content = $msg;
  $mail->MsgHTML($content);

  if($mail->Send()) {
      return true;
  } else {
      return false;
  }

}

?>