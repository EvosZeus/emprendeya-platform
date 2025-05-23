<?php
// ---------------------------------------------------------------------
// BLOQUE DE INICIO, VERIFICACIÓN DE SESIÓN Y RECUPERACIÓN COMPLETA DE DATOS DEL USUARIO
// (Basado en la tabla 'usuarios' y lo guardado en $_SESSION durante el login)
// ---------------------------------------------------------------------

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  header('Location: landing.html');
  exit;
}

// --- Recuperación de todas las variables de sesión relevantes ---

// ID del usuario (obligatorio para saber quién es)
$sesion_user_id = $_SESSION['user_id'];

// Datos de la tabla 'usuarios' que guardaste en la sesión:
$sesion_nombre_completo = isset($_SESSION['user_name'])
  ? htmlspecialchars($_SESSION['user_name'])
  : 'N/A'; // Nombre completo

$sesion_email_usuario = isset($_SESSION['user_email'])
  ? htmlspecialchars($_SESSION['user_email'])
  : 'N/A'; // Email

$sesion_rol_usuario = isset($_SESSION['user_role'])
  ? htmlspecialchars($_SESSION['user_role'])
  : 'N/A'; // Rol (Emprendedor, Inversor)

$sesion_acepta_terminos = isset($_SESSION['user_terms_accepted'])
  ? (bool)$_SESSION['user_terms_accepted'] // Convertir a booleano
  : false; // Acepta términos

$sesion_foto_perfil_url = isset($_SESSION['user_photo_url']) && !empty($_SESSION['user_photo_url'])
  ? htmlspecialchars($_SESSION['user_photo_url'])
  : 'assets/img/profile-signin.jpg'; // Foto de perfil URL (con default)

$sesion_genero_usuario = isset($_SESSION['user_gender'])
  ? htmlspecialchars($_SESSION['user_gender'])
  : 'N/A'; // Género

$sesion_telefono_usuario = isset($_SESSION['user_phone']) && !empty($_SESSION['user_phone'])
  ? htmlspecialchars($_SESSION['user_phone'])
  : 'N/A'; // Teléfono

$sesion_fecha_nacimiento = isset($_SESSION['user_birth_date']) && !empty($_SESSION['user_birth_date'])
  ? htmlspecialchars($_SESSION['user_birth_date']) // Formato YYYY-MM-DD de la DB
  : 'N/A'; // Fecha de nacimiento

$sesion_municipio_usuario = isset($_SESSION['user_municipality']) && !empty($_SESSION['user_municipality'])
  ? htmlspecialchars($_SESSION['user_municipality'])
  : 'N/A'; // Municipio

$sesion_fecha_registro = isset($_SESSION['user_registration_date']) && !empty($_SESSION['user_registration_date'])
  ? htmlspecialchars($_SESSION['user_registration_date']) // Formato de timestamp
  : 'N/A'; // Fecha de registro

