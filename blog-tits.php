<div class="container">
    <!-- CONTENEDOR PRINCIPAL DE LA PÁGINA DEL BLOG DE EMPRENDIMIENTOS -->
   
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Blog de Emprendimientos</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="#">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Blog</a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Gestión de Posts</a>
                        </li>
                    </ul>
                </div>

                <!-- Widgets de Resumen del Blog -->
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total de Posts</p>
                                            <h4 class="card-title" id="statsTotalPosts">0</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Publicados</p>
                                            <h4 class="card-title" id="statsPublishedPosts">0</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Borradores</p>
                                            <h4 class="card-title" id="statsDraftPosts">0</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-danger bubble-shadow-small">
                                            <i class="fas fa-archive"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Archivados</p>
                                            <h4 class="card-title" id="statsArchivedPosts">0</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Listado de Posts del Blog</h4>
                                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addPostModal">
                                        <i class="fa fa-plus"></i>
                                        Agregar Nuevo Post
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal para Agregar/Editar Post -->
                                <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold" id="modalPostTitlePrefix">Nuevo</span>
                                                    <span class="fw-light">Post del Blog</span>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small">Completa el formulario para crear o editar un post.</p>
                                                <form id="postForm">
                                                    <input type="hidden" id="postId">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group form-group-default">
                                                                <label>Título del Post</label>
                                                                <input id="postTitulo" type="text" class="form-control" placeholder="Escribe el título" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>Autor</label>
                                                                <input id="postAutor" type="text" class="form-control" placeholder="Nombre del autor" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>Categoría</label>
                                                                <select id="postCategoria" class="form-control form-select" required>
                                                                    <option value="">Selecciona una categoría</option>
                                                                    <option value="Marketing Digital">Marketing Digital</option>
                                                                    <option value="Finanzas para Emprendedores">Finanzas para Emprendedores</option>
                                                                    <option value="Innovación y Tecnología">Innovación y Tecnología</option>
                                                                    <option value="Gestión de Equipos">Gestión de Equipos</option>
                                                                    <option value="Casos de Éxito">Casos de Éxito</option>
                                                                    <option value="Legal y Cumplimiento">Legal y Cumplimiento</option>
                                                                    <option value="Desarrollo Personal">Desarrollo Personal</option>
                                                                    <option value="Productividad">Productividad</option>
                                                                    <option value="Ventas">Ventas</option>
                                                                    <option value="Noticias del Sector">Noticias del Sector</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>Estado</label>
                                                                <select id="postEstado" class="form-control form-select" required>
                                                                    <option value="Borrador">Borrador</option>
                                                                    <option value="Publicado">Publicado</option>
                                                                    <option value="Archivado">Archivado</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>URL Imagen Destacada (Opcional)</label>
                                                                <input id="postImagenURL" type="url" class="form-control" placeholder="https://ejemplo.com/imagen.jpg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Extracto (Resumen corto)</label>
                                                                <textarea id="postExtracto" class="form-control" rows="3" placeholder="Escribe un resumen breve del post" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Contenido Completo del Post</label>
                                                                <textarea id="postContenido" class="form-control" rows="10" placeholder="Escribe el contenido detallado del post. Puedes usar HTML básico." required></textarea>
                                                                <small class="form-text text-muted">Puedes usar etiquetas HTML básicas como <p>, <br>, <strong>, <em>, <ul>, <li>, <h4>.</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" id="savePostButton" class="btn btn-primary">Guardar Post</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal para Ver Post -->
                                <div class="modal fade" id="viewPostModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">Detalle del</span>
                                                    <span class="fw-light">Post</span>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h3 id="viewPostTitulo" class="fw-bold mb-3"></h3>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <p class="mb-1"><strong>Categoría:</strong> <span id="viewPostCategoria" class="badge bg-info"></span></p>
                                                        <p class="mb-1"><strong>Autor:</strong> <span id="viewPostAutor"></span></p>
                                                    </div>
                                                    <div class="col-md-6 text-md-end">
                                                        <p class="mb-1"><strong>Fecha de Publicación:</strong> <span id="viewPostFecha"></span></p>
                                                        <p class="mb-1"><strong>Estado:</strong> <span id="viewPostEstado" class="badge"></span></p>
                                                    </div>
                                                </div>
                                                
                                                <div id="viewPostImagenContainer" class="text-center mb-4" style="display:none;">
                                                    <img id="viewPostImagen" src="" alt="Imagen Destacada" class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                                                </div>
                                                
                                                <h5 class="fw-semibold mt-4">Extracto:</h5>
                                                <p id="viewPostExtracto" class="text-muted fst-italic"></p>
                                                <hr>
                                                <h5 class="fw-semibold">Contenido Completo:</h5>
                                                <div id="viewPostContenido" class="post-content-view" style="white-space: pre-wrap; max-height: 500px; overflow-y: auto; border: 1px solid #eee; padding: 15px; border-radius: 5px; background-color: #f9f9f9;"></div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="postsTable" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Título</th>
                                                <th>Categoría</th>
                                                <th>Autor</th>
                                                <th>Fecha Pub.</th>
                                                <th>Estado</th>
                                                <th style="width: 15%">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Los datos se cargarán aquí por JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN CONTENIDO PRINCIPAL -->        
    
