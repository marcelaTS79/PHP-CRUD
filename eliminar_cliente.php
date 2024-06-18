<?php
include_once "conexion.php";
if (!empty($_GET["id"])) {
    $id=$_GET["id"];
    $sql=$conexion->pdo->query("delete from clientes where id=$id");
    if ($sql==1) {
        echo '<div>Cliente eliminado correctamente</div>';
    }else{
        echo '<div>Error al eliminar</div>';
    }
}

