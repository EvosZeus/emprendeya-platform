<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: session/sign-in.html");
    exit();
}
?>
<div id="carouselExampleCaptions" class="carousel slide compact-carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
      aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/carrusel/carousel-1.jpeg" class="d-block w-100" alt="..." />
      <div class="carousel-caption d-none d-md-block">
        <div class="text-center mt-5">
          <h2 class="display-1 fw-bold text-white mb-4 animated zoomIn">
            BIENVENIDO A
            <img src="assets/img/emprendeya/logo_light.png" alt="Logo EmprendeYA" class="ms-3"
              style="height: 80px; vertical-align: middle" />
          </h2>
          <p class="lead text-light">
            Impulsa tus ideas, transforma tu futuro.
          </p>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/carrusel/carousel-2.jpeg" class="d-block w-100" alt="..." />
      <div class="carousel-caption d-none d-md-block">
        <div class="text-center mt-5">
          <h2 class="display-1 fw-bold text-white mb-4 animated zoomIn">
            BIENVENIDO A
            <img src="assets/img/emprendeya/logo_light.png" alt="Logo EmprendeYA" class="ms-3"
              style="height: 80px; vertical-align: middle" />
          </h2>
          <p class="lead text-light">
            Impulsa tus ideas, transforma tu futuro.
          </p>
        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- COMIENZO PAGINA -->
