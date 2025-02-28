<?php
session_start();
// Verificamos que la sesión contenga el usuario
$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Datos para la Diabetes</title>
  <style>
  /* Reset básico */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Montserrat', sans-serif;
}

/* Estilos generales del cuerpo */
body {
  background: #ff8800; /* Color naranja sólido */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

/* Contenedor principal del formulario */
.contenedor-formulario {
  order: 2;
  background: #f5e6c8; /* Fondo beige claro */
  padding: 40px;
  border-radius: 12px;
  width: 360px;
  border: 3px solid #d4a373; /* Borde marrón suave */
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  color: #222; /* Color oscuro para el texto */
}

/* Estilos generales para todos los textos */
h1, h2, label, p {
  font-family: 'Montserrat', sans-serif;
  color: #333; /* Color oscuro para buena legibilidad */
}

/* Estilos para el título principal */
.contenedor-formulario h1 {
  text-align: center;
  margin-bottom: 30px;
  font-weight: 600;
  font-size: 28px;
}

/* Estilos para los subtítulos */
.form-section h2 {
  font-size: 18px;
  margin-bottom: 15px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  padding-bottom: 10px;
  color: #d4a373; /* Marrón suave para los subtítulos */
}

/* Estilos de los grupos de entrada */
.input-group {
  margin-bottom: 15px;
}

.input-group label {
  display: block;
  font-size: 14px;
  margin-bottom: 5px;
  color: #444;
}

/* Estilos generales para inputs y selects */
.input-group input,
.input-group select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  background: #f9f9f9;
  color: #333;
  outline: none;
}

/* Placeholder en los inputs */
.input-group input::placeholder,
.input-group select {
  color: #aaa;
}

/* Botón de cerrar sesión */
.btn-cerrar {
  order: 3;
  margin-top: 20px;
  background: #dc3545; /* Rojo */
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s;
}

.btn-cerrar:hover {
  background: #c82333; /* Rojo más oscuro */
}

/* Botones de opciones (enviar datos y menú principal) */
.button-container {
  display: flex;
  gap: 10px;
  margin-top: 20px;
}

.submit-btn,
.choose-btn {
  width: 48%;
  padding: 10px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  font-weight: bold;
  color: #fff;
  cursor: pointer;
  transition: background 0.3s, transform 0.2s;
}

/* Botón de enviar */
.submit-btn {
  background: #28a745; /* Verde */
}
.submit-btn:hover {
  background: #218838; /* Verde más oscuro */
  transform: scale(1.05);
}

/* Botón de menú principal */
.choose-btn {
  background: #6610f2; /* Morado */
}
.choose-btn:hover {
  background: #520dc2; /* Morado más oscuro */
  transform: scale(1.05);
}

/* Opciones de comida */
.food-options {
  display: flex;
  justify-content: space-around;
  margin-top: 10px;
}

.food-option {
  padding: 10px;
  background-color: #ffc107; /* Amarillo */
  border: none;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s;
}

.food-option:hover {
  background-color: #e0a800; /* Amarillo más oscuro */
  transform: scale(1.05);
}

/* Secciones de eventos */
.event-section {
  transition: max-height 0.5s ease-in-out, opacity 0.5s ease;
  overflow: hidden;
  opacity: 0;
  max-height: 0;
  background: transparent;
  border-radius: 5px;
  padding: 15px;
  margin-top: 15px;
  color: #333;
}

.event-section.active {
  opacity: 1;
  max-height: 500px;
}

/* Mensaje de bienvenida */
.mensaje-bienvenida {
  order: 1;
  font-size: 30px;
  font-weight: 600;
  margin-bottom: 40px;
  color: #fff;
  text-shadow: 2px 2px 10px rgba(0,0,0,0.3), 0 0 25px rgba(255,165,0,0.5);
  text-align: center;
}

/* Mensaje de error */
.error-message {
  color: #dc3545; /* Rojo para el texto de error */
  text-align: center;
  margin-bottom: 10px;
  font-weight: bold;
}

/* Adaptación para dispositivos pequeños */
@media (max-width: 400px) {
  .contenedor-formulario {
    width: 90%;
    padding: 20px;
  }
}

  </style>
