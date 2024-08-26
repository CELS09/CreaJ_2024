<?php
session_start();

// Eliminar todos los datos de la sesión
$_SESSION = array();

// Eliminar la cookie de sesión si existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '', 
        time() - 42000, // Tiempo en el pasado para asegurar la eliminación
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redirigir al formulario de inicio de sesión
header("Location: ../index.php");
exit;
?>
