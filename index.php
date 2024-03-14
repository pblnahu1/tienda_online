<?php
include('global/config.php');
include('global/conexion.php');
include('carrito.php');
include('templates/cabecera.php');
?>


<br>
<!-- b-alert -->
<?php if($mensaje!=""){ ?>
<div class="alert alert-success" role="alert">
  <?php // print_r($_POST); //Para saber si mis datos están siendo encriptados...?>
  <?php echo $mensaje; ?>
  <a href="mostrar_carrito.php" class="btn btn-success">Ver carrito</a>
</div>
<?php } ?>

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
        <img title="<?php echo $producto['nombre']; ?>" alt="<?php echo $producto['nombre']; ?>" src="<?php echo $producto['imagen']; ?>" class="card-img-top" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="<?php echo $producto['descripcion']; ?>" height="400px">
        <div class="card-body">
          <span><?php echo $producto['nombre']; ?></span>
          <h5 class="card-title"><?php echo $producto['precio']; ?></h5>
          <p class="card-text"><?php echo $producto['descripcion']; ?></p>
          <form action="" method="post">
            <!-- Encriptando datos -->
            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>">
            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">
            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

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

<?php include('templates/pie.php'); ?>