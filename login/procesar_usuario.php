<?php
// Establecer la conexión a la base de datos
include_once "../includes/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta para obtener el usuario
    $sql = "SELECT * FROM usuarios WHERE (email='$email' OR usuario='$email') AND password='$password'";

    // Ejecutar la consulta
    $result = mysqli_query($conn, $sql);
    
    // ...
    
    // Obtener los datos del usuario
    $usuario = mysqli_fetch_assoc($result);
    
    // Establecer la variable tipo_user según el rol del usuario
    switch ($usuario["rol"]) {
      case 0:
        $tipo_user = 0;
        break;
      case 1:
        $tipo_user = 1;
        break;
      case 2:
        $tipo_user = 2;
        break;
      case 3:
        $tipo_user = 3;
        break;
      default:
        echo "Rol no válido";
    }
    
    // Iniciar la sesión y guardar la variable tipo_user
    session_start();
    $_SESSION['tipo_user'] = $tipo_user;
    
    // Redirigir a la página correspondiente según el rol
    switch ($tipo_user) {
      case 0:
        header("Location: ../administrador.php");
        break;
      case 1:
        header("Location: ../coordinador.php");
        break;
      case 2:
        header("Location: ../redactor.php");
        break;
      case 3:
        header("Location: ../cliente.php");
        break;
      default:
        header("Location: index.php");
    }
    
    
}
?>
