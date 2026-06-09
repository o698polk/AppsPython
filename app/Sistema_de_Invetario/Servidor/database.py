from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker, declarative_base

# ==========================================
# Archivo: database.py
# Propósito: Configurar la conexión con MySQL utilizando SQLAlchemy.
# ==========================================

# URL de conexión a la base de datos MySQL en XAMPP.
# Formato: mysql+pymysql://usuario:contraseña@servidor:puerto/nombre_base_datos
# Asumimos que el usuario por defecto de XAMPP es "root" sin contraseña.
SQLALCHEMY_DATABASE_URL = "mysql+pymysql://root:@localhost:3306/inventario_db"

# Crear el motor (engine) que gestiona la conexión con la base de datos
engine = create_engine(SQLALCHEMY_DATABASE_URL)

# Crear una clase para generar sesiones de base de datos.
# Las sesiones son "ventanas" temporales para interactuar con la base de datos.
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

# Clase base de la cual heredarán todos los modelos de la base de datos (tablas)
Base = declarative_base()

# Función generadora para obtener una sesión de base de datos.
# Se usa en los endpoints de FastAPI para inyectar la dependencia de la base de datos.
def get_db():
    db = SessionLocal()
    try:
        yield db # Retorna la sesión para ser usada
    finally:
        db.close() # Asegura que la conexión se cierre al terminar
