<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDatos = "opsAritmeticas";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDatos, null, "/opt/lampp/var/mysql/mysql.sock");

if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>