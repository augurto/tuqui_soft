<?php
  include('../conexion.php');

        // Obtener los valores ingresados por el usuario
        $nombreProyecto = $_POST['nombre-proyecto'];
        $idCliente = $_POST['nombre_cliente'];
        $idUniversidad = $_POST['nombre_universidad'];
        $idTipoProyecto = $_POST['tipo_proyecto'];
        $asesores = $_POST['asesores']; // este valor es un array con los id de los asesores seleccionados
        $fechaEntrega = $_POST['reservation'];
        $monto = $_POST['monto'];

        // Insertar los valores en la tabla proyectos
        $query = "INSERT INTO proyectos (nombre_proyecto, id_cliente, id_universidad, id_tipo_proyecto, fecha_entrega, monto) VALUES ('$nombreProyecto', $idCliente, $idUniversidad, $idTipoProyecto, '$fechaEntrega', $monto)";
        mysqli_query($conn, $query);

        // Obtener el id del proyecto recién insertado
        $idProyecto = mysqli_insert_id($conn);

        // Insertar los valores en la tabla asesor_proyecto para cada asesor seleccionado
        foreach ($asesores as $idAsesor) {
            $rol = $_POST['rol-' . $idAsesor];
            $query = "INSERT INTO asesor_proyecto (id_proyecto, id_asesor, rol) VALUES ($idProyecto, $idAsesor, '$rol')";
            mysqli_query($conn, $query);
        }
?>
