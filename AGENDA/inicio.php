<?php
session_start();

// Verifica si se ha enviado un formulario
if (isset($_POST['input'])) {

    // Si el usuario pulsa "INCREMENTAR" y no ha alcanzado el límite de 4
    if ($_POST['input'] == "INCREMENTAR" && $_SESSION['contador'] < 4) {
        $_SESSION['contador']++;  // Aumenta el contador de contactos

    // Si el usuario pulsa "DECREMENTAR" y hay al menos 1 contacto
    } else if ($_POST['input'] == "DECREMENTAR" && $_SESSION['contador'] > 0) {
        $_SESSION['contador']--;  // Disminuye el contador de contactos

    // Si el usuario ha alcanzado el límite de 4 contactos o pulsa "GRABAR"
    } else if ($_SESSION['contador'] >= 4 || $_POST['input'] == "GRABAR") {
        header("Location: agenda.php"); // Redirige a agenda.php
        exit();  // Detiene la ejecución para evitar que se siga procesando el código
    } 

} else {
    $_SESSION['contador'] = 0;  // Si no hay formulario enviado, inicializa el contador en 0
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>
<body>
    <h1>AGENDA</h1>

    <!-- Cuadro con instrucciones para el usuario -->
    <div style="border: 4px double; width:40%;">
        <p>Hola <?php echo $_SESSION['usu']; ?>, ¿cuántos contactos deseas grabar?</p>
        <p>Puedes grabar entre 1 y 5. Por cada pulsación en INCREMENTAR, agregarás un usuario más.</p>
        <p>Puedes pulsar DECREMENTAR si quieres reducir el número de contactos.</p>
        <p>Cuando el número sea el deseado, pulsa GRABAR.</p>
    </div>

    <!-- Sección donde se muestran las imágenes según la cantidad de contactos seleccionados -->
    <div>
        <?php 
        for ($i = 0; $i <= $_SESSION['contador']; $i++) {
            echo "<img src='img/OIP$i.jfif' style='border: 4px double; width:5%;'>";  // Muestra las imágenes según el número de contactos
        }
        ?>
    </div>

    <!-- Formulario con los botones para incrementar, decrementar y grabar -->
    <form method="post">
        <input type="submit" value="INCREMENTAR" name="input">  <!-- Aumenta la cantidad de contactos -->
        <input type="submit" value="DECREMENTAR" name="input">  <!-- Disminuye la cantidad de contactos -->
        <input type="submit" value="GRABAR" name="input">  <!-- Redirige a agenda.php para grabar los contactos -->
    </form>
</body>
</html>
