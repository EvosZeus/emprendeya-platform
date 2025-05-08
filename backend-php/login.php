<?php
session_start();
require '../config/database.php';

// Verificar si se recibieron los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Verificar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        exit("Todos los campos son obligatorios.");
    }

    // Verificar si el usuario existe
    $query = "SELECT id, nombre, hashed_password, tipo_usuario FROM users WHERE email = $1";
    $result = pg_query_params($conn, $query, [$email]);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['hashed_password'])) {
        // Inicio de sesión exitoso, guardar en sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_type'] = $user['tipo_usuario'];

        echo "Inicio de sesión exitoso.";
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>
