

<link rel="stylesheet" href="css/ingresa.css">
<?php


// se incluye base de datos 
include("baseDatos.php");

if (isset($_POST["register"])) {
    // Se verifica que se hayan ingresado valores en todos los campos requeridos
    if (
        strlen($_POST["calificacion"]) >= 1 && strlen($_POST["vendido_por"]) >= 1 &&
        strlen($_POST["precio"]) >= 1 && strlen($_POST["capacidad"]) >= 1 &&
        strlen($_POST["peso"]) >= 1 && strlen($_POST["nivel_ruido"]) >= 1 &&
        strlen($_POST["potencia"]) >= 1 && isset($_FILES['imagen'])
    ) {
        // Se obtienen los valores ingresados en el formulario
        $calificacion = $_POST["calificacion"];
        $vendidoPor = $_POST["vendido_por"];
        $precio = $_POST["precio"];
        $capacidad = $_POST["capacidad"];
        $peso = $_POST["peso"];
        $nivelRuido = $_POST["nivel_ruido"];
        $potencia = $_POST["potencia"];
        $fechaReg = date("Y-m-d H:i:s");

        // Verificar si se ha subido una imagen válida
        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen = $_FILES['imagen']['name'];
            $imagen_temporal = $_FILES['imagen']['tmp_name'];
            $ruta_imagen = 'imgAspi/' . $imagen;

            // Mover la imagen a la carpeta de destino
            move_uploaded_file($imagen_temporal, $ruta_imagen);

            // Se intenta conectar a la base de datos
            $conexion = conectaphp();

            // Se prepara la consulta SQL para insertar los datos en la tabla
            $consulta = "INSERT INTO propiedades (calificacion, vendido_por, precio, capacidad, peso, nivel_ruido, potencia, imagen, fecha_reg) 
                VALUES ('$calificacion', '$vendidoPor', '$precio', '$capacidad', '$peso', '$nivelRuido', '$potencia', '$imagen', '$fechaReg')";

            // Se ejecuta la consulta
            $resultado = mysqli_query($conexion, $consulta);

            if ($resultado) {
                echo "Los datos se han almacenado correctamente en la base de datos.";
            } else {
                echo "Error al almacenar los datos en la base de datos.";
            }
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Completa todos los campos.";
    }
}
?>

<!-- Formulario para ingresar los datos -->
<form id="formulario" method="post" action="" enctype="multipart/form-data">
    <label for="calificacion">Calificación:</label>
    <select name="calificacion" id="calificacion">
        <option value="1">☆</option>
        <option value="2">☆☆</option>
        <option value="3">☆☆☆</option>
        <option value="4">☆☆☆☆</option>
        <option value="5">☆☆☆☆☆</option>
    </select>
    <br>
    <label for="vendido_por">Nombre:</label>
    <input type="text" id="vendido_por" name="vendido_por" required>
    <br>
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" min="0" step="0.01" required>
    <br>
    <label for="capacidad">Capacidad:</label>
    <input type="number" id="capacidad" name="capacidad" min="0" step="0.01" required>
    <br>
    <label for="peso">Peso:</label>
    <input type="number" id="peso" name="peso" min="0" step="0.01" required>
    <br>
    <label for="nivel_ruido">Nivel de ruido:</label>
    <input type="number" id="nivel_ruido" name="nivel_ruido" min="0" step="0.01" required>
    <br>
    <label for="potencia">Potencia:</label>
    <input type="number" id="potencia" name="potencia" min="0" required>
    <br>
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen" accept="image/*" required>
    <br>
    <a href="mierda.php" class="button">Ver aspiradoras</a>
    <input type="submit" name="register" value="Crear"> 
</form>




</body>

</html>