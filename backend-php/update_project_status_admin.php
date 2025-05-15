<?php
// backend-php/update_project_status_admin.php

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/database.php';

if (session_status() == PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['user_id']) || strcasecmp($_SESSION['user_role'] ?? '', 'Administrador') != 0) {
    echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
    exit;
}

$response = ['success' => false, 'message' => 'No se recibieron datos válidos.'];

if (isset($_POST['cambios_estado'])) {
    $cambios_json = $_POST['cambios_estado'];
    $cambios = json_decode($cambios_json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        $response['message'] = 'Error al decodificar los datos JSON de estados: ' . json_last_error_msg();
        echo json_encode($response);
        exit;
    }

    if (is_array($cambios) && !empty($cambios)) {
        if (!$conn) {
            $response['message'] = "Error de conexión a la base de datos.";
            echo json_encode($response);
            exit;
        }

        pg_query($conn, "BEGIN");
        $sql_update = "UPDATE proyectos SET estado = $1 WHERE id_proyecto = $2";
        $stmt_name_update = "update_project_status";
        
        $prepare_ok = pg_prepare($conn, $stmt_name_update, $sql_update);
        if (!$prepare_ok) {
            pg_query($conn, "ROLLBACK");
            $response['message'] = "Error al preparar la actualización de estado: " . pg_last_error($conn);
            echo json_encode($response);
            if ($conn) pg_close($conn);
            exit;
        }

        $errores = 0;
        $actualizados_count = 0;
        $posibles_estados_validos = ['pendiente', 'aprobado', 'activo', 'rechazado', 'finalizado', 'en_revision']; // Valida contra estos

        foreach ($cambios as $cambio) {
            if (isset($cambio['id_proyecto'], $cambio['nuevo_estado']) && 
                is_numeric($cambio['id_proyecto']) && 
                in_array(strtolower($cambio['nuevo_estado']), $posibles_estados_validos)) {
                
                $id_proyecto = (int)$cambio['id_proyecto'];
                $nuevo_estado = strtolower(trim($cambio['nuevo_estado'])); // Guardar en minúsculas o como definas

                error_log("ADMIN UPDATE STATUS: Proyecto ID {$id_proyecto}, Nuevo Estado: {$nuevo_estado}");
                $result_update = pg_execute($conn, $stmt_name_update, [$nuevo_estado, $id_proyecto]);
                
                if (!$result_update) {
                    $errores++;
                    error_log("ADMIN UPDATE STATUS ERROR: Proyecto ID {$id_proyecto}. DB Error: " . pg_last_error($conn));
                } elseif (pg_affected_rows($result_update) > 0) {
                    $actualizados_count++;
                }
            } else {
                 error_log("ADMIN UPDATE STATUS WARNING: Item de cambio de estado malformado: " . print_r($cambio, true));
            }
        }

        if ($errores === 0) {
            pg_query($conn, "COMMIT");
            $response['success'] = true;
            $response['message'] = "Estados de {$actualizados_count} proyectos actualizados correctamente.";
        } else {
            pg_query($conn, "ROLLBACK");
            $response['message'] = "Se produjeron {$errores} errores. No todos los estados se actualizaron.";
        }
    } else {
        $response['message'] = 'Formato de datos de cambios de estado incorrecto o vacío.';
    }
} else {
    $response['message'] = 'No se recibieron datos `cambios_estado`.';
}

if (isset($conn) && $conn) { pg_close($conn); }
echo json_encode($response);
?>