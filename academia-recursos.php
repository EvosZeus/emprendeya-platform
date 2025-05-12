<div class="container">
    <div class="row">
        <div class="card card-space">

            <div class="page-inner">
                <!-- Encabezado de la Página -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">Recursos Descargables de Academia</h3>
                    <!-- Si necesitas un botón de administrar, puedes agregarlo aquí como en cursos -->
                    <div class="ms-md-auto py-2 py-md-0">
                        <a href="#" class="menu-link" data-page="academia-recursos-crud">
                            <span class="btn btn-primary">Administrar Recursos</span>
                        </a>
                    </div> 
                </div>

                <!-- Sección de Filtros -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Filtros</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4 col-lg-4">
                                <label for="filtroRecursoTitulo" class="form-label">Título o Descripción</label>
                                <input type="text" id="filtroRecursoTitulo" class="form-control"
                                    placeholder="Buscar por título o descripción...">
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <label for="filtroRecursoCategoria" class="form-label">Categoría del Recurso</label>
                                <select id="filtroRecursoCategoria" class="form-select">
                                    <option selected value="">Todas las categorías...</option>
                                    <option value="1">Plantillas</option>
                                    <option value="2">Guías y Manuales</option>
                                    <option value="3">Herramientas</option>
                                    <option value="4">Informes y Estudios</option>
                                    <option value="5">Multimedia</option>
                                    <!-- Podrías cargar estas categorías dinámicamente si fuera necesario -->
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <label for="filtroRecursoTipo" class="form-label">Tipo de Archivo</label>
                                <select id="filtroRecursoTipo" class="form-select">
                                    <option selected value="">Todos los tipos...</option>
                                    <option value="pdf">PDF</option>
                                    <option value="excel">Excel</option>
                                    <option value="powerpoint">PowerPoint</option>
                                    <option value="word">Word</option>
                                    <option value="zip">ZIP</option>
                                    <option value="imagen">Imagen</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-12 col-lg-2 d-flex align-items-end">
                                <button class="btn btn-primary w-100" onclick="aplicarFiltrosRecursos()">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Listado de Recursos -->
                <div class="row" id="listaRecursos">
                    <!-- Recurso 1: Plantilla de Plan de Negocio -->
                    <div class="col-md-6 col-lg-4 mb-4 recurso-item"
                        data-recurso-id="1"
                        data-titulo="Plantilla de Plan de Negocio"
                        data-descripcion="Descarga nuestra plantilla editable para crear un plan de negocio profesional y bien estructurado."
                        data-tipo="pdf"
                        data-categoria-id="1"
                        data-archivo-url="path/to/plantilla-plan-negocio.pdf"
                        data-fecha-subida="2024-01-10">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold"><i class="fas fa-file-pdf text-danger me-2"></i> Plantilla de Plan de Negocio</h5>
                                <p class="card-text small text-muted">Categoría: Plantillas / Tipo: PDF</p> <!-- Info de categoría visible -->
                                <p class="card-text flex-grow-1">Descarga nuestra plantilla editable para crear un plan de negocio profesional...</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesRecurso"
                                    data-recurso-id="1"
                                    data-titulo="Plantilla de Plan de Negocio"
                                    data-descripcion="Descarga nuestra plantilla editable para crear un plan de negocio profesional y bien estructurado. Incluye secciones para resumen ejecutivo, análisis de mercado, estrategias, plan financiero y más."
                                    data-tipo-nombre="Documento PDF"
                                    data-categoria-nombre="Plantillas" 
                                    data-archivo-url="path/to/plantilla-plan-negocio.pdf"
                                    data-tamano-archivo="1.2 MB"
                                    data-fecha-subida="2024-01-10">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Subido: 10/01/2024</small>
                            </div>
                        </div>
                    </div>

                    <!-- Recurso 2: Plantilla de Flujo de Caja -->
                    <div class="col-md-6 col-lg-4 mb-4 recurso-item"
                        data-recurso-id="2"
                        data-titulo="Plantilla de Flujo de Caja en Excel"
                        data-descripcion="Gestiona tus finanzas con nuestra plantilla de flujo de caja en Excel. Proyecta ingresos y egresos."
                        data-tipo="excel"
                        data-categoria-id="1"
                        data-archivo-url="path/to/plantilla-flujo-caja.xlsx"
                        data-fecha-subida="2024-02-15">
                        <div class="card h-100">
                             <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold"><i class="fas fa-file-excel text-success me-2"></i> Plantilla de Flujo de Caja</h5>
                                <p class="card-text small text-muted">Categoría: Plantillas / Tipo: Excel</p> <!-- Info de categoría visible -->
                                <p class="card-text flex-grow-1">Gestiona tus finanzas con nuestra plantilla de flujo de caja en Excel...</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesRecurso"
                                    data-recurso-id="2"
                                    data-titulo="Plantilla de Flujo de Caja en Excel"
                                    data-descripcion="Gestiona tus finanzas con nuestra plantilla de flujo de caja en Excel. Proyecta ingresos y egresos de forma mensual y anual para una mejor toma de decisiones."
                                    data-tipo-nombre="Hoja de Cálculo Excel"
                                    data-categoria-nombre="Plantillas"
                                    data-archivo-url="path/to/plantilla-flujo-caja.xlsx"
                                    data-tamano-archivo="350 KB"
                                    data-fecha-subida="2024-02-15">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Subido: 15/02/2024</small>
                            </div>
                        </div>
                    </div>

                    <!-- Recurso 3: Guía: Presentación para Inversionistas -->
                     <div class="col-md-6 col-lg-4 mb-4 recurso-item"
                        data-recurso-id="3"
                        data-titulo="Guía: Presentación Efectiva para Inversionistas"
                        data-descripcion="Crea una presentación impactante para atraer la atención de los inversores con esta guía y plantilla."
                        data-tipo="powerpoint"
                        data-categoria-id="2"
                        data-archivo-url="path/to/presentacion-inversionistas.pptx"
                        data-fecha-subida="2024-03-20">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold"><i class="fas fa-file-powerpoint text-warning me-2"></i> Guía: Presentación para Inversionistas</h5>
                                <p class="card-text small text-muted">Categoría: Guías y Manuales / Tipo: PowerPoint</p> <!-- Info de categoría visible -->
                                <p class="card-text flex-grow-1">Crea una presentación impactante para atraer la atención de los inversores...</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesRecurso"
                                    data-recurso-id="3"
                                    data-titulo="Guía: Presentación Efectiva para Inversionistas"
                                    data-descripcion="Aprende a estructurar y diseñar una presentación convincente para inversionistas. Incluye consejos clave y una plantilla base en PowerPoint."
                                    data-tipo-nombre="Presentación PowerPoint"
                                    data-categoria-nombre="Guías y Manuales"
                                    data-archivo-url="path/to/presentacion-inversionistas.pptx"
                                    data-tamano-archivo="2.5 MB"
                                    data-fecha-subida="2024-03-20">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                               <small class="text-muted">Subido: 20/03/2024</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 text-center" id="mensajeSinRecursos" style="display: none;">
                        <p>No se encontraron recursos con los filtros aplicados.</p>
                    </div>
                </div>

            </div> <!-- Fin de .page-inner -->

            <!-- Modal para Detalles del Recurso -->
            <div class="modal fade" id="modalDetallesRecurso" tabindex="-1" aria-labelledby="modalDetallesRecursoLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDetallesRecursoLabel">Detalles del Recurso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <i id="modalRecursoIcono" class="fas fa-file fa-7x text-secondary mb-3"></i>
                                </div>
                                <div class="col-md-8">
                                    <h4 id="modalRecursoTitulo" class="fw-bold"></h4>
                                    <p id="modalRecursoDescripcion"></p>
                                    <hr>
                                    <p><strong class="text-primary">Categoría:</strong> <span id="modalRecursoCategoriaNombre"></span></p> <!-- CAMPO AÑADIDO AL MODAL -->
                                    <p><strong class="text-primary">Tipo de archivo:</strong> <span id="modalRecursoTipoNombre"></span></p>
                                    <p><strong class="text-primary">Tamaño:</strong> <span id="modalRecursoTamano"></span></p>
                                    <p><strong class="text-primary">Fecha de subida:</strong> <span id="modalRecursoFechaSubida"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="#" id="btnDescargarRecurso" class="btn btn-success" download target="_blank">
                                <i class="fas fa-download me-1"></i>Descargar Recurso
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Fin de .card .card-space -->
    </div> <!-- Fin de .row -->
