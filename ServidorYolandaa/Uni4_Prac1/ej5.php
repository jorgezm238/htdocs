<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con un bucle y suma</title>
</head>
<body>
<?php
//verificas si se ha enviado el formulario
if (isset($_POST['submit'])) {
    //Inicializas el array
    $datos_formulario = array();

    $suma=0;
    for ($i=0; $i <=8 ; $i++) { 
        //$valor = isset($_POST[$i]) ? (int)$_POST[$i] : 0;
        $valor = $_POST[$i];
        //Guardas cada valor del for en el array
        $datos_formulario[] = $valor;
        //se suma el valor
        $suma += $valor;
    }
    $numeroElementos = count($datos_formulario);
    echo "El vector tiene ".count($datos_formulario). " elementos </br>";

    //mostrar los valores del formulario y luego su suma
    foreach ($datos_formulario as $key => $value) {
        echo $key . " = ". $value. "</br>";
    }
    echo "<br> La suma es $suma <br>";

    echo'<form action="ej5.php" method ="post">';
    for ($i=0; $i <=8 ; $i++) { 
        echo '
        <label for ="nombre">'.$i.' :</label>
        <input type="text" id="'.$i.'" name="'.$i.'"> <br>';
    }
    echo '<input type="submit" name ="submit" value="Enviar">';
}
else {
    echo'<form action="ej5.php" method ="post">';
    for ($i=0; $i <=8 ; $i++) { 
        echo '
        <label for ="nombre">'.$i.' :</label>
        <input type="text" id="'.$i.'" name="'.$i.'"> <br>
        ';
    }
    echo '<input type="submit" name ="submit" value="Enviar">';
    echo '</form>';
}
 ?>
</body>
</html>