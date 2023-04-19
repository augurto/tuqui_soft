<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "u415020159_juanjo";
$password = "21.17.Juanjo";
$dbname = "u415020159_jj";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

echo "Conexión exitosa a la base de datos!";
?>
