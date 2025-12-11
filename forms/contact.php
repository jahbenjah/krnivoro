<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'contacto@krnivoro.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->company = $_POST['company'];
  $contact->subject = $_POST['subject'];
  $contact->message = $_POST['message'];


  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  ); /*
 

  $contact->add_message($_POST['name'], 'Nombre');
  $contact->add_message($_POST['email'], 'Email');
  $contact->add_message($_POST['company'], 'Empresa');
  $contact->add_message($_POST['subject'], 'Asunto');
  $contact->add_message($_POST['message'], 'Mensaje', 10);

  echo $contact->send();
 

  /*
  $to = "contacto@krnivoro.com";
  $subject = "Nuevo contacto desde el sitio web";

  $name = $_POST['name'];
  $email = $_POST['email'];
  $company = $_POST['company'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  //Cuerpo
  $body = "Nombre: $name\n";
  $body .= "Email:" . $email . "\n";
  $body .= "Compañia:" . $company . "\n";
  $body .= "Asunto:" . $subject . "\n\n";
  $body .= "Mensaje:\n" . $message;
  
  //Encabezados
  $headers = "From: $email\r\n";
  $headers = "Reply-To: $email\r\n";

  //Envia correo
  if(mail($to,$subject,$body,$headers)) {
    echo "sucess";
  } else {
    echo "error";
  }
  // Redirigir con éxito
*/
?>
