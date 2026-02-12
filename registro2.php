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

    // 1. Validar campos vacíos
    if (empty($n) || empty($a) || empty($e) || empty($u) || empty($p)) {
        die("<b style='color:red;'>Error: Todos los campos son obligatorios.</b>");
    }

    // 2. VALIDACIÓN DEL LADO DEL SERVIDOR: Verifica el @ y el dominio
    if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
        die("<script>alert('Error: Por favor, introduce un correo electrónico válido (ejemplo@correo.com).'); window.history.back();</script>");
    }

    // 3. Validar Contraseña (8 caracteres, Mayús, Minús y un guion)
    $mayus = preg_match('/[A-Z]/', $p);
    $minus = preg_match('/[a-z]/', $p);
    $guion = strpos($p, '-') !== false;
    $largo = strlen($p) >= 8;

    if (!$mayus || !$minus || !$guion || !$largo) {
        die("<b style='color:red;'>Error: La contraseña debe tener 8 caracteres, una Mayúscula, una minúscula y un guion (-).</b>");
    }

    // 4. Guardar usuario
    $p_hash = password_hash($p, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, apellidos, email, usuario, password) VALUES ('$n', '$a', '$e', '$u', '$p_hash')";

    if (mysqli_query($conexion, $sql)) {
        echo "<h2 style='color:green;'>REGISTRO_EXITOSO</h2>";
        echo "<a href='login.php'>Ir al Login</a>";
    } else {
        if (mysqli_errno($conexion) == 1062) {
            echo "<b style='color:red;'>Error: El usuario ya existe.</b>";
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }
}
?>

<form method="POST" style="font-family: sans-serif; max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc;">
    <h2>Registro de Usuario</h2>
    
    <input type="text" name="nombre" placeholder="Nombre" required style="width: 100%; margin-bottom: 10px;">
    
    <input type="text" name="apellidos" placeholder="Apellidos" required style="width: 100%; margin-bottom: 10px;">
    
    <label>Correo Electrónico:</label>
    <input type="email" name="email" placeholder="ejemplo@correo.com" required style="width: 100%; margin-bottom: 10px;">
    
    <input type="text" name="usuario" placeholder="Usuario" required style="width: 100%; margin-bottom: 10px;">
    
    <input type="password" name="password" placeholder="Contraseña (A, a, -, 8+)" required style="width: 100%; margin-bottom: 10px;">
    
    <button type="submit" style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; cursor: pointer;">
        Registrarse
    </button>
</form>
