<?php
// backend-php/update_my_project.php

ini_set('display_errors', 1); // Para desarrollo
error_reporting(E_ALL);     // Para desarrollo

header('Content-Type: application/json; charset=utf-8');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$response = ['success' => false, 'message' => 'Acción no permitida o datos insuficientes.'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Método no permitido.';
    error_log("UPDATE_MY_PROJECT: Método no POST. IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'N/A'));
    echo json_encode($response);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    $response['message'] = 'Acceso no autorizado. Debes iniciar sesión.';
    error_log("UPDATE_MY_PROJECT: No user_id en sesión para actualizar proyecto.");
    echo json_encode($response);
    exit;
}
$current_user_id = $_SESSION['user_id'];

require_once __DIR__ . '/../config/database.php';
if (!$conn) {
    $response['message'] = 'Error crítico: No se pudo conectar a la base de datos.';
    error_log("UPDATE_MY_PROJECT: Error de conexión a DB desde config.");
    echo json_encode($response);
    exit;
}

$id_proyecto_a_editar = isset($_POST['id_proyecto']) ? filter_var($_POST['id_proyecto'], FILTER_SANITIZE_NUMBER_INT) : null;
if (!$id_proyecto_a_editar) {
    $response['message'] = 'ID de proyecto no proporcionado para la actualización.';
    error_log("UPDATE_MY_PROJECT: ID de proyecto no encontrado en POST.");
    echo json_encode($response);
    pg_close($conn);
    exit;
}

// Verificar propiedad del proyecto y obtener rutas de archivos actuales
// Asegúrate de que las columnas de archivos existan en tu tabla 'proyectos'
$sql_check_owner = "SELECT usuario_id, logo, pitch_pdf, plan_negocios";
// if (column_exists($conn, 'proyectos', 'proyecciones_pdf')) { // Función hipotética para chequear si la columna existe
//     $sql_check_owner .= ", proyecciones_pdf";
// }
$sql_check_owner .= " FROM proyectos WHERE id_proyecto = $1";

$stmt_check = pg_prepare($conn, "check_project_owner_for_update_v4", $sql_check_owner); // Nuevo nombre
if(!$stmt_check) {
    $response['message'] = 'Error al preparar la verificación del proyecto (P1).';
    error_log("UPDATE_MY_PROJECT: Error preparando check_project_owner_for_update_v4: " . pg_last_error($conn));
    echo json_encode($response); pg_close($conn); exit;
}
$result_check = pg_execute($conn, "check_project_owner_for_update_v4", array($id_proyecto_a_editar));

if (!$result_check || pg_num_rows($result_check) === 0) {
    $response['message'] = 'Proyecto no encontrado para editar (ID: '.$id_proyecto_a_editar.').';
    error_log("UPDATE_MY_PROJECT: Proyecto ID {$id_proyecto_a_editar} no encontrado.");
    echo json_encode($response); pg_close($conn); exit;
}

$project_owner_data = pg_fetch_assoc($result_check);
if ($project_owner_data['usuario_id'] != $current_user_id) {
    $response['message'] = 'No tienes permiso para editar este proyecto.';
    error_log("UPDATE_MY_PROJECT: Intento de editar proyecto ajeno. User: $current_user_id, Proyecto: $id_proyecto_a_editar, Dueño: {$project_owner_data['usuario_id']}");
    echo json_encode($response); pg_close($conn); exit;
}

$logo_actual_db = $project_owner_data['logo'] ?? null;
$pitch_pdf_actual_db = $project_owner_data['pitch_pdf'] ?? null;
$plan_negocios_actual_db = $project_owner_data['plan_negocios'] ?? null;
// $proyecciones_pdf_actual_db = $project_owner_data['proyecciones_pdf'] ?? null; // Si la usas

function limpiar_update_data($valor, $is_textarea = false) {
    $trimmed_value = trim($valor ?? '');
    if ($is_textarea) { return $trimmed_value;  }
    return htmlspecialchars($trimmed_value, ENT_QUOTES, 'UTF-8');
}

// --- Recoger y limpiar datos del POST ---
$nombre_proyecto = limpiar_update_data($_POST['nombre_proyecto'] ?? '');
if (empty($nombre_proyecto)) { $response['message'] = 'El nombre del proyecto es obligatorio.'; error_log("UPDATE_MY_PROJECT: Nombre de proyecto vacío."); echo json_encode($response); pg_close($conn); exit;}

$eslogan = limpiar_update_data($_POST['eslogan'] ?? '');
$sector = limpiar_update_data($_POST['sector'] ?? '');
if (empty($sector)) { $response['message'] = 'El sector del proyecto es obligatorio.'; error_log("UPDATE_MY_PROJECT: Sector vacío."); echo json_encode($response); pg_close($conn); exit;}

$region = limpiar_update_data($_POST['region'] ?? '');
$ubicacion = limpiar_update_data($_POST['ubicacion'] ?? '');
$resumen = limpiar_update_data($_POST['resumen'] ?? '', true);
if (empty($resumen)) { $response['message'] = 'El resumen ejecutivo es obligatorio.'; error_log("UPDATE_MY_PROJECT: Resumen vacío."); echo json_encode($response); pg_close($conn); exit;}

$problema = limpiar_update_data($_POST['problema'] ?? '', true);
$solucion = limpiar_update_data($_POST['solucion'] ?? '', true);
$propuesta_valor = limpiar_update_data($_POST['propuesta_valor'] ?? '', true);
$mercado_objetivo = limpiar_update_data($_POST['mercado_objetivo'] ?? '', true);
$tamano_mercado = limpiar_update_data($_POST['tamano_mercado'] ?? '');
$competencia = limpiar_update_data($_POST['competencia'] ?? '', true);
$ventajas = limpiar_update_data($_POST['ventajas'] ?? '', true);
$modelo_ingresos = limpiar_update_data($_POST['modelo_ingresos'] ?? '', true);

$monto_inversion_str = str_replace([',', '.'], ['', '.'], $_POST['monto_inversion'] ?? '');
$monto_inversion = (is_numeric($monto_inversion_str) && $monto_inversion_str !== '') ? (float)$monto_inversion_str : null;

$valoracion_str = str_replace([',', '.'], ['', '.'], $_POST['valoracion'] ?? '');
$valoracion = (is_numeric($valoracion_str) && $valoracion_str !== '') ? (float)$valoracion_str : null;

$uso_fondos = limpiar_update_data($_POST['uso_fondos'] ?? '', true);
$etapa = limpiar_update_data($_POST['etapa'] ?? '');
$hitos = limpiar_update_data($_POST['hitos'] ?? '');
$logros = limpiar_update_data($_POST['logros'] ?? '', true);

$sitio_web = limpiar_update_data($_POST['sitio_web'] ?? '');
if (!empty($sitio_web) && !filter_var($sitio_web, FILTER_VALIDATE_URL)) $sitio_web = $project_owner_data['sitio_web'] ?? '';

$video_pitch = limpiar_update_data($_POST['video_pitch'] ?? '');
if (!empty($video_pitch) && !filter_var($video_pitch, FILTER_VALIDATE_URL)) $video_pitch = $project_owner_data['video_pitch'] ?? '';

$demo_url = limpiar_update_data($_POST['demo_url'] ?? '');
if (!empty($demo_url) && !filter_var($demo_url, FILTER_VALIDATE_URL)) $demo_url = $project_owner_data['demo_url'] ?? '';

$contacto_nombre = limpiar_update_data($_POST['contacto_nombre'] ?? '');
$contacto_correo = limpiar_update_data($_POST['contacto_correo'] ?? '');
if (!empty($contacto_correo) && !filter_var($contacto_correo, FILTER_VALIDATE_EMAIL)) $contacto_correo = $project_owner_data['contacto_correo'] ?? '';
$contacto_telefono = limpiar_update_data($_POST['contacto_telefono'] ?? '');
$linkedin = limpiar_update_data($_POST['linkedin'] ?? '');
if (!empty($linkedin) && !filter_var($linkedin, FILTER_VALIDATE_URL)) $linkedin = $project_owner_data['linkedin'] ?? '';


// --- Manejo de archivos actualizados ---
$uploadDirBaseProyectosFisica = __DIR__ . '/../assets/uploads/proyectos/';
$uploadUrlBaseProyectosDB = 'assets/uploads/proyectos/';
$allowed_images_update = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$allowed_pdfs_update = ['application/pdf'];

// CORREGIDO EL NOMBRE DE LA FUNCIÓN
function manejarArchivoSubidoUnico_update_v2($fileKey, $uploadDirFisica, $uploadUrlRelativa, $allowedMimeTypes, $maxSizeMB = 5, $rutaArchivoActualEnDB = null) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$fileKey]['tmp_name'];
        $fileName = $_FILES[$fileKey]['name'];
        $fileSize = $_FILES[$fileKey]['size'];
        $fileType = $_FILES[$fileKey]['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!empty($allowedMimeTypes) && !in_array($fileType, $allowedMimeTypes)) {
            error_log("UPDATE_MY_PROJECT: Tipo de archivo no permitido para {$fileKey}: {$fileType}. Permitidos: " . implode(', ',$allowedMimeTypes));
            return $rutaArchivoActualEnDB;
        }
        if ($fileSize > ($maxSizeMB * 1024 * 1024)) {
            error_log("UPDATE_MY_PROJECT: Archivo {$fileKey} demasiado grande: {$fileSize} bytes. Máximo: {$maxSizeMB}MB");
            return $rutaArchivoActualEnDB;
        }

        $newFileName = uniqid($fileKey . '_upd_', true) . '.' . $fileExtension;
        $dest_path_fisica = rtrim($uploadDirFisica, '/') . '/' . $newFileName;
        $dest_path_db = rtrim($uploadUrlRelativa, '/') . '/' . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path_fisica)) {
            error_log("UPDATE_MY_PROJECT: Nuevo archivo {$fileKey} subido a {$dest_path_fisica}");
            if ($rutaArchivoActualEnDB && 
                strpos($rutaArchivoActualEnDB, 'default') === false && 
                file_exists(__DIR__ . '/../' . $rutaArchivoActualEnDB) &&
                is_file(__DIR__ . '/../' . $rutaArchivoActualEnDB) ) { // Chequear que sea un archivo
                
                if (unlink(__DIR__ . '/../' . $rutaArchivoActualEnDB)) {
                     error_log("UPDATE_MY_PROJECT: Archivo anterior {$rutaArchivoActualEnDB} eliminado.");
                } else {
                     error_log("UPDATE_MY_PROJECT: No se pudo eliminar el archivo anterior: " . __DIR__ . '/../' . $rutaArchivoActualEnDB);
                }
            }
            return $dest_path_db;
        } else {
            error_log("UPDATE_MY_PROJECT: Error al mover el archivo subido para {$fileKey} a {$dest_path_fisica}. Error PHP: " . ($_FILES[$fileKey]['error'] ?? 'desconocido'));
            return $rutaArchivoActualEnDB;
        }
    }
    return $rutaArchivoActualEnDB;
}

