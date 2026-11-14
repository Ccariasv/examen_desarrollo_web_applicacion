<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: equipos.php');
    exit;
}

$codigo = trim($_POST['codigo']);
$nombre = trim($_POST['nombre']);
$tipo = $_POST['tipo'];
$descripcion = trim($_POST['descripcion']);
$ubicacion = trim($_POST['ubicacion']);
$estado = $_POST['estado'];
$tiposValidos = ['Laptop', 'Proyector', 'Tablet', 'Camara', 'Laboratorio'];
$estadosValidos = ['Disponible', 'Mantenimiento'];

if ($codigo === '' || $nombre === '' || $ubicacion === '' || !in_array($tipo, $tiposValidos) || !in_array($estado, $estadosValidos)) {
    die('Datos no válidos. <a href="equipos.php">Regresar</a>');
}

$consulta = $conexion->prepare('INSERT INTO equipos (codigo, nombre, tipo, descripcion, ubicacion, estado) VALUES (?, ?, ?, ?, ?, ?)');
$consulta->bind_param('ssssss', $codigo, $nombre, $tipo, $descripcion, $ubicacion, $estado);

if (!$consulta->execute()) {
    die('No se pudo guardar. Revisa que el código no esté repetido. <a href="equipos.php">Regresar</a>');
}

header('Location: equipos.php');
exit;
?>
