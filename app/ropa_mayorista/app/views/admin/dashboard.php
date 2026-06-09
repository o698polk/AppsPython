<?php
// Usar Output Buffering para inyectar esta vista dentro del layout admin
ob_start();
?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center border-primary border-top border-4">
            <div class="card-body py-4">
                <h5 class="card-title text-muted">Total Productos</h5>
                <h2 class="display-4 text-primary"><?= $totales['productos'] ?></h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center border-success border-top border-4">
            <div class="card-body py-4">
                <h5 class="card-title text-muted">Categorías Activas</h5>
                <h2 class="display-4 text-success"><?= $totales['categorias'] ?></h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center border-warning border-top border-4">
            <div class="card-body py-4">
                <h5 class="card-title text-muted">Usuarios Registrados</h5>
                <h2 class="display-4 text-warning"><?= $totales['usuarios'] ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Bienvenido al Panel de Control</h5>
            </div>
            <div class="card-body">
                <p>Desde aquí podrás gestionar todo el catálogo de productos y las categorías asociadas.</p>
                <p class="text-muted small">Módulos habilitados según tu rol: <?= htmlspecialchars($_SESSION['user_role'] ?? '') ?></p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
// Incluir el layout principal y pasarle el contenido renderizado
require_once dirname(__DIR__) . '/layouts/admin.php';
?>
