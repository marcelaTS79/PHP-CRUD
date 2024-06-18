<?php
/**
 * Conexion base de datos de MySQL con PDO
 */
class Conexion {
    private $hostBd = 'localhost';
    private $nombreBd = 'crud-php';
    private $usuarioBd = 'root';
    private $passwordBd = '';
    public $pdo;//Propiedad para almacenar el objeto PDO

    public function __construct() {
        try {
            // Crear nueva conexión PDO
            $dsn = "mysql:host={$this->hostBd};dbname={$this->nombreBd};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->usuarioBd, $this->passwordBd);
            // Establecer modo de errores PDO a excepciones
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage()); // Manejar el error adecuadamente
        }
    }

    public function getConexion() {
        return $this->pdo;
    }
}

// Crear una instancia de la clase Conexion y almacenar en una variable global
$conexion = new Conexion();
