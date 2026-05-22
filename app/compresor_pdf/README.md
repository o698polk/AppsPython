# Compresor PDF (GUI)

Esta es una aplicación de escritorio desarrollada en Python utilizando `PyMuPDF` para la compresión de archivos PDF y `customtkinter` para la interfaz gráfica.

## Requisitos Previos

Asegúrate de tener Python 3.8+ instalado. Luego, instala las dependencias:

```bash
pip install -r requirements.txt
```

## Cómo Ejecutar

Para iniciar la aplicación gráfica, ejecuta el siguiente comando desde este directorio:

```bash
python gui.py
```

## Funcionalidades
- **Seleccionar PDF:** Permite abrir un cuadro de diálogo del sistema operativo para seleccionar el archivo.
- **Validación:** Verifica que la ruta exista, no tenga vulnerabilidades de Path Traversal y sea un PDF válido.
- **Compresión:** Utiliza algoritmos de recolección de basura y compresión *deflate* para reducir el tamaño del archivo sin pérdida funcional de calidad.
- **Guardado Seguro:** Nunca sobrescribe el archivo original, siempre genera uno nuevo con el sufijo `_compressed.pdf`.