</div> <!-- End Wrapper -->

    <!-- CONTENDOR BLOG -->

        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Detalle del Tip Legal</h3>
            </div>

            <div class="row">
                <!-- Columna Principal del Contenido del Post -->
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h2 class="fw-bold mb-1" id="postMainTitle">[Título Atractivo del Post Aquí]</h2>
                            </div>
                            <div class="card-category">
                                <span class="badge bg-info me-2" id="postCategory">[Categoría]</span>
                                Publicado el: <span id="postDate">[Fecha de Publicación]</span>
                                <!-- Podrías agregar el autor si lo tuvieras: Por: <span id="postAuthor">Admin</span> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Imagen Destacada (Opcional) -->
                            <div class="mb-4 text-center">
                                <img src="assets/img/blogpost.jpg" alt="Imagen Destacada del Post"
                                    class="img-fluid rounded shadow" id="postFeaturedImage"
                                    style="max-height: 400px; object-fit: cover;">
                                <!-- Podrías usar un placeholder si no hay imagen:
                            <img src="https://via.placeholder.com/750x350.png?text=Imagen+Destacada" alt="Imagen Destacada" class="img-fluid rounded">
                            -->
                            </div>

                            <!-- Introducción -->
                            <div class="mb-4" id="postIntroduction">
                                <p class="fs-5 text-muted">
                                    [Aquí va la introducción que engancha al lector. Debe ser concisa y presentar el
                                    tema
                                    principal del post, despertando el interés para seguir leyendo.]
                                </p>
                            </div>
                            <hr class="my-4">

                            <!-- Cuerpo del Post -->
                            <div id="postBodyContent">
                                <h4 class="fw-semibold mt-4 mb-3">[Subtítulo 1: Claro y Descriptivo]</h4>
                                <p>Párrafos cortos y fáciles de leer. Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo
                                    consequat.</p>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                    fugiat
                                    nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                    officia deserunt mollit anim id est laborum.</p>

                                <!-- Ejemplo de imagen dentro del cuerpo -->
                                <div class="my-4 text-center">
                                    <figure class="figure">
                                        <img src="https://via.placeholder.com/600x300.png?text=Imagen+Ilustrativa"
                                            class="figure-img img-fluid rounded" alt="Imagen ilustrativa del contenido">
                                        <figcaption class="figure-caption text-center">Una breve descripción de la
                                            imagen si
                                            es necesario.</figcaption>
                                    </figure>
                                </div>

                                <h4 class="fw-semibold mt-4 mb-3">[Subtítulo 2: Continuando el Desarrollo del Tema]</h4>
                                <p>Otro párrafo corto. Puntos clave pueden ir en listas:</p>
                                <ul>
                                    <li>Punto clave número uno.</li>
                                    <li>Punto clave número dos, explicando un poco más.</li>
                                    <li>Punto clave número tres.</li>
                                </ul>
                                <p>Recuerda usar negritas para resaltar ideas importantes o palabras clave. El objetivo
                                    es
                                    mantener al lector involucrado y facilitar la comprensión del contenido.</p>

                                <blockquote class="blockquote mt-4 p-3 bg-light border-start border-4 border-primary">
                                    <p class="mb-0">"Una cita relevante o un consejo destacado puede ir aquí para romper
                                        la
                                        monotonía y añadir valor."</p>
                                    <footer class="blockquote-footer mt-1">Fuente de la cita o <cite
                                            title="Source Title">Nombre del Autor</cite></footer>
                                </blockquote>

                                <h4 class="fw-semibold mt-4 mb-3">[Subtítulo 3: Profundizando o Concluyendo Aspectos]
                                </h4>
                                <p>Últimos párrafos antes de la conclusión general. Asegúrate de que el flujo de
                                    información
                                    sea lógico y coherente. Utiliza transiciones suaves entre las ideas.</p>
                            </div>
                            <hr class="my-4">

                            <!-- Conclusión del Post -->
                            <div class="mt-4 mb-4" id="postConclusion">
                                <h3 class="fw-semibold">Conclusión</h3>
                                <p>
                                    [Resume los puntos más importantes del post. Refuerza el mensaje principal y ofrece
                                    una
                                    reflexión final. Este es el momento de cerrar las ideas presentadas.]
                                </p>
                            </div>

                            <!-- Llamado a la Acción (Call to Action) -->
                            <div class="text-center p-4 my-4 bg-primary-gradient text-white rounded shadow-lg"
                                id="postCallToAction">
                                <h4 class="fw-bold mb-3">¿Listo para el Siguiente Paso?</h4>
                                <p class="mb-3">
                                    [Invita al lector a realizar una acción específica: dejar un comentario (si aplica),
                                    contactar para más información, descargar un recurso, visitar otra página, etc.]
                                </p>
                                <a href="#" class="btn btn-light btn-lg btn-round fw-bold">
                                    ¡Contáctanos Ahora! <i class="fas fa-arrow-circle-right ms-2"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Columna Lateral de Widgets -->
                <div class="col-lg-4 col-md-12">
                    <!-- Widget: Buscar en el Blog -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-search me-2"></i>Buscar en el Blog</h4>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" placeholder="Escribe y presiona Enter..." class="form-control">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Widget: Perfil del Autor/Equipo (Ejemplo) -->
                    <div class="card card-profile">
                        <div class="card-header"
                            style="background-image: url('assets/img/kaiadmin/examples/product2.jpg'); background-size: cover; background-position: center;">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    <img src="assets/img/profile.jpg" alt="Avatar del autor"
                                        class="avatar-img rounded-circle">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">Equipo Legal PRO</div>
                                <div class="job">Expertos en Derecho para Emprendedores</div>
                                <div class="desc">Te ayudamos a navegar el complejo mundo legal para que tu
                                    emprendimiento
                                    crezca seguro.</div>
                                <div class="social-media mt-2">
                                    <a class="btn btn-info btn-twitter btn-sm btn-link" href="#"><span
                                            class="btn-label just-icon"><i class="fab fa-twitter"></i></span></a>
                                    <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#"><span
                                            class="btn-label just-icon"><i class="fab fa-facebook-f"></i></span></a>
                                    <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"><span
                                            class="btn-label just-icon"><i class="fab fa-linkedin-in"></i></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-primary btn-sm btn-round">Ver Perfil Completo</a>
                        </div>
                    </div>

                    <!-- Widget: Categorías -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-folder-open me-2"></i>Categorías</h4>
                        </div>
                        <div class="card-body">
    <ul class="list-group list-group-flush" id="widgetCategories">
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between align-items-center">
                Constitución de Empresa 
                <span class="badge bg-primary rounded-pill ms-2">5</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between align-items-center">
                Impuestos y Tributación 
                <span class="badge bg-primary rounded-pill ms-2">8</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between align-items-center">
                Contratos Legales 
                <span class="badge bg-primary rounded-pill ms-2">12</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between align-items-center">
                Propiedad Intelectual 
                <span class="badge bg-primary rounded-pill ms-2">3</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between align-items-center">
                Derecho Laboral 
                <span class="badge bg-primary rounded-pill ms-2">7</span>
            </a>
        </li>
    </ul>
