<?php 
$tituloPagina = "Eliminar Producto";
require_once __DIR__ . '/../layout/header.php'; 
?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">
            <i class="bi bi-exclamation-triangle me-2"></i>Eliminar Producto #<?php echo htmlspecialchars($producto['id']); ?>
        </h4>
    </div>
    <div class="card-body">
        <div class="alert alert-warning" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            <strong>¡Atención!</strong> Esta acción no se puede deshacer.
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Información del Producto a Eliminar</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="120">ID:</th>
                                <td><?php echo htmlspecialchars($producto['id']); ?></td>
                            </tr>
                            <tr>
                                <th>Nombre:</th>
                                <td><strong><?php echo htmlspecialchars($producto['nombre']); ?></strong></td>
                            </tr>
                            <tr>
                                <th>Precio:</th>
                                <td>
                                    <span class="badge bg-success">
                                        $<?php echo number_format($producto['precio'], 2); ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Stock:</th>
                                <td>
                                    <span class="badge bg-primary">
                                        <?php echo htmlspecialchars($producto['stock']); ?> unidades
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Descripción:</h6>
                        <p class="text-muted">
                            <?php echo !empty($producto['descripcion']) ? htmlspecialchars($producto['descripcion']) : 'Sin descripción'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <h5 class="mb-4">¿Está seguro de que desea eliminar este producto?</h5>
            
            <form action="index.php?controller=producto&action=destroy" method="POST" class="d-inline">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
                
                <button type="submit" class="btn btn-danger btn-lg me-2">
                    <i class="bi bi-trash me-1"></i> Sí, Eliminar Producto
                </button>
                <a href="index.php?controller=producto&action=index" class="btn btn-secondary btn-lg">
                    <i class="bi bi-x-circle me-1"></i> No, Cancelar
                </a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
