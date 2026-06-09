# 4. Arquitectura del Sistema
## Sistema de Venta de Ropa al por Mayor

### 4.1 Patrón Arquitectónico
El sistema implementa el patrón **MVC (Modelo-Vista-Controlador)** en una arquitectura **Monolítica**.
- **Modelo:** Clases PHP responsables de la lógica de negocio y el acceso a la base de datos mediante PDO.
- **Vista:** Plantillas HTML combinadas con PHP nativo para la renderización dinámica. Uso de CSS3 y Bootstrap 5 para el diseño responsive.
- **Controlador:** Clases PHP que reciben las peticiones HTTP, coordinan los Modelos y seleccionan la Vista adecuada para la respuesta.

### 4.2 Stack Tecnológico
- **Backend:** PHP 8.3+ (Orientado a Objetos).
- **Frontend:** HTML5, CSS3, JavaScript (ES6), AJAX (Fetch API), Bootstrap 5.
- **Base de Datos:** MySQL 8.
- **Servidor Web:** Apache (vía XAMPP para desarrollo).
- **Gestión de Dependencias:** Composer (autoload PSR-4, librerías de terceros si aplica).
- **Control de Versiones:** Git.

### 4.3 Flujo de Datos (Request Lifecycle)
1. **Petición (Request):** El cliente realiza una petición HTTP (GET, POST, etc.) al servidor.
2. **Enrutador (Router / Front Controller):** El archivo `index.php` (en la raíz pública) recibe todas las peticiones, inicializa configuraciones (sesiones, variables de entorno) y delega al router.
3. **Controlador:** El router instancia el controlador correspondiente según la URL y ejecuta el método de la acción solicitada.
4. **Middleware (Opcional):** Antes de llegar al controlador, se pueden ejecutar middlewares (ej. validación de autenticación, verificación de roles, protección CSRF).
5. **Modelo:** Si se requieren datos, el controlador instancia el Modelo. El modelo consulta la base de datos MySQL mediante PDO (usando sentencias preparadas para prevenir SQLi).
6. **Vista:** El controlador recopila los datos retornados por el Modelo y los envía a la Vista.
7. **Respuesta (Response):** La Vista genera el HTML final que es retornado al cliente por el servidor web. En peticiones AJAX, el controlador puede devolver directamente JSON.

### 4.4 Gestión de Estado
- **Sesiones:** Se usarán sesiones nativas de PHP (`$_SESSION`) endurecidas (HttpOnly, Secure flag si hay HTTPS, SameSite) para manejar el estado de autenticación y datos temporales (mensajes flash).

### 4.5 Despliegue de Componentes
El aplicativo operará en un único servidor (Monolito) que alojará tanto el código fuente de la aplicación (Apache/PHP) como el motor de base de datos MySQL, ideal para la carga esperada de un catálogo de escala Pyme.
