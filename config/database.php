<?php
// Configuración de la base de datos
$host = getenv('DB_HOST') ?: '127.0.0.1';
$dbname = getenv('DB_NAME') ?: 'Emprendeya';
$username = getenv('DB_USER') ?: 'postgres';
$password = getenv('DB_PASSWORD') ?: 'unicesmag';
$port = getenv('DB_PORT') ?: '5432';

// Intento de conexión
$conn = pg_connect("host=$host dbname=$dbname user=$username password=$password port=$port");

// Verificación de conexión
if (!$conn) {
    error_log("Error de conexión a PostgreSQL: " . pg_last_error());
    exit("Error al conectar a la base de datos.");
}

// Si la conexión es exitosa
// echo "Conexión exitosa";
?>
