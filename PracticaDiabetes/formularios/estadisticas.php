<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usu'])) {
    die("Acceso denegado: Inicia sesión.");
}
$idUser = $_SESSION['id_usu'];

// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "diabetesdb");
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Obtener mes y año seleccionados o usar los actuales
$month = $_POST['mes'] ?? date('m');
$year = $_POST['anio'] ?? date('Y');

// Consulta para obtener niveles de glucosa por día
$sql = "SELECT DAY(fecha) AS dia, lenta FROM CONTROL_GLUCOSA WHERE id_usu = $idUser AND MONTH(fecha) = $month AND YEAR(fecha) = $year";
$result = $mysqli->query($sql);

$glucosa_dias = [];
while ($row = $result->fetch_assoc()) {
    $glucosa_dias[$row['dia']] = $row['lenta'];
}

// Calcular promedio de glucosa lenta
$promedio_glucosa_lenta = !empty($glucosa_dias) ? array_sum($glucosa_dias) / count($glucosa_dias) : 0;

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas de Glucosa</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: lightgray;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        input, button {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        .chart-container {
            width: 90%;
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Estadísticas de Glucosa</h1>
        <form method="post">
            <label>Mes:</label>
            <input type="number" name="mes" value="<?= $month ?>" min="1" max="12" required>
            <label>Año:</label>
            <input type="number" name="anio" value="<?= $year ?>" required>
            <button type="submit">Mostrar Datos</button>
        </form>

        <p><strong>Promedio de Glucosa Lenta:</strong> <?= number_format($promedio_glucosa_lenta, 2) ?> mg/dL</p>

        <div class="chart-container">
            <canvas id="glucosaChart"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('glucosaChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_keys($glucosa_dias)) ?>,
                datasets: [{
                    label: 'Glucosa Lenta (mg/dL)',
                    data: <?= json_encode(array_values($glucosa_dias)) ?>,
                    backgroundColor: 'blue'
                }]
            }
        });
    </script>
</body>
</html>
