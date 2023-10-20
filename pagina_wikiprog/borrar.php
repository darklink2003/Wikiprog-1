<?php
include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

$usuario = $_GET['usuario'];

if (borrar($conexion, $usuario)) {
    echo "Usuario eliminado con éxito.";
} else {
    echo "No se pudo eliminar el usuario.";
}

mysqli_close($conexion);

?>
