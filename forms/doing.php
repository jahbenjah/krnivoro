<?php
// Configuración
$to = "contacto@krnivoro.com"; // Cambia esto por tu correo real
$subject = "Nuevo contacto desde KRNIVORO";

// Recoge los datos del formulario
$name = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
$email = isset($_POST['email']) ? strip_tags($_POST['email']) : '';
$company = isset($_POST['company']) ? strip_tags($_POST['company']) : '';
$subject = isset($_POST['subject']) ? strip_tags($_POST['subject']) : '';
$message = isset($_POST['message']) ? strip_tags($_POST['message']) : '';

// Formatea el mensaje
$message = "Nuevo contacto desde el formulario de KRNIVORO:\n\n";
$message .= "Nombre: $name\n";
$message .= "Correo: $email\n";
$message .= "Compania: $company\n";
$message .= "Asunto: $subject\n";
$message .= "Mensaje: $message\n";

// Cabeceras
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";

// Envía el correo
if(mail($to, $subject, $message, $headers)) {
  echo "OK";
} else {
  echo "Error al enviar el mensaje. Intenta de nuevo.";
}
?>