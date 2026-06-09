from sqlalchemy.orm import Session
import models, schemas

# ==========================================
# Archivo: crud.py
# Propósito: Funciones para operaciones CRUD (Crear, Leer, Actualizar, Borrar) en la BD.
# ==========================================

def get_productos(db: Session, skip: int = 0, limit: int = 100):
    """
    Lee una lista de productos desde la base de datos.
    """
    return db.query(models.Producto).offset(skip).limit(limit).all()

def get_producto(db: Session, producto_id: int):
    """
    Lee un producto específico por su ID.
    """
    return db.query(models.Producto).filter(models.Producto.id == producto_id).first()

def crear_producto(db: Session, producto: schemas.ProductoCrear):
    """
    Crea un nuevo producto en la base de datos.
    """
    # 1. Creamos una instancia del modelo SQLAlchemy con los datos del esquema Pydantic
    db_producto = models.Producto(
        nombre=producto.nombre,
        descripcion=producto.descripcion,
        precio=producto.precio,
        cantidad=producto.cantidad
    )
    # 2. Agregamos el objeto a la sesión
    db.add(db_producto)
    # 3. Guardamos los cambios en la base de datos
    db.commit()
    # 4. Refrescamos el objeto para obtener su nuevo 'id' asignado por MySQL
    db.refresh(db_producto)
    return db_producto

def actualizar_producto(db: Session, producto_id: int, producto_actualizado: schemas.ProductoCrear):
    """
    Actualiza los datos de un producto existente.
    """
    db_producto = db.query(models.Producto).filter(models.Producto.id == producto_id).first()
    if db_producto:
        db_producto.nombre = producto_actualizado.nombre
        db_producto.descripcion = producto_actualizado.descripcion
        db_producto.precio = producto_actualizado.precio
        db_producto.cantidad = producto_actualizado.cantidad
        db.commit()
        db.refresh(db_producto)
    return db_producto

def eliminar_producto(db: Session, producto_id: int):
    """
    Elimina un producto por su ID.
    """
    db_producto = db.query(models.Producto).filter(models.Producto.id == producto_id).first()
    if db_producto:
        db.delete(db_producto)
        db.commit()
    return db_producto
