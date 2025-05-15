<?php
// home.php (o donde estén los contadores)

// ---------------------------------------------------------------------
// BLOQUE DE INICIO, VERIFICACIÓN DE SESIÓN
// ---------------------------------------------------------------------
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  header('Location: landing.html'); // O tu página de login si el usuario no está logueado
  exit;
}

// ---------------------------------------------------------------------
// INICIO: LÓGICA PARA OBTENER CONTEOS DE LA BASE DE DATOS
// ---------------------------------------------------------------------

// Incluir la configuración de la base de datos
// Asumiendo que home.php está en la raíz de 'emprendeya-platform' y 'config' es una subcarpeta.
// Si tu home.php está en otra ubicación (ej. 'views/home.php'), ajusta la ruta a config/database.php.
require_once __DIR__ . '/config/database.php';

$totalEmprendedores = 0;
$totalInversores = 0;
$totalProyectos = 0;
$totalAliados = 576; // Dejamos este estático por ahora. Implementa la consulta si tienes "Aliados".

// Verificar si la conexión se estableció correctamente en database.php
if (isset($conn) && $conn) {
  // 1. Contar Emprendedores
  // Usar rol::TEXT ILIKE si 'rol' es un tipo ENUM. Si es VARCHAR/TEXT, ILIKE solo es suficiente.
  $sqlEmprendedores = "SELECT COUNT(*) AS total FROM usuarios WHERE rol::TEXT ILIKE 'Emprendedor'";
  $resultEmprendedores = pg_query($conn, $sqlEmprendedores);
  if ($resultEmprendedores) {
    $row = pg_fetch_assoc($resultEmprendedores);
    $totalEmprendedores = $row['total'] ?? 0;
  } else {
    error_log("Error al contar emprendedores en home.php: " . pg_last_error($conn));
  }

  // 2. Contar Inversores
  $sqlInversores = "SELECT COUNT(*) AS total FROM usuarios WHERE rol::TEXT ILIKE 'Inversor'";
  $resultInversores = pg_query($conn, $sqlInversores);
  if ($resultInversores) {
    $row = pg_fetch_assoc($resultInversores);
    $totalInversores = $row['total'] ?? 0;
  } else {
    error_log("Error al contar inversores en home.php: " . pg_last_error($conn));
  }

  // 3. Contar Proyectos (activos/aprobados)
  // Asegúrate que la tabla 'proyectos' y la columna 'estado' existan.
  // Si 'estado' en 'proyectos' también es un ENUM, usa estado::TEXT ILIKE
  $sqlProyectos = "SELECT COUNT(*) AS total FROM proyectos WHERE estado ILIKE 'aprobado' OR estado ILIKE 'activo'";
  $resultProyectos = pg_query($conn, $sqlProyectos);
  if ($resultProyectos) {
    $row = pg_fetch_assoc($resultProyectos);
    $totalProyectos = $row['total'] ?? 0;
  } else {
    error_log("Error al contar proyectos en home.php: " . pg_last_error($conn));
  }

  // 4. Contar Aliados (SI TIENES UNA TABLA O FORMA DE IDENTIFICARLOS)
  // Ejemplo si 'rol' es ENUM y tienes un rol 'Aliado':
  /*
    $sqlAliados = "SELECT COUNT(*) AS total FROM usuarios WHERE rol::TEXT ILIKE 'Aliado'";
    $resultAliados = pg_query($conn, $sqlAliados);
    if ($resultAliados) {
        $row = pg_fetch_assoc($resultAliados);
        $totalAliados = $row['total'] ?? 0;
    } else {
        error_log("Error al contar aliados en home.php: " . pg_last_error($conn));
    }
    */

  // No cerramos $conn aquí si home.php es incluido por index.php y index.php maneja el cierre global.
  // Si home.php es accedido directamente y este script es el único que usa $conn en esta ejecución,
  // podrías considerar cerrarla, pero es más común manejarlo globalmente.

} else {
  error_log("HOME.PHP: Error de conexión a la base de datos. La variable \$conn no está definida o la conexión falló desde config/database.php.");
  // Los contadores se mostrarán como 0 o el valor estático si la conexión falla.
}

