<div class="container">
    <div class="row">
        <div class="card card-space">
            <div class="page-inner">

                <!-- Encabezado de la Página -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">Cursos de Academia</h3>
                    <div class="ms-md-auto py-2 py-md-0">
                        <a href="#" class="menu-link" data-page="academia-cursos-crud">
                            <span class="btn btn-primary">Administrar Cursos</span>
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
                                <label for="filtroCursoTitulo" class="form-label">Título del Curso</label>
                                <input type="text" id="filtroCursoTitulo" class="form-control"
                                    placeholder="Buscar por título...">
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <label for="filtroCursoCategoria" class="form-label">Categoría</label>
                                <select id="filtroCursoCategoria" class="form-select">
                                    <option selected value="">Todas las categorías...</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                <label for="filtroCursoNivel" class="form-label">Nivel</label>
                                <select id="filtroCursoNivel" class="form-select">
                                    <option selected value="">Todos los niveles...</option>
                                    <option value="Principiante">Principiante</option>
                                    <option value="Intermedio">Intermedio</option>
                                    <option value="Avanzado">Avanzado</option>
                                    <option value="Todos los niveles">Todos los niveles</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                <label for="filtroCursoEstado" class="form-label">Estado</label>
                                <select id="filtroCursoEstado" class="form-select">
                                    <option selected value="">Todos los estados...</option>
                                    <option value="true">Activo</option>
                                    <option value="false">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-2 d-flex align-items-end">
                                <button class="btn btn-primary w-100" onclick="aplicarFiltrosCursos()">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Listado de Cursos -->
                <div class="row" id="listaCursos">
                    <!-- Curso 1: Marketing Digital -->
                    <div class="col-md-6 col-lg-4 mb-4 curso-item" data-curso-id="1"
                        data-titulo="Curso de Marketing Digital" data-categoria-id="2" data-nivel="Intermedio"
                        data-estado="true" data-duracion="4 semanas">
                        <div class="card h-100">
                            <img src="assets/img/examples/example1.jpeg" class="card-img-top"
                                alt="Curso de Marketing Digital">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Curso de Marketing Digital</h5>
                                <p class="card-text small text-muted">Categoría: Marketing Digital</p>
                                <p class="card-text flex-grow-1">Aprende las estrategias de marketing digital más
                                    efectivas para tu emprendimiento.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesCurso" data-curso-id="1"
                                    data-imagen-portada="assets/img/examples/example1.jpeg"
                                    data-titulo="Curso de Marketing Digital"
                                    data-descripcion="Aprende las estrategias de marketing digital más efectivas para tu emprendimiento. Cubriremos SEO, SEM, redes sociales, email marketing y analítica web para potenciar tu presencia online."
                                    data-duracion="4 semanas" data-nivel="Intermedio" data-modalidad="Online"
                                    data-categoria-nombre="Marketing Digital" data-fecha-inicio="2024-01-15"
                                    data-video-promocional="https://www.youtube.com/embed/dQw4w9WgXcQ">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Duración: 4 semanas</small>
                                <small class="text-muted ms-2">Nivel: Intermedio</small>
                            </div>
                        </div>
                    </div>

                    <!-- Curso 2: Desarrollo Web Full Stack -->
                    <div class="col-md-6 col-lg-4 mb-4 curso-item" data-curso-id="2"
                        data-titulo="Desarrollo Web Full Stack con React y Node" data-categoria-id="1"
                        data-nivel="Avanzado" data-estado="true" data-duracion="12 semanas">
                        <div class="card h-100">
                            <img src="assets/img/bg-404.jpeg" class="card-img-top" alt="Desarrollo Web Full Stack">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Desarrollo Web Full Stack con React y Node</h5>
                                <p class="card-text small text-muted">Categoría: Desarrollo Web</p>
                                <p class="card-text flex-grow-1">Conviértete en un desarrollador full stack dominando
                                    React para el frontend y Node.js para el backend.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesCurso" data-curso-id="2"
                                    data-imagen-portada="assets/img/bg-404.jpeg"
                                    data-titulo="Desarrollo Web Full Stack con React y Node"
                                    data-descripcion="Un curso completo que te llevará desde los fundamentos hasta la creación de aplicaciones web modernas y escalables utilizando React, Redux, Node.js, Express y MongoDB."
                                    data-duracion="12 semanas" data-nivel="Avanzado"
                                    data-modalidad="Online con mentorías" data-categoria-nombre="Desarrollo Web"
                                    data-fecha-inicio="2024-02-01" data-video-promocional="">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Duración: 12 semanas</small>
                                <small class="text-muted ms-2">Nivel: Avanzado</small>
                            </div>
                        </div>
                    </div>

                    <!-- Curso 3: Gestión de Proyectos Ágiles -->
                    <div class="col-md-6 col-lg-4 mb-4 curso-item" data-curso-id="3"
                        data-titulo="Gestión de Proyectos Ágiles con Scrum" data-categoria-id="3"
                        data-nivel="Intermedio" data-estado="true" data-duracion="6 semanas">
                        <div class="card h-100">
                            <img src="assets/img/blog-1.jpeg" class="card-img-top" alt="Gestión de Proyectos Ágiles">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Gestión de Proyectos Ágiles con Scrum</h5>
                                <p class="card-text small text-muted">Categoría: Gestión de Proyectos</p>
                                <p class="card-text flex-grow-1">Aprende a liderar equipos y entregar valor de forma
                                    iterativa e incremental utilizando el marco Scrum.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesCurso" data-curso-id="3"
                                    data-imagen-portada="assets/img/blog-1.jpeg"
                                    data-titulo="Gestión de Proyectos Ágiles con Scrum"
                                    data-descripcion="Domina los roles, eventos y artefactos de Scrum. Este curso te prepara para certificaciones como PSM I y te da herramientas prácticas para aplicar en tus proyectos."
                                    data-duracion="6 semanas" data-nivel="Intermedio"
                                    data-modalidad="Híbrida (Online y Presencial)"
                                    data-categoria-nombre="Gestión de Proyectos" data-fecha-inicio="2024-03-15"
                                    data-video-promocional="https://www.youtube.com/embed/example_scrum_video">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Duración: 6 semanas</small>
                                <small class="text-muted ms-2">Nivel: Intermedio</small>
                            </div>
                        </div>
                    </div>

                    <!-- Curso 4: Diseño Gráfico para Principiantes (INACTIVO) -->
                    <div class="col-md-6 col-lg-4 mb-4 curso-item" data-curso-id="4"
                        data-titulo="Diseño Gráfico para Principiantes" data-categoria-id="4" data-nivel="Principiante"
                        data-estado="false" data-duracion="8 semanas">
                        <div class="card h-100">
                            <img src="assets/img/blog-3.jpeg" class="card-img-top"
                                alt="Diseño Gráfico para Principiantes">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Diseño Gráfico para Principiantes</h5>
                                <p class="card-text small text-muted">Categoría: Diseño Gráfico</p>
                                <p class="card-text flex-grow-1">Introduce tus primeros pasos en el mundo del diseño
                                    visual, aprendiendo composición, color y tipografía.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesCurso" data-curso-id="4"
                                    data-imagen-portada="assets/img/blog-3.jpeg"
                                    data-titulo="Diseño Gráfico para Principiantes"
                                    data-descripcion="Un curso introductorio ideal para quienes desean aprender los fundamentos del diseño gráfico utilizando herramientas accesibles. Crearemos logotipos, carteles y diseños para redes sociales."
                                    data-duracion="8 semanas" data-nivel="Principiante" data-modalidad="Online"
                                    data-categoria-nombre="Diseño Gráfico" data-fecha-inicio="2023-12-01"
                                    data-video-promocional="">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Duración: 8 semanas</small>
                                <small class="text-muted ms-2">Nivel: Principiante</small>
                                <small class="text-danger ms-2 fw-bold">Estado: Inactivo</small>
                            </div>
                        </div>
                    </div>

                    <!-- Curso 5: Python para Análisis de Datos -->
                    <div class="col-md-6 col-lg-4 mb-4 curso-item" data-curso-id="5"
                        data-titulo="Python para Análisis de Datos" data-categoria-id="1" data-nivel="Intermedio"
                        data-estado="true" data-duracion="10 semanas">
                        <div class="card h-100">
                            <img src="assets/img/examples/example5.jpeg" class="card-img-top"
                                alt="Python para Análisis de Datos">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">Python para Análisis de Datos</h5>
                                <p class="card-text small text-muted">Categoría: Desarrollo Web / Ciencia de Datos</p>
                                <p class="card-text flex-grow-1">Aprende a manipular, analizar y visualizar datos
                                    utilizando Python y librerías como Pandas, NumPy y Matplotlib.</p>
                                <button class="btn btn-outline-primary btn-sm mt-auto view-details-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalDetallesCurso" data-curso-id="5"
                                    data-imagen-portada="assets/img/examples/example5.jpeg"
                                    data-titulo="Python para Análisis de Datos"
                                    data-descripcion="Este curso te proporcionará las habilidades para trabajar con grandes conjuntos de datos, realizar limpieza, transformación, análisis exploratorio y crear visualizaciones efectivas con Python."
                                    data-duracion="10 semanas" data-nivel="Intermedio" data-modalidad="Online"
                                    data-categoria-nombre="Desarrollo Web" data-fecha-inicio="2024-04-01"
                                    data-video-promocional="https://www.youtube.com/embed/another_example_video">
                                    Ver Detalles
                                </button>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Duración: 10 semanas</small>
                                <small class="text-muted ms-2">Nivel: Intermedio</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center" id="mensajeSinCursos" style="display: none;">
                        <p>No se encontraron cursos con los filtros aplicados.</p>
                    </div>
                </div>

                <!-- Paginación -->
                <nav aria-label="Paginación de cursos" class="mt-4">
                    <ul class="pagination justify-content-center" id="paginacionCursos">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                    </ul>
                </nav>
            </div> <!-- Fin de .page-inner -->

            <!-- Modal para Detalles del Curso -->
            <div class="modal fade" id="modalDetallesCurso" tabindex="-1" aria-labelledby="modalDetallesCursoLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDetallesCursoLabel">Detalles del Curso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5 text-center">
                                    <img id="modalCursoImagen" src="" class="img-fluid rounded mb-3"
                                        alt="Imagen del Curso" style="max-height: 250px; object-fit: cover;">
                                    <div id="modalCursoVideoPlaceholder">
                                        <!-- Video se inserta aquí por JS -->
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h4 id="modalCursoTitulo" class="fw-bold"></h4>
                                    <p id="modalCursoDescripcion"></p>
                                    <hr>
                                    <p><strong class="text-primary">Categoría:</strong> <span
                                            id="modalCursoCategoriaNombre"></span></p>
                                    <p><strong class="text-primary">Duración:</strong> <span
                                            id="modalCursoDuracion"></span></p>
                                    <p><strong class="text-primary">Nivel:</strong> <span id="modalCursoNivel"></span>
                                    </p>
                                    <p><strong class="text-primary">Modalidad:</strong> <span
                                            id="modalCursoModalidad"></span></p>
                                    <p><strong class="text-primary">Fecha de Inicio:</strong> <span
                                            id="modalCursoFechaInicio"></span></p>
                                    <p><strong class="text-primary">Estado:</strong> <span id="modalCursoEstado"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div id="modalMensajeInscripcion" class="me-auto" style="display: none;">
                                <!-- Mensaje de confirmación/error -->
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" id="btnInscribirseCurso"
                                data-curso-id="">Inscribirse</button>

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Fin de .card .card-space -->
    </div> <!-- Fin de .row -->
