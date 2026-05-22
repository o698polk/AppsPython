# Plan Base: Arquitectura de Orquestación Spec-as-Source

## Objetivo
Establecer el marco de trabajo central basado en el enfoque "spec-as-source" para garantizar la planificación estructurada, la ejecución controlada progresiva, y el mantenimiento del contexto por parte del agente de IA.

## Alcance
Aplica a la totalidad del desarrollo dentro de este repositorio. Todas las futuras solicitudes de características, refactorizaciones o correcciones de errores deberán pasar por este flujo de trabajo obligatoriamente.

## Pasos de implementación
1. **Inicialización de Estructura**: Creación de las carpetas `spec/`, `skill/` y `app/`.
2. **Definición de Capas Transversales**:
   - **Testing**: Requisito de pruebas unitarias y funcionales para cada componente.
   - **Seguridad**: Checklist de validación contra vulnerabilidades comunes.
3. **Flujo de Trabajo Estándar**:
   - Petición del usuario.
   - Generación de `spec/[nombre_tarea].md`.
   - Generación de `skill/[nombre_tarea].md`.
   - Aprobación del usuario.
   - Ejecución por etapas sobre `app/`.

## Riesgos y supuestos
- **Riesgo**: La IA podría intentar escribir código directamente en `app/` omitiendo la planificación.
- **Mitigación**: Este documento sirve como ancla de contexto. El sistema evaluará siempre primero la existencia de un `spec` y un `skill`.
- **Supuesto**: Todo el código de la aplicación residirá estrictamente bajo el directorio `app/`, manteniendo `spec/` y `skill/` agnósticos al framework tecnológico elegido.
