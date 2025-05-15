<?php
// project-detail.php

// --------------------------------------------------------------------
// INICIO DEL BLOQUE PHP (SIN CAMBIOS RESPECTO A LA ÚLTIMA VERSIÓN QUE TE DI)
// Este bloque obtiene $proyectoId, se conecta a la DB,
// obtiene $proyecto (incluyendo rol_creador), $emprendedor_creador, y $galeria_proyecto.
// Asegúrate de que la consulta principal obtenga u.rol AS rol_creador
// y que $emprendedor_creador['rol'] se esté poblando.
// --------------------------------------------------------------------

$proyectoId = null;
if (isset($_GET['id_proyecto'])) {
    $proyectoId = filter_var($_GET['id_proyecto'], FILTER_SANITIZE_NUMBER_INT);
} else {
    $queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    if ($queryString) {
        parse_str($queryString, $queryParams);
        if (isset($queryParams['id_proyecto'])) {
            $proyectoId = filter_var($queryParams['id_proyecto'], FILTER_SANITIZE_NUMBER_INT);
        }
    }
}

if (!$proyectoId) {
    echo "<div class='container page-inner'><div class='alert alert-danger text-center'>ID de proyecto no especificado.</div></div>";
    echo "<script>function inicializarPaginaActual() { console.log('PROJECT-DETAIL.PHP: No project ID, inicialización vacía.'); }</script>";
    exit;
}

require_once __DIR__ . '/config/database.php';

$proyecto = null;
$emprendedor_creador = null;
$galeria_proyecto = [];

$stmtProyecto = pg_prepare(
    $conn,
    "get_project_details_v3",
    "SELECT p.*, 
            u.nombre_completo AS nombre_creador, 
            u.foto_perfil_url AS foto_creador, 
            u.email AS email_creador,
            u.rol AS rol_creador 
     FROM proyectos p
     JOIN usuarios u ON p.usuario_id = u.id
     WHERE p.id_proyecto = $1 AND (p.estado = 'aprobado' OR p.estado = 'activo')"
);

