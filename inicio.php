<?php
session_start();

// Seguridad: Si no hay sesión, vuelve al login
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Mi Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .navbar { background-color: #2c3e50; }
        .card { border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema Web Pro</a>
            <span class="navbar-text text-white">
                Usuario: <strong><?php echo $_SESSION['usuario_logueado']; ?></strong>
            </span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-5 bg-white text-center">
                    <h1 class="display-4 text-primary">¡Bienvenido de nuevo!</h1>
                    <p class="lead mt-3">Has accedido exitosamente al panel de administración.</p>
                    <hr class="my-4">
                    <p>Desde aquí puedes gestionar tu perfil o navegar por las diferentes secciones del sistema.</p>
                    
                    <div class="d-grid gap-2 d-md-block mt-4">
                        <button class="btn btn-outline-primary px-4" type="button">Mi Perfil</button>
                        <button class="btn btn-outline-secondary px-4" type="button">Ajustes</button>
                        <a href="logout.php" class="btn btn-danger px-4">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
