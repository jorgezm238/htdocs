<?php
session_start();

if (!isset($_SESSION['id_usu'])) {
    die("Usuario no autenticado.");
}

$idUser = $_SESSION['id_usu'];

include '../conexion.php';  // Asegúrate de que la ruta es correcta

$fecha = $_POST['dateInput'];
$tipo_comida = $_POST['mealType'];

// Primero, verifica si ya existe la entrada en CONTROL_GLUCOSA
$check_control = "SELECT * FROM CONTROL_GLUCOSA WHERE fecha = '$fecha' AND id_usu = $idUser";
$result_control = $conn->query($check_control);

if ($result_control->num_rows == 0) {
    // Inserta primero en CONTROL_GLUCOSA si no existe
    $deporte = $_POST['sportInput'];
    $lenta = $_POST['slowInsulin'];
    $sql_control = "INSERT INTO CONTROL_GLUCOSA (fecha, deporte, lenta, id_usu)
                    VALUES ('$fecha', $deporte, $lenta, $idUser)";
    $conn->query($sql_control);
}

// Ahora, procede con COMIDA
$gl_1h = $_POST['gl1h'];
$gl_2h = $_POST['gl2h'];
$raciones = $_POST['carbServings'];
$insulina = $_POST['fastInsulin'];

$sql_comida = "INSERT INTO COMIDA (tipo_comida, gl_1h, gl_2h, raciones, insulina, fecha, id_usu)
               VALUES ('$tipo_comida', $gl_1h, $gl_2h, $raciones, $insulina, '$fecha', $idUser)";

if ($conn->query($sql_comida)) {
    // Verificar tipo de evento para inserción condicional en HIPERGLUCEMIA o HIPOGLUCEMIA
    $eventType = $_POST['eventType'];
    if ($eventType === 'hiperglucemia') {
        $glucosa = $_POST['hyperGlucose'];
        $hora = $_POST['hyperTime'];
        $correccion = $_POST['correction'];

        $sql_event = "INSERT INTO HIPERGLUCEMIA (glucosa, hora, correccion, tipo_comida, fecha, id_usu)
                      VALUES ($glucosa, '$hora', $correccion, '$tipo_comida', '$fecha', $idUser)";
    } elseif ($eventType === 'hipoglucemia') {
        $glucosa = $_POST['hypoGlucose'];
        $hora = $_POST['hypoTime'];

        $sql_event = "INSERT INTO HIPOGLUCEMIA (glucosa, hora, tipo_comida, fecha, id_usu)
                      VALUES ($glucosa, '$hora', '$tipo_comida', '$fecha', $idUser)";
    }

    if (isset($sql_event) && !$conn->query($sql_event)) {
        echo "Error al insertar evento: " . $conn->error;
    } else {
        echo "Datos insertados correctamente.";
    }
} else {
    echo "Error al insertar en COMIDA: " . $conn->error;
}

$conn->close();
?>
