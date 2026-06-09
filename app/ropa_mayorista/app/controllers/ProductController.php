<?php
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/middleware/AuthMiddleware.php';
require_once dirname(__DIR__) . '/models/Product.php';
require_once dirname(__DIR__) . '/models/Category.php';
require_once dirname(__DIR__) . '/services/ImageUploadService.php';

class ProductController extends Controller {
    private $productModel;
    private $categoryModel;
    private $uploadService;

    public function __construct() {
        AuthMiddleware::check(['Administrador', 'Operador']);
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->uploadService = new ImageUploadService();
    }

    public function index() {
        $productos = $this->productModel->getAll();
        $this->view('admin/productos/index', [
            'titulo' => 'Gestión de Productos',
            'productos' => $productos
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $data['estado'] = isset($_POST['estado']) ? 1 : 0;
            
            try {
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $data['img_principal'] = $this->uploadService->upload('imagen');
                }
                
                $this->productModel->create($data);
                $this->redirect('/admin/productos');
            } catch (Exception $e) {
                // Manejar error (ej. SKU duplicado, imagen inválida)
                die("Error: " . $e->getMessage());
            }
        } else {
            $categorias = $this->categoryModel->getActive();
            $this->view('admin/productos/form', [
                'titulo' => 'Nuevo Producto',
                'action' => 'create',
                'categorias' => $categorias
            ]);
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/productos');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $data['estado'] = isset($_POST['estado']) ? 1 : 0;
            
            try {
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $data['img_principal'] = $this->uploadService->upload('imagen');
                }
                
                $this->productModel->update($id, $data);
                $this->redirect('/admin/productos');
            } catch (Exception $e) {
                die("Error: " . $e->getMessage());
            }
        } else {
            $producto = $this->productModel->getById($id);
            $categorias = $this->categoryModel->getActive();
            $this->view('admin/productos/form', [
                'titulo' => 'Editar Producto',
                'action' => 'edit?id=' . $id,
                'producto' => $producto,
                'categorias' => $categorias
            ]);
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id && SessionHelper::get('user_role') === 'Administrador') {
            $this->productModel->delete($id);
        }
        $this->redirect('/admin/productos');
    }
}
