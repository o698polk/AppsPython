# Skill: App Web de Cámara

Esta checklist guía el desarrollo progresivo de la aplicación de cámara web, asegurando el cumplimiento de la arquitectura base.

## Fases de Ejecución

- [ ] 1. **Configuración de entorno y dependencias**
  - Configurar entorno virtual y archivo `requirements.txt` en `app/camara_web/`.
  - Instalar dependencias backend (Flask, y herramientas para SSL como `pyopenssl` si es necesario).

- [ ] 2. **Creación de la estructura base del módulo**
  - Crear `app.py` para el backend.
  - Crear carpetas `templates/` y `static/`.
  - Crear `templates/index.html` (Frontend base).
  - Crear `static/style.css` y `static/script.js`.

- [ ] 3. **Implementación de la interfaz web (Frontend)**
  - Integrar Bootstrap vía CDN en `index.html`.
  - Diseñar la UI responsiva con un elemento `<video>` y botones de control (Abrir/Cerrar cámara, Cambiar cámara frontal/trasera si aplica).
  - Implementar lógica en `script.js` usando `navigator.mediaDevices.getUserMedia` para solicitar permisos y mostrar el stream.

- [ ] 4. **Implementación del servidor (Backend) y Seguridad**
  - Configurar rutas en `app.py` para servir el HTML y archivos estáticos.
  - Generar un certificado autofirmado (ad-hoc) o configurar instrucciones para ejecutar sobre HTTPS, de modo que los navegadores móviles permitan el acceso a la cámara.

- [ ] 5. **Pruebas y Validación**
  - Ejecutar la aplicación en la máquina local.
  - Validar acceso mediante IP local desde un dispositivo móvil para probar el acceso a la cámara real.
