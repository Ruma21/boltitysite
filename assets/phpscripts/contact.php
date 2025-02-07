<?php
// Configura el encabezado para devolver una respuesta JSON
header('Content-Type: application/json');

// Verifica si se recibieron datos POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos del formulario
    $to = "soporte@boltity.com"; // Tu correo electrónico
    $from = $_POST['email']; // Correo del remitente
    $name = $_POST['name']; // Nombre del remitente
    $subject = $_POST['subject']; // Asunto del mensaje
    $messageBody = $_POST['Mensaje']; // Mensaje

    // Construye el cuerpo del correo
    $message = "Nombre: " . $name . "\n";
    $message .= "Correo: " . $from . "\n";
    $message .= "Asunto: " . $subject . "\n";
    $message .= "Mensaje:\n" . $messageBody;

    // Encabezados del correo
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Envía el correo
    if (mail($to, $subject, $message, $headers)) {
        // Respuesta exitosa
        echo json_encode(["status" => "success", "message" => "¡Gracias! Tu mensaje ha sido enviado."]);
    } else {
        // Error al enviar el correo
        echo json_encode(["status" => "error", "message" => "Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo."]);
    }
} else {
    // Si no se recibieron datos POST
    echo json_encode(["status" => "error", "message" => "Datos no válidos."]);
}
?>