</div> <!-- Fin de .container -->

<script>
    // Función para cargar categorías en el filtro (ejemplo)
    async function cargarCategoriasFiltro() {
        const selectCategoria = document.getElementById('filtroCursoCategoria');
        if (!selectCategoria) {
            console.warn("Elemento select 'filtroCursoCategoria' no encontrado.");
            return;
        }
        // Simulación de fetch a tu API para obtener categorías
        // En un caso real, harías: const response = await fetch('/api/categorias'); const categorias = await response.json();
        const categorias = [
            { id: 1, nombre: "Desarrollo Web" },
            { id: 2, nombre: "Marketing Digital" },
            { id: 3, nombre: "Gestión de Proyectos" },
            { id: 4, nombre: "Diseño Gráfico" },
            { id: 5, nombre: "Otros" }
        ]; // Datos de ejemplo

        // Limpiar opciones previas excepto la primera ("Todas las categorías...")
        while (selectCategoria.options.length > 1) {
            selectCategoria.remove(1);
        }

        categorias.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat.id; // Usar el ID de la categoría como valor
            option.textContent = cat.nombre;
            selectCategoria.appendChild(option);
        });
    }

    // Función para aplicar filtros
    function aplicarFiltrosCursos() {
        console.log("Aplicando filtros...");
        const tituloInput = document.getElementById('filtroCursoTitulo');
        const categoriaSelect = document.getElementById('filtroCursoCategoria');
        const nivelSelect = document.getElementById('filtroCursoNivel');
        const estadoSelect = document.getElementById('filtroCursoEstado');

        if (!tituloInput || !categoriaSelect || !nivelSelect || !estadoSelect) {
            console.error("Uno o más elementos de filtro no fueron encontrados.");
            return;
        }

        const titulo = tituloInput.value.toLowerCase();
        const categoriaId = categoriaSelect.value;
        const nivel = nivelSelect.value;
        const estado = estadoSelect.value;

        const todosLosCursos = document.querySelectorAll('#listaCursos .curso-item');
        if (todosLosCursos.length === 0 && document.getElementById('listaCursos')) {
            // Si listaCursos existe pero no hay items, no hacer nada o mostrar mensaje
        } else if (!document.getElementById('listaCursos')) {
            console.warn("Elemento '#listaCursos' no encontrado para filtrar.");
            return;
        }

        let cursosVisibles = 0;

        todosLosCursos.forEach(card => {
            const cardTitulo = card.dataset.titulo ? card.dataset.titulo.toLowerCase() : '';
            const cardCategoriaId = card.dataset.categoriaId || '';
            const cardNivel = card.dataset.nivel || '';
            const cardEstado = card.dataset.estado || '';

            const coincideTitulo = titulo === '' || cardTitulo.includes(titulo);
            const coincideCategoria = categoriaId === '' || cardCategoriaId === categoriaId;
            const coincideNivel = nivel === '' || cardNivel === nivel;
            const coincideEstado = estado === '' || cardEstado === estado;

            if (coincideTitulo && coincideCategoria && coincideNivel && coincideEstado) {
                card.style.display = 'block';
                cursosVisibles++;
            } else {
                card.style.display = 'none';
            }
        });

        const mensajeSinCursos = document.getElementById('mensajeSinCursos');
        if (mensajeSinCursos) {
            mensajeSinCursos.style.display = cursosVisibles === 0 ? 'block' : 'none';
        }
    }

    // ÚNICA instancia del listener DOMContentLoaded
    document.addEventListener('DOMContentLoaded', function () {
        console.log("DOM completamente cargado y parseado. Inicializando scripts de la página de cursos.");

        cargarCategoriasFiltro();

        const modalDetallesCurso = document.getElementById('modalDetallesCurso');
        const btnInscribirse = document.getElementById('btnInscribirseCurso');
        const modalMensajeInscripcion = document.getElementById('modalMensajeInscripcion');

        // Validar que los elementos del modal existen antes de añadir listeners
        if (!modalDetallesCurso) {
            console.warn("Modal '#modalDetallesCurso' no encontrado.");
            // Si el modal es esencial para esta página y no se encuentra, podrías detener más ejecuciones o mostrar un error.
            // Por ahora, solo se salta la lógica del modal si no existe.
        } else if (!btnInscribirse) {
            console.warn("Botón '#btnInscribirseCurso' no encontrado dentro del modal.");
        } else if (!modalMensajeInscripcion) {
            console.warn("Elemento '#modalMensajeInscripcion' no encontrado dentro del modal.");
        } else {
            // Toda la lógica del modal va aquí adentro si los elementos existen
            modalDetallesCurso.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Botón "Ver Detalles" que abrió el modal
                if (!button) {
                    console.error("No se pudo determinar el botón que disparó el modal.");
                    return;
                }

                const cursoId = button.dataset.cursoId;
                const imagenSrc = button.dataset.imagenPortada || 'assets/img/placeholder.jpg';
                const titulo = button.dataset.titulo || 'Título no disponible';
                const descripcion = button.dataset.descripcion || 'Descripción no disponible.';
                const categoriaNombre = button.dataset.categoriaNombre || 'N/A';
                const duracion = button.dataset.duracion || 'N/A';
                const nivel = button.dataset.nivel || 'N/A';
                const modalidad = button.dataset.modalidad || 'N/A';
                const fechaInicioRaw = button.dataset.fechaInicio;
                // Corrección para manejar fechas inválidas o no existentes
                let fechaInicio = 'N/A';
                if (fechaInicioRaw && fechaInicioRaw !== "null" && fechaInicioRaw !== "undefined") {
                    const dateObj = new Date(fechaInicioRaw);
                    if (!isNaN(dateObj.getTime())) { // Verifica si la fecha es válida
                        fechaInicio = dateObj.toLocaleDateString();
                    }
                }
                const videoPromocionalUrl = button.dataset.videoPromocional;

                const tarjetaCurso = button.closest('.curso-item');
                const cursoEstaActivo = tarjetaCurso ? tarjetaCurso.dataset.estado === "true" : false;

                // Poblar modal
                modalDetallesCurso.querySelector('#modalCursoImagen').src = imagenSrc;
                modalDetallesCurso.querySelector('#modalCursoImagen').alt = "Imagen de " + titulo;
                modalDetallesCurso.querySelector('#modalCursoTitulo').textContent = titulo;
                modalDetallesCurso.querySelector('#modalCursoDescripcion').textContent = descripcion;
                modalDetallesCurso.querySelector('#modalCursoCategoriaNombre').textContent = categoriaNombre;
                modalDetallesCurso.querySelector('#modalCursoDuracion').textContent = duracion;
                modalDetallesCurso.querySelector('#modalCursoNivel').textContent = nivel;
                modalDetallesCurso.querySelector('#modalCursoModalidad').textContent = modalidad;
                modalDetallesCurso.querySelector('#modalCursoFechaInicio').textContent = fechaInicio;

                const modalCursoEstadoSpan = modalDetallesCurso.querySelector('#modalCursoEstado');
                modalCursoEstadoSpan.textContent = cursoEstaActivo ? 'Activo' : 'Inactivo';
                modalCursoEstadoSpan.className = cursoEstaActivo ? 'text-success fw-bold' : 'text-danger fw-bold';

                const videoPlaceholder = modalDetallesCurso.querySelector('#modalCursoVideoPlaceholder');
                const imgElement = modalDetallesCurso.querySelector('#modalCursoImagen');
                if (videoPromocionalUrl) {
                    imgElement.style.display = 'none';
                    videoPlaceholder.innerHTML = `<div class="ratio ratio-16x9"><iframe id="modalCursoVideoFrame" src="${videoPromocionalUrl}" title="Video promocional del curso" allowfullscreen></iframe></div>`;
                    videoPlaceholder.style.display = 'block';
                } else {
                    imgElement.style.display = 'block';
                    videoPlaceholder.innerHTML = '';
                    videoPlaceholder.style.display = 'none';
                }

                // Configurar botón "Inscribirse"
                btnInscribirse.dataset.cursoId = cursoId;
                modalMensajeInscripcion.style.display = 'none';
                modalMensajeInscripcion.className = 'me-auto';
                modalMensajeInscripcion.textContent = '';
                btnInscribirse.style.display = 'block';

                if (cursoEstaActivo) {
                    btnInscribirse.disabled = false;
                    btnInscribirse.textContent = 'Inscribirse';
                    btnInscribirse.classList.remove('btn-secondary', 'btn-info');
                    btnInscribirse.classList.add('btn-success');
                } else {
                    btnInscribirse.disabled = true;
                    btnInscribirse.textContent = 'No disponible';
                    btnInscribirse.classList.remove('btn-success', 'btn-info');
                    btnInscribirse.classList.add('btn-secondary');
                }
            });

            // Event listener para el clic en el botón "Inscribirse"
            btnInscribirse.addEventListener('click', function () {
                if (this.disabled) return;

                const cursoId = this.dataset.cursoId;
                const cursoTitulo = modalDetallesCurso.querySelector('#modalCursoTitulo').textContent;

                this.disabled = true;
                this.textContent = 'Procesando...';
                modalMensajeInscripcion.style.display = 'none';

                setTimeout(() => {
                    const exitoInscripcion = true; // Cambia a false para simular error

                    if (exitoInscripcion) {
                        modalMensajeInscripcion.textContent = `¡Te has inscrito exitosamente al curso "${cursoTitulo}"!`;
                        modalMensajeInscripcion.className = 'me-auto alert alert-success p-2 small';
                        this.textContent = 'Inscrito';
                        this.classList.remove('btn-success');
                        this.classList.add('btn-info');
                    } else {
                        modalMensajeInscripcion.textContent = 'Hubo un error al procesar tu inscripción. Inténtalo más tarde.';
                        modalMensajeInscripcion.className = 'me-auto alert alert-danger p-2 small';
                        this.disabled = false;
                        this.textContent = 'Inscribirse';
                        this.classList.remove('btn-info', 'btn-secondary');
                        this.classList.add('btn-success');
                    }
                    modalMensajeInscripcion.style.display = 'block';
                }, 1500);
            });

            // Limpiar el modal cuando se cierra
            modalDetallesCurso.addEventListener('hidden.bs.modal', function () {
                btnInscribirse.style.display = 'block';
                btnInscribirse.disabled = false;
                btnInscribirse.textContent = 'Inscribirse';
                btnInscribirse.classList.remove('btn-secondary', 'btn-info');
                btnInscribirse.classList.add('btn-success');

                modalMensajeInscripcion.style.display = 'none';
                modalMensajeInscripcion.textContent = '';
                modalMensajeInscripcion.className = 'me-auto';

                const videoFrame = modalDetallesCurso.querySelector('#modalCursoVideoFrame');
                if (videoFrame && videoFrame.contentWindow) { // Asegurar que el iframe y su contentWindow existan
                    videoFrame.src = ""; // Detener video
                } else if (videoFrame) { // Si solo el iframe existe pero no contentWindow (menos común)
                    const newFrame = videoFrame.cloneNode(); // Clonar para "limpiar" el src
                    videoFrame.parentNode.replaceChild(newFrame, videoFrame);
                }
            });
        } // Fin del bloque if (elementos del modal existen)

        // Aquí podrías añadir otros inicializadores que SÓLO deben correr en la página de cursos
        // por ejemplo, la lógica de paginación si la tienes en el cliente.
    });
