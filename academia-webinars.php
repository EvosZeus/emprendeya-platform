<div class="container">
    <div class="row">
        <div class="card card-space">
            <div class="page-inner">

                <!-- Encabezado de la Página -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">Webinars de Academia</h3>
                    <div class="ms-md-auto py-2 py-md-0">
                        <a href="#" class="menu-link" data-page="academia-webinars-crud">
                            <span class="btn btn-primary">Administrar Webinars</span>
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
                            <div class="col-md-4 col-lg-3">
                                <label for="filtroWebinarTitulo" class="form-label">Título del Webinar</label>
                                <input type="text" id="filtroWebinarTitulo" class="form-control"
                                    placeholder="Buscar por título...">
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <label for="filtroWebinarCategoria" class="form-label">Categoría</label>
                                <select id="filtroWebinarCategoria" class="form-select">
                                    <option selected value="">Todas las categorías...</option>
                                    <!-- Categorías se cargarán por JS -->
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                <label for="filtroWebinarFormato" class="form-label">Formato</label>
                                <select id="filtroWebinarFormato" class="form-select">
                                    <option selected value="">Todos los formatos...</option>
                                    <option value="En vivo">En vivo</option>
                                    <option value="Grabacion">Grabación</option>
                                    <option value="Interactivo">Interactivo</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                <label for="filtroWebinarEstado" class="form-label">Estado</label>
                                <select id="filtroWebinarEstado" class="form-select">
                                    <option selected value="">Todos los estados...</option>
                                    <option value="programado">Programado</option>
                                    <option value="pasado">Pasado</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-2 d-flex align-items-end">
                                <button class="btn btn-primary w-100" onclick="aplicarFiltrosWebinars()">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Listado de Webinars -->
                <div class="row" id="listaWebinars">
                    <!-- Webinar 1: Inversión Ángel -->
                    <div class="col-md-6 col-lg-4 mb-4 webinar-item" data-webinar-id="1"
                        data-titulo="Webinar: Cómo Conseguir Inversión Ángel" data-categoria-id="1" data-formato="En vivo"
                        data-estado="programado" data-fecha-hora="27 de Abril, 2025 - 18:00 GMT-5" data-ponente="Juan Pérez">
                        <div class="card h-100">
                            <img src="assets/img/examples/example7.jpeg" class="card-img-top" alt="Webinar Inversión Ángel">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Webinar: Cómo Conseguir Inversión Ángel</h5>
                                <p class="card-text small text-muted">Categoría: Inversiones</p>
                                <p class="card-text flex-grow-1">Aprende los secretos para atraer inversores ángeles a tu proyecto.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesWebinar" data-webinar-id="1"
                                    data-imagen-portada="assets/img/examples/example7.jpeg"
                                    data-titulo="Webinar: Cómo Conseguir Inversión Ángel"
                                    data-descripcion="Aprende los secretos para atraer inversores ángeles a tu proyecto. Cubriremos estrategias de pitching, valoración y negociación con casos de estudio reales."
                                    data-fecha-hora="27 de Abril, 2025 - 18:00 GMT-5" data-formato="En vivo"
                                    data-ponente="Juan Pérez, Experto en Capital Semilla"
                                    data-categoria-nombre="Inversiones"
                                    data-enlace-registro="https://zoom.us/webinar/register/WN_EXAMPLE_ID_1"
                                    data-enlace-grabacion="">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: 27/04/2025, 18:00</small>
                                <small class="text-muted ms-2">Formato: En vivo</small>
                            </div>
                        </div>
                    </div>

                    <!-- Webinar 2: Marketing de Contenidos -->
                    <div class="col-md-6 col-lg-4 mb-4 webinar-item" data-webinar-id="2"
                        data-titulo="Webinar: Marketing de Contenidos para Startups" data-categoria-id="2" data-formato="En vivo"
                        data-estado="programado" data-fecha-hora="11 de Mayo, 2025 - 10:00 GMT-5" data-ponente="Ana López">
                        <div class="card h-100">
                            <img src="assets/img/examples/example8.jpeg" class="card-img-top" alt="Webinar Marketing de Contenidos">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Webinar: Marketing de Contenidos para Startups</h5>
                                <p class="card-text small text-muted">Categoría: Marketing</p>
                                <p class="card-text flex-grow-1">Atrae clientes potenciales con contenido relevante y de valor.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesWebinar" data-webinar-id="2"
                                    data-imagen-portada="assets/img/examples/example8.jpeg"
                                    data-titulo="Webinar: Marketing de Contenidos para Startups"
                                    data-descripcion="Descubre cómo planificar, crear y distribuir contenido que convierta. Exploraremos formatos, canales y métricas clave para el éxito."
                                    data-fecha-hora="11 de Mayo, 2025 - 10:00 GMT-5" data-formato="En vivo"
                                    data-ponente="Ana López, Estratega de Contenidos"
                                    data-categoria-nombre="Marketing"
                                    data-enlace-registro="https://zoom.us/webinar/register/WN_EXAMPLE_ID_2"
                                    data-enlace-grabacion="">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: 11/05/2025, 10:00</small>
                                <small class="text-muted ms-2">Formato: En vivo</small>
                            </div>
                        </div>
                    </div>

                    <!-- Webinar 3: Aspectos Legales (Pasado con Grabación) -->
                    <div class="col-md-6 col-lg-4 mb-4 webinar-item" data-webinar-id="3"
                        data-titulo="Webinar: Aspectos Legales Clave para Emprendedores" data-categoria-id="3" data-formato="Grabacion"
                        data-estado="pasado" data-fecha-hora="20 de Marzo, 2025 - 16:00 GMT-5" data-ponente="Carlos Ruiz">
                        <div class="card h-100">
                            <img src="assets/img/examples/example9.jpeg" class="card-img-top" alt="Webinar Aspectos Legales">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Webinar: Aspectos Legales Clave para Emprendedores</h5>
                                <p class="card-text small text-muted">Categoría: Legal</p>
                                <p class="card-text flex-grow-1">Protege tu negocio desde el inicio con una base legal sólida.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesWebinar" data-webinar-id="3"
                                    data-imagen-portada="assets/img/examples/example9.jpeg"
                                    data-titulo="Webinar: Aspectos Legales Clave para Emprendedores"
                                    data-descripcion="Conoce los tipos de sociedades, contratos esenciales y la importancia de la propiedad intelectual. (Grabación disponible)"
                                    data-fecha-hora="20 de Marzo, 2025 - 16:00 GMT-5" data-formato="Grabacion"
                                    data-ponente="Carlos Ruiz, Abogado Corporativo"
                                    data-categoria-nombre="Legal"
                                    data-enlace-registro=""
                                    data-enlace-grabacion="https://youtube.com/embed/example_grabacion_legal">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Emitido: 20/03/2025</small>
                                <small class="text-muted ms-2">Formato: Grabación</small>
                                <small class="text-info ms-2 fw-bold">Ver Grabación</small>
                            </div>
                        </div>
                    </div>

                     <!-- Webinar 4: IA Generativa (Programado, Interactivo) -->
                    <div class="col-md-6 col-lg-4 mb-4 webinar-item" data-webinar-id="4"
                        data-titulo="Webinar: IA Generativa para No Programadores" data-categoria-id="4" data-formato="Interactivo"
                        data-estado="programado" data-fecha-hora="10 de Junio, 2025 - 11:00 GMT-5" data-ponente="Sofía Chen">
                        <div class="card h-100">
                            <img src="assets/img/examples/example8.jpeg" class="card-img-top" alt="Webinar IA Generativa">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Webinar: IA Generativa para No Programadores</h5>
                                <p class="card-text small text-muted">Categoría: Tecnología</p>
                                <p class="card-text flex-grow-1">Potencia tu creatividad y productividad con herramientas de IA sin código.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesWebinar" data-webinar-id="4"
                                    data-imagen-portada="assets/img/examples/example8.jpeg"
                                    data-titulo="Webinar: IA Generativa para No Programadores"
                                    data-descripcion="Exploraremos ChatGPT, Midjourney y otras herramientas para creación de texto e imágenes. Sesión interactiva con Q&A."
                                    data-fecha-hora="10 de Junio, 2025 - 11:00 GMT-5" data-formato="Interactivo"
                                    data-ponente="Sofía Chen, Especialista en IA Aplicada"
                                    data-categoria-nombre="Tecnología"
                                    data-enlace-registro="https://zoom.us/webinar/register/WN_EXAMPLE_ID_4"
                                    data-enlace-grabacion="">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: 10/06/2025, 11:00</small>
                                <small class="text-muted ms-2">Formato: Interactivo</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center" id="mensajeSinWebinars" style="display: none;">
                        <p>No se encontraron webinars con los filtros aplicados.</p>
                    </div>
                </div>

                <!-- Paginación -->
                <nav aria-label="Paginación de webinars" class="mt-4">
                    <ul class="pagination justify-content-center" id="paginacionWebinars">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                    </ul>
                </nav>
            </div> <!-- Fin de .page-inner -->

            <!-- Modal para Detalles del Webinar -->
            <div class="modal fade" id="modalDetallesWebinar" tabindex="-1" aria-labelledby="modalDetallesWebinarLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDetallesWebinarLabel">Detalles del Webinar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5 text-center">
                                    <img id="modalWebinarImagen" src="" class="img-fluid rounded mb-3"
                                        alt="Imagen del Webinar" style="max-height: 250px; object-fit: cover;">
                                    <!-- Si se quisiera un video promocional para webinars, se añadiría un placeholder aquí -->
                                </div>
                                <div class="col-md-7">
                                    <h4 id="modalWebinarTitulo" class="fw-bold"></h4>
                                    <p id="modalWebinarDescripcion"></p>
                                    <hr>
                                    <p><strong class="text-primary">Categoría:</strong> <span
                                            id="modalWebinarCategoriaNombre"></span></p>
                                    <p><strong class="text-primary">Fecha y Hora:</strong> <span
                                            id="modalWebinarFechaHora"></span></p>
                                    <p><strong class="text-primary">Formato:</strong> <span 
                                            id="modalWebinarFormato"></span></p>
                                    <p><strong class="text-primary">Ponente:</strong> <span
                                            id="modalWebinarPonente"></span></p>
                                    <p><strong class="text-primary">Estado:</strong> <span id="modalWebinarEstado"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div id="modalMensajeRegistro" class="me-auto" style="display: none;">
                                <!-- Mensaje de confirmación/error -->
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" id="btnRegistrarseWebinar"
                                data-webinar-id="" data-enlace-registro="" data-enlace-grabacion="">Registrarse</button>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Fin de .card .card-space -->
    </div> <!-- Fin de .row -->
