<?php
// Configurar la información de la base de datos
$host = "localhost";
$user = "u415020159_juanjo";
$password = "21.17.Juanjo";
$dbname = "u415020159_jj";

// Establecer la conexión a la base de datos
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Nombre del archivo de la copia de seguridad
$filename = 'copia_de_seguridad.sql';

// Comando para crear la copia de seguridad de la base de datos completa
$command = "mysqldump --user={$user} --password={$password} --host={$host} {$dbname} > {$filename}";

// Ejecutar el comando
system($command);

// Descargar el archivo
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($filename).'"');
header('Content-Length: ' . filesize($filename));
readfile($filename);
exit;
?>
