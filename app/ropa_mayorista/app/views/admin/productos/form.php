<?php ob_start(); ?>

<div class="card shadow-sm mx-auto" style="max-width: 800px;">
    <div class="card-header bg-white">
        <h5 class="mb-0"><?= $titulo ?></h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= $action ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required 
                           value="<?= isset($producto) ? htmlspecialchars($producto['nombre']) : '' ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sku" class="form-label">SKU (Código) *</label>
                    <input type="text" class="form-control" id="sku" name="sku" required 
                           value="<?= isset($producto) ? htmlspecialchars($producto['sku']) : '' ?>">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="id_categoria" class="form-label">Categoría *</label>
                    <select class="form-select" id="id_categoria" name="id_categoria" required>
                        <option value="">Seleccione...</option>
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?= $cat['id_categoria'] ?>" <?= (isset($producto) && $producto['id_categoria'] == $cat['id_categoria']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="precio_mayorista" class="form-label">Precio Mayorista *</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" class="form-control" id="precio_mayorista" name="precio_mayorista" required 
                               value="<?= isset($producto) ? $producto['precio_mayorista'] : '0.00' ?>">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="stock" class="form-label">Stock Actual *</label>
                    <input type="number" class="form-control" id="stock" name="stock" required 
                           value="<?= isset($producto) ? $producto['stock'] : '0' ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4"><?= isset($producto) ? htmlspecialchars($producto['descripcion']) : '' ?></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="telefono_vendedor" class="form-label">Teléfono WhatsApp Vendedor *</label>
                    <input type="text" class="form-control" id="telefono_vendedor" name="telefono_vendedor" required placeholder="Ej. 51999888777"
                           value="<?= isset($producto) ? htmlspecialchars($producto['telefono_vendedor']) : '' ?>">
                    <div class="form-text">Incluye código de país sin el +.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="imagen" class="form-label">Imagen Principal (JPG/PNG)</label>
                    <input class="form-control" type="file" id="imagen" name="imagen" accept="image/jpeg, image/png, image/webp">
                    <?php if(isset($producto) && $producto['img_principal'] && $producto['img_principal'] !== 'default.jpg'): ?>
                        <div class="mt-2 text-muted small">Imagen actual: <?= htmlspecialchars($producto['img_principal']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" id="estado" name="estado" 
                       <?= (!isset($producto) || $producto['estado'] == 1) ? 'checked' : '' ?>>
                <label class="form-check-label" for="estado">Producto Activo en el Catálogo</label>
            </div>
            
            <hr>
            <div class="d-flex justify-content-between">
                <a href="../productos" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Guardar Producto</button>
            </div>
        </form>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require_once dirname(__DIR__, 2) . '/layouts/admin.php'; 
?>
