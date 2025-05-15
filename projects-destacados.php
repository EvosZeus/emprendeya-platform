<?php
// Al inicio de project-destacados.php (o en index.php antes de incluirlo)

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Asegura que la sesión esté activa
}

// Es buena idea verificar user_id aquí también si esta página requiere login
if (!isset($_SESSION['user_id'])) {
    header('Location: landing.html');
    exit;
}

// Obtener el rol del usuario actual desde la sesión
$rol_usuario_actual = $_SESSION['user_role'] ?? 'Invitado'; // Rol por defecto si no está en sesión

// Comparación insensible a mayúsculas/minúsculas con 'Administrador'
$es_administrador = (strcasecmp($rol_usuario_actual, 'Administrador') == 0);

?>

<div class="container">
    <div class="page-inner">
        <!-- En el HTML de project-destacados.php -->
        <div class="page-header d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1 text-warning"><i class="fas fa-star me-2"></i> Proyectos Destacados</h3>
                <p class="mb-0 text-muted page-category">Explora los proyectos seleccionados por su potencial e innovación.</p>
            </div>
            <?php if ($es_administrador): ?>
                <div class="ms-auto py-2 py-md-0">
                    <button id="btn-gestionar-destacados" class="btn btn-warning btn-round btn-sm">
                        <i class="fas fa-edit me-1"></i> Gestionar Destacados
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <div class="card card-round shadow-sm">
            <div class="card-body">
                <!-- Filtros (simplificado para destacados) -->
                <div class="row mb-4 align-items-end gx-3">
                    <div class="col-lg-4 col-md-6 ms-md-auto"> <!-- Alineado a la derecha -->
                        <label for="buscar-destacado-input" class="form-label fw-medium small d-block">Buscar en Destacados:</label>
                        <div class="input-group input-group-sm">
                            <input type="text" id="buscar-destacado-input" class="form-control" placeholder="Nombre del proyecto...">
                            <button id="btn-aplicar-filtros-destacados" class="btn btn-secondary" type="button" title="Buscar"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Indicador de Carga y Errores -->
                <div id="loading-destacados-list" class="text-center py-5" style="display: none;">
                    <div class="spinner-border text-warning" role="status" style="width: 3rem; height: 3rem;"></div>
                    <p class="mt-2">Cargando proyectos destacados...</p>
                </div>
                <div id="error-destacados-list" class="alert alert-danger text-center" style="display: none;"></div>
                <div id="no-destacados-found" class="alert alert-info text-center" style="display: none;">
                    Actualmente no hay proyectos destacados o que coincidan con tu búsqueda.
                </div>

                <!-- Contenedor para las Tarjetas de Proyecto Destacado -->
                <div id="destacados-list-container" class="row">
                    <!-- Las tarjetas de proyectos destacados se insertarán aquí por JavaScript -->
                    <!-- Ejemplo de cómo se vería una tarjeta (generada por JS):
                    <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                        <div class="card project-card-item h-100 shadow-sm border-2 border-warning">
                            <div class="position-absolute top-0 end-0 m-2 z-2">
                                <span class="badge bg-warning text-dark rounded-pill px-2 py-1 shadow-sm"><i class="fas fa-star fa-xs"></i> Destacado</span>
                            </div>
                            <img src="assets/img/examples/project_default.png" class="card-img-top" alt="Logo Proyecto" style="height: 180px; object-fit: contain; padding:10px; background-color:#fff9e6; border-bottom: 1px solid #ffecb3;">
                            <div class="card-body d-flex flex-column p-3">
                                <span class="badge bg-secondary text-white mb-2 align-self-start" style="font-size: 0.75rem;">Sector</span>
                                <h5 class="card-title mb-1" style="font-size: 1.1rem; font-weight: 600;">
                                    <a href="#" class="text-dark menu-link stretched-link" data-page="project-detail&id_proyecto=1" title="Nombre Proyecto">Nombre Proyecto Destacado</a>
                                </h5>
                                <p class="card-text text-muted small mb-2" style="font-size:0.8rem;">Etapa: MVP</p>
                                <p class="card-text text-muted small flex-grow-1 fst-italic" style="font-size:0.85rem; min-height: 55px;">"Eslogan del proyecto o resumen corto."</p> 
                                
                                <div class="progress mb-2" style="height: 8px; border-radius: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="card-text mb-3"><small class="text-muted">Meta: $100.000</small></p>
                                
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-warning btn-sm btn-round menu-link text-dark" data-page="project-detail&id_proyecto=1">Ver Detalles</a>
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-round contact-project-btn" 
                                            data-bs-toggle="modal" data-bs-target="#projectContactModal"
                                            data-project-id="1" data-project-name="Nombre Proyecto Destacado"
                                            data-contact-name="Nombre Contacto" data-owner-email="correo@dueño.com">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer bg-lightsmall border-top-0 pt-2 pb-2 px-3 text-center">
                                 <small class="text-muted d-block" style="font-size:0.75rem;"><i class="fas fa-user me-1"></i>Por: Nombre Creador</small>
                                 <small class="text-muted d-block" style="font-size:0.75rem;"><i class="fas fa-calendar-alt me-1"></i>15 May, 2025</small>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

                <!-- Contenedor para la Paginación -->
                <nav aria-label="Navegación de proyectos destacados" class="mt-4">
                    <ul id="destacados-pagination-container" class="pagination justify-content-center">
                        <!-- Los items de paginación se insertarán aquí -->
                    </ul>
                </nav>
            </div> <!-- Fin card-body -->
        </div> <!-- Fin card -->
    </div> <!-- Fin page-inner -->
