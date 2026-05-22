# Skill 01: Compresor de PDF

Esta es la lista de verificación para la ejecución controlada. La IA debe completar cada paso secuencialmente, asegurando las validaciones correspondientes antes de avanzar.

- [x] **Paso 1: Configuración de Entorno**
  - [x] Crear el subdirectorio `app/compresor_pdf/`.
  - [x] Crear `app/compresor_pdf/requirements.txt` agregando `PyMuPDF`, `customtkinter` y `pytest`.
  - [x] Crear estructura de módulos: `core.py`, `gui.py` y la carpeta `tests/`.

- [x] **Paso 2: Capa de Seguridad y Validación**
  - [x] En `core.py`, implementar la función `validar_rutas(input_path, output_path)` asegurándose de que:
    - El archivo de entrada exista.
    - La extensión del archivo sea `.pdf` (prevención de formato incorrecto).
    - Prevención de Path Traversal utilizando `pathlib.Path.resolve()`.

- [x] **Paso 3: Lógica de Compresión**
  - [x] En `core.py`, implementar `comprimir_pdf(input_path, output_path)`.
  - [x] Integrar `PyMuPDF` (fitz). Abrir el documento y guardarlo usando opciones de optimización (`garbage=4`, `deflate=True`, `clean=True`).

- [x] **Paso 4: Capa de Testing**
  - [x] En `tests/test_core.py`, escribir tests que:
    - Verifiquen que la validación de rutas falle correctamente si no es PDF.
    - Verifiquen que un PDF pequeño de prueba (se debe generar programáticamente para el test) se lea y se guarde sin excepciones.
  - [x] Ejecutar los tests (usando `run_command` con `pytest`) y asegurar que pasen.

- [x] **Paso 5: Interfaz Gráfica de Usuario (GUI)**
  - [x] En `gui.py`, inicializar la ventana principal con `customtkinter`.
  - [x] Crear componentes visuales: botón "Seleccionar PDF", label para la ruta, y botón "Comprimir".
  - [x] Enlazar el botón "Comprimir" con las funciones de `core.py`, manejando las excepciones de manera controlada (mostrando alertas en la GUI y sin exponer stack traces innecesarios).

- [x] **Paso 6: Validación Final**
  - [x] Documentar cómo ejecutar la aplicación en un archivo `README.md` interno del módulo.
  - [x] Reportar la finalización al usuario mostrando el modo de uso.
