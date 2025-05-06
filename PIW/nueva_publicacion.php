<?php
session_start();

if (!isset($_SESSION['email'])) {
    die("Acceso denegado. Debes iniciar sesión.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Publicación</title>
    <link rel="stylesheet" href="css/stylePP.css">
</head>
<body>
    <div class="container">
        <div class="content-container">
            <h2>Crear nueva publicación</h2>
            <form action="php/crear_publicacion.php" method="POST" enctype="multipart/form-data">
                <label for="titulo">Título:</label><br>
                <input type="text" name="titulo" required><br><br>

                <label for="descripcion">Descripción:</label><br>
                <textarea name="descripcion" rows="4" required></textarea><br><br>

                <label for="imagen">Imagen:</label><br>
                <input type="file" name="imagen" accept="image/*" required><br><br>

                <button type="submit" class="comment-btn">Publicar</button>
            </form>
        </div>
    </div>
</body>
</html>
