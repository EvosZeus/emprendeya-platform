<?php
// project-list.php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: landing.html');
    exit;
}


// Obtener el rol del usuario actual desde la sesión
$rol_usuario_actual_pl = $_SESSION['user_role'] ?? 'Invitado'; // Uso _pl para evitar colisión si ya usas $rol_usuario_actual
$es_administrador_pl = (strcasecmp($rol_usuario_actual_pl, 'Administrador') == 0);

// (Tu código PHP opcional para cargar $sectores_unicos puede ir aquí si lo usas)
?>
<div class="container">
    <div class="page-inner">
        <!-- En project-list.php, por ejemplo, en el .card-header después del título -->
        
            <div class="page-header d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="card-title">Listado de Proyectos</h4>
                    <p class="card-category mb-0">Descubre oportunidades e iniciativas innovadoras.</p>
                </div>
                <?php if ($es_administrador_pl): // Usar la variable con sufijo _pl 
                ?>
                    <div class="ms-auto">
                        <button id="btn-gestionar-estados-proyectos" class="btn btn-warning btn-round btn-sm">
                            <i class="fas fa-edit me-1"></i> Gestionar Estados
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        

        <div class="card card-round shadow-sm">
            
            <div class="card-body">
                <!-- Filtros -->
                <div class="row mb-4 align-items-end gx-2">
                    <div class="col-md-5 col-lg-4 mb-2 mb-md-0">
                        <label for="buscar-proyecto-input" class="form-label fw-medium small">Buscar por Nombre:</label>
                        <input type="text" id="buscar-proyecto-input" class="form-control form-control-sm" placeholder="Ej: EcoSfera, Tech...">
                    </div>
                    <div class="col-md-4 col-lg-3 mb-2 mb-md-0">
                        <label for="filtro-sector-select" class="form-label fw-medium small">Filtrar por Sector:</label>
                        <select id="filtro-sector-select" class="form-select form-select-sm">
                            <option value="todos">Todos los Sectores</option>
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
                        </select>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <button id="btn-aplicar-filtros" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-search me-1"></i> Buscar
                        </button>
                    </div>
                </div>

                <!-- Indicador de Carga y Errores -->
                <div id="loading-project-list" class="text-center py-5" style="display: none;">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
                    <p class="mt-2">Cargando proyectos...</p>
                </div>
                <div id="error-project-list" class="alert alert-danger text-center" style="display: none;"></div>
                <div id="no-projects-found" class="alert alert-info text-center" style="display: none;">
                    No se encontraron proyectos que coincidan con tus criterios de búsqueda.
                </div>

                <!-- Contenedor para el Carrusel de Proyectos -->
                <div id="project-list-carousel-container" class="owl-carousel owl-theme">
                    <!-- Los items (tarjetas de proyecto) se insertarán aquí por JavaScript -->
                </div>

                <!-- Contenedor para la Paginación (Generalmente no se usa con carrusel infinito/loop) -->
                <!-- Si el carrusel no es loop y quieres paginar los "sets" de items del carrusel, es más complejo -->
                <nav aria-label="Navegación de proyectos" class="mt-4">
                    <ul id="project-pagination-container" class="pagination justify-content-center">
                        <!-- Paginación (se puede ocultar o adaptar si el carrusel es la navegación principal) -->
                    </ul>
                </nav>

            </div> <!-- Fin card-body -->
        </div> <!-- Fin card -->
    </div> <!-- Fin page-inner -->
</div> <!-- Fin container -->

