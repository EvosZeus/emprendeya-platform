<?php
// backend-php/get_project_form_for_edit.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/database.php';
if (session_status() == PHP_SESSION_NONE) { session_start(); }

$responsePrefix = "<div class='alert alert-danger p-3 m-0 rounded-0'>"; // Para errores antes del form
$responseSuffix = "</div>";

$projectId = isset($_GET['id_proyecto']) ? filter_var($_GET['id_proyecto'], FILTER_SANITIZE_NUMBER_INT) : null;

if (!$projectId || !isset($_SESSION['user_id'])) {
    echo $responsePrefix . "Información insuficiente o no autorizado." . $responseSuffix;
    exit;
}
if (!$conn) {
    echo $responsePrefix . "Error de conexión a la base de datos." . $responseSuffix;
    exit;
}

$current_user_id = $_SESSION['user_id'];
$proyecto_data_raw = null;

// Obtener datos del proyecto y verificar propiedad
// Seleccionar TODAS las columnas que necesitas para el formulario
$sql = "SELECT * FROM proyectos WHERE id_proyecto = $1 AND usuario_id = $2";
$stmt = pg_prepare($conn, "get_project_data_for_edit_form", $sql);

if (!$stmt) {
    error_log("Error preparando get_project_data_for_edit_form: " . pg_last_error($conn));
    echo $responsePrefix . "Error interno del servidor (P1EF)." . $responseSuffix;
    if (isset($conn)) { pg_close($conn); }
    exit;
}
$result = pg_execute($conn, "get_project_data_for_edit_form", array($projectId, $current_user_id));

if ($result && pg_num_rows($result) > 0) {
    $proyecto_data_raw = pg_fetch_assoc($result);
} else {
    echo $responsePrefix . "Proyecto no encontrado o no tienes permiso para editarlo." . $responseSuffix;
    if (isset($conn)) { pg_close($conn); }
    exit;
}

// Preparar datos para el formulario, asegurando que todas las claves existan
// y usando trim() solo en valores que no son null.
// htmlspecialchars se aplica directamente en el 'value' del input para strings.
// Para textareas, el contenido va entre las etiquetas, no en 'value'.
$proyecto_data = [];
$text_area_fields = ['resumen', 'problema', 'solucion', 'propuesta_valor', 'mercado_objetivo', 'competencia', 'ventajas', 'modelo_ingresos', 'uso_fondos', 'hitos', 'logros'];

foreach ($proyecto_data_raw as $key => $value) {
    if (in_array($key, $text_area_fields)) {
        // Para textareas, queremos el valor crudo (o cadena vacía si es null)
        // htmlspecialchars se aplicará al imprimirlo entre <textarea> y </textarea>
        $proyecto_data[$key] = trim($value ?? '');
    } elseif (is_string($value)) {
        $proyecto_data[$key] = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    } else {
        $proyecto_data[$key] = $value; // Mantener números, booleanos, etc.
    }
}

// Asegurar que las claves esperadas por el formulario existan, incluso si son null en la DB
$expected_fields = [
    'nombre_proyecto', 'logo', 'eslogan', 'sector', 'region', 'ubicacion', 'resumen', 'problema',
    'solucion', 'propuesta_valor', 'mercado_objetivo', 'tamano_mercado', 'competencia', 'ventajas',
    'modelo_ingresos', 'monto_inversion', 'valoracion', 'uso_fondos', 'etapa', 'hitos', 'logros',
    'pitch_pdf', 'plan_negocios', /*'proyecciones_pdf',*/ 'sitio_web', 'video_pitch', 'demo_url',
    'contacto_nombre', 'contacto_correo', 'contacto_telefono', 'linkedin'
];

foreach ($expected_fields as $field) {
    if (!isset($proyecto_data[$field])) {
        $proyecto_data[$field] = ''; // O null, pero string vacío es más seguro para 'value'
    }
}


// Listas para selects
$sectores_lista_form_edit = ["Tecnología", "Educación", "Salud", "Agroindustria", "Finanzas", "Medio Ambiente", "Turismo", "Moda", "Comercio", "Otro"];
$etapas_lista_form_edit = ["Idea", "Prototipo", "MVP", "Ventas Iniciales", "Crecimiento", "Maduro"];

