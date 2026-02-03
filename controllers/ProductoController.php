<?php
/**
 * Controlador de Productos
 * Maneja todas las acciones relacionadas con productos
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $baseDatos;
    private $producto;

    /**
     * Constructor
     */
    public function __construct() {
        $database = new Database();
        $this->baseDatos = $database->obtenerConexion();
        $this->producto = new Producto($this->baseDatos);
    }

    /**
     * Listar todos los productos
     */
    public function index() {
        $resultado = $this->producto->obtenerTodos();
        $productos = $resultado->fetchAll();
        
        // Mensaje de sesión si existe
        $mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : null;
        $tipoMensaje = isset($_SESSION['tipoMensaje']) ? $_SESSION['tipoMensaje'] : null;
        unset($_SESSION['mensaje'], $_SESSION['tipoMensaje']);
        
        require_once __DIR__ . '/../views/productos/index.php';
    }

    /**
     * Mostrar formulario de creación
     */
    public function create() {
        $errores = [];
        $producto = [
            'nombre' => '',
            'descripcion' => '',
            'precio' => '',
            'stock' => ''
        ];
        
        require_once __DIR__ . '/../views/productos/create.php';
    }

    /**
     * Guardar nuevo producto
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->producto->nombre = $_POST['nombre'] ?? '';
            $this->producto->descripcion = $_POST['descripcion'] ?? '';
            $this->producto->precio = $_POST['precio'] ?? '';
            $this->producto->stock = $_POST['stock'] ?? '';
            
            $errores = $this->producto->validar();
            
            if (empty($errores)) {
                if ($this->producto->crear()) {
                    $_SESSION['mensaje'] = "Producto creado exitosamente.";
                    $_SESSION['tipoMensaje'] = "success";
                    header("Location: index.php?controller=producto&action=index");
                    exit();
                } else {
                    $errores['general'] = "Error al crear el producto.";
                }
            }
            
            // Si hay errores, mostrar el formulario con los datos ingresados
            $producto = [
                'nombre' => $_POST['nombre'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'precio' => $_POST['precio'] ?? '',
                'stock' => $_POST['stock'] ?? ''
            ];
            
            require_once __DIR__ . '/../views/productos/create.php';
        } else {
            header("Location: index.php?controller=producto&action=create");
            exit();
        }
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id <= 0) {
            $_SESSION['mensaje'] = "ID de producto no válido.";
            $_SESSION['tipoMensaje'] = "danger";
            header("Location: index.php?controller=producto&action=index");
            exit();
        }
        
        $this->producto->id = $id;
        
        if ($this->producto->obtenerPorId()) {
            $producto = [
                'id' => $this->producto->id,
                'nombre' => $this->producto->nombre,
                'descripcion' => $this->producto->descripcion,
                'precio' => $this->producto->precio,
                'stock' => $this->producto->stock
            ];
            $errores = [];
            
            require_once __DIR__ . '/../views/productos/edit.php';
        } else {
            $_SESSION['mensaje'] = "Producto no encontrado.";
            $_SESSION['tipoMensaje'] = "danger";
            header("Location: index.php?controller=producto&action=index");
            exit();
        }
    }

    /**
     * Actualizar producto existente
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            
            if ($id <= 0) {
                $_SESSION['mensaje'] = "ID de producto no válido.";
                $_SESSION['tipoMensaje'] = "danger";
                header("Location: index.php?controller=producto&action=index");
                exit();
            }
            
            $this->producto->id = $id;
            $this->producto->nombre = $_POST['nombre'] ?? '';
            $this->producto->descripcion = $_POST['descripcion'] ?? '';
            $this->producto->precio = $_POST['precio'] ?? '';
            $this->producto->stock = $_POST['stock'] ?? '';
            
            $errores = $this->producto->validar();
            
            if (empty($errores)) {
                if ($this->producto->actualizar()) {
                    $_SESSION['mensaje'] = "Producto actualizado exitosamente.";
                    $_SESSION['tipoMensaje'] = "success";
                    header("Location: index.php?controller=producto&action=index");
                    exit();
                } else {
                    $errores['general'] = "Error al actualizar el producto.";
                }
            }
            
            // Si hay errores, mostrar el formulario con los datos ingresados
            $producto = [
                'id' => $id,
                'nombre' => $_POST['nombre'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'precio' => $_POST['precio'] ?? '',
                'stock' => $_POST['stock'] ?? ''
            ];
            
            require_once __DIR__ . '/../views/productos/edit.php';
        } else {
            header("Location: index.php?controller=producto&action=index");
            exit();
        }
    }

    /**
     * Mostrar confirmación de eliminación
     */
    public function delete() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id <= 0) {
            $_SESSION['mensaje'] = "ID de producto no válido.";
            $_SESSION['tipoMensaje'] = "danger";
            header("Location: index.php?controller=producto&action=index");
            exit();
        }
        
        $this->producto->id = $id;
        
        if ($this->producto->obtenerPorId()) {
            $producto = [
                'id' => $this->producto->id,
                'nombre' => $this->producto->nombre,
                'descripcion' => $this->producto->descripcion,
                'precio' => $this->producto->precio,
                'stock' => $this->producto->stock
            ];
            
            require_once __DIR__ . '/../views/productos/delete.php';
        } else {
            $_SESSION['mensaje'] = "Producto no encontrado.";
            $_SESSION['tipoMensaje'] = "danger";
            header("Location: index.php?controller=producto&action=index");
            exit();
        }
    }

    /**
     * Confirmar y ejecutar eliminación
     */
    public function destroy() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            
            if ($id <= 0) {
                $_SESSION['mensaje'] = "ID de producto no válido.";
                $_SESSION['tipoMensaje'] = "danger";
                header("Location: index.php?controller=producto&action=index");
                exit();
            }
            
            $this->producto->id = $id;
            
            if ($this->producto->eliminar()) {
                $_SESSION['mensaje'] = "Producto eliminado exitosamente.";
                $_SESSION['tipoMensaje'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error al eliminar el producto.";
                $_SESSION['tipoMensaje'] = "danger";
            }
            
            header("Location: index.php?controller=producto&action=index");
            exit();
        } else {
            header("Location: index.php?controller=producto&action=index");
            exit();
        }
    }

    /**
     * Mostrar detalle de un producto
     */
    public function show() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id <= 0) {
            $_SESSION['mensaje'] = "ID de producto no válido.";
            $_SESSION['tipoMensaje'] = "danger";
            header("Location: index.php?controller=producto&action=index");
            exit();
        }
        
        $this->producto->id = $id;
        
        if ($this->producto->obtenerPorId()) {
            $producto = [
                'id' => $this->producto->id,
                'nombre' => $this->producto->nombre,
                'descripcion' => $this->producto->descripcion,
                'precio' => $this->producto->precio,
                'stock' => $this->producto->stock,
                'createdAt' => $this->producto->createdAt
            ];
            
            require_once __DIR__ . '/../views/productos/show.php';
        } else {
            $_SESSION['mensaje'] = "Producto no encontrado.";
            $_SESSION['tipoMensaje'] = "danger";
            header("Location: index.php?controller=producto&action=index");
            exit();
        }
    }
}
