<?php
session_start();

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

if (isset($_POST['submit'])) {
    if (!empty($_POST['usu']) && !empty($_POST['contra']) && !empty($_POST['contraC'])) {
        if ($_POST['contra'] === $_POST['contraC']) {
            
            $_SESSION['usu'] = $_POST['usu'];
            $_SESSION['contra'] = $_POST['contra'];
            $_SESSION['rol']=$_POST['rol'];
            //guardas las variables para que sea mas limpio
            $u=$_SESSION['usu'];
            $c=$_POST['contra'];
            $r=$_POST['rol'];


            $query = "SELECT usu FROM usuarios WHERE usu = '$u'";
            $result = $conn->query($query);
          //  $row=$result->fetch_row();
            
            if ($result && ($result->num_rows >0)) {
                echo'Usuario ya existente.';
            }
            else {
                $query="INSERT INTO `usuarios`(`usu`, `contra`, `rol`) VALUES ('$u','$c','$r')";
                $result = $conn->query($query);
                echo'USUARIO REGISTRADO';
                echo '<br>';
                echo "Registro con exito. Ahora puedes <a href='usuaContra.php'>iniciar sesión</a>.";
                
                $conn->close();
                exit;
            }
            echo '<br>';
            echo '<a href="registrobd.php">Volver</a>';
            exit;

        } else {
            echo "Las contraseñas no coinciden.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>
    <form action="registrobd.php" method="post">
        <label>Usuario:</label>
        <input type="text" name="usu" required>
        <br></br>
        <label>Contraseña:</label>
        <input type="password" name="contra" required>
        <br></br>
        <label>Confirmar contraseña:</label>
        <input type="password" name="contraC" required>
        <br></br>
        <label>Rol:</label>
        <input type="text" name="rol" required>
        <br></br>
        <button type="submit" name="submit">Registrar</button>
    </form>
</body>
</html>