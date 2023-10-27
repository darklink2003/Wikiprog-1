<?php
include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

$registrar_id = $_GET['registrar_id'];

// Verificamos si se ha enviado un formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Recopilamos los datos del formulario
    $usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';
    $correo = isset($_GET['correo']) ? $_GET['correo'] : '';
    $contraseña = isset($_GET['contraseña']) ? $_GET['contraseña'] : '';
    $biografia = isset($_GET['biografia']) ? $_GET['biografia'] : '';

        // Comprueba si alguno de los datos está vacío antes de realizar las actualizaciones
    if (!empty($usuario) || !empty($correo) || !empty($contraseña) || !empty($biografia)) {
        // Realizamos la actualización en la base de datos
        $actualizar = editarUsuario($conexion, $registrar_id, $usuario, $correo, $contraseña, editarBiografia($conexion, $registrar_id, $biografia));

        if ($actualizar) {
            echo "Usuario actualizado con éxito.";
            header("Location: consulta.php?registrar_id=" . $registrar_id);
        } else {
            echo "Error al actualizar el usuario.";
        }
    } else {
        echo "No se han proporcionado datos para actualizar.";
    }
}

$resultados = "<br>" . consulta_ID($conexion, $registrar_id);
$resultados .= biografia($conexion, $registrar_id);

mysqli_close($conexion);

echo $resultados;
?>

<a href="consulta.php?registrar_id=<?php echo $registrar_id?>">Volver</a>
