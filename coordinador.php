
<?php
session_start();

// Verificar si existe la variable de sesión tipo_user y si es igual a 1
if (isset($_SESSION['tipo_user']) && $_SESSION['tipo_user'] == 1) {
  // El usuario es un administrador, se puede mostrar el contenido
  echo "Bienvenido, cordinador";
} else {
  // Si no es un administrador, redirigir a la página de inicio
  header("Location: login/index.php");
  exit();
}
?>
