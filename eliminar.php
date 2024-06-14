<?php
// Se incluye el archivo de conexión a la base de datos
include("baseDatos.php");

// Verificar si se ha enviado un ID válido para eliminar
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $borrar = "DELETE FROM propiedades WHERE id = $id";

    // Se intenta conectar a la base de datos
    $conexion = conectaphp();

    // Se ejecuta la consulta
    $resultadoBorrar = mysqli_query($conexion, $borrar);

    if ($resultadoBorrar) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
