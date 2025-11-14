<?php
require_once "conexion.php";
$db = new Conexion();

$sql = "SELECT i.id, i.nombre, i.apellido, i.edad, i.sexo,
               p.nombre AS pais,
               i.nacionalidad,
               a.nombre AS area,
               i.correo,
               i.celular,
               i.observaciones,
               i.fecha_formulario
        FROM inscriptor i
        JOIN pais p ON i.pais_id = p.id
        JOIN area_interes a ON i.area_id = a.id
        ORDER BY i.id DESC";

$stmt = $db->pdo->query($sql);
$registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Inscripciones</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="container">
    <h1>Reporte de Inscripciones</h1>
    <a href="index.php">Volver al formulario</a>
    <div style="overflow-x: auto; margin-top: 15px;">
    <table border="1" cellpadding="5" cellspacing="0" style="min-width: 1200px; width: 100%;">
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>País</th>
            <th>Nacionalidad</th>
            <th>Área de Interés</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Observaciones</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($registros as $r): ?>
            <tr>
                <td><?= $r['id'] ?></td>
                <td><?= htmlspecialchars($r['nombre'] . ' ' . $r['apellido']) ?></td>
                <td><?= $r['edad'] ?></td>
                <td><?= $r['sexo'] ?></td>
                <td><?= htmlspecialchars($r['pais']) ?></td>
                <td><?= htmlspecialchars($r['nacionalidad']) ?></td>
                <td><?= htmlspecialchars($r['area']) ?></td>
                <td><?= htmlspecialchars($r['correo']) ?></td>
                <td><?= htmlspecialchars($r['celular']) ?></td>
                <td><?= nl2br(htmlspecialchars($r['observaciones'])) ?></td>
                <td><?= $r['fecha_formulario'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
</div>
</body>
</html>
