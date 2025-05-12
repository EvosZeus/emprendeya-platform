<?php
// Incluir la configuración de la base de datos
require '../config/database.php'; // Asegúrate que $conn está disponible aquí

header('Content-Type: application/json'); // Siempre es bueno devolver JSON
$response = ['success' => false, 'message' => 'Petición inválida.'];

// Verificar si los datos fueron enviados por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- 1. Recolección de Datos del Formulario ---
    // Pestaña 1: Cuenta
    $nombre_completo = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : ''; // Contraseña en texto plano
    // 'confirmPassword' es solo para validación en frontend
    $acepta_terminos = isset($_POST['terms']) && $_POST['terms'] === 'on'; // Checkbox 'on' or true

    // Pestaña 2: Personal
    // Foto de perfil se maneja con $_FILES más adelante
    $genero = isset($_POST['gender']) ? trim($_POST['gender']) : null; // Puede ser null si no se selecciona
    $telefono = isset($_POST['phone']) ? trim($_POST['phone']) : null;
    $fecha_nacimiento_str = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : null; // Asumimos name="fecha_nacimiento" para el datepicker
    $municipio = isset($_POST['municipio']) ? trim($_POST['municipio']) : null;

    // Pestaña 3: Rol
    $rol = isset($_POST['userType']) ? trim($_POST['userType']) : '';


    // --- 2. Validación de Datos (Backend) ---
    if (empty($nombre_completo) || empty($email) || empty($password) || empty($rol)) {
        $response['message'] = "Los campos: Nombre Completo, Correo, Contraseña y Rol son obligatorios.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "El formato del correo electrónico no es válido.";
        echo json_encode($response);
        exit;
    }

    if (!$acepta_terminos) {
        $response['message'] = "Debes aceptar los términos y condiciones.";
        echo json_encode($response);
        exit;
    }

    // Validar valores de ENUM (opcional pero recomendado)
    $allowed_genders = ['Masculino', 'Femenino', 'Otro', 'Prefiero no decirlo', null, '']; // Permitir vacío/null
    if (!in_array($genero, $allowed_genders, true)) {
        $response['message'] = "Valor de género no válido.";
        echo json_encode($response);
        exit;
    }
    if ($genero === '') $genero = null; // Convertir string vacío a NULL para la DB

    $allowed_roles = ['Emprendedor', 'Inversor'];
    if (!in_array($rol, $allowed_roles, true)) {
        $response['message'] = "Valor de rol no válido.";
        echo json_encode($response);
        exit;
    }


    // --- 3. Procesamiento de Datos ---
    // Hash seguro para la contraseña
    $contrasena_hash = password_hash($password, PASSWORD_DEFAULT);

    // Formatear fecha de nacimiento para PostgreSQL (YYYY-MM-DD)
    $fecha_nacimiento_db = null;
    if (!empty($fecha_nacimiento_str)) {
        $date_obj = DateTime::createFromFormat('d/m/Y', $fecha_nacimiento_str);
        if ($date_obj) {
            $fecha_nacimiento_db = $date_obj->format('Y-m-d');
        } else {
            $response['message'] = "Formato de fecha de nacimiento inválido. Usa dd/mm/aaaa.";
            echo json_encode($response);
            exit;
        }
    }
    
    // Manejo de la foto de perfil
    $foto_perfil_url = null; // Por defecto null si no se sube foto o hay error
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../assets/uploads/profile_pictures/'; // Ajusta esta ruta
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0775, true); // Crear directorio si no existe
        }

        $file_tmp_path = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        // $file_type = $_FILES['file']['type']; // No confiar ciegamente en esto
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $max_file_size = 400 * 1024; // 400KB (como en tu HTML)

        if (!in_array($file_extension, $allowed_extensions)) {
            $response['message'] = "Tipo de archivo no permitido para la foto de perfil. Solo JPG, JPEG, PNG, GIF.";
            echo json_encode($response);
            exit;
        }

        if ($file_size > $max_file_size) {
            $response['message'] = "El archivo de imagen es demasiado grande (Máx. 400KB).";
            echo json_encode($response);
            exit;
        }
        
        // Generar un nombre de archivo único para evitar colisiones y por seguridad
        $new_file_name = uniqid('profile_', true) . '.' . $file_extension;
        $destination_path = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp_path, $destination_path)) {
            // Guardar la ruta relativa o URL completa según tu necesidad
            // Si 'uploads' está en la raíz pública, la URL sería algo como:
            $foto_perfil_url = 'assets/uploads/profile_pictures/' . $new_file_name;
        } else {
            // Error al mover el archivo, puedes loggearlo pero no necesariamente detener el registro
            // $response['message'] = "Error al guardar la foto de perfil.";
            // error_log("Error al mover el archivo subido: " . $file_name);
            // Considera si el registro debe fallar si la imagen no se guarda
        }
    } else if (isset($_FILES['file']) && $_FILES['file']['error'] != UPLOAD_ERR_NO_FILE) {
        // Hubo un error en la subida diferente a "no se subió archivo"
        $response['message'] = "Error al subir la foto de perfil. Código: " . $_FILES['file']['error'];
        echo json_encode($response);
        exit;
    }


    // --- 4. Interacción con la Base de Datos ---
    // Verificar que el email no esté registrado
    // Asumiendo que $conn es tu objeto de conexión PostgreSQL
    $query_check = "SELECT 1 FROM usuarios WHERE email = $1";
    $result_check = pg_query_params($conn, $query_check, [$email]);

    if (!$result_check) {
        // Error en la consulta de verificación
        error_log("Error en la consulta de verificación de email: " . pg_last_error($conn));
        $response['message'] = "Error del servidor al verificar el correo. Inténtalo más tarde.";
        echo json_encode($response);
        exit;
    }

    if (pg_num_rows($result_check) > 0) {
        $response['message'] = "El correo electrónico ya está registrado.";
        echo json_encode($response);
        exit;
    }

    // Insertar el nuevo usuario en la tabla 'usuarios'
    $query_insert = "INSERT INTO usuarios 
                        (nombre_completo, email, contrasena_hash, acepta_terminos, 
                         foto_perfil_url, genero, telefono, fecha_nacimiento, municipio, rol) 
                     VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";
    
    $params = [
        $nombre_completo,
        $email,
        $contrasena_hash,
        $acepta_terminos, // Booleano
        $foto_perfil_url, // Puede ser null
        $genero,          // Puede ser null
        $telefono,        // Puede ser null
        $fecha_nacimiento_db, // Puede ser null
        $municipio,       // Puede ser null
        $rol
    ];

    $result_insert = pg_query_params($conn, $query_insert, $params);

    if ($result_insert) {
        $response['success'] = true;
        $response['message'] = "¡Registro exitoso! Ahora puedes iniciar sesión.";
        // Podrías también devolver el ID del usuario insertado si es necesario
        // $user_id = pg_fetch_result(pg_query($conn, "SELECT lastval()"), 0, 0);
        // $response['userId'] = $user_id;
    } else {
        // Error en la inserción
        error_log("Error al registrar el usuario: " . pg_last_error($conn)); // Loguear el error real
        $response['message'] = "Error al registrar el usuario. Por favor, inténtalo de nuevo más tarde.";
    }

    echo json_encode($response);

} else {
    // No es una petición POST
    $response['message'] = "Método no permitido.";
    echo json_encode($response);
}

// No olvides cerrar la conexión si no lo hace automáticamente tu script `database.php` al finalizar.
if ($conn) {
    pg_close($conn);
}
?>