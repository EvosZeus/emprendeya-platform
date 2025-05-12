<!-- CONTENEDOR PRINCIPAL DE LA PÁGINA DEL BLOG DE EMPRENDIMIENTOS -->
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Blog de Emprendimientos</h3>

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
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addPostModal">
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
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small">Completa el formulario para crear o editar un post.</p>
                                        <form id="postForm">
                                            <input type="hidden" id="postId">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group form-group-default">
                                                        <label>Título del Post</label>
                                                        <input id="postTitulo" type="text" class="form-control"
                                                            placeholder="Escribe el título" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label>Autor</label>
                                                        <input id="postAutor" type="text" class="form-control"
                                                            placeholder="Nombre del autor" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label>Categoría</label>
                                                        <select id="postCategoria" class="form-control form-select"
                                                            required>
                                                            <option value="">Selecciona una categoría</option>
                                                            <option value="Marketing Digital">Marketing Digital</option>
                                                            <option value="Finanzas para Emprendedores">Finanzas para
                                                                Emprendedores</option>
                                                            <option value="Innovación y Tecnología">Innovación y
                                                                Tecnología</option>
                                                            <option value="Gestión de Equipos">Gestión de Equipos
                                                            </option>
                                                            <option value="Casos de Éxito">Casos de Éxito</option>
                                                            <option value="Legal y Cumplimiento">Legal y Cumplimiento
                                                            </option>
                                                            <option value="Desarrollo Personal">Desarrollo Personal
                                                            </option>
                                                            <option value="Productividad">Productividad</option>
                                                            <option value="Ventas">Ventas</option>
                                                            <option value="Noticias del Sector">Noticias del Sector
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label>Estado</label>
                                                        <select id="postEstado" class="form-control form-select"
                                                            required>
                                                            <option value="Borrador">Borrador</option>
                                                            <option value="Publicado">Publicado</option>
                                                            <option value="Archivado">Archivado</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label>URL Imagen Destacada (Opcional)</label>
                                                        <input id="postImagenURL" type="url" class="form-control"
                                                            placeholder="https://ejemplo.com/imagen.jpg">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Extracto (Resumen corto)</label>
                                                        <textarea id="postExtracto" class="form-control" rows="3"
                                                            placeholder="Escribe un resumen breve del post"
                                                            required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Contenido Completo del Post</label>
                                                        <textarea id="postContenido" class="form-control" rows="10"
                                                            placeholder="Escribe el contenido detallado del post. Puedes usar HTML básico."
                                                            required></textarea>
                                                        <small class="form-text text-muted">Puedes usar etiquetas HTML
                                                            básicas como <p>, <br>, <strong>, <em>, <ul>, <li>, <h4>
                                                                                    .</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" id="savePostButton" class="btn btn-primary">Guardar
                                            Post</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cerrar</button>
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
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h3 id="viewPostTitulo" class="fw-bold mb-3"></h3>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <p class="mb-1"><strong>Categoría:</strong> <span id="viewPostCategoria"
                                                        class="badge bg-info"></span></p>
                                                <p class="mb-1"><strong>Autor:</strong> <span id="viewPostAutor"></span>
                                                </p>
                                            </div>
                                            <div class="col-md-6 text-md-end">
                                                <p class="mb-1"><strong>Fecha de Publicación:</strong> <span
                                                        id="viewPostFecha"></span></p>
                                                <p class="mb-1"><strong>Estado:</strong> <span id="viewPostEstado"
                                                        class="badge"></span></p>
                                            </div>
                                        </div>

                                        <div id="viewPostImagenContainer" class="text-center mb-4"
                                            style="display:none;">
                                            <img id="viewPostImagen" src="" alt="Imagen Destacada"
                                                class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                                        </div>

                                        <h5 class="fw-semibold mt-4">Extracto:</h5>
                                        <p id="viewPostExtracto" class="text-muted fst-italic"></p>
                                        <hr>
                                        <h5 class="fw-semibold">Contenido Completo:</h5>
                                        <div id="viewPostContenido" class="post-content-view"
                                            style="white-space: pre-wrap; max-height: 500px; overflow-y: auto; border: 1px solid #eee; padding: 15px; border-radius: 5px; background-color: #f9f9f9;">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="postsTable" class="display table table-striped table-hover">
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


    <!-- CONTENIDO DE LA ENTRADA DEL BLOG PARA EL USUARIO -->

    <div class="page-inner">
        <div class="row">
            <!-- COLUMNA PRINCIPAL CON LA ENTRADA -->
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <article>
                            <!-- Título de la Entrada -->
                            <h1 class="blog-post-title">10 Estrategias de Marketing Digital para tu Startup en 2024</h1>

                            <!-- Metadatos del Post -->
                            <div class="blog-post-meta">
                                <span><i class="far fa-calendar-alt"></i> Publicado el <time datetime="2024-07-29">29 de
                                        Julio, 2024</time></span> |
                                <span><i class="far fa-user"></i> Por <a href="#">Ana Pérez (Experta en
                                        Marketing)</a></span> |
                                <span><i class="far fa-folder-open"></i> En <a href="#">Marketing Digital</a>, <a
                                        href="#">Startups</a></span>
                            </div>

                            <!-- Imagen Destacada -->
                            <div class="blog-featured-image">
                                <img src="../assets/img/examples/product1.jpg" alt="Estrategias de Marketing Digital"
                                    class="img-fluid">
                            </div>

                            <!-- Introducción que Enganche -->
                            <section class="blog-post-body">
                                <p class="lead"><em>Lanzar una startup es un desafío emocionante, pero hacerla visible y
                                        atraer clientes es crucial para su supervivencia y crecimiento. En 2024, el
                                        marketing digital ofrece un arsenal de herramientas poderosas y accesibles. Aquí
                                        te presentamos 10 estrategias efectivas que puedes empezar a implementar hoy
                                        mismo.</em></p>
                            </section>

                            <!-- Cuerpo del Post -->
                            <section class="blog-post-body">
                                <h2>1. Marketing de Contenidos de Valor</h2>
                                <p>Crea y distribuye contenido relevante y útil (artículos de blog, ebooks, infografías,
                                    videos) que resuelva los problemas de tu audiencia objetivo. Esto no solo atrae
                                    visitantes, sino que también te posiciona como un experto en tu nicho.</p>

                                <h4>Ejemplos de Contenido:</h4>
                                <ul>
                                    <li>Guías prácticas relacionadas con tu producto/servicio.</li>
                                    <li>Estudios de caso de clientes exitosos.</li>
                                    <li>Tutoriales en video mostrando cómo usar tu producto.</li>
                                </ul>

                                <h2>2. Optimización para Motores de Búsqueda (SEO)</h2>
                                <p>Asegúrate de que tu sitio web y contenido estén optimizados para que los motores de
                                    búsqueda como Google puedan encontrarte fácilmente. Investiga palabras clave
                                    relevantes para tu industria y úsalas estratégicamente.</p>

                                <h2>3. Marketing en Redes Sociales (SMM)</h2>
                                <p>Identifica en qué redes sociales se encuentra tu público objetivo (LinkedIn,
                                    Instagram, TikTok, Facebook, etc.) y crea una presencia activa. Comparte tu
                                    contenido, interactúa con tus seguidores y considera la publicidad pagada para un
                                    mayor alcance.</p>

                                <figure class="my-4 text-center">
                                    <img src="../assets/img/examples/product2.jpg" class="img-fluid rounded"
                                        alt="Marketing en Redes Sociales" style="max-height: 300px;">
                                    <figcaption class="figure-caption mt-1 text-muted small">Las redes sociales son
                                        clave para conectar con tu audiencia.</figcaption>
                                </figure>

                                <h2>4. Email Marketing Personalizado</h2>
                                <p>Construye una lista de suscriptores y envía correos electrónicos segmentados y
                                    personalizados. El email marketing sigue siendo una de las herramientas con mayor
                                    ROI (Retorno de la Inversión) si se hace correctamente.</p>

                                <blockquote>
                                    <p class="mb-0">"El mejor marketing no se siente como marketing."</p>
                                    <footer class="blockquote-footer"><cite title="Tom Fishburne">Tom Fishburne</cite>
                                    </footer>
                                </blockquote>

                                <h2>5. Publicidad de Pago Por Clic (PPC)</h2>
                                <p>Plataformas como Google Ads o Facebook Ads te permiten llegar a audiencias
                                    específicas rápidamente. Es ideal para generar leads o ventas a corto plazo, pero
                                    requiere una gestión cuidadosa del presupuesto.</p>

                                {/* Más estrategias del 6 al 10 irían aquí */}
                                <h2>6. Marketing de Influencers</h2>
                                <p>Colabora con influencers relevantes en tu nicho para que promocionen tu producto o
                                    servicio a sus seguidores. Elige micro-influencers si tu presupuesto es limitado
                                    pero buscas autenticidad.</p>

                                <h2>7. Video Marketing</h2>
                                <p>El contenido en video (tutoriales, demos, testimonios, webinars) es altamente
                                    atractivo y compartible. Plataformas como YouTube, TikTok e Instagram Reels son
                                    excelentes canales.</p>

                                <h2>8. Programas de Afiliados o Referidos</h2>
                                <p>Incentiva a otros (afiliados o tus propios clientes) a promocionar tu startup a
                                    cambio de una comisión por cada venta o lead generado. Es una forma de marketing
                                    basada en resultados.</p>

                                <h2>9. SEO Local (si aplica)</h2>
                                <p>Si tu startup tiene una ubicación física o sirve a un área geográfica específica,
                                    optimiza tu presencia en Google My Business y directorios locales.</p>

                                <h2>10. Analítica y Optimización Constante</h2>
                                <p>Utiliza herramientas como Google Analytics para medir el rendimiento de tus
                                    estrategias. Analiza los datos, identifica qué funciona y qué no, y optimiza tus
                                    campañas continuamente.</p>
                            </section>

                            <!-- Conclusión -->
                            <section class="blog-post-body mt-4 pt-3 border-top">
                                <h3>Conclusión: El Marketing es un Maratón, no un Sprint</h3>
                                <p>Implementar estas estrategias de marketing digital requiere tiempo, esfuerzo y
                                    consistencia. No esperes resultados milagrosos de la noche a la mañana. Empieza con
                                    algunas que se ajusten mejor a tu startup y presupuesto, mide tus resultados y
                                    adapta tu enfoque sobre la marcha. ¡El crecimiento llegará!</p>
                            </section>

                           <!-- Call to Action -->
