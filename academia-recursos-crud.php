<div class="container">
  <div class="row">
    <div class="card card-space">

      <!-- Crud de Recursos -->
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Gestión de Recursos</h3>
        <div>
          <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#recursoModal"
            onclick="prepararModalCrearRecurso()">
            <i class="fa fa-plus"></i>
            Nuevo Recurso
          </button>
          <a href="#" class="menu-link" data-page="academia-recursos">
            <span class="btn btn-primary">Regresar a Recursos</span>
          </a>
        </div>
      </div>
      <div class="card-body">
        <!-- Filtros -->
        <div class="row mb-3">
          <div class="col-md-4">
            <input type="text" id="filtroRecursoTitulo" class="form-control" placeholder="Buscar por título o descripción...">
          </div>
          <div class="col-md-3">
            <select id="filtroRecursoTipo" class="form-select">
              <option selected value="">Tipo de Recurso...</option>
              <option value="pdf">PDF</option>
              <option value="word">Word</option>
              <option value="excel">Excel</option>
              <option value="powerpoint">PowerPoint</option>
              <option value="zip">ZIP</option>
              <option value="imagen">Imagen</option>
              <option value="video">Video (enlace)</option>
              <option value="otro">Otro</option>
            </select>
          </div>
          <div class="col-md-3">
            <select id="filtroRecursoEstado" class="form-select">
              <option selected value="">Estado...</option>
              <option value="1">Publicado</option>
              <option value="0">Borrador</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary w-100" onclick="filtrarRecursos()">Filtrar</button>
          </div>
        </div>

        <div class="table-responsive">
          <table id="recursosTable" class="display table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Fecha Subida</th>
                <th style="width: 15%">Acciones</th>
              </tr>
            </thead>
            <tbody id="recursosTableBody">
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

      <!-- Modal para Crear/Editar Recurso -->
      <div class="modal fade" id="recursoModal" tabindex="-1" aria-labelledby="recursoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Modal más pequeño que el de cursos -->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="recursoModalLabel">Nuevo Recurso</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="recursoForm">
                <input type="hidden" id="recursoId" name="recursoId">
                <div class="row">
                  <div class="col-md-7">
                    <div class="mb-3">
                      <label for="recursoTitulo" class="form-label">Título del Recurso <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="recursoTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                      <label for="recursoDescripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                      <textarea class="form-control" id="recursoDescripcion" name="descripcion" rows="5" placeholder="Descripción breve del recurso..." required></textarea>
                    </div>
                     <div class="mb-3">
                        <label for="recursoPalabrasClave" class="form-label">Palabras Clave (separadas por coma)</label>
                        <input type="text" class="form-control" id="recursoPalabrasClave" name="palabras_clave" placeholder="Ej: plantilla, finanzas, informe">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="card">
                      <div class="card-header">
                        <h6 class="mb-0">Detalles y Archivo</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                            <label for="recursoTipo" class="form-label">Tipo de Recurso <span class="text-danger">*</span></label>
                            <select class="form-select" id="recursoTipo" name="tipo" required>
                                <option value="">Seleccionar tipo...</option>
                                <option value="pdf">PDF</option>
                                <option value="word">Word (doc, docx)</option>
                                <option value="excel">Excel (xls, xlsx)</option>
                                <option value="powerpoint">PowerPoint (ppt, pptx)</option>
                                <option value="zip">ZIP</option>
                                <option value="imagen">Imagen (jpg, png, gif)</option>
                                <option value="video">Video (Enlace Externo)</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                          <label for="recursoEstado" class="form-label">Estado <span class="text-danger">*</span></label>
                          <select class="form-select" id="recursoEstado" name="estado" required>
                            <option value="1">Publicado</option>
                            <option value="0">Borrador</option>
                          </select>
                        </div>
                        <div class="mb-3" id="recursoArchivoContainer">
                          <label for="recursoArchivo" class="form-label">Archivo del Recurso <span id="archivoObligatorio" class="text-danger">*</span></label>
                          <input class="form-control" type="file" id="recursoArchivo" name="archivo_recurso">
                          <small id="currentArchivoNombre" class="d-block mt-1"></small>
                        </div>
                        <div class="mb-3" id="recursoEnlaceVideoContainer" style="display:none;">
                            <label for="recursoEnlaceVideo" class="form-label">Enlace del Video (YouTube, Vimeo, etc.) <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" id="recursoEnlaceVideo" name="enlace_video" placeholder="https://ejemplo.com/video">
                        </div>
                         <div class="mb-3">
                          <label for="recursoMiniatura" class="form-label">Miniatura (Opcional)</label>
                          <input class="form-control" type="file" id="recursoMiniatura" name="miniatura" accept="image/*">
                          <img id="currentMiniaturaPreview" src="#" alt="Miniatura actual" class="img-thumbnail mt-2" style="max-height: 80px; display:none;">
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success w-100 mt-3" id="guardarRecursoButton" onclick="guardarRecurso()">Guardar Recurso</button>
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

      <!-- Modal para Ver Recurso -->
      <div class="modal fade" id="viewRecursoModal" tabindex="-1" aria-labelledby="viewRecursoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewRecursoModalLabel">Detalle del Recurso</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h3 id="viewRecursoTitulo" class="fw-bold"></h3>
              <p class="text-muted">
                <small>Tipo: <span id="viewRecursoTipo" class="fw-normal"></span> | Estado: <span id="viewRecursoStatus" class="badge"></span></small><br>
                <small>Subido: <span id="viewRecursoFechaSubida"></span> | Modificado: <span id="viewRecursoFechaModificacion"></span></small>
              </p>
              <hr>
              <div class="row">
                <div class="col-md-4" id="viewRecursoMiniaturaContainer" style="text-align:center;">
                  <p class="fw-bold">Miniatura:</p>
                  <img id="viewRecursoMiniatura" src="#" alt="Miniatura del Recurso" class="img-fluid rounded mb-2" style="max-height: 150px;">
                </div>
                <div class="col-md-8">
                  <h5>Descripción:</h5>
                  <div id="viewRecursoDescripcion" style="max-height: 150px; overflow-y: auto; white-space: pre-wrap; margin-bottom: 1rem;"></div>
                  
                  <p id="viewRecursoArchivoInfo">
                    <strong class="text-primary">Archivo:</strong> <span id="viewRecursoArchivoNombre"></span>
                    <a href="#" id="viewRecursoDescargarLink" class="btn btn-sm btn-outline-success ms-2" target="_blank" download><i class="fa fa-download"></i> Descargar</a>
                  </p>
                  <div id="viewRecursoVideoEmbedContainer" class="mt-2 ratio ratio-16x9" style="display:none;">
                     <iframe id="viewRecursoVideoIframe" src="" title="Video del Recurso" allowfullscreen></iframe>
                  </div>

                  <p><strong class="text-primary">Palabras Clave:</strong> <span id="viewRecursoPalabrasClave"></span></p>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- FIN Crud de Recursos -->
    </div>
  </div>