?>
<form id="formEditarMiProyectoModalProfile" action="backend-php/update_my_project.php" method="POST" enctype="multipart/form-data" class="needs-validation p-2" novalidate>
    <input type="hidden" name="id_proyecto" value="<?php echo $proyecto_data['id_proyecto']; ?>">
    <input type="hidden" name="logo_actual" value="<?php echo $proyecto_data['logo']; ?>">
    <input type="hidden" name="pitch_pdf_actual" value="<?php echo $proyecto_data['pitch_pdf']; ?>">
    <input type="hidden" name="plan_negocios_actual" value="<?php echo $proyecto_data['plan_negocios']; ?>">
    <?php /* <input type="hidden" name="proyecciones_pdf_actual" value="<?php echo $proyecto_data['proyecciones_pdf']; ?>"> */ ?>

    <h5 class="fw-bold mb-3 mt-2 text-primary"><i class="fas fa-pencil-alt me-2"></i>Editando Proyecto: <?php echo $proyecto_data['nombre_proyecto']; ?></h5>
    <hr>

    <!-- 1. Identificación Básica -->
    <h6 class="fw-bold mb-3 section-title-edit">1. Identificación Básica</h6>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="edit_nombre_proyecto" class="form-label">Nombre del Proyecto <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm" id="edit_nombre_proyecto" name="nombre_proyecto" value="<?php echo $proyecto_data['nombre_proyecto']; ?>" required>
        </div>
        <div class="col-md-6">
            <label for="edit_logo" class="form-label">Logo del Proyecto (JPG, PNG, GIF - Máx 2MB)</label>
            <input type="file" class="form-control form-control-sm" id="edit_logo" name="logo" accept="image/*">
            <?php if (!empty($proyecto_data['logo'])): ?>
                <small class="d-block mt-1 text-muted">Actual: <a href="<?php echo $proyecto_data['logo']; ?>" target="_blank" rel="noopener noreferrer"><?php echo basename($proyecto_data['logo']); ?></a> (Dejar vacío para no cambiar)</small>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="edit_eslogan" class="form-label">Eslogan o Frase Corta</label>
            <input type="text" class="form-control form-control-sm" id="edit_eslogan" name="eslogan" value="<?php echo $proyecto_data['eslogan']; ?>">
        </div>
        <div class="col-md-6">
            <label for="edit_sector" class="form-label">Sector / Industria <span class="text-danger">*</span></label>
            <select class="form-select form-select-sm" id="edit_sector" name="sector" required>
                <option value="">Seleccione...</option>
                <?php foreach($sectores_lista_form_edit as $s): ?>
                <option value="<?php echo htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); ?>" <?php echo (isset($proyecto_data['sector']) && strcasecmp($proyecto_data['sector'], $s) == 0) ? 'selected' : ''; ?>><?php echo htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="edit_region" class="form-label">País / Región</label>
            <input type="text" class="form-control form-control-sm" id="edit_region" name="region" value="<?php echo $proyecto_data['region']; ?>" placeholder="Ej: Colombia / Nariño">
        </div>
        <div class="col-md-6">
            <label for="edit_ubicacion" class="form-label">Ubicación del Proyecto (Municipio)</label>
            <input type="text" class="form-control form-control-sm" id="edit_ubicacion" name="ubicacion" value="<?php echo $proyecto_data['ubicacion']; ?>" placeholder="Ej: Pasto">
        </div>
    </div>


    <!-- 2. Resumen y Propuesta de Valor -->
    <h6 class="fw-bold mt-4 mb-3 section-title-edit">2. Resumen y Propuesta de Valor</h6>
    <div class="mb-3">
        <label for="edit_resumen" class="form-label">Resumen Ejecutivo <span class="text-danger">*</span></label>
        <textarea class="form-control form-control-sm" id="edit_resumen" name="resumen" rows="4" required><?php echo htmlspecialchars($proyecto_data['resumen'], ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="edit_problema" class="form-label">Problema que Resuelve</label>
            <textarea class="form-control form-control-sm" id="edit_problema" name="problema" rows="3"><?php echo htmlspecialchars($proyecto_data['problema'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="col-md-6">
            <label for="edit_solucion" class="form-label">Solución Ofrecida</label>
            <textarea class="form-control form-control-sm" id="edit_solucion" name="solucion" rows="3"><?php echo htmlspecialchars($proyecto_data['solucion'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
    </div>
    <div class="mb-3">
        <label for="edit_propuesta_valor" class="form-label">Propuesta Única de Valor</label>
        <textarea class="form-control form-control-sm" id="edit_propuesta_valor" name="propuesta_valor" rows="3"><?php echo htmlspecialchars($proyecto_data['propuesta_valor'], ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>

    <!-- 3. Mercado -->
    <h6 class="fw-bold mt-4 mb-3 section-title-edit">3. Mercado</h6>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="edit_mercado_objetivo" class="form-label">Mercado Objetivo</label>
            <textarea class="form-control form-control-sm" id="edit_mercado_objetivo" name="mercado_objetivo" rows="3"><?php echo htmlspecialchars($proyecto_data['mercado_objetivo'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="col-md-6">
            <label for="edit_tamano_mercado" class="form-label">Tamaño Estimado del Mercado</label>
            <input type="text" class="form-control form-control-sm" id="edit_tamano_mercado" name="tamano_mercado" value="<?php echo $proyecto_data['tamano_mercado']; ?>">
        </div>
    </div>
    <div class="mb-3">
        <label for="edit_competencia" class="form-label">Competencia Principal</label>
        <textarea class="form-control form-control-sm" id="edit_competencia" name="competencia" rows="3"><?php echo htmlspecialchars($proyecto_data['competencia'], ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="edit_ventajas" class="form-label">Ventajas Competitivas</label>
        <textarea class="form-control form-control-sm" id="edit_ventajas" name="ventajas" rows="3"><?php echo htmlspecialchars($proyecto_data['ventajas'], ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    
    <!-- 4. Modelo de Negocio -->
    <h6 class="fw-bold mt-4 mb-3 section-title-edit">4. Modelo de Negocio</h6>
    <div class="mb-3">
        <label for="edit_modelo_ingresos" class="form-label">Modelo de Ingresos</label>
        <textarea class="form-control form-control-sm" id="edit_modelo_ingresos" name="modelo_ingresos" rows="3"><?php echo htmlspecialchars($proyecto_data['modelo_ingresos'], ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>

    <!-- 5. Finanzas -->
    <h6 class="fw-bold mt-4 mb-3 section-title-edit">5. Finanzas e Inversión</h6>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="edit_monto_inversion" class="form-label">Monto de Inversión Solicitado</label>
            <input type="number" step="0.01" class="form-control form-control-sm" id="edit_monto_inversion" name="monto_inversion" value="<?php echo $proyecto_data['monto_inversion']; // Valor crudo para input number ?>">
        </div>
        <div class="col-md-6">
            <label for="edit_valoracion" class="form-label">Valoración Pre-Money (opcional)</label>
            <input type="text" class="form-control form-control-sm" id="edit_valoracion" name="valoracion" value="<?php echo $proyecto_data['valoracion']; // Valor crudo ?>">
        </div>
    </div>
    <div class="mb-3">
        <label for="edit_uso_fondos" class="form-label">Uso Detallado de los Fondos</label>
        <textarea class="form-control form-control-sm" id="edit_uso_fondos" name="uso_fondos" rows="3"><?php echo htmlspecialchars($proyecto_data['uso_fondos'], ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    
    <!-- 6. Tracción y Estado -->
    <h6 class="fw-bold mt-4 mb-3 section-title-edit">6. Estado Actual y Tracción</h6>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="edit_etapa" class="form-label">Etapa Actual del Proyecto</label>
            <select class="form-select form-select-sm" id="edit_etapa" name="etapa">
                <option value="">Seleccione...</option>
                 <?php foreach($etapas_lista_form_edit as $e): ?>
                <option value="<?php echo htmlspecialchars($e, ENT_QUOTES, 'UTF-8'); ?>" <?php echo (isset($proyecto_data['etapa']) && strcasecmp($proyecto_data['etapa'], $e) == 0) ? 'selected' : ''; ?>><?php echo htmlspecialchars($e, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="edit_hitos" class="form-label">Próximos Hitos</label>
            <input type="text" class="form-control form-control-sm" id="edit_hitos" name="hitos" value="<?php echo $proyecto_data['hitos']; ?>">
        </div>
    </div>
    <div class="mb-3">
        <label for="edit_logros" class="form-label">Logros y Tracción Actual</label>
        <textarea class="form-control form-control-sm" id="edit_logros" name="logros" rows="3"><?php echo htmlspecialchars($proyecto_data['logros'], ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>

    <!-- 7. Material de Apoyo -->
    <h6 class="fw-bold mt-4 mb-3 section-title-edit">7. Material de Apoyo</h6>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="edit_pitch_pdf" class="form-label">Pitch Deck (PDF) (dejar vacío para no cambiar)</label>
            <input type="file" class="form-control form-control-sm" id="edit_pitch_pdf" name="pitch_pdf" accept=".pdf">
            <?php if (!empty($proyecto_data['pitch_pdf'])): ?>
                <small class="d-block mt-1 text-muted">Actual: <a href="<?php echo $proyecto_data['pitch_pdf']; ?>" target="_blank" rel="noopener noreferrer"><?php echo basename($proyecto_data['pitch_pdf']); ?></a></small>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label for="edit_plan_negocios" class="form-label">Plan de Negocios (Opcional, dejar vacío para no cambiar)</label>
            <input type="file" class="form-control form-control-sm" id="edit_plan_negocios" name="plan_negocios" accept=".pdf,.doc,.docx">
            <?php if (!empty($proyecto_data['plan_negocios'])): ?>
                <small class="d-block mt-1 text-muted">Actual: <a href="<?php echo $proyecto_data['plan_negocios']; ?>" target="_blank" rel="noopener noreferrer"><?php echo basename($proyecto_data['plan_negocios']); ?></a></small>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="edit_sitio_web" class="form-label">Sitio Web (Opcional)</label>
            <input type="url" class="form-control form-control-sm" id="edit_sitio_web" name="sitio_web" value="<?php echo $proyecto_data['sitio_web']; ?>" placeholder="https://...">
        </div>
        <div class="col-md-4">
            <label for="edit_video_pitch" class="form-label">Video Pitch (URL YouTube/Vimeo - Opcional)</label>
            <input type="url" class="form-control form-control-sm" id="edit_video_pitch" name="video_pitch" value="<?php echo $proyecto_data['video_pitch']; // 'video_pitch' es la columna en la tabla ?>" placeholder="https://youtube.com/...">
        </div>
        <div class="col-md-4">
            <label for="edit_demo_url" class="form-label">Demo del Producto (URL - Opcional)</label>
            <input type="url" class="form-control form-control-sm" id="edit_demo_url" name="demo_url" value="<?php echo $proyecto_data['demo_url']; ?>" placeholder="https://demo...">
        </div>
    </div>
    <!-- Galería de Imágenes: Para la edición, podrías mostrar las actuales y tener un input para AÑADIR nuevas.
         Eliminar imágenes existentes requeriría más JS y lógica backend.
         Por ahora, si suben nuevas, el script update_my_project.php podría reemplazarlas. -->
    <div class="mb-3">
        <label class="form-label">Actualizar Imágenes de Galería (Opcional)</label>
        <input type="file" class="form-control form-control-sm" name="imagenes_galeria_nuevas[]" multiple accept="image/*">
        <small class="text-muted">Si subes imágenes aquí, se intentará reemplazar la galería existente.</small>
        <!-- Aquí podrías listar las imágenes actuales con opción de eliminar (más complejo) -->
    </div>

    <!-- 8. Contacto del Proyecto -->
    <h6 class="fw-bold mt-4 mb-3 section-title-edit">8. Información de Contacto (para este proyecto)</h6>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="edit_contacto_nombre" class="form-label">Nombre Persona de Contacto</label>
            <input type="text" class="form-control form-control-sm" id="edit_contacto_nombre" name="contacto_nombre" value="<?php echo $proyecto_data['contacto_nombre']; ?>">
        </div>
        <div class="col-md-4">
            <label for="edit_contacto_correo" class="form-label">Correo Electrónico de Contacto</label>
            <input type="email" class="form-control form-control-sm" id="edit_contacto_correo" name="contacto_correo" value="<?php echo $proyecto_data['contacto_correo']; ?>">
        </div>
        <div class="col-md-4">
            <label for="edit_contacto_telefono" class="form-label">Teléfono de Contacto</label>
            <input type="tel" class="form-control form-control-sm" id="edit_contacto_telefono" name="contacto_telefono" value="<?php echo $proyecto_data['contacto_telefono']; ?>">
        </div>
    </div>
    <div class="mb-3">
        <label for="edit_linkedin" class="form-label">Perfil de LinkedIn del Proyecto/Contacto (Opcional)</label>
        <input type="url" class="form-control form-control-sm" id="edit_linkedin" name="linkedin" value="<?php echo $proyecto_data['linkedin']; ?>" placeholder="https://linkedin.com/...">
    </div>
    <!-- El botón de submit está en el footer del modal estático en profile.php y usa el atributo 'form' -->
</form>
<script>
    // Pequeño script para asegurar que la validación de Bootstrap se active si es necesario
    // O para inicializar componentes específicos del formulario si los tuvieras (ej. datepickers)
    (function () {
        'use strict'
        var forms = document.querySelectorAll('#formEditarMiProyectoModalProfile.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
         console.log("Formulario de edición listo para proyecto ID <?php echo $proyecto_data['id_proyecto']; ?> con validación Bootstrap adjuntada.");
    })()
</script>
<?php
if (isset($conn)) { pg_close($conn); }
?>