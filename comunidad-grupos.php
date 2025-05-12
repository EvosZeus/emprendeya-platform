<div class="container">
  <div class="page-inner">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Listado de Grupos de Interés</h4>
              <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                data-bs-target="#createGroupModal">
                <i class="fa fa-plus"></i>
                Crear Nuevo Grupo
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="gruposTable" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre del Grupo</th>
                    <th>Descripción Corta</th>
                    <th>Miembros</th>
                    <th>Temas Principales</th>
                    <th>Visibilidad</th>
                    <th style="width: 15%">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Innovadores en Marketing Digital</td>
                    <td>Espacio para discutir estrategias y tendencias...</td>
                    <td>150</td>
                    <td>SEO, SEM, Redes Sociales</td>
                    <td><span class="badge bg-success">Público</span></td>
                    <td>
                      <div class="form-button-action">
                        <button type="button" data-bs-toggle="tooltip" title="Editar Grupo"
                          class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                          data-bs-target="#editGroupModal" onclick="loadGroupData(1)">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" data-bs-toggle="tooltip" title="Eliminar Grupo"
                          class="btn btn-link btn-danger" onclick="confirmDeleteGroup(1)">
                          <i class="fa fa-times"></i>
                        </button>
                        <a href="#!" data-bs-toggle="tooltip" title="Ver Miembros" class="btn btn-link btn-info">
                          <i class="fa fa-users"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Desarrollo Sostenible para Startups</td>
                    <td>Compartir ideas y proyectos de impacto social y ambiental.</td>
                    <td>85</td>
                    <td>Ecología, Impacto Social, Economía Circular</td>
                    <td><span class="badge bg-warning text-dark">Privado</span></td>
                    <td>
                      <div class="form-button-action">
                        <button type="button" data-bs-toggle="tooltip" title="Editar Grupo"
                          class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                          data-bs-target="#editGroupModal" onclick="loadGroupData(2)">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" data-bs-toggle="tooltip" title="Eliminar Grupo"
                          class="btn btn-link btn-danger" onclick="confirmDeleteGroup(2)">
                          <i class="fa fa-times"></i>
                        </button>
                        <a href="#!" data-bs-toggle="tooltip" title="Ver Miembros" class="btn btn-link btn-info">
                          <i class="fa fa-users"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Finanzas para Emprendedores</td>
                    <td>Consejos, recursos y networking sobre financiación.</td>
                    <td>210</td>
                    <td>Inversión Ángel, Venture Capital, Crowdfunding</td>
                    <td><span class="badge bg-success">Público</span></td>
                    <td>
                      <div class="form-button-action">
                        <button type="button" data-bs-toggle="tooltip" title="Editar Grupo"
                          class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                          data-bs-target="#editGroupModal" onclick="loadGroupData(3)">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" data-bs-toggle="tooltip" title="Eliminar Grupo"
                          class="btn btn-link btn-danger" onclick="confirmDeleteGroup(3)">
                          <i class="fa fa-times"></i>
                        </button>
                        <a href="#!" data-bs-toggle="tooltip" title="Ver Miembros" class="btn btn-link btn-info">
                          <i class="fa fa-users"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <!-- Más filas de ejemplo -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Crear Grupo -->
<div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="createGroupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createGroupModalLabel">Crear Nuevo Grupo de Interés</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="createGroupForm">
          <div class="mb-3">
            <label for="createGroupName" class="form-label">Nombre del Grupo</label>
            <input type="text" class="form-control" id="createGroupName" required>
          </div>
          <div class="mb-3">
            <label for="createGroupDescription" class="form-label">Descripción Completa</label>
            <textarea class="form-control" id="createGroupDescription" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="createGroupShortDescription" class="form-label">Descripción Corta (para listado)</label>
            <input type="text" class="form-control" id="createGroupShortDescription" maxlength="100" required>
          </div>
          <div class="mb-3">
            <label for="createGroupTopics" class="form-label">Temas Principales (separados por coma)</label>
            <input type="text" class="form-control" id="createGroupTopics"
              placeholder="Ej: Marketing, Finanzas, Tecnología">
          </div>
          <div class="mb-3">
            <label class="form-label">Visibilidad</label>
            <div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="createGroupVisibility" id="createPublic"
                  value="public" checked>
                <label class="form-check-label" for="createPublic">Público</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="createGroupVisibility" id="createPrivate"
                  value="private">
                <label class="form-check-label" for="createPrivate">Privado</label>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="createGroupCoverImage" class="form-label">Imagen de Portada (Opcional)</label>
            <input class="form-control" type="file" id="createGroupCoverImage">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="saveNewGroup()">Guardar Grupo</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Grupo -->
