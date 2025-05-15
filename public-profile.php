<?php
// public-profile.php

// Simular la obtención del ID del usuario a visualizar.
// En una implementación real, esto vendría de $_GET['user_id_view'] o de una variable
// establecida por tu router cuando se carga esta página dinámicamente.
// Asegúrate de SANITIZAR cualquier input del usuario.
$userIdToView = null;
if (isset($_GET['user_id_view'])) {
    $userIdToView = filter_var($_GET['user_id_view'], FILTER_SANITIZE_NUMBER_INT);
} else {
    // Manejar el caso en que no se proporciona user_id_view
    // Esto podría ser un error, o podrías intentar obtenerlo de la URL si tu router funciona diferente.
    // Por ahora, para el ejemplo, intentaremos sacar el ID si está en el query string de la URL actual.
    // Esto es una simplificación y puede que necesites una lógica más robusta aquí.
    $queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    if ($queryString) {
        parse_str($queryString, $queryParams);
        if (isset($queryParams['user_id_view'])) {
            $userIdToView = filter_var($queryParams['user_id_view'], FILTER_SANITIZE_NUMBER_INT);
        }
    }
}

if (!$userIdToView) {
    echo "<div class='container page-inner'><div class='alert alert-danger text-center'>ID de emprendedor no especificado.</div></div>";
    // Puedes incluir el script de inicialización vacío si es necesario para que el sistema no falle
    echo "<script>function inicializarPaginaActual() { console.log('PUBLIC-PROFILE.PHP: No user ID, inicialización vacía.'); }</script>";
    exit;
}


// Incluir la configuración de la base de datos
require_once __DIR__ . '/config/database.php'; // Ajusta la ruta a tu archivo de conexión

// --- Obtener datos del Emprendedor ---
$emprendedor = null;
$stmtEmprendedor = pg_prepare($conn, "get_emprendedor_profile", "SELECT * FROM usuarios WHERE id = $1 AND rol = 'Emprendedor'");
$resultEmprendedor = pg_execute($conn, "get_emprendedor_profile", array($userIdToView));

if ($resultEmprendedor && pg_num_rows($resultEmprendedor) > 0) {
    $emprendedor = pg_fetch_assoc($resultEmprendedor);

    // Valores por defecto para evitar errores si los campos están vacíos
    $emprendedor['foto_perfil_url'] = !empty(trim($emprendedor['foto_perfil_url'])) ? htmlspecialchars(trim($emprendedor['foto_perfil_url']), ENT_QUOTES, 'UTF-8') : 'assets/img/profile-signin.jpg';
    $emprendedor['foto_portada_url'] = !empty(trim($emprendedor['foto_portada_url'])) ? htmlspecialchars(trim($emprendedor['foto_portada_url']), ENT_QUOTES, 'UTF-8') : 'assets/img/emprendeya/portada.jpg'; // Un default para portada
    $emprendedor['nombre_completo'] = htmlspecialchars($emprendedor['nombre_completo'] ?? 'Emprendedor', ENT_QUOTES, 'UTF-8');
    $emprendedor['descripcion_perfil'] = !empty(trim($emprendedor['descripcion_perfil'])) ? nl2br(htmlspecialchars(trim($emprendedor['descripcion_perfil']), ENT_QUOTES, 'UTF-8')) : '<em>Este emprendedor aún no ha añadido una descripción.</em>';
    $emprendedor['municipio'] = htmlspecialchars($emprendedor['municipio'] ?? 'Ubicación no definida', ENT_QUOTES, 'UTF-8');
    $emprendedor['telefono'] = htmlspecialchars($emprendedor['telefono'] ?? '', ENT_QUOTES, 'UTF-8'); // Dejar vacío si no hay para no mostrar "N/A"
    $emprendedor['email'] = htmlspecialchars($emprendedor['email'] ?? '', ENT_QUOTES, 'UTF-8');
    // Asume que tienes columnas para redes sociales, ej: 'red_facebook', 'red_linkedin', 'red_instagram'
    $emprendedor['red_facebook'] = htmlspecialchars($emprendedor['red_facebook'] ?? '', ENT_QUOTES, 'UTF-8');
    $emprendedor['red_linkedin'] = htmlspecialchars($emprendedor['red_linkedin'] ?? '', ENT_QUOTES, 'UTF-8');
    $emprendedor['red_instagram'] = htmlspecialchars($emprendedor['red_instagram'] ?? '', ENT_QUOTES, 'UTF-8');
} else {
    echo "<div class='container page-inner'><div class='alert alert-warning text-center'>Perfil de emprendedor no encontrado o no válido.</div></div>";
    echo "<script>function inicializarPaginaActual() { console.log('PUBLIC-PROFILE.PHP: Emprendedor no encontrado, inicialización vacía.'); }</script>";
    if ($conn) {
        pg_close($conn);
    }
    exit;
}


