# 5. Diagrama de Módulos
## Sistema de Venta de Ropa al por Mayor

### Estructura Modular Principal

El aplicativo está compuesto por 5 módulos principales altamente cohesivos.

```mermaid
graph TD
    A[Core del Sistema MVC] --> B(Módulo de Autenticación)
    A --> C(Módulo de Catálogo Público)
    A --> D(Módulo de Gestión de Productos)
    A --> E(Módulo de Dashboard / Admin)
    A --> F(Módulo de Integración)

    B --> B1[Login]
    B --> B2[Registro]
    B --> B3[Recuperar Password]
    B --> B4[Gestión de Sesión]

    C --> C1[Listado de Productos]
    C --> C2[Buscador y Filtros]
    C --> C3[Detalle de Producto]
    C --> C4[Paginación]

    D --> D1[CRUD Productos]
    D --> D2[CRUD Categorías]
    D --> D3[Gestión de Imágenes]
    D --> D4[Control de Stock]

    E --> E1[Métricas Generales]
    E --> E2[Gestión de Usuarios]
    E --> E3[Configuraciones Generales]

    F --> F1[Generador Enlace WhatsApp]
```

### Descripción de Componentes

1. **Core del Sistema:**
   - Enrutador base.
   - Conexión a Base de Datos (PDO Wrapper).
   - Manejador de Sesiones.
   - Control de Errores y Logging.

2. **Módulo de Autenticación:**
   - Maneja todo el flujo de acceso, seguridad de contraseñas y recuperación. Valida los roles del usuario.

3. **Módulo de Catálogo Público:**
   - Es la cara visible para el cliente y visitantes. Optimizado para la visualización de imágenes y búsqueda rápida.

4. **Módulo de Gestión de Productos (Backend):**
   - Panel de uso exclusivo para Operadores y Administradores. Permite mantener el catálogo actualizado y gestionar el almacenamiento de imágenes locales de los productos.

5. **Módulo de Dashboard / Admin:**
   - Resumen gerencial para el Administrador y gestión de acceso para el personal.

6. **Módulo de Integración:**
   - Construye dinámicamente las URIs de WhatsApp basado en los datos del producto actual y la configuración del número del vendedor.
