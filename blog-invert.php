
            <!-- CONTENEDOR PRINCIPAL DE LA PÁGINA DEL BLOG DE INVERSIONES -->
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Blog de Inversiones</h3>
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
                                <a href="#">Gestión de Inversiones</a>
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
                                                <i class="fas fa-chart-line"></i> <!-- Icono cambiado para inversiones -->
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Total de Artículos</p>
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
                                        <h4 class="card-title">Listado de Artículos de Inversión</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addPostModal">
                                            <i class="fa fa-plus"></i>
                                            Agregar Nuevo Artículo
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal para Agregar/Editar Artículo -->
                                    <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold" id="modalPostTitlePrefix">Nuevo</span>
                                                        <span class="fw-light">Artículo de Inversión</span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="small">Completa el formulario para crear o editar un artículo.</p>
                                                    <form id="postForm">
                                                        <input type="hidden" id="postId">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group form-group-default">
                                                                    <label>Título del Artículo</label>
                                                                    <input id="postTitulo" type="text" class="form-control" placeholder="Escribe el título" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group form-group-default">
                                                                    <label>Autor / Analista</label>
                                                                    <input id="postAutor" type="text" class="form-control" placeholder="Nombre del autor o analista" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group form-group-default">
                                                                    <label>Categoría de Inversión</label>
                                                                    <select id="postCategoria" class="form-control form-select" required>
                                                                        <option value="">Selecciona una categoría</option>
                                                                        <option value="Acciones">Acciones</option>
                                                                        <option value="Bonos">Bonos</option>
                                                                        <option value="Fondos de Inversión">Fondos de Inversión</option>
                                                                        <option value="Criptomonedas">Criptomonedas</option>
                                                                        <option value="Bienes Raíces">Bienes Raíces</option>
                                                                        <option value="ETFs">ETFs</option>
                                                                        <option value="Educación Financiera">Educación Financiera</option>
                                                                        <option value="Análisis de Mercado">Análisis de Mercado</option>
                                                                        <option value="Estrategias de Inversión">Estrategias de Inversión</option>
                                                                        <option value="Noticias Financieras">Noticias Financieras</option>
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
                                                                    <input id="postImagenURL" type="url" class="form-control" placeholder="https://ejemplo.com/imagen_inversion.jpg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Extracto (Resumen corto)</label>
                                                                    <textarea id="postExtracto" class="form-control" rows="3" placeholder="Escribe un resumen breve del artículo" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Contenido Completo del Artículo</label>
                                                                    <textarea id="postContenido" class="form-control" rows="10" placeholder="Escribe el contenido detallado. Puedes usar HTML básico." required></textarea>
                                                                    <small class="form-text text-muted">Puedes usar etiquetas HTML básicas como <p>, <br>, <strong>, <em>, <ul>, <li>, <h4>.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" id="savePostButton" class="btn btn-primary">Guardar Artículo</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal para Ver Artículo -->
                                    <div class="modal fade" id="viewPostModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">Detalle del</span>
                                                        <span class="fw-light">Artículo</span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3 id="viewPostTitulo" class="fw-bold mb-3"></h3>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <p class="mb-1"><strong>Categoría:</strong> <span id="viewPostCategoria" class="badge bg-info"></span></p>
                                                            <p class="mb-1"><strong>Autor/Analista:</strong> <span id="viewPostAutor"></span></p>
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

        </div> <!-- End Main Panel -->
    </div> <!-- End Wrapper -->

            <!-- CONTENIDO DE LA ENTRADA DEL BLOG PARA EL USUARIO -->
            <div class="container mt-4"> <!-- 'mt-4' para dar espacio desde el header -->
                <div class="page-inner">
                    <div class="row">
                        <!-- COLUMNA PRINCIPAL CON LA ENTRADA -->
                        <div class="col-lg-8 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <article>
                                        <!-- Título de la Entrada -->
                                        <h1 class="blog-post-title">Guía Definitiva para Invertir en ETFs en 2024</h1>

                                        <!-- Metadatos del Post -->
                                        <div class="blog-post-meta">
                                            <span><i class="far fa-calendar-alt"></i> Publicado el <time datetime="2024-07-28">28 de Julio, 2024</time></span> |
                                            <span><i class="far fa-user"></i> Por <a href="#">Equipo Inversiones PRO</a></span> |
                                            <span><i class="far fa-folder-open"></i> En <a href="#">ETFs</a>, <a href="#">Estrategias</a></span>
                                        </div>

                                        <!-- Imagen Destacada (Opcional) -->
                                        <div class="blog-featured-image">
                                            <!-- Usar una imagen de ejemplo de los assets de Kaiadmin si está disponible, o un placeholder -->
                                            <img src="../assets/img/examples/product1.jpg" alt="Inversión en ETFs" class="img-fluid">
                                            <!-- O un placeholder:
                                            <img src="https://via.placeholder.com/750x400.png?text=Imagen+Destacada+ETFs" alt="Inversión en ETFs" class="img-fluid">
                                            -->
                                        </div>

                                        <!-- Introducción que Enganche -->
                                        <section class="blog-post-body">
                                            <p class="lead"><em>Los ETFs (Exchange Traded Funds o Fondos Cotizados en Bolsa) se han convertido en una de las herramientas de inversión más populares tanto para principiantes como para inversores experimentados. Pero, ¿qué son exactamente y por qué deberías considerar incluirlos en tu portafolio este 2024? En esta guía, desglosaremos todo lo que necesitas saber.</em></p>
                                        </section>

                                        <!-- Cuerpo del Post con Subtítulos y Párrafos -->
                                        <section class="blog-post-body">
                                            <h2>¿Qué es un ETF y Cómo Funciona?</h2>
                                            <p>Un ETF es un tipo de fondo de inversión que se negocia en las bolsas de valores, al igual que las acciones individuales. La principal característica de un ETF es que, por lo general, busca replicar el rendimiento de un índice específico, como el S&P 500, el IBEX 35, o un índice de bonos, materias primas, o incluso un sector industrial concreto (tecnología, salud, etc.).</p>
                                            <p>Cuando compras una participación de un ETF, estás comprando una pequeña porción de una canasta diversificada de activos. Esto te permite obtener exposición a múltiples empresas o activos con una sola transacción, lo cual es una de sus grandes ventajas.</p>

                                            <h4>Ventajas Clave de Invertir en ETFs</h4>
                                            <ul>
                                                <li><strong>Diversificación Instantánea:</strong> Con una sola compra accedes a una amplia gama de activos.</li>
                                                <li><strong>Bajos Costos:</strong> Generalmente, tienen comisiones de gestión (TER) más bajas.</li>
                                                <li><strong>Transparencia:</strong> Puedes ver la composición de la cartera del ETF diariamente.</li>
                                                <li><strong>Liquidez:</strong> Puedes comprar y vender ETFs durante el horario de mercado.</li>
                                                <li><strong>Flexibilidad:</strong> Gran variedad de ETFs para cubrir casi cualquier estrategia.</li>
                                            </ul>

                                            <figure class="my-4 text-center">
                                                <img src="../assets/img/examples/product2.jpg" class="img-fluid rounded" alt="Gráfico de diversificación" style="max-height: 300px;">
                                                <figcaption class="figure-caption mt-1 text-muted small">Los ETFs facilitan la diversificación de tu cartera.</figcaption>
                                            </figure>

                                            <h3>Tipos Comunes de ETFs</h3>
                                            <p>La oferta de ETFs es vasta, pero algunos de los tipos más comunes incluyen ETFs de Índices Bursátiles, Sectoriales, de Bonos, de Materias Primas, Geográficos y Temáticos.</p>
                                            
                                            <blockquote>
                                                <p class="mb-0">"La diversificación es la protección contra la ignorancia. Tiene poco sentido para aquellos que saben lo que están haciendo."</p>
                                                
                                            </blockquote>

                                            <h2>¿Cómo Elegir el ETF Adecuado?</h2>
                                            <p>Elegir un ETF requiere considerar tus objetivos, tolerancia al riesgo, el índice que replica, el TER, el proveedor y el volumen de negociación. Investiga a fondo antes de tomar una decisión.</p>

                                            <h4>Riesgos a Considerar</h4>
                                            <p>Aunque son excelentes herramientas, existen riesgos como el de mercado, tracking error y, en algunos casos, riesgo de contraparte. Evita ETFs apalancados e inversos si eres principiante.</p>
                                        </section>

                                        <!-- Conclusión -->
                                        <section class="blog-post-body mt-4 pt-3 border-top">
                                            <h3>Conclusión: ¿Son los ETFs para Ti?</h3>
                                            <p>Para la gran mayoría de los inversores, los ETFs representan una forma eficiente, diversificada y de bajo costo para construir riqueza a largo plazo. Su simplicidad y accesibilidad los convierten en una opción ideal.</p>
                                            <p>Recuerda siempre investigar y, si es necesario, buscar asesoramiento profesional.</p>
                                        </section>

                                        <!-- Call to Action (Opcional, usando componentes de card) -->
                                        <div class="card mt-4 bg-primary-gradient text-white">
                                            <div class="card-body text-center">
                                                <h4 class="card-title text-white fw-bold">¿Quieres Aprender Más?</h4>
                                                <p class="card-text">Suscríbete a nuestro boletín para recibir análisis exclusivos y guías de inversión.</p>
                                                <form class="d-flex justify-content-center">
                                                    <input type="email" class="form-control form-control-sm w-50 me-2" placeholder="Tu correo electrónico">
                                                    <button class="btn btn-light btn-sm" type="submit">Suscribirme</button>
                                                </form>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>

                        <!-- BARRA LATERAL (SIDEBAR DEL BLOG) -->
                        <aside class="col-lg-4 col-md-12">
                            <!-- Widget: Acerca del Autor (reutilizando card-profile de widgets.html) -->
                            <div class="card card-profile mt-4 mt-lg-0">
                                <div class="card-header" style="background-image: url('../assets/img/examples/product3.jpg')">
                                    <div class="profile-picture">
                                        <div class="avatar avatar-xl">
                                            <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="user-profile text-center">
                                        <div class="name">Equipo Inversiones PRO</div>
                                        <div class="job">Analistas Financieros Expertos</div>
                                        <div class="desc">Ayudándote a tomar decisiones de inversión inteligentes.</div>
                                        <div class="social-media">
                                            <a class="btn btn-info btn-twitter btn-sm btn-link" href="#"><span class="btn-label just-icon"><i class="fab fa-twitter"></i></span></a>
                                            <a class="btn btn-primary btn-sm btn-link" href="#"><span class="btn-label just-icon"><i class="fab fa-linkedin-in"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Widget: Categorías (reutilizando card y list-group) -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><i class="fas fa-folder-open me-2"></i>Categorías</h4>
                                </div>
                                <div class="card-body">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                Acciones 
                <span class="badge bg-primary rounded-pill ms-2">15</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                ETFs 
                <span class="badge bg-primary rounded-pill ms-2">12</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                Criptomonedas 
                <span class="badge bg-primary rounded-pill ms-2">8</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                Bienes Raíces 
                <span class="badge bg-primary rounded-pill ms-2">5</span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="text-decoration-none d-flex justify-content-between">
                Educación Financiera 
                <span class="badge bg-primary rounded-pill ms-2">20</span>
            </a>
        </li>
    </ul>
