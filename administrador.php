
<?php
session_start();

// Verificar si existe la variable de sesión tipo_user y si es igual a 0
if (isset($_SESSION['tipo_user']) && $_SESSION['tipo_user'] == 0) {
  // El usuario es un administrador, se puede mostrar el contenido
  $tipo_usuario = $_SESSION['tipo_user'];
  
  echo "Bienvenido, Adminstrador";
} else {
  // Si no es un administrador, redirigir a la página de inicio
  header("Location: login/index.php");
  exit();
}
?>
<input type="hidden" name="nombre" value="<?php echo $tipo_usuario; ?>">

<!-- CODIGO CABECERA -->
<?php
// Incluir archivo de conexión a la base de datos
include 'includes/conexion.php';

// Consulta para contar la cantidad de clientes con rol 3
$sql = "SELECT COUNT(*) as cantidad FROM usuarios WHERE rol = 3";
$resultado = mysqli_query($conn, $sql);

if ($resultado) {
  // Obtener la cantidad de clientes
  $fila = mysqli_fetch_assoc($resultado);
  $cantidadClientes = $fila['cantidad'];
} else {
  $cantidadClientes = 0;
}

mysqli_close($conn);
?>
<!-- FIN CODIGO CABECERA -->


<?php
include_once './includes/superior.php';
?>

<!-- Insertar codigo al Body -->
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Panel de Administracion</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Proyectos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-parking"></i></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Proyectos</span>
                <span class="info-box-number">
                  10
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Finalizados</span>
                <span class="info-box-number">8</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Contabilidad</span>
                <span class="info-box-number">S/.760</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Clientes</span>
                <span class="info-box-number"><?php echo $cantidadClientes; ?> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

<!-- FIN codigo BODY -->
<?php
include_once "./includes/inferior.php";
?>