<?php
/**
 * Configuración de la Base de Datos
 * Archivo de conexión a MySQL usando PDO
 */

class Database {
    private $host = "localhost";
    private $nombreBaseDatos = "ug_u4s14_tienda";
    private $usuario = "root";
    private $contrasena = "";
    private $conexion;

    /**
     * Obtener la conexión a la base de datos
     * @return PDO|null
     */
    public function obtenerConexion() {
        $this->conexion = null;

        try {
            $this->conexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->nombreBaseDatos . ";charset=utf8mb4",
                $this->usuario,
                $this->contrasena
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $excepcion) {
            echo "Error de conexión: " . $excepcion->getMessage();
        }

        return $this->conexion;
    }
}
