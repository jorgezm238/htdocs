<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Color Aleatorio</title>
    <style>
        /* Estilos para el círculo */
        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            color: white;
            text-align: center;
            margin: 20px auto;
        }
        /* Estilos del botón */
        .button {
            display: inline;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            /* background-color: ; */
        }
    </style>
</head>
<body>
<?php
 include 'pintar-circulos.php';
 session_start();

//$colors = ['black', 'black', 'black', 'black'];
echo pintar_circulos($colors = ['black', 'black', 'black', 'black']);  

// Verificar si el array está existe en la sesión
if (isset($_SESSION['colores_adivinar'])) {
    $colorAdivinar= $_SESSION['colores_adivinar'] ;
}

//preguntar al usuario por los colores a adivinar
echo '<form action="respuesta.php" method="POST">';
    
$colors= $_SESSION['colores'] ;

// Crear un botón para cada color y que el boton sea del color correspondiente
$colors = ['red', 'blue', 'green', 'yellow'];
foreach ($colors as $key => $value) { 
    echo '<button class="button" name="'.$key.'" type="button" style="background-color:'.$value.';">'.$value.'</button>';
}


echo '<br><br>';
echo '</form>';
?>


</body>
</html>