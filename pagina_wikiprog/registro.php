<?php

require('config.php');
$conexion = mysqli_connect($host, $user, $password, $database);

// Verifica existente
function verificarExistencia($conexion, $usuario, $correo) {
    $consulta_existencia = "SELECT * FROM registrar WHERE usuario = '$usuario' OR correo = '$correo'";
    $resultado_existencia = mysqli_query($conexion, $consulta_existencia);
    return mysqli_num_rows($resultado_existencia) > 0;
}

// Insertar base de datos
function realizarRegistro($conexion, $usuario, $correo, $contraseña, $terminos_y_condiciones) {
    $consulta = "INSERT INTO registrar (usuario, correo, contraseña, terminos_y_condiciones) VALUES ('$usuario', '$correo', '$contraseña', '$terminos_y_condiciones')";
    $resultado = mysqli_query($conexion, $consulta);
    return $resultado;
}

// Saca datos del formulario
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$terminos_y_condiciones = isset($_POST['terminos_y_condiciones']) ? 1 : 0;

if (verificarExistencia($conexion, $usuario, $correo)) {
    // Usuario duplicado
    echo "El usuario o el correo ya existe";
} else {
    if (realizarRegistro($conexion, $usuario, $correo, $contraseña, $terminos_y_condiciones)) {
        // Usuario registrado bien
        echo "¡Registro exitoso!";
    } else {
        // Usuario registrado mal
        echo "El registro ha fallado. Por favor, inténtalo de nuevo.";
    }
}

mysqli_close($conexion);
?>
