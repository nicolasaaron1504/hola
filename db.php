<?php
// Configuración de acceso
$host = "localhost";
$user = "admisn"; // Usuario solicitado: admisn
$pass = "1234";   // Contraseña solicitada: 1234
$db   = "sistema_web";

// Intentar establecer la conexión
$conexion = mysqli_connect($host, $user, $pass, $db);

// Verificar la conexión
if (!$conexion) {
    // Si falla, muestra el error específico de MySQL
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres a UTF-8 para evitar errores con tildes o la ñ
mysqli_set_charset($conexion, "utf8");
?>