<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">
          <font style="vertical-align: inherit">
            <font style="vertical-align: inherit">Pagina principal</font>
          </font>
        </h3>
        <h6 class="op-7 mb-2">
          <font style="vertical-align: inherit">
            <font style="vertical-align: inherit"></font>
          </font>
        </h6>
      </div>

    </div>
     <!-- Marcadores Pagina  -->
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-primary card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Emprendedores</font>
                    </font>
                  </p>
                  <h4 class="card-title">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">1.294</font>
                    </font>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-info card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-user-check"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Inversores</font>
                    </font>
                  </p>
                  <h4 class="card-title">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">1303</font>
                    </font>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-success card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-chart-pie"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Proyectos</font>
                    </font>
                  </p>
                  <h4 class="card-title">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">1345</font>
                    </font>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-secondary card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="far fa-check-circle"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">Aliados</font>
                    </font>
                  </p>
                  <h4 class="card-title">
                    <font style="vertical-align: inherit;">
                      <font style="vertical-align: inherit;">576</font>
                    </font>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row">
              <div class="card-title">
                <font style="vertical-align: inherit">
                  <font style="vertical-align: inherit">Estadísticas de usuario</font>
                </font>
              </div>
              <div class="card-tools">
                <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                  <span class="btn-label"> <i class="fa fa-pencil"></i> </span>
                  <font style="vertical-align: inherit">
                    <font style="vertical-align: inherit"> Exportar </font>
                  </font>
                </a>
                <a href="#" class="btn btn-label-info btn-round btn-sm">
                  <span class="btn-label"> <i class="fa fa-print"></i> </span>
                  <font style="vertical-align: inherit">
                    <font style="vertical-align: inherit"> Imprimir </font>
                  </font>
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-container" style="min-height: 375px">
              <div class="chartjs-size-monitor" style="
                  position: absolute;
                  inset: 0px;
                  overflow: hidden;
                  pointer-events: none;
                  visibility: hidden;
                  z-index: -1;
                ">
                <div class="chartjs-size-monitor-expand" style="
                    position: absolute;
                    left: 0;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    overflow: hidden;
                    pointer-events: none;
                    visibility: hidden;
                    z-index: -1;
                  ">
                  <div style="
                      position: absolute;
                      width: 1000000px;
                      height: 1000000px;
                      left: 0;
                      top: 0;
                    "></div>
                </div>
                <div class="chartjs-size-monitor-shrink" style="
                    position: absolute;
                    left: 0;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    overflow: hidden;
                    pointer-events: none;
                    visibility: hidden;
                    z-index: -1;
                  ">
                  <div style="
                      position: absolute;
                      width: 200%;
                      height: 200%;
                      left: 0;
                      top: 0;
                    "></div>
                </div>
              </div>
              <canvas id="statisticsChart" style="display: block; height: 375px; width: 642px" width="802" height="468"
                class="chartjs-render-monitor"></canvas>
            </div>
            <div id="myChartLegend">
              <ul class="0-legend html-legend">
                <li>
                  <span style="background-color: #f3545d"></span>
                  <font style="vertical-align: inherit">
                    <font style="vertical-align: inherit">Suscriptores</font>
                  </font>
                </li>
                <li>
                  <span style="background-color: #fdaf4b"></span>
                  <font style="vertical-align: inherit">
                    <font style="vertical-align: inherit">Nuevos visitantes</font>
                  </font>
                </li>
                <li>
                  <span style="background-color: #177dff"></span>
                  <font style="vertical-align: inherit">
                    <font style="vertical-align: inherit">Usuarios activos</font>
                  </font>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-primary card-round">
          <div class="card-header">
            <div class="card-head-row">
              <div class="card-title">
                <font style="vertical-align: inherit">
                  <font style="vertical-align: inherit">Ventas diarias</font>
                </font>
              </div>
              <div class="card-tools">
                <div class="dropdown">
                  <button class="btn btn-sm btn-label-light dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit"> Exportar </font>
                    </font>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Acción</font>
                      </font>
                    </a>
                    <a class="dropdown-item" href="#">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Otra acción</font>
                      </font>
                    </a>
                    <a class="dropdown-item" href="#">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Algo más aquí</font>
                      </font>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-category">
              <font style="vertical-align: inherit">
                <font style="vertical-align: inherit">25 de marzo - 2 de abril</font>
              </font>
            </div>
          </div>
          <div class="card-body pb-0">
            <div class="mb-4 mt-2">
              <h1>
                <font style="vertical-align: inherit">
                  <font style="vertical-align: inherit">$4,578.58</font>
                </font>
              </h1>
            </div>
            <div class="pull-in">
              <div class="chartjs-size-monitor" style="
                  position: absolute;
                  inset: 0px;
                  overflow: hidden;
                  pointer-events: none;
                  visibility: hidden;
                  z-index: -1;
                ">
                <div class="chartjs-size-monitor-expand" style="
                    position: absolute;
                    left: 0;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    overflow: hidden;
                    pointer-events: none;
                    visibility: hidden;
                    z-index: -1;
                  ">
                  <div style="
                      position: absolute;
                      width: 1000000px;
                      height: 1000000px;
                      left: 0;
                      top: 0;
                    "></div>
                </div>
                <div class="chartjs-size-monitor-shrink" style="
                    position: absolute;
                    left: 0;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    overflow: hidden;
                    pointer-events: none;
                    visibility: hidden;
                    z-index: -1;
                  ">
                  <div style="
                      position: absolute;
                      width: 200%;
                      height: 200%;
                      left: 0;
                      top: 0;
                    "></div>
                </div>
              </div>
              <canvas id="dailySalesChart" style="display: block; height: 150px; width: 677px" width="846" height="187"
                class="chartjs-render-monitor"></canvas>
            </div>
          </div>
        </div>
        <div class="card card-round">
          <div class="card-body pb-0">
            <div class="h1 fw-bold float-end text-primary">
              <font style="vertical-align: inherit">
                <font style="vertical-align: inherit">+5%</font>
              </font>
            </div>
            <h2 class="mb-2">
              <font style="vertical-align: inherit">
                <font style="vertical-align: inherit">17</font>
              </font>
            </h2>
            <p class="text-muted">
              <font style="vertical-align: inherit">
                <font style="vertical-align: inherit">Usuarios en línea</font>
              </font>
            </p>
            <div class="pull-in sparkline-fix">
              <div id="lineChart">
                <canvas style="
                    display: inline-block;
                    width: 381.4px;
                    height: 70px;
                    vertical-align: top;
                  " width="381" height="70"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Emprendedores -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title text-secondary">
            <font style="vertical-align: inherit">
              <font style="vertical-align: inherit">Nuestros Emprendedores</font>
            </font>
          </h4>
        </div>
        <div class="card-body">
          <div id="owl-demo" class="owl-carousel owl-theme owl-img-responsive owl-loaded owl-drag">
            <div class="owl-stage-outer">
              <div class="owl-stage" style="
                  transform: translate3d(-1154px, 0px, 0px);
                  transition: 0.25s;
                  width: 3078px;
                ">
                <div class="owl-item cloned" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item cloned" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item cloned" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item active" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item active" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item active" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item cloned" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item cloned" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item cloned" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="owl-item cloned" style="width: 182.354px; margin-right: 10px">
                  <div class="card" style="width: 18rem;">
                    <img src="assets/img/examples/product3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Carlos Lopez</h5>

                      <div class="d-flex justify-content-between mt-3">
                        <!-- Botón de correo -->
                        <a href="mailto:correo@ejemplo.com" class="btn btn-outline-primary btn-round">
                          <i class="bi bi-envelope-fill"></i>
                        </a>

                        <!-- Botón de ver perfil -->
                        <a href="" class="btn btn-secondary btn-round">
                          Ver perfil
                        </a>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>



    <div class="row">
      <div class="col-md-12">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row card-tools-still-right">
              <h4 class="card-title text-primary">
                <font style="vertical-align: inherit">
                  <font style="vertical-align: inherit">Proyectos Recientes</font>
                </font>
              </h4>
            </div>
            <p class="card-category">
              <font style="vertical-align: inherit">
                <font style="vertical-align: inherit">
                  Explora las nuevas iniciativas que están tomando forma y
                  transformando el futuro.</font>
              </font>
            </p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="blog-item bg-light rounded overflow-hidden">
                  <div class="blog-img position-relative overflow-hidden">
                    <img class="img-fluid" src="assets/img/blog-1.jpeg" alt="" />
                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                      href="">Electricidad</a>
                  </div>
                  <div class="p-4">
                    <div class="d-flex mb-3">
                      <small class="me-3"><i class="far fa-user text-primary me-2"></i>Pepito
                        Peréz</small>
                      <small><i class="far fa-calendar-alt text-primary me-2"></i>01
                        Jan, 2024</small>
                    </div>
                    <h4 class="mb-3">Evolti</h4>
                    <p>
                      Evolti se especializa en soluciones avanzadas de energía
                      solar diseñadas para transformar la forma en que el mundo
                      obtiene y utiliza energía. Ofrecemos paneles solares de
                      alta eficiencia, sistemas de almacenamiento de energía y
                      servicios de instalación personalizados que permiten a
                      hogares y empresas reducir costos y su huella de carbono.
                      En Evolti, nuestra misión es liderar la evolución hacia un
                      futuro energético más limpio y sostenible, brindando a
                      nuestros clientes una transición fluida hacia una energía
                      renovable confiable y eficiente.
                    </p>
                    <a class="text-uppercase" href="proyecto.php">Read More <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="blog-item bg-light rounded overflow-hidden">
                  <div class="blog-img position-relative overflow-hidden">
                    <img class="img-fluid" src="assets/img/blog-3.jpeg" alt="" />
                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                      href="">Tecnología</a>
                  </div>
                  <div class="p-4">
                    <div class="d-flex mb-3">
                      <small class="me-3"><i class="far fa-user text-primary me-2"></i>Pepito
                        Peréz</small>
                      <small><i class="far fa-calendar-alt text-primary me-2"></i>01
                        Jan, 2025</small>
                    </div>
                    <h4 class="mb-3">TechTide</h4>
                    <p>
                      TechTide es una empresa innovadora en el campo de la
                      tecnología wearable. Especializados en dispositivos
                      inteligentes para el monitoreo de salud y el bienestar,
                      ofrecemos productos que combinan la última tecnología con
                      un diseño elegante. Desde pulseras que rastrean tu
                      actividad física hasta gafas de realidad aumentada,
                      TechTide te mantiene a la vanguardia del progreso
                      tecnológico mientras cuida tu salud y estilo de vida.
                    </p>
                    <a class="text-uppercase" href="proyecto.php">Read More <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="blog-item bg-light rounded overflow-hidden">
                  <div class="blog-img position-relative overflow-hidden">
                    <img class="img-fluid" src="assets/img/blog-2.jpeg" alt="" />
                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                      href="">Ambiental</a>
                  </div>
                  <div class="p-4">
                    <div class="d-flex mb-3">
                      <small class="me-3"><i class="far fa-user text-primary me-2"></i>Pepito
                        Peréz</small>
                      <small><i class="far fa-calendar-alt text-primary me-2"></i>01
                        Jan, 2023</small>
                    </div>
                    <h4 class="mb-3">EcoSfera</h4>
                    <p>
                      EcoSfera es una startup dedicada a la creación de
                      soluciones sostenibles para el hogar y la oficina. Desde
                      productos ecológicos de limpieza hasta muebles hechos con
                      materiales reciclados, nuestra misión es reducir el
                      impacto ambiental sin sacrificar el estilo y la
                      funcionalidad. Con EcoSfera, cada elección que haces
                      cuenta para un futuro más verde.
                    </p>
                    <a class="text-uppercase" href="proyecto.php">Read More <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card card-round">
          <div class="card-body">
            <div class="card-head-row card-tools-still-right">
              <div class="card-title">
                <font style="vertical-align: inherit">
                  <font style="vertical-align: inherit">Nuevos clientes</font>
                </font>
              </div>
              <div class="card-tools">
                <div class="dropdown">
                  <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Acción</font>
                      </font>
                    </a>
                    <a class="dropdown-item" href="#">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Otra acción</font>
                      </font>
                    </a>
                    <a class="dropdown-item" href="#">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Algo más aquí</font>
                      </font>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-list py-4">
              <div class="item-list">
                <div class="avatar">
                  <img src="assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle" />
                </div>
                <div class="info-user ms-3">
                  <div class="username">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Jimmy Denis</font>
                    </font>
                  </div>
                  <div class="status">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Diseñador gráfico</font>
                    </font>
                  </div>
                </div>
                <button class="btn btn-icon btn-link op-8 me-1">
                  <i class="far fa-envelope"></i>
                </button>
                <button class="btn btn-icon btn-link btn-danger op-8">
                  <i class="fas fa-ban"></i>
                </button>
              </div>
              <div class="item-list">
                <div class="avatar">
                  <span class="avatar-title rounded-circle border border-white">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Fibrosis quística</font>
                    </font>
                  </span>
                </div>
                <div class="info-user ms-3">
                  <div class="username">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Chandra Félix</font>
                    </font>
                  </div>
                  <div class="status">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Promoción de ventas</font>
                    </font>
                  </div>
                </div>
                <button class="btn btn-icon btn-link op-8 me-1">
                  <i class="far fa-envelope"></i>
                </button>
                <button class="btn btn-icon btn-link btn-danger op-8">
                  <i class="fas fa-ban"></i>
                </button>
              </div>
              <div class="item-list">
                <div class="avatar">
                  <img src="assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle" />
                </div>
                <div class="info-user ms-3">
                  <div class="username">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Talha</font>
                    </font>
                  </div>
                  <div class="status">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Diseñador de front-end</font>
                    </font>
                  </div>
                </div>
                <button class="btn btn-icon btn-link op-8 me-1">
                  <i class="far fa-envelope"></i>
                </button>
                <button class="btn btn-icon btn-link btn-danger op-8">
                  <i class="fas fa-ban"></i>
                </button>
              </div>
              <div class="item-list">
                <div class="avatar">
                  <img src="assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle" />
                </div>
                <div class="info-user ms-3">
                  <div class="username">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Chad</font>
                    </font>
                  </div>
                  <div class="status">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Director ejecutivo Zeleaf</font>
                    </font>
                  </div>
                </div>
                <button class="btn btn-icon btn-link op-8 me-1">
                  <i class="far fa-envelope"></i>
                </button>
                <button class="btn btn-icon btn-link btn-danger op-8">
                  <i class="fas fa-ban"></i>
                </button>
              </div>
              <div class="item-list">
                <div class="avatar">
                  <span class="avatar-title rounded-circle border border-white bg-primary">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">H</font>
                    </font>
                  </span>
                </div>
                <div class="info-user ms-3">
                  <div class="username">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Hizrian</font>
                    </font>
                  </div>
                  <div class="status">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Diseñador web</font>
                    </font>
                  </div>
                </div>
                <button class="btn btn-icon btn-link op-8 me-1">
                  <i class="far fa-envelope"></i>
                </button>
                <button class="btn btn-icon btn-link btn-danger op-8">
                  <i class="fas fa-ban"></i>
                </button>
              </div>
              <div class="item-list">
                <div class="avatar">
                  <span class="avatar-title rounded-circle border border-white bg-secondary">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">F</font>
                    </font>
                  </span>
                </div>
                <div class="info-user ms-3">
                  <div class="username">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Farrah</font>
                    </font>
                  </div>
                  <div class="status">
                    <font style="vertical-align: inherit">
                      <font style="vertical-align: inherit">Marketing</font>
                    </font>
                  </div>
                </div>
                <button class="btn btn-icon btn-link op-8 me-1">
                  <i class="far fa-envelope"></i>
                </button>
                <button class="btn btn-icon btn-link btn-danger op-8">
                  <i class="fas fa-ban"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row card-tools-still-right">
              <div class="card-title">
                <font style="vertical-align: inherit">
                  <font style="vertical-align: inherit">Historial de transacciones</font>
                </font>
              </div>
              <div class="card-tools">
                <div class="dropdown">
                  <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Acción</font>
                      </font>
                    </a>
                    <a class="dropdown-item" href="#">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Otra acción</font>
                      </font>
                    </a>
                    <a class="dropdown-item" href="#">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Algo más aquí</font>
                      </font>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center mb-0">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Número de pago</font>
                      </font>
                    </th>
                    <th scope="col" class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Fecha y hora</font>
                      </font>
                    </th>
                    <th scope="col" class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Cantidad</font>
                      </font>
                    </th>
                    <th scope="col" class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">Estado</font>
                      </font>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          Pago de #10231
                        </font>
                      </font>
                    </th>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          19 de marzo de 2020, 14:45
                        </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit"> $250.00 </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <span class="badge badge-success">
                        <font style="vertical-align: inherit">
                          <font style="vertical-align: inherit">Terminado</font>
                        </font>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          Pago de #10231
                        </font>
                      </font>
                    </th>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          19 de marzo de 2020, 14:45
                        </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit"> $250.00 </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <span class="badge badge-success">
                        <font style="vertical-align: inherit">
                          <font style="vertical-align: inherit">Terminado</font>
                        </font>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          Pago de #10231
                        </font>
                      </font>
                    </th>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          19 de marzo de 2020, 14:45
                        </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit"> $250.00 </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <span class="badge badge-success">
                        <font style="vertical-align: inherit">
                          <font style="vertical-align: inherit">Terminado</font>
                        </font>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          Pago de #10231
                        </font>
                      </font>
                    </th>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          19 de marzo de 2020, 14:45
                        </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit"> $250.00 </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <span class="badge badge-success">
                        <font style="vertical-align: inherit">
                          <font style="vertical-align: inherit">Terminado</font>
                        </font>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          Pago de #10231
                        </font>
                      </font>
                    </th>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          19 de marzo de 2020, 14:45
                        </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit"> $250.00 </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <span class="badge badge-success">
                        <font style="vertical-align: inherit">
                          <font style="vertical-align: inherit">Terminado</font>
                        </font>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          Pago de #10231
                        </font>
                      </font>
                    </th>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          19 de marzo de 2020, 14:45
                        </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit"> $250.00 </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <span class="badge badge-success">
                        <font style="vertical-align: inherit">
                          <font style="vertical-align: inherit">Terminado</font>
                        </font>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                        <i class="fa fa-check"></i>
                      </button>
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          Pago de #10231
                        </font>
                      </font>
                    </th>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit">
                          19 de marzo de 2020, 14:45
                        </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <font style="vertical-align: inherit">
                        <font style="vertical-align: inherit"> $250.00 </font>
                      </font>
                    </td>
                    <td class="text-end">
                      <span class="badge badge-success">
                        <font style="vertical-align: inherit">
                          <font style="vertical-align: inherit">Terminado</font>
                        </font>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Blog Start -->




