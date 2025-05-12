<div class="container">
    <div class="row">
        <div class="card card-space">
            <div class="page-inner">
                <!-- Encabezado de la Página -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">Talleres de Academia</h3>
                    <!-- Opcional: Botón para administrar talleres, si aplica -->
                    <div class="ms-md-auto py-2 py-md-0">
                        <a href="#" class="menu-link" data-page="academia-talleres-crud">
                            <span class="btn btn-primary">Administrar Talleres</span>
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
                                <label for="filtroTallerTitulo" class="form-label">Nombre del Taller</label>
                                <input type="text" class="form-control" id="filtroTallerTitulo"
                                    placeholder="Buscar por nombre...">
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <label for="filtroTallerCategoria" class="form-label">Categoría:</label>
                                <select class="form-select" id="filtroTallerCategoria">
                                    <option selected value="">Todas las Categorías</option>
                                    <option value="methodology">Metodología</option>
                                    <option value="pitching">Pitching</option>
                                    <!-- Añadir más categorías si es necesario, o cargarlas dinámicamente -->
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <label for="filtroTallerFecha" class="form-label">Fecha:</label>
                                <select class="form-select" id="filtroTallerFecha">
                                    <option selected value="">Cualquier Fecha</option>
                                    <option value="2025-04-20">20 de Abril, 2025</option>
                                    <option value="2025-05-04">4 de Mayo, 2025</option>
                                    <option value="2025-05-18">18 de Mayo, 2025</option>
                                    <!-- Añadir más fechas si es necesario -->
                                </select>
                            </div>
                            <!-- Opcional: Filtro de Estado para Talleres -->
                            <!-- <div class="col-md-4 col-lg-2">
                                <label for="filtroTallerEstado" class="form-label">Estado</label>
                                <select id="filtroTallerEstado" class="form-select">
                                    <option selected value="">Todos los estados...</option>
                                    <option value="true">Activo</option>
                                    <option value="false">Inactivo</option>
                                </select>
                            </div> -->
                            <div class="col-md-12 col-lg-2 d-flex align-items-end">
                                <button class="btn btn-primary w-100" onclick="aplicarFiltrosTalleres()">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row" id="listaTalleres">
                    <!-- Workshop Card 1 -->
                    <div class="col-md-6 col-lg-4 mb-4 taller-item"
                        data-taller-id="t1"
                        data-titulo="Taller de Design Thinking"
                        data-categoria="methodology"
                        data-fecha="2025-04-20"
                        data-estado="true"
                        data-imagen-portada="assets/img/examples/example4.jpeg"
                        data-descripcion-corta="Aprende a resolver problemas de forma creativa con la metodología Design Thinking."
                        data-descripcion-larga="Este taller intensivo te guiará a través de las cinco fases del Design Thinking: Empatizar, Definir, Idear, Prototipar y Testear. Aplicarás estas técnicas a un desafío real y desarrollarás soluciones innovadoras."
                        data-ponente="Dra. Ana Creativa"
                        data-video-promocional="">
                        <div class="card h-100">
                            <img src="assets/img/examples/example4.jpeg" class="card-img-top" alt="Taller de Design Thinking">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Taller de Design Thinking</h5>
                                <p class="card-text small text-muted">Categoría: Metodología</p>
                                <p class="card-text flex-grow-1">Aprende a resolver problemas de forma creativa con la metodología Design Thinking.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesTaller"
                                    data-taller-id="t1">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: 20 de Abril, 2025</small>
                            </div>
                        </div>
                    </div>
                    <!-- Workshop Card 2 -->
                    <div class="col-md-6 col-lg-4 mb-4 taller-item"
                        data-taller-id="t2"
                        data-titulo="Taller de Lean Startup"
                        data-categoria="methodology"
                        data-fecha="2025-05-04"
                        data-estado="true"
                        data-imagen-portada="assets/img/examples/example5.jpeg"
                        data-descripcion-corta="Valida tu idea de negocio y minimiza riesgos con la metodología Lean Startup."
                        data-descripcion-larga="Descubre cómo aplicar los principios de Lean Startup para construir un Producto Mínimo Viable (MVP), medir resultados y pivotar o perseverar en tu emprendimiento. Ideal para startups y nuevos proyectos."
                        data-ponente="Ing. Pedro Ágil"
                        data-video-promocional="https://www.youtube.com/embed/sNd6vR_8Y3g"> <!-- Ejemplo video -->
                        <div class="card h-100">
                            <img src="assets/img/examples/example5.jpeg" class="card-img-top" alt="Taller de Lean Startup">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Taller de Lean Startup</h5>
                                <p class="card-text small text-muted">Categoría: Metodología</p>
                                <p class="card-text flex-grow-1">Valida tu idea de negocio y minimiza riesgos con la metodología Lean Startup.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesTaller"
                                    data-taller-id="t2">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: 4 de Mayo, 2025</small>
                            </div>
                        </div>
                    </div>
                    <!-- Workshop Card 3 (INACTIVO EJEMPLO) -->
                    <div class="col-md-6 col-lg-4 mb-4 taller-item"
                        data-taller-id="t3"
                        data-titulo="Taller de Pitch Elevator"
                        data-categoria="pitching"
                        data-fecha="2025-05-18"
                        data-estado="false"
                        data-imagen-portada="assets/img/examples/example6.jpeg"
                        data-descripcion-corta="Aprende a comunicar tu idea de negocio de forma concisa e impactante."
                        data-descripcion-larga="Perfecciona tu discurso para presentar tu proyecto en cualquier situación. Trabajaremos en la estructura, el contenido y la entrega de tu pitch para que captes la atención de inversores y clientes."
                        data-ponente="Lic. Carla Impacto"
                        data-video-promocional="">
                        <div class="card h-100">
                            <img src="assets/img/examples/example6.jpeg" class="card-img-top" alt="Taller de Pitch Elevator">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Taller de Pitch Elevator</h5>
                                <p class="card-text small text-muted">Categoría: Pitching</p>
                                <p class="card-text flex-grow-1">Aprende a comunicar tu idea de negocio de forma concisa e impactante.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesTaller"
                                    data-taller-id="t3">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: 18 de Mayo, 2025</small>
                                <small class="text-danger ms-2 fw-bold">Estado: Inactivo</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center" id="mensajeSinTalleres" style="display: none;">
                    <p>No se encontraron talleres con los filtros aplicados.</p>
                </div>

                <!-- Pagination -->
                <nav aria-label="Paginación de talleres" class="mt-4">
                    <ul class="pagination justify-content-center" id="paginacionTalleres">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <!-- <li class="page-item"><a class="page-link" href="#">2</a></li> -->
                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                    </ul>
                </nav>
            </div>


            <!-- Modal para Detalles del Taller -->
            <div class="modal fade" id="modalDetallesTaller" tabindex="-1" aria-labelledby="modalDetallesTallerLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDetallesTallerLabel">Detalles del Taller</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5 text-center">
                                    <img id="modalTallerImagen" src="" class="img-fluid rounded mb-3"
                                        alt="Imagen del Taller" style="max-height: 250px; object-fit: cover;">
                                    <div id="modalTallerVideoPlaceholder">
                                        <!-- Video se inserta aquí por JS -->
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h4 id="modalTallerTitulo" class="fw-bold"></h4>
                                    <p id="modalTallerDescripcionLarga"></p>
                                    <hr>
                                    <p><strong class="text-primary">Categoría:</strong> <span
                                            id="modalTallerCategoriaNombre"></span></p>
                                    <p><strong class="text-primary">Fecha:</strong> <span id="modalTallerFecha"></span></p>
                                    <p><strong class="text-primary">Ponente:</strong> <span id="modalTallerPonente"></span></p>
                                    <p><strong class="text-primary">Estado:</strong> <span id="modalTallerEstado"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div id="modalMensajeRegistro" class="me-auto" style="display: none;">
                                <!-- Mensaje de confirmación/error -->
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" id="btnRegistrarseTaller"
                                data-taller-id="">Registrarse</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para aplicar filtros (debe estar en el scope global si se llama con onclick)
    function aplicarFiltrosTalleres() {
        console.log("Aplicando filtros a talleres...");
        const tituloInput = document.getElementById('filtroTallerTitulo');
        const categoriaSelect = document.getElementById('filtroTallerCategoria');
        const fechaSelect = document.getElementById('filtroTallerFecha');
        // const estadoSelect = document.getElementById('filtroTallerEstado'); // Si se añade filtro de estado

        if (!tituloInput || !categoriaSelect || !fechaSelect) {
            console.error("Uno o más elementos de filtro de talleres no fueron encontrados.");
            return;
        }

        const titulo = tituloInput.value.toLowerCase();
        const categoria = categoriaSelect.value;
        const fecha = fechaSelect.value;
        // const estado = estadoSelect ? estadoSelect.value : ''; // Si se añade filtro de estado

        const todosLosTalleres = document.querySelectorAll('#listaTalleres .taller-item');
        const mensajeSinTalleres = document.getElementById('mensajeSinTalleres');
        let talleresVisibles = 0;

        todosLosTalleres.forEach(card => {
            const cardTitulo = card.dataset.titulo ? card.dataset.titulo.toLowerCase() : '';
            const cardCategoria = card.dataset.categoria || '';
            const cardFecha = card.dataset.fecha || '';
            const cardEstado = card.dataset.estado || ''; // Siempre leer el estado para la lógica del modal

            const coincideTitulo = titulo === '' || cardTitulo.includes(titulo);
            const coincideCategoria = categoria === '' || cardCategoria === categoria;
            const coincideFecha = fecha === '' || cardFecha === fecha;
            // const coincideEstado = estado === '' || cardEstado === estado; // Si se añade filtro de estado

            // Modificar esta condición si se añade el filtro de estado
            if (coincideTitulo && coincideCategoria && coincideFecha /*&& coincideEstado*/) {
                card.style.display = 'block';
                talleresVisibles++;
            } else {
                card.style.display = 'none';
            }
        });

        if (mensajeSinTalleres) {
            mensajeSinTalleres.style.display = talleresVisibles === 0 ? 'block' : 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        console.log("DOM de Talleres completamente cargado. Inicializando scripts.");

        const talleresInscritos = new Set(); // Almacena los IDs de los talleres a los que el usuario ya está registrado

        // Opcional: Cargar categorías de talleres dinámicamente si es necesario
        // async function cargarCategoriasFiltroTalleres() { ... }
        // cargarCategoriasFiltroTalleres();

        const modalDetallesTaller = document.getElementById('modalDetallesTaller');
        const btnRegistrarseTaller = document.getElementById('btnRegistrarseTaller');
        const modalMensajeRegistro = document.getElementById('modalMensajeRegistro');

        if (!modalDetallesTaller) {
            console.warn("Modal '#modalDetallesTaller' no encontrado.");
        } else if (!btnRegistrarseTaller) {
            console.warn("Botón '#btnRegistrarseTaller' no encontrado dentro del modal.");
        } else if (!modalMensajeRegistro) {
            console.warn("Elemento '#modalMensajeRegistro' no encontrado dentro del modal.");
        } else {
            // Lógica del Modal de Talleres
            modalDetallesTaller.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Botón "Ver Detalles" que abrió el modal
                if (!button) {
                    console.error("No se pudo determinar el botón que disparó el modal de talleres.");
                    return;
                }
                const tallerId = button.dataset.tallerId;
                // Encontrar la tarjeta del taller correspondiente para obtener todos sus datos
                const tarjetaTaller = document.querySelector(`.taller-item[data-taller-id="${tallerId}"]`);
                if (!tarjetaTaller) {
                    console.error(`No se encontró la tarjeta del taller con ID: ${tallerId}`);
                    return;
                }

                const imagenSrc = tarjetaTaller.dataset.imagenPortada || 'assets/img/placeholder.jpg';
                const titulo = tarjetaTaller.dataset.titulo || 'Título no disponible';
                const descripcionLarga = tarjetaTaller.dataset.descripcionLarga || tarjetaTaller.dataset.descripcionCorta || 'Descripción no disponible.';
                const categoriaNombre = tarjetaTaller.dataset.categoria || 'N/A'; // Podrías mapear 'methodology' a 'Metodología'
                const fechaRaw = tarjetaTaller.dataset.fecha;
                const ponente = tarjetaTaller.dataset.ponente || 'N/A';
                const videoPromocionalUrl = tarjetaTaller.dataset.videoPromocional;
                const tallerEstaActivo = tarjetaTaller.dataset.estado === "true";

                let fechaFormateada = 'N/A';
                if (fechaRaw) {
                    const dateObj = new Date(fechaRaw + "T00:00:00"); // Asegurar que se parsea como fecha local
                    if (!isNaN(dateObj.getTime())) {
                        fechaFormateada = dateObj.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' });
                    }
                }
                 // Mapeo de categorías a nombres más amigables
                const mapCategorias = {
                    "methodology": "Metodología",
                    "pitching": "Pitching"
                };
                const categoriaDisplay = mapCategorias[categoriaNombre.toLowerCase()] || categoriaNombre;


                // Poblar modal
                modalDetallesTaller.querySelector('#modalTallerImagen').src = imagenSrc;
                modalDetallesTaller.querySelector('#modalTallerImagen').alt = "Imagen de " + titulo;
                modalDetallesTaller.querySelector('#modalTallerTitulo').textContent = titulo;
                modalDetallesTaller.querySelector('#modalTallerDescripcionLarga').textContent = descripcionLarga;
                modalDetallesTaller.querySelector('#modalTallerCategoriaNombre').textContent = categoriaDisplay;
                modalDetallesTaller.querySelector('#modalTallerFecha').textContent = fechaFormateada;
                modalDetallesTaller.querySelector('#modalTallerPonente').textContent = ponente;

                const modalTallerEstadoSpan = modalDetallesTaller.querySelector('#modalTallerEstado');
                modalTallerEstadoSpan.textContent = tallerEstaActivo ? 'Activo' : 'Inactivo';
                modalTallerEstadoSpan.className = tallerEstaActivo ? 'text-success fw-bold' : 'text-danger fw-bold';

                const videoPlaceholder = modalDetallesTaller.querySelector('#modalTallerVideoPlaceholder');
                const imgElement = modalDetallesTaller.querySelector('#modalTallerImagen');
                if (videoPromocionalUrl) {
                    imgElement.style.display = 'none';
                    videoPlaceholder.innerHTML = `<div class="ratio ratio-16x9"><iframe id="modalTallerVideoFrame" src="${videoPromocionalUrl}" title="Video promocional del taller" allowfullscreen></iframe></div>`;
                    videoPlaceholder.style.display = 'block';
                } else {
                    imgElement.style.display = 'block';
                    videoPlaceholder.innerHTML = '';
                    videoPlaceholder.style.display = 'none';
                }

                // Configurar botón "Registrarse"
                btnRegistrarseTaller.dataset.tallerId = tallerId;
                modalMensajeRegistro.style.display = 'none';
                modalMensajeRegistro.className = 'me-auto';
                modalMensajeRegistro.textContent = '';

                if (!tallerEstaActivo) {
                    btnRegistrarseTaller.disabled = true;
                    btnRegistrarseTaller.textContent = 'No disponible';
                    btnRegistrarseTaller.classList.remove('btn-success', 'btn-info');
                    btnRegistrarseTaller.classList.add('btn-secondary');
                } else if (talleresInscritos.has(tallerId)) {
                    btnRegistrarseTaller.disabled = true;
                    btnRegistrarseTaller.textContent = 'Registrado';
                    btnRegistrarseTaller.classList.remove('btn-success', 'btn-secondary');
                    btnRegistrarseTaller.classList.add('btn-info');
                } else {
                    btnRegistrarseTaller.disabled = false;
                    btnRegistrarseTaller.textContent = 'Registrarse';
                    btnRegistrarseTaller.classList.remove('btn-info', 'btn-secondary');
                    btnRegistrarseTaller.classList.add('btn-success');
                }
            });

            btnRegistrarseTaller.addEventListener('click', function () {
                if (this.disabled) return;

                const tallerId = this.dataset.tallerId;
                const tallerTitulo = modalDetallesTaller.querySelector('#modalTallerTitulo').textContent;

                this.disabled = true;
                this.textContent = 'Procesando...';
                modalMensajeRegistro.style.display = 'none';

                setTimeout(() => { // Simulación de llamada a API
                    const exitoRegistro = true; // Cambiar a false para simular error

                    if (exitoRegistro) {
                        if (!talleresInscritos.has(tallerId)) {
                            talleresInscritos.add(tallerId);
                            modalMensajeRegistro.textContent = `¡Te has registrado exitosamente al taller "${tallerTitulo}"!`;
                            modalMensajeRegistro.className = 'me-auto alert alert-success p-2 small';
                            this.textContent = 'Registrado';
                            this.classList.remove('btn-success');
                            this.classList.add('btn-info');
                            this.disabled = true;

                            const modalInstance = bootstrap.Modal.getInstance(modalDetallesTaller);
                            if (modalInstance) {
                                setTimeout(() => {
                                    modalInstance.hide();
                                }, 1500);
                            }
                        } else {
                            // Esto no debería suceder si la lógica de show.bs.modal es correcta
                            modalMensajeRegistro.textContent = 'Ya estás registrado en este taller.';
                            modalMensajeRegistro.className = 'me-auto alert alert-warning p-2 small';
                            this.textContent = 'Registrado';
                            this.classList.remove('btn-success');
                            this.classList.add('btn-info');
                            this.disabled = true;
                        }
                    } else {
                        modalMensajeRegistro.textContent = 'Hubo un error al procesar tu registro. Inténtalo más tarde.';
                        modalMensajeRegistro.className = 'me-auto alert alert-danger p-2 small';
                        this.disabled = false;
                        this.textContent = 'Registrarse';
                        this.classList.remove('btn-info', 'btn-secondary');
                        this.classList.add('btn-success');
                    }
                    modalMensajeRegistro.style.display = 'block';
                }, 1500);
            });

            modalDetallesTaller.addEventListener('hidden.bs.modal', function () {
                btnRegistrarseTaller.disabled = false;
                btnRegistrarseTaller.textContent = 'Registrarse';
                btnRegistrarseTaller.classList.remove('btn-secondary', 'btn-info');
                btnRegistrarseTaller.classList.add('btn-success');

                modalMensajeRegistro.style.display = 'none';
                modalMensajeRegistro.textContent = '';
                modalMensajeRegistro.className = 'me-auto';

                const videoFrame = modalDetallesTaller.querySelector('#modalTallerVideoFrame');
                if (videoFrame && videoFrame.contentWindow) {
                    videoFrame.src = ""; // Detener video
                } else if (videoFrame) {
                    const newFrame = videoFrame.cloneNode();
                    videoFrame.parentNode.replaceChild(newFrame, videoFrame);
                }
            });
        }

        // Inicializar filtros (opcional, si quieres que se apliquen al cargar la página)
        // aplicarFiltrosTalleres();
    });
</script>