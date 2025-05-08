<div class="container">
    <div class="row">
        <div class="card card-space">

            <div class="page-inner">
                <h3 class="fw-bold mb-3">Recursos Descargables de Academia</h3>

                <div class="row mb-4">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="resourceSearch">Buscar Recurso:</label>
                            <input type="text" class="form-control" id="resourceSearch"
                                placeholder="Escribe para buscar recursos...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="resourceTypeFilter">Tipo:</label>
                            <select class="form-control" id="resourceTypeFilter">
                                <option value="all">Todos los Tipos</option>
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="powerpoint">PowerPoint</option>
                                <!-- Add more resource types as needed -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" id="resourceList">
                    <!-- Resource Card 1 -->
                    <div class="col-md-6 col-lg-4 mb-4" data-type="pdf" data-title="Plantilla de Plan de Negocio"
                        data-description="Descarga nuestra plantilla editable para crear un plan de negocio profesional.">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><i class="fas fa-file-pdf me-2"></i> Plantilla de Plan de
                                    Negocio</h5>
                                <p class="card-text">Descarga nuestra plantilla editable para crear un plan de negocio
                                    profesional.</p>
                                <a href="#" class="btn btn-success btn-sm view-details-btn" data-bs-toggle="modal"
                                    data-bs-target="#detailsModal" data-type="resource"
                                    data-title="Plantilla de Plan de Negocio"
                                    data-description="Descarga nuestra plantilla editable para crear un plan de negocio profesional."
                                    data-extra-info-label="Tipo de Archivo" data-extra-info-value="PDF"
                                    data-download-link="#">Ver Detalles</a>
                                <!-- Changed button text to View Details for consistency -->
                            </div>
                        </div>
                    </div>
                    <!-- Resource Card 2 -->
                    <div class="col-md-6 col-lg-4 mb-4" data-type="excel" data-title="Plantilla de Flujo de Caja"
                        data-description="Gestiona tus finanzas con nuestra plantilla de flujo de caja en Excel.">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><i class="fas fa-file-excel me-2"></i> Plantilla de Flujo
                                    de Caja</h5>
                                <p class="card-text">Gestiona tus finanzas con nuestra plantilla de flujo de caja en
                                    Excel.</p>
                                <a href="#" class="btn btn-success btn-sm view-details-btn" data-bs-toggle="modal"
                                    data-bs-target="#detailsModal" data-type="resource"
                                    data-title="Plantilla de Flujo de Caja"
                                    data-description="Gestiona tus finanzas con nuestra plantilla de flujo de caja en Excel."
                                    data-extra-info-label="Tipo de Archivo" data-extra-info-value="Excel"
                                    data-download-link="#">Ver Detalles</a>
                                <!-- Changed button text to View Details for consistency -->
                            </div>
                        </div>
                    </div>
                    <!-- Resource Card 3 -->
                    <div class="col-md-6 col-lg-4 mb-4" data-type="powerpoint"
                        data-title="Presentación para Inversionistas"
                        data-description="Crea una presentación impactante para atraer la atención de los inversores.">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><i class="fas fa-file-powerpoint me-2"></i> Presentación
                                    para Inversionistas</h5>
                                <p class="card-text">Crea una presentación impactante para atraer la atención de los
                                    inversores.</p>
                                <a href="#" class="btn btn-success btn-sm view-details-btn" data-bs-toggle="modal"
                                    data-bs-target="#detailsModal" data-type="resource"
                                    data-title="Presentación para Inversionistas"
                                    data-description="Crea una presentación impactante para atraer la atención de los inversores."
                                    data-extra-info-label="Tipo de Archivo" data-extra-info-value="PowerPoint"
                                    data-download-link="#">Ver Detalles</a>
                                <!-- Changed button text to View Details for consistency -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Details Modal -->
            <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel">Detalles</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img id="modalImage" src="" class="img-fluid mb-3" alt="Imagen" style="display: none;">
                            <!-- Image is not typically used for resources -->
                            <h4 id="modalTitle" class="fw-bold"></h4>
                            <p id="modalDescription"></p>
                            <p id="modalExtraInfo" class="text-muted"></p>
                            <a href="#" id="modalActionButton" class="btn btn-primary mt-3" download>Descargar
                                Recurso</a>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Script for Search and Filter
        const searchInput = document.getElementById('resourceSearch');
        const typeFilter = document.getElementById('resourceTypeFilter');
        const resourceList = document.getElementById('resourceList');
        const resourceCards = resourceList.querySelectorAll('.col-md-6.col-lg-4.mb-4'); // Select the card containers

        function filterResources() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedType = typeFilter.value;

            resourceCards.forEach(card => {
                const title = card.getAttribute('data-title') ? card.getAttribute('data-title').toLowerCase() : '';
                const description = card.getAttribute('data-description') ? card.getAttribute('data-description').toLowerCase() : '';
                const type = card.getAttribute('data-type');

                const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                const matchesType = selectedType === 'all' || (type && type === selectedType);

                if (matchesSearch && matchesType) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterResources);
        if (typeFilter) typeFilter.addEventListener('change', filterResources);

        // Script for Details Modal
        const detailsModal = document.getElementById('detailsModal');
        if (detailsModal) {
            detailsModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                const button = event.relatedTarget;

                // Extract info from data-bs-* attributes
                const type = button.getAttribute('data-type');
                const title = button.getAttribute('data-title');
                const description = button.getAttribute('data-description');
                const extraInfoLabel = button.getAttribute('data-extra-info-label');
                const extraInfoValue = button.getAttribute('data-extra-info-value');
                const downloadLink = button.getAttribute('data-download-link');

                // Update the modal's content.
                const modalTitle = detailsModal.querySelector('#modalTitle');
                const modalDescription = detailsModal.querySelector('#modalDescription');
                const modalExtraInfo = detailsModal.querySelector('#modalExtraInfo');
                const modalGeneralTitle = detailsModal.querySelector('.modal-title');
                const modalActionButton = detailsModal.querySelector('#modalActionButton');

                modalGeneralTitle.textContent = 'Detalles de ' + (type === 'resource' ? 'Recurso' : type);
                modalTitle.textContent = title;
                modalDescription.textContent = description;

                if (extraInfoLabel && extraInfoValue) {
                    modalExtraInfo.textContent = extraInfoLabel + ': ' + extraInfoValue;
                    modalExtraInfo.style.display = 'block';
                } else {
                    modalExtraInfo.style.display = 'none';
                }

                // Update the action button for resources
                if (type === 'resource') {
                    modalActionButton.textContent = 'Descargar Recurso';
                    if (downloadLink) {
                        modalActionButton.href = downloadLink;
                        modalActionButton.style.display = 'block';
                    } else {
                        modalActionButton.style.display = 'none'; // Hide button if no download link
                    }
                }
                modalActionButton.setAttribute('target', '_blank');

                // Hide image section for resources
                const modalImage = detailsModal.querySelector('#modalImage');
                modalImage.style.display = 'none';
            });
        }
    });
</script>