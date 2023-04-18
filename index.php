<?php include 'includes/conexion.php'; 
$tipo_user=3;
// Redireccionar según el rol del usuario
if ($tipo_user == 0) {
    header("Location: administrador.php");
    exit;
} elseif ($tipo_user == 1) {
    header("Location: coordinador.php");
    exit;
} elseif ($tipo_user == 2) {
    header("Location: redactor.php");
    exit;
} elseif ($tipo_user == 3) {
    header("Location: cliente.php");
    exit;
} else {
    // Si el rol no es válido, redireccionar a una página de error o login
    header("Location: login.php");
    exit;
}

?>