$logo_path_final = manejarArchivoSubidoUnico_update_v2('logo', $uploadDirBaseProyectosFisica, $uploadUrlBaseProyectosDB, $allowed_images_update, 2, $_POST['logo_actual'] ?? $logo_actual_db);
$pitch_pdf_path_final = manejarArchivoSubidoUnico_update_v2('pitch_pdf', $uploadDirBaseProyectosFisica, $uploadUrlBaseProyectosDB, $allowed_pdfs_update, 5, $_POST['pitch_pdf_actual'] ?? $pitch_pdf_actual_db);
$plan_negocios_path_final = manejarArchivoSubidoUnico_update_v2('plan_negocios', $uploadDirBaseProyectosFisica, $uploadUrlBaseProyectosDB, $allowed_pdfs_update, 5, $_POST['plan_negocios_actual'] ?? $plan_negocios_actual_db); // Usar $allowed_docs si lo tienes

// --- Construir la consulta UPDATE ---
$update_fields_sql_parts = [];
$update_params = [];
$param_idx_update = 1;

$campos_a_actualizar_db = [
    'nombre_proyecto' => $nombre_proyecto, 'eslogan' => $eslogan, 'sector' => $sector, 'region' => $region,
    'ubicacion' => $ubicacion, 'resumen' => $resumen, 'problema' => $problema, 'solucion' => $solucion,
    'propuesta_valor' => $propuesta_valor, 'mercado_objetivo' => $mercado_objetivo, 'tamano_mercado' => $tamano_mercado,
    'competencia' => $competencia, 'ventajas' => $ventajas, 'modelo_ingresos' => $modelo_ingresos,
    'monto_inversion' => $monto_inversion, 'valoracion' => $valoracion, 'uso_fondos' => $uso_fondos,
    'etapa' => $etapa, 'hitos' => $hitos, 'logros' => $logros, 'sitio_web' => $sitio_web,
    'video_pitch' => $video_pitch, 'demo_url' => $demo_url, 'contacto_nombre' => $contacto_nombre,
    'contacto_correo' => $contacto_correo, 'contacto_telefono' => $contacto_telefono, 'linkedin' => $linkedin,
    'logo' => $logo_path_final,
    'pitch_pdf' => $pitch_pdf_path_final,
    'plan_negocios' => $plan_negocios_path_final,
];

