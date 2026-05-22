# Documentación Técnica: Compresor PDF (GUI)

Este documento detalla la estructura, librerías, clases, funciones y el flujo lógico del proyecto **Compresor PDF**, línea por línea.

---

## 1. Arquitectura del Proyecto

El proyecto sigue una arquitectura separada por capas (Lógica de Negocio y Presentación) para garantizar el mantenimiento y la escalabilidad:

- `core.py`: Contiene toda la lógica de negocio, validaciones de seguridad y algoritmos de compresión. Es independiente de la interfaz gráfica.
- `gui.py`: Contiene la capa de presentación (Frontend de escritorio). Maneja la interacción con el usuario y se comunica con `core.py`.
- `requirements.txt`: Lista de dependencias externas.
- `tests/test_core.py`: Pruebas unitarias para validar la robustez del core.

---

## 2. Librerías Utilizadas

1. **`PyMuPDF` (importado como `fitz`)**: Librería principal para la lectura y manipulación del formato PDF. Se eligió por su alto rendimiento y sus capacidades nativas de recolección de basura (*garbage collection*) y compresión de flujos internos de datos (*deflate*).
2. **`customtkinter` (ctk)**: Framework de interfaz gráfica de usuario basado en Tkinter. Se utiliza para proveer una ventana moderna, con soporte para temas oscuros/claros y componentes estéticos.
3. **`pathlib`**: Librería nativa de Python (módulo estándar) usada para el manejo seguro de rutas de archivos en distintos sistemas operativos y prevención de *Path Traversal*.
4. **`threading`**: Librería nativa de Python utilizada para la ejecución asíncrona (multihilo), evitando que la ventana gráfica se congele mientras el archivo se comprime.
5. **`pytest`**: Framework de pruebas unitarias utilizado en la capa de testing.

---

## 3. Desglose de Código: `core.py`

Este archivo es el corazón de la aplicación.

### Clases de Excepción Personalizadas
```python
class PDFValidationError(Exception): ...
class PDFCompressionError(Exception): ...
```
- **Descripción**: Heredan de la clase base `Exception`. Se utilizan para capturar y diferenciar errores específicos: validación de formatos (`PDFValidationError`) frente a fallos internos de la librería al intentar reducir el tamaño (`PDFCompressionError`).

### Función `validar_rutas(input_path: str, output_path: str) -> tuple[Path, Path]`
**Objetivo**: Validar que la ruta de origen sea segura y el archivo sea un PDF real.
- `Path(input_path).resolve()`: Convierte el texto (string) en un objeto de ruta segura y absoluta, previniendo inyecciones de directorios relativos maliciosos (ej. `../../archivo`).
- `if not input_p.exists():`: Comprueba que el archivo físico exista en el disco duro.
- `if input_p.suffix.lower() != '.pdf':`: Verifica que la terminación del archivo sea correcta.
- `header = f.read(4)`: Lee los primeros 4 bytes del archivo en binario.
- `if header != b'%PDF':`: Valida la cabecera (Magic Number). Garantiza que, sin importar la extensión, el archivo interno sea un PDF legítimo.

### Función `comprimir_pdf(input_path: str, output_path: str) -> None`
**Objetivo**: Ejecutar la reducción de tamaño.
- `in_p, out_p = validar_rutas(...)`: Obliga a que la ejecución pase primero por la capa de seguridad.
- `doc = fitz.open(in_p)`: Abre y carga el documento PDF en memoria usando PyMuPDF.
- `doc.save(out_p, garbage=4, deflate=True, clean=True)`: El núcleo matemático de la compresión. 
  - `garbage=4`: Busca y elimina objetos no referenciados, duplicados de imágenes y fuentes repetidas en la jerarquía del PDF.
  - `deflate=True`: Aplica el algoritmo de compresión sin pérdida (zlib/deflate) a los bloques de texto e imágenes.
  - `clean=True`: Limpia y sanea la sintaxis interna del archivo.
- `doc.close()`: Libera la memoria RAM del sistema.

---

## 4. Desglose de Código: `gui.py`

Este archivo controla la vista del usuario y reacciona a sus acciones.

### Clase `App(ctk.CTk)`
**Objetivo**: Instanciar y configurar la ventana principal de la aplicación.
- `super().__init__()`: Inicializa el componente base del framework CustomTkinter.
- `self.geometry("500x350")`: Define el tamaño de la ventana (ancho x alto).
- `self.input_path = ctk.StringVar()`: Variable de control reactiva que almacena la ruta del PDF. Si cambia, la interfaz se entera automáticamente.
- **`setup_ui(self)`**: Método dedicado a "dibujar" los componentes:
  - `ctk.CTkLabel`, `ctk.CTkButton`, `ctk.CTkFrame`: Renderizan textos, botones y cajas contenedoras.
  - `command=self.seleccionar_pdf`: Conecta el clic del botón con el método de acción lógica.

### Método `seleccionar_pdf(self)`
- `filedialog.askopenfilename(...)`: Invoca al explorador de archivos nativo de Windows para que el usuario busque de manera visual el PDF.
- `self.input_path.set(filepath)`: Guarda la ruta y actualiza el texto en la interfaz.

### Método `comprimir_hilo(self)`
**Objetivo**: Interceptar el clic en "Comprimir" y evitar cuelgues del sistema operativo.
- `threading.Thread(target=self.proceso_compresion, daemon=True).start()`: Inicia un hilo secundario (`daemon=True` para que muera si se cierra la app). Si la compresión demora 10 segundos, la interfaz seguirá respondiendo en el hilo principal sin mostrar el error "La aplicación no responde".

### Método `proceso_compresion(self)`
**Objetivo**: Enlazar la GUI con la lógica del `core.py`.
- `out_p = in_path_obj.with_name(...)`: Utiliza lógica de paths para autocompletar la ruta de salida, agregando la cadena `_compressed` para nunca borrar/sobrescribir el archivo original.
- `comprimir_pdf(input_p, str(out_p))`: Dispara la función del core analizada en la sección 3.
- `size_in = in_path_obj.stat().st_size / 1024 / 1024`: Consulta al sistema de archivos los metadatos para obtener los bytes y los transforma en Megabytes (MB).
- `self.after(0, self.mostrar_exito, msg)`: **Comando crítico.** Puesto que la UI pertenece al Hilo Principal, cualquier modificación visual desde el hilo secundario (el de `threading`) lanzaría un error en Tkinter. `self.after(0, ...)` empuja la orden de actualizar la UI de regreso al hilo principal de forma segura.

### Bloque de Arranque `if __name__ == "__main__":`
- `ctk.set_appearance_mode("System")`: Lee la configuración de Windows y adopta automáticamente el Modo Oscuro o Claro según corresponda.
- `app.mainloop()`: Inicia el bucle infinito que captura los eventos del mouse y el teclado.
