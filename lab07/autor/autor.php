<?php
include('../conexion/conexion.php');

//Abrimos la conexión a la base de datos

$conexion = conectar();
$query = $conexion->prepare('SELECT autor_id, nombres, ape_paterno, ape_materno FROM autor');
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
    <title>Autores</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <h1>Autores</h1>
                <a href="agregar.html"><button class="btn btn-success">Nuevo autor</button></a>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Nombres</td>
                            <td>Apellido Paterno</td>
                            <td>Apellido Materno</td>
                        </tr>
                    </thead>
                    <tbody>
                        <br>
                        <br>
                        <?php
                        // ... Código para obtener los datos de los autores ...

                        while ($autor = $resultado->fetch_array()) {
                            echo '<tr>';
                            echo '<td>' . $autor['autor_id'] . '</td>';
                            echo '<td>' . $autor['nombres'] . '</td>';
                            echo '<td>' . $autor['ape_paterno'] . '</td>';
                            echo '<td>' . $autor['ape_materno'] . '</td>';
                            echo '<td>';
                            echo '<form action="eliminar_autor.php" method="post">';
                            echo '<input type="hidden" name="autor_id" value="' . $autor['autor_id'] . '">';
                            echo '<button class="btn btn-danger" type="submit">Eliminar</button>';
                            echo '</form>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a href="editar_autor.php?autor_id=' . $autor['autor_id'] . '"><button class="btn btn-warning">Editar</button></a>';

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