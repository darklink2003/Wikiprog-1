
<?php

//LOGIN//


/**
 * Conecta a una base de datos MySQL usando PHP.
 *
 * @param string $host El nombre del host del servidor MySQL.
 * @param string $user El nombre de usuario de la base de datos.
 * @param string $password La contraseña de la base de datos.
 * @param string $database El nombre de la base de datos a la que conectarse.
 *
 * @return mysqli|false Devuelve la conexión a la base de datos o `false` si la conexión no se pudo establecer.
 */
function conectarBaseDeDatos() {
    global $host, $user, $password, $database;

    $conexion = mysqli_connect($host, $user, $password, $database);

    if (!$conexion) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    return $conexion;
}
//------------------------------------------------------------------------------------------------------//
/**
 * Autentica a un usuario en una base de datos MySQL usando PHP.
 *
 * @param string $usuario El nombre de usuario del usuario.
 * @param string $contraseña La contraseña del usuario.
 *
 * @return bool Devuelve `true` si la autenticación fue exitosa, `false` si la autenticación falló.
 */

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
/**
 * Verifica la existencia de un usuario o correo electrónico en una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param string $usuario El nombre de usuario del usuario.
 * @param string $correo El correo electrónico del usuario.
 *
 * @return bool Devuelve `true` si el usuario o el correo electrónico ya existe, `false` si el usuario o el correo electrónico no existe.
 */
function verificarExistencia($conexion, $usuario, $correo) {
    $consulta_existencia = "SELECT * FROM registrar WHERE usuario = '$usuario' OR correo = '$correo'";
    $resultado_existencia = mysqli_query($conexion, $consulta_existencia);
    return mysqli_num_rows($resultado_existencia) > 0;
}

// Insertar base de datos

/**
 * Realiza un registro de usuario en una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param string $usuario El nombre de usuario del usuario.
 * @param string $correo El correo electrónico del usuario.
 * @param string $contraseña La contraseña del usuario.
 * @param int $tyc La aceptación de los términos y condiciones.
 *
 * @return bool Devuelve `true` si el registro se realizó correctamente, `false` si el registro no se pudo realizar.
 */
function realizarRegistro($conexion, $usuario, $correo, $contraseña, $tyc) {
    $consulta = "INSERT INTO registrar (usuario, correo, contraseña, tyc) VALUES ('$usuario', '$correo', '$contraseña', '$tyc')";
    $resultado = mysqli_query($conexion, $consulta);
    return $resultado;
}

//--------------------------------------------------------------------------------------------
/**
 * Obtiene el ID de usuario de un usuario dado en una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param string $usuario El nombre de usuario del usuario.
 *
 * @return int Devuelve el ID de usuario si se encuentra un registro coincidente, `false` si el registro no se encuentra.
 */
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
/**
 * Consulta los datos de un usuario en una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param string $usuario El nombre de usuario del usuario.
 *
 * @return string Los datos del usuario si se encuentra un registro coincidente, un mensaje de error si el registro no se encuentra.
 */
function consultaUsuario($conexion, $usuario) {
    $consulta = "SELECT * FROM registrar WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        return "Nombre Usuario: " . $fila['usuario'] . "<br>" .
               "Email: " . $fila['correo'] . "<br>" .
               "Biografía: " . $fila['contraseña'] . "<br>";
    } else {
        return "Usuario no encontrado.";
    }
}

//--------------------------------------------------------------------------------------------
/**
 * Consulta los datos de un usuario en una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param int $registrar_id El ID del usuario.
 *
 * @return string Los datos del usuario si se encuentra un registro coincidente, un mensaje de error si el registro no se encuentra.
 */
function consultaId($conexion, $registrar_id) {
    $consulta = "SELECT * FROM registrar WHERE registrar_id = '$registrar_id'";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        return "Nombre Usuario: " . $fila['usuario'] . "<br>" .
               "Email: " . $fila['correo'] . "<br>";
    } else {
        return "Usuario no encontrado.";
    }
}

//--------------------------------------------------------------------------------------------
/**
 * Consulta los datos de un usuario en una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param int $registrar_id El ID del usuario.
 *
 * @return string Los datos del usuario si se encuentra un registro coincidente, un mensaje de error si el registro no se encuentra.
 */
function consulta_ID($conexion, $registrar_id) {
    $consulta = "SELECT * FROM registrar WHERE registrar_id = '$registrar_id'";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        return "Nombre Usuario: " . $fila['usuario'] . "<br>" .
               "Email: " . $fila['correo'] . "<br>" .
               "Contraseña: " . $fila['contraseña'] . "<br>";

    } else {
        return "Usuario no encontrado.";
    }
}

//--------------------------------------------------------------------------------------------
/**
 * Consulta la biografía de un usuario en una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param int $registrar_id El ID del usuario.
 *
 * @return string La biografía del usuario si se encuentra un registro coincidente, un mensaje de error si el registro no se encuentra.
 */
function biografia($conexion, $registrar_id) {
    $consulta = "SELECT * FROM usuario WHERE usuario_id = '$registrar_id'";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        return 
               "Biografía: " . $fila['biografia'] . "<br>";
    } else {
        return "Usuario no encontrado.";
    }
}

//--------------------------------------------------------------------------------------------
/**
 * Consulta la contraseña de un usuario en una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param int $registrar_id El ID del usuario.
 *
 * @return string La contraseña del usuario si se encuentra un registro coincidente, un mensaje de error si el registro no se encuentra.
 */
function consulta_Contra($conexion, $registrar_id) {
    $consulta = "SELECT * FROM registrar WHERE registrar_id = '$registrar_id'";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        return 
               "Contraseña: " . $fila['contraseña'] . "<br>";
    } else {
        return "Usuario no encontrado.";
    }
}


//--------------------------------------------------------------------------------------------
/**
 * Borra un registro de una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param int $registrar_id El ID del registro que se va a borrar.
 *
 * @return bool True si la consulta se ha ejecutado correctamente, false si la consulta no se ha ejecutado correctamente.
 */
function borrar($conexion, $registrar_id) {
    $consulta = "DELETE FROM registrar WHERE registrar_id = '$registrar_id'";
    $resultado = mysqli_query($conexion, $consulta);

    return $resultado;
}

//--------------------------------------------------------------------------------------------


function editarUsuario($conexion, $registrar_id, $usuario, $correo, $contraseña) {
    $usuario = mysqli_real_escape_string($conexion, $usuario);
    $correo = mysqli_real_escape_string($conexion, $correo);
    $contraseña = mysqli_real_escape_string($conexion, $contraseña);

    $sql = "UPDATE registrar SET usuario = '$usuario', correo = '$correo', contraseña = '$contraseña' WHERE registrar_id = $registrar_id";

    return mysqli_query($conexion, $sql);
}

function editarBiografia($conexion, $registrar_id, $biografia) {
    $biografia = mysqli_real_escape_string($conexion, $biografia);

    $sql = "UPDATE usuario SET biografia = '$biografia' WHERE usuario_id = $registrar_id";

    return mysqli_query($conexion, $sql);
}
