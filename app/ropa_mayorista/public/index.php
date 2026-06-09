<?php
/**
 * Front Controller
 * Punto de entrada único para la aplicación
 */

// Establecer reporte de errores según el entorno
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Definir constante base
define('BASE_PATH', dirname(__DIR__));

// Aquí se incluirá el autoloader de Composer más adelante
// require_once BASE_PATH . '/vendor/autoload.php';

// Cargar clases core
require_once dirname(__DIR__) . '/app/core/Database.php';
require_once dirname(__DIR__) . '/app/core/Router.php';

// Iniciar sesión segura
require_once dirname(__DIR__) . '/app/helpers/SessionHelper.php';
SessionHelper::init();

// Cargar archivo de rutas
require_once dirname(__DIR__) . '/routes/web.php';
