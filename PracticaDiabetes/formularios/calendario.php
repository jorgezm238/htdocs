<?php
session_start();
if (!isset($_SESSION['id_usu'])) {
    die("Usuario no autenticado.");
}
$idUser = intval($_SESSION['id_usu']);

$host    = "localhost";
$dbname  = "diabetesdb";
$dbUser  = "root";
$dbPass  = "";

// Conexión con mysqli
$mysqli = new mysqli($host, $dbUser, $dbPass, $dbname);
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Obtener mes y año (o usar los actuales si no vienen por GET)
$month = isset($_GET['mes']) ? $_GET['mes'] : date('m');
$year  = isset($_GET['anio']) ? $_GET['anio'] : date('Y');

// Calcular fecha de inicio, días del mes y día de la semana
$firstDay = date('Y-m-01', strtotime("$year-$month-01"));
$daysInMonth = date('t', strtotime($firstDay));
$weekDay = date('N', strtotime($firstDay)); // 1 (Lun) a 7 (Dom)

/**
 * Consulta unificada con UNION para traer los datos 
 * que quieras mostrar debajo de cada día.
 * Ajusta CONCAT(...) según tus campos y formato preferido.
 */
$sql = "
  SELECT 
    fecha,
    CONCAT('GLUCOSA => Deporte:', deporte, ', Lenta:', lenta) AS info
  FROM CONTROL_GLUCOSA
  WHERE id_usu = $idUser

  UNION

  SELECT
    fecha,
    CONCAT('COMIDA => ', tipo_comida,
           ' | gl_1h:', gl_1h,
           ' | gl_2h:', gl_2h,
           ' | raciones:', raciones,
           ' | insulina:', insulina
    ) AS info
  FROM COMIDA
  WHERE id_usu = $idUser

  UNION

  SELECT
    fecha,
    CONCAT('HIPERGLUCEMIA => Glucosa:', glucosa,
           ' | Hora:', hora,
           ' | Corrección:', correccion,
           ' | Tipo:', tipo_comida
    ) AS info
  FROM HIPERGLUCEMIA
  WHERE id_usu = $idUser

  UNION

  SELECT
    fecha,
    CONCAT('HIPOGLUCEMIA => Glucosa:', glucosa,
           ' | Hora:', hora,
           ' | Tipo:', tipo_comida
    ) AS info
  FROM HIPOGLUCEMIA
  WHERE id_usu = $idUser
";

$result = $mysqli->query($sql);
$events = [];

/**
 * Recorremos los resultados y agrupamos por fecha.
 * Cada fecha tendrá un array de strings con la info.
 */
while ($row = $result->fetch_assoc()) {
    $events[$row['fecha']][] = $row['info'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calendario Diabetes</title>
  <style>
    /* Reset básico */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Montserrat', sans-serif;
    }

    /* Fondo animado con degradado vibrante */
    body {
      background: linear-gradient(45deg, #ff6b6b, #feca57, #48dbfb, #1dd1a1);
      background-size: 400% 400%;
      animation: gradientAnimation 15s ease infinite;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }
    @keyframes gradientAnimation {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Contenedor del calendario con borde negro 1px */
    .calendario {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      width: 90%;
      max-width: 800px;
      text-align: center;
      color: white;
      border: 1px solid #000; /* Borde negro 1px */
    }

    .calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .calendar-header a {
      text-decoration: none;
      color: white;
      background: #8e44ad;
      padding: 12px 20px;
      border-radius: 5px;
      transition: background 0.3s;
    }
    .calendar-header a:hover {
      background: #9b59b6;
    }
    .calendar-header h1 {
      font-size: 28px;
    }

    /* Grid para los días */
    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 15px;
      margin-bottom: 20px;
    }
    .day-name {
      font-weight: bold;
      background: rgba(255, 255, 255, 0.2);
      padding: 15px;
      border-radius: 5px;
      font-size: 20px;
    }

    .day-cell {
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border-radius: 5px;
      font-size: 20px;
      transition: background 0.3s, transform 0.2s;
      cursor: default; /* Ya no enlazamos a otra página */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .day-cell:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: scale(1.05);
    }

    .day-number {
      font-weight: bold;
      margin-bottom: 5px;
    }

    /* Estilo para la info real */
    .event-data {
      margin-top: 5px;
      font-size: 0.8rem;
      color: #fff;
      background: rgba(0, 0, 0, 0.3);
      padding: 2px 4px;
      border-radius: 3px;
      margin-bottom: 2px;
      text-align: left;
    }

    .button-container {
      margin-top: 20px;
      text-align: center;
    }
    .choose-btn {
      background-color: #8e44ad;
      color: #fff;
      border: none;
      padding: 15px 30px;
      font-size: 18px;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }
    .choose-btn:hover {
      background-color: #2980b9;
      transform: scale(1.05);
    }
    .choose-btn:active {
      background-color: #1f618d;
      transform: scale(0.98);
    }

    @keyframes gradientAnimation {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    @media (max-width: 400px) {
      .calendario {
        width: 90%;
        padding: 15px;
      }
      .calendar-header h1 {
        font-size: 22px;
      }
      .day-name, .day-cell {
        font-size: 16px;
        padding: 10px;
      }
      .choose-btn {
        padding: 10px 20px;
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
<div class="calendario">
  <div class="calendar-header">
    <a href="?mes=<?= ($month == 1) ? 12 : $month - 1 ?>&anio=<?= ($month == 1) ? $year - 1 : $year ?>">◀ Anterior</a>
    <h1><?= date("F Y", strtotime($firstDay)) ?></h1>
    <a href="?mes=<?= ($month == 12) ? 1 : $month + 1 ?>&anio=<?= ($month == 12) ? $year + 1 : $year ?>">Siguiente ▶</a>
  </div>

  <div class="calendar-grid">
    <div class="day-name">Lun</div>
    <div class="day-name">Mar</div>
    <div class="day-name">Mié</div>
    <div class="day-name">Jue</div>
    <div class="day-name">Vie</div>
    <div class="day-name">Sáb</div>
    <div class="day-name">Dom</div>

    <?php
    // Espacios vacíos hasta el primer día de la semana
    for ($i = 1; $i < $weekDay; $i++) {
        echo "<div class='day-cell'></div>";
    }

    // Generar las celdas para cada día del mes
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $currentDate = "$year-$month-" . str_pad($day, 2, "0", STR_PAD_LEFT);
        echo "<div class='day-cell'>";
        echo "<div class='day-number'>$day</div>";
        
        // Mostrar la info (eventos) si existen
        if (isset($events[$currentDate])) {
            foreach ($events[$currentDate] as $detail) {
                echo "<div class='event-data'>$detail</div>";
            }
        }
        echo "</div>";
    }
    ?>
  </div>

  <div class="button-container">
    <button type="button" class="choose-btn" onclick="window.location.href='seleccionar.php'">Volver</button>
  </div>
</div>
<?php $mysqli->close(); ?>
</body>
</html>
