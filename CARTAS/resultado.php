<?php
session_start();

if (!isset($_POST['pareja1']) || !isset($_POST['pareja2'])) {
    die("Selecciona dos cartas.");
}

$pos1 = intval($_POST['pareja1']);
$pos2 = intval($_POST['pareja2']);

if ($pos1 < 1 || $pos1 > 6 || $pos2 < 1 || $pos2 > 6 || $pos1 == $pos2) {
    die("Las posiciones deben estar entre 1 y 6 y ser diferentes.");
}

if (!isset($_SESSION['combinacion'])) {
    die("No se encontró la combinación de cartas.");
}

$combinacion = $_SESSION['combinacion'];

// ✅ Verifica si las cartas son iguales de forma sencilla
$puntosCambio = ($combinacion[$pos1 - 1] == $combinacion[$pos2 - 1]) ? 1 : -1;
$resultado = ($puntosCambio == 1) ? "✅ Acierto" : "❌ Fallo";

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "cartas");
if ($conexion->connect_error) die("Error de conexión.");

if (!isset($_SESSION['nombre'])) {
    die("Error: El usuario no está identificado.");
}
$nombre = $_SESSION['nombre'];

// Actualizar los puntos e intentos del jugador
$conexion->query("UPDATE jugador SET puntos = puntos + $puntosCambio, extra = extra + 1 WHERE nombre = '$nombre'");

// Mostrar resultado y tabla de puntuaciones
echo "<h2>Bienvenido, $nombre</h2>";
echo "<p>$resultado: posiciones $pos1 y $pos2.</p>";

$result = $conexion->query("SELECT nombre, puntos, extra FROM jugador");
echo "<h3>Tabla de puntos:</h3><table border='1'><tr><th>Nombre</th><th>Puntos</th><th>Intentos</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['nombre']}</td><td>{$row['puntos']}</td><td>{$row['extra']}</td></tr>";
}
echo "</table>";

$conexion->close();
?>
