<?php
include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

$registrar_id = $_GET['registrar_id'];

?>

<a href="cursos.php?registrar_id=<?php echo $registrar_id?>">Cursos</a>
<a href="consulta.php?registrar_id=<?php echo $registrar_id?>">Pefil</a> 

