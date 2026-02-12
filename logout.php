<?php
// 1. Iniciamos la sesión para poder acceder a ella
session_start();

// 2. Vaciamos todas las variables de sesión (como el nombre de usuario)
$_SESSION = array();

// 3. Destruimos la sesión por completo en el servidor
session_destroy();

// 4. Redirigimos al usuario al login inmediatamente
header("Location: login.php");
exit();
?>
