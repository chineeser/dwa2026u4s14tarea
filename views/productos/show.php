<?php 
$tituloPagina = "Detalle del Producto";
require_once __DIR__ . '/../layout/header.php'; 
?>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">
                <i class="bi bi-eye me-2"></i>Detalle del Producto
            </h4>
            <div>
                <a href="index.php?controller=producto&action=edit&id=<?php echo htmlspecialchars($producto['id']); ?>" 
                   class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Editar
                </a>
                <a href="index.php?controller=producto&action=index" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200" class="table-light">ID</th>
                                <td><?php echo htmlspecialchars($producto['id']); ?></td>
                            </tr>
                            <tr>
                                <th class="table-light">Nombre</th>
                                <td><strong><?php echo htmlspecialchars($producto['nombre']); ?></strong></td>
                            </tr>
                            <tr>
                                <th class="table-light">Descripción</th>
                                <td>
                                    <?php echo !empty($producto['descripcion']) ? nl2br(htmlspecialchars($producto['descripcion'])) : '<em class="text-muted">Sin descripción</em>'; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-light">Precio</th>
                                <td>
                                    <span class="badge bg-success fs-6">
                                        $<?php echo number_format($producto['precio'], 2); ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-light">Stock Disponible</th>
                                <td>
                                    <?php if ($producto['stock'] > 10): ?>
                                        <span class="badge bg-success fs-6">
                                            <i class="bi bi-check-circle me-1"></i>
                                            <?php echo htmlspecialchars($producto['stock']); ?> unidades
                                        </span>
                                    <?php elseif ($producto['stock'] > 0): ?>
                                        <span class="badge bg-warning fs-6">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <?php echo htmlspecialchars($producto['stock']); ?> unidades (Stock bajo)
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger fs-6">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Sin stock
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-light">Fecha de Creación</th>
                                <td>
                                    <i class="bi bi-calendar me-1"></i>
                                    <?php echo date('d/m/Y', strtotime($producto['createdAt'])); ?>
                                    <i class="bi bi-clock ms-2 me-1"></i>
                                    <?php echo date('H:i:s', strtotime($producto['createdAt'])); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <i class="bi bi-box-seam display-1 text-primary mb-3"></i>
                        <h4><?php echo htmlspecialchars($producto['nombre']); ?></h4>
                        <p class="display-6 text-success mb-2">
                            $<?php echo number_format($producto['precio'], 2); ?>
                        </p>
                        <p class="text-muted">
                            <?php echo htmlspecialchars($producto['stock']); ?> en stock
                        </p>
                    </div>
                </div>
                
                <div class="d-grid gap-2 mt-3">
                    <a href="index.php?controller=producto&action=edit&id=<?php echo htmlspecialchars($producto['id']); ?>" 
                       class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i> Editar Producto
                    </a>
                    <a href="index.php?controller=producto&action=delete&id=<?php echo htmlspecialchars($producto['id']); ?>" 
                       class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Eliminar Producto
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
