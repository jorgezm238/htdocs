<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Ejemplo estático
$statistics = [
    "media" => 10,
    "min"   => 5,
    "max"   => 15,
    "evolucion" => [
        ["dia" => "2023-05-01", "valor" => 10],
        ["dia" => "2023-05-02", "valor" => 12],
        ["dia" => "2023-05-03", "valor" => 9]
    ]
];

header('Content-Type: application/json');
echo json_encode($statistics);
