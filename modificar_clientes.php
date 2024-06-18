<?php
include_once "conexion.php";
$id=$_GET["id"];

$sql=$conexion->pdo->query("SELECT *FROM clientes WHERE id=$id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form class="col-4 p-3 m-auto" method="post">
      <h5 class="text-center alert alert-secondary">Modificar Clientes</h5>
      <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
      <?php
     include_once "modificar_clientes.php";
     while($datos=$sql->fetchObject()){ ?>
     <div class="mb-1">
        <label for="exampleInputEmail1" class="form-label">Nombres</label>
        <input type="text" class="form-control" name="Nombres" value="<?= htmlspecialchars ($datos->Nombres) ?>">
      </div>
      <div class="mb-1">
        <label for="exampleInputEmail1" class="form-label">Apellidos</label>
        <input type="text" class="form-control" name="Apellidos" value="<?= htmlspecialchars ($datos->Apellidos) ?>">
      </div>
      <div class="mb-1">
        <label for="exampleInputEmail1" class="form-label">Documento</label>
        <input type="text" class="form-control" name="Documento" value="<?= htmlspecialchars ($datos->Documento) ?>">
      </div>
      <div class="mb-1">
        <label for="exampleInputEmail1" class="form-label">Direccion</label>
        <input type="text" class="form-control" name="Direccion" value="<?= htmlspecialchars ($datos->Direccion) ?>">
      </div>
      <div class="mb-1">
        <label for="exampleInputEmail1" class="form-label">Telefono</label>
        <input type="text" class="form-control" name="Telefono" value="<?= htmlspecialchars ($datos->Telefono) ?>">
      </div>
      <div class="mb-1">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="text" class="form-control" name="Email" value="<?= htmlspecialchars ($datos->Email) ?>">
      </div>

     <?php }
      ?>
      
      <button type="submit" class="btn btn-primary" name="btnModificar" value="ok">Modificar Cliente</button>
    </form>
</body>
</html>