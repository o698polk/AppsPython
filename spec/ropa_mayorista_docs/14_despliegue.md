# 14. Checklist de Despliegue en Producción
## Sistema de Venta de Ropa al por Mayor

Este documento describe los pasos necesarios para llevar la aplicación desde el entorno local de desarrollo al servidor de producción.

### 1. Preparación del Entorno Servidor
- [ ] Verificar que el servidor soporte PHP 8.3+.
- [ ] Verificar que el motor de base de datos sea MySQL 8.
- [ ] Habilitar el módulo `mod_rewrite` en Apache (esencial para el enrutador MVC).
- [ ] Configurar el `DocumentRoot` del servidor para que apunte estrictamente al directorio `/public` del proyecto, no a la raíz.

### 2. Configuración de Base de Datos
- [ ] Crear la base de datos de producción (ej: `db_ropa_prod`).
- [ ] Ejecutar los scripts de migración (`schema.sql` y `seed.sql`) para crear las tablas y datos básicos.
- [ ] Crear un usuario MySQL exclusivo para el sistema con privilegios limitados (solo DML y DDL en esta BD específica).

### 3. Despliegue de Código
- [ ] Subir el código fuente al servidor.
- [ ] Excluir carpetas y archivos innecesarios (`/tests`, `.git`, `README.md`, archivos de configuración local).
- [ ] Otorgar permisos de escritura (chmod 775 o el adecuado según propietario) a la carpeta de subida de imágenes (`/public/images/products`) y a la carpeta de logs (`/storage/logs`).

### 4. Ajuste de Configuraciones (app.php / database.php)
- [ ] Actualizar credenciales de MySQL de producción (host, user, password, dbname).
- [ ] Cambiar la URL base (`APP_URL`) por el dominio real (ej: `https://www.midominio.com`).
- [ ] Establecer la variable de entorno `APP_ENV = 'production'`.
- [ ] Desactivar la visualización de errores (`display_errors = Off` y `error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT`).

### 5. Seguridad y Rendimiento
- [ ] Forzar la redirección a HTTPS en `.htaccess` o nivel de servidor.
- [ ] Verificar que directorios como `/app` o `/config` devuelvan error 403 o no sean accesibles públicamente.
- [ ] Limpiar cachés y sesiones de prueba previas al lanzamiento.

### 6. Verificación Post-Despliegue (Smoke Testing)
- [ ] Probar la carga de la página principal.
- [ ] Realizar un login con el usuario Administrador.
- [ ] Crear un producto de prueba, verificar la subida de imagen y eliminarlo.
- [ ] Comprobar el enlace a WhatsApp en la vista pública.
