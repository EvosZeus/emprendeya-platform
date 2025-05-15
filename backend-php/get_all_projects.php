<?php
// backend-php/get_all_projects.php

header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

// --- Parámetros de Paginación y Filtro ---
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$proyectos_por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 9; // Mostrar 9 proyectos por página (3x3 grid)
if ($proyectos_por_pagina > 50) $proyectos_por_pagina = 50; // Límite máximo
if ($proyectos_por_pagina < 1) $proyectos_por_pagina = 9;
if ($pagina_actual < 1) $pagina_actual = 1;
$offset = ($pagina_actual - 1) * $proyectos_por_pagina;

// Filtros
$buscar_nombre = isset($_GET['buscar']) ? pg_escape_string(trim($_GET['buscar'])) : '';
$filtro_sector = isset($_GET['sector']) && $_GET['sector'] !== 'todos' ? pg_escape_string(trim($_GET['sector'])) : '';

$proyectos = [];
$total_proyectos_filtrados = 0;
$response = ['success' => false, 'message' => 'No se pudieron cargar los proyectos.', 'data' => [], 'pagination' => null];

try {
    if (!$conn) {
        throw new Exception("Error de conexión a la base de datos.");
    }

    // --- Construir Cláusula WHERE dinámicamente ---
    $where_clauses = ["(p.estado ILIKE 'aprobado' OR p.estado ILIKE 'activo')"]; // Siempre filtrar por estado visible
    $params_query = [];
    $param_idx = 1;

    if (!empty($buscar_nombre)) {
        $where_clauses[] = "p.nombre_proyecto ILIKE $" . $param_idx++;
        $params_query[] = '%' . $buscar_nombre . '%';
    }
    if (!empty($filtro_sector)) {
        $where_clauses[] = "p.sector ILIKE $" . $param_idx++;
        $params_query[] = $filtro_sector;
    }

    $where_sql = "";
    if (count($where_clauses) > 0) {
        $where_sql = "WHERE " . implode(" AND ", $where_clauses);
    }

    // --- Consulta para Contar Total de Proyectos Filtrados (para paginación) ---
    $sql_count = "SELECT COUNT(p.id_proyecto) AS total 
                  FROM proyectos p 
                  JOIN usuarios u ON p.usuario_id = u.id 
                  $where_sql";
    
    $result_count = pg_query_params($conn, $sql_count, $params_query);
    if ($result_count) {
        $total_proyectos_filtrados = (int)pg_fetch_assoc($result_count)['total'];
    } else {
        throw new Exception("Error al contar proyectos: " . pg_last_error($conn));
    }

    // --- Consulta para Obtener los Proyectos de la Página Actual ---
    $sql_data = "SELECT 
                    p.id_proyecto, 
                    p.nombre_proyecto,
                    p.logo AS logo_proyecto,
                    p.resumen,
                    p.sector,
                    p.etapa,
                    p.eslogan,
                    p.monto_inversion,
                    p.fecha_creacion,
                    p.contacto_nombre AS contacto_proyecto_nombre, -- Nombre de contacto del proyecto
                    u.nombre_completo AS nombre_creador -- Nombre del usuario creador
                 FROM 
                    proyectos p
                 JOIN 
                    usuarios u ON p.usuario_id = u.id 
                 $where_sql
                 ORDER BY p.fecha_creacion DESC
                 LIMIT $" . $param_idx++ . " OFFSET $" . $param_idx++;
    
    $params_query_data = array_merge($params_query, [$proyectos_por_pagina, $offset]);

    $result_data = pg_query_params($conn, $sql_data, $params_query_data);

    if ($result_data) {
        while ($row = pg_fetch_assoc($result_data)) {
            $row['logo_proyecto'] = !empty(trim($row['logo_proyecto'])) ? htmlspecialchars(trim($row['logo_proyecto']), ENT_QUOTES, 'UTF-8') : 'assets/img/examples/project_default.png';
            $row['nombre_proyecto'] = htmlspecialchars($row['nombre_proyecto'] ?? 'Proyecto sin Título', ENT_QUOTES, 'UTF-8');
            $row['sector'] = htmlspecialchars($row['sector'] ?? 'General', ENT_QUOTES, 'UTF-8');
            $row['etapa'] = htmlspecialchars($row['etapa'] ?? 'N/A', ENT_QUOTES, 'UTF-8');
            $resumen_completo = $row['resumen'] ?? '';
            $row['resumen_acortado'] = htmlspecialchars(substr($resumen_completo, 0, 100) . (strlen($resumen_completo) > 100 ? '...' : ''), ENT_QUOTES, 'UTF-8');
            $row['monto_inversion_formateado'] = !empty($row['monto_inversion']) ? '$' . number_format($row['monto_inversion'], 0, ',', '.') : 'No especificado';
            
            if (!empty($row['fecha_creacion'])) {
                $date = new DateTime($row['fecha_creacion']);
                $row['fecha_formateada'] = $date->format('d M, Y');
            } else {
                $row['fecha_formateada'] = 'N/A';
            }
            $row['nombre_creador'] = htmlspecialchars($row['nombre_creador'] ?? 'Anónimo', ENT_QUOTES, 'UTF-8');
            $row['contacto_proyecto_nombre'] = htmlspecialchars($row['contacto_proyecto_nombre'] ?? $row['nombre_creador'], ENT_QUOTES, 'UTF-8'); // Usar nombre del creador si no hay contacto específico del proyecto

            // Simulación de progreso (deberías tener esto en tu DB o calcularlo)
            $row['progreso_simulado'] = rand(20, 95);

            $proyectos[] = $row;
        }
        
        $response['success'] = true;
        $response['message'] = 'Proyectos cargados.';
        $response['data'] = $proyectos;
        $response['pagination'] = [
            'total_items' => $total_proyectos_filtrados,
            'por_pagina' => $proyectos_por_pagina,
            'pagina_actual' => $pagina_actual,
            'total_paginas' => ceil($total_proyectos_filtrados / $proyectos_por_pagina)
        ];

    } else {
        throw new Exception("Error al obtener datos de proyectos: " . pg_last_error($conn));
    }

} catch (Exception $e) {
    $response['message'] = 'Excepción: ' . $e->getMessage();
    error_log('Excepción en get_all_projects.php: ' . $e->getMessage());
}

if ($conn) {
    pg_close($conn);
}

echo json_encode($response);
?>