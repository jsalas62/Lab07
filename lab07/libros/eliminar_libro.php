<?php
include('../conexion/conexion.php');
// Abrimos la conexión a la base de datos
$conexion = conectar();
// Obtenemos el id del autor a eliminar
$libro_id = $_POST['libro_id'];
// Preparamos la consulta SQL
$query = $conexion->prepare("DELETE FROM libro WHERE libro_id = ?");
$query->bind_param("i", $libro_id);
// Ejecutamos la consulta SQL
if ($query->execute()) {
    $msg = "Libro eliminado con éxito";
    echo "<script>alert('" . $msg . "'); window.location='libro.php';</script>";
    exit(); // Terminar el script para prevenir la ejecución adicional
} else {
    $msg = "No se pudo eliminar al libro";
    echo "<script>alert('" . $msg . "'); window.location='libro.php';</script>";
    exit(); // Terminar el script para prevenir la ejecución adicional
}
// Cerramos la conexión a la base de datos
desconectar($conexion);
?>