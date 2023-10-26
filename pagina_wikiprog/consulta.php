<?php
include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

$registrar_id = $_GET['registrar_id'];

$resultados = consultaId($conexion, $registrar_id);
$resultados .= biografia($conexion, $registrar_id);


mysqli_close($conexion);

echo $resultados;


?>

<a href="borrar.php?registrar_id=<?php echo $registrar_id?>">Borrar Datos</a>
<a href="editar.php?registrar_id=<?php echo $registrar_id?>">Editar Datos</a> <br> <br>
<a href="index.php?registrar_id=<?php echo $registrar_id?>">INICIO</a> 


