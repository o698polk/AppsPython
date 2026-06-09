# Guía de Desarrollo: Sistema de Inventario con FastAPI y MySQL

Esta guía detalla el proceso paso a paso para ejecutar y entender la aplicación Cliente-Servidor construida.

## 1. Arquitectura del Proyecto

El proyecto está dividido en dos partes principales para separar la lógica de negocio (Backend) de la interfaz de usuario (Frontend).

```text
Sistema_de_Invetario/
├── Cliente/                 -> Frontend (Interfaz Gráfica)
│   ├── css/
│   │   └── style.css        -> Estilos visuales personalizados
│   ├── js/
│   │   └── app.js           -> Lógica JavaScript para consumir la API
│   └── index.html           -> Estructura de la página web (Bootstrap)
├── Servidor/                -> Backend (API RESTful)
│   ├── crud.py              -> Lógica de base de datos (Crear, Leer, Actualizar, Borrar)
│   ├── database.py          -> Configuración de la conexión a MySQL
│   ├── main.py              -> Archivo principal que define las rutas (Endpoints)
│   ├── models.py            -> Modelos de base de datos (Tablas)
│   ├── requirements.txt     -> Lista de dependencias de Python
│   └── schemas.py           -> Esquemas de datos para validación (Pydantic)
└── guia_desarrollo.md       -> Esta guía
```

## 2. Librerías Utilizadas y su Propósito

### Backend (Python)
- **FastAPI (`fastapi`)**: Framework moderno para construir APIs. Se aplica en `main.py` para crear las rutas web (`@app.get()`, `@app.post()`, etc.).
- **Uvicorn (`uvicorn`)**: Servidor web rápido que ejecuta la aplicación FastAPI.
- **SQLAlchemy (`sqlalchemy`)**: Herramienta ORM. Convierte código de Python en consultas SQL. Se usa en `models.py` para definir la tabla y en `crud.py` para las operaciones.
- **PyMySQL (`pymysql`)**: El "puente" que permite a SQLAlchemy conectarse al servidor MySQL (XAMPP). Se configura en `database.py`.
- **Pydantic (`pydantic`)**: Herramienta de validación de datos. Integrado en FastAPI, se usa en `schemas.py` para asegurar que los datos enviados por el usuario sean correctos (ej: que el precio sea un número).

### Frontend
- **Bootstrap 5 (CDN)**: Framework de diseño que proporciona clases CSS (`.btn`, `.container`, `.card`) para que la aplicación se vea profesional y sea responsiva en móviles sin escribir mucho CSS.
- **Fetch API (Nativo de JS)**: Se utiliza en `app.js` para enviar y recibir datos en formato JSON desde el servidor FastAPI.

## 3. Guía de Ejecución (Paso a Paso)

### Paso 1: Configurar la Base de Datos (XAMPP)
1. Abre el Panel de Control de **XAMPP**.
2. Inicia los servicios de **Apache** y **MySQL**.
3. Abre tu navegador y ve a `http://localhost/phpmyadmin/`.
4. Crea una nueva base de datos llamada `inventario_db`. (No necesitas crear las tablas, SQLAlchemy lo hará automáticamente).

### Paso 2: Ejecutar el Servidor Backend
1. Abre una terminal (Símbolo del sistema o PowerShell).
2. Navega hasta la carpeta del servidor:
   ```bash
   cd d:\IPA2026_EJERCICIOS_PRACTICOS\AppsPython\app\Sistema_de_Invetario\Servidor
   ```
3. Instala las dependencias necesarias:
   ```bash
   pip install -r requirements.txt
   ```
4. Inicia el servidor usando Uvicorn:
   ```bash
   uvicorn main:app --reload
   ```
   *Nota: `--reload` hace que el servidor se reinicie automáticamente si haces cambios en el código de Python.*
5. **Swagger UI:** Abre tu navegador en `http://127.0.0.1:8000/docs`. Verás la documentación interactiva generada automáticamente por FastAPI. Puedes probar la API desde aquí.

### Paso 3: Ejecutar el Cliente Frontend
1. Simplemente ve a la carpeta `Cliente` en tu explorador de archivos y haz doble clic en `index.html`.
2. Se abrirá en tu navegador predeterminado.
3. La interfaz se conectará automáticamente a `http://127.0.0.1:8000/productos/` gracias al código en `app.js`.
4. ¡Ya puedes empezar a agregar, editar y eliminar productos!

## 4. Conceptos Clave Aplicados
- **RESTful**: La API sigue los estándares HTTP. `GET` para obtener datos, `POST` para crear, `PUT` para actualizar y `DELETE` para borrar.
- **CORS**: En `main.py`, se configuró CORS para permitir que el archivo local `index.html` (que corre bajo `file://` o un puerto distinto) pueda hacer peticiones al servidor que corre en el puerto `8000`. Sin esto, el navegador bloquearía la conexión por seguridad.
- **Responsive Design**: Las clases de Bootstrap como `col-md-4` y `col-md-8` en `index.html` hacen que los elementos se apilen verticalmente en pantallas pequeñas y se coloquen lado a lado en pantallas de escritorio.