// --- OBTENER PROYECTOS DEL EMPRENDEDOR (MODIFICADO) ---
$proyectos = [];
if (isset($conn) && $conn && isset($userIdToView)) { // $userIdToView es el ID del perfil que se está viendo
    $sql_proyectos = "SELECT 
                        p.id_proyecto, 
                        p.nombre_proyecto, 
                        p.resumen,         -- Para resumen acortado
                        p.eslogan,         -- Para mostrar eslogan
                        p.logo AS imagen_proyecto, 
                        p.sector AS categoria_proyecto, -- Alias definido aquí
                        p.etapa,
                        p.monto_inversion,
                        p.fecha_creacion,
                        p.contacto_nombre AS contacto_proyecto_nombre,  -- Contacto específico del proyecto
                        p.contacto_correo AS contacto_proyecto_email,  -- Contacto específico del proyecto
                        u.nombre_completo AS nombre_creador,            -- Nombre del creador del proyecto
                        u.email AS email_creador                       -- Email del creador (fallback)
                      FROM proyectos p
                      JOIN usuarios u ON p.usuario_id = u.id
                      WHERE p.usuario_id = $1 AND (p.estado ILIKE 'aprobado' OR p.estado ILIKE 'activo')
                      ORDER BY p.fecha_creacion DESC LIMIT 6"; 

    $stmtProyectos = pg_prepare($conn, "get_public_profile_user_projects_v3", $sql_proyectos);

    if (!$stmtProyectos) {
        error_log("PUBLIC-PROFILE.PHP: Error preparando consulta de proyectos: " . pg_last_error($conn));
    } else {
        $resultProyectos = pg_execute($conn, "get_public_profile_user_projects_v3", array($userIdToView));
        if ($resultProyectos) {
            while ($row = pg_fetch_assoc($resultProyectos)) {
                $proyecto_item = [];
                $proyecto_item['id_proyecto'] = $row['id_proyecto'];
                $proyecto_item['nombre_proyecto'] = htmlspecialchars(trim($row['nombre_proyecto'] ?? 'Proyecto sin título'), ENT_QUOTES, 'UTF-8');
                $proyecto_item['imagen_proyecto'] = !empty(trim($row['imagen_proyecto'] ?? '')) ? htmlspecialchars(trim($row['imagen_proyecto'] ?? ''), ENT_QUOTES, 'UTF-8') : 'assets/img/examples/project_default.png';
                // CORRECCIÓN AQUÍ: Usar el alias 'categoria_proyecto' de la consulta
                $proyecto_item['categoria_proyecto'] = htmlspecialchars(trim($row['categoria_proyecto'] ?? 'General'), ENT_QUOTES, 'UTF-8'); 
                $proyecto_item['etapa'] = htmlspecialchars(trim($row['etapa'] ?? 'N/A'), ENT_QUOTES, 'UTF-8');

                $eslogan_raw = trim($row['eslogan'] ?? '');
                $resumen_raw = trim($row['resumen'] ?? '');
                $proyecto_item['display_text'] = !empty($eslogan_raw) ? '"' . htmlspecialchars($eslogan_raw, ENT_QUOTES, 'UTF-8') . '"' : (!empty($resumen_raw) ? htmlspecialchars(substr($resumen_raw, 0, 100) . (strlen($resumen_raw) > 100 ? '...' : ''), ENT_QUOTES, 'UTF-8') : 'Descripción no disponible.');

                $monto_val = $row['monto_inversion'] ?? null;
                $proyecto_item['monto_inversion_formateado'] = !is_null($monto_val) && is_numeric($monto_val) ? '$' . number_format((float)$monto_val, 0, ',', '.') : 'No especificado';
                $proyecto_item['progreso_simulado'] = rand(20,95);
                
                $fecha_creacion_raw = $row['fecha_creacion'] ?? null;
                if ($fecha_creacion_raw) {
                    try { $date = new DateTime($fecha_creacion_raw); $proyecto_item['fecha_formateada'] = $date->format('d M, Y');}
                    catch (Exception $e) { $proyecto_item['fecha_formateada'] = 'Fecha Inválida'; }
                } else { $proyecto_item['fecha_formateada'] = 'N/A'; }

                $proyecto_item['nombre_creador'] = htmlspecialchars(trim($row['nombre_creador'] ?? 'Anónimo'), ENT_QUOTES, 'UTF-8');
                // Para el botón "Contactar" de la tarjeta del proyecto
                $proyecto_item['contacto_proyecto_nombre_display'] = htmlspecialchars(trim($row['contacto_proyecto_nombre'] ?? $row['nombre_creador'] ?? 'Equipo del Proyecto'), ENT_QUOTES, 'UTF-8');
                $proyecto_item['contacto_proyecto_email_display'] = htmlspecialchars(trim($row['contacto_proyecto_email'] ?? $row['email_creador'] ?? ''), ENT_QUOTES, 'UTF-8');
                
                $proyectos[] = $proyecto_item;
            }
        } else {
            error_log("PUBLIC-PROFILE.PHP: Error ejecutando consulta de proyectos para user ID {$userIdToView}: " . pg_last_error($conn));
        }
    }
}
?>

