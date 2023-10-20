<?php

include("funciones.php");

require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);


// Saca datos del formulario
$usuario = $_GET['usuario'];
$correo = $_GET['correo'];
$contraseña = $_GET['contraseña'];
$tyc = isset($_GET['tyc']) ? 0 : 1;

if (verificarExistencia($conexion, $usuario, $correo)) {
    // Usuario duplicado
    echo "El usuario o el correo ya existe";
    exit;
} else {
    // if (realizarRegistro($conexion, $usuario, $correo, $contraseña)) {
    if (realizarRegistro($conexion, $usuario, $correo, $contraseña, $tyc)) {

        // Usuario registrado bien
        header( "location: login2.php" );
        } else {
        // Usuario registrado mal
        echo "El registro ha fallado. Por favor, inténtalo de nuevo.";
    }
}

mysqli_close($conexion);
?>