// Formatear los números para mejor visualización (opcional)
function format_number_es($number)
{
  return number_format((int)$number, 0, ',', '.'); // Asegurar que es entero para number_format
}

$totalEmprendedores_f = format_number_es($totalEmprendedores);
$totalInversores_f = format_number_es($totalInversores);
$totalProyectos_f = format_number_es($totalProyectos);
$totalAliados_f = format_number_es($totalAliados); // Formatear también el estático, por si acaso

// ---------------------------------------------------------------------
// FIN: LÓGICA PARA OBTENER CONTEOS
// ---------------------------------------------------------------------
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
    <!-- Contadores -->
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-primary card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-5">
                <div class="icon-big text-center ">
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">Emprendedores</p>
                  <h4 class="card-title" id="contador-emprendedores">
                    <?php echo $totalEmprendedores_f; ?>
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
            <div class="row align-items-center">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-user-tie"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">Inversores</p>
                  <h4 class="card-title" id="contador-inversores">
                    <?php echo $totalInversores_f; ?>
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
            <div class="row align-items-center">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-project-diagram"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">Proyectos Activos</p>
                  <h4 class="card-title" id="contador-proyectos">
                    <?php echo $totalProyectos_f; ?>
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
            <div class="row align-items-center">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="fas fa-hands-helping"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">Aliados</p>
                  <h4 class="card-title" id="contador-aliados">
                    <?php echo $totalAliados_f; ?>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Contadores -->
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

    <!-- Sección de Emprendedores -->
    <div class="row mt-4"> <!-- Añadí un row para mejor espaciado si es necesario -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title text-black">
              Nuestros Emprendedores
            </h4>
          </div>
          <div class="card-body">
            <!-- El ID 'emprendedores-carousel' es el que usaremos para inicializar Owl Carousel -->
            <div id="emprendedores-carousel" class="owl-carousel owl-theme">
              <!-- Los items del carrusel se añadirán aquí por JavaScript -->
            </div>
            <div id="loading-emprendedores" class="text-center py-4" style="display:none;">
              <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Cargando emprendedores...</span>
              </div>
              <p class="mt-2">Cargando emprendedores...</p>
            </div>
            <div id="error-emprendedores" class="text-center text-danger py-4" style="display:none;">
              <!-- El mensaje de error se establecerá por JS -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Sección de Emprendedores -->

    <!-- Sección de Proyectos Recientes (Lista/Grid) -->
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row card-tools-still-right">
              <h4 class="card-title text-primary">Proyectos Recientes</h4>
            </div>
            <p class="card-category">
              Explora las nuevas iniciativas que están tomando forma y transformando el futuro.
            </p>
          </div>
          <div class="card-body">
            <div id="proyectos-recientes-container" class="row">
              <!-- Tarjetas de proyectos recientes -->
            </div>
            <div id="loading-proyectos-recientes" class="text-center py-4" style="display:none;">
              <div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>
              <p class="mt-2">Cargando proyectos...</p>
            </div>
            <div id="error-proyectos-recientes" class="text-center text-danger py-4" style="display:none;"></div>
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
  $(document).ready(function() {
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
<script>
  function inicializarPaginaActual() {
    console.log("HOME.PHP: inicializarPaginaActual() ejecutada.");

    // Función showAlert (si la necesitas y no está global)
    // function showAlert(type, title, message) { /* ... tu código ... */ }

    // --- Función para Cargar y Mostrar Proyectos Recientes ---
    function cargarProyectosRecientes() {
      const $container = $('#proyectos-recientes-container');
      const $loading = $('#loading-proyectos-recientes'); // ID específico
      const $error = $('#error-proyectos-recientes'); // ID específico

      if (!$container.length) {
        console.error("HOME.PHP: Contenedor #proyectos-recientes-container no encontrado.");
        $error.text("Error de configuración: Contenedor de proyectos no encontrado.").show();
        return;
      }
      if (!$loading.length || !$error.length) {
        console.warn("HOME.PHP: Indicadores de carga/error para proyectos recientes no encontrados.");
      }

      $loading.show();
      $error.hide();
      $container.html('');

      $.ajax({
        url: 'backend-php/get_proyectos_recientes.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          $loading.hide();
          if (response.success && response.data && response.data.length > 0) {
            console.log("HOME.PHP: Proyectos recientes recibidos:", response.data.length);
            let proyectosHtml = '';
            response.data.forEach(function(proyecto) {
              const logoProyectoUrl = proyecto.logo_proyecto || 'assets/img/examples/project_default.png';
              const sector = proyecto.sector || 'General';
              const nombreEmprendedor = proyecto.nombre_emprendedor || 'N/A';
              const fechaFormateada = proyecto.fecha_formateada || 'N/A';
              const nombreProyecto = proyecto.nombre_proyecto || 'Proyecto Sin Título';
              const resumenProyecto = proyecto.resumen || 'Sin descripción breve.';
              const detalleProyectoDataPage = `project-detail&id_proyecto=${proyecto.id_proyecto}`;

              proyectosHtml += `
                            <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                                <div class="card blog-item bg-light rounded overflow-hidden w-100 shadow-sm h-100">
                                    <div class="blog-img position-relative overflow-hidden" style="height: 200px;">
                                        <img class="img-fluid w-100 h-100" src="${logoProyectoUrl}" alt="Logo ${nombreProyecto}" style="object-fit: cover;">
                                        <span class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-3 py-1 px-3" style="font-size: 0.8rem;">
                                            ${sector}
                                        </span>
                                    </div>
                                    <div class="p-4 d-flex flex-column">
                                        <div class="d-flex mb-3">
                                            <small class="me-3 text-muted" title="Creado por">
                                                <i class="far fa-user text-primary me-1"></i>${nombreEmprendedor}
                                            </small>
                                            <small class="text-muted" title="Fecha de publicación">
                                                <i class="far fa-calendar-alt text-primary me-1"></i>${fechaFormateada}
                                            </small>
                                        </div>
                                        <h5 class="mb-3 card-title" style="min-height: 48px;">
                                            <a href="#" class="text-dark menu-link" data-page="${detalleProyectoDataPage}" title="${nombreProyecto}">
                                                ${nombreProyecto}
                                            </a>
                                        </h5>
                                        <p class="card-text text-muted flex-grow-1" style="font-size: 0.9rem;">
                                            ${resumenProyecto}
                                        </p>
                                        <a class="btn btn-sm btn-outline-primary btn-round mt-auto menu-link" href="#" data-page="${detalleProyectoDataPage}">
                                            Ver Proyecto <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
            });
            $container.html(proyectosHtml);
          } else if (response.data && response.data.length === 0) {
            console.log("HOME.PHP: No hay proyectos recientes para mostrar.");
            $container.html('<div class="col-12 text-center py-5"><p class="lead">Aún no hay proyectos recientes publicados.</p></div>');
          } else {
            $error.text(response.message || 'No se pudieron cargar los proyectos.').show();
            console.error("HOME.PHP: Error al cargar proyectos recientes:", response.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $loading.hide();
          $error.text('Error de conexión al cargar proyectos recientes.').show();
          console.error("HOME.PHP: Error AJAX al cargar proyectos recientes:", textStatus, errorThrown, jqXHR.responseText);
        }
      });
    }

    // --- Función para Cargar y Mostrar Carrusel de Emprendedores ---
    function cargarEmprendedoresCarousel() {
      const $carouselContainer = $('#emprendedores-carousel');
      const $loadingIndicator = $('#loading-emprendedores-carousel'); // ID específico
      const $errorIndicator = $('#error-emprendedores-carousel'); // ID específico

      if (!$carouselContainer.length) {
        console.error("HOME.PHP: Contenedor del carrusel #emprendedores-carousel no encontrado.");
        $errorIndicator.text("Error de configuración: Contenedor de emprendedores no encontrado.").show();
        return;
      }
      if (!$loadingIndicator.length || !$errorIndicator.length) {
        console.warn("HOME.PHP: Indicadores de carga/error para carrusel de emprendedores no encontrados.");
      }

      $loadingIndicator.show();
      $errorIndicator.hide();

      if ($carouselContainer.hasClass('owl-loaded')) {
        console.log("HOME.PHP: Destruyendo instancia previa de Owl Carousel para emprendedores.");
        $carouselContainer.trigger('destroy.owl.carousel').removeClass('owl-loaded owl-hidden');
        $carouselContainer.html('');
      } else {
        $carouselContainer.html('');
      }

      $.ajax({
        url: 'backend-php/get_emprendedores.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          $loadingIndicator.hide();
          if (response.success && response.data && response.data.length > 0) {
            console.log("HOME.PHP: Emprendedores para carrusel recibidos:", response.data.length);
            let itemsHtml = '';
            response.data.forEach(function(emprendedor) {
              const fotoUrl = emprendedor.foto_perfil_url || 'assets/img/profile-signin.jpg';
              const nombre = emprendedor.nombre_completo || 'Emprendedor Anónimo';
              const municipio = emprendedor.municipio || '';
              const telefono = emprendedor.telefono || '';
              const dataPageAttribute = `public-profile&user_id_view=${emprendedor.id}`;

              itemsHtml += `
                            <div class="item">
                                <div class="card card-profile-emprendedor mx-auto" style="width: 230px; margin-bottom: 20px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);"> 
                                    <img src="${fotoUrl}" class="card-img-top" alt="Foto de ${nombre}" style="height: 220px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                    <div class="card-body text-center p-3">
                                        <h5 class="card-title mb-1" style="font-size: 1.05rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="${nombre}">${nombre}</h5>
                                        ${municipio ? `<p class="card-text text-muted small mb-0" style="font-size: 0.8rem;"><i class="fas fa-map-marker-alt fa-sm text-primary"></i> ${municipio}</p>` : ''}
                                        ${telefono ? `<p class="card-text text-muted small" style="font-size: 0.8rem;"><i class="fas fa-phone fa-sm text-primary"></i> ${telefono}</p>` : ''}
                                        <a href="#" class="btn btn-primary btn-round btn-sm mt-2 menu-link" data-page="${dataPageAttribute}">Ver Perfil</a>
                                    </div>
                                </div>
                            </div>`;
            });
            $carouselContainer.html(itemsHtml);

            // Inicializar Owl Carousel si la librería está cargada
            if (typeof $.fn.owlCarousel === 'function') {
              $carouselContainer.owlCarousel({
                loop: response.data.length > 4,
                margin: 20,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                navText: ["<i class='fas fa-chevron-left p-2 bg-white text-primary rounded-circle shadow-sm'></i>", "<i class='fas fa-chevron-right p-2 bg-white text-primary rounded-circle shadow-sm'></i>"],
                responsive: {
                  0: {
                    items: 1,
                    stagePadding: 30
                  },
                  576: {
                    items: 2,
                    stagePadding: 20
                  },
                  768: {
                    items: 3,
                    stagePadding: 10
                  },
                  992: {
                    items: 4
                  },
                  1200: {
                    items: 5
                  }
                }
              });
              console.log("HOME.PHP: Owl Carousel para emprendedores inicializado/actualizado.");
            } else {
              console.error("HOME.PHP: Owl Carousel ($.fn.owlCarousel) no está definido. Asegúrate que el plugin esté cargado en index.php.");
              $errorIndicator.text('Error de configuración: El carrusel no pudo cargarse.').show();
            }

          } else if (response.data && response.data.length === 0) {
            console.log("HOME.PHP: No hay emprendedores para mostrar en el carrusel.");
            // No se muestra mensaje de error, simplemente el carrusel estará vacío o con un mensaje si Owl lo permite.
            // O podrías poner un mensaje: $carouselContainer.html('<p class="text-center">No hay emprendedores aún.</p>');
          } else {
            $errorIndicator.text(response.message || 'No se pudieron cargar los emprendedores.').show();
            console.error("HOME.PHP: Error al cargar emprendedores para carrusel:", response.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $loadingIndicator.hide();
          $errorIndicator.text('Error de conexión al cargar emprendedores.').show();
          console.error("HOME.PHP: Error AJAX al cargar emprendedores para carrusel:", textStatus, errorThrown, jqXHR.responseText);
        }
      });
    }

    // Llamar a las funciones para cargar el contenido de la página de inicio
    cargarProyectosRecientes();
    cargarEmprendedoresCarousel();

    console.log("HOME.PHP: Fin de inicializarPaginaActual().");
  }
</script>