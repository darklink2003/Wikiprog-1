<?php

require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

// Consulta SQL para obtener los primeros 10 registros de cursos ordenados por curso_id de forma ascendente (ASC)
$resultadoCursos = $conexion->query("SELECT * FROM leccion ORDER BY leccion_id ASC LIMIT 10");
?>

<h2>Datos de Leccion</h2>
<table>
    <tr>
        <th>Leccion ID</th>
        <th>Titulo</th>
        <th>Descripcion</th>
        <th>Curso ID</th>
    </tr>
    <?php
    if ($resultadoCursos->num_rows > 0) {
        while ($fila = mysqli_fetch_assoc($resultadoCursos)) {
            echo '<tr>';
            echo '<td>' . $fila['leccion_id'] . '</td>';
            echo '<td>' . $fila['titulo'] . '</td>';
            echo '<td>' . $fila['descripcion'] . '</td>';
            echo '<td>' . $fila['curso_id'] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">No se encontraron resultados para cursos.</td></tr>';
    }
    ?>
</table>

<?php
mysqli_close($conexion);
?>
