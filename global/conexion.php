<?php

// obtengo la información de BD y del SERVIDOR directamente del archivo `config.php`
$servidor = "mysql:dbname=".BD.";host=".SERVIDOR; 

try {
    // Creo una instancia PDO (PHP Data Object, mejor seguridad en cuanto al manejo de datos de una BD), me servirá para conectarme a la Base de Datos
    $pdo = new PDO($servidor, USUARIO, PASSWORD,
        array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
    );
    echo "<script>alert('Conectado...')</script>";
} catch (PDOException $e) {
    echo "<script>alert('Error...')</script>";
}

?>