<?php
//No olvidar modificar esta parte cuando se suba a la nube
$host = 'localhost' ;
$user = 'root';
$password ='';
$dbname = 'directorioweb';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexion: ". $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['contraseña'])) {
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

  
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
  
        $row = $result->fetch_assoc();
        
        
        if (password_verify($contraseña, $row['contraseña'])) {
           
            session_start();
            $_SESSION['email'] = $row['email'];
            $_SESSION['nombre'] = $row['nombre'];

            header("Location: ../PaginaP.php");
            exit();

           /* echo "Bienvenido, " . $row['nombre'] . "! <a href='dashboard.php'>Ir al panel</a>";*/
        } else {
            echo "Contraseña incorrecta.";
            header("Location: ../Inicio_Sesion.html");
            exit();
        }
    } else {
        $_SESSION['error'] = "El correo electrónico no está registrado o la contraseña es incorrecta.";
        header("Location: ../Inicio_Sesion.html");
        exit();
       /* echo "Usuario no encontrado.";*/
    }

    $conn->close();
}

?>