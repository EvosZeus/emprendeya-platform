<div class="container">
  <div class="row">
    <div class="card card-space">

      <!-- CRUD de Talleres -->
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Gestión de Talleres</h3>
        <div>
          <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#tallerModal"
            onclick="prepararModalCrearTaller()">
            <i class="fa fa-plus"></i>
            Nuevo Taller
          </button>
          <a href="#" class="menu-link" data-page="academia-talleres"> <!-- Ajusta data-page si es necesario -->
            <span class="btn btn-primary">Regresar a Talleres</span>
          </a>
        </div>
      </div>
      <div class="card-body">
        <!-- Filtros para Talleres -->
        <div class="row mb-3">
          <div class="col-md-4">
            <input type="text" id="filtroTallerTituloCrud" class="form-control" placeholder="Buscar por título...">
          </div>
          <div class="col-md-3">
            <select id="filtroTallerCategoriaCrud" class="form-select">
              <option selected value="">Categoría...</option>
              <!-- Opciones de categoría se cargarán por JavaScript -->
            </select>
          </div>
          <div class="col-md-3">
            <select id="filtroTallerEstadoCrud" class="form-select">
              <option selected value="">Estado...</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary w-100" onclick="filtrarTalleresCrud()">Filtrar</button>
          </div>
        </div>

        <div class="table-responsive">
          <table id="talleresTable" class="display table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th style="width: 15%">Acciones</th>
              </tr>
            </thead>
            <tbody id="talleresTableBody">
              <!-- Las filas se cargarán dinámicamente por JavaScript -->
            </tbody>
          </table>
        </div>
        <nav aria-label="Page navigation example" class="mt-4">
          <ul class="pagination justify-content-end" id="paginacionTalleresCrud">
            <!-- Paginación se generará aquí -->
          </ul>
        </nav>
      </div>

      <!-- Modal para Crear/Editar Taller -->
      <div class="modal fade" id="tallerModal" tabindex="-1" aria-labelledby="tallerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tallerModalLabel">Nuevo Taller</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="tallerForm">
                <input type="hidden" id="tallerId" name="tallerId">
                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label for="tallerTitulo" class="form-label">Título del Taller <span
                          class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="tallerTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                      <label for="tallerDescripcionCorta" class="form-label">Descripción Corta <span
                          class="text-danger">*</span></label>
                      <textarea class="form-control" id="tallerDescripcionCorta" name="descripcion_corta" rows="3"
                        placeholder="Un resumen breve del taller (aparecerá en la tarjeta)..." required></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="tallerDescripcionLarga" class="form-label">Descripción Larga/Detallada</label>
                      <textarea class="form-control" id="tallerDescripcionLarga" name="descripcion_larga" rows="7"
                        placeholder="Información completa sobre el contenido del taller..."></textarea>
                    </div>
                     <div class="mb-3">
                        <label for="tallerVideoPromocional" class="form-label">Video Promocional (URL)</label>
                        <input type="url" class="form-control" id="tallerVideoPromocional" name="video_promocional"
                          placeholder="https://youtube.com/...">
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-header">
                        <h6 class="mb-0">Detalles del Taller</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                            <label for="tallerCategoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                            <select class="form-select" id="tallerCategoria" name="categoria" required>
                                <option value="">Seleccionar categoría...</option>
                                <!-- Opciones de categoría se cargarán por JavaScript -->
                            </select>
                        </div>
                        <div class="mb-3">
                          <label for="tallerEstado" class="form-label">Estado <span class="text-danger">*</span></label>
                          <select class="form-select" id="tallerEstado" name="estado" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="tallerFecha" class="form-label">Fecha del Taller <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" id="tallerFecha" name="fecha" required>
                        </div>
                        <div class="mb-3">
                          <label for="tallerHoraInicio" class="form-label">Hora de Inicio</label>
                          <input type="time" class="form-control" id="tallerHoraInicio" name="hora_inicio">
                        </div>
                         <div class="mb-3">
                          <label for="tallerDuracionEstimada" class="form-label">Duración Estimada</label>
                          <input type="text" class="form-control" id="tallerDuracionEstimada" name="duracion_estimada" placeholder="Ej: 2 horas, 3 sesiones de 1h">
                        </div>
                        <div class="mb-3">
                          <label for="tallerPonente" class="form-label">Ponente(s)</label>
                          <input type="text" class="form-control" id="tallerPonente" name="ponente" placeholder="Nombre del ponente o ponentes">
                        </div>
                         <div class="mb-3">
                          <label for="tallerUbicacion" class="form-label">Ubicación / Enlace</label>
                          <input type="text" class="form-control" id="tallerUbicacion" name="ubicacion" placeholder="Ej: Sala A / Enlace de Zoom">
                        </div>
                      </div>
                    </div>

                    <div class="card mt-3">
                      <div class="card-header">
                        <h6 class="mb-0">Multimedia</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <label for="tallerImagenPortada" class="form-label">Imagen de Portada</label>
                          <input class="form-control" type="file" id="tallerImagenPortada" name="imagen_portada"
                            accept="image/*">
                          <img id="currentTallerImagenPortadaPreview" src="#" alt="Imagen actual" class="img-thumbnail mt-2"
                            style="max-height: 100px; display:none;">
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success w-100 mt-3" id="guardarTallerButton"
                      onclick="guardarTaller()">Guardar Taller</button>
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

      <!-- Modal para Ver Taller -->
      <div class="modal fade" id="viewTallerModal" tabindex="-1" aria-labelledby="viewTallerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewTallerModalLabel">Detalle del Taller</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h3 id="viewTallerTitulo" class="fw-bold"></h3>
              <p class="text-muted">
                <small>Categoría: <span id="viewTallerCategoria" class="fw-normal"></span> | Fecha: <span id="viewTallerFecha"></span> | Estado: <span id="viewTallerStatus"
                    class="badge"></span></small><br>
                <small>Hora Inicio: <span id="viewTallerHoraInicio"></span> | Duración: <span id="viewTallerDuracionEstimada"></span></small><br>
                <small>Ponente: <span id="viewTallerPonente"></span> | Ubicación: <span id="viewTallerUbicacion"></span></small>
              </p>
              <hr>
              <div class="row">
                <div class="col-md-12" id="viewTallerImagenPortadaContainer" style="text-align:center;">
                  <p class="fw-bold">Imagen Portada:</p>
                  <img id="viewTallerImagenPortada" src="#" alt="Imagen de Portada" class="img-fluid rounded"
                    style="max-height: 250px;">
                </div>
              </div>
              <div id="viewTallerVideoPromocionalContainer" class="mt-3">
                <p class="fw-bold">Video Promocional:</p>
                <a id="viewTallerVideoPromocionalLink" href="#" target="_blank">Ver video</a>
                <div id="viewTallerVideoPromocionalEmbed" class="mt-2 ratio ratio-16x9" style="display:none;">
                  <iframe id="viewTallerVideoPromocionalIframe" src="" title="Video Promocional Taller"
                    allowfullscreen></iframe>
                </div>
              </div>
              <hr>
              <h5>Descripción Corta:</h5>
              <p id="viewTallerDescripcionCorta"></p>
              <hr>
              <h5>Descripción Larga/Detallada:</h5>
              <div id="viewTallerDescripcionLarga" style="max-height: 300px; overflow-y: auto; white-space: pre-wrap;">
                <!-- La descripción del taller se insertará aquí -->
              </div>
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
  // Datos de ejemplo para categorías de TALLERES
  let sampleCategoriasTalleres = [
    { id_cat_taller: "methodology", nombre: "Metodología", descripcion: "Talleres sobre métodos y procesos." },
    { id_cat_taller: "pitching", nombre: "Pitching", descripcion: "Talleres para mejorar presentaciones y discursos." },
    { id_cat_taller: "softskills", nombre: "Habilidades Blandas", descripcion: "Desarrollo de habilidades interpersonales." }
  ];

  // Datos de ejemplo para TALLERES
  let sampleTalleres = [
    { id: 1, titulo: "Taller Intensivo de Design Thinking", descripcion_corta: "Resuelve problemas creativamente.", descripcion_larga: "Un taller práctico para aplicar las 5 fases del Design Thinking a un reto real.", fecha: "2025-04-20", hora_inicio:"09:00", duracion_estimada: "4 horas", ponente: "Dra. Innova", ubicacion: "Aula Magna / Online", imagen_portada: "assets/img/examples/example4.jpeg", video_promocional: "", categoria: "methodology", estado: 1, creado_en: "2024-07-01", actualizado_en: "2024-07-15" },
    { id: 2, titulo: "Lean Startup para Emprendedores", descripcion_corta: "Valida tu idea de negocio rápidamente.", descripcion_larga: "Aprende a construir MVPs, medir y pivotar para minimizar riesgos en tu startup.", fecha: "2025-05-04", hora_inicio:"14:00", duracion_estimada: "3 horas", ponente: "Ing. Ágil", ubicacion: "Zoom (Enlace se enviará)", imagen_portada: "assets/img/examples/example5.jpeg", video_promocional: "https://www.youtube.com/embed/sNd6vR_8Y3g", categoria: "methodology", estado: 1, creado_en: "2024-06-15", actualizado_en: "2024-07-10" },
    { id: 3, titulo: "El Arte del Pitch Perfecto", descripcion_corta: "Comunica tu idea con impacto.", descripcion_larga: "Desarrolla un pitch elevator efectivo y aprende técnicas para captar la atención de inversores.", fecha: "2025-05-18", hora_inicio:"10:00", duracion_estimada: "2.5 horas", ponente: "Lic. Impacto", ubicacion: "Sala de Conferencias B", imagen_portada: "assets/img/examples/example6.jpeg", video_promocional: "", categoria: "pitching", estado: 0, creado_en: "2024-07-20", actualizado_en: "2024-07-20" },
  ];

  const tallerModalElement = document.getElementById('tallerModal');
  const tallerModal = tallerModalElement ? new bootstrap.Modal(tallerModalElement) : null;
  
  const viewTallerModalElement = document.getElementById('viewTallerModal');
  const viewTallerModal = viewTallerModalElement ? new bootstrap.Modal(viewTallerModalElement) : null;


  function renderCategoriasSelectTalleres(selectId, placeholder = "Seleccionar categoría...") {
      const selectElement = document.getElementById(selectId);
      if (!selectElement) {
          console.warn(`Select element with ID ${selectId} not found for workshop categories.`);
          return;
      }
      selectElement.innerHTML = `<option value="">${placeholder}</option>`;
      sampleCategoriasTalleres.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.id_cat_taller; // Usar el ID específico de categoría de taller
        option.textContent = cat.nombre;
        selectElement.appendChild(option);
      });
  }

  function renderTalleresTable(talleresToShow = sampleTalleres) {
    const tableBody = document.getElementById('talleresTableBody');
    if (!tableBody) {
        console.warn("Table body 'talleresTableBody' not found.");
        return;
    }
    tableBody.innerHTML = ''; // Limpiar tabla
    
    talleresToShow.forEach(taller => {
      const row = tableBody.insertRow();
      row.id = `row-taller-${taller.id}`;
      row.insertCell().textContent = taller.id;
      row.insertCell().textContent = taller.titulo.substring(0, 40) + (taller.titulo.length > 40 ? '...' : '');
      
      const categoria = sampleCategoriasTalleres.find(cat => cat.id_cat_taller === taller.categoria);
      row.insertCell().textContent = categoria ? categoria.nombre : 'N/A';
      
      row.insertCell().textContent = taller.fecha ? new Date(taller.fecha + 'T00:00:00').toLocaleDateString() : 'N/A';

      const estadoCell = row.insertCell();
      const estadoBadge = document.createElement('span');
      estadoBadge.classList.add('badge');
      if (taller.estado == 1) {
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
              <button type="button" data-bs-toggle="tooltip" title="Editar Taller" class="btn btn-link btn-primary btn-lg" onclick="prepararModalEditarTaller(${taller.id})">
                  <i class="fa fa-edit"></i>
              </button>
              <button type="button" data-bs-toggle="tooltip" title="Eliminar Taller" class="btn btn-link btn-danger" onclick="confirmarEliminarTaller(${taller.id})">
                  <i class="fa fa-times"></i>
              </button>
              <button type="button" data-bs-toggle="tooltip" title="Ver Taller" class="btn btn-link btn-info" onclick="prepararModalVerTaller(${taller.id})">
                  <i class="fa fa-eye"></i>
              </button>
          </div>`;
    });
    // Re-initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  }

  function filtrarTalleresCrud() {
    const filtroTituloVal = document.getElementById('filtroTallerTituloCrud').value.toLowerCase();
    const filtroCategoriaVal = document.getElementById('filtroTallerCategoriaCrud').value;
    const filtroEstadoVal = document.getElementById('filtroTallerEstadoCrud').value;

    const talleresFiltrados = sampleTalleres.filter(taller => {
      const tituloMatch = taller.titulo.toLowerCase().includes(filtroTituloVal);
      const categoriaMatch = filtroCategoriaVal ? taller.categoria === filtroCategoriaVal : true;
      const estadoMatch = filtroEstadoVal ? taller.estado == filtroEstadoVal : true;
      return tituloMatch && categoriaMatch && estadoMatch;
    });
    renderTalleresTable(talleresFiltrados);
  }


  function prepararModalCrearTaller() {
    if (!tallerModal) return;
    document.getElementById('tallerForm').reset();
    renderCategoriasSelectTalleres('tallerCategoria', 'Seleccionar categoría...');
    document.getElementById('tallerId').value = '';
    document.getElementById('tallerModalLabel').textContent = 'Nuevo Taller';
    document.getElementById('guardarTallerButton').textContent = 'Crear Taller';
    document.getElementById('guardarTallerButton').classList.remove('btn-warning');
    document.getElementById('guardarTallerButton').classList.add('btn-success');
    
    const imgPreview = document.getElementById('currentTallerImagenPortadaPreview');
    if(imgPreview) {
        imgPreview.style.display = 'none';
        imgPreview.src = '#';
    }
    tallerModal.show();
  }

  function prepararModalEditarTaller(tallerId) {
    if (!tallerModal) return;
    const taller = sampleTalleres.find(t => t.id === tallerId);
    if (!taller) return;

    document.getElementById('tallerForm').reset();
    renderCategoriasSelectTalleres('tallerCategoria', 'Seleccionar categoría...');
    document.getElementById('tallerId').value = taller.id;
    document.getElementById('tallerModalLabel').textContent = 'Editar Taller';
    document.getElementById('guardarTallerButton').textContent = 'Actualizar Taller';
    document.getElementById('guardarTallerButton').classList.remove('btn-success');
    document.getElementById('guardarTallerButton').classList.add('btn-warning');

    document.getElementById('tallerTitulo').value = taller.titulo;
    document.getElementById('tallerDescripcionCorta').value = taller.descripcion_corta;
    document.getElementById('tallerDescripcionLarga').value = taller.descripcion_larga || '';
    document.getElementById('tallerCategoria').value = taller.categoria || '';
    document.getElementById('tallerFecha').value = taller.fecha || '';
    document.getElementById('tallerHoraInicio').value = taller.hora_inicio || '';
    document.getElementById('tallerDuracionEstimada').value = taller.duracion_estimada || '';
    document.getElementById('tallerPonente').value = taller.ponente || '';
    document.getElementById('tallerUbicacion').value = taller.ubicacion || '';
    document.getElementById('tallerVideoPromocional').value = taller.video_promocional || '';
    document.getElementById('tallerEstado').value = taller.estado;

    const imgPreview = document.getElementById('currentTallerImagenPortadaPreview');
    if (taller.imagen_portada && imgPreview) {
      imgPreview.src = taller.imagen_portada;
      imgPreview.style.display = 'block';
    } else if (imgPreview) {
      imgPreview.style.display = 'none';
      imgPreview.src = '#';
    }
    tallerModal.show();
  }

  function prepararModalVerTaller(tallerId) {
    if (!viewTallerModal) return;
    const taller = sampleTalleres.find(t => t.id === tallerId);
    if (!taller) return;

    const categoriaObj = sampleCategoriasTalleres.find(cat => cat.id_cat_taller === taller.categoria);
    document.getElementById('viewTallerCategoria').textContent = categoriaObj ? categoriaObj.nombre : 'N/A';

    document.getElementById('viewTallerModalLabel').textContent = `Detalle: ${taller.titulo.substring(0, 30)}...`;
    document.getElementById('viewTallerTitulo').textContent = taller.titulo;
    document.getElementById('viewTallerFecha').textContent = taller.fecha ? new Date(taller.fecha + 'T00:00:00').toLocaleDateString() : 'N/A';
    document.getElementById('viewTallerHoraInicio').textContent = taller.hora_inicio || 'N/A';
    document.getElementById('viewTallerDuracionEstimada').textContent = taller.duracion_estimada || 'N/A';
    document.getElementById('viewTallerPonente').textContent = taller.ponente || 'N/A';
    document.getElementById('viewTallerUbicacion').textContent = taller.ubicacion || 'N/A';

    const statusBadge = document.getElementById('viewTallerStatus');
    statusBadge.className = 'badge '; 
    if (taller.estado == 1) {
      statusBadge.classList.add('bg-success');
      statusBadge.textContent = 'Activo';
    } else {
      statusBadge.classList.add('bg-danger');
      statusBadge.textContent = 'Inactivo';
    }
    
    const imgContainer = document.getElementById('viewTallerImagenPortadaContainer');
    const imgElement = document.getElementById('viewTallerImagenPortada');
    if (taller.imagen_portada && imgContainer && imgElement) {
      imgElement.src = taller.imagen_portada;
      imgContainer.style.display = 'block';
    } else if (imgContainer && imgElement) {
      imgElement.src = '#';
      imgContainer.style.display = 'none';
    }

    const videoContainer = document.getElementById('viewTallerVideoPromocionalContainer');
    const videoLink = document.getElementById('viewTallerVideoPromocionalLink');
    const videoEmbedDiv = document.getElementById('viewTallerVideoPromocionalEmbed');
    const videoIframe = document.getElementById('viewTallerVideoPromocionalIframe');

    if (taller.video_promocional && videoContainer && videoLink && videoEmbedDiv && videoIframe) {
      videoContainer.style.display = 'block';
      videoLink.href = taller.video_promocional;
      videoLink.textContent = taller.video_promocional;

      let embedUrl = '';
      if (taller.video_promocional.includes('youtube.com/watch?v=')) {
        embedUrl = taller.video_promocional.replace('watch?v=', 'embed/');
      } else if (taller.video_promocional.includes('youtu.be/')) {
        embedUrl = taller.video_promocional.replace('youtu.be/', 'youtube.com/embed/');
      } else if (taller.video_promocional.includes('youtube.com/embed/')) {
        embedUrl = taller.video_promocional;
      } else if (taller.video_promocional.includes('vimeo.com/')) {
        const videoId = taller.video_promocional.split('/').pop().split('?')[0];
        embedUrl = `https://player.vimeo.com/video/${videoId}`;
      }

      if (embedUrl) {
        videoIframe.src = embedUrl;
        videoEmbedDiv.style.display = 'block';
      } else {
        videoEmbedDiv.style.display = 'none';
        videoIframe.src = "";
      }
    } else if (videoContainer && videoIframe && videoEmbedDiv) {
      videoContainer.style.display = 'none';
      videoIframe.src = '';
      videoEmbedDiv.style.display = 'none';
    }

    document.getElementById('viewTallerDescripcionCorta').textContent = taller.descripcion_corta || 'N/A';
    document.getElementById('viewTallerDescripcionLarga').textContent = taller.descripcion_larga || 'No hay descripción detallada.';
    viewTallerModal.show();
  }

  function guardarTaller() {
    if (!tallerModal) return;
    const tallerId = document.getElementById('tallerId').value;
    const titulo = document.getElementById('tallerTitulo').value;
    const descripcion_corta = document.getElementById('tallerDescripcionCorta').value;
    const categoria_val = document.getElementById('tallerCategoria').value;
    const fecha_val = document.getElementById('tallerFecha').value;
    const estado_val = document.getElementById('tallerEstado').value;

    if (!titulo || !descripcion_corta || !categoria_val || !fecha_val || !estado_val) {
      showToast("Por favor, completa todos los campos obligatorios (*).", 'warning');
      return;
    }
    
    const estado = parseInt(estado_val);
    if (isNaN(estado)){
        showToast("Error en el valor de estado.", 'danger');
        return;
    }

    let tallerData = {
      titulo: titulo,
      descripcion_corta: descripcion_corta,
      descripcion_larga: document.getElementById('tallerDescripcionLarga').value,
      categoria: categoria_val, // El ID de categoría para talleres es string (e.g., 'methodology')
      fecha: fecha_val,
      hora_inicio: document.getElementById('tallerHoraInicio').value,
      duracion_estimada: document.getElementById('tallerDuracionEstimada').value,
      ponente: document.getElementById('tallerPonente').value,
      ubicacion: document.getElementById('tallerUbicacion').value,
      video_promocional: document.getElementById('tallerVideoPromocional').value,
      estado: estado
    };

    const imagenPortadaFile = document.getElementById('tallerImagenPortada').files[0];

    if (tallerId) { // Editando
      const idInt = parseInt(tallerId);
      const index = sampleTalleres.findIndex(t => t.id === idInt);
      if (index !== -1) {
        const tallerExistente = sampleTalleres[index];
        tallerData.id = idInt;
        tallerData.imagen_portada = imagenPortadaFile ? URL.createObjectURL(imagenPortadaFile) : tallerExistente.imagen_portada;
        tallerData.creado_en = tallerExistente.creado_en; // Mantener fecha creación original
        tallerData.actualizado_en = new Date().toISOString().slice(0, 10); // Fecha actual
        sampleTalleres[index] = tallerData;
        showToast('Taller actualizado con éxito', 'success');
      }
    } else { // Creando
      tallerData.id = sampleTalleres.length > 0 ? Math.max(...sampleTalleres.map(t => t.id)) + 1 : 1;
      tallerData.imagen_portada = imagenPortadaFile ? URL.createObjectURL(imagenPortadaFile) : null;
      const now = new Date().toISOString().slice(0, 10);
      tallerData.creado_en = now;
      tallerData.actualizado_en = now;
      sampleTalleres.push(tallerData);
      showToast('Taller creado con éxito', 'success');
    }

    console.log("Guardando taller (simulado):", tallerData);
    tallerModal.hide();
    renderTalleresTable();
    document.getElementById('tallerForm').reset();
  }

  function confirmarEliminarTaller(tallerId) {
    if (confirm(`¿Estás seguro de que quieres eliminar el taller ID ${tallerId}?`)) {
      console.log("Eliminando taller ID:", tallerId);
      sampleTalleres = sampleTalleres.filter(t => t.id !== tallerId);
      renderTalleresTable();
      showToast(`Taller ID ${tallerId} eliminado.`, 'danger');
    }
  }

  const tallerImagenPortadaInput = document.getElementById('tallerImagenPortada');
  if (tallerImagenPortadaInput) {
      tallerImagenPortadaInput.addEventListener('change', function (event) {
        const preview = document.getElementById('currentTallerImagenPortadaPreview');
        if (!preview) return;
        if (event.target.files && event.target.files[0]) {
          preview.src = URL.createObjectURL(event.target.files[0]);
          preview.style.display = 'block';
        } else {
          preview.style.display = 'none';
          preview.src = '#';
        }
      });
  }


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
        toastContainer.style.zIndex = '1090'; // Asegurar que esté sobre otros elementos Bootstrap
        document.body.appendChild(toastContainer);
    }

    const toastElement = document.createElement('div');
    // Usar clases de Bootstrap para alertas que funcionan como toasts
    toastElement.className = `alert alert-${type} alert-dismissible fade show`;
    toastElement.role = 'alert';
    toastElement.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    toastContainer.appendChild(toastElement);

    // Crear una instancia de Bootstrap Alert para manejar el cierre
    const bsAlert = new bootstrap.Alert(toastElement);
    setTimeout(() => {
        bsAlert.close();
    }, 3000); // El toast se cierra después de 3 segundos
  }


  document.addEventListener('DOMContentLoaded', () => {
    // Renderizar selects de categorías para filtros y para el modal de creación/edición
    renderCategoriasSelectTalleres('filtroTallerCategoriaCrud', 'Categoría...');
    renderCategoriasSelectTalleres('tallerCategoria', 'Seleccionar categoría...');
    
    // Renderizar la tabla de talleres inicial
    renderTalleresTable();

    // Si hay otros inicializadores específicos para talleres, van aquí
  });

</script>