
<div class="container">
    <div class="row">
        <div class="card card-space">
            <h3 class="fw-bold mb-3">Explorar Proyectos</h3>
            <p class="mb-4">Descubre las oportunidades de inversión más prometedoras.</p>

            <!-- Filters Row -->
            <div class="d-flex align-items-center gap-2">
                <div class="col-md-3">
                    <input type="text" id="buscar" class="form-control" placeholder="Buscar por nombre...">
                </div>
                <div class="col-md-3">
                    <button id="filtrar" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
            <br><br>
        <!-- Projects Grid -->
             <div class="row"> 
                 <?php
                    include 'config/database.php'; 

                    $query = "SELECT * FROM proyectos ORDER BY id DESC";
                    $result = pg_query($conn, $query);

                    if (!$result) {
                        echo "<p>Error al obtener los proyectos.</p>";
                        exit;
                    }

                    while ($row = pg_fetch_assoc($result)) {
                        $nombre = htmlspecialchars($row['nombre_proyecto']);
                        $eslogan = htmlspecialchars($row['eslogan']);
                        $sector = htmlspecialchars($row['sector']);
                        $etapa = htmlspecialchars($row['etapa']);
                        $descripcion = htmlspecialchars($row['resumen']);
                        $meta = number_format($row['monto_inversion'], 0, '.', ',');
                        $logo = $row['logo'] ? htmlspecialchars($row['logo']) : 'assets/img/default.jpg';
                        $contacto = htmlspecialchars($row['contacto_nombre']);
                        $fecha = date('d M Y', strtotime($row['created_at'] ?? 'now'));
                        $progreso = rand(20, 90); // Simulación

                        echo <<<HTML
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <img src="$logo" class="card-img-top" alt="Project Image">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">$nombre</h5>
                                    <p class="card-text text-muted">$sector | Etapa $etapa</p>
                                    <p class="card-text">$descripcion</p>
                                    <div class="progress mb-2" style="height: 10px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {$progreso}%;" aria-valuenow="$progreso" aria-valuemin="0" aria-valuemax="100">$progreso%</div>
                                    </div>
                                    <p class="card-text mb-2"><small class="text-muted">Meta: \$$meta</small></p>
                                      <a href="#" class="btn btn-secondary btn-sm menu-link" data-page="project-detail">Ver Detalles</a> 
                                     <a href="#" class="btn btn-success btn-sm float-end" data-bs-toggle="modal"  data-bs-target="#chatModal" >contactar</a>

                            <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm"> 
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold" id="chatModalTitle">Enviar Mensaje</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-2">
                                                    <textarea class="form-control" placeholder="Escribe tu mensaje..." rows="3"></textarea>
                                                </div>
                                                <button type="button" class="btn btn-primary w-100">Enviar</button>
                                            </form>
                                            <hr>
                                            <p class="text-center mb-2">También puedes contactar a través de:</p>
                                            <div class="d-flex justify-content-around">
                                                <a href="https://wa.me/+573219118593" class="btn btn-outline-success btn-sm" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                <a href="https://www.facebook.com/marlonandres.meloperez" class="btn btn-outline-primary btn-sm" target="_blank"><i class="fab fa-facebook"></i></a>
                                                <a href="https://www.instagram.com/dburbano_" class="btn btn-outline-danger btn-sm" target="_blank"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <small class="text-muted"><i class="fas fa-user me-1"></i> $contacto</small>
                                    <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Publicado: $fecha</small>
                                </div>
                            </div>
                        </div>
                    HTML;
                    }
                    pg_close($conn);
                ?>
            </div> 
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