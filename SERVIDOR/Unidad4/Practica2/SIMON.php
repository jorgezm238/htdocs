<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Círculo en PHP, HTML y CSS</title>
    <?php
    session_start();
        // Inicializa $color para evitar errores de "variable indefinida"
        $ncolor = rand(0, 3); // Genera un número aleatorio entre 0 y 3

        // Asigna el color basado en $ncolor
        switch ($ncolor) {
            case 0:
                $color = "red";
                break;
            case 1:
                $color = "yellow";
                break;
            case 2:
                $color = "blue";
                break;
            case 3:
                $color = "green";
                break;
            default:
                $color = "black"; // Color por defecto en caso de error
        }
    ?>
    <style>
        .circulo {
            width: 100px;
            height: 100px;
            background-color: <?php echo $color; ?>; /* Color de fondo dinámico */
            border-radius: 50%;
        }
    </style>
</head>
<body>


    <!-- Muestra el círculo con el color asignado -->
    <div class="circulo"></div>

    <div>
        <form action="pregunta.php" method="post">
            <input type="hidden" name="color" value="<?php echo $color; ?>">
            <input type="submit" value="jugar" name="Submit">
        </form>
    </div>
</body>
</html>
