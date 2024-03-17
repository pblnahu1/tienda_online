<?php
include('global/config.php');
include('global/conexion.php');
include('carrito.php');
include('templates/cabecera.php');
?>

<?php

if ($_POST) {
  $total = 0;
  $SID = session_id(); // recupero la session del id, esta funcion devuelve la clave de la sesión. (evitar confusion con otro pedido)
  $Correo = $_POST['email'];

  foreach ($_SESSION['CARRITO'] as $indice => $producto) {
    $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
  }

  $sentenciaSQL = $pdo->prepare(
    "INSERT INTO tblVentas (`id`, `claveTransaccion`, `paypalDatos`, `fecha`, `correo`, `total`, `status`) 
        VALUES(NULL, :ClaveTransaccion, '', NOW(), :Correo, :Total, 'pendiente');"
  );

  $sentenciaSQL->bindParam(":ClaveTransaccion", $SID);
  $sentenciaSQL->bindParam(":Correo", $Correo);
  $sentenciaSQL->bindParam(":Total", $total);
  $sentenciaSQL->execute();
  $idVenta = $pdo->lastInsertId();

  foreach ($_SESSION['CARRITO'] as $indice => $producto) {
    $sentenciaSQL = $pdo->prepare(
      "INSERT INTO `tbldetalleventa` (`ID`, `idVenta`, `idProducto`, `preciounitario`, `cantidad`, `descargado`)
            VALUES(NULL, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');"
    );

    $sentenciaSQL->bindParam(":IDVENTA", $idVenta);
    $sentenciaSQL->bindParam(":IDPRODUCTO", $producto['ID']);
    $sentenciaSQL->bindParam(":PRECIOUNITARIO", $producto['PRECIO']);
    $sentenciaSQL->bindParam(":CANTIDAD", $producto['CANTIDAD']);
    $sentenciaSQL->execute();
  }

  // echo "<h3>".$total."</h3>";
}

?>



<style>
  #paypal-button-container {
    background-color: gold;
    color: black;
    cursor: pointer;
    border-radius: 10px;
    padding: 10px 0;
    font-weight: 700;
    text-transform: uppercase;
    border: 1px solid transparent;
  }

  /* Media query for mobile viewport */
  @media screen and (max-width: 400px) {
    #paypal-button-container {
      width: 100%;
    }
  }

  /* Media query for desktop viewport */
  @media screen and (min-width: 400px) {
    #paypal-button-container {
      width: 250px;
      display: inline-block;
    }

    #paypal-button-container:hover {
      border: 2px solid #000;
    }
  }
</style>

<div class="jumbotron text-center mt-5 bg-success-subtle p-5">
  <h1 class="display-4">¡Paso final!</h1>
  <hr class="my-4">
  <p class="lead">Estás a punto de pagar con PayPal la cantidad de:
  <h4><span id="total-adquirido"><?php echo number_format($total, 2); ?></span></h4>
  <div id="paypal-button-container">Pagar</div>
  </p>
  <p>Los productos podrán ser descargados una vez se procese el pago
    <strong>(Para aclaraciones: webdesign@gmail.com)</strong>
  </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const showAlert = () => {
      const totalAdquirido = document.getElementById("total-adquirido").innerText;

      if (totalAdquirido) {
        Swal.fire({
          title: `Compra realizada con éxito`,
          text: `Haz pagado: $${totalAdquirido}`,
          icon: 'success', // Puedes cambiar esto a 'success', 'warning', 'error', etc.
          confirmButtonText: 'Ok'
        });
      }
    };

    const paypalButton = document.getElementById("paypal-button-container");
    if (paypalButton) {
      paypalButton.onclick = showAlert;
    }
  })
</script>

<?php include('templates/pie.php'); ?>