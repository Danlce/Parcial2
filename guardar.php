<?php
require_once "conexion.php";
$db = new Conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Capturar datos
    $nombre       = trim($_POST['nombre'] ?? '');
    $apellido     = trim($_POST['apellido'] ?? '');
    $edad         = (int)($_POST['edad'] ?? 0);
    $sexo         = $_POST['sexo'] ?? '';
    $pais_id      = (int)($_POST['pais_id'] ?? 0);
    $nacionalidad = trim($_POST['nacionalidad'] ?? '');
    $area_id      = (int)($_POST['area_id'] ?? 0);
    $correo       = trim($_POST['correo'] ?? '');
    $celular      = trim($_POST['celular'] ?? '');
    $observaciones = trim($_POST['observaciones'] ?? '');
    $fecha_formulario = $_POST['fecha_formulario'] ?? date('Y-m-d');

    // 2. VALIDACIONES del lado de PHP (Item 15)
    $errores = [];

    if ($nombre === '' || $apellido === '') {
        $errores[] = "Nombre y apellido son obligatorios.";
    }

    if ($edad <= 0 || $edad > 120) {
        $errores[] = "La edad no es válida.";
    }

    if (!in_array($sexo, ['M','F','O'])) {
        $errores[] = "Seleccione un sexo válido.";
    }

    if ($pais_id <= 0) {
        $errores[] = "Seleccione un país de residencia.";
    }

    if ($nacionalidad === '') {
        $errores[] = "La nacionalidad es obligatoria.";
    }

    if ($area_id <= 0) {
        $errores[] = "Seleccione un tema tecnológico.";
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo no es válido.";
    }

    if ($celular === '') {
        $errores[] = "El celular es obligatorio.";
    }

    // 3. Nombres en mayúscula inicial (Item 16)
    $nombre   = ucwords(strtolower($nombre));
    $apellido = ucwords(strtolower($apellido));

    if (count($errores) > 0) {
        echo "<h3>Errores encontrados:</h3><ul>";
        foreach ($errores as $e) {
            echo "<li>" . htmlspecialchars($e) . "</li>";
        }
        echo "</ul><a href='index.php'>Volver al formulario</a>";
        exit;
    }

    // 4. Insertar en BD
    $sql = "INSERT INTO inscriptor 
        (nombre, apellido, edad, sexo, pais_id, nacionalidad, area_id, correo, celular, observaciones, fecha_formulario)
        VALUES
        (:nombre, :apellido, :edad, :sexo, :pais_id, :nacionalidad, :area_id, :correo, :celular, :observaciones, :fecha_formulario)";

    $stmt = $db->pdo->prepare($sql);
    $stmt->execute([
        ':nombre'          => $nombre,
        ':apellido'        => $apellido,
        ':edad'            => $edad,
        ':sexo'            => $sexo,
        ':pais_id'         => $pais_id,
        ':nacionalidad'    => $nacionalidad,
        ':area_id'         => $area_id,
        ':correo'          => $correo,
        ':celular'         => $celular,
        ':observaciones'   => $observaciones,
        ':fecha_formulario'=> $fecha_formulario
    ]);

    echo "<h2>Registro guardado correctamente</h2>";
    echo "<a href='reporte.php'>Ver reporte de inscripciones</a><br>";
    echo "<a href='index.php'>Volver al formulario</a>";
} else {
    header("Location: index.php");
    exit;
}
