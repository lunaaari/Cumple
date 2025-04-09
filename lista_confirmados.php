<?php
session_start();

const PASSWORD = 'lunakennedy'; // Cambia esto por tu contraseña segura

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: acceso_lista.html");
    exit();
}

$file = 'confirmados.json';
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Confirmados</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }
        ul { list-style: none; padding: 0; }
        li { padding: 8px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Confirmados</h2>
        <ul>
            <?php foreach ($data as $invitado): ?>
                <li><strong><?php echo htmlspecialchars($invitado['nombre']); ?></strong>: <?php echo htmlspecialchars($invitado['asistencia']); ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>
