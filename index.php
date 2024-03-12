<?php
include('global/config.php');
include('global/conexion.php');
include('carrito.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda Online</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>

<body>
  <!-- b-navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php">Logo de Empresa</a>
    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="my-nav" class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Carrito (0)</a>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <br>
  <div class="container">
    <br>
    <!-- b-alert -->
    <div class="alert alert-success" role="alert">
      <?php // print_r($_POST); //Para saber si mis datos están siendo encriptados... ?>
      <?php echo $mensaje; ?>
      <a href="#" class="btn btn-success">Ver carrito</a>
    </div>

    <!-- b-row -->
    <div class="row">
      <?php
      $sentencia = $pdo->prepare("SELECT * FROM `tblproductos`"); //Otra manera de preparar una consulta SQL
      $sentencia->execute(); //Para ejecutar esa consulta 
      $listaDeProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC); //Recorre cada fila de la Tabla según la query
      // print_r($listaDeProductos); //Muestro en pantalla el array asociativo
      ?>
      <?php foreach ($listaDeProductos as $producto) { ?>
        <!-- b-col -->
        <div class="col-3">
          <!-- b-card-img-top -->
          <div class="card">
            <img 
              title="<?php echo $producto['nombre']; ?>" 
              alt="<?php echo $producto['nombre']; ?>" 
              src="<?php echo $producto['imagen']; ?>" 
              class="card-img-top" 
              data-bs-toggle="popover"
              data-bs-trigger="hover"
              data-bs-content="<?php echo $producto['descripcion']; ?>"
            >
            <div class="card-body">
              <span><?php echo $producto['nombre']; ?></span>
              <h5 class="card-title"><?php echo $producto['precio']; ?></h5>
              <p class="card-text"><?php echo $producto['descripcion']; ?></p>

              <form action="" method="post">
                <!-- Encriptando datos -->
                <input type="text" name="id" id="id" value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>">
                <input type="text" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">
                <input type="text" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                <input type="text" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

                <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
              </form>

              
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
  </script>
</body>

</html>