</head>
<body>
  <!-- Botón de cerrar sesión arriba (puedes ajustarlo según tu flujo) -->
  <button class="btn-cerrar" onclick="window.location.href='../index.php';">Cerrar sesión</button>

  <!-- Mensaje de bienvenida -->
  <div class="mensaje-bienvenida">
    ¡Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!
  </div>

  <!-- Contenedor principal de formulario -->
  <div class="contenedor-formulario">
    <?php
      if (isset($_GET['errParam'])) {
          echo "<p class='error-message'>";
          switch ($_GET['errParam']) {
              case 'missingFields':
                  echo "Error: Todos los campos obligatorios deben ser completados.";
                  break;
              case 'hyperExists':
                  echo "Ya existe un registro de hiperglucemia para esa fecha y tipo de comida.";
                  break;
              case 'hypoExists':
                  echo "Ya existe un registro de hipoglucemia para esa fecha y tipo de comida.";
                  break;
              case 'foodExists':
                  echo "Ya existe un registro para esa comida en esa fecha.";
                  break;
              default:
                  echo "Error desconocido. Intente nuevamente.";
          }
          echo "</p>";
      }
    ?>
    <h1>Registro de Datos para la Diabetes</h1>
    <form action="../paginas/submit.php" method="POST">
      <!-- Sección: Control de Glucosa -->
      <div class="form-section">
        <h2>Control de Glucosa</h2>
        <div class="input-group">
          <label for="dateInput">Fecha:</label>
          <input type="date" id="dateInput" name="dateInput" required>
        </div>
        <div class="input-group">
          <label for="sportInput">Minutos de Deporte:</label>
          <input type="number" id="sportInput" name="sportInput" required>
        </div>
        <div class="input-group">
          <label for="slowInsulin">Insulina Lenta:</label>
          <input type="number" id="slowInsulin" name="slowInsulin" required>
        </div>
      </div>
      
      <!-- Sección: Registro de Comida -->
      <div class="form-section">
        <h2>Registro de Comida</h2>
        <div class="input-group">
          <label for="mealType">Tipo de Comida:</label>
          <div class="food-options">
            <button type="button" class="food-option" data-value="Desayuno">Desayuno</button>
            <button type="button" class="food-option" data-value="Comida">Comida</button>
            <button type="button" class="food-option" data-value="Cena">Cena</button>
          </div>
          <input type="hidden" id="mealType" name="mealType" required>
        </div>
        <div class="input-group">
          <label for="gl1h">Glucosa 1h después:</label>
          <input type="number" id="gl1h" name="gl1h" required>
        </div>
        <div class="input-group">
          <label for="gl2h">Glucosa 2h después:</label>
          <input type="number" id="gl2h" name="gl2h" required>
        </div>
        <div class="input-group">
          <label for="carbServings">Raciones:</label>
          <input type="number" id="carbServings" name="carbServings" required>
        </div>
        <div class="input-group">
          <label for="fastInsulin">Insulina:</label>
          <input type="number" id="fastInsulin" name="fastInsulin" required>
        </div>
      </div>
      
      <!-- Sección: Tipo de Evento -->
      <div class="form-section">
        <h2>Tipo de Evento</h2>
        <div class="input-group">
          <label for="eventType">Seleccionar Tipo:</label>
          <select id="eventType" name="eventType">
            <option value="">Seleccione...</option>
            <option value="hipoglucemia">Hipoglucemia (Hipo)</option>
            <option value="hiperglucemia">Hiperglucemia (Hiper)</option>
          </select>
        </div>
      </div>
      
      <!-- Sección: Hiperglucemia -->
      <div class="event-section" id="hyperglycemiaSection">
        <h2>Hiperglucemia</h2>
        <div class="input-group">
          <label for="hyperGlucose">Glucosa:</label>
          <input type="number" id="hyperGlucose" name="hyperGlucose">
        </div>
        <div class="input-group">
          <label for="hyperTime">Hora:</label>
          <input type="time" id="hyperTime" name="hyperTime">
        </div>
        <div class="input-group">
          <label for="correction">Corrección:</label>
          <input type="number" id="correction" name="correction">
        </div>
      </div>
      
      <!-- Sección: Hipoglucemia -->
      <div class="event-section" id="hypoglycemiaSection">
        <h2>Hipoglucemia</h2>
        <div class="input-group">
          <label for="hypoGlucose">Glucosa:</label>
          <input type="number" id="hypoGlucose" name="hypoGlucose">
        </div>
        <div class="input-group">
          <label for="hypoTime">Hora:</label>
          <input type="time" id="hypoTime" name="hypoTime">
        </div>
      </div>
      
      <!-- Botones de envío y menú principal -->
      <div class="button-container">
        <button type="submit" class="submit-btn">Enviar Datos</button>
        <button type="button" class="choose-btn" onclick="window.location.href='seleccionar.php'">Menú Principal</button>
      </div>
    </form>
  </div>
  
  <script>
    // Selección de comida (Desayuno, Comida, Cena)
    document.querySelectorAll('.food-option').forEach(button => {
      button.addEventListener('click', () => {
        document.querySelectorAll('.food-option').forEach(btn => btn.style.backgroundColor = '#ffc107');
        button.style.backgroundColor = '#e0a800';
        document.getElementById('mealType').value = button.dataset.value;
      });
    });

    // Mostrar/ocultar secciones según el evento seleccionado
    const eventTypeSelect = document.getElementById('eventType');
    const hyperSection = document.getElementById('hyperglycemiaSection');
    const hypoSection = document.getElementById('hypoglycemiaSection');

    eventTypeSelect.addEventListener('change', function() {
      const selectedEvent = this.value;
      hyperSection.classList.toggle('active', selectedEvent === 'hiperglucemia');
      hypoSection.classList.toggle('active', selectedEvent === 'hipoglucemia');
    });
  </script>
</body>
</html>