</div>
<script>
  // Datos de ejemplo para recursos
  let sampleRecursos = [
    { id: 1, titulo: "Plantilla Avanzada de Plan de Negocio", descripcion: "Descarga nuestra plantilla editable en Word para crear un plan de negocio profesional y detallado.", tipo: "word", estado: 1, archivo_nombre: "plantilla_plan_negocio_v2.docx", archivo_url_simulada: "assets/files/plantilla_plan_negocio_v2.docx", miniatura_url_simulada: "assets/img/examples/recurso-word.png", palabras_clave: "plan de negocio, word, plantilla, empresa", fecha_subida: "2024-07-10 10:00:00", fecha_modificacion: "2024-07-15 11:00:00" },
    { id: 2, titulo: "Guía Completa de SEO para Principiantes (PDF)", descripcion: "Aprende los fundamentos del SEO y cómo optimizar tu sitio web para motores de búsqueda. Incluye checklist.", tipo: "pdf", estado: 1, archivo_nombre: "guia_seo_principiantes.pdf", archivo_url_simulada: "assets/files/guia_seo_principiantes.pdf", miniatura_url_simulada: "assets/img/examples/recurso-pdf.png", palabras_clave: "seo, marketing digital, guia, pdf", fecha_subida: "2024-06-20 14:30:00", fecha_modificacion: "2024-06-20 14:30:00" },
    { id: 3, titulo: "Tutorial: Cómo usar Canva para Redes Sociales", descripcion: "Videotutorial práctico mostrando cómo crear gráficos impactantes para redes sociales usando Canva.", tipo: "video", estado: 0, archivo_nombre: null, archivo_url_simulada: "https://www.youtube.com/embed/LGhPjdk_kXg", miniatura_url_simulada: "assets/img/examples/recurso-video.png", palabras_clave: "canva, diseño, tutorial, video, redes sociales", fecha_subida: "2024-07-18 09:00:00", fecha_modificacion: "2024-07-18 09:00:00" },
    { id: 4, titulo: "Set de Iconos Flat para Proyectos Web (ZIP)", descripcion: "Colección de 100 iconos vectoriales en formato SVG y PNG, listos para usar en tus proyectos.", tipo: "zip", estado: 1, archivo_nombre: "iconos_flat_proyectos.zip", archivo_url_simulada: "assets/files/iconos_flat_proyectos.zip", miniatura_url_simulada: null, palabras_clave: "iconos, diseño web, svg, png, zip", fecha_subida: "2024-05-05 16:00:00", fecha_modificacion: "2024-05-10 10:20:00" },
  ];

  const recursoModal = new bootstrap.Modal(document.getElementById('recursoModal'));
  const viewRecursoModal = new bootstrap.Modal(document.getElementById('viewRecursoModal'));
  const tipoRecursoSelectModal = document.getElementById('recursoTipo');
  const archivoContainerModal = document.getElementById('recursoArchivoContainer');
  const videoEnlaceContainerModal = document.getElementById('recursoEnlaceVideoContainer');
  const archivoObligatorioSpan = document.getElementById('archivoObligatorio');

  function getIconoPorTipo(tipo) {
    switch (tipo) {
        case 'pdf': return 'fa-file-pdf text-danger';
        case 'word': return 'fa-file-word text-primary';
        case 'excel': return 'fa-file-excel text-success';
        case 'powerpoint': return 'fa-file-powerpoint text-warning';
        case 'zip': return 'fa-file-archive text-info';
        case 'imagen': return 'fa-file-image text-purple'; // Necesitarás una clase CSS para text-purple
        case 'video': return 'fa-file-video text-danger';
        default: return 'fa-file text-secondary';
    }
  }

  function renderRecursosTable(recursosToShow = sampleRecursos) {
    const tableBody = document.getElementById('recursosTableBody');
    tableBody.innerHTML = ''; // Limpiar tabla
    recursosToShow.forEach(recurso => {
      const row = tableBody.insertRow();
      row.id = `row-recurso-${recurso.id}`;
      row.insertCell().textContent = recurso.id;
      
      const titleCell = row.insertCell();
      const icono = getIconoPorTipo(recurso.tipo);
      titleCell.innerHTML = `<i class="fas ${icono} me-2"></i> ${recurso.titulo.substring(0, 40) + (recurso.titulo.length > 40 ? '...' : '')}`;
      
      row.insertCell().textContent = recurso.tipo.charAt(0).toUpperCase() + recurso.tipo.slice(1); // Capitalize

      const estadoCell = row.insertCell();
      const estadoBadge = document.createElement('span');
      estadoBadge.classList.add('badge');
      if (recurso.estado == 1) {
        estadoBadge.classList.add('bg-success');
        estadoBadge.textContent = 'Publicado';
      } else {
        estadoBadge.classList.add('bg-danger');
        estadoBadge.textContent = 'Borrador';
      }
      estadoCell.appendChild(estadoBadge);

      row.insertCell().textContent = recurso.fecha_subida ? new Date(recurso.fecha_subida).toLocaleDateString() : 'N/A';

      const actionsCell = row.insertCell();
      actionsCell.style.width = '15%';
      actionsCell.innerHTML = `
          <div class="form-button-action">
              <button type="button" data-bs-toggle="tooltip" title="Editar Recurso" class="btn btn-link btn-primary btn-lg" onclick="prepararModalEditarRecurso(${recurso.id})">
                  <i class="fa fa-edit"></i>
              </button>
              <button type="button" data-bs-toggle="tooltip" title="Eliminar Recurso" class="btn btn-link btn-danger" onclick="confirmarEliminarRecurso(${recurso.id})">
                  <i class="fa fa-times"></i>
              </button>
              <button type="button" data-bs-toggle="tooltip" title="Ver Recurso" class="btn btn-link btn-info" onclick="prepararModalVerRecurso(${recurso.id})">
                  <i class="fa fa-eye"></i>
              </button>
          </div>`;
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  }

  function filtrarRecursos() {
    const filtroTituloVal = document.getElementById('filtroRecursoTitulo').value.toLowerCase();
    const filtroTipoVal = document.getElementById('filtroRecursoTipo').value;
    const filtroEstadoVal = document.getElementById('filtroRecursoEstado').value;

    const recursosFiltrados = sampleRecursos.filter(recurso => {
      const tituloMatch = recurso.titulo.toLowerCase().includes(filtroTituloVal) || (recurso.descripcion && recurso.descripcion.toLowerCase().includes(filtroTituloVal));
      const tipoMatch = filtroTipoVal ? recurso.tipo === filtroTipoVal : true;
      const estadoMatch = filtroEstadoVal ? recurso.estado == filtroEstadoVal : true;
      return tituloMatch && tipoMatch && estadoMatch;
    });
    renderRecursosTable(recursosFiltrados);
  }
  
  function toggleArchivoEnlaceFields(tipoSeleccionado) {
      if (tipoSeleccionado === 'video') {
          archivoContainerModal.style.display = 'none';
          document.getElementById('recursoArchivo').value = null; // Limpiar campo de archivo si se selecciona video
          document.getElementById('currentArchivoNombre').textContent = '';
          videoEnlaceContainerModal.style.display = 'block';
          archivoObligatorioSpan.style.display = 'none'; // Enlace es obligatorio, no el archivo
      } else {
          archivoContainerModal.style.display = 'block';
          videoEnlaceContainerModal.style.display = 'none';
          document.getElementById('recursoEnlaceVideo').value = ''; // Limpiar campo de enlace si no es video
          archivoObligatorioSpan.style.display = 'inline';
      }
  }

  tipoRecursoSelectModal.addEventListener('change', function() {
      toggleArchivoEnlaceFields(this.value);
  });


  function prepararModalCrearRecurso() {
    document.getElementById('recursoForm').reset();
    document.getElementById('recursoId').value = '';
    document.getElementById('recursoModalLabel').textContent = 'Nuevo Recurso';
    document.getElementById('guardarRecursoButton').textContent = 'Crear Recurso';
    document.getElementById('guardarRecursoButton').classList.remove('btn-warning');
    document.getElementById('guardarRecursoButton').classList.add('btn-success');
    document.getElementById('currentMiniaturaPreview').style.display = 'none';
    document.getElementById('currentMiniaturaPreview').src = '#';
    document.getElementById('currentArchivoNombre').textContent = '';
    toggleArchivoEnlaceFields(''); // Resetear visibilidad de campos de archivo/enlace
    archivoObligatorioSpan.style.display = 'inline';
    recursoModal.show();
  }

  function prepararModalEditarRecurso(recursoId) {
    const recurso = sampleRecursos.find(r => r.id === recursoId);
    if (!recurso) return;

    document.getElementById('recursoForm').reset();
    document.getElementById('recursoId').value = recurso.id;
    document.getElementById('recursoModalLabel').textContent = 'Editar Recurso';
    document.getElementById('guardarRecursoButton').textContent = 'Actualizar Recurso';
    document.getElementById('guardarRecursoButton').classList.remove('btn-success');
    document.getElementById('guardarRecursoButton').classList.add('btn-warning');

    document.getElementById('recursoTitulo').value = recurso.titulo;
    document.getElementById('recursoDescripcion').value = recurso.descripcion;
    document.getElementById('recursoTipo').value = recurso.tipo;
    document.getElementById('recursoEstado').value = recurso.estado;
    document.getElementById('recursoPalabrasClave').value = recurso.palabras_clave || '';

    toggleArchivoEnlaceFields(recurso.tipo);

    if (recurso.tipo === 'video') {
        document.getElementById('recursoEnlaceVideo').value = recurso.archivo_url_simulada || '';
        document.getElementById('currentArchivoNombre').textContent = '';
        archivoObligatorioSpan.style.display = 'none'; // Para editar, el enlace ya existe o se reemplaza
    } else {
        document.getElementById('currentArchivoNombre').textContent = `Actual: ${recurso.archivo_nombre || 'Ninguno'}`;
        archivoObligatorioSpan.style.display = 'none'; // Para editar, el archivo no es obligatorio si ya existe uno
    }


    if (recurso.miniatura_url_simulada) {
      document.getElementById('currentMiniaturaPreview').src = recurso.miniatura_url_simulada;
      document.getElementById('currentMiniaturaPreview').style.display = 'block';
    } else {
      document.getElementById('currentMiniaturaPreview').style.display = 'none';
      document.getElementById('currentMiniaturaPreview').src = '#';
    }
    recursoModal.show();
  }

  function prepararModalVerRecurso(recursoId) {
    const recurso = sampleRecursos.find(r => r.id === recursoId);
    if (!recurso) return;

    document.getElementById('viewRecursoModalLabel').textContent = `Detalle: ${recurso.titulo.substring(0, 30)}...`;
    document.getElementById('viewRecursoTitulo').textContent = recurso.titulo;
    document.getElementById('viewRecursoTipo').textContent = recurso.tipo.charAt(0).toUpperCase() + recurso.tipo.slice(1);
    
    const statusBadge = document.getElementById('viewRecursoStatus');
    statusBadge.className = 'badge '; 
    if (recurso.estado == 1) {
      statusBadge.classList.add('bg-success');
      statusBadge.textContent = 'Publicado';
    } else {
      statusBadge.classList.add('bg-danger');
      statusBadge.textContent = 'Borrador';
    }

    document.getElementById('viewRecursoFechaSubida').textContent = recurso.fecha_subida ? new Date(recurso.fecha_subida).toLocaleString() : 'N/A';
    document.getElementById('viewRecursoFechaModificacion').textContent = recurso.fecha_modificacion ? new Date(recurso.fecha_modificacion).toLocaleString() : 'N/A';
    document.getElementById('viewRecursoDescripcion').textContent = recurso.descripcion || 'No hay descripción disponible.';
    document.getElementById('viewRecursoPalabrasClave').textContent = recurso.palabras_clave || 'N/A';

    const miniaturaContainer = document.getElementById('viewRecursoMiniaturaContainer');
    const miniaturaImg = document.getElementById('viewRecursoMiniatura');
    if (recurso.miniatura_url_simulada) {
      miniaturaImg.src = recurso.miniatura_url_simulada;
      miniaturaContainer.style.display = 'block';
    } else {
      miniaturaImg.src = '#';
      miniaturaContainer.style.display = 'none';
    }
    
    const archivoInfo = document.getElementById('viewRecursoArchivoInfo');
    const videoEmbed = document.getElementById('viewRecursoVideoEmbedContainer');
    const videoIframe = document.getElementById('viewRecursoVideoIframe');
    const descargarLink = document.getElementById('viewRecursoDescargarLink');
    
    if (recurso.tipo === 'video') {
        archivoInfo.style.display = 'none';
        videoEmbed.style.display = 'block';
        let embedUrl = '';
        if (recurso.archivo_url_simulada.includes('youtube.com/watch?v=')) {
            embedUrl = recurso.archivo_url_simulada.replace('watch?v=', 'embed/');
        } else if (recurso.archivo_url_simulada.includes('youtu.be/')) {
            embedUrl = recurso.archivo_url_simulada.replace('youtu.be/', 'youtube.com/embed/');
        } else if (recurso.archivo_url_simulada.includes('vimeo.com/')) {
            const videoId = recurso.archivo_url_simulada.split('/').pop().split('?')[0];
            embedUrl = `https://player.vimeo.com/video/${videoId}`;
        } else { // Asumir que es un enlace directo a un video o ya es un embed
            embedUrl = recurso.archivo_url_simulada;
        }
        videoIframe.src = embedUrl;

    } else {
        archivoInfo.style.display = 'block';
        videoEmbed.style.display = 'none';
        videoIframe.src = "";
        document.getElementById('viewRecursoArchivoNombre').textContent = recurso.archivo_nombre || 'No disponible';
        if(recurso.archivo_url_simulada && recurso.archivo_nombre) {
            descargarLink.href = recurso.archivo_url_simulada;
            descargarLink.download = recurso.archivo_nombre; // Sugerir nombre de archivo
            descargarLink.style.display = 'inline-block';
        } else {
            descargarLink.style.display = 'none';
        }
    }

    viewRecursoModal.show();
  }

  function guardarRecurso() {
    const recursoId = document.getElementById('recursoId').value;
    const titulo = document.getElementById('recursoTitulo').value;
    const descripcion = document.getElementById('recursoDescripcion').value;
    const tipo = document.getElementById('recursoTipo').value;
    const estadoVal = document.getElementById('recursoEstado').value;
    const archivoFile = document.getElementById('recursoArchivo').files[0];
    const miniaturaFile = document.getElementById('recursoMiniatura').files[0];
    const enlaceVideo = document.getElementById('recursoEnlaceVideo').value;

    if (!titulo || !descripcion || !tipo || !estadoVal) {
      alert("Por favor, completa todos los campos obligatorios (*).");
      return;
    }
    const estado = parseInt(estadoVal);

    // Validación específica para tipo video vs otros tipos de archivo
    if (tipo === 'video' && !enlaceVideo) {
        alert("Por favor, proporciona un enlace para el recurso de tipo Video.");
        return;
    }
    if (tipo !== 'video' && !archivoFile && !recursoId) { // Archivo obligatorio solo al crear, no al editar si ya existe uno
        alert("Por favor, selecciona un archivo para el recurso.");
        return;
    }


    let recursoData = {
      titulo: titulo,
      descripcion: descripcion,
      tipo: tipo,
      estado: estado,
      palabras_clave: document.getElementById('recursoPalabrasClave').value,
      // archivo_nombre, archivo_url_simulada, miniatura_url_simulada se manejarán abajo
    };

    const now = new Date().toISOString().slice(0, 19).replace('T', ' ');

    if (recursoId) { // Editando
      const idInt = parseInt(recursoId);
      const index = sampleRecursos.findIndex(r => r.id === idInt);
      if (index !== -1) {
        const existente = sampleRecursos[index];
        recursoData.id = idInt;
        recursoData.fecha_subida = existente.fecha_subida; // Mantener fecha de subida original
        recursoData.fecha_modificacion = now;

        if (tipo === 'video') {
            recursoData.archivo_nombre = null;
            recursoData.archivo_url_simulada = enlaceVideo;
        } else {
            recursoData.archivo_nombre = archivoFile ? archivoFile.name : existente.archivo_nombre;
            // Simulación de URL. En un caso real, subirías el archivo y obtendrías la URL del backend.
            recursoData.archivo_url_simulada = archivoFile ? `assets/files/simulado/${archivoFile.name}` : existente.archivo_url_simulada;
        }
        
        recursoData.miniatura_url_simulada = miniaturaFile ? URL.createObjectURL(miniaturaFile) : existente.miniatura_url_simulada;
        
        sampleRecursos[index] = recursoData;
        showToast('Recurso actualizado con éxito', 'success');
      }
    } else { // Creando
      recursoData.id = sampleRecursos.length > 0 ? Math.max(...sampleRecursos.map(r => r.id)) + 1 : 1;
      recursoData.fecha_subida = now;
      recursoData.fecha_modificacion = now;

      if (tipo === 'video') {
        recursoData.archivo_nombre = null;
        recursoData.archivo_url_simulada = enlaceVideo;
      } else {
        recursoData.archivo_nombre = archivoFile ? archivoFile.name : null;
        recursoData.archivo_url_simulada = archivoFile ? `assets/files/simulado/${archivoFile.name}` : null;
      }
      recursoData.miniatura_url_simulada = miniaturaFile ? URL.createObjectURL(miniaturaFile) : null;
      
      sampleRecursos.push(recursoData);
      showToast('Recurso creado con éxito', 'success');
    }

    console.log("Guardando recurso (simulado):", recursoData);
    recursoModal.hide();
    renderRecursosTable();
    document.getElementById('recursoForm').reset();
  }

  function confirmarEliminarRecurso(recursoId) {
    if (confirm(`¿Estás seguro de que quieres eliminar el recurso ID ${recursoId}?`)) {
      console.log("Eliminando recurso ID:", recursoId);
      sampleRecursos = sampleRecursos.filter(r => r.id !== recursoId);
      renderRecursosTable();
      showToast(`Recurso ID ${recursoId} eliminado.`, 'danger');
    }
  }

  document.getElementById('recursoMiniatura').addEventListener('change', function (event) {
    const preview = document.getElementById('currentMiniaturaPreview');
    if (event.target.files && event.target.files[0]) {
      preview.src = URL.createObjectURL(event.target.files[0]);
      preview.style.display = 'block';
    } else {
      preview.style.display = 'none';
      preview.src = '#';
    }
  });
  document.getElementById('recursoArchivo').addEventListener('change', function(event) {
      const currentArchivoNombre = document.getElementById('currentArchivoNombre');
      if (event.target.files && event.target.files[0]) {
          currentArchivoNombre.textContent = `Seleccionado: ${event.target.files[0].name}`;
      } else {
          // Si no hay id de recurso (creando) y se deselecciona, podría volver a 'Actual: Ninguno' o nada
          if (!document.getElementById('recursoId').value) {
            currentArchivoNombre.textContent = '';
          }
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
        toastContainer.style.zIndex = '1090'; // Bootstrap modal z-index is 1050-1070
        document.body.appendChild(toastContainer);
    }

    const toastElement = document.createElement('div');
    toastElement.className = `toast align-items-center text-white bg-${type === 'danger' ? 'danger' : (type === 'success' ? 'success' : 'primary')} border-0 fade show`;
    toastElement.role = 'alert';
    toastElement.ariaLive = 'assertive';
    toastElement.ariaAtomic = 'true';
    // data-bs-autohide="false" para controlar el cierre manualmente si se desea
    
    toastElement.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    toastContainer.appendChild(toastElement);

    const bsToast = new bootstrap.Toast(toastElement, { delay: 3000 });
    bsToast.show();
    
    // Limpiar el toast del DOM después de que se oculte para evitar acumulación
    toastElement.addEventListener('hidden.bs.toast', function () {
        toastElement.remove();
        if (toastContainer.childElementCount === 0) {
            // Opcional: remover el contenedor si está vacío
            // toastContainer.remove();
        }
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderRecursosTable();
     // Asegurar que al abrir el modal de "Crear", los campos de archivo/enlace estén correctamente visibles/ocultos
    document.getElementById('recursoModal').addEventListener('show.bs.modal', function (event) {
        const recursoId = document.getElementById('recursoId').value;
        if (!recursoId) { // Solo si es para crear (ID vacío)
            toggleArchivoEnlaceFields(document.getElementById('recursoTipo').value);
        }
    });
  });

</script>