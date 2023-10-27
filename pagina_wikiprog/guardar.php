<?php
include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

$registrar_id = $_GET['registrar_id'];
$usuario = $_GET['usuario'];
$correo = $_GET['correo'];
$contraseña = $_GET['contraseña'];



if (borrar($conexion, $registrar_id)) {
    echo "Usuario editado con éxito.";
} else {
    echo "No se pudo editar el usuario.";
}

mysqli_close($conexion);

?>
