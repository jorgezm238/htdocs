<?php
// Cabeceras CORS
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json; charset=utf-8');
// Manejo de preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Incluir la conexión MySQLi
include "db.php";

// Formato de respuesta JSON
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Obtener todos los usuarios
    $result = $mysqli->query("SELECT id_usu, usuario, nombre, apellidos, fecha_nacimiento FROM USUARIO");
    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(["error" => $mysqli->error]);
    }

} elseif ($method === 'POST') {
    // Crear usuario
    $data = json_decode(file_get_contents("php://input"), true);
    $usuario = $data['usuario'];
    $nombre = $data['nombre'];
    $apellidos = $data['apellidos'];
    $fecha_nacimiento = $data['fecha_nacimiento'];
    $contraseña = $data['contraseña'];
    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO USUARIO (usuario, nombre, apellidos, fecha_nacimiento, contraseña) 
                              VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $usuario, $nombre, $apellidos, $fecha_nacimiento, $contraseñaHash);
    $stmt->execute();

    echo json_encode(["message" => "Usuario creado"]);

} elseif ($method === 'PUT') {
    // Actualizar usuario
    $data = json_decode(file_get_contents("php://input"), true);
    $usuario = $data['usuario'];
    $nombre = $data['nombre'];
    $apellidos = $data['apellidos'];
    $fecha_nacimiento = $data['fecha_nacimiento'];

    $stmt = $mysqli->prepare("UPDATE USUARIO 
                              SET nombre=?, apellidos=?, fecha_nacimiento=? 
                              WHERE usuario=?");
    $stmt->bind_param("ssss", $nombre, $apellidos, $fecha_nacimiento, $usuario);
    $stmt->execute();

    echo json_encode(["message" => "Usuario actualizado"]);

} elseif ($method === 'DELETE') {
    // Eliminar usuario
    $usuario = $_GET['usuario'] ?? '';

    $stmt = $mysqli->prepare("DELETE FROM USUARIO WHERE usuario=?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    echo json_encode(["message" => "Usuario eliminado"]);
}
?>
