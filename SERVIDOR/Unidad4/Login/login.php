<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones</title>
</head>
<body>
    <h1>Inicia sesión</h1>
    <?php
session_start();
if (isset($_POST['entrar'])) {
    if (isset($_SESSION['usuario'] , $_SESSION['contrasenia'])) {
        if ($_POST['usuario'] === $_SESSION['usuario'] && $_POST['contrasenia'] === $_SESSION['contrasenia']) {
            echo "Usuario: " . $_SESSION['usuario'] . "</br>"."Plan: " . $_SESSION['plan'];
            exit;
        }
        else {
            echo'Usuario o contraseña incorrectos.';
        }
    }
    echo'No hay datos registrados. Por favor registrese haciendo click <a href ="registropahoy.php">aquí</a>.';
    exit;


}


    ?>
<form action ="login.php" method ="post">
<label>Usuario</label>
<input type="text" name="usuario">
<br></br>
<label>Contraseña</label>
<input type="password" name="contrasenia">
<br></br>
<a href="registropahoy.php">REGISTRARSE</a>
<br></br>
<button type="submit" name='entrar'>Entrar</button>

</form>
</body>
</html>