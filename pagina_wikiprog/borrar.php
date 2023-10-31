<?php
// Va a incluir las funciones necesarias del archivo "funciones.php"
include("funciones.php");

// Va a requerir el archivo de configuración "config.php" que contiene los datos de conexión a la base de datos
require('config.php');

// Establece una conexión con la base de datos utilizando los valores de "config.php"
$conexion = mysqli_connect($host, $user, $password, $database);

// Obtiene el valor del parámetro "registrar_id" desde la URL
$registrar_id = $_GET['registrar_id'];

// Verifica si se ha enviado el parámetro "confirm" en la URL y si su valor es "yes"
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    // Si se cumple la condición, intenta eliminar el usuario
    if (borrar($conexion, $registrar_id)) {
        // Llama a la función "borrarBio" para eliminar datos relacionados con el usuario
        borrarBio($conexion, $registrar_id);
        echo "Usuario eliminado con éxito.";
        // Enlace para volver a la página de perfil
        echo '<a href="login.php?">Volver</a>';
        
    } else {
        echo "No se pudo eliminar el usuario.";
    }
} else {
    // Si no se confirma la eliminación, se muestra un mensaje de confirmación al usuario
    echo "¿Estás seguro de que deseas eliminar este usuario?";
    // Se proporciona un enlace para confirmar la eliminación (Sí)
    echo '<a href="borrar.php?registrar_id=' . $registrar_id . '&confirm=yes">Sí</a>';
    // Se proporciona un enlace para cancelar la eliminación (No) y regresar al perfil
    echo ' | <a href="perfil.php?registrar_id=' . $registrar_id .'">No</a>';
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