if (!$stmtProyecto) {
    error_log("Error al preparar get_project_details_v3: " . pg_last_error($conn));
} else {
    $resultProyecto = pg_execute($conn, "get_project_details_v3", array($proyectoId));

    if ($resultProyecto && pg_num_rows($resultProyecto) > 0) {
        $proyecto = pg_fetch_assoc($resultProyecto);

        $proyecto['logo'] = !empty(trim($proyecto['logo'])) ? htmlspecialchars(trim($proyecto['logo']), ENT_QUOTES, 'UTF-8') : 'assets/img/examples/project_default.png';
        $proyecto['nombre_proyecto'] = htmlspecialchars($proyecto['nombre_proyecto'] ?? 'Proyecto sin Título', ENT_QUOTES, 'UTF-8');
        $proyecto['eslogan'] = htmlspecialchars($proyecto['eslogan'] ?? '', ENT_QUOTES, 'UTF-8');
        $proyecto['sector'] = htmlspecialchars($proyecto['sector'] ?? 'No especificado', ENT_QUOTES, 'UTF-8');
        $proyecto['region'] = htmlspecialchars($proyecto['region'] ?? 'No especificada', ENT_QUOTES, 'UTF-8');
        $proyecto['ubicacion'] = htmlspecialchars($proyecto['ubicacion'] ?? 'No especificada', ENT_QUOTES, 'UTF-8');
        $proyecto['resumen'] = !empty(trim($proyecto['resumen'])) ? nl2br(htmlspecialchars(trim($proyecto['resumen']), ENT_QUOTES, 'UTF-8')) : '<em>No disponible.</em>';
        $proyecto['problema'] = !empty(trim($proyecto['problema'])) ? nl2br(htmlspecialchars(trim($proyecto['problema']), ENT_QUOTES, 'UTF-8')) : '<em>No disponible.</em>';
        $proyecto['solucion'] = !empty(trim($proyecto['solucion'])) ? nl2br(htmlspecialchars(trim($proyecto['solucion']), ENT_QUOTES, 'UTF-8')) : '<em>No disponible.</em>';
        $proyecto['propuesta_valor'] = !empty(trim($proyecto['propuesta_valor'])) ? nl2br(htmlspecialchars(trim($proyecto['propuesta_valor']), ENT_QUOTES, 'UTF-8')) : '<em>No disponible.</em>';
        $proyecto['mercado_objetivo'] = !empty(trim($proyecto['mercado_objetivo'])) ? nl2br(htmlspecialchars(trim($proyecto['mercado_objetivo']), ENT_QUOTES, 'UTF-8')) : '<em>No disponible.</em>';
        $proyecto['tamano_mercado'] = htmlspecialchars($proyecto['tamano_mercado'] ?? 'No especificado', ENT_QUOTES, 'UTF-8');
        $proyecto['competencia'] = !empty(trim($proyecto['competencia'])) ? nl2br(htmlspecialchars(trim($proyecto['competencia']), ENT_QUOTES, 'UTF-8')) : '<em>No disponible.</em>';
        $proyecto['ventajas'] = !empty(trim($proyecto['ventajas'])) ? nl2br(htmlspecialchars(trim($proyecto['ventajas']), ENT_QUOTES, 'UTF-8')) : '<em>No disponible.</em>';
        $proyecto['modelo_ingresos'] = !empty(trim($proyecto['modelo_ingresos'])) ? nl2br(htmlspecialchars(trim($proyecto['modelo_ingresos']), ENT_QUOTES, 'UTF-8')) : '<em>No disponible.</em>';
        $proyecto['monto_inversion'] = !empty($proyecto['monto_inversion']) ? number_format($proyecto['monto_inversion'], 2, ',', '.') : 'No especificado';
        $proyecto['valoracion'] = !empty($proyecto['valoracion']) ? number_format($proyecto['valoracion'], 2, ',', '.') : '';
        $proyecto['uso_fondos'] = !empty(trim($proyecto['uso_fondos'])) ? nl2br(htmlspecialchars(trim($proyecto['uso_fondos']), ENT_QUOTES, 'UTF-8')) : '<em>No disponible.</em>';
        $proyecto['etapa'] = htmlspecialchars($proyecto['etapa'] ?? 'No especificada', ENT_QUOTES, 'UTF-8');
        $proyecto['hitos'] = htmlspecialchars($proyecto['hitos'] ?? 'No especificados', ENT_QUOTES, 'UTF-8');
        $proyecto['logros'] = !empty(trim($proyecto['logros'])) ? nl2br(htmlspecialchars(trim($proyecto['logros']), ENT_QUOTES, 'UTF-8')) : '<em>No disponibles.</em>';
        $proyecto['pitch_pdf'] = !empty(trim($proyecto['pitch_pdf'])) ? htmlspecialchars(trim($proyecto['pitch_pdf']), ENT_QUOTES, 'UTF-8') : '';
        $proyecto['plan_negocios'] = !empty(trim($proyecto['plan_negocios'])) ? htmlspecialchars(trim($proyecto['plan_negocios']), ENT_QUOTES, 'UTF-8') : '';
        $proyecto['sitio_web'] = !empty(trim($proyecto['sitio_web'])) ? htmlspecialchars(trim($proyecto['sitio_web']), ENT_QUOTES, 'UTF-8') : '';
        $proyecto['video_pitch'] = !empty(trim($proyecto['video_pitch'])) ? htmlspecialchars(trim($proyecto['video_pitch']), ENT_QUOTES, 'UTF-8') : '';
        $proyecto['demo_url'] = !empty(trim($proyecto['demo_url'])) ? htmlspecialchars(trim($proyecto['demo_url']), ENT_QUOTES, 'UTF-8') : '';
        $proyecto['contacto_nombre'] = htmlspecialchars($proyecto['contacto_nombre'] ?? ($proyecto['nombre_creador'] ?? 'Contacto del Proyecto'), ENT_QUOTES, 'UTF-8');
        $proyecto['contacto_correo'] = htmlspecialchars($proyecto['contacto_correo'] ?? ($proyecto['email_creador'] ?? ''), ENT_QUOTES, 'UTF-8');
        $proyecto['contacto_telefono'] = htmlspecialchars($proyecto['contacto_telefono'] ?? '', ENT_QUOTES, 'UTF-8');
        $proyecto['linkedin'] = !empty(trim($proyecto['linkedin'])) ? htmlspecialchars(trim($proyecto['linkedin']), ENT_QUOTES, 'UTF-8') : '';

        $emprendedor_creador = [
            'nombre_completo' => htmlspecialchars($proyecto['nombre_creador'] ?? 'Emprendedor Anónimo', ENT_QUOTES, 'UTF-8'),
            'foto_perfil_url' => !empty(trim($proyecto['foto_creador'])) ? htmlspecialchars(trim($proyecto['foto_creador']), ENT_QUOTES, 'UTF-8') : 'assets/img/profile-signin.jpg',
            'email' => htmlspecialchars($proyecto['email_creador'] ?? '', ENT_QUOTES, 'UTF-8'),
            'rol' => htmlspecialchars($proyecto['rol_creador'] ?? 'No especificado', ENT_QUOTES, 'UTF-8')
        ];

        $stmtGaleria = pg_prepare(
            $conn,
            "get_proyecto_galeria_v3",
            "SELECT id_imagen, url_imagen, descripcion_imagen 
             FROM proyecto_imagenes 
             WHERE id_proyecto = $1 
             ORDER BY orden ASC, fecha_subida ASC"
        );

        if (!$stmtGaleria) {
            error_log("Error al preparar get_proyecto_galeria_v3: " . pg_last_error($conn));
        } else {
            $resultGaleria = pg_execute($conn, "get_proyecto_galeria_v3", array($proyectoId));
            if ($resultGaleria) {
                while ($img_row = pg_fetch_assoc($resultGaleria)) {
                    $img_row['url_imagen'] = htmlspecialchars(trim($img_row['url_imagen']), ENT_QUOTES, 'UTF-8');
                    $img_row['descripcion_imagen'] = htmlspecialchars(trim($img_row['descripcion_imagen'] ?? ($proyecto['nombre_proyecto'] . ' - Imagen de Galería')), ENT_QUOTES, 'UTF-8');
                    $galeria_proyecto[] = $img_row;
                }
            } else {
                error_log("Error al ejecutar consulta de galería para proyecto ID $proyectoId: " . pg_last_error($conn));
            }
        }
    } else {
        echo "<div class='container page-inner'><div class='alert alert-warning text-center'>Proyecto no encontrado, no está aprobado, o ha ocurrido un error.</div></div>";
        echo "<script>function inicializarPaginaActual() { console.log('PROJECT-DETAIL.PHP: Proyecto no encontrado, inicialización vacía.'); }</script>";
        if ($conn) {
            pg_close($conn);
        }
        exit;
    }
}

