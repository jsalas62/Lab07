<?php
include('../conexion/conexion.php');
// Abrimos la conexión a la base de datos
$conexion = conectar();
// Obtenemos los valores del formulario
$nombres = $_POST['nombres'];
$ape_paterno = $_POST['ape_paterno'];
$ape_materno = $_POST['ape_materno'];

// Formamos la consulta SQL

$query = $conexion->prepare('INSERT INTO autor (nombres, ape_paterno, ape_materno) VALUES (?, ?, ?)');
$query->bind_param('sss', $nombres, $ape_paterno, $ape_materno);

if ($query->execute()) {
    echo "<script>alert('Autor registrado con exito');</script>";
    echo "<script>window.location.replace('autor.php');</script>";

    exit(); // Terminar el script para prevenir la ejecución adicional
} else {
    echo "<script>alert('No se pudo registrar al autor');</script>";
    echo "<script>window.location.replace('editar_autor.php?libro_id=" . $autor_id . "');</script>";
}

//Cerramos la conexión a la base de datos

desconectar($conexion);
?>