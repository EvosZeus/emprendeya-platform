<div class="container">
  <div class="row">
    <div class="card card-space">

      <!-- Crud -->
      <!-- CONTENIDO DE GESTIÓN DE WEBINARS (VISTA ADMINISTRADOR CON MODALES) - INICIO -->
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Gestión de Webinars</h3>
        <div>
          <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#webinarModal"
            onclick="prepararModalCrearWebinar()">
            <i class="fa fa-plus"></i>
            Nuevo Webinar
          </button>
          <a href="" class="menu-link" data-page="academia-webinars"> <!-- Asumiendo que tienes una página principal de webinars -->
            <span class="btn btn-primary">Regresar</span>
          </a>
        </div>
      </div>
      <div class="card-body">
        <!-- Filtros -->
        <div class="row mb-3">
          <div class="col-md-3">
            <input type="text" id="filtroWebinarTitulo" class="form-control" placeholder="Buscar por título...">
          </div>
          <div class="col-md-3">
            <select id="filtroWebinarCategoria" class="form-select">
              <option selected value="">Categoría...</option>
              <!-- Opciones de categoría se cargarán por JavaScript -->
            </select>
          </div>
          <div class="col-md-2">
            <input type="date" id="filtroWebinarFecha" class="form-control">
          </div>
          <div class="col-md-2">
            <select id="filtroWebinarEstado" class="form-select">
              <option selected value="">Estado...</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
              <option value="2">Próximo</option>
              <option value="3">Pasado</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary w-100" onclick="filtrarWebinars()">Filtrar</button>
          </div>
        </div>

        <div class="table-responsive">
          <table id="webinarsTable" class="display table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Fecha Webinar</th>
                <th>Estado</th>
                <th style="width: 15%">Acciones</th>
              </tr>
            </thead>
            <tbody id="webinarsTableBody">
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

      <!-- Modal para Crear/Editar Webinar -->
      <div class="modal fade" id="webinarModal" tabindex="-1" aria-labelledby="webinarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="webinarModalLabel">Nuevo Webinar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="webinarForm">
                <input type="hidden" id="webinarId" name="webinarId">
                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label for="webinarTitulo" class="form-label">Título del Webinar <span
                          class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="webinarTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                      <label for="webinarPonente" class="form-label">Ponente <span
                          class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="webinarPonente" name="ponente" required>
                    </div>
                    <div class="mb-3">
                      <label for="webinarDescripcion" class="form-label">Descripción <span
                          class="text-danger">*</span></label>
                      <textarea class="form-control" id="webinarDescripcion" name="descripcion" rows="8"
                        placeholder="Descripción detallada del webinar..." required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="webinarEnlaceUnion" class="form-label">Enlace de Unión (Zoom, Meet, etc.) <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" id="webinarEnlaceUnion" name="enlace_union" placeholder="https://..." required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="webinarEnlaceGrabacion" class="form-label">Enlace de Grabación (Opcional)</label>
                            <input type="url" class="form-control" id="webinarEnlaceGrabacion" name="enlace_grabacion" placeholder="https://youtube.com/...">
                        </div>
                    </div>
                     <div class="mb-3">
                        <label for="webinarVideoPromocional" class="form-label">Video Promocional (URL)</label>
                        <input type="url" class="form-control" id="webinarVideoPromocional" name="video_promocional"
                          placeholder="https://youtube.com/...">
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-header">
                        <h6 class="mb-0">Detalles del Webinar</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                            <label for="webinarCategoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                            <select class="form-select" id="webinarCategoria" name="categoria_id" required>
                                <option value="">Seleccionar categoría...</option>
                                <!-- Opciones de categoría se cargarán por JavaScript -->
                            </select>
                        </div>
                        <div class="mb-3">
                          <label for="webinarEstado" class="form-label">Estado <span class="text-danger">*</span></label>
                          <select class="form-select" id="webinarEstado" name="estado" required>
                            <option value="1">Activo (Visible)</option>
                            <option value="0">Inactivo (Oculto)</option>
                            <option value="2">Próximo</option>
                            <option value="3">Pasado (con grabación)</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="webinarFecha" class="form-label">Fecha y Hora del Webinar <span class="text-danger">*</span></label>
                          <input type="datetime-local" class="form-control" id="webinarFecha" name="fecha_webinar" required>
                        </div>
                        <div class="mb-3">
                          <label for="webinarDuracionMinutos" class="form-label">Duración (minutos) <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="webinarDuracionMinutos" name="duracion_minutos" placeholder="Ej: 90" required min="1">
                        </div>
                        <div class="mb-3">
                          <label for="webinarModalidad" class="form-label">Modalidad</label>
                          <select class="form-select" id="webinarModalidad" name="modalidad">
                            <option value="Online" selected>Online</option>
                            <option value="Presencial">Presencial (raro para webinar)</option>
                            <option value="Híbrido">Híbrido</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="card mt-3">
                      <div class="card-header">
                        <h6 class="mb-0">Multimedia</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <label for="webinarImagenPortada" class="form-label">Imagen de Portada</label>
                          <input class="form-control" type="file" id="webinarImagenPortada" name="imagen_portada"
                            accept="image/*">
                          <img id="currentWebinarImagenPortadaPreview" src="#" alt="Imagen actual" class="img-thumbnail mt-2"
                            style="max-height: 100px; display:none;">
                        </div>
                        <div class="mb-3">
                          <label for="webinarLogo" class="form-label">Logo del Webinar (Opcional)</label>
                          <input class="form-control" type="file" id="webinarLogo" name="logo" accept="image/*">
                          <img id="currentWebinarLogoPreview" src="#" alt="Logo actual" class="img-thumbnail mt-2"
                            style="max-height: 70px; display:none;">
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success w-100 mt-3" id="guardarWebinarButton"
                      onclick="guardarWebinar()">Guardar Webinar</button>
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

      <!-- Modal para Ver Webinar -->
      <div class="modal fade" id="viewWebinarModal" tabindex="-1" aria-labelledby="viewWebinarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewWebinarModalLabel">Detalle del Webinar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h3 id="viewWebinarTitulo" class="fw-bold"></h3>
              <p class="text-muted">
                <small>Categoría: <span id="viewWebinarCategoria" class="fw-normal"></span> | Ponente: <span id="viewWebinarPonente" class="fw-normal"></span></small><br>
                <small>Fecha: <span id="viewWebinarFecha"></span> | Duración: <span id="viewWebinarDuracion"></span> min.</small><br>
                <small>Modalidad: <span id="viewWebinarModalidad"></span> | Estado: <span id="viewWebinarStatus" class="badge"></span></small>
              </p>
              <div class="mb-2">
                <strong>Enlace para unirse:</strong> <a id="viewWebinarEnlaceUnion" href="#" target="_blank"></a>
              </div>
              <div class="mb-2" id="viewWebinarEnlaceGrabacionContainer" style="display:none;">
                <strong>Enlace de grabación:</strong> <a id="viewWebinarEnlaceGrabacion" href="#" target="_blank"></a>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4" id="viewWebinarLogoContainer" style="text-align:center;">
                  <p class="fw-bold">Logo:</p>
                  <img id="viewWebinarLogo" src="#" alt="Logo del Webinar" class="img-fluid rounded mb-2"
                    style="max-height: 100px;">
                </div>
                <div class="col-md-8" id="viewWebinarImagenPortadaContainer" style="text-align:center;">
                  <p class="fw-bold">Imagen Portada:</p>
                  <img id="viewWebinarImagenPortada" src="#" alt="Imagen de Portada" class="img-fluid rounded"
                    style="max-height: 200px;">
                </div>
              </div>
              <div id="viewWebinarVideoPromocionalContainer" class="mt-3">
                <p class="fw-bold">Video Promocional:</p>
                <a id="viewWebinarVideoPromocionalLink" href="#" target="_blank">Ver video</a>
                <div id="viewWebinarVideoPromocionalEmbed" class="mt-2 ratio ratio-16x9" style="display:none;">
                  <iframe id="viewWebinarVideoPromocionalIframe" src="" title="Video Promocional"
                    allowfullscreen></iframe>
                </div>
              </div>
              <hr>
              <h5>Descripción Completa:</h5>
              <div id="viewWebinarDescripcion" style="max-height: 300px; overflow-y: auto; white-space: pre-wrap;">
                <!-- La descripción del webinar se insertará aquí -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- CONTENIDO DE GESTIÓN DE WEBINARS (VISTA ADMINISTRADOR CON MODALES) - FIN -->
    </div>
  </div>
