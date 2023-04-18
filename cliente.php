
<?php
session_start();

// Verificar si existe la variable de sesión tipo_user y si es igual a 3
if (isset($_SESSION['tipo_user']) && $_SESSION['tipo_user'] == 3) {
  // El usuario es un cliente, se puede mostrar el contenido
  $tipo_usuario = $_SESSION['tipo_user'];

} else {
  // Si no es un cliente, redirigir a la página de inicio
  header("Location: login/index.php");
  exit();
}
?>

<!-- Dentro del formulario puedes imprimir los valores en inputs -->

<input type="hidden" name="nombre" value="<?php echo $tipo_usuario; ?>">


