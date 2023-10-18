<?php

require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

// Consulta SQL para obtener los primeros 10 registros de cursos ordenados por curso_id de forma ascendente (ASC)
$resultadoCursos = $conexion->query("SELECT * FROM curso ORDER BY curso_id ASC LIMIT 10");
?>

<h2>Datos de Curso</h2>
<table>
    <tr>
        <th>Curso ID</th>
        <th>Titulo Curso</th>
        <th>Descripcion</th>
        <th>Categoria ID</th>
    </tr>
    <?php
    if ($resultadoCursos->num_rows > 0) {
        while ($fila = mysqli_fetch_assoc($resultadoCursos)) {
            echo '<tr>';
            echo '<td>' . $fila['curso_id'] . '</td>';
            echo '<td>' . $fila['titulo_curso'] . '</td>';
            echo '<td>' . $fila['descripcion'] . '</td>';
            echo '<td>' . $fila['categoria_id'] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">No se encontraron resultados para cursos.</td></tr>';
    }
    ?>
</table>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario de comentarios
    $username = $_POST["usuario_id"];
    $commentText = $_POST["comentarios"];

    // Conecta a la base de datos (Asegúrate de tener la configuración correcta en 'config.php')
    require('config.php');
    $conexion = mysqli_connect($host, $user, $password, $database);

    // Verifica la conexión a la base de datos
    if (!$conexion) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Inserta el comentario en la base de datos
    $query = "INSERT INTO comentarios (usuario, comentarios) VALUES (?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ss", $username, $commentText);

    if ($stmt->execute()) {
        // El comentario se insertó correctamente
        echo '<p id="comment-success-message">¡Comentario enviado con éxito!</p>';
    } else {
        // Hubo un error al insertar el comentario
        echo '<p id="comment-success-message">Hubo un error al enviar el comentario.</p>';
        echo 'Error: ' . $stmt->error;
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}

?>

<?php
mysqli_close($conexion);
?>
