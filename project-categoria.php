
               
                    <div class="container">
                        <div class="row">
                            <div class="card card-space">
                                <!-- Filtros -->
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <select class="form-select" id="categoria">
                                            <option selected value="">Categoría...</option>
                                            <option value="tecnologia">Tecnología</option>
                                            <option value="salud">Salud</option>
                                            <option value="educacion">Educación</option>
                                            <option value="comercio">Comercio</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-end">
                                        <button id="filtrar" class="btn btn-primary">Filtrar</button>
                                    </div>
                                </div>

                                <!-- Proyectos -->
                                <div class="row" id="proyectos">
                                    <!-- Proyecto 1 -->
                                    <div class="col-md-6 col-lg-4 mb-4" data-categoria="tecnologia">
                                        <div class="card">
                                            <img src="assets/img/blog-1.jpeg" class="card-img-top" alt="Proyecto Imagen">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold">Proyecto Innovador Alpha</h5>
                                                <p class="card-text text-muted">Tecnología | Etapa MVP</p>
                                                <p class="card-text">Breve descripción del proyecto destacando su potencial.</p>
                                                <a href="#" class="btn btn-secondary btn-sm menu-link" data-page="project-detail">Ver Detalles</a> 
                                                <a href="#" class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#chatModal">Contactar</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Proyecto 2 -->
                                    <div class="col-md-6 col-lg-4 mb-4" data-categoria="salud">
                                        <div class="card">
                                            <img src="assets/img/blog-2.jpeg" class="card-img-top" alt="Proyecto Imagen">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold">Sistema de Monitoreo de Salud</h5>
                                                <p class="card-text text-muted">Salud | Desarrollo Inicial</p>
                                                <p class="card-text">Proyecto que busca mejorar la calidad de vida mediante monitoreo.</p>
                                                <a href="#" class="btn btn-secondary btn-sm menu-link" data-page="project-detail">Ver Detalles</a> 
                                                <a href="#" class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#chatModal">Contactar</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Proyecto 3 -->
                                    <div class="col-md-6 col-lg-4 mb-4" data-categoria="educacion">
                                        <div class="card">
                                            <img src="assets/img/blog-3.jpeg" class="card-img-top" alt="Proyecto Imagen">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold">Plataforma de Aprendizaje Online</h5>
                                                <p class="card-text text-muted">Educación | Beta Testing</p>
                                                <p class="card-text">Una plataforma diseñada para mejorar el acceso a la educación.</p>
                                                <a href="#" class="btn btn-secondary btn-sm menu-link" data-page="project-detail">Ver Detalles</a> 
                                                <a href="#" class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#chatModal">Contactar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de Contacto -->
                    <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="chatModalTitle">Enviar Mensaje</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-2">
                                            <textarea class="form-control" placeholder="Escribe tu mensaje..." rows="3"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-primary w-100">Enviar</button>
                                    </form>
                                    <p class="text-center mb-2">visita su perfil aqui:</p>
                                    <a href="" class="btn btn-success w-100 menu-link"  data-page="profile">Perfil</a> 
                                    <div class="d-flex justify-content-around">
                                        <!--a href="https://wa.me/+573219118593" class="btn btn-outline-success btn-sm" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                        <a href="https://www.facebook.com/" class="btn btn-outline-primary btn-sm" target="_blank"><i class="fab fa-facebook"></i></a>
                                        <a href="https://www.instagram.com/" class="btn btn-outline-danger btn-sm" target="_blank"><i class="fab fa-instagram"></i></a-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                    document.getElementById("filtrar").addEventListener("click", function () {
                        let categoriaSeleccionada = document.getElementById("categoria").value;
                        let proyectos = document.querySelectorAll(".col-md-6.col-lg-4");

                        proyectos.forEach(proyecto => {
                            if (categoriaSeleccionada === "" || proyecto.getAttribute("data-categoria") === categoriaSeleccionada) {
                                proyecto.style.display = "block";
                            } else {
                                proyecto.style.display = "none";
                            }
                        });
                    });
                    </script>
                    


            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
            </div>
            </div>
        </div>
    </div>
</div>