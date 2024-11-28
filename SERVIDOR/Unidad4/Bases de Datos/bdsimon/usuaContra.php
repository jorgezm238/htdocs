<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones</title>
</head>
<body>
    <?php
     require_once 'login.php';
     $conn = new mysqli($hn, $un, $pw, $db);
     if ($conn->connect_error) die("Fatal Error");
    
    if (!empty($_POST['usu'])&& !empty($_POST['contra'])) {
        $input_usu = $_POST['usu'];
        $input_contra = $_POST['contra'];
    
    
     $query = "SELECT usu,contra FROM usuarios WHERE usu='$input_usu' AND 
     contra='$input_contra'";
     $result = $conn->query($query);
     if ($result && ($result->num_rows >0)) {
     echo'Se ha inciado sesion correctamente';
     $rows = $result->fetch_assoc(); 
  
     echo '<br>';
     echo '<strong>Usuario: </strong>' . htmlspecialchars($rows['usu']) . '<br>';
     echo '<strong>Contraseña: </strong>' . htmlspecialchars($rows['contra']) . '<br>';
     
    }
    
    else {

        echo 'Fatal error.';

        }
        
    }
    exit;

    
    $conn->close();

    ?>
<form action ="#" method ="post">
<label>Usuario</label>
<input type="text" name="usu">
<br>
<label>Contraseña</label>
<input type="password" name="contra">
<br>
<a href="registro.php">REGISTRARSE</a>
<br>
<button type="submit" name='submit'>Entrar</button>

</form>
</body>
</html>