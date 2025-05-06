<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seccion Amarilla de Juaritos</title>
    <link rel="stylesheet" href="css/styleP1.css">
</head>
<body>
    <header class = "main-header">
    <h1>Juarez Best</h1> <!--Nombre tentativo esta bien feo pero por mientras lo dejo como placeholder-->
    <nav>
        <a href="nueva_publicacion.php">Agregar Publicacion</a>
        <a href="Inicio_Sesion.html">Salir</a>
    </nav>
    </header>

     <!--<center><h1>Esta es mi pagina de mi seccion amarilla y esas cosas</h1></center> 
    <center><h3>Bueno ya se acabo el demo aqui puedes salirte <a href="Inicio_Sesion.html">Bye</a></h3></center>
   <center><h3>funcion subir publicaciones <a href="nueva_publicacion.php">aqui merito</a></h3></center>-->

    
      
    <div class="container">
        <div class="image-container"><img src="images/bck1.JPG" alt=""></div>
        <div class="content-container">
            <h2 class="label">Publicaccion fija</h2> <!--Publicacion default esta siempre va a estar-->
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius maxime aliquam nemo...</p>
        
       
         <!--
          <div class="comment-section">
            <h4>Comentarios</h4>
            <form action="php/comentarios.php" method="POST">
                <textarea name="comentario" class="comment-input" rows="3" placeholder="Escribe un comentario..."></textarea><br>
                <input type="hidden" name="id_publicacion" value="1">
                <center><button type="submit" class="comment-btn">Comentar</button></center>
            </form>

            
        
        </div>
-->
        </div>
        </div>
        
    </div>
    <br>
    
    <!--<center><button class="publication-btn"><a href="nueva_publicacion.php">Agregar Publicacion</a></button></center> -->
<center><h1>PUBLICACIONES</h1></center>
<?php
$conexion = new mysqli("localhost", "root", "", "directorioweb");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT p.id, p.titulo, p.descripcion, p.imagen, u.nombre, p.direccion, p.fecha
        FROM publicaciones p
        JOIN usuarios u ON p.id_usuario = u.id
        ORDER BY p.fecha DESC";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($publicacion = $resultado->fetch_assoc()) {
        $id_pub = $publicacion['id'];
        echo "<div class='container'>";
        echo "<div class='image-container'><img src='images/" . htmlspecialchars($publicacion['imagen']) . "' alt=''></div>";
        echo "<div class='content-container'>";
        echo "<h2>" . htmlspecialchars($publicacion['titulo']) . "</h2>";
        echo "<p>" . htmlspecialchars($publicacion['descripcion']) . "</p>";
        echo "<p><strong>Dirección:</strong> " . htmlspecialchars($publicacion['direccion']) . "</p>";
        echo "<small>Publicado por " . htmlspecialchars($publicacion['nombre']) . " el " . $publicacion['fecha'] . "</small>";
        
        // Seccion para comentar
        echo "<div class='comment-section'>";
        echo "<form action='php/comentarios.php' method='POST'>";
        echo "<textarea name='comentario' class='comment-input' rows='2' required></textarea><br>";
        echo "<input type='hidden' name='id_publicacion' value='" . $id_pub . "'>";
        echo "<center><button type='submit' class='comment-btn'>Comentar</button></center>";
        echo "</form>";

        // Seccion para ver comentarios
        $sql_com = "SELECT c.comentario, u.nombre, c.fecha
                    FROM comentarios c
                    JOIN usuarios u ON c.id_usuario = u.id
                    WHERE c.id_publicacion = $id_pub
                    ORDER BY c.fecha DESC";
        $res_com = $conexion->query($sql_com);

        if ($res_com->num_rows > 0) {
            echo "<div class='comment-list'>";
            while ($comentario = $res_com->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<strong>" . htmlspecialchars($comentario['nombre']) . "</strong>: ";
                echo "<p>" . htmlspecialchars($comentario['comentario']) . "</p>";
                echo "<small>" . $comentario['fecha'] . "</small>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>No hay comentarios aún.</p>";
        }

        echo "</div>"; // .comment-section
        echo "</div>"; // .content-container
        echo "</div><br>"; // .container
    }
} else {
    echo "<p>No hay publicaciones para mostrar.</p>";
}

$conexion->close();
?>
    
    
 

</body>
</html>
