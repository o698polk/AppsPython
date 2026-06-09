# Sistema de Inventario (Cliente-Servidor)

Este es el plan de implementación para el desarrollo de un Sistema de Inventario con arquitectura Cliente-Servidor, utilizando FastAPI para el backend (con base de datos MySQL en XAMPP) y HTML/CSS/JS con Bootstrap para el frontend.

## User Review Required

> [!IMPORTANT]
> Se requiere que XAMPP esté instalado y el servicio de MySQL (Apache y MySQL) esté en ejecución en su máquina local antes de ejecutar el servidor backend. ¿Ya cuenta con XAMPP iniciado y una base de datos creada (por ejemplo, llamada `inventario_db`) o prefiere que el código genere la base de datos automáticamente si no existe?

## Proposed Changes

Se crearán dos carpetas principales dentro de `d:\IPA2026_EJERCICIOS_PRACTICOS\AppsPython\app\Sistema_de_Invetario`: **Cliente** y **Servidor**.

### Servidor (Backend con FastAPI)

Esta carpeta contendrá la API RESTful y la conexión a la base de datos.
Se utilizarán las siguientes librerías:
- `fastapi`: Framework web moderno y rápido para construir APIs con Python.
- `uvicorn`: Servidor ASGI para ejecutar la aplicación FastAPI.
- `sqlalchemy`: Herramienta SQL y ORM (Object Relational Mapper) para Python, facilita la interacción con MySQL.
- `pymysql`: Driver de MySQL para Python, necesario para que SQLAlchemy se conecte a la base de datos de XAMPP.

#### [NEW] Servidor/requirements.txt
Listado de dependencias para instalar con `pip`.

#### [NEW] Servidor/database.py
Configuración de la conexión a MySQL usando SQLAlchemy.

#### [NEW] Servidor/models.py
Definición de las tablas de la base de datos (Modelo `Producto`).

#### [NEW] Servidor/schemas.py
Definición de los esquemas de Pydantic para la validación de datos (Swagger UI los utiliza para documentar la API).

#### [NEW] Servidor/crud.py
Operaciones Create, Read, Update, Delete para la base de datos.

#### [NEW] Servidor/main.py
Archivo principal de la API. Define las rutas RESTful (`/productos`) e incluye Swagger UI automáticamente.

### Cliente (Frontend con HTML/JS/Bootstrap)

Interfaz gráfica responsiva que consumirá la API.
Se utilizará:
- `HTML5`: Estructura de la página.
- `Bootstrap 5`: Framework CSS para diseño responsivo y componentes (tablas, modales, botones).
- `JavaScript (Fetch API)`: Para hacer peticiones HTTP al servidor FastAPI.

#### [NEW] Cliente/index.html
Página principal con la tabla de inventario y formulario.

#### [NEW] Cliente/css/style.css
Estilos personalizados adicionales.

#### [NEW] Cliente/js/app.js
Lógica de la aplicación para consumir la API RESTful.

### Guía de Desarrollo

Al finalizar, generaré un artefacto `guia_desarrollo.md` que explicará explícitamente todo el proceso de desarrollo, cómo levantar los servicios, para qué sirve cada librería y cómo funciona el código, tal como lo solicitó.

## Verification Plan

### Automated Tests
- Iniciar XAMPP (MySQL).
- Ejecutar el servidor backend con `uvicorn main:app --reload`.
- Abrir `http://127.0.0.1:8000/docs` para verificar que Swagger UI carga correctamente y probar los endpoints.
- Abrir el archivo `Cliente/index.html` en el navegador y verificar que la interfaz carga, es responsiva y puede comunicarse con el backend para listar y crear productos.
