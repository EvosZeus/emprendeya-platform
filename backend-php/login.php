<?php
session_start(); // Asegúrate que esto está al inicio y no hay salida antes.

// Incluir la configuración de la base de datos
// La ruta '../config/database.php' es relativa a la ubicación de login.php
// Si login.php está en backend/login.php y config/ está en la raíz,
// entonces '../config/database.php' es correcto.
require '../config/database.php'; // Asegúrate que $conn está disponible

header('Content-Type: application/json'); // Importante para la respuesta a JS
$response = ['success' => false, 'message' => 'Petición inválida.'];

// Verificar si se recibieron los datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $email_input = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password_input = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validaciones básicas de entrada
    if (empty($email_input) || empty($password_input)) {
        $response['message'] = "El correo electrónico y la contraseña son obligatorios.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "El formato del correo electrónico no es válido.";
        echo json_encode($response);
        exit;
    }

    // Consultar el usuario en la base de datos
    // SELECCIONAR TODAS LAS COLUMNAS NECESARIAS PARA LA SESIÓN DEL PERFIL
    $query = "SELECT 
                id, 
                nombre_completo, 
                email, 
                contrasena_hash,    -- Solo para password_verify, no para la sesión
                acepta_terminos,
                foto_perfil_url,
                foto_portada_url,    -- ASUMIENDO QUE YA AÑADISTE ESTA COLUMNA A TU TABLA usuarios
                genero,
                telefono,
                fecha_nacimiento,    -- Formato YYYY-MM-DD desde la DB
                municipio,
                rol,
                fecha_registro,      -- Formato TIMESTAMP desde la DB
                cuenta_verificada,
                descripcion_perfil   -- ASUMIENDO QUE YA AÑADISTE ESTA COLUMNA A TU TABLA usuarios
              FROM usuarios 
              WHERE email = $1";
    
    $result = pg_query_params($conn, $query, [$email_input]);

    if (!$result) {
        error_log("Error en la consulta de login (login.php): " . pg_last_error($conn));
        $response['message'] = "Error del servidor al intentar iniciar sesión. Por favor, inténtalo más tarde.";
        echo json_encode($response);
        exit;
    }

    if (pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);

        // (Opcional) Verificar si la cuenta está verificada antes de permitir el login
        // if (!isset($user['cuenta_verificada']) || !$user['cuenta_verificada']) {
        //     $response['message'] = "Tu cuenta aún no ha sido verificada. Por favor, revisa tu correo electrónico.";
        //     echo json_encode($response);
        //     exit;
        // }

        // Verificar la contraseña
        if (password_verify($password_input, $user['contrasena_hash'])) {
            // Inicio de sesión exitoso
            
            session_regenerate_id(true); // Prevenir fijación de sesión

            // Guardar TODA la información relevante del usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre_completo'];
            $_SESSION['user_email'] = $user['email']; 
            $_SESSION['user_role'] = $user['rol'];     
            
            $_SESSION['user_photo_url'] = $user['foto_perfil_url']; 
            $_SESSION['user_cover_photo_url'] = $user['foto_portada_url'] ?? null; // Usa ?? null si la columna podría no existir aún

            $_SESSION['user_gender'] = $user['genero']; 
            $_SESSION['user_phone'] = $user['telefono']; 
            $_SESSION['user_birth_date'] = $user['fecha_nacimiento']; 
            $_SESSION['user_municipality'] = $user['municipio']; 
            $_SESSION['user_description'] = $user['descripcion_perfil'] ?? null; // Usa ?? null si la columna podría no existir aún
            
            $_SESSION['user_terms_accepted'] = isset($user['acepta_terminos']) ? (bool)$user['acepta_terminos'] : false;
            $_SESSION['user_account_verified'] = isset($user['cuenta_verificada']) ? (bool)$user['cuenta_verificada'] : false;
            $_SESSION['user_registration_date'] = $user['fecha_registro']; 

            // (Opcional) Actualizar 'ultima_conexion' en la base de datos
            $update_last_login_query = "UPDATE usuarios SET ultima_conexion = NOW() WHERE id = $1";
            pg_query_params($conn, $update_last_login_query, [$user['id']]);
            
            $response['success'] = true;
            $response['message'] = "Inicio de sesión exitoso. Redirigiendo...";
            
        } else {
            // Contraseña incorrecta
            $response['message'] = "El correo electrónico o la contraseña son incorrectos.";
        }
    } else {
        // Usuario no encontrado
        $response['message'] = "El correo electrónico o la contraseña son incorrectos.";
    }

    echo json_encode($response);

} else {
    // No es una petición POST
    $response['message'] = "Método no permitido.";
    echo json_encode($response);
}

// Cerrar la conexión
if ($conn) {
    pg_close($conn);
}
?>