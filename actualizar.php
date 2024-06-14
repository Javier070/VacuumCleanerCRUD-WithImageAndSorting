<?php
include("baseDatos.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $imagen = $_POST['imagen'];
        $calificacion = $_POST['calificacion'];
        $vendido_por = $_POST['vendido_por'];
        $precio = $_POST['precio'];
        $capacidad = $_POST['capacidad'];
        $peso = $_POST['peso'];
        $nivel_ruido = $_POST['nivel_ruido'];
        $potencia = $_POST['potencia'];

        $conexion = conectaphp();

        $consulta = "UPDATE propiedades SET imagen='$imagen', calificacion=$calificacion, vendido_por='$vendido_por', precio=$precio, capacidad=$capacidad, peso=$peso, nivel_ruido=$nivel_ruido, potencia=$potencia WHERE id=$id";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            echo "Registro actualizado exitosamente.";
        } else {
            echo "Error al actualizar el registro: " . mysqli_error($conexion);
        }

        mysqli_close($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Actualizar Registro</title>
</head>

<body>
    <h1>Actualizar Registro</h1>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $conexion = conectaphp();

        $consulta = "SELECT * FROM propiedades WHERE id=$id";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
    ?>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                <label for="imagen">Imagen:</label>
                <input type="text" name="imagen" id="imagen" value="<?php echo $fila['imagen']; ?>" required><br>

                <label for="calificacion">Calificación:</label>
                <input type="number" name="calificacion" id="calificacion" value="<?php echo $fila['calificacion']; ?>" required><br>

                <label for="vendido_por">Vendido por:</label>
                <input type="text" name="vendido_por" id="vendido_por" value="<?php echo $fila['vendido_por']; ?>" required><br>

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" value="<?php echo $fila['precio']; ?>" required><br>

                <label for="capacidad">Capacidad:</label>
                <input type="number" name="capacidad" id="capacidad" value="<?php echo $fila['capacidad']; ?>" required><br>

                <label for="peso">Peso:</label>
                <input type="number" name="peso" id="peso" value="<?php echo $fila['peso']; ?>" required><br>

                <label for="nivel_ruido">Nivel de ruido:</label>
                <input type="number" name="nivel_ruido" id="nivel_ruido" value="<?php echo $fila['nivel_ruido']; ?>" required><br>

                <label for="potencia">Potencia:</label>
                <input type="number" name="potencia" id="potencia" value="<?php echo $fila['potencia']; ?>" required><br>

                <input type="submit" name="update" value="Actualizar">
            </form>
    <?php
        } else {
            echo "No se encontró el registro.";
        }

        mysqli_close($conexion);
    } else {
        echo "ID de registro no especificado.";
    }
    ?>

</body>

</html>
