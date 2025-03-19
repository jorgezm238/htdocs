<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usu'])) {
    die("Acceso denegado: Inicia sesión.");
}
$idUser = $_SESSION['id_usu'];

$mysqli = new mysqli("localhost", "root", "", "diabetesdb");
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Manejo de eliminación de comida
if (isset($_POST['delete'])) {
    $fecha = $_POST['fecha'];
    $tipo_comida = $_POST['tipo_comida'];
    $stmt = $mysqli->prepare("DELETE FROM COMIDA WHERE id_usu = ? AND fecha = ? AND tipo_comida = ?");
    $stmt->bind_param("iss", $idUser, $fecha, $tipo_comida);
    if ($stmt->execute()) {
        echo "<script>alert('Comida eliminada correctamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar la comida');</script>";
    }
}

// Manejo de modificación de comida
if (isset($_POST['update'])) {
    $fecha = $_POST['fecha'];
    $tipo_comida = $_POST['tipo_comida'];
    $gl_1h = $_POST['gl_1h'];
    $gl_2h = $_POST['gl_2h'];
    $raciones = $_POST['raciones'];
    $insulina = $_POST['insulina'];

    $stmt = $mysqli->prepare("UPDATE COMIDA SET gl_1h = ?, gl_2h = ?, raciones = ?, insulina = ? WHERE id_usu = ? AND fecha = ? AND tipo_comida = ?");
    $stmt->bind_param("iiiiiss", $gl_1h, $gl_2h, $raciones, $insulina, $idUser, $fecha, $tipo_comida);

    if ($stmt->execute()) {
        echo "<script>alert('Comida modificada correctamente');</script>";
    } else {
        echo "<script>alert('Error al modificar la comida');</script>";
    }
}

// Obtener comidas registradas para un día específico
$selectedDate = $_POST['selectedDate'] ?? date('Y-m-d');
$stmt = $mysqli->prepare("SELECT * FROM COMIDA WHERE id_usu = ? AND fecha = ?");
$stmt->bind_param("is", $idUser, $selectedDate);
$stmt->execute();
$result = $stmt->get_result();
$comidas = $result->fetch_all(MYSQLI_ASSOC);

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Comidas</title>
    <style>
        /* Reset básico */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Montserrat', sans-serif; }
        
        /* Estilos generales */
        body {
            background: #ff8800; /* Naranja sólido */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        .container {
            background: #f5e6c8; /* Beige claro */
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            border: 3px solid #d4a373;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            text-align: center;
        }

        h1, h2, label {
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #feca57;
        }

        button {
            padding: 8px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        .delete-btn {
            background-color: red;
            color: white;
        }

        .edit-btn {
            background-color: green;
            color: white;
        }

        .edit-form {
            display: none;
        }

        .btn-cerrar {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-cerrar:hover {
            background: #c82333;
        }
    </style>
</head>
<body>

<!-- Botón de cerrar sesión -->
<button class="btn-cerrar" onclick="window.location.href='../index.php';">Cerrar sesión</button>

<div class="container">
    <h1>Gestión de Comidas</h1>

    <!-- Selección de fecha -->
    <form method="POST">
        <label for="selectedDate">Selecciona una fecha:</label>
        <input type="date" name="selectedDate" value="<?= $selectedDate ?>">
        <button type="submit">Mostrar</button>
    </form>

    <!-- Tabla con los datos de las comidas registradas -->
    <?php if (!empty($comidas)): ?>
        <table>
            <tr>
                <th>Tipo de Comida</th>
                <th>Glucosa 1h</th>
                <th>Glucosa 2h</th>
                <th>Raciones</th>
                <th>Insulina</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($comidas as $comida): ?>
                <tr>
                    <td><?= $comida['tipo_comida'] ?></td>
                    <td><?= $comida['gl_1h'] ?></td>
                    <td><?= $comida['gl_2h'] ?></td>
                    <td><?= $comida['raciones'] ?></td>
                    <td><?= $comida['insulina'] ?></td>
                    <td>
                        <button class="edit-btn" onclick="editForm('<?= $comida['fecha'] ?>', '<?= $comida['tipo_comida'] ?>', <?= $comida['gl_1h'] ?>, <?= $comida['gl_2h'] ?>, <?= $comida['raciones'] ?>, <?= $comida['insulina'] ?>)">Modificar</button>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="fecha" value="<?= $comida['fecha'] ?>">
                            <input type="hidden" name="tipo_comida" value="<?= $comida['tipo_comida'] ?>">
                            <button type="submit" name="delete" class="delete-btn">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay comidas registradas para esta fecha.</p>
    <?php endif; ?>

    <!-- Formulario para editar comidas -->
    <div id="editForm" class="edit-form">
        <h2>Modificar Comida</h2>
        <form method="POST">
            <input type="hidden" name="fecha" id="editFecha">
            <input type="hidden" name="tipo_comida" id="editTipoComida">
            <label>Glucosa 1h:</label>
            <input type="number" name="gl_1h" id="editGl1h">
            <label>Glucosa 2h:</label>
            <input type="number" name="gl_2h" id="editGl2h">
            <label>Raciones:</label>
            <input type="number" name="raciones" id="editRaciones">
            <label>Insulina:</label>
            <input type="number" name="insulina" id="editInsulina">
            <button type="submit" name="update">Guardar Cambios</button>
        </form>
    </div>
</div>

<script>
    function editForm(fecha, tipo_comida, gl1h, gl2h, raciones, insulina) {
        document.getElementById("editFecha").value = fecha;
        document.getElementById("editTipoComida").value = tipo_comida;
        document.getElementById("editGl1h").value = gl1h;
        document.getElementById("editGl2h").value = gl2h;
        document.getElementById("editRaciones").value = raciones;
        document.getElementById("editInsulina").value = insulina;
        document.getElementById("editForm").style.display = "block";
    }
</script>

</body>
</html>
