<?php
// Validar que exista el contenido
if (!isset($content)) {
    $content = '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Dashboard') ?> | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar { min-height: 100vh; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <h5 class="text-white text-center mb-4">Mayorista Admin</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../admin/dashboard">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../admin/categorias">
                                <i class="bi bi-tags me-2"></i> Categorías
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../admin/productos">
                                <i class="bi bi-box-seam me-2"></i> Productos
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link text-danger" href="../logout">
                                <i class="bi bi-box-arrow-left me-2"></i> Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-light min-vh-100">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?= htmlspecialchars($titulo ?? 'Dashboard') ?></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <span class="text-muted">Hola, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Usuario') ?> (<?= htmlspecialchars($_SESSION['user_role'] ?? 'Rol') ?>)</span>
                    </div>
                </div>

                <!-- Aquí se inyecta la vista específica -->
                <?= $content ?>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
