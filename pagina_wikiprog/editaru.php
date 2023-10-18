<?php

require('config.php');
    
    $conexion = mysqli_connect($host, $user, $password, $database);

    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $biografia = $_POST['biografia'];



function edit_user($usuario, $correo, $contraseña, $biografia){

    $salida = "";
    $resultado = "UPDATE usuario SET usuario = $usuario, correo = $correo,biografia = $biografia, contraseña = $contraseña WHERE usuario= $usuario";
    $resultado = "UPDATE registrar SET usuario = $usuario, correo = $correo,contraseña = $contraseña WHERE usuario= $usuario";

    $salida = $resultado;

    return $salida;
}

function delete_user($usuario, $correo, $contraseña){

    $salida = "";

    $resultado = "DELETE FROM usuario_id, usuario, correo, biografia, contraseña, rango_id WHERE usuario = $usuario";

    $resultado = "DELETE FROM registrar_id, usuario, correo, contraseña, terminos_y_condiciones WHERE usuario = $usuario";

    $salida = $resultado;



    return $salida;
}

?>