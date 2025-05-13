<?php
// backend-php/profile-actions.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');
$response = ['success' => false, 'message' => 'Acción no válida o datos incorrectos.'];

// Verificar que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    $response['message'] = 'Acceso no autorizado. Debes iniciar sesión.';
    echo json_encode($response);
    exit;
}

// Incluir la configuración de la base de datos
require_once __DIR__ . '/../config/database.php'; 

$current_user_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? '';

// ---- ACCIÓN: ACTUALIZAR INFORMACIÓN DEL PERFIL ----
if ($action === 'update_profile_info') {
    $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : null;
    $birthDateInput = isset($_POST['birthDate']) && !empty(trim($_POST['birthDate'])) ? trim($_POST['birthDate']) : null; // Formato MM/DD/YYYY del datepicker
    $gender = isset($_POST['gender']) && !empty(trim($_POST['gender'])) ? trim($_POST['gender']) : null;
    $municipio = isset($_POST['municipio']) && !empty(trim($_POST['municipio'])) ? trim($_POST['municipio']) : null;
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;

    if (empty($fullName) || empty($email)) {
        $response['message'] = 'El nombre completo y el correo electrónico son obligatorios.';
        echo json_encode($response);
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'El formato del correo electrónico no es válido.';
        echo json_encode($response);
        exit;
    }

    $check_email_query = "SELECT id FROM usuarios WHERE email = $1 AND id != $2";
    $check_email_result = pg_query_params($conn, $check_email_query, [$email, $current_user_id]);
    if ($check_email_result && pg_num_rows($check_email_result) > 0) {
        $response['message'] = 'El correo electrónico ingresado ya está en uso por otro usuario.';
        echo json_encode($response);
        exit;
    }
    
    $birthDateDB = null;
    if ($birthDateInput) {
        $dateObj = DateTime::createFromFormat('m/d/Y', $birthDateInput);
        if ($dateObj) {
            $birthDateDB = $dateObj->format('Y-m-d');
        } else {
            error_log("Formato de fecha de nacimiento incorrecto recibido: " . $birthDateInput . " para usuario ID: " . $current_user_id);
            // Podrías decidir devolver un error aquí si el formato es crítico
            // $response['message'] = 'El formato de la fecha de nacimiento es incorrecto (debe ser MM/DD/AAAA).';
            // echo json_encode($response);
            // exit;
        }
    }

    $update_fields = [];
    $update_params = [];
    $param_idx = 1;

    $update_fields[] = "nombre_completo = $" . $param_idx++;
    $update_params[] = $fullName;

    $update_fields[] = "email = $" . $param_idx++;
    $update_params[] = $email;

    $update_fields[] = "telefono = $" . $param_idx++;
    $update_params[] = empty($phone) ? null : $phone;
    
    $update_fields[] = "fecha_nacimiento = $" . $param_idx++;
    $update_params[] = $birthDateDB; 
    
    $update_fields[] = "genero = $" . $param_idx++;
    $update_params[] = empty($gender) ? null : $gender;

    $update_fields[] = "municipio = $" . $param_idx++;
    $update_params[] = empty($municipio) ? null : $municipio;

    $update_fields[] = "descripcion_perfil = $" . $param_idx++; 
    $update_params[] = empty($description) ? null : $description;

    $update_query_sql = "UPDATE usuarios SET " . implode(", ", $update_fields) . " WHERE id = $" . $param_idx;
    $update_params[] = $current_user_id;

    $update_result = pg_query_params($conn, $update_query_sql, $update_params);

    if ($update_result) {
        $_SESSION['user_name'] = $fullName;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_phone'] = empty($phone) ? null : $phone;
        $_SESSION['user_birth_date'] = $birthDateDB;
        $_SESSION['user_gender'] = empty($gender) ? null : $gender;
        $_SESSION['user_municipality'] = empty($municipio) ? null : $municipio;
        $_SESSION['user_description'] = empty($description) ? null : $description;

        $response['success'] = true;
        $response['message'] = '¡Información del perfil actualizada con éxito!';
    } else {
        error_log("Error al actualizar perfil (profile-actions.php): " . pg_last_error($conn));
        $response['message'] = 'Error al guardar los cambios en la base de datos.';
    }
    echo json_encode($response);
    exit;
}

