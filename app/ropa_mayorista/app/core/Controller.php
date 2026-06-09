<?php
class Controller {
    // Renderiza la vista pasando los datos
    protected function view($view, $data = []) {
        // Extraer variables para que estén disponibles en la vista
        extract($data);
        
        $viewFile = dirname(__DIR__) . "/views/{$view}.php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("Error del sistema: Vista {$view} no encontrada.");
        }
    }

    // Redirecciona a otra URL
    protected function redirect($url) {
        // Ajustar la URL base para subdirectorios en XAMPP
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        $baseUrl = ($scriptName === '/' || $scriptName === '\\') ? '' : $scriptName;
        header("Location: " . $baseUrl . $url);
        exit();
    }
}
