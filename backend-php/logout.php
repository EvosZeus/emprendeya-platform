<?php
// 1. Iniciar o reanudar la sesión existente.
//    Es necesario para poder acceder a la sesión y destruirla.
//    ¡DEBE SER LO PRIMERO, ANTES DE CUALQUIER SALIDA!
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. Eliminar todas las variables de sesión.
//    Esto vacía el array $_SESSION.
$_SESSION = array();

// 3. Si se desea destruir la sesión completamente, también es buena idea
//    borrar la cookie de sesión.
//    Nota: ¡Esto destruirá la sesión, y no solo los datos de la sesión!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, // Poner tiempo en el pasado para expirar
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Finalmente, destruir la sesión del servidor.
session_destroy();

// 5. Redirigir al usuario a una página apropiada (ej. la página de inicio o de login).
//    Asegúrate de que no haya salida HTML antes de este header().
header("Location: ../landing.html"); // ".." sube un nivel desde 'backend/' a la raíz
exit;
?>