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
    if ($conn) { pg_close($conn); }
    exit;
}

// --- Obtener Proyectos del Emprendedor (Ejemplo) ---
$proyectos = [];
// Debes tener una tabla 'proyectos' con una columna 'usuario_id' que referencie al emprendedor
$stmtProyectos = pg_prepare($conn, "get_emprendedor_proyectos", "SELECT id_proyecto, nombre_proyecto, descripcion_corta, imagen_principal_url, categoria FROM proyectos WHERE usuario_id = $1 ORDER BY fecha_creacion DESC LIMIT 6");
$resultProyectos = pg_execute($conn, "get_emprendedor_proyectos", array($userIdToView));

if ($resultProyectos) {
    while ($row = pg_fetch_assoc($resultProyectos)) {
        $row['imagen_principal_url'] = !empty(trim($row['imagen_principal_url'])) ? htmlspecialchars(trim($row['imagen_principal_url']), ENT_QUOTES, 'UTF-8') : 'assets/img/examples/example_project1.jpg'; // Default para imagen de proyecto
        $row['nombre_proyecto'] = htmlspecialchars($row['nombre_proyecto'] ?? 'Proyecto sin nombre', ENT_QUOTES, 'UTF-8');
        $row['descripcion_corta'] = htmlspecialchars(substr($row['descripcion_corta'] ?? '', 0, 100) . '...', ENT_QUOTES, 'UTF-8'); // Acortar descripción
        $row['categoria'] = htmlspecialchars($row['categoria'] ?? 'General', ENT_QUOTES, 'UTF-8');
        $proyectos[] = $row;
    }
}

if ($conn) {
    pg_close($conn);
}
?>

<style>
    /* Estilos específicos para public-profile.php para asegurar encapsulación y diseño profesional */
    .public-profile-page .profile-cover {
        height: 300px;
        background-size: cover;
        background-position: center;
        border-radius: 0.75rem 0.75rem 0 0; /* Kaiadmin usa .card con border-radius */
        position: relative;
    }

    .public-profile-page .profile-avatar-wrapper {
        margin-top: -75px; /* La mitad del tamaño del avatar grande */
        text-align: center;
        position: relative;
        z-index: 10;
    }

    .public-profile-page .profile-avatar-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fff; /* Borde blanco como en Kaiadmin */
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    .public-profile-page .profile-main-info {
        text-align: center;
        padding-top: 1rem;
        padding-bottom: 1.5rem;
    }

    .public-profile-page .profile-name {
        font-size: 2rem;
        font-weight: 600;
        color: #333; /* O tu color de texto principal */
        margin-bottom: 0.25rem;
    }

    .public-profile-page .profile-role,
    .public-profile-page .profile-location {
        font-size: 1rem;
        color: #6c757d; /* text-muted de Bootstrap */
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
        color: var(--kai-primary); /* Usar variable de color primario del tema */
    }

    .public-profile-page .nav-pills .nav-link {
        font-weight: 500;
    }

    /* Estilos para las tarjetas de proyecto */
    .public-profile-page .project-card {
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 0.75rem; /* Consistente con Kaiadmin */
        overflow: hidden; /* Para que la imagen no se salga del borde redondeado */
    }
    .public-profile-page .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
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
        color: var(--kai-primary); /* O el color que prefieras para la categoría */
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
        width: 20px; /* Alineación de iconos */
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
                <p class="profile-short-bio">
                    <?php 
                    // Mostrar una versión más corta de la descripción aquí, si la descripción completa es muy larga
                    $descripcionCorta = strip_tags($emprendedor['descripcion_perfil']); // Quitar HTML por si acaso
                    echo substr($descripcionCorta, 0, 180) . (strlen($descripcionCorta) > 180 ? '...' : ''); 
                    ?>
                </p>
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
                            <a class="nav-link" id="pills-projects-tab" data-bs-toggle="pill" href="#pills-projects" role="tab" aria-controls="pills-projects" aria-selected="false"><i class="fas fa-project-diagram me-1"></i>Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-address-book me-1"></i>Contacto</a>
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
                            <!-- Podrías añadir secciones como Habilidades, Experiencia, Educación aquí -->
                            <!-- Ejemplo Habilidades -->
                            <!--
                            <hr class="my-4">
                            <h5 class="card-title mb-3">Habilidades Principales</h5>
                            <span class="badge bg-primary text-white me-1 mb-1 p-2">Desarrollo Web</span>
                            <span class="badge bg-success text-white me-1 mb-1 p-2">Marketing Digital</span>
                            <span class="badge bg-info text-white me-1 mb-1 p-2">Gestión de Proyectos</span>
                            <span class="badge bg-warning text-dark me-1 mb-1 p-2">Diseño Gráfico</span>
                            -->
                        </div>

                        <!-- Pestaña: Proyectos -->
                        <div class="tab-pane fade" id="pills-projects" role="tabpanel" aria-labelledby="pills-projects-tab">
                            <h4 class="card-title mb-4">Proyectos Destacados</h4>
                            <?php if (!empty($proyectos)): ?>
                                <div class="row">
                                    <?php foreach ($proyectos as $proyecto): ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card project-card">
                                                <img src="<?php echo $proyecto['imagen_principal_url']; ?>" class="card-img-top" alt="Imagen de <?php echo $proyecto['nombre_proyecto']; ?>">
                                                <div class="card-body">
                                                    <p class="card-category text-info mb-1"><?php echo $proyecto['categoria']; ?></p>
                                                    <h5 class="card-title">
                                                        <a href="index.php?page=project-detail&id_proyecto=<?php echo $proyecto['id_proyecto']; ?>" class="text-dark stretched-link menu-link" data-page="project-detail&id_proyecto=<?php echo $proyecto['id_proyecto']; ?>">
                                                            <?php echo $proyecto['nombre_proyecto']; ?>
                                                        </a>
                                                    </h5>
                                                    <p class="card-text"><?php echo $proyecto['descripcion_corta']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php if (count($proyectos) > 5): // O si tienes una forma de saber si hay más proyectos ?>
                                <div class="text-center mt-3">
                                    <a href="index.php?page=all-projects-by-user&user_id=<?php echo $userIdToView; ?>" class="btn btn-outline-primary btn-round menu-link" data-page="all-projects-by-user&user_id=<?php echo $userIdToView; ?>">
                                        Ver Todos los Proyectos
                                    </a>
                                </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <p class="text-center text-muted">Este emprendedor aún no ha publicado proyectos.</p>
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
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Podrías añadir más inicializaciones específicas si las necesitas, por ejemplo, para un mapa si muestras ubicación exacta.

    console.log("PUBLIC-PROFILE.PHP: Fin de inicializarPaginaActual().");
}
</script>