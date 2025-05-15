<!-- Publicar Proyecto - Formulario Profesional y Completo -->
<div class="container">
    <div class="row">
        <div class="card card-space">
            <div class="container ">
                <div class="page-inner">
                    <div class="page-header" style="overflow: auto;">
                        <h4 class="fw-bold text-primary mb-3"><i
                                class="fas fa-fingerprint me-2"></i>Publicar Proyecto</h4>
                        <span class="badge badge-success" style="float: left;">Todos los proyectos son potenciales! <font
                                style="vertical-align: inherit;">+</font></span>
                    </div>

                    <div class="card shadow-sm p-4">
                        <!-- APUNTAR AL SCRIPT PHP CORRECTO -->
                        <form action="backend-php/procesar_proyecto.php" method="POST" enctype="multipart/form-data" id="formCrearProyecto">
                            <!-- 1. Identificación Básica -->
                            <h5 class="fw-bold mb-3">1. Identificación Básica</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre del Proyecto <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nombre_proyecto"
                                        placeholder="Nombre oficial del proyecto" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Logo del Proyecto</label>
                                    <input type="file" class="form-control" name="logo" accept="image/*"
                                        onchange="previewFile(this, '#logo-preview')">
                                    <img id="logo-preview" src="#" alt="Logo preview" class="img-thumbnail mt-2 d-none"
                                        style="max-height: 100px">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Eslogan o Frase Corta</label>
                                    <input type="text" class="form-control" name="eslogan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sector / Industria <span class="text-danger">*</span></label>
                                    <select class="form-select " name="sector" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Tecnología">Tecnología</option>
                                        <option value="Educación">Educación</option>
                                        <option value="Salud">Salud</option>
                                        <option value="Agroindustria">Agroindustria</option>
                                        <option value="Finanzas">Finanzas</option>
                                        <option value="Medio Ambiente">Medio Ambiente</option>
                                        <option value="Turismo">Turismo</option>
                                        <option value="Moda">Moda</option>
                                        <option value="Comercio">Comercio</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">País / Región</label>
                                <input type="text" class="form-control" name="region"
                                    placeholder="Ej. Colombia / Nariño">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ubicación del Proyecto (Municipio)</label>
                                <input type="text" class="form-control mb-2" name="ubicacion" id="ubicacion"
                                    placeholder="Buscar y seleccionar municipio...">
                                <!-- El mapa se inicializa por JS, el input 'ubicacion' se puede llenar manualmente o con el mapa -->
                                <div id="map" style="height: 300px; border: 1px solid #ccc;"></div>
                            </div>

                            <!-- 2. Resumen y Propuesta de Valor -->
                            <h5 class="fw-bold mt-4 mb-3">2. Resumen y Propuesta de Valor</h5>
                            <div class="mb-3">
                                <label class="form-label">Resumen Ejecutivo <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="resumen" rows="3" required></textarea>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Problema que Resuelve</label>
                                    <textarea class="form-control" name="problema"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Solución Ofrecida</label>
                                    <textarea class="form-control" name="solucion"></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Propuesta Única de Valor</label>
                                <textarea class="form-control" name="propuesta_valor"></textarea>
                            </div>

                            <!-- 3. Mercado -->
                            <h5 class="fw-bold mt-4 mb-3">3. Mercado</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Mercado Objetivo</label>
                                    <textarea class="form-control" name="mercado_objetivo"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tamaño Estimado del Mercado</label>
                                    <input type="text" class="form-control" name="tamano_mercado">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Competencia Principal</label>
                                <textarea class="form-control" name="competencia"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ventajas Competitivas</label>
                                <textarea class="form-control" name="ventajas"></textarea>
                            </div>

                            <!-- 4. Modelo de Negocio -->
                            <h5 class="fw-bold mt-4 mb-3">4. Modelo de Negocio</h5>
                            <div class="mb-3">
                                <label class="form-label">Modelo de Ingresos</label>
                                <textarea class="form-control" name="modelo_ingresos"></textarea>
                            </div>

                            <!-- 5. Equipo (No se procesa con el PHP actual sin modificarlo) -->
                            <h5 class="fw-bold mt-4 mb-3">5. Equipo de trabajo (Opcional)</h5>
                            <p class="text-muted small">Esta sección es informativa por ahora y no se guardará con el proyecto principal.</p>
                            <div id="fundadores-container" class="mb-3">
                                <div class="row align-items-end mb-2 fundador-item">
                                    <div class="col-md-6">
                                        <label class="form-label">Miembro de equipo</label>
                                        <input type="text" class="form-control" name="fundadores[]" placeholder="Nombre">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">Experiencia</label>
                                        <textarea class="form-control" name="experiencia_equipo[]" placeholder="Experiencia relevante"></textarea>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFundador(this)">×</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mb-3" onclick="agregarFundador()">+ Agregar Miembro</button>

                            <!-- 6. Finanzas -->
                            <h5 class="fw-bold mt-4 mb-3">6. Finanzas e Inversión</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Monto de Inversión Solicitado</label>
                                    <input type="number" step="0.01" class="form-control" name="monto_inversion" placeholder="Ej: 50000.00">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Valoración Pre-Money (opcional)</label>
                                    <input type="text" class="form-control" name="valoracion" placeholder="Ej: 200000.00 o N/A">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Uso Detallado de los Fondos</label>
                                <textarea class="form-control" name="uso_fondos"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Proyecciones Financieras (PDF) (Opcional)</label>
                                <!-- Cambiar name si se implementa en PHP -->
                                <input type="file" class="form-control" name="proyecciones_pdf" accept=".pdf">
                            </div>

                            <!-- 7. Tracción y Estado -->
                            <h5 class="fw-bold mt-4 mb-3">7. Estado Actual y Tracción</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Etapa Actual del Proyecto</label>
                                    <select class="form-select" name="etapa">
                                        <option value="">Seleccione...</option>
                                        <option value="Idea">Idea</option>
                                        <option value="Prototipo">Prototipo</option>
                                        <option value="MVP">MVP (Producto Mínimo Viable)</option>
                                        <option value="Ventas Iniciales">Ventas Iniciales</option>
                                        <option value="Crecimiento">Crecimiento</option>
                                        <option value="Maduro">Maduro</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Próximos Hitos</label>
                                    <input type="text" class="form-control" name="hitos">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Logros y Tracción Actual</label>
                                <textarea class="form-control" name="logros"></textarea>
                            </div>

                            <!-- 8. Material de Apoyo -->
                            <h5 class="fw-bold mt-4 mb-3">8. Material de Apoyo</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Pitch Deck (PDF)</label>
                                    <input type="file" class="form-control" name="pitch_pdf" accept=".pdf"> <!-- CORREGIDO -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Plan de Negocios (Opcional)</label>
                                    <input type="file" class="form-control" name="plan_negocios" accept=".pdf,.doc,.docx"> <!-- CORREGIDO -->
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Sitio Web (Opcional)</label>
                                    <input type="url" class="form-control" name="sitio_web" placeholder="https://www.ejemplo.com"> <!-- CORREGIDO -->
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Video Pitch (URL YouTube/Vimeo - Opcional)</label>
                                    <input type="url" class="form-control" name="video_pitch" placeholder="https://youtube.com/watch?v=..."> <!-- CORREGIDO -->
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Demo del Producto (URL - Opcional)</label>
                                    <input type="url" class="form-control" name="demo_url" placeholder="https://demo.ejemplo.com"> <!-- CORREGIDO -->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Imágenes Adicionales (Máx 5, 2MB c/u - Opcional)</label>
                                <p class="text-muted small">Estas imágenes no se guardan con la versión actual del sistema.</p>
                                <input type="file" class="form-control" name="imagenes_galeria[]" multiple accept="image/*"
                                    onchange="previewMultiple(this, '#galeria-preview')">
                                <div id="galeria-preview" class="row mt-3 g-2"></div>
                            </div>

                            <!-- 9. Contacto del Proyecto -->
                            <h5 class="fw-bold mt-4 mb-3">9. Información de Contacto (para este proyecto)</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Nombre Persona de Contacto</label>
                                    <input type="text" class="form-control" name="contacto_nombre"> <!-- CORREGIDO -->
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Correo Electrónico de Contacto</label>
                                    <input type="email" class="form-control" name="contacto_correo">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Teléfono de Contacto</label>
                                    <input type="tel" class="form-control" name="contacto_telefono"> <!-- CORREGIDO -->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Perfil de LinkedIn del Proyecto/Contacto (Opcional)</label>
                                <input type="url" class="form-control" name="linkedin" placeholder="https://linkedin.com/in/perfil">
                            </div>

                            <hr class="my-4">
                            <div class="text-end">
                                <button type="reset" class="btn btn-outline-secondary btn-round">Limpiar Formulario</button>
                                <button type="submit" class="btn btn-success btn-round px-4">Publicar Proyecto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript de soporte (Tu JS existente para previews y mapa) -->
