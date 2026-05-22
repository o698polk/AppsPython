import os
from pathlib import Path
import pytest
import fitz
from core import validar_rutas, comprimir_pdf, PDFValidationError

def test_validar_rutas_not_pdf(tmp_path):
    # Crear un archivo de texto
    p = tmp_path / "test.txt"
    p.write_text("not a pdf")
    
    with pytest.raises(PDFValidationError, match="no tiene una extensión .pdf válida"):
        validar_rutas(str(p), "out.pdf")

def test_validar_rutas_not_exists(tmp_path):
    p = tmp_path / "nonexistent.pdf"
    with pytest.raises(PDFValidationError, match="no existe"):
        validar_rutas(str(p), "out.pdf")

def test_comprimir_pdf_exitoso(tmp_path):
    # Crear un PDF de prueba usando fitz
    in_pdf = tmp_path / "in.pdf"
    out_pdf = tmp_path / "out.pdf"
    
    doc = fitz.open()
    page = doc.new_page()
    page.insert_text((50, 50), "Hola, soy un PDF de prueba")
    doc.save(in_pdf)
    doc.close()
    
    # Comprimir
    comprimir_pdf(str(in_pdf), str(out_pdf))
    
    # Verificar que el out.pdf existe y es valido
    assert out_pdf.exists()
    
    out_doc = fitz.open(out_pdf)
    assert out_doc.page_count == 1
    out_doc.close()