</div> <!-- Fin de .container -->

<script>
    // Función para aplicar filtros a los recursos
    function aplicarFiltrosRecursos() {
        console.log("Aplicando filtros de recursos...");
        const tituloInput = document.getElementById('filtroRecursoTitulo');
        const categoriaSelect = document.getElementById('filtroRecursoCategoria'); // NUEVO SELECT
        const tipoSelect = document.getElementById('filtroRecursoTipo');

        if (!tituloInput || !categoriaSelect || !tipoSelect) { // VALIDACIÓN ACTUALIZADA
            console.error("Uno o más elementos de filtro de recursos no fueron encontrados.");
            return;
        }

        const terminoBusqueda = tituloInput.value.toLowerCase();
        const categoriaSeleccionada = categoriaSelect.value; // VALOR DEL NUEVO SELECT
        const tipoSeleccionado = tipoSelect.value;

        const todosLosRecursos = document.querySelectorAll('#listaRecursos .recurso-item');
        if (!document.getElementById('listaRecursos')) {
            console.warn("Elemento '#listaRecursos' no encontrado para filtrar.");
            return;
        }

        let recursosVisibles = 0;

        todosLosRecursos.forEach(card => {
            const cardTitulo = card.dataset.titulo ? card.dataset.titulo.toLowerCase() : '';
            const cardDescripcion = card.dataset.descripcion ? card.dataset.descripcion.toLowerCase() : '';
            const cardCategoriaId = card.dataset.categoriaId || ''; // DATA ATTRIBUTE DE CATEGORÍA
            const cardTipo = card.dataset.tipo || '';

            const coincideBusqueda = terminoBusqueda === '' || cardTitulo.includes(terminoBusqueda) || cardDescripcion.includes(terminoBusqueda);
            const coincideCategoria = categoriaSeleccionada === '' || cardCategoriaId === categoriaSeleccionada; // LÓGICA DE FILTRO DE CATEGORÍA
            const coincideTipo = tipoSeleccionado === '' || cardTipo === tipoSeleccionado;

            if (coincideBusqueda && coincideCategoria && coincideTipo) { // CONDICIÓN ACTUALIZADA
                card.style.display = 'block';
                recursosVisibles++;
            } else {
                card.style.display = 'none';
            }
        });

        const mensajeSinRecursos = document.getElementById('mensajeSinRecursos');
        if (mensajeSinRecursos) {
            mensajeSinRecursos.style.display = recursosVisibles === 0 ? 'block' : 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        console.log("DOM completamente cargado. Inicializando scripts de la página de recursos.");

        const modalDetallesRecurso = document.getElementById('modalDetallesRecurso');
        const btnDescargarRecurso = document.getElementById('btnDescargarRecurso');

        if (!modalDetallesRecurso) {
            console.warn("Modal '#modalDetallesRecurso' no encontrado.");
        } else {
            modalDetallesRecurso.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                if (!button) {
                    console.error("No se pudo determinar el botón que disparó el modal de recursos.");
                    return;
                }

                const titulo = button.dataset.titulo || 'Título no disponible';
                const descripcion = button.dataset.descripcion || 'Descripción no disponible.';
                const categoriaNombre = button.dataset.categoriaNombre || 'N/A'; // OBTENER NOMBRE DE CATEGORÍA PARA MODAL
                const tipoNombre = button.dataset.tipoNombre || 'N/A';
                const archivoUrl = button.dataset.archivoUrl || '#';
                const tamanoArchivo = button.dataset.tamanoArchivo || 'N/A';
                const fechaSubidaRaw = button.dataset.fechaSubida;
                
                let fechaSubida = 'N/A';
                if (fechaSubidaRaw && fechaSubidaRaw !== "null" && fechaSubidaRaw !== "undefined") {
                    const dateObj = new Date(fechaSubidaRaw + "T00:00:00");
                    if (!isNaN(dateObj.getTime())) {
                        fechaSubida = dateObj.toLocaleDateString();
                    }
                }

                // Poblar modal
                modalDetallesRecurso.querySelector('#modalRecursoTitulo').textContent = titulo;
                modalDetallesRecurso.querySelector('#modalRecursoDescripcion').textContent = descripcion;
                modalDetallesRecurso.querySelector('#modalRecursoCategoriaNombre').textContent = categoriaNombre; // MOSTRAR CATEGORÍA EN MODAL
                modalDetallesRecurso.querySelector('#modalRecursoTipoNombre').textContent = tipoNombre;
                modalDetallesRecurso.querySelector('#modalRecursoTamano').textContent = tamanoArchivo;
                modalDetallesRecurso.querySelector('#modalRecursoFechaSubida').textContent = fechaSubida;
                
                const modalIcono = modalDetallesRecurso.querySelector('#modalRecursoIcono');
                const tipoArchivo = button.closest('.recurso-item')?.dataset.tipo || '';
                
                let iconoClase = 'fa-file';
                let iconoColor = 'text-secondary';
                switch (tipoArchivo) {
                    case 'pdf': iconoClase = 'fa-file-pdf'; iconoColor = 'text-danger'; break;
                    case 'excel': iconoClase = 'fa-file-excel'; iconoColor = 'text-success'; break;
                    case 'powerpoint': iconoClase = 'fa-file-powerpoint'; iconoColor = 'text-warning'; break;
                    case 'word': iconoClase = 'fa-file-word'; iconoColor = 'text-primary'; break;
                    case 'zip': iconoClase = 'fa-file-archive'; iconoColor = 'text-info'; break;
                    case 'imagen': iconoClase = 'fa-file-image'; iconoColor = 'text-purple'; break;
                }
                modalIcono.className = `fas ${iconoClase} fa-7x ${iconoColor} mb-3`;

                if (btnDescargarRecurso) {
                    btnDescargarRecurso.href = archivoUrl;
                    btnDescargarRecurso.classList.toggle('disabled', archivoUrl === '#' || archivoUrl === '');
                }
            });

            modalDetallesRecurso.addEventListener('hidden.bs.modal', function () {
                if (btnDescargarRecurso) {
                    btnDescargarRecurso.classList.remove('disabled');
                    btnDescargarRecurso.href = "#";
                }
                modalDetallesRecurso.querySelector('#modalRecursoTitulo').textContent = "";
                modalDetallesRecurso.querySelector('#modalRecursoDescripcion').textContent = "";
                modalDetallesRecurso.querySelector('#modalRecursoCategoriaNombre').textContent = ""; // LIMPIAR CAMPO
            });
        }
        
        const filtroTituloInput = document.getElementById('filtroRecursoTitulo');
        const filtroCategoriaSelect = document.getElementById('filtroRecursoCategoria'); // NUEVO SELECT
        const filtroTipoSelect = document.getElementById('filtroRecursoTipo');

        if (filtroTituloInput) {
            filtroTituloInput.addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    aplicarFiltrosRecursos();
                }
            });
        }
        if (filtroCategoriaSelect) { // LISTENER PARA NUEVO SELECT
            filtroCategoriaSelect.addEventListener('change', aplicarFiltrosRecursos);
        }
        if (filtroTipoSelect) {
            filtroTipoSelect.addEventListener('change', aplicarFiltrosRecursos);
        }
    });
</script>