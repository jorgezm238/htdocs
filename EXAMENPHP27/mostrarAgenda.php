<?php

session_start();
require_once 'conexion.php';

$connection = new mysqli($servidor, $usuario, $clave, $base_datos);
if ($connection->connect_error) die("Fatal Error");
if ($_SERVER["REQUEST_METHOD"]== "POST"){



}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agemda del dia</title>
</head>
<body>
    <h2>Agenda del día</h2>
</body>
</html>