<?php
// Cabeceras CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include "db.php";
header("Content-Type: application/json");

$query = "SELECT 
    AVG(insulina_lenta) AS promedio,
    MIN(insulina_lenta) AS minimo,
    MAX(insulina_lenta) AS maximo
FROM CONTROL_GLUCOSA";

$result = $mysqli->query($query);

if ($result) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(["error" => $mysqli->error]);
}
?>
