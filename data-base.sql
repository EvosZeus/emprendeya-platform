--CREDENCIALES
 --ADMIN
 emprendeya.soporte@gmail.com --PASSWORD B39840592*

 --EMPRENDEDORES
 hello@example.com --PASSWORD 123
 d@gmail.com --PASSWORD 123
 p@gmail.com --PASSWORD 123
--FIN CREDENCIALES



-- (Opcional pero recomendado) Crear tipos ENUM para campos con valores predefinidos
CREATE TYPE tipo_genero AS ENUM ('Masculino', 'Femenino', 'Otro', 'Prefiero no decirlo');
CREATE TYPE tipo_rol_usuario AS ENUM ('Emprendedor', 'Inversor');
ALTER TYPE tipo_rol_usuario 
ADD VALUE 'Administrador';


-- Tabla de Usuarios
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,                          -- Identificador único del usuario
    nombre_completo VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,             -- El email debe ser único
    contrasena_hash VARCHAR(255) NOT NULL,          -- IMPORTANTE: Guarda el HASH de la contraseña, NUNCA la contraseña en texto plano
    acepta_terminos BOOLEAN NOT NULL DEFAULT TRUE,
    
    foto_perfil_url VARCHAR(512),                   -- URL o ruta al archivo de imagen del perfil
    genero tipo_genero,                             -- Usando el tipo ENUM definido arriba
    telefono VARCHAR(50),
    fecha_nacimiento DATE,
    municipio VARCHAR(100),                         -- Podrías normalizar esto en una tabla 'municipios' si es necesario
    
    rol tipo_rol_usuario NOT NULL,                  -- Usando el tipo ENUM definido arriba
    
    fecha_registro TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP, -- Fecha y hora del registro
    ultima_conexion TIMESTAMP WITH TIME ZONE,       -- Para rastrear la última vez que inició sesión
    cuenta_verificada BOOLEAN DEFAULT FALSE,        -- Para un sistema de verificación de email
    token_verificacion VARCHAR(100),                -- Token para verificar email
    token_reset_password VARCHAR(100),              -- Token para reseteo de contraseña
    fecha_expiracion_token TIMESTAMP WITH TIME ZONE -- Fecha de expiración para los tokens
);

-- (Opcional) Índices para mejorar el rendimiento de las búsquedas
CREATE INDEX idx_usuarios_email ON usuarios(email);
CREATE INDEX idx_usuarios_rol ON usuarios(rol);

-- (Opcional pero altamente recomendado) Tabla para Municipios si quieres normalizar
-- CREATE TABLE departamentos (
--     id_departamento SERIAL PRIMARY KEY,
--     nombre_departamento VARCHAR(100) NOT NULL UNIQUE
-- );

-- INSERT INTO departamentos (nombre_departamento) VALUES ('Nariño'); -- Ejemplo

-- CREATE TABLE municipios (
--     id_municipio SERIAL PRIMARY KEY,
--     nombre_municipio VARCHAR(100) NOT NULL,
--     id_departamento_fk INTEGER REFERENCES departamentos(id_departamento)
--     -- UNIQUE (nombre_municipio, id_departamento_fk) -- Para evitar duplicados por departamento
-- );

-- Si usas la tabla municipios, la columna 'municipio' en 'usuarios' cambiaría a:
-- id_municipio_fk INTEGER REFERENCES municipios(id_municipio),

-- Y tendrías que poblar la tabla municipios con los valores del select:
-- INSERT INTO municipios (nombre_municipio, id_departamento_fk) VALUES ('Albán', (SELECT id_departamento FROM departamentos WHERE nombre_departamento = 'Nariño'));
-- ... y así para todos los municipios.
















