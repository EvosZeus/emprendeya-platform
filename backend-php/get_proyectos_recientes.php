<?php
// backend-php/get_proyectos_recientes.php

header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

$proyectos = [];
$response = ['success' => false, 'message' => 'No se pudieron cargar los proyectos.', 'data' => []];

try {
    // Consulta para obtener proyectos recientes junto con información del emprendedor
    // Asumimos que quieres los proyectos más recientes, ordenados por fecha_creacion
    // y solo aquellos que estén en un estado "aprobado" o "activo" (ajusta según tu lógica de estados)
    $query = "SELECT 
                p.id_proyecto, 
                p.nombre_proyecto,
                p.logo AS logo_proyecto, -- Logo del proyecto
                p.resumen, -- O p.descripcion_corta si es más apropiado
                p.sector,
                p.fecha_creacion,
                p.contacto_correo AS contacto_proyecto_correo,
                p.contacto_telefono AS contacto_proyecto_telefono,
                u.nombre_completo AS nombre_emprendedor,
                u.foto_perfil_url AS foto_emprendedor
              FROM 
                proyectos p
              JOIN 
                usuarios u ON p.usuario_id = u.id
              WHERE 
                p.estado = 'aprobado' OR p.estado = 'activo' -- O los estados que consideres visibles
              ORDER BY 
                p.fecha_creacion DESC
              LIMIT 6"; // Muestra los 6 más recientes, por ejemplo

    $result = pg_query($conn, $query);

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            // Formatear fecha
            if (!empty($row['fecha_creacion'])) {
                $date = new DateTime($row['fecha_creacion']);
                // Formato deseado: "01 Jan, 2024" (Día Mes, Año)
                // Para el mes en español, necesitarías configurar el locale o mapear
                // setlocale(LC_TIME, 'es_ES.UTF-8'); // Intenta esto, puede no funcionar en todos los servidores
                // $row['fecha_formateada'] = strftime('%d %b, %Y', $date->getTimestamp()); 
                // Alternativa más simple sin locale (mes en inglés):
                $row['fecha_formateada'] = $date->format('d M, Y');
            } else {
                $row['fecha_formateada'] = 'Fecha no disponible';
            }

            // URLs de imágenes por defecto
            $row['logo_proyecto'] = !empty(trim($row['logo_proyecto'])) ? htmlspecialchars(trim($row['logo_proyecto']), ENT_QUOTES, 'UTF-8') : 'assets/img/examples/project_default.png'; // Default para logo de proyecto
            $row['foto_emprendedor'] = !empty(trim($row['foto_emprendedor'])) ? htmlspecialchars(trim($row['foto_emprendedor']), ENT_QUOTES, 'UTF-8') : 'assets/img/profile-signin.jpg'; // Default para foto de emprendedor
            
            $row['nombre_proyecto'] = htmlspecialchars($row['nombre_proyecto'] ?? 'Proyecto sin Título', ENT_QUOTES, 'UTF-8');
            $row['nombre_emprendedor'] = htmlspecialchars($row['nombre_emprendedor'] ?? 'Emprendedor Anónimo', ENT_QUOTES, 'UTF-8');
            $row['sector'] = htmlspecialchars($row['sector'] ?? 'General', ENT_QUOTES, 'UTF-8');
            $row['resumen'] = htmlspecialchars(substr($row['resumen'] ?? '', 0, 180) . (strlen($row['resumen'] ?? '') > 180 ? '...' : ''), ENT_QUOTES, 'UTF-8');


            $proyectos[] = $row;
        }
        $response['success'] = true;
        $response['message'] = 'Proyectos cargados exitosamente.';
        $response['data'] = $proyectos;
    } else {
        $response['message'] = 'Error al ejecutar la consulta: ' . pg_last_error($conn);
        error_log('Error en get_proyectos_recientes.php: ' . pg_last_error($conn));
    }

} catch (Exception $e) {
    $response['message'] = 'Excepción: ' . $e->getMessage();
    error_log('Excepción en get_proyectos_recientes.php: ' . $e->getMessage());
}

if ($conn) {
    pg_close($conn);
}

echo json_encode($response);
?>