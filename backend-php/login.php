<?php
session_start(); // Asegúrate que esto está al inicio y no hay salida antes.

// Incluir la configuración de la base de datos
require '../config/database.php'; // Asegúrate que $conn está disponible

header('Content-Type: application/json'); // Importante para la respuesta a JS
$response = ['success' => false, 'message' => 'Petición inválida.'];

// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario (usar los 'name' del HTML)
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($email) || empty($password)) {
        $response['message'] = "El correo electrónico y la contraseña son obligatorios.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "El formato del correo electrónico no es válido.";
        echo json_encode($response);
        exit;
    }

    // Consultar el usuario en la base de datos
    // ¡MODIFICACIÓN AQUÍ! Añadir foto_perfil_url a la consulta
    $query = "SELECT id, nombre_completo, email, contrasena_hash, rol, cuenta_verificada, foto_perfil_url 
              FROM usuarios 
              WHERE email = $1"; // También añadí 'email' para tenerlo de la DB si es necesario
    $result = pg_query_params($conn, $query, [$email]);

    if (!$result) {
        error_log("Error en la consulta de login: " . pg_last_error($conn));
        $response['message'] = "Error del servidor. Inténtalo más tarde.";
        echo json_encode($response);
        exit;
    }

    if (pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);

        // Verificar si la cuenta está verificada (si tienes esa funcionalidad)
        // if (!$user['cuenta_verificada']) {
        //     $response['message'] = "Tu cuenta aún no ha sido verificada. Por favor, revisa tu correo electrónico.";
        //     echo json_encode($response);
        //     exit;
        // }

        if (password_verify($password, $user['contrasena_hash'])) {
            session_regenerate_id(true);

            // Guardar información del usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre_completo'];
            $_SESSION['user_role'] = $user['rol'];
            $_SESSION['user_email'] = $user['email']; // Ahora viene de la base de datos
            
            // ¡MODIFICACIÓN AQUÍ! Guardar la URL de la foto de perfil
            $_SESSION['user_photo_url'] = $user['foto_perfil_url']; 

            // (Opcional) Si quieres guardar más datos que ahora seleccionas (ej. todos los del Paso 1 de la respuesta anterior)
            // $_SESSION['user_terms_accepted'] = $user['acepta_terminos']; // Necesitarías añadir 'acepta_terminos' a la SELECT
            // $_SESSION['user_gender'] = $user['genero']; // Necesitarías añadir 'genero' a la SELECT
            // ... y así sucesivamente para todos los campos que quieras en sesión.

            // (Opcional) Actualizar 'ultima_conexion'
            $update_query = "UPDATE usuarios SET ultima_conexion = NOW() WHERE id = $1";
            pg_query_params($conn, $update_query, [$user['id']]);

            $response['success'] = true;
            $response['message'] = "Inicio de sesión exitoso. Redirigiendo...";
            
        } else {
            $response['message'] = "Correo electrónico o contraseña incorrectos.";
        }
    } else {
        $response['message'] = "Correo electrónico o contraseña incorrectos.";
    }

    echo json_encode($response);

} else {
    $response['message'] = "Método no permitido.";
    echo json_encode($response);
}

if ($conn) {
    pg_close($conn);
}
?>