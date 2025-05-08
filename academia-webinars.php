<div class="container">
    <div class="row">
        <div class="card card-space">
            <div class="page-inner">
                <h3 class="fw-bold mb-3">Webinars de Academia</h3>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="webinarSearch">Buscar Webinar:</label>
                            <input type="text" class="form-control" id="webinarSearch"
                                placeholder="Escribe para buscar webinars...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="webinarCategoryFilter">Categoría:</label>
                            <select class="form-control" id="webinarCategoryFilter">
                                <option value="all">Todas las Categorías</option>
                                <option value="inversion">Inversión</option>
                                <option value="marketing">Marketing</option>
                                <option value="legal">Legal</option>
                                <!-- Add more categories as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="webinarDateFilter">Fecha (simple):</label>
                            <select class="form-control" id="webinarDateFilter">
                                <option value="all">Cualquier Fecha</option>
                                <option value="2025-04-27">27 de Abril, 2025</option>
                                <option value="2025-05-11">11 de Mayo, 2025</option>
                                <option value="2025-05-25">25 de Mayo, 2025</option>
                                <!-- Add more date options as needed -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" id="webinarList">
                    <!-- Webinar Card 1 -->
                    <div class="col-md-6 col-lg-4 mb-4" data-category="inversion" data-date="2025-04-27"
                        data-title="Webinar: Cómo Conseguir Inversión Ángel"
                        data-description="Aprende los secretos para atraer inversores ángeles a tu proyecto.">
                        <div class="card">
                            <img src="assets/img/examples/example7.jpeg" class="card-img-top" alt="Webinar Image">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Webinar: Cómo Conseguir Inversión Ángel</h5>
                                <p class="card-text">Aprende los secretos para atraer inversores ángeles a tu proyecto.
                                </p>
                                <a href="#" class="btn btn-primary btn-sm view-details-btn" data-bs-toggle="modal"
                                    data-bs-target="#detailsModal" data-type="webinar"
                                    data-image="assets/img/examples/example7.jpeg"
                                    data-title="Webinar: Cómo Conseguir Inversión Ángel"
                                    data-description="Aprende los secretos para atraer inversores ángeles a tu proyecto."
                                    data-extra-info-label="Fecha" data-extra-info-value="27 de Abril, 2025"
                                    data-action-link="#">Ver Detalles</a>
                                <!-- Changed button text to View Details for consistency -->
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: 27 de Abril, 2025</small>
                            </div>
                        </div>
                    </div>
                    <!-- Webinar Card 2 -->
                    <div class="col-md-6 col-lg-4 mb-4" data-category="marketing" data-date="2025-05-11"
                        data-title="Webinar: Marketing de Contenidos para Startups"
                        data-description="Atrae clientes potenciales con contenido relevante y de valor.">
                        <div class="card">
                            <img src="assets/img/examples/example8.jpeg" class="card-img-top" alt="Webinar Image">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Webinar: Marketing de Contenidos para Startups</h5>
                                <p class="card-text">Atrae clientes potenciales con contenido relevante y de valor.</p>
                                <a href="#" class="btn btn-primary btn-sm view-details-btn" data-bs-toggle="modal"
                                    data-bs-target="#detailsModal" data-type="webinar"
                                    data-image="assets/img/examples/example8.jpeg"
                                    data-title="Webinar: Marketing de Contenidos para Startups"
                                    data-description="Atrae clientes potenciales con contenido relevante y de valor."
                                    data-extra-info-label="Fecha" data-extra-info-value="11 de Mayo, 2025"
                                    data-action-link="#">Ver Detalles</a>
                                <!-- Changed button text to View Details for consistency -->
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: 11 de Mayo, 2025</small>
                            </div>
                        </div>
                    </div>
                    <!-- Webinar Card 3 -->
                    <div class="col-md-6 col-lg-4 mb-4" data-category="legal" data-date="2025-05-25"
                        data-title="Webinar: Aspectos Legales Clave para Emprendedores"
                        data-description="Protege tu negocio desde el inicio con una base legal sólida.">
                        <div class="card">
                            <img src="assets/img/examples/example9.jpeg" class="card-img-top" alt="Webinar Image">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Webinar: Aspectos Legales Clave para Emprendedores</h5>
                                <p class="card-text">Protege tu negocio desde el inicio con una base legal sólida.</p>
                                <a href="#" class="btn btn-primary btn-sm view-details-btn" data-bs-toggle="modal"
                                    data-bs-target="#detailsModal" data-type="webinar"
                                    data-image="assets/img/examples/example9.jpeg"
                                    data-title="Webinar: Aspectos Legales Clave para Emprendedores"
                                    data-description="Protege tu negocio desde el inicio con una base legal sólida."
                                    data-extra-info-label="Fecha" data-extra-info-value="25 de Mayo, 2025"
                                    data-action-link="#">Ver Detalles</a>
                                <!-- Changed button text to View Details for consistency -->
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: 25 de Mayo, 2025</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
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
                            <img id="modalImage" src="" class="img-fluid mb-3" alt="Imagen">
                            <h4 id="modalTitle" class="fw-bold"></h4>
                            <p id="modalDescription"></p>
                            <p id="modalExtraInfo" class="text-muted"></p>
                            <a href="#" id="modalActionButton" class="btn btn-primary mt-3"
                                style="display: none;">Acción</a>
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
        const searchInput = document.getElementById('webinarSearch');
        const categoryFilter = document.getElementById('webinarCategoryFilter');
        const dateFilter = document.getElementById('webinarDateFilter');
        const webinarList = document.getElementById('webinarList');
        const webinarCards = webinarList.querySelectorAll('.col-md-6.col-lg-4.mb-4'); // Select the card containers

        function filterWebinars() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categoryFilter.value;
            const selectedDate = dateFilter.value;

            webinarCards.forEach(card => {
                const title = card.getAttribute('data-title') ? card.getAttribute('data-title').toLowerCase() : '';
                const description = card.getAttribute('data-description') ? card.getAttribute('data-description').toLowerCase() : '';
                const category = card.getAttribute('data-category');
                const date = card.getAttribute('data-date');

                const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                const matchesCategory = selectedCategory === 'all' || (category && category === selectedCategory);
                const matchesDate = selectedDate === 'all' || (date && date === selectedDate);

                if (matchesSearch && matchesCategory && matchesDate) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterWebinars);
        if (categoryFilter) categoryFilter.addEventListener('change', filterWebinars);
        if (dateFilter) dateFilter.addEventListener('change', filterWebinars);

        // Script for Details Modal
        const detailsModal = document.getElementById('detailsModal');
        if (detailsModal) {
            detailsModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                const button = event.relatedTarget;

                // Extract info from data-bs-* attributes
                const type = button.getAttribute('data-type');
                const image = button.getAttribute('data-image');
                const title = button.getAttribute('data-title');
                const description = button.getAttribute('data-description');
                const extraInfoLabel = button.getAttribute('data-extra-info-label');
                const extraInfoValue = button.getAttribute('data-extra-info-value');
                const actionLink = button.getAttribute('data-action-link'); // For webinars/workshops signup

                // Update the modal's content.
                const modalTitle = detailsModal.querySelector('#modalTitle');
                const modalImage = detailsModal.querySelector('#modalImage');
                const modalDescription = detailsModal.querySelector('#modalDescription');
                const modalExtraInfo = detailsModal.querySelector('#modalExtraInfo');
                const modalGeneralTitle = detailsModal.querySelector('.modal-title');
                const modalActionButton = detailsModal.querySelector('#modalActionButton');

                // Set modal general title based on type
                if (type === 'course') modalGeneralTitle.textContent = 'Detalles de Curso';
                else if (type === 'resource') modalGeneralTitle.textContent = 'Detalles de Recurso';
                else if (type === 'workshop') modalGeneralTitle.textContent = 'Detalles de Taller';
                else if (type === 'webinar') modalGeneralTitle.textContent = 'Detalles de Webinar';
                else modalGeneralTitle.textContent = 'Detalles';


                modalTitle.textContent = title;
                modalDescription.textContent = description;

                if (image) {
                    modalImage.src = image;
                    modalImage.style.display = 'block';
                } else {
                    modalImage.style.display = 'none';
                }

                if (extraInfoLabel && extraInfoValue) {
                    modalExtraInfo.textContent = extraInfoLabel + ': ' + extraInfoValue;
                    modalExtraInfo.style.display = 'block';
                } else {
                    modalExtraInfo.style.display = 'none';
                }

                // Handle action button based on type
                if (type === 'resource') {
                    modalActionButton.textContent = 'Descargar Recurso';
                    const downloadLink = button.getAttribute('data-download-link');
                    if (downloadLink) {
                        modalActionButton.href = downloadLink;
                        modalActionButton.style.display = 'block';
                        modalActionButton.removeAttribute('download');
                    } else {
                        modalActionButton.style.display = 'none';
                    }
                    modalActionButton.setAttribute('target', '_blank');

                } else if (type === 'course' || type === 'workshop' || type === 'webinar') {
                    modalActionButton.textContent = 'Inscribirse / Ver Más';
                    if (actionLink) {
                        modalActionButton.href = actionLink;
                        modalActionButton.style.display = 'block';
                        modalActionButton.removeAttribute('download');
                    } else {
                        modalActionButton.style.display = 'none';
                    }
                    modalActionButton.setAttribute('target', '_blank');
                }
                else {
                    modalActionButton.style.display = 'none';
                }

            });
        }
    });
</script>