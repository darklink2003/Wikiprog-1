<?php
include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);


$registrar_id = $_GET['registrar_id'];

// Verificamos si se ha enviado un formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Recopilamos los datos del formulario
    $usuario = $_GET['usuario'];
    $correo = $_GET['correo'];
    $contraseña = $_GET['contraseña'];
    $biografia = $_GET['biografia'];


    // Realizamos la actualización en la base de datos
    $actualizar = editarUsuario($conexion, $registrar_id, $usuario, $correo, $contraseña, editarBiografia($conexion, $registrar_id, $biografia));

    if ($actualizar) {
        echo "Usuario actualizado con éxito.";
        header("Location: consulta.php?registrar_id=" . $registrar_id);
    } else {
        echo "Error al actualizar el usuario.";
    }
}

$resultados = "<br>" . consulta_ID($conexion, $registrar_id);
$resultados .= biografia($conexion, $registrar_id);


mysqli_close($conexion);

echo $resultados;
?>

<!--
<form method="post" action="">
    <input type="text" name="usuario" placeholder="Nombre">
    <input type="text" name="correo" placeholder="Correo">
    <input type="text" name="contraseña" placeholder="Contraseña">
    <input type="text" name="biografia" placeholder="Biografia">
    <input type="submit" name="editar_usuario" value="Editar Usuario">
</form> -->

<a href="borrar.php?registrar_id=<?php echo $registrar_id?>">Borrar Datos</a>
