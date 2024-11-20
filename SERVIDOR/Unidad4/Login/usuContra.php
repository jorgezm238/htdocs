<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones</title>
</head>
<body>
    <?php
    
$usu='davicin';
$contra='davicin123';

if (isset($_POST['submit'])) {
    if(($_POST['usuario']==$usu) && ($contra==$_POST['contrasenia'])){
        echo'Has hecho el loggin correctamente';
        exit;// para que no se repita el codigo
    }
    else {
        echo 'Loggin incorrecto'; //y se repite el formulario
            
    }

   
}


    ?>
<form action ="" method ="post">
<label>Usuario</label>
<input type="text" name="usuario">
<br>
<label>Contraseña</label>
<input type="text" name="contrasenia">
<br>
<a href="registro.php">REGISTRARSE</a>
<br>
<button type="submit" name='submit'>Entrar</button>

</form>
</body>
</html>