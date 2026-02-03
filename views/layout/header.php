<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($tituloPagina) ? $tituloPagina . ' - ' : ''; ?>UG TiendaApp - Sistema de Productos</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Estilos personalizados basados en Mazer Admin -->
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.php?controller=producto&action=index">
                                <i class="bi bi-box-seam me-2"></i>UG TiendaApp
                            </a>
                        </div>
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block">
                                <i class="bi bi-x bi-middle"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menú Principal</li>
                        
                        <li class="sidebar-item <?php echo (!isset($_GET['action']) || $_GET['action'] == 'index') ? 'active' : ''; ?>">
                            <a href="index.php?controller=producto&action=index" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-title">Gestión</li>
                        
                        <li class="sidebar-item <?php echo (isset($_GET['action']) && $_GET['action'] == 'index') ? 'active' : ''; ?>">
                            <a href="index.php?controller=producto&action=index" class="sidebar-link">
                                <i class="bi bi-box-seam"></i>
                                <span>Productos</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item <?php echo (isset($_GET['action']) && $_GET['action'] == 'create') ? 'active' : ''; ?>">
                            <a href="index.php?controller=producto&action=create" class="sidebar-link">
                                <i class="bi bi-plus-circle"></i>
                                <span>Nuevo Producto</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
            <div class="page-heading">
                <h3><?php echo isset($tituloPagina) ? $tituloPagina : 'Dashboard'; ?></h3>
            </div>
            
            <div class="page-content">
                <section class="section">
