<?php
// Va a incluir las funciones necesarias del archivo "funciones.php"
include("funciones.php");

// Va a requerir el archivo de configuración "config.php" que contiene los datos de conexión a la base de datos
require('config.php');

// Establece una conexión con la base de datos utilizando los valores de "config.php"
$conexion = mysqli_connect($host, $user, $password, $database);

// Obtiene el valor del parámetro "registrar_id" desde la URL para identificar al usuario
$registrar_id = $_GET['registrar_id'];

// Realiza una consulta para obtener información sobre el usuario identificado por "registrar_id"
$resultados = consultaId($conexion, $registrar_id);

// Obtiene la biografía del usuario identificado por "registrar_id"
$resultados .= biografia($conexion, $registrar_id);

// Cierra la conexión a la base de datos
mysqli_close($conexion);

// Muestra los resultados obtenidos (información del usuario y biografía)
echo $resultados;
?>

<!-- Enlaces a otras páginas -->
<?php
if (!empty($registrar_id)) {
    echo '<br> <a href="editar.php?registrar_id=' . $registrar_id . '">Editar Datos</a>  ';
    echo '<a href="borrar.php?registrar_id=' . $registrar_id . '">Borrar Datos</a> ';
    echo '<a href="login.php">Cerrar Sesión</a> <br> <br>';
} else {
    echo '<a href="login.php">Iniciar Sesión</a> <br> <br>';
}

echo '<a href="index.php?registrar_id=' . $registrar_id . '">INICIO</a>';
?>
