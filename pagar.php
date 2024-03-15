<?php
include('global/config.php');
include('global/conexion.php');
include('carrito.php');
include('templates/cabecera.php');
?>

<?php

if($_POST) {
    $total=0;
    $SID = session_id(); // recupero la session del id, esta funcion devuelve la clave de la sesión. (evitar confusion con otro pedido)
    foreach($_SESSION['CARRITO'] as $indice=>$producto){ 
        $total = $total + ($producto['PRECIO']*$producto['CANTIDAD']);
    }
    echo "<h3>".$total."</h3>";
}

?>

<?php include('templates/pie.php'); ?>