<div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editGroupModalLabel">Editar Grupo de Interés</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editGroupForm">
          <input type="hidden" id="editGroupId">
          <div class="mb-3">
            <label for="editGroupName" class="form-label">Nombre del Grupo</label>
            <input type="text" class="form-control" id="editGroupName" required>
          </div>
          <div class="mb-3">
            <label for="editGroupDescription" class="form-label">Descripción Completa</label>
            <textarea class="form-control" id="editGroupDescription" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="editGroupShortDescription" class="form-label">Descripción Corta (para listado)</label>
            <input type="text" class="form-control" id="editGroupShortDescription" maxlength="100" required>
          </div>
          <div class="mb-3">
            <label for="editGroupTopics" class="form-label">Temas Principales (separados por coma)</label>
            <input type="text" class="form-control" id="editGroupTopics"
              placeholder="Ej: Marketing, Finanzas, Tecnología">
          </div>
          <div class="mb-3">
            <label class="form-label">Visibilidad</label>
            <div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="editGroupVisibility" id="editPublic" value="public">
                <label class="form-check-label" for="editPublic">Público</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="editGroupVisibility" id="editPrivate"
                  value="private">
                <label class="form-check-label" for="editPrivate">Privado</label>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="editGroupCoverImage" class="form-label">Imagen de Portada Actual</label>
            <img id="currentCoverImage" src="#" alt="Imagen actual" class="img-thumbnail mb-2"
              style="max-height: 100px; display:none;">
            <input class="form-control" type="file" id="editGroupCoverImage">
            <small class="form-text text-muted">Selecciona una nueva imagen para cambiarla.</small>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="updateGroup()">Actualizar Grupo</button>
      </div>
    </div>
  </div>
</div>



</div>


