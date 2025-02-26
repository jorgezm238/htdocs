<?php
session_start();

// Verificamos si el usuario está logueado comprobando la variable "login"
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$mensaje = "";

// Si se ha enviado el formulario con la solución:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['solucion'])) {
    $solucionUsuario = trim($_POST['solucion']);

    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'jeroglificobd');
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener la solución correcta desde la base de datos
    $fechaHoy = '2024-12-12'; // Fecha del jeroglífico
    $stmt = $conexion->prepare("SELECT solucion FROM solucion WHERE fecha = ?");
    $stmt->bind_param("s", $fechaHoy);
    $stmt->execute();
    $stmt->bind_result($solucionCorrecta);
    $stmt->fetch();
    $stmt->close();

    if ($solucionCorrecta) {
        // Guardar la respuesta del usuario
        $login = $_SESSION['login'];
        $horaAhora = date('H:i:s');

        $stmt = $conexion->prepare("INSERT INTO respuestas (login, fecha, hora, respuesta) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $login, $fechaHoy, $horaAhora, $solucionUsuario);
        if (!$stmt->execute()) {
            die("Error al guardar la respuesta: " . $stmt->error);
        }
        $stmt->close();
        

        // Comparar la solución del usuario con la correcta (ignorando mayúsculas y minúsculas)
        if (strcasecmp($solucionUsuario, $solucionCorrecta) === 0) {
            $mensaje = "<p style='color:green;'>¡Correcto! Has encontrado la solución: $solucionCorrecta</p>";
        } else {
            $mensaje = "<p style='color:red;'>Incorrecto. La solución no es correcta.</p>";
        }
    } else {
        $mensaje = "<p style='color:red;'>No se encontró la solución para la fecha.</p>";
    }

    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Jeroglífico del Día</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>

    <?php
    if (!empty($mensaje)) {
        echo $mensaje;
    }
    ?>

    <!-- Mostrar la imagen del jeroglífico -->
    <img src="imagen/20241212.jpg" alt="Jeroglífico del día" style="max-width:300px;">

    <form method="post" action="">
        <label for="solucion">Introduce tu solución:</label><br>
        <input type="text" name="solucion" id="solucion" required>
        <br><br>
        <button type="submit">Enviar</button>
    </form>

    <hr>

    <!-- Enlaces a otros módulos -->
    <a href="puntos.php">Ver puntos por jugador</a> |
    <a href="resultado.php">Resultados del día</a>
</body>
</html>
