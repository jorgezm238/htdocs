<?php
session_start();
require_once 'conexion.php';

$connection = new mysqli($servidor, $usuario, $clave, $base_datos);
if ($connection->connect_error) die("Fatal Error");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mostrar</title>
</head>
<body>
    <h2>Ver agenda</h2>
    <form action="mostrarAgenda.php" method="POST">
    <label for ="fecha">Fecha: </label>
    <input type="date" name="fecha" required>
    <br>
    <label for ="persona">Persona: </label>
    <input type="text" name="persona" required>
<br>
    <button type="submit">Mostrar agenda</button>
    <a href="consulta.php">Volver al estado</a>


    </form>
</body>
</html>