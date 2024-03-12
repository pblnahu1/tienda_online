<?php

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
      break;
  }
}
