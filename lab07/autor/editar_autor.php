<?php
include('../conexion/conexion.php');
//Abrimos la conexión a la base de datos
$conexion = conectar();
$id_autor = $_GET['autor_id'];
$query = $conexion->prepare('SELECT autor_id, nombres, ape_paterno, ape_materno FROM autor WHERE autor_id = ?');
$query->bind_param('i', $id_autor);
$query->execute();
$resultado = $query->get_result();
if ($resultado) {
    $autor = $resultado->fetch_assoc();
} else {
    echo "Error al obtener los datos del autor";
    exit();
}
//Cerramos la conexión a la base de datos
desconectar($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <h1>Editar Autor</h1>
            <form method="post" action="actualizar_autor.php">
                <input type="hidden" name="autor_id" value="<?php echo $autor['autor_id']; ?>">
                <table>
                    <tbody>
                        <tr>
                            <td><label>Nombres:</label></td>
                            <td><input type="text" name="nombres" value="<?php echo $autor['nombres']; ?>"
                                    maxlength="50" required></td>
                        </tr>
                        <tr>
                            <td><label>Apellido Paterno:</label></td>
                            <td><input type="text" name="ape_paterno" value="<?php echo $autor['ape_paterno']; ?>"
                                    maxlength="50" required></td>
                        </tr>
                        <tr>
                            <td><label>Apellido Materno:</label></td>
                            <td><input type="text" name="ape_materno" value="<?php echo $autor['ape_materno']; ?>"
                                    maxlength="50"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <button class="btn btn-success" type="submit">Guardar</button>
                <a href="autor.php" class="btn btn-primary">Regresar</a>
            </form>
        </div>
    </div>
</div>

</body>

</html>