// ---- ACCIÓN: CAMBIAR CONTRASEÑA ----
if ($action === 'change_password') {
    $currentPassword = $_POST['currentPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmNewPassword = $_POST['confirmNewPassword'] ?? '';

    if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
        $response['message'] = 'Todos los campos de contraseña son obligatorios.';
        echo json_encode($response); exit;
    }
    if (strlen($newPassword) < 8) {
        $response['message'] = 'La nueva contraseña debe tener al menos 8 caracteres.';
        echo json_encode($response); exit;
    }
    if ($newPassword !== $confirmNewPassword) {
        $response['message'] = 'La nueva contraseña y su confirmación no coinciden.';
        echo json_encode($response); exit;
    }

    $pass_query = "SELECT contrasena_hash FROM usuarios WHERE id = $1";
    $pass_result = pg_query_params($conn, $pass_query, [$current_user_id]);

    if ($pass_result && pg_num_rows($pass_result) > 0) {
        $user_pass_data = pg_fetch_assoc($pass_result);
        if (password_verify($currentPassword, $user_pass_data['contrasena_hash'])) {
            $new_hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
            $update_pass_query = "UPDATE usuarios SET contrasena_hash = $1 WHERE id = $2";
            $update_pass_result = pg_query_params($conn, $update_pass_query, [$new_hashed_password, $current_user_id]);

            if ($update_pass_result) {
                $response['success'] = true;
                $response['message'] = '¡Contraseña actualizada con éxito!';
            } else {
                error_log("Error al actualizar contraseña (profile-actions.php): " . pg_last_error($conn));
                $response['message'] = 'Error al actualizar la contraseña en la base de datos.';
            }
        } else {
            $response['message'] = 'La contraseña actual ingresada es incorrecta.';
        }
    } else {
        $response['message'] = 'Error al verificar la contraseña actual (usuario no encontrado).';
    }
    echo json_encode($response);
    exit;
}


