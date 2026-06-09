<?php ob_start(); ?>

<div class="card shadow-sm max-w-md mx-auto" style="max-width: 600px;">
    <div class="card-header bg-white">
        <h5 class="mb-0"><?= $titulo ?></h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= $action ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de Categoría</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required 
                       value="<?= isset($categoria) ? htmlspecialchars($categoria['nombre']) : '' ?>">
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= isset($categoria) ? htmlspecialchars($categoria['descripcion']) : '' ?></textarea>
            </div>
            
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" id="estado" name="estado" 
                       <?= (!isset($categoria) || $categoria['estado'] == 1) ? 'checked' : '' ?>>
                <label class="form-check-label" for="estado">Categoría Activa</label>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="../categorias" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require_once dirname(__DIR__, 2) . '/layouts/admin.php'; 
?>