</div> <!-- Fin container -->

<!-- Modal de Contacto (Reutilizado de project-list.php) -->
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


<!-- TODO: Modal para Gestionar Destacados (para el Administrador) -->
<!-- 
<div class="modal fade" id="gestionarDestacadosModal" tabindex="-1" aria-labelledby="gestionarDestacadosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gestionarDestacadosModalLabel">Gestionar Proyectos Destacados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Aquí se cargaría una lista de todos los proyectos (o con filtros) 
                   con checkboxes o botones para marcarlos/desmarcarlos como destacados.</p>
                <p>Se necesitaría AJAX para cargar los proyectos y para guardar los cambios.</p>
                 Contenido del modal de gestión aquí...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn-guardar-cambios-destacados">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
-->

<!-- En project-destacados.php -->

<!-- Modal para Gestionar Proyectos Destacados (SOLO PARA ADMIN) -->
<div class="modal fade" id="gestionarDestacadosModal" tabindex="-1" aria-labelledby="gestionarDestacadosModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable"> <!-- modal-xl para más espacio -->
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark"> <!-- Color warning para destacados -->
                <h5 class="modal-title" id="gestionarDestacadosModalLabel"><i class="fas fa-star me-2"></i>Gestionar Proyectos Destacados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info small">
                    <i class="fas fa-info-circle me-1"></i> Aquí puedes seleccionar qué proyectos aparecerán en la sección de "Destacados". Solo se listan proyectos con estado 'Aprobado' o 'Activo'.
                </div>
                <div class="row mb-3 gx-2">
                    <div class="col-md-5"> <!-- Más espacio para búsqueda por nombre -->
                        <input type="text" id="admin-buscar-proyectos-destacados-input" class="form-control form-control-sm" placeholder="Buscar proyecto por nombre para gestionar...">
                    </div>
                    <!-- Opcional: Filtro por sector si es útil para encontrar proyectos a destacar -->
                    <!--
                    <div class="col-md-3">
                        <select id="admin-filtro-sector-destacados-select" class="form-select form-select-sm">
                            <option value="todos">Todos los Sectores</option>
                            <option value="Tecnología">Tecnología</option>
                            ... más opciones ...
                        </select>
                    </div>
                    -->
                    <div class="col-md-2">
                        <button id="admin-btn-filtrar-proyectos-destacados" class="btn btn-secondary btn-sm w-100">Filtrar</button>
                    </div>
                </div>

                <div id="admin-loading-proyectos-destacados" class="text-center py-4" style="display: none;">
                    <div class="spinner-border text-warning" role="status"></div> <!-- Spinner warning -->
                    <p class="mt-2">Cargando lista de proyectos...</p>
                </div>
                <div id="admin-error-proyectos-destacados" class="alert alert-danger" style="display: none;"></div>

                <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                    <table class="table table-sm table-striped table-hover">
                        <thead class="table-light sticky-top" style="z-index:1;">
                            <tr>
                                <th style="width: 50px;">ID</th>
                                <th>Nombre del Proyecto</th>
                                <th>Creador</th>
                                <th>Estado Actual</th>
                                <th style="width: 150px;" class="text-center">Destacar</th>
                            </tr>
                        </thead>
                        <tbody id="admin-lista-proyectos-destacados-container">
                            <!-- La lista de proyectos con checkboxes se cargará aquí -->
                        </tbody>
                    </table>
                </div>
                <div id="admin-no-proyectos-destacados" class="alert alert-light text-center mt-3" style="display: none;">
                    No se encontraron proyectos (aprobados/activos) con los filtros aplicados.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-round" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success btn-round" id="btn-guardar-cambios-gestion-destacados"> <!-- Nuevo ID para el botón de guardar -->
                    <i class="fas fa-save me-1"></i> Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function inicializarPaginaActual() {
    console.log("PROJECT-DESTACADOS.PHP: inicializarPaginaActual() ejecutada.");

    // --- Selectores para la vista pública de destacados ---
    const $destacadosListContainer = $('#destacados-list-container');
    const $loadingIndicatorPublic = $('#loading-destacados-list');
    const $errorIndicatorPublic = $('#error-destacados-list');
    const $noDestacadosFoundPublic = $('#no-destacados-found');
    const $paginationContainerPublic = $('#destacados-pagination-container');
    const $buscarInputPublic = $('#buscar-destacado-input');
    const $btnAplicarFiltrosPublic = $('#btn-aplicar-filtros-destacados');

    // --- Selectores para el Modal de Gestión de DESTACADOS (Admin) ---
    const $btnOpenGestionarDestacados = $('#btn-gestionar-destacados');
    const $gestionarDestacadosAdminModal = $('#gestionarDestacadosModal'); // ID del HTML del modal
    const $adminListaDestacadosTbody = $('#admin-lista-proyectos-destacados-container'); // ID del tbody de la tabla en el modal
    const $adminLoadingDestacados = $('#admin-loading-proyectos-destacados');
    const $adminErrorDestacados = $('#admin-error-proyectos-destacados');
    const $adminNoProyectosDestacados = $('#admin-no-proyectos-destacados');
    const $adminBuscarDestacadosInput = $('#admin-buscar-proyectos-destacados-input');
    const $adminBtnFiltrarDestacados = $('#admin-btn-filtrar-proyectos-destacados'); // Botón de filtro dentro del modal
    const $btnGuardarGestionDestacados = $('#btn-guardar-cambios-gestion-destacados'); // Botón de guardar del modal

    let currentPageDestacados = 1;
    const projectsPerPageDestacados = 6;
    let originalFeaturedStates = {}; // Para rastrear cambios en el modal de admin

    // --- Función para cargar y mostrar proyectos DESTACADOS (vista pública) ---
    function fetchDestacados() {
        const searchTerm = $buscarInputPublic.val().trim();
        $loadingIndicatorPublic.show();
        $errorIndicatorPublic.hide();
        $noDestacadosFoundPublic.hide();
        $destacadosListContainer.html('');
        $paginationContainerPublic.html('');
        // console.log("PROJECT-DESTACADOS.PHP (Public): Fetching - Página:", currentPageDestacados, "Buscar:", searchTerm);
        $.ajax({
            url: 'backend-php/get_destacados.php',
            type: 'GET', dataType: 'json',
            data: { pagina: currentPageDestacados, por_pagina: projectsPerPageDestacados, buscar: searchTerm },
            success: function(response) {
                $loadingIndicatorPublic.hide();
                if (response && response.success && response.data && Array.isArray(response.data) && response.data.length > 0) {
                    renderDestacadosCards(response.data);
                    if (response.pagination && response.pagination.total_paginas > 1) {
                        renderDestacadosPagination(response.pagination);
                    }
                } else if (response && response.data && response.data.length === 0) {
                    $noDestacadosFoundPublic.show();
                } else {
                    $errorIndicatorPublic.text(response.message || 'No se pudieron cargar los proyectos destacados.').show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $loadingIndicatorPublic.hide();
                $errorIndicatorPublic.text('Error de conexión o del servidor al cargar destacados (vista pública).').show();
                console.error("PROJECT-DESTACADOS.PHP (Public) AJAX Error:", textStatus, errorThrown, jqXHR.responseText);
            }
        });
    }

    // --- Función para renderizar las tarjetas de proyectos DESTACADOS (vista pública) ---
    function renderDestacadosCards(proyectos) {
        let html = '';
        proyectos.forEach(function(p) {
            const detalleProyectoDataPage = `project-detail&id_proyecto=${p.id_proyecto}`;
            let displayText = (p.eslogan && p.eslogan.trim() !== '') ? `"${p.eslogan}"` : ((p.resumen_acortado && p.resumen_acortado.trim() !== '' && p.resumen_acortado !== '...') ? p.resumen_acortado : 'Descripción no disponible.');
            html += `
                <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                    <div class="card project-card-item h-100 shadow-sm border-2 border-warning">
                        <div class="position-absolute top-0 end-0 m-2 z-2"><span class="badge bg-warning text-dark rounded-pill px-2 py-1 shadow-sm"><i class="fas fa-star fa-xs"></i> Destacado</span></div>
                        <img src="${p.logo_proyecto}" class="card-img-top" alt="Logo ${p.nombre_proyecto}" style="height: 180px; object-fit: contain; padding:10px; background-color:#fff9e6; border-bottom: 1px solid #ffecb3;">
                        <div class="card-body d-flex flex-column p-3">
                            <span class="badge bg-secondary text-white mb-2 align-self-start" style="font-size: 0.75rem;">${p.sector}</span>
                            <h5 class="card-title mb-1" style="font-size: 1.1rem; font-weight: 600;"><a href="#" class="text-dark menu-link stretched-link" data-page="${detalleProyectoDataPage}" title="${p.nombre_proyecto}">${p.nombre_proyecto}</a></h5>
                            <p class="card-text text-muted small mb-2" style="font-size:0.8rem;">Etapa: ${p.etapa}</p>
                            <p class="card-text text-muted small flex-grow-1 fst-italic" style="font-size:0.85rem; min-height: 55px;">${displayText}</p>
                            <div class="progress mb-2" style="height: 8px; border-radius: 4px;"><div class="progress-bar bg-warning" role="progressbar" style="width: ${p.progreso_simulado}%;" aria-valuenow="${p.progreso_simulado}" aria-valuemin="0" aria-valuemax="100"></div></div>
                            <p class="card-text mb-3"><small class="text-muted">Meta: ${p.monto_inversion_formateado}</small></p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-warning btn-sm btn-round menu-link text-dark" data-page="${detalleProyectoDataPage}">Ver Detalles</a>
                                <button type="button" class="btn btn-outline-secondary btn-sm btn-round contact-project-btn" data-bs-toggle="modal" data-bs-target="#projectContactModal" data-project-id="${p.id_proyecto}" data-project-name="${p.nombre_proyecto}" data-contact-name="${p.contacto_proyecto_nombre || p.nombre_creador}" data-owner-email="${p.email_creador || ''}"><i class="fas fa-envelope"></i></button>
                            </div>
                        </div>
                        <div class="card-footer bg-lightsmall border-top-0 pt-2 pb-2 px-3 text-center">
                             <small class="text-muted d-block" style="font-size:0.75rem;"><i class="fas fa-user me-1"></i>Por: ${p.nombre_creador}</small>
                             <small class="text-muted d-block" style="font-size:0.75rem;"><i class="fas fa-calendar-alt me-1"></i>${p.fecha_formateada}</small>
                        </div>
                    </div>
                </div>`;
        });
        $destacadosListContainer.html(html);
        var tooltipTriggerList = [].slice.call($destacadosListContainer[0].querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl) });
    }

    function renderDestacadosPagination(pagination) {
        if (!pagination || pagination.total_paginas <= 1) { $paginationContainerPublic.html(''); return; }
        let html = '';
        html += `<li class="page-item ${pagination.pagina_actual === 1 ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${pagination.pagina_actual - 1}" aria-label="Anterior"><span aria-hidden="true">«</span></a></li>`;
        const maxPagesToShow = 5; let startPage = Math.max(1, pagination.pagina_actual - Math.floor(maxPagesToShow / 2)); let endPage = Math.min(pagination.total_paginas, startPage + maxPagesToShow - 1);
        if (endPage - startPage + 1 < maxPagesToShow && startPage > 1) { startPage = Math.max(1, endPage - maxPagesToShow + 1); } if (endPage - startPage + 1 < maxPagesToShow && endPage < pagination.total_paginas) { endPage = Math.min(pagination.total_paginas, startPage + maxPagesToShow - 1); }
        if (startPage > 1) { html += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`; if (startPage > 2) { html += `<li class="page-item disabled"><span class="page-link">...</span></li>`; } }
        for (let i = startPage; i <= endPage; i++) { html += `<li class="page-item ${i === pagination.pagina_actual ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`; }
        if (endPage < pagination.total_paginas) { if (endPage < pagination.total_paginas - 1) { html += `<li class="page-item disabled"><span class="page-link">...</span></li>`; } html += `<li class="page-item"><a class="page-link" href="#" data-page="${pagination.total_paginas}">${pagination.total_paginas}</a></li>`; }
        html += `<li class="page-item ${pagination.pagina_actual === pagination.total_paginas ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${pagination.pagina_actual + 1}" aria-label="Siguiente"><span aria-hidden="true">»</span></a></li>`;
        $paginationContainerPublic.html(html);
    }

    // =======================================================================
    // --- INICIO: LÓGICA PARA MODAL DE GESTIÓN DE DESTACADOS (Admin) ---
    // =======================================================================
    if ($btnOpenGestionarDestacados.length) { 
        
        $btnOpenGestionarDestacados.on('click', function() {
            console.log("PROJECT-DESTACADOS.PHP (Admin): Abriendo modal de gestión de DESTACADOS.");
            originalFeaturedStates = {}; 
            loadProjectsForFeaturedAdminModal($adminBuscarDestacadosInput.val().trim()); // Usa el input correcto
            $gestionarDestacadosAdminModal.modal('show');
        });

        $adminBtnFiltrarDestacados.on('click', function() { // Listener para el botón de filtro DENTRO del modal
            loadProjectsForFeaturedAdminModal($adminBuscarDestacadosInput.val().trim());
        });
        $adminBuscarDestacadosInput.on('keypress', function(e) { // Input de búsqueda del modal de destacados
            if (e.which === 13) { $adminBtnFiltrarDestacados.click(); }
        });

        $btnGuardarGestionDestacados.on('click', function() { // Botón de guardar del modal de destacados
            const $button = $(this);
            const cambiosFeatured = [];
            // Buscar los checkboxes DENTRO del tbody del modal de gestión de destacados
            $adminListaDestacadosTbody.find('.admin-manage-featured-checkbox').each(function() {
                const projectId = $(this).data('project-id');
                const isNowFeatured = $(this).is(':checked');
                
                if (originalFeaturedStates[projectId] !== undefined && originalFeaturedStates[projectId] !== isNowFeatured) {
                    cambiosFeatured.push({
                        id_proyecto: projectId,
                        es_destacado: isNowFeatured 
                    });
                }
            });

            if (cambiosFeatured.length === 0) {
                showAlertGloballyJsDestacados('info', 'Sin Cambios', 'No se modificó el estado destacado de ningún proyecto.');
                $gestionarDestacadosAdminModal.modal('hide');
                return;
            }

            console.log("PROJECT-DESTACADOS.PHP (Admin): Guardando cambios de destacados:", cambiosFeatured);
            $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Guardando...');

            $.ajax({
                url: 'backend-php/update_featured_status_admin.php', 
                type: 'POST',
                dataType: 'json',
                data: { cambios: JSON.stringify(cambiosFeatured) }, 
                success: function(response) {
                    console.log("PROJECT-DESTACADOS.PHP (Admin): Respuesta de update_featured_status_admin.php:", response);
                    if (response.success) {
                        showAlertGloballyJsDestacados('success', '¡Éxito!', 'Proyectos destacados actualizados.');
                        fetchDestacados(); // Recargar la lista pública
                    } else {
                        showAlertGloballyJsDestacados('error', 'Error', response.message || 'No se pudieron guardar los cambios.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showAlertGloballyJsDestacados('error', 'Error', 'Error de conexión al guardar los cambios.');
                    console.error("PROJECT-DESTACADOS.PHP (Admin Featured Save): Error AJAX:", textStatus, errorThrown, jqXHR.responseText);
                },
                complete: function() {
                    $button.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Guardar Cambios de Destacados');
                    $gestionarDestacadosAdminModal.modal('hide');
                }
            });
        });
    } 

    function loadProjectsForFeaturedAdminModal(searchTerm = '') {
        $adminLoadingDestacados.show();
        $adminErrorDestacados.hide();
        $adminNoProyectosDestacados.hide();
        $adminListaDestacadosTbody.html(''); // Limpiar tbody
        console.log("PROJECT-DESTACADOS.PHP (Admin Modal Featured): Cargando proyectos. Buscar:", searchTerm);

        $.ajax({
            url: 'backend-php/get_all_projects_for_admin.php', 
            type: 'GET',
            dataType: 'json',
            data: { buscar: searchTerm },
            success: function(response) {
                $adminLoadingDestacados.hide();
                if (response.success && response.data && Array.isArray(response.data)) {
                    if (response.data.length > 0) {
                        renderAdminFeaturedProjectList(response.data);
                    } else {
                        // Mostrar mensaje dentro de la tabla si no hay resultados
                        const colspan = $adminListaDestacadosTbody.closest('table').find('thead th').length || 5;
                        $adminListaDestacadosTbody.html(`<tr><td colspan="${colspan}" class="text-center text-muted p-3">No se encontraron proyectos (aprobados/activos)${searchTerm ? ' para "' + htmlspecialcharsJS(searchTerm) + '"' : ''}.</td></tr>`);
                    }
                } else {
                    $adminErrorDestacados.text(response.message || 'Error al cargar lista de proyectos para administrar.').show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $adminLoadingDestacados.hide();
                $adminErrorDestacados.text('Error de conexión al cargar proyectos para administrar.').show();
                console.error("PROJECT-DESTACADOS.PHP (Admin Modal Featured Load): Error AJAX:", textStatus, errorThrown, jqXHR.responseText);
            }
        });
    }

    function renderAdminFeaturedProjectList(proyectos) {
        let tbodyHtml = '';
        originalFeaturedStates = {}; 

        proyectos.forEach(function(p) {
            const esDestacadoBool = (String(p.es_destacado).toLowerCase() === 'true' || p.es_destacado === true || parseInt(p.es_destacado) === 1 || String(p.es_destacado).toLowerCase() === 't');
            originalFeaturedStates[p.id_proyecto] = esDestacadoBool; 
            
            // console.log(`AdminList - Proyecto ID: ${p.id_proyecto}, Es Destacado (recibido): ${p.es_destacado}, Convertido: ${esDestacadoBool}`);

            tbodyHtml += `
                <tr data-project-id="${p.id_proyecto}">
                    <td>${p.id_proyecto}</td>
                    <td>${p.nombre_proyecto}</td>
                    <td>${p.nombre_creador || 'N/A'}</td>
                    <td><span class="badge bg-${getBadgeClassForStatusAdmin(p.estado)}">${p.estado ? p.estado.charAt(0).toUpperCase() + p.estado.slice(1) : 'N/A'}</span></td>
                    <td class="text-center">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input admin-manage-featured-checkbox" type="checkbox" role="switch" 
                                   id="manage-destacado-${p.id_proyecto}" data-project-id="${p.id_proyecto}" 
                                   ${esDestacadoBool ? 'checked' : ''}>
                            <label class="form-check-label visually-hidden" for="manage-destacado-${p.id_proyecto}">Destacar</label>
                        </div>
                    </td>
                </tr>
            `;
        });
        $adminListaDestacadosTbody.html(tbodyHtml);
    }
    
    // --- Funciones Auxiliares ---
    function getBadgeClassForStatusAdmin(status) { /* ... (SIN CAMBIOS) ... */ 
        if (!status) return 'secondary';
        switch (status.toLowerCase()) {
            case 'aprobado': case 'activo': return 'success';
            case 'pendiente': case 'en_revision': return 'warning text-dark';
            case 'rechazado': case 'finalizado': return 'danger';
            default: return 'secondary';
        }
    }
    function htmlspecialcharsJS(str) { /* ... (SIN CAMBIOS) ... */ 
        if (typeof str !== 'string') return ''; const map = { '&': '&', '<': '<', '>': '>', '"': '"', "'": "'" }; return str.replace(/[&<>"']/g, function(m) { return map[m]; });
    }
    function showAlertGloballyJsDestacados(type, title, message) { /* ... (SIN CAMBIOS, asegúrate que swal esté cargado globalmente) ... */ 
        if (typeof swal === 'function') { swal({ icon: type, title: title, text: message, buttons: { confirm: { text: "OK", value: true, visible: true, className: "btn btn-primary", closeModal: true }}, timer: type === 'success' ? 2000 : 3500 }); } 
        else { alert(title + ": " + message); }
    }

    // --- Listeners para la vista PÚBLICA de proyectos (filtros y paginación) ---
    $btnAplicarFiltrosPublic.on('click', function() { currentPageDestacados = 1; fetchDestacados(); });
    $buscarInputPublic.on('keypress', function(e) { if (e.which === 13) { $btnAplicarFiltrosPublic.click(); } });
    
    $paginationContainerPublic.on('click', 'a.page-link', function(e) {
        e.preventDefault();
        if ($(this).parent().hasClass('disabled') || $(this).parent().hasClass('active')) return;
        currentPageDestacados = parseInt($(this).data('page'));
        fetchDestacados();
        if($destacadosListContainer.length && $destacadosListContainer.offset()){
             $('html, body').animate({ scrollTop: ($destacadosListContainer.offset().top - 120) }, 300);
        }
    });
    
    // Lógica del Modal de Contacto
    $(document).on('click', '#destacados-list-container .contact-project-btn', function() {
        const projectId = $(this).data('project-id');
        const projectName = $(this).data('project-name');
        const contactName = $(this).data('contact-name');
        const ownerEmail = $(this).data('owner-email'); 
        $('#projectContactModalTitle').text('Contactar Destacado: ' + projectName);
        $('#modalProjectName').text(projectName);
        $('#modalContactName').text(contactName);
        $('#modalProjectId').val(projectId);
        $('#modalProjectOwnerEmail').val(ownerEmail); 
        $('#modalMessage').val(''); $('#modalUserName').val(''); $('#modalUserEmail').val('');
    });

    if ($('#projectMessageForm').length) {
        $('#projectMessageForm').off('submit.destacadosContact').on('submit.destacadosContact', function(e){
            e.preventDefault();
            showAlertGloballyJsDestacados('info', 'Simulación', `El envío de mensajes aún no está implementado.`);
            $('#projectContactModal').modal('hide');
        });
    }

    fetchDestacados(); // Carga inicial de proyectos destacados públicos

    console.log("PROJECT-DESTACADOS.PHP: Fin de inicializarPaginaActual().");
}
</script>