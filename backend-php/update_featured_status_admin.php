<?php
// backend-php/update_featured_status_admin.php

// Para desarrollo: mostrar todos los errores
// En producción, cambia display_errors a 0 y confía en los logs.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/database.php'; // Asegúrate que esta ruta sea correcta

// --- Autenticación de Admin ---
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id']) || strcasecmp($_SESSION['user_role'] ?? '', 'Administrador') != 0) {
    error_log("UpdateFeatured: Intento de acceso no autorizado. User ID: " . ($_SESSION['user_id'] ?? 'No logueado') . ", Rol: " . ($_SESSION['user_role'] ?? 'N/A'));
    echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
    exit;
}

$response = ['success' => false, 'message' => 'No se recibieron datos válidos o ha ocurrido un error inesperado.'];

if (isset($_POST['cambios'])) {
    $cambios_json = $_POST['cambios'];
    $cambios = json_decode($cambios_json, true); // true para array asociativo

    if (json_last_error() !== JSON_ERROR_NONE) {
        $response['message'] = 'Error al decodificar los datos JSON: ' . json_last_error_msg();
        error_log("UpdateFeatured: Error de decodificación JSON - " . json_last_error_msg() . ". Datos recibidos: " . $cambios_json);
        echo json_encode($response);
        exit;
    }

    if (is_array($cambios) && !empty($cambios)) {
        if (!$conn) {
            $response['message'] = "Error crítico: No se pudo establecer la conexión con la base de datos.";
            error_log("UpdateFeatured: Fallo de conexión a la base de datos (variable \$conn no establecida desde config/database.php).");
            echo json_encode($response);
            exit;
        }

        // Iniciar transacción
        $begin_transaction = pg_query($conn, "BEGIN");
        if (!$begin_transaction) {
            $db_error = pg_last_error($conn);
            $response['message'] = "Error al iniciar la transacción: " . $db_error;
            error_log("UpdateFeatured: Fallo al iniciar transacción (BEGIN) - " . $db_error);
            echo json_encode($response);
            if ($conn) pg_close($conn); // Cerrar conexión si se abrió
            exit;
        }

        // Sentencia SQL para actualizar el estado 'es_destacado'
        $sql_update = "UPDATE proyectos SET es_destacado = $1 WHERE id_proyecto = $2";
        // Usar un nombre único para la sentencia preparada para evitar conflictos si se redefine
        $stmt_name_update = "update_proyecto_destacado_status"; 
        
        $prepare_ok = pg_prepare($conn, $stmt_name_update, $sql_update);
        if (!$prepare_ok) {
            pg_query($conn, "ROLLBACK"); // Revertir transacción
            $db_error = pg_last_error($conn);
            $response['message'] = "Error al preparar la consulta de actualización: " . $db_error;
            error_log("UpdateFeatured: Fallo en pg_prepare() - " . $db_error . ". SQL: " . $sql_update);
            echo json_encode($response);
            if ($conn) pg_close($conn);
            exit;
        }

        $errores_ejecucion = 0;
        $proyectos_actualizados_count = 0;

        foreach ($cambios as $cambio) {
            if (isset($cambio['id_proyecto']) && isset($cambio['es_destacado']) && is_numeric($cambio['id_proyecto']) && is_bool($cambio['es_destacado'])) {
                $id_proyecto = (int)$cambio['id_proyecto'];
                $es_destacado_js_bool = $cambio['es_destacado']; // Ya debería ser un booleano true/false desde JS
                
                // PostgreSQL BOOLEAN acepta 'TRUE', 'FALSE', true, false.
                // Pasarlo como booleano PHP es lo más directo con pg_execute.
                $valor_booleano_para_db = $es_destacado_js_bool;

                error_log("UpdateFeatured: Procesando proyecto ID: {$id_proyecto}. Nuevo estado 'es_destacado': " . ($valor_booleano_para_db ? 'TRUE' : 'FALSE'));

                $result_update = pg_execute($conn, $stmt_name_update, [$valor_booleano_para_db, $id_proyecto]);
                
                if (!$result_update) {
                    $errores_ejecucion++;
                    error_log("UpdateFeatured: ERROR al actualizar proyecto ID {$id_proyecto}. DB Error: " . pg_last_error($conn));
                    // Podrías decidir romper el bucle aquí si un error es crítico
                    // break; 
                } else {
                    // Verificar si alguna fila fue afectada (opcional, pero bueno para confirmar)
                    if (pg_affected_rows($result_update) > 0) {
                        error_log("UpdateFeatured: ÉXITO al actualizar proyecto ID {$id_proyecto} a es_destacado = " . ($valor_booleano_para_db ? 'TRUE' : 'FALSE'));
                        $proyectos_actualizados_count++;
                    } else {
                        // Esto podría pasar si el id_proyecto no existe o el valor ya era el mismo.
                        error_log("UpdateFeatured: ADVERTENCIA - Ninguna fila afectada para proyecto ID {$id_proyecto} con es_destacado = " . ($valor_booleano_para_db ? 'TRUE' : 'FALSE') . ". ¿Existe el ID o el valor ya era ese?");
                    }
                }
            } else {
                error_log("UpdateFeatured: ADVERTENCIA - Item de cambio malformado o incompleto recibido: " . print_r($cambio, true));
                // Opcionalmente, contar esto como un error si la estructura de datos es crítica.
                // $errores_ejecucion++; 
            }
        }

        if ($errores_ejecucion === 0) {
            $commit_ok = pg_query($conn, "COMMIT");
            if ($commit_ok) {
                $response['success'] = true;
                $response['message'] = "Estado de proyectos destacados actualizado. {$proyectos_actualizados_count} proyectos afectados.";
            } else {
                 pg_query($conn, "ROLLBACK"); // Asegurar rollback si el COMMIT falla
                 $db_error = pg_last_error($conn);
                 $response['message'] = "Error al confirmar los cambios (COMMIT): " . $db_error;
                 error_log("UpdateFeatured: Fallo en COMMIT - " . $db_error);
            }
        } else {
            pg_query($conn, "ROLLBACK");
            $response['message'] = "Se produjeron {$errores_ejecucion} errores al actualizar algunos proyectos. No se guardaron todos los cambios.";
        }

    } else {
        $response['message'] = 'Formato de datos de cambios incorrecto, vacío o no es un array.';
        error_log("UpdateFeatured: El array de 'cambios' no es válido o está vacío. POST data: " . print_r($_POST, true));
    }
} else {
     $response['message'] = 'No se recibieron datos de cambios (`$_POST[\'cambios\']` no está seteado).';
     error_log("UpdateFeatured: No se encontró \$_POST['cambios'].");
}

if (isset($conn) && $conn) { // Solo cerrar si $conn fue establecido y no se cerró antes
    pg_close($conn);
}
echo json_encode($response);
?>