<!-- Script para cargar dinámicamente el contenido @renderbody -->
  <script>
    let paginaActualCargada = null; // Para evitar recargar la misma página

    function ejecutarScriptsEn(elementoPadre) {
      const scripts = elementoPadre.querySelectorAll("script");
      scripts.forEach((scriptViejo) => {
        const scriptNuevo = document.createElement("script");
        // Copiar atributos (importante para type="module", async, defer, etc.)
        Array.from(scriptViejo.attributes).forEach(attr => scriptNuevo.setAttribute(attr.name, attr.value));

        if (scriptViejo.src) {
          // Para scripts externos, clonar y reemplazar puede forzar la recarga si es necesario,
          // o simplemente permitir que el navegador maneje el cacheo.
          // La clave es que se adjunta al DOM donde el navegador lo "ve".
          scriptNuevo.src = scriptViejo.src; // Asignar src ANTES de appendChild
          scriptNuevo.onload = () => console.log("Script externo (interno al HTML) cargado:", scriptViejo.src);
          scriptNuevo.onerror = () => console.error("Error cargando script externo (interno al HTML):", scriptViejo.src);
        } else {
          // Para scripts inline
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

      // Kaiadmin/EmprendeYa Theme specific initializations
      // Esto es muy dependiente del tema. Puede que tengan una función global para re-inicializar.
      // Ejemplo: if (typeof Kai !== 'undefined' && Kai.init) Kai.init();
      // O puede que necesites llamar a inicializadores de componentes específicos.
      // if (typeof Circles !== 'undefined' && typeof Circles.create === 'function') {
      //    $(contextoElemento).find('.circles-chart').each(function(){
      //        if(!$(this).data('processed-circle')) { // Evitar duplicados
      //            Circles.create({ id: this.id, /* ...más opciones... */ });
      //            $(this).data('processed-circle', true);
      //        }
      //    });
      // }
      console.log("Componentes globales UI (re)inicializados.");
    }

    function cargarContenido(rutaPagina) {
      console.log(`Solicitando carga de contenido para: ${rutaPagina}.php`);

      if (paginaActualCargada === rutaPagina) {
        console.log(`La página ${rutaPagina} ya está cargada. No se recarga.`);
        // Podrías hacer scroll al top o alguna otra acción si lo deseas.
        window.scrollTo(0, 0);
        return; // Evita la recarga
      }

      const renderTarget = document.getElementById("render-body");
      if (!renderTarget) {
        console.error("Elemento #render-body no encontrado. No se puede cargar contenido.");
        return;
      }

      renderTarget.innerHTML = '<div class="d-flex justify-content-center align-items-center" style="min-height: 300px;"><div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Cargando...</span></div></div>';

      fetch(`${rutaPagina}.php`)
        .then((response) => {
          if (!response.ok) {
            throw new Error(`Error HTTP ${response.status} al cargar ${rutaPagina}.php`);
          }
          return response.text();
        })
        .then((html) => {
          renderTarget.innerHTML = html;
          paginaActualCargada = rutaPagina; // Marcar página como cargada

          ejecutarScriptsEn(renderTarget); // Ejecutar scripts <script> DENTRO del HTML cargado
          reinicializarComponentesGlobalesUI(renderTarget); // Re-inicializar tooltips, popovers, scrollbars, etc. en el nuevo contenido

          // Llamar a la función de inicialización específica de la página si existe
          if (typeof window.inicializarPaginaActual === 'function') {
            console.log(`Llamando a window.inicializarPaginaActual() para ${rutaPagina}`);
            try {
              window.inicializarPaginaActual();
            } catch (e) {
              console.error(`Error al ejecutar inicializarPaginaActual() para ${rutaPagina}:`, e);
            }
          } else {
            console.log(`No se encontró window.inicializarPaginaActual() para ${rutaPagina}.`);
          }

          window.scrollTo(0, 0); // Scroll al inicio de la página
          console.log(`Carga de contenido para ${rutaPagina}.php completada.`);
        })
        .catch((error) => {
          console.error("Error detallado al cargar contenido:", error);
          renderTarget.innerHTML = `
                    <div class="page-inner mt--5">
                        <div class="row mt--2"><div class="col-md-12"><div class="card full-height">
                        <div class="card-body text-center">
                            <div class="card-title h2 text-danger">Oops! Algo salió mal.</div>
                            <div class="card-category">No se pudo cargar: <code>${rutaPagina}.php</code></div>
                            <p class="mt-3"><strong>Detalle:</strong> ${error.message}</p>
                            <a href="index.php" class="btn btn-primary btn-round mt-3">Volver al Inicio</a>
                        </div></div></div></div>
                    </div>`;
          paginaActualCargada = null; // Resetear página actual en caso de error
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
      console.log("INDEX.PHP: DOM completamente cargado y parseado.");

      // Reinicializar componentes globales en el contenido estático inicial de index.php
      reinicializarComponentesGlobalesUI(document.body);

      const params = new URLSearchParams(window.location.search);
      const paginaInicial = params.get("page") || "home";

      console.log("INDEX.PHP: Cargando página inicial:", paginaInicial);
      cargarContenido(paginaInicial);

      document.body.addEventListener("click", function(e) { // Delegación de eventos en document.body
        const linkElement = e.target.closest(".menu-link[data-page]");
        if (linkElement) {
          e.preventDefault();
          const ruta = linkElement.getAttribute("data-page");
          if (ruta && ruta.trim() !== "" && ruta.trim() !== "#") {
            console.log("INDEX.PHP: Clic en menu-link, cargando ruta:", ruta);
            cargarContenido(ruta);

            const nuevaUrl = new URL(window.location.href);
            nuevaUrl.searchParams.set('page', ruta);
            history.pushState({
              page: ruta
            }, "", nuevaUrl.toString());
          } else {
            console.warn("INDEX.PHP: Clic en menu-link sin data-page válido o con '#':", linkElement);
          }
        }
      });

      window.addEventListener('popstate', function(event) {
        let pagina = "home";
        if (event.state && event.state.page) {
          pagina = event.state.page;
        } else {
          const paramsPop = new URLSearchParams(window.location.search);
          pagina = paramsPop.get('page') || "home";
        }
        console.log("INDEX.PHP: Evento popstate, cargando página:", pagina);
        cargarContenido(pagina);
      });
    });

    // Función para cargar modal (ejemplo, no directamente relacionada con la carga principal)
    function cargarModal(event) {
      event.preventDefault();
      // ... (tu lógica para cargar o mostrar un modal) ...
      console.log("Función cargarModal llamada.");
    }
  </script>































-- TABLA PROYECTOS
CREATE TABLE proyectos (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    nombre_proyecto VARCHAR(200) NOT NULL,
    eslogan VARCHAR(255),
    sector VARCHAR(100),
    region VARCHAR(150),
    ubicacion_lat DECIMAL(10, 8),
    ubicacion_lng DECIMAL(11, 8),
    resumen TEXT,
    problema TEXT,
    solucion TEXT,
    propuesta_valor TEXT,
    mercado_objetivo TEXT,
    tamano_mercado VARCHAR(255),
    competencia TEXT,
    ventajas TEXT,
    modelo_ingresos TEXT,
    monto_inversion DECIMAL(15, 2),
    valoracion VARCHAR(100),
    uso_fondos TEXT,
    etapa VARCHAR(50),
    hitos TEXT,
    logros TEXT,
    web VARCHAR(255),
    video VARCHAR(255),
    demo VARCHAR(255),
    contacto VARCHAR(150),
    correo_contacto VARCHAR(150),
    telefono VARCHAR(50),
    linkedin VARCHAR(255),
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'activo' CHECK (status IN ('activo', 'inactivo', 'destacado', 'finalizado'))
);

-- Tabla de logos de proyectos
CREATE TABLE logos_proyectos (
    id SERIAL PRIMARY KEY,
    proyecto_id INTEGER REFERENCES proyectos(id) ON DELETE CASCADE,
    ruta_archivo VARCHAR(255) NOT NULL,
    mimetype VARCHAR(100),
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de archivos de proyectos (pitch deck, plan de negocios, etc.)
CREATE TABLE archivos_proyectos (
    id SERIAL PRIMARY KEY,
    proyecto_id INTEGER REFERENCES proyectos(id) ON DELETE CASCADE,
    tipo_archivo VARCHAR(50) NOT NULL CHECK (tipo_archivo IN ('proyecciones', 'pitch', 'plan_negocio')),
    ruta_archivo VARCHAR(255) NOT NULL,
    nombre_original VARCHAR(255),
    mimetype VARCHAR(100),
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de imágenes de proyectos (galería)
CREATE TABLE imagenes_proyectos (
    id SERIAL PRIMARY KEY,
    proyecto_id INTEGER REFERENCES proyectos(id) ON DELETE CASCADE,
    ruta_archivo VARCHAR(255) NOT NULL,
    mimetype VARCHAR(100),
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla para miembros del equipo
CREATE TABLE miembros_equipo (
    id SERIAL PRIMARY KEY,
    proyecto_id INTEGER REFERENCES proyectos(id) ON DELETE CASCADE,
    nombre VARCHAR(100) NOT NULL,
    experiencia TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



--Crud academia cursos 

CREATE TABLE categorias (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

CREATE TABLE cursos (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    duracion VARCHAR(50),
    nivel VARCHAR(20),
    fecha_inicio DATE,
    fecha_fin DATE,
    modalidad VARCHAR(20),
    imagen_portada VARCHAR(255),
    logo VARCHAR(255),
    video_promocional VARCHAR(255),
    categoria_id INT,
    estado BOOLEAN DEFAULT TRUE,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Webinars  Crud

-- Primero, creamos la tabla de categorías para los webinars, si aún no existe una similar.
-- Esto permite una mejor organización y filtrado.
CREATE TABLE IF NOT EXISTS categorias_webinar (
    categoria_id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT,
    fecha_creacion TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- Comentario para la tabla de categorías
COMMENT ON TABLE categorias_webinar IS 'Tabla para almacenar las diferentes categorías de los webinars.';
COMMENT ON COLUMN categorias_webinar.nombre IS 'Nombre único de la categoría del webinar (ej: Marketing, Inversiones, Legal).';

-- Insertamos algunas categorías de ejemplo si la tabla está vacía
-- Puedes ajustar esto o eliminarlo si ya tienes datos o un mecanismo diferente para poblarlas.
INSERT INTO categorias_webinar (nombre)
SELECT 'Inversiones' WHERE NOT EXISTS (SELECT 1 FROM categorias_webinar WHERE nombre = 'Inversiones');
INSERT INTO categorias_webinar (nombre)
SELECT 'Marketing' WHERE NOT EXISTS (SELECT 1 FROM categorias_webinar WHERE nombre = 'Marketing');
INSERT INTO categorias_webinar (nombre)
SELECT 'Legal' WHERE NOT EXISTS (SELECT 1 FROM categorias_webinar WHERE nombre = 'Legal');
INSERT INTO categorias_webinar (nombre)
SELECT 'Tecnología' WHERE NOT EXISTS (SELECT 1 FROM categorias_webinar WHERE nombre = 'Tecnología');
INSERT INTO categorias_webinar (nombre)
SELECT 'Desarrollo Personal' WHERE NOT EXISTS (SELECT 1 FROM categorias_webinar WHERE nombre = 'Desarrollo Personal');


-- Ahora, la tabla principal para los webinars
CREATE TABLE IF NOT EXISTS webinars (
    webinar_id SERIAL PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    imagen_portada_url VARCHAR(512), -- URL o ruta a la imagen de portada
    categoria_id INT,
    fecha_hora_inicio TIMESTAMP WITH TIME ZONE NOT NULL, -- Fecha y hora exactas del webinar
    duracion_minutos INT, -- Duración estimada en minutos (opcional)
    formato VARCHAR(50) CHECK (formato IN ('En vivo', 'Grabacion', 'Interactivo', 'Hibrido')), -- Similar a tu data-formato
    ponente VARCHAR(255), -- Nombre del ponente principal o empresa
    estado VARCHAR(20) NOT NULL DEFAULT 'Programado' CHECK (estado IN ('Programado', 'Pasado', 'Cancelado', 'Borrador')), -- Similar a tu data-estado
    enlace_registro_url VARCHAR(512), -- URL para que los usuarios se registren
    enlace_grabacion_url VARCHAR(512), -- URL a la grabación del webinar, si aplica
    max_participantes INT, -- Límite de participantes (opcional)
    es_gratuito BOOLEAN NOT NULL DEFAULT TRUE,
    precio NUMERIC(10, 2) CHECK (precio >= 0), -- Precio si no es gratuito
    fecha_creacion TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_categoria_webinar
        FOREIGN KEY(categoria_id)
        REFERENCES categorias_webinar(categoria_id)
        ON DELETE SET NULL -- Si se borra una categoría, el webinar queda sin categoría pero no se borra. Podría ser ON DELETE RESTRICT.
        ON UPDATE CASCADE,

    -- Asegurar que el precio solo se establezca si no es gratuito
    CONSTRAINT chk_precio_gratuito
        CHECK ((es_gratuito = TRUE AND precio IS NULL) OR (es_gratuito = FALSE AND precio IS NOT NULL))
);

-- Comentarios para la tabla de webinars
COMMENT ON TABLE webinars IS 'Tabla para almacenar la información de los webinars ofrecidos.';
COMMENT ON COLUMN webinars.titulo IS 'Título principal del webinar.';
COMMENT ON COLUMN webinars.descripcion IS 'Descripción detallada del contenido del webinar.';
COMMENT ON COLUMN webinars.imagen_portada_url IS 'URL o ruta del archivo de la imagen de portada del webinar.';
COMMENT ON COLUMN webinars.categoria_id IS 'ID de la categoría a la que pertenece el webinar (referencia a categorias_webinar).';
COMMENT ON COLUMN webinars.fecha_hora_inicio IS 'Fecha y hora exactas en que inicia el webinar (con zona horaria).';
COMMENT ON COLUMN webinars.duracion_minutos IS 'Duración estimada del webinar en minutos.';
COMMENT ON COLUMN webinars.formato IS 'Formato del webinar (ej: En vivo, Grabacion, Interactivo).';
COMMENT ON COLUMN webinars.ponente IS 'Nombre del ponente, instructor o empresa que imparte el webinar.';
COMMENT ON COLUMN webinars.estado IS 'Estado actual del webinar (ej: Programado, Pasado, Cancelado, Borrador).';
COMMENT ON COLUMN webinars.enlace_registro_url IS 'URL a la plataforma o formulario de registro para el webinar.';
COMMENT ON COLUMN webinars.enlace_grabacion_url IS 'URL donde se puede acceder a la grabación del webinar (si está disponible).';
COMMENT ON COLUMN webinars.max_participantes IS 'Número máximo de participantes permitidos en el webinar.';
COMMENT ON COLUMN webinars.es_gratuito IS 'Indica si el webinar es gratuito (TRUE) o de pago (FALSE).';
COMMENT ON COLUMN webinars.precio IS 'Precio del webinar si no es gratuito.';
COMMENT ON COLUMN webinars.fecha_creacion IS 'Fecha y hora en que se registró el webinar en el sistema.';
COMMENT ON COLUMN webinars.fecha_actualizacion IS 'Fecha y hora de la última modificación del registro del webinar.';

-- Índices para mejorar el rendimiento de las búsquedas
CREATE INDEX IF NOT EXISTS idx_webinars_fecha_hora_inicio ON webinars (fecha_hora_inicio);
CREATE INDEX IF NOT EXISTS idx_webinars_estado ON webinars (estado);
CREATE INDEX IF NOT EXISTS idx_webinars_categoria_id ON webinars (categoria_id);
CREATE INDEX IF NOT EXISTS idx_webinars_titulo_fts ON webinars USING gin(to_tsvector('spanish', titulo)); -- Para búsqueda Full-Text en título
CREATE INDEX IF NOT EXISTS idx_webinars_descripcion_fts ON webinars USING gin(to_tsvector('spanish', descripcion)); -- Para búsqueda Full-Text en descripción


-- Para auto-actualizar fecha_actualizacion (Opcional, requiere una función y un trigger)
CREATE OR REPLACE FUNCTION trigger_set_timestamp()
RETURNS TRIGGER AS $$
BEGIN
  NEW.fecha_actualizacion = NOW();
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Trigger para la tabla categorias_webinar
CREATE TRIGGER set_timestamp_categorias_webinar
BEFORE UPDATE ON categorias_webinar
FOR EACH ROW
EXECUTE FUNCTION trigger_set_timestamp();

-- Trigger para la tabla webinars
CREATE TRIGGER set_timestamp_webinars
BEFORE UPDATE ON webinars
FOR EACH ROW
EXECUTE FUNCTION trigger_set_timestamp();



-- base de datos subir proyectos---

CREATE TABLE proyectos (
    id SERIAL PRIMARY KEY,
    nombre_proyecto VARCHAR(255),
    logo VARCHAR(255),
    eslogan VARCHAR(255),
    sector VARCHAR(100),
    region VARCHAR(100),
    ubicacion TEXT,
    
    resumen TEXT,
    problema TEXT,
    solucion TEXT,
    propuesta_valor TEXT,

    mercado_objetivo TEXT,
    tamano_mercado VARCHAR(100),
    competencia TEXT,
    ventajas TEXT,

    modelo_ingresos TEXT,

    monto_inversion NUMERIC(15, 2),
    valoracion VARCHAR(100),
    uso_fondos TEXT,
    proyecciones_pdf VARCHAR(255),

    etapa VARCHAR(50),
    hitos VARCHAR(255),
    logros TEXT,

    pitch_pdf VARCHAR(255),
    plan_negocios VARCHAR(255),
    sitio_web VARCHAR(255),
    video_pitch VARCHAR(255),
    demo_url VARCHAR(255),
    imagenes JSON,

    contacto_nombre VARCHAR(100),
    contacto_correo VARCHAR(100),
    contacto_telefono VARCHAR(50),
    linkedin VARCHAR(255),

    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


