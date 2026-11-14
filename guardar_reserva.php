<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: reservas.php');
    exit;
}

$equipoId = (int) $_POST['equipo_id'];
$nombre = trim($_POST['nombre']);
$carne = trim($_POST['carne']);
$fecha = $_POST['fecha'];
$horaInicio = $_POST['hora_inicio'];
$horaFin = $_POST['hora_fin'];
$motivo = trim($_POST['motivo']);

if ($equipoId < 1 || $nombre === '' || $carne === '' || $fecha < date('Y-m-d') || $horaFin <= $horaInicio) {
    die('Datos de reserva no válidos. <a href="reservas.php">Regresar</a>');
}

$equipo = $conexion->prepare("SELECT id FROM equipos WHERE id = ? AND estado = 'Disponible'");
$equipo->bind_param('i', $equipoId);
$equipo->execute();
if ($equipo->get_result()->num_rows === 0) {
    die('El equipo no está disponible. <a href="reservas.php">Regresar</a>');
}

$choque = $conexion->prepare('SELECT id FROM reservas WHERE equipo_id = ? AND fecha = ? AND hora_inicio < ? AND hora_fin > ?');
$choque->bind_param('isss', $equipoId, $fecha, $horaFin, $horaInicio);
$choque->execute();
if ($choque->get_result()->num_rows > 0) {
    die('El horario se cruza con otra reserva. <a href="reservas.php">Regresar</a>');
}

$consulta = $conexion->prepare('INSERT INTO reservas (equipo_id, nombre, carne, fecha, hora_inicio, hora_fin, motivo) VALUES (?, ?, ?, ?, ?, ?, ?)');
$consulta->bind_param('issssss', $equipoId, $nombre, $carne, $fecha, $horaInicio, $horaFin, $motivo);
$consulta->execute();

header('Location: reservas.php');
exit;
?>
