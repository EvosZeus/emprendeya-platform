<?php
// backend-php/procesar_proyecto.php

// Iniciar sesión para obtener el ID del usuario
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    // Considerar devolver JSON si es para AJAX en el futuro
    // header('Content-Type: application/json');
    // echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para crear un proyecto.']);
    echo "❌ Error: Debes iniciar sesión para crear un proyecto.";
    exit;
}
$usuario_id_actual = $_SESSION['user_id'];

// Incluir configuración de la base de datos
require_once __DIR__ . '/../config/database.php'; 

// Función de limpieza
function limpiar($valor) {
    return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
}

// Validaciones básicas
if (empty($_POST['nombre_proyecto']) || empty($_POST['resumen']) || empty($_POST['sector'])) {
    // header('Content-Type: application/json');
    // echo json_encode(['success' => false, 'message' => 'Nombre del proyecto, resumen y sector son campos obligatorios.']);
    echo "❌ Error: Nombre del proyecto, resumen y sector son campos obligatorios.";
    exit; 
}

// Limpieza de datos POST
$nombre_proyecto = limpiar($_POST['nombre_proyecto']);
$eslogan = limpiar($_POST['eslogan'] ?? '');
$sector = limpiar($_POST['sector']);
$region = limpiar($_POST['region'] ?? '');
$ubicacion = limpiar($_POST['ubicacion'] ?? '');
$resumen = limpiar($_POST['resumen']);
$problema = limpiar($_POST['problema'] ?? '');
$solucion = limpiar($_POST['solucion'] ?? '');
$propuesta_valor = limpiar($_POST['propuesta_valor'] ?? '');
$mercado_objetivo = limpiar($_POST['mercado_objetivo'] ?? '');
$tamano_mercado = limpiar($_POST['tamano_mercado'] ?? '');
$competencia = limpiar($_POST['competencia'] ?? '');
$ventajas = limpiar($_POST['ventajas'] ?? '');
$modelo_ingresos = limpiar($_POST['modelo_ingresos'] ?? '');

$monto_inversion_str = str_replace(',', '', $_POST['monto_inversion'] ?? '0');
$monto_inversion = is_numeric($monto_inversion_str) ? (float)$monto_inversion_str : 0.00;

$valoracion_str = str_replace(',', '', $_POST['valoracion'] ?? '0');
$valoracion = is_numeric($valoracion_str) ? (float)$valoracion_str : 0.00;

$uso_fondos = limpiar($_POST['uso_fondos'] ?? '');
$etapa = limpiar($_POST['etapa'] ?? '');
$hitos = limpiar($_POST['hitos'] ?? '');
$logros = limpiar($_POST['logros'] ?? '');

$sitio_web = limpiar($_POST['sitio_web'] ?? '');
if (!empty($sitio_web) && !filter_var($sitio_web, FILTER_VALIDATE_URL)) $sitio_web = '';

$video_pitch = limpiar($_POST['video_pitch'] ?? ''); // Renombrado para consistencia con el form HTML
if (!empty($video_pitch) && !filter_var($video_pitch, FILTER_VALIDATE_URL)) $video_pitch = '';

$demo_url = limpiar($_POST['demo_url'] ?? ''); // Renombrado para consistencia con el form HTML
if (!empty($demo_url) && !filter_var($demo_url, FILTER_VALIDATE_URL)) $demo_url = '';

$contacto_nombre = limpiar($_POST['contacto_nombre'] ?? '');
$contacto_correo = limpiar($_POST['contacto_correo'] ?? ''); // Nombre del campo en el form es 'contacto_correo'
if (!empty($contacto_correo) && !filter_var($contacto_correo, FILTER_VALIDATE_EMAIL)) $contacto_correo = '';

$contacto_telefono = limpiar($_POST['contacto_telefono'] ?? ''); // Nombre del campo en el form es 'contacto_telefono'
$linkedin = limpiar($_POST['linkedin'] ?? '');
if (!empty($linkedin) && !filter_var($linkedin, FILTER_VALIDATE_URL)) $linkedin = '';

