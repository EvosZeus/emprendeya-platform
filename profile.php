<?php
// ---------------------------------------------------------------------
// BLOQUE DE INICIO, VERIFICACIÓN DE SESIÓN Y RECUPERACIÓN DE DATOS DEL USUARIO (DESDE SESIÓN)
// ---------------------------------------------------------------------

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: landing.html');
    exit;
}

// Leer directamente de $_SESSION lo que login.php guardó
$sesion_user_id = $_SESSION['user_id'];
$sesion_nombre_completo = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') : 'N/A';
$sesion_email_usuario = isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email'], ENT_QUOTES, 'UTF-8') : 'N/A';
$sesion_rol_usuario = isset($_SESSION['user_role']) ? htmlspecialchars($_SESSION['user_role'], ENT_QUOTES, 'UTF-8') : 'N/A';

$sesion_foto_perfil_url = isset($_SESSION['user_photo_url']) && !empty(trim($_SESSION['user_photo_url']))
    ? htmlspecialchars(trim($_SESSION['user_photo_url']), ENT_QUOTES, 'UTF-8')
    : 'assets/img/profile.jpg'; // TU DEFAULT

$sesion_foto_portada_url = isset($_SESSION['user_cover_photo_url']) && !empty(trim($_SESSION['user_cover_photo_url']))
    ? htmlspecialchars(trim($_SESSION['user_cover_photo_url']), ENT_QUOTES, 'UTF-8')
    : 'assets/img/emprendeya/portada.jpg'; // TU DEFAULT

$sesion_genero_usuario = isset($_SESSION['user_gender']) ? htmlspecialchars($_SESSION['user_gender'], ENT_QUOTES, 'UTF-8') : '';
$sesion_telefono_usuario = isset($_SESSION['user_phone']) && !empty(trim($_SESSION['user_phone'])) ? htmlspecialchars($_SESSION['user_phone'], ENT_QUOTES, 'UTF-8') : '';
$sesion_municipio_usuario = isset($_SESSION['user_municipality']) && !empty(trim($_SESSION['user_municipality'])) ? htmlspecialchars($_SESSION['user_municipality'], ENT_QUOTES, 'UTF-8') : '';

$descripcion_para_formulario = isset($_SESSION['user_description']) ? $_SESSION['user_description'] : '';
$descripcion_para_resumen = !empty(trim($descripcion_para_formulario))
    ? nl2br(htmlspecialchars($descripcion_para_formulario, ENT_QUOTES, 'UTF-8'))
    : '<em>Aún no has añadido una descripción.</em>';

$sesion_acepta_terminos = isset($_SESSION['user_terms_accepted']) ? (bool)$_SESSION['user_terms_accepted'] : false;
$sesion_cuenta_verificada = isset($_SESSION['user_account_verified']) ? (bool)$_SESSION['user_account_verified'] : false;

$sesion_fecha_nacimiento_db = isset($_SESSION['user_birth_date']) && !empty($_SESSION['user_birth_date']) ? $_SESSION['user_birth_date'] : '';
$sesion_fecha_registro_db = isset($_SESSION['user_registration_date']) ? $_SESSION['user_registration_date'] : '';

$fecha_nacimiento_formateada = !empty($sesion_fecha_nacimiento_db) ? date("d \d\e F \d\e Y", strtotime($sesion_fecha_nacimiento_db)) : '<em>No proporcionada</em>';
$fecha_registro_formateada = !empty($sesion_fecha_registro_db) ? date("d \d\e F \d\e Y", strtotime($sesion_fecha_registro_db)) : '<em>N/A</em>';

$municipios_lista = [
    "Alban",
    "Aldana",
    "Ancuya",
    "Arboleda",
    "Barbacoas",
    "Belen",
    "Buesaco",
    "Colon",
    "Consaca",
    "Contadero",
    "Cordoba",
    "Cuaspud",
    "Cumbal",
    "Cumbitara",
    "Chachagui",
    "ElCharco",
    "ElPenol",
    "ElRosario",
    "ElTablon",
    "ElTambo",
    "FranciscoPizarro",
    "Funes",
    "Guachucal",
    "Guaitarilla",
    "Gualmatan",
    "Iles",
    "Imues",
    "Ipiales",
    "LaCruz",
    "LaFlorida",
    "LaLlanada",
    "LaTola",
    "LaUnion",
    "Leiva",
    "Linares",
    "LosAndes",
    "MaguiPayan",
    "Mallama",
    "Mosquera",
    "Narino",
    "OlayaHerrera",
    "Ospina",
    "Pasto",
    "Policarpa",
    "Potosi",
    "Providencia",
    "Puerres",
    "Pupiales",
    "Ricaurte",
    "RobertoPayan",
    "Samaniego",
    "SanBernardo",
    "SanLorenzo",
    "SanPablo",
    "SanPedroDeCartago",
    "Sandona",
    "SantaBarbara",
    "Santacruz",
    "Sapuyes",
    "Taminango",
    "Tangua",
    "Tumaco",
    "Tuquerres",
    "Yacuanquer"
];
// ---------------------------------------------------------------------
// FIN DEL BLOQUE DE SESIÓN
// ---------------------------------------------------------------------
?>

