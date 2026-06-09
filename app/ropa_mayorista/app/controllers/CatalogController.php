<?php
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/models/Product.php';
require_once dirname(__DIR__) . '/helpers/WhatsAppHelper.php';

class CatalogController extends Controller {
    public function detalle() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/');
        }

        $productModel = new Product();
        $producto = $productModel->getById($id);

        // Redirigir si no existe o si no está activo
        if (!$producto || $producto['estado'] == 0) {
            $this->redirect('/');
        }

        // Obtener nombre de categoría para breadcrumb
        $stmt = Database::getInstance()->getConnection()->prepare("SELECT nombre FROM categorias WHERE id_categoria = ?");
        $stmt->execute([$producto['id_categoria']]);
        $categoria = $stmt->fetchColumn();
        
        $producto['categoria_nombre'] = $categoria;

        // Generar enlace WhatsApp
        $whatsappLink = WhatsAppHelper::generateLink($producto['telefono_vendedor'], $producto);

        $this->view('public/detalle', [
            'titulo' => $producto['nombre'] . ' | Mayorista',
            'producto' => $producto,
            'whatsappLink' => $whatsappLink
        ]);
    }
}
