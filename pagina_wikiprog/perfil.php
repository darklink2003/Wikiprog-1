<?php

require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

$registrar_id = $_GET['registrar_id'];

// Consulta SQL para obtener los primeros 10 registros de usuarios ordenados por usuario_id de forma ascendente (ASC)
$resultadoUsuarios = $conexion->query("SELECT * FROM registrar ORDER BY registrar_id ASC LIMIT 10");
?>

<h2>Datos de Usuarios</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Password</th>
        <th>Terminos Y Condiciones</th>
    </tr>
    <?php
    if ($resultadoUsuarios->num_rows > 0) {
        while ($fila = mysqli_fetch_assoc($resultadoUsuarios)) {
            echo '<tr>';
            echo '<td>' . $fila['registrar_id'] . '</td>';
            echo '<td>' . $fila['usuario'] . '</td>';
            echo '<td>' . $fila['correo'] . '</td>';
            echo '<td>' . $fila['contraseña'] . '</td>';
            echo '<td>' . $fila['tyc'] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="5">No se encontraron resultados para usuarios.</td></tr>';
    }
    ?>
</table>

<?php
mysqli_close($conexion);
?>