<script>
  $(document).ready(function () {
    // Inicializar Datatables
    // $("#gruposTable").DataTable({}); // Descomentar si quieres paginación/búsqueda avanzada por defecto

    // Inicializar tooltips (si los usas)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });

  // --- Funciones CRUD (simuladas) ---
  function saveNewGroup() {
    // Aquí iría la lógica para recolectar datos del form #createGroupForm
    // y enviarlos al backend mediante AJAX.
    const groupName = $('#createGroupName').val();
    if (!groupName) {
      alert('El nombre del grupo es obligatorio.');
      return;
    }
    console.log("Guardando nuevo grupo:", {
      name: groupName,
      description: $('#createGroupDescription').val(),
      short_description: $('#createGroupShortDescription').val(),
      topics: $('#createGroupTopics').val(),
      visibility: $('input[name="createGroupVisibility"]:checked').val(),
      // coverImage: ... (manejo de archivo)
    });
    // Cerrar modal y mostrar notificación (simulado)
    $('#createGroupModal').modal('hide');
    swal("¡Éxito!", "Nuevo grupo creado correctamente.", "success");
    // Aquí deberías recargar la tabla o añadir la nueva fila dinámicamente.
  }

  function loadGroupData(groupId) {
    // Simulación: en una app real, harías una petición AJAX para obtener los datos del grupo.
    console.log("Cargando datos para editar grupo ID:", groupId);
    let groupData;
    if (groupId === 1) {
      groupData = {
        id: 1,
        name: "Innovadores en Marketing Digital",
        description: "Espacio para discutir estrategias y tendencias del marketing digital moderno, enfocado en emprendedores y startups que buscan crecer.",
        short_description: "Estrategias y tendencias de marketing digital.",
        topics: "SEO, SEM, Redes Sociales, Content Marketing",
        visibility: "public",
        coverImage: "assets/img/examples/group-cover1.jpg" // Ejemplo de imagen
      };
    } else if (groupId === 2) {
      groupData = {
        id: 2,
        name: "Desarrollo Sostenible para Startups",
        description: "Un foro para compartir ideas, proyectos y mejores prácticas en el ámbito del desarrollo sostenible aplicado a nuevas empresas. Buscamos impacto positivo.",
        short_description: "Ideas y proyectos de impacto social y ambiental.",
        topics: "Ecología, Impacto Social, Economía Circular, ODS",
        visibility: "private",
        coverImage: null
      };
    } else { // groupId === 3
      groupData = {
        id: 3,
        name: "Finanzas para Emprendedores",
        description: "Todo lo que necesitas saber sobre financiación, inversión, contabilidad y gestión financiera para tu emprendimiento. Comparte experiencias y aprende.",
        short_description: "Consejos, recursos y networking sobre financiación.",
        topics: "Inversión Ángel, Venture Capital, Crowdfunding, Bootstrapping",
        visibility: "public",
        coverImage: "assets/img/examples/group-cover2.jpg" // Ejemplo de imagen
      };
    }

    $('#editGroupId').val(groupData.id);
    $('#editGroupName').val(groupData.name);
    $('#editGroupDescription').val(groupData.description);
    $('#editGroupShortDescription').val(groupData.short_description);
    $('#editGroupTopics').val(groupData.topics);
    $(`input[name="editGroupVisibility"][value="${groupData.visibility}"]`).prop('checked', true);

    if (groupData.coverImage) {
      $('#currentCoverImage').attr('src', groupData.coverImage).show();
    } else {
      $('#currentCoverImage').hide();
    }

    $('#editGroupModal').modal('show');
  }

  function updateGroup() {
    // Lógica para recolectar datos del form #editGroupForm y enviarlos al backend.
    const groupId = $('#editGroupId').val();
    const groupName = $('#editGroupName').val();
    if (!groupName) {
      alert('El nombre del grupo es obligatorio.');
      return;
    }
    console.log("Actualizando grupo ID:", groupId, {
      name: groupName,
      description: $('#editGroupDescription').val(),
      short_description: $('#editGroupShortDescription').val(),
      topics: $('#editGroupTopics').val(),
      visibility: $('input[name="editGroupVisibility"]:checked').val(),
      // coverImage: ... (manejo de archivo si se cambia)
    });
    $('#editGroupModal').modal('hide');
    swal("¡Actualizado!", "El grupo ha sido actualizado correctamente.", "success");
    // Aquí deberías recargar la tabla o actualizar la fila dinámicamente.
  }

  function confirmDeleteGroup(groupId) {
    swal({
      title: "¿Estás seguro?",
      text: "¡Una vez eliminado, no podrás recuperar este grupo!",
      icon: "warning",
      buttons: {
        cancel: {
          text: "Cancelar",
          value: null,
          visible: true,
          className: "btn btn-secondary",
          closeModal: true,
        },
        confirm: {
          text: "Sí, eliminar",
          value: true,
          visible: true,
          className: "btn btn-danger",
          closeModal: true,
        },
      },
    }).then((willDelete) => {
      if (willDelete) {
        // Aquí iría la lógica para eliminar el grupo vía AJAX
        console.log("Eliminando grupo ID:", groupId);
        swal("¡Eliminado!", "El grupo ha sido eliminado.", "success");
        // Aquí deberías recargar la tabla o eliminar la fila dinámicamente.
      } else {
        swal("Cancelado", "El grupo está a salvo.", "info");
      }
    });
  }
</script>