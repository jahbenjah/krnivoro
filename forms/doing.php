<?php
// Configuración
$to = "contact@example.com"; // Cambia esto por tu correo real
$subject = "Nuevo contacto desde KRNIVORO";

// Recoge los datos del formulario
$name = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
$email = isset($_POST['email']) ? strip_tags($_POST['email']) : '';
$phone = isset($_POST['phone']) ? strip_tags($_POST['phone']) : '';
$service = isset($_POST['service']) ? strip_tags($_POST['service']) : '';

// Formatea el mensaje
$message = "Nuevo contacto desde el formulario de KRNIVORO:\n\n";
$message .= "Nombre: $name\n";
$message .= "Correo: $email\n";
$message .= "Teléfono: $phone\n";
$message .= "Servicio requerido: $service\n";

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