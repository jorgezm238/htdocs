<?php
session_start();

// Verificar si hay sesión de usuario y obtener el id_usu
if (!isset($_SESSION['id_usu'])) {
    die("Usuario no autenticado.");
}
$idUser = $_SESSION['id_usu'];

include '../conexion.php';  // Make sure this path is correct

// Recoger datos del formulario
$tipo_comida     = $_POST['mealType'];
$fecha           = $_POST['dateInput'];

// Check if a meal of the same type already exists for the given date
$check_sql = "SELECT * FROM COMIDA WHERE tipo_comida = '$tipo_comida' AND fecha = '$fecha' AND id_usu = $idUser";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    echo "Ya existe un registro para '$tipo_comida' en la fecha '$fecha'.";
} else {
    // Sección COMIDA
    $gl_1h = $_POST['gl1h'];
    $gl_2h = $_POST['gl2h'];
    $raciones = $_POST['carbServings'];
    $insulina = $_POST['fastInsulin'];

    // Insertar en COMIDA
    $sql_comida = "INSERT INTO COMIDA (tipo_comida, gl_1h, gl_2h, raciones, insulina, fecha, id_usu)
                   VALUES ('$tipo_comida', $gl_1h, $gl_2h, $raciones, $insulina, '$fecha', $idUser)";

    if ($conn->query($sql_comida)) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar en COMIDA: " . $conn->error;
    }
}

$conn->close();
?>
