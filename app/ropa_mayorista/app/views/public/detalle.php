<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    
    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="?">MayoristaApp</a>
            <a class="btn btn-outline-light btn-sm" href="?">Volver al Catálogo</a>
        </div>
    </nav>

    <div class="container mt-5 flex-grow-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?">Inicio</a></li>
                <li class="breadcrumb-item text-muted"><?= htmlspecialchars($producto['categoria_nombre'] ?? 'General') ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($producto['sku']) ?></li>
            </ol>
        </nav>

        <div class="card shadow border-0 mt-4 overflow-hidden">
            <div class="row g-0">
                <div class="col-md-5 bg-white d-flex align-items-center justify-content-center p-3">
                    <?php if($producto['img_principal'] && $producto['img_principal'] !== 'default.jpg'): ?>
                        <img src="public/images/products/<?= $producto['img_principal'] ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($producto['nombre']) ?>" style="max-height: 500px; object-fit: contain;">
                    <?php else: ?>
                        <div class="text-muted p-5 text-center w-100 bg-light rounded" style="height: 300px; display:flex; align-items:center; justify-content:center;">
                            <span>Sin imagen disponible</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-7">
                    <div class="card-body p-5 h-100 d-flex flex-column">
                        <span class="badge bg-secondary mb-2 align-self-start">Ref: <?= htmlspecialchars($producto['sku']) ?></span>
                        <h1 class="card-title fw-bold mb-3"><?= htmlspecialchars($producto['nombre']) ?></h1>
                        
                        <div class="mb-4">
                            <span class="display-5 fw-bold text-primary">$<?= number_format($producto['precio_mayorista'], 2) ?></span>
                            <span class="text-muted ms-2">precio unitario (al por mayor)</span>
                        </div>

                        <div class="mb-4">
                            <h5 class="fw-bold">Descripción del Producto</h5>
                            <p class="text-muted" style="white-space: pre-wrap;"><?= htmlspecialchars($producto['descripcion'] ?: 'Sin descripción detallada.') ?></p>
                        </div>

                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Categoría</span>
                                <strong><?= htmlspecialchars($producto['categoria_nombre'] ?? 'N/A') ?></strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Disponibilidad</span>
                                <?php if($producto['stock'] > 0): ?>
                                    <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> En Stock (<?= $producto['stock'] ?>)</span>
                                <?php else: ?>
                                    <span class="text-danger fw-bold"><i class="bi bi-x-circle-fill me-1"></i> Agotado</span>
                                <?php endif; ?>
                            </li>
                        </ul>

                        <div class="mt-auto pt-3 border-top">
                            <?php if($producto['stock'] > 0): ?>
                                <!-- Integración con WhatsApp -->
                                <a href="<?= htmlspecialchars($whatsappLink) ?>" target="_blank" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center py-3">
                                    <i class="bi bi-whatsapp fs-4 me-2"></i> 
                                    <span class="fw-bold">Comprar por WhatsApp</span>
                                </a>
                                <p class="text-center text-muted small mt-2 mb-0">Serás redirigido al chat directo con nuestro vendedor.</p>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-lg w-100" disabled>Producto Agotado</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2026 Sistema MayoristaApp. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
