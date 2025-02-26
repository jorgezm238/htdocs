<?php
session_start();

// Incluir archivo de conexión
include '../conexion.php';

$responseMessage = ""; // Variable para almacenar el mensaje de respuesta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars(trim($_POST['nombre'] ?? ''));
    $lastName  = htmlspecialchars(trim($_POST['apellidos'] ?? ''));
    $userName  = htmlspecialchars(trim($_POST['usuario'] ?? ''));
    $password  = trim($_POST['contra'] ?? '');
    $birthDate = $_POST['fecha_nacimiento'] ?? null;

    if ($firstName && $lastName && $userName && $password && $birthDate) {
        $sqlCheck  = "SELECT id_usu FROM USUARIO WHERE usuario = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("s", $userName);
        $stmtCheck->execute();
        $stmtCheck->store_result();

        if ($stmtCheck->num_rows > 0) {
            $responseMessage = "El usuario ya está registrado. <a href='../register.php'>Intenta con otro nombre de usuario</a>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sqlInsert  = "INSERT INTO USUARIO (fecha_nacimiento, nombre, apellidos, usuario, contra)
                           VALUES (?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("sssss", $birthDate, $firstName, $lastName, $userName, $hashedPassword);

            if ($stmtInsert->execute()) {
                $responseMessage = "Registro exitoso. <a href='../index.php'>Inicia sesión aquí</a>";
            } else {
                $responseMessage = "Error: " . $stmtInsert->error;
            }

            $stmtInsert->close();
        }

        $stmtCheck->close();
    } else {
        $responseMessage = "Todos los campos son obligatorios.";
    }
} else {
    $responseMessage = "Método de solicitud no válido.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Proceso de Registro</title>
  <link rel="stylesheet" href="../css/procesoRegistro.css">
  </head>
<body>
  <div class="response-container">
    <?php if (!empty($responseMessage)): ?>
      <div class="mensaje-respuesta">
        <?php echo $responseMessage; ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>

