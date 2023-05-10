<?php
include('../conexion/conexion.php');
//Abrimos la conexión a la base de datos
$conexion = conectar();
$libro_id = $_GET['libro_id'];
$query = $conexion->prepare('SELECT libro_id, titulo, autor_id, anio, especialidad, editorial, enlace FROM libro WHERE libro_id = ?');
$query->bind_param('i', $libro_id);
$query->execute();
$resultado = $query->get_result();
if ($resultado) {
    $libro = $resultado->fetch_assoc();
} else {
    echo "Error al obtener los datos del libro";
    exit();
}
//Obtenemos la lista de autores
$query_autores = $conexion->prepare('SELECT autor_id, nombres FROM autor');
$query_autores->execute();
$autores = $query_autores->get_result();
//Cerramos la conexión a la base de datos
desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <h1>Editar Libro</h1>
                <form method="post" action="actualizar_libro.php">
                    <input type="hidden" name="libro_id" value="<?php echo $libro['libro_id']; ?>">
                    <table>
                        <tbody>
                            <tr>
                                <td><label>Titulo:</label></td>
                                <td><input type="text" name="titulo" value="<?php echo $libro['titulo']; ?>"
                                        maxlength="100" required></td>
                            </tr>
                            <tr>
                                <td><label>Autor:</label></td>
                                <td>
                                    <select name="autor_id">
                                        <?php while ($autor = $autores->fetch_assoc()) { ?>
                                        <option value="<?php echo $autor['autor_id']; ?>" <?php if ($libro['autor_id'] == $autor['autor_id']) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                            <?php echo $autor['nombres']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <?php if (!empty($_POST['error_autor'])) { ?>
                                    <p style="color:red"><?php echo $_POST['error_autor']; ?></p>
                                    <?php } ?>
                                </td>
                            </tr>
                            <td><label>Año</label></td>
                            <td><input type="text" name="anio" value="<?php echo $libro['anio']; ?>" maxlength="11"
                                    required></td>
                            </tr>
                            <tr>
                                <td><label>Especialidad:</label></td>
                                <td><input type="text" name="especialidad" value="<?php echo $libro['especialidad']; ?>"
                                        maxlength="50">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Editorial:</label></td>
                                <td><input type="text" name="editorial" value="<?php echo $libro['editorial']; ?>"
                                        maxlength="50">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Enlace:</label></td>
                                <td><input type="text" name="enlace" value="<?php echo $libro['enlace']; ?>"
                                        maxlength="50"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <button class="btn btn-success" type="submit">Guardar</button>
                    <a href="libro.php" class="btn btn-primary">Regresar</a>
                </form>
            </div>
        </div>
    </div>