// ---- ACCIÓN: ACTUALIZAR FOTO DE PERFIL ----
if ($action === 'update_profile_picture') {
    $file_input_name = 'profilePicFile'; // Coincide con name="profilePicFile" en el form

    if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == UPLOAD_ERR_OK) {
        $upload_dir_fisica = __DIR__ . '/../assets/uploads/profile_pictures/';
        $url_para_db_base = 'assets/uploads/profile_pictures/';

        if (!is_dir($upload_dir_fisica)) {
            if(!mkdir($upload_dir_fisica, 0775, true)) {
                $response['message'] = 'Error: No se pudo crear el directorio de subida.';
                echo json_encode($response); exit;
            }
        }

        $file_tmp_path = $_FILES[$file_input_name]['tmp_name'];
        $file_name_original = $_FILES[$file_input_name]['name'];
        $file_extension = strtolower(pathinfo($file_name_original, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $max_file_size = 2 * 1024 * 1024; // 2MB

        if (!in_array($file_extension, $allowed_extensions)) {
            $response['message'] = 'Tipo de archivo no permitido (solo JPG, JPEG, PNG).';
            echo json_encode($response); exit;
        }
        if ($_FILES[$file_input_name]['size'] > $max_file_size) {
            $response['message'] = 'El archivo es demasiado grande (Máx 2MB).';
            echo json_encode($response); exit;
        }

        $new_file_name = 'profile_' . $current_user_id . '_' . uniqid() . '.' . $file_extension;
        $destination_path_fisica = $upload_dir_fisica . $new_file_name;
        $foto_perfil_url_para_db = $url_para_db_base . $new_file_name;

        $old_photo_query = "SELECT foto_perfil_url FROM usuarios WHERE id = $1";
        $old_photo_res = pg_query_params($conn, $old_photo_query, [$current_user_id]);
        if($old_photo_data = pg_fetch_assoc($old_photo_res)){
            if(!empty($old_photo_data['foto_perfil_url']) && $old_photo_data['foto_perfil_url'] !== 'assets/img/profile.jpg' && file_exists(__DIR__ . '/../' . $old_photo_data['foto_perfil_url'])){
                unlink(__DIR__ . '/../' . $old_photo_data['foto_perfil_url']);
            }
        }

        if (move_uploaded_file($file_tmp_path, $destination_path_fisica)) {
            $update_pic_query = "UPDATE usuarios SET foto_perfil_url = $1 WHERE id = $2";
            $update_pic_result = pg_query_params($conn, $update_pic_query, [$foto_perfil_url_para_db, $current_user_id]);

            if ($update_pic_result) {
                $_SESSION['user_photo_url'] = $foto_perfil_url_para_db;
                $response['success'] = true;
                $response['message'] = 'Foto de perfil actualizada.';
                $response['newImageUrl'] = $foto_perfil_url_para_db;
            } else {
                error_log("Error DB al actualizar foto perfil: " . pg_last_error($conn));
                $response['message'] = 'Error al guardar la ruta de la foto en la base de datos.';
            }
        } else {
            $response['message'] = 'Error al mover el archivo subido.';
        }
    } else {
        $response['message'] = 'No se recibió ningún archivo o hubo un error en la subida.';
        if(isset($_FILES[$file_input_name]['error']) && $_FILES[$file_input_name]['error'] != UPLOAD_ERR_NO_FILE) {
            $response['message'] .= ' Código de error: ' . $_FILES[$file_input_name]['error'];
        }
    }
    echo json_encode($response);
    exit;
}

// ---- ACCIÓN: ACTUALIZAR FOTO DE PORTADA ----
if ($action === 'update_cover_photo') {
    $file_input_name_cover = 'coverPhotoFile'; // Coincide con name="coverPhotoFile" en el form

    if (isset($_FILES[$file_input_name_cover]) && $_FILES[$file_input_name_cover]['error'] == UPLOAD_ERR_OK) {
        $upload_dir_fisica = __DIR__ . '/../assets/uploads/cover_photos/';
        $url_para_db_base = 'assets/uploads/cover_photos/';

        if (!is_dir($upload_dir_fisica)) {
            if(!mkdir($upload_dir_fisica, 0775, true)) {
                $response['message'] = 'Error: No se pudo crear el directorio de subida para portadas.';
                echo json_encode($response); exit;
            }
        }

        $file_tmp_path = $_FILES[$file_input_name_cover]['tmp_name'];
        $file_name_original = $_FILES[$file_input_name_cover]['name'];
        $file_extension = strtolower(pathinfo($file_name_original, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $max_file_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file_extension, $allowed_extensions)) {
            $response['message'] = 'Tipo de archivo no permitido (solo JPG, JPEG, PNG).';
            echo json_encode($response); exit;
        }
        if ($_FILES[$file_input_name_cover]['size'] > $max_file_size) {
            $response['message'] = 'El archivo de portada es demasiado grande (Máx 5MB).';
            echo json_encode($response); exit;
        }

        $new_file_name = 'cover_' . $current_user_id . '_' . uniqid() . '.' . $file_extension;
        $destination_path_fisica = $upload_dir_fisica . $new_file_name;
        $foto_portada_url_para_db = $url_para_db_base . $new_file_name;
        
        $old_cover_query = "SELECT foto_portada_url FROM usuarios WHERE id = $1";
        $old_cover_res = pg_query_params($conn, $old_cover_query, [$current_user_id]);
        if($old_cover_data = pg_fetch_assoc($old_cover_res)){
            if(!empty($old_cover_data['foto_portada_url']) && $old_cover_data['foto_portada_url'] !== 'assets/img/blogpost.jpg' && file_exists(__DIR__ . '/../' . $old_cover_data['foto_portada_url'])){
                unlink(__DIR__ . '/../' . $old_cover_data['foto_portada_url']);
            }
        }

        if (move_uploaded_file($file_tmp_path, $destination_path_fisica)) {
            $update_cover_query = "UPDATE usuarios SET foto_portada_url = $1 WHERE id = $2";
            $update_cover_result = pg_query_params($conn, $update_cover_query, [$foto_portada_url_para_db, $current_user_id]);

            if ($update_cover_result) {
                $_SESSION['user_cover_photo_url'] = $foto_portada_url_para_db;
                $response['success'] = true;
                $response['message'] = 'Foto de portada actualizada.';
                $response['newImageUrl'] = $foto_portada_url_para_db;
            } else {
                error_log("Error DB al actualizar foto portada: " . pg_last_error($conn));
                $response['message'] = 'Error al guardar la ruta de la portada en la base de datos.';
            }
        } else {
            $response['message'] = 'Error al mover el archivo de portada subido.';
        }
    } else {
        $response['message'] = 'No se recibió ningún archivo de portada o hubo un error en la subida.';
         if(isset($_FILES[$file_input_name_cover]['error']) && $_FILES[$file_input_name_cover]['error'] != UPLOAD_ERR_NO_FILE) {
            $response['message'] .= ' Código de error: ' . $_FILES[$file_input_name_cover]['error'];
        }
    }
    echo json_encode($response);
    exit;
}


// ---- ACCIÓN: ELIMINAR CUENTA ----
if ($action === 'delete_account') {
    $confirmPassword = $_POST['confirmDeletePassword'] ?? '';

    if (empty($confirmPassword)) {
        $response['message'] = 'Se requiere tu contraseña actual para eliminar la cuenta.';
        echo json_encode($response); exit;
    }

    $pass_query = "SELECT contrasena_hash FROM usuarios WHERE id = $1";
    $pass_result = pg_query_params($conn, $pass_query, [$current_user_id]);

    if ($pass_result && pg_num_rows($pass_result) > 0) {
        $user_pass_data = pg_fetch_assoc($pass_result);
        if (password_verify($confirmPassword, $user_pass_data['contrasena_hash'])) {
            $delete_query = "DELETE FROM usuarios WHERE id = $1";
            $delete_result = pg_query_params($conn, $delete_query, [$current_user_id]);

            if ($delete_result) {
                session_unset();
                session_destroy();
                $response['success'] = true;
                $response['message'] = 'Tu cuenta ha sido eliminada exitosamente.';
            } else {
                error_log("Error al eliminar cuenta (profile-actions.php): " . pg_last_error($conn));
                $response['message'] = 'Error al intentar eliminar la cuenta de la base de datos.';
            }
        } else {
            $response['message'] = 'La contraseña ingresada es incorrecta. No se pudo eliminar la cuenta.';
        }
    } else {
        $response['message'] = 'Error al verificar la contraseña (usuario no encontrado).';
    }
    echo json_encode($response);
    exit;
}

$response['message'] = 'Acción desconocida o no especificada.';
echo json_encode($response);

if ($conn) {
    pg_close($conn);
}
?>