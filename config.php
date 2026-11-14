<?php
$servidor = '127.0.0.1';
$usuario = 'root';
$contrasena = '';
$baseDatos = 'registro_equipos';

mysqli_report(MYSQLI_REPORT_OFF);
$conexion = mysqli_init();
mysqli_options($conexion, MYSQLI_OPT_CONNECT_TIMEOUT, 3);

if (!mysqli_real_connect($conexion, $servidor, $usuario, $contrasena, $baseDatos)) {
    die('<h2>No se pudo conectar a MySQL</h2><p>Revisa que MySQL esté iniciado en XAMPP.</p>');
}

$conexion->set_charset('utf8mb4');
?>
