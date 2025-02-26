<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'jeroglificobd');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$fechaHoy = '2025-02-26'; // Fecha fija para la prueba

// 1️⃣ Obtener la solución correcta de la tabla "solucion"
$solQuery = "SELECT solucion FROM solucion WHERE fecha = ?";
$stmt = $conexion->prepare($solQuery);
$stmt->bind_param("s", $fechaHoy);
$stmt->execute();
$stmt->bind_result($solucionCorrecta);
$stmt->fetch();
$stmt->close();

// Verificar si se obtuvo una solución
if (!$solucionCorrecta) {
    die("⚠️ ERROR: No se encontró la solución en la base de datos para la fecha: " . $fechaHoy);
}

// 2️⃣ Obtener las respuestas de la fecha actual
$resQuery = "SELECT login, hora, respuesta FROM respuestas WHERE fecha = ?";
$stmt = $conexion->prepare($resQuery);
$stmt->bind_param("s", $fechaHoy);
$stmt->execute();
$resResult = $stmt->get_result();

// Variables para contar aciertos y fallos
$aciertos = 0;
$fallos = 0;

// Arrays para almacenar info de aciertos/fallos
$jugadoresAcertantes = [];
$jugadoresFallos = [];

// 3️⃣ Procesar cada respuesta de los jugadores
while ($fila = $resResult->fetch_assoc()) {
    $loginResp = $fila['login'];
    $horaResp = $fila['hora'];
    $solUsuario = trim(strtolower($fila['respuesta']));
    $solCorrecta = trim(strtolower($solucionCorrecta));

    if (strcasecmp($solUsuario, $solCorrecta) === 0) {
        $aciertos++;
        $jugadoresAcertantes[] = ['login' => $loginResp, 'hora'  => $horaResp];

        // 4️⃣ Sumar 1 punto en la tabla jugador
        $update = "UPDATE jugador SET puntos = puntos + 1 WHERE login=?";
        $stmtUpdate = $conexion->prepare($update);
        $stmtUpdate->bind_param("s", $loginResp);
        if (!$stmtUpdate->execute()) {
            die("⚠️ ERROR: No se pudo actualizar los puntos de $loginResp - " . $stmtUpdate->error);
        }
        $stmtUpdate->close();
    } else {
        $fallos++;
        $jugadoresFallos[] = ['login' => $loginResp, 'hora'  => $horaResp];
    }
}

// Cerrar conexiones
$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados del Día</title>
</head>
<body>
    <h2>Resultados del día (<?php echo htmlspecialchars($fechaHoy); ?>)</h2>
    <p><strong>Solución correcta:</strong> <?php echo htmlspecialchars($solucionCorrecta); ?></p>
    <p><strong>Aciertos:</strong> <?php echo $aciertos; ?></p>
    <p><strong>Fallos:</strong> <?php echo $fallos; ?></p>

    <h3>Jugadores que han acertado</h3>
    <?php if (empty($jugadoresAcertantes)): ?>
        <p>Ningún jugador ha acertado aún.</p>
    <?php else: ?>
        <ul>
        <?php foreach ($jugadoresAcertantes as $ac): ?>
            <li><?php echo htmlspecialchars($ac['login']) . " a las " . htmlspecialchars($ac['hora']); ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h3>Jugadores que han fallado</h3>
    <?php if (empty($jugadoresFallos)): ?>
        <p>Ningún jugador ha fallado (o no hay respuestas).</p>
    <?php else: ?>
        <ul>
        <?php foreach ($jugadoresFallos as $fa): ?>
            <li><?php echo htmlspecialchars($fa['login']) . " a las " . htmlspecialchars($fa['hora']); ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <hr>
    <a href="inicio.php">Volver</a>
</body>
</html>
