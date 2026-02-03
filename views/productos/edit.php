<?php 
$tituloPagina = "Editar Producto";
require_once __DIR__ . '/../layout/header.php'; 
?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <i class="bi bi-pencil me-2"></i>Editar Producto #<?php echo htmlspecialchars($producto['id']); ?>
        </h4>
    </div>
    <div class="card-body">
        <?php if (isset($errores['general'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?php echo htmlspecialchars($errores['general']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>
        
        <form action="index.php?controller=producto&action=update" method="POST" class="form" id="formularioProducto">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
            
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label">Nombre del Producto <span class="text-danger">*</span></label>
                        <input type="text" 
                               id="nombre" 
                               name="nombre" 
                               class="form-control <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" 
                               placeholder="Ingrese el nombre del producto"
                               value="<?php echo htmlspecialchars($producto['nombre']); ?>"
                               required>
                        <?php if (isset($errores['nombre'])): ?>
                            <div class="invalid-feedback">
                                <?php echo htmlspecialchars($errores['nombre']); ?>
                            </div>
                        <?php endif; ?>
                        <small class="text-muted">Mínimo 3 caracteres</small>
                    </div>
                </div>
                
                <div class="col-md-3 col-12">
                    <div class="form-group mb-3">
                        <label for="precio" class="form-label">Precio ($) <span class="text-danger">*</span></label>
                        <input type="number" 
                               id="precio" 
                               name="precio" 
                               class="form-control <?php echo isset($errores['precio']) ? 'is-invalid' : ''; ?>" 
                               placeholder="0.00"
                               step="0.01"
                               min="0.01"
                               value="<?php echo htmlspecialchars($producto['precio']); ?>"
                               required>
                        <?php if (isset($errores['precio'])): ?>
                            <div class="invalid-feedback">
                                <?php echo htmlspecialchars($errores['precio']); ?>
                            </div>
                        <?php endif; ?>
                        <small class="text-muted">Debe ser mayor a 0</small>
                    </div>
                </div>
                
                <div class="col-md-3 col-12">
                    <div class="form-group mb-3">
                        <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                        <input type="number" 
                               id="stock" 
                               name="stock" 
                               class="form-control <?php echo isset($errores['stock']) ? 'is-invalid' : ''; ?>" 
                               placeholder="0"
                               min="0"
                               value="<?php echo htmlspecialchars($producto['stock']); ?>"
                               required>
                        <?php if (isset($errores['stock'])): ?>
                            <div class="invalid-feedback">
                                <?php echo htmlspecialchars($errores['stock']); ?>
                            </div>
                        <?php endif; ?>
                        <small class="text-muted">Número entero no negativo</small>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea id="descripcion" 
                                  name="descripcion" 
                                  class="form-control" 
                                  rows="4"
                                  placeholder="Ingrese una descripción del producto (opcional)"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Actualizar Producto
                    </button>
                    <a href="index.php?controller=producto&action=index" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Cancelar
                    </a>
                    <a href="index.php?controller=producto&action=delete&id=<?php echo htmlspecialchars($producto['id']); ?>" 
                       class="btn btn-danger ms-auto">
                        <i class="bi bi-trash me-1"></i> Eliminar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
