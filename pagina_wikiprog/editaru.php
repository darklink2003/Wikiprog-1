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

if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $eliminar="DELETE FROM usuarios WHERE usuario_id=$id";
    $resultado_eliminar=mysqli_query($conexion, $eliminar);


if($resultado_eliminar){
    header('location:Formulario.php?delete=2');
} 
else 
    echo "no se elimino";
}