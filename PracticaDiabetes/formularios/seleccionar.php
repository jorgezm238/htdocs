<?php
session_start();
$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Opciones</title>
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
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    
    @keyframes gradientAnimation {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    
    /* Mensaje de bienvenida */
    .mensaje-bienvenida {
      order: 1;
      font-size: 32px;
      font-weight: 600;
      margin-bottom: 40px;
      color: #fff;
      text-shadow: 2px 2px 10px rgba(0,0,0,0.3), 0 0 25px rgba(255,165,0,0.5);
      text-align: center;
    }
    
    /* Contenedor del formulario con menos borde */
    .contenedor-formulario {
      order: 2;
      position: relative;
      width: 600px;
      padding: 60px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      border-radius: 16px;
      color: #fff;
      text-align: center;
      overflow: hidden;
      z-index: 1;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: 1px solid #000; /* Borde negro menos grueso */
    }
    
    .contenedor-formulario::before {
      content: "";
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      background: linear-gradient(90deg, #ff6b6b, #feca57, #48dbfb, #1dd1a1, #ff6b6b);
      background-size: 300% 300%;
      z-index: -1;
      filter: blur(2px); /* Menos desenfoque */
      border-radius: 20px;
      animation: borderAnimation 10s linear infinite;
      opacity: 0.5; /* Menos opacidad */
    }
    
    @keyframes borderAnimation {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    
    .contenedor-formulario:hover {
      transform: scale(1.03);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
    }
    
    .contenedor-formulario:hover::before {
      opacity: 0.7;
    }
    
    /* Título del contenedor */
    .contenedor-formulario h1 {
      margin-bottom: 30px;
      font-weight: 600;
      font-size: 32px;
      color: #fff;
      text-align: center;
    }
    
    /* Botones de opción innovadores */
    .btn-opcion {
      width: 100%;
      padding: 16px;
      font-size: 18px;
      border: none;
      border-radius: 6px;
      background: linear-gradient(45deg, #00c6ff, #0072ff);
      color: #fff;
      cursor: pointer;
      margin-top: 10px;
      transition: transform 0.2s, background 0.3s;
    }
    
    .btn-opcion:hover {
      transform: scale(1.05);
      background: linear-gradient(45deg, #0072ff, #00c6ff);
    }
    
    /* Botón de cerrar sesión innovador */
    .btn-cerrar {
      order: 3;
      margin-top: 20px;
      background: linear-gradient(45deg, #ff416c, #ff4b2b);
      color: #fff;
      border: none;
      padding: 12px 24px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: transform 0.2s, background 0.3s;
    }
    
    .btn-cerrar:hover {
      transform: scale(1.05);
      background: linear-gradient(45deg, #ff4b2b, #ff416c);
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
  <button class="btn-cerrar" onclick="window.location.href='../index.php';">Cerrar sesión</button>
  <div class="mensaje-bienvenida">
    ¡Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!
  </div>
  <div class="contenedor-formulario">
    <h1>Elige una opción</h1>
    <button type="button" class="btn-opcion" onclick="window.location.href='comida.php';">Añadir comida</button>
    <button type="button" class="btn-opcion" onclick="window.location.href='calendario.php';">Calendario</button>
    <button type="button" class="btn-opcion" onclick="window.location.href='estadisticas.php';">Estadísticas</button>
  </div>
</body>
</html>
