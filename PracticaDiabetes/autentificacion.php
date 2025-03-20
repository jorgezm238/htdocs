<?php
session_start();

include 'conexion.php';

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}

$userNameInput = trim($_POST['usuario']);
$passwordInput = trim($_POST['contra']);

$sql = "SELECT id_usu, contra FROM USUARIO WHERE usuario = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $userNameInput);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    $hashedPassword = $userData['contra'];

    if (password_verify($passwordInput, $hashedPassword)) {
        $_SESSION['usuario'] = $userNameInput;
        $_SESSION['id_usu'] = $userData['id_usu'];

        header("Location: seleccionar.php");
        exit();
    } else {
        $errorMessage = "Contraseña incorrecta.";
    }
} else {
    $errorMessage = "Usuario no encontrado.";
}

$stmt->close();
$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Autentificación</title>
  <link rel="stylesheet" href="autentificacion.css">
</head>
<body>
  <?php if (isset($errorMessage)): ?>
    <div class="error-container">
      <p><?php echo htmlspecialchars($errorMessage); ?></p>
      <a href="index.php">Volver a intentar</a>
    </div>
  <?php endif; ?>
</body>
</html>


