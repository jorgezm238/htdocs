<?php

 
$servername = "fdb1028.awardspace.net";
$username = "4597266_diabetesdb";
$password = "Fx1C+RlW3ajULW4X";
$dbname = "4597266_diabetesdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>