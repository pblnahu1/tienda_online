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

    echo "<h3>".$total."</h3>";
}

?>

<?php include('templates/pie.php'); ?>