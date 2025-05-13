<?php
// backend-php/get_emprendedores.php

header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php'; // Ajusta la ruta a tu archivo de conexión

$emprendedores = [];
$response = ['success' => false, 'message' => 'No se pudieron cargar los emprendedores.', 'data' => []];

try {
    // Asumiendo que tienes una columna 'rol' en tu tabla 'usuarios'
    // y que el rol de los emprendedores es 'Emprendedor'
    $query = "SELECT id, nombre_completo, foto_perfil_url, telefono, municipio 
              FROM usuarios 
              WHERE rol = 'Emprendedor' 
              ORDER BY nombre_completo ASC"; // O el orden que prefieras

    $result = pg_query($conn, $query);

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            // Asegurar que foto_perfil_url tenga un valor por defecto si está vacía o es null
            if (empty(trim($row['foto_perfil_url']))) {
                $row['foto_perfil_url'] = 'assets/img/profile-signin.jpg'; // Tu imagen por defecto
            }
            // Puedes formatear el teléfono o la ubicación aquí si es necesario
            $emprendedores[] = $row;
        }
        $response['success'] = true;
        $response['message'] = 'Emprendedores cargados exitosamente.';
        $response['data'] = $emprendedores;
    } else {
        $response['message'] = 'Error al ejecutar la consulta: ' . pg_last_error($conn);
        error_log('Error en get_emprendedores.php: ' . pg_last_error($conn));
    }

} catch (Exception $e) {
    $response['message'] = 'Excepción: ' . $e->getMessage();
    error_log('Excepción en get_emprendedores.php: ' . $e->getMessage());
}

if ($conn) {
    pg_close($conn);
}

echo json_encode($response);
?>