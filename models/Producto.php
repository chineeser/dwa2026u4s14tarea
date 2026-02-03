<?php
/**
 * Modelo Producto
 * Maneja todas las operaciones de base de datos para productos
 */

class Producto {
    private $conexion;
    private $tabla = "productos";

    // Propiedades del producto
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;
    public $createdAt;

    /**
     * Constructor
     * @param PDO $baseDatos - Conexión a la base de datos
     */
    public function __construct($baseDatos) {
        $this->conexion = $baseDatos;
    }

    /**
     * Obtener todos los productos
     * @return PDOStatement
     */
    public function obtenerTodos() {
        $consulta = "SELECT id, nombre, descripcion, precio, stock, created_at 
                     FROM " . $this->tabla . " 
                     ORDER BY created_at DESC";
        
        $sentencia = $this->conexion->prepare($consulta);
        $sentencia->execute();
        
        return $sentencia;
    }

    /**
     * Obtener un producto por ID
     * @return bool
     */
    public function obtenerPorId() {
        $consulta = "SELECT id, nombre, descripcion, precio, stock, created_at 
                     FROM " . $this->tabla . " 
                     WHERE id = :id 
                     LIMIT 1";
        
        $sentencia = $this->conexion->prepare($consulta);
        $sentencia->bindParam(":id", $this->id, PDO::PARAM_INT);
        $sentencia->execute();
        
        $fila = $sentencia->fetch();
        
        if ($fila) {
            $this->nombre = $fila['nombre'];
            $this->descripcion = $fila['descripcion'];
            $this->precio = $fila['precio'];
            $this->stock = $fila['stock'];
            $this->createdAt = $fila['created_at'];
            return true;
        }
        
        return false;
    }

    /**
     * Crear un nuevo producto
     * @return bool
     */
    public function crear() {
        $consulta = "INSERT INTO " . $this->tabla . " 
                     (nombre, descripcion, precio, stock, created_at) 
                     VALUES (:nombre, :descripcion, :precio, :stock, NOW())";
        
        $sentencia = $this->conexion->prepare($consulta);
        
        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = floatval($this->precio);
        $this->stock = intval($this->stock);
        
        // Vincular parámetros
        $sentencia->bindParam(":nombre", $this->nombre);
        $sentencia->bindParam(":descripcion", $this->descripcion);
        $sentencia->bindParam(":precio", $this->precio);
        $sentencia->bindParam(":stock", $this->stock);
        
        if ($sentencia->execute()) {
            $this->id = $this->conexion->lastInsertId();
            return true;
        }
        
        return false;
    }

    /**
     * Actualizar un producto existente
     * @return bool
     */
    public function actualizar() {
        $consulta = "UPDATE " . $this->tabla . " 
                     SET nombre = :nombre, 
                         descripcion = :descripcion, 
                         precio = :precio, 
                         stock = :stock 
                     WHERE id = :id";
        
        $sentencia = $this->conexion->prepare($consulta);
        
        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = floatval($this->precio);
        $this->stock = intval($this->stock);
        $this->id = intval($this->id);
        
        // Vincular parámetros
        $sentencia->bindParam(":nombre", $this->nombre);
        $sentencia->bindParam(":descripcion", $this->descripcion);
        $sentencia->bindParam(":precio", $this->precio);
        $sentencia->bindParam(":stock", $this->stock);
        $sentencia->bindParam(":id", $this->id);
        
        return $sentencia->execute();
    }

    /**
     * Eliminar un producto
     * @return bool
     */
    public function eliminar() {
        $consulta = "DELETE FROM " . $this->tabla . " WHERE id = :id";
        
        $sentencia = $this->conexion->prepare($consulta);
        
        $this->id = intval($this->id);
        $sentencia->bindParam(":id", $this->id, PDO::PARAM_INT);
        
        return $sentencia->execute();
    }

    /**
     * Validar los datos del producto
     * @return array - Array de errores (vacío si no hay errores)
     */
    public function validar() {
        $errores = [];
        
        // Validar nombre: obligatorio y mínimo 3 caracteres
        if (empty($this->nombre)) {
            $errores['nombre'] = "El nombre es obligatorio.";
        } elseif (strlen($this->nombre) < 3) {
            $errores['nombre'] = "El nombre debe tener al menos 3 caracteres.";
        }
        
        // Validar precio: obligatorio y mayor que 0
        if ($this->precio === null || $this->precio === '') {
            $errores['precio'] = "El precio es obligatorio.";
        } elseif (!is_numeric($this->precio) || floatval($this->precio) <= 0) {
            $errores['precio'] = "El precio debe ser un número mayor que 0.";
        }
        
        // Validar stock: entero y no negativo
        if ($this->stock === null || $this->stock === '') {
            $errores['stock'] = "El stock es obligatorio.";
        } elseif (!is_numeric($this->stock) || intval($this->stock) < 0) {
            $errores['stock'] = "El stock debe ser un número entero no negativo.";
        }
        
        return $errores;
    }
}
