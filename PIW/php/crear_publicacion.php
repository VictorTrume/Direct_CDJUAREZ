<?php
session_start();

// Verificar si el usuario inició sesión
if (!isset($_SESSION['email'])) {
    die("Acceso denegado. Debes iniciar sesión.");
}

// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'directorioweb';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$titulo = $conn->real_escape_string($_POST['titulo']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$direccion = $conn->real_escape_string($_POST['direccion']);


// Obtener ID del usuario desde el correo de la sesión
$email = $_SESSION['email'];
$sql_usuario = "SELECT id FROM usuarios WHERE email = '$email'";
$res_usuario = $conn->query($sql_usuario);

if ($res_usuario->num_rows === 0) {
    die("Usuario no encontrado.");
}

$id_usuario = $res_usuario->fetch_assoc()['id'];

// Manejar subida de imagen
$nombre_imagen = $_FILES['imagen']['name'];
$imagen_tmp = $_FILES['imagen']['tmp_name'];
$ruta_destino = "../images/" . basename($nombre_imagen);

if (!move_uploaded_file($imagen_tmp, $ruta_destino)) {
    die("Error al subir la imagen.");
}

// Insertar la nueva publicación en la base de datos
$sql_insert = "INSERT INTO publicaciones (id_usuario, titulo, descripcion, direccion, imagen)
               VALUES ($id_usuario, '$titulo', '$descripcion', '$direccion', '$nombre_imagen')";

if ($conn->query($sql_insert) === TRUE) {
    header("Location: ../PaginaP.php");
    exit();
} else {
    echo "Error al guardar la publicación: " . $conn->error;
}

$conn->close();
?>
