<?php

include_once "conexion.php";

// Definir la constante PHP_INPUT
define('PHP_INPUT', 'php://input');

$conexion = new Conexion();
$pdo = $conexion->getConexion();  // Aquí obtenemos la instancia de PDO

// Listar registros y consultar registro GET
if($_SERVER["REQUEST_METHOD"] == 'GET') {
    $sql = "SELECT * FROM clientes";
    $params = [];

    if(isset($_GET['id'])) {
        $sql .= " WHERE id = :id";
        $params[':id'] = $_GET['id'];
    }

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($result);
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error en la consulta: " . $e->getMessage()));
        exit;
    }
}

//Insertar registro POST
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $input = json_decode(file_get_contents(PHP_INPUT), true);
    
    if (!$input) {
        http_response_code(400);
        echo json_encode(array("message" => "Datos no válidos o formato incorrecto"));
        exit;
    }

    $sql = "INSERT INTO clientes (Nombres, Apellidos, Documento, Direccion, Telefono, Email)
            VALUES (:Nombres, :Apellidos, :Documento, :Direccion, :Telefono, :Email)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Nombres', $input['Nombres']);
        $stmt->bindValue(':Apellidos', $input['Apellidos']);
        $stmt->bindValue(':Documento', $input['Documento']);
        $stmt->bindValue(':Direccion', $input['Direccion']);
        $stmt->bindValue(':Telefono', $input['Telefono']);
        $stmt->bindValue(':Email', $input['Email']);
        $stmt->execute();
        $idPost = $pdo->lastInsertId(); // Ver el id que se creó

        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode(array("id" => $idPost));
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error al insertar registro: " . $e->getMessage()));
        exit;
    }
}


//Actualizar registro PUT
if ($_SERVER["REQUEST_METHOD"] == 'PUT') {
    $input = json_decode(file_get_contents(PHP_INPUT), true);
    $sql = "UPDATE clientes
            SET Nombres = :Nombres, Apellidos = :Apellidos, Documento = :Documento, Direccion = :Direccion, Telefono = :Telefono, Email = :Email
            WHERE id = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':Nombres', $input['Nombres']);
        $stmt->bindValue(':Apellidos', $input['Apellidos']);
        $stmt->bindValue(':Documento', $input['Documento']);
        $stmt->bindValue(':Direccion', $input['Direccion']);
        $stmt->bindValue(':Telefono', $input['Telefono']);
        $stmt->bindValue(':Email', $input['Email']);
        $stmt->bindValue(':id', $input['id']);
        $stmt->execute();

        header("HTTP/1.1 200 OK");
        echo json_encode(array("message" => "Registro actualizado correctamente"));
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error al actualizar registro: " . $e->getMessage()));
        exit;
    }
}


//Eliminar registro DELETE
if ($_SERVER["REQUEST_METHOD"] == 'DELETE') {
    // Intentar obtener el ID del parámetro de consulta
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    // Si no se encuentra en el parámetro de consulta, intentar obtenerlo del cuerpo de la solicitud
    if (!$id) {
        parse_str(file_get_contents(PHP_INPUT), $input);
        $id = isset($input['id']) ? $input['id'] : null;
    }

    if ($id) {
        $sql = "DELETE FROM clientes WHERE id = :id";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            header("HTTP/1.1 200 OK");
            echo json_encode(array("message" => "Registro eliminado exitosamente"));
            exit;
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(array("message" => "Error al eliminar registro: " . $e->getMessage()));
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "ID no proporcionado"));
        exit;
    }
}

// Si no coincide devolver Bad Request
http_response_code(400);
echo json_encode(array("message" => "Solicitud no válida"));