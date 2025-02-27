<?php
    session_start();
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Fatal Error");
    $query = "
    SELECT u.Codigo, u.Nombre, COUNT(c.codusuario) AS contactos  -- Selecciona el ID y nombre del usuario, y cuenta cuántos contactos tiene
    FROM usuarios u  -- De la tabla usuarios (alias 'u')
    INNER JOIN contactos c ON u.Codigo = c.codusuario  -- Une 'usuarios' con 'contactos' solo si el usuario tiene contactos
    GROUP BY u.Codigo, u.Nombre;  -- Agrupa los resultados por usuario para contar correctamente sus contactos

    ";

    //INNER JOIN: Une usuarios con contactos, asegurando que solo se incluyan usuarios con al menos un contacto.


    /*$query = "SELECT u.Codigo, u.Nombre, COUNT(c.codusuario) AS contactos
          FROM usuarios u
          LEFT JOIN contactos c ON u.Codigo = c.codusuario
          GROUP BY u.Codigo, u.Nombre";
          
          
          COUNT(c.codusuario) cuenta cuántos contactos tiene cada usuario.
          LEFT JOIN mantiene a los usuarios aunque no tengan contactos.
          GROUP BY agrupa por usuario para contar los contactos correctamente.
          */


    $result = $connection->query($query);
    if (!$result) die("Fatal Error");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border: 1px solid black;
            
            
            text-align: left;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        /* .bar {
            background-color: blue;
            height: 20px;
        } */
        .circulo {
            background-color: red;
            height: 20px;
            width: 20px;
            border-radius: 50px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>AGENDA</h1>
    <h2>Hola <?php echo  $_SESSION['usu'];?></h2>
    <table>
        <tr>
            <th>Código usuario</th>
            <th>Nombre</th>
            <th>Número de contactos</th>
            <th>Gráfica</th>
        </tr>
        <?php
     $rows = $result->num_rows;  // Obtiene el número total de filas en el resultado de la consulta

     for ($j = 0; $j < $rows; ++$j) {  // Recorre cada fila de resultados
         echo "<tr>";  // Abre una nueva fila en la tabla HTML
     
         // Mueve el puntero a la fila actual ($j) y obtiene el valor de 'Codigo'
         $result->data_seek($j);
         echo '<td>' . htmlspecialchars($result->fetch_assoc()['Codigo']) . '</td>'; 
     
         // Mueve el puntero a la fila actual ($j) y obtiene el valor de 'Nombre'
         $result->data_seek($j);
         echo '<td>' . htmlspecialchars($result->fetch_assoc()['Nombre']) . '</td>';
     
         // Mueve el puntero a la fila actual ($j) y obtiene el número de contactos
         $result->data_seek($j);
         $numcontactos = htmlspecialchars($result->fetch_assoc()['contactos']);
     
         // Si el campo 'contactos' está vacío, asigna 0 para evitar errores
         if ($numcontactos == "") {
             $numcontactos = 0;
         }
     
         // Muestra la cantidad de contactos en la celda y abre una nueva celda para la gráfica
         echo '<td>' . $numcontactos . '</td><td>';
     
         // Genera los círculos visuales según la cantidad de contactos
         for ($i = 0; $i < $numcontactos; ++$i) {
             echo "<div class='circulo'></div>";  // Imprime un círculo en HTML para cada contacto
         }
     
         echo '</td></tr>';  // Cierra la fila de la tabla
     }
     
        ?>
        
    </table>
    <a href="index.php">Volver a loguearse</a><br>
    <a href="inicio.php">Introducir más contactos para <?php echo  $_SESSION['usu'];?></a><br>
</body>
</html>