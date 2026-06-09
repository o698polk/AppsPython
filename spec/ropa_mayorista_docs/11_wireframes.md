# 11. Wireframes y UI Conceptual
## Sistema de Venta de Ropa al por Mayor

### 11.1 Catálogo - Página Principal (Público)
**Estructura Visual:**
- **Navbar:** Logo (Izq), Barra de Búsqueda (Centro), Botones Iniciar Sesión/Registro (Der).
- **Hero Section:** Banner promocional ancho completo.
- **Sección Categorías:** Tarjetas pequeñas horizontales o etiquetas tipo "pill" (Polos, Jeans, etc.).
- **Grid de Productos:** Sistema de rejilla (3 o 4 columnas en Desktop, 2 en Tablet, 1 en Móvil).
  - Cada tarjeta: Imagen del producto, Nombre, Precio Mayorista, Botón "Ver Detalle".
- **Paginación:** Números de página al final del grid.
- **Footer:** Información de contacto, enlaces de interés.
- **Flotante:** Icono de WhatsApp en la esquina inferior derecha.

### 11.2 Detalle de Producto
**Estructura Visual:**
- **Breadcrumb:** Inicio > Categoría > Producto
- **Columna Izquierda (Media):** 
  - Imagen principal grande.
  - Miniaturas debajo (Galería).
- **Columna Derecha (Info):**
  - Título del Producto (H1).
  - SKU y Categoría.
  - Precio Mayorista destacado (H2).
  - Estado de Stock (Badge verde/rojo).
  - Descripción completa.
  - Botón grande y destacado: **[ 💬 Comprar por WhatsApp ]**.

### 11.3 Dashboard (Administrador/Operador)
**Estructura Visual:**
- **Sidebar (Izquierda):** Menú de navegación (Resumen, Productos, Categorías, Usuarios, Salir).
- **Top Bar:** Saludo al usuario, botón de perfil.
- **Content Area:**
  - **Cards Superiores:** 
    - [Total Productos: 150]
    - [Total Usuarios: 45]
    - [Total Categorías: 8]
  - **Tabla de Últimos Productos Registrados.**

### 11.4 Formulario CRUD Producto
**Estructura Visual (Modal o Página Nueva):**
- Campos:
  - Nombre (Input Text)
  - SKU (Input Text)
  - Categoría (Select Dropdown)
  - Precio (Input Number)
  - Stock (Input Number)
  - Descripción (Textarea o WYSIWYG básico)
  - Estado (Switch Activo/Inactivo)
  - Imagen Principal (Input File)
  - Teléfono Vendedor (Input Text)
- Botones: [Cancelar] [Guardar Producto]

### 11.5 Login
**Estructura Visual:**
- Contenedor centrado en pantalla.
- Logo arriba.
- Input Correo / Usuario.
- Input Contraseña.
- Botón Iniciar Sesión.
- Enlace "¿Olvidaste tu contraseña?".
- Enlace "¿No tienes cuenta? Regístrate".
