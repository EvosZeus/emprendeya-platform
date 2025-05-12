<?php
session_start();
require '../config/database.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../session/sign-in.html");
    exit();
}

// Configuración para subida de archivos
$targetDir = "../uploads/";
$logosDir = $targetDir . "logos/";
$archivosDir = $targetDir . "archivos/";
$imagenesDir = $targetDir . "imagenes/";

// Crear directorios si no existen
if (!file_exists($logosDir)) mkdir($logosDir, 0777, true);
if (!file_exists($archivosDir)) mkdir($archivosDir, 0777, true);
if (!file_exists($imagenesDir)) mkdir($imagenesDir, 0777, true);

// Función para generar un nombre único para los archivos
function generarNombreUnico($prefijo) {
    return $prefijo . '_' . time() . '_' . rand(1000, 9999);
}

// Función para manejar la subida de archivos
function subirArchivo($file, $directorio, $prefijo, $tiposPermitidos = []) {
    if (empty($file['name'])) return null;
    
    $nombreArchivo = $file['name'];
    $tipoArchivo = $file['type'];
    $tamañoArchivo = $file['size'];
    $tempPath = $file['tmp_name'];
    $error = $file['error'];
    
    // Verificar si hay errores
    if ($error !== 0) return null;
    
    // Verificar tamaño (máximo 10MB)
    if ($tamañoArchivo > 10 * 1024 * 1024) return null;
    
    // Verificar tipo de archivo si se especifican tipos permitidos
    if (!empty($tiposPermitidos) && !in_array($tipoArchivo, $tiposPermitidos)) return null;
    
    // Generar un nombre único
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $nombreUnico = generarNombreUnico($prefijo) . '.' . $extension;
    $rutaDestino = $directorio . $nombreUnico;
    
    // Mover el archivo
    if (move_uploaded_file($tempPath, $rutaDestino)) {
        return [
            'ruta' => $rutaDestino,
            'nombre_original' => $nombreArchivo,
            'tipo' => $tipoArchivo
        ];
    }
    
    return null;
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Iniciar una transacción
        pg_query($conn, "BEGIN");
        
        // Datos básicos del proyecto
        $user_id = $_SESSION['user_id'];
        $nombre_proyecto = trim($_POST['nombre_proyecto']);
        $eslogan = trim($_POST['eslogan']);
        $sector = trim($_POST['sector']);
        $region = trim($_POST['region']);
        
        // Ubicación (coordenadas) - asumimos que estos valores se pasan como campos ocultos del mapa
        $ubicacion_lat = isset($_POST['ubicacion_lat']) ? $_POST['ubicacion_lat'] : null;
        $ubicacion_lng = isset($_POST['ubicacion_lng']) ? $_POST['ubicacion_lng'] : null;
        
        // Resumen y propuesta de valor
        $resumen = trim($_POST['resumen']);
        $problema = trim($_POST['problema']);
        $solucion = trim($_POST['solucion']);
        $propuesta_valor = trim($_POST['propuesta_valor']);
        
        // Mercado
        $mercado_objetivo = trim($_POST['mercado_objetivo']);
        $tamano_mercado = trim($_POST['tamano_mercado']);
        $competencia = trim($_POST['competencia']);
        $ventajas = trim($_POST['ventajas']);
        
        // Modelo de negocio
        $modelo_ingresos = trim($_POST['modelo_ingresos']);
        
        // Finanzas
        $monto_inversion = !empty($_POST['monto_inversion']) ? $_POST['monto_inversion'] : null;
        $valoracion = trim($_POST['valoracion']);
        $uso_fondos = trim($_POST['uso_fondos']);
        
        // Estado y tracción
        $etapa = trim($_POST['etapa']);
        $hitos = trim($_POST['hitos']);
        $logros = trim($_POST['logros']);
        
        // Enlaces
        $web = trim($_POST['web']);
        $video = trim($_POST['video']);
        $demo = trim($_POST['demo']);
        
        // Contacto
        $contacto = trim($_POST['contacto']);
        $correo_contacto = trim($_POST['correo_contacto']);
        $telefono = trim($_POST['telefono']);
        $linkedin = trim($_POST['linkedin']);
        
        // Validar campos obligatorios
        if (empty($nombre_proyecto)) {
            throw new Exception("El nombre del proyecto es obligatorio.");
        }
        
        // Insertar el proyecto
        $query = "INSERT INTO proyectos (
            user_id, nombre_proyecto, eslogan, sector, region, 
            ubicacion_lat, ubicacion_lng, resumen, problema, solucion, 
            propuesta_valor, mercado_objetivo, tamano_mercado, competencia, ventajas, 
            modelo_ingresos, monto_inversion, valoracion, uso_fondos, etapa, 
            hitos, logros, web, video, demo, 
            contacto, correo_contacto, telefono, linkedin
        ) VALUES (
            $1, $2, $3, $4, $5,
            $6, $7, $8, $9, $10,
            $11, $12, $13, $14, $15,
            $16, $17, $18, $19, $20,
            $21, $22, $23, $24, $25,
            $26, $27, $28, $29
        ) RETURNING id";
        
        $result = pg_query_params($conn, $query, [
            $user_id, $nombre_proyecto, $eslogan, $sector, $region,
            $ubicacion_lat, $ubicacion_lng, $resumen, $problema, $solucion,
            $propuesta_valor, $mercado_objetivo, $tamano_mercado, $competencia, $ventajas,
            $modelo_ingresos, $monto_inversion, $valoracion, $uso_fondos, $etapa,
            $hitos, $logros, $web, $video, $demo,
            $contacto, $correo_contacto, $telefono, $linkedin
        ]);
        
        if (!$result) {
            throw new Exception("Error al guardar el proyecto: " . pg_last_error($conn));
        }
        
        $proyecto = pg_fetch_assoc($result);
        $proyecto_id = $proyecto['id'];
        
        // Procesar logo
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
            $logo = subirArchivo($_FILES['logo'], $logosDir, 'logo', ['image/jpeg', 'image/png', 'image/gif']);
            
            if ($logo) {
                $query_logo = "INSERT INTO logos_proyectos (proyecto_id, ruta_archivo, mimetype) VALUES ($1, $2, $3)";
                $result_logo = pg_query_params($conn, $query_logo, [$proyecto_id, $logo['ruta'], $logo['tipo']]);
                
                if (!$result_logo) {
                    throw new Exception("Error al guardar el logo: " . pg_last_error($conn));
                }
            }
        }
        
        // Procesar archivos (proyecciones, pitch, plan_negocio)
        $tipos_archivos = [
            'proyecciones' => ['application/pdf'],
            'pitch' => ['application/pdf'],
            'plan_negocio' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
        ];
        
        foreach ($tipos_archivos as $tipo => $mimetypes) {
            if (isset($_FILES[$tipo]) && $_FILES[$tipo]['error'] === 0) {
                $archivo = subirArchivo($_FILES[$tipo], $archivosDir, $tipo, $mimetypes);
                
                if ($archivo) {
                    $query_archivo = "INSERT INTO archivos_proyectos (proyecto_id, tipo_archivo, ruta_archivo, nombre_original, mimetype) 
                                     VALUES ($1, $2, $3, $4, $5)";
                    $result_archivo = pg_query_params($conn, $query_archivo, [
                        $proyecto_id, $tipo, $archivo['ruta'], $archivo['nombre_original'], $archivo['tipo']
                    ]);
                    
                    if (!$result_archivo) {
                        throw new Exception("Error al guardar el archivo $tipo: " . pg_last_error($conn));
                    }
                }
            }
        }
        
        // Procesar imágenes de galería
        if (isset($_FILES['imagenes'])) {
            $total_imagenes = count($_FILES['imagenes']['name']);
            
            for ($i = 0; $i < $total_imagenes; $i++) {
                if ($_FILES['imagenes']['error'][$i] === 0) {
                    $archivo_imagen = [
                        'name' => $_FILES['imagenes']['name'][$i],
                        'type' => $_FILES['imagenes']['type'][$i],
                        'tmp_name' => $_FILES['imagenes']['tmp_name'][$i],
                        'error' => $_FILES['imagenes']['error'][$i],
                        'size' => $_FILES['imagenes']['size'][$i]
                    ];
                    
                    $imagen = subirArchivo($archivo_imagen, $imagenesDir, 'imagen', ['image/jpeg', 'image/png', 'image/gif']);
                    
                    if ($imagen) {
                        $query_imagen = "INSERT INTO imagenes_proyectos (proyecto_id, ruta_archivo, mimetype) VALUES ($1, $2, $3)";
                        $result_imagen = pg_query_params($conn, $query_imagen, [$proyecto_id, $imagen['ruta'], $imagen['tipo']]);
                        
                        if (!$result_imagen) {
                            throw new Exception("Error al guardar una imagen: " . pg_last_error($conn));
                        }
                    }
                }
            }
        }
        
        // Procesar miembros del equipo
        if (isset($_POST['fundadores']) && is_array($_POST['fundadores'])) {
            $fundadores = $_POST['fundadores'];
            $experiencias = $_POST['experiencia_equipo'] ?? [];
            
            foreach ($fundadores as $key => $fundador) {
                if (!empty(trim($fundador))) {
                    $experiencia = isset($experiencias[$key]) ? trim($experiencias[$key]) : '';
                    
                    $query_miembro = "INSERT INTO miembros_equipo (proyecto_id, nombre, experiencia) VALUES ($1, $2, $3)";
                    $result_miembro = pg_query_params($conn, $query_miembro, [$proyecto_id, trim($fundador), $experiencia]);
                    
                    if (!$result_miembro) {
                        throw new Exception("Error al guardar un miembro del equipo: " . pg_last_error($conn));
                    }
                }
            }
        }
        
        // Confirmar la transacción
        pg_query($conn, "COMMIT");
        
        // Redireccionar a la página de éxito o a la lista de proyectos
        header("Location: mis-proyectos.php?success=1");
        exit();
        
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        pg_query($conn, "ROLLBACK");
        
        // Mostrar el error
        echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
    }
}
?>