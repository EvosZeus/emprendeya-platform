<?php
// backend-php/get_all_projects_for_admin.php (Modificado)

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id']) || strcasecmp($_SESSION['user_role'] ?? '', 'Administrador') != 0) {
    echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
    exit;
}

$buscar_term = isset($_GET['buscar']) ? pg_escape_string($conn, trim($_GET['buscar'])) : '';
$filtro_estado_admin = isset($_GET['estado_filtro']) && $_GET['estado_filtro'] !== 'todos' ? pg_escape_string($conn, trim($_GET['estado_filtro'])) : '';


$proyectos_admin = [];
$response = ['success' => false, 'message' => 'No se pudieron cargar los proyectos para administración.', 'data' => []];

try {
    if (!$conn) {
        throw new Exception("Error de conexión.");
    }

    // Añadimos nombre_creador al SELECT
    $sql = "SELECT p.id_proyecto, p.nombre_proyecto, p.es_destacado, p.estado, u.nombre_completo as nombre_creador
            FROM proyectos p
            LEFT JOIN usuarios u ON p.usuario_id = u.id "; // LEFT JOIN por si algún proyecto no tuviera creador (aunque no debería)

    $params = [];
    $where_clauses = [];
    $param_idx_counter = 1;


    if (!empty($buscar_term)) {
        $where_clauses[] = "p.nombre_proyecto ILIKE $" . $param_idx_counter++;
        $params[] = '%' . $buscar_term . '%';
    }
    if (!empty($filtro_estado_admin)) {
        $where_clauses[] = "p.estado ILIKE $" . $param_idx_counter++;
        $params[] = $filtro_estado_admin;
    }


    if (count($where_clauses) > 0) {
        $sql .= " WHERE " . implode(" AND ", $where_clauses);
    }

    $sql .= " ORDER BY p.fecha_creacion DESC, p.nombre_proyecto ASC"; // Ordenar por fecha y luego nombre
    // Podrías añadir paginación aquí si la lista de proyectos es muy larga para el modal

    $result = empty($params) ? pg_query($conn, $sql) : pg_query_params($conn, $sql, $params);

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            // Convertir el valor de la base de datos (que podría ser 't', 'f', 1, 0, o incluso NULL)
            // a un booleano PHP estricto.
            $es_destacado_php_bool = false; // Default
            if (isset($row['es_destacado'])) {
                $val = strtolower(trim((string)$row['es_destacado']));
                if ($val === 't' || $val === 'true' || $val === '1' || $val === 'on' || $val === 'yes') {
                    $es_destacado_php_bool = true;
                }
            }

            $proyectos_admin[] = [
                'id_proyecto' => $row['id_proyecto'],
                'nombre_proyecto' => htmlspecialchars($row['nombre_proyecto'], ENT_QUOTES, 'UTF-8'),
                'es_destacado' => $es_destacado_php_bool, // <--- ENVIAR COMO BOOLEANO PHP
                'estado' => htmlspecialchars($row['estado'], ENT_QUOTES, 'UTF-8'),
                'nombre_creador' => htmlspecialchars($row['nombre_creador'] ?? 'N/A', ENT_QUOTES, 'UTF-8')
            ];
        }
        $response['success'] = true;
        $response['message'] = 'Proyectos cargados para administración.';
        $response['data'] = $proyectos_admin;
    }
} catch (Exception $e) {
    $response['message'] = 'Excepción: ' . $e->getMessage();
}

if ($conn) {
    pg_close($conn);
}
echo json_encode($response);
