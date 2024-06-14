<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tablas horizontales</title>
    <link rel="stylesheet" href="css/expon.css">
</head>

<body>
    <h1>Tablas horizontales</h1>
    <a href="ingresador.php" class="button">Crear aspiradora</a>




    <?php


    //todo: este comentario es para dejar por escrito las tareas
    // Se incluye el archivo que contiene la función de conexión
    include("baseDatos.php");

    // $conexion es la variable que almacena la conexión a la base de datos
    $conexion = conectaphp();

    //$consulta es una cadena de texto que representa la consulta SQL que deseas ejecutar.
    $consulta = "SELECT * FROM propiedades"; //* Extraemos todos los datos de la tabla propiedades

    /*mysqli_query() es una función utilizada para ejecutar consultas SQL en una base de datos MySQL 
    y obtener el resultado de la consulta para su posterior procesamiento.*/


    // *$resultado es una variable que almacena el resultado de una consulta ejecutada con mysqli_query(),
    //*permitiéndote acceder y manipular los datos devueltos por la consulta 

    $resultado = mysqli_query($conexion, $consulta);

    // Se comprueba si se han obtenido resultados

    ///!fvmdfkgmzdnfklnzdndfognjoadñ
    echo "<form action='' method='POST' id='compararForm'>";

    // Se muestra una tabla horizontal con los datos obtenidos
    echo "<div class='tabla-horizontal'>";

    $calificaciones = array(
        1 => '☆',
        2 => '☆☆',
        3 => '☆☆☆',
        4 => '☆☆☆☆',
        5 => '☆☆☆☆☆'
    );


    while ($fila = mysqli_fetch_array($resultado)) {


        echo "<div class='celda' data-id='" . $fila['id'] . "'>";
        echo "<p>Escoger para comparar: <input type='checkbox' name='aspiradoras[]' value='" . $fila['id'] . "'></p>";
        echo "<img src='imgAspi/" . $fila['imagen'] . "' alt='Aspiradora no va'>";
        echo "<p class='nombre'>Calificación: <span class='calificacion'>" . $calificaciones[$fila['calificacion']] . "</span></p>";
        echo "<p class='email'>Nombre: " . $fila['vendido_por'] . "</p>";
        echo "<p class='fecha'>Precio: " . $fila['precio'] . "€" . "</p>";
        echo "<p class='fecha'>Capacidad: " . $fila['capacidad'] . "L" . "</p>";
        echo "<p class='fecha'>Peso: " . $fila['peso'] . "Kg" . "</p>";
        echo "<p class='fecha'>Nivel de ruido: " . $fila['nivel_ruido'] . "Db" . "</p>";
        echo "<p class='fecha'>Potencia: " . $fila['potencia'] . "W" . "</p>";


        // Formulario de eliminación
        echo "<form class='eliminar-form' action='eliminar.php' method='POST'>";
        echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>";
        echo "<button type='submit' class='eliminar'>Eliminar</button>";
        echo "</form>";

        echo "</div>";
    }

    echo "</div>";

    /**
     * 
     * 
     * 
     * 
     * 
     */
    ?>



    </div>
    <button type="submit">Comparar aspiradoras</button>
    </form>








    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.eliminar').click(function() {
                let celda = $(this).closest('.celda');
                let id = celda.data('id');

                $.post('eliminar.php', {
                    id: id
                }, function(data) {
                    celda.hide();
                    console.log(data); // Imprimir la respuesta del servidor en la consola
                }).fail(function() {
                    console.error('Error al eliminar la aspiradora con js');
                });
            });
        });

        //* Validar el formulario para que si alguien no escoge aspiradoras no de error 
        function validarFormulario() {
            let checkboxes = document.querySelectorAll('input[name="aspiradoras[]"]:checked');

            if (checkboxes.length > 0) {
                return true; // Permitir el envío del formulario
            } else {
                alert('No se han seleccionado aspiradoras para comparar.');
                return false; // Evitar el envío del formulario
            }
        }










        
    </script>

</body>

</html>