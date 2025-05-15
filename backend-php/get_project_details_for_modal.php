<?php
// backend-php/get_project_details_for_modal.php
ini_set('display_errors', 1); error_reporting(E_ALL); // Para desarrollo

require_once __DIR__ . '/../config/database.php'; // Ajusta la ruta a tu config

$projectId = isset($_GET['id_proyecto']) ? filter_var($_GET['id_proyecto'], FILTER_SANITIZE_NUMBER_INT) : null;

if (!$projectId) {
    echo "<div class='alert alert-danger m-3'>ID de proyecto no proporcionado.</div>";
    exit;
}

if (!$conn) {
    echo "<div class='alert alert-danger m-3'>Error de conexión a la base de datos.</div>";
    exit;
}

session_start(); 
$current_user_id_for_view = $_SESSION['user_id'] ?? 0;
$is_owner = false;

$proyecto_raw = null; 
$proyecto = []; // Inicializar $proyecto como array vacío para asegurar que exista
$emprendedor_creador_modal = null;
$galeria_proyecto_modal = [];

$sqlProyecto = "SELECT p.*, 
                       u.nombre_completo AS nombre_creador, 
                       u.foto_perfil_url AS foto_creador,
                       u.rol AS rol_creador,
                       u.email AS email_creador_para_contacto_fallback 
                FROM proyectos p
                JOIN usuarios u ON p.usuario_id = u.id
                WHERE p.id_proyecto = $1"; 

$stmtProyecto = pg_prepare($conn, "get_full_project_details_modal_v4", $sqlProyecto); // Nuevo nombre
if (!$stmtProyecto) {
    error_log("Error al preparar get_full_project_details_modal_v4: " . pg_last_error($conn));
    echo "<div class='alert alert-danger m-3'>Error interno del servidor (P1M).</div>";
    if (isset($conn)) { pg_close($conn); }
    exit;
}
$resultProyecto = pg_execute($conn, "get_full_project_details_modal_v4", array($projectId));

