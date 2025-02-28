<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usu'])) {
    die("Usuario no autenticado.");
}
$idUser = $_SESSION['id_usu'];

$host    = "localhost";
$dbname  = "diabetesdb";
$dbUser  = "root";
$dbPass  = "";

// Crear conexión
$mysqli = new mysqli($host, $dbUser, $dbPass, $dbname);
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Inicializar variables para el mes y año
$month = $year = null;
$events = [];

// Comprobar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $month = $_POST['mes'] ?? date('m');
    $year  = $_POST['anio'] ?? date('Y');

    $firstDay = date('Y-m-01', strtotime("$year-$month-01"));
    $lastDay = date('Y-m-t', strtotime("$firstDay"));

    $sql = "
        SELECT C.fecha, C.tipo_comida, C.gl_1h, C.gl_2h, C.raciones, C.insulina,
               H.glucosa AS glucosa_hiper, H.hora AS hora_hiper,
               P.glucosa AS glucosa_hipo, P.hora AS hora_hipo
        FROM COMIDA C
        LEFT JOIN HIPERGLUCEMIA H ON C.fecha = H.fecha AND C.tipo_comida = H.tipo_comida AND C.id_usu = H.id_usu
        LEFT JOIN HIPOGLUCEMIA P ON C.fecha = P.fecha AND C.tipo_comida = P.tipo_comida AND C.id_usu = P.id_usu
        WHERE C.id_usu = $idUser AND C.fecha BETWEEN '$firstDay' AND '$lastDay'
        ORDER BY C.fecha, C.tipo_comida";

    $result = $mysqli->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $events[$row['fecha']][] = $row;
        }
    } else {
        echo "Error al recuperar los datos: " . $mysqli->error;
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Información</title>
    <style>
  /* Reset básico */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Montserrat', sans-serif;
}

/* Fondo general */
body {
  background: #ff8800; /* Color naranja sólido */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  color: #333;
}

/* Contenedor del formulario y tabla */
.container {
  width: 80%;
  max-width: 850px;
  padding: 30px;
  background: #ecf0f1; /* Fondo gris claro */
  border-radius: 12px;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
  text-align: center;
}

/* Título dentro del cuadro */
h1 {
  font-size: 24px;
  color: #2c3e50; /* Azul oscuro */
  margin-bottom: 20px;
}

/* Estilos para el formulario */
form {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  color: #333;
}

select, input, button {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

button {
  background: #2980b9; /* Azul */
  color: #fff;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s, transform 0.2s;
}

button:hover {
  background: #1f6690; /* Azul más oscuro */
  transform: scale(1.05);
}

/* Tabla */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

/* Encabezado de la tabla */
th {
  background: #feca57; /* Amarillo */
  color: #333;
  padding: 12px;
  font-size: 16px;
  border-bottom: 2px solid #ddd;
}

/* Celdas de la tabla */
td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

/* Alternar colores en filas */
tr:nth-child(even) {
  background: #f9f9f9;
}

/* Mensaje de "No hay datos" */
p {
  font-size: 18px;
  font-weight: bold;
  color: #c0392b; /* Rojo */
  margin-top: 20px;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Seleccione el mes y año para visualizar la información</h1>
        <form method="post">
            <label for="mes">Mes:</label>
            <select name="mes" id="mes">
                <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>" <?= $i == $month ? 'selected' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>

            <label for="anio">Año:</label>
            <input type="number" name="anio" id="anio" value="<?= $year ?? date('Y') ?>">

            <button type="submit">Mostrar Datos</button>
        </form>

        <?php if (!empty($events)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo de Comida</th>
                        <th>Glucosa 1h</th>
                        <th>Glucosa 2h</th>
                        <th>Raciones</th>
                        <th>Insulina</th>
                        <th>Evento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $date => $infos): ?>
                        <?php foreach ($infos as $info): ?>
                            <tr>
                                <td><?= $date ?></td>
                                <td><?= $info['tipo_comida'] ?></td>
                                <td><?= $info['gl_1h'] ?> mg/dL</td>
                                <td><?= $info['gl_2h'] ?> mg/dL</td>
                                <td><?= $info['raciones'] ?></td>
                                <td><?= $info['insulina'] ?> UI</td>
                                <td>
                                    <?php
                                    if ($info['glucosa_hiper']) {
                                        echo "Hiperglucemia: {$info['glucosa_hiper']} mg/dL a las {$info['hora_hiper']}";
                                    } elseif ($info['glucosa_hipo']) {
                                        echo "Hipoglucemia: {$info['glucosa_hipo']} mg/dL a las {$info['hora_hipo']}";
                                    } else {
                                        echo "Ninguno";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>No hay datos para mostrar.</p>
        <?php endif; ?>
    </div>
</body>
</html>
