# 3. Historias de Usuario
## Sistema de Venta de Ropa al por Mayor

| ID | Como... | Quiero... | Para... | Criterios de Aceptación |
|----|---------|-----------|---------|-------------------------|
| **HU-01** | Visitante | Poder registrarme en la plataforma ingresando mis datos personales | Crear una cuenta y acceder a beneficios de cliente | 1. Formulario con: Nombre, Apellido, Correo, Teléfono, Pass. 2. Validaciones JS y PHP. 3. Pass encriptada. |
| **HU-02** | Usuario | Iniciar sesión usando mi correo/usuario y contraseña | Acceder a la plataforma según mi rol | 1. Bloqueo tras 5 intentos fallidos (Rate limit). 2. Redirección según rol. |
| **HU-03** | Usuario | Recuperar mi contraseña | Restablecer mi acceso si lo olvido | 1. Envío de token por email. 2. Enlace de expiración de 15 min. |
| **HU-04** | Administrador | Ver un dashboard con estadísticas básicas | Conocer el estado general de la plataforma | 1. Mostrar tarjetas de conteo. 2. Mostrar lista de últimos 5 usuarios registrados. |
| **HU-05** | Operador | Tener un CRUD completo de productos | Mantener el inventario de ropa actualizado | 1. Crear producto con múltiples imágenes. 2. Asignar SKU único. 3. Validar precio mayorista > 0. |
| **HU-06** | Operador | Activar o desactivar productos | Ocultar productos sin stock sin eliminarlos | 1. Botón de toggle en lista de productos. 2. Ocultos no se muestran en el catálogo. |
| **HU-07** | Operador | Gestionar categorías de ropa | Organizar el catálogo de forma estructurada | 1. CRUD de categorías. 2. No se puede eliminar una categoría si tiene productos asociados (restricción BD). |
| **HU-08** | Cliente | Ver el catálogo público con filtros y paginación | Encontrar la ropa que deseo comprar rápidamente | 1. Búsqueda por nombre/SKU. 2. Filtro por categoría. 3. Máximo 12 productos por página. |
| **HU-09** | Cliente | Ver el detalle de un producto específico | Conocer descripción, precio, stock y galería | 1. Slider de imágenes (Bootstrap Carousel). 2. Mostrar estado de disponibilidad (En stock / Agotado). |
| **HU-10** | Cliente | Hacer clic en "Comprar" y ser redirigido a WhatsApp | Contactar al vendedor para cerrar el trato | 1. Enlace generado dinámicamente: `wa.me/numero?text=Hola...`. 2. Abrir en nueva pestaña (`_blank`). |
| **HU-11** | Administrador | Gestionar usuarios y cambiar roles | Controlar quién tiene acceso administrativo | 1. Lista de usuarios. 2. Editar rol (Cliente a Operador, etc.). |
