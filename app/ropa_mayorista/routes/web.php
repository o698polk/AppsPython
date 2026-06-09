<?php
/**
 * Archivo de rutas web principales
 */

$router = new Router();

// Rutas Públicas (Catálogo)
$router->get('/', 'HomeController', 'index');
$router->get('/producto', 'CatalogController', 'detalle');

// Rutas de Autenticación
$router->get('/login', 'AuthController', 'loginForm');
$router->post('/login/post', 'AuthController', 'login');
$router->get('/registro', 'AuthController', 'registerForm');
$router->post('/registro/post', 'AuthController', 'register');
$router->get('/logout', 'AuthController', 'logout');

// Rutas de Administración
$router->get('/admin/dashboard', 'DashboardController', 'index');

// Rutas de Categorías
$router->get('/admin/categorias', 'CategoryController', 'index');
$router->get('/admin/categorias/create', 'CategoryController', 'create');
$router->post('/admin/categorias/create', 'CategoryController', 'create');
$router->get('/admin/categorias/edit', 'CategoryController', 'edit');
$router->post('/admin/categorias/edit', 'CategoryController', 'edit');
$router->get('/admin/categorias/delete', 'CategoryController', 'delete');

// Rutas de Productos
$router->get('/admin/productos', 'ProductController', 'index');
$router->get('/admin/productos/create', 'ProductController', 'create');
$router->post('/admin/productos/create', 'ProductController', 'create');
$router->get('/admin/productos/edit', 'ProductController', 'edit');
$router->post('/admin/productos/edit', 'ProductController', 'edit');
$router->get('/admin/productos/delete', 'ProductController', 'delete');

// Despachar la ruta actual
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
