-- Script de inserción de datos iniciales (DML)
USE db_ropa_mayorista;

-- 1. Insertar roles básicos
INSERT INTO roles (nombre, descripcion) VALUES
('Administrador', 'Control total del sistema'),
('Operador', 'Gestión de catálogo e inventario'),
('Cliente', 'Usuario registrado que navega el catálogo');

-- 2. Insertar usuarios por defecto (admin y cliente)
-- Admin password: Admin123!
-- Cliente password: Cliente123!
INSERT INTO usuarios (id_rol, nombre, apellido, correo, telefono, password_hash) VALUES
((SELECT id_rol FROM roles WHERE nombre = 'Administrador'), 'Admin', 'Principal', 'admin@mayorista.com', '999888777', '$2y$10$QhjOzImTt1R1ebkSmm9iq.d52rEZKRGq4Rx18UAoWjkWB2cNXmfru'),
((SELECT id_rol FROM roles WHERE nombre = 'Cliente'), 'Juan', 'Perez', 'cliente@mayorista.com', '999777666', '$2y$10$2yM2ypd/CVuWLE7LtMJ8x.TRdErFnrZqgfvPGERX5Fhd230afYOBG');

-- 3. Insertar algunas categorías de prueba
INSERT INTO categorias (nombre, descripcion) VALUES
('Polos', 'Polos de algodón para hombre y mujer'),
('Pantalones', 'Jeans y pantalones de vestir'),
('Casacas', 'Casacas de invierno y cortavientos'),
('Accesorios', 'Gorras, correas y otros complementos');

-- 4. Insertar productos de prueba
INSERT INTO productos (id_categoria, nombre, sku, descripcion, precio_mayorista, stock, img_principal, telefono_vendedor) VALUES
((SELECT id_categoria FROM categorias WHERE nombre = 'Polos'), 'Polo Básico Blanco', 'POL-001', 'Polo 100% algodón', 15.50, 100, 'polo_blanco.jpg', '999111222'),
((SELECT id_categoria FROM categorias WHERE nombre = 'Pantalones'), 'Jean Clásico Azul', 'PAN-001', 'Jean slim fit', 35.00, 50, 'jean_azul.jpg', '999111222'),
((SELECT id_categoria FROM categorias WHERE nombre = 'Casacas'), 'Casaca Cortavientos', 'CAS-001', 'Ideal para invierno', 45.00, 30, 'default-icon.png', '999111222'),
((SELECT id_categoria FROM categorias WHERE nombre = 'Accesorios'), 'Gorra Deportiva', 'ACC-001', 'Gorra ajustable', 12.00, 80, 'default-icon.png', '999111222');