<script>
    // Funciones previewFile, previewMultiple, initMap, agregarFundador, eliminarFundador como las tienes.
    // Asegúrate que `YOUR_API_KEY` en la URL de Google Maps sea reemplazada.

    function previewFile(input, previewId) {
        const file = input.files[0];
        const preview = document.querySelector(previewId);
        if (file) {
            // ... (tu código de previewFile)
        }
    }

    function previewMultiple(input, containerId) {
        // ... (tu código de previewMultiple)
    }

    // Variable global para el mapa y marcador para poder accederla en el reset
    let map;
    let marker;

    function initMap() {
        const defaultLatLng = {
            lat: 1.2136,
            lng: -77.2811
        }; // Pasto
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: defaultLatLng,
            streetViewControl: false, // Deshabilitar Street View
            mapTypeControl: false // Deshabilitar cambio de tipo de mapa
        });

        const input = document.getElementById("ubicacion");
        const searchBox = new google.maps.places.SearchBox(input);
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); // Esto puede sobreponerse feo, a veces mejor no añadirlo al control del mapa

        marker = new google.maps.Marker({
            map,
            position: defaultLatLng,
            draggable: true,
            title: "Ubicación del proyecto"
        });

        // Actualizar input si el marcador se arrastra
        google.maps.event.addListener(marker, 'dragend', function(event) {
            // Intenta obtener la dirección con geocodificación inversa (opcional, requiere más API calls)
            // Por ahora, simplemente podrías dejar que el usuario escriba manualmente después de arrastrar,
            // o guardar lat/lng si prefieres.
            // document.getElementById("ubicacion").value = "Lat: " + event.latLng.lat() + ", Lng: " + event.latLng.lng();
            console.log("Nueva posición del marcador:", event.latLng.lat(), event.latLng.lng());
        });

        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;

            const place = places[0];
            if (!place.geometry || !place.geometry.location) {
                console.log("Lugar devuelto no tiene geometría");
                return;
            }

            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location);
            // Actualizar el input de ubicación con el nombre del lugar si se desea
            // document.getElementById("ubicacion").value = place.name; // O place.formatted_address
        });
    }

    function agregarFundador() {
        // ... (tu código de agregarFundador)
    }

    function eliminarFundador(btn) {
        // ... (tu código de eliminarFundador)
    }

    // Script para limpiar dinámicamente campos añadidos
    // Es mejor adjuntar este listener una vez que el DOM esté completamente cargado
    // y si esta página se carga por AJAX, debe ir en inicializarPaginaActual()
    // Si es una página PHP directa, DOMContentLoaded está bien.
    // Para el sistema que tenemos, si esta página es 'crear_proyecto.php' y se carga dinámicamente
    // el siguiente código iría DENTRO de la función inicializarPaginaActual() de 'crear_proyecto.php'
    //
    // function inicializarPaginaActual() {
    //     const form = document.querySelector('#formCrearProyecto'); // Usar el ID que le dimos
    //     if(form) {
    //         form.addEventListener('reset', () => {
    //             // ... (tu código de reset) ...
    //             // Asegúrate de que map y marker sean accesibles si están definidos globalmente o pásalos
    //             if (typeof map !== 'undefined' && typeof marker !== 'undefined') {
    //                 const defaultLatLngReset = { lat: 1.2136, lng: -77.2811 };
    //                 marker.setPosition(defaultLatLngReset);
    //                 map.setCenter(defaultLatLngReset);
    //                 map.setZoom(12);
    //                 document.getElementById("ubicacion").value = ""; // Limpiar input de ubicación
    //             }
    //         });
    //     }
    //     // Cargar API de Google Maps si no está ya cargada globalmente
    //     if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
    //         let script = document.createElement('script');
    //         script.src = `https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap`;
    //         script.async = true;
    //         script.defer = true;
    //         document.head.appendChild(script);
    //     } else if (document.getElementById('map') && typeof initMap === 'function') {
    //         // Si la API ya está cargada pero el mapa es para esta página específica, inicializarlo
    //         initMap();
    //     }
    // }
    //
    // Si es una página independiente (no cargada por AJAX en index.php):
    window.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('#formCrearProyecto');
        if (form) {
            form.addEventListener('reset', () => {
                // Limpiar fundadores adicionales
                document.querySelectorAll('#fundadores-container .fundador-item').forEach((item, index) => {
                    if (index > 0 || !item.querySelector('input[name="fundadores[]"]').value) { // Si es el primero y está vacío, o si son adicionales
                        // Para el primer item, solo limpiar campos. Para los demás, remover.
                        if (index > 0) item.remove();
                        else {
                            item.querySelector('input[name="fundadores[]"]').value = '';
                            item.querySelector('textarea[name="experiencia_equipo[]"]').value = '';
                        }
                    }
                });

                const logoPreview = document.getElementById('logo-preview');
                if (logoPreview) {
                    logoPreview.src = "#";
                    logoPreview.classList.add('d-none');
                }

                const galeria = document.getElementById('galeria-preview');
                if (galeria) galeria.innerHTML = '';

                document.querySelectorAll('input[type="file"]').forEach(input => {
                    input.value = "";
                });

                if (typeof map !== 'undefined' && typeof marker !== 'undefined') {
                    const defaultLatLngReset = {
                        lat: 1.2136,
                        lng: -77.2811
                    };
                    marker.setPosition(defaultLatLngReset);
                    map.setCenter(defaultLatLngReset);
                    map.setZoom(12);
                    document.getElementById("ubicacion").value = "";
                }
            });
        }
        // Si la API de Google Maps se carga al final de este archivo,
        // initMap ya será llamada por el callback.
        // Si no, y la API se carga globalmente en index.php, necesitarías llamar a initMap() aquí
        // si el elemento #map existe:
        // if (document.getElementById('map') && typeof initMap === 'function') {
        //     initMap();
        // }
    });
