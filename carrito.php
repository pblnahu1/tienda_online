<?php

session_start(); // Variable de sesión q tendrán datos durante la navegación del usuario

$mensaje = "";

if (isset($_POST['btnAccion'])) {
  switch ($_POST['btnAccion']) {
    case 'Agregar':
      if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
        $mensaje .= "Ok. ID Correcto: " . $ID . "<br/>";
      } else {
        $mensaje = "Error. ID Incorrecto: " . $ID;
      }

      if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
        $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
        $mensaje .= "Ok. NOMBRE Correcto: " . $NOMBRE . "<br/>";
      } else {
        $mensaje = "Error. NOMBRE Incorrecto.";
        break;
      }

      if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
        $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
        $mensaje .= "Ok. CANTIDAD Correcto: " . $CANTIDAD . "<br/>";
      } else {
        $mensaje = "Error. CANTIDAD Incorrecto";
        break;
      }

      if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
        $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
        $mensaje .= "0k. Precio: " . $PRECIO . "<br/>";
      } else {
        $mensaje = "Error. PRECIO Incorrecto";
        break;
      }

      if(!isset($_SESSION['CARRITO'])){
        $producto = array(
          'ID'=>$ID,
          'NOMBRE'=>$NOMBRE,
          'CANTIDAD'=>$CANTIDAD,
          'PRECIO'=>$PRECIO
        );
        $_SESSION['CARRITO'][0] = $producto; //En el carrito agrego desde la primer posición los productos
      }else{
        $numeroProductos = count($_SESSION['CARRITO']);
        $producto = array(
          'ID'=>$ID,
          'NOMBRE'=>$NOMBRE,
          'CANTIDAD'=>$CANTIDAD,
          'PRECIO'=>$PRECIO
        );
        $_SESSION['CARRITO'][$numeroProductos] = $producto;
      }
      $mensaje = print_r($_SESSION, true);
      break;
  }
}
