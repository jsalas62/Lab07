<?php
include('../conexion/conexion.php');
// Abrimos la conexión a la base de datos
$conexion = conectar();
// Obtenemos los valores del formulario
$titulo = $_POST['titulo'];
$autor_id = $_POST['autor_id'];
$anio = $_POST['anio'];
$especialidad = $_POST['especialidad'];
$editorial = $_POST['editorial'];
$enlace = $_POST['enlace'];

// Formamos la consulta SQL

$query = $conexion->prepare('INSERT INTO libro (titulo, autor_id, anio, especialidad, editorial, enlace) VALUES (?, ?, ?, ?, ?, ?)');
$query->bind_param('siisss', $titulo, $autor_id, $anio, $especialidad, $editorial, $enlace);
if ($query->execute()) {
    echo "<script>alert('Libro registrado con exito');</script>";
    echo "<script>window.location.replace('libro.php');</script>";
    
    exit(); // Terminar el script para prevenir la ejecución adicional
} else {
    echo "<script>alert('No se pudo registrar el libro');</script>";
    echo "<script>window.location.replace('editar_libro.php?libro_id=" . $libro_id . "');</script>";
}

//Cerramos la conexión a la base de datos

desconectar($conexion);
?>