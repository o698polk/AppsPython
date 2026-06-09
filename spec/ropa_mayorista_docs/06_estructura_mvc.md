# 6. Estructura MVC Completa
## Sistema de Venta de Ropa al por Mayor

La estructura de directorios está diseñada para separar claramente la lógica de la aplicación del acceso público, mejorando la seguridad y mantenibilidad.

```text
/ropa_mayorista
│
├── /app                    # Código fuente de la aplicación (No accesible públicamente vía .htaccess)
│   ├── /controllers        # Controladores (ProductController.php, AuthController.php, etc.)
│   ├── /models             # Modelos de dominio y acceso a BD (Product.php, User.php, Category.php)
│   ├── /views              # Plantillas visuales (.php con HTML)
│   │   ├── /admin          # Vistas del dashboard administrativo
│   │   ├── /public         # Vistas del catálogo público
│   │   ├── /auth           # Vistas de login/registro
│   │   ├── /layouts        # Plantillas base (header, footer, nav)
│   │   └── /components     # Fragmentos reutilizables (tarjetas de producto, alertas)
│   ├── /middleware         # Filtros de peticiones (AuthMiddleware.php, RoleMiddleware.php)
│   ├── /helpers            # Funciones utilitarias (Sanitizer, WhatsAppLinkGenerator)
│   ├── /services           # Lógica compleja de negocio o integraciones (ImageUploadService)
│   └── /core               # Clases base del framework (Router.php, Controller.php, Model.php, Database.php)
│
├── /public                 # Único directorio accesible desde la web (DocumentRoot)
│   ├── index.php           # Front Controller (Punto de entrada único)
│   ├── .htaccess           # Reglas de reescritura de URL para Apache
│   ├── /assets
│   │   ├── /css            # Hojas de estilo personalizadas
│   │   ├── /js             # Scripts de frontend (Fetch API, interacciones UI)
│   │   └── /vendor         # Librerías estáticas (Bootstrap, FontAwesome locales)
│   └── /images
│       ├── /products       # Directorio de subida de imágenes de productos
│       └── /system         # Logos, banners e imágenes estáticas del sitio
│
├── /config                 # Archivos de configuración
│   ├── database.php        # Credenciales de MySQL
│   ├── app.php             # Variables globales (URL base, timezone, entorno)
│   └── security.php        # Claves de hash, configuraciones CORS/CSRF
│
├── /database               # Scripts y migraciones
│   ├── schema.sql          # Script de creación de tablas
│   └── seed.sql            # Datos iniciales (Admin por defecto, categorías de prueba)
│
├── /routes                 # Definición de rutas del sistema
│   ├── web.php             # Rutas públicas (catálogo, login)
│   └── api.php             # Rutas AJAX / JSON si aplican
│
├── /storage                # Almacenamiento no público
│   └── /logs               # Archivos de registro de errores del sistema (error.log, access.log)
│
├── /tests                  # Pruebas automatizadas (Unitarias, de integración)
│   └── ...
│
├── composer.json           # Definición de dependencias y autoload PSR-4
└── README.md               # Documentación general del repositorio
```

### Reglas de Acceso
- El servidor web (Apache) debe configurarse para que el **DocumentRoot** apunte a la carpeta `/public`.
- Los directorios `/app`, `/config`, `/storage`, `/database`, etc., quedan fuera del alcance directo del navegador, protegiendo el código fuente y las credenciales.
