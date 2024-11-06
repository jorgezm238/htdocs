<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Círculo en PHP, HTML y CSS</title>
    <style>
        .circulo {
            width: 100px;             /* Ancho del círculo */
            height: 100px;            /* Alto del círculo */
            background-color: <?php echo $color;?>; /* Color de fondo dinámico */
            border-radius: 50%;       /* Convierte el cuadrado en círculo */
            
        }


    </style>
</head>
<body>
<div>

<form action="pregunta.php" method="post">
<input type="hidden" name ="color" values="<?php echo $color;?>">
<input type="submit" value="jugar" name= "Submit">

</form>

</div>
<?php
switch ($ncolor) {
    case 0:
       $color ="red";
        break;
    case 1:
       $color ="yellow";
        break;
    case 2:
       $color ="blue";
        break;
    case 3:
       $color ="green";
        break;
}



?>
    <div class="circulo"></div>
    <button class="boton">TextoBoton</button>

</body>
</html>