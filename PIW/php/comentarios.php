<?php
session_start();

// Validar que el usuario esté logueado
if (!isset($_SESSION['email']) || !isset($_SESSION['nombre'])) {
    die("Acceso denegado. Debes iniciar sesión.");
}

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'directorioweb';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = $conn->real_escape_string($_POST['comentario']);
    $id_publicacion = intval($_POST['id_publicacion']);

    // Obtener el ID del usuario según su email
    $email = $_SESSION['email'];
    $sql_usuario = "SELECT id FROM usuarios WHERE email = '$email'";
    $resultado = $conn->query($sql_usuario);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $id_usuario = $fila['id'];

        // Insertar comentario
        $sql_insertar = "INSERT INTO comentarios (id_usuario, id_publicacion, comentario, fecha)
                         VALUES ($id_usuario, $id_publicacion, '$comentario', NOW())";

        if ($conn->query($sql_insertar) === TRUE) {
            header("Location: ../PaginaP.php");
            exit();
        } else {
            echo "Error al guardar el comentario: " . $conn->error;
        }
    } else {
        echo "No se encontró el usuario.";
    }
}

$conn->close();
?>
