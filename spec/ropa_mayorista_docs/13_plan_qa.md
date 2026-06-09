# 13. Plan de Pruebas QA
## Sistema de Venta de Ropa al por Mayor

### 1. Pruebas Funcionales (Caja Negra)
| ID Prueba | Descripción | Resultado Esperado |
|-----------|-------------|--------------------|
| QA-F01 | Registro de un nuevo usuario con datos correctos. | Cuenta creada, redirección al login. |
| QA-F02 | Login con credenciales inválidas (5 veces). | Mensaje de error y bloqueo de cuenta o IP (Rate Limit). |
| QA-F03 | Creación de producto sin ingresar precio. | Error de validación en el formulario (backend y frontend). |
| QA-F04 | Subida de imagen con formato no soportado (.exe o .pdf). | Sistema rechaza el archivo y muestra mensaje de error. |
| QA-F05 | Clic en el botón "Comprar" en el detalle de un producto. | Apertura de nueva pestaña hacia `wa.me` con el mensaje y número correctos. |
| QA-F06 | Búsqueda de un producto inexistente. | Mensaje amigable "No se encontraron resultados". |

### 2. Pruebas de Seguridad (OWASP)
- **QA-S01 (Inyección SQL):** Intentar bypass de login ingresando `' OR '1'='1` en el campo de usuario.
- **QA-S02 (XSS):** Intentar ingresar un script `<script>alert(1)</script>` en la descripción de un producto.
- **QA-S03 (CSRF):** Intentar borrar un producto enviando un POST directamente desde una herramienta externa sin el token CSRF válido.
- **QA-S04 (Control de Acceso):** Intentar acceder a la URL `/admin/productos/crear` sin estar logueado o estando logueado como "Cliente". Debe redirigir al login o dar error 403.

### 3. Pruebas de Responsividad y UI
- **QA-UI01:** Visualización del catálogo en resolución móvil (320px - 480px). El grid debe ser de 1 columna.
- **QA-UI02:** Funcionamiento del menú hamburguesa en móviles.
- **QA-UI03:** El modal de galería de imágenes en el detalle de producto se adapta sin desbordar la pantalla.

### 4. Checklist de Aceptación del Usuario (UAT)
- [ ] El administrador puede iniciar sesión y ver el dashboard.
- [ ] El operador puede subir un polo con 3 fotos y ponerle precio.
- [ ] El cliente final puede buscar el polo, ver las fotos y hacer clic en comprar, abriendo su WhatsApp listo para enviar el mensaje.
