<?php
// Establecer la conexión con la base de datos
include '../conexion.php';

// Nombre del archivo de copia de seguridad
$backup_file = "backup-" . date("Y-m-d-H-i-s") . ".sql";

// Obtener todas las tablas de la base de datos
$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Recorrer todas las tablas y obtener sus datos
foreach ($tables as $table) {
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($conn, $sql);
    $num_fields = mysqli_num_fields($result);

    // Crear el archivo de copia de seguridad y escribir los datos de cada tabla
    $handle = fopen($backup_file, 'a+');
    fwrite($handle, "DROP TABLE IF EXISTS $table;\n");
    $row2 = mysqli_fetch_row(mysqli_query($conn, "SHOW CREATE TABLE $table"));
    fwrite($handle, $row2[1] . ";\n");
    while ($row = mysqli_fetch_row($result)) {
        fwrite($handle, "INSERT INTO $table VALUES(");
        for ($i = 0; $i < $num_fields; $i++) {
            if (isset($row[$i])) {
                $value = addslashes($row[$i]);
                fwrite($handle, '"' . $value . '"');
            } else {
                fwrite($handle, '""');
            }
            if ($i < $num_fields - 1) {
                fwrite($handle, ',');
            }
        }
        fwrite($handle, ");\n");
    }
    fwrite($handle, "\n\n\n");
    fclose($handle);
}

// Descargar el archivo de copia de seguridad
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($backup_file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($backup_file));
ob_clean();
flush();
readfile($backup_file);

// Eliminar el archivo de copia de seguridad
unlink($backup_file);
?>
