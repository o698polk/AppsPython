<?php
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/models/Product.php';
require_once dirname(__DIR__) . '/helpers/SessionHelper.php';

class HomeController extends Controller {
    public function index() {
        $productModel = new Product();
        // Obtener solo productos activos (estado = 1)
        // Por simplicidad en este ejercicio, re-utilizamos getAll y filtramos, o hacemos query directa
        $stmt = Database::getInstance()->getConnection()->query("
            SELECT p.*, c.nombre as categoria_nombre 
            FROM productos p 
            LEFT JOIN categorias c ON p.id_categoria = c.id_categoria 
            WHERE p.estado = 1 AND p.stock > 0
            ORDER BY p.id_producto DESC
        ");
        $productos = $stmt->fetchAll();

        $data = [
            'titulo' => 'Catálogo Mayorista',
            'productos' => $productos
        ];
        
        $this->view('public/home', $data);
    }
}
