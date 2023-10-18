<?php
// Conéctate a la base de datos
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);
    
if (!$conexion) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// Obtiene los datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

// Realiza la consulta en la base de datos (ajusta el nombre de la tabla y las columnas según tu estructura)
$consulta = "SELECT * FROM registrar WHERE usuario ='$usuario' AND contraseña = '$contraseña'";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado && mysqli_num_rows($resultado) == 1) {
    // El usuario se ha autenticado correctamente
    // echo "¡Inicio de sesión exitoso!";
    header("Location: index.html");
    exit;
} else {
    // La autenticación ha fallado
    echo "Inicio de sesión fallido. Verifica tus credenciales.";
}

// Cierra la conexión
mysqli_close($conexion);
?>
