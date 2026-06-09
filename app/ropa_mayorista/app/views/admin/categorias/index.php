<?php ob_start(); ?>

<div class="d-flex justify-content-between mb-3">
    <h4>Lista de Categorías</h4>
    <a href="categorias/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nueva Categoría</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categorias)): ?>
                        <tr><td colspan="5" class="text-center py-3">No hay categorías registradas</td></tr>
                    <?php else: ?>
                        <?php foreach($categorias as $cat): ?>
                        <tr>
                            <td><?= $cat['id_categoria'] ?></td>
                            <td><?= htmlspecialchars($cat['nombre']) ?></td>
                            <td><?= htmlspecialchars($cat['descripcion']) ?></td>
                            <td>
                                <?php if($cat['estado'] == 1): ?>
                                    <span class="badge bg-success">Activa</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactiva</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="categorias/edit?id=<?= $cat['id_categoria'] ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <?php if($_SESSION['user_role'] === 'Administrador'): ?>
                                <a href="categorias/delete?id=<?= $cat['id_categoria'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar categoría?');"><i class="bi bi-trash"></i></a>
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
