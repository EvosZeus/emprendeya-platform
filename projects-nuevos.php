<?php
// project-nuevos.php
// Si esta página se carga a través de index.php, la sesión ya debería estar iniciada.
// Si es independiente y requiere sesión, descomenta las siguientes líneas:
/*
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['user_id'])) {
  header('Location: landing.html'); 
  exit;
}
*/

// Opcional: Cargar la lista de sectores dinámicamente para el filtro
// Si $conn no está disponible aquí (porque es una página cargada por AJAX sin PHP directo que incluya database.php)
// entonces las opciones del select deben ser hardcodeadas o cargadas por otro AJAX.
// Por simplicidad, las opciones están hardcodeadas en el HTML más abajo.
/*
require_once __DIR__ . '/config/database.php'; // Ajusta la ruta si es necesario
$sectores_unicos_nuevos = [];
if (isset($conn) && $conn) {
    $result_sectores = pg_query($conn, "SELECT DISTINCT sector FROM proyectos WHERE sector IS NOT NULL AND sector != '' AND (estado ILIKE 'aprobado' OR estado ILIKE 'activo') ORDER BY sector ASC");
    if ($result_sectores) {
        while ($row_sector = pg_fetch_assoc($result_sectores)) {
            $sectores_unicos_nuevos[] = htmlspecialchars($row_sector['sector'], ENT_QUOTES, 'UTF-8');
        }
    }
    // No cerramos $conn si es manejado globalmente por index.php
}
*/
?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3 text-info"><i class="fas fa-lightbulb me-2"></i> Proyectos Nuevos</h3>
        </div>

        <div class="card card-round shadow-sm mt-3">
            <div class="card-body">
                <!-- Filtros -->
                <div class="row mb-4 align-items-end gx-2">
                    <div class="col-md-5 col-lg-4 mb-2 mb-md-0">
                        <label for="buscar-nuevos-input" class="form-label fw-medium small">Buscar en Nuevos Proyectos:</label>
                        <input type="text" id="buscar-nuevos-input" class="form-control form-control-sm" placeholder="Nombre del proyecto...">
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2 mb-md-0">
                        <label for="filtro-sector-nuevos-select" class="form-label fw-medium small">Filtrar por Sector:</label>
                        <select id="filtro-sector-nuevos-select" class="form-select form-select-sm">
                            <option value="todos">Todos los Sectores</option>
                            <?php
                                /* if (!empty($sectores_unicos_nuevos)) {
                                    foreach ($sectores_unicos_nuevos as $sector_opt) {
                                        echo "<option value=\"{$sector_opt}\">{$sector_opt}</option>";
                                    }
                                } else { */
                            ?>
                                    <option value="Tecnología">Tecnología</option>
                                    <option value="Educación">Educación</option>
                                    <option value="Salud">Salud</option>
                                    <option value="Agroindustria">Agroindustria</option>
                                    <option value="Finanzas">Finanzas</option>
                                    <option value="Medio Ambiente">Medio Ambiente</option>
                                    <option value="Turismo">Turismo</option>
                                    <option value="Moda">Moda</option>
                                    <option value="Comercio">Comercio</option>
                                    <option value="Otro">Otro</option>
                            <?php /* } */ ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <button id="btn-aplicar-filtros-nuevos" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-search me-1"></i> Buscar
                        </button>
                    </div>
                </div>

                <!-- Indicador de Carga y Errores -->
                <div id="loading-nuevos-list" class="text-center py-5" style="display: none;">
                    <div class="spinner-border text-info" role="status" style="width: 3rem; height: 3rem;"></div>
                    <p class="mt-2">Cargando proyectos nuevos...</p>
                </div>
                <div id="error-nuevos-list" class="alert alert-danger text-center" style="display: none;"></div>
                <div id="no-nuevos-found" class="alert alert-info text-center" style="display: none;">
                    No hay proyectos nuevos que coincidan con tu búsqueda o aún no se han publicado.
                </div>

                <!-- Contenedor para el Carrusel de Proyectos Nuevos -->
                <div id="nuevos-proyectos-carousel-container" class="owl-carousel owl-theme">
                    <!-- Los items (tarjetas de proyecto) se insertarán aquí por JavaScript -->
                    <!-- Ejemplo de cómo se vería un item generado por JS (para referencia):
                    <div class="item"> 
                        <div class="card project-card-item h-100 shadow-sm border-2 border-info">
                            <div class="position-absolute top-0 end-0 m-2 z-2">
                                <span class="badge bg-info text-white rounded-pill px-2 py-1 shadow-sm"><i class="fas fa-bolt fa-xs"></i> Nuevo</span>
                            </div>
                            <img src="assets/img/examples/project_default.png" class="card-img-top" alt="Logo Proyecto" style="height: 180px; object-fit: contain; padding:10px; background-color:#e3f2fd; border-bottom: 1px solid #b3e5fc;">
                            <div class="card-body d-flex flex-column p-3">
                                <span class="badge bg-secondary text-white mb-2 align-self-start" style="font-size: 0.75rem;">Sector</span>
                                <h5 class="card-title mb-1" style="font-size: 1.1rem; font-weight: 600;">
                                    <a href="#" class="text-dark menu-link stretched-link" data-page="project-detail&id_proyecto=1" title="Nombre Proyecto">Nombre Proyecto Nuevo</a>
                                </h5>
                                <p class="card-text text-muted small mb-2" style="font-size:0.8rem;">Etapa: Idea</p>
                                <p class="card-text text-muted small flex-grow-1 fst-italic" style="font-size:0.85rem; min-height: 55px;">"Eslogan o resumen corto"</p> 
                                <div class="progress mb-2" style="height: 8px; border-radius: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="card-text mb-3"><small class="text-muted">Meta: $20.000</small></p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-info btn-sm btn-round menu-link text-white" data-page="project-detail&id_proyecto=1">Ver Detalles</a>
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-round contact-project-btn" 
                                            data-bs-toggle="modal" data-bs-target="#projectContactModal"
                                            data-project-id="1" data-project-name="Nombre Proyecto Nuevo"
                                            data-contact-name="Nombre Contacto" data-owner-email="correo@dueño.com">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer bg-lightsmall border-top-0 pt-2 pb-2 px-3 text-center">
                                 <small class="text-muted d-block" style="font-size:0.75rem;"><i class="fas fa-user me-1"></i>Por: Nombre Creador</small>
                                 <small class="text-muted d-block" style="font-size:0.75rem;"><i class="fas fa-calendar-alt me-1"></i>15 Jun, 2025</small>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

                <!-- Contenedor para la Paginación (si se usa con el carrusel) -->
                <nav aria-label="Navegación de proyectos nuevos" class="mt-4">
                    <ul id="nuevos-pagination-container" class="pagination justify-content-center">
                        <!-- Los items de paginación se insertarán aquí -->
                    </ul>
                </nav>

            </div> <!-- Fin card-body -->
        </div> <!-- Fin card -->
    </div> <!-- Fin page-inner -->
