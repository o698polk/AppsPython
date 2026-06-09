<?php
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/middleware/AuthMiddleware.php';
require_once dirname(__DIR__) . '/models/Category.php';

class CategoryController extends Controller {
    private $categoryModel;

    public function __construct() {
        AuthMiddleware::check(['Administrador', 'Operador']);
        $this->categoryModel = new Category();
    }

    public function index() {
        $categorias = $this->categoryModel->getAll();
        $this->view('admin/categorias/index', [
            'titulo' => 'Gestión de Categorías',
            'categorias' => $categorias
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'estado' => isset($_POST['estado']) ? 1 : 0
            ];
            
            $this->categoryModel->create($data);
            $this->redirect('/admin/categorias');
        } else {
            $this->view('admin/categorias/form', [
                'titulo' => 'Nueva Categoría',
                'action' => 'create'
            ]);
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/categorias');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'estado' => isset($_POST['estado']) ? 1 : 0
            ];
            
            $this->categoryModel->update($id, $data);
            $this->redirect('/admin/categorias');
        } else {
            $categoria = $this->categoryModel->getById($id);
            $this->view('admin/categorias/form', [
                'titulo' => 'Editar Categoría',
                'action' => 'edit?id=' . $id,
                'categoria' => $categoria
            ]);
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id && SessionHelper::get('user_role') === 'Administrador') {
            try {
                $this->categoryModel->delete($id);
            } catch (Exception $e) {
                // Aquí se podría guardar un error en sesión (flash message) de que tiene productos asociados
            }
        }
        $this->redirect('/admin/categorias');
    }
}
