<?php session_start(); ?>
<nav>
    <div class="logo" >
        <a href="index.html">
            <img src="images/logoTemp.png" alt="Logo" height="80%" style="margin: 10% 0;">
        </a>
    </div>
    
    <div class="btn-nav">
        <?php if (isset($_SESSION['email'])): ?>
            <button class="botonNav" id="agregarBtn" onclick="location.href='nueva_publicacion.php'">Agregar lugar</button>
            <button class="botonNav" onclick="location.href='logout.php'">Cerrar sesión</button>
        <?php else: ?>
            <button class="botonNav" onclick="location.href='Inicio_Sesion.html'">Inicio Sesion</button>
            <button class="botonNav" onclick="location.href='Registro.html'">Registro</button>
        <?php endif; ?>
    </div>
</nav>