# Spec 01: Compresor de PDF

## Objetivo
Desarrollar una aplicación de escritorio en Python que permita comprimir archivos PDF para reducir su tamaño de almacenamiento, manteniendo la legibilidad y asegurando la integridad del documento mediante una interfaz gráfica.

## Alcance
- **Entrada:** Ruta local a un archivo PDF existente.
- **Salida:** Un nuevo archivo PDF optimizado.
- **Lógica:** Se utilizará la librería `PyMuPDF` (fitz) por su eficiencia y capacidades nativas de compresión (deflate) y recolección de basura en la estructura del PDF.
- **Ubicación:** Todo el desarrollo estará encapsulado en `app/compresor_pdf/`.
- **GUI:** Se implementará una interfaz gráfica de usuario de escritorio utilizando `customtkinter` para una experiencia moderna e intuitiva.

## Pasos de implementación
1. Inicializar el entorno en `app/compresor_pdf/` incluyendo un `requirements.txt`.
2. Implementar la validación de entrada (seguridad).
3. Desarrollar la lógica de compresión en `core.py`.
4. Desarrollar la interfaz gráfica (GUI) en `gui.py` utilizando `customtkinter`.
5. Implementar y ejecutar la capa de pruebas (unitarias).

## Riesgos y supuestos
- **Riesgo:** PDFs con firmas digitales podrían perder validez al reescribirse, o PDFs extremadamente pequeños podrían no comprimirse o incluso aumentar ligeramente su tamaño.
- **Mitigación:** La aplicación nunca sobrescribirá el archivo original por defecto, siempre generará un `_compressed.pdf`. Se advertirá sobre la limitación con firmas.
- **Riesgo de Seguridad (Path Traversal):** Lectura/escritura en directorios no autorizados a través de los argumentos de la CLI.
- **Mitigación (Seguridad):** Uso de `pathlib` para resolver y validar rutas absolutas de forma segura.
- **Supuesto:** El entorno dispone de Python 3.8+ y permisos de escritura.