<!-- Vendor Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
  <div class="container py-5 mb-5">
    <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px">
      <h4 class="fw-bold text-primary text-uppercase">
        Patrocinadores Destacados
      </h4>
      <p class="mb-0">
        Agradecemos a nuestros patrocinadores por su valioso apoyo y compromiso,
        que nos impulsa a alcanzar nuevas metas y hacer realidad nuestras
        ambiciones.
      </p>
    </div>
    <div class="bg-white">
      <div class="owl-carousel vendor-carousel">
        <img src="assets/img/vendor-1.jpg" alt="" />
        <img src="assets/img/vendor-2.png" alt="" />
        <img src="assets/img/vendor-1.jpg" alt="" />
        <img src="assets/img/vendor-2.png" alt="" />
        <img src="assets/img/vendor-1.jpg" alt="" />
        <img src="assets/img/vendor-2.png" alt="" />
        <img src="assets/img/vendor-1.jpg" alt="" />
        <img src="assets/img/vendor-2.png" alt="" />
        <img src="assets/img/vendor-1.jpg" alt="" />
      </div>
    </div>
  </div>
</div>
<!-- Vendor End -->

<script>
  $(document).ready(function () {
    $("#owl-demo").owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 4,
        },
      },
    });

    $("#owl-demo2").owlCarousel({
      nav: true, // Show next and prev buttons
      autoplaySpeed: 300,
      navSpeed: 400,
      items: 1,
    });

    $("#owl-demo3").owlCarousel({
      center: true,
      items: 2,
      loop: true,
      margin: 10,
      responsive: {
        600: {
          items: 4,
        },
      },
    });

    $("#owl-demo4").owlCarousel({
      margin: 10,
      loop: false,
      autoWidth: true,
      items: 4,
    });
  });
</script>