<script>
    WebFont.load({
        google: {
            "families": ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
            urls: ['assets/css/fonts.min.css']
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>

<style>
    #emprendeyaemprendeyaProfilePage {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    #emprendeyaemprendeyaProfilePage .card-header.profile-cover-card-header {
        height: 200px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    #emprendeyaemprendeyaProfilePage .profile-main-info-container {
        padding: 20px;
        text-align: center;
    }

    #emprendeyaemprendeyaProfilePage .profile-avatar-wrapper {
        margin-top: -100px;
        margin-bottom: 15px;
        position: relative;
        z-index: 10;
    }

    #emprendeyaemprendeyaProfilePage .profile-avatar-container {
        display: inline-block;
        position: relative;
    }

    #emprendeyaemprendeyaProfilePage .profile-avatar-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #FFFFFF;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    #emprendeyaemprendeyaProfilePage .btn-edit-avatar {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: rgba(255, 255, 255, 0.9);
        border: none;
        color: #555;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        transition: all 0.2s;
    }

    #emprendeyaemprendeyaProfilePage .btn-edit-avatar:hover {
        background-color: #fff;
        color: #007bff;
    }

    #emprendeyaemprendeyaProfilePage .user-profile-details {
        margin-bottom: 20px;
    }

    #emprendeyaemprendeyaProfilePage .profile-name {
        font-size: 1.75rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    #emprendeyaemprendeyaProfilePage .profile-job {
        font-size: 1rem;
        color: #666;
        margin-bottom: 5px;
    }

    #emprendeyaemprendeyaProfilePage .profile-location {
        font-size: 0.9rem;
        color: #888;
    }

    #emprendeyaemprendeyaProfilePage .user-stats-row {
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 15px 0;
        margin: 0 auto 20px;
        max-width: 500px;
    }

    #emprendeyaemprendeyaProfilePage .user-stats-row .number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
    }

    #emprendeyaemprendeyaProfilePage .user-stats-row .title {
        font-size: 0.85rem;
        color: #777;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #emprendeyaemprendeyaProfilePage .btn-primary.btn-round {
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s;
    }

    #emprendeyaemprendeyaProfilePage .btn-primary.btn-round:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }
</style>