$sesion_cuenta_verificada = isset($_SESSION['user_account_verified'])
  ? (bool)$_SESSION['user_account_verified'] // Convertir a booleano
  : false; // Cuenta verificada

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Panel de Administración Bootstrap 5</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets/img/emprendeya/favicon.ico" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>


  <!-- FullCalendar CSS -->

  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.css" />
  <link rel="stylesheet" href="assets/css/emprendeya-2.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/emprendeya.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.php" class="logo">
            <img src="assets/img/emprendeya/logo_light.png" alt="navbar brand" class="navbar-brand" height="50" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <div class="profile-section">
            <div class="user-profile d-flex flex-column align-items-center text-center py-4">
              <div class="avatar avatar-xxl mb-3 <?php echo isset($sesion_user_id) ? '' : 'd-none'; ?>">
                <img src="<?php echo $sesion_foto_perfil_url; ?>"
                  alt="Foto de perfil de <?php echo $sesion_nombre_completo; ?>" class="avatar-img rounded-circle" />
              </div>

              <span class="user-name fw-bold mb-1">
                <font style="vertical-align: inherit">
                  <font style="vertical-align: inherit">
                    <?php echo $sesion_nombre_completo; ?>
                  </font>
                </font>
              </span>
              <span class="user-level"
                style="font-weight: bold; text-transform: uppercase; color: #c63e2f ; vertical-align: inherit;">
                <?php echo $sesion_rol_usuario; ?>
              </span>
            </div>
            <div class="row menubars border-top border-bottom text-center no-gutters px-4">
              <div class="col-4 border-right">
                <a href="#" class="menubar p-3" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-title="Notifications"><i class="fa fa-bell"></i></a>
              </div>
              <div class="col-4 border-right">
                <a href="#" class="menubar p-3" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-title="Settings"><i class="fa fa-cog"></i></a>
              </div>
              <div class="col-4">
                <a href="#" class="menubar p-3 menu-link" data-page="email-inbox" data-bs-toggle="tooltip"
                  data-bs-placement="top" data-bs-title="Email">
                  <i class="fa fa-envelope"></i>
                </a>
              </div>
            </div>
          </div>

          <ul class="nav nav-secondary">

            <li class="nav-item">
              <a href="" class="menu-link" data-page="home">
                <i class="fas fa-home"></i>
                <p>Inicio</p>
                <span class="badge badge-success"></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="menu-link" data-page="secop-2">
                <i class="fas fa-laptop"></i>
                <p>Secop II</p>
                <span class="badge badge-success"></span>
              </a>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#servicios">
                <i class="fas fa-layer-group"></i>
                <p>Servicios</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="servicios">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="" class="menu-link" data-page="mentoria-personalizada">
                      <i class="fas fa-chalkboard-teacher me-2"></i>
                      <span class="sub-item">Mentoría personalizada</span>
                    </a>
                  </li>

                  <li>
                    <a href="" class="menu-link" data-page="asesoria-legal-contable">
                      <i class="fas fa-file-contract me-2"></i>
                      <span class="sub-item">Asesoría legal & contable</span>
                    </a>
                  </li>

                  <li>
                    <a href="" class="menu-link" data-page="diseno-branding">
                      <i class="fas fa-paint-brush me-2"></i>
                      <span class="sub-item">Diseño y branding</span>
                    </a>
                  </li>

                  <li>
                    <a href="" class="menu-link" data-page="marketing-digital">
                      <i class="fas fa-bullhorn me-2"></i>
                      <span class="sub-item">Marketing digital</span>
                    </a>
                  </li>
                  <li>
                    <a href="" class="menu-link" data-page="herramientas-exclusivas">
                      <i class="fas fa-folder-open me-2"></i>
                      <span class="sub-item">Herramientas exclusivas</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#Proyectos">
                <i class="fas fa-project-diagram"></i>
                <p>Proyectos</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="Proyectos">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="" class="menu-link" data-page="public-project">
                      <i class="fas fa-plus-circle me-2 text-success"></i>
                      <span class="sub-item">Publicar proyecto</span>
                    </a>
                  </li>

                  <li>
                    <a href="" class="menu-link" data-page="projects-list">
                      <i class="fas fa-list me-2"></i>
                      <span class="sub-item">Todos</span>
                    </a>
                  </li>

                  <li>
                    <a href="" class="menu-link" data-page="projects-destacados">
                      <i class="fas fa-star me-2"></i>
                      <span class="sub-item">Destacados</span>
                    </a>
                  </li>

                  <li>
                    <a href="" class="menu-link" data-page="projects-nuevos">
                      <i class="fas fa-clock me-2"></i>
                      <span class="sub-item">Nuevos</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#academia">
                <i class="fas fa-swatchbook"></i>
                <p>Academia</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="academia">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="" class="menu-link" data-page="academia-cursos">
                      <span class="sub-item">Cursos</span>
                    </a>
                  </li>
                  <li>
                    <a href="" class="menu-link" data-page="academia-talleres">
                      <span class="sub-item">Talleres</span>
                    </a>
                  </li>
                  <li>
                    <a href="" class="menu-link" data-page="academia-webinars">
                      <span class="sub-item">Webinars</span>
                    </a>
                  </li>
                  <li>
                    <a href="" class="menu-link" data-page="academia-recursos">
                      <span class="sub-item">Recursos descargables</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#comunidad">
                <i class="fas fa-users"></i>
                <p>Comunidad</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="comunidad">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="" class="menu-link" data-page="comunidad-foro">
                      <span class="sub-item">Foro</span>
                    </a>
                  </li>
                  <li>
                    <a href="" class="menu-link" data-page="comunidad-grupos">
                      <span class="sub-item">Grupos de interés</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#blog">
                <i class="fas fa-map-marker-alt"></i>
                <p>Blog</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="blog">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="" class="menu-link" data-page="about">
                      <span class="sub-item">Emprendimiento</span>
                    </a>
                  </li>
                  <li>
                    <a href="" class="menu-link" data-page="about">
                      <span class="sub-item">Inversión</span>
                    </a>
                  </li>
                  <li>
                    <a href="" class="menu-link" data-page="about">
                      <span class="sub-item">Tips legales</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="" class="menu-link" data-page="seguridad">
                <i class="fas fa-lock"></i>
                <p>Centro de Seguridad</p>
                <span class="badge badge-success"></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="menu-link" data-page="aliados">
                <i class="fas fa-hands-helping"></i>
                <p>Aliados</p>
                <span class="badge badge-success"></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="menu-link" data-page="about">
                <i class="fas fa-info-circle"></i>
                <p>Acerca de</p>
                <span class="badge badge-secondary"></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="menu-link" data-page="contact">
                <i class="fas fa-phone"></i>
                <p>Contacto</p>
                <span class="badge badge-secondary"></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.php" class="logo">
              <img src="assets/img/emprendeya/logo_light.png" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search pe-1">
                    <i class="fa fa-search search-icon"></i>
                  </button>
                </div>
                <input type="text" placeholder="Buscar ..." class="form-control" />
              </div>
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                  aria-expanded="false" aria-haspopup="true">
                  <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                  <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                      <input type="text" placeholder="Buscar ..." class="form-control" />
                    </div>
                  </form>
                </ul>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fab fa-weixin"></i>
                  <span class="notification">1</span>
                </a>
                <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                  <li>
                    <div class="dropdown-title d-flex justify-content-between align-items-center">
                      Mensajes
                      <a href="#" class="small">Marcar todos como leídos</a>
                    </div>
                  </li>
                  <li>
                    <div class="message-notif-scroll scrollbar-outer">
                      <div class="notif-center">
                        <a href="#" class="menu-link" data-page="chat">
                          <div class="notif-img">
                            <img src="assets/img/profile2.jpg" alt="Img Profile" />
                          </div>
                          <div class="notif-content">
                            <span class="subject">Javier Martínez</span>
                            <span class="block">¿Cómo estás?</span>
                            <span class="time">hace 5 minutos</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <a class="see-all" href="javascript:void(0);">Ver todos los mensajes<i
                        class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bell"></i>
                  <span class="notification">4</span>
                </a>
                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                  <li>
                    <div class="dropdown-title">
                      Tienes 4 nuevas notificaciones
                    </div>
                  </li>
                  <li>
                    <div class="notif-scroll scrollbar-outer">
                      <div class="notif-center">
                        <a href="#">
                          <div class="notif-icon notif-primary">
                            <i class="fa fa-user-plus"></i>
                          </div>
                          <div class="notif-content">
                            <span class="block">Nuevo usuario registrado</span>
                            <span class="time">hace 5 minutos</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="notif-icon notif-success">
                            <i class="fa fa-comment"></i>
                          </div>
                          <div class="notif-content">
                            <span class="block">
                              Roberto comentó sobre Admin
                            </span>
                            <span class="time">hace 12 minutos</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="notif-img">
                            <img src="assets/img/profile2.jpg" alt="Img Profile" />
                          </div>
                          <div class="notif-content">
                            <span class="block">
                              Ricardo te envió mensajes
                            </span>
                            <span class="time">hace 12 minutos</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="notif-icon notif-danger">
                            <i class="fa fa-heart"></i>
                          </div>
                          <div class="notif-content">
                            <span class="block">A María le gustó Admin</span>
                            <span class="time">hace 17 minutos</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <a class="see-all" href="javascript:void(0);">Ver todas las notificaciones<i
                        class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="fas fa-layer-group"></i>
                </a>
                <div class="dropdown-menu quick-actions animated fadeIn">
                  <div class="quick-actions-header">
                    <span class="title mb-1">Acciones Rápidas</span>
                    <span class="subtitle op-7">Atajos</span>
                  </div>
                  <div class="quick-actions-scroll scrollbar-outer">
                    <div class="quick-actions-items">
                      <div class="row m-0">
                        <a href="#" class="col-6 col-md-4 p-0 menu-link" data-page="action-fats/calendar"
                          onclick="cargarModal(event)">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-danger rounded-circle">
                              <i class="far fa-calendar-alt"></i>
                            </div>
                            <span class="text">Calendario</span>
                          </div>
                        </a>

                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-warning rounded-circle">
                              <i class="fas fa-map"></i>
                            </div>
                            <span class="text">Mapas</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-info rounded-circle">
                              <i class="fas fa-file-excel"></i>
                            </div>
                            <span class="text">Informes</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0 menu-link" href="#" data-page="email-inbox">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-success rounded-circle">
                              <i class="fas fa-envelope"></i>
                            </div>
                            <span class="text">Correos</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0 menu-link" href="#" data-page="404">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-danger rounded-circle">
                              <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <span class="text">404</span>
                          </div>
                        </a>
                        <a class="col-6 col-md-4 p-0 menu-link" data-page="session/sign-in" href="#">
                          <div class="quick-actions-item">
                            <div class="avatar-item bg-secondary rounded-circle">
                              <i class="fas fa-credit-card"></i>
                            </div>
                            <span class="text">sessions</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <div class="avatar-sm">
                    <img src="<?php echo $sesion_foto_perfil_url; ?>" alt="..." class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hola,</span>
                    <span class="fw-bold"><?php echo $sesion_nombre_completo; ?></span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer scroll-content" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 261.837px;">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img src="<?php echo $sesion_foto_perfil_url; ?>" alt="image profile" class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                          <h4><?php echo $sesion_nombre_completo; ?></h4>
                          <p class="text-muted"><?php echo $sesion_email_usuario; ?></p>
                          <a href="" class="btn btn-xs btn-secondary btn-sm menu-link" href="#" data-page="profile">Ver
                            Perfil</a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Configuración de Cuenta</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="backend-php/logout.php">Cerrar Sesión</a>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <!-- ✅ Aquí se inyectará el contenido tipo @RenderBody -->
      <div class="container">
        <div id="render-body" class="page-inner"></div>
      </div>

      <footer class="footer text-dark mt-5" style="background-color: #ffffff">
        <!-- Contenido adicional acoplado -->
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
          <div class="container">
            <div class="row gx-5">
              <div class="col-6 col-md-4 p-0 footer-about">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 p-4"
                  style="background-color: #1a2035">
                  <a href="index.php" class="navbar-brand d-flex align-items-center">
                    <img src="assets/img/emprendeya/logo_light.png" alt="navbar brand" class="navbar-brand me-2"
                      height="50" />
                  </a>

                  <p class="mt-3 mb-4 text-white">
                    ¿Tienes alguna duda, sugerencia? ¡Nos encantaría escuchar
                    tu opinión!
                  </p>
                  <form action="">
                    <div class="row g-3">
                      <div class="col-xl-12">
                        <input type="text" class="form-control bg-light border-0" placeholder="Your Name"
                          style="height: 55px" />
                      </div>
                      <div class="col-12">
                        <input type="email" class="form-control bg-light border-0" placeholder="Your Email"
                          style="height: 55px" />
                      </div>
                      <div class="col-12">
                        <select class="form-select bg-light border-0" style="height: 55px">
                          <option selected>Select A Service</option>
                          <option value="1">Service 1</option>
                          <option value="2">Service 2</option>
                          <option value="3">Service 3</option>
                        </select>
                      </div>
                      <div class="col-12">
                        <textarea class="form-control bg-light border-0" rows="3" placeholder="Message"></textarea>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-secondary btn-rounded w-100 py-3" type="submit">
                          Enviar
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-lg-8 col-md-6 text-dark">
                <div class="row gx-5">
                  <div class="col-lg-4 col-md-12 pt-5 mb-5">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                      <h3 class="text-dark mb-0">Ponte en Contacto</h3>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                      <i class="fas fa-map-marker-alt text-secondary me-2 fs-5"></i>
                      <span class="text-dark">Cra. 20a # 14-54, Pasto, Nariño</span>
                    </div>

                    <div class="d-flex align-items-center mb-2">
                      <i class="fas fa-envelope text-secondary me-2 fs-5"></i>
                      <span class="text-dark">emprendeya.soporte@gmail.com</span>
                    </div>

                    <div class="d-flex align-items-center mb-2">
                      <i class="fas fa-phone text-secondary me-2 fs-5"></i>
                      <span class="text-dark">+57 321 9118 593</span>
                    </div>

                    <div class="d-flex mt-4">
                      <a class="btn btn-icon btn-round btn-secondary me-2" href="#"><i class="fab fa-twitter"></i></a>
                      <a class="btn btn-icon btn-round btn-secondary me-2" href="#"><i
                          class="fab fa-facebook-f"></i></a>
                      <a class="btn btn-icon btn-round btn-secondary me-2" href="#"><i class="fab fa-whatsapp"></i></a>
                      <a class="btn btn-icon btn-round btn-secondary" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                      <h3 class="text-dark mb-0">Enlaces Rápidos</h3>
                    </div>
                    <div class="d-flex flex-column justify-content-start gap-2">
                      <a href="#" class="btn btn-secondary btn-label text-start menu-link" data-page="home">
                        <i class="fas fa-home label-btn-icon me-2"></i>Inicio
                      </a>
                      <a href="#" class="btn btn-secondary btn-label text-start menu-link" data-page="secop-2">
                        <i class="fas fa-laptop label-btn-icon me-2"></i>Secop-II
                      </a>
                      <a href="#" class="btn btn-secondary btn-label text-start menu-link" data-page="about">
                        <i class="fas fa-info-circle label-btn-icon me-2"></i>Acerca de
                      </a>

                      <a class="btn btn-secondary btn-label text-start menu-link" href="#">
                        <i class="fas fa-concierge-bell label-btn-icon me-2"></i>Servicios
                      </a>
                      <a class="btn btn-secondary btn-label text-start menu-link" href="#">
                        <i class="fas fa-blog label-btn-icon me-2"></i>Blog
                      </a>
                      <a class="btn btn-secondary btn-label text-start menu-link" href="#">
                        <i class="fas fa-envelope label-btn-icon me-2"></i>Contactos
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                      <h3 class="text-dark mb-0">Enlaces Populares</h3>
                    </div>
                    <div class="d-flex flex-column justify-content-start gap-2">
                      <a class="btn btn-secondary btn-label text-start menu-link" data-page="home" href="#">
                        <i class="fas fa-home label-btn-icon me-2"></i>Inicio
                      </a>
                      <a class="btn btn-secondary btn-label text-start menu-link" data-page="secop-2" href="#">
                        <i class="fas fa-laptop label-btn-icon me-2"></i>Secop-II
                      </a>
                      <a class="btn btn-secondary btn-label text-start menu-link" data-page="about" href="#">
                        <i class="fas fa-info-circle label-btn-icon me-2"></i>Acerca de
                      </a>
                      <a class="btn btn-secondary btn-label text-start" href="#">
                        <i class="fas fa-concierge-bell label-btn-icon me-2"></i>Servicios
                      </a>

                      <a class="btn btn-secondary btn-label text-start" href="#">
                        <i class="fas fa-envelope label-btn-icon me-2"></i>Contactos
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer inferior -->
        <div class="container-fluid d-flex justify-content-between align-items-center py-3 border-top border-secondary">
          <nav class="pull-left">
            <ul class="nav mb-0">
              <li class="nav-item">
                <a class="nav-link text-dark" href="http://www.emprendeya.com">EmprendeYA</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#">Ayuda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="#">Licencias</a>
              </li>
            </ul>
          </nav>
          <div class="copyright text-dark">
            2025, hecho con <i class="fa fa-heart heart text-danger"></i> por
            <a href="https://www.emprendeya.com" class="text-primary">EmprendeYA</a>
          </div>
        </div>
      </footer>
    </div>

    <div class="custom-template">
      <div class="title">Configuración</div>
      <div class="custom-content">
        <div class="switcher">
          <div class="switch-block">
            <h4>Logo Cabecera</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
              <br />
              <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Barra de Navegación</h4>
            <div class="btnSwitch">
              <button type="button" class="changeTopBarColor" data-color="dark"></button>

              <button type="button" class="selected changeTopBarColor" data-color="white"></button>
              <br />
              <button type="button" class="changeTopBarColor" data-color="dark2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Barra Lateral</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
              <button type="button" class="changeSideBarColor" data-color="dark2"></button>
            </div>
          </div>
        </div>
      </div>
      <div class="custom-toggle">
        <i class="icon-settings"></i>
      </div>
    </div>

    <!-- End Custom template -->
  </div>


  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Moment JS (Requerido por Bootstrap DateTimePicker y potencialmente otros plugins) -->
  <script src="assets/js/plugin/moment/moment.min.js"></script>
  

  <!-- Bootstrap DateTimePicker (DESPUÉS de jQuery y Moment) -->
  <!-- Asegúrate que el archivo CSS para datetimepicker esté incluido en plugins.css o separado en el <head> -->
  <script src="assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>
  <!-- Owl Carousel -->
  <script src="assets/js/plugin/owl-carousel/owl.carousel.min.js"></script>
  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>
  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>
  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>
  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
  <!-- Supabase (Cargado una sola vez) -->
  <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
  <!-- Lottie Player (Cargado una sola vez) -->
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <script src="assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Scripts del Tema EmprendeYa/Kaiadmin (DESPUÉS de todos los plugins) -->
  <script src="assets/js/emprendeya-2.js"></script> <!-- O kaiadmin.min.js -->
  <script src="assets/js/setting-emprendeya.js"></script> <!-- O settings.js del tema -->
  <!-- <script src="assets/js/emprendeya.js"></script> --> <!-- Si es diferente y necesario -->


  <!-- Script para cargar dinámicamente el contenido @renderbody -->
  <!-- Script para cargar dinámicamente el contenido @renderbody -->
  <script>
    let paginaActualCargada = null; // Para evitar recargar la misma página
    let parametrosPaginaActual = null; // Para comparar si los parámetros también son los mismos

    function ejecutarScriptsEn(elementoPadre) {
      const scripts = elementoPadre.querySelectorAll("script");
      scripts.forEach((scriptViejo) => {
        const scriptNuevo = document.createElement("script");
        Array.from(scriptViejo.attributes).forEach(attr => scriptNuevo.setAttribute(attr.name, attr.value));

        if (scriptViejo.src) {
          scriptNuevo.src = scriptViejo.src;
          scriptNuevo.onload = () => console.log("Script externo (interno al HTML) cargado:", scriptViejo.src);
          scriptNuevo.onerror = () => console.error("Error cargando script externo (interno al HTML):", scriptViejo.src);
        } else {
          scriptNuevo.textContent = scriptViejo.textContent;
        }

        scriptViejo.parentNode.replaceChild(scriptNuevo, scriptViejo);
        if (!scriptViejo.src) console.log("Script inline (interno al HTML) ejecutado/re-evaluado.");
      });
    }

    function reinicializarComponentesGlobalesUI(contextoElemento) {
      console.log("(Re)inicializando componentes globales UI en:", contextoElemento);
      // Tooltips
      const tooltipTriggerList = [].slice.call(contextoElemento.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.map(function(tooltipTriggerEl) {
        if (!bootstrap.Tooltip.getInstance(tooltipTriggerEl)) {
          console.log("Inicializando tooltip para:", tooltipTriggerEl);
          return new bootstrap.Tooltip(tooltipTriggerEl);
        }
        return bootstrap.Tooltip.getInstance(tooltipTriggerEl);
      });
      // Popovers
      const popoverTriggerList = [].slice.call(contextoElemento.querySelectorAll('[data-bs-toggle="popover"]'));
      popoverTriggerList.map(function(popoverTriggerEl) {
        if (!bootstrap.Popover.getInstance(popoverTriggerEl)) {
          return new bootstrap.Popover(popoverTriggerEl);
        }
        return bootstrap.Popover.getInstance(popoverTriggerEl);
      });
      // jQuery Scrollbar
      if (typeof $.fn.scrollbar === 'function') {
        $(contextoElemento).find('.scrollbar-inner').not('.scroll-wrapper').scrollbar();
        console.log("Scrollbars (re)inicializados si es necesario.");
      } else {
        console.warn("jQuery Scrollbar no está disponible ($.fn.scrollbar no es una función).");
      }
      console.log("Componentes globales UI (re)inicializados.");
    }

    function cargarContenido(rutaPaginaCompleta) { // ej: "public-profile&user_id_view=123" o "home"
      console.log(`INDEX.PHP: Solicitando carga de contenido para: ${rutaPaginaCompleta}`);

      let baseRuta = rutaPaginaCompleta;
      let queryString = "";

      // Separar la ruta base de los parámetros
      // Buscamos el primer '&' o '?' para separar la ruta base de los parámetros
      const separadorParamsIndex = rutaPaginaCompleta.search(/[?&]/);


      if (separadorParamsIndex !== -1) {
        baseRuta = rutaPaginaCompleta.substring(0, separadorParamsIndex);
        queryString = rutaPaginaCompleta.substring(separadorParamsIndex + 1); // user_id_view=123
        // Si el separador era '?', lo mantenemos, si era '&', lo cambiamos por '?' para la URL
        if (rutaPaginaCompleta[separadorParamsIndex] === '&') {
          queryString = `?${queryString}`;
        } else {
          queryString = `?${queryString}`; // Ya incluye el '?'
        }
      } else {
        // No hay parámetros, baseRuta es la ruta completa
        baseRuta = rutaPaginaCompleta;
        queryString = ""; // No hay query string
      }

      // Comprobamos si la página y sus parámetros ya están cargados
      if (paginaActualCargada === baseRuta && parametrosPaginaActual === queryString) {
        console.log(`INDEX.PHP: La página ${baseRuta} con parámetros '${queryString}' ya está cargada. No se recarga.`);
        window.scrollTo(0, 0);
        return;
      }

      const renderTarget = document.getElementById("render-body");
      if (!renderTarget) {
        console.error("INDEX.PHP: Elemento #render-body no encontrado. No se puede cargar contenido.");
        return;
      }

      renderTarget.innerHTML = '<div class="d-flex justify-content-center align-items-center" style="min-height: 300px;"><div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Cargando...</span></div></div>';

      // Construir la URL final para el fetch
      const fetchUrl = `${baseRuta}.php${queryString}`;
      console.log("INDEX.PHP: Fetch URL construida:", fetchUrl);

      fetch(fetchUrl)
        .then((response) => {
          if (!response.ok) {
            // Crear un error personalizado que incluya el status
            const error = new Error(`Error HTTP ${response.status} al cargar ${fetchUrl}`);
            error.status = response.status; // Adjuntar el status al objeto de error
            throw error; // Lanzar el error para que sea capturado por .catch()
          }
          return response.text();
        })
        .then((html) => {
          renderTarget.innerHTML = html;
          paginaActualCargada = baseRuta; // Guardar la ruta base
          parametrosPaginaActual = queryString; // Guardar los parámetros

          ejecutarScriptsEn(renderTarget);
          reinicializarComponentesGlobalesUI(renderTarget);

          if (typeof window.inicializarPaginaActual === 'function') {
            console.log(`INDEX.PHP: Llamando a window.inicializarPaginaActual() para ${baseRuta}`);
            try {
              window.inicializarPaginaActual();
            } catch (e) {
              console.error(`INDEX.PHP: Error al ejecutar inicializarPaginaActual() para ${baseRuta}:`, e);
            }
          } else {
            console.log(`INDEX.PHP: No se encontró window.inicializarPaginaActual() para ${baseRuta}.`);
          }

          window.scrollTo(0, 0);
          console.log(`INDEX.PHP: Carga de contenido para ${fetchUrl} completada.`);
        })
        .catch((error) => {
          console.error("INDEX.PHP: Error detallado al cargar contenido:", error);

          let errorTitle = "Oops! Algo salió mal.";
          // Asegúrate de que baseRuta esté disponible en este scope, si no, usa fetchUrl o un mensaje genérico.
          // Si baseRuta puede ser undefined aquí, considera cómo obtener el nombre del archivo.
          const requestedFile = baseRuta ? `<code>${baseRuta}.php</code>` : `la página solicitada`;
          let errorCategory = `No se pudo cargar: ${requestedFile}`;

          // Personaliza el mensaje si es un error 404
          if (error.status === 404) {
            errorTitle = "Error 404: Página no encontrada";
            errorCategory = `El recurso ${requestedFile} no se pudo encontrar. Asegúrate de que la URL es correcta y el archivo existe.`;
          } else if (error.status) {
            // Para otros errores HTTP con status conocido
            errorTitle = `Error ${error.status}`;
          }
          // Si error.status no está definido (p.ej., error de red), se usarán los mensajes genéricos de arriba.

          renderTarget.innerHTML = `
            <div class="page-inner mt--5">
                <div class="row mt--2">
                    <div class="col-md-12">
                        <div class="card full-height">
                            <div class="card-body text-center">
                                <!-- Animación Lottie -->
                                <div class="mx-auto mb-4" style="max-width: 400px;">
                                    <lottie-player
                                        src="assets/img/lottie/404.json" 
                                        background="transparent"
                                        speed="1"
                                        loop
                                        autoplay>
                                    </lottie-player>
                                </div>
                                <!-- Fin Animación Lottie -->

                                <div class="card-title h2 text-danger">${errorTitle}</div>
                                <div class="card-category">${errorCategory}</div>
                                <p class="mt-3"><strong>Detalle:</strong> ${error.message}</p>
                                <a href="index.php" class="btn btn-primary btn-round mt-3">Volver al Inicio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
          paginaActualCargada = null;
          parametrosPaginaActual = null;
        });

      // Este div es donde se renderizará el contenido o el error.
      // Asegúrate de que existe en tu HTML, por ejemplo: <div id="content-render-target"></div>
      // const renderTarget = document.getElementById('content-render-target'); // Ejemplo

      // Variables que tu código parece usar, asegúrate de que estén definidas.
      // let paginaActualCargada = null;
      // let parametrosPaginaActual = null;
      // let baseRuta = 'alguna/ruta/base'; // Ejemplo
      // let queryString = '?param=valor'; // Ejemplo
      // let fetchUrl = 'ruta/a/cargar.php'; // Ejemplo
      // const renderTarget = document.body; // O el elemento específico donde cargas el contenido

      // Funciones placeholder que tu código podría estar usando:
      // function ejecutarScriptsEn(elemento) { console.log("Ejecutando scripts en", elemento); }
      // function reinicializarComponentesGlobalesUI(elemento) { console.log("Reinicializando UI en", elemento); }
    }

    document.addEventListener("DOMContentLoaded", function() {
      console.log("INDEX.PHP: DOM completamente cargado y parseado.");
      reinicializarComponentesGlobalesUI(document.body);

      // Obtener la página de la URL (puede incluir parámetros)
      const params = new URLSearchParams(window.location.search);
      let paginaInicial = params.get("page") || "home"; // "home" o "public-profile&user_id_view=123"

      // Si 'page' tiene parámetros, necesitamos mantenerlos.
      // URLSearchParams ya nos da el valor completo de 'page'.
      // Ejemplo: si la URL es ?page=public-profile&user_id_view=123
      // params.get("page") devolverá "public-profile" si 'user_id_view' es otro param.
      // Si queremos que ?page=micontenido&id=123 sea interpretado, page debe ser "micontenido&id=123"
      // El enfoque actual de que data-page="public-profile&user_id_view=123" es mejor.

      // Para la carga inicial, si la URL es index.php?page=public-profile&user_id_view=123,
      // params.get("page") solo nos dará "public-profile". Necesitamos reconstruir
      // la cadena de query si hay más parámetros relevantes para la página.
      // Sin embargo, la lógica actual de history.pushState y popstate usa el valor completo de data-page.

      // Simplificación: Asumimos que la lógica de data-page="ruta¶m=valor" es la principal.
      // Para la carga inicial desde la URL, si es ?page=nombrepagina¶m1=valor1,
      // la función cargarContenido lo parseará correctamente si le pasamos el string completo.
      let paginaInicialCompleta = paginaInicial; // Por defecto, el valor de 'page'

      // Si hay otros parámetros en la URL que no son 'page' y que queremos pasar a la página inicial
      // (esto es más complejo y depende de cómo quieras que funcione tu enrutamiento inicial)
      // Por ahora, nos enfocamos en que el valor de "page" pueda ser "ruta¶ms"

      // Ejemplo: si la URL es index.php?page=public-profile&user_id_view=789
      // params.get("page") solo es "public-profile"
      // Tendrías que reconstruir el string de query si es necesario para la carga INICIAL.
      // Pero para la navegación con data-page="public-profile&user_id_view=789" ya funciona.

      // Para la carga inicial, si la URL es ?page=public-profile&user_id_view=123
      // params.get("page") devolverá "public-profile".
      // Necesitamos reconstruir si 'user_id_view' es un parámetro separado en la URL inicial.
      // Si la URL es ?page=public-profile&user_id_view=123
      // params.get("page") es 'public-profile'
      // params.get("user_id_view") es '123'

      // Reconstruir la cadena de 'data-page' para la carga inicial si es necesario:
      let paginaParaCargar = params.get("page") || "home";
      let parametrosAdicionales = [];
      for (const [key, value] of params.entries()) {
        if (key !== "page") {
          parametrosAdicionales.push(`${key}=${value}`);
        }
      }
      if (parametrosAdicionales.length > 0) {
        paginaParaCargar += (paginaParaCargar.includes('&') || paginaParaCargar.includes('?') ? '&' : (paginaParaCargar.includes('?') ? '' : (baseRuta.includes('/') ? '&' : '?'))) + parametrosAdicionales.join('&');
        // Esta lógica de concatenación de '&' vs '?' puede ser compleja.
        // Simplificamos asumiendo que page puede ser "public-profile" y los otros params son adicionales.
        // Si page ya es "public-profile&id=x", entonces params.get("page") es solo "public-profile" si hay un & en la URL original
        // Lo más robusto es que data-page contenga todo.
      }
      // La forma más simple y robusta para la carga inicial basada en la URL es:
      // 1. Obtener el valor del parámetro 'page' (ej. 'public-profile')
      // 2. Reconstruir el resto del query string de la URL actual.
      // Esto asume que tu PHP (public-profile.php) leerá de $_GET.

      let url = new URL(window.location.href);
      let paginaDeUrl = url.searchParams.get("page") || "home";
      let queryParamsIniciales = [];
      url.searchParams.forEach((value, key) => {
        if (key !== "page") {
          queryParamsIniciales.push(`${encodeURIComponent(key)}=${encodeURIComponent(value)}`);
        }
      });

      let cadenaRutaInicial = paginaDeUrl;
      if (queryParamsIniciales.length > 0) {
        // Determinar si la páginaDeUrl ya es un path o solo un nombre de archivo
        if (paginaDeUrl.includes('/')) { // Es probable un path, añadir ?
          cadenaRutaInicial += "?" + queryParamsIniciales.join("&");
        } else { // Es un nombre de archivo, añadir & si ya hay params o ? si no.
          // Esto es lo que estamos tratando de simplificar.
          // La clave es que `data-page` contenga todo.
          // Para la URL inicial, `paginaDeUrl` es el nombre base.
          cadenaRutaInicial += (cadenaRutaInicial.includes('?') ? '&' : '?') + queryParamsIniciales.join("&");
          // REVISAR: Si la paginaDeUrl es "public-profile" y los params son "user_id_view=123"
          // debería ser "public-profile&user_id_view=123" para que nuestro parser funcione.
          // El `&` vs `?` inicial es el truco.
          // Si el primer parámetro se une con '&' y no con '?', el parseo de `cargarContenido` lo tomará como parte de la ruta base.
          // La lógica de `data-page` es más controlada.
          // Para la URL, si es `index.php?page=public-profile&user_id_view=123`,
          // entonces `paginaDeUrl` es `public-profile`.
          // `queryParamsIniciales` es `['user_id_view=123']`.
          // Necesitamos que `cadenaRutaInicial` sea `public-profile&user_id_view=123`
          // para que `cargarContenido` lo procese bien.
          cadenaRutaInicial = paginaDeUrl + (queryParamsIniciales.length > 0 ? "&" + queryParamsIniciales.join("&") : "");

        }
      }


      console.log("INDEX.PHP: Cargando página inicial (construida desde URL):", cadenaRutaInicial);
      cargarContenido(cadenaRutaInicial);

      document.body.addEventListener("click", function(e) {
        const linkElement = e.target.closest(".menu-link[data-page]");
        if (linkElement) {
          e.preventDefault();
          const rutaCompletaAttr = linkElement.getAttribute("data-page"); // ej: "public-profile&user_id_view=123"
          if (rutaCompletaAttr && rutaCompletaAttr.trim() !== "" && rutaCompletaAttr.trim() !== "#") {
            console.log("INDEX.PHP: Clic en menu-link, cargando ruta desde data-page:", rutaCompletaAttr);
            cargarContenido(rutaCompletaAttr);

            // Actualizar URL para reflejar la página y sus parámetros específicos
            // Necesitamos separar la ruta base de los parámetros para construir bien el query string
            let nuevaRutaBase = rutaCompletaAttr;
            let nuevosQueryParams = new URLSearchParams(); // Usar URLSearchParams para construir bien

            const primerSeparador = rutaCompletaAttr.indexOf('&'); // O '?'
            if (primerSeparador !== -1) {
              nuevaRutaBase = rutaCompletaAttr.substring(0, primerSeparador);
              const paramsStr = rutaCompletaAttr.substring(primerSeparador + 1);
              // Parsear los parámetros manualmente si vienen como "key1=val1&key2=val2"
              const paramsArray = paramsStr.split('&');
              paramsArray.forEach(param => {
                const [key, value] = param.split('=');
                if (key && value !== undefined) {
                  nuevosQueryParams.set(key, value);
                }
              });
            }

            const nuevaUrlObj = new URL(window.location.origin + window.location.pathname); // URL base sin query
            nuevaUrlObj.searchParams.set('page', nuevaRutaBase);
            nuevosQueryParams.forEach((value, key) => {
              nuevaUrlObj.searchParams.set(key, value);
            });

            history.pushState({
              page: rutaCompletaAttr
            }, "", nuevaUrlObj.toString());

          } else {
            console.warn("INDEX.PHP: Clic en menu-link sin data-page válido o con '#':", linkElement);
          }
        }
      });

      window.addEventListener('popstate', function(event) {
        let paginaAHistorial = "home"; // Default
        if (event.state && event.state.page) {
          paginaAHistorial = event.state.page; // Esto ya debería tener la ruta completa con params
        } else {
          // Reconstruir desde la URL actual si no hay estado (caso borde)
          const urlPop = new URL(window.location.href);
          let paginaBasePop = urlPop.searchParams.get("page") || "home";
          let paramsPop = [];
          urlPop.searchParams.forEach((value, key) => {
            if (key !== "page") {
              paramsPop.push(`${key}=${value}`);
            }
          });
          paginaAHistorial = paginaBasePop + (paramsPop.length > 0 ? "&" + paramsPop.join("&") : "");
        }
        console.log("INDEX.PHP: Evento popstate, cargando página:", paginaAHistorial);
        cargarContenido(paginaAHistorial);
      });
    });

    function cargarModal(event) {
      event.preventDefault();
      console.log("Función cargarModal llamada.");
    }
  </script>
</body>

</html>