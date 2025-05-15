<?php
// backend-php/delete_my_project.php
ini_set('display_errors', 1); error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');

if (session_status() == PHP_SESSION_NONE) { session_start(); }

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
    exit;
}
$current_user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_proyecto'])) {
    echo json_encode(['success' => false, 'message' => 'Solicitud no válida.']);
    exit;
}

require_once __DIR__ . '/../config/database.php';
if (!$conn) { /* ... error ... */ }

$id_proyecto_a_eliminar = filter_var($_POST['id_proyecto'], FILTER_SANITIZE_NUMBER_INT);

// Opcional: Obtener rutas de archivos para eliminarlos del servidor
$archivos_a_eliminar_del_servidor = [];
$sql_get_files = "SELECT logo, pitch_pdf, plan_negocios FROM proyectos WHERE id_proyecto = $1 AND usuario_id = $2";
$stmt_get_files = pg_prepare($conn, "get_project_files_for_delete_v2", $sql_get_files);
if ($stmt_get_files) {
    $result_files = pg_execute($conn, "get_project_files_for_delete_v2", array($id_proyecto_a_eliminar, $current_user_id));
    if ($result_files && pg_num_rows($result_files) > 0) {
        $file_paths = pg_fetch_assoc($result_files);
        if (!empty($file_paths['logo'])) $archivos_a_eliminar_del_servidor[] = $file_paths['logo'];
        if (!empty($file_paths['pitch_pdf'])) $archivos_a_eliminar_del_servidor[] = $file_paths['pitch_pdf'];
        if (!empty($file_paths['plan_negocios'])) $archivos_a_eliminar_del_servidor[] = $file_paths['plan_negocios'];
    }
}

// Obtener imágenes de galería para eliminarlas
$sql_get_gallery_files = "SELECT url_imagen FROM proyecto_imagenes WHERE id_proyecto = $1";
$stmt_get_gallery = pg_prepare($conn, "get_gallery_files_for_delete", $sql_get_gallery_files);
if($stmt_get_gallery){
    $result_gallery_files = pg_execute($conn, "get_gallery_files_for_delete", array($id_proyecto_a_eliminar));
    if($result_gallery_files){
        while($gallery_file_row = pg_fetch_assoc($result_gallery_files)){
            if (!empty($gallery_file_row['url_imagen'])) $archivos_a_eliminar_del_servidor[] = $gallery_file_row['url_imagen'];
        }
    }
}


pg_query($conn, "BEGIN");
// ON DELETE CASCADE en proyecto_imagenes debería eliminar las filas de galería automáticamente.
$sql_delete = "DELETE FROM proyectos WHERE id_proyecto = $1 AND usuario_id = $2";
$stmt_delete = pg_prepare($conn, "delete_my_project_stmt_v2", $sql_delete);

if (!$stmt_delete) { /* ... error, rollback, exit ... */ }
$result_delete = pg_execute($conn, "delete_my_project_stmt_v2", array($id_proyecto_a_eliminar, $current_user_id));

if ($result_delete && pg_affected_rows($result_delete) > 0) {
    pg_query($conn, "COMMIT");
    // Eliminar archivos físicos del servidor
    foreach ($archivos_a_eliminar_del_servidor as $file_path) {
        if (empty($file_path) || strpos($file_path, 'default') !== false) continue; // No borrar defaults
        $full_server_path = __DIR__ . '/../' . $file_path; 
        if (file_exists($full_server_path) && is_file($full_server_path)) { // Chequear que sea un archivo
            if (unlink($full_server_path)) {
                error_log("DELETE_PROJECT: Archivo eliminado del servidor: " . $full_server_path);
            } else {
                error_log("DELETE_PROJECT: ERROR al eliminar archivo del servidor: " . $full_server_path);
            }
        } else {
             error_log("DELETE_PROJECT: Archivo no encontrado o no es un archivo para eliminar: " . $full_server_path);
        }
    }
    echo json_encode(['success' => true, 'message' => 'Proyecto eliminado correctamente.']);
} else {
    pg_query($conn, "ROLLBACK");
    if (pg_affected_rows($result_delete) === 0) {
         echo json_encode(['success' => false, 'message' => 'No se eliminó el proyecto. Puede que no exista o no tengas permiso.']);
    } else {
         echo json_encode(['success' => false, 'message' => 'Error al eliminar el proyecto: ' . pg_last_error($conn)]);
    }
}
pg_close($conn);
?>