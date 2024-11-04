<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Círculo en PHP, HTML y CSS</title>
    <style>
        .circulo {
            width: 100px;             /* Ancho del círculo */
            height: 100px;            /* Alto del círculo */
            background-color: blue; /* Color de fondo dinámico */
            border-radius: 50%;       /* Convierte el cuadrado en círculo */
            
        }
        .boton {
            background-color: green; /* Color de fondo dinámico */
            color: white;               /* Color del texto */
            border: none;              /* Sin borde */
            padding: 10px 20px;        /* Espaciado interno */
            font-size: 16px;           /* Tamaño del texto */
            border-radius: 5px;        /* Bordes redondeados */
            cursor: pointer;           /* Cambia el cursor a una mano */
            transition: background-color 0.3s; /* Transición para el efecto hover */
        }
        .boton:hover {
            background-color: #2980b9; /* Color en hover */
        }
    </style>
</head>
<body>
    <div class="circulo"></div>
    <button class="boton">TextoBoton</button>

</body>
</html>