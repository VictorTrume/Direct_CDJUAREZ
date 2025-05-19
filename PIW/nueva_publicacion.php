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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="nav.html">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/estiloAdmin.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/nav.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tagesschrift&display=swap" rel="stylesheet">
</head>
<body>
<div id="nav-placeholder"></div>
<script>
    fetch("nav.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("nav-placeholder").innerHTML = data;
        // Verifica si estás en 'nueva_publicacion.php'
        if (window.location.pathname.includes("nueva_publicacion.php")) {
            // Oculta el botón de inicio de sesión
            const loginBtn = document.getElementById("agregarBtn");
            if (loginBtn) {
                loginBtn.style.display = "none";
            }
        }
    });
</script>

<main>
  <form action="php/crear_publicacion.php" method="POST" class="contenido">
    <div class="contInp">
        <p>Titulo</p>
        <input type="text" name="titulo" required class="inpText">
        <p>Direccion</p>
        <input type="text" name="direccion" required class="inpText">
    </div>  
    <div class="contInp">
        <p>Enlace de la imagen</p>
        <input type="text" name="imagen_url" placeholder="https://..." required class="inpText">
    </div>
    <section class="contenido">
        <p>Texto Descriptivo</p>
        <textarea name="descripcion" required class="descrip"></textarea>
        <button class="botonNav btnIS">Agregar</button>
    </section>
</form>

</main>

</body>
</html>


