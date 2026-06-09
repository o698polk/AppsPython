# 8. Diseño de Base de Datos MySQL
## Sistema de Venta de Ropa al por Mayor

Motor: **InnoDB** | Charset: **utf8mb4** | Collation: **utf8mb4_unicode_ci**

### 1. Tabla: `roles`
| Columna | Tipo | Nulo | Default | Restricción / Extra |
|---------|------|------|---------|---------------------|
| id_rol | INT | No | - | PK, AUTO_INCREMENT |
| nombre | VARCHAR(50) | No | - | UNIQUE |
| descripcion | TEXT | Sí | NULL | |

### 2. Tabla: `usuarios`
| Columna | Tipo | Nulo | Default | Restricción / Extra |
|---------|------|------|---------|---------------------|
| id_usuario | INT | No | - | PK, AUTO_INCREMENT |
| id_rol | INT | No | - | FK -> roles.id_rol |
| nombre | VARCHAR(100)| No | - | |
| apellido| VARCHAR(100)| No | - | |
| correo | VARCHAR(150)| No | - | UNIQUE |
| telefono | VARCHAR(20) | Sí | NULL | |
| password_hash | VARCHAR(255)| No | - | |
| estado | TINYINT(1) | No | 1 | (1=Activo, 0=Inactivo) |
| fecha_registro | DATETIME | No | CURRENT_TIMESTAMP | |

### 3. Tabla: `categorias`
| Columna | Tipo | Nulo | Default | Restricción / Extra |
|---------|------|------|---------|---------------------|
| id_categoria| INT | No | - | PK, AUTO_INCREMENT |
| nombre | VARCHAR(100)| No | - | UNIQUE |
| descripcion | TEXT | Sí | NULL | |
| estado | TINYINT(1) | No | 1 | |

### 4. Tabla: `productos`
| Columna | Tipo | Nulo | Default | Restricción / Extra |
|---------|------|------|---------|---------------------|
| id_producto | INT | No | - | PK, AUTO_INCREMENT |
| id_categoria| INT | No | - | FK -> categorias.id_categoria |
| nombre | VARCHAR(150)| No | - | |
| sku | VARCHAR(50) | No | - | UNIQUE |
| descripcion | TEXT | Sí | NULL | |
| precio_mayorista| DECIMAL(10,2)| No | 0.00 | |
| stock | INT | No | 0 | |
| estado | TINYINT(1) | No | 1 | |
| img_principal| VARCHAR(255)| No | 'default.jpg' | |
| telefono_vendedor| VARCHAR(20)| No | - | Para enlace de WhatsApp |
| fecha_creacion| DATETIME | No | CURRENT_TIMESTAMP | |

### 5. Tabla: `producto_imagenes`
| Columna | Tipo | Nulo | Default | Restricción / Extra |
|---------|------|------|---------|---------------------|
| id_imagen | INT | No | - | PK, AUTO_INCREMENT |
| id_producto | INT | No | - | FK -> productos.id_producto ON DELETE CASCADE |
| ruta_imagen | VARCHAR(255)| No | - | |
| orden | INT | No | 0 | Para ordenamiento en UI |

### 6. Tabla: `auditoria_logs`
| Columna | Tipo | Nulo | Default | Restricción / Extra |
|---------|------|------|---------|---------------------|
| id_log | INT | No | - | PK, AUTO_INCREMENT |
| id_usuario | INT | Sí | NULL | FK -> usuarios.id_usuario |
| accion | VARCHAR(50) | No | - | Ej: 'CREATE', 'UPDATE', 'DELETE', 'LOGIN' |
| tabla_afectada| VARCHAR(50) | No | - | |
| id_registro | INT | Sí | NULL | |
| fecha | DATETIME | No | CURRENT_TIMESTAMP | |
| ip_address | VARCHAR(45) | No | - | |
