<?php
require 'config.php';
$equipos = $conexion->query('SELECT * FROM equipos ORDER BY id DESC');
require 'header.php';
?>

<section class="caja-formulario">
    <h2>Registrar equipo</h2>
    <form action="guardar_equipo.php" method="POST">
        <label>Código</label>
        <input type="text" name="codigo" maxlength="20" required placeholder="Ejemplo: LAP-001">

        <label>Nombre del equipo</label>
        <input type="text" name="nombre" maxlength="100" required placeholder="Ejemplo: Laptop Dell">

        <label>Tipo</label>
        <select name="tipo" required>
            <option value="">Seleccione un tipo</option>
            <option>Laptop</option><option>Proyector</option><option>Tablet</option>
            <option>Camara</option><option>Laboratorio</option>
        </select>

        <label>Descripción</label>
        <textarea name="descripcion" maxlength="255" placeholder="Características del equipo"></textarea>

        <label>Ubicación</label>
        <input type="text" name="ubicacion" maxlength="100" required placeholder="Ejemplo: Salón 4">

        <label>Estado</label>
        <select name="estado" required>
            <option value="Disponible">Disponible</option>
            <option value="Mantenimiento">Mantenimiento</option>
        </select>
        <button type="submit">Guardar equipo</button>
    </form>
</section>

<section>
    <h2>Equipos registrados</h2>
    <?php if ($equipos->num_rows > 0): ?>
        <div class="tabla-contenedor">
            <table>
                <thead><tr><th>Código</th><th>Nombre</th><th>Tipo</th><th>Ubicación</th><th>Estado</th></tr></thead>
                <tbody>
                    <?php while ($equipo = $equipos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($equipo['codigo']); ?></td>
                            <td><?php echo htmlspecialchars($equipo['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($equipo['tipo']); ?></td>
                            <td><?php echo htmlspecialchars($equipo['ubicacion']); ?></td>
                            <td><span class="estado <?php echo strtolower($equipo['estado']); ?>"><?php echo htmlspecialchars($equipo['estado']); ?></span></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="mensaje">Todavía no hay equipos registrados.</p>
    <?php endif; ?>
</section>

<?php require 'footer.php'; ?>
