<?php

    session_start();
    require_once 'login.php';

    $connection = new mysqli($hn, $un, $pw, $db);
    $mensaje = "";
    if (isset($_POST['respuesta'])) {
        
    
        $usu = $_SESSION['usu'];
        $respuesta=$_POST['respuesta'];
        $fecha =date("Y-m-d");
        $query = "SELECT * FROM respuestas WHERE fecha = '$fecha' AND login = '$usu' ";
        $result = $connection->query($query);

        if ($result->num_rows >0) {
            $mensaje = "Ya enviaste una respuesta hoy";
        }
        else {
            $sql="INSERT INTO respuestas (fecha,login,respuesta) VALUES ('$fecha', '$usu', '$respuesta')";
            $result = $connection->query($sql);
            if($conn->query($sql) === true){
                $mensaje= "Respuesta guardada correctamente";
            }else{
                $mensaje= "Respuesta NO guardada " .$conn ->error;

            }
        }
    
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <h1>Bienvenido,  <?php echo  $_SESSION['nombre'];?>!</h1>
    </div>
    <div>
    <h1>JEROGLÍFICO</h1>
       
           
        <img src='img/20241212.jpg' style= width:40%;>
        <form method="POST">
        <br>
        <label for="respuesta">Solucion al jeroglífico: </label>
        <input type="text" id="respuesta" name="respuesta" required>
    
        <br>
    <input type="submit" value="Enviar" name="input">
    
    <br>
    <a href="puntos.php">Ver puntos por jugador</a>
    <br>
    <a href="resultado.php">Resultados del dia</a>

    </form>
    <p><?php echo $mensaje;?></p>
</body>
</html>