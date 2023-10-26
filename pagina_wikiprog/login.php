<?php

include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $usuario = $_GET['usuario'];
    $contraseña = $_GET['contraseña'];

    if (autenticarUsuario($usuario, $contraseña)) {
        // Obtener el ID del usuario
        $registrar_id = obtenerUsuarioID($conexion, $usuario);

        if ($registrar_id !== false) {
            header("Location: index.php?registrar_id=" . $registrar_id);
            exit;
        } else {
            echo "Inicio de sesión fallido. Verifica tus credenciales.";
        }
    } else {
        echo "Inicio de sesión fallido. Verifica tus credenciales.";
    }
}

?>