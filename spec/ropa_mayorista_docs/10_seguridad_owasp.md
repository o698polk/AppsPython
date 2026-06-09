# 10. Revisión de Seguridad (OWASP Top 10)
## Sistema de Venta de Ropa al por Mayor

### A01:2021-Broken Access Control (Control de Acceso Roto)
- **Mitigación:** Todas las rutas del panel administrativo estarán protegidas por un `AuthMiddleware` y un `RoleMiddleware`. No se confiará en valores ocultos del DOM ni parámetros GET para validar permisos de acciones CRUD.

### A02:2021-Cryptographic Failures (Fallos Criptográficos)
- **Mitigación:** Las contraseñas serán almacenadas usando `password_hash()` con el algoritmo bcrypt nativo de PHP. No se usarán algoritmos obsoletos como MD5 o SHA1.
- **Transmisión:** Si el servidor lo soporta, forzar HTTPS.

### A03:2021-Injection (Inyección SQL y otras)
- **Mitigación:** TODAS las consultas a MySQL se realizarán mediante **Prepared Statements** con PDO. No se concatenarán variables directamente en los strings SQL.
- **Validación:** Se sanearán y validarán los inputs (tipo, longitud, formato).

### A04:2021-Insecure Design (Diseño Inseguro)
- **Mitigación:** Rate limiting en el formulario de login (bloqueo tras N intentos). El sistema obligará el uso de contraseñas de al menos 8 caracteres.

### A05:2021-Security Misconfiguration (Configuraciones Defectuosas de Seguridad)
- **Mitigación:** Desactivar `display_errors = Off` en producción. Los errores se guardarán en un archivo de log no accesible públicamente (`storage/logs/`). El archivo `.htaccess` bloqueará el acceso al código fuente.

### A07:2021-Identification and Authentication Failures (Fallos de Autenticación)
- **Mitigación:** Manejo seguro de sesiones. Regenerar el ID de sesión con `session_regenerate_id(true)` tras el login para evitar Session Fixation. Tokens para recuperación de contraseña caducarán en 15 minutos.

### Mitigaciones Adicionales
- **Cross-Site Request Forgery (CSRF):** Todo formulario de modificación de datos (POST, PUT, DELETE) incluirá un token CSRF generado en PHP y verificado por el controlador.
- **Cross-Site Scripting (XSS):** Todo dato emitido en las vistas PHP será escapado utilizando `htmlspecialchars($data, ENT_QUOTES, 'UTF-8')`.
- **File Upload Security:** Las imágenes de productos se validarán rigurosamente (tipo MIME, tamaño, extensión blanca: jpg, png, webp) y se renombrarán con un hash único antes de guardarlas, evitando ejecución de código malicioso.
