<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "u415020159_juanjo";
$password = "21.17.Juanjo";
$dbname = "u415020159_jj";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos los valores del formulario
    $nombre_proyecto = $_POST["nombreProyecto"];
    $id_cliente = $_POST["idCliente"];
    $id_universidad = $_POST["idUniversidad"];
    $id_tipo_proyecto = $_POST["idTipoProyecto"];
    $fecha_entrega = $_POST["fechaEntrega"];
    $monto = $_POST["monto"];
    $asesores = $_POST["asesores"];
    

    // Preparamos la consulta para insertar el proyecto
    $sql = "INSERT INTO proyectos (nombre_proyecto, id_cliente, id_universidad, id_tipo_proyecto, fecha_entrega, monto) VALUES ('$nombre_proyecto', '$id_cliente', '$id_universidad', '$id_tipo_proyecto', '$fecha_entrega', '$monto')";

    // Ejecutamos la consulta
    if (mysqli_query($conn, $sql)) {
        // Si se ha insertado correctamente el proyecto, recogemos su ID
    
        $id_proyecto = mysqli_insert_id($conn);
        // Almacenamos el ID del proyecto en una variable
        $mi_variable = $id_proyecto;
        // Si se ha capturado la variable (comprobado)

        // Preparamos la consulta para insertar los asesores del proyecto
        $sql_asesores = "INSERT INTO asesores_proyecto (id_proyecto, id_usuario, rol) VALUES ";
        foreach ($asesores as $asesor) {
            $id_usuario = $asesor['nombre'];
            $rol = $asesor['rol'];  
            $sql_asesores .= "('$mi_variable', '$id_usuario', '$rol'),";
        }
        $sql_asesores = rtrim($sql_asesores, ","); // Quitamos la última coma

        // Ejecutamos la consulta
        if (mysqli_query($conn, $sql_asesores)) {
            echo "Proyecto guardado correctamente.";
        } else {
          // Imprimimos la consulta para debuggear
            echo "SQL Asesores: " . $sql_asesores . "<br>";

            echo "Error al guardar los asesores del proyecto: ".$mi_variable. mysqli_error($conn);
        }
    } else {
        echo "Error al guardar el proyecto: " . mysqli_error($conn);
    }

    // Cerramos la conexión a la base de datos
    mysqli_close($conn);
}
?>
