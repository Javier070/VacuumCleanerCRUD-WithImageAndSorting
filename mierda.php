
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Comparador de aspiradoras</title>
    <link rel="stylesheet" href="mie.css">
</head>

<body>
    
    <h1 class="titulo">Catálogo de aspiradoras</h1>
    <div class="button-container">
        <a href="ingresador.php" class="button-create">Crear aspiradora</a> <!-- Enlace para crear una nueva aspiradora -->
        <button type="submit" onclick="validarFormulario()" class="comparar-button">Comparar aspiradoras</button> <!-- Botón para comparar las aspiradoras seleccionadas -->
    </div>

    <?php
    
    include("baseDatos.php"); // Se incluye el archivo de conexión a la base de datos
    $conexion = conectaphp(); //Es la variable que almacena la conexión establecida previamente a la base de datos

    $consulta = "SELECT * FROM propiedades"; // Consulta SQL para obtener todas las aspiradoras de las tabla propiedades

    $resultado = mysqli_query($conexion, $consulta); // Es la variable donde se almacenan los resultados de la consulta

    /**
     *   mysqli_query Es una función de PHP que se utiliza para enviar una consulta SQL a
     *   la base de datos y obtener un conjunto de resultados. Recibe dos parámetros: la conexión
     *    a la base de datos ($conexion) y la consulta SQL ($consulta).*/


    echo "<form action='comparar.php' method='GET' id='compararForm'>"; // Formulario para comparar aspiradoras
    echo "<div class='tabla-horizontal'>"; // Contenedor para que las tablas se muestren horizontalmente
    
    $calificaciones = array( //array que recorre los datos de tipo int conviertiendolos  a  estrellas
        1 => '☆',
        2 => '☆☆',
        3 => '☆☆☆',
        4 => '☆☆☆☆',
        5 => '☆☆☆☆☆'
    );

    while ($fila = mysqli_fetch_array($resultado)) {
        echo "<div class='celda' data-id='" . $fila['id'] . "'>"; // División que contiene los detalles de una aspiradora
        echo "<p>Escoger para comparar: <input type='checkbox' name='aspiradoras[]' value='" . $fila['id'] . "'></p>"; // Checkbox para seleccionar la aspiradora para comparar
        echo "<img src='imgAspi/" . $fila['imagen'] . "' alt='Aspiradora no va'>"; // Imagen de la aspiradora
        echo "<p class='nombre'>Calificación: <span class='calificacion'>" . $calificaciones[$fila['calificacion']] . "</span></p>"; // Calificación de la aspiradora
        echo "<p class='email'>Nombre: " . $fila['vendido_por'] . "</p>"; // Nombre de aspiradora
        echo "<p class='fecha'>Precio: " . $fila['precio'] . "€" . "</p>"; // Precio de la aspiradora
        echo "<p class='fecha'>Capacidad: " . $fila['capacidad'] . "L" . "</p>"; // Capacidad de la aspiradora
        echo "<p class='fecha'>Peso: " . $fila['peso'] . "Kg" . "</p>"; // Peso de la aspiradora
        echo "<p class='fecha'>Nivel de ruido: " . $fila['nivel_ruido'] . "Db" . "</p>"; // Nivel de ruido de la aspiradora
        echo "<p class='fecha'>Potencia: " . $fila['potencia'] . "W" . "</p>"; // Potencia de la aspiradora

        echo "<div class='eliminar-form'>"; // División para el formulario de eliminación
        echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>"; // Campo oculto para el ID de la aspiradora
        echo "<button type='button' class='eliminar'>Eliminar</button>"; // Botón para eliminar la aspiradora
        echo "</div>";

        echo "</div>";
    }
    echo "</div>";
    echo "</form>";
    ?>

    <div id="eliminarFormContainer"></div> <!-- Contenedor para el formulario de eliminación -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  <!--  carga la biblioteca jQuery  -->

    <script>
//info

    // Manejador de eventos para el botón de eliminar
    $('.eliminar').click(function(event) {  // Este es un manejador de eventos que se activa cuando se hace clic en un elemento con la clase "eliminar"

        let celda = $(this).closest('.celda'); // Obtener la celda más cercana al botón de eliminar
      //  Utilizamos la función closest() de jQuery para buscar el elemento padre más cercano con la clase "celda".
       
       
        let id = celda.data('id'); // Obtener el ID de la aspiradora desde el atributo data
        // Utilizamos la función data() de jQuery para obtener el valor de un atributo de datos personalizado.

        if (confirm('¿Estás seguro de eliminar esta aspiradora?')) { // Mostrar una confirmación al usuario
            // Se muestra un cuadro de diálogo de confirmación al usuario utilizando la función confirm() del navegador.
        // Si el usuario hace clic en "Aceptar", se ejecuta el siguiente bloque de código.


           
            $.post('eliminar.php', { id: id }, function(data) { // Enviar una solicitud POST a "eliminar.php" con el ID de la aspiradora
                // Se realiza una solicitud POST a "eliminar.php" enviando el ID de la aspiradora como parámetro.
             // Utilizamos la función post() de jQuery para enviar la solicitud AJAX.


                celda.hide(); //* Ocultar la celda eliminada de la interfaz
                // Ocultamos la celda eliminada de la interfaz utilizando la función hide() de jQuery.
            // Esto elimina visualmente la aspiradora de la lista sin recargar la página completa.
            });
        }
    });
    // Función para validar el formulario de comparación

        function validarFormulario() { //* Función para validar el formulario de comparación
            let checkboxes = document.querySelectorAll('input[name="aspiradoras[]"]:checked'); 

        /**
         * document  para buscar elementos dentro del documento HTML.
         * querySelectorAll: Es un método del objeto document que permite seleccionar múltiples elementos del documento.
         *  Recibe como argumento un selector CSS que especifica los criterios de selección de los elementos deseados. */ 

         /*Esta línea de código selecciona
             *todos los elementos <input> que tienen el atributo name igual a "aspiradoras[]" y están marcados como checked.
             * Devuelve una lista de esos elementos para ser almacenados en la variable checkboxes*/
            

            if (checkboxes.length > 0) { 
 // verifica si la cantidad de elementos seleccionados almacenados en la variable checkboxes es mayor que cero. 

                document.getElementById('compararForm').submit();
/* busca el elemento del documento HTML que tiene el atributo id igual a 'compararForm', que en este caso es un formulario.
 El método submit() se utiliza para enviar el formulario. En resumen, esta línea de código envía el formulario de comparación.*/

            } else {
                alert('No se han seleccionado aspiradoras para comparar.');
            }
        }
    </script>
</body>

</html>
