<?php
/**
 * Front Controller - Punto de entrada de la aplicación
 * Maneja el enrutamiento básico de la aplicación MVC
 */

// Iniciar sesión para mensajes flash
session_start();

// Obtener parámetros del controlador y acción
$controlador = isset($_GET['controller']) ? $_GET['controller'] : 'producto';
$accion = isset($_GET['action']) ? $_GET['action'] : 'index';

// Sanitizar parámetros
$controlador = preg_replace('/[^a-zA-Z0-9]/', '', $controlador);
$accion = preg_replace('/[^a-zA-Z0-9]/', '', $accion);

// Definir controladores válidos
$controladoresValidos = ['producto'];

// Verificar si el controlador es válido
if (!in_array(strtolower($controlador), $controladoresValidos)) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Controlador no encontrado</h1>";
    exit();
}

// Construir nombre del controlador
$nombreControlador = ucfirst($controlador) . 'Controller';
$archivoControlador = __DIR__ . '/../controllers/' . $nombreControlador . '.php';

// Verificar si el archivo del controlador existe
if (!file_exists($archivoControlador)) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Archivo del controlador no encontrado</h1>";
    exit();
}

// Incluir el controlador
require_once $archivoControlador;

// Instanciar el controlador
$instanciaControlador = new $nombreControlador();

// Verificar si la acción existe
if (!method_exists($instanciaControlador, $accion)) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Acción no encontrada</h1>";
    exit();
}

// Ejecutar la acción
$instanciaControlador->$accion();
