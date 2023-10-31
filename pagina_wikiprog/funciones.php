
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

//--------------------------------------------------------------------------------------------
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

//--------------------------------------------------------------------------------------------

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
/**
 * Borra un registro de una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param int $registrar_id El ID del registro que se va a borrar.
 *
 * @return bool True si la consulta se ha ejecutado correctamente, false si la consulta no se ha ejecutado correctamente.
 */
function borrarBio($conexion, $registrar_id) {
    $consulta = "DELETE FROM usuario WHERE usuario_id = '$registrar_id'";
    $resultado = mysqli_query($conexion, $consulta);

    return $resultado;
}

//--------------------------------------------------------------------------------------------

/**
 * Edita los datos de un usuario en una base de datos MySQL usando PHP.
 *
 * @param mysqli $conexion La conexión a la base de datos.
 * @param int $registrar_id El ID del usuario que se va a editar.
 * @param string $usuario El nuevo nombre de usuario.
 * @param string $correo El nuevo correo electrónico.
 * @param string $contraseña La nueva contraseña.
 *
 * @return bool True si la consulta se ha ejecutado correctamente, false si la consulta no se ha ejecutado correctamente.
 */
function editarUsuario($conexion, $registrar_id, $usuario, $correo, $contraseña) {
    $usuario = mysqli_real_escape_string($conexion, $usuario);
    $correo = mysqli_real_escape_string($conexion, $correo);
    $contraseña = mysqli_real_escape_string($conexion, $contraseña);

    $sql = "UPDATE registrar SET usuario = '$usuario', correo = '$correo', contraseña = '$contraseña' WHERE registrar_id = $registrar_id";

    return mysqli_query($conexion, $sql);
}

//--------------------------------------------------------------------------------------------

/**
 * Actualiza la biografía de un usuario en la base de datos.
 *
 * @param mysqli $conexion - La conexión activa a la base de datos.
 * @param int $registrar_id - El ID del usuario cuya biografía se va a actualizar.
 * @param string $biografia - La nueva biografía que se asignará al usuario.
 *
 * @return bool - Devuelve true si la actualización fue exitosa, false en caso de error.
 */
function editarBiografia($conexion, $registrar_id, $biografia) {
    // Escapa caracteres especiales en la biografía para evitar inyecciones SQL.
    $biografia = mysqli_real_escape_string($conexion, $biografia);

    // Construye la consulta SQL para actualizar la biografía del usuario.
    $sql = "UPDATE usuario SET biografia = '$biografia' WHERE usuario_id = $registrar_id";

    // Ejecuta la consulta y devuelve el resultado (true si es exitosa, false si hay un error).
    return mysqli_query($conexion, $sql);
}


//--------------------------------------------------------------------------------------------

// Function to display course information
function llamar_tabla_curso($conexion, $curso_id) {
    // Fetch course details from the database
    $query = "SELECT * FROM curso where curso_id = $curso_id";
    $result = mysqli_query($conexion, $query);

    $salida = '';

    while ($row = mysqli_fetch_assoc($result)) {
        $salida .= '<tr>';
        $salida .= '<td>' . "Titulo: " . $row['titulo_curso'] . '</td>' . '<br>';
        $salida .= '<td>' . "Descripcion: " . $row['descripcion'] . '</td>' . '<br>';
        $salida .= '</tr>' . '<br>';
    }

    return $salida;
}

//--------------------------------------------------------------------------------------------

    function categoria($conexion, $categoria_id) {
        $consulta = "SELECT * FROM categoria WHERE categoria_id = '$categoria_id'";

        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);

            return 
                "Categoria: " . $fila['descripcion'] . "<br>";
        } else {
            return "Usuario no encontrado.";
        }
    }

    //--------------------------------------------------------------------------------------------

    function consulta_categoria($conexion, $curso_id) {
        $consulta = "SELECT * FROM curso WHERE curso_id = '$curso_id'";

        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);

            return 
                "categoria_id: " . $fila['categoria_id'] . "<br>";
        } else {
            return "Usuario no encontrado.";
        }
    }
//--------------------------------------------------------------------------------------------


// Function to display comments
function Comentarios($conexion, $curso_id) {
    $query = "SELECT * FROM comentarios where curso_id = $curso_id";
    $result = mysqli_query($conexion, $query);

    $salida = '';

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $salida .= '<tr>';
                $salida .= '<td>' . "usuario: " . $row['usuario_id'] . '</td>' . '<br>';
                $salida .= '<td>' . "comentario: " . $row['descripcion'] . '</td>' . '<br>';
                $salida .= '<td>' . "fecha: " . $row['fecha'] . '</td>' . '<br>';
                $salida .= '</tr>' . '<br>';
            }
        } else {
            $salida .= 'No hay comentarios para este curso.';
        }
    } else {
        $salida .= "Error ejecutando consulta: " . mysqli_error($conexion);
        exit;
    }

    return $salida;
}

// Function to add a comment
function agregar_comentario($conexion, $curso_id, $usuario_id, $descripcion) {
    // Validate comment input
    if (empty($descripcion)) {
        return false;
    }

    // Prepare and execute the query
    $query = "INSERT INTO comentarios (curso_id, usuario_id, descripcion, fecha) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "iis", $curso_id, $usuario_id, $descripcion);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

//--------------------------------------------------------------------------------------------


function mostrarCursos() {
    global $conexion, $registrar_id;

    // Mostrar la información de los cursos
    $sql = "SELECT curso_id, titulo_curso, descripcion FROM curso";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        echo "LISTA DE CURSOS:<br> <br>";
        while ($row = $result->fetch_assoc()) {
            $curso_id = $row["curso_id"];
            $titulo_curso = htmlspecialchars($row["titulo_curso"]); // Escapar datos para evitar XSS
            $descripcion = htmlspecialchars($row["descripcion"]); // Escapar datos para evitar XSS

            // Agregar un enlace a una página (reemplaza 'tu_pagina.php' con la URL correcta)
            echo "Título: <a href='curso.php?registrar_id=$registrar_id&curso_id=$curso_id'>$titulo_curso</a> Descripción: $descripcion<br>";
        }
    } else {
        echo "No hay cursos disponibles en la base de datos.";
    }
}

//--------------------------------------------------------------------------------------------

