<?php
include('../conexion/conexion.php');
// Abrimos la conexión a la base de datos
$conexion = conectar();
// Obtenemos el id del autor a eliminar
$autor_id = $_POST['autor_id'];
// Verificamos si el autor tiene libros asociados
$query = $conexion->prepare("SELECT COUNT(*) FROM libro WHERE autor_id = ?");
$query->bind_param("i", $autor_id);
$query->execute();
$resultado = $query->get_result();
$num_libros = $resultado->fetch_row()[0];
if ($num_libros > 0) {
    $msg = "No se puede eliminar al autor porque tiene libros asociados";
    echo "<script>alert('" . $msg . "'); window.location='autor.php';</script>";
    exit(); // Terminar el script para prevenir la ejecución adicional
}
// Preparamos la consulta SQL
$query = $conexion->prepare("DELETE FROM autor WHERE autor_id = ?");
$query->bind_param("i", $autor_id);
// Ejecutamos la consulta SQL
if ($query->execute()) {
    $msg = "Autor eliminado con éxito";
    echo "<script>alert('" . $msg . "'); window.location='autor.php';</script>";
    exit(); // Terminar el script para prevenir la ejecución adicional
} else {
    $msg = "No se pudo eliminar al autor";
    echo "<script>alert('" . $msg . "'); window.location='autor.php';</script>";
    exit(); // Terminar el script para prevenir la ejecución adicional
}
// Cerramos la conexión a la base de datos
desconectar($conexion);
?>