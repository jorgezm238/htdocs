<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Pictogramas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Listado de Pictogramas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Categoría</th>
                <th>Imagen</th>
                <th>Descripción</th>
              
            </tr>
        </thead>
        <tbody>
            @foreach($imagenes->chunk(4) as $grupo)
                <tr>
                    @foreach($grupo as $img)
                        <td>
                            <strong>ID:</strong> {{ $img->idimagen }}<br>
                            <strong>Categoría:</strong> {{ $img->categoria }}<br>
                            <img src="{{ asset($img->imagen) }}" alt="Pictograma"><br>
                            <strong>Descripción:</strong> {{ $img->descripcion }}<br>
                            <small>{{ asset($img->imagen) }}</small>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
