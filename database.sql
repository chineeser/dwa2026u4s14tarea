-- =====================================================
-- Base de Datos: tienda
-- Descripción: Script SQL para crear la base de datos
--              y tabla de productos con datos de ejemplo
-- Autor: Luis Sánchez Herrera
-- Fecha: 2026-02-02
-- =====================================================

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS ug_u4s14_tienda
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Seleccionar la base de datos
USE ug_u4s14_tienda;

-- =====================================================
-- Tabla: productos
-- Descripción: Almacena el catálogo de productos
-- =====================================================
DROP TABLE IF EXISTS productos;

CREATE TABLE productos (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT(11) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Datos de ejemplo: 5 productos
-- =====================================================
INSERT INTO productos (nombre, descripcion, precio, stock, created_at) VALUES
('Laptop HP Pavilion 15', 'Laptop HP Pavilion con procesador Intel Core i5, 8GB RAM, 256GB SSD, pantalla de 15.6 pulgadas Full HD.', 899.99, 15, NOW()),
('Mouse Inalámbrico Logitech M280', 'Mouse inalámbrico ergonómico con conexión USB, batería de larga duración y diseño compacto.', 25.50, 50, NOW()),
('Teclado Mecánico Redragon K552', 'Teclado mecánico gaming con switches Outemu Blue, retroiluminación RGB y construcción resistente.', 45.99, 30, NOW()),
('Monitor Samsung 24" Curvo', 'Monitor curvo de 24 pulgadas con resolución Full HD, panel VA, tiempo de respuesta 4ms y AMD FreeSync.', 189.00, 20, NOW()),
('Audífonos Sony WH-1000XM4', 'Audífonos inalámbricos con cancelación de ruido activa, 30 horas de batería y audio de alta resolución.', 349.99, 12, NOW());

-- =====================================================
-- Verificar datos insertados
-- =====================================================
SELECT * FROM productos;