if ($resultProyecto && pg_num_rows($resultProyecto) > 0) {
    $proyecto_raw = pg_fetch_assoc($resultProyecto);

    if ($current_user_id_for_view != 0 && $proyecto_raw['usuario_id'] == $current_user_id_for_view) {
        $is_owner = true;
    }

    if (!$is_owner && !(strtolower($proyecto_raw['estado'] ?? '') === 'aprobado' || strtolower($proyecto_raw['estado'] ?? '') === 'activo')) {
        echo "<div class='alert alert-warning m-3'>Este proyecto no está disponible o no tienes permiso para verlo.</div>";
        if (isset($conn)) { pg_close($conn); }
        exit;
    }
    
    // --- Procesamiento y Sanitización de todos los campos del proyecto ---
    $proyecto['id_proyecto'] = $proyecto_raw['id_proyecto'];
    $proyecto['logo'] = !empty(trim($proyecto_raw['logo'] ?? '')) ? htmlspecialchars(trim($proyecto_raw['logo'] ?? ''), ENT_QUOTES, 'UTF-8') : 'assets/img/examples/project_default.png'; // Ruta relativa a la raíz del sitio
    $proyecto['nombre_proyecto'] = htmlspecialchars(trim($proyecto_raw['nombre_proyecto'] ?? 'Proyecto sin Título'), ENT_QUOTES, 'UTF-8');
    $proyecto['eslogan'] = htmlspecialchars(trim($proyecto_raw['eslogan'] ?? ''), ENT_QUOTES, 'UTF-8');
    $proyecto['sector'] = htmlspecialchars(trim($proyecto_raw['sector'] ?? 'No especificado'), ENT_QUOTES, 'UTF-8');
    $proyecto['region'] = htmlspecialchars(trim($proyecto_raw['region'] ?? 'No especificada'), ENT_QUOTES, 'UTF-8');
    $proyecto['ubicacion'] = htmlspecialchars(trim($proyecto_raw['ubicacion'] ?? 'No especificada'), ENT_QUOTES, 'UTF-8');
    
    $resumen_raw = trim($proyecto_raw['resumen'] ?? '');
    $proyecto['resumen'] = !empty($resumen_raw) ? nl2br(htmlspecialchars($resumen_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';
    
    $problema_raw = trim($proyecto_raw['problema'] ?? '');
    $proyecto['problema'] = !empty($problema_raw) ? nl2br(htmlspecialchars($problema_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';

    $solucion_raw = trim($proyecto_raw['solucion'] ?? '');
    $proyecto['solucion'] = !empty($solucion_raw) ? nl2br(htmlspecialchars($solucion_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';

    $propuesta_valor_raw = trim($proyecto_raw['propuesta_valor'] ?? '');
    $proyecto['propuesta_valor'] = !empty($propuesta_valor_raw) ? nl2br(htmlspecialchars($propuesta_valor_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';

    $mercado_objetivo_raw = trim($proyecto_raw['mercado_objetivo'] ?? '');
    $proyecto['mercado_objetivo'] = !empty($mercado_objetivo_raw) ? nl2br(htmlspecialchars($mercado_objetivo_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';
    
    $proyecto['tamano_mercado'] = htmlspecialchars(trim($proyecto_raw['tamano_mercado'] ?? 'No especificado'), ENT_QUOTES, 'UTF-8');

    $competencia_raw = trim($proyecto_raw['competencia'] ?? '');
    $proyecto['competencia'] = !empty($competencia_raw) ? nl2br(htmlspecialchars($competencia_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';
    
    $ventajas_raw = trim($proyecto_raw['ventajas'] ?? '');
    $proyecto['ventajas'] = !empty($ventajas_raw) ? nl2br(htmlspecialchars($ventajas_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';

    $modelo_ingresos_raw = trim($proyecto_raw['modelo_ingresos'] ?? '');
    $proyecto['modelo_ingresos'] = !empty($modelo_ingresos_raw) ? nl2br(htmlspecialchars($modelo_ingresos_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';

    $monto_inversion_val = $proyecto_raw['monto_inversion'] ?? null;
    $proyecto['monto_inversion_formateado'] = !is_null($monto_inversion_val) && is_numeric($monto_inversion_val) ? '$' . number_format((float)$monto_inversion_val, 0, ',', '.') : 'No especificado';
    
    $valoracion_val = $proyecto_raw['valoracion'] ?? null;
    $proyecto['valoracion_formateada'] = !is_null($valoracion_val) && is_numeric($valoracion_val) ? '$' . number_format((float)$valoracion_val, 0, ',', '.') : '';

    $uso_fondos_raw = trim($proyecto_raw['uso_fondos'] ?? '');
    $proyecto['uso_fondos'] = !empty($uso_fondos_raw) ? nl2br(htmlspecialchars($uso_fondos_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';

    $proyecto['etapa'] = htmlspecialchars(trim($proyecto_raw['etapa'] ?? 'No especificada'), ENT_QUOTES, 'UTF-8');
    $proyecto['hitos'] = htmlspecialchars(trim($proyecto_raw['hitos'] ?? 'No especificados'), ENT_QUOTES, 'UTF-8');

    $logros_raw = trim($proyecto_raw['logros'] ?? '');
    $proyecto['logros'] = !empty($logros_raw) ? nl2br(htmlspecialchars($logros_raw, ENT_QUOTES, 'UTF-8')) : '<em>Información no disponible.</em>';
    
    $proyecto['pitch_pdf'] = htmlspecialchars(trim($proyecto_raw['pitch_pdf'] ?? ''), ENT_QUOTES, 'UTF-8');
    $proyecto['plan_negocios'] = htmlspecialchars(trim($proyecto_raw['plan_negocios'] ?? ''), ENT_QUOTES, 'UTF-8');
    // $proyecto['proyecciones_pdf'] = htmlspecialchars(trim($proyecto_raw['proyecciones_pdf'] ?? ''), ENT_QUOTES, 'UTF-8'); // Si la usas

    $proyecto['sitio_web'] = htmlspecialchars(trim($proyecto_raw['sitio_web'] ?? ''), ENT_QUOTES, 'UTF-8');
    $proyecto['video_pitch_url'] = htmlspecialchars(trim($proyecto_raw['video_pitch'] ?? ''), ENT_QUOTES, 'UTF-8');
    $proyecto['demo_url'] = htmlspecialchars(trim($proyecto_raw['demo_url'] ?? ''), ENT_QUOTES, 'UTF-8');
    
    // --- CORRECCIÓN PARA CONTACTO DEL PROYECTO ---
    $raw_contacto_nombre = $proyecto_raw['contacto_nombre'] ?? ($proyecto_raw['nombre_creador'] ?? null);
    $proyecto['contacto_nombre_display'] = !empty(trim($raw_contacto_nombre ?? '')) ? htmlspecialchars(trim($raw_contacto_nombre ?? ''), ENT_QUOTES, 'UTF-8') : 'No especificado';

    $raw_contacto_correo = $proyecto_raw['contacto_correo'] ?? ($proyecto_raw['email_creador_para_contacto_fallback'] ?? null);
    $proyecto['contacto_correo_display'] = !empty(trim($raw_contacto_correo ?? '')) ? htmlspecialchars(trim($raw_contacto_correo ?? ''), ENT_QUOTES, 'UTF-8') : '';

    $raw_contacto_telefono = $proyecto_raw['contacto_telefono'] ?? null;
    $proyecto['contacto_telefono_display'] = !empty(trim($raw_contacto_telefono ?? '')) ? htmlspecialchars(trim($raw_contacto_telefono ?? ''), ENT_QUOTES, 'UTF-8') : '';

    $raw_linkedin = $proyecto_raw['linkedin'] ?? null;
    $proyecto['linkedin_display'] = !empty(trim($raw_linkedin ?? '')) ? htmlspecialchars(trim($raw_linkedin ?? ''), ENT_QUOTES, 'UTF-8') : '';

    // --- CORRECCIÓN PARA FECHA DE CREACIÓN FORMATEADA ---
    $fecha_creacion_raw = $proyecto_raw['fecha_creacion'] ?? null;
    if ($fecha_creacion_raw) {
        try { 
            $date = new DateTime($fecha_creacion_raw); 
            $proyecto['fecha_creacion_formateada'] = $date->format('d F, Y H:i'); 
        } catch (Exception $e) { 
            $proyecto['fecha_creacion_formateada'] = 'Fecha inválida'; 
            error_log("Error formateando fecha '{$fecha_creacion_raw}' en get_project_details_for_modal.php: " . $e->getMessage());
        }
    } else {
        $proyecto['fecha_creacion_formateada'] = 'N/A'; 
    }
    // --- FIN CORRECCIÓN FECHA ---


    $emprendedor_creador_modal = [
        'nombre_completo' => htmlspecialchars(trim($proyecto_raw['nombre_creador'] ?? 'Emprendedor Anónimo'), ENT_QUOTES, 'UTF-8'),
        'foto_perfil_url' => !empty(trim($proyecto_raw['foto_creador'] ?? '')) ? htmlspecialchars(trim($proyecto_raw['foto_creador'] ?? ''), ENT_QUOTES, 'UTF-8') : 'assets/img/profile-signin.jpg',
        'rol' => htmlspecialchars(trim($proyecto_raw['rol_creador'] ?? 'No especificado'), ENT_QUOTES, 'UTF-8')
    ];

    // Galería
    $stmtGaleriaModal = pg_prepare($conn, "get_project_gallery_modal_v4", "SELECT url_imagen, descripcion_imagen FROM proyecto_imagenes WHERE id_proyecto = $1 ORDER BY orden ASC, fecha_subida ASC"); // Nuevo nombre
    if($stmtGaleriaModal){
        $resultGaleriaModal = pg_execute($conn, "get_project_gallery_modal_v4", array($projectId));
        if($resultGaleriaModal){
            while($img_row = pg_fetch_assoc($resultGaleriaModal)){
                $galeria_proyecto_modal[] = [
                    'url_imagen' => htmlspecialchars(trim($img_row['url_imagen'] ?? ''), ENT_QUOTES, 'UTF-8'),
                    'descripcion_imagen' => htmlspecialchars(trim($img_row['descripcion_imagen'] ?? ($proyecto['nombre_proyecto'])), ENT_QUOTES, 'UTF-8')
                ];
            }
        } else { error_log("Error ejecutando galería modal: ".pg_last_error($conn)); }
    } else { error_log("Error preparando galería modal: ".pg_last_error($conn)); }
    
    function getEmbedUrlModalDetail($videoUrl) { 
        if (empty($videoUrl)) return '';
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $match)) {
            return 'https://www.youtube.com/embed/' . $match[1];
        }
        if (preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $match)) {
            return 'https://player.vimeo.com/video/' . $match[1];
        }
        return '';
    }
    $embedVideoUrlModal = getEmbedUrlModalDetail($proyecto['video_pitch_url']);

    // ---- INICIO DEL HTML PARA EL MODAL ----
    // Tu HTML del modal va aquí, usando las variables $proyecto, $emprendedor_creador_modal, $galeria_proyecto_modal, $embedVideoUrlModal
    // Asegúrate que el HTML que genera este script NO incluya <html>, <head>, <body>, solo el contenido para el modal.
    // El HTML que te di en la respuesta anterior para el cuerpo del modal ("<div class='project-detail-modal-content p-3'>...</div>")
    // y su script JS interno para MagnificPopup es el que debe ir aquí.
    // Por ejemplo:
    ?>
    <div class="project-detail-modal-content p-3">
        <div class="text-center mb-4 pt-2" style="background: linear-gradient(to right, #0d6efd, #0a58ca); color: white; margin: -1rem -1rem 1.5rem -1rem; padding: 20px 15px; border-radius: 0.3rem 0.3rem 0 0 ;">
             <img src="<?php echo $proyecto['logo']; ?>" alt="Logo: <?php echo $proyecto['nombre_proyecto']; ?>" class="img-fluid rounded-circle mb-2 shadow-sm project-header-logo-modal" style="max-height: 80px; width:80px; object-fit:contain; border: 3px solid rgba(255,255,255,0.7); background-color: rgba(255,255,255,0.1);">
            <h3 class="fw-bold mb-1 mt-1"><?php echo $proyecto['nombre_proyecto']; ?></h3>
            <?php if(!empty($proyecto['eslogan'])): ?><p class="text-white-50 fs-6 mb-0 fst-italic">"<?php echo $proyecto['eslogan']; ?>"</p><?php endif; ?>
        </div>

        <ul class="nav nav-tabs nav-fill mb-3" id="projectDetailModalTabs" role="tablist">
            <li class="nav-item" role="presentation"><button class="nav-link active" id="modal-tab-general" data-bs-toggle="tab" data-bs-target="#modal-content-general" type="button" role="tab">General</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" id="modal-tab-mercado" data-bs-toggle="tab" data-bs-target="#modal-content-mercado" type="button" role="tab">Mercado</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" id="modal-tab-finanzas" data-bs-toggle="tab" data-bs-target="#modal-content-finanzas" type="button" role="tab">Finanzas</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" id="modal-tab-equipo" data-bs-toggle="tab" data-bs-target="#modal-content-equipo" type="button" role="tab">Creador y Contacto</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" id="modal-tab-multimedia" data-bs-toggle="tab" data-bs-target="#modal-content-multimedia" type="button" role="tab">Multimedia</button></li>
        </ul>

        <div class="tab-content" id="projectDetailModalTabsContent">
            <div class="tab-pane fade show active" id="modal-content-general" role="tabpanel">
                <h5 class="text-primary mt-2 mb-2"><i class="fas fa-file-alt me-1"></i>Resumen Ejecutivo</h5>
                <div class="text-content-detail-modal small bg-light p-3 rounded mb-3"><?php echo $proyecto['resumen']; ?></div>
                <div class="row">
                    <div class="col-md-6"><h6 class="text-primary mt-2 mb-1">Problema</h6><p class="text-muted small"><?php echo $proyecto['problema']; ?></p></div>
                    <div class="col-md-6"><h6 class="text-primary mt-2 mb-1">Solución</h6><p class="text-muted small"><?php echo $proyecto['solucion']; ?></p></div>
                </div>
                <?php if (!empty(strip_tags($proyecto['propuesta_valor'])) && $proyecto['propuesta_valor'] !== '<em>Información no disponible.</em>'): ?>
                    <h6 class="text-primary mt-3 mb-1">Propuesta de Valor</h6><p class="text-muted small"><?php echo $proyecto['propuesta_valor']; ?></p>
                <?php endif; ?>
                <hr class="my-3">
                <p class="mb-1 small"><strong><i class="fas fa-industry fa-fw me-1"></i>Sector:</strong> <?php echo $proyecto['sector']; ?></p>
                <p class="mb-1 small"><strong><i class="fas fa-flag-checkered fa-fw me-1"></i>Etapa:</strong> <?php echo $proyecto['etapa']; ?></p>
                <p class="mb-1 small"><strong><i class="fas fa-globe-americas fa-fw me-1"></i>Región:</strong> <?php echo $proyecto['region']; ?></p>
                <p class="mb-1 small"><strong><i class="fas fa-map-marker-alt fa-fw me-1"></i>Ubicación:</strong> <?php echo $proyecto['ubicacion']; ?></p>
                <p class="mb-0 small"><strong><i class="far fa-calendar-alt fa-fw me-1"></i>Creado:</strong> <?php echo $proyecto['fecha_creacion_formateada']; // Esta es la clave que debe existir ?></p>
            </div>
            <div class="tab-pane fade" id="modal-content-mercado" role="tabpanel">
                <h5 class="text-primary mt-2 mb-2"><i class="fas fa-chart-pie me-1"></i>Análisis de Mercado</h5>
                <p class="small"><strong>Mercado Objetivo:</strong> <?php echo $proyecto['mercado_objetivo']; ?></p>
                <p class="small"><strong>Tamaño Estimado:</strong> <?php echo $proyecto['tamano_mercado']; ?></p>
                <p class="small"><strong>Competencia:</strong> <?php echo $proyecto['competencia']; ?></p>
                <p class="small"><strong>Ventajas Competitivas:</strong> <?php echo $proyecto['ventajas']; ?></p>
                <hr class="my-3">
                 <h5 class="text-primary mt-2 mb-2"><i class="fas fa-cogs me-1"></i>Modelo de Negocio</h5>
                <p class="small"><strong>Modelo de Ingresos:</strong> <?php echo $proyecto['modelo_ingresos']; ?></p>
            </div>
            <div class="tab-pane fade" id="modal-content-finanzas" role="tabpanel">
                <h5 class="text-primary mt-2 mb-2"><i class="fas fa-hand-holding-usd me-1"></i>Finanzas</h5>
                <p class="small"><strong>Inversión Solicitada:</strong> <?php echo $proyecto['monto_inversion_formateado']; ?></p>
                <?php if (!empty($proyecto['valoracion_formateada'])): ?>
                    <p class="small"><strong>Valoración Pre-Money:</strong> $<?php echo $proyecto['valoracion_formateada']; ?></p>
                <?php endif; ?>
                <p class="small"><strong>Uso de Fondos:</strong> <?php echo $proyecto['uso_fondos']; ?></p>
                 <hr class="my-3">
                 <h5 class="text-primary mt-2 mb-2"><i class="fas fa-tasks me-1"></i>Tracción y Logros</h5>
                <p class="small"><strong>Próximos Hitos:</strong> <?php echo $proyecto['hitos']; ?></p>
                <p class="small"><strong>Logros Obtenidos:</strong> <?php echo $proyecto['logros']; ?></p>
            </div>
            <div class="tab-pane fade" id="modal-content-equipo" role="tabpanel">
                 <h5 class="text-primary mt-2 mb-2"><i class="fas fa-user-tie me-1"></i>Creador del Proyecto</h5>
                 <div class="d-flex align-items-center mb-3">
                    <img src="<?php echo $emprendedor_creador_modal['foto_perfil_url']; ?>" alt="<?php echo $emprendedor_creador_modal['nombre_completo']; ?>" class="rounded-circle me-2" style="width:40px; height:40px; object-fit:cover;">
                    <div><strong><?php echo $emprendedor_creador_modal['nombre_completo']; ?></strong><br><small class="text-muted"><?php echo $emprendedor_creador_modal['rol']; ?></small></div>
                 </div>
                 <h5 class="text-primary mt-3 mb-2"><i class="fas fa-address-book me-1"></i>Contacto del Proyecto</h5>
                 <p class="small"><strong>Nombre:</strong> <?php echo $proyecto['contacto_nombre_display']; ?></p>
                 <p class="small"><strong>Email:</strong> <?php if (!empty($proyecto['contacto_correo_display'])): ?><a href="mailto:<?php echo $proyecto['contacto_correo_display']; ?>"><?php echo $proyecto['contacto_correo_display']; ?></a><?php else: ?>N/A<?php endif; ?></p>
                 <p class="small"><strong>Teléfono:</strong> <?php echo !empty($proyecto['contacto_telefono_display']) ? $proyecto['contacto_telefono_display'] : 'N/A'; ?></p>
                 <?php if (!empty($proyecto['linkedin_display'])): ?><p class="small"><strong>LinkedIn:</strong> <a href="<?php echo $proyecto['linkedin_display']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $proyecto['linkedin_display']; ?></a></p><?php endif; ?>
            </div>
            <div class="tab-pane fade" id="modal-content-multimedia" role="tabpanel">
                 <h5 class="text-primary mt-2 mb-2"><i class="fas fa-folder-open me-1"></i>Documentos y Enlaces</h5>
                <ul class="list-unstyled">
                    <?php if (!empty($proyecto['sitio_web'])): ?><li><small><a href="<?php echo $proyecto['sitio_web']; ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-globe fa-fw me-1"></i> Sitio Web</a></small></li><?php endif; ?>
                    <?php if (!empty($proyecto['pitch_pdf'])): ?><li><small><a href="<?php echo $proyecto['pitch_pdf']; ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-file-powerpoint fa-fw me-1"></i> Pitch Deck</a></small></li><?php endif; ?>
                    <?php if (!empty($proyecto['plan_negocios'])): ?><li><small><a href="<?php echo $proyecto['plan_negocios']; ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-file-alt fa-fw me-1"></i> Plan de Negocios</a></small></li><?php endif; ?>
                    <?php if (!empty($proyecto['demo_url'])): ?><li><small><a href="<?php echo $proyecto['demo_url']; ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-laptop fa-fw me-1"></i> Demo Producto</a></small></li><?php endif; ?>
                </ul>
                <?php if(!empty($galeria_proyecto_modal)): ?>
                <hr class="my-3"><h5 class="mt-0 mb-3"><i class="fas fa-images text-primary me-1"></i>Galería del Proyecto</h5>
                <div class="row g-2 image-gallery-modal-view">
                    <?php foreach($galeria_proyecto_modal as $img): ?>
                    <div class="col-4 col-md-3 col-lg-2"><a href="<?php echo $img['url_imagen']; ?>" title="<?php echo $img['descripcion_imagen']; ?>" class="gallery-item-link-modal-view d-block"><img src="<?php echo $img['url_imagen']; ?>" alt="<?php echo $img['descripcion_imagen']; ?>" class="img-fluid rounded shadow-sm" style="height:80px; width:100%; object-fit:cover;"></a></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php if(!empty($embedVideoUrlModal)): ?>
                <hr class="my-3"><h5 class="mt-0 mb-3"><i class="fab fa-youtube text-primary me-1"></i>Video Pitch</h5>
                <div class="video-responsive shadow rounded overflow-hidden"><iframe src="<?php echo $embedVideoUrlModal; ?>" title="Video del Proyecto" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>
                <?php elseif(!empty($proyecto['video_pitch_url'])): ?>
                <hr class="my-3"><h5 class="mt-0 mb-3"><i class="fab fa-youtube text-primary me-1"></i>Video Pitch</h5>
                <p><a href="<?php echo $proyecto['video_pitch_url']; ?>" target="_blank" class="btn btn-sm btn-outline-danger"><i class="fab fa-youtube me-1"></i> Ver en Plataforma Externa</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        $(function() { 
            var tooltipsInVerModalLoaded = new bootstrap.Tooltip(document.getElementById('modalVerMiProyectoBodyProfile'), { selector: '[data-bs-toggle="tooltip"]' });
            if (typeof $.fn.magnificPopup === 'function' && $('.image-gallery-modal-view').length > 0 && $('.image-gallery-modal-view a').length > 0) {
                $('.image-gallery-modal-view').magnificPopup({ delegate: 'a.gallery-item-link-modal-view', type: 'image', gallery: { enabled: true }, mainClass: 'mfp-zoom-in mfp-img-mobile', removalDelay: 300, showCloseBtn: true, closeBtnInside: true });
            }
            var firstTabElModal = document.querySelector('#projectDetailModalTabs button[data-bs-target="#modal-content-general"]');
            if(firstTabElModal) { new bootstrap.Tab(firstTabElModal).show(); }
        });
    </script>
    <?php
    // ---- FIN DEL HTML PARA EL MODAL ----
} else {
    echo "<div class='alert alert-warning m-3'>No se encontraron detalles para este proyecto o no tienes permiso para verlo.</div>";
}
if (isset($conn)) { pg_close($conn); }
?>