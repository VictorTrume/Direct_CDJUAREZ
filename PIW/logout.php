<?php
session_start();            // Inicia la sesión para poder destruirla
session_unset();            // Limpia todas las variables de sesión
session_destroy();          // Destruye la sesión actual

// Redirige al inicio (puedes cambiarlo por otra página si quieres)
header("Location: index.html");
exit;