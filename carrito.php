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

      if (!isset($_SESSION['CARRITO'])) {
        $producto = array(
          'ID' => $ID,
          'NOMBRE' => $NOMBRE,
          'CANTIDAD' => $CANTIDAD,
          'PRECIO' => $PRECIO
        );
        $_SESSION['CARRITO'][0] = $producto; //En el carrito agrego desde la primer posición los productos
        $mensaje = "Producto agregado al carrito";
      } else {
        $idProductos = array_column($_SESSION['CARRITO'], "ID");
        if(in_array($ID, $idProductos)){
          echo "<script>alert('El producto ya ha sido seleccionado...');</script>";
          $mensaje="";
        }else{
          $numeroProductos = count($_SESSION['CARRITO']);
          $producto = array(
            'ID' => $ID,
            'NOMBRE' => $NOMBRE,
            'CANTIDAD' => $CANTIDAD,
            'PRECIO' => $PRECIO
          );
          $_SESSION['CARRITO'][$numeroProductos] = $producto;
          $mensaje = "Producto agregado al carrito";
        }
      }
      // $mensaje = print_r($_SESSION, true);
      break;
    case "Eliminar":
      if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
        foreach($_SESSION['CARRITO'] as $indice=>$producto){
          if($producto['ID'] == $ID) {
            unset($_SESSION['CARRITO'][$indice]);
            echo  "<script>alert('Elemento borrado...')</script>";
          }
        }
        $mensaje .= "OK. ID Correcto: " . $ID . "<br/>";
      } else {
        $mensaje = "Error. ID Incorrecto: " . $ID . "<br/>";
      }
      break;
  }
}
