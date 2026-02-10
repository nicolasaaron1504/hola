<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $n = $_POST['nombre'] ?? '';
    $a = $_POST['apellidos'] ?? '';
    $e = $_POST['email'] ?? '';
    $u = $_POST['usuario'] ?? '';
    $p = $_POST['password'] ?? '';

    // 1. Verificar campos vacíos
    if (empty($n) || empty($a) || empty($e) || empty($u) || empty($p)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // 2. Validar formato de correo
    if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
        die("Error: El formato del correo no es válido.");
    }

    // 3. Validar contraseña (8 caracteres, Mayús, Minús y guion)
    $tiene_mayus = preg_match('/[A-Z]/', $p);
    $tiene_minus = preg_match('/[a-z]/', $p);
    $tiene_guion = strpos($p, '-') !== false;
    $largo_ok   = strlen($p) >= 8;

    if (!$tiene_mayus || !$tiene_minus || !$tiene_guion || !$largo_ok) {
        die("Error: La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un guion (-).");
    }

    // 4. Cifrar y Guardar
    $p_hash = password_hash($p, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, apellidos, email, usuario, password) VALUES ('$n', '$a', '$e', '$u', '$p_hash')";

    if (mysqli_query($conexion, $sql)) {
        echo "<b style='color:green;'>REGISTRO_EXITOSO</b>";
    } else {
        if (mysqli_errno($conexion) == 1062) {
            echo "Error: El usuario ya existe.";
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }
}
?>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="text" name="apellidos" placeholder="Apellidos" required><br>
    <input type="email" name="email" placeholder="Correo" required><br>
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="password" placeholder="Pass (8 carac, A, a, -)" required><br>
    <button type="submit">Enviar</button>
</form>