<div class="card mt-4 bg-primary-gradient text-white">
    <div class="card-body text-center">
        <h4 class="card-title text-white fw-bold">¿Necesitas Ayuda con tu Estrategia de Marketing?</h4>
        <p class="card-text">Nuestro equipo de expertos puede ayudarte a diseñar e implementar un plan de marketing digital a medida para tu startup.</p>
        <a href="#" class="btn btn-light btn-sm">¡Contáctanos para una Consultoría Gratuita!</a>
    </div>
</div>

                        </article>
                    </div>
                </div>
            </div>

            <!-- BARRA LATERAL (SIDEBAR DEL BLOG) -->
            <aside class="col-lg-4 col-md-12">
                <div class="card card-profile mt-4 mt-lg-0">
                    <div class="card-header" style="background-image: url('../assets/img/examples/product3.jpg')">
                        <div class="profile-picture">
                            <div class="avatar avatar-xl">
                                <img src="../assets/img/profile2.jpg" alt="Autor del Blog"
                                    class="avatar-img rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-profile text-center">
                            <div class="name">Equipo Emprendedores PRO</div>
                            <div class="job">Apasionados por el Éxito de tu Negocio</div>
                            <div class="desc">Compartimos conocimiento y herramientas para ayudarte a crecer.</div>
                            <div class="social-media widget-social-icons">
                                <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="me-2"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-folder-open me-2"></i>Categorías</h4>
                    </div>
                    <div class="card-body">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                Marketing Digital 
                <span class="badge bg-primary rounded-pill ms-2">25</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                Finanzas 
                <span class="badge bg-primary rounded-pill ms-2">18</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                Innovación 
                <span class="badge bg-primary rounded-pill ms-2">12</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                Legal 
                <span class="badge bg-primary rounded-pill ms-2">9</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                Productividad 
                <span class="badge bg-primary rounded-pill ms-2">14</span>
            </a>
        </li>
    </ul>