<style>
    /* Estilos específicos para public-profile.php para asegurar encapsulación y diseño profesional */
    .public-profile-page .profile-cover {
        height: 300px;
        background-size: cover;
        background-position: center;
        border-radius: 0.75rem 0.75rem 0 0;
        /* Kaiadmin usa .card con border-radius */
        position: relative;
    }

    .public-profile-page .profile-avatar-wrapper {
        margin-top: -75px;
        /* La mitad del tamaño del avatar grande */
        text-align: center;
        position: relative;
        z-index: 10;
    }

    .public-profile-page .profile-avatar-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fff;
        /* Borde blanco como en Kaiadmin */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .public-profile-page .profile-main-info {
        text-align: center;
        padding-top: 1rem;
        padding-bottom: 1.5rem;
    }

    .public-profile-page .profile-name {
        font-size: 2rem;
        font-weight: 600;
        color: #333;
        /* O tu color de texto principal */
        margin-bottom: 0.25rem;
    }

    .public-profile-page .profile-role,
    .public-profile-page .profile-location {
        font-size: 1rem;
        color: #6c757d;
        /* text-muted de Bootstrap */
        margin-bottom: 0.25rem;
    }

    .public-profile-page .profile-location i {
        margin-right: 0.3rem;
    }

    .public-profile-page .profile-short-bio {
        font-size: 0.95rem;
        color: #495057;
        max-width: 700px;
        margin: 0.5rem auto 1.5rem auto;
        line-height: 1.6;
    }

    .public-profile-page .profile-social-links a {
        font-size: 1.5rem;
        margin: 0 0.5rem;
        color: #555;
        transition: color 0.3s ease;
    }

    .public-profile-page .profile-social-links a:hover {
        color: var(--kai-primary);
        /* Usar variable de color primario del tema */
    }

    .public-profile-page .nav-pills .nav-link {
        font-weight: 500;
    }
    
   


    /* Estilos para las tarjetas de proyecto */
    .public-profile-page .project-card {
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 0.75rem;
        /* Consistente con Kaiadmin */
        overflow: hidden;
        /* Para que la imagen no se salga del borde redondeado */
    }

    .public-profile-page .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .public-profile-page .project-card .card-img-top {
        height: 180px;
        object-fit: cover;
    }

    .public-profile-page .project-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .public-profile-page .project-card .card-category {
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--kai-primary);
        /* O el color que prefieras para la categoría */
    }

    .public-profile-page .project-card .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Contacto */
    .public-profile-page .contact-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .public-profile-page .contact-info-item i {
        font-size: 1.2rem;
        color: var(--kai-primary);
        margin-right: 1rem;
        width: 20px;
        /* Alineación de iconos */
        text-align: center;
    }

    /* Animación de entrada */
    .public-profile-page .animated-section {
        animation: fadeInUPKai 0.8s ease-out;
    }

    @keyframes fadeInUPKai {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="public-profile-page page-inner">
    <!-- Contenedor principal del perfil -->
    <div class="card shadow-lg mb-4 animated-section" style="border-radius: 0.75rem;">
        <!-- Imagen de Portada -->
        <div class="profile-cover" style="background-image: url('<?php echo $emprendedor['foto_portada_url']; ?>');">
            <!-- Podrías añadir un botón para cambiar portada si el usuario es dueño del perfil -->
        </div>

        <!-- Avatar e Información Básica -->
        <div class="card-body">
            <div class="profile-avatar-wrapper">
                <img src="<?php echo $emprendedor['foto_perfil_url']; ?>" alt="Foto de perfil de <?php echo $emprendedor['nombre_completo']; ?>" class="profile-avatar-img">
            </div>

            <div class="profile-main-info">
                <h1 class="profile-name"><?php echo $emprendedor['nombre_completo']; ?></h1>
                <p class="profile-role text-primary fw-medium">Emprendedor</p>
                <?php if ($emprendedor['municipio'] !== 'Ubicación no definida'): ?>
                    <p class="profile-location"><i class="fas fa-map-marker-alt"></i> <?php echo $emprendedor['municipio']; ?>, Nariño</p>
                <?php endif; ?>
                
                <div class="profile-social-links mt-3">
                    <?php if (!empty($emprendedor['red_facebook'])): ?>
                        <a href="<?php echo $emprendedor['red_facebook']; ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-square"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($emprendedor['red_linkedin'])): ?>
                        <a href="<?php echo $emprendedor['red_linkedin']; ?>" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($emprendedor['red_instagram'])): ?>
                        <a href="<?php echo $emprendedor['red_instagram']; ?>" target="_blank" title="Instagram"><i class="fab fa-instagram-square"></i></a>
                    <?php endif; ?>
                    <!-- Podrías añadir más redes o un sitio web aquí -->
                </div>
            </div>
        </div>
    </div>

    <!-- Pestañas de Navegación y Contenido -->
    <div class="row">
        <div class="col-md-12">
            <div class="card animated-section" style="animation-delay: 0.2s;">
                <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd justify-content-center" id="public-profile-pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-about-tab" data-bs-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="true"><i class="fas fa-user-alt me-1"></i>Sobre Mí</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-projects-tab-link" data-bs-toggle="pill" href="#pills-projects" role="tab" aria-controls="pills-projects" aria-selected="false"><i class="fas fa-project-diagram me-1"></i>Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-address-book me-1"></i>Contacto</a>
                        </li>
                        <!-- BOTÓN CHAT AÑADIDO -->
                                                  
                        <li class="nav-item">
                            <a class=" nav-link btn-success" 
                               href="#"
                               data-bs-toggle="modal"
                               data-bs-target="#chatModal"
                               data-recipient-name="<?php echo htmlspecialchars($emprendedor['nombre_completo'], ENT_QUOTES, 'UTF-8'); ?>"
                               data-recipient-id="<?php echo htmlspecialchars($userIdToView, ENT_QUOTES, 'UTF-8'); ?>"
                               data-recipient-email="<?php echo htmlspecialchars($emprendedor['email'], ENT_QUOTES, 'UTF-8'); ?>"
                               title="Chatear con <?php echo htmlspecialchars($emprendedor['nombre_completo'], ENT_QUOTES, 'UTF-8'); ?>">
                               <i class="fas fa-comments me-1"></i> CHAT
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="pills-gallery-tab" data-bs-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-gallery" aria-selected="false"><i class="fas fa-images me-1"></i>Galería</a>
                        </li> -->
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content mt-2 mb-3" id="public-profile-pills-tabContent">
                        <!-- Pestaña: Sobre Mí -->
                        <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                            <h4 class="card-title mb-3">Biografía de <?php echo explode(' ', $emprendedor['nombre_completo'])[0]; ?></h4>
                            <div class="text-muted lh-lg">
                                <?php echo $emprendedor['descripcion_perfil']; ?>
                            </div>
                            
                        </div>

                        <!-- CORRECCIÓN: ID del panel y aria-labelledby -->
                        <div class="tab-pane fade" id="pills-projects" role="tabpanel" aria-labelledby="pills-projects-tab-link">
                            <h4 class="card-title mb-4">Proyectos de <?php echo explode(' ', $emprendedor['nombre_completo'])[0]; ?></h4>
                            <?php if (!empty($proyectos)): ?>
                                <div class="row">
                                    <?php foreach ($proyectos as $proyecto_item): ?>
                                        <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                                            <div class="card project-card h-100 shadow-sm">
                                                <img src="<?php echo $proyecto_item['imagen_proyecto']; ?>" class="card-img-top" alt="Imagen de <?php echo $proyecto_item['nombre_proyecto']; ?>" style="height: 180px; object-fit: contain; padding:10px; background-color:#f8f9fa;">
                                                <div class="card-body d-flex flex-column p-3">
                                                    <span class="badge bg-info text-white mb-2 align-self-start" style="font-size: 0.75rem;"><?php echo $proyecto_item['categoria_proyecto']; ?></span>
                                                    <h5 class="card-title mt-1" style="min-height: 40px;">
                                                        <!-- Botón/Enlace VER PROYECTO (usa menu-link) -->
                                                        <a href="#" class="text-dark menu-link stretched-link"
                                                            data-page="project-detail&id_proyecto=<?php echo $proyecto_item['id_proyecto']; ?>"
                                                            title="Ver detalles de <?php echo $proyecto_item['nombre_proyecto']; ?>">
                                                            <?php echo $proyecto_item['nombre_proyecto']; ?>
                                                        </a>
                                                    </h5>
                                                    <p class="card-text text-muted small mb-1" style="font-size:0.8rem;">Etapa: <?php echo $proyecto_item['etapa']; ?></p>
                                                    <p class="card-text text-muted small flex-grow-1 fst-italic" style="font-size:0.85rem; min-height: 50px;">
                                                        <?php echo $proyecto_item['display_text']; // Eslogan o resumen acortado 
                                                        ?>
                                                    </p>
                                                    <p class="card-text mb-3"><small class="text-muted">Meta: <?php echo $proyecto_item['monto_inversion_formateado']; ?></small></p>

                                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                                        <a href="#" class="btn btn-sm btn-primary btn-round menu-link"
                                                            data-page="project-detail&id_proyecto=<?php echo $proyecto_item['id_proyecto']; ?>">
                                                            <i class="fas fa-eye me-1"></i> Ver Proyecto
                                                        </a>
                                                        <!-- Botón CONTACTAR (abre el modal #chatModal que ya tienes) -->
                                                        <button type="button" class="btn btn-sm btn-outline-success btn-round btn-chat-on-public-profile"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#chatModal"
                                                            data-project-name="<?php echo htmlspecialchars($proyecto_item['nombre_proyecto'], ENT_QUOTES, 'UTF-8'); ?>"
                                                            data-contact-name="<?php echo $proyecto_item['contacto_proyecto_nombre_display']; ?>"
                                                            data-owner-email="<?php echo $proyecto_item['contacto_proyecto_email_display']; ?>"
                                                            data-project-id="<?php echo $proyecto_item['id_proyecto']; ?>">
                                                            <i class="fas fa-comments me-1"></i> Contactar
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-footer bg-lightsmall border-top-0 pt-2 pb-2 px-3 text-center">
                                                    <small class="text-muted d-block" style="font-size:0.75rem;"><i class="fas fa-user me-1"></i>Por: <?php echo $proyecto_item['nombre_creador']; ?></small>
                                                    <!-- No tenemos fecha del proyecto aquí, pero podrías añadirla si la seleccionas -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php if (count($proyectos) >= 6): /* ... tu lógica para "Ver todos" ... */ endif; ?>
                            <?php else: ?>
                                <p class="text-center text-muted py-4">Este emprendedor aún no ha publicado proyectos visibles.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Pestaña: Contacto -->
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <h4 class="card-title mb-3">Información de Contacto</h4>
                            <?php if (!empty($emprendedor['email'])): ?>
                                <div class="contact-info-item">
                                    <i class="fas fa-envelope"></i>
                                    <span><?php echo $emprendedor['email']; ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($emprendedor['telefono'])): ?>
                                <div class="contact-info-item">
                                    <i class="fas fa-phone"></i>
                                    <span><?php echo $emprendedor['telefono']; ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($emprendedor['municipio'] !== 'Ubicación no definida'): ?>
                                <div class="contact-info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo $emprendedor['municipio']; ?>, Nariño, Colombia</span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($emprendedor['red_facebook']) || !empty($emprendedor['red_linkedin']) || !empty($emprendedor['red_instagram'])): ?>
                                <hr class="my-4">
                                <h5 class="card-title mb-3">Redes Sociales</h5>
                                <?php if (!empty($emprendedor['red_facebook'])): ?>
                                    <div class="contact-info-item">
                                        <i class="fab fa-facebook"></i>
                                        <a href="<?php echo $emprendedor['red_facebook']; ?>" target="_blank"><?php echo $emprendedor['red_facebook']; ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($emprendedor['red_linkedin'])): ?>
                                    <div class="contact-info-item">
                                        <i class="fab fa-linkedin"></i>
                                        <a href="<?php echo $emprendedor['red_linkedin']; ?>" target="_blank"><?php echo $emprendedor['red_linkedin']; ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($emprendedor['red_instagram'])): ?>
                                    <div class="contact-info-item">
                                        <i class="fab fa-instagram"></i>
                                        <a href="<?php echo $emprendedor['red_instagram']; ?>" target="_blank"><?php echo $emprendedor['red_instagram']; ?></a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <!-- Botón para contactar (si tienes sistema de mensajería) -->
                            <!--
                            <hr class="my-4">
                            <button class="btn btn-primary btn-lg btn-round"><i class="fas fa-paper-plane me-2"></i> Enviar Mensaje</button>
                            -->
                        </div>

                        <!-- Pestaña: Galería (Opcional) -->
                        <!-- 
                        <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                            <h4 class="card-title mb-3">Galería de Imágenes</h4>
                            <div class="row image-gallery"> -->
                        <!-- Ejemplo de item de galería, necesitarías un loop con las imágenes del emprendedor -->
                        <!-- <a href="assets/img/examples/example1.jpeg" class="col-6 col-md-4 col-lg-3 mb-4">
                                    <img src="assets/img/examples/example1-300x300.jpg" class="img-fluid rounded shadow-sm">
                                </a>
                                <a href="assets/img/examples/example2.jpeg" class="col-6 col-md-4 col-lg-3 mb-4">
                                    <img src="assets/img/examples/example2-300x300.jpg" class="img-fluid rounded shadow-sm">
                                </a> -->
                        <!-- Añadir más imágenes -->
                        <!-- </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script específico para public-profile.php -->
