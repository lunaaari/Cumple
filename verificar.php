<?php
session_start();

const PASSWORD = 'tucontraseña123'; // Cambia esto por tu contraseña segura

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['password'] === PASSWORD) {
        $_SESSION['authenticated'] = true;
        header("Location: lista_confirmados.php");
        exit();
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.location.href='acceso_lista.html';</script>";
    }
}
?>