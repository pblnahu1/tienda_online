CREATE DATABASE IF NOT EXISTS tienda_online_php;
USE tienda_online_php;

CREATE TABLE IF NOT EXISTS tblproductos(
    id_producto INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(20,2) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    PRIMARY KEY(id_producto)
);

INSERT INTO tblproductos (nombre, precio, descripcion, imagen) VALUES ("Learn PHP 8", "300.00", "This new book on PHP 8 introduces writing solid, secure, object-oriented code in the new PHP 8: you will create a complete three-tier application using a natural process of building and testing modules within each tier. This practical approach teaches you about app development and introduces PHP features when they are actually needed rather than providing you with abstract theory and contrived examples.
", "https://http2.mlstatic.com/D_NQ_NP_812543-MLA46365967895_062021-O.webp
");
INSERT INTO tblproductos (nombre, precio, descripcion, imagen) VALUES ("Professional ASP.NET MVC 5", "429.00", "MVC 5 is the newest update to the popular Microsoft technology that enables you to build dynamic, data-driven websites. Like previous versions, this guide shows you step-by-step techniques on using MVC to best advantage, with plenty of practical tutorials to illustrate the concepts. It covers controllers, views, and models; forms and HTML helpers; data annotation and validation; membership, authorization, and security.", "https://images-na.ssl-images-amazon.com/images/I/51u-ERS1W8L._SX396_BO1,204,203,200_.jpg
");
INSERT INTO tblproductos (nombre, precio, descripcion, imagen) VALUES ("Learning Vue.js 2", "1005.35", "* Learn how to propagate DOM changes across the website without writing extensive jQuery callbacks code.
* Learn how to achieve reactivity and easily compose views with Vue.js and understand what it does behind the scenes.
* Explore the core features of Vue.js with small examples, learn how to build dynamic content into preexisting web applications, and build Vue.js applications from scratch.
", "https://m.media-amazon.com/images/I/41GXQZ5TmQL._SX342_SY445_.jpg ");


CREATE TABLE IF NOT EXISTS tblVentas(
    id INT NOT NULL AUTO_INCREMENT,
    claveTransaccion VARCHAR(250) NOT NULL,
    paypalDatos TEXT NOT NULL,
    fecha DATETIME NOT NULL,
    correo VARCHAR(5000) NOT NULL,
    total DECIMAL(60,2) NOT NULL,
    status VARCHAR(200),
    PRIMARY KEY(id)
);

-- INSERT INTO tblVentas (`id`, `claveTransaccion`, `paypalDatos`, `fecha`, `correo`, `total`, `status`) VALUES (NULL, '12345678910', '', '2018-10-01 00:00:00', 'torrezpablo25@gmail.com', 700, 'pendiente');


CREATE TABLE IF NOT EXISTS tblDetalleVenta(
    id INT NOT NULL AUTO_INCREMENT,
    idVenta INT,
    idProducto INT,
    preciounitario DECIMAL(20,2) NOT NULL, 
    cantidad INT NOT NULL,
    descargado INT(1) NOT NULL,
    PRIMARY KEY(id)
);

ALTER TABLE `tbldetalleventa` ADD FOREIGN KEY (`idVenta`) REFERENCES `tblventas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbldetalleventa` ADD FOREIGN KEY(`idProducto`) REFERENCES `tblproductos`(`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbldetalleventa` DROP INDEX `idVenta`;
ALTER TABLE `tbldetalleventa` DROP INDEX `idProducto`;  

# ALTER TABLE `tbldetalleventa` CHANGE `idVenta` `idVenta` INT(11) NULL;
# ALTER TABLE `tbldetalleventa` CHANGE `idProducto` `idProducto` INT(11) NULL;

ALTER TABLE `tbldetalleventa` MODIFY COLUMN `idVenta` INT NOT NULL;
ALTER TABLE `tbldetalleventa` MODIFY COLUMN `idProducto` INT NOT NULL;

-- Para insertar, deben existir el ID en la tabla 'tblVentas' y el ID en la tabla 'tblproductos'
INSERT INTO `tbldetalleventa` (`id`, `idVenta`, `idProducto`, `preciounitario`, `cantidad`, `descargado`)
VALUES(NULL, '6', '1', '1000', '1', '0');