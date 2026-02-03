# Sistema CRUD de Productos - PHP MVC
# Universidad de Guayaquil
# Desarrollo de Aplicaciones Web
# Tarea (U4S14)

## Descripción del Proyecto

Aplicación web desarrollada en PHP bajo arquitectura MVC (Modelo-Vista-Controlador) para gestionar un catálogo de productos. Incluye operaciones CRUD completas (Crear, Leer, Actualizar y Borrar).

## Estructura del Proyecto

```
u4s14tarea/
├── config/
│   └── database.php          # Archivo de configuración de la conexión a MySQL
├── controllers/
│   └── ProductoController.php# Controlador de productos
├── models/
│   └── Producto.php          # Modelo de datos de producto
├── views/
│   ├── layout/
│   │   ├── header.php        # Cabecera
│   │   └── footer.php        # Pie de página
│   └── productos/
│       ├── index.php         # Listado de productos
│       ├── create.php        # Formulario de creación de productos
│       ├── edit.php          # Formulario de edición de productos
│       ├── show.php          # Detalle del producto
│       └── delete.php        # Confirmación de eliminación del producto
├── public/
│   ├── css/
│   │   └── estilos.css       # Estilos basados en Mazer Admin (https://zuramai.github.io/mazer/)
│   ├── js/
│   │   └── app.js            # JavaScript de la aplicación
│   └── index.php             # Front Controller (punto de entrada)
├── database.sql              # Script SQL de la base de datos
└── README.md                 # Este archivo
```

## Requisitos

- **XAMPP** (o cualquier servidor Apache con PHP y MySQL)
- **PHP 7.4** o superior
- **MySQL 5.7** o superior
- Navegador web moderno


## Rutas Disponibles

| Acción | URL | Descripción |
|--------|-----|-------------|
| Listar | `?controller=producto&action=index` | Ver todos los productos |
| Crear | `?controller=producto&action=create` | Formulario de nuevo producto |
| Guardar | `?controller=producto&action=store` | Guardar nuevo producto (POST) |
| Ver | `?controller=producto&action=show&id=X` | Ver detalle de un producto |
| Editar | `?controller=producto&action=edit&id=X` | Formulario de edición |
| Actualizar | `?controller=producto&action=update` | Actualizar producto (POST) |
| Eliminar | `?controller=producto&action=delete&id=X` | Confirmación de eliminación |
| Confirmar | `?controller=producto&action=destroy` | Ejecutar eliminación (POST) |

## Validaciones

El sistema incluye las siguientes validaciones:

| Campo | Regla |
|-------|-------|
| **nombre** | Obligatorio, mínimo 3 caracteres |
| **precio** | Obligatorio, número mayor que 0 |
| **stock** | Obligatorio, número entero no negativo |
| **descripcion** | Opcional |

Los errores se muestran en el formulario correspondiente.

## Notas

- Las variables y funciones están nombradas en español usando camelCase
- El código está documentado con comentarios en español
- Se incluyen 5 productos de ejemplo en el archivo SQL

## Autor

Universidad de Guayaquil  
Carrera: Ingeniería en Sistemas  
Materia: Desarrollo de Aplicaciones Web  
Período: 2025 TI2
Autor: Luis Alberto Sánchez Herrera 
