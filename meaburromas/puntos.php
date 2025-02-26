<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$conexion = new mysqli('localhost', 'root', '', 'jeroglificobd');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = "SELECT nombre, login, puntos FROM jugador";
$result = $conexion->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Puntos por Jugador</title>
</head>
<body>
    <h2>Puntos por Jugador</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Nombre</th>
            <th>Login</th>
            <th>Puntos</th>
        </tr>
        <?php
        if ($result) {
            while ($fila = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['login']) . "</td>";
                echo "<td>" . (int)$fila['puntos'] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

    <hr>
    <a href="inicio.php">Volver</a>
</body>
</html>
<?php
$conexion->close();
?>