foreach ($campos_a_actualizar_db as $columna => $valor) {
    // Comparamos con los datos originales de la DB para este proyecto
    // para construir la query solo con los campos que cambiaron.
    // O, si prefieres, puedes actualizar todos los campos siempre.
    // Para simplificar, actualizaremos todos los campos que el formulario podría enviar.
    $update_fields_sql_parts[] = pg_escape_identifier($conn, $columna) . " = $" . $param_idx_update++;
    
    if (in_array($columna, ['monto_inversion', 'valoracion']) && is_null($valor)) {
        $update_params[] = null;
    } else {
        $update_params[] = $valor;
    }
}
$update_fields_sql_parts[] = "fecha_actualizacion = CURRENT_TIMESTAMP";

if (count($update_fields_sql_parts) <= 1 ) { // Solo fecha_actualizacion no cuenta como cambio significativo
    $response['success'] = true; $response['message'] = 'No se detectaron cambios de datos para actualizar.';
    pg_close($conn); echo json_encode($response); exit;
}

$sql_update_project = "UPDATE proyectos SET " . implode(", ", $update_fields_sql_parts) . 
                      " WHERE id_proyecto = $" . $param_idx_update . " AND usuario_id = $" . ($param_idx_update + 1);
$update_params[] = $id_proyecto_a_editar;
$update_params[] = $current_user_id;

