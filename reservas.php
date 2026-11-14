<?php
require 'config.php';
$equipos = $conexion->query("SELECT id, codigo, nombre FROM equipos WHERE estado = 'Disponible' ORDER BY nombre");
$reservas = $conexion->query('SELECT r.*, e.codigo, e.nombre AS equipo_nombre FROM reservas r INNER JOIN equipos e ON r.equipo_id = e.id ORDER BY r.fecha DESC, r.hora_inicio DESC');
require 'header.php';
?>

<section class="caja-formulario">
    <h2>Crear reserva</h2>
    <?php if ($equipos->num_rows > 0): ?>
        <form action="guardar_reserva.php" method="POST" id="formReserva">
            <label>Equipo</label>
            <select name="equipo_id" required>
                <option value="">Seleccione un equipo</option>
                <?php while ($equipo = $equipos->fetch_assoc()): ?>
                    <option value="<?php echo $equipo['id']; ?>"><?php echo htmlspecialchars($equipo['codigo'] . ' - ' . $equipo['nombre']); ?></option>
                <?php endwhile; ?>
            </select>
            <label>Nombre completo</label>
            <input type="text" name="nombre" maxlength="100" required>
            <label>Carné</label>
            <input type="text" name="carne" maxlength="20" required>
            <label>Fecha</label>
            <input type="date" name="fecha" required min="<?php echo date('Y-m-d'); ?>">
            <div class="dos-campos">
                <div><label>Hora de inicio</label><input type="time" name="hora_inicio" required></div>
                <div><label>Hora de fin</label><input type="time" name="hora_fin" required></div>
            </div>
            <label>Motivo</label>
            <textarea name="motivo" maxlength="255" placeholder="Ejemplo: Presentación de clase"></textarea>
            <button type="submit">Guardar reserva</button>
        </form>
    <?php else: ?>
        <p class="mensaje">No hay equipos disponibles. Primero registra un equipo.</p>
    <?php endif; ?>
</section>

<section>
    <h2>Lista de reservas</h2>
    <?php if ($reservas->num_rows > 0): ?>
        <div class="tabla-contenedor"><table>
            <thead><tr><th>Equipo</th><th>Persona</th><th>Fecha</th><th>Horario</th><th>Motivo</th></tr></thead>
            <tbody>
                <?php while ($reserva = $reservas->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reserva['codigo'] . ' - ' . $reserva['equipo_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['nombre'] . ' (' . $reserva['carne'] . ')'); ?></td>
                        <td><?php echo htmlspecialchars($reserva['fecha']); ?></td>
                        <td><?php echo substr($reserva['hora_inicio'], 0, 5) . ' - ' . substr($reserva['hora_fin'], 0, 5); ?></td>
                        <td><?php echo htmlspecialchars($reserva['motivo']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table></div>
    <?php else: ?>
        <p class="mensaje">Todavía no hay reservas.</p>
    <?php endif; ?>
</section>

<?php require 'footer.php'; ?>
