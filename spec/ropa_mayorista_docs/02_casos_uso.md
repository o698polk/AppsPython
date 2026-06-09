# 2. Casos de Uso
## Sistema de Venta de Ropa al por Mayor

### Actores del Sistema
1. **Administrador:** Control total sobre el sistema, usuarios, configuraciones y catálogo.
2. **Operador:** Personal encargado de la gestión del inventario y productos.
3. **Cliente (Usuario Registrado):** Accede al catálogo completo.
4. **Visitante (Usuario Anónimo):** Navega por el catálogo público básico.

---

### CU-01: Autenticación y Autorización
- **Actor:** Todos
- **Descripción:** Permite a los usuarios acceder a sus respectivas áreas mediante login y recuperar su contraseña en caso de olvido.
- **Flujo Principal:** 
  1. El usuario ingresa credenciales.
  2. El sistema valida las credenciales.
  3. El sistema redirige según el rol (Dashboard para Admin/Operador, Catálogo para Cliente).

### CU-02: Gestión de Productos
- **Actor:** Administrador, Operador
- **Descripción:** Permite administrar el catálogo de ropa.
- **Flujo Principal:** 
  1. El actor accede al módulo de productos.
  2. Selecciona crear, editar, eliminar o cambiar estado de un producto.
  3. El sistema valida los datos y actualiza la base de datos.
  4. El sistema sube las imágenes correspondientes a la galería.

### CU-03: Gestión de Categorías
- **Actor:** Administrador, Operador
- **Descripción:** Administra la taxonomía del catálogo.
- **Flujo Principal:**
  1. El actor ingresa a Categorías.
  2. Puede agregar, modificar o deshabilitar categorías de ropa (Ej: Polos, Pantalones, Casacas).

### CU-04: Navegación del Catálogo
- **Actor:** Visitante, Cliente
- **Descripción:** Búsqueda y filtrado de productos.
- **Flujo Principal:**
  1. El actor ingresa a la página principal.
  2. Utiliza la barra de búsqueda o hace clic en una categoría.
  3. El sistema muestra resultados paginados.

### CU-05: Redirección a Compra (WhatsApp)
- **Actor:** Cliente, Visitante
- **Descripción:** Generación del contacto comercial.
- **Flujo Principal:**
  1. El actor visualiza el detalle de un producto.
  2. Hace clic en "Comprar por WhatsApp".
  3. El sistema genera la URL de API de WhatsApp con el teléfono del vendedor y el texto preformateado (Nombre, SKU, Precio).
  4. El actor es redirigido a WhatsApp Web o la App móvil.

### CU-06: Visualización de Dashboard
- **Actor:** Administrador
- **Descripción:** Consulta de métricas del negocio.
- **Flujo Principal:**
  1. Inicia sesión como Admin.
  2. El sistema consulta y muestra totales de productos, usuarios y registros recientes.

### CU-07: Gestión de Usuarios y Roles
- **Actor:** Administrador
- **Descripción:** Administración de cuentas del sistema.
- **Flujo Principal:**
  1. Accede al módulo de Usuarios.
  2. Puede crear nuevos operadores o desactivar clientes.