</div> <!-- Fin container -->

<!-- Modal de Contacto (Reutilizado de project-list.php y project-destacados.php) -->
<div class="modal fade" id="projectContactModal" tabindex="-1" aria-labelledby="projectContactModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> 
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="projectContactModalTitle">Contactar Proyecto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6 class="mb-1">Proyecto: <strong id="modalProjectName" class="text-primary"></strong></h6>
                    <p class="mb-0 text-muted small">Contacto: <span id="modalContactName"></span></p>
                </div>
                <form id="projectMessageForm">
                    <input type="hidden" id="modalProjectId" name="project_id_to_contact">
                    <input type="hidden" id="modalProjectOwnerEmail" name="project_owner_email">
                    <div class="mb-3">
                        <label for="modalUserName" class="form-label">Tu Nombre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="modalUserName" name="user_name" required placeholder="Ej: Juan Pérez">
                    </div>
                     <div class="mb-3">
                        <label for="modalUserEmail" class="form-label">Tu Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="modalUserEmail" name="user_email" required placeholder="Ej: tuemail@dominio.com">
                    </div>
                    <div class="mb-3">
                        <label for="modalMessage" class="form-label">Tu Mensaje <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="modalMessage" name="message" placeholder="Escribe tu mensaje para el emprendedor..." rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-paper-plane me-2"></i>Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