</script>
<!-- Carga de API de Google Maps (PON TU API KEY) -->
<!-- Es mejor cargarla una sola vez en tu index.php si la usas en múltiples páginas cargadas por AJAX -->
<!-- Si este es un archivo independiente, está bien aquí -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY_AQUI&libraries=places&callback=initMap" async defer></script> -->

<!-- JavaScript de soporte -->
<script>
    function previewFile(input, previewId) {
        const file = input.files[0];
        const preview = document.querySelector(previewId);
        if (file) {
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (file.size > maxSize) {
                alert("El archivo supera el tamaño máximo permitido de 2MB.");
                input.value = "";
                return;
            }
            const reader = new FileReader();
            reader.onload = () => {
                preview.src = reader.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    }

    function previewMultiple(input, containerId) {
        const container = document.querySelector(containerId);
        container.innerHTML = '';
        Array.from(input.files).forEach((file, index) => {
            if (file.size > 2 * 1024 * 1024) {
                alert(`La imagen "${file.name}" excede los 2MB y no será cargada.`);
                return;
            }
            const reader = new FileReader();
            reader.onload = () => {
                const col = document.createElement('div');
                col.className = 'col-md-3 position-relative';
                col.innerHTML = `
            <div class="border p-1 rounded position-relative">
              <img src="${reader.result}" class="img-fluid rounded" style="height: 150px; object-fit: cover; width: 100%;">
              <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" style="z-index: 2;" onclick="this.parentElement.parentElement.remove()">&times;</button>
            </div>
          `;
                container.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    }
</script>

<!-- Carga de mapa de Google Maps -->
<script>
    function initMap() {
        const defaultLatLng = {
            lat: 1.2136,
            lng: -77.2811
        }; // Coordenadas de Pasto, Nariño
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: defaultLatLng
        });

        const input = document.getElementById("ubicacion");
        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        let marker = new google.maps.Marker({
            map,
            position: defaultLatLng,
            draggable: true
        });

        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;

            const place = places[0];
            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap" async
    defer></script>

<script>
    function agregarFundador() {
        const container = document.getElementById('fundadores-container');
        const div = document.createElement('div');
        div.className = 'row align-items-end mb-2 fundador-item';
        div.innerHTML = `
            <div class="col-md-6">
              <input type="text" class="form-control" name="fundadores[]" placeholder="Nombre del fundador">
            </div>
            <div class="col-md-5">
              <textarea class="form-control" name="experiencia_equipo[]" placeholder="Experiencia relevante"></textarea>
            </div>
            <div class="col-md-1 text-end">
              <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFundador(this)">&times;</button>
            </div>`;
        container.appendChild(div);
    }

    function eliminarFundador(btn) {
        btn.closest('.fundador-item').remove();
    }

    // Script para limpiar dinámicamente campos añadidos
    window.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form');
        form.addEventListener('reset', () => {
            // Limpiar fundadores adicionales
            const fundadores = document.querySelectorAll('.fundador-item');
            fundadores.forEach((item, index) => {
                if (index > 0) item.remove();
            });

            // Ocultar logo preview
            const logoPreview = document.getElementById('logo-preview');
            if (logoPreview) {
                logoPreview.src = "#";
                logoPreview.classList.add('d-none');
            }

            // Limpiar galería de imágenes
            const galeria = document.getElementById('galeria-preview');
            if (galeria) galeria.innerHTML = '';

            // Limpiar inputs de tipo file manualmente
            document.querySelectorAll('input[type="file"]').forEach(input => {
                input.value = "";
            });

            // Reiniciar ubicación del mapa
            if (typeof marker !== 'undefined') {
                marker.setPosition({
                    lat: 1.2136,
                    lng: -77.2811
                });
                map.setCenter({
                    lat: 1.2136,
                    lng: -77.2811
                });
            }
        });
    });
</script>