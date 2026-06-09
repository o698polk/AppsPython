from fastapi import FastAPI, Depends, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from sqlalchemy.orm import Session
from typing import List

import models
import schemas
import crud
from database import engine, get_db

# ==========================================
# Archivo: main.py
# Propósito: Archivo principal de la aplicación FastAPI. Define los Endpoints (Rutas) de la API REST.
# ==========================================

# 1. Crear las tablas en la base de datos MySQL si no existen.
# Esto se conecta a XAMPP usando la configuración en database.py.
models.Base.metadata.create_all(bind=engine)

# 2. Inicializar la aplicación FastAPI.
# Al instanciar FastAPI, Swagger UI se configura automáticamente en la ruta /docs
app = FastAPI(
    title="Sistema de Inventario API RESTful",
    description="API para gestionar el inventario de productos usando FastAPI y MySQL",
    version="1.0.0"
)

# 3. Configurar CORS (Cross-Origin Resource Sharing)
# Esto permite que nuestro Cliente (Frontend) en HTML/JS pueda hacer peticiones a este Servidor.
# Sin esto, el navegador bloquearía las peticiones por seguridad.
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"], # Permite peticiones de cualquier origen (En producción debe ser la URL del Frontend)
    allow_credentials=True,
    allow_methods=["*"], # Permite todos los métodos (GET, POST, PUT, DELETE, etc.)
    allow_headers=["*"], # Permite todos los headers
)

# ==========================================
# RUTAS DE LA API (Endpoints)
# ==========================================

@app.get("/productos/", response_model=List[schemas.Producto])
def listar_productos(skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    """
    Obtiene la lista de todos los productos en el inventario.
    """
    productos = crud.get_productos(db, skip=skip, limit=limit)
    return productos

@app.get("/productos/{producto_id}", response_model=schemas.Producto)
def obtener_producto(producto_id: int, db: Session = Depends(get_db)):
    """
    Obtiene un producto específico a partir de su ID.
    """
    db_producto = crud.get_producto(db, producto_id=producto_id)
    if db_producto is None:
        raise HTTPException(status_code=404, detail="Producto no encontrado")
    return db_producto

@app.post("/productos/", response_model=schemas.Producto)
def crear_producto(producto: schemas.ProductoCrear, db: Session = Depends(get_db)):
    """
    Crea un nuevo producto en la base de datos.
    """
    return crud.crear_producto(db=db, producto=producto)

@app.put("/productos/{producto_id}", response_model=schemas.Producto)
def actualizar_producto(producto_id: int, producto: schemas.ProductoCrear, db: Session = Depends(get_db)):
    """
    Actualiza un producto existente.
    """
    db_producto = crud.actualizar_producto(db=db, producto_id=producto_id, producto_actualizado=producto)
    if db_producto is None:
        raise HTTPException(status_code=404, detail="Producto no encontrado")
    return db_producto

@app.delete("/productos/{producto_id}")
def eliminar_producto(producto_id: int, db: Session = Depends(get_db)):
    """
    Elimina un producto del inventario.
    """
    db_producto = crud.eliminar_producto(db=db, producto_id=producto_id)
    if db_producto is None:
        raise HTTPException(status_code=404, detail="Producto no encontrado")
    return {"mensaje": "Producto eliminado exitosamente"}
