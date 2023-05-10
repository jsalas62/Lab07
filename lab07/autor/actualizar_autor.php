<?php
include('../conexion/conexion.php');
// Abrimos la conexión a la base de datos
$conexion = conectar();
// Obtenemos los nuevos datos del autor
$autor_id = $_POST['autor_id'];
$nombres = $_POST['nombres'];
$ape_paterno = $_POST['ape_paterno'];
$ape_materno = $_POST['ape_materno'];
// Formamos la consulta SQL
$query = $conexion->prepare('UPDATE autor SET nombres = ?, ape_paterno = ?, ape_materno = ? WHERE autor_id = ?');
$query->bind_param('sssi', $nombres, $ape_paterno, $ape_materno, $autor_id);
if ($query->execute()) {
    echo "<script>alert('Autor actualizado con exito');</script>";
    echo "<script>window.location.replace('autor.php');</script>";
} else {
    echo "<script>alert('Error al actualizar los datos del autor');</script>";
    echo "<script>window.location.replace('editar_libro.php?libro_id=" . $autor_id . "');</script>";
}
//Cerramos la conexión a la base de datos
desconectar($conexion);
?>