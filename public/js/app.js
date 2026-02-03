/**
 * JavaScript - Aplicación de Gestión de Productos
 * Funcionalidades interactivas del frontend
 */

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar componentes
    inicializarSidebar();
    inicializarFormularios();
    inicializarAlertas();
});

/**
 * Inicializar funcionalidad del sidebar
 */
function inicializarSidebar() {
    const burgerBtn = document.querySelector('.burger-btn');
    const sidebar = document.querySelector('#sidebar');
    const sidebarHide = document.querySelector('.sidebar-hide');
    
    if (burgerBtn && sidebar) {
        burgerBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('active');
        });
    }
    
    if (sidebarHide && sidebar) {
        sidebarHide.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.remove('active');
        });
    }
    
    // Cerrar sidebar al hacer clic fuera en móvil
    document.addEventListener('click', function(e) {
        if (window.innerWidth < 1200) {
            if (!sidebar.contains(e.target) && !burgerBtn.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        }
    });
}

/**
 * Inicializar validación de formularios
 */
function inicializarFormularios() {
    const formularios = document.querySelectorAll('form');
    
    formularios.forEach(function(formulario) {
        formulario.addEventListener('submit', function(e) {
            const camposRequeridos = formulario.querySelectorAll('[required]');
            let esValido = true;
            
            camposRequeridos.forEach(function(campo) {
                if (!validarCampo(campo)) {
                    esValido = false;
                }
            });
            
            if (!esValido) {
                e.preventDefault();
                mostrarMensaje('Por favor, complete todos los campos requeridos correctamente.', 'danger');
            }
        });
        
        // Validación en tiempo real
        const campos = formulario.querySelectorAll('.form-control');
        campos.forEach(function(campo) {
            campo.addEventListener('blur', function() {
                validarCampo(campo);
            });
            
            campo.addEventListener('input', function() {
                // Remover clase de error mientras escribe
                if (campo.classList.contains('is-invalid')) {
                    validarCampo(campo);
                }
            });
        });
    });
}

/**
 * Validar un campo individual
 * @param {HTMLElement} campo - El campo a validar
 * @returns {boolean} - Si el campo es válido
 */
function validarCampo(campo) {
    const nombre = campo.getAttribute('name');
    const valor = campo.value.trim();
    let esValido = true;
    let mensajeError = '';
    
    // Validación de campo requerido
    if (campo.hasAttribute('required') && valor === '') {
        esValido = false;
        mensajeError = 'Este campo es obligatorio.';
    }
    
    // Validaciones específicas por campo
    if (esValido && nombre === 'nombre') {
        if (valor.length < 3) {
            esValido = false;
            mensajeError = 'El nombre debe tener al menos 3 caracteres.';
        }
    }
    
    if (esValido && nombre === 'precio') {
        const precio = parseFloat(valor);
        if (isNaN(precio) || precio <= 0) {
            esValido = false;
            mensajeError = 'El precio debe ser un número mayor que 0.';
        }
    }
    
    if (esValido && nombre === 'stock') {
        const stock = parseInt(valor);
        if (isNaN(stock) || stock < 0) {
            esValido = false;
            mensajeError = 'El stock debe ser un número entero no negativo.';
        }
    }
    
    // Aplicar clases de validación
    if (esValido) {
        campo.classList.remove('is-invalid');
        campo.classList.add('is-valid');
    } else {
        campo.classList.remove('is-valid');
        campo.classList.add('is-invalid');
        
        // Actualizar mensaje de error
        let feedbackElement = campo.nextElementSibling;
        if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
            feedbackElement.textContent = mensajeError;
        }
    }
    
    return esValido;
}

/**
 * Mostrar mensaje de alerta
 * @param {string} mensaje - El mensaje a mostrar
 * @param {string} tipo - El tipo de alerta (success, danger, warning, info)
 */
function mostrarMensaje(mensaje, tipo) {
    const contenedor = document.querySelector('.card-body');
    if (!contenedor) return;
    
    // Remover alertas existentes
    const alertasExistentes = contenedor.querySelectorAll('.alert-js');
    alertasExistentes.forEach(function(alerta) {
        alerta.remove();
    });
    
    // Crear nueva alerta
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show alert-js`;
    alerta.setAttribute('role', 'alert');
    
    const icono = tipo === 'success' ? 'check-circle' : 'exclamation-triangle';
    
    alerta.innerHTML = `
        <i class="bi bi-${icono} me-2"></i>
        ${mensaje}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    `;
    
    // Insertar al inicio del contenedor
    contenedor.insertBefore(alerta, contenedor.firstChild);
    
    // Auto-cerrar después de 5 segundos
    setTimeout(function() {
        alerta.classList.remove('show');
        setTimeout(function() {
            alerta.remove();
        }, 150);
    }, 5000);
}

/**
 * Inicializar auto-cierre de alertas
 */
function inicializarAlertas() {
    const alertas = document.querySelectorAll('.alert:not(.alert-warning)');
    
    alertas.forEach(function(alerta) {
        // Auto-cerrar después de 5 segundos
        setTimeout(function() {
            if (alerta.classList.contains('show')) {
                alerta.classList.remove('show');
                setTimeout(function() {
                    alerta.remove();
                }, 150);
            }
        }, 5000);
    });
}

/**
 * Confirmar eliminación (función de respaldo)
 * @param {string} nombreProducto - Nombre del producto a eliminar
 * @returns {boolean} - Si se confirma la eliminación
 */
function confirmarEliminacion(nombreProducto) {
    return confirm(`¿Está seguro de que desea eliminar el producto "${nombreProducto}"?\n\nEsta acción no se puede deshacer.`);
}

/**
 * Formatear precio a moneda
 * @param {number} precio - El precio a formatear
 * @returns {string} - El precio formateado
 */
function formatearPrecio(precio) {
    return new Intl.NumberFormat('es-EC', {
        style: 'currency',
        currency: 'USD'
    }).format(precio);
}

/**
 * Formatear fecha
 * @param {string} fecha - La fecha a formatear
 * @returns {string} - La fecha formateada
 */
function formatearFecha(fecha) {
    const opciones = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(fecha).toLocaleDateString('es-EC', opciones);
}
