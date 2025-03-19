<?php
$host = "localhost";
$dbname = "diabetesdb2";
$user = "root";
$pass = "";

header("Access-Control-Allow-Origin: http://localhost:3000");
header('Content-Type: application/json; charset=utf-8');
// Conexión con MySQLi
$mysqli = new mysqli($host, $user, $pass, $dbname);

if ($mysqli->connect_errno) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Ajustar el charset a UTF-8
$mysqli->set_charset("utf8");
?>