<!-- Modal de Contacto (Sin cambios) -->
<div class="modal fade" id="projectContactModal" tabindex="-1" aria-labelledby="projectContactModalTitle" aria-hidden="true">
    <!-- ... (contenido del modal como lo tenías) ... -->
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
<!-- Modal para Gestionar Estados de Proyectos (SOLO PARA ADMIN) -->
<div class="modal fade" id="gestionarEstadosModal" tabindex="-1" aria-labelledby="gestionarEstadosModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable"> <!-- modal-xl para más espacio -->
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="gestionarEstadosModalLabel"><i class="fas fa-clipboard-check me-2"></i>Gestionar Estados de Proyectos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info small">
                    <i class="fas fa-info-circle me-1"></i> Aquí puedes aprobar o cambiar el estado de los proyectos. Los proyectos 'Pendientes' no son visibles públicamente hasta ser 'Aprobados' o 'Activos'.
                </div>
                <div class="row mb-3 gx-2">
                    <div class="col-md-4">
                        <input type="text" id="admin-buscar-proyectos-estado-input" class="form-control form-control-sm" placeholder="Buscar proyecto por nombre...">
                    </div>
                    <div class="col-md-3">
                        <select id="admin-filtro-estado-select" class="form-select form-select-sm">
                            <option value="todos">Todos los Estados</option>
                            <option value="pendiente" selected>Pendientes</option>
                            <option value="aprobado">Aprobados</option>

                        </select>
                    </div>
                    <div class="col-md-2">
                        <button id="admin-btn-filtrar-estados" class="btn btn-secondary btn-sm w-100">Filtrar</button>
                    </div>
                </div>

                <div id="admin-loading-proyectos-estado" class="text-center py-4" style="display: none;">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Cargando lista de proyectos...</p>
                </div>
                <div id="admin-error-proyectos-estado" class="alert alert-danger" style="display: none;"></div>

                <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                    <table class="table table-sm table-striped table-hover">
                        <thead class="table-light sticky-top" style="z-index:1;">
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Proyecto</th>
                                <th>Creador</th>
                                <th>Estado Actual</th>
                                <th style="width: 200px;">Nuevo Estado</th>
                            </tr>
                        </thead>
                        <tbody id="admin-lista-proyectos-estado-container">
                            <!-- La lista de proyectos con selects se cargará aquí -->
                        </tbody>
                    </table>
                </div>
                <div id="admin-no-proyectos-estado" class="alert alert-light text-center mt-3" style="display: none;">
                    No se encontraron proyectos con los filtros aplicados.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-round" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success btn-round" id="btn-guardar-cambios-estados">
                    <i class="fas fa-save me-1"></i> Guardar Cambios de Estado
                </button>
            </div>
        </div>
    </div>