function inicializarPaginaActual() {
    console.log("PROJECT-NUEVOS.PHP: inicializarPaginaActual() ejecutada.");

    const $carouselContainer = $('#nuevos-proyectos-carousel-container');
    const $loadingIndicator = $('#loading-nuevos-list');
    const $errorIndicator = $('#error-nuevos-list');
    const $noProjectsFound = $('#no-nuevos-found');
    const $paginationContainer = $('#nuevos-pagination-container');
    const $buscarInput = $('#buscar-nuevos-input');
    const $sectorSelect = $('#filtro-sector-nuevos-select'); // Asegúrate que el ID sea correcto
    const $btnAplicarFiltros = $('#btn-aplicar-filtros-nuevos');

    let currentPage = 1;
    const projectsPerPage = 9; // O el número de items que quieras por "página" del carrusel

    function fetchNuevosProyectos() {
        const searchTerm = $buscarInput.val().trim();
        const selectedSector = $sectorSelect.val();

        $loadingIndicator.show();
        $errorIndicator.hide();
        $noProjectsFound.hide();
        
        if ($carouselContainer.hasClass('owl-loaded')) {
            $carouselContainer.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-theme owl-loaded owl-drag owl-hidden');
        }
        $carouselContainer.html('');
        $paginationContainer.html('');

        console.log("PROJECT-NUEVOS.PHP: Fetching nuevos - Página:", currentPage, "Buscar:", searchTerm, "Sector:", selectedSector);

        $.ajax({
            url: 'backend-php/get_nuevos_proyectos.php', // APUNTA AL NUEVO SCRIPT PHP
            type: 'GET',
            dataType: 'json',
            data: {
                pagina: currentPage,
                por_pagina: projectsPerPage,
                buscar: searchTerm,
                sector: selectedSector
            },
            success: function(response) {
                $loadingIndicator.hide();
                console.log("PROJECT-NUEVOS.PHP: Respuesta de get_nuevos_proyectos.php:", response);
                if (response && response.success && response.data && Array.isArray(response.data) && response.data.length > 0) {
                    renderNuevosProjectCards(response.data); // Usar una función de renderizado específica si el diseño cambia
                    
                    if (typeof $.fn.owlCarousel === 'function') {
                        $carouselContainer.addClass('owl-carousel owl-theme');
                        $carouselContainer.owlCarousel({
                            loop: response.data.length > 3, // Ajustar según items visibles
                            margin: 20,
                            nav: true,
                            dots: true,
                            autoplay:true, // Quizás no quieras autoplay para "nuevos"
                            autoplayTimeout:6000,
                            autoplayHoverPause:true,
                            navText: ["<i class='fas fa-chevron-left p-2 bg-white text-primary rounded-circle shadow-sm'></i>", "<i class='fas fa-chevron-right p-2 bg-white text-primary rounded-circle shadow-sm'></i>"],
                            responsive:{
                                0:{ items:1, stagePadding: 30 },
                                576:{ items:2, stagePadding: 20 },
                                768:{ items:2, stagePadding: 30 },
                                992:{ items:3 },
                                1200:{ items:3 },
                                1400:{ items:4 }
                            }
                        });
                        console.log("PROJECT-NUEVOS.PHP: Owl Carousel inicializado.");
                    } else {
                        console.warn("PROJECT-NUEVOS.PHP: Owl Carousel no está definido.");
                        $errorIndicator.text('Error de configuración: El carrusel no pudo cargarse.').show();
                    }

                    if (response.pagination && response.pagination.total_paginas > 1) {
                        renderNuevosPagination(response.pagination);
                    }
                } else if (response && response.data && response.data.length === 0) {
                    $noProjectsFound.show();
                } else {
                    let errorMsg = 'No se pudieron cargar los proyectos nuevos.';
                    if(response && response.message) errorMsg = response.message;
                    $errorIndicator.text(errorMsg).show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $loadingIndicator.hide();
                $errorIndicator.text('Error de conexión o del servidor al cargar proyectos nuevos.').show();
                console.error("PROJECT-NUEVOS.PHP: Error AJAX:", textStatus, errorThrown, jqXHR.responseText);
            }
        });
    }

    // La función renderNuevosProjectCards puede ser idéntica a renderDestacadosCards
    // o a renderProjectCards de project-list.php, solo cambiando el color del badge/borde si quieres.
    // Por simplicidad, la reutilizaremos con pequeños cambios en el estilo de la tarjeta si es necesario.
    function renderNuevosProjectCards(proyectos) {
        let html = '';
        proyectos.forEach(function(p) {
            const detalleProyectoDataPage = `project-detail&id_proyecto=${p.id_proyecto}`;
            let displayText = '';
            if (p.eslogan && p.eslogan.trim() !== '') { displayText = `"${p.eslogan}"`; }
            else if (p.resumen_acortado && p.resumen_acortado.trim() !== '' && p.resumen_acortado !== '...') { displayText = p.resumen_acortado; }
            else { displayText = 'Descripción no disponible.'; }

            // Tarjeta con un estilo ligeramente diferente para "Nuevos" 
            html += `
                <div class="item">
                    <div class="card project-card-item h-100 shadow-sm border-2 border-info"> 
                        <div class="position-absolute top-0 end-0 m-2 z-2">
                            <span class="badge bg-info text-white rounded-pill px-2 py-1 shadow-sm"><i class="fas fa-bolt fa-xs"></i> Nuevo</span>
                        </div>
                        <img src="${p.logo_proyecto}" class="card-img-top" alt="Logo ${p.nombre_proyecto}" style="height: 180px; object-fit: contain; padding:10px; background-color:#e3f2fd; border-bottom: 1px solid #b3e5fc;">
                        <div class="card-body d-flex flex-column p-3">
                            <span class="badge bg-secondary text-white mb-2 align-self-start" style="font-size: 0.75rem;">${p.sector}</span>
                            <h5 class="card-title mb-1" style="font-size: 1.1rem; font-weight: 600;">
                                <a href="#" class="text-dark menu-link stretched-link" data-page="${detalleProyectoDataPage}" title="${p.nombre_proyecto}">${p.nombre_proyecto}</a>
                            </h5>
                            <p class="card-text text-muted small mb-2" style="font-size:0.8rem;">Etapa: ${p.etapa}</p>
                            <p class="card-text text-muted small flex-grow-1 fst-italic" style="font-size:0.85rem; min-height: 55px;">${displayText}</p>
                            <div class="progress mb-2" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: ${p.progreso_simulado}%;" aria-valuenow="${p.progreso_simulado}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="card-text mb-3"><small class="text-muted">Meta: ${p.monto_inversion_formateado}</small></p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-info btn-sm btn-round menu-link text-white" data-page="${detalleProyectoDataPage}">Ver Detalles</a>
                                <button type="button" class="btn btn-outline-secondary btn-sm btn-round contact-project-btn" 
                                        data-bs-toggle="modal" data-bs-target="#projectContactModal"
                                        data-project-id="${p.id_proyecto}" 
                                        data-project-name="${p.nombre_proyecto}"
                                        data-contact-name="${p.contacto_proyecto_nombre || p.nombre_creador}"
                                        data-owner-email="${p.email_creador || ''}">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer bg-lightsmall border-top-0 pt-2 pb-2 px-3 text-center">
                             <small class="text-muted d-block" style="font-size:0.75rem;"><i class="fas fa-user me-1"></i>Por: ${p.nombre_creador}</small>
                             <small class="text-muted d-block" style="font-size:0.75rem;"><i class="fas fa-calendar-alt me-1"></i>${p.fecha_formateada}</small>
                        </div>
                    </div>
                </div>
            `;
        });
        $carouselContainer.html(html); // Usar el contenedor del carrusel
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl) });
    }

    function renderNuevosPagination(pagination) {
        // ... (Lógica de renderPagination, idéntica a la de project-destacados.php, pero usa $paginationContainer)
        if (!pagination || pagination.total_paginas <= 1) { $paginationContainer.html(''); return; }
        let html = '';
        html += `<li class="page-item ${pagination.pagina_actual === 1 ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${pagination.pagina_actual - 1}" aria-label="Anterior"><span aria-hidden="true">«</span></a></li>`;
        const maxPagesToShow = 5;
        let startPage = Math.max(1, pagination.pagina_actual - Math.floor(maxPagesToShow / 2));
        let endPage = Math.min(pagination.total_paginas, startPage + maxPagesToShow - 1);
        if (endPage - startPage + 1 < maxPagesToShow && startPage > 1) { startPage = Math.max(1, endPage - maxPagesToShow + 1); }
        if (endPage - startPage + 1 < maxPagesToShow && endPage < pagination.total_paginas) { endPage = Math.min(pagination.total_paginas, startPage + maxPagesToShow - 1); }
        if (startPage > 1) { html += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`; if (startPage > 2) { html += `<li class="page-item disabled"><span class="page-link">...</span></li>`; } }
        for (let i = startPage; i <= endPage; i++) { html += `<li class="page-item ${i === pagination.pagina_actual ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`; }
        if (endPage < pagination.total_paginas) { if (endPage < pagination.total_paginas - 1) { html += `<li class="page-item disabled"><span class="page-link">...</span></li>`; } html += `<li class="page-item"><a class="page-link" href="#" data-page="${pagination.total_paginas}">${pagination.total_paginas}</a></li>`; }
        html += `<li class="page-item ${pagination.pagina_actual === pagination.total_paginas ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${pagination.pagina_actual + 1}" aria-label="Siguiente"><span aria-hidden="true">»</span></a></li>`;
        $paginationContainer.html(html);
    }

    // Event Listeners
    $btnAplicarFiltros.on('click', function() { currentPage = 1; fetchNuevosProyectos(); });
    $buscarInput.on('keypress', function(e) { if (e.which === 13) { $btnAplicarFiltros.click(); } });
    $sectorSelect.on('change', function() { $btnAplicarFiltros.click(); });

    $paginationContainer.on('click', 'a.page-link', function(e) {
        e.preventDefault();
        if ($(this).parent().hasClass('disabled') || $(this).parent().hasClass('active')) return;
        currentPage = parseInt($(this).data('page'));
        fetchNuevosProyectos();
        if($carouselContainer.length && $carouselContainer.offset()){
             $('html, body').animate({ scrollTop: ($carouselContainer.offset().top - 120) }, 300);
        }
    });
    
    // Lógica del Modal de Contacto (debe adjuntarse al contenedor del carrusel)
    $carouselContainer.on('click', '.contact-project-btn', function() {
        const projectId = $(this).data('project-id');
        const projectName = $(this).data('project-name');
        const contactName = $(this).data('contact-name');
        const ownerEmail = $(this).data('owner-email'); 

        $('#projectContactModalTitle').text('Contactar Proyecto: ' + projectName);
        $('#modalProjectName').text(projectName);
        $('#modalContactName').text(contactName);
        $('#modalProjectId').val(projectId);
        $('#modalProjectOwnerEmail').val(ownerEmail); 
        $('#modalMessage').val('');
        $('#modalUserName').val(''); 
        $('#modalUserEmail').val('');
    });

    // Listener para el envío del formulario del modal de contacto (si no está global)
    if ($('#projectMessageForm').length && !$._data($('#projectMessageForm')[0], 'events')?.submit) {
        $('#projectMessageForm').on('submit', function(e){
            e.preventDefault();
            console.log("Enviando mensaje (simulación)... Datos:", $(this).serialize());
            if(typeof showAlertGlobally === 'function') {
                showAlertGlobally('info', 'Simulación', `El envío de mensajes aún no está implementado.`);
            } else {
                alert("El envío de mensajes aún no está implementado.");
            }
            $('#projectContactModal').modal('hide');
        });
    }
    // Función showAlert global (si no la tienes ya en un script global accesible)
    function showAlertGlobally(type, title, message) { // Renombrada para evitar colisión si la tienes en otro lado
        if (typeof swal === 'function') {
            swal({
                icon: type, title: title, text: message,
                buttons: { confirm: { text: "OK", value: true, visible: true, className: "btn btn-primary", closeModal: true }},
                timer: type === 'success' ? 2000 : 3500
            });
        } else {
            console.warn("SweetAlert (swal) no está definido. Usando alert() por defecto.");
            alert(title + ": " + message);
        }
    }


    fetchNuevosProyectos(); // Carga inicial

    console.log("PROJECT-NUEVOS.PHP: Fin de inicializarPaginaActual().");
}
</script>