# 12. Plan de Desarrollo por Fases
## Sistema de Venta de Ropa al por Mayor

### Fase 1: Arquitectura y Base de Datos (Semana 1)
- [ ] Creación de la estructura de directorios MVC en `/app` y `/public`.
- [ ] Configuración del Front Controller (`index.php`) y `.htaccess`.
- [ ] Implementación de la clase núcleo `Database.php` (Conexión PDO).
- [ ] Desarrollo del Enrutador básico (`Router.php`).
- [ ] Creación de scripts SQL y semilla de la base de datos MySQL en `/database`.

### Fase 2: Autenticación y Seguridad (Semana 1-2)
- [ ] Modelo `User.php`.
- [ ] Vistas de Login y Registro.
- [ ] Controlador `AuthController.php`.
- [ ] Middleware de Autenticación y control de Sesiones.
- [ ] Flujo de hash de contraseñas.

### Fase 3: Dashboard y Gestión de Catálogo (Backend) (Semana 2-3)
- [ ] Vistas y layout del panel administrativo (Sidebar, Topbar).
- [ ] CRUD de Categorías (Modelo, Vista, Controlador).
- [ ] CRUD de Productos.
- [ ] Servicio de subida de imágenes (validación, renombrado, guardado en `/public/images/products`).
- [ ] Lógica de cambio de estado (activar/desactivar) y control de stock básico.

### Fase 4: Frontend Público e Integración WhatsApp (Semana 3)
- [ ] Layout público (Navbar, Footer, Bootstrap 5).
- [ ] Vista del Catálogo con grilla de productos, paginación y búsqueda.
- [ ] Vista Detalle de Producto y galería de imágenes.
- [ ] Helper `WhatsAppLinkGenerator` para construir el enlace a la API de WhatsApp con el mensaje preformateado.

### Fase 5: QA, Pruebas y Despliegue (Semana 4)
- [ ] Ejecución de pruebas funcionales y de seguridad.
- [ ] Ajustes de responsividad en móviles y tablets.
- [ ] Pruebas en navegador cruzado (Chrome, Safari, etc.).
- [ ] Despliegue en entorno de producción.
