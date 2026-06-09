<?php ob_start(); ?>

<div class="d-flex justify-content-between mb-3">
    <h4>Lista de Productos</h4>
    <a href="productos/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo Producto</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>SKU</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($productos)): ?>
                        <tr><td colspan="8" class="text-center py-3">No hay productos registrados</td></tr>
                    <?php else: ?>
                        <?php foreach($productos as $prod): ?>
                        <tr>
                            <td>
                                <?php if($prod['img_principal'] && $prod['img_principal'] !== 'default.jpg'): ?>
                                    <img src="../../public/images/products/<?= $prod['img_principal'] ?>" width="50" height="50" class="img-thumbnail" style="object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center img-thumbnail" style="width: 50px; height: 50px;"><i class="bi bi-image"></i></div>
                                <?php endif; ?>
                            </td>
                            <td><small class="text-muted"><?= htmlspecialchars($prod['sku']) ?></small></td>
                            <td class="fw-bold"><?= htmlspecialchars($prod['nombre']) ?></td>
                            <td><span class="badge bg-info text-dark"><?= htmlspecialchars($prod['categoria_nombre'] ?? 'Sin Categoría') ?></span></td>
                            <td>$<?= number_format($prod['precio_mayorista'], 2) ?></td>
                            <td>
                                <?php if($prod['stock'] > 0): ?>
                                    <span class="badge bg-success rounded-pill"><?= $prod['stock'] ?></span>
                                <?php else: ?>
                                    <span class="badge bg-danger rounded-pill">0</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($prod['estado'] == 1): ?>
                                    <span class="badge bg-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="productos/edit?id=<?= $prod['id_producto'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <?php if($_SESSION['user_role'] === 'Administrador'): ?>
                                <a href="productos/delete?id=<?= $prod['id_producto'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar producto?');"><i class="bi bi-trash"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require_once dirname(__DIR__, 2) . '/layouts/admin.php'; 
?>
