<?php
include('../conexion/conexion.php');
//Abrimos la conexión a la base de datos
$conexion = conectar();
//Obtenemos los datos enviados por el formulario
$libro_id = $_POST['libro_id'];
$titulo = $_POST['titulo'];
$autor_id = $_POST['autor_id'];
$anio = $_POST['anio'];
$especialidad = $_POST['especialidad'];
$editorial = $_POST['editorial'];
$enlace = $_POST['enlace'];

//Actualizamos los datos del libro
$query = $conexion->prepare('UPDATE libro SET titulo = ?, autor_id = ?, anio = ?, especialidad = ?, editorial = ?, enlace = ? WHERE libro_id = ?');
$query->bind_param('siisssi', $titulo, $autor_id, $anio, $especialidad, $editorial, $enlace, $libro_id);
if ($query->execute()) {
    echo "<script>alert('Los datos del libro se han actualizado correctamente');</script>";
    echo "<script>window.location.replace('libro.php');</script>";
} else {
    echo "<script>alert('Error al actualizar los datos del libro');</script>";
    echo "<script>window.location.replace('editar_libro.php?libro_id=" . $libro_id . "');</script>";
}
//Cerramos la conexión a la base de datos
desconectar($conexion);
?>