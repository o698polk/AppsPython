from pydantic import BaseModel
from typing import Optional

# ==========================================
# Archivo: schemas.py
# Propósito: Definir los esquemas de datos con Pydantic.
# Estos esquemas validan los datos de entrada/salida de la API REST y documentan en Swagger.
# ==========================================

class ProductoBase(BaseModel):
    """
    Esquema base con los atributos comunes de un producto.
    """
    nombre: str
    descripcion: Optional[str] = None
    precio: float
    cantidad: int = 0

class ProductoCrear(ProductoBase):
    """
    Esquema utilizado para CREAR un producto. 
    Hereda de ProductoBase, por lo que pide los mismos datos.
    """
    pass

class Producto(ProductoBase):
    """
    Esquema utilizado para LEER un producto desde la API.
    Añade el 'id' que viene de la base de datos.
    """
    id: int

    class Config:
        # Permite a Pydantic leer datos directamente de modelos SQLAlchemy (ORM)
        from_attributes = True