<script>
    function inicializarPaginaActual() {
        console.log("PUBLIC-PROFILE.PHP: inicializarPaginaActual() ejecutada.");

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // --- Lógica para el Modal de Contacto Genérico (#chatModal) ---
        // Este listener se adjunta al documento para capturar clics en botones que abren el modal,
        // ya sea para contactar al emprendedor directamente desde su perfil o sobre un proyecto específico.

        // Listener para el botón de chat/contacto en el perfil del EMPRENDEDOR (incluye el nuevo botón en la barra de pestañas)
        $('.btn-chat-emprendedor').off('click.contactEmprendedor').on('click.contactEmprendedor', function() {
            const recipientName = $(this).data('recipient-name');
            const recipientId = $(this).data('recipient-id'); // ID del emprendedor (userIdToView)
            const recipientEmail = $(this).data('recipient-email');

            $('#chatModalTitle').text('Enviar Mensaje a ' + recipientName); // Asume que el modal tiene un título con este ID
            // Poblar campos ocultos en el formulario del modal #chatModal si los tienes
            // Ejemplo:
            // $('#chatModalForm #chatRecipientId').val(recipientId);
            // $('#chatModalForm #chatRecipientEmail').val(recipientEmail);
            // $('#chatModalForm #chatContextProjectId').val(''); // No hay contexto de proyecto aquí

            // Limpiar campos del mensaje
            $('#chatModal').find('textarea').val(''); // Asume que el textarea está en #chatModal

            // Obtener y pre-llenar info del remitente (usuario logueado)
            const senderNameFromSession = "<?php echo htmlspecialchars($_SESSION['user_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>";
            const senderEmailFromSession = "<?php echo htmlspecialchars($_SESSION['user_email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>";
            // $('#chatModalForm #chatSenderName').val(senderNameFromSession); // Si tienes estos campos
            // $('#chatModalForm #chatSenderEmail').val(senderEmailFromSession);

            console.log(`PUBLIC-PROFILE.PHP: Abriendo chat modal para EMPRENDEDOR: ${recipientName}, ID: ${recipientId}, Email: ${recipientEmail}`);
        });

        // Listener para los botones de chat/contacto en las TARJETAS DE PROYECTO
        // CORRECCIÓN: Selector del contenedor de pestaña y clase del botón
        $('#pills-projects').off('click.contactProjectCard').on('click.contactProjectCard', '.btn-chat-on-public-profile', function() {
            const projectName = $(this).data('project-name');
            const contactName = $(this).data('contact-name'); // Nombre de contacto del proyecto
            const ownerEmail = $(this).data('owner-email'); // Email de contacto del proyecto
            const projectIdContext = $(this).data('project-id');

            $('#chatModalTitle').text('Contactar sobre: ' + projectName); // Asume que el modal tiene un título con este ID
            // Poblar campos ocultos en el formulario del modal #chatModal
            // Ejemplo:
            // $('#chatModalForm #chatRecipientId').val(''); // Puede que no necesites el ID del dueño aquí si envías al email del proyecto
            // $('#chatModalForm #chatRecipientEmail').val(ownerEmail);
            // $('#chatModalForm #chatContextProjectId').val(projectIdContext);

            // Limpiar campos del mensaje
            $('#chatModal').find('textarea').val(''); // Asume que el textarea está en #chatModal

            // Obtener y pre-llenar info del remitente
            const senderNameFromSession = "<?php echo htmlspecialchars($_SESSION['user_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>";
            const senderEmailFromSession = "<?php echo htmlspecialchars($_SESSION['user_email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>";
            // $('#chatModalForm #chatSenderName').val(senderNameFromSession);
            // $('#chatModalForm #chatSenderEmail').val(senderEmailFromSession);

            console.log(`PUBLIC-PROFILE.PHP: Abriendo chat modal para PROYECTO: ${projectName}, Contacto: ${contactName}, Email: ${ownerEmail}, ProyectoID: ${projectIdContext}`);
        });


        // Listener para el envío del formulario del modal #chatModal
        // Este listener debería ser ÚNICO en toda tu aplicación si el ID del form es siempre el mismo
        // o asegúrate de que se adjunte correctamente y una sola vez.
        const $chatModalForm = $('#chatModal').find('form'); // Encuentra el form dentro de #chatModal
        if ($chatModalForm.length && (typeof $._data === 'function' ? !$._data($chatModalForm[0], 'events')?.submit : true)) {
            $chatModalForm.off('submit.publicProfileChat').on('submit.publicProfileChat', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                const $submitButton = $(this).find('button[type="submit"]');

                console.log("PUBLIC-PROFILE.PHP: Enviando mensaje desde #chatModal (simulación)... Datos:", formData);
                $submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Enviando...');

                // AQUÍ VA TU LLAMADA AJAX A UN SCRIPT PHP QUE ENVÍE EL EMAIL/MENSAJE
                // Ejemplo:
                /*
                $.ajax({
                    url: 'backend-php/send_chat_message.php', // Necesitas crear este script
                    type: 'POST',
                    data: formData, // Incluiría los campos ocultos con recipient_email, project_id, etc.
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showAlertGloballyPublicProfile('success', '¡Mensaje Enviado!', response.message || 'Tu mensaje ha sido enviado.');
                            bootstrap.Modal.getInstance(document.getElementById('chatModal'))?.hide();
                        } else {
                            showAlertGloballyPublicProfile('error', 'Error', response.message || 'No se pudo enviar el mensaje.');
                        }
                    },
                    error: function() { showAlertGloballyPublicProfile('error', 'Error', 'Error de conexión al enviar el mensaje.'); },
                    complete: function() { $submitButton.prop('disabled', false).html('Enviar'); }
                });
                */
                // Simulación por ahora:
                setTimeout(function() {
                    if (typeof showAlertGloballyPublicProfile === 'function') { // Verifica si la func de alerta existe
                        showAlertGloballyPublicProfile('success', 'Simulación', 'Mensaje enviado (simulado). El backend para esto debe ser implementado.');
                    } else {
                        alert('Mensaje enviado (simulado).');
                    }
                    bootstrap.Modal.getInstance(document.getElementById('chatModal'))?.hide();
                    $submitButton.prop('disabled', false).html('Enviar');
                }, 1000);
            });
        }

        // Función de alerta específica para esta página para evitar conflictos si es necesario
        function showAlertGloballyPublicProfile(type, title, message) {
            if (typeof swal === 'function') {
                swal({
                    icon: type,
                    title: title,
                    text: message,
                    buttons: {
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "btn btn-primary",
                            closeModal: true
                        }
                    },
                    timer: type === 'success' ? 2500 : 4000
                });
            } else {
                console.warn("SweetAlert (swal) no está definido en public-profile. Usando alert().");
                alert(title + ": " + message);
            }
        }

        // Inicializar Magnific Popup para la galería (si se usa la pestaña de galería)
        if (document.querySelector('.image-gallery')) {
            if (typeof $.fn.magnificPopup === 'function') {
                $('.image-gallery').magnificPopup({
                    delegate: 'a', // child items selector, by clicking on it popup will open
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    mainClass: 'mfp-with-zoom', // Funciona con animate.css
                    zoom: {
                        enabled: true,
                        duration: 300,
                        easing: 'ease-in-out',
                        opener: function(openerElement) {
                            return openerElement.is('img') ? openerElement : openerElement.find('img');
                        }
                    }
                });
                console.log("PUBLIC-PROFILE.PHP: Magnific Popup inicializado para .image-gallery");
            } else {
                console.warn("PUBLIC-PROFILE.PHP: Magnific Popup ($.fn.magnificPopup) no está definido. Asegúrate que el plugin esté cargado en index.php.");
            }
        }

        // Activar tooltips si hay alguno en esta página
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Podrías añadir más inicializaciones específicas si las necesitas, por ejemplo, para un mapa si muestras ubicación exacta.

        console.log("PUBLIC-PROFILE.PHP: Fin de inicializarPaginaActual().");
    }
</script>