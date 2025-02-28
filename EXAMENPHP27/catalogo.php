<?php
session_start();
require_once 'conexion.php';

$connection = new mysqli($servidor, $usuario, $clave, $base_datos);
if ($connection->connect_error) die("Fatal Error");

$query ="SELECT idimagen ,categoria, imagen FROM imagenes";
$result = $conexion->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado pictogramas</title>
</head>
<body>
    <h1>Listado pictogramas</h1>
    <table>
    <tr>
    <?php
    echo "<table border>";
    echo"<tr>";
$cont = 0;
while ($row  =$result->fetch_assoc()) {
    $imagen=htmlspecialchars($row['imagen']);
    echo"<td>";
    echo "<img src =$imagen witdh='100'>";
    echo "<p>['$imagen']</p>";
    echo"{$row['categoria']}<br>";
    echo"</td>";
    $imagen=htmlspecialchars($row['imagen']);
    $cont++;
    if ($cont % 4 == 0) {
        echo"</tr><tr>";
    }
}
echo "</table>";
echo"</tr>";

?>

    </tr>


    </table>
</body>
</html>