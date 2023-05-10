<?php
include('../conexion/conexion.php');

//Abrimos la conexión a la base de datos
$conexion = conectar();
$query = $conexion->prepare("SELECT libro_id, titulo, CONCAT(autor.nombres, ' ', autor.ape_paterno, ' ', autor.ape_materno) AS autor, anio, especialidad, editorial, enlace 
                             FROM libro 
                             INNER JOIN autor ON libro.autor_id = autor.autor_id");
$query->execute();
$resultado = $query->get_result();

//Cerramos la conexión a la base de datos
desconectar($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <h1>Libros</h1>
                <a href="agregar.php"><button class="btn btn-success">Nuevo libro</button></a>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Titulo</td>
                            <td>Autor</td>
                            <td>Año</td>
                            <td>Especialidad</td>
                            <td>Editorial</td>
                            <td>Enlace</td>
                        </tr>
                    </thead>
                    <tbody>
                        <br>
                        <br>
                        <?php
                        // Recorremos el array con los datos de los alumnos
                        while ($libro = $resultado->fetch_array()) {

                            echo '<tr>';
                            echo '<td>' . $libro['libro_id'] . '</td>';
                            echo '<td>' . $libro['titulo'] . '</td>';
                            echo '<td>' . $libro['autor'] . '</td>';
                            echo '<td>' . $libro['anio'] . '</td>';
                            echo '<td>' . $libro['especialidad'] . '</td>';
                            echo '<td>' . $libro['editorial'] . '</td>';


                            echo '<td>';
                            echo '<a href="' . $libro['enlace'] . '" class="btn btn-primary" target="_blank">Ver</a>';
                            echo '</td>';

                            echo '<td>';
                            echo '<form action="eliminar_libro.php" method="post">';
                            echo '<input type="hidden" name="libro_id" value="' . $libro['libro_id'] . '">';
                            echo '<button class="btn btn-danger" type="submit">Eliminar</button>';
                            echo '</form>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a href="editar_libro.php?libro_id=' . $libro['libro_id'] . '"><button class="btn btn-warning">Editar</button></a>';

                            echo '</td>';
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>