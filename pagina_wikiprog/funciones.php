
<?php

//LOGIN//

function conectarBaseDeDatos() {
    global $host, $user, $password, $database;

    $conexion = mysqli_connect($host, $user, $password, $database);

    if (!$conexion) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    return $conexion;
}

function autenticarUsuario($usuario, $contraseña) {
    $conexion = conectarBaseDeDatos();

    $usuario = mysqli_real_escape_string($conexion, $usuario);
    $contraseña = mysqli_real_escape_string($conexion, $contraseña);

    $consulta = "SELECT * FROM registrar WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) == 1) {
        mysqli_close($conexion);
        return true; // Autenticación exitosa
    } else {
        mysqli_close($conexion);
        return false; // Autenticación fallida
    }
}

//--------------------------------------------------------------------------------------------

//REGISTRO//

// Verifica existente
function verificarExistencia($conexion, $usuario, $correo) {
    $consulta_existencia = "SELECT * FROM registrar WHERE usuario = '$usuario' OR correo = '$correo'";
    $resultado_existencia = mysqli_query($conexion, $consulta_existencia);
    return mysqli_num_rows($resultado_existencia) > 0;
}

// Insertar base de datos
function realizarRegistro($conexion, $usuario, $correo, $contraseña, $tyc) {
    $consulta = "INSERT INTO registrar (usuario, correo, contraseña, tyc) VALUES ('$usuario', '$correo', '$contraseña', '$tyc')";
    $resultado = mysqli_query($conexion, $consulta);
    return $resultado;
}

//--------------------------------------------------------------------------------------------

function obtenerUsuarioID($conexion, $usuario) {
    $consulta = "SELECT registrar_id FROM registrar WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['registrar_id'];
    } else {
        return false;
    }
}

//--------------------------------------------------------------------------------------------

function consultaUsuario($conexion, $usuario) {
    $consulta = "SELECT * FROM registrar WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        return "Nombre: " . $fila['usuario'] . "<br>" .
               "Email: " . $fila['correo'] . "<br>" .
               "Contraseña: " . $fila['contraseña'] . "<br>";
    } else {
        return "Usuario no encontrado.";
    }
}

function borrar($conexion, $usuario) {
    $consulta = "DELETE FROM registrar WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);

    return $resultado;
}