<?php

require("../assets/vendor/PHPMailer/src/PHPMailer.php");
require("../assets/vendor/PHPMailer/src/SMTP.php");

 $mail = new PHPMailer\PHPMailer\PHPMailer();
 $mail->IsSMTP(); // enable SMTP
 $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
 $mail->SMTPAuth = true; // authentication enabled
 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
 $mail->Host = "mail.contacto@krnivoro.com.com";
 $mail->Port = 465; //465  or 587
 $mail->IsHTML(true);
 $mail->Username = "contacto@krnivoro.com";
 $mail->Password = "Krniv@r@";
 $mail->SetFrom("contacto@krnivoro.com");
 $mail->Subject = "Contacto Desde : Contacto Krnivoro WebSite";
 
 $name = $_POST['name'];
 $email = $_POST['email'];
 $company = $_POST['company'];
 $subject = $_POST['subject'];
 $message = $_POST['message'];

 
 $mail->Body = "Nombre: {$name}  <br> Correo Electronico: {$email} <br> Asunto : {$subject} <br> Mensaje : {$message}";
 $mail->AddAddress("contacto@krnivoro.com");
 if(!$mail->Send()) {
 echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
 echo "OK";
 }

   // Validate reCAPTCH Response
/*if(isset($_POST['g-recaptcha-response'])) {
   // RECAPTCHA SETTINGS
   $captcha = $_POST['g-recaptcha-response'];
   $ip = $_SERVER['REMOTE_ADDR'];
   $key = '6Lfwi24gAAAAAN_yYd6f2hBlFDZA7AKHfFli3eWt';
   $url = 'https://www.google.com/recaptcha/api/siteverify';

   define('SITE_KEY', '6Lfwi24gAAAAAG7R525-_yDyiqqu8As3fo3IxOKD');
   define('SECRET_KEY', '6Lfwi24gAAAAAN_yYd6f2hBlFDZA7AKHfFli3eWt');

   // RECAPTCH RESPONSE
   $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
   $data = json_decode($recaptcha_response);

   if(isset($data->success) &&  $data->success === true) {
   }
   else {
      die('Your account has been logged as a spammer, you cannot continue!');
   }
 }
*/
 ?>