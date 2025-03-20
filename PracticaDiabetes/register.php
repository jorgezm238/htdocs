<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Cuenta de Usuario</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="registro-container">
    <h2>Regístrate</h2>
    <?php if (isset($_GET['error'])): ?>
      <p class="mensaje-error"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form action="procesoRegistro.php" method="POST">
      <div class="input-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
      </div>

      <div class="input-group">
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Tus apellidos" required>
      </div>

      <div class="input-group">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" placeholder="Elige un usuario" required>
      </div>

      <div class="input-group">
        <label for="contra">Contraseña:</label>
        <input type="password" id="contra" name="contra" placeholder="Crea una contraseña" required>
      </div>

      <div class="input-group">
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
      </div>

      <button class="btn-registrar" type="submit">Crear Cuenta</button>
    </form>

    <p class="opcion-login">
      ¿Ya tienes cuenta? <a href="index.php">Inicia sesión</a>
    </p>
  </div>
</body>
</html>
