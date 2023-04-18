
<?php
session_start();

// Verificar si existe la variable de sesión tipo_user y si es igual a 3
if (isset($_SESSION['tipo_user']) && $_SESSION['tipo_user'] == 3) {
  // El usuario es un administrador, se puede mostrar el contenido
  echo "Bienvenido, Usuario";
} else {
  // Si no es un administrador, redirigir a la página de inicio
  header("Location: login/index.php");
  exit();
}
?>
