<?php
//No olvidar modificar esta parte cuando se suba a la nube
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'directorioweb';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexion: ". $conn->connect_error);
}

if (isset($_POST['registro'])) {
    // Escapar las entradas para evitar inyección SQL
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $contraseña = $conn->real_escape_string($_POST['contraseña']);

    // Crear el hash de la contraseña
    $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

    // Insertar la nueva entrada en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña_hash')";

    if ($conn->query($sql) === TRUE) {
        echo "<a href='../Inicio_Sesion.html'>Iniciar Sesion </a>";
    } else {
        echo "Error: " .$sql . "<br>" .$conn->error;
    }

    $conn->close();
}
?>
<?php

//echo "El archivo registro.php se está ejecutando.";  
?>
