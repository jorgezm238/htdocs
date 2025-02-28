<?php 
session_start();  // Inicia la sesión para acceder a las variables de sesión
require_once 'login.php';  // Incluye el archivo de conexión a la base de datos

// Conexión a la base de datos
$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die("Fatal Error");  // Si hay un error de conexión, se detiene el script

$cod = $_SESSION['cod'];  // Obtiene el código del usuario desde la sesión

// Obtener el último codcontacto registrado y sumarle 1
$result_max = $connection->query("SELECT MAX(codcontacto) FROM contactos");  // Consulta el máximo codcontacto
$row_max = $result_max->fetch_array();  // Obtiene el resultado en forma de array
$codcontacto = $row_max[0] + 1;  // Incrementa el valor para evitar duplicados

// Bucle para insertar cada contacto
for ($i = 1; $i <= $_SESSION['contador'] + 1; $i++) { 
    $nombre = $_POST['nombre' . $i];  // Obtiene el nombre del contacto desde el formulario
    $email = $_POST['email' . $i];  // Obtiene el email del contacto desde el formulario
    $telf = $_POST['telefono' . $i];  // Obtiene el teléfono del contacto desde el formulario

    // Inserta el nuevo contacto en la base de datos
    $connection->query("INSERT INTO contactos (codcontacto, nombre, email, telefono, codusuario) 
                        VALUES ($codcontacto, '$nombre', '$email', '$telf', $cod)");

    $codcontacto++;  // Incrementa el codcontacto para el siguiente contacto
}

// Cierra la conexión a la base de datos
$connection->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
</head>
<body>
    <h1>AGENDA</h1>
    <h2>Hola <?php echo $_SESSION['usu']; ?></h2>  <!-- Muestra el nombre del usuario en sesión -->
    <p>Se han grabado los <?php echo $_SESSION['contador'] + 1; ?> contactos de <?php echo $_SESSION['usu']; ?></p>

    <!-- Enlaces de navegación -->
    <a href="index.php">Volver a loguearse</a><br>
    <a href="inicio.php">Introducir más contactos para <?php echo $_SESSION['usu']; ?></a><br>
    <a href="totales.php">Total de contactos guardados</a><br>
</body>
</html>
