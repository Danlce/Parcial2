<?php
require_once "conexion.php";
$db = new Conexion();

// Traer países y áreas de interés de la BD
$stmtPais = $db->pdo->query("SELECT id, nombre FROM pais");
$paises = $stmtPais->fetchAll(PDO::FETCH_ASSOC);

$stmtAreas = $db->pdo->query("SELECT id, nombre FROM area_interes");
$areas = $stmtAreas->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Formulario de Inscripción</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="container">
    <h1>Formulario de Inscripción al Evento Tecnológico</h1>

    <form action="guardar.php" method="post">
        <!-- 1. Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <!-- 2. Apellido -->
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" required>

        <!-- 3. Edad -->
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" min="1" max="120" required>

        <!-- 4. Sexo -->
        <label>Sexo:</label>
        <label><input type="radio" name="sexo" value="M" required> Masculino</label>
        <label><input type="radio" name="sexo" value="F"> Femenino</label>
        <label><input type="radio" name="sexo" value="O"> Otro</label>

        <!-- 5. País de residencia -->
        <label for="pais">País de Residencia:</label>
        <select name="pais_id" id="pais" required>
            <option value="">-- Seleccione --</option>
            <?php foreach ($paises as $p): ?>
                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
            <?php endforeach; ?>
        </select>

        <!-- 6. Nacionalidad -->
        <label for="nacionalidad">Nacionalidad:</label>
        <input type="text" name="nacionalidad" id="nacionalidad" required>

        <!-- 7. Tema Tecnológico que le gustaría aprender -->
        <label for="area_id">Tema Tecnológico que le gustaría aprender:</label>
        <select name="area_id" id="area_id" required>
            <option value="">-- Seleccione --</option>
            <?php foreach ($areas as $a): ?>
                <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nombre']) ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Extra: ejemplo de checkbox (para usar checkbox como dice la rúbrica) -->
        <label>Preferencia de contacto:</label>
        <label><input type="checkbox" name="pref_contacto[]" value="correo"> Correo</label>
        <label><input type="checkbox" name="pref_contacto[]" value="celular"> Celular</label>

        <!-- Correo -->
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required>

        <!-- Celular -->
        <label for="celular">Celular:</label>
        <input type="text" name="celular" id="celular" required>

        <!-- 8. Observaciones o Consulta -->
        <label for="observaciones">Observaciones o Consulta sobre el evento:</label>
        <textarea name="observaciones" id="observaciones" rows="4"></textarea>

        <!-- 9. Fecha del formulario -->
        <label for="fecha_formulario">Fecha del formulario:</label>
        <input type="date" name="fecha_formulario" id="fecha_formulario"
               value="<?= date('Y-m-d') ?>" readonly>

        <button type="submit">Enviar Formulario</button>
    </form>

    <div class="footer">
        Información de contacto: info@itech.com | Tel: +507 6000-0000 <br>
        © 2025 iTECH. All rights reserved.
    </div>
</div>
</body>
</html>
