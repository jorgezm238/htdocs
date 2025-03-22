<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Manejo de preflight (CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once 'conexion.php';

$method = $_SERVER['REQUEST_METHOD'];

// Para POST, PUT y DELETE leemos el JSON del body
if ($method !== 'GET') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
}

switch ($method) {

    // =========== LISTAR USUARIOS ===============
    case 'GET':
        $sql = "SELECT 
                    id_usu AS id, 
                    usuario AS username, 
                    nombre, 
                    apellidos, 
                    fecha_nacimiento AS fechaNacimiento 
                FROM usuario";
        $result = $conn->query($sql);

        if (!$result) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
            exit;
        }

        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($usuarios);
        break;

    // =========== CREAR USUARIO ===============
    case 'POST':
        // Validamos datos requeridos
        if (
            !$data || 
            !isset($data['username'], $data['password'], $data['nombre'], $data['apellidos'], $data['fechaNacimiento'])
        ) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(["error" => "Datos JSON inválidos o faltan campos"]);
            exit;
        }

        $username        = trim($data['username']);
        $passwordPlain   = $data['password'];
        $hashedPassword  = password_hash($passwordPlain, PASSWORD_BCRYPT);
        $nombre          = trim($data['nombre']);
        $apellidos       = trim($data['apellidos']);
        $fechaNacimiento = trim($data['fechaNacimiento']);

        $sql = "INSERT INTO usuario (usuario, contra, nombre, apellidos, fecha_nacimiento)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conn->error]);
            exit;
        }

        $stmt->bind_param("sssss", $username, $hashedPassword, $nombre, $apellidos, $fechaNacimiento);

        if ($stmt->execute()) {
            $response = ["success" => true, "message" => "Usuario creado correctamente"];
        } else {
            http_response_code(500);
            $response = ["success" => false, "message" => "Error al crear usuario: " . $stmt->error];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        break;

    // =========== ACTUALIZAR USUARIO ===============
    case 'PUT':
        if (
            !$data ||
            !isset($data['username'], $data['nombre'], $data['apellidos'], $data['fechaNacimiento'])
        ) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(["error" => "Datos JSON inválidos o faltan campos"]);
            exit;
        }

        $username        = trim($data['username']);
        $nombre          = trim($data['nombre']);
        $apellidos       = trim($data['apellidos']);
        $fechaNacimiento = trim($data['fechaNacimiento']);
        $password        = isset($data['password']) ? $data['password'] : '';

        // Si llega un password, lo actualizamos
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE usuario SET 
                      nombre = ?,
                      apellidos = ?,
                      fecha_nacimiento = ?,
                      contra = ?
                    WHERE usuario = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                http_response_code(500);
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conn->error]);
                exit;
            }
            $stmt->bind_param("sssss", $nombre, $apellidos, $fechaNacimiento, $hashedPassword, $username);
        } else {
            $sql = "UPDATE usuario SET 
                      nombre = ?,
                      apellidos = ?,
                      fecha_nacimiento = ?
                    WHERE usuario = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                http_response_code(500);
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conn->error]);
                exit;
            }
            $stmt->bind_param("ssss", $nombre, $apellidos, $fechaNacimiento, $username);
        }

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response = ["success" => true, "message" => "Usuario actualizado correctamente"];
            } else {
                $response = ["success" => false, "message" => "No se realizaron cambios o usuario no encontrado"];
            }
        } else {
            http_response_code(500);
            $response = ["success" => false, "message" => "Error al actualizar usuario: " . $stmt->error];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        break;

    // =========== ELIMINAR USUARIO ===============
    case 'DELETE':
        if (!$data || !isset($data['username'])) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(["error" => "Datos JSON inválidos o faltan campos"]);
            exit;
        }

        $username = trim($data['username']);

        $sql = "DELETE FROM usuario WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conn->error]);
            exit;
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $response = ["success" => true, "message" => "Usuario eliminado correctamente"];
        } else {
            http_response_code(404);
            $response = ["success" => false, "message" => "Usuario no encontrado o error al eliminar"];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        break;

    default:
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