// --- Manejo de subida de archivos ---
$uploadDirBaseProyectos = __DIR__ . '/../assets/uploads/proyectos/'; // Para logo, pitch, plan
$uploadUrlBaseProyectos = 'assets/uploads/proyectos/';

if (!is_dir($uploadDirBaseProyectos)) {
    if (!mkdir($uploadDirBaseProyectos, 0775, true)) {
        echo "❌ Error: No se pudo crear el directorio de subida de proyectos: " . $uploadDirBaseProyectos;
        exit;
    }
}

// Función genérica para manejar subida de un solo archivo
function manejarArchivoSubidoUnico($fileKey, $uploadDirFisica, $uploadUrlRelativa, $allowedMimeTypes, $maxSizeMB = 5) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$fileKey]['tmp_name'];
        $fileName = $_FILES[$fileKey]['name'];
        $fileSize = $_FILES[$fileKey]['size'];
        $fileType = $_FILES[$fileKey]['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $safeFileName = preg_replace("/[^a-zA-Z0-9_.-]/", "_", basename($fileName));
        $newFileName = uniqid($fileKey . '_', true) . '.' . $fileExtension;
        
        $dest_path_fisica = $uploadDirFisica . $newFileName;
        $dest_path_db = $uploadUrlRelativa . $newFileName;

        if (!empty($allowedMimeTypes) && !in_array($fileType, $allowedMimeTypes)) {
            echo "❌ Error ($fileKey): Tipo de archivo no permitido. Permitidos: " . implode(', ', $allowedMimeTypes);
            return null;
        }
        if ($fileSize > ($maxSizeMB * 1024 * 1024)) {
            echo "❌ Error ($fileKey): El archivo es demasiado grande (Máx {$maxSizeMB}MB).";
            return null;
        }

        if (move_uploaded_file($fileTmpPath, $dest_path_fisica)) {
            return $dest_path_db;
        } else {
            error_log("Error al mover el archivo subido ($fileKey) a $dest_path_fisica. Error PHP: " . $_FILES[$fileKey]['error']);
            echo "❌ Error al mover el archivo subido ($fileKey).";
            return null;
        }
    } elseif (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "❌ Error en la subida del archivo ($fileKey): Código " . $_FILES[$fileKey]['error'];
        return null;
    }
    return null;
}

$allowed_images = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$allowed_pdfs = ['application/pdf'];
$allowed_docs = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];


$logo_path = manejarArchivoSubidoUnico('logo', $uploadDirBaseProyectos, $uploadUrlBaseProyectos, $allowed_images, 2); // Max 2MB para logo
$pitch_pdf_path = manejarArchivoSubidoUnico('pitch_pdf', $uploadDirBaseProyectos, $uploadUrlBaseProyectos, $allowed_pdfs);
$plan_negocios_path = manejarArchivoSubidoUnico('plan_negocios', $uploadDirBaseProyectos, $uploadUrlBaseProyectos, $allowed_docs);
// Si implementas proyecciones_pdf, el name del input en HTML debe ser 'proyecciones_pdf'
$proyecciones_pdf_path = manejarArchivoSubidoUnico('proyecciones_pdf', $uploadDirBaseProyectos, $uploadUrlBaseProyectos, $allowed_pdfs);


// --- Conexión a la base de datos ---
if (!$conn) {
    echo "❌ Error: No se pudo establecer la conexión con la base de datos desde config.";
    exit();
}

// --- Insertar Proyecto Principal ---
// Añadir proyecciones_pdf si se implementó y la columna existe
$sqlProyecto = "INSERT INTO proyectos (
    usuario_id, nombre_proyecto, logo, eslogan, sector, region, ubicacion, resumen, problema, 
    solucion, propuesta_valor, mercado_objetivo, tamano_mercado, competencia, ventajas, 
    modelo_ingresos, monto_inversion, valoracion, uso_fondos, etapa, hitos, logros, 
    pitch_pdf, plan_negocios, proyecciones_pdf, 
    sitio_web, video_pitch, demo_url, contacto_nombre, contacto_correo, contacto_telefono, linkedin
) VALUES (
    $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, 
    $18, $19, $20, $21, $22, $23, $24, $25, $26, $27, $28, $29, $30, $31, $32
) RETURNING id_proyecto"; // Ahora 32 placeholders

