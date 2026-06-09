-- Script de creación de la base de datos (DDL)
-- Motor: InnoDB, Charset: utf8mb4

CREATE DATABASE IF NOT EXISTS db_ropa_mayorista
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE db_ropa_mayorista;

-- Tabla 1: roles
CREATE TABLE IF NOT EXISTS roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT NULL
) ENGINE=InnoDB;

-- Tabla 2: usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_rol INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20) NULL,
    password_hash VARCHAR(255) NOT NULL,
    estado TINYINT(1) NOT NULL DEFAULT 1,
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuarios_roles FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
) ENGINE=InnoDB;

-- Tabla 3: categorias
CREATE TABLE IF NOT EXISTS categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT NULL,
    estado TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

-- Tabla 4: productos
CREATE TABLE IF NOT EXISTS productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    sku VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT NULL,
    precio_mayorista DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock INT NOT NULL DEFAULT 0,
    estado TINYINT(1) NOT NULL DEFAULT 1,
    img_principal VARCHAR(255) NOT NULL DEFAULT 'default.jpg',
    telefono_vendedor VARCHAR(20) NOT NULL,
    fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_productos_categorias FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
) ENGINE=InnoDB;

-- Tabla 5: producto_imagenes
CREATE TABLE IF NOT EXISTS producto_imagenes (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    ruta_imagen VARCHAR(255) NOT NULL,
    orden INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_imagenes_productos FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla 6: auditoria_logs
CREATE TABLE IF NOT EXISTS auditoria_logs (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NULL,
    accion VARCHAR(50) NOT NULL,
    tabla_afectada VARCHAR(50) NOT NULL,
    id_registro INT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45) NOT NULL,
    CONSTRAINT fk_auditoria_usuarios FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE SET NULL
) ENGINE=InnoDB;