</div>
<script>
  // Datos de ejemplo para categorías (pueden ser los mismos o diferentes)
  let sampleCategoriasWebinars = [
    { id: 1, nombre: "Tecnología Emergente", descripcion: "Webinars sobre IA, Blockchain, IoT." },
    { id: 2, nombre: "Habilidades Blandas", descripcion: "Desarrollo de liderazgo, comunicación." },
    { id: 3, nombre: "Marketing y Ventas", descripcion: "Estrategias digitales y de crecimiento." },
    { id: 4, nombre: "Bienestar y Productividad", descripcion: "Tips para mejorar el rendimiento y salud." }
  ];

  // Datos de ejemplo para webinars
  let sampleWebinars = [
    { id: 1, titulo: "Introducción a la Inteligencia Artificial Generativa", ponente: "Dr. Alex Pineda", descripcion: "Explora los fundamentos de la IA generativa y sus aplicaciones prácticas en el mundo actual. Veremos ejemplos como ChatGPT y Midjourney.", fecha_webinar: "2024-09-15T10:00", duracion_minutos: 90, modalidad: "Online", imagen_portada: "assets/img/examples/webinar-ia.jpg", logo: "assets/img/examples/logo-tech.png", video_promocional: "https://www.youtube.com/embed/dQw4w9WgXcQ", categoria_id: 1, estado: 2, enlace_union: "https://zoom.us/j/1234567890", enlace_grabacion: null, creado_en: "2024-07-01 10:00:00", actualizado_en: "2024-07-15 12:30:00" },
    { id: 2, titulo: "Comunicación Efectiva en Equipos Remotos", ponente: "Lic. Sofia Ramirez", descripcion: "Aprende técnicas y herramientas para mejorar la comunicación y colaboración en equipos que trabajan a distancia.", fecha_webinar: "2024-08-20T16:30", duracion_minutos: 60, modalidad: "Online", imagen_portada: "assets/img/examples/webinar-comunicacion.jpg", logo: null, video_promocional: "", categoria_id: 2, estado: 3, enlace_union: "https://meet.google.com/abc-def-ghi", enlace_grabacion: "https://youtu.be/examplegrabacion1", creado_en: "2024-06-15 14:00:00", actualizado_en: "2024-07-10 09:00:00" },
    { id: 3, titulo: "Estrategias de Contenido para Redes Sociales en 2024", ponente: " especialista en marketing", descripcion: "Descubre las últimas tendencias y estrategias para crear contenido atractivo que genere engagement en tus redes sociales.", fecha_webinar: "2024-10-05T11:00", duracion_minutos: 75, modalidad: "Online", imagen_portada: null, logo: "assets/img/examples/logo-mkt.png", video_promocional: "https://vimeo.com/123456789", categoria_id: 3, estado: 1, enlace_union: "https://teams.microsoft.com/l/meetup-join/...", enlace_grabacion: null, creado_en: "2024-07-20 16:00:00", actualizado_en: "2024-07-20 16:00:00" },
  ];

  const webinarModal = new bootstrap.Modal(document.getElementById('webinarModal'));
  const viewWebinarModal = new bootstrap.Modal(document.getElementById('viewWebinarModal'));

  function renderCategoriasWebinarSelect(selectId, placeholder = "Seleccionar categoría...") {
      const selectElement = document.getElementById(selectId);
      selectElement.innerHTML = `<option value="">${placeholder}</option>`;
      sampleCategoriasWebinars.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.id;
        option.textContent = cat.nombre;
        selectElement.appendChild(option);
      });
  }

  function formatWebinarDateTime(dateTimeString) {
      if (!dateTimeString) return 'N/A';
      const date = new Date(dateTimeString);
      return date.toLocaleString('es-ES', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });
  }
  function formatWebinarDateForTable(dateTimeString) {
      if (!dateTimeString) return 'N/A';
      const date = new Date(dateTimeString);
      return date.toLocaleDateString('es-ES', { year: 'numeric', month: 'short', day: 'numeric' }) + ' ' + date.toLocaleTimeString('es-ES', {hour: '2-digit', minute: '2-digit'});
  }


  function renderWebinarsTable(webinarsToShow = sampleWebinars) {
    const tableBody = document.getElementById('webinarsTableBody');
    tableBody.innerHTML = ''; // Limpiar tabla
    webinarsToShow.forEach(webinar => {
      const row = tableBody.insertRow();
      row.id = `row-webinar-${webinar.id}`;
      row.insertCell().textContent = webinar.id;
      row.insertCell().textContent = webinar.titulo.substring(0, 40) + (webinar.titulo.length > 40 ? '...' : '');
      
      const categoria = sampleCategoriasWebinars.find(cat => cat.id === webinar.categoria_id);
      row.insertCell().textContent = categoria ? categoria.nombre : 'N/A';
      
      row.insertCell().textContent = formatWebinarDateForTable(webinar.fecha_webinar);

      const estadoCell = row.insertCell();
      const estadoBadge = document.createElement('span');
      estadoBadge.classList.add('badge');
      if (webinar.estado == 1) { // Activo
        estadoBadge.classList.add('bg-success');
        estadoBadge.textContent = 'Activo';
      } else if (webinar.estado == 0) { // Inactivo
        estadoBadge.classList.add('bg-danger');
        estadoBadge.textContent = 'Inactivo';
      } else if (webinar.estado == 2) { // Próximo
        estadoBadge.classList.add('bg-info');
        estadoBadge.textContent = 'Próximo';
      } else if (webinar.estado == 3) { // Pasado
        estadoBadge.classList.add('bg-secondary');
        estadoBadge.textContent = 'Pasado';
      } else {
        estadoBadge.textContent = 'Desconocido';
      }
      estadoCell.appendChild(estadoBadge);

      const actionsCell = row.insertCell();
      actionsCell.style.width = '15%';
      actionsCell.innerHTML = `
          <div class="form-button-action">
              <button type="button" data-bs-toggle="tooltip" title="Editar Webinar" class="btn btn-link btn-primary btn-lg" onclick="prepararModalEditarWebinar(${webinar.id})">
                  <i class="fa fa-edit"></i>
              </button>
              <button type="button" data-bs-toggle="tooltip" title="Eliminar Webinar" class="btn btn-link btn-danger" onclick="confirmarEliminarWebinar(${webinar.id})">
                  <i class="fa fa-times"></i>
              </button>
              <button type="button" data-bs-toggle="tooltip" title="Ver Webinar" class="btn btn-link btn-info" onclick="prepararModalVerWebinar(${webinar.id})">
                  <i class="fa fa-eye"></i>
              </button>
          </div>`;
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  }

  function filtrarWebinars() {
    const filtroTituloVal = document.getElementById('filtroWebinarTitulo').value.toLowerCase();
    const filtroCategoriaVal = document.getElementById('filtroWebinarCategoria').value;
    const filtroFechaVal = document.getElementById('filtroWebinarFecha').value;
    const filtroEstadoVal = document.getElementById('filtroWebinarEstado').value;

    const webinarsFiltrados = sampleWebinars.filter(webinar => {
      const tituloMatch = webinar.titulo.toLowerCase().includes(filtroTituloVal);
      const categoriaMatch = filtroCategoriaVal ? webinar.categoria_id == filtroCategoriaVal : true;
      let fechaMatch = true;
      if (filtroFechaVal) {
          const webinarDate = webinar.fecha_webinar.substring(0,10); // YYYY-MM-DD
          fechaMatch = webinarDate === filtroFechaVal;
      }
      const estadoMatch = filtroEstadoVal ? webinar.estado == filtroEstadoVal : true;
      return tituloMatch && categoriaMatch && fechaMatch && estadoMatch;
    });
    renderWebinarsTable(webinarsFiltrados);
  }


  function prepararModalCrearWebinar() {
    document.getElementById('webinarForm').reset();
    renderCategoriasWebinarSelect('webinarCategoria', 'Seleccionar categoría...');
    document.getElementById('webinarId').value = '';
    document.getElementById('webinarModalLabel').textContent = 'Nuevo Webinar';
    document.getElementById('guardarWebinarButton').textContent = 'Crear Webinar';
    document.getElementById('guardarWebinarButton').classList.remove('btn-warning');
    document.getElementById('guardarWebinarButton').classList.add('btn-success');
    document.getElementById('currentWebinarImagenPortadaPreview').style.display = 'none';
    document.getElementById('currentWebinarImagenPortadaPreview').src = '#';
    document.getElementById('currentWebinarLogoPreview').style.display = 'none';
    document.getElementById('currentWebinarLogoPreview').src = '#';
    document.getElementById('webinarModalidad').value = 'Online'; // Default
    webinarModal.show();
  }

  function prepararModalEditarWebinar(webinarId) {
    const webinar = sampleWebinars.find(w => w.id === webinarId);
    if (!webinar) return;

    document.getElementById('webinarForm').reset();
    renderCategoriasWebinarSelect('webinarCategoria', 'Seleccionar categoría...');
    document.getElementById('webinarId').value = webinar.id;
    document.getElementById('webinarModalLabel').textContent = 'Editar Webinar';
    document.getElementById('guardarWebinarButton').textContent = 'Actualizar Webinar';
    document.getElementById('guardarWebinarButton').classList.remove('btn-success');
    document.getElementById('guardarWebinarButton').classList.add('btn-warning');

    document.getElementById('webinarTitulo').value = webinar.titulo;
    document.getElementById('webinarPonente').value = webinar.ponente;
    document.getElementById('webinarDescripcion').value = webinar.descripcion;
    document.getElementById('webinarCategoria').value = webinar.categoria_id || '';
    document.getElementById('webinarFecha').value = webinar.fecha_webinar || '';
    document.getElementById('webinarDuracionMinutos').value = webinar.duracion_minutos || '';
    document.getElementById('webinarModalidad').value = webinar.modalidad || 'Online';
    document.getElementById('webinarEnlaceUnion').value = webinar.enlace_union || '';
    document.getElementById('webinarEnlaceGrabacion').value = webinar.enlace_grabacion || '';
    document.getElementById('webinarVideoPromocional').value = webinar.video_promocional || '';
    document.getElementById('webinarEstado').value = webinar.estado.toString();

    if (webinar.imagen_portada) {
      document.getElementById('currentWebinarImagenPortadaPreview').src = webinar.imagen_portada;
      document.getElementById('currentWebinarImagenPortadaPreview').style.display = 'block';
    } else {
      document.getElementById('currentWebinarImagenPortadaPreview').style.display = 'none';
      document.getElementById('currentWebinarImagenPortadaPreview').src = '#';
    }
    if (webinar.logo) {
      document.getElementById('currentWebinarLogoPreview').src = webinar.logo;
      document.getElementById('currentWebinarLogoPreview').style.display = 'block';
    } else {
      document.getElementById('currentWebinarLogoPreview').style.display = 'none';
      document.getElementById('currentWebinarLogoPreview').src = '#';
    }
    webinarModal.show();
  }

  function prepararModalVerWebinar(webinarId) {
    const webinar = sampleWebinars.find(w => w.id === webinarId);
    if (!webinar) return;

    const categoria = sampleCategoriasWebinars.find(cat => cat.id === webinar.categoria_id);
    document.getElementById('viewWebinarCategoria').textContent = categoria ? categoria.nombre : 'N/A';

    document.getElementById('viewWebinarModalLabel').textContent = `Detalle: ${webinar.titulo.substring(0, 30)}...`;
    document.getElementById('viewWebinarTitulo').textContent = webinar.titulo;
    document.getElementById('viewWebinarPonente').textContent = webinar.ponente || 'N/A';
    document.getElementById('viewWebinarFecha').textContent = formatWebinarDateTime(webinar.fecha_webinar);
    document.getElementById('viewWebinarDuracion').textContent = webinar.duracion_minutos || 'N/A';
    document.getElementById('viewWebinarModalidad').textContent = webinar.modalidad || 'N/A';
    
    const enlaceUnionElem = document.getElementById('viewWebinarEnlaceUnion');
    enlaceUnionElem.href = webinar.enlace_union || '#';
    enlaceUnionElem.textContent = webinar.enlace_union || 'No disponible';
    if (!webinar.enlace_union) enlaceUnionElem.target = '';


    const enlaceGrabacionContainer = document.getElementById('viewWebinarEnlaceGrabacionContainer');
    const enlaceGrabacionElem = document.getElementById('viewWebinarEnlaceGrabacion');
    if(webinar.enlace_grabacion){
        enlaceGrabacionElem.href = webinar.enlace_grabacion;
        enlaceGrabacionElem.textContent = webinar.enlace_grabacion;
        enlaceGrabacionContainer.style.display = 'block';
    } else {
        enlaceGrabacionContainer.style.display = 'none';
    }


    const statusBadge = document.getElementById('viewWebinarStatus');
    statusBadge.className = 'badge '; 
    if (webinar.estado == 1) {
      statusBadge.classList.add('bg-success');
      statusBadge.textContent = 'Activo';
    } else if (webinar.estado == 0) {
      statusBadge.classList.add('bg-danger');
      statusBadge.textContent = 'Inactivo';
    } else if (webinar.estado == 2) {
      statusBadge.classList.add('bg-info');
      statusBadge.textContent = 'Próximo';
    } else if (webinar.estado == 3) {
      statusBadge.classList.add('bg-secondary');
      statusBadge.textContent = 'Pasado';
    } else {
        statusBadge.textContent = 'Desconocido';
    }


    if (webinar.imagen_portada) {
      document.getElementById('viewWebinarImagenPortada').src = webinar.imagen_portada;
      document.getElementById('viewWebinarImagenPortadaContainer').style.display = 'block';
    } else {
      document.getElementById('viewWebinarImagenPortada').src = '#';
      document.getElementById('viewWebinarImagenPortadaContainer').style.display = 'none';
    }
    if (webinar.logo) {
      document.getElementById('viewWebinarLogo').src = webinar.logo;
      document.getElementById('viewWebinarLogoContainer').style.display = 'block';
    } else {
      document.getElementById('viewWebinarLogo').src = '#';
      document.getElementById('viewWebinarLogoContainer').style.display = 'none';
    }

    const videoContainer = document.getElementById('viewWebinarVideoPromocionalContainer');
    const videoLink = document.getElementById('viewWebinarVideoPromocionalLink');
    const videoEmbedDiv = document.getElementById('viewWebinarVideoPromocionalEmbed');
    const videoIframe = document.getElementById('viewWebinarVideoPromocionalIframe');

    if (webinar.video_promocional) {
      videoContainer.style.display = 'block';
      videoLink.href = webinar.video_promocional;
      videoLink.textContent = webinar.video_promocional;

      let embedUrl = '';
      if (webinar.video_promocional.includes('youtube.com/watch?v=')) {
        embedUrl = webinar.video_promocional.replace('watch?v=', 'embed/');
      } else if (webinar.video_promocional.includes('youtu.be/')) {
        embedUrl = webinar.video_promocional.replace('youtu.be/', 'youtube.com/embed/');
      } else if (webinar.video_promocional.includes('youtube.com/embed/')) {
        embedUrl = webinar.video_promocional;
      } else if (webinar.video_promocional.includes('vimeo.com/')) {
        const videoId = webinar.video_promocional.split('/').pop().split('?')[0];
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

    document.getElementById('viewWebinarDescripcion').textContent = webinar.descripcion || 'No hay descripción disponible.';
    viewWebinarModal.show();
  }

  function guardarWebinar() {
    const webinarId = document.getElementById('webinarId').value;
    const titulo = document.getElementById('webinarTitulo').value;
    const ponente = document.getElementById('webinarPonente').value;
    const descripcion = document.getElementById('webinarDescripcion').value;
    const categoria_id_val = document.getElementById('webinarCategoria').value;
    const fecha_webinar = document.getElementById('webinarFecha').value;
    const duracion_minutos_val = document.getElementById('webinarDuracionMinutos').value;
    const enlace_union = document.getElementById('webinarEnlaceUnion').value;
    const estado_val = document.getElementById('webinarEstado').value;


    if (!titulo || !ponente || !descripcion || !categoria_id_val || !fecha_webinar || !duracion_minutos_val || !enlace_union || !estado_val) {
      alert("Por favor, completa todos los campos obligatorios (*).");
      return;
    }
    const categoria_id = parseInt(categoria_id_val);
    const duracion_minutos = parseInt(duracion_minutos_val);
    const estado = parseInt(estado_val);

    if (isNaN(categoria_id) || isNaN(duracion_minutos) || isNaN(estado)){
        alert("Error en los valores numéricos (categoría, duración o estado).");
        return;
    }

    let webinarData = {
      titulo: titulo,
      ponente: ponente,
      descripcion: descripcion,
      categoria_id: categoria_id,
      fecha_webinar: fecha_webinar,
      duracion_minutos: duracion_minutos,
      modalidad: document.getElementById('webinarModalidad').value,
      enlace_union: enlace_union,
      enlace_grabacion: document.getElementById('webinarEnlaceGrabacion').value,
      video_promocional: document.getElementById('webinarVideoPromocional').value,
      estado: estado
    };

    const imagenPortadaFile = document.getElementById('webinarImagenPortada').files[0];
    const logoFile = document.getElementById('webinarLogo').files[0];

    if (webinarId) { // Editando
      const idInt = parseInt(webinarId);
      const index = sampleWebinars.findIndex(w => w.id === idInt);
      if (index !== -1) {
        const webinarExistente = sampleWebinars[index];
        webinarData.id = idInt;
        webinarData.imagen_portada = imagenPortadaFile ? URL.createObjectURL(imagenPortadaFile) : webinarExistente.imagen_portada;
        webinarData.logo = logoFile ? URL.createObjectURL(logoFile) : webinarExistente.logo;
        webinarData.creado_en = webinarExistente.creado_en;
        webinarData.actualizado_en = new Date().toISOString().slice(0, 19).replace('T', ' ');
        sampleWebinars[index] = webinarData;
        showToast('Webinar actualizado con éxito', 'success');
      }
    } else { // Creando
      webinarData.id = sampleWebinars.length > 0 ? Math.max(...sampleWebinars.map(w => w.id)) + 1 : 1;
      webinarData.imagen_portada = imagenPortadaFile ? URL.createObjectURL(imagenPortadaFile) : null;
      webinarData.logo = logoFile ? URL.createObjectURL(logoFile) : null;
      const now = new Date().toISOString().slice(0, 19).replace('T', ' ');
      webinarData.creado_en = now;
      webinarData.actualizado_en = now;
      sampleWebinars.push(webinarData);
      showToast('Webinar creado con éxito', 'success');
    }

    console.log("Guardando webinar (simulado):", webinarData);
    webinarModal.hide();
    renderWebinarsTable();
    document.getElementById('webinarForm').reset(); // Limpiar formulario después de guardar
  }

  function confirmarEliminarWebinar(webinarId) {
    if (confirm(`¿Estás seguro de que quieres eliminar el webinar ID ${webinarId}?`)) {
      console.log("Eliminando webinar ID:", webinarId);
      sampleWebinars = sampleWebinars.filter(w => w.id !== webinarId);
      renderWebinarsTable();
      showToast(`Webinar ID ${webinarId} eliminado.`, 'danger');
    }
  }

  document.getElementById('webinarImagenPortada').addEventListener('change', function (event) {
    const preview = document.getElementById('currentWebinarImagenPortadaPreview');
    if (event.target.files && event.target.files[0]) {
      preview.src = URL.createObjectURL(event.target.files[0]);
      preview.style.display = 'block';
    } else {
      preview.style.display = 'none';
      preview.src = '#';
    }
  });
  document.getElementById('webinarLogo').addEventListener('change', function (event) {
    const preview = document.getElementById('currentWebinarLogoPreview');
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
        toastContainer.style.zIndex = '1090'; // Asegurar que esté sobre los modales (Bootstrap modal z-index es 1050-1070)
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
         // Opcional: remover el toast del DOM después de cerrado si se acumulan muchos
        toastElement.remove();
    }, 3000);
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderCategoriasWebinarSelect('filtroWebinarCategoria', 'Categoría...');
    renderCategoriasWebinarSelect('webinarCategoria', 'Seleccionar categoría...');
    renderWebinarsTable();
  });

</script>