# Directrices de Ejecución para IA (AI Skill)

Esta "skill" define las reglas de procesamiento y ejecución que la Inteligencia Artificial debe seguir estrictamente al desarrollar en este proyecto.

## Reglas de Comportamiento Central
1. **Análisis Previo**: ANTES de escribir código en `app/`, lee y analiza el documento `spec/` correspondiente.
2. **Desglose de Tareas**: La ejecución no es monolítica. Divide el trabajo detallado en el `spec` en etapas pequeñas y controladas.
3. **No Suposición de Tecnologías**: La capa de orquestación (`spec/` y `skill/`) es agnóstica. Solo adapta tu lógica al framework tecnológico una vez que estés operando dentro de `app/` o cuando el plan lo especifique claramente.
4. **Validación en Cada Paso**:
   - Escribe el código del componente.
   - Aplica la capa de testing (pruebas unitarias/funcionales según el framework).
   - Aplica la capa de seguridad (validación de inputs, prevención de inyecciones, manejo seguro de errores).
   - Verifica el funcionamiento (si es posible en el entorno local) antes de continuar a la siguiente etapa de la skill.

## Fases de una "Skill" típica
Cuando se te asigne una nueva tarea, generarás un archivo en este directorio `skill/` con una lista de verificación (`- [ ]`) como la siguiente:
- [ ] 1. Configuración de entorno y dependencias.
- [ ] 2. Creación de la estructura base del módulo.
- [ ] 3. Implementación de la lógica de negocio (con testing).
- [ ] 4. Revisión de seguridad y validación de checklist.
- [ ] 5. Integración con el resto del sistema en `app/`.
