<?php
include("db.php");
// Iniciamos sesión para que el servidor recuerde quién entró
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u = $_POST['usuario'] ?? '';
    $p = $_POST['password'] ?? '';

    $sql = "SELECT password FROM usuarios WHERE usuario = '$u'";
    $resultado = mysqli_query($conexion, $sql);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        if (password_verify($p, $fila['password'])) {
            // Guardamos el nombre del usuario en una "sesion"
            $_SESSION['usuario_logueado'] = $u;
            
            // REDIRECCIÓN: Aquí ocurre la magia
            header("Location: inicio.php");
            exit(); // Es vital poner exit() para que el código se detenga aquí
        } else {
            echo "<b style='color:red;'>Contraseña incorrecta.</b>";
        }
    } else {
        echo "<b style='color:red;'>El usuario no existe.</b>";
    }
}
?>

<form method="POST">
    <h2>Iniciar Sesión</h2>
    <input type="text" name="usuario" placeholder="Usuario" required><br><br>
    <input type="password" name="password" placeholder="Contraseña" required><br><br>
    <button type="submit">Entrar</button>
</form>
