<?php
include('global/config.php');
include('global/conexion.php');
include('carrito.php');
include('templates/cabecera.php');
?>

<?php

if($_POST) {
    $total = 0;
    $SID = session_id(); // recupero la session del id, esta funcion devuelve la clave de la sesión. (evitar confusion con otro pedido)
    $Correo = $_POST['email'];

    foreach($_SESSION['CARRITO'] as $indice=>$producto){ 
        $total = $total + ($producto['PRECIO']*$producto['CANTIDAD']);
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

    foreach($_SESSION['CARRITO'] as $indice=>$producto){
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

    echo "<h3>".$total."</h3>";
}

?>

<?php include('templates/pie.php'); ?>