</div>

                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-tags me-2"></i>Etiquetas Populares</h4>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">SEO</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Startup</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Contenido</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Redes Sociales</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Email Marketing</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm me-1 mb-2">Ventas</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
<!-- FIN CONTENIDO DE LA ENTRADA DEL BLOG -->



<script>
    $(document).ready(function () {
        // Inicializar Magnific Popup para imágenes dentro del cuerpo del post (opcional)
        $('.blog-post-body').magnificPopup({
            delegate: 'img:not(.no-popup)',
            type: 'image',
            gallery: { enabled: true },
            mainClass: 'mfp-with-zoom',
            zoom: { enabled: true, duration: 300, easing: 'ease-in-out' }
        });

        // Inicializar tooltips de Bootstrap si se usan
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<script>
    $(document).ready(function () {
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
                    render: function (data, type, row) {
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
                    render: function (data, type, row) {
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
                    render: function (data, type, row) {
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
            "drawCallback": function (settings) {
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

        $('button[data-bs-target="#addPostModal"]').on('click', function () {
            resetModalForm();
        });

        $('#savePostButton').on('click', function () {
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
                            className: 'btn btn-success'
                        }
                    },
                });
            } else {
                alert('Post guardado exitosamente!');
            }
        });

        $('#postsTable tbody').on('click', '.edit-post', function () {
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

        $('#postsTable tbody').on('click', '.view-post', function () {
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

        $('#postsTable tbody').on('click', '.delete-post', function () {
            const postId = parseInt($(this).data('id'));
            const rowToDelete = postsTable.row($(this).closest('tr'));

            if (typeof swal !== 'undefined') {
                swal({
                    title: '¿Estás seguro?',
                    text: "Una vez eliminado, no podrás recuperar este post.",
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: "Cancelar",
                            value: null,
                            visible: true,
                            className: "btn btn-danger",
                            closeModal: true,
                        },
                        confirm: {
                            text: 'Sí, ¡eliminarlo!',
                            className: 'btn btn-success'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        postsData = postsData.filter(p => p.id !== postId);
                        rowToDelete.remove().draw();
                        updateStats();
                        swal("¡Eliminado!", "El post ha sido eliminado.", "success", {
                            buttons: {
                                confirm: { className: 'btn btn-success' }
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