<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['name']);
    $asistencia = htmlspecialchars($_POST['attendance']);

    // Guardar la confirmación en un archivo JSON
    $file = 'confirmados.json';
    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $data[] = ["nombre" => $nombre, "asistencia" => $asistencia];
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

    // Enviar confirmación por correo
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tucorreo@gmail.com';
        $mail->Password = 'tupassword';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('tucorreo@gmail.com', 'Confirmaciones');
        $mail->addAddress('trinijkim@gmail.com');

        $mail->Subject = 'Confirmación de Asistencia';
        $mail->Body = "Nombre: $nombre\nAsistirá: $asistencia";

        $mail->send();
        echo "<script>alert('Confirmación enviada con éxito.'); window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error al enviar: {$mail->ErrorInfo}'); window.location.href='index.html';</script>";
    }
} else {
    header("Location: index.html");
    exit();
}
?>