<?php
//No olvidar modificar esta parte cuando se suba a la nube
$host = 'localhost' ;
$user = 'root';
$password ='';
$dbname = 'directorioweb';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error){
    die("Error de conexion: ". $conn->connect_error);
}

if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombres', '$email', '$contraseña_hash')";

    if ($conn->query($sql) === TRUE){
        echo "¡¡Registro exitoso!! <a href='../Inicio_Sesion.html'>Iniciar Sesion </a>";
    } else{
        echo "Error: " .$sql . "<br>" .$conn->error;
    }

    $conn->close;
}
?>