</div>
<!-- ======================================================================= -->
<!-- ============ SCRIPT ESPECÍFICO PARA PROJECT-LIST.PHP ================== -->
<!-- ======================================================================= -->
<script>
    function inicializarPaginaActual() {
        console.log("PROJECT-LIST.PHP: inicializarPaginaActual() ejecutada.");

        // --- Selectores para la vista pública de proyectos (Carrusel) ---
        const $projectCarouselContainer = $('#project-list-carousel-container');
        const $loadingIndicatorPublic = $('#loading-project-list');
        const $errorIndicatorPublic = $('#error-project-list');
        const $noProjectsFoundPublic = $('#no-projects-found');
        const $paginationContainerPublic = $('#project-pagination-container');
        const $buscarInputPublic = $('#buscar-proyecto-input');
        const $sectorSelectPublic = $('#filtro-sector-select'); // Renombrado para evitar confusión
        const $btnAplicarFiltrosPublic = $('#btn-aplicar-filtros');

        // --- Selectores para el Modal de Gestión de ESTADOS (Admin) ---
        const $btnGestionarEstados = $('#btn-gestionar-estados-proyectos'); // Asegúrate que este ID esté en tu HTML
        const $gestionarEstadosModal = $('#gestionarEstadosModal'); // Y este también
        const $adminListaProyectosEstadoContainer = $('#admin-lista-proyectos-estado-container');
        const $adminLoadingEstados = $('#admin-loading-proyectos-estado');
        const $adminErrorEstados = $('#admin-error-proyectos-estado');
        const $adminNoProyectosEstado = $('#admin-no-proyectos-estado');
        const $adminBuscarEstadoInput = $('#admin-buscar-proyectos-estado-input');
        const $adminFiltroEstadoSelect = $('#admin-filtro-estado-select');
        const $adminBtnFiltrarEstados = $('#admin-btn-filtrar-estados');
        const $btnGuardarCambiosEstados = $('#btn-guardar-cambios-estados');

        let currentPage = 1; // Para la paginación de la lista pública
        const projectsPerPage = 9;

        // --- Función para cargar y mostrar proyectos en el CARRUSEL (vista pública) ---
        function fetchProjects() {
            const searchTerm = $buscarInputPublic.val().trim();
            const selectedSector = $sectorSelectPublic.val();

            $loadingIndicatorPublic.show();
            $errorIndicatorPublic.hide();
            $noProjectsFoundPublic.hide();

            if ($projectCarouselContainer.hasClass('owl-loaded')) {
                $projectCarouselContainer.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-theme owl-loaded owl-drag owl-hidden');
            }
            $projectCarouselContainer.html('');
            $paginationContainerPublic.html('');

            console.log("PROJECT-LIST.PHP (Public Carousel): Fetching - Página:", currentPage, "Buscar:", searchTerm, "Sector:", selectedSector);

            $.ajax({
                url: 'backend-php/get_all_projects.php', // Script que obtiene todos los proyectos (aprobados/activos)
                type: 'GET',
                dataType: 'json',
                data: {
                    pagina: currentPage,
                    por_pagina: projectsPerPage,
                    buscar: searchTerm,
                    sector: selectedSector
                },
                success: function(response) {
                    $loadingIndicatorPublic.hide();
                    if (response.success && response.data && response.data.length > 0) {
                        renderProjectItemsForCarousel(response.data);

                        if (typeof $.fn.owlCarousel === 'function') {
                            $projectCarouselContainer.addClass('owl-carousel owl-theme');
                            $projectCarouselContainer.owlCarousel({
                                loop: response.data.length > 4,
                                margin: 20,
                                nav: true,
                                dots: true,
                                autoplay: true,
                                autoplayTimeout: 5500,
                                autoplayHoverPause: true,
                                navText: ["<i class='fas fa-chevron-left p-2 bg-white text-primary rounded-circle shadow-sm'></i>", "<i class='fas fa-chevron-right p-2 bg-white text-primary rounded-circle shadow-sm'></i>"],
                                responsive: {
                                    0: {
                                        items: 1,
                                        stagePadding: 30
                                    },
                                    576: {
                                        items: 2,
                                        stagePadding: 20
                                    },
                                    768: {
                                        items: 2,
                                        stagePadding: 30
                                    },
                                    992: {
                                        items: 3
                                    },
                                    1200: {
                                        items: 3
                                    },
                                    1400: {
                                        items: 4
                                    }
                                }
                            });
                            console.log("PROJECT-LIST.PHP: Owl Carousel (público) inicializado.");
                        } else {
                            console.warn("PROJECT-LIST.PHP: Owl Carousel no está definido.");
                            $errorIndicatorPublic.text('Error de configuración: El carrusel no pudo cargarse.').show();
                        }
                        if (response.pagination && response.pagination.total_paginas > 1) {
                            renderPagination(response.pagination); // Paginación para la lista pública
                        }
                    } else if (response.data && response.data.length === 0) {
                        $noProjectsFoundPublic.show();
                    } else {
                        $errorIndicatorPublic.text(response.message || 'Error al cargar proyectos.').show();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $loadingIndicatorPublic.hide();
                    $errorIndicatorPublic.text('Error de conexión o del servidor (proyectos públicos). Inténtalo de nuevo.').show();
                    console.error("PROJECT-LIST.PHP (Public Carousel): Error AJAX:", textStatus, errorThrown, jqXHR.responseText);
                }
            });
        }

        // --- Función para renderizar las tarjetas de proyecto en el CARRUSEL (vista pública) ---
        function renderProjectItemsForCarousel(proyectos) {
            // ... (Esta función ya la tienes y parece funcionar bien, mostrando el eslogan, etc.)
            // Asegúrate de que cada item esté envuelto en <div class="item">
            // Y que el botón de contacto tenga los data-* attributes necesarios para el modal.
            let html = '';
            proyectos.forEach(function(p) {
                const detalleProyectoDataPage = `project-detail&id_proyecto=${p.id_proyecto}`;
                let displayText = '';
                if (p.eslogan && p.eslogan.trim() !== '') {
                    displayText = `"${p.eslogan}"`;
                } else if (p.resumen_acortado && p.resumen_acortado.trim() !== '' && p.resumen_acortado !== '...') {
                    displayText = p.resumen_acortado;
                } else {
                    displayText = 'Este proyecto aún no tiene una descripción detallada.';
                }

                html += `
                <div class="item"> 
                    <div class="card project-card-item h-100 shadow-sm mx-1"> 
                        <img src="${p.logo_proyecto}" class="card-img-top" alt="Logo ${p.nombre_proyecto}" style="height: 170px; object-fit: contain; padding:10px; background-color:#f8f9fa; border-bottom: 1px solid #eee;">
                        <div class="card-body d-flex flex-column p-3">
                            <span class="badge bg-info text-white mb-2 align-self-start" style="font-size: 0.7rem;">${p.sector}</span>
                            <h5 class="card-title mb-1" style="font-size: 1rem; font-weight: 600; min-height: 38px;">
                                <a href="#" class="text-dark menu-link stretched-link" data-page="${detalleProyectoDataPage}" title="${p.nombre_proyecto}">${p.nombre_proyecto}</a>
                            </h5>
                            <p class="card-text text-muted small mb-2" style="font-size:0.8rem;">Etapa: ${p.etapa}</p>
                            <p class="card-text text-muted small flex-grow-1 fst-italic" style="font-size:0.85rem; min-height: 55px;">${displayText}</p> 
                            <div class="progress mb-2" style="height: 7px; border-radius: 3.5px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: ${p.progreso_simulado}%;" aria-valuenow="${p.progreso_simulado}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="card-text mb-3"><small class="text-muted">Meta: ${p.monto_inversion_formateado}</small></p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-primary btn-xs btn-round menu-link" data-page="${detalleProyectoDataPage}">Ver Detalles</a>
                                <button type="button" class="btn btn-outline-secondary btn-xs btn-round contact-project-btn" 
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
                </div>`;
            });
            $projectCarouselContainer.html(html);
            var tooltipTriggerList = [].slice.call($projectCarouselContainer[0].querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        }

        // --- Función para renderizar la paginación PÚBLICA ---
        function renderPagination(pagination) {
            // ... (tu función renderPagination SIN CAMBIOS, la que usa $paginationContainerPublic) ...
            if (!pagination || pagination.total_paginas <= 1) {
                $paginationContainerPublic.html('');
                return;
            }
            let html = '';
            html += `<li class="page-item ${pagination.pagina_actual === 1 ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${pagination.pagina_actual - 1}" aria-label="Anterior"><span aria-hidden="true">«</span></a></li>`;
            const maxPagesToShow = 5;
            let startPage = Math.max(1, pagination.pagina_actual - Math.floor(maxPagesToShow / 2));
            let endPage = Math.min(pagination.total_paginas, startPage + maxPagesToShow - 1);
            if (endPage - startPage + 1 < maxPagesToShow && startPage > 1) {
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }
            if (endPage - startPage + 1 < maxPagesToShow && endPage < pagination.total_paginas) {
                endPage = Math.min(pagination.total_paginas, startPage + maxPagesToShow - 1);
            }
            if (startPage > 1) {
                html += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
                if (startPage > 2) {
                    html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
            }
            for (let i = startPage; i <= endPage; i++) {
                html += `<li class="page-item ${i === pagination.pagina_actual ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
            }
            if (endPage < pagination.total_paginas) {
                if (endPage < pagination.total_paginas - 1) {
                    html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
                html += `<li class="page-item"><a class="page-link" href="#" data-page="${pagination.total_paginas}">${pagination.total_paginas}</a></li>`;
            }
            html += `<li class="page-item ${pagination.pagina_actual === pagination.total_paginas ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${pagination.pagina_actual + 1}" aria-label="Siguiente"><span aria-hidden="true">»</span></a></li>`;
            $paginationContainerPublic.html(html);
        }


        // ==================================================================
        // --- LÓGICA PARA MODAL DE GESTIÓN DE ESTADOS (Admin) ---
        // ==================================================================
        if ($btnGestionarEstados.length) {

            $btnGestionarEstados.on('click', function() {
                console.log("PROJECT-LIST.PHP (Admin): Abriendo modal de gestión de estados.");
                loadProjectsForAdminStatusModal($adminBuscarEstadoInput.val().trim(), $adminFiltroEstadoSelect.val());
                $gestionarEstadosModal.modal('show');
            });

            $adminBtnFiltrarEstados.on('click', function() {
                loadProjectsForAdminStatusModal($adminBuscarEstadoInput.val().trim(), $adminFiltroEstadoSelect.val());
            });
            $adminBuscarEstadoInput.on('keypress', function(e) {
                if (e.which === 13) {
                    $adminBtnFiltrarEstados.click();
                }
            });
            $adminFiltroEstadoSelect.on('change', function() {
                $adminBtnFiltrarEstados.click();
            });

            $btnGuardarCambiosEstados.on('click', function() {
                const $button = $(this);
                const cambiosDeEstado = [];
                // Buscar los selects dentro de las filas de la tabla
                $adminListaProyectosEstadoContainer.find('tr').each(function() {
                    const $row = $(this);
                    const projectId = $row.data('project-id');
                    const nuevoEstado = $row.find('.admin-project-status-select').val();
                    const estadoOriginal = $row.data('original-status');

                    if (nuevoEstado !== estadoOriginal) {
                        cambiosDeEstado.push({
                            id_proyecto: projectId,
                            nuevo_estado: nuevoEstado
                        });
                    }
                });

                if (cambiosDeEstado.length === 0) {
                    showAlertGloballyJsProjectList('info', 'Sin Cambios', 'No se modificó el estado de ningún proyecto.');
                    $gestionarEstadosModal.modal('hide');
                    return;
                }

                console.log("PROJECT-LIST.PHP (Admin): Guardando cambios de estados:", cambiosDeEstado);
                $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Guardando...');

                $.ajax({
                    url: 'backend-php/update_project_status_admin.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        cambios_estado: JSON.stringify(cambiosDeEstado)
                    },
                    success: function(response) {
                        if (response.success) {
                            showAlertGloballyJsProjectList('success', '¡Éxito!', 'Estados de proyectos actualizados.');
                            fetchProjects(); // Recargar el carrusel público
                        } else {
                            showAlertGloballyJsProjectList('error', 'Error', response.message || 'No se pudieron guardar los cambios de estado.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        showAlertGloballyJsProjectList('error', 'Error', 'Error de conexión al guardar los cambios de estado.');
                        console.error("PROJECT-LIST.PHP (Admin Status Save): Error AJAX:", textStatus, errorThrown, jqXHR.responseText);
                    },
                    complete: function() {
                        $button.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Guardar Cambios de Estado');
                        $gestionarEstadosModal.modal('hide');
                    }
                });
            });
        }

        // --- Función para cargar proyectos en el MODAL DE ADMIN para ESTADOS ---
        function loadProjectsForAdminStatusModal(searchTerm = '', filterStatus = 'pendiente') {
            $adminLoadingEstados.show();
            $adminErrorEstados.hide();
            $adminNoProyectosEstado.hide();
            $adminListaProyectosEstadoContainer.html('');
            console.log("PROJECT-LIST.PHP (Admin Modal Estados): Cargando. Buscar:", searchTerm, "Estado Filtro:", filterStatus);

            $.ajax({
                url: 'backend-php/get_all_projects_for_admin.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    buscar: searchTerm,
                    estado_filtro: filterStatus
                },
                success: function(response) {
                    $adminLoadingEstados.hide();
                    if (response.success && response.data) {
                        if (response.data.length > 0) {
                            renderAdminProjectStatusList(response.data);
                        } else {
                            $adminNoProyectosEstado.text('No se encontraron proyectos ' + (filterStatus !== 'todos' ? 'en estado "' + filterStatus + '"' : '') + (searchTerm ? ' para "' + htmlspecialcharsJS(searchTerm) + '"' : '') + '.').show();
                        }
                    } else {
                        $adminErrorEstados.text(response.message || 'Error al cargar lista de proyectos para admin.').show();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $adminLoadingEstados.hide();
                    $adminErrorEstados.text('Error de conexión al cargar proyectos para admin.').show();
                    console.error("PROJECT-LIST.PHP (Admin Modal Load): Error AJAX:", textStatus, errorThrown, jqXHR.responseText);
                }
            });
        }

        // --- Función para renderizar la lista de proyectos en el MODAL DE ADMIN para ESTADOS ---
        function renderAdminProjectStatusList(proyectos) {
            let tbodyHtml = '';
            const posiblesEstados = ['pendiente', 'aprobado'];

            proyectos.forEach(function(p) {
                let optionsHtml = '';
                posiblesEstados.forEach(function(estadoOpt) {
                    optionsHtml += `<option value="${estadoOpt}" ${p.estado.toLowerCase() === estadoOpt ? 'selected' : ''}>
                                    ${estadoOpt.charAt(0).toUpperCase() + estadoOpt.slice(1).replace('_', ' ')}
                                </option>`;
                });

                tbodyHtml += `
                <tr data-project-id="${p.id_proyecto}" data-original-status="${p.estado.toLowerCase()}">
                    <td>${p.id_proyecto}</td>
                    <td>${p.nombre_proyecto}</td>
                    <td>${p.nombre_creador || 'N/A'}</td>
                    <td><span class="badge bg-${getBadgeClassForStatus(p.estado)}">${p.estado.charAt(0).toUpperCase() + p.estado.slice(1)}</span></td>
                    <td>
                        <select class="form-select form-select-sm admin-project-status-select">
                            ${optionsHtml}
                        </select>
                    </td>
                </tr>
            `;
            });
            $adminListaProyectosEstadoContainer.html(tbodyHtml);
        }

        // Función auxiliar para dar color a los badges de estado
        function getBadgeClassForStatus(status) {
            switch (status.toLowerCase()) {
                case 'aprobado':
                case 'activo':
                    return 'success';
                case 'pendiente':
                case 'en_revision':
                    return 'warning text-dark';
                case 'rechazado':
                case 'finalizado':
                    return 'danger';
                default:
                    return 'secondary';
            }
        }

        function htmlspecialcharsJS(str) {
            if (typeof str !== 'string') return '';
            const map = {
                '&': '&',
                '<': '<',
                '>': '>',
                '"': '"',
                "'": ''
            };
            return str.replace(/[&<>"']/g, function(m) {
                return map[m];
            });
            }

            function showAlertGloballyJsProjectList(type, title, message) {
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
                        timer: type === 'success' ? 2000 : 3500
                    });
                } else {
                    alert(title + ": " + message);
                }
            }

            // --- Event Listeners para la vista PÚBLICA de proyectos ---
            $btnAplicarFiltrosPublic.on('click', function() {
                currentPage = 1;
                fetchProjects();
            });
            $buscarInputPublic.on('keypress', function(e) {
                if (e.which === 13) {
                    $btnAplicarFiltrosPublic.click();
                }
            });
            $sectorSelectPublic.on('change', function() {
                $btnAplicarFiltrosPublic.click();
            }); // Asegúrate que $btnAplicarFiltrosPublic es el botón correcto.

            $paginationContainerPublic.on('click', 'a.page-link', function(e) {
                e.preventDefault();
                if ($(this).parent().hasClass('disabled') || $(this).parent().hasClass('active')) return;
                currentPage = parseInt($(this).data('page'));
                fetchProjects();
                if ($projectCarouselContainer.length && $projectCarouselContainer.offset()) {
                    $('html, body').animate({
                        scrollTop: ($projectCarouselContainer.offset().top - 120)
                    }, 300);
                }
            });

            // Lógica del Modal de Contacto
            // El listener se adjunta al contenedor del carrusel ya que las tarjetas se regeneran
            $projectCarouselContainer.on('click', '.contact-project-btn', function() {
                const projectId = $(this).data('project-id');
                const projectName = $(this).data('project-name');
                const contactName = $(this).data('contact-name');
                const ownerEmail = $(this).data('owner-email');

                $('#projectContactModalTitle').text('Contactar: ' + projectName);
                $('#modalProjectName').text(projectName);
                $('#modalContactName').text(contactName);
                $('#modalProjectId').val(projectId);
                $('#modalProjectOwnerEmail').val(ownerEmail);
                $('#modalMessage').val('');
                $('#modalUserName').val('');
                $('#modalUserEmail').val('');
            });

            // Listener para el envío del formulario del modal de contacto
            // Si el modal #projectContactModal es global (definido en index.php), este listener también debería ser global
            // o asegurarse de que no se duplique.
            if ($('#projectMessageForm').length) {
                // Remover listeners previos para evitar duplicados si esta función se llama múltiples veces
                $('#projectMessageForm').off('submit.projectListContact').on('submit.projectListContact', function(e) {
                    e.preventDefault();
                    console.log("Enviando mensaje (simulación)... Datos:", $(this).serialize());
                    showAlertGloballyJsProjectList('info', 'Simulación', `El envío de mensajes aún no está implementado.`);
                    $('#projectContactModal').modal('hide');
                });
            }

            // Carga inicial de proyectos para el carrusel público
            fetchProjects();

            console.log("PROJECT-LIST.PHP: Fin de inicializarPaginaActual().");
        }
</script>