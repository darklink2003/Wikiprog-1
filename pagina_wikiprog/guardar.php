<?php
// Incluye las funciones necesarias desde el archivo "funciones.php"
include("funciones.php");

// Requiere el archivo de configuración "config.php" que contiene los datos de conexión a la base de datos
require('config.php');

// Establece una conexión con la base de datos utilizando los valores de "config.php"
$conexion = mysqli_connect($host, $user, $password, $database);

// Obtiene el valor del parámetro "registrar_id" desde la URL para identificar al usuario
$registrar_id = $_GET['registrar_id'];

// Obtiene los valores de "usuario", "correo" y "contraseña" desde la URL (datos editados)
$usuario = $_GET['usuario'];
$correo = $_GET['correo'];
$contraseña = $_GET['contraseña'];

// Intenta editar el usuario en la base de datos utilizando la función "borrar"
if (borrar($conexion, $registrar_id)) {
    echo "Usuario editado con éxito.";
} else {
    echo "No se pudo editar el usuario.";
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
