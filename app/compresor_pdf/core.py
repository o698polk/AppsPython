import os
from pathlib import Path
import fitz  # PyMuPDF

class PDFValidationError(Exception):
    """Excepción lanzada cuando falla la validación de rutas o formato."""
    pass

class PDFCompressionError(Exception):
    """Excepción lanzada cuando ocurre un error durante la compresión."""
    pass

def validar_rutas(input_path: str, output_path: str) -> tuple[Path, Path]:
    """
    Valida la existencia del archivo de entrada, su formato, y previene
    Path Traversal resolviendo las rutas a rutas absolutas reales.
    """
    try:
        input_p = Path(input_path).resolve()
        output_p = Path(output_path).resolve()
    except Exception as e:
        raise PDFValidationError(f"Error al resolver las rutas: {e}")

    if not input_p.exists():
        raise PDFValidationError("El archivo de entrada no existe.")
    
    if not input_p.is_file():
        raise PDFValidationError("La ruta de entrada no es un archivo.")
        
    if input_p.suffix.lower() != '.pdf':
        raise PDFValidationError("El archivo de entrada no tiene una extensión .pdf válida.")
        
    # Validar cabecera (Magic number de PDF)
    try:
        with open(input_p, 'rb') as f:
            header = f.read(4)
            if header != b'%PDF':
                raise PDFValidationError("El archivo no tiene un formato interno de PDF válido.")
    except Exception as e:
        raise PDFValidationError(f"No se pudo leer el archivo de entrada: {e}")

    return input_p, output_p

def comprimir_pdf(input_path: str, output_path: str) -> None:
    """
    Comprime un PDF usando PyMuPDF aplicando recolección de basura y compresión deflate.
    """
    in_p, out_p = validar_rutas(input_path, output_path)
    
    try:
        doc = fitz.open(in_p)
        # Opciones de optimización:
        # garbage=4: Recolectar basura, eliminar objetos no referenciados, deduplicar imágenes/fuentes
        # deflate=True: Comprimir streams (flujos de datos internos)
        # clean=True: Limpiar sintaxis de objetos
        doc.save(out_p, garbage=4, deflate=True, clean=True)
        doc.close()
    except Exception as e:
        raise PDFCompressionError(f"Error al comprimir el PDF: {e}")