</div>

                    </div>

                    <!-- Widget: Posts Recientes -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-history me-2"></i>Tips Recientes</h4>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush" id="widgetRecentPosts">
                                <a href="#" class="list-group-item list-group-item-action">
                                    <h6 class="fw-mediumbold mb-1">Errores Comunes al Registrar tu Marca</h6>
                                    <small class="text-muted d-block">15 de Julio, 2024</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <h6 class="fw-mediumbold mb-1">¿Contrato Indefinido o por Obra y Servicio?</h6>
                                    <small class="text-muted d-block">10 de Julio, 2024</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <h6 class="fw-mediumbold mb-1">Aspectos Legales del E-commerce</h6>
                                    <small class="text-muted d-block">05 de Julio, 2024</small>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Widget: Etiquetas (Tags) -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-tags me-2"></i>Etiquetas Populares</h4>
                        </div>
                        <div class="card-body" id="widgetTags">
                            <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">EIRL</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Impuestos</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Startup</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Contratos</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Marca</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Laboral</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Fintech</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

</div>
<script>
    // Script para simular la carga de datos del post y la interactividad básica
    // En una aplicación real, estos datos vendrían del backend o del estado de tu aplicación.
    $(document).ready(function () {
        // Datos de ejemplo del post que se está visualizando
        const currentPostData = {
            title: "Guía Definitiva para la Constitución de tu EIRL en 2024",
            category: "Constitución de Empresa",
            date: "20 de Julio, 2024",
            author: "Equipo Legal PRO",
            featuredImageUrl: "assets/img/examples/product1.jpg", // Cambia esto por una imagen tuya
            introduction: "Iniciar una Empresa Individual de Responsabilidad Limitada (EIRL) es un paso emocionante y fundamental para muchos emprendedores. Esta estructura legal ofrece beneficios significativos, pero también implica una serie de trámites que pueden parecer abrumadores. En esta guía completa, te llevaremos de la mano a través de todo el proceso, asegurando que tengas la información necesaria para formalizar tu negocio con éxito.",
            bodyContent: `
            <h4 class="fw-semibold mt-4 mb-3">¿Por qué elegir una EIRL?</h4>
            <p>La principal ventaja de una EIRL radica en la <strong>limitación de responsabilidad</strong>. Esto significa que tu patrimonio personal (casa, auto, ahorros) queda protegido ante posibles deudas o problemas financieros de la empresa. La EIRL, como persona jurídica, responde con su propio patrimonio. Además, es ideal para negocios unipersonales, simplificando la gestión y la toma de decisiones.</p>
            
            <h4 class="fw-semibold mt-4 mb-3">Requisitos Previos</h4>
            <p>Antes de iniciar el trámite, asegúrate de tener:</p>
            <ul>
                <li>Nombre completo y DNI/Cédula del titular.</li>
                <li>Definición clara del objeto social (a qué se dedicará la empresa).</li>
                <li>Tres opciones de nombre para la empresa (para verificar disponibilidad).</li>
                <li>Monto del capital social (puede ser en bienes o efectivo).</li>
            </ul>

            <div class="my-4 text-center">
                <figure class="figure">
                    <img src="https://via.placeholder.com/600x300.png?text=Documentos+Necesarios" class="figure-img img-fluid rounded" alt="Documentos necesarios">
                    <figcaption class="figure-caption text-center">Asegúrate de tener toda la documentación lista.</figcaption>
                </figure>
            </div>

            <h4 class="fw-semibold mt-4 mb-3">Pasos Detallados para la Constitución</h4>
            <ol>
                <li><strong>Búsqueda y Reserva del Nombre:</strong> Verifica que el nombre elegido para tu empresa esté disponible en los registros públicos y resérvalo.</li>
                <li><strong>Elaboración de la Minuta de Constitución:</strong> Este documento, redactado por un abogado, contiene los estatutos de la empresa, el capital, el objeto social, y los datos del titular.</li>
                <li><strong>Escritura Pública:</strong> La minuta debe ser elevada a escritura pública ante un notario.</li>
                <li><strong>Inscripción en Registros Públicos:</strong> La escritura pública se inscribe en el registro de personas jurídicas para que la EIRL nazca legalmente.</li>
                <li><strong>Obtención del RUC/Identificación Tributaria:</strong> Inscribe tu nueva empresa ante la entidad tributaria de tu país para poder emitir facturas y cumplir con tus obligaciones fiscales.</li>
            </ol>
            <p>Este proceso puede tomar algunas semanas, dependiendo de la agilidad de las entidades públicas y el notario.</p>
        `,
            conclusion: `
            <h3 class="fw-semibold">Tu Camino al Éxito Formalizado</h3>
            <p>Constituir tu EIRL es más que un trámite; es sentar las bases sólidas para el crecimiento de tu emprendimiento. Si bien el proceso requiere dedicación, los beneficios de operar formalmente y proteger tu patrimonio son invaluables. ¡Adelante con tu proyecto!</p>
        `,
            callToAction: {
                title: "¿Necesitas Ayuda Profesional?",
                text: "Nuestro equipo de abogados especializados está listo para asesorarte en cada paso de la constitución de tu EIRL. ¡Simplifica el proceso y enfócate en hacer crecer tu negocio!",
                buttonText: "Solicitar Asesoría Gratuita",
                buttonUrl: "#contact"
            }
        };

        // Llenar dinámicamente el contenido del post
        $('#breadcrumbPostTitle').text(currentPostData.title.substring(0, 30) + "..."); // Acortar para breadcrumb
        $('#postMainTitle').text(currentPostData.title);
        $('#postCategory').text(currentPostData.category);
        $('#postDate').text(currentPostData.date);
        // if(currentPostData.author) $('#postAuthor').text(currentPostData.author);
        if (currentPostData.featuredImageUrl) {
            $('#postFeaturedImage').attr('src', currentPostData.featuredImageUrl).attr('alt', currentPostData.title);
        } else {
            $('#postFeaturedImage').parent().hide(); // Ocultar si no hay imagen
        }
        $('#postIntroduction').html(currentPostData.introduction);
        $('#postBodyContent').html(currentPostData.bodyContent);
        $('#postConclusion').html(currentPostData.conclusion);

        const cta = $('#postCallToAction');
        cta.find('h4').text(currentPostData.callToAction.title);
        cta.find('p').text(currentPostData.callToAction.text);
        cta.find('a.btn')
            .attr('href', currentPostData.callToAction.buttonUrl)
            .html(currentPostData.callToAction.buttonText + ' <i class="fas fa-arrow-circle-right ms-2"></i>');

        // Funcionalidad de botones de admin (simulada)
        $('#editThisPostButtonAdmin').on('click', function () {
            alert('Acción: Abrir modal o página de edición para este post.');
            // Aquí integrarías con tu CRUD. Por ejemplo, si el post tiene un ID:
            // window.location.href = '/admin/blog/edit/' + postId; 
        });

        $('#backToListButtonAdmin').on('click', function () {
            alert('Acción: Volver a la página de listado de tips legales.');
            // window.location.href = '/admin/blog/tips-legales';
        });
    });
