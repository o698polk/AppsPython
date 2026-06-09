<?php
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/models/User.php';
require_once dirname(__DIR__) . '/helpers/SessionHelper.php';

class AuthController extends Controller {
    
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function loginForm() {
        if (SessionHelper::has('user_id')) {
            $this->redirect('/');
        }
        $this->view('auth/login', ['titulo' => 'Iniciar Sesión']);
    }

    public function registerForm() {
        if (SessionHelper::has('user_id')) {
            $this->redirect('/');
        }
        $this->view('auth/registro', ['titulo' => 'Crear Cuenta']);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($correo);

            if ($user && $user['estado'] == 1 && password_verify($password, $user['password_hash'])) {
                // Prevenir Session Fixation
                SessionHelper::regenerate();
                
                SessionHelper::set('user_id', $user['id_usuario']);
                SessionHelper::set('user_name', $user['nombre']);
                SessionHelper::set('user_role', $user['rol_nombre']);

                // Redirigir según el rol
                if ($user['rol_nombre'] === 'Administrador' || $user['rol_nombre'] === 'Operador') {
                    $this->redirect('/admin/dashboard'); // Futura ruta
                } else {
                    $this->redirect('/');
                }
            } else {
                // Rate Limiting u otros mecanismos podrían ir aquí
                $this->view('auth/login', [
                    'titulo' => 'Iniciar Sesión',
                    'error' => 'Credenciales incorrectas o cuenta inactiva.'
                ]);
            }
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nombre' => filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING),
                'apellido' => filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING),
                'correo' => filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL),
                'telefono' => filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING),
                'password' => $_POST['password'] ?? ''
            ];

            // Validaciones básicas (se pueden ampliar)
            if (empty($data['nombre']) || empty($data['correo']) || empty($data['password'])) {
                $this->view('auth/registro', ['titulo' => 'Crear Cuenta', 'error' => 'Por favor complete todos los campos obligatorios.']);
                return;
            }

            if ($this->userModel->findByEmail($data['correo'])) {
                $this->view('auth/registro', ['titulo' => 'Crear Cuenta', 'error' => 'El correo ya está registrado.']);
                return;
            }

            if ($this->userModel->createUser($data)) {
                $this->view('auth/login', ['titulo' => 'Iniciar Sesión', 'success' => 'Cuenta creada exitosamente. Por favor inicie sesión.']);
            } else {
                $this->view('auth/registro', ['titulo' => 'Crear Cuenta', 'error' => 'Error al crear la cuenta. Intente nuevamente.']);
            }
        }
    }

    public function logout() {
        SessionHelper::destroy();
        $this->redirect('/');
    }
}