<div class="container">
    <div class="page-inner">

        <div class="card card-profile" id="emprendeyaemprendeyaProfilePage">
            <div class="card-header profile-cover-card-header"
                style="background-image: url('<?php echo $sesion_foto_portada_url; ?>');">

            </div>

            <div class="profile-main-info-container">
                <div class="profile-avatar-wrapper">
                    <div class="profile-avatar-container">
                        <img src="<?php echo $sesion_foto_perfil_url; ?>"
                            alt="Foto de perfil de <?php echo $sesion_nombre_completo; ?>"
                            class="avatar-img rounded-circle profile-avatar-img">
                        <button class="btn btn-icon btn-round btn-light btn-sm btn-edit-avatar"
                            data-bs-toggle="modal" data-bs-target="#changeProfilePicModalemprendeya"
                            title="Cambiar foto de perfil">
                            <i class="fa fa-camera"></i>
                        </button>
                    </div>
                </div>

                <div class="user-profile-details text-center">
                    <div class="profile-name">
                        <?php echo $sesion_nombre_completo; ?>
                        <?php if ($sesion_cuenta_verificada): ?>
                            <i class="fas fa-check-circle text-primary" data-bs-toggle="tooltip"
                                title="Cuenta Verificada"></i>
                        <?php endif; ?>
                    </div>
                    <div class="profile-job">
                        <?php echo $sesion_rol_usuario; ?>
                    </div>
                    <div class="profile-location">
                        <i class="fas fa-map-marker-alt fa-sm me-1"></i>
                        <?php echo !empty($sesion_municipio_usuario) ? $sesion_municipio_usuario . ', Nariño' : 'Ubicación no definida'; ?>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="user-profile text-center">
                    <div class="row user-stats-row justify-content-center mb-4">
                        <div class="col text-center">
                            <div class="number">12</div>
                            <div class="title">Proyectos</div>
                        </div>
                        <div class="col text-center">
                            <div class="number">150</div>
                            <div class="title">Conexiones</div>
                        </div>
                        <div class="col text-center">
                            <div class="number">8</div>
                            <div class="title">Inversiones</div>
                        </div>
                    </div>

                    <div class="view-profile">
                        <button class="btn btn-primary btn-round"
                            onclick="activateTabAndFocusemprendeya('emprendeya-pills-edit-profile-tab', 'editFullNameemprendeya')">
                            <i class="fas fa-user-edit me-1"></i> Editar Perfil
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="emprendeya-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="emprendeya-pills-overview-tab" data-bs-toggle="pill"
                                    href="#emprendeya-pills-overview" role="tab" aria-controls="emprendeya-pills-overview"
                                    aria-selected="true"><i class="fas fa-user-alt me-1"></i>Resumen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="emprendeya-pills-edit-profile-tab" data-bs-toggle="pill"
                                    href="#emprendeya-pills-edit-profile" role="tab"
                                    aria-controls="emprendeya-pills-edit-profile" aria-selected="false"><i
                                        class="fas fa-edit me-1"></i>Editar Información</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="emprendeya-pills-change-password-tab" data-bs-toggle="pill"
                                    href="#emprendeya-pills-change-password" role="tab"
                                    aria-controls="emprendeya-pills-change-password" aria-selected="false"><i
                                        class="fas fa-key me-1"></i>Contraseña</a>
                            </li>
                            <?php if ($sesion_rol_usuario === 'Emprendedor'): ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="emprendeya-pills-projects-tab" data-bs-toggle="pill"
                                        href="#emprendeya-pills-projects" role="tab" aria-controls="emprendeya-pills-projects"
                                        aria-selected="false"><i class="fas fa-project-diagram me-1"></i>Mis Proyectos</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" id="emprendeya-pills-settings-tab" data-bs-toggle="pill"
                                    href="#emprendeya-pills-settings" role="tab" aria-controls="emprendeya-pills-settings"
                                    aria-selected="false"><i class="fas fa-cog me-1"></i>Configuración</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content mt-2 mb-3" id="emprendeya-pills-tabContent">
                            <div class="tab-pane fade show active" id="emprendeya-pills-overview" role="tabpanel"
                                aria-labelledby="emprendeya-pills-overview-tab">
                                <h4 class="card-title mb-3">Sobre
                                    <?php echo (explode(" ", $sesion_nombre_completo)[0]); ?>
                                </h4>
                                <p class="card-text">
                                    <?php echo $descripcion_para_resumen;  ?>
                                </p>
                                <hr>
                                <h5 class="card-title mt-4 mb-3">Detalles</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Email:</strong> <?php echo $sesion_email_usuario; ?></p>
                                        <p><strong>Teléfono:</strong> <?php echo !empty($sesion_telefono_usuario) ? $sesion_telefono_usuario : '<em>No proporcionado</em>'; ?></p>
                                        <p><strong>Género:</strong> <?php echo !empty($sesion_genero_usuario) ? $sesion_genero_usuario : '<em>No especificado</em>'; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Fecha de Nacimiento:</strong> <?php echo !empty($sesion_fecha_nacimiento_db) ? date("d/m/Y", strtotime($sesion_fecha_nacimiento_db)) : '<em>No proporcionada</em>'; ?></p>
                                        <p><strong>Miembro desde:</strong> <?php echo !empty($sesion_fecha_registro_db) ? date("d/m/Y", strtotime($sesion_fecha_registro_db)) : '<em>N/A</em>'; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="emprendeya-pills-edit-profile" role="tabpanel"
                                aria-labelledby="emprendeya-pills-edit-profile-tab">
                                <h4 class="card-title mb-3">Actualizar Información Personal</h4>
                                <form id="editProfileFormemprendeya" class="needs-validation" novalidate>
                                    <div class="form-group form-show-validation row">
                                        <label for="editFullNameemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Nombre Completo <span class="required-label">*</span></label>
                                        <div class="col-lg-6 col-md-9 col-sm-8">
                                            <input type="text" class="form-control" id="editFullNameemprendeya" name="fullName" value="<?php echo $sesion_nombre_completo; ?>" required>
                                            <div class="invalid-feedback">Ingresa tu nombre completo.</div>
                                        </div>
                                    </div>
                                    <div class="form-group form-show-validation row">
                                        <label for="editEmailemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Correo Electrónico <span class="required-label">*</span></label>
                                        <div class="col-lg-6 col-md-9 col-sm-8">
                                            <input type="email" class="form-control" id="editEmailemprendeya" name="email" value="<?php echo $sesion_email_usuario; ?>" required>
                                            <div class="invalid-feedback">Ingresa un correo válido.</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="editPhoneemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Teléfono</label>
                                        <div class="col-lg-6 col-md-9 col-sm-8">
                                            <input type="tel" class="form-control" id="editPhoneemprendeya" name="phone" value="<?php echo $sesion_telefono_usuario; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="editBirthDateemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Fecha de Nacimiento</label>
                                        <div class="col-lg-6 col-md-9 col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="editBirthDateemprendeya" name="birthDate" placeholder="MM/DD/YYYY" value="<?php echo !empty($sesion_fecha_nacimiento_db) ? date("m/d/Y", strtotime($sesion_fecha_nacimiento_db)) : ''; ?>">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="editGenderemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Género</label>
                                        <div class="col-lg-6 col-md-9 col-sm-8">
                                            <select class="form-control" id="editGenderemprendeya" name="gender">
                                                <option value="" <?php echo empty($sesion_genero_usuario) ? 'selected' : ''; ?>>Seleccionar...</option>
                                                <option value="Masculino" <?php echo ($sesion_genero_usuario == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                                <option value="Femenino" <?php echo ($sesion_genero_usuario == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                                                <option value="Otro" <?php echo ($sesion_genero_usuario == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                                                <option value="Prefiero no decirlo" <?php echo ($sesion_genero_usuario == 'Prefiero no decirlo') ? 'selected' : ''; ?>>Prefiero no decirlo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="editMunicipioemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Municipio</label>
                                        <div class="col-lg-6 col-md-9 col-sm-8">
                                            <select class="form-control" id="editMunicipioemprendeya" name="municipio">
                                                <option value="">Selecciona tu Municipio...</option>
                                                <?php
                                                foreach ($municipios_lista as $muni) {
                                                    $selected = ($sesion_municipio_usuario == $muni) ? 'selected' : '';
                                                    echo "<option value=\"" . htmlspecialchars($muni) . "\" $selected>" . htmlspecialchars($muni) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="editDescriptionemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Descripción / Bio</label>
                                        <div class="col-lg-6 col-md-9 col-sm-8"> <!-- Asegurar que el textarea esté dentro de esta columna -->
                                            <textarea class="form-control" id="editDescriptionemprendeya" name="description" rows="4"><?php echo htmlspecialchars($descripcion_para_formulario, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <div class="row">
                                            <div class="col-md-9 offset-md-3"> <!-- Ajuste para alineación con los inputs -->
                                                <button type="submit" class="btn btn-primary btn-round">Guardar Cambios</button>
                                                <button type="button" class="btn btn-outline-secondary btn-round">Cancelar</button> <!-- Usar btn-outline-secondary o similar para Cancelar -->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="emprendeya-pills-change-password" role="tabpanel"
                                aria-labelledby="emprendeya-pills-change-password-tab">
                                <h4 class="card-title mb-3">Seguridad de la Cuenta</h4>
                                <form id="changePasswordFormemprendeya" class="needs-validation" novalidate>
                                    <div class="form-group form-show-validation row">
                                        <label for="currentPasswordemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Contraseña Actual <span class="required-label">*</span></label>
                                        <div class="col-lg-6 col-md-9 col-sm-8">
                                            <input type="password" class="form-control" id="currentPasswordemprendeya" name="currentPassword" required>
                                            <div class="invalid-feedback">Ingresa tu contraseña actual.</div>
                                        </div>
                                    </div>
                                    <div class="form-group form-show-validation row">
                                        <label for="newPasswordemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Nueva Contraseña <span class="required-label">*</span></label>
                                        <div class="col-lg-6 col-md-9 col-sm-8">
                                            <input type="password" class="form-control" id="newPasswordemprendeya" name="newPassword" required minlength="8">
                                            <div class="invalid-feedback">Mínimo 8 caracteres.</div>
                                        </div>
                                    </div>
                                    <div class="form-group form-show-validation row">
                                        <label for="confirmNewPasswordemprendeya" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-end">Confirmar Nueva <span class="required-label">*</span></label>
                                        <div class="col-lg-6 col-md-9 col-sm-8">
                                            <input type="password" class="form-control" id="confirmNewPasswordemprendeya" name="confirmNewPassword" required>
                                            <div class="invalid-feedback">Las contraseñas no coinciden.</div>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <div class="row">
                                            <div class="col-md-9 offset-md-3"> <!-- Ajuste para alineación -->
                                                <button type="submit" class="btn btn-primary btn-round">Actualizar Contraseña</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <?php if ($sesion_rol_usuario === 'Emprendedor'): ?>
                                <div class="tab-pane fade" id="emprendeya-pills-projects" role="tabpanel" aria-labelledby="emprendeya-pills-projects-tab">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Mis Proyectos</h4>
                                        <a href="crear_proyecto.php" class="btn btn-primary btn-round btn-sm">
                                            <span class="btn-label"><i class="fa fa-plus"></i></span> Nuevo Proyecto
                                        </a>
                                    </div>
                                    <div class="card-category mb-3">Aquí puedes ver y gestionar tus emprendimientos.</div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card card-post card-round">
                                                <img class="card-img-top" src="assets/img/examples/example_project1.jpg" alt="Imagen Proyecto">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="avatar">
                                                            <img src="<?php echo $sesion_foto_perfil_url; ?>" alt="..." class="avatar-img rounded-circle">
                                                        </div>
                                                        <div class="info-post ms-2">
                                                            <p class="username"><?php echo $sesion_nombre_completo; ?></p>
                                                            <p class="date text-muted">Iniciado: 10 Feb 2024</p>
                                                        </div>
                                                    </div>
                                                    <div class="separator-solid"></div>
                                                    <p class="card-category text-info mb-1"><a href="#">Tecnología</a></p>
                                                    <h3 class="card-title"><a href="#">Plataforma de E-learning para Nariño</a></h3>
                                                    <p class="card-text">Desarrollo de una plataforma para ofrecer cursos online accesibles a la comunidad.</p>
                                                    <div class="mt-2">
                                                        <small class="text-muted">Progreso: 60%</small>
                                                        <div class="progress progress-sm mt-1">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="btn btn-secondary btn-sm btn-border btn-round mt-3">Ver Detalles</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="tab-pane fade" id="emprendeya-pills-settings" role="tabpanel" aria-labelledby="emprendeya-pills-settings-tab">
                                <h4 class="card-title mb-3">Configuración de la Cuenta</h4>
                                <div class="form-group">
                                    <label class="form-label">Preferencias de Notificación</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="emprendeyaEmailNews" checked>
                                        <label class="form-check-label" for="emprendeyaEmailNews">Novedades y actualizaciones de EmprendeYa.</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="emprendeyaEmailProjects" checked>
                                        <label class="form-check-label" for="emprendeyaEmailProjects">Alertas sobre mis proyectos e interacciones.</label>
                                    </div>
                                </div>
                                <div class="separator-solid my-3"></div>
                                <div class="form-group">
                                    <label class="form-label">Privacidad</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="emprendeyaProfileVisibility" checked>
                                        <label class="form-check-label" for="emprendeyaProfileVisibility">Hacer mi perfil visible para otros usuarios.</label>
                                    </div>
                                </div>
                                <div class="separator-solid my-3"></div>
                                <div class="form-group">
                                    <label class="form-label text-danger fw-bold">Zona de Peligro</label>
                                    <p class="small text-muted">Eliminar tu cuenta es una acción irreversible.</p>
                                    <button class="btn btn-danger btn-round btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModalemprendeya">Eliminar mi Cuenta</button>
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
</div>

<!-- MODALES subir foto de perfil-->
<div class="modal fade" id="changeProfilePicModalemprendeya" tabindex="-1" role="dialog" aria-labelledby="changeProfilePicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeProfilePicModalLabel">Actualizar Foto de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadProfilePicFormemprendeya" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="profilePicFileemprendeya">Selecciona una imagen (JPG, PNG - Máx 2MB)</label>
                        <input type="file" class="form-control" id="profilePicFileemprendeya" name="profilePicFile" accept="image/jpeg,image/png" required> <!-- Cambiado a form-control para mejor estilo -->
                        <div class="invalid-feedback">Por favor, selecciona un archivo de imagen.</div>
                    </div>
                    <div id="imageProfilePreviewContaineremprendeya" class="text-center mt-2" style="display:none;">
                        <img id="imageProfilePreviewemprendeya" src="#" alt="Vista previa" class="img-thumbnail" style="max-height: 200px;" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-round" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-round">Subir Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changeCoverPhotoModalemprendeya" tabindex="-1" role="dialog" aria-labelledby="changeCoverPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeCoverPhotoModalLabel">Actualizar Foto de Portada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadCoverPhotoFormemprendeya" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="coverPhotoFileemprendeya">Selecciona imagen (JPG, PNG - Máx 5MB)</label>
                        <input type="file" class="form-control" id="coverPhotoFileemprendeya" name="coverPhotoFile" accept="image/jpeg,image/png" required> <!-- Cambiado a form-control -->
                        <div class="invalid-feedback">Por favor, selecciona un archivo de imagen.</div>
                    </div>
                    <div id="imageCoverPreviewContaineremprendeya" class="text-center mt-2" style="display:none;">
                        <img id="imageCoverPreviewemprendeya" src="#" alt="Vista previa de portada" class="img-fluid rounded" style="max-height: 250px;" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-round" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-round">Subir Portada</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteAccountModalemprendeya" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel"><i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteAccountFormemprendeya" class="needs-validation" novalidate>
                <div class="modal-body">
                    <p>Estás a punto de eliminar tu cuenta permanentemente. Esta acción no se puede deshacer.</p>
                    <div class="form-group">
                        <label for="confirmDeletePasswordemprendeya">Contraseña Actual <span class="required-label">*</span></label>
                        <input type="password" class="form-control" id="confirmDeletePasswordemprendeya" name="confirmDeletePassword" required>
                        <div class="invalid-feedback">Se requiere tu contraseña.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-round" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btn-round">Sí, Eliminar Cuenta</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- ======================================================================= -->
<!-- ============ INICIO DEL CÓDIGO JAVASCRIPT PERSONALIZADO ============== -->
<!-- ======================================================================= -->
<!-- TODO EL HTML DE TU profile.php VA ANTES DE ESTE SCRIPT -->

<script>
    function inicializarPaginaActual() {
        console.log("PROFILE.PHP: inicializarPaginaActual() ejecutada.");

        function showAlert(type, title, message) {
            if (typeof swal === 'function') {
                swal({
                    icon: type,
                    title: title,
                    text: message,
                    buttons: {
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "btn btn-primary",
                            closeModal: true
                        }
                    },
                    timer: type === 'success' ? 2500 : 4000
                });
            } else {
                console.error("SweetAlert (swal) no está definido.");
                alert(`${title}: ${message}`);
            }
        }

        // Esta función es para el botón de "Editar Perfil" que te lleva a la pestaña y enfoca el input
        window.activateTabAndFocusemprendeya = function(tabId, inputId) {
            var someTabTriggerEl = document.getElementById(tabId);
            if (someTabTriggerEl) {
                var tab = new bootstrap.Tab(someTabTriggerEl);
                tab.show();
                // Esperar un poco para que la pestaña se muestre antes de enfocar
                setTimeout(function() {
                    const inputElement = document.getElementById(inputId);
                    if (inputElement) {
                        inputElement.focus();
                        console.log("PROFILE.PHP: Enfocado en input:", inputId);
                    } else {
                        console.warn("PROFILE.PHP: No se pudo enfocar, input no encontrado:", inputId);
                    }
                }, 300); // 300ms pueden ser suficientes, ajusta si es necesario
            } else {
                console.warn("PROFILE.PHP: No se pudo activar la pestaña, trigger no encontrado:", tabId);
            }
        };

        // 1. Inicializar DatePicker para el formulario de edición de perfil
        if ($('#editBirthDateemprendeya').length) {
            if (typeof $.fn.datetimepicker === 'function') {
                try {
                    $('#editBirthDateemprendeya').datetimepicker({
                        format: 'MM/DD/YYYY',
                        useCurrent: false,
                    });
                    console.log("PROFILE.PHP: DateTimePicker inicializado para #editBirthDateemprendeya.");
                } catch (e) {
                    console.error("PROFILE.PHP: Error al inicializar DateTimePicker:", e);
                }
            } else {
                console.error("PROFILE.PHP: $.fn.datetimepicker no es una función. Asegúrate que el plugin esté cargado en index.php.");
            }
        } else {
            console.log("PROFILE.PHP: Campo #editBirthDateemprendeya no encontrado para el DatePicker.");
        }

        // DENTRO de inicializarPaginaActual() en profile.php

        // 2. Formulario: Editar Información del Perfil
        if ($('#editProfileFormemprendeya').length) {
            console.log("PROFILE.PHP: Formulario #editProfileFormemprendeya ENCONTRADO.");
            $('#editProfileFormemprendeya').off('submit.editProfile').on('submit.editProfile', function(e) {
                console.log("PROFILE.PHP: SUBMIT EVENT DETECTADO para #editProfileFormemprendeya");
                e.preventDefault();
                console.log("PROFILE.PHP: Default form submission PREVENTED para editar perfil.");

                var form = this; // Guardamos la referencia al formulario
                if (form.checkValidity() === false) {
                    e.stopPropagation();
                    $(form).addClass('was-validated');
                    console.log("PROFILE.PHP: Formulario editar perfil no válido (Bootstrap).");
                    return;
                }
                $(form).removeClass('was-validated');

                var formData = new FormData(form);
                formData.append('action', 'update_profile_info');

                $.ajax({
                    url: 'backend-php/profile-actions.php', // RUTA CORRECTA
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $(form).find('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
                    },
                    complete: function() {
                        // No es estrictamente necesario re-habilitar el botón aquí si vas a recargar,
                        // pero es buena práctica por si la recarga falla o se comenta después.
                        $(form).find('button[type="submit"]').prop('disabled', false).html('Guardar Cambios');
                    },
                    success: function(response) {
                        console.log("PROFILE.PHP: Respuesta AJAX (update_profile_info):", response);
                        if (response.success) {
                            showAlert('success', '¡Éxito!', response.message);
                            // form.reset(); // Opcional: Limpiar el formulario. No es crucial si recargas.

                            // Espera un poco para que el usuario vea el mensaje de éxito
                            setTimeout(function() {
                                location.reload(); // Esto recargará la página actual
                            }, 1500); // 1.5 segundos de espera (ajusta según prefieras)

                        } else {
                            showAlert('error', 'Error', response.message || 'No se pudo actualizar la información.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("PROFILE.PHP: Error AJAX (update_profile_info):", textStatus, errorThrown, jqXHR.responseText);
                        showAlert('error', 'Error de Conexión', 'No se pudo conectar al servidor.');
                    }
                });
            });
        } else {
            console.error("PROFILE.PHP: Formulario #editProfileFormemprendeya NO ENCONTRADO.");
        }
        // 3. Formulario: Subir Foto de Perfil
        if ($('#uploadProfilePicFormemprendeya').length) {
            console.log("PROFILE.PHP: Formulario #uploadProfilePicFormemprendeya ENCONTRADO.");
            $('#uploadProfilePicFormemprendeya').off('submit.profilePic').on('submit.profilePic', function(e) {
                console.log("PROFILE.PHP: SUBMIT EVENT DETECTADO para #uploadProfilePicFormemprendeya");
                e.preventDefault();
                console.log("PROFILE.PHP: Default form submission PREVENTED para foto de perfil.");

                var form = this;
                var fileInput = $('#profilePicFileemprendeya').get(0);

                if (fileInput.files.length === 0) {
                    // Mostrar error de validación si usas Bootstrap
                    $('#profilePicFileemprendeya').addClass('is-invalid');
                    // Asegúrate de tener un div con class="invalid-feedback" después del input
                    $('#profilePicFileemprendeya').siblings('.invalid-feedback').text('Por favor, selecciona un archivo.').show();
                    console.log("PROFILE.PHP: No se seleccionó archivo para foto de perfil.");
                    return;
                } else {
                    $('#profilePicFileemprendeya').removeClass('is-invalid');
                    $('#profilePicFileemprendeya').siblings('.invalid-feedback').hide();
                }

                var formData = new FormData(form); // FormData ya incluye el archivo
                formData.append('action', 'update_profile_picture');

                $.ajax({
                    url: 'backend-php/profile-actions.php', // RUTA CORRECTA
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $(form).find('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Subiendo...');
                    },
                    complete: function() {
                        $(form).find('button[type="submit"]').prop('disabled', false).html('Subir Foto');
                    },
                    success: function(response) {
                        console.log("PROFILE.PHP: Respuesta AJAX (update_profile_picture):", response);
                        if (response.success && response.newImageUrl) {
                            showAlert('success', '¡Éxito!', response.message);
                            var newImageUrl = response.newImageUrl + '?t=' + new Date().getTime();

                            // Actualizar imágenes de perfil en la página
                            $('.profile-avatar-img').attr('src', newImageUrl); // Avatar principal en el perfil
                            $('.sidebar .avatar-img').attr('src', newImageUrl); // Avatar en el sidebar
                            $('.navbar .topbar-user .avatar-img').attr('src', newImageUrl); // Avatar en el navbar
                            $('.navbar .dropdown-user-scroll .user-box .avatar-img').attr('src', newImageUrl); // Avatar en dropdown de usuario

                            $('#changeProfilePicModalemprendeya').modal('hide');
                        } else {
                            showAlert('error', 'Error', response.message || 'No se pudo actualizar la foto.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("PROFILE.PHP: Error AJAX (update_profile_picture):", textStatus, errorThrown, jqXHR.responseText);
                        showAlert('error', 'Error de Conexión', 'No se pudo conectar al servidor para subir la foto.');
                    }
                });
            });
        } else {
            console.error("PROFILE.PHP: Formulario #uploadProfilePicFormemprendeya NO ENCONTRADO.");
        }

        // 3.1 Preview para la foto de perfil
        $('#profilePicFileemprendeya').on('change', function() {
            var file = this.files[0];
            var previewContainer = $('#imageProfilePreviewContaineremprendeya');
            var previewImage = $('#imageProfilePreviewemprendeya');
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.attr('src', e.target.result);
                    previewContainer.show();
                }
                reader.readAsDataURL(file);
                $(this).removeClass('is-invalid').siblings('.invalid-feedback').hide();
            } else {
                previewContainer.hide();
                previewImage.attr('src', '#');
            }
        });


        // 4. Formulario: Subir Foto de Portada (Añade esta lógica si no la tienes)
        if ($('#uploadCoverPhotoFormemprendeya').length) {
            console.log("PROFILE.PHP: Formulario #uploadCoverPhotoFormemprendeya ENCONTRADO.");
            $('#uploadCoverPhotoFormemprendeya').off('submit.coverPic').on('submit.coverPic', function(e) {
                console.log("PROFILE.PHP: SUBMIT EVENT DETECTADO para #uploadCoverPhotoFormemprendeya");
                e.preventDefault();
                console.log("PROFILE.PHP: Default form submission PREVENTED para foto de portada.");

                var form = this;
                var fileInput = $('#coverPhotoFileemprendeya').get(0);

                if (fileInput.files.length === 0) {
                    $('#coverPhotoFileemprendeya').addClass('is-invalid').siblings('.invalid-feedback').text('Selecciona un archivo.').show();
                    return;
                } else {
                    $('#coverPhotoFileemprendeya').removeClass('is-invalid').siblings('.invalid-feedback').hide();
                }

                var formData = new FormData(form);
                formData.append('action', 'update_cover_photo');

                $.ajax({
                    url: 'backend-php/profile-actions.php', // RUTA CORRECTA
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $(form).find('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Subiendo...');
                    },
                    complete: function() {
                        $(form).find('button[type="submit"]').prop('disabled', false).html('Subir Portada');
                    },
                    success: function(response) {
                        if (response.success && response.newImageUrl) {
                            showAlert('success', '¡Éxito!', response.message);
                            var newCoverImageUrl = response.newImageUrl + '?t=' + new Date().getTime();
                            $('.profile-cover-card-header').css('background-image', 'url("' + newCoverImageUrl + '")');
                            $('#changeCoverPhotoModalemprendeya').modal('hide');
                        } else {
                            showAlert('error', 'Error', response.message || 'No se pudo actualizar la portada.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        showAlert('error', 'Error de Conexión', 'No se pudo conectar para subir la portada.');
                    }
                });
            });
        } else {
            console.error("PROFILE.PHP: Formulario #uploadCoverPhotoFormemprendeya NO ENCONTRADO.");
        }
        // 4.1 Preview para la foto de portada
        $('#coverPhotoFileemprendeya').on('change', function() {
            var file = this.files[0];
            var previewContainer = $('#imageCoverPreviewContaineremprendeya');
            var previewImage = $('#imageCoverPreviewemprendeya');
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.attr('src', e.target.result);
                    previewContainer.show();
                }
                reader.readAsDataURL(file);
                $(this).removeClass('is-invalid').siblings('.invalid-feedback').hide();
            } else {
                previewContainer.hide();
                previewImage.attr('src', '#');
            }
        });

        // 5. Formulario: Cambiar Contraseña (Añade esta lógica si no la tienes)
        if ($('#changePasswordFormemprendeya').length) {
            console.log("PROFILE.PHP: Formulario #changePasswordFormemprendeya ENCONTRADO.");
            $('#changePasswordFormemprendeya').off('submit.changePass').on('submit.changePass', function(e) {
                console.log("PROFILE.PHP: SUBMIT EVENT DETECTADO para #changePasswordFormemprendeya");
                e.preventDefault();
                var form = this;
                // ... (lógica de validación de contraseñas) ...
                if (form.checkValidity() === false) {
                    e.stopPropagation();
                    $(form).addClass('was-validated');
                    return;
                }
                if ($('#newPasswordemprendeya').val() !== $('#confirmNewPasswordemprendeya').val()) {
                    $('#confirmNewPasswordemprendeya').addClass('is-invalid').siblings('.invalid-feedback').text('Las contraseñas no coinciden.').show();
                    return;
                } else {
                    $('#confirmNewPasswordemprendeya').removeClass('is-invalid').siblings('.invalid-feedback').hide();
                }
                $(form).removeClass('was-validated');

                var formData = new FormData(form);
                formData.append('action', 'change_password');
                // ... (llamada AJAX similar a las otras) ...
                $.ajax({
                    url: 'backend-php/profile-actions.php', // RUTA CORRECTA
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $(form).find('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Actualizando...');
                    },
                    complete: function() {
                        $(form).find('button[type="submit"]').prop('disabled', false).html('Actualizar Contraseña');
                    },
                    success: function(response) {
                        if (response.success) {
                            showAlert('success', '¡Éxito!', response.message);

                            setTimeout(function() {
                                location.reload(); // Esto recargará la página actual
                            }, 1500);
                        } else {
                            showAlert('error', 'Error', response.message);
                        }
                    },
                    error: function() {
                        showAlert('error', 'Error', 'No se pudo cambiar la contraseña.');
                    }
                });
            });
        } else {
            console.error("PROFILE.PHP: Formulario #changePasswordFormemprendeya NO ENCONTRADO.");
        }


        // Limpiar modales al cerrar
        // Es mejor usar un selector más específico si sabes que solo los modales de esta página deben limpiarse así.
        // O si es global, debería estar en index.php
        $('.modal').on('hidden.bs.modal', function() { // Asegurar que el listener se aplique a modales cargados dinámicamente
            console.log("PROFILE.PHP: Modal cerrado, intentando limpiar formulario.", this.id);
            var form = $(this).find('form');
            if (form.length) {
                form[0].reset();
                form.removeClass('was-validated');
                form.find('input, select, textarea').removeClass('is-invalid'); // Quitar clases de error
                form.find('.invalid-feedback').text('').hide(); // Limpiar y ocultar mensajes de error
            }
            // Para las vistas previas de imágenes
            $(this).find('#imageProfilePreviewContaineremprendeya, #imageCoverPreviewContaineremprendeya').hide();
            $(this).find('#imageProfilePreviewemprendeya, #imageCoverPreviewemprendeya').attr('src', '#');
        });

        console.log("PROFILE.PHP: Fin de inicializarPaginaActual(). Todos los handlers adjuntados.");
    }

    // No envuelvas inicializarPaginaActual en $(document).ready() aquí.
    // El script de carga de index.php ya se encarga de llamar esta función
    // cuando el DOM de profile.php está listo.
</script>
<!-- ======================================================================= -->
<!-- ============= FIN DEL CÓDIGO JAVASCRIPT PERSONALIZADO =============== -->
<!-- ======================================================================= -->

</body>

</html>