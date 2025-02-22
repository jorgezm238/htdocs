<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border-collapse: collapse;
            width: 100%;
        }
        th, td{
            border:1px solid black;
            padding: 8px;
            text-align: left;
        

        }
        th{
            background-color: grey;
        }
        .b{
            background-color:grey;
            height: 20px;
            display: inline-block;
        }





    </style>
</head>
<body>

<h1>Puntos por jugador</h1>
<table>
<tr>
<th>Login</th>
<th>Puntos</th>
<th>graf</th>
</tr>
<?php
session_start();
require_once 'login.php';

$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die("Fatal Error");
$query = "SELECT login,Nombre,puntos FROM jugador";
$result = $connection->query($query);
if (!$result) die("Fatal Error");

$rows = $result->num_rows;
for ($i=0; $i <$rows ; $i++) { 
    echo "<tr">
    $result->data_seek($i);
    echo '<td>'.htmlspecialchars($result->fetch_assoc()['Nombre']).'</td>';
    $result->data_seek($i);
    echo '<td>'.htmlspecialchars($result->fetch_assoc()['puntos']).'</td>';
    $result->data_seek($i);
    echo "<td><div class 'b' style='width;".(htmlspecialchars($result->fetch_assoc()['puntos']))."px;'></div>".'</td></tr>';
}




?>
</table>
    
</body>
</html>