</script>

<script>
$(document).ready(function() {
    let postsData = []; 
    let postCounter = 0; 
    let currentEditRow = null; 

    const postsTable = $('#postsTable').DataTable({
        "pageLength": 10,
        responsive: true,
        order: [[0, 'desc']], 
        data: postsData,
        columns: [
            { data: 'id', className: 'text-center' },
            { 
                data: 'titulo',
                render: function(data, type, row){
                    var escapedTitle = $('<div>').text(data).html();
                    return data.length > 35 ? '<span data-bs-toggle="tooltip" title="' + escapedTitle + '">' + data.substr(0, 35) + '...</span>' : data;
                }
            },
            { data: 'categoria' },
            { data: 'autor' },
            { data: 'fechaPublicacion', className: 'text-center' },
            { 
                data: 'estado',
                className: 'text-center',
                render: function(data, type, row) {
                    let badgeClass = 'badge-secondary';
                    if (data === 'Publicado') badgeClass = 'badge-success';
                    else if (data === 'Borrador') badgeClass = 'badge-warning text-dark';
                    else if (data === 'Archivado') badgeClass = 'badge-danger';
                    return '<span class="badge ' + badgeClass + '">' + data + '</span>';
                }
            },
            { 
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    var buttons = '<div class="form-button-action">' +
                                  '<button type="button" data-bs-toggle="tooltip" title="Ver" class="btn btn-link btn-info btn-lg view-post p-1" data-id="' + row.id + '">' +
                                      '<i class="fa fa-eye"></i>' +
                                  '</button>' +
                                  '<button type="button" data-bs-toggle="tooltip" title="Editar" class="btn btn-link btn-primary btn-lg edit-post p-1" data-id="' + row.id + '">' +
                                      '<i class="fa fa-edit"></i>' +
                                  '</button>' +
                                  '<button type="button" data-bs-toggle="tooltip" title="Eliminar" class="btn btn-link btn-danger delete-post p-1" data-id="' + row.id + '">' +
                                      '<i class="fa fa-times"></i>' +
                                  '</button>' +
                               '</div>';
                    return buttons;
                }
            }
        ],
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip('dispose');
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
              return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        },
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
        }
    });

    function updateStats() {
        $('#statsTotalPosts').text(postsData.length);
        $('#statsPublishedPosts').text(postsData.filter(p => p.estado === 'Publicado').length);
        $('#statsDraftPosts').text(postsData.filter(p => p.estado === 'Borrador').length);
        $('#statsArchivedPosts').text(postsData.filter(p => p.estado === 'Archivado').length);
    }

    function resetModalForm() {
        $('#postForm')[0].reset();
        $('#postId').val('');
        $('#modalPostTitlePrefix').text('Nuevo');
        currentEditRow = null; 
    }

    $('button[data-bs-target="#addPostModal"]').on('click', function() {
        resetModalForm();
    });

    $('#savePostButton').on('click', function() {
        if (!$('#postForm')[0].checkValidity()) {
            $('#postForm')[0].reportValidity();
            return;
        }

        const postIdVal = $('#postId').val();
        const titulo = $('#postTitulo').val();
        const autor = $('#postAutor').val();
        const categoria = $('#postCategoria').val();
        const estado = $('#postEstado').val();
        const imagenURL = $('#postImagenURL').val();
        const extracto = $('#postExtracto').val();
        const contenido = $('#postContenido').val();
        const fechaActual = new Date().toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });

        if (postIdVal) { 
            const postIdNum = parseInt(postIdVal);
            const postIndex = postsData.findIndex(p => p.id === postIdNum);
            if (postIndex > -1) {
                let postOriginal = postsData[postIndex];
                let fechaPubActualizada = postOriginal.fechaPublicacion;
                let fechaPubOriginalActualizada = postOriginal.fechaPublicacionOriginal;

                if (estado === 'Publicado' && !postOriginal.fechaPublicacionOriginal) {
                    fechaPubActualizada = fechaActual;
                    fechaPubOriginalActualizada = true;
                }
                
                postsData[postIndex] = { 
                    ...postOriginal, 
                    titulo, autor, categoria, estado, imagenURL, extracto, contenido, 
                    fechaModificacion: fechaActual,
                    fechaPublicacion: fechaPubActualizada,
                    fechaPublicacionOriginal: fechaPubOriginalActualizada
                };
                
                if (currentEditRow) {
                     postsTable.row(currentEditRow).data(postsData[postIndex]).draw();
                } else {
                    console.warn("currentEditRow no estaba definido al editar. Redibujando tabla completa.");
                    postsTable.clear().rows.add(postsData).draw();
                }
            } else {
                 console.error("Error: No se encontró el post con ID " + postIdNum + " para actualizar en postsData.");
            }
        } else { 
            postCounter++;
            const newPost = { 
                id: postCounter, 
                titulo, autor, categoria, estado, imagenURL, extracto, contenido, 
                fechaCreacion: fechaActual, 
                fechaPublicacion: (estado === 'Publicado' ? fechaActual : '-'),
                fechaPublicacionOriginal: (estado === 'Publicado'),
                fechaModificacion: fechaActual
            };
            postsData.push(newPost);
            postsTable.row.add(newPost).draw();
        }

        $('#addPostModal').modal('hide');
        resetModalForm();
        updateStats();
        if (typeof swal !== 'undefined') {
            swal("¡Éxito!", "El post ha sido guardado correctamente.", "success", {
                buttons: {
                    confirm: {
                        className : 'btn btn-success'
                    }
                },
            });
        } else {
            alert('Post guardado exitosamente!');
        }
    });

    $('#postsTable tbody').on('click', '.edit-post', function() {
        const postId = parseInt($(this).data('id'));
        const post = postsData.find(p => p.id === postId);
        currentEditRow = postsTable.row($(this).closest('tr')); 

        if (post) {
            $('#postId').val(post.id);
            $('#postTitulo').val(post.titulo);
            $('#postAutor').val(post.autor);
            $('#postCategoria').val(post.categoria);
            $('#postEstado').val(post.estado);
            $('#postImagenURL').val(post.imagenURL || '');
            $('#postExtracto').val(post.extracto);
            $('#postContenido').val(post.contenido);
            $('#modalPostTitlePrefix').text('Editar');
            $('#addPostModal').modal('show');
        } else {
            console.error("Error: No se encontró el post con ID " + postId + " para editar.");
            currentEditRow = null; 
        }
    });

    $('#postsTable tbody').on('click', '.view-post', function() {
        const postId = parseInt($(this).data('id'));
        const post = postsData.find(p => p.id === postId);

        if (post) {
            $('#viewPostTitulo').text(post.titulo);
            $('#viewPostCategoria').text(post.categoria).removeClass().addClass('badge bg-info');
            $('#viewPostAutor').text(post.autor);
            
            let fechaAMostrar = post.estado === 'Publicado' ? post.fechaPublicacion : (post.fechaCreacion || 'N/A');
            if (post.estado === 'Borrador' && post.fechaPublicacion === '-') fechaAMostrar = post.fechaCreacion;
            $('#viewPostFecha').text(fechaAMostrar);

            let badgeClassView = 'badge-secondary';
            if (post.estado === 'Publicado') badgeClassView = 'bg-success';
            else if (post.estado === 'Borrador') badgeClassView = 'bg-warning text-dark';
            else if (post.estado === 'Archivado') badgeClassView = 'bg-danger';
            $('#viewPostEstado').text(post.estado).removeClass('bg-success bg-warning bg-danger badge-secondary text-dark').addClass(badgeClassView);

            if (post.imagenURL && post.imagenURL.trim() !== '') {
                $('#viewPostImagen').attr('src', post.imagenURL);
                $('#viewPostImagenContainer').show();
            } else {
                $('#viewPostImagenContainer').hide();
            }
            $('#viewPostExtracto').text(post.extracto);
            $('#viewPostContenido').html($('<div>').text(post.contenido).html().replace(/\n/g, '<br>'));
            $('#viewPostModal').modal('show');
        }
    });

    $('#postsTable tbody').on('click', '.delete-post', function() {
        const postId = parseInt($(this).data('id'));
        const rowToDelete = postsTable.row($(this).closest('tr'));

        if (typeof swal !== 'undefined') {
            swal({
                title: '¿Estás seguro?',
                text: "Una vez eliminado, no podrás recuperar este post.",
                icon: 'warning', 
                buttons:{
                    cancel: {
                        text: "Cancelar",
                        value: null,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true,
                    },
                    confirm: {
                        text : 'Sí, ¡eliminarlo!',
                        className : 'btn btn-success'
                    }
                }
            }).then((willDelete) => { 
                if (willDelete) {
                    postsData = postsData.filter(p => p.id !== postId);
                    rowToDelete.remove().draw();
                    updateStats();
                    swal("¡Eliminado!", "El post ha sido eliminado.", "success",{
                        buttons: {
                            confirm: { className: 'btn btn-success'}
                        }
                    });
                }
            });
        } else { 
            if (confirm('¿Estás seguro de que quieres eliminar este post?')) {
                postsData = postsData.filter(p => p.id !== postId);
                rowToDelete.remove().draw();
                updateStats();
            }
        }
    });
    
    function loadSampleData() {
        const samplePosts = [
            { id: ++postCounter, titulo: '10 Estrategias de Marketing Digital para Impulsar tu Startup', autor: 'Ana Pérez', categoria: 'Marketing Digital', estado: 'Publicado', imagenURL: 'https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFya2V0aW5nJTIwZGlnaXRhbHxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60', extracto: 'Descubre cómo el marketing digital puede ser tu mejor aliado para crecer...', contenido: 'Contenido detallado sobre SEO, SEM, Redes Sociales, Email Marketing...\n\nIncluye ejemplos prácticos.', fechaCreacion: '01/07/2024', fechaPublicacion: '01/07/2024', fechaPublicacionOriginal: true, fechaModificacion: '01/07/2024' },
            { id: ++postCounter, titulo: 'Guía de Finanzas para Emprendedores: Presupuesto y Flujo de Caja', autor: 'Carlos Ruiz', categoria: 'Finanzas para Emprendedores', estado: 'Borrador', imagenURL: '', extracto: 'Aprende a gestionar las finanzas de tu negocio desde el inicio...', contenido: 'Explicación sobre cómo crear un presupuesto, proyecciones financieras, control de gastos...\n\nConsejos para evitar errores comunes.', fechaCreacion: '05/07/2024', fechaPublicacion: '-', fechaPublicacionOriginal: false, fechaModificacion: '05/07/2024' },
            { id: ++postCounter, titulo: 'Innovación Disruptiva: Cómo Revolucionar tu Industria en un Mundo Cambiante', autor: 'Laura Gómez', categoria: 'Innovación y Tecnología', estado: 'Archivado', imagenURL: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8aW5ub3ZhY2lvbnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60', extracto: 'La innovación no es solo para grandes empresas. Ve cómo aplicarla...', contenido: 'Casos de estudio, metodologías como Design Thinking, Lean Startup...\n\nEl futuro es ahora.', fechaCreacion: '10/06/2024', fechaPublicacion: '15/06/2024', fechaPublicacionOriginal: true, fechaModificacion: '10/06/2024' },
            { id: ++postCounter, titulo: 'Construyendo un Equipo de Alto Rendimiento desde Cero', autor: 'Marcos Solis', categoria: 'Gestión de Equipos', estado: 'Publicado', imagenURL: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTV8fHRlYW18ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60', extracto: 'El éxito de tu emprendimiento depende en gran medida de tu equipo. Aprende a reclutar, motivar y retener talento.', contenido: 'Sección sobre cultura organizacional, liderazgo efectivo, herramientas de colaboración y estrategias para la resolución de conflictos.\n\nDinámicas de grupo y más.', fechaCreacion: '15/07/2024', fechaPublicacion: '15/07/2024', fechaPublicacionOriginal: true, fechaModificacion: '15/07/2024' },
            { id: ++postCounter, titulo: 'Caso de Éxito: De Idea a Empresa Millonaria en 3 Años', autor: 'Redacción Blog', categoria: 'Casos de Éxito', estado: 'Publicado', imagenURL: '', extracto: 'Inspírate con la historia de "EmprendeX", una startup que transformó el mercado con una solución simple pero efectiva.', contenido: 'Entrevista con los fundadores, los desafíos que enfrentaron, las estrategias clave que utilizaron y las lecciones aprendidas en su camino al éxito.\n\n¡Tú puedes ser el siguiente!', fechaCreacion: '20/07/2024', fechaPublicacion: '20/07/2024', fechaPublicacionOriginal: true, fechaModificacion: '20/07/2024' }
        ];
        postsData.push(...samplePosts);
        postsTable.rows.add(samplePosts).draw();
        updateStats();
    }
    loadSampleData(); 
});
</script>