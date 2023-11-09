<?php
// Va a incluir las funciones necesarias del archivo "funciones.php"
include("funciones.php");

// Va a requerir el archivo de configuración "config.php" que contiene los datos de conexión a la base de datos
require('config.php');

// Establece una conexión con la base de datos utilizando los valores de "config.php"
$conexion = mysqli_connect($host, $user, $password, $database);


// Obtiene los datos del formulario a través de la superglobal $_GET
$usuario = $_GET['usuario']; // Obtén el nombre de usuario
$correo = $_GET['correo'];   // Obtén la dirección de correo
$contraseña = $_GET['contraseña']; // Obtén la contraseña
$tyc = isset($_GET['tyc']) ? 0 : 1; // Verifica si se aceptaron los términos y condiciones


// Verificar si los campos obligatorios no están vacíos
if (empty($usuario) || empty($correo) || empty($contraseña)) {
    echo "Por favor, completa todos los campos obligatorios.";
} else {
    // Verificar si el usuario o correo ya existen en la base de datos
    // Realizar el registro del usuario
if (realizarRegistro($conexion, $usuario, $correo, $contraseña, $tyc)) {
    // Usuario registrado exitosamente
    // Guardar la biografía
    $biografia = $_GET['biografia']; // Obtén la biografía del formulario
    if (Registro_Biografia($conexion, mysqli_insert_id($conexion), $biografia)) {
        // Biografía registrada exitosamente
        header("location: login.php"); // Redirige al usuario a la página de inicio de sesión
    } else {
        // Registro de biografía fallido
        echo "El registro de la biografía ha fallado. Por favor, inténtalo de nuevo.";
    }
} else {
    // Registro de usuario fallido
    echo "El registro ha fallado. Por favor, inténtalo de nuevo.";
}

}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
