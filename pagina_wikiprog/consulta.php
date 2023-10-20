<?php
include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

$usuario = $_GET['usuario'];

$resultados = consultaUsuario($conexion, $usuario);

mysqli_close($conexion);

echo $resultados;


?>

<a href="borrar.php?usuario=<?php echo $usuario?>">Borrar Datos</a> 