</div> <!-- Fin de .container -->

<!--
    ASEGÚRATE DE QUE TU HTML PARA LA PÁGINA DE WEBINARS ESTÉ AQUÍ.
    Este script debe ir DESPUÉS de que el HTML del modal y los elementos de filtro estén definidos.
    Y DESPUÉS de que Bootstrap JS esté cargado.
-->

<script>
    // Simulación de conjunto de webinars a los que el usuario ya está registrado
    const webinarsRegistrados = new Set();

    // Función para cargar categorías en el filtro de webinars
    async function cargarCategoriasWebinarFiltro() {
        console.log("[Webinars Script] Intentando cargar categorías para filtro...");
        const selectCategoria = document.getElementById('filtroWebinarCategoria');
        if (!selectCategoria) {
            console.error("[Webinars Script] Elemento select 'filtroWebinarCategoria' NO encontrado.");
            return;
        }
        // Simulación de fetch a tu API para obtener categorías de webinars
        const categoriasWebinars = [
            { id: 1, nombre: "Inversiones" },
            { id: 2, nombre: "Marketing" },
            { id: 3, nombre: "Legal" },
            { id: 4, nombre: "Tecnología" },
            { id: 5, nombre: "Desarrollo Personal" }
        ];

        // Limpiar opciones previas excepto la primera ("Todas las categorías...")
        while (selectCategoria.options.length > 1) {
            selectCategoria.remove(1);
        }

        categoriasWebinars.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat.id;
            option.textContent = cat.nombre;
            selectCategoria.appendChild(option);
        });
        console.log("[Webinars Script] Categorías para filtro cargadas.");
    }

    // Función para aplicar filtros a los webinars
    function aplicarFiltrosWebinars() {
        console.log("[Webinars Script] Aplicando filtros de webinars...");
        const tituloInput = document.getElementById('filtroWebinarTitulo');
        const categoriaSelect = document.getElementById('filtroWebinarCategoria');
        const formatoSelect = document.getElementById('filtroWebinarFormato');
        const estadoSelect = document.getElementById('filtroWebinarEstado');
        const mensajeSinWebinars = document.getElementById('mensajeSinWebinars');
        const listaWebinarsEl = document.getElementById('listaWebinars');

        // Verificar que todos los elementos necesarios para filtrar existan
        if (!tituloInput || !categoriaSelect || !formatoSelect || !estadoSelect || !mensajeSinWebinars || !listaWebinarsEl) {
            console.error("[Webinars Script] Uno o más elementos de filtro o lista de webinar NO fueron encontrados. Verifique IDs:", {
                tituloInputExists: !!tituloInput,
                categoriaSelectExists: !!categoriaSelect,
                formatoSelectExists: !!formatoSelect,
                estadoSelectExists: !!estadoSelect,
                mensajeSinWebinarsExists: !!mensajeSinWebinars,
                listaWebinarsElExists: !!listaWebinarsEl
            });
            return; // No continuar si faltan elementos clave para filtrar
        }

        const titulo = tituloInput.value.toLowerCase();
        const categoriaId = categoriaSelect.value;
        const formato = formatoSelect.value;
        const estado = estadoSelect.value;

        const todosLosWebinars = listaWebinarsEl.querySelectorAll('.webinar-item');
        let webinarsVisibles = 0;

        todosLosWebinars.forEach(card => {
            const cardTitulo = card.dataset.titulo ? card.dataset.titulo.toLowerCase() : '';
            const cardCategoriaId = card.dataset.categoriaId || '';
            const cardFormato = card.dataset.formato || '';
            const cardEstado = card.dataset.estado || '';

            const coincideTitulo = titulo === '' || cardTitulo.includes(titulo);
            const coincideCategoria = categoriaId === '' || cardCategoriaId === categoriaId;
            const coincideFormato = formato === '' || cardFormato === formato;
            const coincideEstado = estado === '' || cardEstado === estado;

            if (coincideTitulo && coincideCategoria && coincideFormato && coincideEstado) {
                card.style.display = 'block';
                webinarsVisibles++;
            } else {
                card.style.display = 'none';
            }
        });

        mensajeSinWebinars.style.display = webinarsVisibles === 0 ? 'block' : 'none';
        console.log("[Webinars Script] Filtros aplicados, webinars visibles:", webinarsVisibles);
    }

    // ---- INICIO DEL SCRIPT PRINCIPAL DE LA PÁGINA DE WEBINARS ----
    document.addEventListener('DOMContentLoaded', function () {
        console.log("[Webinars Script] DOM completamente cargado y parseado para webinars. Iniciando scripts...");

        // Cargar elementos de filtro
        cargarCategoriasWebinarFiltro();

        // Elementos del modal
        const modalDetallesWebinar = document.getElementById('modalDetallesWebinar');
        const btnRegistrarseWebinar = document.getElementById('btnRegistrarseWebinar');
        const modalMensajeRegistro = document.getElementById('modalMensajeRegistro');

        // Verificar la existencia de los elementos del modal
        if (!modalDetallesWebinar) {
            console.error("[Webinars Script] Modal '#modalDetallesWebinar' NO encontrado. La funcionalidad de detalles del webinar no estará disponible.");
            // No se pueden añadir listeners si el modal no existe, así que podríamos detenernos aquí
            // o permitir que el resto de la página (filtros) funcione.
            // Por ahora, solo mostraremos el error y los filtros seguirán intentando funcionar.
        }
        if (modalDetallesWebinar && !btnRegistrarseWebinar) { // Solo chequear si el modal existe
            console.warn("[Webinars Script] Botón '#btnRegistrarseWebinar' no encontrado dentro del modal.");
        }
        if (modalDetallesWebinar && !modalMensajeRegistro) { // Solo chequear si el modal existe
            console.warn("[Webinars Script] Elemento '#modalMensajeRegistro' no encontrado dentro del modal.");
        }

        console.log("[Webinars Script] Elementos del modal encontrados:", {
            modal: !!modalDetallesWebinar,
            btn: !!btnRegistrarseWebinar,
            msg: !!modalMensajeRegistro
        });

        // Configurar listeners del modal SOLO SI TODOS los elementos esenciales del modal existen
        if (modalDetallesWebinar && btnRegistrarseWebinar && modalMensajeRegistro) {
            console.log("[Webinars Script] Configurando listeners para el modal de detalles del webinar.");

            modalDetallesWebinar.addEventListener('show.bs.modal', function (event) {
                console.log("[Webinars Script] Evento 'show.bs.modal' disparado para #modalDetallesWebinar");
                const button = event.relatedTarget; // El botón que disparó el modal
                if (!button) {
                    console.error("[Webinars Script] No se pudo determinar el botón que disparó el modal de webinar.");
                    return;
                }
                console.log("[Webinars Script] Botón que disparó el modal:", button);

                // Extracción de datos del botón
                const webinarId = button.dataset.webinarId;
                const imagenSrc = button.dataset.imagenPortada || 'assets/img/placeholder.jpg'; // Valor por defecto
                const titulo = button.dataset.titulo || 'Título no disponible';
                const descripcion = button.dataset.descripcion || 'Descripción no disponible.';
                const categoriaNombre = button.dataset.categoriaNombre || 'N/A';
                const fechaHora = button.dataset.fechaHora || 'N/A';
                const formato = button.dataset.formato || 'N/A';
                const ponente = button.dataset.ponente || 'N/A';
                const enlaceRegistro = button.dataset.enlaceRegistro || '';
                const enlaceGrabacion = button.dataset.enlaceGrabacion || '';

                const tarjetaWebinar = button.closest('.webinar-item');
                let webinarEstadoActual = 'programado'; // Estado por defecto si no se encuentra
                if (tarjetaWebinar && typeof tarjetaWebinar.dataset.estado !== 'undefined') {
                    webinarEstadoActual = tarjetaWebinar.dataset.estado;
                } else {
                    console.warn(`[Webinars Script] No se pudo determinar el estado desde data-estado para el webinar ID: ${webinarId}. Usando '${webinarEstadoActual}'. Asegúrate que '.webinar-item' y 'data-estado' estén correctos.`);
                }

                console.log(`[Webinars Script] Poblando modal con datos para webinar ID: ${webinarId}, Título: ${titulo}, Estado: ${webinarEstadoActual}`);

                // Poblar el modal con los datos
                modalDetallesWebinar.querySelector('#modalWebinarImagen').src = imagenSrc;
                modalDetallesWebinar.querySelector('#modalWebinarImagen').alt = "Imagen de " + titulo;
                modalDetallesWebinar.querySelector('#modalWebinarTitulo').textContent = titulo;
                modalDetallesWebinar.querySelector('#modalWebinarDescripcion').textContent = descripcion;
                modalDetallesWebinar.querySelector('#modalWebinarCategoriaNombre').textContent = categoriaNombre;
                modalDetallesWebinar.querySelector('#modalWebinarFechaHora').textContent = fechaHora;
                modalDetallesWebinar.querySelector('#modalWebinarFormato').textContent = formato;
                modalDetallesWebinar.querySelector('#modalWebinarPonente').textContent = ponente;

                const modalWebinarEstadoSpan = modalDetallesWebinar.querySelector('#modalWebinarEstado');
                modalWebinarEstadoSpan.textContent = webinarEstadoActual === 'programado' ? 'Programado' : 'Pasado';
                modalWebinarEstadoSpan.className = webinarEstadoActual === 'programado' ? 'text-success fw-bold' : 'text-info fw-bold';

                // Configurar el botón de acción del modal ("Registrarse" / "Ver Grabación")
                btnRegistrarseWebinar.dataset.webinarId = webinarId;
                btnRegistrarseWebinar.dataset.enlaceRegistro = enlaceRegistro;
                btnRegistrarseWebinar.dataset.enlaceGrabacion = enlaceGrabacion;
                modalMensajeRegistro.style.display = 'none'; // Ocultar mensaje previo
                modalMensajeRegistro.className = 'me-auto'; // Resetear clases del mensaje
                modalMensajeRegistro.textContent = '';       // Limpiar texto del mensaje
                btnRegistrarseWebinar.style.display = 'block'; // Asegurar que el botón sea visible

                if (webinarEstadoActual === 'programado') {
                    if (webinarsRegistrados.has(webinarId)) {
                        btnRegistrarseWebinar.disabled = true;
                        btnRegistrarseWebinar.textContent = 'Ya Registrado';
                        btnRegistrarseWebinar.classList.remove('btn-success', 'btn-primary', 'btn-secondary');
                        btnRegistrarseWebinar.classList.add('btn-info');
                    } else if (enlaceRegistro) {
                        btnRegistrarseWebinar.disabled = false;
                        btnRegistrarseWebinar.textContent = 'Registrarse';
                        btnRegistrarseWebinar.classList.remove('btn-info', 'btn-primary', 'btn-secondary');
                        btnRegistrarseWebinar.classList.add('btn-success');
                    } else {
                        btnRegistrarseWebinar.disabled = true;
                        btnRegistrarseWebinar.textContent = 'Registro no disponible';
                        btnRegistrarseWebinar.classList.remove('btn-success', 'btn-info', 'btn-primary');
                        btnRegistrarseWebinar.classList.add('btn-secondary');
                    }
                } else { // Webinar pasado
                    if (enlaceGrabacion) {
                        btnRegistrarseWebinar.disabled = false;
                        btnRegistrarseWebinar.textContent = 'Ver Grabación';
                        btnRegistrarseWebinar.classList.remove('btn-success', 'btn-info', 'btn-secondary');
                        btnRegistrarseWebinar.classList.add('btn-primary'); // Azul para ver grabación
                    } else {
                        btnRegistrarseWebinar.disabled = true;
                        btnRegistrarseWebinar.textContent = 'Grabación no disponible';
                        btnRegistrarseWebinar.classList.remove('btn-success', 'btn-info', 'btn-primary');
                        btnRegistrarseWebinar.classList.add('btn-secondary');
                    }
                }
                console.log("[Webinars Script] Modal poblado y botón de acción configurado.");
            });

            // Listener para el botón de acción dentro del modal
            btnRegistrarseWebinar.addEventListener('click', function () {
                if (this.disabled) return; // No hacer nada si el botón está deshabilitado
                console.log("[Webinars Script] Botón de registro/grabación clickeado.");

                const webinarId = this.dataset.webinarId;
                const webinarTitulo = modalDetallesWebinar.querySelector('#modalWebinarTitulo').textContent;
                const enlaceReg = this.dataset.enlaceRegistro;
                const enlaceGrab = this.dataset.enlaceGrabacion;
                const esProgramado = modalDetallesWebinar.querySelector('#modalWebinarEstado').textContent === 'Programado';

                if (esProgramado) {
                    if (webinarsRegistrados.has(webinarId)) return; // Doble chequeo, aunque el botón debería estar deshabilitado

                    this.disabled = true;
                    this.textContent = 'Procesando...';
                    modalMensajeRegistro.style.display = 'none';

                    // Simulación de llamada a API para registrarse
                    setTimeout(() => {
                        const exitoRegistro = true; // Cambia a false para simular un error de API
                        if (exitoRegistro) {
                            webinarsRegistrados.add(webinarId); // Marcar como registrado localmente
                            modalMensajeRegistro.innerHTML = `¡Te has registrado exitosamente al webinar "${webinarTitulo}"!`;
                            if (enlaceReg && enlaceReg !== '#') { // Añadir enlace si existe
                                modalMensajeRegistro.innerHTML += ` Revisa tu correo para el enlace o <a href="${enlaceReg}" target="_blank" rel="noopener noreferrer">accede aquí</a>.`;
                            }
                            modalMensajeRegistro.className = 'me-auto alert alert-success p-2 small';
                            this.textContent = 'Ya Registrado';
                            this.classList.remove('btn-success');
                            this.classList.add('btn-info');
                        } else {
                            modalMensajeRegistro.textContent = 'Hubo un error al procesar tu registro. Inténtalo más tarde.';
                            modalMensajeRegistro.className = 'me-auto alert alert-danger p-2 small';
                            this.disabled = false; // Permitir reintentar
                            this.textContent = 'Registrarse';
                            this.classList.remove('btn-info', 'btn-secondary');
                            this.classList.add('btn-success');
                        }
                        modalMensajeRegistro.style.display = 'block';
                        console.log("[Webinars Script] Proceso de registro (simulado) completado.");
                    }, 1500);

                } else { // Es un webinar pasado, el botón es "Ver Grabación"
                    if (enlaceGrab && enlaceGrab !== '#') {
                        console.log("[Webinars Script] Abriendo enlace de grabación:", enlaceGrab);
                        window.open(enlaceGrab, '_blank', 'noopener,noreferrer'); // Abrir en nueva pestaña
                        // Opcionalmente, cerrar el modal después de abrir el enlace
                        const modalInstance = bootstrap.Modal.getInstance(modalDetallesWebinar);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }
                }
            });

            // Limpiar/Resetear el modal cuando se cierra
            modalDetallesWebinar.addEventListener('hidden.bs.modal', function () {
                console.log("[Webinars Script] Modal #modalDetallesWebinar cerrado ('hidden.bs.modal'). Reseteando botón.");
                btnRegistrarseWebinar.disabled = false;
                btnRegistrarseWebinar.textContent = 'Registrarse'; // Texto por defecto
                btnRegistrarseWebinar.classList.remove('btn-secondary', 'btn-info', 'btn-primary');
                btnRegistrarseWebinar.classList.add('btn-success'); // Clase por defecto

                modalMensajeRegistro.style.display = 'none';
                modalMensajeRegistro.textContent = '';
                modalMensajeRegistro.className = 'me-auto';
            });

        } else {
            console.warn("[Webinars Script] No se configuraron los listeners del modal porque faltan elementos esenciales.");
        }

        // Llamada inicial para aplicar filtros (si es necesario al cargar la página)
        // Esto es útil si los filtros pudieran tener valores por defecto al cargar.
        console.log("[Webinars Script] Llamando a aplicarFiltrosWebinars() después de cargar el DOM.");
        aplicarFiltrosWebinars();

        console.log("[Webinars Script] Scripts de la página de webinars completamente inicializados.");
    });
</script>