</div>

                            </div>

                            <!-- Widget: Artículos Recientes (reutilizando card-body y card-list de widgets.html) -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><i class="fas fa-history me-2"></i>Artículos Recientes</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-list">
                                        <div class="item-list">
                                            <div class="avatar avatar-sm"> <!-- Usar avatar-sm para imágenes pequeñas -->
                                                <img src="../assets/img/examples/example1-300x300.jpg" alt="..." class="avatar-img rounded">
                                            </div>
                                            <div class="info-user ms-2">
                                                <a href="#" class="text-decoration-none"><div class="username">Análisis del Mercado de Bonos</div></a>
                                                <div class="status text-muted small">25 Jul, 2024</div>
                                            </div>
                                        </div>
                                        <div class="item-list">
                                            <div class="avatar avatar-sm">
                                                <img src="../assets/img/examples/example2-300x300.jpg" alt="..." class="avatar-img rounded">
                                            </div>
                                            <div class="info-user ms-2">
                                                <a href="#" class="text-decoration-none"><div class="username">Errores Comunes al Invertir en Cripto</div></a>
                                                <div class="status text-muted small">22 Jul, 2024</div>
                                            </div>
                                        </div>
                                        <div class="item-list">
                                            <div class="avatar avatar-sm">
                                                <img src="../assets/img/examples/example3-300x300.jpg" alt="..." class="avatar-img rounded">
                                            </div>
                                            <div class="info-user ms-2">
                                                <a href="#" class="text-decoration-none"><div class="username">Impacto de la IA en Inversiones</div></a>
                                                <div class="status text-muted small">20 Jul, 2024</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
            <!-- FIN CONTENIDO DE LA ENTRADA DEL BLOG -->
        </div> <!-- End Main Panel -->
    </div> <!-- End Wrapper -->

    

    <script>
        // Script para inicializar Magnific Popup si se usa para imágenes dentro del post
        $(document).ready(function() {
            $('.blog-post-body').magnificPopup({
                delegate: 'img:not(.no-popup)', // target items with selector (excluding images con .no-popup)
                type: 'image',
                gallery:{
                    enabled:true
                },
                mainClass: 'mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                }
            });

            // Inicializar tooltips de Bootstrap si los usas en esta vista
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
              return new bootstrap.Tooltip(tooltipTriggerEl)
            })
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
                        console.error("Error: No se encontró el artículo con ID " + postIdNum + " para actualizar en postsData.");
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
                    swal("¡Éxito!", "El artículo ha sido guardado correctamente.", "success", {
                        buttons: {
                            confirm: {
                                className : 'btn btn-success'
                            }
                        },
                    });
                } else {
                    alert('Artículo guardado exitosamente!');
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
                    console.error("Error: No se encontró el artículo con ID " + postId + " para editar.");
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
                        text: "Una vez eliminado, no podrás recuperar este artículo.",
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
                            swal("¡Eliminado!", "El artículo ha sido eliminado.", "success",{
                                buttons: {
                                    confirm: { className: 'btn btn-success'}
                                }
                            });
                        }
                    });
                } else { 
                    if (confirm('¿Estás seguro de que quieres eliminar este artículo?')) {
                        postsData = postsData.filter(p => p.id !== postId);
                        rowToDelete.remove().draw();
                        updateStats();
                    }
                }
            });
            
            function loadSampleData() {
                const samplePosts = [
                    { id: ++postCounter, titulo: 'Introducción a la Inversión en Acciones para Principiantes', autor: 'Sofía Vargas', categoria: 'Acciones', estado: 'Publicado', imagenURL: 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8c3RvY2slMjBtYXJrZXR8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60', extracto: 'Aprende los conceptos básicos para empezar a invertir en el mercado de acciones y construir tu portafolio.', contenido: '¿Qué es una acción? Tipos de acciones. Cómo elegir un bróker. Análisis fundamental vs. técnico. Riesgos y recompensas.\n\nEjemplos de empresas populares.', fechaCreacion: '02/07/2024', fechaPublicacion: '02/07/2024', fechaPublicacionOriginal: true, fechaModificacion: '02/07/2024' },
                    { id: ++postCounter, titulo: 'Diversificación de Cartera: La Clave para Reducir Riesgos', autor: 'David Lee', categoria: 'Estrategias de Inversión', estado: 'Publicado', imagenURL: 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8ZGl2ZXJzaWZpY2F0aW9ufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60', extracto: 'No pongas todos tus huevos en la misma canasta. Descubre por qué la diversificación es crucial.', contenido: 'Principios de diversificación. Correlación de activos. Cómo diversificar con diferentes instrumentos: acciones, bonos, ETFs, bienes raíces.\n\nErrores comunes al diversificar.', fechaCreacion: '08/07/2024', fechaPublicacion: '08/07/2024', fechaPublicacionOriginal: true, fechaModificacion: '08/07/2024' },
                    { id: ++postCounter, titulo: 'Análisis Técnico: Interpretando Gráficos para Tomar Decisiones', autor: 'Laura Chen', categoria: 'Análisis de Mercado', estado: 'Borrador', imagenURL: '', extracto: 'Una introducción al análisis técnico y cómo puede ayudarte a identificar tendencias y oportunidades.', contenido: 'Soportes y resistencias. Medias móviles. Indicadores como RSI y MACD. Patrones gráficos comunes.\n\nLimitaciones del análisis técnico.', fechaCreacion: '12/07/2024', fechaPublicacion: '-', fechaPublicacionOriginal: false, fechaModificacion: '12/07/2024' },
                    { id: ++postCounter, titulo: '¿Son las Criptomonedas una Buena Inversión en 2024?', autor: 'Equipo InvestPRO', categoria: 'Criptomonedas', estado: 'Publicado', imagenURL: 'https://images.unsplash.com/photo-1621452079929-0536DC2f80ea?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8Y3J5cHRvY3VycmVuY3l8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60', extracto: 'Un vistazo al panorama actual de las criptomonedas, sus riesgos y potencial de retorno.', contenido: 'Principales criptomonedas. Volatilidad. Regulación. Casos de uso. Cómo empezar a invertir de forma segura (si decides hacerlo).\n\nOpiniones de expertos.', fechaCreacion: '18/07/2024', fechaPublicacion: '18/07/2024', fechaPublicacionOriginal: true, fechaModificacion: '18/07/2024' },
                    { id: ++postCounter, titulo: 'Invertir en Bienes Raíces: Pros, Contras y Estrategias', autor: 'Carlos Méndez', categoria: 'Bienes Raíces', estado: 'Archivado', imagenURL: '', extracto: 'Explora las diferentes formas de invertir en el sector inmobiliario y si es adecuado para ti.', contenido: 'Compra directa, REITs, crowdfunding inmobiliario. Flujo de caja vs. apreciación. Consideraciones fiscales.\n\nMercados emergentes a considerar.', fechaCreacion: '25/06/2024', fechaPublicacion: '30/06/2024', fechaPublicacionOriginal: true, fechaModificacion: '25/06/2024' }
                ];
                postsData.push(...samplePosts);
                postsTable.rows.add(samplePosts).draw();
                updateStats();
            }
            loadSampleData(); 
        });
    </script>
