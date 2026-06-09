# Especificación: App Web de Cámara

## 1. Objetivo
Desarrollar una aplicación web que permita al usuario abrir y visualizar la cámara de su dispositivo (especialmente teléfonos móviles). 

## 2. Tecnologías
- **Frontend**: HTML5, CSS (Bootstrap 5), JavaScript (API `navigator.mediaDevices.getUserMedia`).
- **Backend**: Python (Flask o FastAPI, en este caso utilizaremos Flask por su simplicidad para servir archivos estáticos y plantillas).

## 3. Alcance
- Servidor backend en Python que sirve la interfaz web.
- Interfaz web con un botón para iniciar la cámara y un elemento `<video>` para mostrar el stream en tiempo real.
- Uso de Bootstrap para que la interfaz sea responsiva y se adapte a pantallas de celulares.

## 4. Riesgos y Consideraciones
- **Seguridad (HTTPS)**: Para que los navegadores móviles permitan el acceso a la cámara mediante `getUserMedia`, la aplicación DEBE servirse bajo un contexto seguro (HTTPS) o desde `localhost`. Si el usuario accede desde su celular a la IP local de la computadora (ej. `192.168.x.x`), el navegador bloqueará la cámara por estar en HTTP.
- **Mitigación**: Será necesario configurar certificados autofirmados (SSL) en Flask o utilizar una herramienta de túnel como `ngrok` para exponer el servidor local a través de una URL HTTPS pública.

## 5. Ubicación
Todo el código de la aplicación residirá en `app/camara_web/`.
