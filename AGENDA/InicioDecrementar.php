<?php
session_start();

// Si es la primera vez que se carga la página, inicializa el contador en 5
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 5;  // Empieza con 5 imágenes
}

// Verifica si se ha enviado un formulario
if (isset($_POST['input'])) {

    // Si el usuario pulsa "INCREMENTAR" y no ha alcanzado el límite de 5
    if ($_POST['input'] == "INCREMENTAR" && $_SESSION['contador'] < 5) {
        $_SESSION['contador']++;  // Aumenta el contador de contactos

    // Si el usuario pulsa "DECREMENTAR" y hay al menos 1 contacto
    } else if ($_POST['input'] == "DECREMENTAR" && $_SESSION['contador'] > 1) {
        $_SESSION['contador']--;  // Disminuye el contador de contactos

    // Si el usuario pulsa "GRABAR", redirige a agenda.php
    } else if ($_POST['input'] == "GRABAR") {
        header("Location: agenda.php");  // Redirige a agenda.php
        exit();  // Termina la ejecución del script
    }
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
        <p>Empiezas con 5 contactos. Puedes reducir el número pulsando DECREMENTAR.</p>
        <p>Cuando el número sea el deseado, pulsa GRABAR.</p>
    </div>

    <!-- Sección donde se muestran las imágenes según la cantidad de contactos seleccionados -->
    <div>
        <?php 
        for ($i = 0; $i < $_SESSION['contador']; $i++) {  // Ahora empieza con 5 imágenes y puede reducirse
            echo "<img src='img/OIP$i.jfif' style='border: 4px double; width:5%;'>";  
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
