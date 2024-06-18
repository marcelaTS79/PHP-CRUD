<?php
include_once "conexion.php"; // Incluye el archivo de conexión

$conexion = new Conexion(); // Instancia la clase de conexión
$pdo = $conexion->getConexion(); // Obtén la conexión PDO

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["Nombres"]) && !empty($_POST["Apellidos"]) && !empty($_POST["Documento"]) && !empty($_POST["Direccion"]) && !empty($_POST["Telefono"]) && !empty($_POST["Email"])){
        
        $nombres = $_POST["Nombres"];
        $apellidos = $_POST["Apellidos"];
        $documento = $_POST["Documento"];
        $direccion = $_POST["Direccion"];
        $telefono = $_POST["Telefono"];
        $email = $_POST["Email"];

        // Uso de consultas preparadas para mayor seguridad
        $sql = "INSERT INTO clientes (Nombres, Apellidos, Documento, Direccion, Telefono, Email) VALUES (:nombres, :apellidos, :documento, :direccion, :telefono, :email)";
        $stmt = $pdo->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':documento', $documento);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success">Cliente registrado correctamente</div>';
        } else {
            echo '<div class="alert alert-danger">Error al registrar cliente</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Hay campos vacíos</div>';
    }
}


