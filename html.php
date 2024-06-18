<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro Clientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/e4243951ed.js" crossorigin="anonymous"></script>
</head>

<body>
  <h1 class="text-center p-3">Taller de Escultura e Imagineria</h1>
  <?php
  include_once "conexion.php";
  include_once "eliminar_cliente.php";
  ?>
  <div class="container-fluid row">
    <form action="registro_clientes.php"  method="post" class="col-4 p-3">
      <h3 class="text-center text-secondary">Registro Clientes</h3>
      <?php
      
      include_once "registro_clientes.php";
      ?>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nombres</label>
        <input type="text" class="form-control" name="Nombres">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Apellidos</label>
        <input type="text" class="form-control" name="Apellidos">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Documento</label>
        <input type="text" class="form-control" name="Documento">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Direccion</label>
        <input type="text" class="form-control" name="Direccion">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Telefono</label>
        <input type="text" class="form-control" name="Telefono">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="text" class="form-control" name="Email">
      </div>
      <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
    </form>
    <div class="col-8 p-4">
      <table class="table">
        <thead class="bg-info">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Documento</th>
            <th scope="col">Direccion</th>
            <th scope="col">Telefono</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          include_once "conexion.php";
          $conexion = new Conexion();
          $pdo = $conexion->getConexion();
          $sql = $pdo->query("SELECT * FROM CLIENTES");
          while ($datos = $sql->fetch(PDO::FETCH_OBJ)) { ?>
            <tr>
              <td><?= htmlspecialchars ($datos->id);?></td>
              <td><?= htmlspecialchars ($datos->Nombres);?></td>
              <td><?= htmlspecialchars ($datos->Apellidos); ?></td>
              <td><?= htmlspecialchars ($datos->Documento); ?></td>
              <td><?= htmlspecialchars ($datos->Direccion); ?></td>
              <td><?= htmlspecialchars ($datos->Telefono); ?></td>
              <td><?= htmlspecialchars ($datos->Email); ?></td>
              <td>
                <a href="modificar_clientes.php?id=<?= htmlspecialchars ($datos->id) ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-pen-to-square"></i></a>
                <a onclick="return eliminar()"href="html.php?id=<?=htmlspecialchars ($datos->id) ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-trash-can"></i></a>
                <a href="html.php?id=<?= htmlspecialchars ($datos->id) ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-pen-to-square"></i></a>
              </td>
            </tr>
          <?php }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>