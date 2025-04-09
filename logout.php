<?php
session_start();
session_destroy();
header("Location: acceso_lista.html");
exit();
?>