<?php
session_start();
require_once 'conexion.php';

$connection = new mysqli($servidor, $usuario, $clave, $base_datos);
if ($connection->connect_error) die("Fatal Error");

$pers=$conexion->query("SELECT idpersona, nombre FROM personas");

$imagenes = $conexion->query("SELECT idimagen, categoria , imagen FROM imagenes");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $idpersona = $_POST['persona']; 
    $idimagen = $_POST['imagen'];


    $insert = "INSERT INTO agenda(fecha,hora,idpersona,idimagen)VALUES('$fecha','$hora','$idpersona','$idimagen')";
    $conexion->query($insert);
    echo'Entrada añadida con éxito';

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Añadir datos agenda</h1>
    <form method="post">
        <label>Fecha</label>
        <input type="date" name="fecha" required><br>

        <label>Hora</label>
        <input type="time" name="hora" required><br>


        <label>Persona</label>
        <select name ="persona">
            <?php while ($row =$pers->fetch_assoc()) {?>
                <option value="<?=$row['id']?>"<?=$row['nombre']?>></option>
            
            <?php }?>
        </select>
            <h2>Selecciona una imagen</h2>
            <table border="1">
                <tr>
                <?php while ($row =$imagenes->fetch_assoc()) {?>
                <td>
                    <input type="radio" name ="imagen" value ="<?$row['idimagen'] ?>"required>
                    <?php
                    $imagen=htmlspecialchars($row['imagen']);
        echo"<td>";
    echo "<img src =$imagen witdh='10'>";
    echo "<p>['$imagen']</p>";
    echo"{$row['categoria']}<br>";
    echo"</td>";
    $imagen=htmlspecialchars($row['imagen']);
   $cont++;
    if ($cont % 4 == 0) {
        echo"</tr><tr>";
    }?>
                </td>
                    <?php } ?>

                </tr>

            </table>
            <br>
            <button type="submit">Añadir entrada en agenda</button>
            <br>
            <a href="catalogo.php">Volver al listado</a>
    </form>
</body>
</html>