function getEmbedUrl($videoUrl)
{
    if (empty($videoUrl)) return '';
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $match)) {
        return 'https://www.youtube.com/embed/' . $match[1];
    }
    if (preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $match)) {
        return 'https://player.vimeo.com/video/' . $match[1];
    }
    return '';
}
$embedVideoUrl = getEmbedUrl($proyecto['video_pitch'] ?? '');

if ($conn) {
    pg_close($conn);
}
// --------------------------------------------------------------------
// FIN DEL BLOQUE PHP
// --------------------------------------------------------------------
?>

<!-- Estilos específicos para project-detail.php -->
<style>
    .project-header-logo {
        max-height: 150px !important;
        /* Ajusta este valor según necesites */
        width: 150px !important;
        /* Ajusta este valor según necesites */
        object-fit: contain;
        border: 4px solid rgba(255, 255, 255, 0.8);
        background-color: rgba(255, 255, 255, 0.15);
        padding: 5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .project-title-detail {
        letter-spacing: -1px;
    }

    .project-slogan-detail {
        font-size: 1.35rem;
        opacity: 0.9;
        margin-top: 0.25rem;
    }

    .project-section {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .project-section h4 {
        border-bottom: 2px solid #e9ecef;
        /* Un gris más claro que el primario para subtítulos */
        padding-bottom: 0.75rem;
        margin-bottom: 1.75rem !important;
        display: flex;
        align-items: center;
        font-size: 1.5rem;
        /* Ligeramente más grande */
        color: #333;
        /* Color de texto más oscuro para h4 */
    }

    .project-section h4 i {
        margin-right: 0.85rem;
        font-size: 1.1em;
        color: var(--kai-primary);
    }

    .card-subtitle-detail {
        color: #202940;
        margin-bottom: 0.75rem;
        font-size: 1.15rem;
        font-weight: 500;
    }

    /* Estilo Kaiadmin para subtítulos */
    .text-content-detail {
        line-height: 1.75;
        color: #505867;
        font-size: 0.95rem;
    }

    /* Color de texto de Kaiadmin */
    .text-content-detail p {
        margin-bottom: 1rem;
    }

    .card-light-blue {
        background-color: #e7f1ff;
        border-left: 4px solid #007bff;
    }

    .card-light-green {
        background-color: #e6ffed;
        border-left: 4px solid #28a745;
    }

    .video-responsive {
        overflow: hidden;
        padding-bottom: 56.25%;
        position: relative;
        height: 0;
    }

    .video-responsive iframe {
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        position: absolute;
    }

    .project-sidebar-section h5 {
        font-size: 1.2rem;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 0.5rem;
        color: #333;
    }

    .animated-section-detail {
        animation: fadeInKai 0.6s ease-in-out;
    }

    @keyframes fadeInKai {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .gallery-image-thumb {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: .375rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform .2s ease-in-out, box-shadow .2s ease-in-out;
        cursor: pointer;
        border: 1px solid #eee;
    }

    .gallery-image-thumb:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Estilos para la tarjeta del creador */
    .creator-card {
        border: 1px solid #e9ecef;
        /* Borde estándar de tarjeta */
        border-radius: 0.5rem;
        /* Kaiadmin card radius */
        background-color: #ffffff;
        /* Fondo blanco */
        overflow: hidden;
        /* Para que el card-header-img no se salga */
    }

    .creator-card .card-header-img {
        height: 100px;
        /* Altura para la imagen de "portada" del creador */
        background-size: cover;
        background-position: center;
    }

    .creator-card .creator-avatar-wrapper {
        margin-top: -40px;
        /* Para que el avatar se superponga */
    }

    .creator-card .creator-avatar {
        width: 80px;
        height: 80px;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .creator-card .creator-name {
        font-size: 1.15rem;
        /* Tamaño nombre creador */
        font-weight: 600;
        color: #202940;
        /* Color título Kaiadmin */
        margin-top: 0.5rem;
    }

    .creator-card .creator-role {
        font-size: 0.85rem;
        color: #007bff;
        /* Primario para el rol */
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .creator-card .creator-contact-info {
        font-size: 0.8rem;
        color: #6c757d;
        word-break: break-all;
        /* Para emails largos */
    }

    .creator-card .creator-contact-info i {
        width: 16px;
        text-align: center;
        margin-right: 0.3rem;
    }

    .creator-card .btn-outline-secondary {
        /* Estilo para el botón "Ver Perfil del Creador" */
        padding: 0.25rem 0.75rem;
        font-size: 0.8rem;
    }
</style>

<div class="container">
    <div class="card card-space">
        <div class="page-inner">
            <div class="card shadow-sm animated-section-detail">
                <div class="card-header text-center"
                    style="background: linear-gradient(to right, #0062E6, #33AEFF); color: white; padding: 30px 20px; border-bottom: 5px solid #004AAD;">
                    <img src="<?php echo $proyecto['logo']; ?>" alt="Logo del Proyecto: <?php echo $proyecto['nombre_proyecto']; ?>"
                        class="img-fluid rounded-circle mb-3 shadow-lg project-header-logo">
                    <h1 class="fw-bold mb-1 display-5 project-title-detail"><?php echo $proyecto['nombre_proyecto']; ?></h1>
                    <?php if (!empty($proyecto['eslogan'])): ?>
                        <p class="lead mb-0 fst-italic project-slogan-detail">"<?php echo $proyecto['eslogan']; ?>"</p>
                    <?php endif; ?>
                </div>

                <div class="card-body p-md-4">
                    <div class="row">
                        <!-- Columna Izquierda (Principal) -->
                        <div class="col-lg-8">
                            <section id="identificacion-basica" class="mb-4 project-section">
                                <h4 class="fw-bold text-primary"><i class="fas fa-fingerprint"></i>Identificación Básica</h4>
                                <div class="card card-body shadow-sm">
                                    <p><strong><i class="fas fa-industry me-2 text-muted"></i>Sector / Industria:</strong> <?php echo $proyecto['sector']; ?></p>
                                    <p><strong><i class="fas fa-globe-americas me-2 text-muted"></i>País / Región:</strong> <?php echo $proyecto['region']; ?></p>
                                    <p class="mb-0"><strong><i class="fas fa-map-marker-alt me-2 text-muted"></i>Ubicación Específica:</strong> <?php echo $proyecto['ubicacion']; ?></p>
                                    <?php if (!empty($proyecto['ubicacion']) && $proyecto['ubicacion'] !== 'No especificada'): ?>
                                        <div class="mt-3">
                                            <label class="form-label fw-bold">Visualización Geográfica:</label>
                                            <div id="project-detail-map" style="height: 250px; width: 100%; border: 1px solid #ccc; border-radius: .25rem;"></div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </section>

                            <section id="resumen-propuesta" class="mb-4 project-section">
                                <h4 class="fw-bold text-primary"><i class="fas fa-file-alt"></i>Resumen y Propuesta de Valor</h4>
                                <div class="card card-body mb-3 shadow-sm">
                                    <h5 class="fw-bold card-subtitle-detail">Resumen Ejecutivo</h5>
                                    <div class="text-content-detail"><?php echo $proyecto['resumen']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="card card-light-blue h-100 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="fw-bold card-subtitle-detail"><i class="fas fa-exclamation-circle me-2"></i>Problema que Resuelve</h5>
                                                <div class="text-content-detail"><?php echo $proyecto['problema']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card card-light-green h-100 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="fw-bold card-subtitle-detail"><i class="fas fa-check-circle me-2"></i>Solución Ofrecida</h5>
                                                <div class="text-content-detail"><?php echo $proyecto['solucion']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if (!empty(strip_tags($proyecto['propuesta_valor'])) && $proyecto['propuesta_valor'] !== '<em>No disponible.</em>'): ?>
                                    <div class="card card-info card-annoucement card-round mt-3 shadow-sm">
                                        <div class="card-body text-center">
                                            <div class="card-opening">Propuesta Única de Valor</div>
                                            <div class="card-desc text-content-detail">
                                                <?php echo $proyecto['propuesta_valor']; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </section>
                            <!-- ... (Demas secciones: mercado, modelo_negocio, estado_traccion) ... -->

                            <section id="material-apoyo-multimedia" class="mb-4 project-section">
                                <h4 class="fw-bold text-primary"><i class="fas fa-photo-video"></i>Galería y Multimedia</h4>

                                <h5 class="fw-bold mt-3 card-subtitle-detail">Imágenes del Proyecto</h5>
                                <?php if (!empty($galeria_proyecto)): ?>
                                    <div id="galeria-proyecto-detalle" class="row g-2 image-gallery">
                                        <?php foreach ($galeria_proyecto as $img): ?>
                                            <div class="col-6 col-sm-4 col-md-3 mb-2">
                                                <a href="<?php echo $img['url_imagen']; ?>"
                                                    class="gallery-item-link d-block"
                                                    title="<?php echo $img['descripcion_imagen']; ?>"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top">
                                                    <img src="<?php echo $img['url_imagen']; ?>"
                                                        alt="<?php echo $img['descripcion_imagen']; ?>"
                                                        class="img-fluid rounded shadow-sm gallery-image-thumb">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted mt-1">No hay imágenes de galería disponibles para este proyecto.</p>
                                <?php endif; ?>

                                <?php if (!empty($embedVideoUrl)): ?>
                                    <h5 class="fw-bold mt-4 card-subtitle-detail">Video Pitch</h5>
                                    <div class="video-responsive shadow rounded overflow-hidden">
                                        <iframe width="560" height="315" src="<?php echo $embedVideoUrl; ?>" title="Video Pitch del Proyecto: <?php echo $proyecto['nombre_proyecto']; ?>"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div>
                                <?php elseif (!empty($proyecto['video_pitch'])): ?>
                                    <h5 class="fw-bold mt-4 card-subtitle-detail">Video Pitch</h5>
                                    <p class="text-muted mt-1">
                                        <a href="<?php echo $proyecto['video_pitch']; ?>" target="_blank" class="btn btn-outline-info btn-sm">
                                            <i class="fab fa-youtube me-1"></i> Ver Video
                                        </a> (No se pudo embeber directamente)
                                    </p>
                                <?php else: ?>
                                    <h5 class="fw-bold mt-4 card-subtitle-detail">Video Pitch</h5>
                                    <p class="text-muted mt-1">No hay video pitch disponible para este proyecto.</p>
                                <?php endif; ?>

                                <?php if (!empty($proyecto['demo_url'])): ?>
                                    <h5 class="fw-bold mt-4 card-subtitle-detail">Demo del Producto</h5>
                                    <a href="<?php echo $proyecto['demo_url']; ?>" target="_blank" class="btn btn-info btn-round">
                                        <span class="btn-label"><i class="fas fa-laptop"></i></span> Ver Demo
                                    </a>
                                <?php else: ?>
                                    <h5 class="fw-bold mt-4 card-subtitle-detail">Demo del Producto</h5>
                                    <p class="text-muted mt-1">No hay demo disponible para este proyecto.</p>
                                <?php endif; ?>
                            </section>
                        </div>

                        <!-- Columna Derecha (Sidebar) -->
                        <div class="col-lg-4">
                            <section id="creador-proyecto" class="mb-4 project-sidebar-section">
                                <h5 class="fw-bold text-secondary mb-3"><i class="fas fa-user-tie me-2"></i>Creado por</h5>
                                <div class="card creator-card shadow-sm">
                                    <div class="card-header-img" style="background-image: url('assets/img/default-cover.jpg');">
                                        <!-- Considera usar $emprendedor_creador['foto_portada_url'] si la tienes -->
                                    </div>
                                    <div class="card-body text-center pt-0">
                                        <div class="creator-avatar-wrapper">
                                            <img src="<?php echo $emprendedor_creador['foto_perfil_url']; ?>" alt="Foto de <?php echo $emprendedor_creador['nombre_completo']; ?>" class="creator-avatar rounded-circle">
                                        </div>
                                        <h4 class="creator-name mt-2 mb-1"><?php echo $emprendedor_creador['nombre_completo']; ?></h4>
                                        <p class="creator-role mb-2"><?php echo $emprendedor_creador['rol']; ?></p>
                                        <?php if (!empty($emprendedor_creador['email'])): ?>
                                            <p class="creator-contact-info mb-1">
                                                <i class="fas fa-envelope me-1"></i> <a href="mailto:<?php echo $emprendedor_creador['email']; ?>"><?php echo $emprendedor_creador['email']; ?></a>
                                            </p>
                                        <?php endif; ?>
                                        <a href="index.php?page=public-profile&user_id_view=<?php echo $proyecto['usuario_id']; ?>" class="btn btn-outline-secondary btn-sm btn-round mt-2 menu-link" data-page="public-profile&user_id_view=<?php echo $proyecto['usuario_id']; ?>">
                                            Ver Perfil del Creador
                                        </a>
                                    </div>
                                </div>
                            </section>

                            <!-- ... (Secciones Finanzas, Documentos, Contacto del Proyecto) ... -->
                            <section id="finanzas-inversion" class="mb-4 project-sidebar-section">
                                <h5 class="fw-bold text-secondary mb-3"><i class="fas fa-hand-holding-usd me-2"></i>Finanzas e Inversión</h5>
                                <div class="card card-stats card-success card-round mb-3 shadow-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Inversión Solicitada</p>
                                                    <h4 class="card-title">$<?php echo $proyecto['monto_inversion']; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if (!empty($proyecto['valoracion']) && $proyecto['valoracion'] !== 'No especificado' && $proyecto['valoracion'] !== ''): ?>
                                    <div class="card card-stats card-info card-round mb-3 shadow-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-icon">
                                                    <div class="icon-big text-center icon-info bubble-shadow-small"><i class="fas fa-balance-scale"></i></div>
                                                </div>
                                                <div class="col col-stats ms-3 ms-sm-0">
                                                    <div class="numbers">
                                                        <p class="card-category">Valoración Pre-Money</p>
                                                        <h4 class="card-title">$<?php echo $proyecto['valoracion']; ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="card card-body mb-3 shadow-sm">
                                    <h6 class="fw-bold card-subtitle-detail">Uso Detallado de los Fondos</h6>
                                    <div class="text-content-detail"><?php echo $proyecto['uso_fondos']; ?></div>
                                </div>

                                <?php /* if (isset($proyecto['proyecciones_pdf']) && !empty($proyecto['proyecciones_pdf'])): ?>
                                <div class="card card-body mb-3 shadow-sm">
                                    <h6 class="fw-bold card-subtitle-detail">Proyecciones Financieras</h6>
                                    <a href="<?php echo $proyecto['proyecciones_pdf']; ?>" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-file-pdf me-1"></i> Ver Proyecciones (PDF)
                                    </a>
                                </div>
                                <?php endif; */ ?>
                            </section>

                            <section id="documentos-adicionales" class="mb-4 project-sidebar-section">
                                <h5 class="fw-bold text-secondary mb-3"><i class="fas fa-folder-open me-2"></i>Documentos y Enlaces</h5>
                                <div class="list-group shadow-sm">
                                    <?php if (!empty($proyecto['pitch_pdf'])): ?>
                                        <a href="<?php echo $proyecto['pitch_pdf']; ?>" target="_blank"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-file-powerpoint me-2 text-danger"></i> Pitch Deck (PDF)</span>
                                            <i class="fas fa-external-link-alt text-muted"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($proyecto['plan_negocios'])): ?>
                                        <a href="<?php echo $proyecto['plan_negocios']; ?>" target="_blank"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-file-alt me-2 text-info"></i> Plan de Negocios</span>
                                            <i class="fas fa-external-link-alt text-muted"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($proyecto['sitio_web'])): ?>
                                        <a href="<?php echo $proyecto['sitio_web']; ?>" target="_blank"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-globe me-2 text-success"></i> Sitio Web Oficial</span>
                                            <i class="fas fa-external-link-alt text-muted"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php if (empty($proyecto['pitch_pdf']) && empty($proyecto['plan_negocios']) && empty($proyecto['sitio_web'])): ?>
                                    <p class="text-muted mt-2">No hay documentos o enlaces adicionales disponibles.</p>
                                <?php endif; ?>
                            </section>

                            <section id="contacto-principal" class="mb-4 project-sidebar-section">
                                <h5 class="fw-bold text-secondary mb-3"><i class="fas fa-address-card me-2"></i>Contacto del Proyecto</h5>
                                <div class="card card-body shadow-sm">
                                    <?php if (!empty($proyecto['contacto_nombre'])): ?>
                                        <p><i class="fas fa-user-tie me-2 text-muted"></i><strong>Nombre:</strong> <?php echo $proyecto['contacto_nombre']; ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($proyecto['contacto_correo'])): ?>
                                        <p><i class="fas fa-at me-2 text-muted"></i><strong>Email:</strong> <a href="mailto:<?php echo $proyecto['contacto_correo']; ?>"><?php echo $proyecto['contacto_correo']; ?></a></p>
                                    <?php endif; ?>
                                    <?php if (!empty($proyecto['contacto_telefono'])): ?>
                                        <p><i class="fas fa-phone-alt me-2 text-muted"></i><strong>Teléfono:</strong> <?php echo $proyecto['contacto_telefono']; ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($proyecto['linkedin'])): ?>
                                        <p class="mb-0"><i class="fab fa-linkedin me-2 text-muted"></i><strong>LinkedIn:</strong> <a href="<?php echo $proyecto['linkedin']; ?>" target="_blank"><?php echo $proyecto['linkedin']; // O un texto como "Perfil de LinkedIn" 
                                                                                                                                                                                                    ?></a></p>
                                    <?php endif; ?>
                                    <?php if (empty($proyecto['contacto_nombre']) && empty($proyecto['contacto_correo']) && empty($proyecto['contacto_telefono']) && empty($proyecto['linkedin'])): ?>
                                        <p class="text-muted">Información de contacto para este proyecto no proporcionada.</p>
                                    <?php endif; ?>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center py-4 bg-light border-top">
                    <button type="button" class="btn btn-success btn-lg btn-round mx-1" onclick="alert('Funcionalidad Invertir no implementada aún.')">
                        <span class="btn-label"><i class="fas fa-rocket"></i></span> Estoy Interesado en Invertir
                    </button>
                    <button type="button" class="btn btn-primary btn-lg btn-round mx-1" onclick="alert('Funcionalidad Colaborar no implementada aún.')">
                        <span class="btn-label"><i class="fas fa-hands-helping"></i></span> Quiero Colaborar
                    </button>
                    <?php if (!empty($proyecto['contacto_correo'])): ?>
                        <a href="mailto:<?php echo $proyecto['contacto_correo']; ?>?subject=Interesado en el proyecto: <?php echo urlencode($proyecto['nombre_proyecto']); ?>" class="btn btn-outline-secondary btn-lg btn-round mx-1">
                            <span class="btn-label"><i class="fas fa-envelope"></i></span> Contactar Directamente
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- Script específico para project-detail.php -->
<script>
    function inicializarPaginaActual() {
        console.log("PROJECT-DETAIL.PHP: inicializarPaginaActual() ejecutada.");

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Dentro de inicializarPaginaActual() en project-detail.php

        const $galleryContainer = $('#galeria-proyecto-detalle');
        if ($galleryContainer.length && $galleryContainer.find('a.gallery-item-link').length > 0 && typeof $.fn.magnificPopup === 'function') {
            $galleryContainer.magnificPopup({
                delegate: 'a.gallery-item-link',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1],
                    arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
                },
                image: {
                    titleSrc: function(item) {
                        return item.el.attr('title') || '';
                    },
                    tError: '<a href="%url%">La imagen #%curr%</a> no pudo ser cargada.'
                },
                mainClass: 'mfp-with-zoom mfp-img-mobile',

                // --- INICIO DE MODIFICACIONES PARA BOTÓN DE CIERRE PERSONALIZADO ---
                showCloseBtn: false, // Desactivamos el botón por defecto si no funciona
                callbacks: {
                    open: function() {
                        // Añadir nuestro propio botón de cierre al contenedor del popup
                        // El contenedor del popup suele ser .mfp-wrap o .mfp-content
                        // Vamos a añadirlo al .mfp-container que es un buen lugar
                        var $closeBtn = $('<button title="Cerrar (Esc)" type="button" class="mfp-close custom-mfp-close">×</button>');
                        // 'custom-mfp-close' es una clase para nuestros estilos
                        // '×' es el carácter de la 'X'

                        // Intentar añadirlo al contenedor de la figura de la imagen
                        // o a un lugar visible consistentemente.
                        // this.content es el jQuery object del contenido actual (la imagen y su contenedor)
                        if (this.contentContainer) { // mfp-figure o similar
                            this.contentContainer.prepend($closeBtn); // Añadirlo al principio del contenedor de la imagen
                        } else {
                            $('.mfp-container').prepend($closeBtn); // Fallback al contenedor principal
                        }

                        // Asignar el evento click a nuestro botón
                        $closeBtn.on('click.customClose', function() {
                            $.magnificPopup.close();
                        });
                    },
                    close: function() {
                        // Limpiar el evento de nuestro botón si es necesario, aunque mfp-close debería ser único por instancia
                        $('.custom-mfp-close').off('click.customClose').remove();
                    }
                },
                // --- FIN DE MODIFICACIONES PARA BOTÓN DE CIERRE PERSONALIZADO ---

                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                    opener: function(openerElement) {
                        return openerElement.find('img');
                    }
                }
            });
            console.log("PROJECT-DETAIL.PHP: Magnific Popup inicializado para #galeria-proyecto-detalle (con intento de botón de cierre personalizado).");
        } else if ($galleryContainer.length && $galleryContainer.find('a.gallery-item-link').length > 0) {
            console.warn("PROJECT-DETAIL.PHP: Magnific Popup ($.fn.magnificPopup) no está definido pero hay items de galería.");
        }

        const ubicacionProyecto = <?php echo json_encode($proyecto['ubicacion'] ?? ''); ?>;
        const apiKeyGoogleMaps = 'TU_API_KEY_DE_GOOGLE_MAPS_AQUI';

        window.initProjectDetailMapGlobalCallback = function() {
            initProjectDetailMapRender(ubicacionProyecto);
        };

        function initProjectDetailMapRender(address) {
            const mapDiv = document.getElementById('project-detail-map');
            if (!mapDiv || !address || address === 'No especificada') {
                if (mapDiv) mapDiv.innerHTML = '<p class="text-muted text-center p-3">Ubicación no proporcionada o mapa no disponible.</p>';
                return;
            }
            const geocoder = new google.maps.Geocoder();
            const defaultLatLng = {
                lat: 1.2136,
                lng: -77.2811
            };
            const map = new google.maps.Map(mapDiv, {
                zoom: 15,
                center: defaultLatLng,
                mapTypeControl: false,
                streetViewControl: false
            });
            geocoder.geocode({
                'address': address + ', Nariño, Colombia'
            }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    map.setCenter(results[0].geometry.location);
                    new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        title: address
                    });
                } else {
                    console.warn('PROJECT-DETAIL.PHP: Geocode no fue exitoso para "' + address + '". Razón: ' + status + ". Usando ubicación por defecto.");
                    new google.maps.Marker({
                        map: map,
                        position: defaultLatLng,
                        title: "Ubicación por defecto"
                    });
                }
            });
        }

        if (document.getElementById('project-detail-map') && ubicacionProyecto && ubicacionProyecto !== 'No especificada' && apiKeyGoogleMaps !== 'TU_API_KEY_DE_GOOGLE_MAPS_AQUI') {
            if (typeof google === 'object' && typeof google.maps === 'object') {
                initProjectDetailMapRender(ubicacionProyecto);
            } else {
                if (!document.querySelector('script[src*="maps.googleapis.com"]')) {
                    console.log("PROJECT-DETAIL.PHP: Cargando API de Google Maps...");
                    let script = document.createElement('script');
                    script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKeyGoogleMaps}&libraries=places&callback=initProjectDetailMapGlobalCallback`;
                    script.async = true;
                    script.defer = true;
                    document.head.appendChild(script);
                } else {
                    let checkGoogleMapsReady = setInterval(function() {
                        if (typeof google === 'object' && typeof google.maps === 'object') {
                            clearInterval(checkGoogleMapsReady);
                            if (typeof window.initProjectDetailMapGlobalCallback === 'function') {
                                window.initProjectDetailMapGlobalCallback();
                            }
                        }
                    }, 500);
                    setTimeout(() => clearInterval(checkGoogleMapsReady), 5000);
                }
            }
        } else if (document.getElementById('project-detail-map') && (apiKeyGoogleMaps === 'TU_API_KEY_DE_GOOGLE_MAPS_AQUI')) {
            document.getElementById('project-detail-map').innerHTML = '<p class="text-muted text-center p-3">API Key de Google Maps no configurada.</p>';
        }
        console.log("PROJECT-DETAIL.PHP: Fin de inicializarPaginaActual().");
    }
</script>