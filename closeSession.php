<?php
include 'conn.php';
session_start(); // Iniciar la sesión

// Limpiar las sumas generadas
unset($_SESSION['sumas']);

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header('Location: index.php');
exit();
?>