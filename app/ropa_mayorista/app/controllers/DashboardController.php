<?php
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/middleware/AuthMiddleware.php';

class DashboardController extends Controller {
    public function __construct() {
        // Proteger el acceso solo a Administradores y Operadores
        AuthMiddleware::check(['Administrador', 'Operador']);
    }

    public function index() {
        // Aquí conectaremos con modelos para traer totales más adelante (Total Productos, etc.)
        $data = [
            'titulo' => 'Panel Administrativo',
            'totales' => [
                'productos' => 0, // Placeholder
                'categorias' => 0, // Placeholder
                'usuarios' => 0 // Placeholder
            ]
        ];
        
        $this->view('admin/dashboard', $data);
    }
}
