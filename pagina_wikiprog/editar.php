<?php
include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

$registrar_id = $_GET['registrar_id'];

$resultados = consultaId($conexion, $registrar_id);
$resultados .= consulta_Contra($conexion, $registrar_id);



mysqli_close($conexion);

echo $resultados;


?>
<a href="guardar.php?registrar_id=<?php echo $registrar_id; ?>&usuario=<?php echo $usuario; ?>&correo=<?php echo $correo; ?>&contraseña=<?php echo $contraseña; ?>">Guardar</a>