</script>


<!-- Boton de inscribirse-->
<script>
    const cursosInscritos = new Set(); // Almacena los IDs de los cursos a los que el usuario ya está inscrito

    document.getElementById('btnInscribirseCurso').addEventListener('click', function () {
        if (this.disabled) return;

        const cursoId = this.dataset.cursoId;
        const cursoTitulo = document.getElementById('modalCursoTitulo').textContent;

        this.disabled = true;
        this.textContent = 'Procesando...';

        setTimeout(() => {
            if (!cursosInscritos.has(cursoId)) {
                cursosInscritos.add(cursoId); // Registrar el curso como inscrito
                const modalMensajeInscripcion = document.getElementById('modalMensajeInscripcion');
                modalMensajeInscripcion.textContent = `¡Te has inscrito exitosamente al curso "${cursoTitulo}"!`;
                modalMensajeInscripcion.className = 'me-auto alert alert-success p-2 small';
                modalMensajeInscripcion.style.display = 'block';

                // Animación de éxito
                const modalDetallesCurso = document.getElementById('modalDetallesCurso');
                const modalInstance = bootstrap.Modal.getInstance(modalDetallesCurso);
                setTimeout(() => {
                    modalInstance.hide(); // Cerrar el modal después de mostrar el mensaje
                }, 1500);

                // Actualizar el botón
                this.textContent = 'Inscrito';
                this.classList.remove('btn-success');
                this.classList.add('btn-info');
            } else {
                const modalMensajeInscripcion = document.getElementById('modalMensajeInscripcion');
                modalMensajeInscripcion.textContent = 'Ya estás inscrito en este curso.';
                modalMensajeInscripcion.className = 'me-auto alert alert-warning p-2 small';
                modalMensajeInscripcion.style.display = 'block';

                this.disabled = false;
                this.textContent = 'Inscribirse';
                this.classList.remove('btn-info', 'btn-secondary');
                this.classList.add('btn-success');
            }
        }, 1500);
    });

    // Habilitar o deshabilitar el botón según los cursos inscritos
    document.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón "Ver Detalles" que abrió el modal
        if (!button) return;

        const cursoId = button.dataset.cursoId;
        const btnInscribirse = document.getElementById('btnInscribirseCurso');

        if (cursosInscritos.has(cursoId)) {
            btnInscribirse.disabled = true;
            btnInscribirse.textContent = 'Inscrito';
            btnInscribirse.classList.remove('btn-success');
            btnInscribirse.classList.add('btn-info');
        } else {
            btnInscribirse.disabled = false;
            btnInscribirse.textContent = 'Inscribirse';
            btnInscribirse.classList.remove('btn-info', 'btn-secondary');
            btnInscribirse.classList.add('btn-success');
        }
    });
</script>