<?php
// backend-php/get_nuevos_proyectos.php

// Para desarrollo: mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/database.php';

// Parámetros de Paginación y Filtro (puedes mantenerlos si son útiles para esta vista)
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$proyectos_por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 9; // Ajusta según necesidad
if ($proyectos_por_pagina > 50) $proyectos_por_pagina = 50;
if ($proyectos_por_pagina < 1) $proyectos_por_pagina = 9;
if ($pagina_actual < 1) $pagina_actual = 1;
$offset = ($pagina_actual - 1) * $proyectos_por_pagina;

$buscar_nombre = isset($_GET['buscar']) ? pg_escape_string($conn, trim($_GET['buscar'])) : '';
$filtro_sector = isset($_GET['sector']) && $_GET['sector'] !== 'todos' ? pg_escape_string($conn, trim($_GET['sector'])) : '';


$proyectos_data = []; // Renombrado para evitar confusión con un posible $proyectos global
$total_proyectos_filtrados = 0;
$response = ['success' => false, 'message' => 'No se pudieron cargar los proyectos nuevos.', 'data' => [], 'pagination' => null];

try {
    if (!$conn) {
        throw new Exception("Error de conexión a la base de datos.");
    }

    $where_clauses = ["(p.estado ILIKE 'aprobado' OR p.estado ILIKE 'activo')"]; // Solo proyectos visibles
    $params_query = [];
    $param_idx_counter = 1;

    if (!empty($buscar_nombre)) {
        $where_clauses[] = "p.nombre_proyecto ILIKE $" . $param_idx_counter++;
        $params_query[] = '%' . $buscar_nombre . '%';
    }
    if (!empty($filtro_sector)) {
        $where_clauses[] = "p.sector ILIKE $" . $param_idx_counter++;
        $params_query[] = $filtro_sector;
    }

    $where_sql = "WHERE " . implode(" AND ", $where_clauses);

    $sql_count = "SELECT COUNT(p.id_proyecto) AS total 
                  FROM proyectos p 
                  JOIN usuarios u ON p.usuario_id = u.id 
                  $where_sql";
    
    $result_count = pg_query_params($conn, $sql_count, $params_query);
    if ($result_count) {
        $count_row = pg_fetch_assoc($result_count);
        $total_proyectos_filtrados = isset($count_row['total']) ? (int)$count_row['total'] : 0;
    } else {
        throw new Exception("Error al contar proyectos nuevos: " . pg_last_error($conn));
    }

    $params_query_data = $params_query;
    $params_query_data[] = $proyectos_por_pagina;
    $params_query_data[] = $offset;
    
    $limit_placeholder = $param_idx_counter++;
    $offset_placeholder = $param_idx_counter++;

    $sql_data = "SELECT 
                    p.id_proyecto, p.nombre_proyecto, p.logo AS logo_proyecto, p.resumen, p.eslogan,
                    p.sector, p.etapa, p.monto_inversion, p.fecha_creacion,
                    p.contacto_nombre AS contacto_proyecto_nombre,
                    u.nombre_completo AS nombre_creador,
                    u.email AS email_creador
                 FROM proyectos p
                 JOIN usuarios u ON p.usuario_id = u.id 
                 $where_sql
                 ORDER BY p.fecha_creacion DESC -- Clave: Ordenar por fecha de creación descendente
                 LIMIT $" . $limit_placeholder . " OFFSET $" . $offset_placeholder;
    
    $result_data = pg_query_params($conn, $sql_data, $params_query_data);

    if ($result_data) {
        while ($row = pg_fetch_assoc($result_data)) {
            // Procesamiento de datos (idéntico a get_all_projects.php o get_destacados.php)
            $row['logo_proyecto'] = !empty(trim($row['logo_proyecto'])) ? htmlspecialchars(trim($row['logo_proyecto']), ENT_QUOTES, 'UTF-8') : 'assets/img/examples/project_default.png';
            $row['nombre_proyecto'] = htmlspecialchars($row['nombre_proyecto'] ?? 'Proyecto sin Título', ENT_QUOTES, 'UTF-8');
            $row['eslogan'] = htmlspecialchars($row['eslogan'] ?? '', ENT_QUOTES, 'UTF-8');
            $row['sector'] = htmlspecialchars($row['sector'] ?? 'General', ENT_QUOTES, 'UTF-8');
            $row['etapa'] = htmlspecialchars($row['etapa'] ?? 'N/A', ENT_QUOTES, 'UTF-8');
            $resumen_completo = $row['resumen'] ?? '';
            $row['resumen_acortado'] = htmlspecialchars(substr($resumen_completo, 0, 100) . (strlen($resumen_completo) > 100 ? '...' : ''), ENT_QUOTES, 'UTF-8');
            $row['monto_inversion_formateado'] = !empty($row['monto_inversion']) ? '$' . number_format((float)$row['monto_inversion'], 0, ',', '.') : 'No especificado';
            if (!empty($row['fecha_creacion'])) {
                try {
                    $date = new DateTime($row['fecha_creacion']);
                    $row['fecha_formateada'] = $date->format('d M, Y');
                } catch (Exception $dateEx) {
                    $row['fecha_formateada'] = 'Fecha inválida';
                }
            } else {
                $row['fecha_formateada'] = 'N/A';
            }
            $row['nombre_creador'] = htmlspecialchars($row['nombre_creador'] ?? 'Anónimo', ENT_QUOTES, 'UTF-8');
            $row['email_creador'] = htmlspecialchars($row['email_creador'] ?? '', ENT_QUOTES, 'UTF-8');
            $row['contacto_proyecto_nombre'] = htmlspecialchars($row['contacto_proyecto_nombre'] ?? $row['nombre_creador'], ENT_QUOTES, 'UTF-8');
            $row['progreso_simulado'] = rand(10, 70); // Progreso simulado podría ser menor para proyectos nuevos
            $proyectos_data[] = $row;
        }
        
        $response['success'] = true;
        $response['message'] = 'Proyectos nuevos cargados.';
        $response['data'] = $proyectos_data;
        $response['pagination'] = [
            'total_items' => $total_proyectos_filtrados,
            'por_pagina' => $proyectos_por_pagina,
            'pagina_actual' => $pagina_actual,
            'total_paginas' => ($proyectos_por_pagina > 0 ? ceil($total_proyectos_filtrados / $proyectos_por_pagina) : 0)
        ];
    } else {
        throw new Exception("Error al obtener datos de proyectos nuevos: " . pg_last_error($conn));
    }

} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Excepción del servidor: ' . $e->getMessage();
    error_log('Excepción en get_nuevos_proyectos.php: ' . $e->getMessage());
}

if (isset($conn) && $conn) {
    pg_close($conn);
}

echo json_encode($response);
?>