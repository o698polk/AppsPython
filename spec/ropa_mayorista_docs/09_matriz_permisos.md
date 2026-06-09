# 9. Matriz de Permisos y Roles
## Sistema de Venta de Ropa al por Mayor

Se implementará Control de Acceso Basado en Roles (RBAC).

| Módulo / Funcionalidad | Cliente | Operador | Administrador |
|------------------------|---------|----------|---------------|
| **Catálogo Público** | | | |
| Ver Listado de Productos | ✔️ | ✔️ | ✔️ |
| Ver Detalle de Producto | ✔️ | ✔️ | ✔️ |
| Clic en "Comprar" (WhatsApp) | ✔️ | ✔️ | ✔️ |
| **Autenticación** | | | |
| Iniciar / Cerrar Sesión | ✔️ | ✔️ | ✔️ |
| Recuperar Contraseña | ✔️ | ✔️ | ✔️ |
| **Dashboard** | | | |
| Ver Estadísticas y Totales | ❌ | ❌ | ✔️ |
| **Gestión de Productos** | | | |
| Crear Producto | ❌ | ✔️ | ✔️ |
| Editar Producto | ❌ | ✔️ | ✔️ |
| Eliminar Producto | ❌ | ❌ | ✔️ |
| Cambiar Estado (Activo/Inactivo)| ❌ | ✔️ | ✔️ |
| **Gestión de Categorías** | | | |
| Crear Categoría | ❌ | ✔️ | ✔️ |
| Editar Categoría | ❌ | ✔️ | ✔️ |
| Eliminar Categoría | ❌ | ❌ | ✔️ |
| **Gestión de Usuarios** | | | |
| Ver Listado de Usuarios | ❌ | ❌ | ✔️ |
| Cambiar Rol de Usuario | ❌ | ❌ | ✔️ |
| Desactivar Cuenta | ❌ | ❌ | ✔️ |
| **Configuraciones** | | | |
| Ver Logs de Auditoría | ❌ | ❌ | ✔️ |
| Editar Ajustes del Sistema | ❌ | ❌ | ✔️ |

*Nota: Un Visitante (no registrado) tendrá acceso limitado de solo-lectura al catálogo, posiblemente no pudiendo ver el precio o el botón de compra hasta que se registre (dependiendo de la regla de negocio que se defina en la implementación).*