$paramsProyecto = [
    $usuario_id_actual, $nombre_proyecto, $logo_path, $eslogan, $sector, $region, $ubicacion, $resumen, $problema,
    $solucion, $propuesta_valor, $mercado_objetivo, $tamano_mercado, $competencia, $ventajas,
    $modelo_ingresos, $monto_inversion, $valoracion, $uso_fondos, $etapa, $hitos, $logros,
    $pitch_pdf_path, $plan_negocios_path, $proyecciones_pdf_path, // Añadido
    $sitio_web, $video_pitch, $demo_url, $contacto_nombre, $contacto_correo, $contacto_telefono, $linkedin
];

$stmt_name_proyecto = "insert_proyecto_principal_v2"; // Cambiar nombre si la query cambia
$prepare_result_proyecto = pg_prepare($conn, $stmt_name_proyecto, $sqlProyecto);

if (!$prepare_result_proyecto) {
    echo "❌ Error al preparar la consulta del proyecto: " . pg_last_error($conn);
    if ($conn) { pg_close($conn); }
    exit;
}

$resultProyectoPrincipal = pg_execute($conn, $stmt_name_proyecto, $paramsProyecto);
$id_proyecto_insertado = null;

if ($resultProyectoPrincipal && pg_num_rows($resultProyectoPrincipal) > 0) {
    $row_id = pg_fetch_assoc($resultProyectoPrincipal);
    $id_proyecto_insertado = $row_id['id_proyecto'];
    // echo "✅ Proyecto principal guardado con éxito. ID: " . $id_proyecto_insertado . "<br>"; // Mensaje para debug

    // ---- INICIO: Manejo de Imágenes de Galería ----
    // El name del input file en HTML debe ser "imagenes_galeria[]"
    if (isset($_FILES['imagenes_galeria']) && is_array($_FILES['imagenes_galeria']['name']) && !empty($_FILES['imagenes_galeria']['name'][0])) {
        
        $galeriaUploadDirFisica = __DIR__ . '/../assets/uploads/proyectos_galeria/'; // Ruta física
        $galeriaUploadUrlRelativa = 'assets/uploads/proyectos_galeria/';      // Ruta para DB

        if (!is_dir($galeriaUploadDirFisica)) {
            if (!mkdir($galeriaUploadDirFisica, 0775, true)) {
                // Loguear error pero no necesariamente detener todo el script si la galería es opcional
                error_log("ADVERTENCIA: No se pudo crear el directorio de subida para la galería: " . $galeriaUploadDirFisica);
                // echo "⚠️ Advertencia: No se pudo crear el directorio de subida para la galería.<br>";
            }
        }

        // Solo proceder si el directorio existe o se pudo crear
        if (is_dir($galeriaUploadDirFisica)) {
            $sqlImagenGaleria = "INSERT INTO proyecto_imagenes (id_proyecto, url_imagen, descripcion_imagen, orden) VALUES ($1, $2, $3, $4)";
            $stmt_name_galeria = "insert_imagen_galeria_v2"; // Cambiar nombre si la query cambia
            $prepare_result_galeria = pg_prepare($conn, $stmt_name_galeria, $sqlImagenGaleria);

            if (!$prepare_result_galeria) {
                error_log("ADVERTENCIA: Error al preparar la consulta para imágenes de galería: " . pg_last_error($conn));
            } else {
                $total_files = count($_FILES['imagenes_galeria']['name']);
                for ($i = 0; $i < $total_files; $i++) {
                    if ($_FILES['imagenes_galeria']['error'][$i] === UPLOAD_ERR_OK) {
                        $fileTmpPath = $_FILES['imagenes_galeria']['tmp_name'][$i];
                        $fileName = $_FILES['imagenes_galeria']['name'][$i];
                        $fileSize = $_FILES['imagenes_galeria']['size'][$i];
                        $fileType = $_FILES['imagenes_galeria']['type'][$i];
                        $fileNameCmps = explode(".", $fileName);
                        $fileExtension = strtolower(end($fileNameCmps));

                        $safeFileName = preg_replace("/[^a-zA-Z0-9_.-]/", "_", basename($fileName));
                        $newGaleriaFileName = uniqid('galeria_' . $id_proyecto_insertado . '_', true) . '.' . $fileExtension;
                        
                        $dest_path_fisica_galeria = $galeriaUploadDirFisica . $newGaleriaFileName;
                        $dest_path_db_galeria = $galeriaUploadUrlRelativa . $newGaleriaFileName;

                        $max_file_size_galeria_mb = 2; // 2MB por imagen de galería

                        if (!in_array($fileType, $allowed_images)) {
                            // echo "⚠️ Advertencia: Tipo de archivo no permitido para galería '{$fileName}'.<br>";
                            continue;
                        }
                        if ($fileSize > ($max_file_size_galeria_mb * 1024 * 1024)) {
                            // echo "⚠️ Advertencia: El archivo de galería '{$fileName}' es demasiado grande (Máx {$max_file_size_galeria_mb}MB).<br>";
                            continue;
                        }

                        if (move_uploaded_file($fileTmpPath, $dest_path_fisica_galeria)) {
                            $paramsImagen = [$id_proyecto_insertado, $dest_path_db_galeria, $safeFileName, $i]; // $i como orden inicial
                            $resultImagen = pg_execute($conn, $stmt_name_galeria, $paramsImagen);
                            // if (!$resultImagen) {
                            //     error_log("Error al guardar ruta de imagen de galería '{$fileName}' en BD: " . pg_last_error($conn));
                            // }
                        } else {
                            error_log("Error al mover archivo de galería subido '{$fileName}'. Error PHP: " . $_FILES['imagenes_galeria']['error'][$i]);
                        }
                    } elseif ($_FILES['imagenes_galeria']['error'][$i] !== UPLOAD_ERR_NO_FILE) {
                        error_log("Error en subida de archivo de galería '{$_FILES['imagenes_galeria']['name'][$i]}': Código " . $_FILES['imagenes_galeria']['error'][$i]);
                    }
                }
            }
        }
    }
    // ---- FIN: Manejo de Imágenes de Galería ----

    // Para un envío de formulario directo:
    echo "<div style='padding:20px; font-family: Arial, sans-serif; text-align:center; border: 1px solid #ddd; margin: 20px; border-radius: 5px;'>
            <h2 style='color:green;'>✅ ¡Proyecto Guardado Exitosamente!</h2>
            <p>Tu proyecto \"<strong>" . htmlspecialchars($nombre_proyecto, ENT_QUOTES, 'UTF-8') . "</strong>\" ha sido recibido.</p>
            <p>Serás redirigido a la página principal en 5 segundos.</p>
            <p><a href='../index.php?page=home' style='text-decoration:none; color: #007bff;'>O haz clic aquí para ir ahora</a></p>
          </div>
          <script> setTimeout(function(){ window.location.href = '../index.php?page=home'; }, 5000); </script>";
    // O redirige a "mis proyectos" o al detalle del proyecto recién creado.
    // header("Refresh:5; url=../index.php?page=project-detail&id_proyecto=" . $id_proyecto_insertado); 
    exit;

} else {
    // echo "❌ Error al guardar el proyecto principal: " . pg_last_error($conn);
     echo "<div style='padding:20px; font-family: Arial, sans-serif; text-align:center; border: 1px solid #ddd; margin: 20px; border-radius: 5px; background-color: #ffebee; color: #c62828;'>
            <h2 style='color:#c62828;'>❌ Error al Guardar el Proyecto</h2>
            <p>Hubo un problema al intentar guardar tu proyecto. Por favor, intenta de nuevo.</p>
            <p>Detalle del error: " . htmlspecialchars(pg_last_error($conn), ENT_QUOTES, 'UTF-8') . "</p>
            <p><a href='javascript:history.back()' style='text-decoration:none; color: #007bff;'>Volver al formulario</a></p>
          </div>";
}

if ($conn) { pg_close($conn); }
?>