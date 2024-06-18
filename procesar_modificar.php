<?php
include_once "conexion.php";

if(!empty($_POST["btnModificar"])) {
    if (!empty($_POST["Nombres"]) && !empty($_POST["Apellidos"]) && !empty($_POST["Documento"]) && !empty($_POST["Direccion"]) && !empty($_POST["Telefono"]) && !empty($_POST["Email"])){
        $id=$_POST["id"];
        $nombres=$_POST["Nombres"];
        $apellidos=$_POST["Apellidos"];
        $documento=$_POST["Documentos"];
        $direccion=$_POST["Direccion"];
        $telefono=$_POST["Telefono"];
        $email=$_POST["Email"];
        $sql=$conexion->pdo->query("update clientes set Nombres='$nombre',Apellidos='$apellido', Documento='$documento',Direccion='$direccion', Telefono='$telefono', Email='$email' where id=$id");
        if ($sql==1) {
            header("location:html.php");
        }else{
            echo "<div class='alert alert-danger'>Error al modificar cliente</div>";
        }

    }else{
        echo "<div class='alert alert-warning'>Campos vacios</div>";
    }

}


