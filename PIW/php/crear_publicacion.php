<?php
session_start();

if (!isset($_SESSION['email'])) {
    die("Acceso denegado. Debes iniciar sesión.");
}

/*
$host = 'localhost';
$user = 'u634466269_VictorTrume';
$password = '2s=Vy2P4dnb';
$dbname = 'u634466269_DirectCdJrz';
*/
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'directorioweb';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$titulo = $conn->real_escape_string($_POST['titulo']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$imagen_url = $conn->real_escape_string($_POST['imagen_url']);

$email = $_SESSION['email'];
$sql_usuario = "SELECT id FROM usuarios WHERE email = '$email'";
$res_usuario = $conn->query($sql_usuario);

if ($res_usuario->num_rows === 0) {
    die("Usuario no encontrado.");
}

$id_usuario = $res_usuario->fetch_assoc()['id'];

$sql_insert = "INSERT INTO publicaciones (id_usuario, titulo, descripcion, direccion, imagen)
               VALUES ($id_usuario, '$titulo', '$descripcion', '$direccion', '$imagen_url')";

if ($conn->query($sql_insert) === TRUE) {
    header("Location: ../PaginaP.php");
    exit();
} else {
    echo "Error al guardar la publicación: " . $conn->error;
}

$conn->close();
?>
