from sqlalchemy import Column, Integer, String, Float
from database import Base

# ==========================================
# Archivo: models.py
# Propósito: Definir la estructura de las tablas en la base de datos usando SQLAlchemy.
# ==========================================

class Producto(Base):
    """
    Modelo de la tabla 'productos' en la base de datos.
    Hereda de 'Base' que fue creado en database.py.
    """
    __tablename__ = "productos"

    # Columna 'id': Entero, clave primaria, se autoincrementa.
    id = Column(Integer, primary_key=True, index=True)
    
    # Columna 'nombre': Texto, no puede ser nulo, indexada para búsquedas rápidas.
    nombre = Column(String(100), index=True, nullable=False)
    
    # Columna 'descripcion': Texto descriptivo del producto.
    descripcion = Column(String(255), nullable=True)
    
    # Columna 'precio': Número decimal para el costo del producto.
    precio = Column(Float, nullable=False)
    
    # Columna 'cantidad': Número entero para el stock disponible.
    cantidad = Column(Integer, default=0)
