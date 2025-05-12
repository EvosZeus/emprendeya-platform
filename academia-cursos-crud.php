<div class="container">
  <div class="row">
    <div class="card card-space">

      <!-- Crud -->
      <!-- CONTENIDO DE GESTIÓN DE CURSOS (VISTA ADMINISTRADOR CON MODALES) - INICIO -->
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Gestión de Cursos</h3>
        <div>
          <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#cursoModal"
            onclick="prepararModalCrearCurso()">
            <i class="fa fa-plus"></i>
            Nuevo Curso
          </button>
          <a href="" class="menu-link" data-page="academia-cursos">
            <span class="btn btn-primary">Regresar</span>
          </a>
        </div>
      </div>
      <div class="card-body">
        <!-- Filtros -->
        <div class="row mb-3">
          <div class="col-md-3">
            <input type="text" id="filtroTitulo" class="form-control" placeholder="Buscar por título...">
          </div>
          <div class="col-md-3">
            <select id="filtroCategoria" class="form-select">
              <option selected value="">Categoría...</option>
              <option value="1">Desarrollo Web</option>
              <option value="2">Marketing Digital</option>
              <option value="3">Gestión de Proyectos</option>
              <option value="4">Diseño Gráfico</option>
              <option value="5">Otros</option>
              <!-- Opciones de categoría se cargarán por JavaScript -->
            </select>
          </div>
          <div class="col-md-2">
            <select id="filtroNivel" class="form-select">
              <option selected value="">Nivel...</option>
              <option value="Principiante">Principiante</option>
              <option value="Intermedio">Intermedio</option>
              <option value="Avanzado">Avanzado</option>
              <option value="Todos los niveles">Todos los niveles</option>
            </select>
          </div>
          <div class="col-md-2">
            <select id="filtroEstado" class="form-select">
              <option selected value="">Estado...</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary w-100" onclick="filtrarCursos()">Filtrar</button>
          </div>
        </div>

        <div class="table-responsive">
          <table id="cursosTable" class="display table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Nivel</th>
                <th>Estado</th>
                <th style="width: 15%">Acciones</th>
              </tr>
            </thead>
            <tbody id="cursosTableBody">
              <!-- Las filas se cargarán dinámicamente por JavaScript -->
            </tbody>
          </table>
        </div>
        <nav aria-label="Page navigation example" class="mt-4">
          <ul class="pagination justify-content-end">
            <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
          </ul>
        </nav>
      </div>



      <!-- Modal para Crear/Editar Curso -->
      <div class="modal fade" id="cursoModal" tabindex="-1" aria-labelledby="cursoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="cursoModalLabel">Nuevo Curso</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="cursoForm">
                <input type="hidden" id="cursoId" name="cursoId">
                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label for="cursoTitulo" class="form-label">Título del Curso <span
                          class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="cursoTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                      <label for="cursoDescripcion" class="form-label">Descripción <span
                          class="text-danger">*</span></label>
                      <textarea class="form-control" id="cursoDescripcion" name="descripcion" rows="10"
                        placeholder="Descripción detallada del curso..." required></textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="cursoVideoPromocional" class="form-label">Video Promocional (URL)</label>
                        <input type="url" class="form-control" id="cursoVideoPromocional" name="video_promocional"
                          placeholder="https://youtube.com/...">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-header">
                        <h6 class="mb-0">Detalles del Curso</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                            <label for="cursoCategoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                            <select class="form-select" id="cursoCategoria" name="categoria_id" required>
                                <option value="">Seleccionar categoría...</option>
                                <!-- Opciones de categoría se cargarán por JavaScript -->
                            </select>
                        </div>
                        <div class="mb-3">
                          <label for="cursoEstado" class="form-label">Estado <span class="text-danger">*</span></label>
                          <select class="form-select" id="cursoEstado" name="estado" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="cursoNivel" class="form-label">Nivel <span class="text-danger">*</span></label>
                          <select class="form-select" id="cursoNivel" name="nivel" required>
                            <option value="">Seleccionar nivel...</option>
                            <option value="Principiante">Principiante</option>
                            <option value="Intermedio">Intermedio</option>
                            <option value="Avanzado">Avanzado</option>
                            <option value="Todos los niveles">Todos los niveles</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="cursoDuracion" class="form-label">Duración</label>
                          <input type="text" class="form-control" id="cursoDuracion" name="duracion"
                            placeholder="Ej: 4 semanas, 20 horas">
                        </div>
                        <div class="mb-3">
                          <label for="cursoModalidad" class="form-label">Modalidad</label>
                          <select class="form-select" id="cursoModalidad" name="modalidad">
                            <option value="">Seleccionar modalidad...</option>
                            <option value="Online">Online</option>
                            <option value="Presencial">Presencial</option>
                            <option value="Híbrido">Híbrido</option>
                          </select>
                        </div>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="cursoFechaInicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="cursoFechaInicio" name="fecha_inicio">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="cursoFechaFin" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="cursoFechaFin" name="fecha_fin">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card mt-3">
                      <div class="card-header">
                        <h6 class="mb-0">Multimedia</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <label for="cursoImagenPortada" class="form-label">Imagen de Portada</label>
                          <input class="form-control" type="file" id="cursoImagenPortada" name="imagen_portada"
                            accept="image/*">
                          <img id="currentImagenPortadaPreview" src="#" alt="Imagen actual" class="img-thumbnail mt-2"
                            style="max-height: 100px; display:none;">
                        </div>
                        <div class="mb-3">
                          <label for="cursoLogo" class="form-label">Logo del Curso</label>
                          <input class="form-control" type="file" id="cursoLogo" name="logo" accept="image/*">
                          <img id="currentLogoPreview" src="#" alt="Logo actual" class="img-thumbnail mt-2"
                            style="max-height: 70px; display:none;">
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success w-100 mt-3" id="guardarCursoButton"
                      onclick="guardarCurso()">Guardar Curso</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal para Ver Curso -->
      <div class="modal fade" id="viewCursoModal" tabindex="-1" aria-labelledby="viewCursoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewCursoModalLabel">Detalle del Curso</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h3 id="viewCursoTitulo" class="fw-bold"></h3>
              <p class="text-muted">
                <small>Categoría: <span id="viewCursoCategoria" class="fw-normal"></span> | Nivel: <span id="viewCursoNivel"></span> | Estado: <span id="viewCursoStatus"
                    class="badge"></span></small><br>
                <small>Duración: <span id="viewCursoDuracion"></span> | Modalidad: <span
                    id="viewCursoModalidad"></span></small><br>
                <small>Inicio: <span id="viewCursoFechaInicio"></span> | Fin: <span
                    id="viewCursoFechaFin"></span></small>
              </p>
              <hr>
              <div class="row">
                <div class="col-md-4" id="viewCursoLogoContainer" style="text-align:center;">
                  <p class="fw-bold">Logo:</p>
                  <img id="viewCursoLogo" src="#" alt="Logo del Curso" class="img-fluid rounded mb-2"
                    style="max-height: 100px;">
                </div>
                <div class="col-md-8" id="viewCursoImagenPortadaContainer" style="text-align:center;">
                  <p class="fw-bold">Imagen Portada:</p>
                  <img id="viewCursoImagenPortada" src="#" alt="Imagen de Portada" class="img-fluid rounded"
                    style="max-height: 200px;">
                </div>
              </div>
              <div id="viewCursoVideoPromocionalContainer" class="mt-3">
                <p class="fw-bold">Video Promocional:</p>
                <a id="viewCursoVideoPromocionalLink" href="#" target="_blank">Ver video</a>
                <div id="viewCursoVideoPromocionalEmbed" class="mt-2 ratio ratio-16x9" style="display:none;">
                  <iframe id="viewCursoVideoPromocionalIframe" src="" title="Video Promocional"
                    allowfullscreen></iframe>
                </div>
              </div>
              <hr>
              <h5>Descripción Completa:</h5>
              <div id="viewCursoDescripcion" style="max-height: 300px; overflow-y: auto; white-space: pre-wrap;">
                <!-- La descripción del curso se insertará aquí -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- CONTENIDO DE GESTIÓN DE CURSOS (VISTA ADMINISTRADOR CON MODALES) - FIN -->

      <!-- Details Modal (Opcional, parece no usarse para cursos, lo mantengo por si acaso) -->
      <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detailsModalLabel">Detalles</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img id="modalImage" src="" class="img-fluid mb-3" alt="Imagen">
              <h4 id="modalTitle" class="fw-bold"></h4>
              <p id="modalDescription"></p>
              <p id="modalExtraInfo" class="text-muted"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<script>
  // Datos de ejemplo para categorías
  let sampleCategorias = [
    { id: 1, nombre: "Desarrollo Web", descripcion: "Cursos sobre tecnologías frontend y backend." },
    { id: 2, nombre: "Marketing Digital", descripcion: "Estrategias para promoción online." },
    { id: 3, nombre: "Gestión de Proyectos", descripcion: "Metodologías y herramientas para la gestión." },
    { id: 4, nombre: "Diseño Gráfico", descripcion: "Herramientas y técnicas de diseño visual." }
  ];

  // Datos de ejemplo para cursos (adaptados)
  let sampleCursos = [
    { id: 1, titulo: "Introducción a la Programación Web", descripcion: "Aprende los fundamentos de HTML, CSS y JavaScript para construir tus primeras páginas web. Curso ideal para principiantes sin experiencia previa.", duracion: "8 semanas", nivel: "Principiante", fecha_inicio: "2024-08-01", fecha_fin: "2024-09-26", modalidad: "Online", imagen_portada: "assets/img/examples/curso-web.jpg", logo: "assets/img/examples/logo-prog.png", video_promocional: "https://www.youtube.com/embed/dQw4w9WgXcQ", categoria_id: 1, estado: 1, creado_en: "2024-07-01 10:00:00", actualizado_en: "2024-07-15 12:30:00" },
    { id: 2, titulo: "Marketing Digital Avanzado", descripcion: "Domina estrategias de SEO, SEM, redes sociales y email marketing para potenciar negocios en el entorno digital. Requiere conocimientos básicos de marketing.", duracion: "6 semanas", nivel: "Avanzado", fecha_inicio: "2024-09-01", fecha_fin: "2024-10-12", modalidad: "Híbrido", imagen_portada: "assets/img/examples/curso-marketing.jpg", logo: "assets/img/examples/logo-mkt.png", video_promocional: "", categoria_id: 2, estado: 1, creado_en: "2024-06-15 14:00:00", actualizado_en: "2024-07-10 09:00:00" },
    { id: 3, titulo: "Gestión de Proyectos con Metodologías Ágiles", descripcion: "Descubre Scrum, Kanban y otras metodologías ágiles para liderar proyectos de forma eficiente y flexible. No se requiere experiencia previa en gestión.", duracion: "40 horas", nivel: "Intermedio", fecha_inicio: "2024-08-15", fecha_fin: "2024-09-15", modalidad: "Presencial", imagen_portada: null, logo: null, video_promocional: "https://vimeo.com/123456789", categoria_id: 3, estado: 0, creado_en: "2024-07-20 16:00:00", actualizado_en: "2024-07-20 16:00:00" },
    { id: 4, titulo: "Diseño de Interfaces UX/UI", descripcion: "Aprende a diseñar experiencias de usuario intuitivas y atractivas para aplicaciones web y móviles.", duracion: "10 semanas", nivel: "Intermedio", fecha_inicio: "2024-10-01", fecha_fin: "2024-12-10", modalidad: "Online", imagen_portada: "assets/img/examples/curso-uxui.jpg", logo: "assets/img/examples/logo-design.png", video_promocional: "", categoria_id: 4, estado: 1, creado_en: "2024-07-25 11:00:00", actualizado_en: "2024-07-25 11:00:00" },
  ];

  const cursoModal = new bootstrap.Modal(document.getElementById('cursoModal'));
  const viewCursoModal = new bootstrap.Modal(document.getElementById('viewCursoModal'));

  function renderCategoriasSelect(selectId, placeholder = "Seleccionar categoría...") {
      const selectElement = document.getElementById(selectId);
      selectElement.innerHTML = `<option value="">${placeholder}</option>`;
      sampleCategorias.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.id;
        option.textContent = cat.nombre;
        selectElement.appendChild(option);
      });
  }

  function renderCursosTable(cursosToShow = sampleCursos) {
    const tableBody = document.getElementById('cursosTableBody');
    tableBody.innerHTML = ''; // Limpiar tabla
    cursosToShow.forEach(curso => {
      const row = tableBody.insertRow();
      row.id = `row-curso-${curso.id}`;
      row.insertCell().textContent = curso.id;
      row.insertCell().textContent = curso.titulo.substring(0, 40) + (curso.titulo.length > 40 ? '...' : '');
      
      const categoria = sampleCategorias.find(cat => cat.id === curso.categoria_id);
      row.insertCell().textContent = categoria ? categoria.nombre : 'N/A';
      
      row.insertCell().textContent = curso.nivel || 'N/A';

      const estadoCell = row.insertCell();
      const estadoBadge = document.createElement('span');
      estadoBadge.classList.add('badge');
      if (curso.estado == 1) {
        estadoBadge.classList.add('bg-success');
        estadoBadge.textContent = 'Activo';
      } else {
        estadoBadge.classList.add('bg-danger');
        estadoBadge.textContent = 'Inactivo';
      }
      estadoCell.appendChild(estadoBadge);

      const actionsCell = row.insertCell();
      actionsCell.style.width = '15%';
      actionsCell.innerHTML = `
          <div class="form-button-action">
              <button type="button" data-bs-toggle="tooltip" title="Editar Curso" class="btn btn-link btn-primary btn-lg" onclick="prepararModalEditarCurso(${curso.id})">
                  <i class="fa fa-edit"></i>
              </button>
              <button type="button" data-bs-toggle="tooltip" title="Eliminar Curso" class="btn btn-link btn-danger" onclick="confirmarEliminarCurso(${curso.id})">
                  <i class="fa fa-times"></i>
              </button>
              <button type="button" data-bs-toggle="tooltip" title="Ver Curso" class="btn btn-link btn-info" onclick="prepararModalVerCurso(${curso.id})">
                  <i class="fa fa-eye"></i>
              </button>
          </div>`;
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  }

  function filtrarCursos() {
    const filtroTituloVal = document.getElementById('filtroTitulo').value.toLowerCase();
    const filtroCategoriaVal = document.getElementById('filtroCategoria').value;
    const filtroNivelVal = document.getElementById('filtroNivel').value;
    const filtroEstadoVal = document.getElementById('filtroEstado').value;

    const cursosFiltrados = sampleCursos.filter(curso => {
      const tituloMatch = curso.titulo.toLowerCase().includes(filtroTituloVal);
      const categoriaMatch = filtroCategoriaVal ? curso.categoria_id == filtroCategoriaVal : true;
      const nivelMatch = filtroNivelVal ? curso.nivel === filtroNivelVal : true;
      const estadoMatch = filtroEstadoVal ? curso.estado == filtroEstadoVal : true;
      return tituloMatch && categoriaMatch && nivelMatch && estadoMatch;
    });
    renderCursosTable(cursosFiltrados);
  }


  function prepararModalCrearCurso() {
    document.getElementById('cursoForm').reset();
    renderCategoriasSelect('cursoCategoria', 'Seleccionar categoría...');
    document.getElementById('cursoId').value = '';
    document.getElementById('cursoModalLabel').textContent = 'Nuevo Curso';
    document.getElementById('guardarCursoButton').textContent = 'Crear Curso';
    document.getElementById('guardarCursoButton').classList.remove('btn-warning');
    document.getElementById('guardarCursoButton').classList.add('btn-success');
    document.getElementById('currentImagenPortadaPreview').style.display = 'none';
    document.getElementById('currentImagenPortadaPreview').src = '#';
    document.getElementById('currentLogoPreview').style.display = 'none';
    document.getElementById('currentLogoPreview').src = '#';
    cursoModal.show();
  }

  function prepararModalEditarCurso(cursoId) {
    const curso = sampleCursos.find(c => c.id === cursoId);
    if (!curso) return;

    document.getElementById('cursoForm').reset();
    renderCategoriasSelect('cursoCategoria', 'Seleccionar categoría...');
    document.getElementById('cursoId').value = curso.id;
    document.getElementById('cursoModalLabel').textContent = 'Editar Curso';
    document.getElementById('guardarCursoButton').textContent = 'Actualizar Curso';
    document.getElementById('guardarCursoButton').classList.remove('btn-success');
    document.getElementById('guardarCursoButton').classList.add('btn-warning');

    document.getElementById('cursoTitulo').value = curso.titulo;
    document.getElementById('cursoDescripcion').value = curso.descripcion;
    document.getElementById('cursoCategoria').value = curso.categoria_id || '';
    document.getElementById('cursoDuracion').value = curso.duracion || '';
    document.getElementById('cursoNivel').value = curso.nivel || '';
    document.getElementById('cursoFechaInicio').value = curso.fecha_inicio || '';
    document.getElementById('cursoFechaFin').value = curso.fecha_fin || '';
    document.getElementById('cursoModalidad').value = curso.modalidad || '';
    document.getElementById('cursoVideoPromocional').value = curso.video_promocional || '';
    document.getElementById('cursoEstado').value = curso.estado;

    if (curso.imagen_portada) {
      document.getElementById('currentImagenPortadaPreview').src = curso.imagen_portada;
      document.getElementById('currentImagenPortadaPreview').style.display = 'block';
    } else {
      document.getElementById('currentImagenPortadaPreview').style.display = 'none';
      document.getElementById('currentImagenPortadaPreview').src = '#';
    }
    if (curso.logo) {
      document.getElementById('currentLogoPreview').src = curso.logo;
      document.getElementById('currentLogoPreview').style.display = 'block';
    } else {
      document.getElementById('currentLogoPreview').style.display = 'none';
      document.getElementById('currentLogoPreview').src = '#';
    }
    cursoModal.show();
  }

  function prepararModalVerCurso(cursoId) {
    const curso = sampleCursos.find(c => c.id === cursoId);
    if (!curso) return;

    const categoria = sampleCategorias.find(cat => cat.id === curso.categoria_id);
    document.getElementById('viewCursoCategoria').textContent = categoria ? categoria.nombre : 'N/A';

    document.getElementById('viewCursoModalLabel').textContent = `Detalle: ${curso.titulo.substring(0, 30)}...`;
    document.getElementById('viewCursoTitulo').textContent = curso.titulo;
    document.getElementById('viewCursoNivel').textContent = curso.nivel || 'N/A';
    document.getElementById('viewCursoDuracion').textContent = curso.duracion || 'N/A';
    document.getElementById('viewCursoModalidad').textContent = curso.modalidad || 'N/A';
    document.getElementById('viewCursoFechaInicio').textContent = curso.fecha_inicio ? new Date(curso.fecha_inicio + 'T00:00:00').toLocaleDateString() : 'N/A';
    document.getElementById('viewCursoFechaFin').textContent = curso.fecha_fin ? new Date(curso.fecha_fin + 'T00:00:00').toLocaleDateString() : 'N/A';

    const statusBadge = document.getElementById('viewCursoStatus');
    statusBadge.className = 'badge '; 
    if (curso.estado == 1) {
      statusBadge.classList.add('bg-success');
      statusBadge.textContent = 'Activo';
    } else {
      statusBadge.classList.add('bg-danger');
      statusBadge.textContent = 'Inactivo';
    }

    if (curso.imagen_portada) {
      document.getElementById('viewCursoImagenPortada').src = curso.imagen_portada;
      document.getElementById('viewCursoImagenPortadaContainer').style.display = 'block';
    } else {
      document.getElementById('viewCursoImagenPortada').src = '#';
      document.getElementById('viewCursoImagenPortadaContainer').style.display = 'none';
    }
    if (curso.logo) {
      document.getElementById('viewCursoLogo').src = curso.logo;
      document.getElementById('viewCursoLogoContainer').style.display = 'block';
    } else {
      document.getElementById('viewCursoLogo').src = '#';
      document.getElementById('viewCursoLogoContainer').style.display = 'none';
    }

    const videoContainer = document.getElementById('viewCursoVideoPromocionalContainer');
    const videoLink = document.getElementById('viewCursoVideoPromocionalLink');
    const videoEmbedDiv = document.getElementById('viewCursoVideoPromocionalEmbed');
    const videoIframe = document.getElementById('viewCursoVideoPromocionalIframe');

    if (curso.video_promocional) {
      videoContainer.style.display = 'block';
      videoLink.href = curso.video_promocional;
      videoLink.textContent = curso.video_promocional;

      let embedUrl = '';
      if (curso.video_promocional.includes('youtube.com/watch?v=')) {
        embedUrl = curso.video_promocional.replace('watch?v=', 'embed/');
      } else if (curso.video_promocional.includes('youtu.be/')) {
        embedUrl = curso.video_promocional.replace('youtu.be/', 'youtube.com/embed/');
      } else if (curso.video_promocional.includes('youtube.com/embed/')) {
        embedUrl = curso.video_promocional;
      } else if (curso.video_promocional.includes('vimeo.com/')) {
        const videoId = curso.video_promocional.split('/').pop().split('?')[0];
        embedUrl = `https://player.vimeo.com/video/${videoId}`;
      }

      if (embedUrl) {
        videoIframe.src = embedUrl;
        videoEmbedDiv.style.display = 'block';
      } else {
        videoEmbedDiv.style.display = 'none';
         videoIframe.src = "";
      }
    } else {
      videoContainer.style.display = 'none';
      videoIframe.src = '';
      videoEmbedDiv.style.display = 'none';
    }

    document.getElementById('viewCursoDescripcion').textContent = curso.descripcion || 'No hay descripción disponible.';
    viewCursoModal.show();
  }

  function guardarCurso() {
    const cursoId = document.getElementById('cursoId').value;
    const titulo = document.getElementById('cursoTitulo').value;
    const descripcion = document.getElementById('cursoDescripcion').value;
    const categoria_id_val = document.getElementById('cursoCategoria').value;
    const nivel = document.getElementById('cursoNivel').value;
    const estado_val = document.getElementById('cursoEstado').value;

    if (!titulo || !descripcion || !categoria_id_val || !nivel || !estado_val) {
      alert("Por favor, completa todos los campos obligatorios (*).");
      return;
    }
    const categoria_id = parseInt(categoria_id_val);
    const estado = parseInt(estado_val);

    if (isNaN(categoria_id) || isNaN(estado)){
        alert("Error en los valores de categoría o estado.");
        return;
    }

    let cursoData = {
      titulo: titulo,
      descripcion: descripcion,
      categoria_id: categoria_id,
      duracion: document.getElementById('cursoDuracion').value,
      nivel: nivel,
      fecha_inicio: document.getElementById('cursoFechaInicio').value,
      fecha_fin: document.getElementById('cursoFechaFin').value,
      modalidad: document.getElementById('cursoModalidad').value,
      video_promocional: document.getElementById('cursoVideoPromocional').value,
      estado: estado
    };

    const imagenPortadaFile = document.getElementById('cursoImagenPortada').files[0];
    const logoFile = document.getElementById('cursoLogo').files[0];

    if (cursoId) { // Editando
      const idInt = parseInt(cursoId);
      const index = sampleCursos.findIndex(c => c.id === idInt);
      if (index !== -1) {
        const cursoExistente = sampleCursos[index];
        cursoData.id = idInt;
        cursoData.imagen_portada = imagenPortadaFile ? URL.createObjectURL(imagenPortadaFile) : cursoExistente.imagen_portada;
        cursoData.logo = logoFile ? URL.createObjectURL(logoFile) : cursoExistente.logo;
        cursoData.creado_en = cursoExistente.creado_en;
        cursoData.actualizado_en = new Date().toISOString().slice(0, 19).replace('T', ' ');
        sampleCursos[index] = cursoData;
        showToast('Curso actualizado con éxito', 'success');
      }
    } else { // Creando
      cursoData.id = sampleCursos.length > 0 ? Math.max(...sampleCursos.map(c => c.id)) + 1 : 1;
      cursoData.imagen_portada = imagenPortadaFile ? URL.createObjectURL(imagenPortadaFile) : null;
      cursoData.logo = logoFile ? URL.createObjectURL(logoFile) : null;
      const now = new Date().toISOString().slice(0, 19).replace('T', ' ');
      cursoData.creado_en = now;
      cursoData.actualizado_en = now;
      sampleCursos.push(cursoData);
      showToast('Curso creado con éxito', 'success');
    }

    console.log("Guardando curso (simulado):", cursoData);
    cursoModal.hide();
    renderCursosTable();
    document.getElementById('cursoForm').reset(); // Limpiar formulario después de guardar
  }

  function confirmarEliminarCurso(cursoId) {
    if (confirm(`¿Estás seguro de que quieres eliminar el curso ID ${cursoId}?`)) {
      console.log("Eliminando curso ID:", cursoId);
      sampleCursos = sampleCursos.filter(c => c.id !== cursoId);
      renderCursosTable();
      showToast(`Curso ID ${cursoId} eliminado.`, 'danger');
    }
  }

  document.getElementById('cursoImagenPortada').addEventListener('change', function (event) {
    const preview = document.getElementById('currentImagenPortadaPreview');
    if (event.target.files && event.target.files[0]) {
      preview.src = URL.createObjectURL(event.target.files[0]);
      preview.style.display = 'block';
    } else {
      preview.style.display = 'none';
      preview.src = '#';
    }
  });
  document.getElementById('cursoLogo').addEventListener('change', function (event) {
    const preview = document.getElementById('currentLogoPreview');
    if (event.target.files && event.target.files[0]) {
      preview.src = URL.createObjectURL(event.target.files[0]);
      preview.style.display = 'block';
    } else {
      preview.style.display = 'none';
      preview.src = '#';
    }
  });

  function showToast(message, type = 'info') {
    const existingToastContainer = document.getElementById('toast-container-main');
    let toastContainer;

    if (existingToastContainer) {
        toastContainer = existingToastContainer;
    } else {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container-main';
        toastContainer.style.position = 'fixed';
        toastContainer.style.top = '20px';
        toastContainer.style.right = '20px';
        toastContainer.style.zIndex = '1090';
        document.body.appendChild(toastContainer);
    }

    const toastElement = document.createElement('div');
    toastElement.className = `alert alert-${type} alert-dismissible fade show`;
    toastElement.role = 'alert';
    toastElement.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    toastContainer.appendChild(toastElement);

    const bsAlert = new bootstrap.Alert(toastElement);
    setTimeout(() => {
        bsAlert.close();
    }, 3000);
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderCategoriasSelect('filtroCategoria', 'Categoría...');
    renderCategoriasSelect('cursoCategoria', 'Seleccionar categoría...');
    renderCursosTable();
  });

</script>