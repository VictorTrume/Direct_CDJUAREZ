<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juarez</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/estiloLugares.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
<div id="nav-placeholder"></div>
<script>
  fetch("nav.php")
    .then(response => response.text())
    .then(data => {
      document.getElementById("nav-placeholder").innerHTML = data;
    });
</script>

<main>
    <div id="buscadores">
        <h2>Filtros</h2>
        <form method="GET" action="" class="contFiltro">
            <p>Restaurante</p>
            <input type="text" name="buscar" placeholder="Buscar restaurante" value="<?= $_GET['buscar'] ?? '' ?>" class="separador">
            <p>Direccion</p>
            <input type="text" name="direccion" placeholder="Ej. Av. Tecnológico" value="<?= $_GET['direccion'] ?? '' ?>" class="separador">
            <input type="submit" value="Buscar" class="buscarBtn btnWeb">
        </form>
    </div>

    <div class="contenedorCont">
        <?php
       //$conexion = new mysqli("localhost", "u634466269_VictorTrume", "2s=Vy2P4dnb", "u634466269_DirectCdJrz");
       $conexion = new mysqli("localhost", "root", "", "directorioweb");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $sql = "SELECT p.id, p.titulo, p.descripcion, p.imagen, u.nombre, p.direccion, p.fecha
                FROM publicaciones p
                JOIN usuarios u ON p.id_usuario = u.id
                ORDER BY p.fecha DESC";

        if (isset($_GET['buscar']) || isset($_GET['direccion'])) {
            $buscar = $_GET['buscar'] ?? '';
            $direccion = $_GET['direccion'] ?? '';

            $sql = "SELECT p.id, p.titulo, p.descripcion, p.imagen, u.nombre, p.direccion, p.fecha
                    FROM publicaciones p
                    JOIN usuarios u ON p.id_usuario = u.id
                    WHERE 1=1";

            if (!empty($buscar)) {
                $buscar = $conexion->real_escape_string($buscar);
                $sql .= " AND titulo LIKE '%$buscar%'";
            }

            if (!empty($direccion)) {
                $direccion = $conexion->real_escape_string($direccion);
                $sql .= " AND LOWER(direccion) LIKE LOWER('%$direccion%')";
            }
        }

        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while ($publicacion = $resultado->fetch_assoc()) {
                $id_pub = $publicacion['id'];
                echo "<div class='contLugar'>";

                
                $imagen = htmlspecialchars($publicacion['imagen']);
                if (filter_var($imagen, FILTER_VALIDATE_URL)) {
                    echo "<div class='contImg'><img src='" . $imagen . "' alt=''></div>";
                } else {
                    echo "<div class='contImg'><img src='images/" . $imagen . "' alt=''></div>";
                }

                echo "<div class='contInf'>";
                echo "<h2>" . htmlspecialchars($publicacion['titulo']) . "</h2>";
                echo "<p class='descrip'>" . htmlspecialchars($publicacion['descripcion']) . "</p>";
                echo "<p class='descrip'><strong>Dirección:</strong> " . htmlspecialchars($publicacion['direccion']) . "</p>";
                echo "<small>Publicado por " . htmlspecialchars($publicacion['nombre']) . " el " . $publicacion['fecha'] . "</small>";
                echo "<center><button type='submit' class='buscarBtn btnWeb btn-comentario'>Ver Comentarios</button></center>";
                echo "</div>";

                // Sección para comentar
                echo "<div class='comment-section desaparecer'>";
                echo "<form action='php/comentarios.php' method='POST'>";
                echo "<h2 class='comentar'>Comentar</h2>";
                echo "<textarea name='comentario' class='descripInp' rows='2' required></textarea><br>";
                echo "<input type='hidden' name='id_publicacion' value='" . $id_pub . "'>";
                echo "<center><button type='submit' class='buscarBtn btnWeb'>Comentar</button></center>";
                echo "</form>";

                // Ver comentarios
                $sql_com = "SELECT c.comentario, u.nombre, c.fecha
                            FROM comentarios c
                            JOIN usuarios u ON c.id_usuario = u.id
                            WHERE c.id_publicacion = $id_pub
                            ORDER BY c.fecha DESC";
                $res_com = $conexion->query($sql_com);

                if ($res_com->num_rows > 0) {
                    echo "<div class='comment-list'>";
                    while ($comentario = $res_com->fetch_assoc()) {
                        echo "<div class='comment descrip'>";
                        echo "<strong>" . htmlspecialchars($comentario['nombre']) . "</strong>: ";
                        echo "<p>" . htmlspecialchars($comentario['comentario']) . "</p>";
                        echo "<small>" . $comentario['fecha'] . "</small>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p class='espacio'>No hay comentarios aún.</p>";
                }
                echo "</div><br>"; // .comment-section
                echo "</div>"; // .contLugar
            }
        } else {
            echo "<p>No hay publicaciones para mostrar.</p>";
        }

        $conexion->close();
        ?>
    </div>
</main>

<div id="footer-placeholder"></div>
<script>
    fetch("footer.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("footer-placeholder").innerHTML = data;
        });
</script>

<script src="JS/btn.js"></script>
</body>
</html>

