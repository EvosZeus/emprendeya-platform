<?php
// Incluir la configuración de la base de datos
require '../config/database.php';

// Verificar si los datos fueron enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash seguro
    $tipo_usuario = trim($_POST['tipo_usuario']);

    // Verificar que no haya campos vacíos
    if (empty($nombre) || empty($email) || empty($password) || empty($tipo_usuario)) {
        exit("Todos los campos son obligatorios.");
    }

    // Verificar que el email no esté registrado
    $query_check = "SELECT * FROM users WHERE email = $1";
    $result = pg_query_params($conn, $query_check, [$email]);

    if (pg_num_rows($result) > 0) {
        exit("El correo electrónico ya está registrado.");
    }

    // Insertar el nuevo usuario
    $query = "INSERT INTO users (nombre, email, hashed_password, tipo_usuario) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($conn, $query, [$nombre, $email, $password, $tipo_usuario]);

    if ($result) {
        echo "Registro exitoso.";
    } else {
        echo "Error al registrar el usuario: " . pg_last_error($conn);
    }
}
?>
