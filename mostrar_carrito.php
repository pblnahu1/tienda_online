<?php
include('global/config.php');
include('carrito.php');
include('templates/cabecera.php');
?>

<br>
<h3>Lista del carrito</h3>
<?php if (!empty($_SESSION['CARRITO'])) { ?>
  <!-- b-table -->
  <table class="table table-light table-bordered">
    <tbody>
      <tr>
        <th width="40%">Descripción</th>
        <th width="15%">Cantidad</th>
        <th width="20%">Precio</th>
        <th width="20%">Total</th>
        <th width="5%">--</th>
      </tr>
      <?php $total = 0; ?>
      <?php foreach ($_SESSION['CARRITO'] as $indixe => $producto) { ?>
        <tr>
          <th width="40%"><?php echo $producto['NOMBRE']; ?></th>
          <th width="15%" class="text-center"><?php echo $producto['CANTIDAD']; ?></th>
          <th width="20%" class="text-center">$<?php echo $producto['PRECIO']; ?></th>
          <th width="20%" class="text-center">$<?php echo number_format($producto['PRECIO'] * $producto['CANTIDAD'], 2); ?></th>
          <th width="5%"><button class="btn btn-danger" type="button">Eliminar</button></th>
        </tr>
      <?php $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']); ?>
      <?php } ?>
      <tr>
        <td colspan="3" align="right">
          <h3>Total</h3>
        </td>
        <td align="right">
          <h3><?php echo number_format($total, 2); ?></h3>
        </td>
        <td></td>
      </tr>
    </tbody>
  </table>

<?php } else { ?>
  <div class="alert alert-success" role="alert">
    No hay productos en el carrito...
  </div>
<?php } ?>

<?php include('templates/pie.php'); ?>