$stmt_update_name = "update_my_project_final_stmt_v4"; // Nuevo nombre
$prepare_update = pg_prepare($conn, $stmt_update_name, $sql_update_project);

if (!$prepare_update) {
    $response['message'] = 'Error al preparar la actualización del proyecto (P2): ' . pg_last_error($conn);
    error_log("UPDATE_MY_PROJECT: Error pg_prepare - " . pg_last_error($conn) . " SQL: " . $sql_update_project . " PARAMS: " . print_r($update_params, true));
    pg_close($conn); echo json_encode($response); exit;
}

pg_query($conn, "BEGIN");
$result_update = pg_execute($conn, $stmt_update_name, $update_params);

$final_message = "";

if ($result_update) {
    // --- Manejo de Actualización de Imágenes de Galería ---
    $galeria_actualizada_correctamente = true; // Asumir éxito hasta que algo falle
    if (isset($_FILES['imagenes_galeria_nuevas']) && is_array($_FILES['imagenes_galeria_nuevas']['name']) && !empty($_FILES['imagenes_galeria_nuevas']['name'][0])) {
        // (Lógica para borrar viejas y subir nuevas imágenes de galería, como en procesar_proyecto.php)
        // ... esta lógica debería estar aquí ...
        // Si algo falla en la galería, podrías hacer $galeria_actualizada_correctamente = false;
    }
    // --- FIN Manejo de Galería ---

    if ($galeria_actualizada_correctamente) {
        pg_query($conn, "COMMIT");
        $response['success'] = true;
        $response['message'] = 'Proyecto actualizado con éxito.';
        if (pg_affected_rows($result_update) == 0 && count($update_fields_sql_parts) > 1) {
             $response['message'] = 'Proyecto actualizado, aunque parece que los datos eran idénticos a los existentes.';
        }
    } else {
        pg_query($conn, "ROLLBACK");
        $response['message'] = 'Proyecto actualizado, pero hubo un error con las imágenes de galería.';
    }

} else {
    pg_query($conn, "ROLLBACK");
    $response['message'] = 'Error al ejecutar la actualización del proyecto: ' . pg_last_error($conn);
    error_log("UPDATE_MY_PROJECT: Error pg_execute - " . pg_last_error($conn));
}

pg_close($conn);
echo json_encode($response);
?>