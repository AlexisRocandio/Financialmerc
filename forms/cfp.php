<?php
header('Access-Control-Allow-Origin: *');  // Permitir solicitudes desde cualquier origen
header('Access-Control-Allow-Methods: POST');  // Permitir solo solicitudes POST
header('Content-Type: text/plain');  // Asegúrate de que el tipo de contenido sea texto plano
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recoger los datos del formulario
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $telefono = $_POST['telephone'];
    $asunto = $_POST['subject'];
    $mensaje = $_POST['message'];

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ajusta tu host SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'fmsics@gmail.com'; // Ajusta tu usuario SMTP
        $mail->Password = 'asnq xsvm wpnt jils'; // Ajusta tu contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // $mail->SMTPDebug = 2;  // Mostrar detalles de depuración
        // $mail->Debugoutput = 'html';

        // Configurar el contenido del correo
        $mail->setFrom($email, 'Formulario de Contacto de la pagina web de FinancialMerc');
        //$mail->addAddress('hola@financialmerc.com');
        $mail->addAddress('alexisrock25@gmail.com');
        $mail->Subject = $asunto;

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        // Definir el contenido
        $contenido = "<html>
                        <p><strong>Nombre:</strong> {$nombre}</p>
                        <p><strong>Email:</strong> {$email}</p>
                        <p><strong>Telefono:</strong> {$telefono}</p>
                        <p><strong>Mensaje:</strong> {$mensaje}</p>
                        <p>Este mensaje fue enviado desde el formulario de contacto de la página web de FinancialMerc</p>
                      </html>";

        $mail->Body = $contenido;
        $mail->AltBody = 'Esto es texto alternativo sin HTML';

        if ($mail->send()) {
            echo '¡Enviado Correctamente! ¡Nosotros te contactaremos!';
        } else {
            echo 'El Mensaje no se pudo enviar';
        }
    } catch (Exception $e) {
        echo "El Mensaje no se pudo enviar. Error de PHPMailer: {$mail->ErrorInfo}";
    }
}
?>
