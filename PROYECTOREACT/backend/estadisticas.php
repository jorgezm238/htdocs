<?php
include 'conexion.php';

// Recibe el parámetro mes, por ejemplo 2025-03
$mes = isset($_GET['mes']) ? mysqli_real_escape_string($conexion, $_GET['mes']) : date('Y-m');

// Consulta para obtener estadísticas LENTA
$sql = "SELECT 
          AVG(lenta) AS media, 
          MIN(lenta) AS minima, 
          MAX(lenta) AS maxima 
        FROM CONTROL_GLUCOSA 
        WHERE DATE_FORMAT(fecha, '%Y-%m')='$mes'";

$res = mysqli_query($conexion, $sql);

if (!$res) {
    echo json_encode(["error" => mysqli_error($conexion)]);
    exit;
}

echo json_encode(mysqli_fetch_assoc($res));

mysqli_close($conexion);
