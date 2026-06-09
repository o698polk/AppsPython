<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Ropa Mayorista') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card { transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
        .hero-banner { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4rem 0; }
    </style>
</head>
<body class="bg-light">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="?">MayoristaApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="?">Catálogo</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if (in_array($_SESSION['user_role'], ['Administrador', 'Operador'])): ?>
                            <li class="nav-item"><a class="nav-link text-info" href="admin/dashboard">Panel Admin</a></li>
                        <?php endif; ?>
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle text-warning" href="#" data-bs-toggle="dropdown">
                                Hola, <?= htmlspecialchars($_SESSION['user_name']) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item text-danger" href="logout">Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ms-2"><a class="btn btn-outline-light btn-sm" href="login">Iniciar Sesión</a></li>
                        <li class="nav-item ms-2"><a class="btn btn-primary btn-sm" href="registro">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-banner text-center mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Catálogo Exclusivo Mayorista</h1>
            <p class="lead">Descubre la mejor selección de prendas al mejor precio. Compra directa y segura.</p>
        </div>
    </div>

    <div class="container mb-5">
        <h3 class="mb-4 border-bottom pb-2">Productos Destacados</h3>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php if(empty($productos)): ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Actualmente no hay productos disponibles en el catálogo.</p>
                </div>
            <?php else: ?>
                <?php foreach($productos as $prod): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <?php if($prod['img_principal'] && !in_array($prod['img_principal'], ['default.jpg', 'default-icon.png'])): ?>
                            <img src="public/images/products/<?= $prod['img_principal'] ?>" class="card-img-top" alt="<?= htmlspecialchars($prod['nombre']) ?>" style="height: 250px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-light text-secondary d-flex flex-column align-items-center justify-content-center card-img-top border-bottom" style="height: 250px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-box-seam mb-2" viewBox="0 0 16 16">
                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
                                </svg>
                                <span class="small fw-bold">Sin Imagen</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-secondary mb-2 align-self-start"><?= htmlspecialchars($prod['categoria_nombre'] ?? 'General') ?></span>
                            <h5 class="card-title text-truncate"><?= htmlspecialchars($prod['nombre']) ?></h5>
                            <p class="card-text text-muted small mb-3">SKU: <?= htmlspecialchars($prod['sku']) ?></p>
                            
                            <div class="mt-auto">
                                <h4 class="text-primary fw-bold mb-3">$<?= number_format($prod['precio_mayorista'], 2) ?></h4>
                                <a href="producto?id=<?= $prod['id_producto'] ?>" class="btn btn-outline-primary w-100">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2026 Sistema MayoristaApp. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
