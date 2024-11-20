<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
<?php
session_start();

?>

<form action ="" method ="post">
<label>Usuario</label>
<input type="text" name="usuario" required>
<br>
<label>Contraseña</label>
<input type="text" name="contrasenia" required>
<br>
<label>Confirmar Contraseña</label>
<input type="text" name="contraseniaC" required>
<br>
<input type="radio" name="tipo" value="estandar" id="estandar" required>
<label for="estandar">Estándar</label><br>
<input type="radio" name="tipo" value="premium" id="premium">
<label for="premium">Premium</label><br><br>    
<button type="submit">Enviar</button>

</form>
</body>
</html>