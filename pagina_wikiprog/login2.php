<?php

include("funciones.php");
require('config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $usuario = $_GET['usuario'];
    $contraseña = $_GET['contraseña'];

    if (autenticarUsuario($usuario, $contraseña)) {
        header("Location: consulta.php?usuario=$usuario");
        exit;
    } else {
        echo "Inicio de sesión fallido. Verifica tus credenciales.";
    }
}
?>