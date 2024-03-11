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