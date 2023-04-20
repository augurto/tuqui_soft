<?php
  include('../conexion.php');

  // Insertar datos en la tabla proyecto
  if (isset($_POST['guardar-proyecto'])) {
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $cliente_id = $_POST['cliente_id'];
    $monto = $_POST['monto'];
    $inicio_entrega = $_POST['inicio_entrega'];
    $fin_entrega = $_POST['fin_entrega'];

    $query = "INSERT INTO proyecto (nombre_proyecto, cliente_id, monto, inicio_entrega, fin_entrega) VALUES ('$nombre_proyecto', $cliente_id, $monto, '$inicio_entrega', '$fin_entrega')";

    mysqli_query($conn, $query);

    // Obtener el ID del proyecto recién insertado
    $proyecto_id = mysqli_insert_id($conn);

    // Insertar datos en la tabla detalle_proyecto
    if (isset($_POST['asesores'])) {
      $asesores = $_POST['asesores'];

      foreach ($asesores as $asesor) {
        $asesor_id = $asesor['id'];
        $rol = $asesor['rol'];

        $query = "INSERT INTO detalle_proyecto (proyecto_id, asesor_id, rol) VALUES ($proyecto_id, $asesor_id, '$rol')";

        mysqli_query($conn, $query);
      }
    }

    header('Location: ../../proyectos.php');
  }
?>
