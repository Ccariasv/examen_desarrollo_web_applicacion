<?php
require 'config.php';

$totalEquipos = $conexion->query("SELECT COUNT(*) AS total FROM equipos")->fetch_assoc()['total'];
$disponibles = $conexion->query("SELECT COUNT(*) AS total FROM equipos WHERE estado = 'Disponible'")->fetch_assoc()['total'];
$totalReservas = $conexion->query("SELECT COUNT(*) AS total FROM reservas WHERE fecha >= CURDATE()")->fetch_assoc()['total'];
require 'header.php';
?>

<section class="bienvenida">
    <h2>Bienvenido</h2>
    <p>En esta aplicación puedes registrar equipos y crear reservas para los estudiantes.</p>
    <a class="boton" href="equipos.php">Registrar equipo</a>
    <a class="boton boton-secundario" href="reservas.php">Crear reserva</a>
</section>

<section class="resumen">
    <div class="tarjeta">
        <h3><?php echo $totalEquipos; ?></h3>
        <p>Equipos registrados</p>
    </div>
    <div class="tarjeta">
        <h3><?php echo $disponibles; ?></h3>
        <p>Equipos disponibles</p>
    </div>
    <div class="tarjeta">
        <h3><?php echo $totalReservas; ?></h3>
        <p>Reservas próximas</p>
    </div>
</section>

<?php require 'footer.php'; ?>
