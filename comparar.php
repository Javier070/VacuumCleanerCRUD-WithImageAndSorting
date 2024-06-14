
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="xx.css">
    <title>Aspiradoras</title>
    
</head>

<body>
    <h1>Comparar aspiradoras</h1>
    <a href="mierda.php" class="mierda-button">Catálogo de aspiradoras</a>

    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Calificación ▲▼</th>
                <th>Nombre ▲▼</th>
                <th>Precio ▲▼</th>
                <th>Capacidad ▲▼</th>
                <th>Peso ▲▼</th>
                <th>Nivel de ruido ▲▼</th>
                <th>Potencia ▲▼</th>
                <th>   Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Se incluye el archivo que contiene la función de conexión
            include("baseDatos.php");

            // Establecer conexión a la base de datos
            $conexion = conectaphp();

            // Convertir el array de aspiradoras seleccionadas en una cadena separada por comas
            $aspiradorasIDs = implode(",", $_GET['aspiradoras']);

            // Obtener los datos de las aspiradoras seleccionadas
            $consulta = "SELECT * FROM propiedades WHERE id IN ($aspiradorasIDs)";
            $resultado = mysqli_query($conexion, $consulta);

            while ($fila = mysqli_fetch_array($resultado)) {
                $calificaciones = array(
                    1 => '☆',
                    2 => '☆☆',
                    3 => '☆☆☆',
                    4 => '☆☆☆☆',
                    5 => '☆☆☆☆☆'
                );

                echo "<tr class='aspiradora' data-id='" . $fila['id'] . "'>";
                echo "<td><img src='imgAspi/" . $fila['imagen'] . "' alt='AspiradoraFoto' width='100'></td>";
                echo "<td>";
                echo "<p class='nombre'> <span class='calificacion' style='color: orange;'>" . $calificaciones[$fila['calificacion']] . "</span></p>";
                echo "</td>";
                echo "<td>" . $fila['vendido_por'] . "</td>";
                echo "<td>" . $fila['precio'] . "€</td>";
                echo "<td>" . $fila['capacidad'] . "L</td>";
                echo "<td>" . $fila['peso'] . "Kg</td>";
                echo "<td>" . $fila['nivel_ruido'] . "Db</td>";
                echo "<td>" . $fila['potencia'] . "W</td>";
                echo "<td><a href='#' class='descartado'>Descartar</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    