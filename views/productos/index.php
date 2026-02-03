<?php 
$tituloPagina = "Lista de Productos";
require_once __DIR__ . '/../layout/header.php'; 
?>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">Catálogo de Productos</h4>
            <a href="index.php?controller=producto&action=create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Producto
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if (isset($mensaje) && $mensaje): ?>
            <div class="alert alert-<?php echo htmlspecialchars($tipoMensaje); ?> alert-dismissible fade show" role="alert">
                <i class="bi bi-<?php echo $tipoMensaje === 'success' ? 'check-circle' : 'exclamation-triangle'; ?> me-2"></i>
                <?php echo htmlspecialchars($mensaje); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>
        
        <?php if (empty($productos)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                No hay productos registrados. <a href="index.php?controller=producto&action=create">Crear el primero</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tablaProductos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Fecha Creación</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto['id']); ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($producto['nombre']); ?></strong>
                                </td>
                                <td>
                                    <?php 
                                    $descripcion = htmlspecialchars($producto['descripcion']);
                                    echo strlen($descripcion) > 50 ? substr($descripcion, 0, 50) . '...' : $descripcion;
                                    ?>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        $<?php echo number_format($producto['precio'], 2); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo $producto['stock'] > 0 ? 'primary' : 'danger'; ?>">
                                        <?php echo htmlspecialchars($producto['stock']); ?> unidades
                                    </span>
                                </td>
                                <td>
                                    <?php echo date('d/m/Y H:i', strtotime($producto['created_at'])); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="index.php?controller=producto&action=show&id=<?php echo $producto['id']; ?>" 
                                           class="btn btn-sm btn-info" title="Ver detalle">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="index.php?controller=producto&action=edit&id=<?php echo $producto['id']; ?>" 
                                           class="btn btn-sm btn-warning" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="index.php?controller=producto&action=delete&id=<?php echo $producto['id']; ?>" 
                                           class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                <p class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Total de productos: <strong><?php echo count($productos); ?></strong>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
