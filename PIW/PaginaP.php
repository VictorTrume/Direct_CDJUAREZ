<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones con Comentarios</title>
    <link rel="stylesheet" href="css/stylePP.css">
</head>
<body>

    <center><h1>Esta es mi pagina de mi seccion amarilla y esas cosas</h1></center> 
    <center><h3>Bueno ya se acabo el demo aqui puedes salirte <a href="Inicio_Sesion.html">Bye</a></h3></center>

    <!-- Publicación 1 -->
    <div class="container">
        <div class="image-container"><img src="images/bck1.JPG" alt=""></div>
        <div class="content-container">
            <h2 class="label">Publicacion de prueba #1</h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius maxime aliquam nemo...</p>
        </div>

        <div class="footer-container">
            <div class="share-buttons"></div>
            <center><a href="#" class="details">Mas Detalles</a></center>
        </div>

        <!-- Comentarios Publicación 1 -->
        <div class="comment-section">
            <h4>Comentarios</h4>
            <form action="php/comentarios.php" method="POST">
                <textarea name="comentario" class="comment-input" rows="3" placeholder="Escribe un comentario..."></textarea><br>
                <input type="hidden" name="id_publicacion" value="1">
                <center><button type="submit" class="comment-btn">Comentar</button></center>
            </form>

            <div class="comment-list">
                <?php
                $conexion = new mysqli("localhost", "root", "", "directorioweb");
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                $id_publicacion = 1;
                $sql = "SELECT c.comentario, u.nombre, c.fecha_comentario 
                        FROM comentarios c
                        JOIN usuarios u ON c.id_usuario = u.id
                        WHERE c.id_publicacion = $id_publicacion
                        ORDER BY c.fecha_comentario DESC";

                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<div class='comentario'>";
                        echo "<strong>" . htmlspecialchars($fila['nombre']) . "</strong>: ";
                        echo "<p>" . htmlspecialchars($fila['comentario']) . "</p>";
                        echo "<small>" . $fila['fecha_comentario'] . "</small>";
                        echo "</div><hr>";
                    }
                } else {
                    echo "No hay comentarios aún.";
                }

                $conexion->close();
                ?>
            </div>
        </div>
        <br>
    </div>

</body>
</html>
