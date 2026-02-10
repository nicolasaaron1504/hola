<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // 1. Validar vacíos
    if (empty($nombre) || empty($apellidos) || empty($email) || empty($usuario) || empty($password)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // 2. Validar correo (@)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Formato de correo inválido.");
    }

    // 3. Validar Contraseña (8 caracteres, Mayús, Minús y guion)
    $mayus = preg_match('/[A-Z]/', $password);
    $minus = preg_match('/[a-z]/', $password);
    $guion = strpos($password, '-') !== false;
    $largo = strlen($password) >= 8;

    if (!$mayus || !$minus || !$guion || !$largo) {
        die("Error: La contraseña requiere 8 caracteres, una Mayúscula, una minúscula y un guion (-).");
    }

    // 4. Guardar
    $p_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, apellidos, email, usuario, password) VALUES ('$nombre', '$apellidos', '$email', '$usuario', '$p_hash')";

    if (mysqli_query($conexion, $sql)) {
        echo "<b style='color:green;'>REGISTRO_EXITOSO</b>";
    } else {
        echo "ERROR: " . mysqli_error($conexion);
    }
}
?>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="text" name="apellidos" placeholder="Apellidos" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="password" placeholder="Pass (8 carac, A, a, -)" required><br>
    <button type="submit">Enviar</button>
</form>
