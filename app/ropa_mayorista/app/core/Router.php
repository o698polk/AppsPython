<?php
class Router {
    private $routes = [];

    public function add($method, $uri, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function get($uri, $controller, $action) {
        $this->add('GET', $uri, $controller, $action);
    }

    public function post($uri, $controller, $action) {
        $this->add('POST', $uri, $controller, $action);
    }

    public function dispatch($uri, $method) {
        // Extraer la URI y limpiar
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/');
        
        // Ajustar la URI para subdirectorios en XAMPP
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/' && $scriptName !== '\\') {
            $uri = str_replace($scriptName, '', $uri);
        }
        if (empty($uri)) $uri = '/';

        foreach ($this->routes as $route) {
            // Manejo de rutas con parámetros simples podría ir aquí en el futuro
            if ($route['uri'] === $uri && $route['method'] === $method) {
                $controllerName = $route['controller'];
                $actionName = $route['action'];

                $controllerFile = dirname(__DIR__) . "/controllers/{$controllerName}.php";
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    $controller = new $controllerName();
                    $controller->$actionName();
                    return;
                } else {
                    die("Error del sistema: Controlador {$controllerName} no encontrado.");
                }
            }
        }
        
        http_response_code(404);
        die("404 Not Found - La ruta solicitada no existe.");
    }
}
