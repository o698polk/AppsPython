# 1. Software Requirements Specification (SRS)
## Sistema de Venta de Ropa al por Mayor

### 1.1 Propósito
El propósito de este documento es definir los requerimientos funcionales y no funcionales para la aplicación web de venta de ropa al por mayor. El sistema permitirá gestionar el inventario, catálogo y contactos comerciales, derivando la compra final al WhatsApp del vendedor.

### 1.2 Alcance del Sistema
La plataforma gestionará productos, categorías, usuarios y exhibirá un catálogo público. NO procesará pagos en línea ni gestionará carritos de compras complejos. El objetivo es servir como un escaparate digital que facilita el contacto directo vía WhatsApp.

### 1.3 Requerimientos Funcionales (RF)

#### RF-01: Gestión de Usuarios
- **RF-01.1:** El sistema debe permitir el registro de usuarios (Nombre, Apellido, Correo, Teléfono, Contraseña).
- **RF-01.2:** El sistema debe autenticar usuarios mediante Correo/Usuario y Contraseña.
- **RF-01.3:** El sistema debe permitir la recuperación de contraseña.
- **RF-01.4:** El sistema debe soportar roles: Administrador, Operador, Cliente.

#### RF-02: Gestión de Catálogo y Productos
- **RF-02.1:** El Administrador/Operador podrá crear, editar, eliminar, activar y desactivar productos.
- **RF-02.2:** Cada producto tendrá: Nombre, SKU, Categoría, Descripción, Precio mayorista, Stock, Estado, Imagen principal, Galería de imágenes, y Número de WhatsApp del vendedor.
- **RF-02.3:** El Administrador/Operador podrá gestionar (CRUD) categorías.

#### RF-03: Visualización del Catálogo Público
- **RF-03.1:** El sistema mostrará una página principal con banner, productos destacados, recientes y categorías.
- **RF-03.2:** El sistema proveerá búsqueda de productos, filtros y ordenamiento.
- **RF-03.3:** El detalle de producto mostrará la información y un botón de "Comprar" (WhatsApp).

#### RF-04: Integración con WhatsApp
- **RF-04.1:** Al hacer clic en "Comprar", el sistema redirigirá a `https://wa.me/{telefono}?text={mensaje}` con información prellenada del producto (Nombre, SKU, Precio).

#### RF-05: Dashboard Administrativo
- **RF-05.1:** El sistema proveerá un panel con estadísticas (Total productos, usuarios, últimos registros).

### 1.4 Requerimientos No Funcionales (RNF)
- **RNF-01 (Arquitectura):** El sistema debe usar Arquitectura MVC Monolítica en PHP 8.3+.
- **RNF-02 (Base de Datos):** El sistema debe usar MySQL 8.
- **RNF-03 (Interfaz):** El diseño debe ser Responsive, Mobile First usando Bootstrap 5 y CSS3.
- **RNF-04 (Seguridad):** Se deben mitigar riesgos OWASP Top 10 (CSRF, XSS, SQL Injection mediante PDO). Contraseñas hasheadas con `password_hash()`.
- **RNF-05 (Compatibilidad):** Soportado en Chrome, Firefox, Edge, Safari.
