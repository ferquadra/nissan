SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `billeteras`(
  `id_billetera` INT(16) NOT NULL AUTO_INCREMENT , 
  `id_usuario` INT(12) NULL , 
  `usuario` VARCHAR(255) NULL , 
  `moneda` VARCHAR(255) NULL , 
  `direccion` LONGTEXT NULL , 
  `fecha` DATETIME NULL , 
  PRIMARY KEY (`id_billetera`)
  ) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `id_marca` int(10) UNSIGNED DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `texto` longtext DEFAULT NULL,
  `id_imagen` int(10) UNSIGNED DEFAULT NULL,
  `precio` decimal(16,2) UNSIGNED DEFAULT NULL,
  `id_moneda` int(4) DEFAULT NULL,
  `mapa` longtext DEFAULT NULL,
  `precio1` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio2` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio3` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio4` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio5` decimal(16,2) UNSIGNED DEFAULT NULL,
  `publicado` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `oferta` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `destacado` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `orden` int(4) DEFAULT NULL,
  `orden_cat` int(4) DEFAULT NULL,
  `actualiza` int(16) DEFAULT NULL,
  `stock` int(10) DEFAULT 0,
  `precioweb` decimal(16,2) DEFAULT NULL,
  `preciopub` int(1) DEFAULT 1,
  `categorias` longtext DEFAULT NULL,
  `id_variante` int(16) DEFAULT 0,
  `x` decimal(10,2) NOT NULL,
  `y` decimal(10,2) NOT NULL,
  `z` decimal(10,2) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `precio6` decimal(16,2) DEFAULT NULL,
  `precio7` decimal(16,2) DEFAULT NULL,
  `precio8` decimal(16,2) DEFAULT NULL,
  `precio9` decimal(16,2) DEFAULT NULL,
  `precio10` decimal(16,2) DEFAULT NULL,
  `descuento` int(2) DEFAULT 0,
  `html` longtext DEFAULT NULL,
  `tags` longtext DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `iva` decimal(3,1) DEFAULT NULL,
  `venta_min` decimal(10,2) DEFAULT NULL,
  `venta_max` decimal(10,2) DEFAULT NULL,
  `pack` int(10) DEFAULT NULL,
  `texto_privado` longtext DEFAULT NULL,
  `requiere_notas` int(1) DEFAULT 0,
  `id_operador` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categorias_descargas` (
  `id_categoriadescarga` int(10) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `id_padre` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `orden` int(10) NOT NULL,
  `id_imagen` int(10) NOT NULL,
  `publicado` int(1) NOT NULL,
  `destacado` int(1) NOT NULL,
  PRIMARY KEY (`id_categoriadescarga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `cupones` (
  `id_cupon` int(16) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `texto` longtext DEFAULT NULL,
  `fecha_desde` datetime DEFAULT NULL,
  `fecha_hasta` datetime DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `descuento` int(3) DEFAULT NULL,
  `importe` decimal(10,2) DEFAULT NULL,
  `cat_aplica` longtext DEFAULT NULL,
  `cat_noaplica` longtext DEFAULT NULL,
  `usos` int(10) DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_cupon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `categorias_videos` (
  `id_categoriavideo` int(10) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `id_padre` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `orden` int(10) NOT NULL,
  `id_imagen` int(10) NOT NULL,
  `publicado` int(1) NOT NULL,
  `destacado` int(1) NOT NULL,
  PRIMARY KEY (`id_categoriavideo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `descargas` (
  `id_descarga` int(16) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `enlace` longtext DEFAULT NULL,
  `html` longtext DEFAULT NULL,
  `usuarios` longtext DEFAULT NULL,
  `carpetas` longtext DEFAULT NULL,
  `publicado` int(1) NOT NULL DEFAULT 0,
  `orden` int(4) NOT NULL DEFAULT 9999,
  PRIMARY KEY (`id_descarga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `videos` (
  `id_video` int(16) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `enlace` longtext DEFAULT NULL,
  `html` longtext DEFAULT NULL,
  `usuarios` longtext DEFAULT NULL,
  `carpetas` longtext DEFAULT NULL,
  `publicado` int(1) NOT NULL DEFAULT 0,
  `orden` int(4) NOT NULL DEFAULT 9999,
  `texto` longtext,
  `codserie` varchar(255) DEFAULT NULL,
  `temporada` int(5) DEFAULT NULL,
  `capitulo` int(5) DEFAULT NULL,
  `tituloserie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `inmuebles` (
  `id_inmueble` int(12) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `operacion` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `texto` longtext DEFAULT NULL,
  `id_imagen` int(10) UNSIGNED DEFAULT NULL,
  `precio` decimal(16,2) UNSIGNED DEFAULT NULL,
  `id_moneda` int(4) DEFAULT NULL,
  `mapa` longtext DEFAULT NULL,
  `precio1` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio2` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio3` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio4` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio5` decimal(16,2) UNSIGNED DEFAULT NULL,
  `publicado` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `oferta` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `destacado` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `orden` int(4) DEFAULT NULL,
  `orden_cat` int(4) DEFAULT NULL,
  `actualiza` int(16) DEFAULT NULL,
  `stock` int(10) DEFAULT 0,
  `precioweb` decimal(16,2) DEFAULT NULL,
  `preciopub` int(1) DEFAULT 1,
  `preciopub1` int(1) DEFAULT NULL,
  `preciopub2` int(1) DEFAULT NULL,
  `categorias` longtext DEFAULT NULL,
  `id_variante` int(16) DEFAULT 0,
  `x` decimal(10,2) NOT NULL,
  `y` decimal(10,2) NOT NULL,
  `z` decimal(10,2) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `descuento` int(2) DEFAULT 0,
  `html` longtext DEFAULT NULL,
  `tags` longtext DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `sup_cub` int(10) DEFAULT NULL,
  `sup_des` int(10) DEFAULT NULL,
  `sup_tot` int(10) DEFAULT NULL,
  `habitaciones` int(3) DEFAULT NULL,
  `antiguedad` int(5) DEFAULT NULL,
  `orientacion` int(2) DEFAULT NULL,
  `id_provincia` int(6) DEFAULT 0,
  `id_localidad` int(6) DEFAULT 0,
  PRIMARY KEY (`id_inmueble`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `categorias_inmuebles` (
  `id_categoriainmueble` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(80) DEFAULT NULL,
  `id_padre` int(10) unsigned NOT NULL DEFAULT '0',
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `orden` int(10) DEFAULT NULL,
  `id_imagen` int(10) unsigned DEFAULT NULL,
  `publicado` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `destacado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_categoriainmueble`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `productos_pedido_temp` (
  `id_temp` int(12) NOT NULL AUTO_INCREMENT,
  `id_producto` int(12) DEFAULT NULL,
  `id_usuario` int(12) DEFAULT NULL,
  `cantidad` int(12) DEFAULT NULL,
  `unitario` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `medida` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_temp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `operadores` (
  `id_operador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) NOT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `email` varchar(255) DEFAULT NULL,
  `permisos` longtext DEFAULT NULL,
  `fecha_alta` datetime DEFAULT NULL,
  `fecha_nac` datetime DEFAULT NULL,
  `ultimo` datetime DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_operador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

INSERT INTO `operadores` VALUES(1, 'Sin nombre', 'admin', '123456', 1, NULL, '["operadores_write","mensajes_write","pedidos_write","usuarios_write","archivos_write","ecommerce_write","contenidos_write","configuracion_write","soporte_write","facturacion_write","micuenta_write"]', NULL, NULL, NULL, NULL);

CREATE TABLE IF NOT EXISTS `emails_enviados` (
  `id_enviado` int(16) NOT NULL AUTO_INCREMENT,
  `desde` varchar(255) DEFAULT NULL,
  `hasta` varchar(255) DEFAULT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `sendgrid_id` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `leidos` int(10) DEFAULT '0',
  `clicks` int(10) DEFAULT '0',
  PRIMARY KEY (`id_enviado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `comodin` (
  `id_comodin` int(16) NOT NULL AUTO_INCREMENT,
  `c1` varchar(255) DEFAULT NULL,
  `c2` varchar(255) DEFAULT NULL,
  `c3` varchar(255) DEFAULT NULL,
  `c4` varchar(255) DEFAULT NULL,
  `c5` varchar(255) DEFAULT NULL,
  `c6` varchar(255) DEFAULT NULL,
  `c7` varchar(255) DEFAULT NULL,
  `c8` varchar(255) DEFAULT NULL,
  `c9` varchar(255) DEFAULT NULL,
  `c10` varchar(255) DEFAULT NULL,
  `t1` longtext,
  `t2` longtext,
  `t3` longtext,
  `t4` longtext,
  `t5` longtext,
  `t6` longtext,
  `t7` longtext,
  `t8` longtext,
  `t9` longtext,
  PRIMARY KEY (`id_comodin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `sesiones` (
  `id_sesion` int(16) NOT NULL AUTO_INCREMENT,
  `phpsessid` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `data` longtext NOT NULL,
  `extra` longtext NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_sesion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `banners` (
  `id_banner` int(16) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `enlace` longtext,
  `html` longtext,
  `id_posicion` int(12) DEFAULT NULL,
  `publicado` int(1) NOT NULL DEFAULT '0',
  `orden` int(4) NOT NULL DEFAULT '9999',
  `margen` int(3) DEFAULT 1,
  PRIMARY KEY (`id_banner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

CREATE TABLE IF NOT EXISTS `productos_colores` (
  `id_productocolor` int(16) NOT NULL AUTO_INCREMENT,
  `id_producto` int(12) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `id_color` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_productocolor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75;

CREATE TABLE IF NOT EXISTS `productos_talles` (
  `id_productotalle` int(12) NOT NULL AUTO_INCREMENT,
  `id_producto` int(12) DEFAULT NULL,
  `talle` varchar(255) DEFAULT NULL,
  `stock` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_productotalle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96;

CREATE TABLE `anuncios` (
  `id_anuncio` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` varchar(10) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vigencia_desde` datetime DEFAULT NULL,
  `vigencia_hasta` datetime DEFAULT NULL,
  `impresiones` int(11) UNSIGNED DEFAULT NULL,
  `contador_impresiones` int(10) UNSIGNED DEFAULT NULL,
  `clicks` int(10) UNSIGNED DEFAULT NULL,
  `contador_clicks` int(10) UNSIGNED DEFAULT NULL,
  `publicado` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `notas` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `archivos` (
  `id_archivo` int(10) UNSIGNED NOT NULL,
  `sector` mediumint(8) UNSIGNED NOT NULL,
  `id_elemento` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `campos_categoriaproducto` (
  `id_campocategoria` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `tipo` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `extra` longtext,
  `orden` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `campos_listado` (
  `id_campolistado` int(10) UNSIGNED NOT NULL,
  `id_listado` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `tipo` tinyint(3) UNSIGNED NOT NULL,
  `extra` mediumtext,
  `orden` mediumint(8) UNSIGNED NOT NULL,
  `ayuda` mediumtext,
  `requerido` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categorias_elementos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(80) DEFAULT NULL,
  `id_padre` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `orden` int(10) DEFAULT NULL,
  `id_imagen` int(10) UNSIGNED DEFAULT NULL,
  `publicado` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categorias_producto` (
  `id_categoriaproducto` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(80) DEFAULT NULL,
  `id_padre` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `orden` int(10) DEFAULT NULL,
  `id_imagen` int(10) UNSIGNED DEFAULT NULL,
  `publicado` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `destacado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `productos_variantes` (
  `id_productovariante` int(16) NOT NULL AUTO_INCREMENT,
  `id_producto` int(16) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `id_color` int(12) DEFAULT NULL,
  `talle` varchar(255) DEFAULT NULL,
  `peso` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(12) DEFAULT NULL,
  `orden` int(10) DEFAULT NULL, 
  PRIMARY KEY (`id_productovariante`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `categorias_producto` VALUES(134, '', 0, 'CELULARES', '', NULL, NULL, 1, 1);
INSERT INTO `categorias_producto` VALUES(135, '', 0, 'FITNESS', '', NULL, NULL, 1, 1);
INSERT INTO `categorias_producto` VALUES(136, '', 0, 'JUEGOS', '', NULL, NULL, 1, 1);
INSERT INTO `categorias_producto` VALUES(137, '', 0, 'DORMITORIO', '', NULL, NULL, 1, 1);
INSERT INTO `categorias_producto` VALUES(138, '', 0, 'NOTEBOOKS', '', NULL, NULL, 1, 1);
INSERT INTO `categorias_producto` VALUES(139, '', 0, 'TIEMPO LIBRE', '', NULL, NULL, 1, 1);
INSERT INTO `categorias_producto` VALUES(140, '', 0, 'LAVADO', '', NULL, NULL, 1, 1);
INSERT INTO `categorias_producto` VALUES(141, '', 0, 'COCINAS', '', NULL, NULL, 1, 1);

CREATE TABLE `colores` (
  `id_color` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `configuracion` (
  `id_configuracion` int(10) UNSIGNED NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `valor` longtext,
  `extra` longtext,
  `orden` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `titulo` varchar(255) DEFAULT NULL,
  `ayuda` longtext,
  `visible` INT(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `configuracion` VALUES(1, 'avanzada', 'usar_ckeditor', 4, '1', '1=Sí|2=No', 10, 'Usar editor HTML para campos amplios', 'Los campos de texto que son amplios pueden editarse con o sin formato HTML.',0);
INSERT INTO `configuracion` VALUES(2, 'catalogo', 'mostrar_precios', 4, '1', '1=Si|0=No', 10, 'Mostrar el precio de los productos en el sitio Web', 'En caso de que requiera ocultar todos los precios de productos puede usar esta opción de configuración. Tenga en cuenta que los usuarios no podrán realizar pedidos si deshabilita esto.',0);
INSERT INTO `configuracion` VALUES(3, 'catalogo', 'forma_pedido', 4, '4', '1=Sin carro de compras|2=Realización de pedidos|3=Compra directa|4=Carro de compras', 20, 'Forma en la que se reciben los pedidos en la Web', 'Seleccione la forma en la que desea se realicen las compras en su sitio Web.<br /><br />\r\nSin carro de compras: No se permite que los usuarios realicen pedidos o compras en la Web.<br /><br />\r\nRealización de pedidos: Se permite la confección del pedido en el carro de compras. Una vez confirmado el pedido se envía por email y queda registrado en la base de datos.<br /><br />\r\nCompra directa: Se permite la compra directa de los productos con pasarela de pagos.<br /><br />\r\nCarro de compras: Se permite la confección del pedido en el carro de compras. La confirmación del mismo implica el pago con tarjeta de crédito.',0);
INSERT INTO `configuracion` VALUES(4, 'catalogo', 'leyenda_precio', 2, '(*) precio en pesos argentinos\r\n(**) descuento en compra al por mayor', NULL, 40, 'Leyenda para precios', 'Leyenda que acompaña al precio en el detalle de los productos.',0);
INSERT INTO `configuracion` VALUES(5, 'general', 'meta_title', 1, '', NULL, 10, 'Título del sitio Web', 'Título que se visualiza en la barra superior del navegador.',0);
INSERT INTO `configuracion` VALUES(6, 'general', 'meta_description', 2, '', NULL, 20, 'Descripción del sitio Web', 'Texto corto descriptivo del sitio Web, útil para identificación en los buscadores y posicionamiento.',0);
INSERT INTO `configuracion` VALUES(7, 'general', 'meta_keywords', 1, '', NULL, 30, 'Palabras clave', 'Separe por coma las palabras clave generales de su sitio Web. Útil para posicionamiento.',0);
INSERT INTO `configuracion` VALUES(8, 'contacto', 'email', 1, 'info@tuempresa.com', NULL, 10, 'Mails administración', 'Ingrese el email de administración del sitio Web.<br />\r\nEste email será utilizado para envíos y como casilla de destino de mensajes enviados por los usuarios.',0);
INSERT INTO `configuracion` VALUES(9, 'contacto', 'direccion', 2, 'Sarmiento 881 (Casa Central)\r\n</br>Tel. +54 (0341) 472 0966</br>\r\n</br>info@tuempresa.com</br>\r\nwww.tuempresa.com', NULL, 20, 'Datos de Contacto', NULL,0);
INSERT INTO `configuracion` VALUES(10, 'contacto', 'telefono', 1, '+54 (0341) 472 0966', NULL, 30, 'Teléfonos', NULL,0);
INSERT INTO `configuracion` VALUES(11, 'contacto', 'texto_contacto', 2, 'Complete el siguiente formulario si desea contactarse con nosotros, recibir información y novedades o hacernos alguna consultas.', NULL, 40, 'Texto del formulario de contacto', 'Texto que se encuentra sobre el formulario de contacto.',0);
INSERT INTO `configuracion` VALUES(12, 'contacto', 'texto_agradecimiento', 2, 'Gracias por enviarnos tus datos, en breve nos comunicamos con vos. Que tengas un lindo día!', NULL, 50, 'Texto de agradecimiento', 'Texto de agradecimiento de mensaje enviado.',0);
INSERT INTO `configuracion` VALUES(13, 'contacto', 'mapa_google', 2, '', '', 60, 'Ubicacion', 'Copie el codigo IFRAME de Google Maps.',0);
INSERT INTO `configuracion` VALUES(14, 'catalogo', 'productos_home', 1, '21', NULL, 50, 'Cantidad de productos en la Home', 'Cantidad de productos que se muestran en la home del sitio Web.',0);
INSERT INTO `configuracion` VALUES(15, 'catalogo', 'productos_destacados', 1, '21', NULL, 60, 'Cantidad de productos destacados', 'Cantidad de productos destacados que se muestran en el catálogo.',0);
INSERT INTO `configuracion` VALUES(16, 'catalogo', 'productos_ofertas', 1, '21', NULL, 70, 'Cantidad de productos en oferta', 'Cantidad de productos que se muestran en el sector de ofertas y novedades',0);
INSERT INTO `configuracion` VALUES(17, 'catalogo', 'productos_ofertas_home', 1, '21', NULL, 80, 'Cantidad de productos en ofertas (recuadro Home)', 'Cantidad de productos que se visualizan en el recuadro de ofertas y novedades de la Home.',0);
INSERT INTO `configuracion` VALUES(18, 'catalogo', 'productos_listado', 1, '21', NULL, 90, 'Cantidad de productos en listados', 'Cantidad de productos que se deben mostrar de forma predeterminada en los listados del sitio Web.',0);
INSERT INTO `configuracion` VALUES(19, 'avanzada', 'google_analytics', 1, 'UA-33317648-49', NULL, 20, 'Google Analytics tracking ID', 'ID de Google Analytics. Complete este campo si desea almacenar estadísticas en Google Analytics con la herramienta integrada de Elephant.',0);
INSERT INTO `configuracion` VALUES(20, 'catalogo', 'listas_extra', 1, '0', NULL, 30, 'Listas de precio extra', 'Determina la cantidad de listas de precio extra habilitadas en el formulario de prosductos. Este valor debe estar entre 0 y 5.',0);
INSERT INTO `configuracion` VALUES(21, 'avanzada', 'imagenes_descripcion', 4, '1', '1=Si|0=No', 30, 'Descripcion en Imagenes', 'Este parametro depende exclusivamente del diseño del sitio web. Es posible que su sitio no muestre descripcion en las imagenes o solo algunas de ellas la posean.',0);
INSERT INTO `configuracion` VALUES(22, 'avanzada', 'imagenes_enlace', 4, '1', '1=Si|0=No', 40, 'Enlaces en Imagenes', 'Este parametro depende exclusivamente del diseño del sitio web. Es posible que su sitio no tenga enlaces en las imagenes o solo algunas de ellas lo posean.',0);
INSERT INTO `configuracion` VALUES(23, 'general', 'fondo', 5, '2170', NULL, 110, 'Fondo General del Sitio Web', NULL,0);
INSERT INTO `configuracion` VALUES(24, 'colores', 'fondo_color', 8, '12205c', NULL, 60, 'Color de Fondo (si no hay imagen)', NULL,0);
INSERT INTO `configuracion` VALUES(25, 'general', 'pie', 5, '586', NULL, 120, 'Imagen de Pie', NULL,0);
INSERT INTO `configuracion` VALUES(26, 'colores', 'pie_color', 8, 'f0d003', NULL, 80, 'Color de fondo de Pie (si no hay imagen)', NULL,0);
INSERT INTO `configuracion` VALUES(27, 'colores', 'pie_texto_color', 8, '000000', NULL, 90, 'Color del Texto en el Pie', NULL,0);
INSERT INTO `configuracion` VALUES(28, 'colores', 'texto_general_color', 8, '262626', NULL, 100, 'Color del Texto en toda la web', NULL,0);
INSERT INTO `configuracion` VALUES(29, 'colores', 'seccion_titulo_color', 8, 'ffffff', NULL, 130, 'Color del Titulo en las Secciones', NULL,0);
INSERT INTO `configuracion` VALUES(30, 'colores', 'seccion_titulo_fondo_color', 8, '3d4fa6', NULL, 140, 'Color de Fondo en las Secciones', NULL,0);
INSERT INTO `configuracion` VALUES(31, 'contacto', 'imagen_encabezado', 5, '519', NULL, 70, 'Imagen de Encabezado', NULL,0);
INSERT INTO `configuracion` VALUES(32, 'contacto', 'titulo_datos', 1, 'Datos de Contacto', NULL, 15, 'Titulo Datos de Contacto', NULL,0);
INSERT INTO `configuracion` VALUES(33, 'contacto', 'titulo_ubicacion', 1, 'Donde Estamos', NULL, 55, 'Titulo de Ubicacion', NULL,0);
INSERT INTO `configuracion` VALUES(34, 'contacto', 'titulo_formulario', 1, 'Envianos un mensaje', NULL, 35, 'Titulo de Formulario', NULL,0);
INSERT INTO `configuracion` VALUES(35, 'contacto', 'contacto_template', 10, 'contacto-datos-ubicacion', '1=contacto-ubicacion-datos|2=contacto-datos-ubicacion', 80, 'Template', NULL,0);
INSERT INTO `configuracion` VALUES(36, 'redes', 'enlace_facebook', 1, '', NULL, 10, 'Enlace a Facebook', NULL,0);
INSERT INTO `configuracion` VALUES(37, 'redes', 'enlace_twitter', 1, '', NULL, 20, 'Enlace a Twitter', NULL,0);
INSERT INTO `configuracion` VALUES(38, 'redes', 'enlace_google', 1, '', NULL, 30, 'Enlace a Google+', NULL,0);
INSERT INTO `configuracion` VALUES(39, 'redes', 'enlace_linkedin', 1, '', NULL, 40, 'Enlace a Linkedin', NULL,0);
INSERT INTO `configuracion` VALUES(40, 'redes', 'enlace_youtube', 1, '', NULL, 50, 'Enlace a YouTube', NULL,0);
INSERT INTO `configuracion` VALUES(41, 'elementos', 'elementos_titulo', 1, 'Productos', NULL, 10, 'Titulo del Objeto', NULL,0);
INSERT INTO `configuracion` VALUES(42, 'elementos', 'elementos_imagen_encabezado', 5, '1036', NULL, 20, 'Imagenes de Encabezado', NULL,0);
INSERT INTO `configuracion` VALUES(43, 'elementos', 'elementos_titulo_seccion', 1, 'Nuestros Productos', NULL, 30, 'Titulo de Seccion', NULL,0);
INSERT INTO `configuracion` VALUES(44, 'elementos', 'elementos_subtitulo_seccion', 1, 'Todas nuestros productos', NULL, 40, 'Subtitulo de Seccion', NULL,0);
INSERT INTO `configuracion` VALUES(45, 'elementos', 'elementos_titulo_consulta', 1, 'Consultar', NULL, 50, 'Titulo de Boton Consultar', NULL,0);
INSERT INTO `configuracion` VALUES(46, 'elementos', 'elementos_titulo_detalle', 1, 'Detalle', NULL, 60, 'Titulo de Detalle', NULL,0);
INSERT INTO `configuracion` VALUES(47, 'colores', 'elementos_relacionados_fondo_color', 8, 'e2ebf0', NULL, 150, 'Elementos Relacionados Fondo', NULL,0);
INSERT INTO `configuracion` VALUES(48, 'colores', 'elementos_relacionados_contenedor_color', 8, 'b0c1cf', NULL, 160, 'Elementos Relacionados Contenedor', NULL,0);
INSERT INTO `configuracion` VALUES(49, 'elementos', 'elementos_relacionados_titulo', 1, 'Destacados', NULL, 70, 'Titulo Relacionados', NULL,0);
INSERT INTO `configuracion` VALUES(50, 'general', 'general_dominio', 1, 'www.dominio.com', NULL, 5, 'Dominio WWW', NULL,0);
INSERT INTO `configuracion` VALUES(51, 'contacto', 'general_direccion_corta', 1, 'Sarmiento 881, Rosario, Argentina.', NULL, 100, 'Direccion Corta', NULL,0);
INSERT INTO `configuracion` VALUES(52, 'avanzada', 'data_fiscal', 1, '#', NULL, 100, 'Enlace AFIP (Data Fiscal)', 'Copie el enlace provisto por AFIP (Formulario 960/NM)',0);
INSERT INTO `configuracion` VALUES(53, 'redes', 'codigo_facebook', 2, '', NULL, 110, 'Codigo API Facebook', 'Codigo API general para todos los recursos.',0);
INSERT INTO `configuracion` VALUES(54, 'redes', 'codigo_likebox', 2, '', NULL, 120, 'Codigo LikeBox Facebook', NULL,0);
INSERT INTO `configuracion` VALUES(56, 'avanzada', 'client_id', 1, '', '', 100, 'Client_id (MercadoPago)', '',0);
INSERT INTO `configuracion` VALUES(57, 'avanzada', 'client_secret', 1, '', '', 110, 'Client_secret (MercadoPago)', '',0);
INSERT INTO `configuracion` VALUES(58, 'avanzada', 'mp_sandbox', 4, '0', '0=No|1=Si', 120, 'Modo Pruebas Sandbox (MercadoPago)', 'Para probar, elige una de las siguientes tarjetas de acuerdo al estado que quieras obtener:\r\n\r\nVisa Nro 4444 4444 4444 0008: approved. /\r\nMastercard Nro 5031 1111 1111 6601: pending. /\r\nAmerican Express Nro 37000 00000 02461: rejected.',0);
INSERT INTO `configuracion` VALUES(59, 'general', 'valor_minimo_envio', 1, '1000000', '', 40, 'Valor Minimo de Envio', '',0);
INSERT INTO `configuracion` VALUES(61, 'catalogo', 'pedido_gracias', 2, 'El pedido fue recibido.', NULL, 100, 'Texto Gracias', NULL,0);
INSERT INTO `configuracion` VALUES(62, 'catalogo', 'pedido_transferencia', 2, '', NULL, 110, 'Texto Transferencia', NULL,0);
INSERT INTO `configuracion` VALUES(63, 'catalogo', 'productos_excluidos', 2, '50-56313,36-26673,36-26670,36-26674,36-75229,36-75225,36-99304,36-99302,36-80004', NULL, 5, 'Productos Excluidos', 'Separados por coma. Ej: 36-26673,36-26670,36-26674,36-75229,36-75225',0);
INSERT INTO `configuracion` VALUES(64, 'avanzada', 'fuente', 2, '<link href=\"https://fonts.googleapis.com/css?family=Varela+Round\" rel=\"stylesheet\">', NULL, 2, 'Fuente / Tiporgrafía', 'Enlace a la fuente',0);
INSERT INTO `configuracion` VALUES(65, 'avanzada', 'color_head_email', 7, '#EEEEEE', NULL, 20, 'Color Encabezado Email', 'Solo valores exadecimales Ej: #cc0044',0);
INSERT INTO `configuracion` VALUES(66, 'avanzada', 'color_texto_email', 7, '#666666', NULL, 30, 'Color de Texto Email', 'Ejemplo: #fff o white',0);
INSERT INTO `configuracion` VALUES(67, 'avanzada', 'barra_prefooter', 4, '1', NULL, 40, 'Barra Pre Footer', 'Mostrar:1 - Ocultar:0',0);
INSERT INTO `configuracion` VALUES(68, 'avanzada', 'productos_titulo', 1, 'PRODUCTOS', NULL, 1, 'Titulo de Productos', 'Nombre para los productos. Ej: Productos, Packs, Cursos, etc.',0);
INSERT INTO `configuracion` VALUES(69, 'avanzada', 'instagram_userid', 1, '8626857013', NULL, 10, 'Instagram UserID', NULL,0);
INSERT INTO `configuracion` VALUES(70, 'avanzada', 'instagram_clientid', 1, 'dd095157744c4bd0a67181fc4906e5b6', NULL, 20, 'Instagram ClientID', NULL,0);
INSERT INTO `configuracion` VALUES(71, 'avanzada', 'instagram_accesstoken', 1, '8626857013.dd09515.0fcd8351c65140d48f5a340693af1c3f', NULL, 30, 'Instagram Access Token', NULL,0);
INSERT INTO `configuracion` VALUES(72, 'avanzada', 'instagram_cantidad', 1, '6', NULL, 40, 'Instagram Cantidad de Imagenes', NULL,0);
INSERT INTO `configuracion` VALUES (74, 'avanzada', 'categorias_destacadas_productos', '4', '0', NULL, '50', 'Categorías Destacadas en Productos', 'Mostrar 1 - Ocultar 0',0);
INSERT INTO `configuracion` VALUES (75, 'avanzada', 'responder_gmail', '4', '0', NULL, '55', 'Responder con Gmail', 'Habilitar 1 - Desactivar 0',0);
INSERT INTO `configuracion` VALUES (76, 'avanzada', 'modulo_banners', '4', '0', NULL, '70', 'Banners', 'Habilitar 1 - Desactivar 0',0);
INSERT INTO `configuracion` VALUES (78, 'avanzada', 'preloader', '1', '1', '1-Puntos / 2-Roller / 3-Cuadrados / 4-Elipsis', '0', 'Preloader', NULL,0);
INSERT INTO `configuracion` VALUES (80, 'avanzada', 'modulo_sucursales', '4', '0', NULL, '80', 'Sucursales', 'Habilitar 1 - Desactivar 0',0);
INSERT INTO `configuracion` VALUES (90, 'avanzada', 'modulo_mayorista', '4', '0', NULL, '90', 'Mayorista', 'Habilitar 1 - Desactivar 0',0);
INSERT INTO `configuracion` VALUES (95, 'avanzada', 'modulo_inmuebles', '4', '0', NULL, '95', 'Inmuebles', 'Habilitar 1 - Desactivar 0',0);
INSERT INTO `configuracion` VALUES (100, 'avanzada', 'productos_leyenda', '2', '', NULL, '90', 'Leyenda adicional', 'Texto que se adjunta al item o producto del catálogo',1);
INSERT INTO `configuracion` VALUES (110, 'avanzada', 'productos_leyenda_listado', '2', '', NULL, '110', 'Leyenda adicional en listado', 'Texto que se adjunta al item o producto del catálogo en el listado',1);
INSERT INTO configuracion VALUES (150,'avanzada','modulo_mayorista_moderacion','4','1','1=Si,0=No','120','Moderación',NULL,0);
INSERT INTO configuracion VALUES (160, 'avanzada', 'precios_publicos', '4', '1', NULL, '130', 'Precios Públicos', 'Precios publicos sin usuario logeado',1);
INSERT INTO configuracion VALUES (170, 'avanzada', 'sonidos_admin', '4', '1', NULL, '200', 'Sonidos del administrador', NULL,0);
INSERT INTO configuracion VALUES (180, 'avanzada', 'sonidos_web', '4', '1', NULL, '210', 'Sonidos del sitio web', NULL,0);
INSERT INTO configuracion VALUES (190, 'avanzada', 'categorias_columnas', '4', '1', NULL, '220', 'Columnas de Categorias', NULL,0);
INSERT INTO configuracion VALUES (200, 'avanzada', 'compra_minima', '1', '0', NULL, '200', 'Monto Mínimo de Compra', 'Monto mínimo de Compra (0 = sin límite)',1);
INSERT INTO configuracion VALUES (210, 'avanzada', 'productos_html', '4', '0', NULL, '210', 'HTML en Productos', NULL,1);
INSERT INTO configuracion VALUES (220, 'smtp', 'smtp_host', '1', '', NULL, '220', 'HOST', NULL,0);
INSERT INTO configuracion VALUES (230, 'smtp', 'smtp_user', '1', '', NULL, '230', 'USER', NULL,0);
INSERT INTO configuracion VALUES (240, 'smtp', 'smtp_pass', '1', '', NULL, '240', 'PASS', NULL,0);
INSERT INTO configuracion VALUES (250, 'smtp', 'smtp_auth', '1', '', NULL, '250', 'AUTH', NULL,0);
INSERT INTO configuracion VALUES (260, 'smtp', 'smtp_secure', '1', '', NULL, '260', 'SECURE', NULL,0);
INSERT INTO configuracion VALUES (270, 'smtp', 'smtp_port', '1', '', NULL, '270', 'PORT', NULL,0);
INSERT INTO configuracion VALUES (300, 'html', 'html_head', '2', '', NULL, '300', 'HTML ANTES DE CERRAR HEAD', NULL,0);
INSERT INTO configuracion VALUES (310, 'html', 'html_body', '2', '', NULL, '310', 'HTML LUEGO DE ABRIR BODY', NULL,0);
INSERT INTO configuracion VALUES (320, 'avanzada', 'es_institucional', '4', '0', NULL, '320', '¿Es Institucional?', NULL,0);
INSERT INTO configuracion VALUES (330, 'avanzada', 'pago_arreglo', '4', '1', NULL, '330', 'Pago: Arreglo con el vendedor', NULL,1);
INSERT INTO configuracion VALUES (335, 'avanzada', 'pago_ensucursal', '4', '1', NULL, '335', 'Pago: En Sucursal', NULL,1);
INSERT INTO configuracion VALUES (337, 'avanzada', 'pago_ahora12', '4', '0', NULL, '337', 'Pago: Ahora 12', NULL,0);
INSERT INTO configuracion VALUES (340, 'avanzada', 'vista_imagenes', '4', '1', NULL, '340', 'Listado de productos (imagenes/listado)', NULL,0);
INSERT INTO configuracion VALUES (350, 'avanzada', 'zoom_admin', '1', '100', NULL, '350', 'Zoom para el Administrador', NULL,0);
INSERT INTO configuracion VALUES (360, 'avanzada', 'importar_manual', '4', '0', NULL, '360', 'Importador de Datos', NULL,0);
INSERT INTO configuracion VALUES (370, 'avanzada', 'label_notas_pedido', '1', 'NOTAS', NULL, '370', 'Etiqueta de Notas del Pedido', NULL,1);
INSERT INTO configuracion VALUES (375, 'avanzada', 'notas_obligatorias', '4', '0', NULL, '375', 'Notas del pedido obligatorias', NULL,1);
INSERT INTO configuracion VALUES (380, 'avanzada', 'paypal_client', '1', '', NULL, '380', 'PayPal Client Id', NULL,0);
INSERT INTO configuracion VALUES (390, 'avanzada', 'paypal_secret', '1', '', NULL, '390', 'Paypal Secret', NULL,0);
INSERT INTO configuracion VALUES (392, 'avanzada', 'todopago_key', '1', '', NULL, '392', 'TodoPago Api Key', NULL,0);
INSERT INTO configuracion VALUES (394, 'avanzada', 'todopago_merchant', '1', '', NULL, '394', 'TodoPago Nro de Comercio (Merchant ID)', NULL,0);
INSERT INTO configuracion VALUES (400, 'avanzada', 'mp_public_key', '1', '', NULL, '400', 'MercadoPago Public Key', NULL,0);
INSERT INTO configuracion VALUES (410, 'avanzada', 'mp_access_token', '1', '', NULL, '410', 'MercadoPago Access Token', NULL,0);
INSERT INTO configuracion VALUES (415, 'avanzada', 'tokko', '1', '', NULL, '415', 'Tokko Broker', NULL,0);

INSERT INTO configuracion VALUES (416, 'avanzada', 'stripe_public', '1', '', NULL, '416', 'Stripe Clave Publica', NULL,0);
INSERT INTO configuracion VALUES (417, 'avanzada', 'stripe_secret', '1', '', NULL, '417', 'Stripe Clave Secreta', NULL,0);

INSERT INTO configuracion VALUES (420, 'avanzada', 'titulo_medida_x', '1', 'Largo', NULL, '420', 'Titulo X', NULL,0);
INSERT INTO configuracion VALUES (430, 'avanzada', 'titulo_medida_y', '1', 'Alto', NULL, '430', 'Titulo Y', NULL,0);
INSERT INTO configuracion VALUES (440, 'avanzada', 'titulo_medida_z', '1', 'Ancho', NULL, '440', 'Titulo Z', NULL,0);

INSERT INTO configuracion VALUES (450, 'avanzada', 'inmuebles_leyenda', '2', '', NULL, '450', 'Inmuebles Leyenda', 'Texto que se adjunta al detalle de la propiedad',0);
INSERT INTO configuracion VALUES (470, 'avanzada', 'slider_corto', '4', '0', NULL, '470', 'Slider Corto', 'Habilitar 1 - Desactivar 0',0);
INSERT INTO configuracion VALUES (475, 'avanzada', 'envio_oca', '4', '0', NULL, '475', 'Envio OCA', 'Habilitar 1 - Desactivar 0',0);
INSERT INTO configuracion VALUES (480, 'avanzada', 'envio_oca_informativo', '4', '0', NULL, '480', 'Envio OCA Solo Informativo', 'Habilitar 1 - Desactivar 0',0);
INSERT INTO configuracion VALUES (485, 'avanzada', 'envio_oca_domicilio', '1', '', NULL, '485', 'Envio OCA - Recibe el pedido en domicilio', 'Nro de Operativa OCA',0);
INSERT INTO configuracion VALUES (490, 'avanzada', 'envio_oca_sucursal', '1', '', NULL, '490', 'Envio OCA - Recibe el pedido en una sucursal', 'Nro de Operativa OCA',0);
INSERT INTO configuracion VALUES (492, 'avanzada', 'envio_oca_cuit', '1', '', NULL, '492', 'Envio OCA - Cuit asociado a la cuenta', '',0);
INSERT INTO configuracion VALUES (494, 'avanzada', 'envio_oca_cporigen', '1', '', NULL, '494', 'Envio OCA - Codigo Postal de Origen', '',0);

INSERT INTO configuracion VALUES (500, 'avanzada', 'envio_cruzdelsur_idcliente', '1', '', NULL, '500', 'Envio Cruz Del Sur - IdCliente', '',0);
INSERT INTO configuracion VALUES (502, 'avanzada', 'envio_cruzdelsur_ulogin', '1', '', NULL, '502', 'Envio Cruz Del Sur - uLogin', '',0);
INSERT INTO configuracion VALUES (504, 'avanzada', 'envio_cruzdelsur_uclave', '1', '', NULL, '504', 'Envio Cruz Del Sur - uClave', '',0);

INSERT INTO configuracion VALUES (506, 'avanzada', 'envio_enviopack_apikey', '1', '', NULL, '506', 'EnvioPack - Apikey', '',0);
INSERT INTO configuracion VALUES (508, 'avanzada', 'envio_enviopack_secret', '1', '', NULL, '508', 'EnvioPack - Secret', '',0);

INSERT INTO configuracion VALUES(73, 'avanzada', 'vi_preheader_onoff', 4, '0', NULL, '500', 'Pre Header (On/Off)', 'Mostar:1 - Ocultar:0',0);
INSERT INTO configuracion VALUES(510, 'avanzada', 'vi_preheader_boxed', 4, '1', NULL, '510', 'Pre Header (Boxed)', 'On:1 - Off:0',0);
INSERT INTO configuracion VALUES(520, 'avanzada', 'vi_preheader_color_bg', 7, '#303030', NULL, '520', 'Pre Header (Background)', '',0);
INSERT INTO configuracion VALUES(530, 'avanzada', 'vi_preheader_color_txt', 7, '#888888', NULL, '530', 'Pre Header (Texto)', '',0);
INSERT INTO configuracion VALUES(540, 'avanzada', 'vi_preheader_color_txthover', 7, '#FFFFFF', NULL, '540', 'Pre Header (Texto Hover)', '',0);

INSERT INTO configuracion VALUES(590, 'avanzada', 'vi_header_boxed', 4, '1', NULL, '590', 'Header (Boxed)', 'On:1 - Off:0',0);
INSERT INTO configuracion VALUES(600, 'avanzada', 'vi_header_d_logo_onoff', 4, '1', NULL, '600', 'Header Logo (On/Off)', '',0);
INSERT INTO configuracion VALUES(610, 'avanzada', 'vi_header_d_logo_ph', 1, '1', NULL, '610', 'Header Logo (Pos Horiz)', '',0);
INSERT INTO configuracion VALUES(620, 'avanzada', 'vi_header_d_logo_pv', 1, '1', NULL, '620', 'Header Logo (Pos Vert)', '',0);

INSERT INTO configuracion VALUES(630, 'avanzada', 'vi_header_d_btns_onoff', 4, '1', NULL, '630', 'Header Botonera (On/Off)', '',0);
INSERT INTO configuracion VALUES(640, 'avanzada', 'vi_header_d_btns_ph', 1, '1', NULL, '640', 'Header Botonera (Pos Horiz)', '',0);
INSERT INTO configuracion VALUES(650, 'avanzada', 'vi_header_d_btns_pv', 1, '1', NULL, '650', 'Header Botonera (Pos Vert)', '',0);

INSERT INTO configuracion VALUES(660, 'avanzada', 'vi_header_d_iconos_onoff', 4, '1', NULL, '660', 'Header Iconos (On/Off)', '',0);
INSERT INTO configuracion VALUES(670, 'avanzada', 'vi_header_d_iconos_ph', 1, '3', NULL, '670', 'Header Iconos (Pos Horiz)', '',0);
INSERT INTO configuracion VALUES(680, 'avanzada', 'vi_header_d_iconos_pv', 1, '1', NULL, '680', 'Header Iconos (Pos Vert)', '',0);

INSERT INTO configuracion VALUES(690, 'avanzada', 'vi_header_d_color_iconos', 7, '#191919', NULL, '690', 'Header Iconos (Color)', '',0);
INSERT INTO configuracion VALUES(695, 'avanzada', 'vi_header_d_color_iconoshover', 7, '#303030', NULL, '695', 'Header Iconos (Color Hover)', '',0);

INSERT INTO configuracion VALUES(700, 'avanzada', 'vi_header_d_color_bg', 7, '#FFFFFF', NULL, '700', 'Header Color (Background)', '',0);
INSERT INTO configuracion VALUES(710, 'avanzada', 'vi_header_d_color_bg2', 7, '#FFFFFF', NULL, '710', 'Header Color (Background 2)', '',0);
INSERT INTO configuracion VALUES(720, 'avanzada', 'vi_header_d_color_txt', 7, '#191919', NULL, '720', 'Header Color (Texto)', '',0);
INSERT INTO configuracion VALUES(730, 'avanzada', 'vi_header_d_color_txthover', 7, '#333333', NULL, '730', 'Header Color (Texto Hover)', '',0);

INSERT INTO configuracion VALUES(800, 'avanzada', 'vi_header_s_color_bg', 7, '#FFFFFF', NULL, '800', 'Header Stuck Color (Background)', '',0);
INSERT INTO configuracion VALUES(810, 'avanzada', 'vi_header_s_color_txt', 7, '#191919', NULL, '810', 'Header  Stuck Color (Texto)', '',0);
INSERT INTO configuracion VALUES(820, 'avanzada', 'vi_header_s_color_txthover', 7, '#191919', NULL, '820', 'Header  Stuck Color (Texto Hover)', '',0);

INSERT INTO configuracion VALUES(900, 'avanzada', 'vi_header_m_color_bg', 7, '#FFFFFF', NULL, '800', 'MOVIL Header Color (Background)', '',0);
INSERT INTO configuracion VALUES(910, 'avanzada', 'vi_header_m_color_txt', 7, '#191919', NULL, '810', 'MOVIL Header Color (Texto)', '',0);
INSERT INTO configuracion VALUES(920, 'avanzada', 'vi_header_m_color_txthover', 7, '#303030', NULL, '820', 'MOVIL Header Color (Texto Hover)', '',0);
INSERT INTO configuracion VALUES(930, 'avanzada', 'vi_header_m_color_separador', 7, '#EEEEEE', NULL, '820', 'MOVIL Header Color (Separador)', '',0);
INSERT INTO configuracion VALUES(940, 'avanzada', 'vi_header_m_color_btn', 7, '#191919', NULL, '820', 'MOVIL Header Color (Btn)', '',0);
INSERT INTO configuracion VALUES(950, 'avanzada', 'vi_header_m_color_btnhover', 7, '#303030', NULL, '820', 'MOVIL Header Color (Btn Hover)', '',0);

INSERT INTO configuracion VALUES(1000, 'avanzada', 'url_postlogin', 1, './?p=home&m=productos', NULL, '1000', 'URL POST LOGIN', '',0);
INSERT INTO configuracion VALUES(1050, 'avanzada', 'url_importador', 1, '', NULL, '1000', 'URL IMPORTADOR', '',0);

INSERT INTO configuracion VALUES(1900, 'avanzada', 'vi_footer', 1, '1', NULL, '1900', 'FOOTER', 'Nro de Pie',0);

INSERT INTO configuracion VALUES(2000, 'avanzada', 'vi_footertop_d_color_bg', 7, '#2879fe', NULL, '2000', 'FOOTER Top Color Bg', '',0);
INSERT INTO configuracion VALUES(2100, 'avanzada', 'vi_footertop_d_color_txt', 7, '#fafafa', NULL, '2100', 'FOOTER Top Color Txt', '',0);
INSERT INTO configuracion VALUES(2150, 'avanzada', 'vi_footertop_d_color_txthover', 7, '#ffffff', NULL, '2150', 'FOOTER Top Color Txt Hover', '',0);
INSERT INTO configuracion VALUES(2200, 'avanzada', 'vi_footertop_d_color_btn', 7, '#303030', NULL, '2200', 'FOOTER Top Color Btn', '',0);
INSERT INTO configuracion VALUES(2250, 'avanzada', 'vi_footertop_d_color_btnhover', 7, '#000000', NULL, '2250', 'FOOTER Top Color Btn Hover', '',0);
INSERT INTO configuracion VALUES(2300, 'avanzada', 'vi_footertop_d_color_btntxt', 7, '#ffffff', NULL, '2300', 'FOOTER Top Color Btn Txt', '',0);

INSERT INTO configuracion VALUES(2350, 'avanzada', 'vi_footermid_d_color_bg', 7, '#f7f8fa', NULL, '2350', 'FOOTER Mid Color Bg', '',0);
INSERT INTO configuracion VALUES(2400, 'avanzada', 'vi_footermid_d_color_txt', 7, '#777777', NULL, '2400', 'FOOTER Mid Color Txt', '',0);
INSERT INTO configuracion VALUES(2450, 'avanzada', 'vi_footermid_d_color_txthover', 7, '#2879fe', NULL, '2450', 'FOOTER Mid Color Txt Hover', '',0);
INSERT INTO configuracion VALUES(2500, 'avanzada', 'vi_footermid_d_color_tit', 7, '#333333', NULL, '2500', 'FOOTER Mid Color Tit', '',0);
INSERT INTO configuracion VALUES(2550, 'avanzada', 'vi_footermid_d_color_subtit', 7, '#545454', NULL, '2550', 'FOOTER Mid Color Subtit', '',0);

INSERT INTO configuracion VALUES(2600, 'avanzada', 'vi_footermid_d_image_bg', 1, '', NULL, '2600', 'FOOTER Mid Img Bg', '',0);
INSERT INTO configuracion VALUES(2650, 'avanzada', 'vi_footermid_d_repeat_bg', 1, '', NULL, '2650', 'FOOTER Mid Repeat Bg', '',0);
INSERT INTO configuracion VALUES(2700, 'avanzada', 'vi_footermid_d_size_bg', 1, '', NULL, '2700', 'FOOTER Mid Size Bg', '',0);

INSERT INTO configuracion VALUES(2750, 'avanzada', 'vi_footerbot_d_color_bg', 7, '#ffffff', NULL, '2750', 'FOOTER Bot Color Bg', '',0);
INSERT INTO configuracion VALUES(2800, 'avanzada', 'vi_footerbot_d_color_txt', 7, '#777777', NULL, '2800', 'FOOTER Bot Color Txt', '',0);

INSERT INTO configuracion VALUES(2850, 'avanzada', 'vi_footer_m_color_bg', 7, '#f7f8fa', NULL, '2850', 'FOOTER MOVIL Color Bg', '',0);
INSERT INTO configuracion VALUES(2900, 'avanzada', 'vi_footer_m_color_txt', 7, '#777777', NULL, '2900', 'FOOTER MOVIL Color Txt', '',0);
INSERT INTO configuracion VALUES(2950, 'avanzada', 'vi_footer_m_color_txthover', 7, '#2879fe', NULL, '2950', 'FOOTER MOVIL Color Txt Hover', '',0);
INSERT INTO configuracion VALUES(3000, 'avanzada', 'vi_footer_m_color_btn', 7, '#303030', NULL, '3000', 'FOOTER MOVIL Color Btn', '',0);
INSERT INTO configuracion VALUES(3100, 'avanzada', 'vi_footer_m_color_btnhover', 7, '#000000', NULL, '3100', 'FOOTER MOVIL Color Btn Hover', '',0);
INSERT INTO configuracion VALUES(3150, 'avanzada', 'vi_footer_m_color_btntxt', 7, '#ffffff', NULL, '3150', 'FOOTER MOVIL Color Btn Txt', '',0);
INSERT INTO configuracion VALUES(3200, 'avanzada', 'vi_footer_m_color_tit', 7, '#333333', NULL, '3200', 'FOOTER MOVIL Color Tit', '',0);
INSERT INTO configuracion VALUES(3250, 'avanzada', 'vi_footer_m_color_subtit', 7, '#545454', NULL, '3250', 'FOOTER MOVIL Color Subtit', '',0);
INSERT INTO configuracion VALUES(3260, 'avanzada', 'vi_footer_m_color_separador', 7, '#eeeeee', NULL, '3260', 'FOOTER MOVIL Color Separador', '',0);
INSERT INTO configuracion VALUES(3300, 'avanzada', 'vi_footerbot_m_color_bg', 7, '#ffffff', NULL, '3300', 'FOOTER MOVIL Bot Color Bg', '',0);
INSERT INTO configuracion VALUES(3350, 'avanzada', 'vi_footerbot_m_color_txt', 7, '#777777', NULL, '3350', 'FOOTER MOVIL Bot Color Txt', '',0);

INSERT INTO configuracion VALUES(3400, 'avanzada', 'vi_paneles_color_bg', 7, '#FFFFFF', NULL, '3400', 'PANELES COLOR BG', '',0);
INSERT INTO configuracion VALUES(3410, 'avanzada', 'vi_paneles_color_separador', 7, '#EEEEEE', NULL, '3410', 'PANELES COLOR SEPARADOR', '',0);
INSERT INTO configuracion VALUES(3420, 'avanzada', 'vi_paneles_color_txt', 7, '#191919', NULL, '3420', 'PANELES COLOR TXT', '',0);
INSERT INTO configuracion VALUES(3430, 'avanzada', 'vi_paneles_color_txthover', 7, '#303030', NULL, '3430', 'PANELES COLOR TXTHOVER', '',0);
INSERT INTO configuracion VALUES(3440, 'avanzada', 'vi_paneles_color_btntxt', 7, '#FFFFFF', NULL, '3440', 'PANELES COLOR BTNTXT', '',0);
INSERT INTO configuracion VALUES(3450, 'avanzada', 'vi_paneles_color_btn', 7, '#191919', NULL, '3450', 'PANELES COLOR BTN', '',0);
INSERT INTO configuracion VALUES(3460, 'avanzada', 'vi_paneles_color_btnhover', 7, '#303030', NULL, '3460', 'PANELES COLOR BTNHOVER', '',0);
INSERT INTO configuracion VALUES(3470, 'avanzada', 'vi_paneles_color_precio', 7, '#2879fe', NULL, '3470', 'PANELES COLOR PRECIO', '',0);
INSERT INTO configuracion VALUES(3480, 'avanzada', 'vi_paneles_color_preciotachado', 7, '#BBBBBB', NULL, '3480', 'PANELES COLOR PRECIO TACHADO', '',0);

INSERT INTO configuracion VALUES(3600, 'avanzada', 'vi_header_btnsacceso_onoff', 4, '0', NULL, '3600', 'BOTON ACCESO ON/OFF', '',0);
INSERT INTO configuracion VALUES(3610, 'avanzada', 'vi_header_btnsacceso_color_txt', 7, '#FFFFFF', NULL, '3610', 'BOTON ACCESO COLOR TEXTO', '',0);
INSERT INTO configuracion VALUES(3620, 'avanzada', 'vi_header_btnsacceso_color_btn', 7, '#191919', NULL, '3620', 'BOTON ACCESO COLOR BOTON', '',0);
INSERT INTO configuracion VALUES(3630, 'avanzada', 'vi_header_btnsacceso_color_btnhover', 7, '#303030', NULL, '3630', 'BOTON ACCESO COLOR HOVER', '',0);
INSERT INTO configuracion VALUES(3640, 'avanzada', 'vi_header_btnsacceso_valor', 1, 'ACCEDER / REGISTRARSE', NULL, '3640', 'BOTON ACCESO TEXTO LABEL', '',0);

INSERT INTO configuracion VALUES(3650, 'avanzada', 'vi_color_primario', 7, '#2879fe', NULL, '3650', 'COLOR PRIMARIO', '',0);
INSERT INTO configuracion VALUES(3660, 'avanzada', 'vi_color_primario_hover', 7, '#BBBBBB', NULL, '3660', 'COLOR PRIMARIO HOVER', '',0);

INSERT INTO configuracion VALUES(9000, 'avanzada', 'precio_sugerido', '4', '0', NULL, '9000', 'Precios Sugeridos', 'Muestra el precio de Lista1 o Precio Público a los clientes con otras listas.',0);
INSERT INTO configuracion VALUES(9010, 'avanzada', 'stock', '4', '0', NULL, '9010', 'STOCK', 'Habilita el control de Stock',1);
INSERT INTO configuracion VALUES(9015, 'avanzada', 'stock_descuenta', '4', '1', NULL, '9015', 'STOCK', 'Descuenta stock por cada pedido',1);
INSERT INTO configuracion VALUES(9020, 'avanzada', 'modulo_descargas', '4', '0', NULL, '9020', 'MODULO DESCARGAS', 'Habilita el modulo de descargas.',0);
INSERT INTO configuracion VALUES(9025, 'avanzada', 'modulo_descargas_publicas', '4', '0', NULL, '9025', 'DESCARGAS PUBLICAS', 'Habilita las descargas publicas.',0);
INSERT INTO configuracion VALUES(9030, 'avanzada', 'modulo_descargas_titulo', '1', 'DESCARGAS', NULL, '9030', 'MODULO DESCARGAS TITULO', 'Titulo del modulo (una sola palabra)',0);

INSERT INTO configuracion VALUES(9031, 'avanzada', 'modulo_videos', '4', '0', NULL, '9031', 'MODULO VIDEOS', 'Habilita el modulo de videos.',0);
INSERT INTO configuracion VALUES(9032, 'avanzada', 'modulo_videos_titulo', '1', 'VIDEOS', NULL, '9032', 'MODULO VIDEOS TITULO', 'Titulo del modulo (una sola palabra)',0);

INSERT INTO configuracion VALUES(9035, 'avanzada', 'lenguaje', '1', 'ES', NULL, '9035', 'LENGUAJE', 'ES - EN',0);
INSERT INTO configuracion VALUES(9040, 'avanzada', 'moneda', '1', 'ARS', NULL, '9040', 'MONEDA', 'ARS - USD',0);

INSERT INTO configuracion VALUES(9045, 'avanzada', 'localidad', '1', '', NULL, '9045', 'LOCALIDAD', 'Id Localidad',0);
INSERT INTO configuracion VALUES(9050, 'avanzada', 'provincia', '1', '', NULL, '9050', 'PROVINCIA', 'Id Provincia',0);

INSERT INTO configuracion VALUES(9100, 'avanzada', 'cupones_descuento', '4', '0', NULL, '9100', 'CUPONES DE DESCUENTO', 'Habilitar o deshabilitar cupones de descuento', 0);
INSERT INTO configuracion VALUES(9110, 'avanzada', 'productos_orden', '1', 'az', NULL, '9110', 'Productos - Orden por defecto', '(caros-baratos-pordefecto-viejos-nuevos-az-za)', 0);
INSERT INTO configuracion VALUES(9112, 'avanzada', 'novedades_orden', '1', 'orden ASC, id_novedad DESC', NULL, '9112', 'Novedades - Orden por defecto', '', 0);

INSERT INTO configuracion VALUES(9115, 'avanzada', 'productos_cantidad', '1', '64', NULL, '9115', 'Productos - Cantidad por pagina', '', 1);

INSERT INTO configuracion VALUES(9118, 'avanzada', 'productos_compradirecta', '4', '1', NULL, '9118', 'COMPRA DIRECTA', 'Habilitar o deshabilitar la compra directa', 1);
INSERT INTO configuracion VALUES(9120, 'avanzada', 'productos_agregar_listado', '4', '0', NULL, '9120', 'AGREGAR EN EL LISTADO', 'Habilitar o deshabilitar boton de agregar en el listado', 0);
INSERT INTO configuracion VALUES(9124, 'avanzada', 'productos_agregar_detalle', '4', '1', NULL, '9124', 'AGREGAR EN EL DETALLE', 'Habilitar o deshabilitar boton de agregar en el detalle', 0);
INSERT INTO configuracion VALUES(9125, 'avanzada', 'contacto_adjunto', '4', '0', NULL, '9125', 'CONTACTO CON ARCHIVO ADJUNTO', 'Habilitar o deshabilitar la posibilidad de adjuntar archivo en el contacto', 1);
INSERT INTO configuracion VALUES(9130, 'avanzada', 'contacto_adjunto_label', '1', 'Adjuntar CV', NULL, '9130', 'CONTACTO ARCHIVO ADJUNTO LABEL', 'Texto del adjuntar en contacto', 1);

INSERT INTO configuracion VALUES(9135, 'avanzada', 'sonido_mensajes', '4', '1', NULL, '9135', 'SONIDO DE MENSAJES NUEVOS', 'Habilita o deshabilita los sonidos de mensaje nuevo', 1);
INSERT INTO configuracion VALUES(9140, 'avanzada', 'sonido_pedidos', '4', '1', NULL, '9140', 'SONIDO DE PEDIDOS NUEVOS', 'Habilita o deshabilita los sonidos de pedido nuevo', 1);

INSERT INTO configuracion VALUES(9200, 'avanzada', 'botonera_comocomprar', '4', '0', NULL, '9200', 'COMO COMPRAR VISIBLE EN BOTONERA', 'Habilita o deshabilita Como Comprar en la botonera', 0);

INSERT INTO configuracion VALUES(9300, 'avanzada', 'envio_gratis', '1', '0', NULL, '9300', 'MONTO PARA ENVIO GRATIS', 'Monto a partir del cual se considera el envio gratuito', 1);
INSERT INTO configuracion VALUES(9400, 'avanzada', 'dolar_ars', '1', '0', NULL, '9400', 'VALOR DOLAR EN PESOS ARG', '', 1);

INSERT INTO configuracion VALUES(9500, 'avanzada', 'modulo_operadores', '4', '1', NULL, '9500', 'MODULO OPERADORES', 'Habilita el modulo de operadores.',0);
INSERT INTO configuracion VALUES(9600, 'avanzada', 'clima_localidad', '1', 'Rosario,ar', NULL, '9600', 'CLIMA LOCALIDAD', 'Ciudad y pais para el clima',1);
INSERT INTO configuracion VALUES(9620, 'avanzada', 'id_pais', '1', '1', NULL, '9620', 'ID PAIS', 'Pais de referencia',0);

INSERT INTO configuracion VALUES(9650, 'avanzada', 'sabadell_merchantcode', '1', '', NULL, '9650', 'SABADELL - MerchantCode', '',1);
INSERT INTO configuracion VALUES(9655, 'avanzada', 'sabadell_password', '1', '', NULL, '9655', 'SABADELL - Password', '',1);
INSERT INTO configuracion VALUES(9660, 'avanzada', 'sabadell_terminal', '1', '', NULL, '9660', 'SABADELL - Terminal', '',1);
INSERT INTO configuracion VALUES(9665, 'avanzada', 'sabadell_jetid', '1', '', NULL, '9665', 'SABADELL - JetID', '',1);

INSERT INTO configuracion VALUES(9670, 'avanzada', 'webpay_apikey', '1', '', NULL, '9670', 'WEBPAY - APIKEY', '',1);
INSERT INTO configuracion VALUES(9675, 'avanzada', 'webpay_apisecret', '1', '', NULL, '9675', 'WEBPAY - APISECRET', '',1);

INSERT INTO configuracion VALUES(9700, 'avanzada', 'bitcoin', '1', '', NULL, '9700', 'BITCOIN CLAVE PUBLICA', 'Clave pública de Bitcoin', 1);

INSERT INTO configuracion VALUES(9750, 'avanzada', 'cookies_aviso', '4', '0', NULL, '9750', 'AVISO DE COOKIES', 'Habilita el aviso de cookies.',1);
INSERT INTO configuracion VALUES(9760, 'avanzada', 'cond_fiscal', '4', '0', NULL, '9760', 'SOLICITAR CONDICIÓN FISCAL', 'Habilita la condicion fiscal en los datos del pedido.',1);

INSERT INTO configuracion VALUES(9800, 'avanzada', 'pedido_datos_requeridos', '1', 'nombre-dni-telefono-email-id_provincia-id_localidad-codpos-calle-numero', NULL, '9800', 'PEDIDO DATOS REQUERIDOS', 'Campos requeridos en el proceso de compra',0);

INSERT INTO configuracion VALUES(9900, 'avanzada', 'boton_arrepentimiento', '4', '0', NULL, '9900', 'BOTON ARREPENTIMIENTO', '',1);

INSERT INTO configuracion VALUES(9950, 'avanzada', 'pago_tucuotaonline', '4', '0', NULL, '9950', 'CREDITOS - TU CUOTA ONLINE', '',1);

INSERT INTO configuracion VALUES(10000, 'avanzada', 'form_productos_amedida', '10', '', NULL, '10000', 'Formulario de Contacto (Productos)', 'HTML/JS',0);

INSERT INTO configuracion VALUES(11000, 'avanzada', 'powered_by_transparent', '4', '1', NULL, '11000', 'Firma de Transparent al pie', '',0);

INSERT INTO configuracion VALUES(12000, 'avanzada', 'contabilium_client', '1', '', NULL, '12000', 'Contabilium - Client ID', '',1);
INSERT INTO configuracion VALUES(12100, 'avanzada', 'contabilium_secret', '1', '', NULL, '12100', 'Contabilium - Client Secret', '',1);

INSERT INTO configuracion VALUES(12200, 'avanzada', 'globalbluepoint_usuario', '1', '', NULL, '12200', 'Global Blue Point - Usuario', '',1);

INSERT INTO configuracion VALUES(12300, 'avanzada', 'productos_publicos', '4', '1', NULL, '165', 'Productos Publicos', 'Productos publicos sin usuario logeado',1);
INSERT INTO configuracion VALUES(12400, 'avanzada', 'stock_visible', '4', '0', NULL, '12400', 'Stock Visible', 'Cantidad restante de stock visible',1);
INSERT INTO configuracion VALUES(12500, 'avanzada', 'vendedor_publica', '4', '1', NULL, '12500', 'Vendedor puede publicar', 'El operador vendedor puede publicar productos',1);

INSERT INTO configuracion VALUES(13300, 'avanzada', 'mp_api', '4', '0', NULL, '13300', 'Tarjetas de Credito / Debito (MercadoPago)', '',1);
INSERT INTO configuracion VALUES(13400, 'avanzada', 'decidir_site_id_hijo', '1', '', NULL, '13400', 'Site ID (Decidir)', '',1);

INSERT INTO configuracion VALUES(14000, 'avanzada', 'admin_informes', '4', '0', NULL, '14000', 'Informes en el Administrador', '',1);
INSERT INTO configuracion VALUES(15000, 'avanzada', 'inteligencia_artificial', '4', '0', NULL, '15000', 'Habilitar Inteligencia Artificial (AI)', 'Habilita el uso de APIs de Inteligecia Artificial brindando ayuda con los contenidos',0);

INSERT INTO configuracion VALUES(16000, 'avanzada', 'mobbex_apikey', '1', '', NULL, '16000', 'Mobbex - Api Key', '',1);
INSERT INTO configuracion VALUES(16500, 'avanzada', 'mobbex_token', '1', '', NULL, '16500', 'Mobbex - Access Token', '',1);
INSERT INTO configuracion VALUES(16510, 'avanzada', 'mobbex_test', '4', '1', NULL, '16510', 'Mobbex - Test Sandbox', '',1);
INSERT INTO configuracion VALUES(16600, 'avanzada', 'shipnow_token', '1', '', NULL, '16600', 'Shipnow - Token', '',1);

INSERT INTO configuracion VALUES(17000, 'avanzada', 'apagar_precios', '4', '0', NULL, '17000', 'Apagar los precios', '',1);
INSERT INTO configuracion VALUES(18000, 'avanzada', 'admin_logo', '4', '0', NULL, '18000', 'Administrar Logotipo', '',1);
INSERT INTO configuracion VALUES(19000, 'avanzada', 'productos_formato_listado', '4', '0', NULL, '19000','Productos Formato Listado','',1);

CREATE TABLE `elementos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `id_marca` int(10) UNSIGNED DEFAULT NULL,
  `descripcion` longtext,
  `texto` longtext,
  `id_imagen` int(10) UNSIGNED DEFAULT NULL,
  `precio` decimal(16,2) UNSIGNED DEFAULT NULL,
  `id_moneda` int(4) DEFAULT NULL,
  `mapa` longtext,
  `precio1` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio2` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio3` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio4` decimal(16,2) UNSIGNED DEFAULT NULL,
  `precio5` decimal(16,2) UNSIGNED DEFAULT NULL,
  `publicado` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `oferta` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `destacado` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `orden` int(4) DEFAULT NULL,
  `orden_cat` int(4) DEFAULT NULL,
  `impuesto` int(4) DEFAULT NULL,
  `id_rubro` int(10) DEFAULT NULL,
  `id_subrubro` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `empresa` (
  `id_empresa` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `razonsocial` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `horarios` longtext,
  `sobrenosotros` longtext,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `notas` longtext,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `googleplaces` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `enlaces` (
  `id_enlace` int(6) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` longtext,
  `titulo_enlace` varchar(255) DEFAULT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  `orden` int(4) DEFAULT NULL,
  `id_ubicacion` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `estados_pedido` (
  `id_estadopedido` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `editable` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `estados_pedido` VALUES(1, 'Pendiente', 0);
INSERT INTO `estados_pedido` VALUES(2, 'Aceptado', 1);
INSERT INTO `estados_pedido` VALUES(3, 'Entregado', 1);
INSERT INTO `estados_pedido` VALUES(4, 'Rechazado', 1);

CREATE TABLE `estados_presupuesto` (
  `id_estadopresupuesto` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `editable` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `formas_envio` (
  `id_formaenvio` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `precio` decimal(7,2) DEFAULT NULL,
  `solicitardir` int(1) NOT NULL DEFAULT '1',
  `es_retiro` int(1) DEFAULT '0',
  PRIMARY KEY (`id_formaenvio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `formas_envio` (`id_formaenvio`, `nombre`, `precio`, `solicitardir`, `es_retiro`) VALUES (1, 'Retiro en sucursal', 0.00, 0, 0);

CREATE TABLE `galerias` (
  `id_galeria` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `texto` longtext,
  `id_imagen` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `imagenes` (
  `id_imagen` int(10) UNSIGNED NOT NULL,
  `sector` mediumint(8) UNSIGNED NOT NULL,
  `id_elemento` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` longtext,
  `enlace` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `inicio` (
  `id_inicio` int(2) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `bienvenido_titulo` longtext,
  `bienvenido_texto` longtext,
  `bienvenido_enlace` longtext,
  `widget1` varchar(255) DEFAULT NULL,
  `widget2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `listados` (
  `id_listado` int(10) UNSIGNED NOT NULL,
  `controlador` varchar(50) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `id_campobusqueda` int(10) UNSIGNED DEFAULT NULL,
  `id_campoorden` int(10) UNSIGNED DEFAULT NULL,
  `campo_orden_direccion` varchar(4) DEFAULT '',
  `bloqueado` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `localidades` (
  `id_localidad` int(10) NOT NULL,
  `id_provincia` int(10) DEFAULT NULL,
  `id_pais` int(10) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `codpos` varchar(255) DEFAULT NULL,
  `notas` longtext,
  `codigo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `localidades` VALUES(2, 1, 1, 'BUENOS AIRES', '12 DE OCTUBRE', '6501', NULL, NULL);
INSERT INTO `localidades` VALUES(3, 1, 1, 'BUENOS AIRES', '16 DE JULIO', '7313', NULL, NULL);
INSERT INTO `localidades` VALUES(4, 1, 1, 'BUENOS AIRES', '17 DE AGOSTO', '8129', NULL, NULL);
INSERT INTO `localidades` VALUES(5, 1, 1, 'BUENOS AIRES', '25 DE MAYO', '6660', NULL, NULL);
INSERT INTO `localidades` VALUES(6, 1, 1, 'BUENOS AIRES', '30 DE AGOSTO', '6405', NULL, NULL);
INSERT INTO `localidades` VALUES(7, 1, 1, 'BUENOS AIRES', '9 DE ABRIL', '1776', NULL, NULL);
INSERT INTO `localidades` VALUES(8, 1, 1, 'BUENOS AIRES', '9 DE ABRIL (BUE)', '1839', NULL, NULL);
INSERT INTO `localidades` VALUES(9, 1, 1, 'BUENOS AIRES', '9 DE JULIO (BUE)', '6500', NULL, NULL);
INSERT INTO `localidades` VALUES(10, 1, 1, 'BUENOS AIRES', 'ABASTO', '1903', NULL, NULL);
INSERT INTO `localidades` VALUES(11, 1, 1, 'BUENOS AIRES', 'ABBOTT', '7228', NULL, NULL);
INSERT INTO `localidades` VALUES(12, 1, 1, 'BUENOS AIRES', 'ABEL', '6450', NULL, NULL);
INSERT INTO `localidades` VALUES(13, 1, 1, 'BUENOS AIRES', 'ACANTILADOS', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(14, 1, 1, 'BUENOS AIRES', 'ACASSUSO', '1640', NULL, NULL);
INSERT INTO `localidades` VALUES(15, 1, 1, 'BUENOS AIRES', 'ACEVEDO', '2717', NULL, NULL);
INSERT INTO `localidades` VALUES(16, 1, 1, 'BUENOS AIRES', 'ACHUPALLAS', '6627', NULL, NULL);
INSERT INTO `localidades` VALUES(17, 1, 1, 'BUENOS AIRES', 'ACON', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(18, 1, 1, 'BUENOS AIRES', 'ADELA', '7136', NULL, NULL);
INSERT INTO `localidades` VALUES(19, 1, 1, 'BUENOS AIRES', 'ADELA CORTI', '8000', NULL, NULL);
INSERT INTO `localidades` VALUES(20, 1, 1, 'BUENOS AIRES', 'ADOLFO SOURDEAUX', '1612', NULL, NULL);
INSERT INTO `localidades` VALUES(21, 1, 1, 'BUENOS AIRES', 'AEROPUERTO DE EZEIZA', '1802', NULL, NULL);
INSERT INTO `localidades` VALUES(22, 1, 1, 'BUENOS AIRES', 'AGOTE', '6608', NULL, NULL);
INSERT INTO `localidades` VALUES(23, 1, 1, 'BUENOS AIRES', 'AGUAS VERDES', '7112', NULL, NULL);
INSERT INTO `localidades` VALUES(24, 1, 1, 'BUENOS AIRES', 'AGUSTIN MOSCONI', '6667', NULL, NULL);
INSERT INTO `localidades` VALUES(25, 1, 1, 'BUENOS AIRES', 'AGUSTIN ROCA', '6001', NULL, NULL);
INSERT INTO `localidades` VALUES(26, 1, 1, 'BUENOS AIRES', 'AGUSTINA', '6001', NULL, NULL);
INSERT INTO `localidades` VALUES(27, 1, 1, 'BUENOS AIRES', 'ALAGON', '6463', NULL, NULL);
INSERT INTO `localidades` VALUES(28, 1, 1, 'BUENOS AIRES', 'ALAMOS', '6437', NULL, NULL);
INSERT INTO `localidades` VALUES(29, 1, 1, 'BUENOS AIRES', 'ALBARIÑO', '6405', NULL, NULL);
INSERT INTO `localidades` VALUES(30, 1, 1, 'BUENOS AIRES', 'ALBERTI', '6634', NULL, NULL);
INSERT INTO `localidades` VALUES(31, 1, 1, 'BUENOS AIRES', 'ALDO BONZI', '1770', NULL, NULL);
INSERT INTO `localidades` VALUES(32, 1, 1, 'BUENOS AIRES', 'ALEGRE', '1987', NULL, NULL);
INSERT INTO `localidades` VALUES(33, 1, 1, 'BUENOS AIRES', 'ALEJANDRO KORN', '1864', NULL, NULL);
INSERT INTO `localidades` VALUES(34, 1, 1, 'BUENOS AIRES', 'ALEJANDRO PETION', '1808', NULL, NULL);
INSERT INTO `localidades` VALUES(35, 1, 1, 'BUENOS AIRES', 'ALFAR', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(36, 1, 1, 'BUENOS AIRES', 'ALFEREZ SAN MARTIN', '8117', NULL, NULL);
INSERT INTO `localidades` VALUES(37, 1, 1, 'BUENOS AIRES', 'ALGARROBO', '8136', NULL, NULL);
INSERT INTO `localidades` VALUES(38, 1, 1, 'BUENOS AIRES', 'ALMIRANTE BENAVIDEZ', '1621', NULL, NULL);
INSERT INTO `localidades` VALUES(39, 1, 1, 'BUENOS AIRES', 'ALMIRANTE BROWN', '1846', NULL, NULL);
INSERT INTO `localidades` VALUES(40, 1, 1, 'BUENOS AIRES', 'ALMIRANTE SEGUI', '1895', NULL, NULL);
INSERT INTO `localidades` VALUES(41, 1, 1, 'BUENOS AIRES', 'ALSINA', '2938', NULL, NULL);
INSERT INTO `localidades` VALUES(42, 1, 1, 'BUENOS AIRES', 'ALTA VISTA', '8181', NULL, NULL);
INSERT INTO `localidades` VALUES(43, 1, 1, 'BUENOS AIRES', 'ALTAMIRA', '6601', NULL, NULL);
INSERT INTO `localidades` VALUES(44, 1, 1, 'BUENOS AIRES', 'ALTAMIRANO (BUE)', '1986', NULL, NULL);
INSERT INTO `localidades` VALUES(45, 1, 1, 'BUENOS AIRES', 'ALTONA', '7303', NULL, NULL);
INSERT INTO `localidades` VALUES(46, 1, 1, 'BUENOS AIRES', 'ALVAREZ DE TOLEDO', '7267', NULL, NULL);
INSERT INTO `localidades` VALUES(47, 1, 1, 'BUENOS AIRES', 'ALVAREZ JONTE', '1921', NULL, NULL);
INSERT INTO `localidades` VALUES(48, 1, 1, 'BUENOS AIRES', 'ALVARO BARROS', '7403', NULL, NULL);
INSERT INTO `localidades` VALUES(49, 1, 1, 'BUENOS AIRES', 'ALZAGA', '7021', NULL, NULL);
INSERT INTO `localidades` VALUES(50, 1, 1, 'BUENOS AIRES', 'AMALIA', '6516', NULL, NULL);
INSERT INTO `localidades` VALUES(51, 1, 1, 'BUENOS AIRES', 'AMEGHINO', '6064', NULL, NULL);
INSERT INTO `localidades` VALUES(52, 1, 1, 'BUENOS AIRES', 'AMERICA', '6237', NULL, NULL);
INSERT INTO `localidades` VALUES(53, 1, 1, 'BUENOS AIRES', 'ANASAGASTI', '6607', NULL, NULL);
INSERT INTO `localidades` VALUES(54, 1, 1, 'BUENOS AIRES', 'ANDANT', '6555', NULL, NULL);
INSERT INTO `localidades` VALUES(55, 1, 1, 'BUENOS AIRES', 'ANDERSON', '6621', NULL, NULL);
INSERT INTO `localidades` VALUES(56, 1, 1, 'BUENOS AIRES', 'ANTONIO CARBONI', '7243', NULL, NULL);
INSERT INTO `localidades` VALUES(57, 1, 1, 'BUENOS AIRES', 'APARICIO', '7501', NULL, NULL);
INSERT INTO `localidades` VALUES(58, 1, 1, 'BUENOS AIRES', 'ARANA', '1909', NULL, NULL);
INSERT INTO `localidades` VALUES(59, 1, 1, 'BUENOS AIRES', 'ARANO', '6443', NULL, NULL);
INSERT INTO `localidades` VALUES(60, 1, 1, 'BUENOS AIRES', 'ARAUJO', '6643', NULL, NULL);
INSERT INTO `localidades` VALUES(61, 1, 1, 'BUENOS AIRES', 'ARBOLEDAS', '6557', NULL, NULL);
INSERT INTO `localidades` VALUES(62, 1, 1, 'BUENOS AIRES', 'ARENAZA', '6075', NULL, NULL);
INSERT INTO `localidades` VALUES(63, 1, 1, 'BUENOS AIRES', 'ARGERICH', '8134', NULL, NULL);
INSERT INTO `localidades` VALUES(64, 1, 1, 'BUENOS AIRES', 'ARIEL', '7301', NULL, NULL);
INSERT INTO `localidades` VALUES(65, 1, 1, 'BUENOS AIRES', 'ARRECIFES', '2740', NULL, NULL);
INSERT INTO `localidades` VALUES(66, 1, 1, 'BUENOS AIRES', 'ARRIBEÑOS', '6007', NULL, NULL);
INSERT INTO `localidades` VALUES(67, 1, 1, 'BUENOS AIRES', 'ARROYO CARABELITAS', '2805', NULL, NULL);
INSERT INTO `localidades` VALUES(68, 1, 1, 'BUENOS AIRES', 'ARROYO CORTO', '8172', NULL, NULL);
INSERT INTO `localidades` VALUES(69, 1, 1, 'BUENOS AIRES', 'ARROYO DEL  MEDIO', '2715', NULL, NULL);
INSERT INTO `localidades` VALUES(70, 1, 1, 'BUENOS AIRES', 'ARROYO DULCE', '2743', NULL, NULL);
INSERT INTO `localidades` VALUES(71, 1, 1, 'BUENOS AIRES', 'ARROYO VENADO', '6437', NULL, NULL);
INSERT INTO `localidades` VALUES(72, 1, 1, 'BUENOS AIRES', 'ARTURO VATTEONE', '6433', NULL, NULL);
INSERT INTO `localidades` VALUES(73, 1, 1, 'BUENOS AIRES', 'ASAMBLEA', '6640', NULL, NULL);
INSERT INTO `localidades` VALUES(74, 1, 1, 'BUENOS AIRES', 'ASCENCION', '6003', NULL, NULL);
INSERT INTO `localidades` VALUES(75, 1, 1, 'BUENOS AIRES', 'ASTURIAS', '6469', NULL, NULL);
INSERT INTO `localidades` VALUES(76, 1, 1, 'BUENOS AIRES', 'ATALAYA', '1913', NULL, NULL);
INSERT INTO `localidades` VALUES(77, 1, 1, 'BUENOS AIRES', 'ATILIO PESSAGNO', '7116', NULL, NULL);
INSERT INTO `localidades` VALUES(78, 1, 1, 'BUENOS AIRES', 'ATUCHA', '2808', NULL, NULL);
INSERT INTO `localidades` VALUES(79, 1, 1, 'BUENOS AIRES', 'AVELLANEDA (BUE)', '1870', NULL, NULL);
INSERT INTO `localidades` VALUES(80, 1, 1, 'BUENOS AIRES', 'AYACUCHO', '7150', NULL, NULL);
INSERT INTO `localidades` VALUES(81, 1, 1, 'BUENOS AIRES', 'AYERZA', '2700', NULL, NULL);
INSERT INTO `localidades` VALUES(82, 1, 1, 'BUENOS AIRES', 'AZCUENAGA', '6721', NULL, NULL);
INSERT INTO `localidades` VALUES(83, 1, 1, 'BUENOS AIRES', 'AZOPARDO', '8181', NULL, NULL);
INSERT INTO `localidades` VALUES(84, 1, 1, 'BUENOS AIRES', 'AZUCENA', '7005', NULL, NULL);
INSERT INTO `localidades` VALUES(85, 1, 1, 'BUENOS AIRES', 'AZUL', '7300', NULL, NULL);
INSERT INTO `localidades` VALUES(86, 1, 1, 'BUENOS AIRES', 'BACACAY', '6516', NULL, NULL);
INSERT INTO `localidades` VALUES(87, 1, 1, 'BUENOS AIRES', 'BADANO', '6403', NULL, NULL);
INSERT INTO `localidades` VALUES(88, 1, 1, 'BUENOS AIRES', 'BAHIA BLANCA', '8000', NULL, NULL);
INSERT INTO `localidades` VALUES(89, 1, 1, 'BUENOS AIRES', 'BAHIA SAN BLAS', '8506', NULL, NULL);
INSERT INTO `localidades` VALUES(90, 1, 1, 'BUENOS AIRES', 'BAIGORRITA', '6013', NULL, NULL);
INSERT INTO `localidades` VALUES(91, 1, 1, 'BUENOS AIRES', 'BAJO HONDO', '8115', NULL, NULL);
INSERT INTO `localidades` VALUES(92, 1, 1, 'BUENOS AIRES', 'BALCARCE', '7620', NULL, NULL);
INSERT INTO `localidades` VALUES(93, 1, 1, 'BUENOS AIRES', 'BALNEARIO ATLANTIDA', '7607', NULL, NULL);
INSERT INTO `localidades` VALUES(94, 1, 1, 'BUENOS AIRES', 'BALNEARIO CAMET NORTE', '7607', NULL, NULL);
INSERT INTO `localidades` VALUES(95, 1, 1, 'BUENOS AIRES', 'BALNEARIO CHAPALCO', '8132', NULL, NULL);
INSERT INTO `localidades` VALUES(96, 1, 1, 'BUENOS AIRES', 'BALNEARIO CLAROMECO', '7505', NULL, NULL);
INSERT INTO `localidades` VALUES(97, 1, 1, 'BUENOS AIRES', 'BALNEARIO COSTA BONITA', '7631', NULL, NULL);
INSERT INTO `localidades` VALUES(98, 1, 1, 'BUENOS AIRES', 'BALNEARIO FRENTE MAR', '7607', NULL, NULL);
INSERT INTO `localidades` VALUES(99, 1, 1, 'BUENOS AIRES', 'BALNEARIO LA BALIZA', '7607', NULL, NULL);
INSERT INTO `localidades` VALUES(100, 1, 1, 'BUENOS AIRES', 'BALNEARIO LA CALETA', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(101, 1, 1, 'BUENOS AIRES', 'BALNEARIO LOS ANGELES', '7641', NULL, NULL);
INSERT INTO `localidades` VALUES(102, 1, 1, 'BUENOS AIRES', 'BALNEARIO MAR CHIQUITA', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(103, 1, 1, 'BUENOS AIRES', 'BALNEARIO MAR DE COBO', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(104, 1, 1, 'BUENOS AIRES', 'BALNEARIO OCEANO', '7511', NULL, NULL);
INSERT INTO `localidades` VALUES(105, 1, 1, 'BUENOS AIRES', 'BALNEARIO ORENSE', '7511', NULL, NULL);
INSERT INTO `localidades` VALUES(106, 1, 1, 'BUENOS AIRES', 'BALNEARIO ORIENTE', '8153', NULL, NULL);
INSERT INTO `localidades` VALUES(107, 1, 1, 'BUENOS AIRES', 'BALNEARIO PARADA', '8109', NULL, NULL);
INSERT INTO `localidades` VALUES(108, 1, 1, 'BUENOS AIRES', 'BALNEARIO PLAYA DORADA', '7607', NULL, NULL);
INSERT INTO `localidades` VALUES(109, 1, 1, 'BUENOS AIRES', 'BALNEARIO SAN ANTONIO', '8132', NULL, NULL);
INSERT INTO `localidades` VALUES(110, 1, 1, 'BUENOS AIRES', 'BALNEARIO SAN CAYETANO', '7521', NULL, NULL);
INSERT INTO `localidades` VALUES(111, 1, 1, 'BUENOS AIRES', 'BALNEARIO SANTA ELENA', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(112, 1, 1, 'BUENOS AIRES', 'BALNEARIO SAUCE GRANDE', '8153', NULL, NULL);
INSERT INTO `localidades` VALUES(113, 1, 1, 'BUENOS AIRES', 'BALSA', '6070', NULL, NULL);
INSERT INTO `localidades` VALUES(114, 1, 1, 'BUENOS AIRES', 'BANCALARI', '1617', NULL, NULL);
INSERT INTO `localidades` VALUES(115, 1, 1, 'BUENOS AIRES', 'BANDERALO', '6244', NULL, NULL);
INSERT INTO `localidades` VALUES(116, 1, 1, 'BUENOS AIRES', 'BANFIELD', '1828', NULL, NULL);
INSERT INTO `localidades` VALUES(117, 1, 1, 'BUENOS AIRES', 'BARADERO', '2942', NULL, NULL);
INSERT INTO `localidades` VALUES(118, 1, 1, 'BUENOS AIRES', 'BARKER', '7005', NULL, NULL);
INSERT INTO `localidades` VALUES(119, 1, 1, 'BUENOS AIRES', 'BARRIO 1 DE MAYO', '1814', NULL, NULL);
INSERT INTO `localidades` VALUES(120, 1, 1, 'BUENOS AIRES', 'BARRIO PARQUE SICARDI', '1900', NULL, NULL);
INSERT INTO `localidades` VALUES(121, 1, 1, 'BUENOS AIRES', 'BARROW', '7519', NULL, NULL);
INSERT INTO `localidades` VALUES(122, 1, 1, 'BUENOS AIRES', 'BARTOLOME BAVIO', '1911', NULL, NULL);
INSERT INTO `localidades` VALUES(123, 1, 1, 'BUENOS AIRES', 'BASE AERONAVAL COMANDANTE ESPORA', '8107', NULL, NULL);
INSERT INTO `localidades` VALUES(124, 1, 1, 'BUENOS AIRES', 'BATAN', '7605', NULL, NULL);
INSERT INTO `localidades` VALUES(125, 1, 1, 'BUENOS AIRES', 'BATERIAS', '8111', NULL, NULL);
INSERT INTO `localidades` VALUES(126, 1, 1, 'BUENOS AIRES', 'BATHURST', '7540', NULL, NULL);
INSERT INTO `localidades` VALUES(127, 1, 1, 'BUENOS AIRES', 'BAUDRIX', '6643', NULL, NULL);
INSERT INTO `localidades` VALUES(128, 1, 1, 'BUENOS AIRES', 'BAYAUCA', '6078', NULL, NULL);
INSERT INTO `localidades` VALUES(129, 1, 1, 'BUENOS AIRES', 'BECCAR', '1643', NULL, NULL);
INSERT INTO `localidades` VALUES(130, 1, 1, 'BUENOS AIRES', 'BELEN DE ESCOBAR', '1625', NULL, NULL);
INSERT INTO `localidades` VALUES(131, 1, 1, 'BUENOS AIRES', 'BELLA VISTA (BUE)', '1661', NULL, NULL);
INSERT INTO `localidades` VALUES(132, 1, 1, 'BUENOS AIRES', 'BELLOCQ', '6535', NULL, NULL);
INSERT INTO `localidades` VALUES(133, 1, 1, 'BUENOS AIRES', 'BENAVIDEZ', '1621', NULL, NULL);
INSERT INTO `localidades` VALUES(134, 1, 1, 'BUENOS AIRES', 'BENITEZ', '6632', NULL, NULL);
INSERT INTO `localidades` VALUES(135, 1, 1, 'BUENOS AIRES', 'BENITO JUAREZ', '7020', NULL, NULL);
INSERT INTO `localidades` VALUES(136, 1, 1, 'BUENOS AIRES', 'BERAZATEGUI', '1884', NULL, NULL);
INSERT INTO `localidades` VALUES(137, 1, 1, 'BUENOS AIRES', 'BERDIER', '2743', NULL, NULL);
INSERT INTO `localidades` VALUES(138, 1, 1, 'BUENOS AIRES', 'BERISSO', '1923', NULL, NULL);
INSERT INTO `localidades` VALUES(139, 1, 1, 'BUENOS AIRES', 'BERMUDEZ', '6071', NULL, NULL);
INSERT INTO `localidades` VALUES(140, 1, 1, 'BUENOS AIRES', 'BERNAL', '1876', NULL, NULL);
INSERT INTO `localidades` VALUES(141, 1, 1, 'BUENOS AIRES', 'BERRAONDO', '8124', NULL, NULL);
INSERT INTO `localidades` VALUES(142, 1, 1, 'BUENOS AIRES', 'BERUTTI', '6424', NULL, NULL);
INSERT INTO `localidades` VALUES(143, 1, 1, 'BUENOS AIRES', 'BIAUS', '6627', NULL, NULL);
INSERT INTO `localidades` VALUES(144, 1, 1, 'BUENOS AIRES', 'BLANCA GRANDE', '6561', NULL, NULL);
INSERT INTO `localidades` VALUES(145, 1, 1, 'BUENOS AIRES', 'BLANDENGUES', '6032', NULL, NULL);
INSERT INTO `localidades` VALUES(146, 1, 1, 'BUENOS AIRES', 'BLAQUIER', '6065', NULL, NULL);
INSERT INTO `localidades` VALUES(147, 1, 1, 'BUENOS AIRES', 'BLAS DURAÑONA', '6661', NULL, NULL);
INSERT INTO `localidades` VALUES(148, 1, 1, 'BUENOS AIRES', 'BOCAYUVA', '6348', NULL, NULL);
INSERT INTO `localidades` VALUES(149, 1, 1, 'BUENOS AIRES', 'BOLIVAR', '6550', NULL, NULL);
INSERT INTO `localidades` VALUES(150, 1, 1, 'BUENOS AIRES', 'BONIFACIO-LAG.ALSINA', '6439', NULL, NULL);
INSERT INTO `localidades` VALUES(151, 1, 1, 'BUENOS AIRES', 'BORDENAVE', '8187', NULL, NULL);
INSERT INTO `localidades` VALUES(152, 1, 1, 'BUENOS AIRES', 'BOSCH', '7620', NULL, NULL);
INSERT INTO `localidades` VALUES(153, 1, 1, 'BUENOS AIRES', 'BOSQUE PERALTA RAMOS- MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(154, 1, 1, 'BUENOS AIRES', 'BOSQUES', '1889', NULL, NULL);
INSERT INTO `localidades` VALUES(155, 1, 1, 'BUENOS AIRES', 'BOULOGNE', '1609', NULL, NULL);
INSERT INTO `localidades` VALUES(156, 1, 1, 'BUENOS AIRES', 'BRAGADO', '6640', NULL, NULL);
INSERT INTO `localidades` VALUES(157, 1, 1, 'BUENOS AIRES', 'BURZACO', '1852', NULL, NULL);
INSERT INTO `localidades` VALUES(158, 1, 1, 'BUENOS AIRES', 'Bº 2 DE ABRIL - MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(159, 1, 1, 'BUENOS AIRES', 'Bº AEROPARQUE KM 398- MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(160, 1, 1, 'BUENOS AIRES', 'Bº CAMET NORTE - MAR DEL PLATA', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(161, 1, 1, 'BUENOS AIRES', 'Bº CASTAGNINO - MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(162, 1, 1, 'BUENOS AIRES', 'Bº COSTA ATLANTICA - MAR DEL PLATA', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(163, 1, 1, 'BUENOS AIRES', 'Bº EL SOSIEGO - MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(164, 1, 1, 'BUENOS AIRES', 'Bº EL ZORZAL - MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(165, 1, 1, 'BUENOS AIRES', 'Bº LA ARMONIA KM 380- MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(166, 1, 1, 'BUENOS AIRES', 'Bº LAS MARGARITAS - MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(167, 1, 1, 'BUENOS AIRES', 'CABILDO', '8118', NULL, NULL);
INSERT INTO `localidades` VALUES(168, 1, 1, 'BUENOS AIRES', 'CACHARI', '7214', NULL, NULL);
INSERT INTO `localidades` VALUES(169, 1, 1, 'BUENOS AIRES', 'CADRET', '6535', NULL, NULL);
INSERT INTO `localidades` VALUES(170, 1, 1, 'BUENOS AIRES', 'CALDERON', '8101', NULL, NULL);
INSERT INTO `localidades` VALUES(171, 1, 1, 'BUENOS AIRES', 'CALFUCURA', '7613', NULL, NULL);
INSERT INTO `localidades` VALUES(172, 1, 1, 'BUENOS AIRES', 'CALVO', '8154', NULL, NULL);
INSERT INTO `localidades` VALUES(173, 1, 1, 'BUENOS AIRES', 'CAMBACERES', '6516', NULL, NULL);
INSERT INTO `localidades` VALUES(174, 1, 1, 'BUENOS AIRES', 'CAMET', '7612', NULL, NULL);
INSERT INTO `localidades` VALUES(175, 1, 1, 'BUENOS AIRES', 'CAMPANA', '2804', NULL, NULL);
INSERT INTO `localidades` VALUES(176, 1, 1, 'BUENOS AIRES', 'CAMPO DE MAYO', '1659', NULL, NULL);
INSERT INTO `localidades` VALUES(177, 1, 1, 'BUENOS AIRES', 'CAMPO DEL NORTE AMERICANO', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(178, 1, 1, 'BUENOS AIRES', 'CAMPO LA ELISA', '2752', NULL, NULL);
INSERT INTO `localidades` VALUES(179, 1, 1, 'BUENOS AIRES', 'CAMPO SAN JUAN', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(180, 1, 1, 'BUENOS AIRES', 'CAMPODONICO', '7305', NULL, NULL);
INSERT INTO `localidades` VALUES(181, 1, 1, 'BUENOS AIRES', 'CAMPOS SALLES', '2903', NULL, NULL);
INSERT INTO `localidades` VALUES(182, 1, 1, 'BUENOS AIRES', 'CANGALLO', '7153', NULL, NULL);
INSERT INTO `localidades` VALUES(183, 1, 1, 'BUENOS AIRES', 'CANNING', '1804', NULL, NULL);
INSERT INTO `localidades` VALUES(184, 1, 1, 'BUENOS AIRES', 'CANONIGO GORRITI', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(185, 1, 1, 'BUENOS AIRES', 'CANTERA LA FEDERACION', '7000', NULL, NULL);
INSERT INTO `localidades` VALUES(186, 1, 1, 'BUENOS AIRES', 'CAPILLA DEL SEÑOR', '2812', NULL, NULL);
INSERT INTO `localidades` VALUES(187, 1, 1, 'BUENOS AIRES', 'CAPITAN CASTRO', '6461', NULL, NULL);
INSERT INTO `localidades` VALUES(188, 1, 1, 'BUENOS AIRES', 'CAPITAN SARMIENTO', '2752', NULL, NULL);
INSERT INTO `localidades` VALUES(189, 1, 1, 'BUENOS AIRES', 'CARABELAS', '2703', NULL, NULL);
INSERT INTO `localidades` VALUES(190, 1, 1, 'BUENOS AIRES', 'CARAPACHAY', '1605', NULL, NULL);
INSERT INTO `localidades` VALUES(191, 1, 1, 'BUENOS AIRES', 'CARDALES', '2814', NULL, NULL);
INSERT INTO `localidades` VALUES(192, 1, 1, 'BUENOS AIRES', 'CARDENAL PAGLIERO', '8506', NULL, NULL);
INSERT INTO `localidades` VALUES(193, 1, 1, 'BUENOS AIRES', 'CARHUE', '6430', NULL, NULL);
INSERT INTO `localidades` VALUES(194, 1, 1, 'BUENOS AIRES', 'CARILO', '7166', NULL, NULL);
INSERT INTO `localidades` VALUES(195, 1, 1, 'BUENOS AIRES', 'CARLOS BEGUERIE', '7247', NULL, NULL);
INSERT INTO `localidades` VALUES(196, 1, 1, 'BUENOS AIRES', 'CARLOS CASARES', '6530', NULL, NULL);
INSERT INTO `localidades` VALUES(197, 1, 1, 'BUENOS AIRES', 'CARLOS KEEN', '6701', NULL, NULL);
INSERT INTO `localidades` VALUES(198, 1, 1, 'BUENOS AIRES', 'CARLOS MARIA NAON', '6515', NULL, NULL);
INSERT INTO `localidades` VALUES(199, 1, 1, 'BUENOS AIRES', 'CARLOS SALAS', '6453', NULL, NULL);
INSERT INTO `localidades` VALUES(200, 1, 1, 'BUENOS AIRES', 'CARLOS TEJEDOR', '6455', NULL, NULL);
INSERT INTO `localidades` VALUES(201, 1, 1, 'BUENOS AIRES', 'CARMEN DE ARECO', '6725', NULL, NULL);
INSERT INTO `localidades` VALUES(202, 1, 1, 'BUENOS AIRES', 'CARMEN DE PATAGONES', '8504', NULL, NULL);
INSERT INTO `localidades` VALUES(203, 1, 1, 'BUENOS AIRES', 'CASALINS', '7225', NULL, NULL);
INSERT INTO `localidades` VALUES(204, 1, 1, 'BUENOS AIRES', 'CASBAS', '6417', NULL, NULL);
INSERT INTO `localidades` VALUES(205, 1, 1, 'BUENOS AIRES', 'CASCADA', '7547', NULL, NULL);
INSERT INTO `localidades` VALUES(206, 1, 1, 'BUENOS AIRES', 'CASEROS (BUE)', '1678', NULL, NULL);
INSERT INTO `localidades` VALUES(207, 1, 1, 'BUENOS AIRES', 'CASEY', '6417', NULL, NULL);
INSERT INTO `localidades` VALUES(208, 1, 1, 'BUENOS AIRES', 'CASTELAR', '1712', NULL, NULL);
INSERT INTO `localidades` VALUES(209, 1, 1, 'BUENOS AIRES', 'CASTELLI', '7114', NULL, NULL);
INSERT INTO `localidades` VALUES(210, 1, 1, 'BUENOS AIRES', 'CASTILLA', '6616', NULL, NULL);
INSERT INTO `localidades` VALUES(211, 1, 1, 'BUENOS AIRES', 'CAZON', '7265', NULL, NULL);
INSERT INTO `localidades` VALUES(212, 1, 1, 'BUENOS AIRES', 'CAÑADA SECA (BUE)', '6105', NULL, NULL);
INSERT INTO `localidades` VALUES(213, 1, 1, 'BUENOS AIRES', 'CAÑUELAS', '1814', NULL, NULL);
INSERT INTO `localidades` VALUES(214, 1, 1, 'BUENOS AIRES', 'CENTENARIO (BUE)', '6535', NULL, NULL);
INSERT INTO `localidades` VALUES(215, 1, 1, 'BUENOS AIRES', 'CENTINELA DEL MAR', '7607', NULL, NULL);
INSERT INTO `localidades` VALUES(216, 1, 1, 'BUENOS AIRES', 'CENTRO AGRICOLA EL PATO', '1893', NULL, NULL);
INSERT INTO `localidades` VALUES(217, 1, 1, 'BUENOS AIRES', 'CENTRO ATOMICO EZEIZA', '1802', NULL, NULL);
INSERT INTO `localidades` VALUES(218, 1, 1, 'BUENOS AIRES', 'CERRITO (BUE)', '6237', NULL, NULL);
INSERT INTO `localidades` VALUES(219, 1, 1, 'BUENOS AIRES', 'CERRO DE LA GLORIA', '7101', NULL, NULL);
INSERT INTO `localidades` VALUES(220, 1, 1, 'BUENOS AIRES', 'CERRO LEONES', '7001', NULL, NULL);
INSERT INTO `localidades` VALUES(221, 1, 1, 'BUENOS AIRES', 'CHACABUCO', '6740', NULL, NULL);
INSERT INTO `localidades` VALUES(222, 1, 1, 'BUENOS AIRES', 'CHANCAY', '6017', NULL, NULL);
INSERT INTO `localidades` VALUES(223, 1, 1, 'BUENOS AIRES', 'CHAPADMALAL', '7605', NULL, NULL);
INSERT INTO `localidades` VALUES(224, 1, 1, 'BUENOS AIRES', 'CHAPALEOFU', '7203', NULL, NULL);
INSERT INTO `localidades` VALUES(225, 1, 1, 'BUENOS AIRES', 'CHAPAR', '7020', NULL, NULL);
INSERT INTO `localidades` VALUES(226, 1, 1, 'BUENOS AIRES', 'CHAS', '7223', NULL, NULL);
INSERT INTO `localidades` VALUES(227, 1, 1, 'BUENOS AIRES', 'CHASCOMUS', '7130', NULL, NULL);
INSERT INTO `localidades` VALUES(228, 1, 1, 'BUENOS AIRES', 'CHASICO', '8117', NULL, NULL);
INSERT INTO `localidades` VALUES(229, 1, 1, 'BUENOS AIRES', 'CHENAUT', '2764', NULL, NULL);
INSERT INTO `localidades` VALUES(230, 1, 1, 'BUENOS AIRES', 'CHICLANA', '6476', NULL, NULL);
INSERT INTO `localidades` VALUES(231, 1, 1, 'BUENOS AIRES', 'CHILLAR', '7311', NULL, NULL);
INSERT INTO `localidades` VALUES(232, 1, 1, 'BUENOS AIRES', 'CHIVILCOY (BUE)', '6620', NULL, NULL);
INSERT INTO `localidades` VALUES(233, 1, 1, 'BUENOS AIRES', 'CHOIQUE', '8117', NULL, NULL);
INSERT INTO `localidades` VALUES(234, 1, 1, 'BUENOS AIRES', 'CITY BELL', '1896', NULL, NULL);
INSERT INTO `localidades` VALUES(235, 1, 1, 'BUENOS AIRES', 'CIUDAD EVITA', '1778', NULL, NULL);
INSERT INTO `localidades` VALUES(236, 1, 1, 'BUENOS AIRES', 'CIUDADELA', '1702', NULL, NULL);
INSERT INTO `localidades` VALUES(237, 1, 1, 'BUENOS AIRES', 'CLARAZ', '7005', NULL, NULL);
INSERT INTO `localidades` VALUES(238, 1, 1, 'BUENOS AIRES', 'CLAROMECO', '7505', NULL, NULL);
INSERT INTO `localidades` VALUES(239, 1, 1, 'BUENOS AIRES', 'CLAUDIO MOLINA', '7515', NULL, NULL);
INSERT INTO `localidades` VALUES(240, 1, 1, 'BUENOS AIRES', 'CLAYPOLE', '1849', NULL, NULL);
INSERT INTO `localidades` VALUES(241, 1, 1, 'BUENOS AIRES', 'CNEL. MARTINEZ DE HOZ', '6533', NULL, NULL);
INSERT INTO `localidades` VALUES(242, 1, 1, 'BUENOS AIRES', 'CNEL. RODOLFO BUNGE', '7020', NULL, NULL);
INSERT INTO `localidades` VALUES(243, 1, 1, 'BUENOS AIRES', 'COBO', '7612', NULL, NULL);
INSERT INTO `localidades` VALUES(244, 1, 1, 'BUENOS AIRES', 'COCHRANE', '8118', NULL, NULL);
INSERT INTO `localidades` VALUES(245, 1, 1, 'BUENOS AIRES', 'COLIQUEO', '6743', NULL, NULL);
INSERT INTO `localidades` VALUES(246, 1, 1, 'BUENOS AIRES', 'COLON (BUE)', '2720', NULL, NULL);
INSERT INTO `localidades` VALUES(247, 1, 1, 'BUENOS AIRES', 'COLONIA 43 (CUARENTA Y TRES)', '8136', NULL, NULL);
INSERT INTO `localidades` VALUES(248, 1, 1, 'BUENOS AIRES', 'COLONIA ALBERDI', '6034', NULL, NULL);
INSERT INTO `localidades` VALUES(249, 1, 1, 'BUENOS AIRES', 'COLONIA BARGA', '8142', NULL, NULL);
INSERT INTO `localidades` VALUES(250, 1, 1, 'BUENOS AIRES', 'COLONIA BARON HIRSCH', '6441', NULL, NULL);
INSERT INTO `localidades` VALUES(251, 1, 1, 'BUENOS AIRES', 'COLONIA BEETHOVEN', '1921', NULL, NULL);
INSERT INTO `localidades` VALUES(252, 1, 1, 'BUENOS AIRES', 'COLONIA BELLA VISTA', '8000', NULL, NULL);
INSERT INTO `localidades` VALUES(253, 1, 1, 'BUENOS AIRES', 'COLONIA DE VACACIONES CHAPADMALAL', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(254, 1, 1, 'BUENOS AIRES', 'COLONIA EL BALDE', '6403', NULL, NULL);
INSERT INTO `localidades` VALUES(255, 1, 1, 'BUENOS AIRES', 'COLONIA EL GUANACO', '8142', NULL, NULL);
INSERT INTO `localidades` VALUES(256, 1, 1, 'BUENOS AIRES', 'COLONIA EL PINCEN', '8181', NULL, NULL);
INSERT INTO `localidades` VALUES(257, 1, 1, 'BUENOS AIRES', 'COLONIA ESCUELA ARGENTINA', '7136', NULL, NULL);
INSERT INTO `localidades` VALUES(258, 1, 1, 'BUENOS AIRES', 'COLONIA FERRARI', '7172', NULL, NULL);
INSERT INTO `localidades` VALUES(259, 1, 1, 'BUENOS AIRES', 'COLONIA GOBERNDOR UDAONDO', '8180', NULL, NULL);
INSERT INTO `localidades` VALUES(260, 1, 1, 'BUENOS AIRES', 'COLONIA HINOJO', '7318', NULL, NULL);
INSERT INTO `localidades` VALUES(261, 1, 1, 'BUENOS AIRES', 'COLONIA HIPOLITO IRIGOYEN', '8181', NULL, NULL);
INSERT INTO `localidades` VALUES(262, 1, 1, 'BUENOS AIRES', 'COLONIA HOGAR R GUTIERREZ', '1727', NULL, NULL);
INSERT INTO `localidades` VALUES(263, 1, 1, 'BUENOS AIRES', 'COLONIA INCHAUSTI', '6667', NULL, NULL);
INSERT INTO `localidades` VALUES(264, 1, 1, 'BUENOS AIRES', 'COLONIA LA BEBA', '6003', NULL, NULL);
INSERT INTO `localidades` VALUES(265, 1, 1, 'BUENOS AIRES', 'COLONIA LA CATALINA', '8136', NULL, NULL);
INSERT INTO `localidades` VALUES(266, 1, 1, 'BUENOS AIRES', 'COLONIA LA CELINA', '8508', NULL, NULL);
INSERT INTO `localidades` VALUES(267, 1, 1, 'BUENOS AIRES', 'COLONIA LA ESPERANZA', '6531', NULL, NULL);
INSERT INTO `localidades` VALUES(268, 1, 1, 'BUENOS AIRES', 'COLONIA LA ESTRELLA', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(269, 1, 1, 'BUENOS AIRES', 'COLONIA LA GRACIELA', '8142', NULL, NULL);
INSERT INTO `localidades` VALUES(270, 1, 1, 'BUENOS AIRES', 'COLONIA LA INVERNADA', '2751', NULL, NULL);
INSERT INTO `localidades` VALUES(271, 1, 1, 'BUENOS AIRES', 'COLONIA LA MERCED', '8105', NULL, NULL);
INSERT INTO `localidades` VALUES(272, 1, 1, 'BUENOS AIRES', 'COLONIA LA NENA', '2751', NULL, NULL);
INSERT INTO `localidades` VALUES(273, 1, 1, 'BUENOS AIRES', 'COLONIA LA NORIA', '2751', NULL, NULL);
INSERT INTO `localidades` VALUES(274, 1, 1, 'BUENOS AIRES', 'COLONIA LA REINA', '2751', NULL, NULL);
INSERT INTO `localidades` VALUES(275, 1, 1, 'BUENOS AIRES', 'COLONIA LA VANGUARDIA', '2711', NULL, NULL);
INSERT INTO `localidades` VALUES(276, 1, 1, 'BUENOS AIRES', 'COLONIA LA VASCONGADA', '8183', NULL, NULL);
INSERT INTO `localidades` VALUES(277, 1, 1, 'BUENOS AIRES', 'COLONIA LABORDEROY', '2751', NULL, NULL);
INSERT INTO `localidades` VALUES(278, 1, 1, 'BUENOS AIRES', 'COLONIA LAPIN', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(279, 1, 1, 'BUENOS AIRES', 'COLONIA LAS YESCAS', '6513', NULL, NULL);
INSERT INTO `localidades` VALUES(280, 1, 1, 'BUENOS AIRES', 'COLONIA LEVEN', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(281, 1, 1, 'BUENOS AIRES', 'COLONIA LOS ALAMOS', '8142', NULL, NULL);
INSERT INTO `localidades` VALUES(282, 1, 1, 'BUENOS AIRES', 'COLONIA LOS ALFALFARES', '8132', NULL, NULL);
INSERT INTO `localidades` VALUES(283, 1, 1, 'BUENOS AIRES', 'COLONIA LOS BOSQUES', '6018', NULL, NULL);
INSERT INTO `localidades` VALUES(284, 1, 1, 'BUENOS AIRES', 'COLONIA LOS HORNOS', '6007', NULL, NULL);
INSERT INTO `localidades` VALUES(285, 1, 1, 'BUENOS AIRES', 'COLONIA LOS HUESOS', '6018', NULL, NULL);
INSERT INTO `localidades` VALUES(286, 1, 1, 'BUENOS AIRES', 'COLONIA LOS TOLDOS', '2751', NULL, NULL);
INSERT INTO `localidades` VALUES(287, 1, 1, 'BUENOS AIRES', 'COLONIA LOS TRES USARIS', '2760', NULL, NULL);
INSERT INTO `localidades` VALUES(288, 1, 1, 'BUENOS AIRES', 'COLONIA MAURICIO HIRSCH', '6531', NULL, NULL);
INSERT INTO `localidades` VALUES(289, 1, 1, 'BUENOS AIRES', 'COLONIA MIGUEL ESTEVERENA', '8508', NULL, NULL);
INSERT INTO `localidades` VALUES(290, 1, 1, 'BUENOS AIRES', 'COLONIA MONTE LA PLATA', '8144', NULL, NULL);
INSERT INTO `localidades` VALUES(291, 1, 1, 'BUENOS AIRES', 'COLONIA MURATURE', '6341', NULL, NULL);
INSERT INTO `localidades` VALUES(292, 1, 1, 'BUENOS AIRES', 'COLONIA NAC DE ALIENADOS', '6708', NULL, NULL);
INSERT INTO `localidades` VALUES(293, 1, 1, 'BUENOS AIRES', 'COLONIA NACIONAL DE MENORES', '1727', NULL, NULL);
INSERT INTO `localidades` VALUES(294, 1, 1, 'BUENOS AIRES', 'COLONIA NAVIERA', '6341', NULL, NULL);
INSERT INTO `localidades` VALUES(295, 1, 1, 'BUENOS AIRES', 'COLONIA NIEVES', '7318', NULL, NULL);
INSERT INTO `localidades` VALUES(296, 1, 1, 'BUENOS AIRES', 'COLONIA OCAMPO', '8134', NULL, NULL);
INSERT INTO `localidades` VALUES(297, 1, 1, 'BUENOS AIRES', 'COLONIA PALANTELEN', '6643', NULL, NULL);
INSERT INTO `localidades` VALUES(298, 1, 1, 'BUENOS AIRES', 'COLONIA PHILLIPSON N 1', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(299, 1, 1, 'BUENOS AIRES', 'COLONIA PUEBLO RUSO', '8144', NULL, NULL);
INSERT INTO `localidades` VALUES(300, 1, 1, 'BUENOS AIRES', 'COLONIA RUSA', '7318', NULL, NULL);
INSERT INTO `localidades` VALUES(301, 1, 1, 'BUENOS AIRES', 'COLONIA SAN EDUARDO', '6646', NULL, NULL);
INSERT INTO `localidades` VALUES(302, 1, 1, 'BUENOS AIRES', 'COLONIA SAN ENRIQUE', '8132', NULL, NULL);
INSERT INTO `localidades` VALUES(303, 1, 1, 'BUENOS AIRES', 'COLONIA SAN FRANCISCO -GRAL VIAMONT', '6017', NULL, NULL);
INSERT INTO `localidades` VALUES(304, 1, 1, 'BUENOS AIRES', 'COLONIA SAN FRANCISCO -PDO PATAGONE', '8142', NULL, NULL);
INSERT INTO `localidades` VALUES(305, 1, 1, 'BUENOS AIRES', 'COLONIA SAN MARTIN', '8164', NULL, NULL);
INSERT INTO `localidades` VALUES(306, 1, 1, 'BUENOS AIRES', 'COLONIA SAN MIGUEL', '7403', NULL, NULL);
INSERT INTO `localidades` VALUES(307, 1, 1, 'BUENOS AIRES', 'COLONIA SAN MIGUEL ARCANGEL', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(308, 1, 1, 'BUENOS AIRES', 'COLONIA SAN PEDRO', '8164', NULL, NULL);
INSERT INTO `localidades` VALUES(309, 1, 1, 'BUENOS AIRES', 'COLONIA SAN RAMON', '6437', NULL, NULL);
INSERT INTO `localidades` VALUES(310, 1, 1, 'BUENOS AIRES', 'COLONIA SANTA MARIA', '6535', NULL, NULL);
INSERT INTO `localidades` VALUES(311, 1, 1, 'BUENOS AIRES', 'COLONIA SANTA MARIANA', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(312, 1, 1, 'BUENOS AIRES', 'COLONIA SANTA ROSA', '1816', NULL, NULL);
INSERT INTO `localidades` VALUES(313, 1, 1, 'BUENOS AIRES', 'COLONIA SANTA ROSA (ALTA VISTA, PUA', '8181', NULL, NULL);
INSERT INTO `localidades` VALUES(314, 1, 1, 'BUENOS AIRES', 'COLONIA SERE', '6459', NULL, NULL);
INSERT INTO `localidades` VALUES(315, 1, 1, 'BUENOS AIRES', 'COLONIA STEGMAN', '2751', NULL, NULL);
INSERT INTO `localidades` VALUES(316, 1, 1, 'BUENOS AIRES', 'COLONIA TAPATTA', '8142', NULL, NULL);
INSERT INTO `localidades` VALUES(317, 1, 1, 'BUENOS AIRES', 'COLONIA VELAZ', '2915', NULL, NULL);
INSERT INTO `localidades` VALUES(318, 1, 1, 'BUENOS AIRES', 'COLONIA VELEZ', '2933', NULL, NULL);
INSERT INTO `localidades` VALUES(319, 1, 1, 'BUENOS AIRES', 'COLONIA ZAMBUNGO', '6628', NULL, NULL);
INSERT INTO `localidades` VALUES(320, 1, 1, 'BUENOS AIRES', 'COMANDANTE ESPORA', '8107', NULL, NULL);
INSERT INTO `localidades` VALUES(321, 1, 1, 'BUENOS AIRES', 'COMANDANTE GIRIBONE', '7135', NULL, NULL);
INSERT INTO `localidades` VALUES(322, 1, 1, 'BUENOS AIRES', 'COMANDANTE OTAMENDI', '7603', NULL, NULL);
INSERT INTO `localidades` VALUES(323, 1, 1, 'BUENOS AIRES', 'COMODORO PY', '6641', NULL, NULL);
INSERT INTO `localidades` VALUES(324, 1, 1, 'BUENOS AIRES', 'CONDARCO', '6233', NULL, NULL);
INSERT INTO `localidades` VALUES(325, 1, 1, 'BUENOS AIRES', 'CONESA', '2907', NULL, NULL);
INSERT INTO `localidades` VALUES(326, 1, 1, 'BUENOS AIRES', 'COPETONAS', '7511', NULL, NULL);
INSERT INTO `localidades` VALUES(327, 1, 1, 'BUENOS AIRES', 'CORACEROS', '6465', NULL, NULL);
INSERT INTO `localidades` VALUES(328, 1, 1, 'BUENOS AIRES', 'CORAZZI', '6405', NULL, NULL);
INSERT INTO `localidades` VALUES(329, 1, 1, 'BUENOS AIRES', 'CORBETT', '6507', NULL, NULL);
INSERT INTO `localidades` VALUES(330, 1, 1, 'BUENOS AIRES', 'CORONEL BOERR', '7208', NULL, NULL);
INSERT INTO `localidades` VALUES(331, 1, 1, 'BUENOS AIRES', 'CORONEL BRANDSEN', '1980', NULL, NULL);
INSERT INTO `localidades` VALUES(332, 1, 1, 'BUENOS AIRES', 'CORONEL CHARLONE', '6223', NULL, NULL);
INSERT INTO `localidades` VALUES(333, 1, 1, 'BUENOS AIRES', 'CORONEL DORREGO BUE', '8150', NULL, NULL);
INSERT INTO `localidades` VALUES(334, 1, 1, 'BUENOS AIRES', 'CORONEL FALCON', '8118', NULL, NULL);
INSERT INTO `localidades` VALUES(335, 1, 1, 'BUENOS AIRES', 'CORONEL GRANADA', '6062', NULL, NULL);
INSERT INTO `localidades` VALUES(336, 1, 1, 'BUENOS AIRES', 'CORONEL ISLEÑOS', '2747', NULL, NULL);
INSERT INTO `localidades` VALUES(337, 1, 1, 'BUENOS AIRES', 'CORONEL MARCELINO FREYRE', '6555', NULL, NULL);
INSERT INTO `localidades` VALUES(338, 1, 1, 'BUENOS AIRES', 'CORONEL MON', '6628', NULL, NULL);
INSERT INTO `localidades` VALUES(339, 1, 1, 'BUENOS AIRES', 'CORONEL PRINGLES', '7530', NULL, NULL);
INSERT INTO `localidades` VALUES(340, 1, 1, 'BUENOS AIRES', 'CORONEL SEGUI', '6628', NULL, NULL);
INSERT INTO `localidades` VALUES(341, 1, 1, 'BUENOS AIRES', 'CORONEL SUAREZ', '7540', NULL, NULL);
INSERT INTO `localidades` VALUES(342, 1, 1, 'BUENOS AIRES', 'CORONEL VIDAL', '7174', NULL, NULL);
INSERT INTO `localidades` VALUES(343, 1, 1, 'BUENOS AIRES', 'CORTI', '8118', NULL, NULL);
INSERT INTO `localidades` VALUES(344, 1, 1, 'BUENOS AIRES', 'CORTINEZ', '6712', NULL, NULL);
INSERT INTO `localidades` VALUES(345, 1, 1, 'BUENOS AIRES', 'COSTA AZUL', '7112', NULL, NULL);
INSERT INTO `localidades` VALUES(346, 1, 1, 'BUENOS AIRES', 'COSTA BRAVA', '2914', NULL, NULL);
INSERT INTO `localidades` VALUES(347, 1, 1, 'BUENOS AIRES', 'COSTA DEL ESTE', '7109', NULL, NULL);
INSERT INTO `localidades` VALUES(348, 1, 1, 'BUENOS AIRES', 'COUNTRY DE ECHEVERRIA', '1804', NULL, NULL);
INSERT INTO `localidades` VALUES(349, 1, 1, 'BUENOS AIRES', 'COVELLO', '7305', NULL, NULL);
INSERT INTO `localidades` VALUES(350, 1, 1, 'BUENOS AIRES', 'CRISTIANO MUERTO', '7503', NULL, NULL);
INSERT INTO `localidades` VALUES(351, 1, 1, 'BUENOS AIRES', 'CROTTO', '7307', NULL, NULL);
INSERT INTO `localidades` VALUES(352, 1, 1, 'BUENOS AIRES', 'CRUCE VARELA', '1887', NULL, NULL);
INSERT INTO `localidades` VALUES(353, 1, 1, 'BUENOS AIRES', 'CUCHA CUCHA', '6746', NULL, NULL);
INSERT INTO `localidades` VALUES(354, 1, 1, 'BUENOS AIRES', 'CUCULLU', '6723', NULL, NULL);
INSERT INTO `localidades` VALUES(355, 1, 1, 'BUENOS AIRES', 'CURA MALAL', '7548', NULL, NULL);
INSERT INTO `localidades` VALUES(356, 1, 1, 'BUENOS AIRES', 'CURARU', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(357, 1, 1, 'BUENOS AIRES', 'D ORBIGNY', '7541', NULL, NULL);
INSERT INTO `localidades` VALUES(358, 1, 1, 'BUENOS AIRES', 'DAIREAUX', '6555', NULL, NULL);
INSERT INTO `localidades` VALUES(359, 1, 1, 'BUENOS AIRES', 'DARREGUEIRA', '8183', NULL, NULL);
INSERT INTO `localidades` VALUES(360, 1, 1, 'BUENOS AIRES', 'DE BARY', '6348', NULL, NULL);
INSERT INTO `localidades` VALUES(361, 1, 1, 'BUENOS AIRES', 'DE LA CANAL', '7013', NULL, NULL);
INSERT INTO `localidades` VALUES(362, 1, 1, 'BUENOS AIRES', 'DE LA GARMA', '7515', NULL, NULL);
INSERT INTO `localidades` VALUES(363, 1, 1, 'BUENOS AIRES', 'DEFFERRARI', '7521', NULL, NULL);
INSERT INTO `localidades` VALUES(364, 1, 1, 'BUENOS AIRES', 'DEL CARRIL', '7265', NULL, NULL);
INSERT INTO `localidades` VALUES(365, 1, 1, 'BUENOS AIRES', 'DEL VALLE', '6509', NULL, NULL);
INSERT INTO `localidades` VALUES(366, 1, 1, 'BUENOS AIRES', 'DEL VISO', '1669', NULL, NULL);
INSERT INTO `localidades` VALUES(367, 1, 1, 'BUENOS AIRES', 'DELFIN HUERGO', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(368, 1, 1, 'BUENOS AIRES', 'DELGADO', '6007', NULL, NULL);
INSERT INTO `localidades` VALUES(369, 1, 1, 'BUENOS AIRES', 'DENNEHY', '6516', NULL, NULL);
INSERT INTO `localidades` VALUES(370, 1, 1, 'BUENOS AIRES', 'DIEGO GAYNOR', '2812', NULL, NULL);
INSERT INTO `localidades` VALUES(371, 1, 1, 'BUENOS AIRES', 'DIQUE LUJAN', '1623', NULL, NULL);
INSERT INTO `localidades` VALUES(372, 1, 1, 'BUENOS AIRES', 'DIQUE PASO PIEDRA', '8118', NULL, NULL);
INSERT INTO `localidades` VALUES(373, 1, 1, 'BUENOS AIRES', 'DOCK SUD', '1871', NULL, NULL);
INSERT INTO `localidades` VALUES(374, 1, 1, 'BUENOS AIRES', 'DOLORES', '7100', NULL, NULL);
INSERT INTO `localidades` VALUES(375, 1, 1, 'BUENOS AIRES', 'DOMSELAAR', '1984', NULL, NULL);
INSERT INTO `localidades` VALUES(376, 1, 1, 'BUENOS AIRES', 'DON BOSCO', '1876', NULL, NULL);
INSERT INTO `localidades` VALUES(377, 1, 1, 'BUENOS AIRES', 'DON CIPRIANO', '7135', NULL, NULL);
INSERT INTO `localidades` VALUES(378, 1, 1, 'BUENOS AIRES', 'DON ORIONE', '1850', NULL, NULL);
INSERT INTO `localidades` VALUES(379, 1, 1, 'BUENOS AIRES', 'DON TORCUATO', '1611', NULL, NULL);
INSERT INTO `localidades` VALUES(380, 1, 1, 'BUENOS AIRES', 'DOS HERMANOS', '6042', NULL, NULL);
INSERT INTO `localidades` VALUES(381, 1, 1, 'BUENOS AIRES', 'DOS NACIONES', '7007', NULL, NULL);
INSERT INTO `localidades` VALUES(382, 1, 1, 'BUENOS AIRES', 'DOYHENARD', '1984', NULL, NULL);
INSERT INTO `localidades` VALUES(383, 1, 1, 'BUENOS AIRES', 'DOYLE', '2935', NULL, NULL);
INSERT INTO `localidades` VALUES(384, 1, 1, 'BUENOS AIRES', 'DR. DOMINGO HAROSTEGUY', '7212', NULL, NULL);
INSERT INTO `localidades` VALUES(385, 1, 1, 'BUENOS AIRES', 'DRABBLE', '6242', NULL, NULL);
INSERT INTO `localidades` VALUES(386, 1, 1, 'BUENOS AIRES', 'DRYSDALE', '6455', NULL, NULL);
INSERT INTO `localidades` VALUES(387, 1, 1, 'BUENOS AIRES', 'DUCOS', '8170', NULL, NULL);
INSERT INTO `localidades` VALUES(388, 1, 1, 'BUENOS AIRES', 'DUDIGNAC', '6505', NULL, NULL);
INSERT INTO `localidades` VALUES(389, 1, 1, 'BUENOS AIRES', 'DUFAUR', '8164', NULL, NULL);
INSERT INTO `localidades` VALUES(390, 1, 1, 'BUENOS AIRES', 'DUGGAN', '2764', NULL, NULL);
INSERT INTO `localidades` VALUES(391, 1, 1, 'BUENOS AIRES', 'DUHAU', '6405', NULL, NULL);
INSERT INTO `localidades` VALUES(392, 1, 1, 'BUENOS AIRES', 'DURAÑONA', '7401', NULL, NULL);
INSERT INTO `localidades` VALUES(393, 1, 1, 'BUENOS AIRES', 'DUSSAUD', '6050', NULL, NULL);
INSERT INTO `localidades` VALUES(394, 1, 1, 'BUENOS AIRES', 'EDMUNDO PERKINS', '6030', NULL, NULL);
INSERT INTO `localidades` VALUES(395, 1, 1, 'BUENOS AIRES', 'EDUARDO COSTA', '6064', NULL, NULL);
INSERT INTO `localidades` VALUES(396, 1, 1, 'BUENOS AIRES', 'EL ARBOLITO', '2718', NULL, NULL);
INSERT INTO `localidades` VALUES(397, 1, 1, 'BUENOS AIRES', 'EL DESCANSO (BUE)', '2935', NULL, NULL);
INSERT INTO `localidades` VALUES(398, 1, 1, 'BUENOS AIRES', 'EL DIA', '6241', NULL, NULL);
INSERT INTO `localidades` VALUES(399, 1, 1, 'BUENOS AIRES', 'EL DIVISORIO', '7531', NULL, NULL);
INSERT INTO `localidades` VALUES(400, 1, 1, 'BUENOS AIRES', 'EL DORADO (BUE)', '6031', NULL, NULL);
INSERT INTO `localidades` VALUES(401, 1, 1, 'BUENOS AIRES', 'EL FENIX', '2804', NULL, NULL);
INSERT INTO `localidades` VALUES(402, 1, 1, 'BUENOS AIRES', 'EL GRIEGO - MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(403, 1, 1, 'BUENOS AIRES', 'EL JABALI', '6531', NULL, NULL);
INSERT INTO `localidades` VALUES(404, 1, 1, 'BUENOS AIRES', 'EL JAGUEL', '1842', NULL, NULL);
INSERT INTO `localidades` VALUES(405, 1, 1, 'BUENOS AIRES', 'EL JARDIN', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(406, 1, 1, 'BUENOS AIRES', 'EL LENGUARAZ', '7635', NULL, NULL);
INSERT INTO `localidades` VALUES(407, 1, 1, 'BUENOS AIRES', 'EL LUCHADOR', '7313', NULL, NULL);
INSERT INTO `localidades` VALUES(408, 1, 1, 'BUENOS AIRES', 'EL MANGRULLO', '7260', NULL, NULL);
INSERT INTO `localidades` VALUES(409, 1, 1, 'BUENOS AIRES', 'EL MORO', '7623', NULL, NULL);
INSERT INTO `localidades` VALUES(410, 1, 1, 'BUENOS AIRES', 'EL NUEVO GOLF', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(411, 1, 1, 'BUENOS AIRES', 'EL PALENQUE (BUE)', '1667', NULL, NULL);
INSERT INTO `localidades` VALUES(412, 1, 1, 'BUENOS AIRES', 'EL PALOMAR', '1684', NULL, NULL);
INSERT INTO `localidades` VALUES(413, 1, 1, 'BUENOS AIRES', 'EL PARAISO', '2916', NULL, NULL);
INSERT INTO `localidades` VALUES(414, 1, 1, 'BUENOS AIRES', 'EL PENSAMIENTO', '7531', NULL, NULL);
INSERT INTO `localidades` VALUES(415, 1, 1, 'BUENOS AIRES', 'EL PEREGRINO', '6053', NULL, NULL);
INSERT INTO `localidades` VALUES(416, 1, 1, 'BUENOS AIRES', 'EL RECADO', '6474', NULL, NULL);
INSERT INTO `localidades` VALUES(417, 1, 1, 'BUENOS AIRES', 'EL SOCORRO', '2715', NULL, NULL);
INSERT INTO `localidades` VALUES(418, 1, 1, 'BUENOS AIRES', 'EL TALAR', '1617', NULL, NULL);
INSERT INTO `localidades` VALUES(419, 1, 1, 'BUENOS AIRES', 'EL TEJAR', '6515', NULL, NULL);
INSERT INTO `localidades` VALUES(420, 1, 1, 'BUENOS AIRES', 'EL TRIGO', '7207', NULL, NULL);
INSERT INTO `localidades` VALUES(421, 1, 1, 'BUENOS AIRES', 'EL TRIUNFO', '6073', NULL, NULL);
INSERT INTO `localidades` VALUES(422, 1, 1, 'BUENOS AIRES', 'EL ZORRO', '8150', NULL, NULL);
INSERT INTO `localidades` VALUES(423, 1, 1, 'BUENOS AIRES', 'ELIAS ROMERO', '1721', NULL, NULL);
INSERT INTO `localidades` VALUES(424, 1, 1, 'BUENOS AIRES', 'ELORDI', '6242', NULL, NULL);
INSERT INTO `localidades` VALUES(425, 1, 1, 'BUENOS AIRES', 'ELVIRA', '7243', NULL, NULL);
INSERT INTO `localidades` VALUES(426, 1, 1, 'BUENOS AIRES', 'EMILIO AYERZA', '6628', NULL, NULL);
INSERT INTO `localidades` VALUES(427, 1, 1, 'BUENOS AIRES', 'EMILIO LAMARCA', '8508', NULL, NULL);
INSERT INTO `localidades` VALUES(428, 1, 1, 'BUENOS AIRES', 'EMILIO V. BUNGE', '6241', NULL, NULL);
INSERT INTO `localidades` VALUES(429, 1, 1, 'BUENOS AIRES', 'EMITA', '6634', NULL, NULL);
INSERT INTO `localidades` VALUES(430, 1, 1, 'BUENOS AIRES', 'EMMA', '7263', NULL, NULL);
INSERT INTO `localidades` VALUES(431, 1, 1, 'BUENOS AIRES', 'EMPALME LOBOS', '7249', NULL, NULL);
INSERT INTO `localidades` VALUES(432, 1, 1, 'BUENOS AIRES', 'ENCINA', '6077', NULL, NULL);
INSERT INTO `localidades` VALUES(433, 1, 1, 'BUENOS AIRES', 'ENERGIA', '7641', NULL, NULL);
INSERT INTO `localidades` VALUES(434, 1, 1, 'BUENOS AIRES', 'ENRIQUE FYNN', '1741', NULL, NULL);
INSERT INTO `localidades` VALUES(435, 1, 1, 'BUENOS AIRES', 'ENRIQUE LAVALLE', '6467', NULL, NULL);
INSERT INTO `localidades` VALUES(436, 1, 1, 'BUENOS AIRES', 'ENSENADA', '1925', NULL, NULL);
INSERT INTO `localidades` VALUES(437, 1, 1, 'BUENOS AIRES', 'EREZCANO', '2903', NULL, NULL);
INSERT INTO `localidades` VALUES(438, 1, 1, 'BUENOS AIRES', 'ERNESTINA', '6665', NULL, NULL);
INSERT INTO `localidades` VALUES(439, 1, 1, 'BUENOS AIRES', 'ESCOBAR', '1625', NULL, NULL);
INSERT INTO `localidades` VALUES(440, 1, 1, 'BUENOS AIRES', 'ESCUELA AGRICOLA DON BOSCO', '1815', NULL, NULL);
INSERT INTO `localidades` VALUES(441, 1, 1, 'BUENOS AIRES', 'ESPARTILLAR', '8171', NULL, NULL);
INSERT INTO `localidades` VALUES(442, 1, 1, 'BUENOS AIRES', 'ESPIGAS', '6561', NULL, NULL);
INSERT INTO `localidades` VALUES(443, 1, 1, 'BUENOS AIRES', 'ESPORA', '6601', NULL, NULL);
INSERT INTO `localidades` VALUES(444, 1, 1, 'BUENOS AIRES', 'ESQUINA DE CROTTO', '7100', NULL, NULL);
INSERT INTO `localidades` VALUES(445, 1, 1, 'BUENOS AIRES', 'ESTACION CAMET', '7612', NULL, NULL);
INSERT INTO `localidades` VALUES(446, 1, 1, 'BUENOS AIRES', 'ESTACION CARABELAS', '2703', NULL, NULL);
INSERT INTO `localidades` VALUES(447, 1, 1, 'BUENOS AIRES', 'ESTACION CHAPADMALAL', '7605', NULL, NULL);
INSERT INTO `localidades` VALUES(448, 1, 1, 'BUENOS AIRES', 'ESTACION CUENCA', '6231', NULL, NULL);
INSERT INTO `localidades` VALUES(449, 1, 1, 'BUENOS AIRES', 'ESTACION HAM', '6005', NULL, NULL);
INSERT INTO `localidades` VALUES(450, 1, 1, 'BUENOS AIRES', 'ESTEBAN ADROGUE', '1846', NULL, NULL);
INSERT INTO `localidades` VALUES(451, 1, 1, 'BUENOS AIRES', 'ESTEBAN AGUSTIN GASCON', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(452, 1, 1, 'BUENOS AIRES', 'ESTEBAN DE LUCA', '6475', NULL, NULL);
INSERT INTO `localidades` VALUES(453, 1, 1, 'BUENOS AIRES', 'ESTEBAN ECHEVERRIA', '1842', NULL, NULL);
INSERT INTO `localidades` VALUES(454, 1, 1, 'BUENOS AIRES', 'ESTELA', '8127', NULL, NULL);
INSERT INTO `localidades` VALUES(455, 1, 1, 'BUENOS AIRES', 'ESTOMBA', '8118', NULL, NULL);
INSERT INTO `localidades` VALUES(456, 1, 1, 'BUENOS AIRES', 'ESTRUGAMOU', '7207', NULL, NULL);
INSERT INTO `localidades` VALUES(457, 1, 1, 'BUENOS AIRES', 'ETCHEVERRY', '1903', NULL, NULL);
INSERT INTO `localidades` VALUES(458, 1, 1, 'BUENOS AIRES', 'EZEIZA', '1804', NULL, NULL);
INSERT INTO `localidades` VALUES(459, 1, 1, 'BUENOS AIRES', 'EZPELETA', '1882', NULL, NULL);
INSERT INTO `localidades` VALUES(460, 1, 1, 'BUENOS AIRES', 'FAIR', '7153', NULL, NULL);
INSERT INTO `localidades` VALUES(461, 1, 1, 'BUENOS AIRES', 'FARO', '8150', NULL, NULL);
INSERT INTO `localidades` VALUES(462, 1, 1, 'BUENOS AIRES', 'FARO NORTE - MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(463, 1, 1, 'BUENOS AIRES', 'FARO QUERANDI', '7165', NULL, NULL);
INSERT INTO `localidades` VALUES(464, 1, 1, 'BUENOS AIRES', 'FARO SAN ANTONIO', '7103', NULL, NULL);
INSERT INTO `localidades` VALUES(465, 1, 1, 'BUENOS AIRES', 'FARO SEGUNDA BARRANCOSA', '8504', NULL, NULL);
INSERT INTO `localidades` VALUES(466, 1, 1, 'BUENOS AIRES', 'FATIMA ESTACION EMPALME', '1633', NULL, NULL);
INSERT INTO `localidades` VALUES(467, 1, 1, 'BUENOS AIRES', 'FATRALO', '6430', NULL, NULL);
INSERT INTO `localidades` VALUES(468, 1, 1, 'BUENOS AIRES', 'FAUZON', '6500', NULL, NULL);
INSERT INTO `localidades` VALUES(469, 1, 1, 'BUENOS AIRES', 'FELIPE SOLA', '8129', NULL, NULL);
INSERT INTO `localidades` VALUES(470, 1, 1, 'BUENOS AIRES', 'FERRARI', '6003', NULL, NULL);
INSERT INTO `localidades` VALUES(471, 1, 1, 'BUENOS AIRES', 'FERRE', '6003', NULL, NULL);
INSERT INTO `localidades` VALUES(472, 1, 1, 'BUENOS AIRES', 'FLANDRIA', '6706', NULL, NULL);
INSERT INTO `localidades` VALUES(473, 1, 1, 'BUENOS AIRES', 'FLORENCIO VARELA', '1888', NULL, NULL);
INSERT INTO `localidades` VALUES(474, 1, 1, 'BUENOS AIRES', 'FLORIDA', '1602', NULL, NULL);
INSERT INTO `localidades` VALUES(475, 1, 1, 'BUENOS AIRES', 'FONTEZUELA', '2700', NULL, NULL);
INSERT INTO `localidades` VALUES(476, 1, 1, 'BUENOS AIRES', 'FORTIN ACHA', '6031', NULL, NULL);
INSERT INTO `localidades` VALUES(477, 1, 1, 'BUENOS AIRES', 'FORTIN MERCEDES', '8148', NULL, NULL);
INSERT INTO `localidades` VALUES(478, 1, 1, 'BUENOS AIRES', 'FORTIN OLAVARRIA', '6403', NULL, NULL);
INSERT INTO `localidades` VALUES(479, 1, 1, 'BUENOS AIRES', 'FORTIN TIBURCIO', '6001', NULL, NULL);
INSERT INTO `localidades` VALUES(480, 1, 1, 'BUENOS AIRES', 'FORTIN VIGILANCIA', '6073', NULL, NULL);
INSERT INTO `localidades` VALUES(481, 1, 1, 'BUENOS AIRES', 'FOURNIER', '6501', NULL, NULL);
INSERT INTO `localidades` VALUES(482, 1, 1, 'BUENOS AIRES', 'FRANCISCO A. BERRA', '7220', NULL, NULL);
INSERT INTO `localidades` VALUES(483, 1, 1, 'BUENOS AIRES', 'FRANCISCO ALVAREZ', '1746', NULL, NULL);
INSERT INTO `localidades` VALUES(484, 1, 1, 'BUENOS AIRES', 'FRANCISCO CASAL', '6230', NULL, NULL);
INSERT INTO `localidades` VALUES(485, 1, 1, 'BUENOS AIRES', 'FRANCISCO DE VITORIA', '6403', NULL, NULL);
INSERT INTO `localidades` VALUES(486, 1, 1, 'BUENOS AIRES', 'FRANCISCO J MEEKS', '7301', NULL, NULL);
INSERT INTO `localidades` VALUES(487, 1, 1, 'BUENOS AIRES', 'FRANCISCO MADERO', '6472', NULL, NULL);
INSERT INTO `localidades` VALUES(488, 1, 1, 'BUENOS AIRES', 'FRANCISCO MAGNANO', '6475', NULL, NULL);
INSERT INTO `localidades` VALUES(489, 1, 1, 'BUENOS AIRES', 'FRANKLIN', '6614', NULL, NULL);
INSERT INTO `localidades` VALUES(490, 1, 1, 'BUENOS AIRES', 'FRAY LUIS BELTRAN', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(491, 1, 1, 'BUENOS AIRES', 'FRENCH', '6516', NULL, NULL);
INSERT INTO `localidades` VALUES(492, 1, 1, 'BUENOS AIRES', 'FULTON', '7007', NULL, NULL);
INSERT INTO `localidades` VALUES(493, 1, 1, 'BUENOS AIRES', 'GAHAN', '2745', NULL, NULL);
INSERT INTO `localidades` VALUES(494, 1, 1, 'BUENOS AIRES', 'GALO LLORENTE', '6513', NULL, NULL);
INSERT INTO `localidades` VALUES(495, 1, 1, 'BUENOS AIRES', 'GANDARA', '7136', NULL, NULL);
INSERT INTO `localidades` VALUES(496, 1, 1, 'BUENOS AIRES', 'GARCIA DEL RIO', '8162', NULL, NULL);
INSERT INTO `localidades` VALUES(497, 1, 1, 'BUENOS AIRES', 'GARDEY', '7003', NULL, NULL);
INSERT INTO `localidades` VALUES(498, 1, 1, 'BUENOS AIRES', 'GARIN', '1619', NULL, NULL);
INSERT INTO `localidades` VALUES(499, 1, 1, 'BUENOS AIRES', 'GARRE', '6411', NULL, NULL);
INSERT INTO `localidades` VALUES(500, 1, 1, 'BUENOS AIRES', 'GENERAL ALVEAR BUE', '7263', NULL, NULL);
INSERT INTO `localidades` VALUES(501, 1, 1, 'BUENOS AIRES', 'GENERAL ARENALES', '6005', NULL, NULL);
INSERT INTO `localidades` VALUES(502, 1, 1, 'BUENOS AIRES', 'GENERAL BELGRANO', '7223', NULL, NULL);
INSERT INTO `localidades` VALUES(503, 1, 1, 'BUENOS AIRES', 'GENERAL CONESA (MDQ)', '7101', NULL, NULL);
INSERT INTO `localidades` VALUES(504, 1, 1, 'BUENOS AIRES', 'GENERAL DANIEL CERRI', '8105', NULL, NULL);
INSERT INTO `localidades` VALUES(505, 1, 1, 'BUENOS AIRES', 'GENERAL GUIDO', '7118', NULL, NULL);
INSERT INTO `localidades` VALUES(506, 1, 1, 'BUENOS AIRES', 'GENERAL HORNOS', '1739', NULL, NULL);
INSERT INTO `localidades` VALUES(507, 1, 1, 'BUENOS AIRES', 'GENERAL LAMADRID', '7406', NULL, NULL);
INSERT INTO `localidades` VALUES(508, 1, 1, 'BUENOS AIRES', 'GENERAL LAPRIDA', '7414', NULL, NULL);
INSERT INTO `localidades` VALUES(509, 1, 1, 'BUENOS AIRES', 'GENERAL LAS HERAS', '1741', NULL, NULL);
INSERT INTO `localidades` VALUES(510, 1, 1, 'BUENOS AIRES', 'GENERAL LAVALLE', '7103', NULL, NULL);
INSERT INTO `localidades` VALUES(511, 1, 1, 'BUENOS AIRES', 'GENERAL MADARIAGA', '7163', NULL, NULL);
INSERT INTO `localidades` VALUES(512, 1, 1, 'BUENOS AIRES', 'GENERAL MANSILLA', '1911', NULL, NULL);
INSERT INTO `localidades` VALUES(513, 1, 1, 'BUENOS AIRES', 'GENERAL O BRIEN', '6646', NULL, NULL);
INSERT INTO `localidades` VALUES(514, 1, 1, 'BUENOS AIRES', 'GENERAL PACHECO', '1617', NULL, NULL);
INSERT INTO `localidades` VALUES(515, 1, 1, 'BUENOS AIRES', 'GENERAL PAZ', '1987', NULL, NULL);
INSERT INTO `localidades` VALUES(516, 1, 1, 'BUENOS AIRES', 'GENERAL PINTOS', '6050', NULL, NULL);
INSERT INTO `localidades` VALUES(517, 1, 1, 'BUENOS AIRES', 'GENERAL PIRAN', '7172', NULL, NULL);
INSERT INTO `localidades` VALUES(518, 1, 1, 'BUENOS AIRES', 'GENERAL RODRIGUEZ', '1748', NULL, NULL);
INSERT INTO `localidades` VALUES(519, 1, 1, 'BUENOS AIRES', 'GENERAL ROJO', '2905', NULL, NULL);
INSERT INTO `localidades` VALUES(520, 1, 1, 'BUENOS AIRES', 'GENERAL RONDEAU', '8124', NULL, NULL);
INSERT INTO `localidades` VALUES(521, 1, 1, 'BUENOS AIRES', 'GENERAL SARMIENTO', '1663', NULL, NULL);
INSERT INTO `localidades` VALUES(522, 1, 1, 'BUENOS AIRES', 'GENERAL VIAMONTE BUE', '6015', NULL, NULL);
INSERT INTO `localidades` VALUES(523, 1, 1, 'BUENOS AIRES', 'GENERAL VILLEGAS', '6230', NULL, NULL);
INSERT INTO `localidades` VALUES(524, 1, 1, 'BUENOS AIRES', 'GERENTE CILLEY', '6507', NULL, NULL);
INSERT INTO `localidades` VALUES(525, 1, 1, 'BUENOS AIRES', 'GERLI', '1824', NULL, NULL);
INSERT INTO `localidades` VALUES(526, 1, 1, 'BUENOS AIRES', 'GERMANIA', '6053', NULL, NULL);
INSERT INTO `localidades` VALUES(527, 1, 1, 'BUENOS AIRES', 'GIL', '8151', NULL, NULL);
INSERT INTO `localidades` VALUES(528, 1, 1, 'BUENOS AIRES', 'GIRODIAS', '6407', NULL, NULL);
INSERT INTO `localidades` VALUES(529, 1, 1, 'BUENOS AIRES', 'GIRONDO', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(530, 1, 1, 'BUENOS AIRES', 'GLEW', '1856', NULL, NULL);
INSERT INTO `localidades` VALUES(531, 1, 1, 'BUENOS AIRES', 'GNECCO', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(532, 1, 1, 'BUENOS AIRES', 'GOBERNADOR ANDONAEGUI', '2764', NULL, NULL);
INSERT INTO `localidades` VALUES(533, 1, 1, 'BUENOS AIRES', 'GOBERNADOR ARIAS', '6531', NULL, NULL);
INSERT INTO `localidades` VALUES(534, 1, 1, 'BUENOS AIRES', 'GOBERNADOR CASTRO', '2946', NULL, NULL);
INSERT INTO `localidades` VALUES(535, 1, 1, 'BUENOS AIRES', 'GOBERNADOR COSTA', '1888', NULL, NULL);
INSERT INTO `localidades` VALUES(536, 1, 1, 'BUENOS AIRES', 'GOBERNADOR OBLIGADO', '1981', NULL, NULL);
INSERT INTO `localidades` VALUES(537, 1, 1, 'BUENOS AIRES', 'GOBERNADOR ORTIZ DE ROSAS', '7260', NULL, NULL);
INSERT INTO `localidades` VALUES(538, 1, 1, 'BUENOS AIRES', 'GOBERNADOR UDAONDO', '7221', NULL, NULL);
INSERT INTO `localidades` VALUES(539, 1, 1, 'BUENOS AIRES', 'GOBERNADOR UGARTE', '6621', NULL, NULL);
INSERT INTO `localidades` VALUES(540, 1, 1, 'BUENOS AIRES', 'GOLDNEY', '6614', NULL, NULL);
INSERT INTO `localidades` VALUES(541, 1, 1, 'BUENOS AIRES', 'GOMEZ DE LA VEGA', '1983', NULL, NULL);
INSERT INTO `localidades` VALUES(542, 1, 1, 'BUENOS AIRES', 'GONDRA', '6241', NULL, NULL);
INSERT INTO `localidades` VALUES(543, 1, 1, 'BUENOS AIRES', 'GONNET', '1897', NULL, NULL);
INSERT INTO `localidades` VALUES(544, 1, 1, 'BUENOS AIRES', 'GONZALEZ CATAN', '1759', NULL, NULL);
INSERT INTO `localidades` VALUES(545, 1, 1, 'BUENOS AIRES', 'GONZALEZ CHAVEZ', '7513', NULL, NULL);
INSERT INTO `localidades` VALUES(546, 1, 1, 'BUENOS AIRES', 'GONZALEZ MORENO', '6239', NULL, NULL);
INSERT INTO `localidades` VALUES(547, 1, 1, 'BUENOS AIRES', 'GONZALEZ RISOS', '6605', NULL, NULL);
INSERT INTO `localidades` VALUES(548, 1, 1, 'BUENOS AIRES', 'GORCHS', '7226', NULL, NULL);
INSERT INTO `localidades` VALUES(549, 1, 1, 'BUENOS AIRES', 'GORINA', '1897', NULL, NULL);
INSERT INTO `localidades` VALUES(550, 1, 1, 'BUENOS AIRES', 'GOROSTIAGA', '6632', NULL, NULL);
INSERT INTO `localidades` VALUES(551, 1, 1, 'BUENOS AIRES', 'GOUIN', '6727', NULL, NULL);
INSERT INTO `localidades` VALUES(552, 1, 1, 'BUENOS AIRES', 'GOWLAND', '6608', NULL, NULL);
INSERT INTO `localidades` VALUES(553, 1, 1, 'BUENOS AIRES', 'GOYENA', '8175', NULL, NULL);
INSERT INTO `localidades` VALUES(554, 1, 1, 'BUENOS AIRES', 'GOYENECHE', '7220', NULL, NULL);
INSERT INTO `localidades` VALUES(555, 1, 1, 'BUENOS AIRES', 'GRAND BOURG', '1615', NULL, NULL);
INSERT INTO `localidades` VALUES(556, 1, 1, 'BUENOS AIRES', 'GREGORIO DE LAFERRERE', '1757', NULL, NULL);
INSERT INTO `localidades` VALUES(557, 1, 1, 'BUENOS AIRES', 'GREGORIO VILLAFAÑE', '6740', NULL, NULL);
INSERT INTO `localidades` VALUES(558, 1, 1, 'BUENOS AIRES', 'GRUMBEIN', '8101', NULL, NULL);
INSERT INTO `localidades` VALUES(559, 1, 1, 'BUENOS AIRES', 'GUAMINI', '6435', NULL, NULL);
INSERT INTO `localidades` VALUES(560, 1, 1, 'BUENOS AIRES', 'GUANACO', '6476', NULL, NULL);
INSERT INTO `localidades` VALUES(561, 1, 1, 'BUENOS AIRES', 'GUARDIA DEL MONTE', '7220', NULL, NULL);
INSERT INTO `localidades` VALUES(562, 1, 1, 'BUENOS AIRES', 'GUERNICA', '1862', NULL, NULL);
INSERT INTO `localidades` VALUES(563, 1, 1, 'BUENOS AIRES', 'GUERRERO', '7116', NULL, NULL);
INSERT INTO `localidades` VALUES(564, 1, 1, 'BUENOS AIRES', 'GUERRICO', '2717', NULL, NULL);
INSERT INTO `localidades` VALUES(565, 1, 1, 'BUENOS AIRES', 'GUIDO SPANO', '2707', NULL, NULL);
INSERT INTO `localidades` VALUES(566, 1, 1, 'BUENOS AIRES', 'GUNTHER', '6053', NULL, NULL);
INSERT INTO `localidades` VALUES(567, 1, 1, 'BUENOS AIRES', 'HAEDO', '1706', NULL, NULL);
INSERT INTO `localidades` VALUES(568, 1, 1, 'BUENOS AIRES', 'HALE', '6511', NULL, NULL);
INSERT INTO `localidades` VALUES(569, 1, 1, 'BUENOS AIRES', 'HAM', '6005', NULL, NULL);
INSERT INTO `localidades` VALUES(570, 1, 1, 'BUENOS AIRES', 'HARAS DEL OJO DE AGUA', '7620', NULL, NULL);
INSERT INTO `localidades` VALUES(571, 1, 1, 'BUENOS AIRES', 'HARAS LA ELVIRA', '6612', NULL, NULL);
INSERT INTO `localidades` VALUES(572, 1, 1, 'BUENOS AIRES', 'HEAVY', '6723', NULL, NULL);
INSERT INTO `localidades` VALUES(573, 1, 1, 'BUENOS AIRES', 'HENDERSON', '6465', NULL, NULL);
INSERT INTO `localidades` VALUES(574, 1, 1, 'BUENOS AIRES', 'HENRY BELL', '6621', NULL, NULL);
INSERT INTO `localidades` VALUES(575, 1, 1, 'BUENOS AIRES', 'HEREFORD', '6233', NULL, NULL);
INSERT INTO `localidades` VALUES(576, 1, 1, 'BUENOS AIRES', 'HERRERA VEGAS', '6557', NULL, NULL);
INSERT INTO `localidades` VALUES(577, 1, 1, 'BUENOS AIRES', 'HILARIO ASCASUBI', '8142', NULL, NULL);
INSERT INTO `localidades` VALUES(578, 1, 1, 'BUENOS AIRES', 'HORTENSIA', '6537', NULL, NULL);
INSERT INTO `localidades` VALUES(579, 1, 1, 'BUENOS AIRES', 'HUANGUELEN', '7545', NULL, NULL);
INSERT INTO `localidades` VALUES(580, 1, 1, 'BUENOS AIRES', 'HUDSON', '1885', NULL, NULL);
INSERT INTO `localidades` VALUES(581, 1, 1, 'BUENOS AIRES', 'HUESO CLAVADO', '7500', NULL, NULL);
INSERT INTO `localidades` VALUES(582, 1, 1, 'BUENOS AIRES', 'HUETEL', '6511', NULL, NULL);
INSERT INTO `localidades` VALUES(583, 1, 1, 'BUENOS AIRES', 'HUGUES', '2725', NULL, NULL);
INSERT INTO `localidades` VALUES(584, 1, 1, 'BUENOS AIRES', 'HUNTER', '2707', NULL, NULL);
INSERT INTO `localidades` VALUES(585, 1, 1, 'BUENOS AIRES', 'HURLINGHAM', '1686', NULL, NULL);
INSERT INTO `localidades` VALUES(586, 1, 1, 'BUENOS AIRES', 'HUSARES', '6455', NULL, NULL);
INSERT INTO `localidades` VALUES(587, 1, 1, 'BUENOS AIRES', 'IBAÑEZ', '7223', NULL, NULL);
INSERT INTO `localidades` VALUES(588, 1, 1, 'BUENOS AIRES', 'IGARZABAL', '8512', NULL, NULL);
INSERT INTO `localidades` VALUES(589, 1, 1, 'BUENOS AIRES', 'IGNACIO CORREAS ARANA', '1909', NULL, NULL);
INSERT INTO `localidades` VALUES(590, 1, 1, 'BUENOS AIRES', 'INDACOECHEA', '6623', NULL, NULL);
INSERT INTO `localidades` VALUES(591, 1, 1, 'BUENOS AIRES', 'INDIO RICO', '7501', NULL, NULL);
INSERT INTO `localidades` VALUES(592, 1, 1, 'BUENOS AIRES', 'INES INDART', '2747', NULL, NULL);
INSERT INTO `localidades` VALUES(593, 1, 1, 'BUENOS AIRES', 'INGENIERO BALBIN', '6051', NULL, NULL);
INSERT INTO `localidades` VALUES(594, 1, 1, 'BUENOS AIRES', 'INGENIERO BEAUGEY', '6457', NULL, NULL);
INSERT INTO `localidades` VALUES(595, 1, 1, 'BUENOS AIRES', 'INGENIERO BUDGE', '1773', NULL, NULL);
INSERT INTO `localidades` VALUES(596, 1, 1, 'BUENOS AIRES', 'INGENIERO DE MADRID', '6651', NULL, NULL);
INSERT INTO `localidades` VALUES(597, 1, 1, 'BUENOS AIRES', 'INGENIERO JUAN ALLAN', '1891', NULL, NULL);
INSERT INTO `localidades` VALUES(598, 1, 1, 'BUENOS AIRES', 'INGENIERO MASCHWITZ', '1623', NULL, NULL);
INSERT INTO `localidades` VALUES(599, 1, 1, 'BUENOS AIRES', 'INGENIERO MONETA', '2935', NULL, NULL);
INSERT INTO `localidades` VALUES(600, 1, 1, 'BUENOS AIRES', 'INGENIERO OTAMENDI', '2802', NULL, NULL);
INSERT INTO `localidades` VALUES(601, 1, 1, 'BUENOS AIRES', 'INGENIERO SILVEYRA', '6743', NULL, NULL);
INSERT INTO `localidades` VALUES(602, 1, 1, 'BUENOS AIRES', 'INGENIERO THOMPSON', '6337', NULL, NULL);
INSERT INTO `localidades` VALUES(603, 1, 1, 'BUENOS AIRES', 'INGENIERO THOMPSON', '6337', NULL, NULL);
INSERT INTO `localidades` VALUES(604, 1, 1, 'BUENOS AIRES', 'INGENIERO WHITE', '8103', NULL, NULL);
INSERT INTO `localidades` VALUES(605, 1, 1, 'BUENOS AIRES', 'INGENIERO WILLIAMS', '6603', NULL, NULL);
INSERT INTO `localidades` VALUES(606, 1, 1, 'BUENOS AIRES', 'INOCENCIO SOSA', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(607, 1, 1, 'BUENOS AIRES', 'IRALA', '6013', NULL, NULL);
INSERT INTO `localidades` VALUES(608, 1, 1, 'BUENOS AIRES', 'IRAOLA', '7009', NULL, NULL);
INSERT INTO `localidades` VALUES(609, 1, 1, 'BUENOS AIRES', 'IRENE', '7507', NULL, NULL);
INSERT INTO `localidades` VALUES(610, 1, 1, 'BUENOS AIRES', 'IRENEO PORTELA', '2943', NULL, NULL);
INSERT INTO `localidades` VALUES(611, 1, 1, 'BUENOS AIRES', 'IRIARTE', '6042', NULL, NULL);
INSERT INTO `localidades` VALUES(612, 1, 1, 'BUENOS AIRES', 'ISIDRO CASANOVA', '1765', NULL, NULL);
INSERT INTO `localidades` VALUES(613, 1, 1, 'BUENOS AIRES', 'ISLAS', '6667', NULL, NULL);
INSERT INTO `localidades` VALUES(614, 1, 1, 'BUENOS AIRES', 'ITURREGUI', '6557', NULL, NULL);
INSERT INTO `localidades` VALUES(615, 1, 1, 'BUENOS AIRES', 'ITUZAINGO BUE', '1714', NULL, NULL);
INSERT INTO `localidades` VALUES(616, 1, 1, 'BUENOS AIRES', 'JEPPENER', '1986', NULL, NULL);
INSERT INTO `localidades` VALUES(617, 1, 1, 'BUENOS AIRES', 'JOSE A. GUISASOLA', '8156', NULL, NULL);
INSERT INTO `localidades` VALUES(618, 1, 1, 'BUENOS AIRES', 'JOSE B. CASAS', '8505', NULL, NULL);
INSERT INTO `localidades` VALUES(619, 1, 1, 'BUENOS AIRES', 'JOSE C. PAZ', '1665', NULL, NULL);
INSERT INTO `localidades` VALUES(620, 1, 1, 'BUENOS AIRES', 'JOSE FERRARI', '1905', NULL, NULL);
INSERT INTO `localidades` VALUES(621, 1, 1, 'BUENOS AIRES', 'JOSE HERNANDEZ', '1903', NULL, NULL);
INSERT INTO `localidades` VALUES(622, 1, 1, 'BUENOS AIRES', 'JOSE INGENIEROS', '1702', NULL, NULL);
INSERT INTO `localidades` VALUES(623, 1, 1, 'BUENOS AIRES', 'JOSE LEON SUAREZ', '1655', NULL, NULL);
INSERT INTO `localidades` VALUES(624, 1, 1, 'BUENOS AIRES', 'JOSE M. MICHEO', '7263', NULL, NULL);
INSERT INTO `localidades` VALUES(625, 1, 1, 'BUENOS AIRES', 'JOSE MARIA BLANCO', '6409', NULL, NULL);
INSERT INTO `localidades` VALUES(626, 1, 1, 'BUENOS AIRES', 'JOSE MARIA JAUREGUI', '6706', NULL, NULL);
INSERT INTO `localidades` VALUES(627, 1, 1, 'BUENOS AIRES', 'JOSE MARMOL', '1846', NULL, NULL);
INSERT INTO `localidades` VALUES(628, 1, 1, 'BUENOS AIRES', 'JOSE SANTOS AREVALO', '7243', NULL, NULL);
INSERT INTO `localidades` VALUES(629, 1, 1, 'BUENOS AIRES', 'JOSE SOJO', '7260', NULL, NULL);
INSERT INTO `localidades` VALUES(630, 1, 1, 'BUENOS AIRES', 'JUAN A PRADERE', '8142', NULL, NULL);
INSERT INTO `localidades` VALUES(631, 1, 1, 'BUENOS AIRES', 'JUAN ATUCHA', '7245', NULL, NULL);
INSERT INTO `localidades` VALUES(632, 1, 1, 'BUENOS AIRES', 'JUAN BAUTISTA ALBERDI', '6034', NULL, NULL);
INSERT INTO `localidades` VALUES(633, 1, 1, 'BUENOS AIRES', 'JUAN BLAQUIER', '7267', NULL, NULL);
INSERT INTO `localidades` VALUES(634, 1, 1, 'BUENOS AIRES', 'JUAN COUSTE', '8136', NULL, NULL);
INSERT INTO `localidades` VALUES(635, 1, 1, 'BUENOS AIRES', 'JUAN E. BARRA', '7517', NULL, NULL);
INSERT INTO `localidades` VALUES(636, 1, 1, 'BUENOS AIRES', 'JUAN F. IBARRA', '6551', NULL, NULL);
INSERT INTO `localidades` VALUES(637, 1, 1, 'BUENOS AIRES', 'JUAN G PUJOL', '2909', NULL, NULL);
INSERT INTO `localidades` VALUES(638, 1, 1, 'BUENOS AIRES', 'JUAN JOSE ALMEYRA', '6603', NULL, NULL);
INSERT INTO `localidades` VALUES(639, 1, 1, 'BUENOS AIRES', 'JUAN JOSE PASO', '6474', NULL, NULL);
INSERT INTO `localidades` VALUES(640, 1, 1, 'BUENOS AIRES', 'JUAN MARIA GUTIERREZ', '1890', NULL, NULL);
INSERT INTO `localidades` VALUES(641, 1, 1, 'BUENOS AIRES', 'JUAN N. FERNANDEZ', '7011', NULL, NULL);
INSERT INTO `localidades` VALUES(642, 1, 1, 'BUENOS AIRES', 'JUAN TRONCONI', '7247', NULL, NULL);
INSERT INTO `localidades` VALUES(643, 1, 1, 'BUENOS AIRES', 'JUAN V CILLEY', '6430', NULL, NULL);
INSERT INTO `localidades` VALUES(644, 1, 1, 'BUENOS AIRES', 'JUAN VELA', '6663', NULL, NULL);
INSERT INTO `localidades` VALUES(645, 1, 1, 'BUENOS AIRES', 'JUAN VUCETICH (EX DOCTOR R LEVENE)', '1894', NULL, NULL);
INSERT INTO `localidades` VALUES(646, 1, 1, 'BUENOS AIRES', 'JUANA A. DE LA PEÑA', '2717', NULL, NULL);
INSERT INTO `localidades` VALUES(647, 1, 1, 'BUENOS AIRES', 'JUANCHO', '7169', NULL, NULL);
INSERT INTO `localidades` VALUES(648, 1, 1, 'BUENOS AIRES', 'JULIO ARDITTI', '1913', NULL, NULL);
INSERT INTO `localidades` VALUES(649, 1, 1, 'BUENOS AIRES', 'JUNIN BUE', '6000', NULL, NULL);
INSERT INTO `localidades` VALUES(650, 1, 1, 'BUENOS AIRES', 'KENNY', '2745', NULL, NULL);
INSERT INTO `localidades` VALUES(651, 1, 1, 'BUENOS AIRES', 'KRABBE', '7530', NULL, NULL);
INSERT INTO `localidades` VALUES(652, 1, 1, 'BUENOS AIRES', 'LA ANGELITA', '6003', NULL, NULL);
INSERT INTO `localidades` VALUES(653, 1, 1, 'BUENOS AIRES', 'LA BALANDRA', '1923', NULL, NULL);
INSERT INTO `localidades` VALUES(654, 1, 1, 'BUENOS AIRES', 'LA BALLENA', '7521', NULL, NULL);
INSERT INTO `localidades` VALUES(655, 1, 1, 'BUENOS AIRES', 'LA BALLENERA', '7605', NULL, NULL);
INSERT INTO `localidades` VALUES(656, 1, 1, 'BUENOS AIRES', 'LA BARRANCOSA', '7260', NULL, NULL);
INSERT INTO `localidades` VALUES(657, 1, 1, 'BUENOS AIRES', 'LA BLANCA', '8136', NULL, NULL);
INSERT INTO `localidades` VALUES(658, 1, 1, 'BUENOS AIRES', 'LA BLANQUEADA', '7243', NULL, NULL);
INSERT INTO `localidades` VALUES(659, 1, 1, 'BUENOS AIRES', 'LA BOLSA', '2933', NULL, NULL);
INSERT INTO `localidades` VALUES(660, 1, 1, 'BUENOS AIRES', 'LA BRAVA', '7620', NULL, NULL);
INSERT INTO `localidades` VALUES(661, 1, 1, 'BUENOS AIRES', 'LA BUENA MOZA', '2930', NULL, NULL);
INSERT INTO `localidades` VALUES(662, 1, 1, 'BUENOS AIRES', 'LA CALERA', '7020', NULL, NULL);
INSERT INTO `localidades` VALUES(663, 1, 1, 'BUENOS AIRES', 'LA CALERA (VA.CACIQUE)', '7005', NULL, NULL);
INSERT INTO `localidades` VALUES(664, 1, 1, 'BUENOS AIRES', 'LA CALIFORNIA ARGENITNA', '6616', NULL, NULL);
INSERT INTO `localidades` VALUES(665, 1, 1, 'BUENOS AIRES', 'LA CAMPANA', '7260', NULL, NULL);
INSERT INTO `localidades` VALUES(666, 1, 1, 'BUENOS AIRES', 'LA CARLOTA', '6628', NULL, NULL);
INSERT INTO `localidades` VALUES(667, 1, 1, 'BUENOS AIRES', 'LA CARRETA', '6471', NULL, NULL);
INSERT INTO `localidades` VALUES(668, 1, 1, 'BUENOS AIRES', 'LA CAUTIVA', '6403', NULL, NULL);
INSERT INTO `localidades` VALUES(669, 1, 1, 'BUENOS AIRES', 'LA CHOZA', '1737', NULL, NULL);
INSERT INTO `localidades` VALUES(670, 1, 1, 'BUENOS AIRES', 'LA COLINA', '7408', NULL, NULL);
INSERT INTO `localidades` VALUES(671, 1, 1, 'BUENOS AIRES', 'LA CONSTANCIA', '7153', NULL, NULL);
INSERT INTO `localidades` VALUES(672, 1, 1, 'BUENOS AIRES', 'LA COPETA', '7545', NULL, NULL);
INSERT INTO `localidades` VALUES(673, 1, 1, 'BUENOS AIRES', 'LA COSTA', '1814', NULL, NULL);
INSERT INTO `localidades` VALUES(674, 1, 1, 'BUENOS AIRES', 'LA COSTA (CASTELLI)', '7114', NULL, NULL);
INSERT INTO `localidades` VALUES(675, 1, 1, 'BUENOS AIRES', 'LA DELFINA', '6017', NULL, NULL);
INSERT INTO `localidades` VALUES(676, 1, 1, 'BUENOS AIRES', 'LA DELIA', '2740', NULL, NULL);
INSERT INTO `localidades` VALUES(677, 1, 1, 'BUENOS AIRES', 'LA DORITA', '6538', NULL, NULL);
INSERT INTO `localidades` VALUES(678, 1, 1, 'BUENOS AIRES', 'LA DORMILONA', '6628', NULL, NULL);
INSERT INTO `localidades` VALUES(679, 1, 1, 'BUENOS AIRES', 'LA DULCE (N.OLIVERA)', '7637', NULL, NULL);
INSERT INTO `localidades` VALUES(680, 1, 1, 'BUENOS AIRES', 'LA ELMA', '7603', NULL, NULL);
INSERT INTO `localidades` VALUES(681, 1, 1, 'BUENOS AIRES', 'LA EMILIA', '2901', NULL, NULL);
INSERT INTO `localidades` VALUES(682, 1, 1, 'BUENOS AIRES', 'LA ESPERANZA', '2915', NULL, NULL);
INSERT INTO `localidades` VALUES(683, 1, 1, 'BUENOS AIRES', 'LA ESPERANZA (NAPALEUFU, PDO BALCAR', '7007', NULL, NULL);
INSERT INTO `localidades` VALUES(684, 1, 1, 'BUENOS AIRES', 'LA ESPERANZA (PDO GRAL BELGRANO)', '7223', NULL, NULL);
INSERT INTO `localidades` VALUES(685, 1, 1, 'BUENOS AIRES', 'LA ESPERANZA (PDO GRAL MADARIAGA)', '7163', NULL, NULL);
INSERT INTO `localidades` VALUES(686, 1, 1, 'BUENOS AIRES', 'LA ESPERANZA (ROSAS, PDO LAS FLORES', '7205', NULL, NULL);
INSERT INTO `localidades` VALUES(687, 1, 1, 'BUENOS AIRES', 'LA ESTRELLA (DOLORES, PDO DOLORES)', '7100', NULL, NULL);
INSERT INTO `localidades` VALUES(688, 1, 1, 'BUENOS AIRES', 'LA ESTRELLA (SIERRAS BAYAS, OLAVARR', '7403', NULL, NULL);
INSERT INTO `localidades` VALUES(689, 1, 1, 'BUENOS AIRES', 'LA EVA', '8136', NULL, NULL);
INSERT INTO `localidades` VALUES(690, 1, 1, 'BUENOS AIRES', 'LA FELICIANA', '7503', NULL, NULL);
INSERT INTO `localidades` VALUES(691, 1, 1, 'BUENOS AIRES', 'LA FLORIDA (DTO CRUZ ALTA)', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(692, 1, 1, 'BUENOS AIRES', 'LA FLORIDA (PDO ADOLFO ALSINA)', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(693, 1, 1, 'BUENOS AIRES', 'LA FLORIDA (PDO SAN ANDRES DE GILES', '6720', NULL, NULL);
INSERT INTO `localidades` VALUES(694, 1, 1, 'BUENOS AIRES', 'LA FLORIDA (PILA, PDO DE PILA)', '7116', NULL, NULL);
INSERT INTO `localidades` VALUES(695, 1, 1, 'BUENOS AIRES', 'LA FRATERNIDAD', '1748', NULL, NULL);
INSERT INTO `localidades` VALUES(696, 1, 1, 'BUENOS AIRES', 'LA GRANJA (BUE)', '1901', NULL, NULL);
INSERT INTO `localidades` VALUES(697, 1, 1, 'BUENOS AIRES', 'LA HERMINIA', '6437', NULL, NULL);
INSERT INTO `localidades` VALUES(698, 1, 1, 'BUENOS AIRES', 'LA HIGUERA', '6475', NULL, NULL);
INSERT INTO `localidades` VALUES(699, 1, 1, 'BUENOS AIRES', 'LA HORQUETA (PDO CAMPANA)', '2805', NULL, NULL);
INSERT INTO `localidades` VALUES(700, 1, 1, 'BUENOS AIRES', 'LA HORQUETA (PDO CHASCOMUS)', '7130', NULL, NULL);
INSERT INTO `localidades` VALUES(701, 1, 1, 'BUENOS AIRES', 'LA HORQUETA (PDO DE TRES ARROYOS)', '7500', NULL, NULL);
INSERT INTO `localidades` VALUES(702, 1, 1, 'BUENOS AIRES', 'LA HUAYQUERIA', '6005', NULL, NULL);
INSERT INTO `localidades` VALUES(703, 1, 1, 'BUENOS AIRES', 'LA HUELLA', '7101', NULL, NULL);
INSERT INTO `localidades` VALUES(704, 1, 1, 'BUENOS AIRES', 'LA INVENCIBLE', '2745', NULL, NULL);
INSERT INTO `localidades` VALUES(705, 1, 1, 'BUENOS AIRES', 'LA LARGA (PDO DAIREAUX)', '6555', NULL, NULL);
INSERT INTO `localidades` VALUES(706, 1, 1, 'BUENOS AIRES', 'LA LARGA NUEVA (APEADERO FCGU)', '2812', NULL, NULL);
INSERT INTO `localidades` VALUES(707, 1, 1, 'BUENOS AIRES', 'LA LIMPIA', '6645', NULL, NULL);
INSERT INTO `localidades` VALUES(708, 1, 1, 'BUENOS AIRES', 'LA LUCILA (BUE)', '1636', NULL, NULL);
INSERT INTO `localidades` VALUES(709, 1, 1, 'BUENOS AIRES', 'LA LUCILA DEL MAR', '7113', NULL, NULL);
INSERT INTO `localidades` VALUES(710, 1, 1, 'BUENOS AIRES', 'LA LUISA', '2752', NULL, NULL);
INSERT INTO `localidades` VALUES(711, 1, 1, 'BUENOS AIRES', 'LA MANUELA', '6439', NULL, NULL);
INSERT INTO `localidades` VALUES(712, 1, 1, 'BUENOS AIRES', 'LA MASCOTA (PDO. VILLARINO)', '8134', NULL, NULL);
INSERT INTO `localidades` VALUES(713, 1, 1, 'BUENOS AIRES', 'LA MASCOTA (REAL AUDIENCIA, DTO PIL', '7225', NULL, NULL);
INSERT INTO `localidades` VALUES(714, 1, 1, 'BUENOS AIRES', 'LA MASCOTA (STO DOMINGO, PDO LAVALL', '7119', NULL, NULL);
INSERT INTO `localidades` VALUES(715, 1, 1, 'BUENOS AIRES', 'LA MATANZA', '1759', NULL, NULL);
INSERT INTO `localidades` VALUES(716, 1, 1, 'BUENOS AIRES', 'LA NEGRA', '7005', NULL, NULL);
INSERT INTO `localidades` VALUES(717, 1, 1, 'BUENOS AIRES', 'LA NEVADA', '7545', NULL, NULL);
INSERT INTO `localidades` VALUES(718, 1, 1, 'BUENOS AIRES', 'LA NIÑA', '6513', NULL, NULL);
INSERT INTO `localidades` VALUES(719, 1, 1, 'BUENOS AIRES', 'LA NORIA', '1814', NULL, NULL);
INSERT INTO `localidades` VALUES(720, 1, 1, 'BUENOS AIRES', 'LA NUMANCIA', '7007', NULL, NULL);
INSERT INTO `localidades` VALUES(721, 1, 1, 'BUENOS AIRES', 'LA ORIENTAL', '6022', NULL, NULL);
INSERT INTO `localidades` VALUES(722, 1, 1, 'BUENOS AIRES', 'LA PALA', '6341', NULL, NULL);
INSERT INTO `localidades` VALUES(723, 1, 1, 'BUENOS AIRES', 'LA PASTORA (PDO TANDIL)', '7001', NULL, NULL);
INSERT INTO `localidades` VALUES(724, 1, 1, 'BUENOS AIRES', 'LA PASTORA (PDO TRES ARROYOS)', '7500', NULL, NULL);
INSERT INTO `localidades` VALUES(725, 1, 1, 'BUENOS AIRES', 'LA PINTA', '6007', NULL, NULL);
INSERT INTO `localidades` VALUES(726, 1, 1, 'BUENOS AIRES', 'LA PLATA', '1900', NULL, NULL);
INSERT INTO `localidades` VALUES(727, 1, 1, 'BUENOS AIRES', 'LA PORTEÑA (EL TRIGO, PDO LAS FLORE', '7207', NULL, NULL);
INSERT INTO `localidades` VALUES(728, 1, 1, 'BUENOS AIRES', 'LA PORTEÑA (PDO LOBOS)', '7241', NULL, NULL);
INSERT INTO `localidades` VALUES(729, 1, 1, 'BUENOS AIRES', 'LA PORTEÑA (PDO MORENO)', '1744', NULL, NULL);
INSERT INTO `localidades` VALUES(730, 1, 1, 'BUENOS AIRES', 'LA PORTEÑA (PDO TRENQUE LAUQUEN)', '6407', NULL, NULL);
INSERT INTO `localidades` VALUES(731, 1, 1, 'BUENOS AIRES', 'LA PRIMAVERA (A JONTE, DTO MAGDALEN', '1921', NULL, NULL);
INSERT INTO `localidades` VALUES(732, 1, 1, 'BUENOS AIRES', 'LA PRIMAVERA (PDO CORONEL SUAREZ)', '7543', NULL, NULL);
INSERT INTO `localidades` VALUES(733, 1, 1, 'BUENOS AIRES', 'LA PROVIDENCIA', '7403', NULL, NULL);
INSERT INTO `localidades` VALUES(734, 1, 1, 'BUENOS AIRES', 'LA RABIA', '6667', NULL, NULL);
INSERT INTO `localidades` VALUES(735, 1, 1, 'BUENOS AIRES', 'LA REFORMA (PDO GRAL ALVARADO)', '7603', NULL, NULL);
INSERT INTO `localidades` VALUES(736, 1, 1, 'BUENOS AIRES', 'LA REFORMA (PDO ROQUE PEREZ)', '7245', NULL, NULL);
INSERT INTO `localidades` VALUES(737, 1, 1, 'BUENOS AIRES', 'LA REFORMA CHASCOMUS', '7130', NULL, NULL);
INSERT INTO `localidades` VALUES(738, 1, 1, 'BUENOS AIRES', 'LA REJA', '1744', NULL, NULL);
INSERT INTO `localidades` VALUES(739, 1, 1, 'BUENOS AIRES', 'LA RICA', '6623', NULL, NULL);
INSERT INTO `localidades` VALUES(740, 1, 1, 'BUENOS AIRES', 'LA SALADA', '1774', NULL, NULL);
INSERT INTO `localidades` VALUES(741, 1, 1, 'BUENOS AIRES', 'LA SOFIA', '6535', NULL, NULL);
INSERT INTO `localidades` VALUES(742, 1, 1, 'BUENOS AIRES', 'LA SORTIJA', '7517', NULL, NULL);
INSERT INTO `localidades` VALUES(743, 1, 1, 'BUENOS AIRES', 'LA TABLADA', '1766', NULL, NULL);
INSERT INTO `localidades` VALUES(744, 1, 1, 'BUENOS AIRES', 'LA TRINIDAD (BUE)', '6003', NULL, NULL);
INSERT INTO `localidades` VALUES(745, 1, 1, 'BUENOS AIRES', 'LA VANGUARDIA (BUE)', '2715', NULL, NULL);
INSERT INTO `localidades` VALUES(746, 1, 1, 'BUENOS AIRES', 'LA VIOLETA', '2751', NULL, NULL);
INSERT INTO `localidades` VALUES(747, 1, 1, 'BUENOS AIRES', 'LA VITICOLA', '8122', NULL, NULL);
INSERT INTO `localidades` VALUES(748, 1, 1, 'BUENOS AIRES', 'LA ZANJA', '6400', NULL, NULL);
INSERT INTO `localidades` VALUES(749, 1, 1, 'BUENOS AIRES', 'LABARDEN', '7161', NULL, NULL);
INSERT INTO `localidades` VALUES(750, 1, 1, 'BUENOS AIRES', 'LAGUNA ALSINA', '6439', NULL, NULL);
INSERT INTO `localidades` VALUES(751, 1, 1, 'BUENOS AIRES', 'LANGUEYU', '7151', NULL, NULL);
INSERT INTO `localidades` VALUES(752, 1, 1, 'BUENOS AIRES', 'LANUS', '1824', NULL, NULL);
INSERT INTO `localidades` VALUES(753, 1, 1, 'BUENOS AIRES', 'LAPLACETTE', '6013', NULL, NULL);
INSERT INTO `localidades` VALUES(754, 1, 1, 'BUENOS AIRES', 'LARRAMENDY', '7414', NULL, NULL);
INSERT INTO `localidades` VALUES(755, 1, 1, 'BUENOS AIRES', 'LARREA', '6634', NULL, NULL);
INSERT INTO `localidades` VALUES(756, 1, 1, 'BUENOS AIRES', 'LARTIGAU', '7531', NULL, NULL);
INSERT INTO `localidades` VALUES(757, 1, 1, 'BUENOS AIRES', 'LAS ARMAS', '7172', NULL, NULL);
INSERT INTO `localidades` VALUES(758, 1, 1, 'BUENOS AIRES', 'LAS CANTERAS (MAR DEL PLATA)', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(759, 1, 1, 'BUENOS AIRES', 'LAS DALIAS (MAR DEL PLATA)', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(760, 1, 1, 'BUENOS AIRES', 'LAS FLORES (BUE)', '7200', NULL, NULL);
INSERT INTO `localidades` VALUES(761, 1, 1, 'BUENOS AIRES', 'LAS HERMANAS', '7412', NULL, NULL);
INSERT INTO `localidades` VALUES(762, 1, 1, 'BUENOS AIRES', 'LAS JUANITAS', '6476', NULL, NULL);
INSERT INTO `localidades` VALUES(763, 1, 1, 'BUENOS AIRES', 'LAS MALVINAS (BUE) PARADA FCDFS', '1748', NULL, NULL);
INSERT INTO `localidades` VALUES(764, 1, 1, 'BUENOS AIRES', 'LAS MARIANAS', '6607', NULL, NULL);
INSERT INTO `localidades` VALUES(765, 1, 1, 'BUENOS AIRES', 'LAS MARTINETAS', '7406', NULL, NULL);
INSERT INTO `localidades` VALUES(766, 1, 1, 'BUENOS AIRES', 'LAS MOSTAZAS', '7530', NULL, NULL);
INSERT INTO `localidades` VALUES(767, 1, 1, 'BUENOS AIRES', 'LAS NUTRIAS', '7623', NULL, NULL);
INSERT INTO `localidades` VALUES(768, 1, 1, 'BUENOS AIRES', 'LAS PALMAS (BUE)', '2806', NULL, NULL);
INSERT INTO `localidades` VALUES(769, 1, 1, 'BUENOS AIRES', 'LAS PARVAS', '6022', NULL, NULL);
INSERT INTO `localidades` VALUES(770, 1, 1, 'BUENOS AIRES', 'LAS TAHONAS', '1921', NULL, NULL);
INSERT INTO `localidades` VALUES(771, 1, 1, 'BUENOS AIRES', 'LAS TONINAS', '7106', NULL, NULL);
INSERT INTO `localidades` VALUES(772, 1, 1, 'BUENOS AIRES', 'LAS TOSCAS (BUE)', '6453', NULL, NULL);
INSERT INTO `localidades` VALUES(773, 1, 1, 'BUENOS AIRES', 'LAS VAQUERIAS', '7500', NULL, NULL);
INSERT INTO `localidades` VALUES(774, 1, 1, 'BUENOS AIRES', 'LASTRA', '7406', NULL, NULL);
INSERT INTO `localidades` VALUES(775, 1, 1, 'BUENOS AIRES', 'LAVALLOL', '1836', NULL, NULL);
INSERT INTO `localidades` VALUES(776, 1, 1, 'BUENOS AIRES', 'LAZZARINO', '7300', NULL, NULL);
INSERT INTO `localidades` VALUES(777, 1, 1, 'BUENOS AIRES', 'LEANDRO N. ALEM', '6032', NULL, NULL);
INSERT INTO `localidades` VALUES(778, 1, 1, 'BUENOS AIRES', 'LEBUCO', '6338', NULL, NULL);
INSERT INTO `localidades` VALUES(779, 1, 1, 'BUENOS AIRES', 'LEDESMA', '7116', NULL, NULL);
INSERT INTO `localidades` VALUES(780, 1, 1, 'BUENOS AIRES', 'LERTORA', '6400', NULL, NULL);
INSERT INTO `localidades` VALUES(781, 1, 1, 'BUENOS AIRES', 'LIBANO', '7407', NULL, NULL);
INSERT INTO `localidades` VALUES(782, 1, 1, 'BUENOS AIRES', 'LIBERTAD (BUE)', '1716', NULL, NULL);
INSERT INTO `localidades` VALUES(783, 1, 1, 'BUENOS AIRES', 'LIBRES DEL SUD', '7135', NULL, NULL);
INSERT INTO `localidades` VALUES(784, 1, 1, 'BUENOS AIRES', 'LIC. MATIENZO', '7007', NULL, NULL);
INSERT INTO `localidades` VALUES(785, 1, 1, 'BUENOS AIRES', 'LIMA', '2806', NULL, NULL);
INSERT INTO `localidades` VALUES(786, 1, 1, 'BUENOS AIRES', 'LIN CALEL', '7505', NULL, NULL);
INSERT INTO `localidades` VALUES(787, 1, 1, 'BUENOS AIRES', 'LINCOLN', '6070', NULL, NULL);
INSERT INTO `localidades` VALUES(788, 1, 1, 'BUENOS AIRES', 'LOBERIA', '7635', NULL, NULL);
INSERT INTO `localidades` VALUES(789, 1, 1, 'BUENOS AIRES', 'LOBOS', '7240', NULL, NULL);
INSERT INTO `localidades` VALUES(790, 1, 1, 'BUENOS AIRES', 'LOMA HERMOSA (BUE)', '1657', NULL, NULL);
INSERT INTO `localidades` VALUES(791, 1, 1, 'BUENOS AIRES', 'LOMA NEGRA', '7403', NULL, NULL);
INSERT INTO `localidades` VALUES(792, 1, 1, 'BUENOS AIRES', 'LOMA VERDE', '1625', NULL, NULL);
INSERT INTO `localidades` VALUES(793, 1, 1, 'BUENOS AIRES', 'LOMA VERDE -LA PLATA', '1981', NULL, NULL);
INSERT INTO `localidades` VALUES(794, 1, 1, 'BUENOS AIRES', 'LOMAS DE ZAMORA', '1832', NULL, NULL);
INSERT INTO `localidades` VALUES(795, 1, 1, 'BUENOS AIRES', 'LOMAS DEL GOLF', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(796, 1, 1, 'BUENOS AIRES', 'LOMAS DEL MIRADOR', '1752', NULL, NULL);
INSERT INTO `localidades` VALUES(797, 1, 1, 'BUENOS AIRES', 'LONGCHAMPS', '1854', NULL, NULL);
INSERT INTO `localidades` VALUES(798, 1, 1, 'BUENOS AIRES', 'LOPEZ (BUE)', '7021', NULL, NULL);
INSERT INTO `localidades` VALUES(799, 1, 1, 'BUENOS AIRES', 'LOPEZ LECUBE', '8117', NULL, NULL);
INSERT INTO `localidades` VALUES(800, 1, 1, 'BUENOS AIRES', 'LOS ANGELES (BUE)', '2743', NULL, NULL);
INSERT INTO `localidades` VALUES(801, 1, 1, 'BUENOS AIRES', 'LOS CALDENES', '6242', NULL, NULL);
INSERT INTO `localidades` VALUES(802, 1, 1, 'BUENOS AIRES', 'LOS CALLEJONES', '6062', NULL, NULL);
INSERT INTO `localidades` VALUES(803, 1, 1, 'BUENOS AIRES', 'LOS CARDALES', '2814', NULL, NULL);
INSERT INTO `localidades` VALUES(804, 1, 1, 'BUENOS AIRES', 'LOS COLONIALES', '6555', NULL, NULL);
INSERT INTO `localidades` VALUES(805, 1, 1, 'BUENOS AIRES', 'LOS INDIOS', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(806, 1, 1, 'BUENOS AIRES', 'LOS LAURELES (BUE)', '6230', NULL, NULL);
INSERT INTO `localidades` VALUES(807, 1, 1, 'BUENOS AIRES', 'LOS PINOS', '7621', NULL, NULL);
INSERT INTO `localidades` VALUES(808, 1, 1, 'BUENOS AIRES', 'LOS TOLDOS', '6015', NULL, NULL);
INSERT INTO `localidades` VALUES(809, 1, 1, 'BUENOS AIRES', 'LOUGE', '7545', NULL, NULL);
INSERT INTO `localidades` VALUES(810, 1, 1, 'BUENOS AIRES', 'LUCAS MONTEVERDE', '6661', NULL, NULL);
INSERT INTO `localidades` VALUES(811, 1, 1, 'BUENOS AIRES', 'LUIS GUILLON', '1838', NULL, NULL);
INSERT INTO `localidades` VALUES(812, 1, 1, 'BUENOS AIRES', 'LUJAN (BUE)', '6700', NULL, NULL);
INSERT INTO `localidades` VALUES(813, 1, 1, 'BUENOS AIRES', 'LURO', '6439', NULL, NULL);
INSERT INTO `localidades` VALUES(814, 1, 1, 'BUENOS AIRES', 'M. CORONADO', '1682', NULL, NULL);
INSERT INTO `localidades` VALUES(815, 1, 1, 'BUENOS AIRES', 'M0NTECARLO', '7167', NULL, NULL);
INSERT INTO `localidades` VALUES(816, 1, 1, 'BUENOS AIRES', 'MACEDO', '7169', NULL, NULL);
INSERT INTO `localidades` VALUES(817, 1, 1, 'BUENOS AIRES', 'MAGDALA', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(818, 1, 1, 'BUENOS AIRES', 'MAGDALENA (BUE)', '1913', NULL, NULL);
INSERT INTO `localidades` VALUES(819, 1, 1, 'BUENOS AIRES', 'MAGUIRRE', '2718', NULL, NULL);
INSERT INTO `localidades` VALUES(820, 1, 1, 'BUENOS AIRES', 'MAIPU (BUE)', '7160', NULL, NULL);
INSERT INTO `localidades` VALUES(821, 1, 1, 'BUENOS AIRES', 'MAMAGUITA', '6661', NULL, NULL);
INSERT INTO `localidades` VALUES(822, 1, 1, 'BUENOS AIRES', 'MANUEL J. COBO', '7116', NULL, NULL);
INSERT INTO `localidades` VALUES(823, 1, 1, 'BUENOS AIRES', 'MANUEL JOSE GARCIA', '6608', NULL, NULL);
INSERT INTO `localidades` VALUES(824, 1, 1, 'BUENOS AIRES', 'MANUEL OCAMPO', '2713', NULL, NULL);
INSERT INTO `localidades` VALUES(825, 1, 1, 'BUENOS AIRES', 'MANZANARES', '1629', NULL, NULL);
INSERT INTO `localidades` VALUES(826, 1, 1, 'BUENOS AIRES', 'MANZONE F.A.', '1633', NULL, NULL);
INSERT INTO `localidades` VALUES(827, 1, 1, 'BUENOS AIRES', 'MAPIS', '6557', NULL, NULL);
INSERT INTO `localidades` VALUES(828, 1, 1, 'BUENOS AIRES', 'MAPIS', '7404', NULL, NULL);
INSERT INTO `localidades` VALUES(829, 1, 1, 'BUENOS AIRES', 'MAQUINISTA SAVIO', '1620', NULL, NULL);
INSERT INTO `localidades` VALUES(830, 1, 1, 'BUENOS AIRES', 'MAR AZUL', '7165', NULL, NULL);
INSERT INTO `localidades` VALUES(831, 1, 1, 'BUENOS AIRES', 'MAR CHIQUITA', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(832, 1, 1, 'BUENOS AIRES', 'MAR DE AJO', '7109', NULL, NULL);
INSERT INTO `localidades` VALUES(833, 1, 1, 'BUENOS AIRES', 'MAR DE COBO', '7612', NULL, NULL);
INSERT INTO `localidades` VALUES(834, 1, 1, 'BUENOS AIRES', 'MAR DE COBO', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(835, 1, 1, 'BUENOS AIRES', 'MAR DE LAS PAMPAS', '7265', NULL, NULL);
INSERT INTO `localidades` VALUES(836, 1, 1, 'BUENOS AIRES', 'MAR DEL PLATA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(837, 1, 1, 'BUENOS AIRES', 'MAR DEL SUR', '7607', NULL, NULL);
INSERT INTO `localidades` VALUES(838, 1, 1, 'BUENOS AIRES', 'MAR DEL TUYU', '7108', NULL, NULL);
INSERT INTO `localidades` VALUES(839, 1, 1, 'BUENOS AIRES', 'MARCELINO UGARTE', '2741', NULL, NULL);
INSERT INTO `localidades` VALUES(840, 1, 1, 'BUENOS AIRES', 'MARCOS PAZ (BUE)', '1727', NULL, NULL);
INSERT INTO `localidades` VALUES(841, 1, 1, 'BUENOS AIRES', 'MARI LAUQUEN', '6400', NULL, NULL);
INSERT INTO `localidades` VALUES(842, 1, 1, 'BUENOS AIRES', 'MARIA IGNACIA', '7003', NULL, NULL);
INSERT INTO `localidades` VALUES(843, 1, 1, 'BUENOS AIRES', 'MARIA LUCILA', '6467', NULL, NULL);
INSERT INTO `localidades` VALUES(844, 1, 1, 'BUENOS AIRES', 'MARIANO ACOSTA', '1723', NULL, NULL);
INSERT INTO `localidades` VALUES(845, 1, 1, 'BUENOS AIRES', 'MARIANO BENITEZ', '2701', NULL, NULL);
INSERT INTO `localidades` VALUES(846, 1, 1, 'BUENOS AIRES', 'MARIANO H. ALFONZO', '2718', NULL, NULL);
INSERT INTO `localidades` VALUES(847, 1, 1, 'BUENOS AIRES', 'MARIANO UNZUE', '6551', NULL, NULL);
INSERT INTO `localidades` VALUES(848, 1, 1, 'BUENOS AIRES', 'MARILO', '1664', NULL, NULL);
INSERT INTO `localidades` VALUES(849, 1, 1, 'BUENOS AIRES', 'MARIO ROLDAN', '7517', NULL, NULL);
INSERT INTO `localidades` VALUES(850, 1, 1, 'BUENOS AIRES', 'MARTIN BERRAONDO', '6667', NULL, NULL);
INSERT INTO `localidades` VALUES(851, 1, 1, 'BUENOS AIRES', 'MARTIN COLMAN', '7201', NULL, NULL);
INSERT INTO `localidades` VALUES(852, 1, 1, 'BUENOS AIRES', 'MARTIN FIERRO', '7311', NULL, NULL);
INSERT INTO `localidades` VALUES(853, 1, 1, 'BUENOS AIRES', 'MARTINEZ', '1640', NULL, NULL);
INSERT INTO `localidades` VALUES(854, 1, 1, 'BUENOS AIRES', 'MARUCHA', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(855, 1, 1, 'BUENOS AIRES', 'MASUREL', '6439', NULL, NULL);
INSERT INTO `localidades` VALUES(856, 1, 1, 'BUENOS AIRES', 'MATHEU', '1627', NULL, NULL);
INSERT INTO `localidades` VALUES(857, 1, 1, 'BUENOS AIRES', 'MAXIMO FERNANDEZ', '6645', NULL, NULL);
INSERT INTO `localidades` VALUES(858, 1, 1, 'BUENOS AIRES', 'MAXIMO PAZ (BUE)', '1812', NULL, NULL);
INSERT INTO `localidades` VALUES(859, 1, 1, 'BUENOS AIRES', 'MAYOR BURATOVICH', '8146', NULL, NULL);
INSERT INTO `localidades` VALUES(860, 1, 1, 'BUENOS AIRES', 'MAYOR JOSE ORELLANO', '6053', NULL, NULL);
INSERT INTO `localidades` VALUES(861, 1, 1, 'BUENOS AIRES', 'MAZA', '6343', NULL, NULL);
INSERT INTO `localidades` VALUES(862, 1, 1, 'BUENOS AIRES', 'MECHITA', '6648', NULL, NULL);
INSERT INTO `localidades` VALUES(863, 1, 1, 'BUENOS AIRES', 'MECHONGUE', '7605', NULL, NULL);
INSERT INTO `localidades` VALUES(864, 1, 1, 'BUENOS AIRES', 'MEDANOS', '8132', NULL, NULL);
INSERT INTO `localidades` VALUES(865, 1, 1, 'BUENOS AIRES', 'MELCHOR ROMERO', '1903', NULL, NULL);
INSERT INTO `localidades` VALUES(866, 1, 1, 'BUENOS AIRES', 'MEMBRILLAR', '6748', NULL, NULL);
INSERT INTO `localidades` VALUES(867, 1, 1, 'BUENOS AIRES', 'MERCADO CENTRAL', '1771', NULL, NULL);
INSERT INTO `localidades` VALUES(868, 1, 1, 'BUENOS AIRES', 'MERCEDES (BUE)', '6600', NULL, NULL);
INSERT INTO `localidades` VALUES(869, 1, 1, 'BUENOS AIRES', 'MERCEDITAS', '2725', NULL, NULL);
INSERT INTO `localidades` VALUES(870, 1, 1, 'BUENOS AIRES', 'MERLO (BUE)', '1722', NULL, NULL);
INSERT INTO `localidades` VALUES(871, 1, 1, 'BUENOS AIRES', 'MICAELA CASCALLARES', '7507', NULL, NULL);
INSERT INTO `localidades` VALUES(872, 1, 1, 'BUENOS AIRES', 'MIRA PAMPA', '6403', NULL, NULL);
INSERT INTO `localidades` VALUES(873, 1, 1, 'BUENOS AIRES', 'MIRAMAR (BUE)', '7607', NULL, NULL);
INSERT INTO `localidades` VALUES(874, 1, 1, 'BUENOS AIRES', 'MIRAMONTE', '7214', NULL, NULL);
INSERT INTO `localidades` VALUES(875, 1, 1, 'BUENOS AIRES', 'MIRANDA', '7201', NULL, NULL);
INSERT INTO `localidades` VALUES(876, 1, 1, 'BUENOS AIRES', 'MOCTEZUMA', '6531', NULL, NULL);
INSERT INTO `localidades` VALUES(877, 1, 1, 'BUENOS AIRES', 'MOLL', '6627', NULL, NULL);
INSERT INTO `localidades` VALUES(878, 1, 1, 'BUENOS AIRES', 'MONASTERIO', '7136', NULL, NULL);
INSERT INTO `localidades` VALUES(879, 1, 1, 'BUENOS AIRES', 'MONES CAZON', '6469', NULL, NULL);
INSERT INTO `localidades` VALUES(880, 1, 1, 'BUENOS AIRES', 'MONROE', '2741', NULL, NULL);
INSERT INTO `localidades` VALUES(881, 1, 1, 'BUENOS AIRES', 'MONTE CHINGOLO', '1825', NULL, NULL);
INSERT INTO `localidades` VALUES(882, 1, 1, 'BUENOS AIRES', 'MONTE GRANDE', '1842', NULL, NULL);
INSERT INTO `localidades` VALUES(883, 1, 1, 'BUENOS AIRES', 'MONTE HERMOSO', '8153', NULL, NULL);
INSERT INTO `localidades` VALUES(884, 1, 1, 'BUENOS AIRES', 'MONTE VELOZ', '1917', NULL, NULL);
INSERT INTO `localidades` VALUES(885, 1, 1, 'BUENOS AIRES', 'MONTES DE OCA (BUE)', '8136', NULL, NULL);
INSERT INTO `localidades` VALUES(886, 1, 1, 'BUENOS AIRES', 'MOORES', '6230', NULL, NULL);
INSERT INTO `localidades` VALUES(887, 1, 1, 'BUENOS AIRES', 'MOREA', '6507', NULL, NULL);
INSERT INTO `localidades` VALUES(888, 1, 1, 'BUENOS AIRES', 'MORENO', '1744', NULL, NULL);
INSERT INTO `localidades` VALUES(889, 1, 1, 'BUENOS AIRES', 'MORON (BASE OESTE)', '1708', NULL, NULL);
INSERT INTO `localidades` VALUES(890, 1, 1, 'BUENOS AIRES', 'MORSE', '6013', NULL, NULL);
INSERT INTO `localidades` VALUES(891, 1, 1, 'BUENOS AIRES', 'MOURAS', '6471', NULL, NULL);
INSERT INTO `localidades` VALUES(892, 1, 1, 'BUENOS AIRES', 'MULCAMY', '6501', NULL, NULL);
INSERT INTO `localidades` VALUES(893, 1, 1, 'BUENOS AIRES', 'MUNRO', '1605', NULL, NULL);
INSERT INTO `localidades` VALUES(894, 1, 1, 'BUENOS AIRES', 'MUÑIZ', '1663', NULL, NULL);
INSERT INTO `localidades` VALUES(895, 1, 1, 'BUENOS AIRES', 'MUÑOZ', '7404', NULL, NULL);
INSERT INTO `localidades` VALUES(896, 1, 1, 'BUENOS AIRES', 'NAHUEL RUCA', '7613', NULL, NULL);
INSERT INTO `localidades` VALUES(897, 1, 1, 'BUENOS AIRES', 'NAPALEOFU', '7007', NULL, NULL);
INSERT INTO `localidades` VALUES(898, 1, 1, 'BUENOS AIRES', 'NAPOSTA', '8122', NULL, NULL);
INSERT INTO `localidades` VALUES(899, 1, 1, 'BUENOS AIRES', 'NAVARRO', '6505', NULL, NULL);
INSERT INTO `localidades` VALUES(900, 1, 1, 'BUENOS AIRES', 'NECOCHEA', '7630', NULL, NULL);
INSERT INTO `localidades` VALUES(901, 1, 1, 'BUENOS AIRES', 'NECOL', '6077', NULL, NULL);
INSERT INTO `localidades` VALUES(902, 1, 1, 'BUENOS AIRES', 'NEWTON', '7223', NULL, NULL);
INSERT INTO `localidades` VALUES(903, 1, 1, 'BUENOS AIRES', 'NICANOR OLIVERA', '7637', NULL, NULL);
INSERT INTO `localidades` VALUES(904, 1, 1, 'BUENOS AIRES', 'NICOLAS DESCALZI', '8151', NULL, NULL);
INSERT INTO `localidades` VALUES(905, 1, 1, 'BUENOS AIRES', 'NICOLAS LEVALLE', '8151', NULL, NULL);
INSERT INTO `localidades` VALUES(906, 1, 1, 'BUENOS AIRES', 'NIEVES', '7316', NULL, NULL);
INSERT INTO `localidades` VALUES(907, 1, 1, 'BUENOS AIRES', 'NORBERTO DE LA RIEST', '6663', NULL, NULL);
INSERT INTO `localidades` VALUES(908, 1, 1, 'BUENOS AIRES', 'NORUMBEGA', '6501', NULL, NULL);
INSERT INTO `localidades` VALUES(909, 1, 1, 'BUENOS AIRES', 'NUEVA ATLANTIS', '7113', NULL, NULL);
INSERT INTO `localidades` VALUES(910, 1, 1, 'BUENOS AIRES', 'NUEVA PLATA', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(911, 1, 1, 'BUENOS AIRES', 'NUEVA ROMA', '8117', NULL, NULL);
INSERT INTO `localidades` VALUES(912, 1, 1, 'BUENOS AIRES', 'NUEVA SUIZA', '6077', NULL, NULL);
INSERT INTO `localidades` VALUES(913, 1, 1, 'BUENOS AIRES', 'O HIGGINS', '6748', NULL, NULL);
INSERT INTO `localidades` VALUES(914, 1, 1, 'BUENOS AIRES', 'OCHANDIO', '7521', NULL, NULL);
INSERT INTO `localidades` VALUES(915, 1, 1, 'BUENOS AIRES', 'OLASCOAGA', '6652', NULL, NULL);
INSERT INTO `localidades` VALUES(916, 1, 1, 'BUENOS AIRES', 'OLAVARRIA', '7400', NULL, NULL);
INSERT INTO `localidades` VALUES(917, 1, 1, 'BUENOS AIRES', 'OLIDEN', '1981', NULL, NULL);
INSERT INTO `localidades` VALUES(918, 1, 1, 'BUENOS AIRES', 'OLIVERA', '6608', NULL, NULL);
INSERT INTO `localidades` VALUES(919, 1, 1, 'BUENOS AIRES', 'OLIVOS', '1636', NULL, NULL);
INSERT INTO `localidades` VALUES(920, 1, 1, 'BUENOS AIRES', 'OLMOS', '1903', NULL, NULL);
INSERT INTO `localidades` VALUES(921, 1, 1, 'BUENOS AIRES', 'OMBU', '7545', NULL, NULL);
INSERT INTO `localidades` VALUES(922, 1, 1, 'BUENOS AIRES', 'OMBUCTA', '8142', NULL, NULL);
INSERT INTO `localidades` VALUES(923, 1, 1, 'BUENOS AIRES', 'OPENDOOR', '6708', NULL, NULL);
INSERT INTO `localidades` VALUES(924, 1, 1, 'BUENOS AIRES', 'ORDOQUI', '6537', NULL, NULL);
INSERT INTO `localidades` VALUES(925, 1, 1, 'BUENOS AIRES', 'ORENSE', '7503', NULL, NULL);
INSERT INTO `localidades` VALUES(926, 1, 1, 'BUENOS AIRES', 'ORIENTE', '7509', NULL, NULL);
INSERT INTO `localidades` VALUES(927, 1, 1, 'BUENOS AIRES', 'ORTIZ BASUALDO', '2703', NULL, NULL);
INSERT INTO `localidades` VALUES(928, 1, 1, 'BUENOS AIRES', 'ORTIZ DE ROZAS', '6660', NULL, NULL);
INSERT INTO `localidades` VALUES(929, 1, 1, 'BUENOS AIRES', 'OSTENDE', '7167', NULL, NULL);
INSERT INTO `localidades` VALUES(930, 1, 1, 'BUENOS AIRES', 'OTOÑO', '7545', NULL, NULL);
INSERT INTO `localidades` VALUES(931, 1, 1, 'BUENOS AIRES', 'PABLO ACOSTA', '7301', NULL, NULL);
INSERT INTO `localidades` VALUES(932, 1, 1, 'BUENOS AIRES', 'PABLO NOGUES', '1613', NULL, NULL);
INSERT INTO `localidades` VALUES(933, 1, 1, 'BUENOS AIRES', 'PABLO PODESTA', '1657', NULL, NULL);
INSERT INTO `localidades` VALUES(934, 1, 1, 'BUENOS AIRES', 'PALANTELEN', '6640', NULL, NULL);
INSERT INTO `localidades` VALUES(935, 1, 1, 'BUENOS AIRES', 'PALEMON HUERGO', '6628', NULL, NULL);
INSERT INTO `localidades` VALUES(936, 1, 1, 'BUENOS AIRES', 'PARAGUIL', '7412', NULL, NULL);
INSERT INTO `localidades` VALUES(937, 1, 1, 'BUENOS AIRES', 'PARAJE EL GUALICHO', '7200', NULL, NULL);
INSERT INTO `localidades` VALUES(938, 1, 1, 'BUENOS AIRES', 'PARAJE EL PAMPERO', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(939, 1, 1, 'BUENOS AIRES', 'PARAJE ERA PAL', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(940, 1, 1, 'BUENOS AIRES', 'PARAJE SAN ALBERTO', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(941, 1, 1, 'BUENOS AIRES', 'PARAJUIL', '7530', NULL, NULL);
INSERT INTO `localidades` VALUES(942, 1, 1, 'BUENOS AIRES', 'PARDO', '7212', NULL, NULL);
INSERT INTO `localidades` VALUES(943, 1, 1, 'BUENOS AIRES', 'PARISH', '7316', NULL, NULL);
INSERT INTO `localidades` VALUES(944, 1, 1, 'BUENOS AIRES', 'PARQUE HERMOSO', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(945, 1, 1, 'BUENOS AIRES', 'PARQUE INDEPENDENCIA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(946, 1, 1, 'BUENOS AIRES', 'PARQUE INDUSTRIAL GRAL SAVIO', '7601', NULL, NULL);
INSERT INTO `localidades` VALUES(947, 1, 1, 'BUENOS AIRES', 'PARQUE LELIOR', '1713', NULL, NULL);
INSERT INTO `localidades` VALUES(948, 1, 1, 'BUENOS AIRES', 'PARRAVICINI', '7100', NULL, NULL);
INSERT INTO `localidades` VALUES(949, 1, 1, 'BUENOS AIRES', 'PASMAN', '7547', NULL, NULL);
INSERT INTO `localidades` VALUES(950, 1, 1, 'BUENOS AIRES', 'PASO', '1834', NULL, NULL);
INSERT INTO `localidades` VALUES(951, 1, 1, 'BUENOS AIRES', 'PASO DEL REY', '1742', NULL, NULL);
INSERT INTO `localidades` VALUES(952, 1, 1, 'BUENOS AIRES', 'PASO MAYOR', '8115', NULL, NULL);
INSERT INTO `localidades` VALUES(953, 1, 1, 'BUENOS AIRES', 'PASO MAYOR', '8151', NULL, NULL);
INSERT INTO `localidades` VALUES(954, 1, 1, 'BUENOS AIRES', 'PASTEUR', '6077', NULL, NULL);
INSERT INTO `localidades` VALUES(955, 1, 1, 'BUENOS AIRES', 'PATRICIOS', '6503', NULL, NULL);
INSERT INTO `localidades` VALUES(956, 1, 1, 'BUENOS AIRES', 'PAULA', '6557', NULL, NULL);
INSERT INTO `localidades` VALUES(957, 1, 1, 'BUENOS AIRES', 'PAZOS KANKI', '6058', NULL, NULL);
INSERT INTO `localidades` VALUES(958, 1, 1, 'BUENOS AIRES', 'PDA ALASTUEY', '6703', NULL, NULL);
INSERT INTO `localidades` VALUES(959, 1, 1, 'BUENOS AIRES', 'PEARSON', '2711', NULL, NULL);
INSERT INTO `localidades` VALUES(960, 1, 1, 'BUENOS AIRES', 'PEDERNALES', '6665', NULL, NULL);
INSERT INTO `localidades` VALUES(961, 1, 1, 'BUENOS AIRES', 'PEDRO GAMEN', '6451', NULL, NULL);
INSERT INTO `localidades` VALUES(962, 1, 1, 'BUENOS AIRES', 'PEDRO LURO', '8148', NULL, NULL);
INSERT INTO `localidades` VALUES(963, 1, 1, 'BUENOS AIRES', 'PEDRO N. ESCRIBANO', '7135', NULL, NULL);
INSERT INTO `localidades` VALUES(964, 1, 1, 'BUENOS AIRES', 'PEHUAJO', '6450', NULL, NULL);
INSERT INTO `localidades` VALUES(965, 1, 1, 'BUENOS AIRES', 'PEHUELCHES', '6409', NULL, NULL);
INSERT INTO `localidades` VALUES(966, 1, 1, 'BUENOS AIRES', 'PEHUEN CO', '8109', NULL, NULL);
INSERT INTO `localidades` VALUES(967, 1, 1, 'BUENOS AIRES', 'PELICURA', '8117', NULL, NULL);
INSERT INTO `localidades` VALUES(968, 1, 1, 'BUENOS AIRES', 'PELLEGRINI', '6346', NULL, NULL);
INSERT INTO `localidades` VALUES(969, 1, 1, 'BUENOS AIRES', 'PEREZ MILLAN', '2933', NULL, NULL);
INSERT INTO `localidades` VALUES(970, 1, 1, 'BUENOS AIRES', 'PERGAMINO', '2700', NULL, NULL);
INSERT INTO `localidades` VALUES(971, 1, 1, 'BUENOS AIRES', 'PICHINCHA', '6051', NULL, NULL);
INSERT INTO `localidades` VALUES(972, 1, 1, 'BUENOS AIRES', 'PIEDRA ECHADA', '8117', NULL, NULL);
INSERT INTO `localidades` VALUES(973, 1, 1, 'BUENOS AIRES', 'PIEDRITAS', '6241', NULL, NULL);
INSERT INTO `localidades` VALUES(974, 1, 1, 'BUENOS AIRES', 'PIERES', '7633', NULL, NULL);
INSERT INTO `localidades` VALUES(975, 1, 1, 'BUENOS AIRES', 'PIGUE', '8170', NULL, NULL);
INSERT INTO `localidades` VALUES(976, 1, 1, 'BUENOS AIRES', 'PILA', '7116', NULL, NULL);
INSERT INTO `localidades` VALUES(977, 1, 1, 'BUENOS AIRES', 'PILAHUINCO', '7531', NULL, NULL);
INSERT INTO `localidades` VALUES(978, 1, 1, 'BUENOS AIRES', 'PILAR (BUE)', '1629', NULL, NULL);
INSERT INTO `localidades` VALUES(979, 1, 1, 'BUENOS AIRES', 'PILLAGUINCO', '7530', NULL, NULL);
INSERT INTO `localidades` VALUES(980, 1, 1, 'BUENOS AIRES', 'PINAMAR', '7167', NULL, NULL);
INSERT INTO `localidades` VALUES(981, 1, 1, 'BUENOS AIRES', 'PINZON', '2703', NULL, NULL);
INSERT INTO `localidades` VALUES(982, 1, 1, 'BUENOS AIRES', 'PIPINAS', '1921', NULL, NULL);
INSERT INTO `localidades` VALUES(983, 1, 1, 'BUENOS AIRES', 'PIROVANO', '6551', NULL, NULL);
INSERT INTO `localidades` VALUES(984, 1, 1, 'BUENOS AIRES', 'PIÑEYRO', '7548', NULL, NULL);
INSERT INTO `localidades` VALUES(985, 1, 1, 'BUENOS AIRES', 'PLA', '6634', NULL, NULL);
INSERT INTO `localidades` VALUES(986, 1, 1, 'BUENOS AIRES', 'PLATANOS', '1885', NULL, NULL);
INSERT INTO `localidades` VALUES(987, 1, 1, 'BUENOS AIRES', 'PLAYA CHAPADMALAL', '7605', NULL, NULL);
INSERT INTO `localidades` VALUES(988, 1, 1, 'BUENOS AIRES', 'PLAYA SERENA', '7601', NULL, NULL);
INSERT INTO `localidades` VALUES(989, 1, 1, 'BUENOS AIRES', 'PLAYA SERENA', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(990, 1, 1, 'BUENOS AIRES', 'PLAZA MONTERO', '7201', NULL, NULL);
INSERT INTO `localidades` VALUES(991, 1, 1, 'BUENOS AIRES', 'PLOMER', '1741', NULL, NULL);
INSERT INTO `localidades` VALUES(992, 1, 1, 'BUENOS AIRES', 'POLITO', '6430', NULL, NULL);
INSERT INTO `localidades` VALUES(993, 1, 1, 'BUENOS AIRES', 'POLVAREDAS (BUE)', '7267', NULL, NULL);
INSERT INTO `localidades` VALUES(994, 1, 1, 'BUENOS AIRES', 'POLVORINES', '1613', NULL, NULL);
INSERT INTO `localidades` VALUES(995, 1, 1, 'BUENOS AIRES', 'PONTAUT', '7535', NULL, NULL);
INSERT INTO `localidades` VALUES(996, 1, 1, 'BUENOS AIRES', 'PONTEVEDRA', '1761', NULL, NULL);
INSERT INTO `localidades` VALUES(997, 1, 1, 'BUENOS AIRES', 'PORVENIR', '6063', NULL, NULL);
INSERT INTO `localidades` VALUES(998, 1, 1, 'BUENOS AIRES', 'POURTALE', '7404', NULL, NULL);
INSERT INTO `localidades` VALUES(999, 1, 1, 'BUENOS AIRES', 'PRADERE', '6231', NULL, NULL);
INSERT INTO `localidades` VALUES(1000, 1, 1, 'BUENOS AIRES', 'PRESIDENTE DERQUI', '1635', NULL, NULL);
INSERT INTO `localidades` VALUES(1001, 1, 1, 'BUENOS AIRES', 'PRESIDENTE QUINTANA', '6621', NULL, NULL);
INSERT INTO `localidades` VALUES(1002, 1, 1, 'BUENOS AIRES', 'PRIMERA JUNTA', '6422', NULL, NULL);
INSERT INTO `localidades` VALUES(1003, 1, 1, 'BUENOS AIRES', 'PSTE PERON', '1862', NULL, NULL);
INSERT INTO `localidades` VALUES(1004, 1, 1, 'BUENOS AIRES', 'PUAN', '8180', NULL, NULL);
INSERT INTO `localidades` VALUES(1005, 1, 1, 'BUENOS AIRES', 'PUEBLITOS', '6661', NULL, NULL);
INSERT INTO `localidades` VALUES(1006, 1, 1, 'BUENOS AIRES', 'PUEBLO OTERO', '2700', NULL, NULL);
INSERT INTO `localidades` VALUES(1007, 1, 1, 'BUENOS AIRES', 'PUEBLO SAN JOSE (PDO CORONEL SUAREZ', '7541', NULL, NULL);
INSERT INTO `localidades` VALUES(1008, 1, 1, 'BUENOS AIRES', 'PUEBLO SANTA MARIA', '7542', NULL, NULL);
INSERT INTO `localidades` VALUES(1009, 1, 1, 'BUENOS AIRES', 'PUEBLO STA. TRINIDAD', '7541', NULL, NULL);
INSERT INTO `localidades` VALUES(1010, 1, 1, 'BUENOS AIRES', 'PUERTO  OBLIGADO', '2931', NULL, NULL);
INSERT INTO `localidades` VALUES(1011, 1, 1, 'BUENOS AIRES', 'PUERTO BELGRANO', '8111', NULL, NULL);
INSERT INTO `localidades` VALUES(1012, 1, 1, 'BUENOS AIRES', 'PUNTA ALTA', '8109', NULL, NULL);
INSERT INTO `localidades` VALUES(1013, 1, 1, 'BUENOS AIRES', 'PUNTA INDIO', '1917', NULL, NULL);
INSERT INTO `localidades` VALUES(1014, 1, 1, 'BUENOS AIRES', 'PUNTA LARA', '1925', NULL, NULL);
INSERT INTO `localidades` VALUES(1015, 1, 1, 'BUENOS AIRES', 'PUNTA LARA', '1931', NULL, NULL);
INSERT INTO `localidades` VALUES(1016, 1, 1, 'BUENOS AIRES', 'PUNTA MEDANOS', '7109', NULL, NULL);
INSERT INTO `localidades` VALUES(1017, 1, 1, 'BUENOS AIRES', 'QUENUMA', '6335', NULL, NULL);
INSERT INTO `localidades` VALUES(1018, 1, 1, 'BUENOS AIRES', 'QUEQUEN', '7631', NULL, NULL);
INSERT INTO `localidades` VALUES(1019, 1, 1, 'BUENOS AIRES', 'QUILMES', '1878', NULL, NULL);
INSERT INTO `localidades` VALUES(1020, 1, 1, 'BUENOS AIRES', 'QUILMES OESTE', '1879', NULL, NULL);
INSERT INTO `localidades` VALUES(1021, 1, 1, 'BUENOS AIRES', 'QUIRNO COSTA', '6018', NULL, NULL);
INSERT INTO `localidades` VALUES(1022, 1, 1, 'BUENOS AIRES', 'QUIROGA', '6533', NULL, NULL);
INSERT INTO `localidades` VALUES(1023, 1, 1, 'BUENOS AIRES', 'QUIÑIHUAL', '7530', NULL, NULL);
INSERT INTO `localidades` VALUES(1024, 1, 1, 'BUENOS AIRES', 'RAFAEL CALZADA', '1847', NULL, NULL);
INSERT INTO `localidades` VALUES(1025, 1, 1, 'BUENOS AIRES', 'RAFAEL CASTILLO', '1755', NULL, NULL);
INSERT INTO `localidades` VALUES(1026, 1, 1, 'BUENOS AIRES', 'RAFAEL OBLIGADO', '6001', NULL, NULL);
INSERT INTO `localidades` VALUES(1027, 1, 1, 'BUENOS AIRES', 'RAMALLO', '2915', NULL, NULL);
INSERT INTO `localidades` VALUES(1028, 1, 1, 'BUENOS AIRES', 'RAMON J. NEILD', '6533', NULL, NULL);
INSERT INTO `localidades` VALUES(1029, 1, 1, 'BUENOS AIRES', 'RAMON SANTA MARINA', '7641', NULL, NULL);
INSERT INTO `localidades` VALUES(1030, 1, 1, 'BUENOS AIRES', 'RAMOS MEJIA', '1704', NULL, NULL);
INSERT INTO `localidades` VALUES(1031, 1, 1, 'BUENOS AIRES', 'RAMOS OTERO', '7621', NULL, NULL);
INSERT INTO `localidades` VALUES(1032, 1, 1, 'BUENOS AIRES', 'RANCAGUA', '2701', NULL, NULL);
INSERT INTO `localidades` VALUES(1033, 1, 1, 'BUENOS AIRES', 'RANCHOS', '1987', NULL, NULL);
INSERT INTO `localidades` VALUES(1034, 1, 1, 'BUENOS AIRES', 'RANELAGH', '1886', NULL, NULL);
INSERT INTO `localidades` VALUES(1035, 1, 1, 'BUENOS AIRES', 'RAUCH', '7203', NULL, NULL);
INSERT INTO `localidades` VALUES(1036, 1, 1, 'BUENOS AIRES', 'RAULET', '7530', NULL, NULL);
INSERT INTO `localidades` VALUES(1037, 1, 1, 'BUENOS AIRES', 'RAWSON (BUE)', '6734', NULL, NULL);
INSERT INTO `localidades` VALUES(1038, 1, 1, 'BUENOS AIRES', 'REAL AUDIENCIA', '7225', NULL, NULL);
INSERT INTO `localidades` VALUES(1039, 1, 1, 'BUENOS AIRES', 'RECALDE', '6559', NULL, NULL);
INSERT INTO `localidades` VALUES(1040, 1, 1, 'BUENOS AIRES', 'REMEDIOS DE ESCALADA', '1826', NULL, NULL);
INSERT INTO `localidades` VALUES(1041, 1, 1, 'BUENOS AIRES', 'RESERVA', '7536', NULL, NULL);
INSERT INTO `localidades` VALUES(1042, 1, 1, 'BUENOS AIRES', 'RETA', '7511', NULL, NULL);
INSERT INTO `localidades` VALUES(1043, 1, 1, 'BUENOS AIRES', 'RICARDO GAVIÑA', '7313', NULL, NULL);
INSERT INTO `localidades` VALUES(1044, 1, 1, 'BUENOS AIRES', 'RINGUELET', '1901', NULL, NULL);
INSERT INTO `localidades` VALUES(1045, 1, 1, 'BUENOS AIRES', 'RIO TALA', '2944', NULL, NULL);
INSERT INTO `localidades` VALUES(1046, 1, 1, 'BUENOS AIRES', 'RIVADAVIA (BUE)', '6237', NULL, NULL);
INSERT INTO `localidades` VALUES(1047, 1, 1, 'BUENOS AIRES', 'RIVADEO', '8127', NULL, NULL);
INSERT INTO `localidades` VALUES(1048, 1, 1, 'BUENOS AIRES', 'RIVAS', '6614', NULL, NULL);
INSERT INTO `localidades` VALUES(1049, 1, 1, 'BUENOS AIRES', 'RIVERA', '6441', NULL, NULL);
INSERT INTO `localidades` VALUES(1050, 1, 1, 'BUENOS AIRES', 'ROBERTO CANO', '2703', NULL, NULL);
INSERT INTO `localidades` VALUES(1051, 1, 1, 'BUENOS AIRES', 'ROBERTO PAYRO', '1915', NULL, NULL);
INSERT INTO `localidades` VALUES(1052, 1, 1, 'BUENOS AIRES', 'ROBERTS', '6075', NULL, NULL);
INSERT INTO `localidades` VALUES(1053, 1, 1, 'BUENOS AIRES', 'ROCHA', '7404', NULL, NULL);
INSERT INTO `localidades` VALUES(1054, 1, 1, 'BUENOS AIRES', 'ROJAS', '2705', NULL, NULL);
INSERT INTO `localidades` VALUES(1055, 1, 1, 'BUENOS AIRES', 'ROMAN BAEZ', '6612', NULL, NULL);
INSERT INTO `localidades` VALUES(1056, 1, 1, 'BUENOS AIRES', 'ROOSEVELT', '6403', NULL, NULL);
INSERT INTO `localidades` VALUES(1057, 1, 1, 'BUENOS AIRES', 'ROQUE PEREZ', '7245', NULL, NULL);
INSERT INTO `localidades` VALUES(1058, 1, 1, 'BUENOS AIRES', 'ROSAS', '7205', NULL, NULL);
INSERT INTO `localidades` VALUES(1059, 1, 1, 'BUENOS AIRES', 'RUFINO DE ELIZALDE', '1900', NULL, NULL);
INSERT INTO `localidades` VALUES(1060, 1, 1, 'BUENOS AIRES', 'RUIZ SOLIS', '6720', NULL, NULL);
INSERT INTO `localidades` VALUES(1061, 1, 1, 'BUENOS AIRES', 'SAAVEDRA', '8174', NULL, NULL);
INSERT INTO `localidades` VALUES(1062, 1, 1, 'BUENOS AIRES', 'SAENZ PEÑA', '1674', NULL, NULL);
INSERT INTO `localidades` VALUES(1063, 1, 1, 'BUENOS AIRES', 'SAFORCADA', '6022', NULL, NULL);
INSERT INTO `localidades` VALUES(1064, 1, 1, 'BUENOS AIRES', 'SALADILLO (BUE)', '7260', NULL, NULL);
INSERT INTO `localidades` VALUES(1065, 1, 1, 'BUENOS AIRES', 'SALAZAR', '6471', NULL, NULL);
INSERT INTO `localidades` VALUES(1066, 1, 1, 'BUENOS AIRES', 'SALDUNGARAY', '8166', NULL, NULL);
INSERT INTO `localidades` VALUES(1067, 1, 1, 'BUENOS AIRES', 'SALLIQUELO', '6339', NULL, NULL);
INSERT INTO `localidades` VALUES(1068, 1, 1, 'BUENOS AIRES', 'SALTO', '2741', NULL, NULL);
INSERT INTO `localidades` VALUES(1069, 1, 1, 'BUENOS AIRES', 'SALVADOR MARIA', '7241', NULL, NULL);
INSERT INTO `localidades` VALUES(1070, 1, 1, 'BUENOS AIRES', 'SAMBOROMBOM', '1980', NULL, NULL);
INSERT INTO `localidades` VALUES(1071, 1, 1, 'BUENOS AIRES', 'SAN AGUSTIN (BUE)', '7621', NULL, NULL);
INSERT INTO `localidades` VALUES(1072, 1, 1, 'BUENOS AIRES', 'SAN ANDRES (BUE)', '1651', NULL, NULL);
INSERT INTO `localidades` VALUES(1073, 1, 1, 'BUENOS AIRES', 'SAN ANDRES DE GILES', '6720', NULL, NULL);
INSERT INTO `localidades` VALUES(1074, 1, 1, 'BUENOS AIRES', 'SAN ANTONIO DE ARECO', '2760', NULL, NULL);
INSERT INTO `localidades` VALUES(1075, 1, 1, 'BUENOS AIRES', 'SAN ANTONIO DE PADUA', '1718', NULL, NULL);
INSERT INTO `localidades` VALUES(1076, 1, 1, 'BUENOS AIRES', 'SAN BENITO (BUE)', '7261', NULL, NULL);
INSERT INTO `localidades` VALUES(1077, 1, 1, 'BUENOS AIRES', 'SAN BERNARDO', '7111', NULL, NULL);
INSERT INTO `localidades` VALUES(1078, 1, 1, 'BUENOS AIRES', 'SAN BERNARDO (BUE)', '6561', NULL, NULL);
INSERT INTO `localidades` VALUES(1079, 1, 1, 'BUENOS AIRES', 'SAN BERNARDO DE PEHO', '6476', NULL, NULL);
INSERT INTO `localidades` VALUES(1080, 1, 1, 'BUENOS AIRES', 'SAN CARLOS', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(1081, 1, 1, 'BUENOS AIRES', 'SAN CAYETANO', '7521', NULL, NULL);
INSERT INTO `localidades` VALUES(1082, 1, 1, 'BUENOS AIRES', 'SAN CLEMENTE DEL TUY', '7105', NULL, NULL);
INSERT INTO `localidades` VALUES(1083, 1, 1, 'BUENOS AIRES', 'SAN EMILIO', '6017', NULL, NULL);
INSERT INTO `localidades` VALUES(1084, 1, 1, 'BUENOS AIRES', 'SAN ENRIQUE', '6661', NULL, NULL);
INSERT INTO `localidades` VALUES(1085, 1, 1, 'BUENOS AIRES', 'SAN ESTEBAN (BUE)', '6476', NULL, NULL);
INSERT INTO `localidades` VALUES(1086, 1, 1, 'BUENOS AIRES', 'SAN FERMIN', '6417', NULL, NULL);
INSERT INTO `localidades` VALUES(1087, 1, 1, 'BUENOS AIRES', 'SAN FERNANDO (BUE)', '1646', NULL, NULL);
INSERT INTO `localidades` VALUES(1088, 1, 1, 'BUENOS AIRES', 'SAN FRANCISCO DE BELLOCQ', '7505', NULL, NULL);
INSERT INTO `localidades` VALUES(1089, 1, 1, 'BUENOS AIRES', 'SAN FRANCISCO SOLANO', '1881', NULL, NULL);
INSERT INTO `localidades` VALUES(1090, 1, 1, 'BUENOS AIRES', 'SAN GERMAN', '8124', NULL, NULL);
INSERT INTO `localidades` VALUES(1091, 1, 1, 'BUENOS AIRES', 'SAN IGNACIO', '7151', NULL, NULL);
INSERT INTO `localidades` VALUES(1092, 1, 1, 'BUENOS AIRES', 'SAN ISIDRO (BUE)', '1642', NULL, NULL);
INSERT INTO `localidades` VALUES(1093, 1, 1, 'BUENOS AIRES', 'SAN JACINTO', '6600', NULL, NULL);
INSERT INTO `localidades` VALUES(1094, 1, 1, 'BUENOS AIRES', 'SAN JACINTO (BUE)', '7400', NULL, NULL);
INSERT INTO `localidades` VALUES(1095, 1, 1, 'BUENOS AIRES', 'SAN JACINTO (BUE)', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(1096, 1, 1, 'BUENOS AIRES', 'SAN JORGE ( BUE)', '7404', NULL, NULL);
INSERT INTO `localidades` VALUES(1097, 1, 1, 'BUENOS AIRES', 'SAN JOSE', '1846', NULL, NULL);
INSERT INTO `localidades` VALUES(1098, 1, 1, 'BUENOS AIRES', 'SAN JOSE (ALGARROBO, PDO PUAN)', '8136', NULL, NULL);
INSERT INTO `localidades` VALUES(1099, 1, 1, 'BUENOS AIRES', 'SAN JOSE (BAUDRIX, PDO ALBERTI)', '6643', NULL, NULL);
INSERT INTO `localidades` VALUES(1100, 1, 1, 'BUENOS AIRES', 'SAN JOSE (ERNESTINA, PDO 25 DE MAYO', '6665', NULL, NULL);
INSERT INTO `localidades` VALUES(1101, 1, 1, 'BUENOS AIRES', 'SAN JOSE (PDO NECOCHEA)', '7635', NULL, NULL);
INSERT INTO `localidades` VALUES(1102, 1, 1, 'BUENOS AIRES', 'SAN JOSE (ZONA RAUCH)', '7203', NULL, NULL);
INSERT INTO `localidades` VALUES(1103, 1, 1, 'BUENOS AIRES', 'SAN JOSE DE GALI', '7114', NULL, NULL);
INSERT INTO `localidades` VALUES(1104, 1, 1, 'BUENOS AIRES', 'SAN JOSE DE LOS QUINTEROS', '7109', NULL, NULL);
INSERT INTO `localidades` VALUES(1105, 1, 1, 'BUENOS AIRES', 'SAN JOSE DE OTAMENDI', '7601', NULL, NULL);
INSERT INTO `localidades` VALUES(1106, 1, 1, 'BUENOS AIRES', 'SAN JUSTO (BUE)', '1754', NULL, NULL);
INSERT INTO `localidades` VALUES(1107, 1, 1, 'BUENOS AIRES', 'SAN MANUEL', '7007', NULL, NULL);
INSERT INTO `localidades` VALUES(1108, 1, 1, 'BUENOS AIRES', 'SAN MARTIN (BUE)', '1650', NULL, NULL);
INSERT INTO `localidades` VALUES(1109, 1, 1, 'BUENOS AIRES', 'SAN MAURICIO', '6239', NULL, NULL);
INSERT INTO `localidades` VALUES(1110, 1, 1, 'BUENOS AIRES', 'SAN MAYOL', '7519', NULL, NULL);
INSERT INTO `localidades` VALUES(1111, 1, 1, 'BUENOS AIRES', 'SAN MIGUEL (BUE)', '1663', NULL, NULL);
INSERT INTO `localidades` VALUES(1112, 1, 1, 'BUENOS AIRES', 'SAN MIGUEL DEL MONTE', '7220', NULL, NULL);
INSERT INTO `localidades` VALUES(1113, 1, 1, 'BUENOS AIRES', 'SAN NICOLAS', '2900', NULL, NULL);
INSERT INTO `localidades` VALUES(1114, 1, 1, 'BUENOS AIRES', 'SAN PATRICIO', '6734', NULL, NULL);
INSERT INTO `localidades` VALUES(1115, 1, 1, 'BUENOS AIRES', 'SAN PATRICIO', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(1116, 1, 1, 'BUENOS AIRES', 'SAN PEDRO (BUE)', '2930', NULL, NULL);
INSERT INTO `localidades` VALUES(1117, 1, 1, 'BUENOS AIRES', 'SAN QUILCO', '7406', NULL, NULL);
INSERT INTO `localidades` VALUES(1118, 1, 1, 'BUENOS AIRES', 'SAN ROMAN', '8154', NULL, NULL);
INSERT INTO `localidades` VALUES(1119, 1, 1, 'BUENOS AIRES', 'SAN SEBASTIAN', '6623', NULL, NULL);
INSERT INTO `localidades` VALUES(1120, 1, 1, 'BUENOS AIRES', 'SAN VICENTE (BUE)', '1865', NULL, NULL);
INSERT INTO `localidades` VALUES(1121, 1, 1, 'BUENOS AIRES', 'SANCHEZ', '2912', NULL, NULL);
INSERT INTO `localidades` VALUES(1122, 1, 1, 'BUENOS AIRES', 'SANSINENA', '6233', NULL, NULL);
INSERT INTO `localidades` VALUES(1123, 1, 1, 'BUENOS AIRES', 'SANTA CELINA', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(1124, 1, 1, 'BUENOS AIRES', 'SANTA CLARA DEL MAR', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(1125, 1, 1, 'BUENOS AIRES', 'SANTA COLOMA', '2761', NULL, NULL);
INSERT INTO `localidades` VALUES(1126, 1, 1, 'BUENOS AIRES', 'SANTA ELENA (BUE)', '7414', NULL, NULL);
INSERT INTO `localidades` VALUES(1127, 1, 1, 'BUENOS AIRES', 'SANTA ELEODORA', '6241', NULL, NULL);
INSERT INTO `localidades` VALUES(1128, 1, 1, 'BUENOS AIRES', 'SANTA FELICIA', '7243', NULL, NULL);
INSERT INTO `localidades` VALUES(1129, 1, 1, 'BUENOS AIRES', 'SANTA INES', '6471', NULL, NULL);
INSERT INTO `localidades` VALUES(1130, 1, 1, 'BUENOS AIRES', 'SANTA ISABEL', '7609', NULL, NULL);
INSERT INTO `localidades` VALUES(1131, 1, 1, 'BUENOS AIRES', 'SANTA LUCIA (BUE)', '2935', NULL, NULL);
INSERT INTO `localidades` VALUES(1132, 1, 1, 'BUENOS AIRES', 'SANTA LUISA', '7401', NULL, NULL);
INSERT INTO `localidades` VALUES(1133, 1, 1, 'BUENOS AIRES', 'SANTA REGINA', '6105', NULL, NULL);
INSERT INTO `localidades` VALUES(1134, 1, 1, 'BUENOS AIRES', 'SANTA RITA - PARTIDO GUAMINI', '6437', NULL, NULL);
INSERT INTO `localidades` VALUES(1135, 1, 1, 'BUENOS AIRES', 'SANTA TERESITA', '7107', NULL, NULL);
INSERT INTO `localidades` VALUES(1136, 1, 1, 'BUENOS AIRES', 'SANTIAGO GARBARINI', '6660', NULL, NULL);
INSERT INTO `localidades` VALUES(1137, 1, 1, 'BUENOS AIRES', 'SANTIAGO LARRE', '7245', NULL, NULL);
INSERT INTO `localidades` VALUES(1138, 1, 1, 'BUENOS AIRES', 'SANTO DOMINGO (BUE)', '7119', NULL, NULL);
INSERT INTO `localidades` VALUES(1139, 1, 1, 'BUENOS AIRES', 'SANTO TOMAS', '6530', NULL, NULL);
INSERT INTO `localidades` VALUES(1140, 1, 1, 'BUENOS AIRES', 'SANTOS LUGARES', '1676', NULL, NULL);
INSERT INTO `localidades` VALUES(1141, 1, 1, 'BUENOS AIRES', 'SANTOS UNZUE', '6507', NULL, NULL);
INSERT INTO `localidades` VALUES(1142, 1, 1, 'BUENOS AIRES', 'SARANDI', '1872', NULL, NULL);
INSERT INTO `localidades` VALUES(1143, 1, 1, 'BUENOS AIRES', 'SARASA', '2721', NULL, NULL);
INSERT INTO `localidades` VALUES(1144, 1, 1, 'BUENOS AIRES', 'SEVIGNE', '7101', NULL, NULL);
INSERT INTO `localidades` VALUES(1145, 1, 1, 'BUENOS AIRES', 'SHAW', '7316', NULL, NULL);
INSERT INTO `localidades` VALUES(1146, 1, 1, 'BUENOS AIRES', 'SIERRA CHICA', '7401', NULL, NULL);
INSERT INTO `localidades` VALUES(1147, 1, 1, 'BUENOS AIRES', 'SIERRA DE LA VENTANA', '8168', NULL, NULL);
INSERT INTO `localidades` VALUES(1148, 1, 1, 'BUENOS AIRES', 'SIERRA DE LOS PADRES', '7601', NULL, NULL);
INSERT INTO `localidades` VALUES(1149, 1, 1, 'BUENOS AIRES', 'SIERRAS BAYAS', '7403', NULL, NULL);
INSERT INTO `localidades` VALUES(1150, 1, 1, 'BUENOS AIRES', 'SMITH', '6531', NULL, NULL);
INSERT INTO `localidades` VALUES(1151, 1, 1, 'BUENOS AIRES', 'SOL DE MAYO (BUE)', '2709', NULL, NULL);
INSERT INTO `localidades` VALUES(1152, 1, 1, 'BUENOS AIRES', 'SOLANET', '7151', NULL, NULL);
INSERT INTO `localidades` VALUES(1153, 1, 1, 'BUENOS AIRES', 'SOLIS', '2764', NULL, NULL);
INSERT INTO `localidades` VALUES(1154, 1, 1, 'BUENOS AIRES', 'SPEGAZZINI', '1813', NULL, NULL);
INSERT INTO `localidades` VALUES(1155, 1, 1, 'BUENOS AIRES', 'STEGMANN', '7536', NULL, NULL);
INSERT INTO `localidades` VALUES(1156, 1, 1, 'BUENOS AIRES', 'STELLA MARIS', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(1157, 1, 1, 'BUENOS AIRES', 'STRÖEDER', '8505', NULL, NULL);
INSERT INTO `localidades` VALUES(1158, 1, 1, 'BUENOS AIRES', 'SUIPACHA', '6612', NULL, NULL);
INSERT INTO `localidades` VALUES(1159, 1, 1, 'BUENOS AIRES', 'SUNDBLAND', '6401', NULL, NULL);
INSERT INTO `localidades` VALUES(1160, 1, 1, 'BUENOS AIRES', 'TACUARI', '2743', NULL, NULL);
INSERT INTO `localidades` VALUES(1161, 1, 1, 'BUENOS AIRES', 'TAMANGUEYU', '7633', NULL, NULL);
INSERT INTO `localidades` VALUES(1162, 1, 1, 'BUENOS AIRES', 'TAMBO NUEVO', '2700', NULL, NULL);
INSERT INTO `localidades` VALUES(1163, 1, 1, 'BUENOS AIRES', 'TANDIL', '7000', NULL, NULL);
INSERT INTO `localidades` VALUES(1164, 1, 1, 'BUENOS AIRES', 'TAPALQUE', '7303', NULL, NULL);
INSERT INTO `localidades` VALUES(1165, 1, 1, 'BUENOS AIRES', 'TAPIALES', '1770', NULL, NULL);
INSERT INTO `localidades` VALUES(1166, 1, 1, 'BUENOS AIRES', 'TATAY', '6721', NULL, NULL);
INSERT INTO `localidades` VALUES(1167, 1, 1, 'BUENOS AIRES', 'TEDIN URIBURU', '7021', NULL, NULL);
INSERT INTO `localidades` VALUES(1168, 1, 1, 'BUENOS AIRES', 'TEMPERLEY', '1834', NULL, NULL);
INSERT INTO `localidades` VALUES(1169, 1, 1, 'BUENOS AIRES', 'TENIENTE CORONEL MIÑANA', '7401', NULL, NULL);
INSERT INTO `localidades` VALUES(1170, 1, 1, 'BUENOS AIRES', 'TENIENTE ORIGONE', '8144', NULL, NULL);
INSERT INTO `localidades` VALUES(1171, 1, 1, 'BUENOS AIRES', 'THAMES', '6343', NULL, NULL);
INSERT INTO `localidades` VALUES(1172, 1, 1, 'BUENOS AIRES', 'TIGRE', '1648', NULL, NULL);
INSERT INTO `localidades` VALUES(1173, 1, 1, 'BUENOS AIRES', 'TIMOTE', '6457', NULL, NULL);
INSERT INTO `localidades` VALUES(1174, 1, 1, 'BUENOS AIRES', 'TODD', '2754', NULL, NULL);
INSERT INTO `localidades` VALUES(1175, 1, 1, 'BUENOS AIRES', 'TOLOSA', '1903', NULL, NULL);
INSERT INTO `localidades` VALUES(1176, 1, 1, 'BUENOS AIRES', 'TOMAS JOFRE', '6601', NULL, NULL);
INSERT INTO `localidades` VALUES(1177, 1, 1, 'BUENOS AIRES', 'TORDILLO', '7101', NULL, NULL);
INSERT INTO `localidades` VALUES(1178, 1, 1, 'BUENOS AIRES', 'TORDILLO (BUE)', '7101', NULL, NULL);
INSERT INTO `localidades` VALUES(1179, 1, 1, 'BUENOS AIRES', 'TORO', '1635', NULL, NULL);
INSERT INTO `localidades` VALUES(1180, 1, 1, 'BUENOS AIRES', 'TORQUINST', '8160', NULL, NULL);
INSERT INTO `localidades` VALUES(1181, 1, 1, 'BUENOS AIRES', 'TORRES', '6703', NULL, NULL);
INSERT INTO `localidades` VALUES(1182, 1, 1, 'BUENOS AIRES', 'TORTUGUITAS', '1667', NULL, NULL);
INSERT INTO `localidades` VALUES(1183, 1, 1, 'BUENOS AIRES', 'TRANSRADIO', '1776', NULL, NULL);
INSERT INTO `localidades` VALUES(1184, 1, 1, 'BUENOS AIRES', 'TRENQUE LAUQUEN', '6400', NULL, NULL);
INSERT INTO `localidades` VALUES(1185, 1, 1, 'BUENOS AIRES', 'TRES ALGARROBOS', '6231', NULL, NULL);
INSERT INTO `localidades` VALUES(1186, 1, 1, 'BUENOS AIRES', 'TRES ARROYOS', '7500', NULL, NULL);
INSERT INTO `localidades` VALUES(1187, 1, 1, 'BUENOS AIRES', 'TRES CUERVOS', '8183', NULL, NULL);
INSERT INTO `localidades` VALUES(1188, 1, 1, 'BUENOS AIRES', 'TRES LAGUNAS (BUE)', '6443', NULL, NULL);
INSERT INTO `localidades` VALUES(1189, 1, 1, 'BUENOS AIRES', 'TRES LEGUAS', '7100', NULL, NULL);
INSERT INTO `localidades` VALUES(1190, 1, 1, 'BUENOS AIRES', 'TRES LOMAS', '6409', NULL, NULL);
INSERT INTO `localidades` VALUES(1191, 1, 1, 'BUENOS AIRES', 'TRES PICOS', '8162', NULL, NULL);
INSERT INTO `localidades` VALUES(1192, 1, 1, 'BUENOS AIRES', 'TRES SARGENTOS', '6727', NULL, NULL);
INSERT INTO `localidades` VALUES(1193, 1, 1, 'BUENOS AIRES', 'TRIGALES', '6053', NULL, NULL);
INSERT INTO `localidades` VALUES(1194, 1, 1, 'BUENOS AIRES', 'TRISTAN SUAREZ', '1806', NULL, NULL);
INSERT INTO `localidades` VALUES(1195, 1, 1, 'BUENOS AIRES', 'TRIUNVIRATO', '6071', NULL, NULL);
INSERT INTO `localidades` VALUES(1196, 1, 1, 'BUENOS AIRES', 'TRONCOS DEL TALAR', '1618', NULL, NULL);
INSERT INTO `localidades` VALUES(1197, 1, 1, 'BUENOS AIRES', 'TRONGE', '6407', NULL, NULL);
INSERT INTO `localidades` VALUES(1198, 1, 1, 'BUENOS AIRES', 'TRUJUY', '1664', NULL, NULL);
INSERT INTO `localidades` VALUES(1199, 1, 1, 'BUENOS AIRES', 'TURDERA', '1834', NULL, NULL);
INSERT INTO `localidades` VALUES(1200, 1, 1, 'BUENOS AIRES', 'TUYUTI', '6721', NULL, NULL);
INSERT INTO `localidades` VALUES(1201, 1, 1, 'BUENOS AIRES', 'UBALLES', '7301', NULL, NULL);
INSERT INTO `localidades` VALUES(1202, 1, 1, 'BUENOS AIRES', 'UDAQUIOLA', '7151', NULL, NULL);
INSERT INTO `localidades` VALUES(1203, 1, 1, 'BUENOS AIRES', 'UNION (BUE)', '1804', NULL, NULL);
INSERT INTO `localidades` VALUES(1204, 1, 1, 'BUENOS AIRES', 'URDAMPILLETA', '6553', NULL, NULL);
INSERT INTO `localidades` VALUES(1205, 1, 1, 'BUENOS AIRES', 'URIBELARREA', '1815', NULL, NULL);
INSERT INTO `localidades` VALUES(1206, 1, 1, 'BUENOS AIRES', 'URQUIZA', '1718', NULL, NULL);
INSERT INTO `localidades` VALUES(1207, 1, 1, 'BUENOS AIRES', 'URQUIZA (BUE)', '2718', NULL, NULL);
INSERT INTO `localidades` VALUES(1208, 1, 1, 'BUENOS AIRES', 'VAGUES', '2764', NULL, NULL);
INSERT INTO `localidades` VALUES(1209, 1, 1, 'BUENOS AIRES', 'VALDES', '6667', NULL, NULL);
INSERT INTO `localidades` VALUES(1210, 1, 1, 'BUENOS AIRES', 'VALENTIN ALSINA', '1822', NULL, NULL);
INSERT INTO `localidades` VALUES(1211, 1, 1, 'BUENOS AIRES', 'VALENTIN GOMEZ', '6401', NULL, NULL);
INSERT INTO `localidades` VALUES(1212, 1, 1, 'BUENOS AIRES', 'VALERIA DEL MAR', '7167', NULL, NULL);
INSERT INTO `localidades` VALUES(1213, 1, 1, 'BUENOS AIRES', 'VALLE HERMOSO', '7600', NULL, NULL);
INSERT INTO `localidades` VALUES(1214, 1, 1, 'BUENOS AIRES', 'VALLIMANCA', '6557', NULL, NULL);
INSERT INTO `localidades` VALUES(1215, 1, 1, 'BUENOS AIRES', 'VASQUEZ', '7519', NULL, NULL);
INSERT INTO `localidades` VALUES(1216, 1, 1, 'BUENOS AIRES', 'VEDIA', '6030', NULL, NULL);
INSERT INTO `localidades` VALUES(1217, 1, 1, 'BUENOS AIRES', 'VELA', '7003', NULL, NULL);
INSERT INTO `localidades` VALUES(1218, 1, 1, 'BUENOS AIRES', 'VELLOSO', '7305', NULL, NULL);
INSERT INTO `localidades` VALUES(1219, 1, 1, 'BUENOS AIRES', 'VERGARA', '7135', NULL, NULL);
INSERT INTO `localidades` VALUES(1220, 1, 1, 'BUENOS AIRES', 'VERONICA', '1917', NULL, NULL);
INSERT INTO `localidades` VALUES(1221, 1, 1, 'BUENOS AIRES', 'VICENTE CASARES', '1808', NULL, NULL);
INSERT INTO `localidades` VALUES(1222, 1, 1, 'BUENOS AIRES', 'VICENTE LOPEZ (NORTE', '1638', NULL, NULL);
INSERT INTO `localidades` VALUES(1223, 1, 1, 'BUENOS AIRES', 'VICENTE PEREDA', '7300', NULL, NULL);
INSERT INTO `localidades` VALUES(1224, 1, 1, 'BUENOS AIRES', 'VICTORIA (BUE)', '1644', NULL, NULL);
INSERT INTO `localidades` VALUES(1225, 1, 1, 'BUENOS AIRES', 'VICTORINO DELA PLAZA', '6411', NULL, NULL);
INSERT INTO `localidades` VALUES(1226, 1, 1, 'BUENOS AIRES', 'VIEYTES', '1915', NULL, NULL);
INSERT INTO `localidades` VALUES(1227, 1, 1, 'BUENOS AIRES', 'VILELA', '7208', NULL, NULL);
INSERT INTO `localidades` VALUES(1228, 1, 1, 'BUENOS AIRES', 'VILLA  ASTOLFI', '1633', NULL, NULL);
INSERT INTO `localidades` VALUES(1229, 1, 1, 'BUENOS AIRES', 'VILLA ADELINA', '1607', NULL, NULL);
INSERT INTO `localidades` VALUES(1230, 1, 1, 'BUENOS AIRES', 'VILLA ALBERTINA', '1773', NULL, NULL);
INSERT INTO `localidades` VALUES(1231, 1, 1, 'BUENOS AIRES', 'VILLA ALBERTINA', '1828', NULL, NULL);
INSERT INTO `localidades` VALUES(1232, 1, 1, 'BUENOS AIRES', 'VILLA ANGELICA', '1888', NULL, NULL);
INSERT INTO `localidades` VALUES(1233, 1, 1, 'BUENOS AIRES', 'VILLA ARCADIA', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(1234, 1, 1, 'BUENOS AIRES', 'VILLA ARRIETA', '7403', NULL, NULL);
INSERT INTO `localidades` VALUES(1235, 1, 1, 'BUENOS AIRES', 'VILLA BALLESTER', '1653', NULL, NULL);
INSERT INTO `localidades` VALUES(1236, 1, 1, 'BUENOS AIRES', 'VILLA BONICH', '1650', NULL, NULL);
INSERT INTO `localidades` VALUES(1237, 1, 1, 'BUENOS AIRES', 'VILLA BOSCH', '1682', NULL, NULL);
INSERT INTO `localidades` VALUES(1238, 1, 1, 'BUENOS AIRES', 'VILLA CACIQUE', '7005', NULL, NULL);
INSERT INTO `localidades` VALUES(1239, 1, 1, 'BUENOS AIRES', 'VILLA CAPDEPONT', '2800', NULL, NULL);
INSERT INTO `localidades` VALUES(1240, 1, 1, 'BUENOS AIRES', 'VILLA CAROLA', '6555', NULL, NULL);
INSERT INTO `localidades` VALUES(1241, 1, 1, 'BUENOS AIRES', 'VILLA CARUCHA', '7505', NULL, NULL);
INSERT INTO `localidades` VALUES(1242, 1, 1, 'BUENOS AIRES', 'VILLA CASTELAR', '8181', NULL, NULL);
INSERT INTO `localidades` VALUES(1243, 1, 1, 'BUENOS AIRES', 'VILLA CASTELAR EST ERIZE', '6430', NULL, NULL);
INSERT INTO `localidades` VALUES(1244, 1, 1, 'BUENOS AIRES', 'VILLA CELINA', '1772', NULL, NULL);
INSERT INTO `localidades` VALUES(1245, 1, 1, 'BUENOS AIRES', 'VILLA DA FONTE', '2718', NULL, NULL);
INSERT INTO `localidades` VALUES(1246, 1, 1, 'BUENOS AIRES', 'VILLA DE MAYO', '1614', NULL, NULL);
INSERT INTO `localidades` VALUES(1247, 1, 1, 'BUENOS AIRES', 'VILLA DEPIERI', '2930', NULL, NULL);
INSERT INTO `localidades` VALUES(1248, 1, 1, 'BUENOS AIRES', 'VILLA DOMINICO', '1874', NULL, NULL);
INSERT INTO `localidades` VALUES(1249, 1, 1, 'BUENOS AIRES', 'VILLA ELISA (BUE)', '1894', NULL, NULL);
INSERT INTO `localidades` VALUES(1250, 1, 1, 'BUENOS AIRES', 'VILLA ESPIL', '6712', NULL, NULL);
INSERT INTO `localidades` VALUES(1251, 1, 1, 'BUENOS AIRES', 'VILLA FIORITO', '1773', NULL, NULL);
INSERT INTO `localidades` VALUES(1252, 1, 1, 'BUENOS AIRES', 'VILLA FLANDRIA', '6706', NULL, NULL);
INSERT INTO `localidades` VALUES(1253, 1, 1, 'BUENOS AIRES', 'VILLA FORTABAT', '7403', NULL, NULL);
INSERT INTO `localidades` VALUES(1254, 1, 1, 'BUENOS AIRES', 'VILLA GENERAL ARIAS', '8101', NULL, NULL);
INSERT INTO `localidades` VALUES(1255, 1, 1, 'BUENOS AIRES', 'VILLA GESELL', '7165', NULL, NULL);
INSERT INTO `localidades` VALUES(1256, 1, 1, 'BUENOS AIRES', 'VILLA GOBERNADOR UDAONDO', '1713', NULL, NULL);
INSERT INTO `localidades` VALUES(1257, 1, 1, 'BUENOS AIRES', 'VILLA IRIS', '8126', NULL, NULL);
INSERT INTO `localidades` VALUES(1258, 1, 1, 'BUENOS AIRES', 'VILLA LA ÑATA', '1648', NULL, NULL);
INSERT INTO `localidades` VALUES(1259, 1, 1, 'BUENOS AIRES', 'VILLA LIA', '2761', NULL, NULL);
INSERT INTO `localidades` VALUES(1260, 1, 1, 'BUENOS AIRES', 'VILLA LUZURIAGA', '1753', NULL, NULL);
INSERT INTO `localidades` VALUES(1261, 1, 1, 'BUENOS AIRES', 'VILLA LYNCH', '1672', NULL, NULL);
INSERT INTO `localidades` VALUES(1262, 1, 1, 'BUENOS AIRES', 'VILLA MADERO', '1768', NULL, NULL);
INSERT INTO `localidades` VALUES(1263, 1, 1, 'BUENOS AIRES', 'VILLA MAIPU', '1650', NULL, NULL);
INSERT INTO `localidades` VALUES(1264, 1, 1, 'BUENOS AIRES', 'VILLA MARGARITA', '8185', NULL, NULL);
INSERT INTO `localidades` VALUES(1265, 1, 1, 'BUENOS AIRES', 'VILLA MARIA (BUE)', '6628', NULL, NULL);
INSERT INTO `localidades` VALUES(1266, 1, 1, 'BUENOS AIRES', 'VILLA MARTELLI', '1603', NULL, NULL);
INSERT INTO `localidades` VALUES(1267, 1, 1, 'BUENOS AIRES', 'VILLA MAZA', '6343', NULL, NULL);
INSERT INTO `localidades` VALUES(1268, 1, 1, 'BUENOS AIRES', 'VILLA MONICA', '7318', NULL, NULL);
INSERT INTO `localidades` VALUES(1269, 1, 1, 'BUENOS AIRES', 'VILLA MOQUEHUA', '6625', NULL, NULL);
INSERT INTO `localidades` VALUES(1270, 1, 1, 'BUENOS AIRES', 'VILLA NUMANCIA', '1858', NULL, NULL);
INSERT INTO `localidades` VALUES(1271, 1, 1, 'BUENOS AIRES', 'VILLA OLGA GRUMBEIN', '8000', NULL, NULL);
INSERT INTO `localidades` VALUES(1272, 1, 1, 'BUENOS AIRES', 'VILLA RAMALLO', '2914', NULL, NULL);
INSERT INTO `localidades` VALUES(1273, 1, 1, 'BUENOS AIRES', 'VILLA ROCH', '7101', NULL, NULL);
INSERT INTO `localidades` VALUES(1274, 1, 1, 'BUENOS AIRES', 'VILLA ROSA', '1631', NULL, NULL);
INSERT INTO `localidades` VALUES(1275, 1, 1, 'BUENOS AIRES', 'VILLA SABOYA', '6101', NULL, NULL);
INSERT INTO `localidades` VALUES(1276, 1, 1, 'BUENOS AIRES', 'VILLA SAN JOSE', '2743', NULL, NULL);
INSERT INTO `localidades` VALUES(1277, 1, 1, 'BUENOS AIRES', 'VILLA SANZ', '6511', NULL, NULL);
INSERT INTO `localidades` VALUES(1278, 1, 1, 'BUENOS AIRES', 'VILLA SAUCE', '6235', NULL, NULL);
INSERT INTO `localidades` VALUES(1279, 1, 1, 'BUENOS AIRES', 'VILLA SAURI', '6430', NULL, NULL);
INSERT INTO `localidades` VALUES(1280, 1, 1, 'BUENOS AIRES', 'VILLA SAUZE', '6235', NULL, NULL);
INSERT INTO `localidades` VALUES(1281, 1, 1, 'BUENOS AIRES', 'VILLA SENA', '6403', NULL, NULL);
INSERT INTO `localidades` VALUES(1282, 1, 1, 'BUENOS AIRES', 'VILLA SUIZA', '6077', NULL, NULL);
INSERT INTO `localidades` VALUES(1283, 1, 1, 'BUENOS AIRES', 'VILLA TESEI', '1688', NULL, NULL);
INSERT INTO `localidades` VALUES(1284, 1, 1, 'BUENOS AIRES', 'VILLA VATTEONE', '1888', NULL, NULL);
INSERT INTO `localidades` VALUES(1285, 1, 1, 'BUENOS AIRES', 'VILLALONGA', '8512', NULL, NULL);
INSERT INTO `localidades` VALUES(1286, 1, 1, 'BUENOS AIRES', 'VILLANUEVA (BUE)', '7225', NULL, NULL);
INSERT INTO `localidades` VALUES(1287, 1, 1, 'BUENOS AIRES', 'VILLARS', '1731', NULL, NULL);
INSERT INTO `localidades` VALUES(1288, 1, 1, 'BUENOS AIRES', 'VIRREY DEL PINO', '1763', NULL, NULL);
INSERT INTO `localidades` VALUES(1289, 1, 1, 'BUENOS AIRES', 'VIRREYES', '1644', NULL, NULL);
INSERT INTO `localidades` VALUES(1290, 1, 1, 'BUENOS AIRES', 'VIVORAS', '8180', NULL, NULL);
INSERT INTO `localidades` VALUES(1291, 1, 1, 'BUENOS AIRES', 'VIVORATA', '7612', NULL, NULL);
INSERT INTO `localidades` VALUES(1292, 1, 1, 'BUENOS AIRES', 'VIÑA', '2754', NULL, NULL);
INSERT INTO `localidades` VALUES(1293, 1, 1, 'BUENOS AIRES', 'VOLTA', '6064', NULL, NULL);
INSERT INTO `localidades` VALUES(1294, 1, 1, 'BUENOS AIRES', 'VOLUNTAD', '7412', NULL, NULL);
INSERT INTO `localidades` VALUES(1295, 1, 1, 'BUENOS AIRES', 'VUELTA DE OBLIGADO', '2931', NULL, NULL);
INSERT INTO `localidades` VALUES(1296, 1, 1, 'BUENOS AIRES', 'WARNERS', '6646', NULL, NULL);
INSERT INTO `localidades` VALUES(1297, 1, 1, 'BUENOS AIRES', 'WILDE', '1875', NULL, NULL);
INSERT INTO `localidades` VALUES(1298, 1, 1, 'BUENOS AIRES', 'YERBAS', '7303', NULL, NULL);
INSERT INTO `localidades` VALUES(1299, 1, 1, 'BUENOS AIRES', 'YRAIZOZ', '7605', NULL, NULL);
INSERT INTO `localidades` VALUES(1300, 1, 1, 'BUENOS AIRES', 'YULUYACO', '6443', NULL, NULL);
INSERT INTO `localidades` VALUES(1301, 1, 1, 'BUENOS AIRES', 'ZARATE', '2800', NULL, NULL);
INSERT INTO `localidades` VALUES(1302, 1, 1, 'BUENOS AIRES', 'ZAVALIA', '6018', NULL, NULL);
INSERT INTO `localidades` VALUES(1303, 1, 1, 'BUENOS AIRES', 'ZELAYA', '1627', NULL, NULL);
INSERT INTO `localidades` VALUES(1304, 1, 1, 'BUENOS AIRES', 'ZENON VIDELA DORNA', '7226', NULL, NULL);
INSERT INTO `localidades` VALUES(1305, 1, 1, 'BUENOS AIRES', 'ZENTENA', '7545', NULL, NULL);
INSERT INTO `localidades` VALUES(1306, 1, 1, 'BUENOS AIRES', 'ZOILO PERALTA', '7530', NULL, NULL);
INSERT INTO `localidades` VALUES(1307, 1, 1, 'BUENOS AIRES', 'ZONA DELTA SAN FERNANDO', '1647', NULL, NULL);
INSERT INTO `localidades` VALUES(1308, 1, 1, 'BUENOS AIRES', 'ZUBIARRE', '8151', NULL, NULL);
INSERT INTO `localidades` VALUES(1309, 2, 1, 'CAPITAL FEDERAL', 'CAPITAL FEDERAL', '1000', NULL, NULL);
INSERT INTO `localidades` VALUES(1310, 3, 1, 'CATAMARCA', 'ACONQUIJA', '4743', NULL, NULL);
INSERT INTO `localidades` VALUES(1311, 3, 1, 'CATAMARCA', 'ALIJILAN', '4723', NULL, NULL);
INSERT INTO `localidades` VALUES(1312, 3, 1, 'CATAMARCA', 'AMADORES', '4716', NULL, NULL);
INSERT INTO `localidades` VALUES(1313, 3, 1, 'CATAMARCA', 'AMANAO', '4741', NULL, NULL);
INSERT INTO `localidades` VALUES(1314, 3, 1, 'CATAMARCA', 'ANCASTI', '4701', NULL, NULL);
INSERT INTO `localidades` VALUES(1315, 3, 1, 'CATAMARCA', 'ANDALGALA', '4740', NULL, NULL);
INSERT INTO `localidades` VALUES(1316, 3, 1, 'CATAMARCA', 'ANTOFAGASTA DE LA SI', '4705', NULL, NULL);
INSERT INTO `localidades` VALUES(1317, 3, 1, 'CATAMARCA', 'BAJO LA ALUMBRERA', '4743', NULL, NULL);
INSERT INTO `localidades` VALUES(1318, 3, 1, 'CATAMARCA', 'BALCOZNA', '4719', NULL, NULL);
INSERT INTO `localidades` VALUES(1319, 3, 1, 'CATAMARCA', 'BANDA DE LUCERO', '5333', NULL, NULL);
INSERT INTO `localidades` VALUES(1320, 3, 1, 'CATAMARCA', 'BAÑADO', '4707', NULL, NULL);
INSERT INTO `localidades` VALUES(1321, 3, 1, 'CATAMARCA', 'BAÑADO DE OVANTA', '4723', NULL, NULL);
INSERT INTO `localidades` VALUES(1322, 3, 1, 'CATAMARCA', 'BELEN', '4750', NULL, NULL);
INSERT INTO `localidades` VALUES(1323, 3, 1, 'CATAMARCA', 'CARRANZA', '4724', NULL, NULL);
INSERT INTO `localidades` VALUES(1324, 3, 1, 'CATAMARCA', 'CASA DE PIEDRA', '4741', NULL, NULL);
INSERT INTO `localidades` VALUES(1325, 3, 1, 'CATAMARCA', 'CERRO NEGRO', '5331', NULL, NULL);
INSERT INTO `localidades` VALUES(1326, 3, 1, 'CATAMARCA', 'CHAQUIAGO', '4741', NULL, NULL);
INSERT INTO `localidades` VALUES(1327, 3, 1, 'CATAMARCA', 'CHOYA (CAT)', '4741', NULL, NULL);
INSERT INTO `localidades` VALUES(1328, 3, 1, 'CATAMARCA', 'CHUMBICHA', '4728', NULL, NULL);
INSERT INTO `localidades` VALUES(1329, 3, 1, 'CATAMARCA', 'COLANA', '5317', NULL, NULL);
INSERT INTO `localidades` VALUES(1330, 3, 1, 'CATAMARCA', 'COLPES', '5321', NULL, NULL);
INSERT INTO `localidades` VALUES(1331, 3, 1, 'CATAMARCA', 'CONDOR HUASI', '4711', NULL, NULL);
INSERT INTO `localidades` VALUES(1332, 3, 1, 'CATAMARCA', 'CONETA', '4724', NULL, NULL);
INSERT INTO `localidades` VALUES(1333, 3, 1, 'CATAMARCA', 'COPACABANA', '5333', NULL, NULL);
INSERT INTO `localidades` VALUES(1334, 3, 1, 'CATAMARCA', 'CORRAL QUEMADO', '4751', NULL, NULL);
INSERT INTO `localidades` VALUES(1335, 3, 1, 'CATAMARCA', 'EL ALAMITO', '4743', NULL, NULL);
INSERT INTO `localidades` VALUES(1336, 3, 1, 'CATAMARCA', 'EL ALTO', '4235', NULL, NULL);
INSERT INTO `localidades` VALUES(1337, 3, 1, 'CATAMARCA', 'EL BOLSON CATAMARCA', '4711', NULL, NULL);
INSERT INTO `localidades` VALUES(1338, 3, 1, 'CATAMARCA', 'EL DESMONTE', '4723', NULL, NULL);
INSERT INTO `localidades` VALUES(1339, 3, 1, 'CATAMARCA', 'EL DURAZNO CATAMARCA', '4751', NULL, NULL);
INSERT INTO `localidades` VALUES(1340, 3, 1, 'CATAMARCA', 'EL PORTEZUELO -CATAM', '4750', NULL, NULL);
INSERT INTO `localidades` VALUES(1341, 3, 1, 'CATAMARCA', 'EL RODEO (CAT)', '4715', NULL, NULL);
INSERT INTO `localidades` VALUES(1342, 3, 1, 'CATAMARCA', 'ESQUIU', '5261', NULL, NULL);
INSERT INTO `localidades` VALUES(1343, 3, 1, 'CATAMARCA', 'FARALLON NEGRO', '4751', NULL, NULL);
INSERT INTO `localidades` VALUES(1344, 3, 1, 'CATAMARCA', 'FIAMBALA', '5345', NULL, NULL);
INSERT INTO `localidades` VALUES(1345, 3, 1, 'CATAMARCA', 'GUAYAMBA', '4235', NULL, NULL);
INSERT INTO `localidades` VALUES(1346, 3, 1, 'CATAMARCA', 'HUACO (CAT)', '4750', NULL, NULL);
INSERT INTO `localidades` VALUES(1347, 3, 1, 'CATAMARCA', 'HUALFIN', '4751', NULL, NULL);
INSERT INTO `localidades` VALUES(1348, 3, 1, 'CATAMARCA', 'HUAYCAMA', '4705', NULL, NULL);
INSERT INTO `localidades` VALUES(1349, 3, 1, 'CATAMARCA', 'HUILLAPIMA', '4726', NULL, NULL);
INSERT INTO `localidades` VALUES(1350, 3, 1, 'CATAMARCA', 'ICA¥O (CAT)', '5265', NULL, NULL);
INSERT INTO `localidades` VALUES(1351, 3, 1, 'CATAMARCA', 'IPIZCA', '4701', NULL, NULL);
INSERT INTO `localidades` VALUES(1352, 3, 1, 'CATAMARCA', 'LA AGUADA', '4740', NULL, NULL);
INSERT INTO `localidades` VALUES(1353, 3, 1, 'CATAMARCA', 'LA BAJADA', '4716', NULL, NULL);
INSERT INTO `localidades` VALUES(1354, 3, 1, 'CATAMARCA', 'LA CARRERA CATAMARCA', '4711', NULL, NULL);
INSERT INTO `localidades` VALUES(1355, 3, 1, 'CATAMARCA', 'LA DORADA', '5261', NULL, NULL);
INSERT INTO `localidades` VALUES(1356, 3, 1, 'CATAMARCA', 'LA GUARDIA CATAMARCA', '5263', NULL, NULL);
INSERT INTO `localidades` VALUES(1357, 3, 1, 'CATAMARCA', 'LA HIGUERA (CAT)', '4719', NULL, NULL);
INSERT INTO `localidades` VALUES(1358, 3, 1, 'CATAMARCA', 'LA MERCED (CAT)', '4718', NULL, NULL);
INSERT INTO `localidades` VALUES(1359, 3, 1, 'CATAMARCA', 'LA PUERTA (CAT)', '4711', NULL, NULL);
INSERT INTO `localidades` VALUES(1360, 3, 1, 'CATAMARCA', 'LA TERCENA', '4711', NULL, NULL);
INSERT INTO `localidades` VALUES(1361, 3, 1, 'CATAMARCA', 'LA TOMA (CATAMARCA)', '4751', NULL, NULL);
INSERT INTO `localidades` VALUES(1362, 3, 1, 'CATAMARCA', 'LA VIÑA (CATAMARCA)', '4751', NULL, NULL);
INSERT INTO `localidades` VALUES(1363, 3, 1, 'CATAMARCA', 'LA ZANJA', '5261', NULL, NULL);
INSERT INTO `localidades` VALUES(1364, 3, 1, 'CATAMARCA', 'LAS CA¥AS', '4235', NULL, NULL);
INSERT INTO `localidades` VALUES(1365, 3, 1, 'CATAMARCA', 'LAS FLORES', '5261', NULL, NULL);
INSERT INTO `localidades` VALUES(1366, 3, 1, 'CATAMARCA', 'LAS JUNTAS', '4715', NULL, NULL);
INSERT INTO `localidades` VALUES(1367, 3, 1, 'CATAMARCA', 'LAS PIRQUITAS', '4713', NULL, NULL);
INSERT INTO `localidades` VALUES(1368, 3, 1, 'CATAMARCA', 'LONDRES', '4753', NULL, NULL);
INSERT INTO `localidades` VALUES(1369, 3, 1, 'CATAMARCA', 'LOS ALTOS', '4723', NULL, NULL);
INSERT INTO `localidades` VALUES(1370, 3, 1, 'CATAMARCA', 'LOS ANGELES', '4724', NULL, NULL);
INSERT INTO `localidades` VALUES(1371, 3, 1, 'CATAMARCA', 'LOS CASTILLOS', '4711', NULL, NULL);
INSERT INTO `localidades` VALUES(1372, 3, 1, 'CATAMARCA', 'LOS NACIMIENTOS', '4751', NULL, NULL);
INSERT INTO `localidades` VALUES(1373, 3, 1, 'CATAMARCA', 'LOS VARELAS', '4711', NULL, NULL);
INSERT INTO `localidades` VALUES(1374, 3, 1, 'CATAMARCA', 'MALLI', '4740', NULL, NULL);
INSERT INTO `localidades` VALUES(1375, 3, 1, 'CATAMARCA', 'MEDANITOS', '5341', NULL, NULL);
INSERT INTO `localidades` VALUES(1376, 3, 1, 'CATAMARCA', 'MIRAFLORES', '4724', NULL, NULL);
INSERT INTO `localidades` VALUES(1377, 3, 1, 'CATAMARCA', 'MONTE POTRERO', '4716', NULL, NULL);
INSERT INTO `localidades` VALUES(1378, 3, 1, 'CATAMARCA', 'MUTQUIN', '5317', NULL, NULL);
INSERT INTO `localidades` VALUES(1379, 3, 1, 'CATAMARCA', 'PAJONAL (CATAMARCA)', '5315', NULL, NULL);
INSERT INTO `localidades` VALUES(1380, 3, 1, 'CATAMARCA', 'PALO BLANCO', '5341', NULL, NULL);
INSERT INTO `localidades` VALUES(1381, 3, 1, 'CATAMARCA', 'PALO LABRADO', '4716', NULL, NULL);
INSERT INTO `localidades` VALUES(1382, 3, 1, 'CATAMARCA', 'PIEDRA BLANCA', '4709', NULL, NULL);
INSERT INTO `localidades` VALUES(1383, 3, 1, 'CATAMARCA', 'POMAN', '5315', NULL, NULL);
INSERT INTO `localidades` VALUES(1384, 3, 1, 'CATAMARCA', 'POMANCILLO', '4711', NULL, NULL);
INSERT INTO `localidades` VALUES(1385, 3, 1, 'CATAMARCA', 'QUIROS', '5266', NULL, NULL);
INSERT INTO `localidades` VALUES(1386, 3, 1, 'CATAMARCA', 'RECREO (CAT)', '5260', NULL, NULL);
INSERT INTO `localidades` VALUES(1387, 3, 1, 'CATAMARCA', 'RINCON (CAT)', '5317', NULL, NULL);
INSERT INTO `localidades` VALUES(1388, 3, 1, 'CATAMARCA', 'SALADO', '5331', NULL, NULL);
INSERT INTO `localidades` VALUES(1389, 3, 1, 'CATAMARCA', 'SAN ANTONIO (CAT)', '4701', NULL, NULL);
INSERT INTO `localidades` VALUES(1390, 3, 1, 'CATAMARCA', 'SAN ANTONIO DE LA PA', '5264', NULL, NULL);
INSERT INTO `localidades` VALUES(1391, 3, 1, 'CATAMARCA', 'SAN FERNANDO (CAT)', '4751', NULL, NULL);
INSERT INTO `localidades` VALUES(1392, 3, 1, 'CATAMARCA', 'SAN FERNANDO DEL VALLE DE CATAMARCA', '4700', NULL, NULL);
INSERT INTO `localidades` VALUES(1393, 3, 1, 'CATAMARCA', 'SAN ISIDRO (CAT)', '4707', NULL, NULL);
INSERT INTO `localidades` VALUES(1394, 3, 1, 'CATAMARCA', 'SAN JOSE (CAT)', '4701', NULL, NULL);
INSERT INTO `localidades` VALUES(1395, 3, 1, 'CATAMARCA', 'SAN JOSE (CATAMARCA)', '5319', NULL, NULL);
INSERT INTO `localidades` VALUES(1396, 3, 1, 'CATAMARCA', 'SAN MARTIN (CAT)', '5263', NULL, NULL);
INSERT INTO `localidades` VALUES(1397, 3, 1, 'CATAMARCA', 'SAN MIGUEL (CAT)', '5321', NULL, NULL);
INSERT INTO `localidades` VALUES(1398, 3, 1, 'CATAMARCA', 'SAN PEDRO CAPAYAN', '4726', NULL, NULL);
INSERT INTO `localidades` VALUES(1399, 3, 1, 'CATAMARCA', 'SANTA MARIA', '4139', NULL, NULL);
INSERT INTO `localidades` VALUES(1400, 3, 1, 'CATAMARCA', 'SANTA ROSA (CAT 1)', '4707', NULL, NULL);
INSERT INTO `localidades` VALUES(1401, 3, 1, 'CATAMARCA', 'SANTA ROSA (CAT)', '5343', NULL, NULL);
INSERT INTO `localidades` VALUES(1402, 3, 1, 'CATAMARCA', 'SAUJIL', '5321', NULL, NULL);
INSERT INTO `localidades` VALUES(1403, 3, 1, 'CATAMARCA', 'SIJAN', '5319', NULL, NULL);
INSERT INTO `localidades` VALUES(1404, 3, 1, 'CATAMARCA', 'SINGUIL', '4711', NULL, NULL);
INSERT INTO `localidades` VALUES(1405, 3, 1, 'CATAMARCA', 'SUMALAO', '4705', NULL, NULL);
INSERT INTO `localidades` VALUES(1406, 3, 1, 'CATAMARCA', 'SUMAMPA', '4722', NULL, NULL);
INSERT INTO `localidades` VALUES(1407, 3, 1, 'CATAMARCA', 'TAPSO', '4234', NULL, NULL);
INSERT INTO `localidades` VALUES(1408, 3, 1, 'CATAMARCA', 'TINOGASTA', '5340', NULL, NULL);
INSERT INTO `localidades` VALUES(1409, 3, 1, 'CATAMARCA', 'TRES PUENTES', '4707', NULL, NULL);
INSERT INTO `localidades` VALUES(1410, 3, 1, 'CATAMARCA', 'VILISMAN', '4235', NULL, NULL);
INSERT INTO `localidades` VALUES(1411, 4, 1, 'CHACO', 'AEROP. INTERNACIONAL DE RES', '3500', NULL, NULL);
INSERT INTO `localidades` VALUES(1412, 4, 1, 'CHACO', 'AVIA TERAI', '3706', NULL, NULL);
INSERT INTO `localidades` VALUES(1413, 4, 1, 'CHACO', 'BARRANQUERAS', '3503', NULL, NULL);
INSERT INTO `localidades` VALUES(1414, 4, 1, 'CHACO', 'BARRIO BARBERAN', '3500', NULL, NULL);
INSERT INTO `localidades` VALUES(1415, 4, 1, 'CHACO', 'BARRIO DON SANTIAGO', '3500', NULL, NULL);
INSERT INTO `localidades` VALUES(1416, 4, 1, 'CHACO', 'BARRIO RAOTA', '3500', NULL, NULL);
INSERT INTO `localidades` VALUES(1417, 4, 1, 'CHACO', 'BARRIO VILLA ELBA', '3500', NULL, NULL);
INSERT INTO `localidades` VALUES(1418, 4, 1, 'CHACO', 'BASAIL', '3516', NULL, NULL);
INSERT INTO `localidades` VALUES(1419, 4, 1, 'CHACO', 'CAMPO LARGO', '3716', NULL, NULL);
INSERT INTO `localidades` VALUES(1420, 4, 1, 'CHACO', 'CAPITAN SOLARI', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1421, 4, 1, 'CHACO', 'CHARATA', '3730', NULL, NULL);
INSERT INTO `localidades` VALUES(1422, 4, 1, 'CHACO', 'CIERVO PETIZO', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1423, 4, 1, 'CHACO', 'COLONIA ABORIGEN', '3531', NULL, NULL);
INSERT INTO `localidades` VALUES(1424, 4, 1, 'CHACO', 'COLONIA BENITEZ', '3505', NULL, NULL);
INSERT INTO `localidades` VALUES(1425, 4, 1, 'CHACO', 'COLONIA ELISA', '3515', NULL, NULL);
INSERT INTO `localidades` VALUES(1426, 4, 1, 'CHACO', 'COLONIAS UNIDAS', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1427, 4, 1, 'CHACO', 'CORONEL DUGRATY', '3541', NULL, NULL);
INSERT INTO `localidades` VALUES(1428, 4, 1, 'CHACO', 'CORZUELA', '3718', NULL, NULL);
INSERT INTO `localidades` VALUES(1429, 4, 1, 'CHACO', 'FONTANA', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1430, 4, 1, 'CHACO', 'GENERAL PINEDO', '3732', NULL, NULL);
INSERT INTO `localidades` VALUES(1431, 4, 1, 'CHACO', 'GENERAL VEDIA', '3522', NULL, NULL);
INSERT INTO `localidades` VALUES(1432, 4, 1, 'CHACO', 'GRAL.J.DE SAN MARTIN', '3509', NULL, NULL);
INSERT INTO `localidades` VALUES(1433, 4, 1, 'CHACO', 'J. J. CASTELLI', '3705', NULL, NULL);
INSERT INTO `localidades` VALUES(1434, 4, 1, 'CHACO', 'LA EDUVIGIS', '3510', NULL, NULL);
INSERT INTO `localidades` VALUES(1435, 4, 1, 'CHACO', 'LA ESCONDIDA', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1436, 4, 1, 'CHACO', 'LA LEONESA', '3518', NULL, NULL);
INSERT INTO `localidades` VALUES(1437, 4, 1, 'CHACO', 'LA MASCOTA (ZONA AVIA TERAI)', '3706', NULL, NULL);
INSERT INTO `localidades` VALUES(1438, 4, 1, 'CHACO', 'LA NEGRA', '3513', NULL, NULL);
INSERT INTO `localidades` VALUES(1439, 4, 1, 'CHACO', 'LA PASTORIL', '3515', NULL, NULL);
INSERT INTO `localidades` VALUES(1440, 4, 1, 'CHACO', 'LA VERDE', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1441, 4, 1, 'CHACO', 'LAGUNA LIMPIA', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1442, 4, 1, 'CHACO', 'LAPACHITO', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1443, 4, 1, 'CHACO', 'LAS BREÑAS', '3722', NULL, NULL);
INSERT INTO `localidades` VALUES(1444, 4, 1, 'CHACO', 'LAS GARCITAS', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1445, 4, 1, 'CHACO', 'LAS PALMAS', '3518', NULL, NULL);
INSERT INTO `localidades` VALUES(1446, 4, 1, 'CHACO', 'MACHAGAI', '3534', NULL, NULL);
INSERT INTO `localidades` VALUES(1447, 4, 1, 'CHACO', 'MAKALLE', '3514', NULL, NULL);
INSERT INTO `localidades` VALUES(1448, 4, 1, 'CHACO', 'PAMPA DEL INDIO', '3531', NULL, NULL);
INSERT INTO `localidades` VALUES(1449, 4, 1, 'CHACO', 'PRES. DE LA PLAZA', '3536', NULL, NULL);
INSERT INTO `localidades` VALUES(1450, 4, 1, 'CHACO', 'PRESIDENCIA ROCA', '3511', NULL, NULL);
INSERT INTO `localidades` VALUES(1451, 4, 1, 'CHACO', 'PTE. ROQUE S. PEÑA', '3700', NULL, NULL);
INSERT INTO `localidades` VALUES(1452, 4, 1, 'CHACO', 'PUERTO BERMEJO', '3524', NULL, NULL);
INSERT INTO `localidades` VALUES(1453, 4, 1, 'CHACO', 'PUERTO TIROL', '3505', NULL, NULL);
INSERT INTO `localidades` VALUES(1454, 4, 1, 'CHACO', 'PUERTO VILELA', '3503', NULL, NULL);
INSERT INTO `localidades` VALUES(1455, 4, 1, 'CHACO', 'QUITILIPI', '3530', NULL, NULL);
INSERT INTO `localidades` VALUES(1456, 4, 1, 'CHACO', 'RESISTENCIA', '3500', NULL, NULL);
INSERT INTO `localidades` VALUES(1457, 4, 1, 'CHACO', 'RIO DE ORO', '3518', NULL, NULL);
INSERT INTO `localidades` VALUES(1458, 4, 1, 'CHACO', 'RUTA 11', '3500', NULL, NULL);
INSERT INTO `localidades` VALUES(1459, 4, 1, 'CHACO', 'RUTA 16- NICOLAS AVELLANEDA', '3500', NULL, NULL);
INSERT INTO `localidades` VALUES(1460, 4, 1, 'CHACO', 'SANTA SYLVINA', '3541', NULL, NULL);
INSERT INTO `localidades` VALUES(1461, 4, 1, 'CHACO', 'SELVAS DE RIO DE ORO', '3507', NULL, NULL);
INSERT INTO `localidades` VALUES(1462, 4, 1, 'CHACO', 'TRES ISLETAS', '3703', NULL, NULL);
INSERT INTO `localidades` VALUES(1463, 4, 1, 'CHACO', 'VILLA ANGELA', '3540', NULL, NULL);
INSERT INTO `localidades` VALUES(1464, 4, 1, 'CHACO', 'VILLA BERTHET', '3545', NULL, NULL);
INSERT INTO `localidades` VALUES(1465, 5, 1, 'CHUBUT', 'CAMARONES', '9111', NULL, NULL);
INSERT INTO `localidades` VALUES(1466, 5, 1, 'CHUBUT', 'CHOLILA', '9217', NULL, NULL);
INSERT INTO `localidades` VALUES(1467, 5, 1, 'CHUBUT', 'COMODORO RIVADAVIA', '9000', NULL, NULL);
INSERT INTO `localidades` VALUES(1468, 5, 1, 'CHUBUT', 'CORCOVADO', '9201', NULL, NULL);
INSERT INTO `localidades` VALUES(1469, 5, 1, 'CHUBUT', 'DOLAVON', '9107', NULL, NULL);
INSERT INTO `localidades` VALUES(1470, 5, 1, 'CHUBUT', 'EL HOYO', '8431', NULL, NULL);
INSERT INTO `localidades` VALUES(1471, 5, 1, 'CHUBUT', 'EL MAITEN', '9210', NULL, NULL);
INSERT INTO `localidades` VALUES(1472, 5, 1, 'CHUBUT', 'EPUYEN', '9211', NULL, NULL);
INSERT INTO `localidades` VALUES(1473, 5, 1, 'CHUBUT', 'ESQUEL', '9200', NULL, NULL);
INSERT INTO `localidades` VALUES(1474, 5, 1, 'CHUBUT', 'GAIMAN', '9105', NULL, NULL);
INSERT INTO `localidades` VALUES(1475, 5, 1, 'CHUBUT', 'GOBERNADOR COSTA', '9223', NULL, NULL);
INSERT INTO `localidades` VALUES(1476, 5, 1, 'CHUBUT', 'GUALJAINA', '9201', NULL, NULL);
INSERT INTO `localidades` VALUES(1477, 5, 1, 'CHUBUT', 'JOSE DE SAN MARTIN', '9220', NULL, NULL);
INSERT INTO `localidades` VALUES(1478, 5, 1, 'CHUBUT', 'LA ORIENTAL', '9009', NULL, NULL);
INSERT INTO `localidades` VALUES(1479, 5, 1, 'CHUBUT', 'LA PRIMAVERA', '9201', NULL, NULL);
INSERT INTO `localidades` VALUES(1480, 5, 1, 'CHUBUT', 'LAGO FUTALAUQUEN', '9200', NULL, NULL);
INSERT INTO `localidades` VALUES(1481, 5, 1, 'CHUBUT', 'LAGO PUELO', '8431', NULL, NULL);
INSERT INTO `localidades` VALUES(1482, 5, 1, 'CHUBUT', 'LELEQUE', '9213', NULL, NULL);
INSERT INTO `localidades` VALUES(1483, 5, 1, 'CHUBUT', 'PLAYA UNION', '9103', NULL, NULL);
INSERT INTO `localidades` VALUES(1484, 5, 1, 'CHUBUT', 'PUERTO MADRYN', '9120', NULL, NULL);
INSERT INTO `localidades` VALUES(1485, 5, 1, 'CHUBUT', 'PUERTO PIRAMIDES', '9121', NULL, NULL);
INSERT INTO `localidades` VALUES(1486, 5, 1, 'CHUBUT', 'RADA TILLY', '9001', NULL, NULL);
INSERT INTO `localidades` VALUES(1487, 5, 1, 'CHUBUT', 'RAWSON (CHUBUT)', '9103', NULL, NULL);
INSERT INTO `localidades` VALUES(1488, 5, 1, 'CHUBUT', 'RIO PICO', '9225', NULL, NULL);
INSERT INTO `localidades` VALUES(1489, 5, 1, 'CHUBUT', 'SARMIENTO (CHU)', '9020', NULL, NULL);
INSERT INTO `localidades` VALUES(1490, 5, 1, 'CHUBUT', 'TECKA', '9201', NULL, NULL);
INSERT INTO `localidades` VALUES(1491, 5, 1, 'CHUBUT', 'TRELEW', '9100', NULL, NULL);
INSERT INTO `localidades` VALUES(1492, 5, 1, 'CHUBUT', 'TREVELIN', '9203', NULL, NULL);
INSERT INTO `localidades` VALUES(1493, 6, 1, 'CORDOBA', '33 KM 881', '5214', NULL, NULL);
INSERT INTO `localidades` VALUES(1494, 6, 1, 'CORDOBA', 'ACHIRAS', '5833', NULL, NULL);
INSERT INTO `localidades` VALUES(1495, 6, 1, 'CORDOBA', 'ADELIA MARIA', '5843', NULL, NULL);
INSERT INTO `localidades` VALUES(1496, 6, 1, 'CORDOBA', 'AGUA DE ORO', '5107', NULL, NULL);
INSERT INTO `localidades` VALUES(1497, 6, 1, 'CORDOBA', 'AGUAS CLARAS', '5282', NULL, NULL);
INSERT INTO `localidades` VALUES(1498, 6, 1, 'CORDOBA', 'ALCIRA GIGENA', '5813', NULL, NULL);
INSERT INTO `localidades` VALUES(1499, 6, 1, 'CORDOBA', 'ALEJANDRO', '2686', NULL, NULL);
INSERT INTO `localidades` VALUES(1500, 6, 1, 'CORDOBA', 'ALEJO LEDESMA', '2662', NULL, NULL);
INSERT INTO `localidades` VALUES(1501, 6, 1, 'CORDOBA', 'ALICIA', '5949', NULL, NULL);
INSERT INTO `localidades` VALUES(1502, 6, 1, 'CORDOBA', 'ALMAFUERTE', '5854', NULL, NULL);
INSERT INTO `localidades` VALUES(1503, 6, 1, 'CORDOBA', 'ALPA CORRAL', '5801', NULL, NULL);
INSERT INTO `localidades` VALUES(1504, 6, 1, 'CORDOBA', 'ALTA GRACIA', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1505, 6, 1, 'CORDOBA', 'ALTAUTINA', '5871', NULL, NULL);
INSERT INTO `localidades` VALUES(1506, 6, 1, 'CORDOBA', 'ALTO ALEGRE', '5903', NULL, NULL);
INSERT INTO `localidades` VALUES(1507, 6, 1, 'CORDOBA', 'ALTO DE SAN PEDRO', '5174', NULL, NULL);
INSERT INTO `localidades` VALUES(1508, 6, 1, 'CORDOBA', 'ALTO GRANDE', '5893', NULL, NULL);
INSERT INTO `localidades` VALUES(1509, 6, 1, 'CORDOBA', 'ALTOS DE CHIPION', '2417', NULL, NULL);
INSERT INTO `localidades` VALUES(1510, 6, 1, 'CORDOBA', 'AMBOY', '5199', NULL, NULL);
INSERT INTO `localidades` VALUES(1511, 6, 1, 'CORDOBA', 'AMBUL', '5299', NULL, NULL);
INSERT INTO `localidades` VALUES(1512, 6, 1, 'CORDOBA', 'ANA ZUMARAN', '5905', NULL, NULL);
INSERT INTO `localidades` VALUES(1513, 6, 1, 'CORDOBA', 'ANIZACATE', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1514, 6, 1, 'CORDOBA', 'ARGUELLO', '5147', NULL, NULL);
INSERT INTO `localidades` VALUES(1515, 6, 1, 'CORDOBA', 'ARIAS', '2624', NULL, NULL);
INSERT INTO `localidades` VALUES(1516, 6, 1, 'CORDOBA', 'ARROYITO', '2434', NULL, NULL);
INSERT INTO `localidades` VALUES(1517, 6, 1, 'CORDOBA', 'ARROYO ALGODON', '5909', NULL, NULL);
INSERT INTO `localidades` VALUES(1518, 6, 1, 'CORDOBA', 'ARROYO CABRAL', '5917', NULL, NULL);
INSERT INTO `localidades` VALUES(1519, 6, 1, 'CORDOBA', 'ASCOCHINGA', '5117', NULL, NULL);
INSERT INTO `localidades` VALUES(1520, 6, 1, 'CORDOBA', 'ATHOS PAMPA', '5194', NULL, NULL);
INSERT INTO `localidades` VALUES(1521, 6, 1, 'CORDOBA', 'AUSONIA', '5901', NULL, NULL);
INSERT INTO `localidades` VALUES(1522, 6, 1, 'CORDOBA', 'AVELLANEDA (CBA)', '5212', NULL, NULL);
INSERT INTO `localidades` VALUES(1523, 6, 1, 'CORDOBA', 'B. S. BERNARDO', '5231', NULL, NULL);
INSERT INTO `localidades` VALUES(1524, 6, 1, 'CORDOBA', 'BALLESTEROS', '2572', NULL, NULL);
INSERT INTO `localidades` VALUES(1525, 6, 1, 'CORDOBA', 'BALNEARIA', '5141', NULL, NULL);
INSERT INTO `localidades` VALUES(1526, 6, 1, 'CORDOBA', 'BELL VILLE', '2550', NULL, NULL);
INSERT INTO `localidades` VALUES(1527, 6, 1, 'CORDOBA', 'BENGOLEA', '5807', NULL, NULL);
INSERT INTO `localidades` VALUES(1528, 6, 1, 'CORDOBA', 'BENJAMIN GOULD', '2664', NULL, NULL);
INSERT INTO `localidades` VALUES(1529, 6, 1, 'CORDOBA', 'BERROTARAN', '5817', NULL, NULL);
INSERT INTO `localidades` VALUES(1530, 6, 1, 'CORDOBA', 'BIALET MASSE', '5158', NULL, NULL);
INSERT INTO `localidades` VALUES(1531, 6, 1, 'CORDOBA', 'BOCA DEL RIO', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1532, 6, 1, 'CORDOBA', 'BOSQUE ALEGRE', '5187', NULL, NULL);
INSERT INTO `localidades` VALUES(1533, 6, 1, 'CORDOBA', 'BRINKMANN', '2419', NULL, NULL);
INSERT INTO `localidades` VALUES(1534, 6, 1, 'CORDOBA', 'BULNES', '5845', NULL, NULL);
INSERT INTO `localidades` VALUES(1535, 6, 1, 'CORDOBA', 'CABALANGO', '5155', NULL, NULL);
INSERT INTO `localidades` VALUES(1536, 6, 1, 'CORDOBA', 'CALCHIN', '5969', NULL, NULL);
INSERT INTO `localidades` VALUES(1537, 6, 1, 'CORDOBA', 'CALCHIN OESTE', '5965', NULL, NULL);
INSERT INTO `localidades` VALUES(1538, 6, 1, 'CORDOBA', 'CALMAYO', '5191', NULL, NULL);
INSERT INTO `localidades` VALUES(1539, 6, 1, 'CORDOBA', 'CAMILO ALDAO', '2585', NULL, NULL);
INSERT INTO `localidades` VALUES(1540, 6, 1, 'CORDOBA', 'CAMINIAGA', '5244', NULL, NULL);
INSERT INTO `localidades` VALUES(1541, 6, 1, 'CORDOBA', 'CANALS', '2650', NULL, NULL);
INSERT INTO `localidades` VALUES(1542, 6, 1, 'CORDOBA', 'CANTERAS DE QUILPO', '5281', NULL, NULL);
INSERT INTO `localidades` VALUES(1543, 6, 1, 'CORDOBA', 'CANTERAS EL SAUCE', '5107', NULL, NULL);
INSERT INTO `localidades` VALUES(1544, 6, 1, 'CORDOBA', 'CAPILLA DE LOS REMEDIOS', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(1545, 6, 1, 'CORDOBA', 'CAPILLA DEL CARMEN', '5963', NULL, NULL);
INSERT INTO `localidades` VALUES(1546, 6, 1, 'CORDOBA', 'CAPILLA DEL MONTE', '5184', NULL, NULL);
INSERT INTO `localidades` VALUES(1547, 6, 1, 'CORDOBA', 'CARNERILLO', '5805', NULL, NULL);
INSERT INTO `localidades` VALUES(1548, 6, 1, 'CORDOBA', 'CARRILOBO', '5915', NULL, NULL);
INSERT INTO `localidades` VALUES(1549, 6, 1, 'CORDOBA', 'CARRIZAL', '5285', NULL, NULL);
INSERT INTO `localidades` VALUES(1550, 6, 1, 'CORDOBA', 'CASA GRANDE', '5162', NULL, NULL);
INSERT INTO `localidades` VALUES(1551, 6, 1, 'CORDOBA', 'CAVANAGH', '2625', NULL, NULL);
INSERT INTO `localidades` VALUES(1552, 6, 1, 'CORDOBA', 'CAÑADA DE MACHADO', '5961', NULL, NULL);
INSERT INTO `localidades` VALUES(1553, 6, 1, 'CORDOBA', 'CAÑADA DE MACHADO SUD', '5963', NULL, NULL);
INSERT INTO `localidades` VALUES(1554, 6, 1, 'CORDOBA', 'CAÑADA DEL SAUCE', '5817', NULL, NULL);
INSERT INTO `localidades` VALUES(1555, 6, 1, 'CORDOBA', 'CERRO AZUL', '5107', NULL, NULL);
INSERT INTO `localidades` VALUES(1556, 6, 1, 'CORDOBA', 'CERRO COLORADO', '5244', NULL, NULL);
INSERT INTO `localidades` VALUES(1557, 6, 1, 'CORDOBA', 'CHAJAN', '5837', NULL, NULL);
INSERT INTO `localidades` VALUES(1558, 6, 1, 'CORDOBA', 'CHANCANI', '5871', NULL, NULL);
INSERT INTO `localidades` VALUES(1559, 6, 1, 'CORDOBA', 'CHARBONIER', '5282', NULL, NULL);
INSERT INTO `localidades` VALUES(1560, 6, 1, 'CORDOBA', 'CHARRAS', '5807', NULL, NULL);
INSERT INTO `localidades` VALUES(1561, 6, 1, 'CORDOBA', 'CHAZON', '2675', NULL, NULL);
INSERT INTO `localidades` VALUES(1562, 6, 1, 'CORDOBA', 'CHILIBROSTE', '2561', NULL, NULL);
INSERT INTO `localidades` VALUES(1563, 6, 1, 'CORDOBA', 'CHUCUL', '5805', NULL, NULL);
INSERT INTO `localidades` VALUES(1564, 6, 1, 'CORDOBA', 'CHURQUI CAÑADA', '5246', NULL, NULL);
INSERT INTO `localidades` VALUES(1565, 6, 1, 'CORDOBA', 'CHUÑA', '5218', NULL, NULL);
INSERT INTO `localidades` VALUES(1566, 6, 1, 'CORDOBA', 'CIENAGA DEL CORO', '5289', NULL, NULL);
INSERT INTO `localidades` VALUES(1567, 6, 1, 'CORDOBA', 'CINTRA', '2559', NULL, NULL);
INSERT INTO `localidades` VALUES(1568, 6, 1, 'CORDOBA', 'CIUDAD DE AMERICA', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1569, 6, 1, 'CORDOBA', 'COLAZO', '5965', NULL, NULL);
INSERT INTO `localidades` VALUES(1570, 6, 1, 'CORDOBA', 'COLONIA 10 DE JULIO', '2349', NULL, NULL);
INSERT INTO `localidades` VALUES(1571, 6, 1, 'CORDOBA', 'COLONIA ALMADA', '5835', NULL, NULL);
INSERT INTO `localidades` VALUES(1572, 6, 1, 'CORDOBA', 'COLONIA ANITA', '2413', NULL, NULL);
INSERT INTO `localidades` VALUES(1573, 6, 1, 'CORDOBA', 'COLONIA BEIRO', '2421', NULL, NULL);
INSERT INTO `localidades` VALUES(1574, 6, 1, 'CORDOBA', 'COLONIA CAROYA', '5223', NULL, NULL);
INSERT INTO `localidades` VALUES(1575, 6, 1, 'CORDOBA', 'COLONIA EL FORTIN', '5133', NULL, NULL);
INSERT INTO `localidades` VALUES(1576, 6, 1, 'CORDOBA', 'COLONIA MARINA', '2424', NULL, NULL);
INSERT INTO `localidades` VALUES(1577, 6, 1, 'CORDOBA', 'COLONIA MAUNIER', '2349', NULL, NULL);
INSERT INTO `localidades` VALUES(1578, 6, 1, 'CORDOBA', 'COLONIA PROSPERIDAD', '2423', NULL, NULL);
INSERT INTO `localidades` VALUES(1579, 6, 1, 'CORDOBA', 'COLONIA SAN BARTOLOME', '2426', NULL, NULL);
INSERT INTO `localidades` VALUES(1580, 6, 1, 'CORDOBA', 'COLONIA SAN PEDRO', '2421', NULL, NULL);
INSERT INTO `localidades` VALUES(1581, 6, 1, 'CORDOBA', 'COLONIA SANTA ANA', '6123', NULL, NULL);
INSERT INTO `localidades` VALUES(1582, 6, 1, 'CORDOBA', 'COLONIA SANTA MARIA', '2424', NULL, NULL);
INSERT INTO `localidades` VALUES(1583, 6, 1, 'CORDOBA', 'COLONIA TIROLESA', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(1584, 6, 1, 'CORDOBA', 'COLONIA VALTELINA', '2413', NULL, NULL);
INSERT INTO `localidades` VALUES(1585, 6, 1, 'CORDOBA', 'COLONIA VIGNAUD', '2419', NULL, NULL);
INSERT INTO `localidades` VALUES(1586, 6, 1, 'CORDOBA', 'CONLARA', '5873', NULL, NULL);
INSERT INTO `localidades` VALUES(1587, 6, 1, 'CORDOBA', 'COPACABANA', '5201', NULL, NULL);
INSERT INTO `localidades` VALUES(1588, 6, 1, 'CORDOBA', 'COPINA', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1589, 6, 1, 'CORDOBA', 'CORDOBA', '5008', NULL, NULL);
INSERT INTO `localidades` VALUES(1590, 6, 1, 'CORDOBA', 'CORDOBA', '5000', NULL, NULL);
INSERT INTO `localidades` VALUES(1591, 6, 1, 'CORDOBA', 'CORDOBA', '5012', NULL, NULL);
INSERT INTO `localidades` VALUES(1592, 6, 1, 'CORDOBA', 'CORDOBA (CERRO DE LAS ROSAS)', '5009', NULL, NULL);
INSERT INTO `localidades` VALUES(1593, 6, 1, 'CORDOBA', 'CORONEL BAIGORRIA', '5811', NULL, NULL);
INSERT INTO `localidades` VALUES(1594, 6, 1, 'CORDOBA', 'CORONEL BULNES', '2555', NULL, NULL);
INSERT INTO `localidades` VALUES(1595, 6, 1, 'CORDOBA', 'CORONEL MOLDES CBA', '5847', NULL, NULL);
INSERT INTO `localidades` VALUES(1596, 6, 1, 'CORDOBA', 'CORRAL DE BUSTOS', '2645', NULL, NULL);
INSERT INTO `localidades` VALUES(1597, 6, 1, 'CORDOBA', 'CORRALITO', '5853', NULL, NULL);
INSERT INTO `localidades` VALUES(1598, 6, 1, 'CORDOBA', 'COSQUIN', '5166', NULL, NULL);
INSERT INTO `localidades` VALUES(1599, 6, 1, 'CORDOBA', 'COSTA ALEGRE', '5963', NULL, NULL);
INSERT INTO `localidades` VALUES(1600, 6, 1, 'CORDOBA', 'COSTASACATE', '5961', NULL, NULL);
INSERT INTO `localidades` VALUES(1601, 6, 1, 'CORDOBA', 'CRUZ ALTA', '2189', NULL, NULL);
INSERT INTO `localidades` VALUES(1602, 6, 1, 'CORDOBA', 'CRUZ CHICA', '5178', NULL, NULL);
INSERT INTO `localidades` VALUES(1603, 6, 1, 'CORDOBA', 'CRUZ DE CAÑA', '5875', NULL, NULL);
INSERT INTO `localidades` VALUES(1604, 6, 1, 'CORDOBA', 'CRUZ DEL EJE', '5280', NULL, NULL);
INSERT INTO `localidades` VALUES(1605, 6, 1, 'CORDOBA', 'CRUZ GRANDE', '5178', NULL, NULL);
INSERT INTO `localidades` VALUES(1606, 6, 1, 'CORDOBA', 'CUATRO VIENTOS', '5801', NULL, NULL);
INSERT INTO `localidades` VALUES(1607, 6, 1, 'CORDOBA', 'CUCHI CORRAL', '5178', NULL, NULL);
INSERT INTO `localidades` VALUES(1608, 6, 1, 'CORDOBA', 'CUESTA BLANCA', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1609, 6, 1, 'CORDOBA', 'DALMACIO VELEZ SARSFIELD', '5919', NULL, NULL);
INSERT INTO `localidades` VALUES(1610, 6, 1, 'CORDOBA', 'DE LA SERNA', '6271', NULL, NULL);
INSERT INTO `localidades` VALUES(1611, 6, 1, 'CORDOBA', 'DEAN FUNES', '5200', NULL, NULL);
INSERT INTO `localidades` VALUES(1612, 6, 1, 'CORDOBA', 'DEL CAMPILLO', '6271', NULL, NULL);
INSERT INTO `localidades` VALUES(1613, 6, 1, 'CORDOBA', 'DESPEÑADEROS', '5121', NULL, NULL);
INSERT INTO `localidades` VALUES(1614, 6, 1, 'CORDOBA', 'DEVOTO', '2424', NULL, NULL);
INSERT INTO `localidades` VALUES(1615, 6, 1, 'CORDOBA', 'DIEGO DE ROJAS', '5135', NULL, NULL);
INSERT INTO `localidades` VALUES(1616, 6, 1, 'CORDOBA', 'DIQUE LOS MOLINOS', '5192', NULL, NULL);
INSERT INTO `localidades` VALUES(1617, 6, 1, 'CORDOBA', 'DOLORES (CBA)', '5182', NULL, NULL);
INSERT INTO `localidades` VALUES(1618, 6, 1, 'CORDOBA', 'DUMESNIL', '5149', NULL, NULL);
INSERT INTO `localidades` VALUES(1619, 6, 1, 'CORDOBA', 'EL ALCALDE', '5131', NULL, NULL);
INSERT INTO `localidades` VALUES(1620, 6, 1, 'CORDOBA', 'EL ARAÑADO', '5947', NULL, NULL);
INSERT INTO `localidades` VALUES(1621, 6, 1, 'CORDOBA', 'EL BARRIAL', '5285', NULL, NULL);
INSERT INTO `localidades` VALUES(1622, 6, 1, 'CORDOBA', 'EL BAÑADO', '5214', NULL, NULL);
INSERT INTO `localidades` VALUES(1623, 6, 1, 'CORDOBA', 'EL BRETE', '5281', NULL, NULL);
INSERT INTO `localidades` VALUES(1624, 6, 1, 'CORDOBA', 'EL CONDOR', '5155', NULL, NULL);
INSERT INTO `localidades` VALUES(1625, 6, 1, 'CORDOBA', 'EL DESCANSO', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1626, 6, 1, 'CORDOBA', 'EL DURAZNO (DTO RIO SECO)', '5249', NULL, NULL);
INSERT INTO `localidades` VALUES(1627, 6, 1, 'CORDOBA', 'EL DURAZNO (S. ELCANO)', '5231', NULL, NULL);
INSERT INTO `localidades` VALUES(1628, 6, 1, 'CORDOBA', 'EL DURAZNO (TANTI)', '5155', NULL, NULL);
INSERT INTO `localidades` VALUES(1629, 6, 1, 'CORDOBA', 'EL FORTIN', '5951', NULL, NULL);
INSERT INTO `localidades` VALUES(1630, 6, 1, 'CORDOBA', 'EL MANZANO', '5107', NULL, NULL);
INSERT INTO `localidades` VALUES(1631, 6, 1, 'CORDOBA', 'EL PARADOR DE MONTAÑA', '5197', NULL, NULL);
INSERT INTO `localidades` VALUES(1632, 6, 1, 'CORDOBA', 'EL PUEBLITO', '5107', NULL, NULL);
INSERT INTO `localidades` VALUES(1633, 6, 1, 'CORDOBA', 'EL QUEBRACHAL (CBA)', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(1634, 6, 1, 'CORDOBA', 'EL RODEO (CBA)', '5249', NULL, NULL);
INSERT INTO `localidades` VALUES(1635, 6, 1, 'CORDOBA', 'EL ROSARIO', '5205', NULL, NULL);
INSERT INTO `localidades` VALUES(1636, 6, 1, 'CORDOBA', 'EL ROSARIO (LA CUMBRE)', '5178', NULL, NULL);
INSERT INTO `localidades` VALUES(1637, 6, 1, 'CORDOBA', 'EL SAUCE', '5289', NULL, NULL);
INSERT INTO `localidades` VALUES(1638, 6, 1, 'CORDOBA', 'EL TIO', '2432', NULL, NULL);
INSERT INTO `localidades` VALUES(1639, 6, 1, 'CORDOBA', 'EL TUSCAL', '5216', NULL, NULL);
INSERT INTO `localidades` VALUES(1640, 6, 1, 'CORDOBA', 'ELENA', '5215', NULL, NULL);
INSERT INTO `localidades` VALUES(1641, 6, 1, 'CORDOBA', 'EMBALSE', '5856', NULL, NULL);
INSERT INTO `localidades` VALUES(1642, 6, 1, 'CORDOBA', 'ENCRUCIJADA', '5231', NULL, NULL);
INSERT INTO `localidades` VALUES(1643, 6, 1, 'CORDOBA', 'ESCOBAS', '5282', NULL, NULL);
INSERT INTO `localidades` VALUES(1644, 6, 1, 'CORDOBA', 'ESPINILLO', '5811', NULL, NULL);
INSERT INTO `localidades` VALUES(1645, 6, 1, 'CORDOBA', 'ESTACION CALCHIN', '5969', NULL, NULL);
INSERT INTO `localidades` VALUES(1646, 6, 1, 'CORDOBA', 'ESTACION GRAL. PAZ', '5145', NULL, NULL);
INSERT INTO `localidades` VALUES(1647, 6, 1, 'CORDOBA', 'ESTANCIA VIEJA', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1648, 6, 1, 'CORDOBA', 'ETRURIA', '2681', NULL, NULL);
INSERT INTO `localidades` VALUES(1649, 6, 1, 'CORDOBA', 'FALDA DE LOS REARTES', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1650, 6, 1, 'CORDOBA', 'FALDA DEL CARMEN', '5187', NULL, NULL);
INSERT INTO `localidades` VALUES(1651, 6, 1, 'CORDOBA', 'FALDA DEL CAÑETE', '5187', NULL, NULL);
INSERT INTO `localidades` VALUES(1652, 6, 1, 'CORDOBA', 'FERREYRA', '5123', NULL, NULL);
INSERT INTO `localidades` VALUES(1653, 6, 1, 'CORDOBA', 'FLOR SERRANA', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1654, 6, 1, 'CORDOBA', 'FREYRE', '2413', NULL, NULL);
INSERT INTO `localidades` VALUES(1655, 6, 1, 'CORDOBA', 'GENERAL BALDISERA', '2583', NULL, NULL);
INSERT INTO `localidades` VALUES(1656, 6, 1, 'CORDOBA', 'GENERAL CABRERA', '5809', NULL, NULL);
INSERT INTO `localidades` VALUES(1657, 6, 1, 'CORDOBA', 'GENERAL DEHEZA', '5923', NULL, NULL);
INSERT INTO `localidades` VALUES(1658, 6, 1, 'CORDOBA', 'GENERAL FOTHERINGHAM', '5931', NULL, NULL);
INSERT INTO `localidades` VALUES(1659, 6, 1, 'CORDOBA', 'GENERAL LEVALLE CBA', '6132', NULL, NULL);
INSERT INTO `localidades` VALUES(1660, 6, 1, 'CORDOBA', 'GENERAL ROCA (CBA)', '2592', NULL, NULL);
INSERT INTO `localidades` VALUES(1661, 6, 1, 'CORDOBA', 'GENERAL VIAMONTE CBA', '2671', NULL, NULL);
INSERT INTO `localidades` VALUES(1662, 6, 1, 'CORDOBA', 'GIGENA', '5813', NULL, NULL);
INSERT INTO `localidades` VALUES(1663, 6, 1, 'CORDOBA', 'GUANACO MUERTO', '5281', NULL, NULL);
INSERT INTO `localidades` VALUES(1664, 6, 1, 'CORDOBA', 'GUASAPAMPA', '5285', NULL, NULL);
INSERT INTO `localidades` VALUES(1665, 6, 1, 'CORDOBA', 'GUATIMOZIN', '2627', NULL, NULL);
INSERT INTO `localidades` VALUES(1666, 6, 1, 'CORDOBA', 'GUIÑAZU', '5145', NULL, NULL);
INSERT INTO `localidades` VALUES(1667, 6, 1, 'CORDOBA', 'GUTEMBERG', '5249', NULL, NULL);
INSERT INTO `localidades` VALUES(1668, 6, 1, 'CORDOBA', 'HERNANDO', '5929', NULL, NULL);
INSERT INTO `localidades` VALUES(1669, 6, 1, 'CORDOBA', 'HIPOLITO BOUCHARD', '6225', NULL, NULL);
INSERT INTO `localidades` VALUES(1670, 6, 1, 'CORDOBA', 'HOLMBERG', '5825', NULL, NULL);
INSERT INTO `localidades` VALUES(1671, 6, 1, 'CORDOBA', 'HORNILLOS', '5885', NULL, NULL);
INSERT INTO `localidades` VALUES(1672, 6, 1, 'CORDOBA', 'HUANCHILLA', '6121', NULL, NULL);
INSERT INTO `localidades` VALUES(1673, 6, 1, 'CORDOBA', 'HUERTA GRANDE', '5174', NULL, NULL);
INSERT INTO `localidades` VALUES(1674, 6, 1, 'CORDOBA', 'HUINCA RENANCO', '6270', NULL, NULL);
INSERT INTO `localidades` VALUES(1675, 6, 1, 'CORDOBA', 'ICHO CRUZ', '5152', NULL, NULL);
INSERT INTO `localidades` VALUES(1676, 6, 1, 'CORDOBA', 'IDIAZABAL', '2559', NULL, NULL);
INSERT INTO `localidades` VALUES(1677, 6, 1, 'CORDOBA', 'IMPIRA', '5987', NULL, NULL);
INSERT INTO `localidades` VALUES(1678, 6, 1, 'CORDOBA', 'INRIVILLE', '2587', NULL, NULL);
INSERT INTO `localidades` VALUES(1679, 6, 1, 'CORDOBA', 'ISCHILIN', '5201', NULL, NULL);
INSERT INTO `localidades` VALUES(1680, 6, 1, 'CORDOBA', 'ISLA DE SAN ANTONIO', '5214', NULL, NULL);
INSERT INTO `localidades` VALUES(1681, 6, 1, 'CORDOBA', 'ISLA VERDE', '2661', NULL, NULL);
INSERT INTO `localidades` VALUES(1682, 6, 1, 'CORDOBA', 'ITALO', '6271', NULL, NULL);
INSERT INTO `localidades` VALUES(1683, 6, 1, 'CORDOBA', 'J. GARCIA', '5201', NULL, NULL);
INSERT INTO `localidades` VALUES(1684, 6, 1, 'CORDOBA', 'JAIME PETER', '5218', NULL, NULL);
INSERT INTO `localidades` VALUES(1685, 6, 1, 'CORDOBA', 'JAMES CRAIK', '5984', NULL, NULL);
INSERT INTO `localidades` VALUES(1686, 6, 1, 'CORDOBA', 'JESUS MARIA', '5220', NULL, NULL);
INSERT INTO `localidades` VALUES(1687, 6, 1, 'CORDOBA', 'JOSE DE LA QUINTANA', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1688, 6, 1, 'CORDOBA', 'JOVITA', '6127', NULL, NULL);
INSERT INTO `localidades` VALUES(1689, 6, 1, 'CORDOBA', 'JUAREZ CELMAN', '5145', NULL, NULL);
INSERT INTO `localidades` VALUES(1690, 6, 1, 'CORDOBA', 'JUSTINIANO POSSE', '2553', NULL, NULL);
INSERT INTO `localidades` VALUES(1691, 6, 1, 'CORDOBA', 'LA BOLSA', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1692, 6, 1, 'CORDOBA', 'LA BOTIJA', '5214', NULL, NULL);
INSERT INTO `localidades` VALUES(1693, 6, 1, 'CORDOBA', 'LA CALERA', '5151', NULL, NULL);
INSERT INTO `localidades` VALUES(1694, 6, 1, 'CORDOBA', 'LA CARLOTA', '2670', NULL, NULL);
INSERT INTO `localidades` VALUES(1695, 6, 1, 'CORDOBA', 'LA CAUTIVA', '6142', NULL, NULL);
INSERT INTO `localidades` VALUES(1696, 6, 1, 'CORDOBA', 'LA CAÑADA', '5201', NULL, NULL);
INSERT INTO `localidades` VALUES(1697, 6, 1, 'CORDOBA', 'LA CESIRA', '6101', NULL, NULL);
INSERT INTO `localidades` VALUES(1698, 6, 1, 'CORDOBA', 'LA CRUZ CBA', '5859', NULL, NULL);
INSERT INTO `localidades` VALUES(1699, 6, 1, 'CORDOBA', 'LA CUMBRE', '5178', NULL, NULL);
INSERT INTO `localidades` VALUES(1700, 6, 1, 'CORDOBA', 'LA CUMBRECITA', '5194', NULL, NULL);
INSERT INTO `localidades` VALUES(1701, 6, 1, 'CORDOBA', 'LA DONOSA', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1702, 6, 1, 'CORDOBA', 'LA FALDA', '5172', NULL, NULL);
INSERT INTO `localidades` VALUES(1703, 6, 1, 'CORDOBA', 'LA FRANCIA', '2426', NULL, NULL);
INSERT INTO `localidades` VALUES(1704, 6, 1, 'CORDOBA', 'LA GRANJA (CBA)', '5115', NULL, NULL);
INSERT INTO `localidades` VALUES(1705, 6, 1, 'CORDOBA', 'LA HIGUERA (CBA)', '5285', NULL, NULL);
INSERT INTO `localidades` VALUES(1706, 6, 1, 'CORDOBA', 'LA HIGUERITA', '5176', NULL, NULL);
INSERT INTO `localidades` VALUES(1707, 6, 1, 'CORDOBA', 'LA ISLA', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1708, 6, 1, 'CORDOBA', 'LA LAGUNA', '5901', NULL, NULL);
INSERT INTO `localidades` VALUES(1709, 6, 1, 'CORDOBA', 'LA LEGUA', '5284', NULL, NULL);
INSERT INTO `localidades` VALUES(1710, 6, 1, 'CORDOBA', 'LA MAJADILLA', '5203', NULL, NULL);
INSERT INTO `localidades` VALUES(1711, 6, 1, 'CORDOBA', 'LA PAISANITA', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1712, 6, 1, 'CORDOBA', 'LA PALESTINA', '5925', NULL, NULL);
INSERT INTO `localidades` VALUES(1713, 6, 1, 'CORDOBA', 'LA PAMPA (CORDOBA)', '5117', NULL, NULL);
INSERT INTO `localidades` VALUES(1714, 6, 1, 'CORDOBA', 'LA PAQUITA', '2417', NULL, NULL);
INSERT INTO `localidades` VALUES(1715, 6, 1, 'CORDOBA', 'LA PARA', '5137', NULL, NULL);
INSERT INTO `localidades` VALUES(1716, 6, 1, 'CORDOBA', 'LA PAZ (CBA)', '5117', NULL, NULL);
INSERT INTO `localidades` VALUES(1717, 6, 1, 'CORDOBA', 'LA PERLA', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(1718, 6, 1, 'CORDOBA', 'LA PLAYOSA', '5911', NULL, NULL);
INSERT INTO `localidades` VALUES(1719, 6, 1, 'CORDOBA', 'LA PORTEÑA', '5221', NULL, NULL);
INSERT INTO `localidades` VALUES(1720, 6, 1, 'CORDOBA', 'LA PRIMAVERA (DTO CRUZ DEL EJE)', '5172', NULL, NULL);
INSERT INTO `localidades` VALUES(1721, 6, 1, 'CORDOBA', 'LA PRIMAVERA (MARULL, DTO SAN JUSTO', '5139', NULL, NULL);
INSERT INTO `localidades` VALUES(1722, 6, 1, 'CORDOBA', 'LA PUERTA (CBA)', '5137', NULL, NULL);
INSERT INTO `localidades` VALUES(1723, 6, 1, 'CORDOBA', 'LA QUEBRADA', '5111', NULL, NULL);
INSERT INTO `localidades` VALUES(1724, 6, 1, 'CORDOBA', 'LA RINCONADA', '5233', NULL, NULL);
INSERT INTO `localidades` VALUES(1725, 6, 1, 'CORDOBA', 'LA SERRANITA', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1726, 6, 1, 'CORDOBA', 'LA TABLADA (POCHO, DTO POCHO)', '5299', NULL, NULL);
INSERT INTO `localidades` VALUES(1727, 6, 1, 'CORDOBA', 'LA TABLADA (SUC 9, DTO CAPITAL)', '5009', NULL, NULL);
INSERT INTO `localidades` VALUES(1728, 6, 1, 'CORDOBA', 'LA TORDILLA - CBA', '2435', NULL, NULL);
INSERT INTO `localidades` VALUES(1729, 6, 1, 'CORDOBA', 'LA TUNA', '5212', NULL, NULL);
INSERT INTO `localidades` VALUES(1730, 6, 1, 'CORDOBA', 'LA ZANJA', '5201', NULL, NULL);
INSERT INTO `localidades` VALUES(1731, 6, 1, 'CORDOBA', 'LABORDE', '2657', NULL, NULL);
INSERT INTO `localidades` VALUES(1732, 6, 1, 'CORDOBA', 'LABOULAYE', '6120', NULL, NULL);
INSERT INTO `localidades` VALUES(1733, 6, 1, 'CORDOBA', 'LAGUNA DEL MONTE', '6101', NULL, NULL);
INSERT INTO `localidades` VALUES(1734, 6, 1, 'CORDOBA', 'LAGUNA LARGA', '5974', NULL, NULL);
INSERT INTO `localidades` VALUES(1735, 6, 1, 'CORDOBA', 'LAS ACEQUIAS', '5848', NULL, NULL);
INSERT INTO `localidades` VALUES(1736, 6, 1, 'CORDOBA', 'LAS BAJADAS', '5851', NULL, NULL);
INSERT INTO `localidades` VALUES(1737, 6, 1, 'CORDOBA', 'LAS CALERAS', '5819', NULL, NULL);
INSERT INTO `localidades` VALUES(1738, 6, 1, 'CORDOBA', 'LAS CANTERAS', '5218', NULL, NULL);
INSERT INTO `localidades` VALUES(1739, 6, 1, 'CORDOBA', 'LAS CHACRAS', '5875', NULL, NULL);
INSERT INTO `localidades` VALUES(1740, 6, 1, 'CORDOBA', 'LAS ESCOBAS', '5182', NULL, NULL);
INSERT INTO `localidades` VALUES(1741, 6, 1, 'CORDOBA', 'LAS FLORES', '5249', NULL, NULL);
INSERT INTO `localidades` VALUES(1742, 6, 1, 'CORDOBA', 'LAS GAMAS', '5819', NULL, NULL);
INSERT INTO `localidades` VALUES(1743, 6, 1, 'CORDOBA', 'LAS HIGUERAS', '5117', NULL, NULL);
INSERT INTO `localidades` VALUES(1744, 6, 1, 'CORDOBA', 'LAS ISLETILLAS', '5931', NULL, NULL);
INSERT INTO `localidades` VALUES(1745, 6, 1, 'CORDOBA', 'LAS JUNTAS', '5203', NULL, NULL);
INSERT INTO `localidades` VALUES(1746, 6, 1, 'CORDOBA', 'LAS JUNTURAS', '5965', NULL, NULL);
INSERT INTO `localidades` VALUES(1747, 6, 1, 'CORDOBA', 'LAS MARGARITAS', '2671', NULL, NULL);
INSERT INTO `localidades` VALUES(1748, 6, 1, 'CORDOBA', 'LAS MOJADILLAS', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(1749, 6, 1, 'CORDOBA', 'LAS MOJARRAS', '5909', NULL, NULL);
INSERT INTO `localidades` VALUES(1750, 6, 1, 'CORDOBA', 'LAS PALOMAS', '5201', NULL, NULL);
INSERT INTO `localidades` VALUES(1751, 6, 1, 'CORDOBA', 'LAS PERDICES', '5921', NULL, NULL);
INSERT INTO `localidades` VALUES(1752, 6, 1, 'CORDOBA', 'LAS PEÑAS NORTE', '5238', NULL, NULL);
INSERT INTO `localidades` VALUES(1753, 6, 1, 'CORDOBA', 'LAS RABONAS', '5885', NULL, NULL);
INSERT INTO `localidades` VALUES(1754, 6, 1, 'CORDOBA', 'LAS TAPIAS (CBA)', '5281', NULL, NULL);
INSERT INTO `localidades` VALUES(1755, 6, 1, 'CORDOBA', 'LAS TOSCAS (CBA)', '5871', NULL, NULL);
INSERT INTO `localidades` VALUES(1756, 6, 1, 'CORDOBA', 'LAS VARAS', '5941', NULL, NULL);
INSERT INTO `localidades` VALUES(1757, 6, 1, 'CORDOBA', 'LAS VARILLAS', '5940', NULL, NULL);
INSERT INTO `localidades` VALUES(1758, 6, 1, 'CORDOBA', 'LAS VERTIENTES', '5827', NULL, NULL);
INSERT INTO `localidades` VALUES(1759, 6, 1, 'CORDOBA', 'LEONES', '2594', NULL, NULL);
INSERT INTO `localidades` VALUES(1760, 6, 1, 'CORDOBA', 'LOMA BOLA', '5879', NULL, NULL);
INSERT INTO `localidades` VALUES(1761, 6, 1, 'CORDOBA', 'LOS CAUDILLOS', '5214', NULL, NULL);
INSERT INTO `localidades` VALUES(1762, 6, 1, 'CORDOBA', 'LOS CEDROS', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1763, 6, 1, 'CORDOBA', 'LOS CERRILLOS (CBA)', '5871', NULL, NULL);
INSERT INTO `localidades` VALUES(1764, 6, 1, 'CORDOBA', 'LOS CHAÑARES', '5212', NULL, NULL);
INSERT INTO `localidades` VALUES(1765, 6, 1, 'CORDOBA', 'LOS CHAÑARITOS', '5125', NULL, NULL);
INSERT INTO `localidades` VALUES(1766, 6, 1, 'CORDOBA', 'LOS CISNES', '2684', NULL, NULL);
INSERT INTO `localidades` VALUES(1767, 6, 1, 'CORDOBA', 'LOS COCOS', '5182', NULL, NULL);
INSERT INTO `localidades` VALUES(1768, 6, 1, 'CORDOBA', 'LOS CONDORES', '5823', NULL, NULL);
INSERT INTO `localidades` VALUES(1769, 6, 1, 'CORDOBA', 'LOS MISTOLES', '5229', NULL, NULL);
INSERT INTO `localidades` VALUES(1770, 6, 1, 'CORDOBA', 'LOS MOLINOS (CBA)', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1771, 6, 1, 'CORDOBA', 'LOS MOLLES (CBA)', '5885', NULL, NULL);
INSERT INTO `localidades` VALUES(1772, 6, 1, 'CORDOBA', 'LOS POZOS', '5244', NULL, NULL);
INSERT INTO `localidades` VALUES(1773, 6, 1, 'CORDOBA', 'LOS QUEBRACHOS', '5246', NULL, NULL);
INSERT INTO `localidades` VALUES(1774, 6, 1, 'CORDOBA', 'LOS REARTES', '5194', NULL, NULL);
INSERT INTO `localidades` VALUES(1775, 6, 1, 'CORDOBA', 'LOS SAUCES (CBA)', '5282', NULL, NULL);
INSERT INTO `localidades` VALUES(1776, 6, 1, 'CORDOBA', 'LOS SURGENTES', '2581', NULL, NULL);
INSERT INTO `localidades` VALUES(1777, 6, 1, 'CORDOBA', 'LOS TARTAGOS', '5218', NULL, NULL);
INSERT INTO `localidades` VALUES(1778, 6, 1, 'CORDOBA', 'LOS ZORROS', '5901', NULL, NULL);
INSERT INTO `localidades` VALUES(1779, 6, 1, 'CORDOBA', 'LOZADA', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(1780, 6, 1, 'CORDOBA', 'LUCA', '5917', NULL, NULL);
INSERT INTO `localidades` VALUES(1781, 6, 1, 'CORDOBA', 'LUCIO V. MANSILLA', '5216', NULL, NULL);
INSERT INTO `localidades` VALUES(1782, 6, 1, 'CORDOBA', 'LUQUE', '5967', NULL, NULL);
INSERT INTO `localidades` VALUES(1783, 6, 1, 'CORDOBA', 'LUTTI', '5853', NULL, NULL);
INSERT INTO `localidades` VALUES(1784, 6, 1, 'CORDOBA', 'LUXARDO', '2411', NULL, NULL);
INSERT INTO `localidades` VALUES(1785, 6, 1, 'CORDOBA', 'LUYABA', '5875', NULL, NULL);
INSERT INTO `localidades` VALUES(1786, 6, 1, 'CORDOBA', 'MACHA', '5211', NULL, NULL);
INSERT INTO `localidades` VALUES(1787, 6, 1, 'CORDOBA', 'MALAGUEÑO', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(1788, 6, 1, 'CORDOBA', 'MALENA', '5839', NULL, NULL);
INSERT INTO `localidades` VALUES(1789, 6, 1, 'CORDOBA', 'MANFREDI', '5988', NULL, NULL);
INSERT INTO `localidades` VALUES(1790, 6, 1, 'CORDOBA', 'MARCOS JUAREZ', '2580', NULL, NULL);
INSERT INTO `localidades` VALUES(1791, 6, 1, 'CORDOBA', 'MARULL', '5139', NULL, NULL);
INSERT INTO `localidades` VALUES(1792, 6, 1, 'CORDOBA', 'MATALDI', '6271', NULL, NULL);
INSERT INTO `localidades` VALUES(1793, 6, 1, 'CORDOBA', 'MATORRALES', '5965', NULL, NULL);
INSERT INTO `localidades` VALUES(1794, 6, 1, 'CORDOBA', 'MAYUC SUMAJ', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1795, 6, 1, 'CORDOBA', 'MEDIA NARANJA', '5281', NULL, NULL);
INSERT INTO `localidades` VALUES(1796, 6, 1, 'CORDOBA', 'MELO', '6123', NULL, NULL);
INSERT INTO `localidades` VALUES(1797, 6, 1, 'CORDOBA', 'MENDIOLAZA', '5107', NULL, NULL);
INSERT INTO `localidades` VALUES(1798, 6, 1, 'CORDOBA', 'MI GRANJA', '5125', NULL, NULL);
INSERT INTO `localidades` VALUES(1799, 6, 1, 'CORDOBA', 'MI VALLE', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(1800, 6, 1, 'CORDOBA', 'MINA CLAVERO', '5889', NULL, NULL);
INSERT INTO `localidades` VALUES(1801, 6, 1, 'CORDOBA', 'MIRADOR DEL LAGO', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1802, 6, 1, 'CORDOBA', 'MIRAMAR (CBA)', '5143', NULL, NULL);
INSERT INTO `localidades` VALUES(1803, 6, 1, 'CORDOBA', 'MOLINARI', '5166', NULL, NULL);
INSERT INTO `localidades` VALUES(1804, 6, 1, 'CORDOBA', 'MONTE BUEY', '2589', NULL, NULL);
INSERT INTO `localidades` VALUES(1805, 6, 1, 'CORDOBA', 'MONTE CRISTO', '5125', NULL, NULL);
INSERT INTO `localidades` VALUES(1806, 6, 1, 'CORDOBA', 'MONTE DE LOS GAUCHOS', '5831', NULL, NULL);
INSERT INTO `localidades` VALUES(1807, 6, 1, 'CORDOBA', 'MONTE DEL ROSARIO', '5129', NULL, NULL);
INSERT INTO `localidades` VALUES(1808, 6, 1, 'CORDOBA', 'MONTE LENA', '2564', NULL, NULL);
INSERT INTO `localidades` VALUES(1809, 6, 1, 'CORDOBA', 'MONTE MAIZ', '2659', NULL, NULL);
INSERT INTO `localidades` VALUES(1810, 6, 1, 'CORDOBA', 'MONTE RALO', '5119', NULL, NULL);
INSERT INTO `localidades` VALUES(1811, 6, 1, 'CORDOBA', 'MONTE REDONDO', '2423', NULL, NULL);
INSERT INTO `localidades` VALUES(1812, 6, 1, 'CORDOBA', 'MORRISON', '2568', NULL, NULL);
INSERT INTO `localidades` VALUES(1813, 6, 1, 'CORDOBA', 'MORTEROS', '2421', NULL, NULL);
INSERT INTO `localidades` VALUES(1814, 6, 1, 'CORDOBA', 'NICOLAS BRUZONE', '6271', NULL, NULL);
INSERT INTO `localidades` VALUES(1815, 6, 1, 'CORDOBA', 'NOETINGER', '2563', NULL, NULL);
INSERT INTO `localidades` VALUES(1816, 6, 1, 'CORDOBA', 'NONO', '5887', NULL, NULL);
INSERT INTO `localidades` VALUES(1817, 6, 1, 'CORDOBA', 'OBISPO TREJO', '5225', NULL, NULL);
INSERT INTO `localidades` VALUES(1818, 6, 1, 'CORDOBA', 'OJO DE AGUA', '5220', NULL, NULL);
INSERT INTO `localidades` VALUES(1819, 6, 1, 'CORDOBA', 'OLAETA', '5807', NULL, NULL);
INSERT INTO `localidades` VALUES(1820, 6, 1, 'CORDOBA', 'OLIVA', '5980', NULL, NULL);
INSERT INTO `localidades` VALUES(1821, 6, 1, 'CORDOBA', 'OLIVARES SAN NICOLAS', '5280', NULL, NULL);
INSERT INTO `localidades` VALUES(1822, 6, 1, 'CORDOBA', 'ONCATIVO', '5986', NULL, NULL);
INSERT INTO `localidades` VALUES(1823, 6, 1, 'CORDOBA', 'ONGAMIRA', '5184', NULL, NULL);
INSERT INTO `localidades` VALUES(1824, 6, 1, 'CORDOBA', 'ORDOÑEZ', '2555', NULL, NULL);
INSERT INTO `localidades` VALUES(1825, 6, 1, 'CORDOBA', 'PAJAS BLANCAS', '5111', NULL, NULL);
INSERT INTO `localidades` VALUES(1826, 6, 1, 'CORDOBA', 'PALO PARADO', '5280', NULL, NULL);
INSERT INTO `localidades` VALUES(1827, 6, 1, 'CORDOBA', 'PAMPA DE ACHALA', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1828, 6, 1, 'CORDOBA', 'PAMPA DE POCHO', '5299', NULL, NULL);
INSERT INTO `localidades` VALUES(1829, 6, 1, 'CORDOBA', 'PAMPAYASTA NORTE', '5931', NULL, NULL);
INSERT INTO `localidades` VALUES(1830, 6, 1, 'CORDOBA', 'PAMPAYASTA SUR', '5931', NULL, NULL);
INSERT INTO `localidades` VALUES(1831, 6, 1, 'CORDOBA', 'PANAHOLMA', '5893', NULL, NULL);
INSERT INTO `localidades` VALUES(1832, 6, 1, 'CORDOBA', 'PARQUE SIQUIMAN', '5158', NULL, NULL);
INSERT INTO `localidades` VALUES(1833, 6, 1, 'CORDOBA', 'PASCANAS', '2679', NULL, NULL);
INSERT INTO `localidades` VALUES(1834, 6, 1, 'CORDOBA', 'PASCO', '5925', NULL, NULL);
INSERT INTO `localidades` VALUES(1835, 6, 1, 'CORDOBA', 'PASO VIEJO', '5284', NULL, NULL);
INSERT INTO `localidades` VALUES(1836, 6, 1, 'CORDOBA', 'PICHANAS', '5284', NULL, NULL);
INSERT INTO `localidades` VALUES(1837, 6, 1, 'CORDOBA', 'PILAR (CBA)', '5972', NULL, NULL);
INSERT INTO `localidades` VALUES(1838, 6, 1, 'CORDOBA', 'PINTOS (CBA)', '5178', NULL, NULL);
INSERT INTO `localidades` VALUES(1839, 6, 1, 'CORDOBA', 'PIQUILLIN', '5125', NULL, NULL);
INSERT INTO `localidades` VALUES(1840, 6, 1, 'CORDOBA', 'PLAZA COLAZO', '5965', NULL, NULL);
INSERT INTO `localidades` VALUES(1841, 6, 1, 'CORDOBA', 'PLAZA JOSEFINA (CBA)', '2403', NULL, NULL);
INSERT INTO `localidades` VALUES(1842, 6, 1, 'CORDOBA', 'PLAZA MECEDES', '5137', NULL, NULL);
INSERT INTO `localidades` VALUES(1843, 6, 1, 'CORDOBA', 'PLAZA SAN FRANCISCO', '2401', NULL, NULL);
INSERT INTO `localidades` VALUES(1844, 6, 1, 'CORDOBA', 'PORTEÑA', '2415', NULL, NULL);
INSERT INTO `localidades` VALUES(1845, 6, 1, 'CORDOBA', 'POTRERO DE GARAY', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1846, 6, 1, 'CORDOBA', 'POTRERO DE LUJAN', '5191', NULL, NULL);
INSERT INTO `localidades` VALUES(1847, 6, 1, 'CORDOBA', 'POZO DEL MOLLE', '5913', NULL, NULL);
INSERT INTO `localidades` VALUES(1848, 6, 1, 'CORDOBA', 'POZO DEL TALA', '5187', NULL, NULL);
INSERT INTO `localidades` VALUES(1849, 6, 1, 'CORDOBA', 'PUEBLO ITALIANO', '2651', NULL, NULL);
INSERT INTO `localidades` VALUES(1850, 6, 1, 'CORDOBA', 'PUERTA COLORADA', '5817', NULL, NULL);
INSERT INTO `localidades` VALUES(1851, 6, 1, 'CORDOBA', 'PUESTO DE TINNI', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(1852, 6, 1, 'CORDOBA', 'PUESTO DEL ROSARIO (TOTORAL)', '5236', NULL, NULL);
INSERT INTO `localidades` VALUES(1853, 6, 1, 'CORDOBA', 'PUESTO SAN JOSE (DTO TOTORAL)', '5242', NULL, NULL);
INSERT INTO `localidades` VALUES(1854, 6, 1, 'CORDOBA', 'PUESTO VIEJO', '5244', NULL, NULL);
INSERT INTO `localidades` VALUES(1855, 6, 1, 'CORDOBA', 'PUNTA DEL AGUA', '5187', NULL, NULL);
INSERT INTO `localidades` VALUES(1856, 6, 1, 'CORDOBA', 'QUEBRACHO HERRADO', '2423', NULL, NULL);
INSERT INTO `localidades` VALUES(1857, 6, 1, 'CORDOBA', 'QUEBRADA DE LUNA', '5282', NULL, NULL);
INSERT INTO `localidades` VALUES(1858, 6, 1, 'CORDOBA', 'RAFAEL GARCIA', '5119', NULL, NULL);
INSERT INTO `localidades` VALUES(1859, 6, 1, 'CORDOBA', 'RAMON J. CARCANO', '5900', NULL, NULL);
INSERT INTO `localidades` VALUES(1860, 6, 1, 'CORDOBA', 'RANGEL', '5131', NULL, NULL);
INSERT INTO `localidades` VALUES(1861, 6, 1, 'CORDOBA', 'RAYO CORTADO', '5246', NULL, NULL);
INSERT INTO `localidades` VALUES(1862, 6, 1, 'CORDOBA', 'REDUCCION (CBA)', '5803', NULL, NULL);
INSERT INTO `localidades` VALUES(1863, 6, 1, 'CORDOBA', 'RINCON (CBA)', '5961', NULL, NULL);
INSERT INTO `localidades` VALUES(1864, 6, 1, 'CORDOBA', 'RIO BAMBA', '6134', NULL, NULL);
INSERT INTO `localidades` VALUES(1865, 6, 1, 'CORDOBA', 'RIO CEBALLOS', '5111', NULL, NULL);
INSERT INTO `localidades` VALUES(1866, 6, 1, 'CORDOBA', 'RIO CUARTO', '5800', NULL, NULL);
INSERT INTO `localidades` VALUES(1867, 6, 1, 'CORDOBA', 'RIO DE LOS SAUCES', '5821', NULL, NULL);
INSERT INTO `localidades` VALUES(1868, 6, 1, 'CORDOBA', 'RIO PRIMERO', '5127', NULL, NULL);
INSERT INTO `localidades` VALUES(1869, 6, 1, 'CORDOBA', 'RIO SECO (CBA)', '5284', NULL, NULL);
INSERT INTO `localidades` VALUES(1870, 6, 1, 'CORDOBA', 'RIO SEGUNDO', '5960', NULL, NULL);
INSERT INTO `localidades` VALUES(1871, 6, 1, 'CORDOBA', 'RIO TERCERO', '5850', NULL, NULL);
INSERT INTO `localidades` VALUES(1872, 6, 1, 'CORDOBA', 'RODEO VIEJO', '5801', NULL, NULL);
INSERT INTO `localidades` VALUES(1873, 6, 1, 'CORDOBA', 'ROSALES', '6128', NULL, NULL);
INSERT INTO `localidades` VALUES(1874, 6, 1, 'CORDOBA', 'SACANTA', '5945', NULL, NULL);
INSERT INTO `localidades` VALUES(1875, 6, 1, 'CORDOBA', 'SAIRA', '2525', NULL, NULL);
INSERT INTO `localidades` VALUES(1876, 6, 1, 'CORDOBA', 'SALADILLO (CBA)', '2587', NULL, NULL);
INSERT INTO `localidades` VALUES(1877, 6, 1, 'CORDOBA', 'SALDAN', '5149', NULL, NULL);
INSERT INTO `localidades` VALUES(1878, 6, 1, 'CORDOBA', 'SALSACATE', '5295', NULL, NULL);
INSERT INTO `localidades` VALUES(1879, 6, 1, 'CORDOBA', 'SALSIPUEDES', '5113', NULL, NULL);
INSERT INTO `localidades` VALUES(1880, 6, 1, 'CORDOBA', 'SAMPACHO', '5829', NULL, NULL);
INSERT INTO `localidades` VALUES(1881, 6, 1, 'CORDOBA', 'SAN AGUSTIN (CBA)', '5191', NULL, NULL);
INSERT INTO `localidades` VALUES(1882, 6, 1, 'CORDOBA', 'SAN ALBERTO', '5871', NULL, NULL);
INSERT INTO `localidades` VALUES(1883, 6, 1, 'CORDOBA', 'SAN ANTONIO DE ARREDONDO', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1884, 6, 1, 'CORDOBA', 'SAN ANTONIO DE LITIN', '2559', NULL, NULL);
INSERT INTO `localidades` VALUES(1885, 6, 1, 'CORDOBA', 'SAN BASILIO', '5841', NULL, NULL);
INSERT INTO `localidades` VALUES(1886, 6, 1, 'CORDOBA', 'SAN CARLOS MINAS', '5291', NULL, NULL);
INSERT INTO `localidades` VALUES(1887, 6, 1, 'CORDOBA', 'SAN CLEMENTE', '5187', NULL, NULL);
INSERT INTO `localidades` VALUES(1888, 6, 1, 'CORDOBA', 'SAN ESTEBAN', '5182', NULL, NULL);
INSERT INTO `localidades` VALUES(1889, 6, 1, 'CORDOBA', 'SAN FRANCISCO', '2400', NULL, NULL);
INSERT INTO `localidades` VALUES(1890, 6, 1, 'CORDOBA', 'SAN FRANCISCO DEL CHAÑAR', '5209', NULL, NULL);
INSERT INTO `localidades` VALUES(1891, 6, 1, 'CORDOBA', 'SAN IGNACIO (CBA)', '5199', NULL, NULL);
INSERT INTO `localidades` VALUES(1892, 6, 1, 'CORDOBA', 'SAN ISIDRO (CBA)', '5220', NULL, NULL);
INSERT INTO `localidades` VALUES(1893, 6, 1, 'CORDOBA', 'SAN JAVIER (CBA)', '5875', NULL, NULL);
INSERT INTO `localidades` VALUES(1894, 6, 1, 'CORDOBA', 'SAN JOAQUIN (CBA)', '6123', NULL, NULL);
INSERT INTO `localidades` VALUES(1895, 6, 1, 'CORDOBA', 'SAN JOSE (COSQUIN)', '5166', NULL, NULL);
INSERT INTO `localidades` VALUES(1896, 6, 1, 'CORDOBA', 'SAN JOSE (DTO CRUZ DEL EJE)', '5281', NULL, NULL);
INSERT INTO `localidades` VALUES(1897, 6, 1, 'CORDOBA', 'SAN JOSE (NOETINGER, DTO UNION)', '2563', NULL, NULL);
INSERT INTO `localidades` VALUES(1898, 6, 1, 'CORDOBA', 'SAN JOSE (SAN JAVIER)', '5871', NULL, NULL);
INSERT INTO `localidades` VALUES(1899, 6, 1, 'CORDOBA', 'SAN JOSE DE LA DORMIDA', '5244', NULL, NULL);
INSERT INTO `localidades` VALUES(1900, 6, 1, 'CORDOBA', 'SAN JOSE DE LAS SALINAS', '5216', NULL, NULL);
INSERT INTO `localidades` VALUES(1901, 6, 1, 'CORDOBA', 'SAN JOSE DEL SALTEÑO', '2563', NULL, NULL);
INSERT INTO `localidades` VALUES(1902, 6, 1, 'CORDOBA', 'SAN MARCOS SIERRAS', '5282', NULL, NULL);
INSERT INTO `localidades` VALUES(1903, 6, 1, 'CORDOBA', 'SAN MARCOS SUD', '2566', NULL, NULL);
INSERT INTO `localidades` VALUES(1904, 6, 1, 'CORDOBA', 'SAN MIGUEL (CBA)', '5212', NULL, NULL);
INSERT INTO `localidades` VALUES(1905, 6, 1, 'CORDOBA', 'SAN NICOLAS (CBA)', '5152', NULL, NULL);
INSERT INTO `localidades` VALUES(1906, 6, 1, 'CORDOBA', 'SAN PEDRO (CINTRA, DTO UNION)', '2559', NULL, NULL);
INSERT INTO `localidades` VALUES(1907, 6, 1, 'CORDOBA', 'SAN PEDRO (DTO SAN ALBERTO)', '5871', NULL, NULL);
INSERT INTO `localidades` VALUES(1908, 6, 1, 'CORDOBA', 'SAN PEDRO (GUTEMBERG, DTO RIO SECO)', '5249', NULL, NULL);
INSERT INTO `localidades` VALUES(1909, 6, 1, 'CORDOBA', 'SAN PEDRO DE TOYOS', '5201', NULL, NULL);
INSERT INTO `localidades` VALUES(1910, 6, 1, 'CORDOBA', 'SAN PEDRO NOLACO', '5017', NULL, NULL);
INSERT INTO `localidades` VALUES(1911, 6, 1, 'CORDOBA', 'SAN PEDRO NORTE', '5205', NULL, NULL);
INSERT INTO `localidades` VALUES(1912, 6, 1, 'CORDOBA', 'SAN ROQUE (CBA)', '5149', NULL, NULL);
INSERT INTO `localidades` VALUES(1913, 6, 1, 'CORDOBA', 'SANABRIA', '5901', NULL, NULL);
INSERT INTO `localidades` VALUES(1914, 6, 1, 'CORDOBA', 'SANTA ANA (P VIEJO, DTO CRUZ DEL EJ', '5284', NULL, NULL);
INSERT INTO `localidades` VALUES(1915, 6, 1, 'CORDOBA', 'SANTA ANA (SF CHAÑAR, DTO SOBREMONT', '5209', NULL, NULL);
INSERT INTO `localidades` VALUES(1916, 6, 1, 'CORDOBA', 'SANTA BARBARA (CBA)', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(1917, 6, 1, 'CORDOBA', 'SANTA CECILIA', '5176', NULL, NULL);
INSERT INTO `localidades` VALUES(1918, 6, 1, 'CORDOBA', 'SANTA CLARA DE SAGUIER', '2405', NULL, NULL);
INSERT INTO `localidades` VALUES(1919, 6, 1, 'CORDOBA', 'SANTA CRUZ', '5201', NULL, NULL);
INSERT INTO `localidades` VALUES(1920, 6, 1, 'CORDOBA', 'SANTA ELENA (CBA)', '5246', NULL, NULL);
INSERT INTO `localidades` VALUES(1921, 6, 1, 'CORDOBA', 'SANTA EUFEMIA', '2671', NULL, NULL);
INSERT INTO `localidades` VALUES(1922, 6, 1, 'CORDOBA', 'SANTA ISABEL (CHARBONIER, Dº PUNILL', '5282', NULL, NULL);
INSERT INTO `localidades` VALUES(1923, 6, 1, 'CORDOBA', 'SANTA ISABEL (DTO RIO SECO)', '5249', NULL, NULL);
INSERT INTO `localidades` VALUES(1924, 6, 1, 'CORDOBA', 'SANTA MARIA DE PUNILLA', '5164', NULL, NULL);
INSERT INTO `localidades` VALUES(1925, 6, 1, 'CORDOBA', 'SANTA MONICA', '5197', NULL, NULL);
INSERT INTO `localidades` VALUES(1926, 6, 1, 'CORDOBA', 'SANTA ROSA DE CALAMUCHITA', '5196', NULL, NULL);
INSERT INTO `localidades` VALUES(1927, 6, 1, 'CORDOBA', 'SANTA ROSA DE RIO PRIMERO', '5133', NULL, NULL);
INSERT INTO `localidades` VALUES(1928, 6, 1, 'CORDOBA', 'SANTIAGO TEMPLE', '5125', NULL, NULL);
INSERT INTO `localidades` VALUES(1929, 6, 1, 'CORDOBA', 'SARMIENTO (CBA)', '5212', NULL, NULL);
INSERT INTO `localidades` VALUES(1930, 6, 1, 'CORDOBA', 'SATURNINO M. LASPIUR', '5943', NULL, NULL);
INSERT INTO `localidades` VALUES(1931, 6, 1, 'CORDOBA', 'SEBASTIAN ELCANO', '5231', NULL, NULL);
INSERT INTO `localidades` VALUES(1932, 6, 1, 'CORDOBA', 'SEEBER', '2419', NULL, NULL);
INSERT INTO `localidades` VALUES(1933, 6, 1, 'CORDOBA', 'SERRANO', '6125', NULL, NULL);
INSERT INTO `localidades` VALUES(1934, 6, 1, 'CORDOBA', 'SERREZUELA', '5270', NULL, NULL);
INSERT INTO `localidades` VALUES(1935, 6, 1, 'CORDOBA', 'SILVIO PELLICO', '5907', NULL, NULL);
INSERT INTO `localidades` VALUES(1936, 6, 1, 'CORDOBA', 'SIMBOLAR (CBA)', '5242', NULL, NULL);
INSERT INTO `localidades` VALUES(1937, 6, 1, 'CORDOBA', 'SINSACATE', '5220', NULL, NULL);
INSERT INTO `localidades` VALUES(1938, 6, 1, 'CORDOBA', 'SUCO', '5837', NULL, NULL);
INSERT INTO `localidades` VALUES(1939, 6, 1, 'CORDOBA', 'TALA CAÑADA', '5297', NULL, NULL);
INSERT INTO `localidades` VALUES(1940, 6, 1, 'CORDOBA', 'TALA HUASI', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1941, 6, 1, 'CORDOBA', 'TANCACHA', '5933', NULL, NULL);
INSERT INTO `localidades` VALUES(1942, 6, 1, 'CORDOBA', 'TANTI', '5155', NULL, NULL);
INSERT INTO `localidades` VALUES(1943, 6, 1, 'CORDOBA', 'TICINO', '5925', NULL, NULL);
INSERT INTO `localidades` VALUES(1944, 6, 1, 'CORDOBA', 'TIO PUJIO', '5936', NULL, NULL);
INSERT INTO `localidades` VALUES(1945, 6, 1, 'CORDOBA', 'TOLEDO', '5123', NULL, NULL);
INSERT INTO `localidades` VALUES(1946, 6, 1, 'CORDOBA', 'TOSNO', '5289', NULL, NULL);
INSERT INTO `localidades` VALUES(1947, 6, 1, 'CORDOBA', 'TOSQUITA', '6141', NULL, NULL);
INSERT INTO `localidades` VALUES(1948, 6, 1, 'CORDOBA', 'TOTORALEJOS', '5216', NULL, NULL);
INSERT INTO `localidades` VALUES(1949, 6, 1, 'CORDOBA', 'TRANSITO', '2436', NULL, NULL);
INSERT INTO `localidades` VALUES(1950, 6, 1, 'CORDOBA', 'TUCLAME', '5284', NULL, NULL);
INSERT INTO `localidades` VALUES(1951, 6, 1, 'CORDOBA', 'TULUMBA', '5203', NULL, NULL);
INSERT INTO `localidades` VALUES(1952, 6, 1, 'CORDOBA', 'UCACHA', '2677', NULL, NULL);
INSERT INTO `localidades` VALUES(1953, 6, 1, 'CORDOBA', 'UNIDAD TURISTICA EMBALSE', '5857', NULL, NULL);
INSERT INTO `localidades` VALUES(1954, 6, 1, 'CORDOBA', 'UNQUILLO', '5109', NULL, NULL);
INSERT INTO `localidades` VALUES(1955, 6, 1, 'CORDOBA', 'USINA NUCLEAR EMBALSE', '5859', NULL, NULL);
INSERT INTO `localidades` VALUES(1956, 6, 1, 'CORDOBA', 'VALLE ALEGRE', '5187', NULL, NULL);
INSERT INTO `localidades` VALUES(1957, 6, 1, 'CORDOBA', 'VALLE HERMOSO', '5168', NULL, NULL);
INSERT INTO `localidades` VALUES(1958, 6, 1, 'CORDOBA', 'VAQUERIAS', '5168', NULL, NULL);
INSERT INTO `localidades` VALUES(1959, 6, 1, 'CORDOBA', 'VICUÑA MACKENA', '6140', NULL, NULL);
INSERT INTO `localidades` VALUES(1960, 6, 1, 'CORDOBA', 'VILLA ALBERTINA', '5221', NULL, NULL);
INSERT INTO `localidades` VALUES(1961, 6, 1, 'CORDOBA', 'VILLA ALICIA', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(1962, 6, 1, 'CORDOBA', 'VILLA ALLENDE', '5105', NULL, NULL);
INSERT INTO `localidades` VALUES(1963, 6, 1, 'CORDOBA', 'VILLA ALPINA', '5194', NULL, NULL);
INSERT INTO `localidades` VALUES(1964, 6, 1, 'CORDOBA', 'VILLA AMANCAY', '5199', NULL, NULL);
INSERT INTO `localidades` VALUES(1965, 6, 1, 'CORDOBA', 'VILLA ANIMI', '5107', NULL, NULL);
INSERT INTO `localidades` VALUES(1966, 6, 1, 'CORDOBA', 'VILLA ASCASUBI', '5935', NULL, NULL);
INSERT INTO `localidades` VALUES(1967, 6, 1, 'CORDOBA', 'VILLA BERNA', '5194', NULL, NULL);
INSERT INTO `localidades` VALUES(1968, 6, 1, 'CORDOBA', 'VILLA BUSTOS', '5164', NULL, NULL);
INSERT INTO `localidades` VALUES(1969, 6, 1, 'CORDOBA', 'VILLA CAEIRO', '5164', NULL, NULL);
INSERT INTO `localidades` VALUES(1970, 6, 1, 'CORDOBA', 'VILLA CARLOS PAZ', '5152', NULL, NULL);
INSERT INTO `localidades` VALUES(1971, 6, 1, 'CORDOBA', 'VILLA CIUDAD DE AMERICA', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1972, 6, 1, 'CORDOBA', 'VILLA CIUDAD PARQUE LOS REARTES', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1973, 6, 1, 'CORDOBA', 'VILLA COLIMBA', '5200', NULL, NULL);
INSERT INTO `localidades` VALUES(1974, 6, 1, 'CORDOBA', 'VILLA CONCEPCION DEL TIO', '2433', NULL, NULL);
INSERT INTO `localidades` VALUES(1975, 6, 1, 'CORDOBA', 'VILLA CURA BROCHERO', '5891', NULL, NULL);
INSERT INTO `localidades` VALUES(1976, 6, 1, 'CORDOBA', 'VILLA DE MARIA', '5248', NULL, NULL);
INSERT INTO `localidades` VALUES(1977, 6, 1, 'CORDOBA', 'VILLA DE SOTO', '5284', NULL, NULL);
INSERT INTO `localidades` VALUES(1978, 6, 1, 'CORDOBA', 'VILLA DEL DIQUE', '5862', NULL, NULL);
INSERT INTO `localidades` VALUES(1979, 6, 1, 'CORDOBA', 'VILLA DEL PRADO', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1980, 6, 1, 'CORDOBA', 'VILLA DEL ROSARIO', '5963', NULL, NULL);
INSERT INTO `localidades` VALUES(1981, 6, 1, 'CORDOBA', 'VILLA DEL TOTORAL', '5236', NULL, NULL);
INSERT INTO `localidades` VALUES(1982, 6, 1, 'CORDOBA', 'VILLA DOLORES', '5870', NULL, NULL);
INSERT INTO `localidades` VALUES(1983, 6, 1, 'CORDOBA', 'VILLA ESQUIU', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(1984, 6, 1, 'CORDOBA', 'VILLA FONTANA (CBA)', '5137', NULL, NULL);
INSERT INTO `localidades` VALUES(1985, 6, 1, 'CORDOBA', 'VILLA GARCIA', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1986, 6, 1, 'CORDOBA', 'VILLA GIARDINO', '5176', NULL, NULL);
INSERT INTO `localidades` VALUES(1987, 6, 1, 'CORDOBA', 'VILLA GRAL. BELGRANO', '5194', NULL, NULL);
INSERT INTO `localidades` VALUES(1988, 6, 1, 'CORDOBA', 'VILLA GUTIERREZ', '5212', NULL, NULL);
INSERT INTO `localidades` VALUES(1989, 6, 1, 'CORDOBA', 'VILLA HUIDOBRO', '6275', NULL, NULL);
INSERT INTO `localidades` VALUES(1990, 6, 1, 'CORDOBA', 'VILLA LA MERCED', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1991, 6, 1, 'CORDOBA', 'VILLA LAS ROSAS', '5885', NULL, NULL);
INSERT INTO `localidades` VALUES(1992, 6, 1, 'CORDOBA', 'VILLA LOS AROMOS', '5186', NULL, NULL);
INSERT INTO `localidades` VALUES(1993, 6, 1, 'CORDOBA', 'VILLA LOS LEONES', '5281', NULL, NULL);
INSERT INTO `localidades` VALUES(1994, 6, 1, 'CORDOBA', 'VILLA LOS LLANOS', '5111', NULL, NULL);
INSERT INTO `localidades` VALUES(1995, 6, 1, 'CORDOBA', 'VILLA MARIA', '5900', NULL, NULL);
INSERT INTO `localidades` VALUES(1996, 6, 1, 'CORDOBA', 'VILLA MONTENEGRO', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(1997, 6, 1, 'CORDOBA', 'VILLA MUÑOZ', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(1998, 6, 1, 'CORDOBA', 'VILLA NUEVA (CBA)', '5903', NULL, NULL);
INSERT INTO `localidades` VALUES(1999, 6, 1, 'CORDOBA', 'VILLA PQUE SANTA ANA (DTO STA MARIA', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(2000, 6, 1, 'CORDOBA', 'VILLA QUILINO', '5214', NULL, NULL);
INSERT INTO `localidades` VALUES(2001, 6, 1, 'CORDOBA', 'VILLA QUILLINZO', '5859', NULL, NULL);
INSERT INTO `localidades` VALUES(2002, 6, 1, 'CORDOBA', 'VILLA RETIRO', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(2003, 6, 1, 'CORDOBA', 'VILLA RIVERA INDARTE', '5147', NULL, NULL);
INSERT INTO `localidades` VALUES(2004, 6, 1, 'CORDOBA', 'VILLA ROSSI', '6128', NULL, NULL);
INSERT INTO `localidades` VALUES(2005, 6, 1, 'CORDOBA', 'VILLA RUMIPAL', '5864', NULL, NULL);
INSERT INTO `localidades` VALUES(2006, 6, 1, 'CORDOBA', 'VILLA SAN MIGUEL', '5111', NULL, NULL);
INSERT INTO `localidades` VALUES(2007, 6, 1, 'CORDOBA', 'VILLA SARMIENTO', '6273', NULL, NULL);
INSERT INTO `localidades` VALUES(2008, 6, 1, 'CORDOBA', 'VILLA SATYTA', '5189', NULL, NULL);
INSERT INTO `localidades` VALUES(2009, 6, 1, 'CORDOBA', 'VILLA SILVINA', '5111', NULL, NULL);
INSERT INTO `localidades` VALUES(2010, 6, 1, 'CORDOBA', 'VILLA TANINGA', '5295', NULL, NULL);
INSERT INTO `localidades` VALUES(2011, 6, 1, 'CORDOBA', 'VILLA VALERIA', '6273', NULL, NULL);
INSERT INTO `localidades` VALUES(2012, 6, 1, 'CORDOBA', 'VILLA YACANTO', '5197', NULL, NULL);
INSERT INTO `localidades` VALUES(2013, 6, 1, 'CORDOBA', 'VILLA. SANTA CRUZ DEL LAGO', '5153', NULL, NULL);
INSERT INTO `localidades` VALUES(2014, 6, 1, 'CORDOBA', 'VIVERO (CBA)', '6106', NULL, NULL);
INSERT INTO `localidades` VALUES(2015, 6, 1, 'CORDOBA', 'WENCESLAO ESCALANTE', '2655', NULL, NULL);
INSERT INTO `localidades` VALUES(2016, 6, 1, 'CORDOBA', 'YOCSINA', '5101', NULL, NULL);
INSERT INTO `localidades` VALUES(2017, 7, 1, 'CORRIENTES', 'ALMAFUERTE', '3317', NULL, NULL);
INSERT INTO `localidades` VALUES(2018, 7, 1, 'CORRIENTES', 'ALMAFUERTE', '3317', NULL, NULL);
INSERT INTO `localidades` VALUES(2019, 7, 1, 'CORRIENTES', 'ALVEAR (CORRIENTES)', '3344', NULL, NULL);
INSERT INTO `localidades` VALUES(2020, 7, 1, 'CORRIENTES', 'BELLA VISTA (CORRIEN', '3432', NULL, NULL);
INSERT INTO `localidades` VALUES(2021, 7, 1, 'CORRIENTES', 'BONPLAND', '3234', NULL, NULL);
INSERT INTO `localidades` VALUES(2022, 7, 1, 'CORRIENTES', 'BONPLAND', '3317', NULL, NULL);
INSERT INTO `localidades` VALUES(2023, 7, 1, 'CORRIENTES', 'BONPLAND', '3317', NULL, NULL);
INSERT INTO `localidades` VALUES(2024, 7, 1, 'CORRIENTES', 'CAMPO FERNANDEZ', '3427', NULL, NULL);
INSERT INTO `localidades` VALUES(2025, 7, 1, 'CORRIENTES', 'CHAVARRIA', '3474', NULL, NULL);
INSERT INTO `localidades` VALUES(2026, 7, 1, 'CORRIENTES', 'COLONIA LIEVING', '3358', NULL, NULL);
INSERT INTO `localidades` VALUES(2027, 7, 1, 'CORRIENTES', 'CORRIENTES', '3400', NULL, NULL);
INSERT INTO `localidades` VALUES(2028, 7, 1, 'CORRIENTES', 'CURUZU CUATIA', '3460', NULL, NULL);
INSERT INTO `localidades` VALUES(2029, 7, 1, 'CORRIENTES', 'EMPEDRADO', '3418', NULL, NULL);
INSERT INTO `localidades` VALUES(2030, 7, 1, 'CORRIENTES', 'ENSENADA GRANDE', '3412', NULL, NULL);
INSERT INTO `localidades` VALUES(2031, 7, 1, 'CORRIENTES', 'ENSENADITA', '3412', NULL, NULL);
INSERT INTO `localidades` VALUES(2032, 7, 1, 'CORRIENTES', 'ESQUINA', '3196', NULL, NULL);
INSERT INTO `localidades` VALUES(2033, 7, 1, 'CORRIENTES', 'FELIPE YOFRE', '3472', NULL, NULL);
INSERT INTO `localidades` VALUES(2034, 7, 1, 'CORRIENTES', 'GARRUCHOS', '3351', NULL, NULL);
INSERT INTO `localidades` VALUES(2035, 7, 1, 'CORRIENTES', 'GOBERNADOR VIRASORO', '3342', NULL, NULL);
INSERT INTO `localidades` VALUES(2036, 7, 1, 'CORRIENTES', 'GOYA', '3450', NULL, NULL);
INSERT INTO `localidades` VALUES(2037, 7, 1, 'CORRIENTES', 'ITA IBATE', '3480', NULL, NULL);
INSERT INTO `localidades` VALUES(2038, 7, 1, 'CORRIENTES', 'ITATI', '3414', NULL, NULL);
INSERT INTO `localidades` VALUES(2039, 7, 1, 'CORRIENTES', 'ITUZAINGO CTS', '3302', NULL, NULL);
INSERT INTO `localidades` VALUES(2040, 7, 1, 'CORRIENTES', 'JUAN PUJOL', '3222', NULL, NULL);
INSERT INTO `localidades` VALUES(2041, 7, 1, 'CORRIENTES', 'LA CRUZ CORRIENTES', '3346', NULL, NULL);
INSERT INTO `localidades` VALUES(2042, 7, 1, 'CORRIENTES', 'LA PASTORIL', '3440', NULL, NULL);
INSERT INTO `localidades` VALUES(2043, 7, 1, 'CORRIENTES', 'LA PORTEÑA', '3463', NULL, NULL);
INSERT INTO `localidades` VALUES(2044, 7, 1, 'CORRIENTES', 'LAVALLE (CORRIENTES)', '3443', NULL, NULL);
INSERT INTO `localidades` VALUES(2045, 7, 1, 'CORRIENTES', 'MANUEL DERQUI', '3416', NULL, NULL);
INSERT INTO `localidades` VALUES(2046, 7, 1, 'CORRIENTES', 'MARIANO LOZA', '3476', NULL, NULL);
INSERT INTO `localidades` VALUES(2047, 7, 1, 'CORRIENTES', 'MERCEDES (CTS)', '3470', NULL, NULL);
INSERT INTO `localidades` VALUES(2048, 7, 1, 'CORRIENTES', 'MOCORETA', '3228', NULL, NULL);
INSERT INTO `localidades` VALUES(2049, 7, 1, 'CORRIENTES', 'MONTE CASEROS (CTS)', '3220', NULL, NULL);
INSERT INTO `localidades` VALUES(2050, 7, 1, 'CORRIENTES', 'PASO DE LA PATRIA', '3409', NULL, NULL);
INSERT INTO `localidades` VALUES(2051, 7, 1, 'CORRIENTES', 'PASO DE LOS LIBRES', '3230', NULL, NULL);
INSERT INTO `localidades` VALUES(2052, 7, 1, 'CORRIENTES', 'PERUGORRIA', '3461', NULL, NULL);
INSERT INTO `localidades` VALUES(2053, 7, 1, 'CORRIENTES', 'RIACHUELO', '3416', NULL, NULL);
INSERT INTO `localidades` VALUES(2054, 7, 1, 'CORRIENTES', 'SALADAS', '3420', NULL, NULL);
INSERT INTO `localidades` VALUES(2055, 7, 1, 'CORRIENTES', 'SAN CARLOS (CTS)', '3306', NULL, NULL);
INSERT INTO `localidades` VALUES(2056, 7, 1, 'CORRIENTES', 'SAN COSME', '3412', NULL, NULL);
INSERT INTO `localidades` VALUES(2057, 7, 1, 'CORRIENTES', 'SAN LORENZO (CORRIEN', '3416', NULL, NULL);
INSERT INTO `localidades` VALUES(2058, 7, 1, 'CORRIENTES', 'SAN LUIS DEL PALMAR', '3403', NULL, NULL);
INSERT INTO `localidades` VALUES(2059, 7, 1, 'CORRIENTES', 'SAN ROQUE', '3448', NULL, NULL);
INSERT INTO `localidades` VALUES(2060, 7, 1, 'CORRIENTES', 'SANTA LUCIA (CORR)', '3440', NULL, NULL);
INSERT INTO `localidades` VALUES(2061, 7, 1, 'CORRIENTES', 'SANTA ROSA (CORR)', '3466', NULL, NULL);
INSERT INTO `localidades` VALUES(2062, 7, 1, 'CORRIENTES', 'SANTO TOME (CTS)', '3340', NULL, NULL);
INSERT INTO `localidades` VALUES(2063, 7, 1, 'CORRIENTES', 'SAUCE', '3463', NULL, NULL);
INSERT INTO `localidades` VALUES(2064, 7, 1, 'CORRIENTES', 'TABAY', '3421', NULL, NULL);
INSERT INTO `localidades` VALUES(2065, 7, 1, 'CORRIENTES', 'TATACUA', '3421', NULL, NULL);
INSERT INTO `localidades` VALUES(2066, 7, 1, 'CORRIENTES', 'VILLA OLIVARI', '3486', NULL, NULL);
INSERT INTO `localidades` VALUES(2067, 8, 1, 'ENTRE RIOS', 'LA NOBLEZA', '3212', NULL, NULL);
INSERT INTO `localidades` VALUES(2068, 8, 1, 'ENTRE RIOS', 'LA PRIMAVERA', '3272', NULL, NULL);
INSERT INTO `localidades` VALUES(2069, 8, 1, 'ENTRE RÍOS', '1° DE MAYO', '3263', NULL, NULL);
INSERT INTO `localidades` VALUES(2070, 8, 1, 'ENTRE RÍOS', '20 DE SETIEMBRE', '3158', NULL, NULL);
INSERT INTO `localidades` VALUES(2071, 8, 1, 'ENTRE RÍOS', 'ALCARAZ', '3138', NULL, NULL);
INSERT INTO `localidades` VALUES(2072, 8, 1, 'ENTRE RÍOS', 'ALCARAZ 2§', '3138', NULL, NULL);
INSERT INTO `localidades` VALUES(2073, 8, 1, 'ENTRE RÍOS', 'ALDEA BRASILERA', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2074, 8, 1, 'ENTRE RÍOS', 'ALDEA MARIA LUISA', '3114', NULL, NULL);
INSERT INTO `localidades` VALUES(2075, 8, 1, 'ENTRE RÍOS', 'ALDEA PROTESTANTE', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2076, 8, 1, 'ENTRE RÍOS', 'ALDEA SAN ANTONIO', '2826', NULL, NULL);
INSERT INTO `localidades` VALUES(2077, 8, 1, 'ENTRE RÍOS', 'ALDEA SAN JUAN', '2826', NULL, NULL);
INSERT INTO `localidades` VALUES(2078, 8, 1, 'ENTRE RÍOS', 'ALDEA SAN RAFAEL', '3116', NULL, NULL);
INSERT INTO `localidades` VALUES(2079, 8, 1, 'ENTRE RÍOS', 'ALDEA SANTA CELIA', '2826', NULL, NULL);
INSERT INTO `localidades` VALUES(2080, 8, 1, 'ENTRE RÍOS', 'ALDEA SANTA MARIA', '3123', NULL, NULL);
INSERT INTO `localidades` VALUES(2081, 8, 1, 'ENTRE RÍOS', 'ALMADA', '2824', NULL, NULL);
INSERT INTO `localidades` VALUES(2082, 8, 1, 'ENTRE RÍOS', 'ALTAMIRANO', '3177', NULL, NULL);
INSERT INTO `localidades` VALUES(2083, 8, 1, 'ENTRE RÍOS', 'ALTAMIRANO SUD', '3174', NULL, NULL);
INSERT INTO `localidades` VALUES(2084, 8, 1, 'ENTRE RÍOS', 'ANTELO', '3151', NULL, NULL);
INSERT INTO `localidades` VALUES(2085, 8, 1, 'ENTRE RÍOS', 'ARANGUREN', '3162', NULL, NULL);
INSERT INTO `localidades` VALUES(2086, 8, 1, 'ENTRE RÍOS', 'ARROYO BARU', '3269', NULL, NULL);
INSERT INTO `localidades` VALUES(2087, 8, 1, 'ENTRE RÍOS', 'AYUI', '3204', NULL, NULL);
INSERT INTO `localidades` VALUES(2088, 8, 1, 'ENTRE RÍOS', 'BAJADA GRANDE', '3100', NULL, NULL);
INSERT INTO `localidades` VALUES(2089, 8, 1, 'ENTRE RÍOS', 'BASAVILBASO', '3170', NULL, NULL);
INSERT INTO `localidades` VALUES(2090, 8, 1, 'ENTRE RÍOS', 'BELGRANO', '3228', NULL, NULL);
INSERT INTO `localidades` VALUES(2091, 8, 1, 'ENTRE RÍOS', 'BENITO LEGEREN', '3203', NULL, NULL);
INSERT INTO `localidades` VALUES(2092, 8, 1, 'ENTRE RÍOS', 'BETBEDER', '3156', NULL, NULL);
INSERT INTO `localidades` VALUES(2093, 8, 1, 'ENTRE RÍOS', 'BOVRIL', '3142', NULL, NULL);
INSERT INTO `localidades` VALUES(2094, 8, 1, 'ENTRE RÍOS', 'CAMPS', '3164', NULL, NULL);
INSERT INTO `localidades` VALUES(2095, 8, 1, 'ENTRE RÍOS', 'CARABAJILLA', '3203', NULL, NULL);
INSERT INTO `localidades` VALUES(2096, 8, 1, 'ENTRE RÍOS', 'CASEROS (E.RIOS)', '3262', NULL, NULL);
INSERT INTO `localidades` VALUES(2097, 8, 1, 'ENTRE RÍOS', 'CEIBAS', '2823', NULL, NULL);
INSERT INTO `localidades` VALUES(2098, 8, 1, 'ENTRE RÍOS', 'CERRITO', '3122', NULL, NULL);
INSERT INTO `localidades` VALUES(2099, 8, 1, 'ENTRE RÍOS', 'CHAJARI', '3228', NULL, NULL);
INSERT INTO `localidades` VALUES(2100, 8, 1, 'ENTRE RÍOS', 'CNIA. NVA.MONTEVIDEO', '2828', NULL, NULL);
INSERT INTO `localidades` VALUES(2101, 8, 1, 'ENTRE RÍOS', 'COLON (E.RIOS)', '3280', NULL, NULL);
INSERT INTO `localidades` VALUES(2102, 8, 1, 'ENTRE RÍOS', 'COLONIA ADELA', '3201', NULL, NULL);
INSERT INTO `localidades` VALUES(2103, 8, 1, 'ENTRE RÍOS', 'COLONIA ALEMANA', '3228', NULL, NULL);
INSERT INTO `localidades` VALUES(2104, 8, 1, 'ENTRE RÍOS', 'COLONIA ALVEAR', '3105', NULL, NULL);
INSERT INTO `localidades` VALUES(2105, 8, 1, 'ENTRE RÍOS', 'COLONIA ARGENTINA', '3118', NULL, NULL);
INSERT INTO `localidades` VALUES(2106, 8, 1, 'ENTRE RÍOS', 'COLONIA AVELLANEDA', '3107', NULL, NULL);
INSERT INTO `localidades` VALUES(2107, 8, 1, 'ENTRE RÍOS', 'COLONIA AVIGOR', '3142', NULL, NULL);
INSERT INTO `localidades` VALUES(2108, 8, 1, 'ENTRE RÍOS', 'COLONIA CARRASCO', '3142', NULL, NULL);
INSERT INTO `localidades` VALUES(2109, 8, 1, 'ENTRE RÍOS', 'COLONIA CRESPO', '3118', NULL, NULL);
INSERT INTO `localidades` VALUES(2110, 8, 1, 'ENTRE RÍOS', 'COLONIA EL SAUCE', '3261', NULL, NULL);
INSERT INTO `localidades` VALUES(2111, 8, 1, 'ENTRE RÍOS', 'COLONIA ELIA', '3261', NULL, NULL);
INSERT INTO `localidades` VALUES(2112, 8, 1, 'ENTRE RÍOS', 'COLONIA ENSAYO', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2113, 8, 1, 'ENTRE RÍOS', 'COLONIA FLORES', '3200', NULL, NULL);
INSERT INTO `localidades` VALUES(2114, 8, 1, 'ENTRE RÍOS', 'COLONIA GRAPSCHENTAL', '3114', NULL, NULL);
INSERT INTO `localidades` VALUES(2115, 8, 1, 'ENTRE RÍOS', 'COLONIA LA GLORIA', '3204', NULL, NULL);
INSERT INTO `localidades` VALUES(2116, 8, 1, 'ENTRE RÍOS', 'COLONIA LA PAZ', '3206', NULL, NULL);
INSERT INTO `localidades` VALUES(2117, 8, 1, 'ENTRE RÍOS', 'COLONIA NUEVA', '3118', NULL, NULL);
INSERT INTO `localidades` VALUES(2118, 8, 1, 'ENTRE RÍOS', 'COLONIA RIVADAVIA', '3023', NULL, NULL);
INSERT INTO `localidades` VALUES(2119, 8, 1, 'ENTRE RÍOS', 'COLONIA YERUA', '3201', NULL, NULL);
INSERT INTO `localidades` VALUES(2120, 8, 1, 'ENTRE RÍOS', 'CONCEP. DEL URUGUAY', '3260', NULL, NULL);
INSERT INTO `localidades` VALUES(2121, 8, 1, 'ENTRE RÍOS', 'CONCORDIA', '3200', NULL, NULL);
INSERT INTO `localidades` VALUES(2122, 8, 1, 'ENTRE RÍOS', 'CONSCRIPTO BERNARDI', '3188', NULL, NULL);
INSERT INTO `localidades` VALUES(2123, 8, 1, 'ENTRE RÍOS', 'COSTA GRANDE', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2124, 8, 1, 'ENTRE RÍOS', 'COSTA GRANDE DOLL', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2125, 8, 1, 'ENTRE RÍOS', 'COSTAS DE SAN ANTONI', '2826', NULL, NULL);
INSERT INTO `localidades` VALUES(2126, 8, 1, 'ENTRE RÍOS', 'CRESPO', '3116', NULL, NULL);
INSERT INTO `localidades` VALUES(2127, 8, 1, 'ENTRE RÍOS', 'CRUCESITAS 3A. SECC.', '3151', NULL, NULL);
INSERT INTO `localidades` VALUES(2128, 8, 1, 'ENTRE RÍOS', 'CUCHILLA', '2840', NULL, NULL);
INSERT INTO `localidades` VALUES(2129, 8, 1, 'ENTRE RÍOS', 'CURTIEMBRE', '3113', NULL, NULL);
INSERT INTO `localidades` VALUES(2130, 8, 1, 'ENTRE RÍOS', 'DIAMANTE', '3105', NULL, NULL);
INSERT INTO `localidades` VALUES(2131, 8, 1, 'ENTRE RÍOS', 'DOMINGUEZ', '3246', NULL, NULL);
INSERT INTO `localidades` VALUES(2132, 8, 1, 'ENTRE RÍOS', 'DON CRISTOBAL 2§', '3162', NULL, NULL);
INSERT INTO `localidades` VALUES(2133, 8, 1, 'ENTRE RÍOS', 'DURAZNO', '3177', NULL, NULL);
INSERT INTO `localidades` VALUES(2134, 8, 1, 'ENTRE RÍOS', 'EIGENFELD', '3116', NULL, NULL);
INSERT INTO `localidades` VALUES(2135, 8, 1, 'ENTRE RÍOS', 'EJIDO DIAMANTE', '3105', NULL, NULL);
INSERT INTO `localidades` VALUES(2136, 8, 1, 'ENTRE RÍOS', 'EL BRILLANTE', '3283', NULL, NULL);
INSERT INTO `localidades` VALUES(2137, 8, 1, 'ENTRE RÍOS', 'EL CIMARRON', '3188', NULL, NULL);
INSERT INTO `localidades` VALUES(2138, 8, 1, 'ENTRE RÍOS', 'EL COLORADO E.RIOS', '3192', NULL, NULL);
INSERT INTO `localidades` VALUES(2139, 8, 1, 'ENTRE RÍOS', 'EL GUALEGUAY', '3212', NULL, NULL);
INSERT INTO `localidades` VALUES(2140, 8, 1, 'ENTRE RÍOS', 'EL NUEVO RINCON', '2824', NULL, NULL);
INSERT INTO `localidades` VALUES(2141, 8, 1, 'ENTRE RÍOS', 'EL PALENQUE (E.RIOS)', '3118', NULL, NULL);
INSERT INTO `localidades` VALUES(2142, 8, 1, 'ENTRE RÍOS', 'EL PINGO', '3132', NULL, NULL);
INSERT INTO `localidades` VALUES(2143, 8, 1, 'ENTRE RÍOS', 'EL QUEBRACHO', '3192', NULL, NULL);
INSERT INTO `localidades` VALUES(2144, 8, 1, 'ENTRE RÍOS', 'EL REDOMON', '3212', NULL, NULL);
INSERT INTO `localidades` VALUES(2145, 8, 1, 'ENTRE RÍOS', 'EL SOLAR', '3137', NULL, NULL);
INSERT INTO `localidades` VALUES(2146, 8, 1, 'ENTRE RÍOS', 'EMBARCADERO FERRARI', '3201', NULL, NULL);
INSERT INTO `localidades` VALUES(2147, 8, 1, 'ENTRE RÍOS', 'ENRIQUE CARBO', '2852', NULL, NULL);
INSERT INTO `localidades` VALUES(2148, 8, 1, 'ENTRE RÍOS', 'ESCRI¥A', '2828', NULL, NULL);
INSERT INTO `localidades` VALUES(2149, 8, 1, 'ENTRE RÍOS', 'ESTACION YERUA', '3214', NULL, NULL);
INSERT INTO `localidades` VALUES(2150, 8, 1, 'ENTRE RÍOS', 'ETCHEVHERE', '3114', NULL, NULL);
INSERT INTO `localidades` VALUES(2151, 8, 1, 'ENTRE RÍOS', 'FAUSTINO M.PARERA', '2824', NULL, NULL);
INSERT INTO `localidades` VALUES(2152, 8, 1, 'ENTRE RÍOS', 'FEDERACION', '3206', NULL, NULL);
INSERT INTO `localidades` VALUES(2153, 8, 1, 'ENTRE RÍOS', 'FEDERAL', '3180', NULL, NULL);
INSERT INTO `localidades` VALUES(2154, 8, 1, 'ENTRE RÍOS', 'FEVRE', '3151', NULL, NULL);
INSERT INTO `localidades` VALUES(2155, 8, 1, 'ENTRE RÍOS', 'GALARZA', '2843', NULL, NULL);
INSERT INTO `localidades` VALUES(2156, 8, 1, 'ENTRE RÍOS', 'GENERAL ALMADA', '2824', NULL, NULL);
INSERT INTO `localidades` VALUES(2157, 8, 1, 'ENTRE RÍOS', 'GENERAL CAMPOS', '3216', NULL, NULL);
INSERT INTO `localidades` VALUES(2158, 8, 1, 'ENTRE RÍOS', 'GILBERT', '2828', NULL, NULL);
INSERT INTO `localidades` VALUES(2159, 8, 1, 'ENTRE RÍOS', 'GOBERNADOR ECHAGšE', '2845', NULL, NULL);
INSERT INTO `localidades` VALUES(2160, 8, 1, 'ENTRE RÍOS', 'GOBERNADOR MANSILLA', '2845', NULL, NULL);
INSERT INTO `localidades` VALUES(2161, 8, 1, 'ENTRE RÍOS', 'GOBERNADOR SOLA', '3176', NULL, NULL);
INSERT INTO `localidades` VALUES(2162, 8, 1, 'ENTRE RÍOS', 'GUALEGUAY', '2840', NULL, NULL);
INSERT INTO `localidades` VALUES(2163, 8, 1, 'ENTRE RÍOS', 'GUALEGUAYCHU', '2820', NULL, NULL);
INSERT INTO `localidades` VALUES(2164, 8, 1, 'ENTRE RÍOS', 'GUARDAMONTE', '3177', NULL, NULL);
INSERT INTO `localidades` VALUES(2165, 8, 1, 'ENTRE RÍOS', 'HASENKAMP', '3134', NULL, NULL);
INSERT INTO `localidades` VALUES(2166, 8, 1, 'ENTRE RÍOS', 'HERNANDARIAS', '3127', NULL, NULL);
INSERT INTO `localidades` VALUES(2167, 8, 1, 'ENTRE RÍOS', 'HERNANDEZ', '3156', NULL, NULL);
INSERT INTO `localidades` VALUES(2168, 8, 1, 'ENTRE RÍOS', 'HERRERA (E.RIOS)', '3272', NULL, NULL);
INSERT INTO `localidades` VALUES(2169, 8, 1, 'ENTRE RÍOS', 'HOLT', '2846', NULL, NULL);
INSERT INTO `localidades` VALUES(2170, 8, 1, 'ENTRE RÍOS', 'HUMAITA', '3206', NULL, NULL);
INSERT INTO `localidades` VALUES(2171, 8, 1, 'ENTRE RÍOS', 'IBICUY', '2846', NULL, NULL);
INSERT INTO `localidades` VALUES(2172, 8, 1, 'ENTRE RÍOS', 'ING.MIGUEL SAJAROFF', '3246', NULL, NULL);
INSERT INTO `localidades` VALUES(2173, 8, 1, 'ENTRE RÍOS', 'IRAZUSTA', '2852', NULL, NULL);
INSERT INTO `localidades` VALUES(2174, 8, 1, 'ENTRE RÍOS', 'ISTHILAR', '3204', NULL, NULL);
INSERT INTO `localidades` VALUES(2175, 8, 1, 'ENTRE RÍOS', 'JUBILEO', '3254', NULL, NULL);
INSERT INTO `localidades` VALUES(2176, 8, 1, 'ENTRE RÍOS', 'LA CAPILLA', '3246', NULL, NULL);
INSERT INTO `localidades` VALUES(2177, 8, 1, 'ENTRE RÍOS', 'LA CLARITA', '3269', NULL, NULL);
INSERT INTO `localidades` VALUES(2178, 8, 1, 'ENTRE RÍOS', 'LA CRIOLLA E.RIOS', '3212', NULL, NULL);
INSERT INTO `localidades` VALUES(2179, 8, 1, 'ENTRE RÍOS', 'LA PAZ (E.RIOS)', '3190', NULL, NULL);
INSERT INTO `localidades` VALUES(2180, 8, 1, 'ENTRE RÍOS', 'LA PICADA', '3118', NULL, NULL);
INSERT INTO `localidades` VALUES(2181, 8, 1, 'ENTRE RÍOS', 'LA QUERENCIA', '3212', NULL, NULL);
INSERT INTO `localidades` VALUES(2182, 8, 1, 'ENTRE RÍOS', 'LARROQUE', '2854', NULL, NULL);
INSERT INTO `localidades` VALUES(2183, 8, 1, 'ENTRE RÍOS', 'LAS CUEVAS (E.RIOS)', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2184, 8, 1, 'ENTRE RÍOS', 'LAS MOSCAS', '3244', NULL, NULL);
INSERT INTO `localidades` VALUES(2185, 8, 1, 'ENTRE RÍOS', 'LAS TUNAS (E.RIOS)', '3111', NULL, NULL);
INSERT INTO `localidades` VALUES(2186, 8, 1, 'ENTRE RÍOS', 'LAZO', '2841', NULL, NULL);
INSERT INTO `localidades` VALUES(2187, 8, 1, 'ENTRE RÍOS', 'LIBAROS', '3244', NULL, NULL);
INSERT INTO `localidades` VALUES(2188, 8, 1, 'ENTRE RÍOS', 'LIEBIG', '3281', NULL, NULL);
INSERT INTO `localidades` VALUES(2189, 8, 1, 'ENTRE RÍOS', 'LOS CHURRUAS', '3212', NULL, NULL);
INSERT INTO `localidades` VALUES(2190, 8, 1, 'ENTRE RÍOS', 'LOS CONQUISTADORES', '3183', NULL, NULL);
INSERT INTO `localidades` VALUES(2191, 8, 1, 'ENTRE RÍOS', 'LUCAS GONZALEZ', '3158', NULL, NULL);
INSERT INTO `localidades` VALUES(2192, 8, 1, 'ENTRE RÍOS', 'LUCAS NORTE', '3241', NULL, NULL);
INSERT INTO `localidades` VALUES(2193, 8, 1, 'ENTRE RÍOS', 'LUCAS SUD', '3241', NULL, NULL);
INSERT INTO `localidades` VALUES(2194, 8, 1, 'ENTRE RÍOS', 'MACIA', '3177', NULL, NULL);
INSERT INTO `localidades` VALUES(2195, 8, 1, 'ENTRE RÍOS', 'MAGNASCO', '3212', NULL, NULL);
INSERT INTO `localidades` VALUES(2196, 8, 1, 'ENTRE RÍOS', 'MANDISOVI', '3228', NULL, NULL);
INSERT INTO `localidades` VALUES(2197, 8, 1, 'ENTRE RÍOS', 'MARIA ELINA', '3208', NULL, NULL);
INSERT INTO `localidades` VALUES(2198, 8, 1, 'ENTRE RÍOS', 'MARIA GRANDE', '3133', NULL, NULL);
INSERT INTO `localidades` VALUES(2199, 8, 1, 'ENTRE RÍOS', 'MARIA GRANDE 2º', '3133', NULL, NULL);
INSERT INTO `localidades` VALUES(2200, 8, 1, 'ENTRE RÍOS', 'MOJONES', '3241', NULL, NULL);
INSERT INTO `localidades` VALUES(2201, 8, 1, 'ENTRE RÍOS', 'MOLINO DOLL', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2202, 8, 1, 'ENTRE RÍOS', 'NOGOYA', '3150', NULL, NULL);
INSERT INTO `localidades` VALUES(2203, 8, 1, 'ENTRE RÍOS', 'NUEVA ESCOCIA', '3201', NULL, NULL);
INSERT INTO `localidades` VALUES(2204, 8, 1, 'ENTRE RÍOS', 'ORO VERDE', '3100', NULL, NULL);
INSERT INTO `localidades` VALUES(2205, 8, 1, 'ENTRE RÍOS', 'PAJONAL (E.RIOS)', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2206, 8, 1, 'ENTRE RÍOS', 'PALAVECINO', '2820', NULL, NULL);
INSERT INTO `localidades` VALUES(2207, 8, 1, 'ENTRE RÍOS', 'PARANA', '3100', NULL, NULL);
INSERT INTO `localidades` VALUES(2208, 8, 1, 'ENTRE RÍOS', 'PASO LAGUNA', '3241', NULL, NULL);
INSERT INTO `localidades` VALUES(2209, 8, 1, 'ENTRE RÍOS', 'PASO POTRILLO', '3127', NULL, NULL);
INSERT INTO `localidades` VALUES(2210, 8, 1, 'ENTRE RÍOS', 'PASTOR BRITOS', '2826', NULL, NULL);
INSERT INTO `localidades` VALUES(2211, 8, 1, 'ENTRE RÍOS', 'PEDERNAL E.R.', '3203', NULL, NULL);
INSERT INTO `localidades` VALUES(2212, 8, 1, 'ENTRE RÍOS', 'PEHUAJO SUD', '2854', NULL, NULL);
INSERT INTO `localidades` VALUES(2213, 8, 1, 'ENTRE RÍOS', 'PERDICES', '2823', NULL, NULL);
INSERT INTO `localidades` VALUES(2214, 8, 1, 'ENTRE RÍOS', 'PIEDRAS BLANCAS', '3129', NULL, NULL);
INSERT INTO `localidades` VALUES(2215, 8, 1, 'ENTRE RÍOS', 'PILOTO AVILA', '3190', NULL, NULL);
INSERT INTO `localidades` VALUES(2216, 8, 1, 'ENTRE RÍOS', 'PI¥EYRO', '3240', NULL, NULL);
INSERT INTO `localidades` VALUES(2217, 8, 1, 'ENTRE RÍOS', 'PRONUNCIAMIENTO', '3263', NULL, NULL);
INSERT INTO `localidades` VALUES(2218, 8, 1, 'ENTRE RÍOS', 'PUEBLITO', '3155', NULL, NULL);
INSERT INTO `localidades` VALUES(2219, 8, 1, 'ENTRE RÍOS', 'PUEBLO ARRUA', '3138', NULL, NULL);
INSERT INTO `localidades` VALUES(2220, 8, 1, 'ENTRE RÍOS', 'PUEBLO BELLOCQ', '3136', NULL, NULL);
INSERT INTO `localidades` VALUES(2221, 8, 1, 'ENTRE RÍOS', 'PUEBLO BRUGO', '3125', NULL, NULL);
INSERT INTO `localidades` VALUES(2222, 8, 1, 'ENTRE RÍOS', 'PUERTO RUIZ', '2840', NULL, NULL);
INSERT INTO `localidades` VALUES(2223, 8, 1, 'ENTRE RÍOS', 'PUERTO YERUA', '3201', NULL, NULL);
INSERT INTO `localidades` VALUES(2224, 8, 1, 'ENTRE RÍOS', 'PUIGARI', '3103', NULL, NULL);
INSERT INTO `localidades` VALUES(2225, 8, 1, 'ENTRE RÍOS', 'RACEDO', '3114', NULL, NULL);
INSERT INTO `localidades` VALUES(2226, 8, 1, 'ENTRE RÍOS', 'RAICES', '3177', NULL, NULL);
INSERT INTO `localidades` VALUES(2227, 8, 1, 'ENTRE RÍOS', 'RAMIREZ', '3164', NULL, NULL);
INSERT INTO `localidades` VALUES(2228, 8, 1, 'ENTRE RÍOS', 'RAMON A. PARERA', '3118', NULL, NULL);
INSERT INTO `localidades` VALUES(2229, 8, 1, 'ENTRE RÍOS', 'RINCON DEL DOLL', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2230, 8, 1, 'ENTRE RÍOS', 'RINCON DEL NOGOYA', '3155', NULL, NULL);
INSERT INTO `localidades` VALUES(2231, 8, 1, 'ENTRE RÍOS', 'ROCAMORA', '3172', NULL, NULL);
INSERT INTO `localidades` VALUES(2232, 8, 1, 'ENTRE RÍOS', 'ROSARIO DEL TALA', '3174', NULL, NULL);
INSERT INTO `localidades` VALUES(2233, 8, 1, 'ENTRE RÍOS', 'SAN ANTONIO (E.RIOS)', '2826', NULL, NULL);
INSERT INTO `localidades` VALUES(2234, 8, 1, 'ENTRE RÍOS', 'SAN BENITO', '3107', NULL, NULL);
INSERT INTO `localidades` VALUES(2235, 8, 1, 'ENTRE RÍOS', 'SAN CIPRIANO', '3263', NULL, NULL);
INSERT INTO `localidades` VALUES(2236, 8, 1, 'ENTRE RÍOS', 'SAN GUSTAVO', '3191', NULL, NULL);
INSERT INTO `localidades` VALUES(2237, 8, 1, 'ENTRE RÍOS', 'SAN JAIME', '3185', NULL, NULL);
INSERT INTO `localidades` VALUES(2238, 8, 1, 'ENTRE RÍOS', 'SAN JOSE (E.RIOS)', '3283', NULL, NULL);
INSERT INTO `localidades` VALUES(2239, 8, 1, 'ENTRE RÍOS', 'SAN JOSE FELICIANO', '3187', NULL, NULL);
INSERT INTO `localidades` VALUES(2240, 8, 1, 'ENTRE RÍOS', 'SAN JUSTO (E.RIOS)', '3261', NULL, NULL);
INSERT INTO `localidades` VALUES(2241, 8, 1, 'ENTRE RÍOS', 'SAN MARCIAL', '3248', NULL, NULL);
INSERT INTO `localidades` VALUES(2242, 8, 1, 'ENTRE RÍOS', 'SAN PEDRO', '3272', NULL, NULL);
INSERT INTO `localidades` VALUES(2243, 8, 1, 'ENTRE RÍOS', 'SAN SALVADOR', '3218', NULL, NULL);
INSERT INTO `localidades` VALUES(2244, 8, 1, 'ENTRE RÍOS', 'SAN VICTOR', '3191', NULL, NULL);
INSERT INTO `localidades` VALUES(2245, 8, 1, 'ENTRE RÍOS', 'SANTA ANA (E.RIOS)', '3208', NULL, NULL);
INSERT INTO `localidades` VALUES(2246, 8, 1, 'ENTRE RÍOS', 'SANTA ANITA', '3248', NULL, NULL);
INSERT INTO `localidades` VALUES(2247, 8, 1, 'ENTRE RÍOS', 'SANTA ELENA (E.RIOS)', '3192', NULL, NULL);
INSERT INTO `localidades` VALUES(2248, 8, 1, 'ENTRE RÍOS', 'SAUCE DE LUNA', '3144', NULL, NULL);
INSERT INTO `localidades` VALUES(2249, 8, 1, 'ENTRE RÍOS', 'SAUCE MONTRULL', '3118', NULL, NULL);
INSERT INTO `localidades` VALUES(2250, 8, 1, 'ENTRE RÍOS', 'SAUCE PINTO', '3107', NULL, NULL);
INSERT INTO `localidades` VALUES(2251, 8, 1, 'ENTRE RÍOS', 'SEGUI', '3117', NULL, NULL);
INSERT INTO `localidades` VALUES(2252, 8, 1, 'ENTRE RÍOS', 'SIR LEONARD', '3142', NULL, NULL);
INSERT INTO `localidades` VALUES(2253, 8, 1, 'ENTRE RÍOS', 'SOSA', '3133', NULL, NULL);
INSERT INTO `localidades` VALUES(2254, 8, 1, 'ENTRE RÍOS', 'SPATZENKUTTER', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2255, 8, 1, 'ENTRE RÍOS', 'STROBEL', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2256, 8, 1, 'ENTRE RÍOS', 'TABOSSI', '3111', NULL, NULL);
INSERT INTO `localidades` VALUES(2257, 8, 1, 'ENTRE RÍOS', 'TEZANOS PINTO', '3114', NULL, NULL);
INSERT INTO `localidades` VALUES(2258, 8, 1, 'ENTRE RÍOS', 'TRES BOCAS', '3155', NULL, NULL);
INSERT INTO `localidades` VALUES(2259, 8, 1, 'ENTRE RÍOS', 'UBAJAY', '3287', NULL, NULL);
INSERT INTO `localidades` VALUES(2260, 8, 1, 'ENTRE RÍOS', 'URANGA (E.RIOS)', '3100', NULL, NULL);
INSERT INTO `localidades` VALUES(2261, 8, 1, 'ENTRE RÍOS', 'URDINARRAIN', '2826', NULL, NULL);
INSERT INTO `localidades` VALUES(2262, 8, 1, 'ENTRE RÍOS', 'URQUIZA (E.RIOS)', '3248', NULL, NULL);
INSERT INTO `localidades` VALUES(2263, 8, 1, 'ENTRE RÍOS', 'VALLE MARIA', '3101', NULL, NULL);
INSERT INTO `localidades` VALUES(2264, 8, 1, 'ENTRE RÍOS', 'VIALE', '3109', NULL, NULL);
INSERT INTO `localidades` VALUES(2265, 8, 1, 'ENTRE RÍOS', 'VICTORIA (E.RIOS)', '3153', NULL, NULL);
INSERT INTO `localidades` VALUES(2266, 8, 1, 'ENTRE RÍOS', 'VILLA CLARA', '3252', NULL, NULL);
INSERT INTO `localidades` VALUES(2267, 8, 1, 'ENTRE RÍOS', 'VILLA DEL ROSARIO ER', '3229', NULL, NULL);
INSERT INTO `localidades` VALUES(2268, 8, 1, 'ENTRE RÍOS', 'VILLA ELISA (E.RIOS)', '3265', NULL, NULL);
INSERT INTO `localidades` VALUES(2269, 8, 1, 'ENTRE RÍOS', 'VILLA FONTANA (E.R.)', '3114', NULL, NULL);
INSERT INTO `localidades` VALUES(2270, 8, 1, 'ENTRE RÍOS', 'VILLA LIBERTADOR', '3103', NULL, NULL);
INSERT INTO `localidades` VALUES(2271, 8, 1, 'ENTRE RÍOS', 'VILLA MANTERO', '3272', NULL, NULL);
INSERT INTO `localidades` VALUES(2272, 8, 1, 'ENTRE RÍOS', 'VILLA PARANACITO', '2823', NULL, NULL);
INSERT INTO `localidades` VALUES(2273, 8, 1, 'ENTRE RÍOS', 'VILLA URQUIZA', '3113', NULL, NULL);
INSERT INTO `localidades` VALUES(2274, 8, 1, 'ENTRE RÍOS', 'VILLA ZORRAQUIN', '3201', NULL, NULL);
INSERT INTO `localidades` VALUES(2275, 8, 1, 'ENTRE RÍOS', 'VILLAGUAY', '3240', NULL, NULL);
INSERT INTO `localidades` VALUES(2276, 8, 1, 'ENTRE RÍOS', 'VIVERO (E.RIOS)', '2846', NULL, NULL);
INSERT INTO `localidades` VALUES(2277, 8, 1, 'ENTRE RÍOS', 'YUQUERI', '3214', NULL, NULL);
INSERT INTO `localidades` VALUES(2278, 9, 1, 'FORMOSA', 'CLORINDA', '3610', NULL, NULL);
INSERT INTO `localidades` VALUES(2279, 9, 1, 'FORMOSA', 'COMAND. FONTANA (CHA', '3620', NULL, NULL);
INSERT INTO `localidades` VALUES(2280, 9, 1, 'FORMOSA', 'EL COLORADO FORMOSA', '3603', NULL, NULL);
INSERT INTO `localidades` VALUES(2281, 9, 1, 'FORMOSA', 'EL ESPINILLO', '3615', NULL, NULL);
INSERT INTO `localidades` VALUES(2282, 9, 1, 'FORMOSA', 'ESTANISLAO DEL CAMPO', '3626', NULL, NULL);
INSERT INTO `localidades` VALUES(2283, 9, 1, 'FORMOSA', 'FORMOSA', '3600', NULL, NULL);
INSERT INTO `localidades` VALUES(2284, 9, 1, 'FORMOSA', 'GRAL. BELGRANO', '3615', NULL, NULL);
INSERT INTO `localidades` VALUES(2285, 9, 1, 'FORMOSA', 'GRAN GUARDIA', '3604', NULL, NULL);
INSERT INTO `localidades` VALUES(2286, 9, 1, 'FORMOSA', 'IBARRETA', '3624', NULL, NULL);
INSERT INTO `localidades` VALUES(2287, 9, 1, 'FORMOSA', 'INGENIERO JUAREZ', '3636', NULL, NULL);
INSERT INTO `localidades` VALUES(2288, 9, 1, 'FORMOSA', 'LAGUNA BLANCA', '3613', NULL, NULL);
INSERT INTO `localidades` VALUES(2289, 9, 1, 'FORMOSA', 'LAGUNA NAIK NECK', '3611', NULL, NULL);
INSERT INTO `localidades` VALUES(2290, 9, 1, 'FORMOSA', 'LAGUNA YEMA', '3634', NULL, NULL);
INSERT INTO `localidades` VALUES(2291, 9, 1, 'FORMOSA', 'LAS LOMITAS (FORMOSA', '3630', NULL, NULL);
INSERT INTO `localidades` VALUES(2292, 9, 1, 'FORMOSA', 'MAYOR VILLAFAÑE', '3601', NULL, NULL);
INSERT INTO `localidades` VALUES(2293, 9, 1, 'FORMOSA', 'PALO SANTO', '3608', NULL, NULL);
INSERT INTO `localidades` VALUES(2294, 9, 1, 'FORMOSA', 'PIRANE', '3606', NULL, NULL);
INSERT INTO `localidades` VALUES(2295, 9, 1, 'FORMOSA', 'POZO DEL TIGRE', '3628', NULL, NULL);
INSERT INTO `localidades` VALUES(2296, 9, 1, 'FORMOSA', 'SAN JUAN - FSA', '3611', NULL, NULL);
INSERT INTO `localidades` VALUES(2297, 9, 1, 'FORMOSA', 'TACAGLE', '3615', NULL, NULL);
INSERT INTO `localidades` VALUES(2298, 9, 1, 'FORMOSA', 'TRES LAGUNAS', '3611', NULL, NULL);
INSERT INTO `localidades` VALUES(2299, 9, 1, 'FORMOSA', 'VILLA DOS TRECE', '3603', NULL, NULL);
INSERT INTO `localidades` VALUES(2300, 10, 1, 'JUJUY', 'ABRA PAMPA', '4640', NULL, NULL);
INSERT INTO `localidades` VALUES(2301, 10, 1, 'JUJUY', 'ALTOS HORNOS ZAPLA', '4612', NULL, NULL);
INSERT INTO `localidades` VALUES(2302, 10, 1, 'JUJUY', 'Bº LEDESMA (LIB. GRAL SAN MARTIN)', '4512', NULL, NULL);
INSERT INTO `localidades` VALUES(2303, 10, 1, 'JUJUY', 'CAIMANCITO', '4516', NULL, NULL);
INSERT INTO `localidades` VALUES(2304, 10, 1, 'JUJUY', 'CALILEGUA', '4514', NULL, NULL);
INSERT INTO `localidades` VALUES(2305, 10, 1, 'JUJUY', 'CHALICAN', '4504', NULL, NULL);
INSERT INTO `localidades` VALUES(2306, 10, 1, 'JUJUY', 'EL AGUILAR', '4634', NULL, NULL);
INSERT INTO `localidades` VALUES(2307, 10, 1, 'JUJUY', 'EL CARMEN', '4603', NULL, NULL);
INSERT INTO `localidades` VALUES(2308, 10, 1, 'JUJUY', 'EL QUEMADO', '4504', NULL, NULL);
INSERT INTO `localidades` VALUES(2309, 10, 1, 'JUJUY', 'FRAILE PINTADO', '4506', NULL, NULL);
INSERT INTO `localidades` VALUES(2310, 10, 1, 'JUJUY', 'HUMAHUACA', '4630', NULL, NULL);
INSERT INTO `localidades` VALUES(2311, 10, 1, 'JUJUY', 'LA ESPERANZA', '4415', NULL, NULL);
INSERT INTO `localidades` VALUES(2312, 10, 1, 'JUJUY', 'LA ESPERANZA', '4503', NULL, NULL);
INSERT INTO `localidades` VALUES(2313, 10, 1, 'JUJUY', 'LA MENDIETA', '4522', NULL, NULL);
INSERT INTO `localidades` VALUES(2314, 10, 1, 'JUJUY', 'LA QUIACA', '4650', NULL, NULL);
INSERT INTO `localidades` VALUES(2315, 10, 1, 'JUJUY', 'LIBERTADOR GRAL. SAN MARTIN', '4512', NULL, NULL);
INSERT INTO `localidades` VALUES(2316, 10, 1, 'JUJUY', 'MAIMARA', '4622', NULL, NULL);
INSERT INTO `localidades` VALUES(2317, 10, 1, 'JUJUY', 'MINA AGUILAR', '4634', NULL, NULL);
INSERT INTO `localidades` VALUES(2318, 10, 1, 'JUJUY', 'MINA PIRQUITAS', '4643', NULL, NULL);
INSERT INTO `localidades` VALUES(2319, 10, 1, 'JUJUY', 'MONTERRICO', '4608', NULL, NULL);
INSERT INTO `localidades` VALUES(2320, 10, 1, 'JUJUY', 'PALPALA', '4612', NULL, NULL);
INSERT INTO `localidades` VALUES(2321, 10, 1, 'JUJUY', 'PERICO', '4608', NULL, NULL);
INSERT INTO `localidades` VALUES(2322, 10, 1, 'JUJUY', 'PURMAMARCA', '4618', NULL, NULL);
INSERT INTO `localidades` VALUES(2323, 10, 1, 'JUJUY', 'REYES', '4600', NULL, NULL);
INSERT INTO `localidades` VALUES(2324, 10, 1, 'JUJUY', 'RINCONADA', '4643', NULL, NULL);
INSERT INTO `localidades` VALUES(2325, 10, 1, 'JUJUY', 'RIO BLANCO', '4601', NULL, NULL);
INSERT INTO `localidades` VALUES(2326, 10, 1, 'JUJUY', 'SAN PEDRO DE JUJUY', '4500', NULL, NULL);
INSERT INTO `localidades` VALUES(2327, 10, 1, 'JUJUY', 'SAN SALVADOR DE JUJUY', '4600', NULL, NULL);
INSERT INTO `localidades` VALUES(2328, 10, 1, 'JUJUY', 'SANTA CLARA (JUJUY)', '4501', NULL, NULL);
INSERT INTO `localidades` VALUES(2329, 10, 1, 'JUJUY', 'SANTO DOMINGO', '4608', NULL, NULL);
INSERT INTO `localidades` VALUES(2330, 10, 1, 'JUJUY', 'TERMAS DE REYES', '4600', NULL, NULL);
INSERT INTO `localidades` VALUES(2331, 10, 1, 'JUJUY', 'TILCARA', '4624', NULL, NULL);
INSERT INTO `localidades` VALUES(2332, 10, 1, 'JUJUY', 'TRES CRUCES', '4634', NULL, NULL);
INSERT INTO `localidades` VALUES(2333, 10, 1, 'JUJUY', 'TUMBAYA', '4618', NULL, NULL);
INSERT INTO `localidades` VALUES(2334, 10, 1, 'JUJUY', 'VALLE GRANDE', '4513', NULL, NULL);
INSERT INTO `localidades` VALUES(2335, 10, 1, 'JUJUY', 'VOLCAN', '4616', NULL, NULL);
INSERT INTO `localidades` VALUES(2336, 10, 1, 'JUJUY', 'YALA', '4616', NULL, NULL);
INSERT INTO `localidades` VALUES(2337, 10, 1, 'JUJUY', 'YUTO', '4518', NULL, NULL);
INSERT INTO `localidades` VALUES(2338, 11, 1, 'LA PAMPA', 'ABRAMO', '8212', NULL, NULL);
INSERT INTO `localidades` VALUES(2339, 11, 1, 'LA PAMPA', 'ADOLFO VAN PRAET', '6212', NULL, NULL);
INSERT INTO `localidades` VALUES(2340, 11, 1, 'LA PAMPA', 'ALPACHIRI', '6309', NULL, NULL);
INSERT INTO `localidades` VALUES(2341, 11, 1, 'LA PAMPA', 'ALTA ITALIA', '6207', NULL, NULL);
INSERT INTO `localidades` VALUES(2342, 11, 1, 'LA PAMPA', 'ANGUIL', '6326', NULL, NULL);
INSERT INTO `localidades` VALUES(2343, 11, 1, 'LA PAMPA', 'ARATA', '6385', NULL, NULL);
INSERT INTO `localidades` VALUES(2344, 11, 1, 'LA PAMPA', 'ATALIVA ROCA', '6301', NULL, NULL);
INSERT INTO `localidades` VALUES(2345, 11, 1, 'LA PAMPA', 'BERNARDO LARROUDE', '6220', NULL, NULL);
INSERT INTO `localidades` VALUES(2346, 11, 1, 'LA PAMPA', 'BERNASCONI', '8204', NULL, NULL);
INSERT INTO `localidades` VALUES(2347, 11, 1, 'LA PAMPA', 'CALEU CALEU', '8138', NULL, NULL);
INSERT INTO `localidades` VALUES(2348, 11, 1, 'LA PAMPA', 'CALEUFU', '6387', NULL, NULL);
INSERT INTO `localidades` VALUES(2349, 11, 1, 'LA PAMPA', 'CATRILO', '6330', NULL, NULL);
INSERT INTO `localidades` VALUES(2350, 11, 1, 'LA PAMPA', 'CNEL. HILARIO LAGOS', '6228', NULL, NULL);
INSERT INTO `localidades` VALUES(2351, 11, 1, 'LA PAMPA', 'COLONIA 25 DE MAYO', '8201', NULL, NULL);
INSERT INTO `localidades` VALUES(2352, 11, 1, 'LA PAMPA', 'COLONIA BARON', '6315', NULL, NULL);
INSERT INTO `localidades` VALUES(2353, 11, 1, 'LA PAMPA', 'DORILA', '6365', NULL, NULL);
INSERT INTO `localidades` VALUES(2354, 11, 1, 'LA PAMPA', 'EDUARDO CASTEX', '6380', NULL, NULL);
INSERT INTO `localidades` VALUES(2355, 11, 1, 'LA PAMPA', 'EMBAJADOR MARTINI', '6203', NULL, NULL);
INSERT INTO `localidades` VALUES(2356, 11, 1, 'LA PAMPA', 'GENERAL ACHA', '8200', NULL, NULL);
INSERT INTO `localidades` VALUES(2357, 11, 1, 'LA PAMPA', 'GENERAL MANUEL CAMPO', '6309', NULL, NULL);
INSERT INTO `localidades` VALUES(2358, 11, 1, 'LA PAMPA', 'GENERAL PICO', '6360', NULL, NULL);
INSERT INTO `localidades` VALUES(2359, 11, 1, 'LA PAMPA', 'GRAL.SAN MARTIN -LPP', '8206', NULL, NULL);
INSERT INTO `localidades` VALUES(2360, 11, 1, 'LA PAMPA', 'GUATRACHE', '6311', NULL, NULL);
INSERT INTO `localidades` VALUES(2361, 11, 1, 'LA PAMPA', 'INGENIERO LUIGGI', '6205', NULL, NULL);
INSERT INTO `localidades` VALUES(2362, 11, 1, 'LA PAMPA', 'INTENDENTE ALVEAR', '6221', NULL, NULL);
INSERT INTO `localidades` VALUES(2363, 11, 1, 'LA PAMPA', 'JACINTO ARAUZ', '8208', NULL, NULL);
INSERT INTO `localidades` VALUES(2364, 11, 1, 'LA PAMPA', 'LA ADELA', '8138', NULL, NULL);
INSERT INTO `localidades` VALUES(2365, 11, 1, 'LA PAMPA', 'LA MANUELITA', '6305', NULL, NULL);
INSERT INTO `localidades` VALUES(2366, 11, 1, 'LA PAMPA', 'LA PASTORIL', '6323', NULL, NULL);
INSERT INTO `localidades` VALUES(2367, 11, 1, 'LA PAMPA', 'LA PORTEÑA', '8206', NULL, NULL);
INSERT INTO `localidades` VALUES(2368, 11, 1, 'LA PAMPA', 'LA PRIMAVERA (A DEL AGUILA, CHALILE', '6323', NULL, NULL);
INSERT INTO `localidades` VALUES(2369, 11, 1, 'LA PAMPA', 'LA PRIMAVERA (CHAMAL CO, DTO RANCUL', '6214', NULL, NULL);
INSERT INTO `localidades` VALUES(2370, 11, 1, 'LA PAMPA', 'LA PRIMAVERA (M RIGLOS, DTO ATREUCO', '6301', NULL, NULL);
INSERT INTO `localidades` VALUES(2371, 11, 1, 'LA PAMPA', 'LA PRIMAVERA (SANTA ROSA, DTO CAPIT', '6300', NULL, NULL);
INSERT INTO `localidades` VALUES(2372, 11, 1, 'LA PAMPA', 'LA REFORMA', '8201', NULL, NULL);
INSERT INTO `localidades` VALUES(2373, 11, 1, 'LA PAMPA', 'LA REFORMA VIEJA', '8201', NULL, NULL);
INSERT INTO `localidades` VALUES(2374, 11, 1, 'LA PAMPA', 'LA TRINIDAD', '6354', NULL, NULL);
INSERT INTO `localidades` VALUES(2375, 11, 1, 'LA PAMPA', 'LA VANGUARDIA', '6303', NULL, NULL);
INSERT INTO `localidades` VALUES(2376, 11, 1, 'LA PAMPA', 'LA VIOLETA', '6352', NULL, NULL);
INSERT INTO `localidades` VALUES(2377, 11, 1, 'LA PAMPA', 'LAS MALVINAS', '6300', NULL, NULL);
INSERT INTO `localidades` VALUES(2378, 11, 1, 'LA PAMPA', 'LONQUIMAY', '6352', NULL, NULL);
INSERT INTO `localidades` VALUES(2379, 11, 1, 'LA PAMPA', 'MACACHIN', '6307', NULL, NULL);
INSERT INTO `localidades` VALUES(2380, 11, 1, 'LA PAMPA', 'MAISONABE', '6212', NULL, NULL);
INSERT INTO `localidades` VALUES(2381, 11, 1, 'LA PAMPA', 'METILEO', '6367', NULL, NULL);
INSERT INTO `localidades` VALUES(2382, 11, 1, 'LA PAMPA', 'MIGUEL CANE', '6383', NULL, NULL);
INSERT INTO `localidades` VALUES(2383, 11, 1, 'LA PAMPA', 'MIGUEL RIGLOS', '6301', NULL, NULL);
INSERT INTO `localidades` VALUES(2384, 11, 1, 'LA PAMPA', 'MONTE NIEVAS', '6213', NULL, NULL);
INSERT INTO `localidades` VALUES(2385, 11, 1, 'LA PAMPA', 'OJEDA', '6207', NULL, NULL);
INSERT INTO `localidades` VALUES(2386, 11, 1, 'LA PAMPA', 'PARERA', '6333', NULL, NULL);
INSERT INTO `localidades` VALUES(2387, 11, 1, 'LA PAMPA', 'QUEMU QUEMU', '6212', NULL, NULL);
INSERT INTO `localidades` VALUES(2388, 11, 1, 'LA PAMPA', 'QUETREQUEN', '6214', NULL, NULL);
INSERT INTO `localidades` VALUES(2389, 11, 1, 'LA PAMPA', 'RANCUL', '6214', NULL, NULL);
INSERT INTO `localidades` VALUES(2390, 11, 1, 'LA PAMPA', 'REALICO', '6200', NULL, NULL);
INSERT INTO `localidades` VALUES(2391, 11, 1, 'LA PAMPA', 'SANTA ROSA (LPP)', '6300', NULL, NULL);
INSERT INTO `localidades` VALUES(2392, 11, 1, 'LA PAMPA', 'SPELUZZI', '6365', NULL, NULL);
INSERT INTO `localidades` VALUES(2393, 11, 1, 'LA PAMPA', 'TELEN', '6321', NULL, NULL);
INSERT INTO `localidades` VALUES(2394, 11, 1, 'LA PAMPA', 'TOAY', '6303', NULL, NULL);
INSERT INTO `localidades` VALUES(2395, 11, 1, 'LA PAMPA', 'TOMAS M.DE ANCHORENA', '6301', NULL, NULL);
INSERT INTO `localidades` VALUES(2396, 11, 1, 'LA PAMPA', 'TREBOLARES', '6361', NULL, NULL);
INSERT INTO `localidades` VALUES(2397, 11, 1, 'LA PAMPA', 'TRENEL', '6369', NULL, NULL);
INSERT INTO `localidades` VALUES(2398, 11, 1, 'LA PAMPA', 'URIBURU', '6354', NULL, NULL);
INSERT INTO `localidades` VALUES(2399, 11, 1, 'LA PAMPA', 'VERTIZ', '6365', NULL, NULL);
INSERT INTO `localidades` VALUES(2400, 11, 1, 'LA PAMPA', 'VICTORICA', '6319', NULL, NULL);
INSERT INTO `localidades` VALUES(2401, 11, 1, 'LA PAMPA', 'WINIFREDA', '6313', NULL, NULL);
INSERT INTO `localidades` VALUES(2402, 12, 1, 'LA RIOJA', 'AMINGA', '5301', NULL, NULL);
INSERT INTO `localidades` VALUES(2403, 12, 1, 'LA RIOJA', 'ANILLACO', '5301', NULL, NULL);
INSERT INTO `localidades` VALUES(2404, 12, 1, 'LA RIOJA', 'ARAUCO', '5311', NULL, NULL);
INSERT INTO `localidades` VALUES(2405, 12, 1, 'LA RIOJA', 'CHAÑAR', '5276', NULL, NULL);
INSERT INTO `localidades` VALUES(2406, 12, 1, 'LA RIOJA', 'CHEPES VIEJO', '5470', NULL, NULL);
INSERT INTO `localidades` VALUES(2407, 12, 1, 'LA RIOJA', 'CHILECITO', '5360', NULL, NULL);
INSERT INTO `localidades` VALUES(2408, 12, 1, 'LA RIOJA', 'CORTADERAS -LA RIOJA', '5474', NULL, NULL);
INSERT INTO `localidades` VALUES(2409, 12, 1, 'LA RIOJA', 'DESIDERIO TELLO', '5474', NULL, NULL);
INSERT INTO `localidades` VALUES(2410, 12, 1, 'LA RIOJA', 'EL MOLLAR', '5381', NULL, NULL);
INSERT INTO `localidades` VALUES(2411, 12, 1, 'LA RIOJA', 'EL PORTEZUELO (LRJ)', '5385', NULL, NULL);
INSERT INTO `localidades` VALUES(2412, 12, 1, 'LA RIOJA', 'EL TALA', '5471', NULL, NULL);
INSERT INTO `localidades` VALUES(2413, 12, 1, 'LA RIOJA', 'EL TOTORAL', '5471', NULL, NULL);
INSERT INTO `localidades` VALUES(2414, 12, 1, 'LA RIOJA', 'FAMATINA', '5365', NULL, NULL);
INSERT INTO `localidades` VALUES(2415, 12, 1, 'LA RIOJA', 'GUANCHIN', '5367', NULL, NULL);
INSERT INTO `localidades` VALUES(2416, 12, 1, 'LA RIOJA', 'GUANDACOL', '5353', NULL, NULL);
INSERT INTO `localidades` VALUES(2417, 12, 1, 'LA RIOJA', 'LA MARAVILLA', '5351', NULL, NULL);
INSERT INTO `localidades` VALUES(2418, 12, 1, 'LA RIOJA', 'LA PAMPA (LRJ)', '5359', NULL, NULL);
INSERT INTO `localidades` VALUES(2419, 12, 1, 'LA RIOJA', 'LA PRIMAVERA', '5470', NULL, NULL);
INSERT INTO `localidades` VALUES(2420, 12, 1, 'LA RIOJA', 'LA REFORMA', '5471', NULL, NULL);
INSERT INTO `localidades` VALUES(2421, 12, 1, 'LA RIOJA', 'LA RIOJA', '5300', NULL, NULL);
INSERT INTO `localidades` VALUES(2422, 12, 1, 'LA RIOJA', 'LA TORDILLA (LRJ)', '5471', NULL, NULL);
INSERT INTO `localidades` VALUES(2423, 12, 1, 'LA RIOJA', 'LA ZANJA', '5276', NULL, NULL);
INSERT INTO `localidades` VALUES(2424, 12, 1, 'LA RIOJA', 'LAS TOSCAS', '5471', NULL, NULL);
INSERT INTO `localidades` VALUES(2425, 12, 1, 'LA RIOJA', 'LOMA BLANCA', '5381', NULL, NULL);
INSERT INTO `localidades` VALUES(2426, 12, 1, 'LA RIOJA', 'LOS SARMIENTOS (LRJ)', '5361', NULL, NULL);
INSERT INTO `localidades` VALUES(2427, 12, 1, 'LA RIOJA', 'MACHIGASTA', '5311', NULL, NULL);
INSERT INTO `localidades` VALUES(2428, 12, 1, 'LA RIOJA', 'MALANZAN', '5385', NULL, NULL);
INSERT INTO `localidades` VALUES(2429, 12, 1, 'LA RIOJA', 'MALLIGASTA', '5361', NULL, NULL);
INSERT INTO `localidades` VALUES(2430, 12, 1, 'LA RIOJA', 'MASCASIN', '5471', NULL, NULL);
INSERT INTO `localidades` VALUES(2431, 12, 1, 'LA RIOJA', 'MILAGRO', '5274', NULL, NULL);
INSERT INTO `localidades` VALUES(2432, 12, 1, 'LA RIOJA', 'NONOGASTA', '5372', NULL, NULL);
INSERT INTO `localidades` VALUES(2433, 12, 1, 'LA RIOJA', 'OLTA', '5383', NULL, NULL);
INSERT INTO `localidades` VALUES(2434, 12, 1, 'LA RIOJA', 'PATQUIA', '5386', NULL, NULL);
INSERT INTO `localidades` VALUES(2435, 12, 1, 'LA RIOJA', 'PIEDRA PINTADA', '5361', NULL, NULL);
INSERT INTO `localidades` VALUES(2436, 12, 1, 'LA RIOJA', 'PUERTO ALEGRE', '5361', NULL, NULL);
INSERT INTO `localidades` VALUES(2437, 12, 1, 'LA RIOJA', 'PUNTA DE LOS LLANOS', '5384', NULL, NULL);
INSERT INTO `localidades` VALUES(2438, 12, 1, 'LA RIOJA', 'REAL DEL CADILLO', '5444', NULL, NULL);
INSERT INTO `localidades` VALUES(2439, 12, 1, 'LA RIOJA', 'SALICAS', '5327', NULL, NULL);
INSERT INTO `localidades` VALUES(2440, 12, 1, 'LA RIOJA', 'SAN NICOLAS', '5360', NULL, NULL);
INSERT INTO `localidades` VALUES(2441, 12, 1, 'LA RIOJA', 'SANTA CLARA', '5351', NULL, NULL);
INSERT INTO `localidades` VALUES(2442, 12, 1, 'LA RIOJA', 'SANTA ELENA', '5353', NULL, NULL);
INSERT INTO `localidades` VALUES(2443, 12, 1, 'LA RIOJA', 'SAÑOGASTA', '5367', NULL, NULL);
INSERT INTO `localidades` VALUES(2444, 12, 1, 'LA RIOJA', 'TILIMUSQUI', '5361', NULL, NULL);
INSERT INTO `localidades` VALUES(2445, 12, 1, 'LA RIOJA', 'TRES CERROS', '5361', NULL, NULL);
INSERT INTO `localidades` VALUES(2446, 12, 1, 'LA RIOJA', 'ULAPES', '5473', NULL, NULL);
INSERT INTO `localidades` VALUES(2447, 12, 1, 'LA RIOJA', 'VICHIGASTA', '5374', NULL, NULL);
INSERT INTO `localidades` VALUES(2448, 12, 1, 'LA RIOJA', 'VILLA CASTELLI', '5355', NULL, NULL);
INSERT INTO `localidades` VALUES(2449, 12, 1, 'LA RIOJA', 'VILLA MAZAN', '5313', NULL, NULL);
INSERT INTO `localidades` VALUES(2450, 12, 1, 'LA RIOJA', 'VILLA UNION', '5350', NULL, NULL);
INSERT INTO `localidades` VALUES(2451, 12, 1, 'LA RIOJA', 'VINCHINA', '5357', NULL, NULL);
INSERT INTO `localidades` VALUES(2452, 13, 1, 'MENDOZA', '3 DE MAYO', '5543', NULL, NULL);
INSERT INTO `localidades` VALUES(2453, 13, 1, 'MENDOZA', 'AGRELO', '5509', NULL, NULL);
INSERT INTO `localidades` VALUES(2454, 13, 1, 'MENDOZA', 'AGUA AMARGA', '5563', NULL, NULL);
INSERT INTO `localidades` VALUES(2455, 13, 1, 'MENDOZA', 'AGUA DEL TORO', '5545', NULL, NULL);
INSERT INTO `localidades` VALUES(2456, 13, 1, 'MENDOZA', 'ALGARROBO GRANDE', '5582', NULL, NULL);
INSERT INTO `localidades` VALUES(2457, 13, 1, 'MENDOZA', 'ALPATACAL', '5591', NULL, NULL);
INSERT INTO `localidades` VALUES(2458, 13, 1, 'MENDOZA', 'ALTO SALVADOR', '5570', NULL, NULL);
INSERT INTO `localidades` VALUES(2459, 13, 1, 'MENDOZA', 'ALTO VERDE (MZA)', '5582', NULL, NULL);
INSERT INTO `localidades` VALUES(2460, 13, 1, 'MENDOZA', 'ALVAREZ CONDARCO', '5549', NULL, NULL);
INSERT INTO `localidades` VALUES(2461, 13, 1, 'MENDOZA', 'ANCHORIS', '5509', NULL, NULL);
INSERT INTO `localidades` VALUES(2462, 13, 1, 'MENDOZA', 'ANCON', '5561', NULL, NULL);
INSERT INTO `localidades` VALUES(2463, 13, 1, 'MENDOZA', 'ANDRADE', '5575', NULL, NULL);
INSERT INTO `localidades` VALUES(2464, 13, 1, 'MENDOZA', 'ARROYITO MZA', '5537', NULL, NULL);
INSERT INTO `localidades` VALUES(2465, 13, 1, 'MENDOZA', 'ARROYO CLARO', '5560', NULL, NULL);
INSERT INTO `localidades` VALUES(2466, 13, 1, 'MENDOZA', 'ASUNCION', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2467, 13, 1, 'MENDOZA', 'ATUEL NORTE', '5623', NULL, NULL);
INSERT INTO `localidades` VALUES(2468, 13, 1, 'MENDOZA', 'BAJADA ARAUJO', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2469, 13, 1, 'MENDOZA', 'BALDE DE PIEDRAS', '5596', NULL, NULL);
INSERT INTO `localidades` VALUES(2470, 13, 1, 'MENDOZA', 'BARRANCAS (MZA)', '5517', NULL, NULL);
INSERT INTO `localidades` VALUES(2471, 13, 1, 'MENDOZA', 'BARRI LA GLORIA', '5501', NULL, NULL);
INSERT INTO `localidades` VALUES(2472, 13, 1, 'MENDOZA', 'BARRIO AERONAUTICO', '5539', NULL, NULL);
INSERT INTO `localidades` VALUES(2473, 13, 1, 'MENDOZA', 'BARRIO BOMBAL', '5500', NULL, NULL);
INSERT INTO `localidades` VALUES(2474, 13, 1, 'MENDOZA', 'BARRIO CANO', '5500', NULL, NULL);
INSERT INTO `localidades` VALUES(2475, 13, 1, 'MENDOZA', 'BARRIO COMERCIO', '5519', NULL, NULL);
INSERT INTO `localidades` VALUES(2476, 13, 1, 'MENDOZA', 'BARRIO FERROVIARIO', '5519', NULL, NULL);
INSERT INTO `localidades` VALUES(2477, 13, 1, 'MENDOZA', 'BARRIO FOECYT', '5501', NULL, NULL);
INSERT INTO `localidades` VALUES(2478, 13, 1, 'MENDOZA', 'BARRIO GRAFICO', '5519', NULL, NULL);
INSERT INTO `localidades` VALUES(2479, 13, 1, 'MENDOZA', 'BARRIO MUNICIPAL', '5539', NULL, NULL);
INSERT INTO `localidades` VALUES(2480, 13, 1, 'MENDOZA', 'BARRIO NFANTA', '5539', NULL, NULL);
INSERT INTO `localidades` VALUES(2481, 13, 1, 'MENDOZA', 'BARRIO OLIVARES', '5500', NULL, NULL);
INSERT INTO `localidades` VALUES(2482, 13, 1, 'MENDOZA', 'BARRIO PEDRO MOLINA', '5519', NULL, NULL);
INSERT INTO `localidades` VALUES(2483, 13, 1, 'MENDOZA', 'BARRIO SAN EDUARDO', '5513', NULL, NULL);
INSERT INTO `localidades` VALUES(2484, 13, 1, 'MENDOZA', 'BARRIO SAN IGNACIO', '5547', NULL, NULL);
INSERT INTO `localidades` VALUES(2485, 13, 1, 'MENDOZA', 'BARRIO SAN MARTIN', '5500', NULL, NULL);
INSERT INTO `localidades` VALUES(2486, 13, 1, 'MENDOZA', 'BARRIO SANIDAD', '5500', NULL, NULL);
INSERT INTO `localidades` VALUES(2487, 13, 1, 'MENDOZA', 'BARRIO SANTA ANA', '5521', NULL, NULL);
INSERT INTO `localidades` VALUES(2488, 13, 1, 'MENDOZA', 'BARRIO SOEVA', '5501', NULL, NULL);
INSERT INTO `localidades` VALUES(2489, 13, 1, 'MENDOZA', 'BARRIO TRAPICHE', '5501', NULL, NULL);
INSERT INTO `localidades` VALUES(2490, 13, 1, 'MENDOZA', 'BARRIO VIALIDAD', '5500', NULL, NULL);
INSERT INTO `localidades` VALUES(2491, 13, 1, 'MENDOZA', 'BARRIO VILLA PARQUE', '5547', NULL, NULL);
INSERT INTO `localidades` VALUES(2492, 13, 1, 'MENDOZA', 'BERMEJO', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2493, 13, 1, 'MENDOZA', 'BLANCO ENCALADA', '5549', NULL, NULL);
INSERT INTO `localidades` VALUES(2494, 13, 1, 'MENDOZA', 'BOWEN', '5634', NULL, NULL);
INSERT INTO `localidades` VALUES(2495, 13, 1, 'MENDOZA', 'BUEN ORDEN', '5570', NULL, NULL);
INSERT INTO `localidades` VALUES(2496, 13, 1, 'MENDOZA', 'BUENA NUEVA', '5523', NULL, NULL);
INSERT INTO `localidades` VALUES(2497, 13, 1, 'MENDOZA', 'CACHEUTA', '5549', NULL, NULL);
INSERT INTO `localidades` VALUES(2498, 13, 1, 'MENDOZA', 'CADETES DE CHILE', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2499, 13, 1, 'MENDOZA', 'CAMPO DE LOS ANDES', '5565', NULL, NULL);
INSERT INTO `localidades` VALUES(2500, 13, 1, 'MENDOZA', 'CAPILLA DEL ROSARIO', '5523', NULL, NULL);
INSERT INTO `localidades` VALUES(2501, 13, 1, 'MENDOZA', 'CAPITAN MONTOYA', '5601', NULL, NULL);
INSERT INTO `localidades` VALUES(2502, 13, 1, 'MENDOZA', 'CAPIZ', '5560', NULL, NULL);
INSERT INTO `localidades` VALUES(2503, 13, 1, 'MENDOZA', 'CARMENSA', '5621', NULL, NULL);
INSERT INTO `localidades` VALUES(2504, 13, 1, 'MENDOZA', 'CARRIZAL DE ABAJO', '5509', NULL, NULL);
INSERT INTO `localidades` VALUES(2505, 13, 1, 'MENDOZA', 'CARRIZAL DE ARRIBA', '5509', NULL, NULL);
INSERT INTO `localidades` VALUES(2506, 13, 1, 'MENDOZA', 'CARRODILLA', '5505', NULL, NULL);
INSERT INTO `localidades` VALUES(2507, 13, 1, 'MENDOZA', 'CARTELLONE', '5531', NULL, NULL);
INSERT INTO `localidades` VALUES(2508, 13, 1, 'MENDOZA', 'CA¥ADITA ALEGRE', '5519', NULL, NULL);
INSERT INTO `localidades` VALUES(2509, 13, 1, 'MENDOZA', 'CAÑADA SECA (MZA)', '5603', NULL, NULL);
INSERT INTO `localidades` VALUES(2510, 13, 1, 'MENDOZA', 'CHACHINGO', '5517', NULL, NULL);
INSERT INTO `localidades` VALUES(2511, 13, 1, 'MENDOZA', 'CHACRAS DE CORIA', '5505', NULL, NULL);
INSERT INTO `localidades` VALUES(2512, 13, 1, 'MENDOZA', 'CHAPANAY', '5589', NULL, NULL);
INSERT INTO `localidades` VALUES(2513, 13, 1, 'MENDOZA', 'CHILECITO MENDOZA', '5569', NULL, NULL);
INSERT INTO `localidades` VALUES(2514, 13, 1, 'MENDOZA', 'CHIVILCOY (MZA)', '5571', NULL, NULL);
INSERT INTO `localidades` VALUES(2515, 13, 1, 'MENDOZA', 'CIRCUNVALACION', '5591', NULL, NULL);
INSERT INTO `localidades` VALUES(2516, 13, 1, 'MENDOZA', 'CIUDAD DE JUNIN', '5573', NULL, NULL);
INSERT INTO `localidades` VALUES(2517, 13, 1, 'MENDOZA', 'COLONIA 3 DE MAYO', '5543', NULL, NULL);
INSERT INTO `localidades` VALUES(2518, 13, 1, 'MENDOZA', 'COLONIA ALEMANA MZA', '5543', NULL, NULL);
INSERT INTO `localidades` VALUES(2519, 13, 1, 'MENDOZA', 'COLONIA ALVEAR OESTE', '5632', NULL, NULL);
INSERT INTO `localidades` VALUES(2520, 13, 1, 'MENDOZA', 'COLONIA ANDRE', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2521, 13, 1, 'MENDOZA', 'COLONIA BOMBAL', '5529', NULL, NULL);
INSERT INTO `localidades` VALUES(2522, 13, 1, 'MENDOZA', 'COLONIA DEL CARMEN', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2523, 13, 1, 'MENDOZA', 'COLONIA LAS ROSAS', '5565', NULL, NULL);
INSERT INTO `localidades` VALUES(2524, 13, 1, 'MENDOZA', 'COLONIA LOPEZ', '5623', NULL, NULL);
INSERT INTO `localidades` VALUES(2525, 13, 1, 'MENDOZA', 'COLONIA SANTA TERESA', '5527', NULL, NULL);
INSERT INTO `localidades` VALUES(2526, 13, 1, 'MENDOZA', 'COLONIA SEGOVIA', '5525', NULL, NULL);
INSERT INTO `localidades` VALUES(2527, 13, 1, 'MENDOZA', 'COLONIA TABANERA', '5560', NULL, NULL);
INSERT INTO `localidades` VALUES(2528, 13, 1, 'MENDOZA', 'COMANDANTE SALAS', '5594', NULL, NULL);
INSERT INTO `localidades` VALUES(2529, 13, 1, 'MENDOZA', 'COQUIMBITO', '5513', NULL, NULL);
INSERT INTO `localidades` VALUES(2530, 13, 1, 'MENDOZA', 'CORDON DEL PLATA', '5561', NULL, NULL);
INSERT INTO `localidades` VALUES(2531, 13, 1, 'MENDOZA', 'CORONEL DORREGO MZA', '5519', NULL, NULL);
INSERT INTO `localidades` VALUES(2532, 13, 1, 'MENDOZA', 'CORRAL DE CUERO', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2533, 13, 1, 'MENDOZA', 'CORRAL DEL MOLLE', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2534, 13, 1, 'MENDOZA', 'CORRALITOS', '5527', NULL, NULL);
INSERT INTO `localidades` VALUES(2535, 13, 1, 'MENDOZA', 'COSTA DE ARAUJO', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2536, 13, 1, 'MENDOZA', 'CRISTO REDENTOR', '5557', NULL, NULL);
INSERT INTO `localidades` VALUES(2537, 13, 1, 'MENDOZA', 'CRUZ DE PIEDRA', '5517', NULL, NULL);
INSERT INTO `localidades` VALUES(2538, 13, 1, 'MENDOZA', 'CUADRO NACIONAL', '5607', NULL, NULL);
INSERT INTO `localidades` VALUES(2539, 13, 1, 'MENDOZA', 'DELGADILLO', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2540, 13, 1, 'MENDOZA', 'DESAGUADERO', '5598', NULL, NULL);
INSERT INTO `localidades` VALUES(2541, 13, 1, 'MENDOZA', 'DOCE DE OCTUBRE', '5596', NULL, NULL);
INSERT INTO `localidades` VALUES(2542, 13, 1, 'MENDOZA', 'EL ALGARROBAL', '5541', NULL, NULL);
INSERT INTO `localidades` VALUES(2543, 13, 1, 'MENDOZA', 'EL BORBOLLON', '5541', NULL, NULL);
INSERT INTO `localidades` VALUES(2544, 13, 1, 'MENDOZA', 'EL CARRIZAL', '5509', NULL, NULL);
INSERT INTO `localidades` VALUES(2545, 13, 1, 'MENDOZA', 'EL CA¥ITO', '5543', NULL, NULL);
INSERT INTO `localidades` VALUES(2546, 13, 1, 'MENDOZA', 'EL CENTRAL', '5589', NULL, NULL);
INSERT INTO `localidades` VALUES(2547, 13, 1, 'MENDOZA', 'EL CERRITO', '5600', NULL, NULL);
INSERT INTO `localidades` VALUES(2548, 13, 1, 'MENDOZA', 'EL CHALLAO', '5539', NULL, NULL);
INSERT INTO `localidades` VALUES(2549, 13, 1, 'MENDOZA', 'EL CHILCAL', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2550, 13, 1, 'MENDOZA', 'EL COLORADO', '5592', NULL, NULL);
INSERT INTO `localidades` VALUES(2551, 13, 1, 'MENDOZA', 'EL CONSUELO', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2552, 13, 1, 'MENDOZA', 'EL GUANACO', '5537', NULL, NULL);
INSERT INTO `localidades` VALUES(2553, 13, 1, 'MENDOZA', 'EL NIHUIL', '5605', NULL, NULL);
INSERT INTO `localidades` VALUES(2554, 13, 1, 'MENDOZA', 'EL PARAISO (MZA)', '5531', NULL, NULL);
INSERT INTO `localidades` VALUES(2555, 13, 1, 'MENDOZA', 'EL PASTAL', '5541', NULL, NULL);
INSERT INTO `localidades` VALUES(2556, 13, 1, 'MENDOZA', 'EL PERAL', '5561', NULL, NULL);
INSERT INTO `localidades` VALUES(2557, 13, 1, 'MENDOZA', 'EL PLUMERILLO', '5541', NULL, NULL);
INSERT INTO `localidades` VALUES(2558, 13, 1, 'MENDOZA', 'EL RESGUARDO', '5541', NULL, NULL);
INSERT INTO `localidades` VALUES(2559, 13, 1, 'MENDOZA', 'EL RETAMO', '5537', NULL, NULL);
INSERT INTO `localidades` VALUES(2560, 13, 1, 'MENDOZA', 'EL RETIRO', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2561, 13, 1, 'MENDOZA', 'EL SOSNEADO', '5611', NULL, NULL);
INSERT INTO `localidades` VALUES(2562, 13, 1, 'MENDOZA', 'EL USILLAL', '5601', NULL, NULL);
INSERT INTO `localidades` VALUES(2563, 13, 1, 'MENDOZA', 'EL VERGEL', '5527', NULL, NULL);
INSERT INTO `localidades` VALUES(2564, 13, 1, 'MENDOZA', 'EL VILLEGUINO', '5594', NULL, NULL);
INSERT INTO `localidades` VALUES(2565, 13, 1, 'MENDOZA', 'EL ZAMPAR', '5561', NULL, NULL);
INSERT INTO `localidades` VALUES(2566, 13, 1, 'MENDOZA', 'EUGENIO BUSTOS', '5569', NULL, NULL);
INSERT INTO `localidades` VALUES(2567, 13, 1, 'MENDOZA', 'FRAY L. BELTRAN MZA', '5531', NULL, NULL);
INSERT INTO `localidades` VALUES(2568, 13, 1, 'MENDOZA', 'GENERAL ACHA MZA', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2569, 13, 1, 'MENDOZA', 'GENERAL ALVEAR MZA', '5620', NULL, NULL);
INSERT INTO `localidades` VALUES(2570, 13, 1, 'MENDOZA', 'GENERAL GUTIERREZ', '5511', NULL, NULL);
INSERT INTO `localidades` VALUES(2571, 13, 1, 'MENDOZA', 'GENERAL ORTEGA', '5517', NULL, NULL);
INSERT INTO `localidades` VALUES(2572, 13, 1, 'MENDOZA', 'GOB. LUIS MOLINA', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2573, 13, 1, 'MENDOZA', 'GOBERNADOR BENEGAS', '5544', NULL, NULL);
INSERT INTO `localidades` VALUES(2574, 13, 1, 'MENDOZA', 'GOBERNADOR BENEGAS 1', '5603', NULL, NULL);
INSERT INTO `localidades` VALUES(2575, 13, 1, 'MENDOZA', 'GOBERNADOR CIVIT', '5594', NULL, NULL);
INSERT INTO `localidades` VALUES(2576, 13, 1, 'MENDOZA', 'GODOY CRUZ', '5501', NULL, NULL);
INSERT INTO `localidades` VALUES(2577, 13, 1, 'MENDOZA', 'GOUDGE', '5603', NULL, NULL);
INSERT INTO `localidades` VALUES(2578, 13, 1, 'MENDOZA', 'GUAYMALLEN', '5521', NULL, NULL);
INSERT INTO `localidades` VALUES(2579, 13, 1, 'MENDOZA', 'GUSTAVO ANDRE', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2580, 13, 1, 'MENDOZA', 'HORINITO EL GRINGO', '5543', NULL, NULL);
INSERT INTO `localidades` VALUES(2581, 13, 1, 'MENDOZA', 'HORNOS DE MOYANO', '5543', NULL, NULL);
INSERT INTO `localidades` VALUES(2582, 13, 1, 'MENDOZA', 'INGENIERO GIAGNONI', '5582', NULL, NULL);
INSERT INTO `localidades` VALUES(2583, 13, 1, 'MENDOZA', 'JAIME PRATS', '5623', NULL, NULL);
INSERT INTO `localidades` VALUES(2584, 13, 1, 'MENDOZA', 'JESUS NAZARENO', '5523', NULL, NULL);
INSERT INTO `localidades` VALUES(2585, 13, 1, 'MENDOZA', 'JOCOLI', '5543', NULL, NULL);
INSERT INTO `localidades` VALUES(2586, 13, 1, 'MENDOZA', 'JOCOLI VIEJO', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2587, 13, 1, 'MENDOZA', 'JOSE N.. LENCINAS', '5594', NULL, NULL);
INSERT INTO `localidades` VALUES(2588, 13, 1, 'MENDOZA', 'JUNIN MZA', '5582', NULL, NULL);
INSERT INTO `localidades` VALUES(2589, 13, 1, 'MENDOZA', 'KILOMETRO OCHO', '5529', NULL, NULL);
INSERT INTO `localidades` VALUES(2590, 13, 1, 'MENDOZA', 'LA ARBOLEDA', '5561', NULL, NULL);
INSERT INTO `localidades` VALUES(2591, 13, 1, 'MENDOZA', 'LA CARRERA MZA', '5561', NULL, NULL);
INSERT INTO `localidades` VALUES(2592, 13, 1, 'MENDOZA', 'LA CELIA', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2593, 13, 1, 'MENDOZA', 'LA CENTRAL', '5579', NULL, NULL);
INSERT INTO `localidades` VALUES(2594, 13, 1, 'MENDOZA', 'LA CHILCA', '5595', NULL, NULL);
INSERT INTO `localidades` VALUES(2595, 13, 1, 'MENDOZA', 'LA CHIMBA', '5589', NULL, NULL);
INSERT INTO `localidades` VALUES(2596, 13, 1, 'MENDOZA', 'LA COLONIA', '5570', NULL, NULL);
INSERT INTO `localidades` VALUES(2597, 13, 1, 'MENDOZA', 'LA COLONIA SUD', '5594', NULL, NULL);
INSERT INTO `localidades` VALUES(2598, 13, 1, 'MENDOZA', 'LA CONSULTA', '5567', NULL, NULL);
INSERT INTO `localidades` VALUES(2599, 13, 1, 'MENDOZA', 'LA CORTADERA', '5545', NULL, NULL);
INSERT INTO `localidades` VALUES(2600, 13, 1, 'MENDOZA', 'LA COSTA', '5596', NULL, NULL);
INSERT INTO `localidades` VALUES(2601, 13, 1, 'MENDOZA', 'LA DORMIDA', '5592', NULL, NULL);
INSERT INTO `localidades` VALUES(2602, 13, 1, 'MENDOZA', 'LA ESCANDINAVA', '5634', NULL, NULL);
INSERT INTO `localidades` VALUES(2603, 13, 1, 'MENDOZA', 'LA ESTACADA', '5560', NULL, NULL);
INSERT INTO `localidades` VALUES(2604, 13, 1, 'MENDOZA', 'LA FLORIDA MZA', '5579', NULL, NULL);
INSERT INTO `localidades` VALUES(2605, 13, 1, 'MENDOZA', 'LA LIBERTAD', '5579', NULL, NULL);
INSERT INTO `localidades` VALUES(2606, 13, 1, 'MENDOZA', 'LA MARZOLINA', '5632', NULL, NULL);
INSERT INTO `localidades` VALUES(2607, 13, 1, 'MENDOZA', 'LA PALMERA', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2608, 13, 1, 'MENDOZA', 'LA PASTORAL', '5570', NULL, NULL);
INSERT INTO `localidades` VALUES(2609, 13, 1, 'MENDOZA', 'LA PAZ (MZA)', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2610, 13, 1, 'MENDOZA', 'LA PEGA', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2611, 13, 1, 'MENDOZA', 'LA PRIMAVERA (DTO GUAYMALLEN)', '5527', NULL, NULL);
INSERT INTO `localidades` VALUES(2612, 13, 1, 'MENDOZA', 'LA PRIMAVERA (LA PAZ, DTO LA PAZ)', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2613, 13, 1, 'MENDOZA', 'LA PRIMAVERA (VISTA FLORES, TUNUYAN', '5565', NULL, NULL);
INSERT INTO `localidades` VALUES(2614, 13, 1, 'MENDOZA', 'LA PRIMAVERA MZA', '5563', NULL, NULL);
INSERT INTO `localidades` VALUES(2615, 13, 1, 'MENDOZA', 'LA PUNTILLA (MZA)', '5505', NULL, NULL);
INSERT INTO `localidades` VALUES(2616, 13, 1, 'MENDOZA', 'LAGUNA DEL ROSARIO', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2617, 13, 1, 'MENDOZA', 'LAGUNITA', '5527', NULL, NULL);
INSERT INTO `localidades` VALUES(2618, 13, 1, 'MENDOZA', 'LAS CATITAS', '5592', NULL, NULL);
INSERT INTO `localidades` VALUES(2619, 13, 1, 'MENDOZA', 'LAS CUEVAS (MZA)', '5557', NULL, NULL);
INSERT INTO `localidades` VALUES(2620, 13, 1, 'MENDOZA', 'LAS DELICIAS', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2621, 13, 1, 'MENDOZA', 'LAS HERAS (MZA)', '5539', NULL, NULL);
INSERT INTO `localidades` VALUES(2622, 13, 1, 'MENDOZA', 'LAS LE¥AS', '5613', NULL, NULL);
INSERT INTO `localidades` VALUES(2623, 13, 1, 'MENDOZA', 'LAS MALVINAS', '5605', NULL, NULL);
INSERT INTO `localidades` VALUES(2624, 13, 1, 'MENDOZA', 'LAS PAREDES', '5601', NULL, NULL);
INSERT INTO `localidades` VALUES(2625, 13, 1, 'MENDOZA', 'LAS ROSAS (MZA)', '5560', NULL, NULL);
INSERT INTO `localidades` VALUES(2626, 13, 1, 'MENDOZA', 'LAS VIZCACHAS', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2627, 13, 1, 'MENDOZA', 'LAVALLE (MZA)', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2628, 13, 1, 'MENDOZA', 'LIMON', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2629, 13, 1, 'MENDOZA', 'LOS ALAMOS', '5531', NULL, NULL);
INSERT INTO `localidades` VALUES(2630, 13, 1, 'MENDOZA', 'LOS ALGARROBOS', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2631, 13, 1, 'MENDOZA', 'LOS ARBOLES', '5563', NULL, NULL);
INSERT INTO `localidades` VALUES(2632, 13, 1, 'MENDOZA', 'LOS BALDES', '5537', NULL, NULL);
INSERT INTO `localidades` VALUES(2633, 13, 1, 'MENDOZA', 'LOS BARRIALES', '5585', NULL, NULL);
INSERT INTO `localidades` VALUES(2634, 13, 1, 'MENDOZA', 'LOS BARRIALES (MZA)', '5585', NULL, NULL);
INSERT INTO `localidades` VALUES(2635, 13, 1, 'MENDOZA', 'LOS BLANCOS', '5537', NULL, NULL);
INSERT INTO `localidades` VALUES(2636, 13, 1, 'MENDOZA', 'LOS CAMPAMENTOS', '5577', NULL, NULL);
INSERT INTO `localidades` VALUES(2637, 13, 1, 'MENDOZA', 'LOS CORRALITOS MZA', '5527', NULL, NULL);
INSERT INTO `localidades` VALUES(2638, 13, 1, 'MENDOZA', 'LOS EMBARQUES', '5595', NULL, NULL);
INSERT INTO `localidades` VALUES(2639, 13, 1, 'MENDOZA', 'LOS RALOS MZA', '5537', NULL, NULL);
INSERT INTO `localidades` VALUES(2640, 13, 1, 'MENDOZA', 'LOS SAUCES (MZA)', '5563', NULL, NULL);
INSERT INTO `localidades` VALUES(2641, 13, 1, 'MENDOZA', 'LOS SAUCES - LAVALLE', '5537', NULL, NULL);
INSERT INTO `localidades` VALUES(2642, 13, 1, 'MENDOZA', 'LUJAN DE CUYO', '5507', NULL, NULL);
INSERT INTO `localidades` VALUES(2643, 13, 1, 'MENDOZA', 'LUNLUNTA', '5517', NULL, NULL);
INSERT INTO `localidades` VALUES(2644, 13, 1, 'MENDOZA', 'LUZURIAGA', '5513', NULL, NULL);
INSERT INTO `localidades` VALUES(2645, 13, 1, 'MENDOZA', 'MAIPU', '5515', NULL, NULL);
INSERT INTO `localidades` VALUES(2646, 13, 1, 'MENDOZA', 'MALARGÜE', '5613', NULL, NULL);
INSERT INTO `localidades` VALUES(2647, 13, 1, 'MENDOZA', 'MAQUINISTA LEVET', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2648, 13, 1, 'MENDOZA', 'MAYOR DRUMOND', '5507', NULL, NULL);
INSERT INTO `localidades` VALUES(2649, 13, 1, 'MENDOZA', 'MEDRANO', '5585', NULL, NULL);
INSERT INTO `localidades` VALUES(2650, 13, 1, 'MENDOZA', 'MENDOZA', '5500', NULL, NULL);
INSERT INTO `localidades` VALUES(2651, 13, 1, 'MENDOZA', 'MOLUCHES', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2652, 13, 1, 'MENDOZA', 'MONTE CASEROS (MZA)', '5571', NULL, NULL);
INSERT INTO `localidades` VALUES(2653, 13, 1, 'MENDOZA', 'MONTE COMAN', '5609', NULL, NULL);
INSERT INTO `localidades` VALUES(2654, 13, 1, 'MENDOZA', 'MUNDO NUEVO', '5579', NULL, NULL);
INSERT INTO `localidades` VALUES(2655, 13, 1, 'MENDOZA', 'NUEVA CALIFORNIA', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2656, 13, 1, 'MENDOZA', 'NUEVA CIUDAD', '5519', NULL, NULL);
INSERT INTO `localidades` VALUES(2657, 13, 1, 'MENDOZA', 'PALMIRA', '5584', NULL, NULL);
INSERT INTO `localidades` VALUES(2658, 13, 1, 'MENDOZA', 'PAMPITA', '5598', NULL, NULL);
INSERT INTO `localidades` VALUES(2659, 13, 1, 'MENDOZA', 'PANQUEHUA', '5539', NULL, NULL);
INSERT INTO `localidades` VALUES(2660, 13, 1, 'MENDOZA', 'PARADERO LA SUPERIOR', '5525', NULL, NULL);
INSERT INTO `localidades` VALUES(2661, 13, 1, 'MENDOZA', 'PARAMILLO', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2662, 13, 1, 'MENDOZA', 'PAREDITAS', '5569', NULL, NULL);
INSERT INTO `localidades` VALUES(2663, 13, 1, 'MENDOZA', 'PEDREGAL', '5529', NULL, NULL);
INSERT INTO `localidades` VALUES(2664, 13, 1, 'MENDOZA', 'PERDRIEL', '5509', NULL, NULL);
INSERT INTO `localidades` VALUES(2665, 13, 1, 'MENDOZA', 'PHILIPPS', '5579', NULL, NULL);
INSERT INTO `localidades` VALUES(2666, 13, 1, 'MENDOZA', 'PICHI CIEGO', '5594', NULL, NULL);
INSERT INTO `localidades` VALUES(2667, 13, 1, 'MENDOZA', 'PIRQUITA', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2668, 13, 1, 'MENDOZA', 'POLVAREDAS', '5551', NULL, NULL);
INSERT INTO `localidades` VALUES(2669, 13, 1, 'MENDOZA', 'POTRERILLOS', '5549', NULL, NULL);
INSERT INTO `localidades` VALUES(2670, 13, 1, 'MENDOZA', 'PRIMAVERA', '5525', NULL, NULL);
INSERT INTO `localidades` VALUES(2671, 13, 1, 'MENDOZA', 'PROGRESO MZA', '5535', NULL, NULL);
INSERT INTO `localidades` VALUES(2672, 13, 1, 'MENDOZA', 'PUENTE DEL INCA', '5555', NULL, NULL);
INSERT INTO `localidades` VALUES(2673, 13, 1, 'MENDOZA', 'PUERTA DE LA ISLA', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2674, 13, 1, 'MENDOZA', 'PUNTA DE VACAS', '5553', NULL, NULL);
INSERT INTO `localidades` VALUES(2675, 13, 1, 'MENDOZA', 'RAMA CAIDA', '5603', NULL, NULL);
INSERT INTO `localidades` VALUES(2676, 13, 1, 'MENDOZA', 'REAL DEL PADRE', '5624', NULL, NULL);
INSERT INTO `localidades` VALUES(2677, 13, 1, 'MENDOZA', 'RECOARO', '5596', NULL, NULL);
INSERT INTO `localidades` VALUES(2678, 13, 1, 'MENDOZA', 'REDUCCION (MZA)', '5579', NULL, NULL);
INSERT INTO `localidades` VALUES(2679, 13, 1, 'MENDOZA', 'RETAMO', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2680, 13, 1, 'MENDOZA', 'RIO BLANCO', '5553', NULL, NULL);
INSERT INTO `localidades` VALUES(2681, 13, 1, 'MENDOZA', 'RIVADAVIA (MZA)', '5577', NULL, NULL);
INSERT INTO `localidades` VALUES(2682, 13, 1, 'MENDOZA', 'RODEO DE LA CRUZ', '5525', NULL, NULL);
INSERT INTO `localidades` VALUES(2683, 13, 1, 'MENDOZA', 'RODEO DEL MEDIO', '5529', NULL, NULL);
INSERT INTO `localidades` VALUES(2684, 13, 1, 'MENDOZA', 'RODRIGUEZ PE¥A', '5585', NULL, NULL);
INSERT INTO `localidades` VALUES(2685, 13, 1, 'MENDOZA', 'RUSELL', '5517', NULL, NULL);
INSERT INTO `localidades` VALUES(2686, 13, 1, 'MENDOZA', 'SALTO DE LAS ROSAS', '5603', NULL, NULL);
INSERT INTO `localidades` VALUES(2687, 13, 1, 'MENDOZA', 'SAN ALBERTO MZA', '5545', NULL, NULL);
INSERT INTO `localidades` VALUES(2688, 13, 1, 'MENDOZA', 'SAN CARLOS (MZA)', '5569', NULL, NULL);
INSERT INTO `localidades` VALUES(2689, 13, 1, 'MENDOZA', 'SAN FCO.DEL MONTE', '5503', NULL, NULL);
INSERT INTO `localidades` VALUES(2690, 13, 1, 'MENDOZA', 'SAN JOSE (MZA)', '5561', NULL, NULL);
INSERT INTO `localidades` VALUES(2691, 13, 1, 'MENDOZA', 'SAN JOSE (MZA1)', '5519', NULL, NULL);
INSERT INTO `localidades` VALUES(2692, 13, 1, 'MENDOZA', 'SAN MARTIN (MZA)', '5570', NULL, NULL);
INSERT INTO `localidades` VALUES(2693, 13, 1, 'MENDOZA', 'SAN MIGUEL MZA', '5537', NULL, NULL);
INSERT INTO `localidades` VALUES(2694, 13, 1, 'MENDOZA', 'SAN PEDRO DEL ATUEL', '5621', NULL, NULL);
INSERT INTO `localidades` VALUES(2695, 13, 1, 'MENDOZA', 'SAN RAFAEL', '5600', NULL, NULL);
INSERT INTO `localidades` VALUES(2696, 13, 1, 'MENDOZA', 'SANTA BLANCA', '5531', NULL, NULL);
INSERT INTO `localidades` VALUES(2697, 13, 1, 'MENDOZA', 'SANTA MARIA DE ORO', '5579', NULL, NULL);
INSERT INTO `localidades` VALUES(2698, 13, 1, 'MENDOZA', 'SANTA MARTA', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2699, 13, 1, 'MENDOZA', 'SANTA ROSA (MZA)', '5596', NULL, NULL);
INSERT INTO `localidades` VALUES(2700, 13, 1, 'MENDOZA', 'SEXTA SECCION', '5500', NULL, NULL);
INSERT INTO `localidades` VALUES(2701, 13, 1, 'MENDOZA', 'SOPANTA', '5591', NULL, NULL);
INSERT INTO `localidades` VALUES(2702, 13, 1, 'MENDOZA', 'TAPON', '5598', NULL, NULL);
INSERT INTO `localidades` VALUES(2703, 13, 1, 'MENDOZA', 'TOTORAL', '5560', NULL, NULL);
INSERT INTO `localidades` VALUES(2704, 13, 1, 'MENDOZA', 'TRES ACEQUIAS', '5585', NULL, NULL);
INSERT INTO `localidades` VALUES(2705, 13, 1, 'MENDOZA', 'TRES ESQUINAS', '5569', NULL, NULL);
INSERT INTO `localidades` VALUES(2706, 13, 1, 'MENDOZA', 'TRES ESQUINAS MZA', '5517', NULL, NULL);
INSERT INTO `localidades` VALUES(2707, 13, 1, 'MENDOZA', 'TRES PORTEÑAS', '5589', NULL, NULL);
INSERT INTO `localidades` VALUES(2708, 13, 1, 'MENDOZA', 'TULUMAYA', '5533', NULL, NULL);
INSERT INTO `localidades` VALUES(2709, 13, 1, 'MENDOZA', 'TUNUYAN', '5560', NULL, NULL);
INSERT INTO `localidades` VALUES(2710, 13, 1, 'MENDOZA', 'TUPUNGATO', '5561', NULL, NULL);
INSERT INTO `localidades` VALUES(2711, 13, 1, 'MENDOZA', 'UGARTECHE', '5509', NULL, NULL);
INSERT INTO `localidades` VALUES(2712, 13, 1, 'MENDOZA', 'USPALLATA', '5545', NULL, NULL);
INSERT INTO `localidades` VALUES(2713, 13, 1, 'MENDOZA', 'VERGEL', '5527', NULL, NULL);
INSERT INTO `localidades` VALUES(2714, 13, 1, 'MENDOZA', 'VILLA 25 DE MAYO', '5570', NULL, NULL);
INSERT INTO `localidades` VALUES(2715, 13, 1, 'MENDOZA', 'VILLA ANTIGUA', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2716, 13, 1, 'MENDOZA', 'VILLA ATUEL', '5622', NULL, NULL);
INSERT INTO `localidades` VALUES(2717, 13, 1, 'MENDOZA', 'VILLA BASTIAS', '5561', NULL, NULL);
INSERT INTO `localidades` VALUES(2718, 13, 1, 'MENDOZA', 'VILLA CATALA', '5596', NULL, NULL);
INSERT INTO `localidades` VALUES(2719, 13, 1, 'MENDOZA', 'VILLA CENTENARIO', '5570', NULL, NULL);
INSERT INTO `localidades` VALUES(2720, 13, 1, 'MENDOZA', 'VILLA DEL CARMEN MZA', '5570', NULL, NULL);
INSERT INTO `localidades` VALUES(2721, 13, 1, 'MENDOZA', 'VILLA HIPODROMO', '5547', NULL, NULL);
INSERT INTO `localidades` VALUES(2722, 13, 1, 'MENDOZA', 'VILLA LA PAZ', '5591', NULL, NULL);
INSERT INTO `localidades` VALUES(2723, 13, 1, 'MENDOZA', 'VILLA MOLINO ORFILIA', '5571', NULL, NULL);
INSERT INTO `localidades` VALUES(2724, 13, 1, 'MENDOZA', 'VILLA NUEVA (MZA)', '5521', NULL, NULL);
INSERT INTO `localidades` VALUES(2725, 13, 1, 'MENDOZA', 'VILLA SAN ISIDRO MZA', '5577', NULL, NULL);
INSERT INTO `localidades` VALUES(2726, 13, 1, 'MENDOZA', 'VILLA SECA', '5563', NULL, NULL);
INSERT INTO `localidades` VALUES(2727, 13, 1, 'MENDOZA', 'VILLA VIEJA', '5590', NULL, NULL);
INSERT INTO `localidades` VALUES(2728, 13, 1, 'MENDOZA', 'VILLANUEVA (MZA)', '5521', NULL, NULL);
INSERT INTO `localidades` VALUES(2729, 13, 1, 'MENDOZA', 'VISTA FLORES', '5565', NULL, NULL);
INSERT INTO `localidades` VALUES(2730, 13, 1, 'MENDOZA', 'VISTALBA', '5509', NULL, NULL);
INSERT INTO `localidades` VALUES(2731, 13, 1, 'MENDOZA', 'ZANJON AMARILLO', '5553', NULL, NULL);
INSERT INTO `localidades` VALUES(2732, 13, 1, 'MENDOZA', 'ZAPATA (MZA)', '5560', NULL, NULL);
INSERT INTO `localidades` VALUES(2733, 13, 1, 'MENDOZA', 'ÑACUÑAN', '5595', NULL, NULL);
INSERT INTO `localidades` VALUES(2734, 14, 1, 'MISIONES', '2 DE MAYO', '3363', NULL, NULL);
INSERT INTO `localidades` VALUES(2735, 14, 1, 'MISIONES', '25 DE MAYO (MIS)', '3363', NULL, NULL);
INSERT INTO `localidades` VALUES(2736, 14, 1, 'MISIONES', '9 DE JULIO (MIS)', '3380', NULL, NULL);
INSERT INTO `localidades` VALUES(2737, 14, 1, 'MISIONES', 'ANDRESITO', '3366', NULL, NULL);
INSERT INTO `localidades` VALUES(2738, 14, 1, 'MISIONES', 'APOSTOLES', '3350', NULL, NULL);
INSERT INTO `localidades` VALUES(2739, 14, 1, 'MISIONES', 'ARISTOBULO DEL VALLE', '3364', NULL, NULL);
INSERT INTO `localidades` VALUES(2740, 14, 1, 'MISIONES', 'ARROYO DEL MEDIO', '3313', NULL, NULL);
INSERT INTO `localidades` VALUES(2741, 14, 1, 'MISIONES', 'AZARA', '3351', NULL, NULL);
INSERT INTO `localidades` VALUES(2742, 14, 1, 'MISIONES', 'BERNARDO DE IRIGOYEN', '3366', NULL, NULL);
INSERT INTO `localidades` VALUES(2743, 14, 1, 'MISIONES', 'CABUREI', '3366', NULL, NULL);
INSERT INTO `localidades` VALUES(2744, 14, 1, 'MISIONES', 'CAMPO GRANDE', '3362', NULL, NULL);
INSERT INTO `localidades` VALUES(2745, 14, 1, 'MISIONES', 'CAMPO RAMON', '3361', NULL, NULL);
INSERT INTO `localidades` VALUES(2746, 14, 1, 'MISIONES', 'CAMPO VIERA', '3362', NULL, NULL);
INSERT INTO `localidades` VALUES(2747, 14, 1, 'MISIONES', 'CANDELARIA (MIS)', '3308', NULL, NULL);
INSERT INTO `localidades` VALUES(2748, 14, 1, 'MISIONES', 'CAPIOVI', '3332', NULL, NULL);
INSERT INTO `localidades` VALUES(2749, 14, 1, 'MISIONES', 'CARAGUATAY', '3386', NULL, NULL);
INSERT INTO `localidades` VALUES(2750, 14, 1, 'MISIONES', 'CARAGUATAY', '3386', NULL, NULL);
INSERT INTO `localidades` VALUES(2751, 14, 1, 'MISIONES', 'CERRO AZUL (MIS)', '3313', NULL, NULL);
INSERT INTO `localidades` VALUES(2752, 14, 1, 'MISIONES', 'COLONIA AURORA', '3363', NULL, NULL);
INSERT INTO `localidades` VALUES(2753, 14, 1, 'MISIONES', 'COLONIA WANDA', '3376', NULL, NULL);
INSERT INTO `localidades` VALUES(2754, 14, 1, 'MISIONES', 'CONC. DE LA SIERRA', '3355', NULL, NULL);
INSERT INTO `localidades` VALUES(2755, 14, 1, 'MISIONES', 'CORPUS', '3327', NULL, NULL);
INSERT INTO `localidades` VALUES(2756, 14, 1, 'MISIONES', 'CUÑA PIRU', '3334', NULL, NULL);
INSERT INTO `localidades` VALUES(2757, 14, 1, 'MISIONES', 'EL ALACAZAR', '3386', NULL, NULL);
INSERT INTO `localidades` VALUES(2758, 14, 1, 'MISIONES', 'EL ALCAZAR', '3386', NULL, NULL);
INSERT INTO `localidades` VALUES(2759, 14, 1, 'MISIONES', 'EL DORADO', '3380', NULL, NULL);
INSERT INTO `localidades` VALUES(2760, 14, 1, 'MISIONES', 'EL SOBERBIO', '3364', NULL, NULL);
INSERT INTO `localidades` VALUES(2761, 14, 1, 'MISIONES', 'GARUHAPE', '3334', NULL, NULL);
INSERT INTO `localidades` VALUES(2762, 14, 1, 'MISIONES', 'GARUPA', '3304', NULL, NULL);
INSERT INTO `localidades` VALUES(2763, 14, 1, 'MISIONES', 'GOBERNADOR ROCA', '3324', NULL, NULL);
INSERT INTO `localidades` VALUES(2764, 14, 1, 'MISIONES', 'GUARANI', '3361', NULL, NULL);
INSERT INTO `localidades` VALUES(2765, 14, 1, 'MISIONES', 'HIPOLITO IRIGOYEN', '3328', NULL, NULL);
INSERT INTO `localidades` VALUES(2766, 14, 1, 'MISIONES', 'JARDIN AMERICA', '3328', NULL, NULL);
INSERT INTO `localidades` VALUES(2767, 14, 1, 'MISIONES', 'LEANDRO N. ALEM (MIS', '3315', NULL, NULL);
INSERT INTO `localidades` VALUES(2768, 14, 1, 'MISIONES', 'LIBERTAD (MISIONES)', '3374', NULL, NULL);
INSERT INTO `localidades` VALUES(2769, 14, 1, 'MISIONES', 'LORETO (MIS)', '3316', NULL, NULL);
INSERT INTO `localidades` VALUES(2770, 14, 1, 'MISIONES', 'LOS HELECHOS', '3361', NULL, NULL);
INSERT INTO `localidades` VALUES(2771, 14, 1, 'MISIONES', 'LUJAN (MIS)', '3332', NULL, NULL);
INSERT INTO `localidades` VALUES(2772, 14, 1, 'MISIONES', 'MAGDALENA', '3376', NULL, NULL);
INSERT INTO `localidades` VALUES(2773, 14, 1, 'MISIONES', 'MONTECARLO', '3384', NULL, NULL);
INSERT INTO `localidades` VALUES(2774, 14, 1, 'MISIONES', 'OBERA', '3360', NULL, NULL);
INSERT INTO `localidades` VALUES(2775, 14, 1, 'MISIONES', 'PIÑALITO', '3366', NULL, NULL);
INSERT INTO `localidades` VALUES(2776, 14, 1, 'MISIONES', 'POSADAS', '3300', NULL, NULL);
INSERT INTO `localidades` VALUES(2777, 14, 1, 'MISIONES', 'PUERTO BOSSETTI', '3374', NULL, NULL);
INSERT INTO `localidades` VALUES(2778, 14, 1, 'MISIONES', 'PUERTO DELICIA', '3381', NULL, NULL);
INSERT INTO `localidades` VALUES(2779, 14, 1, 'MISIONES', 'PUERTO ESPAÑA', '3326', NULL, NULL);
INSERT INTO `localidades` VALUES(2780, 14, 1, 'MISIONES', 'PUERTO ESPERANZA', '3378', NULL, NULL);
INSERT INTO `localidades` VALUES(2781, 14, 1, 'MISIONES', 'PUERTO IGUAZU', '3370', NULL, NULL);
INSERT INTO `localidades` VALUES(2782, 14, 1, 'MISIONES', 'PUERTO LEONI', '3332', NULL, NULL);
INSERT INTO `localidades` VALUES(2783, 14, 1, 'MISIONES', 'PUERTO PINARES', '3382', NULL, NULL);
INSERT INTO `localidades` VALUES(2784, 14, 1, 'MISIONES', 'PUERTO PIRAY', '3381', NULL, NULL);
INSERT INTO `localidades` VALUES(2785, 14, 1, 'MISIONES', 'PUERTO RICO', '3334', NULL, NULL);
INSERT INTO `localidades` VALUES(2786, 14, 1, 'MISIONES', 'PUERTO VICTORIA', '3382', NULL, NULL);
INSERT INTO `localidades` VALUES(2787, 14, 1, 'MISIONES', 'RUIZ DE MONTOYA', '3334', NULL, NULL);
INSERT INTO `localidades` VALUES(2788, 14, 1, 'MISIONES', 'SALTO ENCANTADO', '3364', NULL, NULL);
INSERT INTO `localidades` VALUES(2789, 14, 1, 'MISIONES', 'SAN ANTONIO (MIS)', '3366', NULL, NULL);
INSERT INTO `localidades` VALUES(2790, 14, 1, 'MISIONES', 'SAN IGNACIO (MIS)', '3322', NULL, NULL);
INSERT INTO `localidades` VALUES(2791, 14, 1, 'MISIONES', 'SAN ISIDRO', '3300', NULL, NULL);
INSERT INTO `localidades` VALUES(2792, 14, 1, 'MISIONES', 'SAN JAVIER (MIS)', '3357', NULL, NULL);
INSERT INTO `localidades` VALUES(2793, 14, 1, 'MISIONES', 'SAN JOSE (MIS)', '3306', NULL, NULL);
INSERT INTO `localidades` VALUES(2794, 14, 1, 'MISIONES', 'SAN PEDRO (MIS)', '3364', NULL, NULL);
INSERT INTO `localidades` VALUES(2795, 14, 1, 'MISIONES', 'SAN VICENTE (MIS)', '3364', NULL, NULL);
INSERT INTO `localidades` VALUES(2796, 14, 1, 'MISIONES', 'SANTA ANA (MIS)', '3316', NULL, NULL);
INSERT INTO `localidades` VALUES(2797, 14, 1, 'MISIONES', 'SANTO PIPO', '3326', NULL, NULL);
INSERT INTO `localidades` VALUES(2798, 14, 1, 'MISIONES', 'TRES DE MAYO', '3334', NULL, NULL);
INSERT INTO `localidades` VALUES(2799, 14, 1, 'MISIONES', 'VILLA LANUS', '3304', NULL, NULL);
INSERT INTO `localidades` VALUES(2800, 15, 1, 'NEUQUEN', 'ALUMINE', '8345', NULL, NULL);
INSERT INTO `localidades` VALUES(2801, 15, 1, 'NEUQUEN', 'ANDACOLLO', '8354', NULL, NULL);
INSERT INTO `localidades` VALUES(2802, 15, 1, 'NEUQUEN', 'ARROYITO (NQN)', '8313', NULL, NULL);
INSERT INTO `localidades` VALUES(2803, 15, 1, 'NEUQUEN', 'AÑELO', '8312', NULL, NULL);
INSERT INTO `localidades` VALUES(2804, 15, 1, 'NEUQUEN', 'BAJADA DEL AGRIO', '8344', NULL, NULL);
INSERT INTO `localidades` VALUES(2805, 15, 1, 'NEUQUEN', 'BARRANCAS', '8356', NULL, NULL);
INSERT INTO `localidades` VALUES(2806, 15, 1, 'NEUQUEN', 'BUTA RANQUIL', '8357', NULL, NULL);
INSERT INTO `localidades` VALUES(2807, 15, 1, 'NEUQUEN', 'CAVIAHUE', '8346', NULL, NULL);
INSERT INTO `localidades` VALUES(2808, 15, 1, 'NEUQUEN', 'CENTENARIO (NQN)', '8309', NULL, NULL);
INSERT INTO `localidades` VALUES(2809, 15, 1, 'NEUQUEN', 'CHOS MALAL', '8353', NULL, NULL);
INSERT INTO `localidades` VALUES(2810, 15, 1, 'NEUQUEN', 'COLONIA VALENTINA', '8301', NULL, NULL);
INSERT INTO `localidades` VALUES(2811, 15, 1, 'NEUQUEN', 'COPAHUE', '8348', NULL, NULL);
INSERT INTO `localidades` VALUES(2812, 15, 1, 'NEUQUEN', 'COVUNCO', '8351', NULL, NULL);
INSERT INTO `localidades` VALUES(2813, 15, 1, 'NEUQUEN', 'CUTRAL CO', '8322', NULL, NULL);
INSERT INTO `localidades` VALUES(2814, 15, 1, 'NEUQUEN', 'EL CHOLAR', '8362', NULL, NULL);
INSERT INTO `localidades` VALUES(2815, 15, 1, 'NEUQUEN', 'EL HUECU', '8350', NULL, NULL);
INSERT INTO `localidades` VALUES(2816, 15, 1, 'NEUQUEN', 'HUINGANCO', '8365', NULL, NULL);
INSERT INTO `localidades` VALUES(2817, 15, 1, 'NEUQUEN', 'JUNIN DE LOS ANDES', '8371', NULL, NULL);
INSERT INTO `localidades` VALUES(2818, 15, 1, 'NEUQUEN', 'LA NEGRA', '8375', NULL, NULL);
INSERT INTO `localidades` VALUES(2819, 15, 1, 'NEUQUEN', 'LA PORTEÑA', '8347', NULL, NULL);
INSERT INTO `localidades` VALUES(2820, 15, 1, 'NEUQUEN', 'LA PRIMAVERA', '8353', NULL, NULL);
INSERT INTO `localidades` VALUES(2821, 15, 1, 'NEUQUEN', 'LA SALADA', '8353', NULL, NULL);
INSERT INTO `localidades` VALUES(2822, 15, 1, 'NEUQUEN', 'LAS COLORADAS', '8341', NULL, NULL);
INSERT INTO `localidades` VALUES(2823, 15, 1, 'NEUQUEN', 'LAS LAJAS', '8347', NULL, NULL);
INSERT INTO `localidades` VALUES(2824, 15, 1, 'NEUQUEN', 'LAS OVEJAS', '8355', NULL, NULL);
INSERT INTO `localidades` VALUES(2825, 15, 1, 'NEUQUEN', 'LONCOPUE', '8349', NULL, NULL);
INSERT INTO `localidades` VALUES(2826, 15, 1, 'NEUQUEN', 'MARIANO MORENO', '8352', NULL, NULL);
INSERT INTO `localidades` VALUES(2827, 15, 1, 'NEUQUEN', 'NAHUEL HUAPI', '8401', NULL, NULL);
INSERT INTO `localidades` VALUES(2828, 15, 1, 'NEUQUEN', 'NEUQUEN', '8300', NULL, NULL);
INSERT INTO `localidades` VALUES(2829, 15, 1, 'NEUQUEN', 'PICUN LEUFU', '8313', NULL, NULL);
INSERT INTO `localidades` VALUES(2830, 15, 1, 'NEUQUEN', 'PIEDRA DEL AGUILA', '8315', NULL, NULL);
INSERT INTO `localidades` VALUES(2831, 15, 1, 'NEUQUEN', 'PLAZA HUINCUL', '8318', NULL, NULL);
INSERT INTO `localidades` VALUES(2832, 15, 1, 'NEUQUEN', 'PLOTIER', '8316', NULL, NULL);
INSERT INTO `localidades` VALUES(2833, 15, 1, 'NEUQUEN', 'RINCON DE LOS SAUCES', '8319', NULL, NULL);
INSERT INTO `localidades` VALUES(2834, 15, 1, 'NEUQUEN', 'SAN M. DE LOS ANDES', '8370', NULL, NULL);
INSERT INTO `localidades` VALUES(2835, 15, 1, 'NEUQUEN', 'SAN PATRICIO DEL CHAÑAR', '8306', NULL, NULL);
INSERT INTO `localidades` VALUES(2836, 15, 1, 'NEUQUEN', 'SAN PATRICIO DEL CHAÑAR', '8305', NULL, NULL);
INSERT INTO `localidades` VALUES(2837, 15, 1, 'NEUQUEN', 'SENILLOSA', '8316', NULL, NULL);
INSERT INTO `localidades` VALUES(2838, 15, 1, 'NEUQUEN', 'TAQUIMILAN', '8342', NULL, NULL);
INSERT INTO `localidades` VALUES(2839, 15, 1, 'NEUQUEN', 'TRAFUL', '8408', NULL, NULL);
INSERT INTO `localidades` VALUES(2840, 15, 1, 'NEUQUEN', 'TRICAO MALAL', '8358', NULL, NULL);
INSERT INTO `localidades` VALUES(2841, 15, 1, 'NEUQUEN', 'VARVARCO', '8359', NULL, NULL);
INSERT INTO `localidades` VALUES(2842, 15, 1, 'NEUQUEN', 'VILLA EL CHOCON', '8311', NULL, NULL);
INSERT INTO `localidades` VALUES(2843, 15, 1, 'NEUQUEN', 'VILLA LA ANGOSTURA', '8407', NULL, NULL);
INSERT INTO `localidades` VALUES(2844, 15, 1, 'NEUQUEN', 'VILLA PEHUENIA', '8345', NULL, NULL);
INSERT INTO `localidades` VALUES(2845, 15, 1, 'NEUQUEN', 'VISTA ALEGRE NORTE', '8314', NULL, NULL);
INSERT INTO `localidades` VALUES(2846, 15, 1, 'NEUQUEN', 'VISTA ALEGRE SUR', '8317', NULL, NULL);
INSERT INTO `localidades` VALUES(2847, 15, 1, 'NEUQUEN', 'ZAPALA (NQN)', '8340', NULL, NULL);
INSERT INTO `localidades` VALUES(2848, 15, 1, 'NEUQUEN', 'ÑORQUINCO', '8353', NULL, NULL);
INSERT INTO `localidades` VALUES(2849, 16, 1, 'RIO NEGRO', 'AGUADA CECILIO', '8534', NULL, NULL);
INSERT INTO `localidades` VALUES(2850, 16, 1, 'RIO NEGRO', 'AGUADA DE GUERRA', '8424', NULL, NULL);
INSERT INTO `localidades` VALUES(2851, 16, 1, 'RIO NEGRO', 'ALLEN', '8328', NULL, NULL);
INSERT INTO `localidades` VALUES(2852, 16, 1, 'RIO NEGRO', 'BALNEARIO EL CONDOR', '8501', NULL, NULL);
INSERT INTO `localidades` VALUES(2853, 16, 1, 'RIO NEGRO', 'BALSA LAS PERLAS', '8316', NULL, NULL);
INSERT INTO `localidades` VALUES(2854, 16, 1, 'RIO NEGRO', 'BARDA DEL MEDIO', '8305', NULL, NULL);
INSERT INTO `localidades` VALUES(2855, 16, 1, 'RIO NEGRO', 'BELISLE', '8368', NULL, NULL);
INSERT INTO `localidades` VALUES(2856, 16, 1, 'RIO NEGRO', 'CATRIEL', '8307', NULL, NULL);
INSERT INTO `localidades` VALUES(2857, 16, 1, 'RIO NEGRO', 'CERVANTES', '8326', NULL, NULL);
INSERT INTO `localidades` VALUES(2858, 16, 1, 'RIO NEGRO', 'CHELFORO', '8336', NULL, NULL);
INSERT INTO `localidades` VALUES(2859, 16, 1, 'RIO NEGRO', 'CHICHINALES', '8337', NULL, NULL);
INSERT INTO `localidades` VALUES(2860, 16, 1, 'RIO NEGRO', 'CHIMPAY', '8364', NULL, NULL);
INSERT INTO `localidades` VALUES(2861, 16, 1, 'RIO NEGRO', 'CHOELE CHOEL', '8360', NULL, NULL);
INSERT INTO `localidades` VALUES(2862, 16, 1, 'RIO NEGRO', 'CINCO SALTOS', '8303', NULL, NULL);
INSERT INTO `localidades` VALUES(2863, 16, 1, 'RIO NEGRO', 'CIPOLLETTI', '8324', NULL, NULL);
INSERT INTO `localidades` VALUES(2864, 16, 1, 'RIO NEGRO', 'CLEMENTE ONELLI', '8416', NULL, NULL);
INSERT INTO `localidades` VALUES(2865, 16, 1, 'RIO NEGRO', 'CLEMENTE ONELLI', '8505', NULL, NULL);
INSERT INTO `localidades` VALUES(2866, 16, 1, 'RIO NEGRO', 'CNEL.J.J.GOMEZ', '8331', NULL, NULL);
INSERT INTO `localidades` VALUES(2867, 16, 1, 'RIO NEGRO', 'COMALLO', '8416', NULL, NULL);
INSERT INTO `localidades` VALUES(2868, 16, 1, 'RIO NEGRO', 'CONTRALMIRANTE CORDERO', '8301', NULL, NULL);
INSERT INTO `localidades` VALUES(2869, 16, 1, 'RIO NEGRO', 'CORONEL BELISLE', '8364', NULL, NULL);
INSERT INTO `localidades` VALUES(2870, 16, 1, 'RIO NEGRO', 'CTE. MARTIN GUERRICO', '8328', NULL, NULL);
INSERT INTO `localidades` VALUES(2871, 16, 1, 'RIO NEGRO', 'DARWIN', '8367', NULL, NULL);
INSERT INTO `localidades` VALUES(2872, 16, 1, 'RIO NEGRO', 'DARWIN', '8369', NULL, NULL);
INSERT INTO `localidades` VALUES(2873, 16, 1, 'RIO NEGRO', 'DINA HUAPI', '8402', NULL, NULL);
INSERT INTO `localidades` VALUES(2874, 16, 1, 'RIO NEGRO', 'DINA HUAPI', '8406', NULL, NULL);
INSERT INTO `localidades` VALUES(2875, 16, 1, 'RIO NEGRO', 'EL BOLSON (RIO NEGRO', '8430', NULL, NULL);
INSERT INTO `localidades` VALUES(2876, 16, 1, 'RIO NEGRO', 'EL CUY', '8329', NULL, NULL);
INSERT INTO `localidades` VALUES(2877, 16, 1, 'RIO NEGRO', 'FERRI', '8130', NULL, NULL);
INSERT INTO `localidades` VALUES(2878, 16, 1, 'RIO NEGRO', 'GENERAL CONESA', '8503', NULL, NULL);
INSERT INTO `localidades` VALUES(2879, 16, 1, 'RIO NEGRO', 'GENERAL ROCA R.NEGRO', '8332', NULL, NULL);
INSERT INTO `localidades` VALUES(2880, 16, 1, 'RIO NEGRO', 'GODOY', '8338', NULL, NULL);
INSERT INTO `localidades` VALUES(2881, 16, 1, 'RIO NEGRO', 'GRAL.FERNANDEZ ORO', '8325', NULL, NULL);
INSERT INTO `localidades` VALUES(2882, 16, 1, 'RIO NEGRO', 'GUARDIA MITRE', '8534', NULL, NULL);
INSERT INTO `localidades` VALUES(2883, 16, 1, 'RIO NEGRO', 'GUERRICO', '8336', NULL, NULL);
INSERT INTO `localidades` VALUES(2884, 16, 1, 'RIO NEGRO', 'ING.L.A.HUERGO', '8334', NULL, NULL);
INSERT INTO `localidades` VALUES(2885, 16, 1, 'RIO NEGRO', 'INGENIERO JACOBACCI', '8418', NULL, NULL);
INSERT INTO `localidades` VALUES(2886, 16, 1, 'RIO NEGRO', 'LA PORTEÑA', '8417', NULL, NULL);
INSERT INTO `localidades` VALUES(2887, 16, 1, 'RIO NEGRO', 'LA PRIMAVERA', '8520', NULL, NULL);
INSERT INTO `localidades` VALUES(2888, 16, 1, 'RIO NEGRO', 'LAMARQUE', '8363', NULL, NULL);
INSERT INTO `localidades` VALUES(2889, 16, 1, 'RIO NEGRO', 'LAS GRUTAS', '8520', NULL, NULL);
INSERT INTO `localidades` VALUES(2890, 16, 1, 'RIO NEGRO', 'LLAO LLAO', '8409', NULL, NULL);
INSERT INTO `localidades` VALUES(2891, 16, 1, 'RIO NEGRO', 'LOS MENUCOS', '8424', NULL, NULL);
INSERT INTO `localidades` VALUES(2892, 16, 1, 'RIO NEGRO', 'LUIS BELTRAN (R.N)', '8361', NULL, NULL);
INSERT INTO `localidades` VALUES(2893, 16, 1, 'RIO NEGRO', 'MAINQUE', '8327', NULL, NULL);
INSERT INTO `localidades` VALUES(2894, 16, 1, 'RIO NEGRO', 'MAQUINCHAO', '8422', NULL, NULL);
INSERT INTO `localidades` VALUES(2895, 16, 1, 'RIO NEGRO', 'NAHUEL NIYEU', '8534', NULL, NULL);
INSERT INTO `localidades` VALUES(2896, 16, 1, 'RIO NEGRO', 'PADRE A. STEFENELLI', '8335', NULL, NULL);
INSERT INTO `localidades` VALUES(2897, 16, 1, 'RIO NEGRO', 'PERITO MORENO (RIO N', '8416', NULL, NULL);
INSERT INTO `localidades` VALUES(2898, 16, 1, 'RIO NEGRO', 'PILCANIYEU', '8412', NULL, NULL);
INSERT INTO `localidades` VALUES(2899, 16, 1, 'RIO NEGRO', 'POMONA', '8363', NULL, NULL);
INSERT INTO `localidades` VALUES(2900, 16, 1, 'RIO NEGRO', 'POMONA', '8367', NULL, NULL);
INSERT INTO `localidades` VALUES(2901, 16, 1, 'RIO NEGRO', 'RAMOS MEXIA', '8534', NULL, NULL);
INSERT INTO `localidades` VALUES(2902, 16, 1, 'RIO NEGRO', 'RIO COLORADO RIO NEG', '8138', NULL, NULL);
INSERT INTO `localidades` VALUES(2903, 16, 1, 'RIO NEGRO', 'SAN ANTONIO OESTE', '8520', NULL, NULL);
INSERT INTO `localidades` VALUES(2904, 16, 1, 'RIO NEGRO', 'SAN C. DE BARILOCHE', '8400', NULL, NULL);
INSERT INTO `localidades` VALUES(2905, 16, 1, 'RIO NEGRO', 'SARGENTO VIDAL', '8310', NULL, NULL);
INSERT INTO `localidades` VALUES(2906, 16, 1, 'RIO NEGRO', 'SIERRA COLORADA', '8534', NULL, NULL);
INSERT INTO `localidades` VALUES(2907, 16, 1, 'RIO NEGRO', 'SIERRA GRANDE', '8532', NULL, NULL);
INSERT INTO `localidades` VALUES(2908, 16, 1, 'RIO NEGRO', 'VALCHETA', '8536', NULL, NULL);
INSERT INTO `localidades` VALUES(2909, 16, 1, 'RIO NEGRO', 'VALLE AZUL', '8336', NULL, NULL);
INSERT INTO `localidades` VALUES(2910, 16, 1, 'RIO NEGRO', 'VIEDMA', '8500', NULL, NULL);
INSERT INTO `localidades` VALUES(2911, 16, 1, 'RIO NEGRO', 'VILLA EL MANZANO', '8308', NULL, NULL);
INSERT INTO `localidades` VALUES(2912, 16, 1, 'RIO NEGRO', 'VILLA MASCARDI', '8401', NULL, NULL);
INSERT INTO `localidades` VALUES(2913, 16, 1, 'RIO NEGRO', 'VILLA REGINA', '8336', NULL, NULL);
INSERT INTO `localidades` VALUES(2914, 16, 1, 'RIO NEGRO', 'ÑORQUINCO', '8415', NULL, NULL);
INSERT INTO `localidades` VALUES(2915, 17, 1, 'SALTA', 'AGUARAY', '4566', NULL, NULL);
INSERT INTO `localidades` VALUES(2916, 17, 1, 'SALTA', 'AGUAS BLANCAS', '4531', NULL, NULL);
INSERT INTO `localidades` VALUES(2917, 17, 1, 'SALTA', 'ANGASTACO', '4427', NULL, NULL);
INSERT INTO `localidades` VALUES(2918, 17, 1, 'SALTA', 'ANIMANA', '4427', NULL, NULL);
INSERT INTO `localidades` VALUES(2919, 17, 1, 'SALTA', 'APOLINARIO SARAVIA', '4449', NULL, NULL);
INSERT INTO `localidades` VALUES(2920, 17, 1, 'SALTA', 'CACHI', '4417', NULL, NULL);
INSERT INTO `localidades` VALUES(2921, 17, 1, 'SALTA', 'CAFAYATE', '4427', NULL, NULL);
INSERT INTO `localidades` VALUES(2922, 17, 1, 'SALTA', 'CAMPAMENTO VESPUCIO', '4563', NULL, NULL);
INSERT INTO `localidades` VALUES(2923, 17, 1, 'SALTA', 'CAMPO DURAN', '4566', NULL, NULL);
INSERT INTO `localidades` VALUES(2924, 17, 1, 'SALTA', 'CAMPO QUIJANO', '4407', NULL, NULL);
INSERT INTO `localidades` VALUES(2925, 17, 1, 'SALTA', 'CAMPO SANTO', '4432', NULL, NULL);
INSERT INTO `localidades` VALUES(2926, 17, 1, 'SALTA', 'CERRILLOS', '4403', NULL, NULL);
INSERT INTO `localidades` VALUES(2927, 17, 1, 'SALTA', 'CHICOANA', '4423', NULL, NULL);
INSERT INTO `localidades` VALUES(2928, 17, 1, 'SALTA', 'COBOS', '4432', NULL, NULL);
INSERT INTO `localidades` VALUES(2929, 17, 1, 'SALTA', 'COLONIA SANTA ROSA', '4531', NULL, NULL);
INSERT INTO `localidades` VALUES(2930, 17, 1, 'SALTA', 'CORONEL MOLDES SALTA', '4421', NULL, NULL);
INSERT INTO `localidades` VALUES(2931, 17, 1, 'SALTA', 'EL BORDO', '4432', NULL, NULL);
INSERT INTO `localidades` VALUES(2932, 17, 1, 'SALTA', 'EL CARRIL', '4421', NULL, NULL);
INSERT INTO `localidades` VALUES(2933, 17, 1, 'SALTA', 'EL GALPON', '4444', NULL, NULL);
INSERT INTO `localidades` VALUES(2934, 17, 1, 'SALTA', 'EL POTRERO (DTO ROSARIO DE LA FRON)', '4193', NULL, NULL);
INSERT INTO `localidades` VALUES(2935, 17, 1, 'SALTA', 'EL QUEBRACHAL (SALTA', '4452', NULL, NULL);
INSERT INTO `localidades` VALUES(2936, 17, 1, 'SALTA', 'EL TABACAL (ORAN)', '4533', NULL, NULL);
INSERT INTO `localidades` VALUES(2937, 17, 1, 'SALTA', 'EL TUNAL', '4446', NULL, NULL);
INSERT INTO `localidades` VALUES(2938, 17, 1, 'SALTA', 'EMBARCACION', '4550', NULL, NULL);
INSERT INTO `localidades` VALUES(2939, 17, 1, 'SALTA', 'GENERAL GÜEMES', '4430', NULL, NULL);
INSERT INTO `localidades` VALUES(2940, 17, 1, 'SALTA', 'GENERAL MOSCONI', '4562', NULL, NULL);
INSERT INTO `localidades` VALUES(2941, 17, 1, 'SALTA', 'JOAQUIN V. GONZALEZ', '4448', NULL, NULL);
INSERT INTO `localidades` VALUES(2942, 17, 1, 'SALTA', 'LA MAROMA', '4423', NULL, NULL);
INSERT INTO `localidades` VALUES(2943, 17, 1, 'SALTA', 'LA MERCED (SALTA)', '4421', NULL, NULL);
INSERT INTO `localidades` VALUES(2944, 17, 1, 'SALTA', 'LA SILLETA', '4407', NULL, NULL);
INSERT INTO `localidades` VALUES(2945, 17, 1, 'SALTA', 'LA TABLADA', '4535', NULL, NULL);
INSERT INTO `localidades` VALUES(2946, 17, 1, 'SALTA', 'LA VIÑA (SALTA)', '4425', NULL, NULL);
INSERT INTO `localidades` VALUES(2947, 17, 1, 'SALTA', 'LAS FLORES', '4449', NULL, NULL);
INSERT INTO `localidades` VALUES(2948, 17, 1, 'SALTA', 'LAS LAJITAS', '4449', NULL, NULL);
INSERT INTO `localidades` VALUES(2949, 17, 1, 'SALTA', 'METAN', '4440', NULL, NULL);
INSERT INTO `localidades` VALUES(2950, 17, 1, 'SALTA', 'METAN VIEJO', '4441', NULL, NULL);
INSERT INTO `localidades` VALUES(2951, 17, 1, 'SALTA', 'MOLINOS', '4419', NULL, NULL);
INSERT INTO `localidades` VALUES(2952, 17, 1, 'SALTA', 'ORAN', '4530', NULL, NULL);
INSERT INTO `localidades` VALUES(2953, 17, 1, 'SALTA', 'PICHANAL', '4534', NULL, NULL);
INSERT INTO `localidades` VALUES(2954, 17, 1, 'SALTA', 'RIO DE LAS PIEDRAS', '4434', NULL, NULL);
INSERT INTO `localidades` VALUES(2955, 17, 1, 'SALTA', 'ROS. DE LA FRONTERA', '4198', NULL, NULL);
INSERT INTO `localidades` VALUES(2956, 17, 1, 'SALTA', 'ROSARIO DE LERMA', '4405', NULL, NULL);
INSERT INTO `localidades` VALUES(2957, 17, 1, 'SALTA', 'S.A. DE LOS COBRES', '4411', NULL, NULL);
INSERT INTO `localidades` VALUES(2958, 17, 1, 'SALTA', 'SALTA', '4400', NULL, NULL);
INSERT INTO `localidades` VALUES(2959, 17, 1, 'SALTA', 'SALVADOR MAZA-POCITO', '4568', NULL, NULL);
INSERT INTO `localidades` VALUES(2960, 17, 1, 'SALTA', 'SAN CARLOS (SALTA)', '4427', NULL, NULL);
INSERT INTO `localidades` VALUES(2961, 17, 1, 'SALTA', 'SAN LUIS (SALTA)', '4449', NULL, NULL);
INSERT INTO `localidades` VALUES(2962, 17, 1, 'SALTA', 'TALAPAMPA', '4425', NULL, NULL);
INSERT INTO `localidades` VALUES(2963, 17, 1, 'SALTA', 'TARTAGAL (SAL)', '4560', NULL, NULL);
INSERT INTO `localidades` VALUES(2964, 17, 1, 'SALTA', 'VAQUEROS', '4401', NULL, NULL);
INSERT INTO `localidades` VALUES(2965, 17, 1, 'SALTA', 'VILLA SAN LORENZO (SALTA)', '4401', NULL, NULL);
INSERT INTO `localidades` VALUES(2966, 17, 1, 'SALTA', 'YATASTO', '4440', NULL, NULL);
INSERT INTO `localidades` VALUES(2967, 18, 1, 'SAN JUAN', '25 DE MAYO (SAN JUAN', '5443', NULL, NULL);
INSERT INTO `localidades` VALUES(2968, 18, 1, 'SAN JUAN', '9 DE JULIO (SAN JUAN', '5417', NULL, NULL);
INSERT INTO `localidades` VALUES(2969, 18, 1, 'SAN JUAN', 'ALAMITO', '5415', NULL, NULL);
INSERT INTO `localidades` VALUES(2970, 18, 1, 'SAN JUAN', 'ALBARDON', '5419', NULL, NULL);
INSERT INTO `localidades` VALUES(2971, 18, 1, 'SAN JUAN', 'ALTO DE SIERRA', '5438', NULL, NULL);
INSERT INTO `localidades` VALUES(2972, 18, 1, 'SAN JUAN', 'ANGACO', '5415', NULL, NULL);
INSERT INTO `localidades` VALUES(2973, 18, 1, 'SAN JUAN', 'ANGUALASTO', '5467', NULL, NULL);
INSERT INTO `localidades` VALUES(2974, 18, 1, 'SAN JUAN', 'ASTICA', '5447', NULL, NULL);
INSERT INTO `localidades` VALUES(2975, 18, 1, 'SAN JUAN', 'BARREAL', '5405', NULL, NULL);
INSERT INTO `localidades` VALUES(2976, 18, 1, 'SAN JUAN', 'BAÑOS DE LA LAJA', '5419', NULL, NULL);
INSERT INTO `localidades` VALUES(2977, 18, 1, 'SAN JUAN', 'BAÑOS PISMANTA', '5465', NULL, NULL);
INSERT INTO `localidades` VALUES(2978, 18, 1, 'SAN JUAN', 'BELLA VISTA (SJN)', '5403', NULL, NULL);
INSERT INTO `localidades` VALUES(2979, 18, 1, 'SAN JUAN', 'CALINGASTA', '5403', NULL, NULL);
INSERT INTO `localidades` VALUES(2980, 18, 1, 'SAN JUAN', 'CAMPO AFUERA', '5419', NULL, NULL);
INSERT INTO `localidades` VALUES(2981, 18, 1, 'SAN JUAN', 'CARPINTERIA (SJN)', '5435', NULL, NULL);
INSERT INTO `localidades` VALUES(2982, 18, 1, 'SAN JUAN', 'CAUCETE', '5442', NULL, NULL);
INSERT INTO `localidades` VALUES(2983, 18, 1, 'SAN JUAN', 'CHIMBAS', '5413', NULL, NULL);
INSERT INTO `localidades` VALUES(2984, 18, 1, 'SAN JUAN', 'COCHAGUAL', '5435', NULL, NULL);
INSERT INTO `localidades` VALUES(2985, 18, 1, 'SAN JUAN', 'CONCEPCION (SJN)', '5400', NULL, NULL);
INSERT INTO `localidades` VALUES(2986, 18, 1, 'SAN JUAN', 'DESAMPARADOS', '5400', NULL, NULL);
INSERT INTO `localidades` VALUES(2987, 18, 1, 'SAN JUAN', 'DIVISADERO', '5431', NULL, NULL);
INSERT INTO `localidades` VALUES(2988, 18, 1, 'SAN JUAN', 'DOS ACEQUIAS', '5439', NULL, NULL);
INSERT INTO `localidades` VALUES(2989, 18, 1, 'SAN JUAN', 'EL BOSQUE', '5415', NULL, NULL);
INSERT INTO `localidades` VALUES(2990, 18, 1, 'SAN JUAN', 'EL MOGOTE', '5413', NULL, NULL);
INSERT INTO `localidades` VALUES(2991, 18, 1, 'SAN JUAN', 'EL RINCON', '5443', NULL, NULL);
INSERT INTO `localidades` VALUES(2992, 18, 1, 'SAN JUAN', 'GRAN CHINA', '5461', NULL, NULL);
INSERT INTO `localidades` VALUES(2993, 18, 1, 'SAN JUAN', 'HUACO (SJN)', '5463', NULL, NULL);
INSERT INTO `localidades` VALUES(2994, 18, 1, 'SAN JUAN', 'IGLESIA', '5467', NULL, NULL);
INSERT INTO `localidades` VALUES(2995, 18, 1, 'SAN JUAN', 'JACHAL', '5460', NULL, NULL);
INSERT INTO `localidades` VALUES(2996, 18, 1, 'SAN JUAN', 'LA ORILLA', '5425', NULL, NULL);
INSERT INTO `localidades` VALUES(2997, 18, 1, 'SAN JUAN', 'LA PUNTILLA (SJN)', '5442', NULL, NULL);
INSERT INTO `localidades` VALUES(2998, 18, 1, 'SAN JUAN', 'LAS CASUARINAS', '5443', NULL, NULL);
INSERT INTO `localidades` VALUES(2999, 18, 1, 'SAN JUAN', 'LAS FLORES (SJN)', '5467', NULL, NULL);
INSERT INTO `localidades` VALUES(3000, 18, 1, 'SAN JUAN', 'LAS LOMITAS (SJN)', '5419', NULL, NULL);
INSERT INTO `localidades` VALUES(3001, 18, 1, 'SAN JUAN', 'LAS TAPIAS', '5415', NULL, NULL);
INSERT INTO `localidades` VALUES(3002, 18, 1, 'SAN JUAN', 'LAS TAPIAS (SJN)', '5419', NULL, NULL);
INSERT INTO `localidades` VALUES(3003, 18, 1, 'SAN JUAN', 'LOS BERROS DE ABAJO', '5431', NULL, NULL);
INSERT INTO `localidades` VALUES(3004, 18, 1, 'SAN JUAN', 'MARAYES', '5446', NULL, NULL);
INSERT INTO `localidades` VALUES(3005, 18, 1, 'SAN JUAN', 'MARQUESADO', '5407', NULL, NULL);
INSERT INTO `localidades` VALUES(3006, 18, 1, 'SAN JUAN', 'MEDANO DE ORO', '5421', NULL, NULL);
INSERT INTO `localidades` VALUES(3007, 18, 1, 'SAN JUAN', 'MEDIA AGUA', '5435', NULL, NULL);
INSERT INTO `localidades` VALUES(3008, 18, 1, 'SAN JUAN', 'NIQUIVIL', '5409', NULL, NULL);
INSERT INTO `localidades` VALUES(3009, 18, 1, 'SAN JUAN', 'PEDERNAL', '5431', NULL, NULL);
INSERT INTO `localidades` VALUES(3010, 18, 1, 'SAN JUAN', 'PIE DE PALO', '5444', NULL, NULL);
INSERT INTO `localidades` VALUES(3011, 18, 1, 'SAN JUAN', 'POCITO', '5427', NULL, NULL);
INSERT INTO `localidades` VALUES(3012, 18, 1, 'SAN JUAN', 'PUNTA DEL MONTE', '5415', NULL, NULL);
INSERT INTO `localidades` VALUES(3013, 18, 1, 'SAN JUAN', 'RAWSON (SJN)', '5423', NULL, NULL);
INSERT INTO `localidades` VALUES(3014, 18, 1, 'SAN JUAN', 'RIVADAVIA (SJN)', '5400', NULL, NULL);
INSERT INTO `localidades` VALUES(3015, 18, 1, 'SAN JUAN', 'RODEO', '5465', NULL, NULL);
INSERT INTO `localidades` VALUES(3016, 18, 1, 'SAN JUAN', 'S.ANTONIO (V.FERTIL)', '5449', NULL, NULL);
INSERT INTO `localidades` VALUES(3017, 18, 1, 'SAN JUAN', 'SAN ISIDRO (SJN)', '5461', NULL, NULL);
INSERT INTO `localidades` VALUES(3018, 18, 1, 'SAN JUAN', 'SAN JOSE DE JACHAL', '5460', NULL, NULL);
INSERT INTO `localidades` VALUES(3019, 18, 1, 'SAN JUAN', 'SAN JUAN', '5400', NULL, NULL);
INSERT INTO `localidades` VALUES(3020, 18, 1, 'SAN JUAN', 'SAN MARTIN (SJN)', '5439', NULL, NULL);
INSERT INTO `localidades` VALUES(3021, 18, 1, 'SAN JUAN', 'SAN ROQUE (SJN)', '5409', NULL, NULL);
INSERT INTO `localidades` VALUES(3022, 18, 1, 'SAN JUAN', 'SANTA LUCIA (SJN)', '5411', NULL, NULL);
INSERT INTO `localidades` VALUES(3023, 18, 1, 'SAN JUAN', 'SARMIENTO (SJN)', '5435', NULL, NULL);
INSERT INTO `localidades` VALUES(3024, 18, 1, 'SAN JUAN', 'TAMBERIAS', '5401', NULL, NULL);
INSERT INTO `localidades` VALUES(3025, 18, 1, 'SAN JUAN', 'TRINIDAD', '5400', NULL, NULL);
INSERT INTO `localidades` VALUES(3026, 18, 1, 'SAN JUAN', 'TUDCUM', '5467', NULL, NULL);
INSERT INTO `localidades` VALUES(3027, 18, 1, 'SAN JUAN', 'ULLUM', '5409', NULL, NULL);
INSERT INTO `localidades` VALUES(3028, 18, 1, 'SAN JUAN', 'VALLE FERTIL', '5449', NULL, NULL);
INSERT INTO `localidades` VALUES(3029, 18, 1, 'SAN JUAN', 'VILLA ABERASTAIN', '5427', NULL, NULL);
INSERT INTO `localidades` VALUES(3030, 18, 1, 'SAN JUAN', 'VILLA BASILIO NIEVAS', '5401', NULL, NULL);
INSERT INTO `localidades` VALUES(3031, 18, 1, 'SAN JUAN', 'VILLA DOMINGUITO', '5439', NULL, NULL);
INSERT INTO `localidades` VALUES(3032, 18, 1, 'SAN JUAN', 'VILLA EL SALVADOR', '5415', NULL, NULL);
INSERT INTO `localidades` VALUES(3033, 18, 1, 'SAN JUAN', 'VILLA KRAUSE', '5425', NULL, NULL);
INSERT INTO `localidades` VALUES(3034, 18, 1, 'SAN JUAN', 'VILLA LUGANO', '5439', NULL, NULL);
INSERT INTO `localidades` VALUES(3035, 18, 1, 'SAN JUAN', 'VILLA MERCEDES (SJN)', '5461', NULL, NULL);
INSERT INTO `localidades` VALUES(3036, 18, 1, 'SAN JUAN', 'VILLA SAN ISIDRO SJN', '5415', NULL, NULL);
INSERT INTO `localidades` VALUES(3037, 18, 1, 'SAN JUAN', 'VILLA SANTA ROSA', '5443', NULL, NULL);
INSERT INTO `localidades` VALUES(3038, 18, 1, 'SAN JUAN', 'ZONDA (SJN)', '5401', NULL, NULL);
INSERT INTO `localidades` VALUES(3039, 19, 1, 'SAN LUIS', 'ANCHORENA', '6389', NULL, NULL);
INSERT INTO `localidades` VALUES(3040, 19, 1, 'SAN LUIS', 'ARIZONA', '6389', NULL, NULL);
INSERT INTO `localidades` VALUES(3041, 19, 1, 'SAN LUIS', 'BAGUAL', '6216', NULL, NULL);
INSERT INTO `localidades` VALUES(3042, 19, 1, 'SAN LUIS', 'BETANIA', '6279', NULL, NULL);
INSERT INTO `localidades` VALUES(3043, 19, 1, 'SAN LUIS', 'BUENA ESPERANZA', '6277', NULL, NULL);
INSERT INTO `localidades` VALUES(3044, 19, 1, 'SAN LUIS', 'CANDELARIA (SL)', '5713', NULL, NULL);
INSERT INTO `localidades` VALUES(3045, 19, 1, 'SAN LUIS', 'CARPINTERIA SAN LUIS', '5883', NULL, NULL);
INSERT INTO `localidades` VALUES(3046, 19, 1, 'SAN LUIS', 'CAÑADA DE LA NEGRA (ZONA S R CONLAR', '5777', NULL, NULL);
INSERT INTO `localidades` VALUES(3047, 19, 1, 'SAN LUIS', 'CAÑADA LA NEGRA (ZONA MERLO)', '5881', NULL, NULL);
INSERT INTO `localidades` VALUES(3048, 19, 1, 'SAN LUIS', 'CONCARAN', '5770', NULL, NULL);
INSERT INTO `localidades` VALUES(3049, 19, 1, 'SAN LUIS', 'CORTADERAS -SAN LUIS', '5883', NULL, NULL);
INSERT INTO `localidades` VALUES(3050, 19, 1, 'SAN LUIS', 'FCO.DEL MONTE DE ORO', '5707', NULL, NULL);
INSERT INTO `localidades` VALUES(3051, 19, 1, 'SAN LUIS', 'FORTIN EL PATRIA', '6279', NULL, NULL);
INSERT INTO `localidades` VALUES(3052, 19, 1, 'SAN LUIS', 'FORTUNA', '6216', NULL, NULL);
INSERT INTO `localidades` VALUES(3053, 19, 1, 'SAN LUIS', 'JUSTO DARACT', '5738', NULL, NULL);
INSERT INTO `localidades` VALUES(3054, 19, 1, 'SAN LUIS', 'LA MASCOTA (FORTUNA, GDOR V DUPUY)', '5216', NULL, NULL);
INSERT INTO `localidades` VALUES(3055, 19, 1, 'SAN LUIS', 'LA MASCOTA (JUSTO DARACT, DO PEDERN', '5738', NULL, NULL);
INSERT INTO `localidades` VALUES(3056, 19, 1, 'SAN LUIS', 'LA NEGRA (ZONA VILLA MERCEDES)', '5730', NULL, NULL);
INSERT INTO `localidades` VALUES(3057, 19, 1, 'SAN LUIS', 'LA NEGRITA', '5731', NULL, NULL);
INSERT INTO `localidades` VALUES(3058, 19, 1, 'SAN LUIS', 'LA PRIMAVERA', '5719', NULL, NULL);
INSERT INTO `localidades` VALUES(3059, 19, 1, 'SAN LUIS', 'LA PRIMAVERA (MERCEDES, DTO PEDERNE', '5730', NULL, NULL);
INSERT INTO `localidades` VALUES(3060, 19, 1, 'SAN LUIS', 'LA RAMADA - SAN LUIS', '5881', NULL, NULL);
INSERT INTO `localidades` VALUES(3061, 19, 1, 'SAN LUIS', 'LA REFORMA', '5724', NULL, NULL);
INSERT INTO `localidades` VALUES(3062, 19, 1, 'SAN LUIS', 'LA TOMA (SAN LUIS)', '5750', NULL, NULL);
INSERT INTO `localidades` VALUES(3063, 19, 1, 'SAN LUIS', 'LAFINUR', '5871', NULL, NULL);
INSERT INTO `localidades` VALUES(3064, 19, 1, 'SAN LUIS', 'LAS CANTERAS', '5759', NULL, NULL);
INSERT INTO `localidades` VALUES(3065, 19, 1, 'SAN LUIS', 'LAS FLORES (LA TOMA, DTO PRINGLES)', '5750', NULL, NULL);
INSERT INTO `localidades` VALUES(3066, 19, 1, 'SAN LUIS', 'LAS FLORES (PASO GRANDE, D S MARTIN', '5753', NULL, NULL);
INSERT INTO `localidades` VALUES(3067, 19, 1, 'SAN LUIS', 'LEANDRO N. ALEM (SLU', '5703', NULL, NULL);
INSERT INTO `localidades` VALUES(3068, 19, 1, 'SAN LUIS', 'LOS CAJONES', '5871', NULL, NULL);
INSERT INTO `localidades` VALUES(3069, 19, 1, 'SAN LUIS', 'LOS MOLLES (SAN LUIS', '5703', NULL, NULL);
INSERT INTO `localidades` VALUES(3070, 19, 1, 'SAN LUIS', 'LUJAN (SAN LUIS)', '5709', NULL, NULL);
INSERT INTO `localidades` VALUES(3071, 19, 1, 'SAN LUIS', 'MARTIN DE LOYOLA', '6216', NULL, NULL);
INSERT INTO `localidades` VALUES(3072, 19, 1, 'SAN LUIS', 'MERLO (SAN LUIS)', '5881', NULL, NULL);
INSERT INTO `localidades` VALUES(3073, 19, 1, 'SAN LUIS', 'NAHEL MAPA', '6279', NULL, NULL);
INSERT INTO `localidades` VALUES(3074, 19, 1, 'SAN LUIS', 'NASCHEL', '5759', NULL, NULL);
INSERT INTO `localidades` VALUES(3075, 19, 1, 'SAN LUIS', 'NUEVA GALIA', '6216', NULL, NULL);
INSERT INTO `localidades` VALUES(3076, 19, 1, 'SAN LUIS', 'PAPAGAYOS', '5883', NULL, NULL);
INSERT INTO `localidades` VALUES(3077, 19, 1, 'SAN LUIS', 'QUINES', '5711', NULL, NULL);
INSERT INTO `localidades` VALUES(3078, 19, 1, 'SAN LUIS', 'SALADILLO (SAN LUIS)', '5751', NULL, NULL);
INSERT INTO `localidades` VALUES(3079, 19, 1, 'SAN LUIS', 'SAN LUIS (SAN LUIS)', '5700', NULL, NULL);
INSERT INTO `localidades` VALUES(3080, 19, 1, 'SAN LUIS', 'STA.ROSA DE CONLARA', '5777', NULL, NULL);
INSERT INTO `localidades` VALUES(3081, 19, 1, 'SAN LUIS', 'TILISARAO', '5773', NULL, NULL);
INSERT INTO `localidades` VALUES(3082, 19, 1, 'SAN LUIS', 'UNION', '6216', NULL, NULL);
INSERT INTO `localidades` VALUES(3083, 19, 1, 'SAN LUIS', 'VILLA DEL CARMEN (SL', '5835', NULL, NULL);
INSERT INTO `localidades` VALUES(3084, 19, 1, 'SAN LUIS', 'VILLA LARCA', '5883', NULL, NULL);
INSERT INTO `localidades` VALUES(3085, 19, 1, 'SAN LUIS', 'VILLA MERCEDES (SLU)', '5730', NULL, NULL);
INSERT INTO `localidades` VALUES(3086, 20, 1, 'SANTA CRUZ', '28 DE NOVIEMBRE', '9407', NULL, NULL);
INSERT INTO `localidades` VALUES(3087, 20, 1, 'SANTA CRUZ', 'ALTO RIO SENGUER', '9033', NULL, NULL);
INSERT INTO `localidades` VALUES(3088, 20, 1, 'SANTA CRUZ', 'CALETA OLIVIA', '9011', NULL, NULL);
INSERT INTO `localidades` VALUES(3089, 20, 1, 'SANTA CRUZ', 'CAÑADON SECO', '9013', NULL, NULL);
INSERT INTO `localidades` VALUES(3090, 20, 1, 'SANTA CRUZ', 'CTE.LUIS PIEDRABUENA', '9303', NULL, NULL);
INSERT INTO `localidades` VALUES(3091, 20, 1, 'SANTA CRUZ', 'DIADEMA ARGENTINA', '9009', NULL, NULL);
INSERT INTO `localidades` VALUES(3092, 20, 1, 'SANTA CRUZ', 'EL CALAFATE', '9201', NULL, NULL);
INSERT INTO `localidades` VALUES(3093, 20, 1, 'SANTA CRUZ', 'GENERAL MOSCONI -SCZ', '9005', NULL, NULL);
INSERT INTO `localidades` VALUES(3094, 20, 1, 'SANTA CRUZ', 'GOBERNADOR GREGORES', '9311', NULL, NULL);
INSERT INTO `localidades` VALUES(3095, 20, 1, 'SANTA CRUZ', 'JARAMILLO', '9053', NULL, NULL);
INSERT INTO `localidades` VALUES(3096, 20, 1, 'SANTA CRUZ', 'LA PORTEÑA', '9303', NULL, NULL);
INSERT INTO `localidades` VALUES(3097, 20, 1, 'SANTA CRUZ', 'LA VIOLETA', '9051', NULL, NULL);
INSERT INTO `localidades` VALUES(3098, 20, 1, 'SANTA CRUZ', 'LAS HERAS (S.CRUZ)', '9017', NULL, NULL);
INSERT INTO `localidades` VALUES(3099, 20, 1, 'SANTA CRUZ', 'PERITO MORENO S.CRUZ', '9040', NULL, NULL);
INSERT INTO `localidades` VALUES(3100, 20, 1, 'SANTA CRUZ', 'PICO TRUNCADO', '9015', NULL, NULL);
INSERT INTO `localidades` VALUES(3101, 20, 1, 'SANTA CRUZ', 'PUERTO DESEADO', '9050', NULL, NULL);
INSERT INTO `localidades` VALUES(3102, 20, 1, 'SANTA CRUZ', 'PUERTO SAN JULIAN', '9310', NULL, NULL);
INSERT INTO `localidades` VALUES(3103, 20, 1, 'SANTA CRUZ', 'PUERTO SANTA CRUZ', '9300', NULL, NULL);
INSERT INTO `localidades` VALUES(3104, 20, 1, 'SANTA CRUZ', 'RIO GALLEGOS', '9400', NULL, NULL);
INSERT INTO `localidades` VALUES(3105, 20, 1, 'SANTA CRUZ', 'RIO MAYO - SCZ', '9030', NULL, NULL);
INSERT INTO `localidades` VALUES(3106, 20, 1, 'SANTA CRUZ', 'RIO TURBIO', '9407', NULL, NULL);
INSERT INTO `localidades` VALUES(3107, 21, 1, 'SANTA FE', '12 DE AGOSTO', '2701', NULL, NULL);
INSERT INTO `localidades` VALUES(3108, 21, 1, 'SANTA FE', 'A.DEL MEDIO', '2113', NULL, NULL);
INSERT INTO `localidades` VALUES(3109, 21, 1, 'SANTA FE', 'AARON CASTELLANOS', '6106', NULL, NULL);
INSERT INTO `localidades` VALUES(3110, 21, 1, 'SANTA FE', 'ACEBAL', '2109', NULL, NULL);
INSERT INTO `localidades` VALUES(3111, 21, 1, 'SANTA FE', 'AGUARA GRANDE', '3071', NULL, NULL);
INSERT INTO `localidades` VALUES(3112, 21, 1, 'SANTA FE', 'ALBARELLOS', '2101', NULL, NULL);
INSERT INTO `localidades` VALUES(3113, 21, 1, 'SANTA FE', 'ALCORTA', '2117', NULL, NULL);
INSERT INTO `localidades` VALUES(3114, 21, 1, 'SANTA FE', 'ALDAO', '2214', NULL, NULL);
INSERT INTO `localidades` VALUES(3115, 21, 1, 'SANTA FE', 'ALEJANDRA', '3051', NULL, NULL);
INSERT INTO `localidades` VALUES(3116, 21, 1, 'SANTA FE', 'ALTO VERDE (SFN)', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3117, 21, 1, 'SANTA FE', 'ALVAREZ', '2107', NULL, NULL);
INSERT INTO `localidades` VALUES(3118, 21, 1, 'SANTA FE', 'ALVEAR (SFN)', '2126', NULL, NULL);
INSERT INTO `localidades` VALUES(3119, 21, 1, 'SANTA FE', 'AMBROSETTI', '2352', NULL, NULL);
INSERT INTO `localidades` VALUES(3120, 21, 1, 'SANTA FE', 'AMENABAR', '6103', NULL, NULL);
INSERT INTO `localidades` VALUES(3121, 21, 1, 'SANTA FE', 'AMSTRONG', '2508', NULL, NULL);
INSERT INTO `localidades` VALUES(3122, 21, 1, 'SANTA FE', 'ANGEL GALLARDO', '3014', NULL, NULL);
INSERT INTO `localidades` VALUES(3123, 21, 1, 'SANTA FE', 'ANGELICA', '2303', NULL, NULL);
INSERT INTO `localidades` VALUES(3124, 21, 1, 'SANTA FE', 'ANTONIO PINI', '3061', NULL, NULL);
INSERT INTO `localidades` VALUES(3125, 21, 1, 'SANTA FE', 'AREQUITO', '2183', NULL, NULL);
INSERT INTO `localidades` VALUES(3126, 21, 1, 'SANTA FE', 'ARMINDA', '2119', NULL, NULL);
INSERT INTO `localidades` VALUES(3127, 21, 1, 'SANTA FE', 'AROCENA', '2242', NULL, NULL);
INSERT INTO `localidades` VALUES(3128, 21, 1, 'SANTA FE', 'AROMOS', '3036', NULL, NULL);
INSERT INTO `localidades` VALUES(3129, 21, 1, 'SANTA FE', 'ARROYO AGUIAR', '3014', NULL, NULL);
INSERT INTO `localidades` VALUES(3130, 21, 1, 'SANTA FE', 'ARROYO CEIBAL', '3575', NULL, NULL);
INSERT INTO `localidades` VALUES(3131, 21, 1, 'SANTA FE', 'ARROYO LEYES', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3132, 21, 1, 'SANTA FE', 'ARROYO SECO', '2128', NULL, NULL);
INSERT INTO `localidades` VALUES(3133, 21, 1, 'SANTA FE', 'ARRUFO', '2344', NULL, NULL);
INSERT INTO `localidades` VALUES(3134, 21, 1, 'SANTA FE', 'ARTEAGA', '2187', NULL, NULL);
INSERT INTO `localidades` VALUES(3135, 21, 1, 'SANTA FE', 'ASCOCHINGAS', '3014', NULL, NULL);
INSERT INTO `localidades` VALUES(3136, 21, 1, 'SANTA FE', 'ATALIVA', '2307', NULL, NULL);
INSERT INTO `localidades` VALUES(3137, 21, 1, 'SANTA FE', 'AURELIA', '2318', NULL, NULL);
INSERT INTO `localidades` VALUES(3138, 21, 1, 'SANTA FE', 'AVELLANEDA (SFN)', '3561', NULL, NULL);
INSERT INTO `localidades` VALUES(3139, 21, 1, 'SANTA FE', 'BARRANCAS (SFN)', '2246', NULL, NULL);
INSERT INTO `localidades` VALUES(3140, 21, 1, 'SANTA FE', 'BARRIO ALTO VERDE', '3000', NULL, NULL);
INSERT INTO `localidades` VALUES(3141, 21, 1, 'SANTA FE', 'BARRIO EL POZO', '3000', NULL, NULL);
INSERT INTO `localidades` VALUES(3142, 21, 1, 'SANTA FE', 'BARROS PASOS', '3569', NULL, NULL);
INSERT INTO `localidades` VALUES(3143, 21, 1, 'SANTA FE', 'BAUER Y SIGEL', '2405', NULL, NULL);
INSERT INTO `localidades` VALUES(3144, 21, 1, 'SANTA FE', 'BELLA ITALIA', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3145, 21, 1, 'SANTA FE', 'BELLA VISTA (SFN)', '2200', NULL, NULL);
INSERT INTO `localidades` VALUES(3146, 21, 1, 'SANTA FE', 'BERABEVU', '2639', NULL, NULL);
INSERT INTO `localidades` VALUES(3147, 21, 1, 'SANTA FE', 'BERNA', '3569', NULL, NULL);
INSERT INTO `localidades` VALUES(3148, 21, 1, 'SANTA FE', 'BERNARDO DE IRIGOYEN', '2248', NULL, NULL);
INSERT INTO `localidades` VALUES(3149, 21, 1, 'SANTA FE', 'BERRETA', '2501', NULL, NULL);
INSERT INTO `localidades` VALUES(3150, 21, 1, 'SANTA FE', 'BIGAND', '2177', NULL, NULL);
INSERT INTO `localidades` VALUES(3151, 21, 1, 'SANTA FE', 'BOMBAL', '2179', NULL, NULL);
INSERT INTO `localidades` VALUES(3152, 21, 1, 'SANTA FE', 'BOUQUET', '2523', NULL, NULL);
INSERT INTO `localidades` VALUES(3153, 21, 1, 'SANTA FE', 'BUSTINZA', '2501', NULL, NULL);
INSERT INTO `localidades` VALUES(3154, 21, 1, 'SANTA FE', 'C. YAGUARETE', '3586', NULL, NULL);
INSERT INTO `localidades` VALUES(3155, 21, 1, 'SANTA FE', 'CABAL', '3036', NULL, NULL);
INSERT INTO `localidades` VALUES(3156, 21, 1, 'SANTA FE', 'CACIQUE ARIACAIQUIN', '3041', NULL, NULL);
INSERT INTO `localidades` VALUES(3157, 21, 1, 'SANTA FE', 'CAFFERATA', '2643', NULL, NULL);
INSERT INTO `localidades` VALUES(3158, 21, 1, 'SANTA FE', 'CALCHAQUI', '3050', NULL, NULL);
INSERT INTO `localidades` VALUES(3159, 21, 1, 'SANTA FE', 'CAMPO ANDINO', '3021', NULL, NULL);
INSERT INTO `localidades` VALUES(3160, 21, 1, 'SANTA FE', 'CAMPO DEL MEDIO', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3161, 21, 1, 'SANTA FE', 'CAMPO GARAY', '3066', NULL, NULL);
INSERT INTO `localidades` VALUES(3162, 21, 1, 'SANTA FE', 'CAMPO HARDY', '3592', NULL, NULL);
INSERT INTO `localidades` VALUES(3163, 21, 1, 'SANTA FE', 'CAPITAN BERMUDEZ', '2154', NULL, NULL);
INSERT INTO `localidades` VALUES(3164, 21, 1, 'SANTA FE', 'CAPIVARA', '2311', NULL, NULL);
INSERT INTO `localidades` VALUES(3165, 21, 1, 'SANTA FE', 'CARCARAÑA', '2138', NULL, NULL);
INSERT INTO `localidades` VALUES(3166, 21, 1, 'SANTA FE', 'CARLOS PELLEGRINI', '2453', NULL, NULL);
INSERT INTO `localidades` VALUES(3167, 21, 1, 'SANTA FE', 'CARMEN', '2618', NULL, NULL);
INSERT INTO `localidades` VALUES(3168, 21, 1, 'SANTA FE', 'CARMEN DEL SAUCE', '2109', NULL, NULL);
INSERT INTO `localidades` VALUES(3169, 21, 1, 'SANTA FE', 'CARRERAS', '2729', NULL, NULL);
INSERT INTO `localidades` VALUES(3170, 21, 1, 'SANTA FE', 'CARRIZALES', '2218', NULL, NULL);
INSERT INTO `localidades` VALUES(3171, 21, 1, 'SANTA FE', 'CASALENGO', '2248', NULL, NULL);
INSERT INTO `localidades` VALUES(3172, 21, 1, 'SANTA FE', 'CASILDA', '2170', NULL, NULL);
INSERT INTO `localidades` VALUES(3173, 21, 1, 'SANTA FE', 'CAVOUR', '3081', NULL, NULL);
INSERT INTO `localidades` VALUES(3174, 21, 1, 'SANTA FE', 'CAYASTA', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3175, 21, 1, 'SANTA FE', 'CAYASTACITO', '3038', NULL, NULL);
INSERT INTO `localidades` VALUES(3176, 21, 1, 'SANTA FE', 'CAÑADA DE GOMEZ', '2500', NULL, NULL);
INSERT INTO `localidades` VALUES(3177, 21, 1, 'SANTA FE', 'CAÑADA DEL UCLE', '2635', NULL, NULL);
INSERT INTO `localidades` VALUES(3178, 21, 1, 'SANTA FE', 'CAÑADA OMBU', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3179, 21, 1, 'SANTA FE', 'CAÑADA RICA', '2105', NULL, NULL);
INSERT INTO `localidades` VALUES(3180, 21, 1, 'SANTA FE', 'CAÑADA ROSQUIN', '2454', NULL, NULL);
INSERT INTO `localidades` VALUES(3181, 21, 1, 'SANTA FE', 'CENTENO', '2148', NULL, NULL);
INSERT INTO `localidades` VALUES(3182, 21, 1, 'SANTA FE', 'CEPEDA', '2105', NULL, NULL);
INSERT INTO `localidades` VALUES(3183, 21, 1, 'SANTA FE', 'CEPEDA', '2921', NULL, NULL);
INSERT INTO `localidades` VALUES(3184, 21, 1, 'SANTA FE', 'CERES', '2340', NULL, NULL);
INSERT INTO `localidades` VALUES(3185, 21, 1, 'SANTA FE', 'CHABAS', '2173', NULL, NULL);
INSERT INTO `localidades` VALUES(3186, 21, 1, 'SANTA FE', 'CHAPUY', '2603', NULL, NULL);
INSERT INTO `localidades` VALUES(3187, 21, 1, 'SANTA FE', 'CHAÑAR LADEADO SFN', '2643', NULL, NULL);
INSERT INTO `localidades` VALUES(3188, 21, 1, 'SANTA FE', 'CHOVET', '2633', NULL, NULL);
INSERT INTO `localidades` VALUES(3189, 21, 1, 'SANTA FE', 'CHRISTOPHERSEN', '6039', NULL, NULL);
INSERT INTO `localidades` VALUES(3190, 21, 1, 'SANTA FE', 'CLARKE', '2218', NULL, NULL);
INSERT INTO `localidades` VALUES(3191, 21, 1, 'SANTA FE', 'CLASON', '2146', NULL, NULL);
INSERT INTO `localidades` VALUES(3192, 21, 1, 'SANTA FE', 'CLUCELLAS', '2407', NULL, NULL);
INSERT INTO `localidades` VALUES(3193, 21, 1, 'SANTA FE', 'COLASTINE', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3194, 21, 1, 'SANTA FE', 'COLASTINE NORTE', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3195, 21, 1, 'SANTA FE', 'COLMENA', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3196, 21, 1, 'SANTA FE', 'COLONIA ALDAO', '2214', NULL, NULL);
INSERT INTO `localidades` VALUES(3197, 21, 1, 'SANTA FE', 'COLONIA ANA', '2345', NULL, NULL);
INSERT INTO `localidades` VALUES(3198, 21, 1, 'SANTA FE', 'COLONIA ANGELONI', '3048', NULL, NULL);
INSERT INTO `localidades` VALUES(3199, 21, 1, 'SANTA FE', 'COLONIA BELGRANO', '2257', NULL, NULL);
INSERT INTO `localidades` VALUES(3200, 21, 1, 'SANTA FE', 'COLONIA BICHA', '2317', NULL, NULL);
INSERT INTO `localidades` VALUES(3201, 21, 1, 'SANTA FE', 'COLONIA BIGAND', '2177', NULL, NULL);
INSERT INTO `localidades` VALUES(3202, 21, 1, 'SANTA FE', 'COLONIA BOSSI', '2326', NULL, NULL);
INSERT INTO `localidades` VALUES(3203, 21, 1, 'SANTA FE', 'COLONIA CALIFORNIA', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3204, 21, 1, 'SANTA FE', 'COLONIA CASTELAR SFN', '2401', NULL, NULL);
INSERT INTO `localidades` VALUES(3205, 21, 1, 'SANTA FE', 'COLONIA CASTELLANOS', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3206, 21, 1, 'SANTA FE', 'COLONIA CELLO', '2405', NULL, NULL);
INSERT INTO `localidades` VALUES(3207, 21, 1, 'SANTA FE', 'COLONIA CLARA', '3025', NULL, NULL);
INSERT INTO `localidades` VALUES(3208, 21, 1, 'SANTA FE', 'COLONIA DOLORES', '3045', NULL, NULL);
INSERT INTO `localidades` VALUES(3209, 21, 1, 'SANTA FE', 'COLONIA FIDELA', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3210, 21, 1, 'SANTA FE', 'COLONIA FRANCESA', '3005', NULL, NULL);
INSERT INTO `localidades` VALUES(3211, 21, 1, 'SANTA FE', 'COLONIA HANSEN', '2637', NULL, NULL);
INSERT INTO `localidades` VALUES(3212, 21, 1, 'SANTA FE', 'COLONIA ITURRASPE', '2413', NULL, NULL);
INSERT INTO `localidades` VALUES(3213, 21, 1, 'SANTA FE', 'COLONIA LA BLANCA', '3052', NULL, NULL);
INSERT INTO `localidades` VALUES(3214, 21, 1, 'SANTA FE', 'COLONIA LA NEGRA', '3054', NULL, NULL);
INSERT INTO `localidades` VALUES(3215, 21, 1, 'SANTA FE', 'COLONIA LA PENCA', '3045', NULL, NULL);
INSERT INTO `localidades` VALUES(3216, 21, 1, 'SANTA FE', 'COLONIA MARGARITA', '2443', NULL, NULL);
INSERT INTO `localidades` VALUES(3217, 21, 1, 'SANTA FE', 'COLONIA MASCIAS', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3218, 21, 1, 'SANTA FE', 'COLONIA MONTEFIORE', '2341', NULL, NULL);
INSERT INTO `localidades` VALUES(3219, 21, 1, 'SANTA FE', 'COLONIA MORGAN', '2609', NULL, NULL);
INSERT INTO `localidades` VALUES(3220, 21, 1, 'SANTA FE', 'COLONIA NUEVA NARCISO', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3221, 21, 1, 'SANTA FE', 'COLONIA PUJOL', '3080', NULL, NULL);
INSERT INTO `localidades` VALUES(3222, 21, 1, 'SANTA FE', 'COLONIA ROSA', '2347', NULL, NULL);
INSERT INTO `localidades` VALUES(3223, 21, 1, 'SANTA FE', 'COLONIA SAN MANUEL', '3563', NULL, NULL);
INSERT INTO `localidades` VALUES(3224, 21, 1, 'SANTA FE', 'COLONIA SILVA', '3042', NULL, NULL);
INSERT INTO `localidades` VALUES(3225, 21, 1, 'SANTA FE', 'COLONIA TERESA', '3005', NULL, NULL);
INSERT INTO `localidades` VALUES(3226, 21, 1, 'SANTA FE', 'COLONIA VALDEZ', '2115', NULL, NULL);
INSERT INTO `localidades` VALUES(3227, 21, 1, 'SANTA FE', 'CONSTANZA', '2311', NULL, NULL);
INSERT INTO `localidades` VALUES(3228, 21, 1, 'SANTA FE', 'CONSTITUYENTES', '3014', NULL, NULL);
INSERT INTO `localidades` VALUES(3229, 21, 1, 'SANTA FE', 'CORONDA', '2240', NULL, NULL);
INSERT INTO `localidades` VALUES(3230, 21, 1, 'SANTA FE', 'CORONEL ARNOLD', '2123', NULL, NULL);
INSERT INTO `localidades` VALUES(3231, 21, 1, 'SANTA FE', 'CORONEL BOGADO', '2103', NULL, NULL);
INSERT INTO `localidades` VALUES(3232, 21, 1, 'SANTA FE', 'CORONEL DOMINGUEZ', '2105', NULL, NULL);
INSERT INTO `localidades` VALUES(3233, 21, 1, 'SANTA FE', 'CORONEL FRAGA', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3234, 21, 1, 'SANTA FE', 'CORONEL ROSETTI', '6106', NULL, NULL);
INSERT INTO `localidades` VALUES(3235, 21, 1, 'SANTA FE', 'CORREA', '2506', NULL, NULL);
INSERT INTO `localidades` VALUES(3236, 21, 1, 'SANTA FE', 'CRISPI', '2441', NULL, NULL);
INSERT INTO `localidades` VALUES(3237, 21, 1, 'SANTA FE', 'CUATRO DE FEBRERO', '2732', NULL, NULL);
INSERT INTO `localidades` VALUES(3238, 21, 1, 'SANTA FE', 'CUATRO ESQUINAS', '2639', NULL, NULL);
INSERT INTO `localidades` VALUES(3239, 21, 1, 'SANTA FE', 'CULULU', '3023', NULL, NULL);
INSERT INTO `localidades` VALUES(3240, 21, 1, 'SANTA FE', 'CURUPAITY', '2342', NULL, NULL);
INSERT INTO `localidades` VALUES(3241, 21, 1, 'SANTA FE', 'DESVIO ARIJON', '2242', NULL, NULL);
INSERT INTO `localidades` VALUES(3242, 21, 1, 'SANTA FE', 'DIAZ', '2222', NULL, NULL);
INSERT INTO `localidades` VALUES(3243, 21, 1, 'SANTA FE', 'DIEGO DE ALVEAR', '6036', NULL, NULL);
INSERT INTO `localidades` VALUES(3244, 21, 1, 'SANTA FE', 'EGUSQUIZA', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3245, 21, 1, 'SANTA FE', 'EL ARAZA', '3563', NULL, NULL);
INSERT INTO `localidades` VALUES(3246, 21, 1, 'SANTA FE', 'EL CANTOR', '2643', NULL, NULL);
INSERT INTO `localidades` VALUES(3247, 21, 1, 'SANTA FE', 'EL JARDIN', '2603', NULL, NULL);
INSERT INTO `localidades` VALUES(3248, 21, 1, 'SANTA FE', 'EL LAUREL', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3249, 21, 1, 'SANTA FE', 'EL NOCHERO', '3061', NULL, NULL);
INSERT INTO `localidades` VALUES(3250, 21, 1, 'SANTA FE', 'EL POZO', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3251, 21, 1, 'SANTA FE', 'EL RABON', '3592', NULL, NULL);
INSERT INTO `localidades` VALUES(3252, 21, 1, 'SANTA FE', 'EL SOMBRERITO', '3585', NULL, NULL);
INSERT INTO `localidades` VALUES(3253, 21, 1, 'SANTA FE', 'EL TIMBO - SFN', '3561', NULL, NULL);
INSERT INTO `localidades` VALUES(3254, 21, 1, 'SANTA FE', 'EL TREBOL', '2535', NULL, NULL);
INSERT INTO `localidades` VALUES(3255, 21, 1, 'SANTA FE', 'ELISA', '3029', NULL, NULL);
INSERT INTO `localidades` VALUES(3256, 21, 1, 'SANTA FE', 'ELORTONDO', '2732', NULL, NULL);
INSERT INTO `localidades` VALUES(3257, 21, 1, 'SANTA FE', 'EMILIA', '3036', NULL, NULL);
INSERT INTO `localidades` VALUES(3258, 21, 1, 'SANTA FE', 'EMPALME SAN CARLOS', '3007', NULL, NULL);
INSERT INTO `localidades` VALUES(3259, 21, 1, 'SANTA FE', 'EMPALME VILLA CONSTITUCION', '2918', NULL, NULL);
INSERT INTO `localidades` VALUES(3260, 21, 1, 'SANTA FE', 'ESMERALDA', '2456', NULL, NULL);
INSERT INTO `localidades` VALUES(3261, 21, 1, 'SANTA FE', 'ESPERANZA', '3080', NULL, NULL);
INSERT INTO `localidades` VALUES(3262, 21, 1, 'SANTA FE', 'ESPIN', '3056', NULL, NULL);
INSERT INTO `localidades` VALUES(3263, 21, 1, 'SANTA FE', 'ESTACION CALDENGUES', '6015', NULL, NULL);
INSERT INTO `localidades` VALUES(3264, 21, 1, 'SANTA FE', 'ESTACION CHRISTOPHERSEN', '2611', NULL, NULL);
INSERT INTO `localidades` VALUES(3265, 21, 1, 'SANTA FE', 'ESTACION CLUCELLAS', '2407', NULL, NULL);
INSERT INTO `localidades` VALUES(3266, 21, 1, 'SANTA FE', 'ESTACION MATILDE', '3013', NULL, NULL);
INSERT INTO `localidades` VALUES(3267, 21, 1, 'SANTA FE', 'ESTEBAN RAMA', '3066', NULL, NULL);
INSERT INTO `localidades` VALUES(3268, 21, 1, 'SANTA FE', 'ESTHER', '3036', NULL, NULL);
INSERT INTO `localidades` VALUES(3269, 21, 1, 'SANTA FE', 'EUSEBIA', '2317', NULL, NULL);
INSERT INTO `localidades` VALUES(3270, 21, 1, 'SANTA FE', 'EUSTOLIA', '2407', NULL, NULL);
INSERT INTO `localidades` VALUES(3271, 21, 1, 'SANTA FE', 'FELICIA', '3087', NULL, NULL);
INSERT INTO `localidades` VALUES(3272, 21, 1, 'SANTA FE', 'FIGHIERA', '2126', NULL, NULL);
INSERT INTO `localidades` VALUES(3273, 21, 1, 'SANTA FE', 'FIRMAT', '2630', NULL, NULL);
INSERT INTO `localidades` VALUES(3274, 21, 1, 'SANTA FE', 'FLOR DE ORO', '3575', NULL, NULL);
INSERT INTO `localidades` VALUES(3275, 21, 1, 'SANTA FE', 'FLORENCIA', '3516', NULL, NULL);
INSERT INTO `localidades` VALUES(3276, 21, 1, 'SANTA FE', 'FONTEZUELA', '2701', NULL, NULL);
INSERT INTO `localidades` VALUES(3277, 21, 1, 'SANTA FE', 'FORTIN OLMOS', '3548', NULL, NULL);
INSERT INTO `localidades` VALUES(3278, 21, 1, 'SANTA FE', 'FRANCK', '3009', NULL, NULL);
INSERT INTO `localidades` VALUES(3279, 21, 1, 'SANTA FE', 'FRAY LUIS BELTRAN SFN', '2156', NULL, NULL);
INSERT INTO `localidades` VALUES(3280, 21, 1, 'SANTA FE', 'FRONTERA', '2438', NULL, NULL);
INSERT INTO `localidades` VALUES(3281, 21, 1, 'SANTA FE', 'FUENTES', '2123', NULL, NULL);
INSERT INTO `localidades` VALUES(3282, 21, 1, 'SANTA FE', 'FUNES', '2132', NULL, NULL);
INSERT INTO `localidades` VALUES(3283, 21, 1, 'SANTA FE', 'GALVEZ', '2252', NULL, NULL);
INSERT INTO `localidades` VALUES(3284, 21, 1, 'SANTA FE', 'GARABATO', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3285, 21, 1, 'SANTA FE', 'GARIBALDI', '2443', NULL, NULL);
INSERT INTO `localidades` VALUES(3286, 21, 1, 'SANTA FE', 'GATO COLORADO', '3541', NULL, NULL);
INSERT INTO `localidades` VALUES(3287, 21, 1, 'SANTA FE', 'GENERAL GELLY', '2701', NULL, NULL);
INSERT INTO `localidades` VALUES(3288, 21, 1, 'SANTA FE', 'GENERAL LAGOS', '2126', NULL, NULL);
INSERT INTO `localidades` VALUES(3289, 21, 1, 'SANTA FE', 'GESSLER', '2253', NULL, NULL);
INSERT INTO `localidades` VALUES(3290, 21, 1, 'SANTA FE', 'GLUTHLY', '3083', NULL, NULL);
INSERT INTO `localidades` VALUES(3291, 21, 1, 'SANTA FE', 'GOBERNADOR CANDIOTI', '3018', NULL, NULL);
INSERT INTO `localidades` VALUES(3292, 21, 1, 'SANTA FE', 'GOBERNADOR CRESPO', '3044', NULL, NULL);
INSERT INTO `localidades` VALUES(3293, 21, 1, 'SANTA FE', 'GOBERNADOR VERA', '3550', NULL, NULL);
INSERT INTO `localidades` VALUES(3294, 21, 1, 'SANTA FE', 'GODEKEN', '2639', NULL, NULL);
INSERT INTO `localidades` VALUES(3295, 21, 1, 'SANTA FE', 'GODOY', '2921', NULL, NULL);
INSERT INTO `localidades` VALUES(3296, 21, 1, 'SANTA FE', 'GOLONDRINA', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3297, 21, 1, 'SANTA FE', 'GRANADERO BAIGORRIA', '2152', NULL, NULL);
INSERT INTO `localidades` VALUES(3298, 21, 1, 'SANTA FE', 'GREGORIA PEREZ DE DENIS', '3061', NULL, NULL);
INSERT INTO `localidades` VALUES(3299, 21, 1, 'SANTA FE', 'GUADALUPE NORTE', '3574', NULL, NULL);
INSERT INTO `localidades` VALUES(3300, 21, 1, 'SANTA FE', 'GUAYCURU', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3301, 21, 1, 'SANTA FE', 'HELVECIA', '3003', NULL, NULL);
INSERT INTO `localidades` VALUES(3302, 21, 1, 'SANTA FE', 'HERCILIA', '2352', NULL, NULL);
INSERT INTO `localidades` VALUES(3303, 21, 1, 'SANTA FE', 'HIPATIA', '3023', NULL, NULL);
INSERT INTO `localidades` VALUES(3304, 21, 1, 'SANTA FE', 'HUANQUEROS', '3076', NULL, NULL);
INSERT INTO `localidades` VALUES(3305, 21, 1, 'SANTA FE', 'HUGENTOBLER', '2317', NULL, NULL);
INSERT INTO `localidades` VALUES(3306, 21, 1, 'SANTA FE', 'HUMBERTO 1º', '2309', NULL, NULL);
INSERT INTO `localidades` VALUES(3307, 21, 1, 'SANTA FE', 'HUMBOLDT', '3081', NULL, NULL);
INSERT INTO `localidades` VALUES(3308, 21, 1, 'SANTA FE', 'IBARLUCEA', '2142', NULL, NULL);
INSERT INTO `localidades` VALUES(3309, 21, 1, 'SANTA FE', 'INDEPENDENCIA', '3060', NULL, NULL);
INSERT INTO `localidades` VALUES(3310, 21, 1, 'SANTA FE', 'INGENIERO BOASI', '3023', NULL, NULL);
INSERT INTO `localidades` VALUES(3311, 21, 1, 'SANTA FE', 'INGENIERO CHANOURDIE', '3575', NULL, NULL);
INSERT INTO `localidades` VALUES(3312, 21, 1, 'SANTA FE', 'INTIYACO', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3313, 21, 1, 'SANTA FE', 'IRIGOYEN', '2248', NULL, NULL);
INSERT INTO `localidades` VALUES(3314, 21, 1, 'SANTA FE', 'IRIONDO', '3018', NULL, NULL);
INSERT INTO `localidades` VALUES(3315, 21, 1, 'SANTA FE', 'ITURRASPE', '2521', NULL, NULL);
INSERT INTO `localidades` VALUES(3316, 21, 1, 'SANTA FE', 'JUAN B. MOLINA', '2103', NULL, NULL);
INSERT INTO `localidades` VALUES(3317, 21, 1, 'SANTA FE', 'JUNCAL', '2723', NULL, NULL);
INSERT INTO `localidades` VALUES(3318, 21, 1, 'SANTA FE', 'LA BRAVA', '3045', NULL, NULL);
INSERT INTO `localidades` VALUES(3319, 21, 1, 'SANTA FE', 'LA CABRAL', '3074', NULL, NULL);
INSERT INTO `localidades` VALUES(3320, 21, 1, 'SANTA FE', 'LA CAIMA', '2242', NULL, NULL);
INSERT INTO `localidades` VALUES(3321, 21, 1, 'SANTA FE', 'LA CALIFORNIA', '2520', NULL, NULL);
INSERT INTO `localidades` VALUES(3322, 21, 1, 'SANTA FE', 'LA CAMILA', '3054', NULL, NULL);
INSERT INTO `localidades` VALUES(3323, 21, 1, 'SANTA FE', 'LA CHISPA', '2601', NULL, NULL);
INSERT INTO `localidades` VALUES(3324, 21, 1, 'SANTA FE', 'LA CRIOLLA', '3052', NULL, NULL);
INSERT INTO `localidades` VALUES(3325, 21, 1, 'SANTA FE', 'LA GALLARETA', '3057', NULL, NULL);
INSERT INTO `localidades` VALUES(3326, 21, 1, 'SANTA FE', 'LA GUAMPITA', '3056', NULL, NULL);
INSERT INTO `localidades` VALUES(3327, 21, 1, 'SANTA FE', 'LA GUARDIA (SFN)', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3328, 21, 1, 'SANTA FE', 'LA LOLA', '3567', NULL, NULL);
INSERT INTO `localidades` VALUES(3329, 21, 1, 'SANTA FE', 'LA NORIA', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3330, 21, 1, 'SANTA FE', 'LA ORIENTAL', '3054', NULL, NULL);
INSERT INTO `localidades` VALUES(3331, 21, 1, 'SANTA FE', 'LA ORILLA', '3080', NULL, NULL);
INSERT INTO `localidades` VALUES(3332, 21, 1, 'SANTA FE', 'LA PELADA', '3027', NULL, NULL);
INSERT INTO `localidades` VALUES(3333, 21, 1, 'SANTA FE', 'LA PICASA', '6036', NULL, NULL);
INSERT INTO `localidades` VALUES(3334, 21, 1, 'SANTA FE', 'LA POTASA', '3563', NULL, NULL);
INSERT INTO `localidades` VALUES(3335, 21, 1, 'SANTA FE', 'LA RESERVA', '3581', NULL, NULL);
INSERT INTO `localidades` VALUES(3336, 21, 1, 'SANTA FE', 'LA RUBIA', '2342', NULL, NULL);
INSERT INTO `localidades` VALUES(3337, 21, 1, 'SANTA FE', 'LA SALADA', '2142', NULL, NULL);
INSERT INTO `localidades` VALUES(3338, 21, 1, 'SANTA FE', 'LA SARITA', '3563', NULL, NULL);
INSERT INTO `localidades` VALUES(3339, 21, 1, 'SANTA FE', 'LA VANGUARDIA (MOUSSY, DTO OBLIGADO', '3561', NULL, NULL);
INSERT INTO `localidades` VALUES(3340, 21, 1, 'SANTA FE', 'LA VANGUARDIA (SFN)', '2105', NULL, NULL);
INSERT INTO `localidades` VALUES(3341, 21, 1, 'SANTA FE', 'LA ZULEMA', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3342, 21, 1, 'SANTA FE', 'LABORDEBOY', '2726', NULL, NULL);
INSERT INTO `localidades` VALUES(3343, 21, 1, 'SANTA FE', 'LAGUNA PAIVA', '3020', NULL, NULL);
INSERT INTO `localidades` VALUES(3344, 21, 1, 'SANTA FE', 'LANDETA', '2531', NULL, NULL);
INSERT INTO `localidades` VALUES(3345, 21, 1, 'SANTA FE', 'LANTERI', '3575', NULL, NULL);
INSERT INTO `localidades` VALUES(3346, 21, 1, 'SANTA FE', 'LARGUIA', '2144', NULL, NULL);
INSERT INTO `localidades` VALUES(3347, 21, 1, 'SANTA FE', 'LARRECHEA', '2241', NULL, NULL);
INSERT INTO `localidades` VALUES(3348, 21, 1, 'SANTA FE', 'LAS AVISPAS', '3074', NULL, NULL);
INSERT INTO `localidades` VALUES(3349, 21, 1, 'SANTA FE', 'LAS BANDURRIAS', '2148', NULL, NULL);
INSERT INTO `localidades` VALUES(3350, 21, 1, 'SANTA FE', 'LAS GARZAS', '3574', NULL, NULL);
INSERT INTO `localidades` VALUES(3351, 21, 1, 'SANTA FE', 'LAS MERCEDES', '3516', NULL, NULL);
INSERT INTO `localidades` VALUES(3352, 21, 1, 'SANTA FE', 'LAS PALMAS - SFN', '3555', NULL, NULL);
INSERT INTO `localidades` VALUES(3353, 21, 1, 'SANTA FE', 'LAS PALMERAS', '2326', NULL, NULL);
INSERT INTO `localidades` VALUES(3354, 21, 1, 'SANTA FE', 'LAS PAREJAS', '2505', NULL, NULL);
INSERT INTO `localidades` VALUES(3355, 21, 1, 'SANTA FE', 'LAS PETACAS', '2451', NULL, NULL);
INSERT INTO `localidades` VALUES(3356, 21, 1, 'SANTA FE', 'LAS ROSAS (SFN)', '2520', NULL, NULL);
INSERT INTO `localidades` VALUES(3357, 21, 1, 'SANTA FE', 'LAS TOSCAS (SFN)', '3586', NULL, NULL);
INSERT INTO `localidades` VALUES(3358, 21, 1, 'SANTA FE', 'LAS TUNAS (SFN)', '3009', NULL, NULL);
INSERT INTO `localidades` VALUES(3359, 21, 1, 'SANTA FE', 'LASSAGA', '3036', NULL, NULL);
INSERT INTO `localidades` VALUES(3360, 21, 1, 'SANTA FE', 'LEHMANN', '2305', NULL, NULL);
INSERT INTO `localidades` VALUES(3361, 21, 1, 'SANTA FE', 'LLAMBI CAMPBELL', '3034', NULL, NULL);
INSERT INTO `localidades` VALUES(3362, 21, 1, 'SANTA FE', 'LOGROÑO', '3066', NULL, NULL);
INSERT INTO `localidades` VALUES(3363, 21, 1, 'SANTA FE', 'LOMA ALTA', '2253', NULL, NULL);
INSERT INTO `localidades` VALUES(3364, 21, 1, 'SANTA FE', 'LOPEZ (SFN)', '2255', NULL, NULL);
INSERT INTO `localidades` VALUES(3365, 21, 1, 'SANTA FE', 'LOS AMORES', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3366, 21, 1, 'SANTA FE', 'LOS CARDOS', '2533', NULL, NULL);
INSERT INTO `localidades` VALUES(3367, 21, 1, 'SANTA FE', 'LOS CERRILLOS (SFN)', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3368, 21, 1, 'SANTA FE', 'LOS CORRALITOS', '3051', NULL, NULL);
INSERT INTO `localidades` VALUES(3369, 21, 1, 'SANTA FE', 'LOS LAPACHOS', '3575', NULL, NULL);
INSERT INTO `localidades` VALUES(3370, 21, 1, 'SANTA FE', 'LOS LAURELES', '3567', NULL, NULL);
INSERT INTO `localidades` VALUES(3371, 21, 1, 'SANTA FE', 'LOS MOLINOS (SFN)', '2181', NULL, NULL);
INSERT INTO `localidades` VALUES(3372, 21, 1, 'SANTA FE', 'LOS NOGALES (SFN)', '2183', NULL, NULL);
INSERT INTO `localidades` VALUES(3373, 21, 1, 'SANTA FE', 'LOS QUIRQUINCHOS', '2637', NULL, NULL);
INSERT INTO `localidades` VALUES(3374, 21, 1, 'SANTA FE', 'LOS TABANOS', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3375, 21, 1, 'SANTA FE', 'LOS ZAPALLOS', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3376, 21, 1, 'SANTA FE', 'LUCIANO LEIVA', '3048', NULL, NULL);
INSERT INTO `localidades` VALUES(3377, 21, 1, 'SANTA FE', 'LUCILA', '3072', NULL, NULL);
INSERT INTO `localidades` VALUES(3378, 21, 1, 'SANTA FE', 'LUCIO V. LOPEZ', '2142', NULL, NULL);
INSERT INTO `localidades` VALUES(3379, 21, 1, 'SANTA FE', 'LUIS PALACIOS', '2142', NULL, NULL);
INSERT INTO `localidades` VALUES(3380, 21, 1, 'SANTA FE', 'M TORRES', '2631', NULL, NULL);
INSERT INTO `localidades` VALUES(3381, 21, 1, 'SANTA FE', 'MACIEL', '2208', NULL, NULL);
INSERT INTO `localidades` VALUES(3382, 21, 1, 'SANTA FE', 'MAGGIOLO', '2622', NULL, NULL);
INSERT INTO `localidades` VALUES(3383, 21, 1, 'SANTA FE', 'MAIZALES', '2113', NULL, NULL);
INSERT INTO `localidades` VALUES(3384, 21, 1, 'SANTA FE', 'MALABRIGO', '3572', NULL, NULL);
INSERT INTO `localidades` VALUES(3385, 21, 1, 'SANTA FE', 'MANGORE', '2445', NULL, NULL);
INSERT INTO `localidades` VALUES(3386, 21, 1, 'SANTA FE', 'MANUCHO', '3023', NULL, NULL);
INSERT INTO `localidades` VALUES(3387, 21, 1, 'SANTA FE', 'MARCELINO ESCALADA', '3042', NULL, NULL);
INSERT INTO `localidades` VALUES(3388, 21, 1, 'SANTA FE', 'MARGARITA', '3056', NULL, NULL);
INSERT INTO `localidades` VALUES(3389, 21, 1, 'SANTA FE', 'MARIA JUANA', '2445', NULL, NULL);
INSERT INTO `localidades` VALUES(3390, 21, 1, 'SANTA FE', 'MARIA LUISA', '3025', NULL, NULL);
INSERT INTO `localidades` VALUES(3391, 21, 1, 'SANTA FE', 'MARIA SUSANA', '2527', NULL, NULL);
INSERT INTO `localidades` VALUES(3392, 21, 1, 'SANTA FE', 'MARIA TERESA', '2609', NULL, NULL);
INSERT INTO `localidades` VALUES(3393, 21, 1, 'SANTA FE', 'MARIANO SAAVEDRA', '3011', NULL, NULL);
INSERT INTO `localidades` VALUES(3394, 21, 1, 'SANTA FE', 'MAXIMO PAZ (SFN)', '2115', NULL, NULL);
INSERT INTO `localidades` VALUES(3395, 21, 1, 'SANTA FE', 'MELINCUE', '2728', NULL, NULL);
INSERT INTO `localidades` VALUES(3396, 21, 1, 'SANTA FE', 'MOISES VILLE', '2313', NULL, NULL);
INSERT INTO `localidades` VALUES(3397, 21, 1, 'SANTA FE', 'MONIGOTES', '2342', NULL, NULL);
INSERT INTO `localidades` VALUES(3398, 21, 1, 'SANTA FE', 'MONJE', '2212', NULL, NULL);
INSERT INTO `localidades` VALUES(3399, 21, 1, 'SANTA FE', 'MONTE FLORES', '2101', NULL, NULL);
INSERT INTO `localidades` VALUES(3400, 21, 1, 'SANTA FE', 'MONTE VERA', '3014', NULL, NULL);
INSERT INTO `localidades` VALUES(3401, 21, 1, 'SANTA FE', 'MONTES DE OCA', '2521', NULL, NULL);
INSERT INTO `localidades` VALUES(3402, 21, 1, 'SANTA FE', 'MOUSSY', '3561', NULL, NULL);
INSERT INTO `localidades` VALUES(3403, 21, 1, 'SANTA FE', 'MURPHY', '2601', NULL, NULL);
INSERT INTO `localidades` VALUES(3404, 21, 1, 'SANTA FE', 'NARE', '3046', NULL, NULL);
INSERT INTO `localidades` VALUES(3405, 21, 1, 'SANTA FE', 'NELSON', '3032', NULL, NULL);
INSERT INTO `localidades` VALUES(3406, 21, 1, 'SANTA FE', 'NICANOR E. MOLINAS', '3563', NULL, NULL);
INSERT INTO `localidades` VALUES(3407, 21, 1, 'SANTA FE', 'NUEVA ITALIA', '3074', NULL, NULL);
INSERT INTO `localidades` VALUES(3408, 21, 1, 'SANTA FE', 'NUEVO TORINO', '3087', NULL, NULL);
INSERT INTO `localidades` VALUES(3409, 21, 1, 'SANTA FE', 'OGILVIE', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3410, 21, 1, 'SANTA FE', 'OLIVEROS', '2206', NULL, NULL);
INSERT INTO `localidades` VALUES(3411, 21, 1, 'SANTA FE', 'ORATORIO MORANTE', '2921', NULL, NULL);
INSERT INTO `localidades` VALUES(3412, 21, 1, 'SANTA FE', 'OROÑO', '2253', NULL, NULL);
INSERT INTO `localidades` VALUES(3413, 21, 1, 'SANTA FE', 'PADRE PEDRO ITURRALDE', '3061', NULL, NULL);
INSERT INTO `localidades` VALUES(3414, 21, 1, 'SANTA FE', 'PALACIOS', '2326', NULL, NULL);
INSERT INTO `localidades` VALUES(3415, 21, 1, 'SANTA FE', 'PAVON', '2918', NULL, NULL);
INSERT INTO `localidades` VALUES(3416, 21, 1, 'SANTA FE', 'PAVON ARRIBA', '2109', NULL, NULL);
INSERT INTO `localidades` VALUES(3417, 21, 1, 'SANTA FE', 'PEDRO GOMEZ CELLO', '2405', NULL, NULL);
INSERT INTO `localidades` VALUES(3418, 21, 1, 'SANTA FE', 'PEREZ', '2121', NULL, NULL);
INSERT INTO `localidades` VALUES(3419, 21, 1, 'SANTA FE', 'PETRONILA', '3046', NULL, NULL);
INSERT INTO `localidades` VALUES(3420, 21, 1, 'SANTA FE', 'PEYRANO', '2113', NULL, NULL);
INSERT INTO `localidades` VALUES(3421, 21, 1, 'SANTA FE', 'PIAMONTE', '2529', NULL, NULL);
INSERT INTO `localidades` VALUES(3422, 21, 1, 'SANTA FE', 'PILAR (SFN)', '3085', NULL, NULL);
INSERT INTO `localidades` VALUES(3423, 21, 1, 'SANTA FE', 'PIÑERO', '2119', NULL, NULL);
INSERT INTO `localidades` VALUES(3424, 21, 1, 'SANTA FE', 'PLAZA JOSEFINA (SFN)', '2403', NULL, NULL);
INSERT INTO `localidades` VALUES(3425, 21, 1, 'SANTA FE', 'PORTUGALETES', '3071', NULL, NULL);
INSERT INTO `localidades` VALUES(3426, 21, 1, 'SANTA FE', 'POZO BORRADO', '3061', NULL, NULL);
INSERT INTO `localidades` VALUES(3427, 21, 1, 'SANTA FE', 'POZO DE LOS INDIOS', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3428, 21, 1, 'SANTA FE', 'PRESIDENTE ROCA', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3429, 21, 1, 'SANTA FE', 'PROGRESO', '3023', NULL, NULL);
INSERT INTO `localidades` VALUES(3430, 21, 1, 'SANTA FE', 'PROVIDENCIA', '3025', NULL, NULL);
INSERT INTO `localidades` VALUES(3431, 21, 1, 'SANTA FE', 'PUEBLO ANDINO', '2214', NULL, NULL);
INSERT INTO `localidades` VALUES(3432, 21, 1, 'SANTA FE', 'PUEBLO CASAS', '2148', NULL, NULL);
INSERT INTO `localidades` VALUES(3433, 21, 1, 'SANTA FE', 'PUEBLO ESTHER', '2126', NULL, NULL);
INSERT INTO `localidades` VALUES(3434, 21, 1, 'SANTA FE', 'PUEBLO MARINI', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3435, 21, 1, 'SANTA FE', 'PUEBLO MUÑOZ', '2119', NULL, NULL);
INSERT INTO `localidades` VALUES(3436, 21, 1, 'SANTA FE', 'PUERTO ARAGON', '2246', NULL, NULL);
INSERT INTO `localidades` VALUES(3437, 21, 1, 'SANTA FE', 'PUERTO GABOTO', '2208', NULL, NULL);
INSERT INTO `localidades` VALUES(3438, 21, 1, 'SANTA FE', 'PUERTO GRAL.SAN MARTIN', '2202', NULL, NULL);
INSERT INTO `localidades` VALUES(3439, 21, 1, 'SANTA FE', 'PUJATO', '2123', NULL, NULL);
INSERT INTO `localidades` VALUES(3440, 21, 1, 'SANTA FE', 'PUJATO NORTE', '3080', NULL, NULL);
INSERT INTO `localidades` VALUES(3441, 21, 1, 'SANTA FE', 'RAFAELA', '2300', NULL, NULL);
INSERT INTO `localidades` VALUES(3442, 21, 1, 'SANTA FE', 'RAMAYON', '3042', NULL, NULL);
INSERT INTO `localidades` VALUES(3443, 21, 1, 'SANTA FE', 'RAMONA', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3444, 21, 1, 'SANTA FE', 'RAQUEL', '2322', NULL, NULL);
INSERT INTO `localidades` VALUES(3445, 21, 1, 'SANTA FE', 'RASTREADOR FOURNIER', '2605', NULL, NULL);
INSERT INTO `localidades` VALUES(3446, 21, 1, 'SANTA FE', 'RECONQUISTA', '3560', NULL, NULL);
INSERT INTO `localidades` VALUES(3447, 21, 1, 'SANTA FE', 'RECREO', '3018', NULL, NULL);
INSERT INTO `localidades` VALUES(3448, 21, 1, 'SANTA FE', 'RICARDITO', '3572', NULL, NULL);
INSERT INTO `localidades` VALUES(3449, 21, 1, 'SANTA FE', 'RICARDONE', '2201', NULL, NULL);
INSERT INTO `localidades` VALUES(3450, 21, 1, 'SANTA FE', 'RINCON DEL QUEBRACHO', '3025', NULL, NULL);
INSERT INTO `localidades` VALUES(3451, 21, 1, 'SANTA FE', 'RINCON NORTE', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3452, 21, 1, 'SANTA FE', 'RINCON POTREROS', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3453, 21, 1, 'SANTA FE', 'ROLDAN', '2134', NULL, NULL);
INSERT INTO `localidades` VALUES(3454, 21, 1, 'SANTA FE', 'ROMANG', '3555', NULL, NULL);
INSERT INTO `localidades` VALUES(3455, 21, 1, 'SANTA FE', 'ROSARIO', '2000', NULL, NULL);
INSERT INTO `localidades` VALUES(3456, 21, 1, 'SANTA FE', 'RUEDA', '2921', NULL, NULL);
INSERT INTO `localidades` VALUES(3457, 21, 1, 'SANTA FE', 'RUEDAS', '2921', NULL, NULL);
INSERT INTO `localidades` VALUES(3458, 21, 1, 'SANTA FE', 'RUFINO', '6100', NULL, NULL);
INSERT INTO `localidades` VALUES(3459, 21, 1, 'SANTA FE', 'RUNCIMAN', '2611', NULL, NULL);
INSERT INTO `localidades` VALUES(3460, 21, 1, 'SANTA FE', 'SAA PEREYRA', '3011', NULL, NULL);
INSERT INTO `localidades` VALUES(3461, 21, 1, 'SANTA FE', 'SAGUIER', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3462, 21, 1, 'SANTA FE', 'SALADERO CABAL', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3463, 21, 1, 'SANTA FE', 'SALTO GRANDE', '2172', NULL, NULL);
INSERT INTO `localidades` VALUES(3464, 21, 1, 'SANTA FE', 'SAN AGUSTIN (SFN)', '3017', NULL, NULL);
INSERT INTO `localidades` VALUES(3465, 21, 1, 'SANTA FE', 'SAN ANTONIO (SFN)', '3589', NULL, NULL);
INSERT INTO `localidades` VALUES(3466, 21, 1, 'SANTA FE', 'SAN ANTONIO DE OBLIGADO', '3587', NULL, NULL);
INSERT INTO `localidades` VALUES(3467, 21, 1, 'SANTA FE', 'SAN BERNARDO (SFN)', '3061', NULL, NULL);
INSERT INTO `localidades` VALUES(3468, 21, 1, 'SANTA FE', 'SAN CARLOS CENTRO', '3013', NULL, NULL);
INSERT INTO `localidades` VALUES(3469, 21, 1, 'SANTA FE', 'SAN CARLOS NORTE', '3009', NULL, NULL);
INSERT INTO `localidades` VALUES(3470, 21, 1, 'SANTA FE', 'SAN CARLOS SUR', '3013', NULL, NULL);
INSERT INTO `localidades` VALUES(3471, 21, 1, 'SANTA FE', 'SAN CRISTOBAL', '3070', NULL, NULL);
INSERT INTO `localidades` VALUES(3472, 21, 1, 'SANTA FE', 'SAN EDUARDO', '2615', NULL, NULL);
INSERT INTO `localidades` VALUES(3473, 21, 1, 'SANTA FE', 'SAN ESTANISLAO', '2501', NULL, NULL);
INSERT INTO `localidades` VALUES(3474, 21, 1, 'SANTA FE', 'SAN EUGENIO', '2253', NULL, NULL);
INSERT INTO `localidades` VALUES(3475, 21, 1, 'SANTA FE', 'SAN FABIAN', '2242', NULL, NULL);
INSERT INTO `localidades` VALUES(3476, 21, 1, 'SANTA FE', 'SAN FRANCISCO (SFN)', '2601', NULL, NULL);
INSERT INTO `localidades` VALUES(3477, 21, 1, 'SANTA FE', 'SAN GENARO NORTE', '2147', NULL, NULL);
INSERT INTO `localidades` VALUES(3478, 21, 1, 'SANTA FE', 'SAN GENARO SUR', '2146', NULL, NULL);
INSERT INTO `localidades` VALUES(3479, 21, 1, 'SANTA FE', 'SAN GERONIMO SUD', '2136', NULL, NULL);
INSERT INTO `localidades` VALUES(3480, 21, 1, 'SANTA FE', 'SAN GREGORIO', '2613', NULL, NULL);
INSERT INTO `localidades` VALUES(3481, 21, 1, 'SANTA FE', 'SAN GUILLERMO', '2347', NULL, NULL);
INSERT INTO `localidades` VALUES(3482, 21, 1, 'SANTA FE', 'SAN JAVIER (SFN)', '3005', NULL, NULL);
INSERT INTO `localidades` VALUES(3483, 21, 1, 'SANTA FE', 'SAN JERONIMO DEL SAUCE', '3009', NULL, NULL);
INSERT INTO `localidades` VALUES(3484, 21, 1, 'SANTA FE', 'SAN JERONIMO NORTE', '3011', NULL, NULL);
INSERT INTO `localidades` VALUES(3485, 21, 1, 'SANTA FE', 'SAN JOAQUIN (SFN)', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3486, 21, 1, 'SANTA FE', 'SAN JORGE', '2451', NULL, NULL);
INSERT INTO `localidades` VALUES(3487, 21, 1, 'SANTA FE', 'SAN JOSE DE LA ESQUINA', '2185', NULL, NULL);
INSERT INTO `localidades` VALUES(3488, 21, 1, 'SANTA FE', 'SAN JOSE DEL RINCON', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3489, 21, 1, 'SANTA FE', 'SAN JUSTO (SFN)', '3040', NULL, NULL);
INSERT INTO `localidades` VALUES(3490, 21, 1, 'SANTA FE', 'SAN LORENZO (SFN)', '2200', NULL, NULL);
INSERT INTO `localidades` VALUES(3491, 21, 1, 'SANTA FE', 'SAN MARIANO', '3011', NULL, NULL);
INSERT INTO `localidades` VALUES(3492, 21, 1, 'SANTA FE', 'SAN MARTIN DE LAS ESCOBAS', '2449', NULL, NULL);
INSERT INTO `localidades` VALUES(3493, 21, 1, 'SANTA FE', 'SAN MARTIN DE TOURS', '2255', NULL, NULL);
INSERT INTO `localidades` VALUES(3494, 21, 1, 'SANTA FE', 'SAN MARTIN NORTE', '3045', NULL, NULL);
INSERT INTO `localidades` VALUES(3495, 21, 1, 'SANTA FE', 'SAN RICARDO', '2501', NULL, NULL);
INSERT INTO `localidades` VALUES(3496, 21, 1, 'SANTA FE', 'SAN VICENTE (SFN)', '2447', NULL, NULL);
INSERT INTO `localidades` VALUES(3497, 21, 1, 'SANTA FE', 'SANFORD', '2173', NULL, NULL);
INSERT INTO `localidades` VALUES(3498, 21, 1, 'SANTA FE', 'SANTA CLARA DE BUENA VISTA', '2258', NULL, NULL);
INSERT INTO `localidades` VALUES(3499, 21, 1, 'SANTA FE', 'SANTA EMILIA', '2605', NULL, NULL);
INSERT INTO `localidades` VALUES(3500, 21, 1, 'SANTA FE', 'SANTA FE', '3000', NULL, NULL);
INSERT INTO `localidades` VALUES(3501, 21, 1, 'SANTA FE', 'SANTA ISABEL (SFN)', '2605', NULL, NULL);
INSERT INTO `localidades` VALUES(3502, 21, 1, 'SANTA FE', 'SANTA LUCIA (SFN)', '3553', NULL, NULL);
INSERT INTO `localidades` VALUES(3503, 21, 1, 'SANTA FE', 'SANTA MARGARITA', '3061', NULL, NULL);
INSERT INTO `localidades` VALUES(3504, 21, 1, 'SANTA FE', 'SANTA ROSA (SFN)', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3505, 21, 1, 'SANTA FE', 'SANTA ROSA DE CALCHINES', '3001', NULL, NULL);
INSERT INTO `localidades` VALUES(3506, 21, 1, 'SANTA FE', 'SANTA TERESA', '2111', NULL, NULL);
INSERT INTO `localidades` VALUES(3507, 21, 1, 'SANTA FE', 'SANTI SPIRITU', '2617', NULL, NULL);
INSERT INTO `localidades` VALUES(3508, 21, 1, 'SANTA FE', 'SANTO DOMINGO', '3025', NULL, NULL);
INSERT INTO `localidades` VALUES(3509, 21, 1, 'SANTA FE', 'SANTO TOME (SFN)', '3016', NULL, NULL);
INSERT INTO `localidades` VALUES(3510, 21, 1, 'SANTA FE', 'SANTURCE', '3074', NULL, NULL);
INSERT INTO `localidades` VALUES(3511, 21, 1, 'SANTA FE', 'SARGENTO CABRAL', '2105', NULL, NULL);
INSERT INTO `localidades` VALUES(3512, 21, 1, 'SANTA FE', 'SARMIENTO', '3023', NULL, NULL);
INSERT INTO `localidades` VALUES(3513, 21, 1, 'SANTA FE', 'SASTRE', '2440', NULL, NULL);
INSERT INTO `localidades` VALUES(3514, 21, 1, 'SANTA FE', 'SAUCE VIEJO', '3017', NULL, NULL);
INSERT INTO `localidades` VALUES(3515, 21, 1, 'SANTA FE', 'SERODINO', '2216', NULL, NULL);
INSERT INTO `localidades` VALUES(3516, 21, 1, 'SANTA FE', 'SOLDINI', '2107', NULL, NULL);
INSERT INTO `localidades` VALUES(3517, 21, 1, 'SANTA FE', 'SOLEDAD', '3025', NULL, NULL);
INSERT INTO `localidades` VALUES(3518, 21, 1, 'SANTA FE', 'SOUTO MAYOR', '3025', NULL, NULL);
INSERT INTO `localidades` VALUES(3519, 21, 1, 'SANTA FE', 'STEPHENSON', '2103', NULL, NULL);
INSERT INTO `localidades` VALUES(3520, 21, 1, 'SANTA FE', 'SUARDI', '2349', NULL, NULL);
INSERT INTO `localidades` VALUES(3521, 21, 1, 'SANTA FE', 'SUNCHALES', '2322', NULL, NULL);
INSERT INTO `localidades` VALUES(3522, 21, 1, 'SANTA FE', 'SUSANA', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3523, 21, 1, 'SANTA FE', 'TACUARENDI', '3587', NULL, NULL);
INSERT INTO `localidades` VALUES(3524, 21, 1, 'SANTA FE', 'TACURAL', '2324', NULL, NULL);
INSERT INTO `localidades` VALUES(3525, 21, 1, 'SANTA FE', 'TARRAGONA', '6103', NULL, NULL);
INSERT INTO `localidades` VALUES(3526, 21, 1, 'SANTA FE', 'TARTAGAL (SFN)', '3565', NULL, NULL);
INSERT INTO `localidades` VALUES(3527, 21, 1, 'SANTA FE', 'TEODELINA', '6009', NULL, NULL);
INSERT INTO `localidades` VALUES(3528, 21, 1, 'SANTA FE', 'THEOBALD', '2918', NULL, NULL);
INSERT INTO `localidades` VALUES(3529, 21, 1, 'SANTA FE', 'TIMBUES', '2204', NULL, NULL);
INSERT INTO `localidades` VALUES(3530, 21, 1, 'SANTA FE', 'TOBA', '3551', NULL, NULL);
INSERT INTO `localidades` VALUES(3531, 21, 1, 'SANTA FE', 'TORTUGAS', '2512', NULL, NULL);
INSERT INTO `localidades` VALUES(3532, 21, 1, 'SANTA FE', 'TOSTADO', '3060', NULL, NULL);
INSERT INTO `localidades` VALUES(3533, 21, 1, 'SANTA FE', 'TOTORAS', '2144', NULL, NULL);
INSERT INTO `localidades` VALUES(3534, 21, 1, 'SANTA FE', 'TRAILL', '2456', NULL, NULL);
INSERT INTO `localidades` VALUES(3535, 21, 1, 'SANTA FE', 'URANGA (SFN)', '2105', NULL, NULL);
INSERT INTO `localidades` VALUES(3536, 21, 1, 'SANTA FE', 'VENADO TUERTO', '2600', NULL, NULL);
INSERT INTO `localidades` VALUES(3537, 21, 1, 'SANTA FE', 'VERA Y PINTADO', '3054', NULL, NULL);
INSERT INTO `localidades` VALUES(3538, 21, 1, 'SANTA FE', 'VIDELA', '3048', NULL, NULL);
INSERT INTO `localidades` VALUES(3539, 21, 1, 'SANTA FE', 'VILLA ADELA', '3581', NULL, NULL);
INSERT INTO `localidades` VALUES(3540, 21, 1, 'SANTA FE', 'VILLA AMELIA', '2101', NULL, NULL);
INSERT INTO `localidades` VALUES(3541, 21, 1, 'SANTA FE', 'VILLA ANA', '3583', NULL, NULL);
INSERT INTO `localidades` VALUES(3542, 21, 1, 'SANTA FE', 'VILLA CAÑAS', '2607', NULL, NULL);
INSERT INTO `localidades` VALUES(3543, 21, 1, 'SANTA FE', 'VILLA CONSTITUCION', '2919', NULL, NULL);
INSERT INTO `localidades` VALUES(3544, 21, 1, 'SANTA FE', 'VILLA DE LA RIVERA', '2204', NULL, NULL);
INSERT INTO `localidades` VALUES(3545, 21, 1, 'SANTA FE', 'VILLA DIEGO', '2124', NULL, NULL);
INSERT INTO `localidades` VALUES(3546, 21, 1, 'SANTA FE', 'VILLA ELOISA', '2503', NULL, NULL);
INSERT INTO `localidades` VALUES(3547, 21, 1, 'SANTA FE', 'VILLA ESTELA', '2726', NULL, NULL);
INSERT INTO `localidades` VALUES(3548, 21, 1, 'SANTA FE', 'VILLA FREDICKSON', '2630', NULL, NULL);
INSERT INTO `localidades` VALUES(3549, 21, 1, 'SANTA FE', 'VILLA GOBERNADOR GALVEZ', '2124', NULL, NULL);
INSERT INTO `localidades` VALUES(3550, 21, 1, 'SANTA FE', 'VILLA GUILLERMINA', '3589', NULL, NULL);
INSERT INTO `localidades` VALUES(3551, 21, 1, 'SANTA FE', 'VILLA MINETTI', '3061', NULL, NULL);
INSERT INTO `localidades` VALUES(3552, 21, 1, 'SANTA FE', 'VILLA MUGUETA', '2175', NULL, NULL);
INSERT INTO `localidades` VALUES(3553, 21, 1, 'SANTA FE', 'VILLA OCAMPO', '3580', NULL, NULL);
INSERT INTO `localidades` VALUES(3554, 21, 1, 'SANTA FE', 'VILLA SAN JOSE', '2301', NULL, NULL);
INSERT INTO `localidades` VALUES(3555, 21, 1, 'SANTA FE', 'VILLA SARALEGUI', '3046', NULL, NULL);
INSERT INTO `localidades` VALUES(3556, 21, 1, 'SANTA FE', 'VILLA TRINIDAD', '2345', NULL, NULL);
INSERT INTO `localidades` VALUES(3557, 21, 1, 'SANTA FE', 'VILLADA', '2173', NULL, NULL);
INSERT INTO `localidades` VALUES(3558, 21, 1, 'SANTA FE', 'VIRGINIA', '2311', NULL, NULL);
INSERT INTO `localidades` VALUES(3559, 21, 1, 'SANTA FE', 'WHEELWRIGHT', '2722', NULL, NULL);
INSERT INTO `localidades` VALUES(3560, 21, 1, 'SANTA FE', 'ZAVALLA', '2123', NULL, NULL);
INSERT INTO `localidades` VALUES(3561, 21, 1, 'SANTA FE', 'ZAVALLA - FACULTAD DE AGRONOMIA UNR', '2125', NULL, NULL);
INSERT INTO `localidades` VALUES(3562, 21, 1, 'SANTA FE', 'ZENON PEREYRA', '2409', NULL, NULL);
INSERT INTO `localidades` VALUES(3563, 21, 1, 'SANTA FE', 'ÑANDUCITA', '3072', NULL, NULL);
INSERT INTO `localidades` VALUES(3564, 22, 1, 'SANTIAGO DEL ESTERO', 'ARRAGA', '4206', NULL, NULL);
INSERT INTO `localidades` VALUES(3565, 22, 1, 'SANTIAGO DEL ESTERO', 'AÑATUYA', '3760', NULL, NULL);
INSERT INTO `localidades` VALUES(3566, 22, 1, 'SANTIAGO DEL ESTERO', 'BANDERA', '3064', NULL, NULL);
INSERT INTO `localidades` VALUES(3567, 22, 1, 'SANTIAGO DEL ESTERO', 'BELTRAN', '4205', NULL, NULL);
INSERT INTO `localidades` VALUES(3568, 22, 1, 'SANTIAGO DEL ESTERO', 'BREA POZO', '4313', NULL, NULL);
INSERT INTO `localidades` VALUES(3569, 22, 1, 'SANTIAGO DEL ESTERO', 'CHOYA (SGO)', '4233', NULL, NULL);
INSERT INTO `localidades` VALUES(3570, 22, 1, 'SANTIAGO DEL ESTERO', 'CLODOMIRA', '4338', NULL, NULL);
INSERT INTO `localidades` VALUES(3571, 22, 1, 'SANTIAGO DEL ESTERO', 'COLONIA DORA', '4332', NULL, NULL);
INSERT INTO `localidades` VALUES(3572, 22, 1, 'SANTIAGO DEL ESTERO', 'EL CABURÉ', '3712', NULL, NULL);
INSERT INTO `localidades` VALUES(3573, 22, 1, 'SANTIAGO DEL ESTERO', 'FERNANDEZ', '4322', NULL, NULL);
INSERT INTO `localidades` VALUES(3574, 22, 1, 'SANTIAGO DEL ESTERO', 'FORRES', '4312', NULL, NULL);
INSERT INTO `localidades` VALUES(3575, 22, 1, 'SANTIAGO DEL ESTERO', 'FORTIN INCA', '3062', NULL, NULL);
INSERT INTO `localidades` VALUES(3576, 22, 1, 'SANTIAGO DEL ESTERO', 'FRIAS', '4230', NULL, NULL);
INSERT INTO `localidades` VALUES(3577, 22, 1, 'SANTIAGO DEL ESTERO', 'GARZA', '4324', NULL, NULL);
INSERT INTO `localidades` VALUES(3578, 22, 1, 'SANTIAGO DEL ESTERO', 'GUARDIA ESCOLTA', '3062', NULL, NULL);
INSERT INTO `localidades` VALUES(3579, 22, 1, 'SANTIAGO DEL ESTERO', 'HERRERA (SGO)', '4328', NULL, NULL);
INSERT INTO `localidades` VALUES(3580, 22, 1, 'SANTIAGO DEL ESTERO', 'ICA¥O (SGO)', '4334', NULL, NULL);
INSERT INTO `localidades` VALUES(3581, 22, 1, 'SANTIAGO DEL ESTERO', 'LA BANDA', '4300', NULL, NULL);
INSERT INTO `localidades` VALUES(3582, 22, 1, 'SANTIAGO DEL ESTERO', 'LA CAÑADA', '4354', NULL, NULL);
INSERT INTO `localidades` VALUES(3583, 22, 1, 'SANTIAGO DEL ESTERO', 'LA NORIA (DTO LORETO, SGO DEL ESTER', '4208', NULL, NULL);
INSERT INTO `localidades` VALUES(3584, 22, 1, 'SANTIAGO DEL ESTERO', 'LA NORIA (ESTACION ATAMISQUI)', '4315', NULL, NULL);
INSERT INTO `localidades` VALUES(3585, 22, 1, 'SANTIAGO DEL ESTERO', 'LA PORTEÑA', '4206', NULL, NULL);
INSERT INTO `localidades` VALUES(3586, 22, 1, 'SANTIAGO DEL ESTERO', 'LA PRIMAVERA', '5250', NULL, NULL);
INSERT INTO `localidades` VALUES(3587, 22, 1, 'SANTIAGO DEL ESTERO', 'LA PUNTA', '4203', NULL, NULL);
INSERT INTO `localidades` VALUES(3588, 22, 1, 'SANTIAGO DEL ESTERO', 'LAS FLORES (AVERITAS, DTO G TABOADA', '3766', NULL, NULL);
INSERT INTO `localidades` VALUES(3589, 22, 1, 'SANTIAGO DEL ESTERO', 'LAS FLORES (FRIAS, DTO CHOYA)', '4230', NULL, NULL);
INSERT INTO `localidades` VALUES(3590, 22, 1, 'SANTIAGO DEL ESTERO', 'LAS FLORES (LA PUNTA, DTO CHOYA)', '4203', NULL, NULL);
INSERT INTO `localidades` VALUES(3591, 22, 1, 'SANTIAGO DEL ESTERO', 'LAS FLORES (LAVALLE, DTO GUASAYAN)', '4234', NULL, NULL);
INSERT INTO `localidades` VALUES(3592, 22, 1, 'SANTIAGO DEL ESTERO', 'LAS FLORES (PUEST SAN ANT, D CAPITA', '4206', NULL, NULL);
INSERT INTO `localidades` VALUES(3593, 22, 1, 'SANTIAGO DEL ESTERO', 'LAS FLORES (SOL DE JULIO, OJO DE AG', '5251', NULL, NULL);
INSERT INTO `localidades` VALUES(3594, 22, 1, 'SANTIAGO DEL ESTERO', 'LAS FLORES (SUMAMPA, DTO QUEBRACHOS', '5253', NULL, NULL);
INSERT INTO `localidades` VALUES(3595, 22, 1, 'SANTIAGO DEL ESTERO', 'LAS HERMANAS (ZONA LA BANDA)', '4300', NULL, NULL);
INSERT INTO `localidades` VALUES(3596, 22, 1, 'SANTIAGO DEL ESTERO', 'LAVALLE (SGO)', '4234', NULL, NULL);
INSERT INTO `localidades` VALUES(3597, 22, 1, 'SANTIAGO DEL ESTERO', 'LORETO', '4208', NULL, NULL);
INSERT INTO `localidades` VALUES(3598, 22, 1, 'SANTIAGO DEL ESTERO', 'LOS JURIES', '3763', NULL, NULL);
INSERT INTO `localidades` VALUES(3599, 22, 1, 'SANTIAGO DEL ESTERO', 'LOS NARANJOS', '4300', NULL, NULL);
INSERT INTO `localidades` VALUES(3600, 22, 1, 'SANTIAGO DEL ESTERO', 'LOS PIRTINTOS', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(3601, 22, 1, 'SANTIAGO DEL ESTERO', 'LUJAN (SGO)', '4328', NULL, NULL);
INSERT INTO `localidades` VALUES(3602, 22, 1, 'SANTIAGO DEL ESTERO', 'MALBRAN', '2354', NULL, NULL);
INSERT INTO `localidades` VALUES(3603, 22, 1, 'SANTIAGO DEL ESTERO', 'MONTE QUEMADO', '3714', NULL, NULL);
INSERT INTO `localidades` VALUES(3604, 22, 1, 'SANTIAGO DEL ESTERO', 'PAMPA DE LOS GUANACO', '3712', NULL, NULL);
INSERT INTO `localidades` VALUES(3605, 22, 1, 'SANTIAGO DEL ESTERO', 'PINTOS (SGO)', '2356', NULL, NULL);
INSERT INTO `localidades` VALUES(3606, 22, 1, 'SANTIAGO DEL ESTERO', 'QUIMILI', '3740', NULL, NULL);
INSERT INTO `localidades` VALUES(3607, 22, 1, 'SANTIAGO DEL ESTERO', 'REAL SAYANA', '4334', NULL, NULL);
INSERT INTO `localidades` VALUES(3608, 22, 1, 'SANTIAGO DEL ESTERO', 'SACHAYOJ', '3731', NULL, NULL);
INSERT INTO `localidades` VALUES(3609, 22, 1, 'SANTIAGO DEL ESTERO', 'SAN RAMON', '4302', NULL, NULL);
INSERT INTO `localidades` VALUES(3610, 22, 1, 'SANTIAGO DEL ESTERO', 'SANTA CATALINA', '4203', NULL, NULL);
INSERT INTO `localidades` VALUES(3611, 22, 1, 'SANTIAGO DEL ESTERO', 'SANTIAGO DEL ESTERO', '4200', NULL, NULL);
INSERT INTO `localidades` VALUES(3612, 22, 1, 'SANTIAGO DEL ESTERO', 'SELVA', '2354', NULL, NULL);
INSERT INTO `localidades` VALUES(3613, 22, 1, 'SANTIAGO DEL ESTERO', 'SIMBOLAR (SGO)', '4339', NULL, NULL);
INSERT INTO `localidades` VALUES(3614, 22, 1, 'SANTIAGO DEL ESTERO', 'SOL DE MAYO', '4315', NULL, NULL);
INSERT INTO `localidades` VALUES(3615, 22, 1, 'SANTIAGO DEL ESTERO', 'SUNCHO CORRAL', '4350', NULL, NULL);
INSERT INTO `localidades` VALUES(3616, 22, 1, 'SANTIAGO DEL ESTERO', 'TACO POZO', '3714', NULL, NULL);
INSERT INTO `localidades` VALUES(3617, 22, 1, 'SANTIAGO DEL ESTERO', 'TERMAS DE RIO HONDO', '4220', NULL, NULL);
INSERT INTO `localidades` VALUES(3618, 22, 1, 'SANTIAGO DEL ESTERO', 'TOMAS YOUNG', '3165', NULL, NULL);
INSERT INTO `localidades` VALUES(3619, 22, 1, 'SANTIAGO DEL ESTERO', 'VILLA SAN MARTIN', '4208', NULL, NULL);
INSERT INTO `localidades` VALUES(3620, 22, 1, 'SANTIAGO DEL ESTERO', 'VILMER', '4302', NULL, NULL);
INSERT INTO `localidades` VALUES(3621, 23, 1, 'TIERRA DEL FUEGO', 'RIO GRANDE', '9420', NULL, NULL);
INSERT INTO `localidades` VALUES(3622, 23, 1, 'TIERRA DEL FUEGO', 'TOLHUIN', '9420', NULL, NULL);
INSERT INTO `localidades` VALUES(3623, 23, 1, 'TIERRA DEL FUEGO', 'USHUAIA', '9410', NULL, NULL);
INSERT INTO `localidades` VALUES(3624, 24, 1, 'TUCUMAN', '7 DE ABRIL', '4195', NULL, NULL);
INSERT INTO `localidades` VALUES(3625, 24, 1, 'TUCUMAN', 'A. DEL LLAMO', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3626, 24, 1, 'TUCUMAN', 'ACHERAL', '4134', NULL, NULL);
INSERT INTO `localidades` VALUES(3627, 24, 1, 'TUCUMAN', 'AGUA DULCE', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3628, 24, 1, 'TUCUMAN', 'AGUILARES', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3629, 24, 1, 'TUCUMAN', 'AGUILARES', '4152', NULL, NULL);
INSERT INTO `localidades` VALUES(3630, 24, 1, 'TUCUMAN', 'ALABAMA', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3631, 24, 1, 'TUCUMAN', 'ALBERDI', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3632, 24, 1, 'TUCUMAN', 'ALBOL GRANDE', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3633, 24, 1, 'TUCUMAN', 'ALDERETES', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3634, 24, 1, 'TUCUMAN', 'ALPACHIRI', '4149', NULL, NULL);
INSERT INTO `localidades` VALUES(3635, 24, 1, 'TUCUMAN', 'ALTO VERDE (TUC)', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3636, 24, 1, 'TUCUMAN', 'ALTO VERDE (TUC)', '4153', NULL, NULL);
INSERT INTO `localidades` VALUES(3637, 24, 1, 'TUCUMAN', 'AMBERES', '4144', NULL, NULL);
INSERT INTO `localidades` VALUES(3638, 24, 1, 'TUCUMAN', 'AMPATA', '4174', NULL, NULL);
INSERT INTO `localidades` VALUES(3639, 24, 1, 'TUCUMAN', 'ARBOL SOLO', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3640, 24, 1, 'TUCUMAN', 'ARCADIA', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3641, 24, 1, 'TUCUMAN', 'ARCADIA', '4147', NULL, NULL);
INSERT INTO `localidades` VALUES(3642, 24, 1, 'TUCUMAN', 'ARENALES', '4187', NULL, NULL);
INSERT INTO `localidades` VALUES(3643, 24, 1, 'TUCUMAN', 'ATAHONA', '4174', NULL, NULL);
INSERT INTO `localidades` VALUES(3644, 24, 1, 'TUCUMAN', 'BAJO GRANDE', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3645, 24, 1, 'TUCUMAN', 'BALDERRAMA', '4166', NULL, NULL);
INSERT INTO `localidades` VALUES(3646, 24, 1, 'TUCUMAN', 'BANDA RIO SALI', '4109', NULL, NULL);
INSERT INTO `localidades` VALUES(3647, 24, 1, 'TUCUMAN', 'BARRANQUEROS', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3648, 24, 1, 'TUCUMAN', 'BATIRUANA', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3649, 24, 1, 'TUCUMAN', 'BELICHA', '4149', NULL, NULL);
INSERT INTO `localidades` VALUES(3650, 24, 1, 'TUCUMAN', 'BELLA VISTA (LEALES)', '4168', NULL, NULL);
INSERT INTO `localidades` VALUES(3651, 24, 1, 'TUCUMAN', 'BELLA VISTA (TUC )', '4121', NULL, NULL);
INSERT INTO `localidades` VALUES(3652, 24, 1, 'TUCUMAN', 'BELLA VISTA (TUC)', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3653, 24, 1, 'TUCUMAN', 'BENJAMIN ARAOZ', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3654, 24, 1, 'TUCUMAN', 'BENJAMIN PAZ', '4122', NULL, NULL);
INSERT INTO `localidades` VALUES(3655, 24, 1, 'TUCUMAN', 'BLACA POZO', '4332', NULL, NULL);
INSERT INTO `localidades` VALUES(3656, 24, 1, 'TUCUMAN', 'BOCA DE TIGRE', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3657, 24, 1, 'TUCUMAN', 'BURRUYACO', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3658, 24, 1, 'TUCUMAN', 'B° BELGRANO', '4109', NULL, NULL);
INSERT INTO `localidades` VALUES(3659, 24, 1, 'TUCUMAN', 'C. DE TALAMAYO', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3660, 24, 1, 'TUCUMAN', 'CAMPO DE HERRERA', '4105', NULL, NULL);
INSERT INTO `localidades` VALUES(3661, 24, 1, 'TUCUMAN', 'CAMPO QUIMIL', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3662, 24, 1, 'TUCUMAN', 'CAMPOS VOLANTES', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3663, 24, 1, 'TUCUMAN', 'CAPITAN CACERES', '4142', NULL, NULL);
INSERT INTO `localidades` VALUES(3664, 24, 1, 'TUCUMAN', 'CARBON POZO', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3665, 24, 1, 'TUCUMAN', 'CARRETA QUEMADA', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3666, 24, 1, 'TUCUMAN', 'CASPICHANGO', '4135', NULL, NULL);
INSERT INTO `localidades` VALUES(3667, 24, 1, 'TUCUMAN', 'CAÑADA DE ALZOGARAY', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3668, 24, 1, 'TUCUMAN', 'CAÑADA DE VICLOS', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3669, 24, 1, 'TUCUMAN', 'CAÑETE', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3670, 24, 1, 'TUCUMAN', 'CEVIL POZO', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3671, 24, 1, 'TUCUMAN', 'CEVIL REDONDO', '4105', NULL, NULL);
INSERT INTO `localidades` VALUES(3672, 24, 1, 'TUCUMAN', 'CHAÑAR VIEJO', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3673, 24, 1, 'TUCUMAN', 'CHOROMORO', '4122', NULL, NULL);
INSERT INTO `localidades` VALUES(3674, 24, 1, 'TUCUMAN', 'CHOROMORO', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3675, 24, 1, 'TUCUMAN', 'CHUSCHA', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3676, 24, 1, 'TUCUMAN', 'CIUCACITA', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3677, 24, 1, 'TUCUMAN', 'CIUDACITA', '4174', NULL, NULL);
INSERT INTO `localidades` VALUES(3678, 24, 1, 'TUCUMAN', 'COLMENAR', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3679, 24, 1, 'TUCUMAN', 'COLOMBRES', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3680, 24, 1, 'TUCUMAN', 'COLONIA 1', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(3681, 24, 1, 'TUCUMAN', 'COLONIA 2', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(3682, 24, 1, 'TUCUMAN', 'COLONIA 3', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(3683, 24, 1, 'TUCUMAN', 'COLONIA LOLITAS', '4182', NULL, NULL);
INSERT INTO `localidades` VALUES(3684, 24, 1, 'TUCUMAN', 'COLONIA MEDIA AGUA', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3685, 24, 1, 'TUCUMAN', 'COLONIA ORTIZ', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3686, 24, 1, 'TUCUMAN', 'CONCEPCIÓN (TUC)', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3687, 24, 1, 'TUCUMAN', 'CONDER HUASI', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3688, 24, 1, 'TUCUMAN', 'CONDOR HUASI', '4115', NULL, NULL);
INSERT INTO `localidades` VALUES(3689, 24, 1, 'TUCUMAN', 'CORRALITO', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3690, 24, 1, 'TUCUMAN', 'DELFIN GALLO', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3691, 24, 1, 'TUCUMAN', 'DELFIN GALLO', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3692, 24, 1, 'TUCUMAN', 'DIAGONAL', '4103', NULL, NULL);
INSERT INTO `localidades` VALUES(3693, 24, 1, 'TUCUMAN', 'DONATO ALVAREZ', '4161', NULL, NULL);
INSERT INTO `localidades` VALUES(3694, 24, 1, 'TUCUMAN', 'DOS POZOS', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3695, 24, 1, 'TUCUMAN', 'EL BAGUAL', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3696, 24, 1, 'TUCUMAN', 'EL BAJO', '4164', NULL, NULL);
INSERT INTO `localidades` VALUES(3697, 24, 1, 'TUCUMAN', 'EL BRACHO', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3698, 24, 1, 'TUCUMAN', 'EL BRETE', '4126', NULL, NULL);
INSERT INTO `localidades` VALUES(3699, 24, 1, 'TUCUMAN', 'EL CADILLAL', '4122', NULL, NULL);
INSERT INTO `localidades` VALUES(3700, 24, 1, 'TUCUMAN', 'EL CAJON', '4139', NULL, NULL);
INSERT INTO `localidades` VALUES(3701, 24, 1, 'TUCUMAN', 'EL CALELCITO', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3702, 24, 1, 'TUCUMAN', 'EL CARDENAL', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3703, 24, 1, 'TUCUMAN', 'EL CEIVAL', '4105', NULL, NULL);
INSERT INTO `localidades` VALUES(3704, 24, 1, 'TUCUMAN', 'EL CERCADO', '4142', NULL, NULL);
INSERT INTO `localidades` VALUES(3705, 24, 1, 'TUCUMAN', 'EL CEVILAR', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3706, 24, 1, 'TUCUMAN', 'EL CHAÑAR', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3707, 24, 1, 'TUCUMAN', 'EL CHAÑARITO', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3708, 24, 1, 'TUCUMAN', 'EL CHICHAL', '4115', NULL, NULL);
INSERT INTO `localidades` VALUES(3709, 24, 1, 'TUCUMAN', 'EL CORTADERAL', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3710, 24, 1, 'TUCUMAN', 'EL EMPALME', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3711, 24, 1, 'TUCUMAN', 'EL JARDIN', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3712, 24, 1, 'TUCUMAN', 'EL MANANTIAL', '4220', NULL, NULL);
INSERT INTO `localidades` VALUES(3713, 24, 1, 'TUCUMAN', 'EL MISTOL', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3714, 24, 1, 'TUCUMAN', 'EL MISTOL', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3715, 24, 1, 'TUCUMAN', 'EL MOJON', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3716, 24, 1, 'TUCUMAN', 'EL MOJON', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3717, 24, 1, 'TUCUMAN', 'EL MOLINO', '4149', NULL, NULL);
INSERT INTO `localidades` VALUES(3718, 24, 1, 'TUCUMAN', 'EL MOLINO', '4158', NULL, NULL);
INSERT INTO `localidades` VALUES(3719, 24, 1, 'TUCUMAN', 'EL NARANJITO', '4115', NULL, NULL);
INSERT INTO `localidades` VALUES(3720, 24, 1, 'TUCUMAN', 'EL PARAISO (TUC)', '4242', NULL, NULL);
INSERT INTO `localidades` VALUES(3721, 24, 1, 'TUCUMAN', 'EL POLEAR', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3722, 24, 1, 'TUCUMAN', 'EL PORVENIR', '4151', NULL, NULL);
INSERT INTO `localidades` VALUES(3723, 24, 1, 'TUCUMAN', 'EL PORVENIR', '4162', NULL, NULL);
INSERT INTO `localidades` VALUES(3724, 24, 1, 'TUCUMAN', 'EL POTRERILLO', '4149', NULL, NULL);
INSERT INTO `localidades` VALUES(3725, 24, 1, 'TUCUMAN', 'EL PUESTITO', '4149', NULL, NULL);
INSERT INTO `localidades` VALUES(3726, 24, 1, 'TUCUMAN', 'EL PUESTITO', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3727, 24, 1, 'TUCUMAN', 'EL PUESTITO', '4187', NULL, NULL);
INSERT INTO `localidades` VALUES(3728, 24, 1, 'TUCUMAN', 'EL PUESTO', '4149', NULL, NULL);
INSERT INTO `localidades` VALUES(3729, 24, 1, 'TUCUMAN', 'EL PUESTO', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3730, 24, 1, 'TUCUMAN', 'EL RODEO', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3731, 24, 1, 'TUCUMAN', 'EL RODEO', '4155', NULL, NULL);
INSERT INTO `localidades` VALUES(3732, 24, 1, 'TUCUMAN', 'EL SIAMBON', '4105', NULL, NULL);
INSERT INTO `localidades` VALUES(3733, 24, 1, 'TUCUMAN', 'EL SUCHO', '4164', NULL, NULL);
INSERT INTO `localidades` VALUES(3734, 24, 1, 'TUCUMAN', 'EL SUNCHAL', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3735, 24, 1, 'TUCUMAN', 'EL TALA', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3736, 24, 1, 'TUCUMAN', 'EL TALA', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3737, 24, 1, 'TUCUMAN', 'EL TIMBO', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3738, 24, 1, 'TUCUMAN', 'ESQUINA', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3739, 24, 1, 'TUCUMAN', 'ESQUINA', '4176', NULL, NULL);
INSERT INTO `localidades` VALUES(3740, 24, 1, 'TUCUMAN', 'ESTACIÓN ARAOZ', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3741, 24, 1, 'TUCUMAN', 'FAMAILLA', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3742, 24, 1, 'TUCUMAN', 'FINCA LOPEZ', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3743, 24, 1, 'TUCUMAN', 'FINCA MAYO', '4182', NULL, NULL);
INSERT INTO `localidades` VALUES(3744, 24, 1, 'TUCUMAN', 'FINCA SAN LUIS', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3745, 24, 1, 'TUCUMAN', 'GARCIA FERNANDEZ', '4152', NULL, NULL);
INSERT INTO `localidades` VALUES(3746, 24, 1, 'TUCUMAN', 'GARMENDIA', '4187', NULL, NULL);
INSERT INTO `localidades` VALUES(3747, 24, 1, 'TUCUMAN', 'GASTONILLA', '4147', NULL, NULL);
INSERT INTO `localidades` VALUES(3748, 24, 1, 'TUCUMAN', 'GDOR. PIEDRABUENA', '4187', NULL, NULL);
INSERT INTO `localidades` VALUES(3749, 24, 1, 'TUCUMAN', 'GONZALO', '4122', NULL, NULL);
INSERT INTO `localidades` VALUES(3750, 24, 1, 'TUCUMAN', 'GRAMAJO', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3751, 24, 1, 'TUCUMAN', 'GRANEROS', '4159', NULL, NULL);
INSERT INTO `localidades` VALUES(3752, 24, 1, 'TUCUMAN', 'GRANJA MODELO', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3753, 24, 1, 'TUCUMAN', 'GUADAMONTE', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3754, 24, 1, 'TUCUMAN', 'GUAYACANES', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3755, 24, 1, 'TUCUMAN', 'GUEMES', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3756, 24, 1, 'TUCUMAN', 'HILERET', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3757, 24, 1, 'TUCUMAN', 'HUALINCHAY', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3758, 24, 1, 'TUCUMAN', 'HUASA PAMPA SUR', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3759, 24, 1, 'TUCUMAN', 'ILTICO', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3760, 24, 1, 'TUCUMAN', 'INDEPENDENCIA', '4143', NULL, NULL);
INSERT INTO `localidades` VALUES(3761, 24, 1, 'TUCUMAN', 'ING. LA FRONTERITA', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3762, 24, 1, 'TUCUMAN', 'INGENIO LA FLORIDA', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3763, 24, 1, 'TUCUMAN', 'ISCA YACU', '4184', NULL, NULL);
INSERT INTO `localidades` VALUES(3764, 24, 1, 'TUCUMAN', 'ISCHILON', '4142', NULL, NULL);
INSERT INTO `localidades` VALUES(3765, 24, 1, 'TUCUMAN', 'JUAN B. ALBERDI', '4158', NULL, NULL);
INSERT INTO `localidades` VALUES(3766, 24, 1, 'TUCUMAN', 'LA BANDA DEL RIO SALI', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3767, 24, 1, 'TUCUMAN', 'LA BANDA DEL RIO SALI', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3768, 24, 1, 'TUCUMAN', 'LA BANDA DEL RIO SALI', '4133', NULL, NULL);
INSERT INTO `localidades` VALUES(3769, 24, 1, 'TUCUMAN', 'LA CALERA', '4158', NULL, NULL);
INSERT INTO `localidades` VALUES(3770, 24, 1, 'TUCUMAN', 'LA CANDELARIA', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3771, 24, 1, 'TUCUMAN', 'LA CAÑADA DE LA CRUZ', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3772, 24, 1, 'TUCUMAN', 'LA CAÑADA DE LA CRUZ', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3773, 24, 1, 'TUCUMAN', 'LA CAÑADA DE LA CRUZ', '4159', NULL, NULL);
INSERT INTO `localidades` VALUES(3774, 24, 1, 'TUCUMAN', 'LA CHILCA', '4242', NULL, NULL);
INSERT INTO `localidades` VALUES(3775, 24, 1, 'TUCUMAN', 'LA COCHA', '4146', NULL, NULL);
INSERT INTO `localidades` VALUES(3776, 24, 1, 'TUCUMAN', 'LA CRUZ TUC', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3777, 24, 1, 'TUCUMAN', 'LA FAVORITA', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3778, 24, 1, 'TUCUMAN', 'LA FLORIDA (7 DE ABRIL, DTO BURRUYA', '4195', NULL, NULL);
INSERT INTO `localidades` VALUES(3779, 24, 1, 'TUCUMAN', 'LA FLORIDA (DTO CHICLIGASTA)', '4174', NULL, NULL);
INSERT INTO `localidades` VALUES(3780, 24, 1, 'TUCUMAN', 'LA FLORIDA (DTO MONTEROS)', '4144', NULL, NULL);
INSERT INTO `localidades` VALUES(3781, 24, 1, 'TUCUMAN', 'LA FLORIDA (LOS PUESTOS, DTO LEALES', '4115', NULL, NULL);
INSERT INTO `localidades` VALUES(3782, 24, 1, 'TUCUMAN', 'LA FRONTERITA', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3783, 24, 1, 'TUCUMAN', 'LA HIGUERA (TUC)', '4122', NULL, NULL);
INSERT INTO `localidades` VALUES(3784, 24, 1, 'TUCUMAN', 'LA INVERNADA', NULL, NULL, NULL);
INSERT INTO `localidades` VALUES(3785, 24, 1, 'TUCUMAN', 'LA RAMADA', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3786, 24, 1, 'TUCUMAN', 'LA REDUCCION', '4129', NULL, NULL);
INSERT INTO `localidades` VALUES(3787, 24, 1, 'TUCUMAN', 'LA REDUCCION', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3788, 24, 1, 'TUCUMAN', 'LA RINCONADA (TUC)', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3789, 24, 1, 'TUCUMAN', 'LA SOLEDAD', '4139', NULL, NULL);
INSERT INTO `localidades` VALUES(3790, 24, 1, 'TUCUMAN', 'LA TALA', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3791, 24, 1, 'TUCUMAN', 'LA TALA', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3792, 24, 1, 'TUCUMAN', 'LA TRINIDAD (TUC)', '4151', NULL, NULL);
INSERT INTO `localidades` VALUES(3793, 24, 1, 'TUCUMAN', 'LA TUNA', '4149', NULL, NULL);
INSERT INTO `localidades` VALUES(3794, 24, 1, 'TUCUMAN', 'LA ZANJA', '4242', NULL, NULL);
INSERT INTO `localidades` VALUES(3795, 24, 1, 'TUCUMAN', 'LAMADRID', '4176', NULL, NULL);
INSERT INTO `localidades` VALUES(3796, 24, 1, 'TUCUMAN', 'LAS ANIMAS', '4176', NULL, NULL);
INSERT INTO `localidades` VALUES(3797, 24, 1, 'TUCUMAN', 'LAS ARCAS', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3798, 24, 1, 'TUCUMAN', 'LAS CEJAS', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3799, 24, 1, 'TUCUMAN', 'LAS CEJAS', '4186', NULL, NULL);
INSERT INTO `localidades` VALUES(3800, 24, 1, 'TUCUMAN', 'LAS CEJAS', '4186', NULL, NULL);
INSERT INTO `localidades` VALUES(3801, 24, 1, 'TUCUMAN', 'LAS JUNTAS', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3802, 24, 1, 'TUCUMAN', 'LAS MARAVILLAS', '4238', NULL, NULL);
INSERT INTO `localidades` VALUES(3803, 24, 1, 'TUCUMAN', 'LAS MERCEDES', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3804, 24, 1, 'TUCUMAN', 'LAS PIEDRITAS', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3805, 24, 1, 'TUCUMAN', 'LAS PIEDRITAS', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3806, 24, 1, 'TUCUMAN', 'LAS SALINAS', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3807, 24, 1, 'TUCUMAN', 'LAS TACANAS', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3808, 24, 1, 'TUCUMAN', 'LAS TALAS', '4105', NULL, NULL);
INSERT INTO `localidades` VALUES(3809, 24, 1, 'TUCUMAN', 'LAS TALITAS', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3810, 24, 1, 'TUCUMAN', 'LAS TIPAS', '4105', NULL, NULL);
INSERT INTO `localidades` VALUES(3811, 24, 1, 'TUCUMAN', 'LASTENIA', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3812, 24, 1, 'TUCUMAN', 'LAURELES', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3813, 24, 1, 'TUCUMAN', 'LEALES', '4113', NULL, NULL);
INSERT INTO `localidades` VALUES(3814, 24, 1, 'TUCUMAN', 'LEOCADIO PAZ', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3815, 24, 1, 'TUCUMAN', 'LEON ROUGES', '4143', NULL, NULL);
INSERT INTO `localidades` VALUES(3816, 24, 1, 'TUCUMAN', 'LOS AGUIRRES', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3817, 24, 1, 'TUCUMAN', 'LOS BULACIOS', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3818, 24, 1, 'TUCUMAN', 'LOS CORDOBAS', '4157', NULL, NULL);
INSERT INTO `localidades` VALUES(3819, 24, 1, 'TUCUMAN', 'LOS GOMES', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3820, 24, 1, 'TUCUMAN', 'LOS GOMEZ', '4113', NULL, NULL);
INSERT INTO `localidades` VALUES(3821, 24, 1, 'TUCUMAN', 'LOS GUCHEAS', '4151', NULL, NULL);
INSERT INTO `localidades` VALUES(3822, 24, 1, 'TUCUMAN', 'LOS GUTIERREZ', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3823, 24, 1, 'TUCUMAN', 'LOS LAPACHITOS', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3824, 24, 1, 'TUCUMAN', 'LOS LUNAS', '4155', NULL, NULL);
INSERT INTO `localidades` VALUES(3825, 24, 1, 'TUCUMAN', 'LOS NARANJITOS', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3826, 24, 1, 'TUCUMAN', 'LOS NOGALES (TUC)', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3827, 24, 1, 'TUCUMAN', 'LOS PEREYRA', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3828, 24, 1, 'TUCUMAN', 'LOS PEREZ', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3829, 24, 1, 'TUCUMAN', 'LOS PIZARROS', '4162', NULL, NULL);
INSERT INTO `localidades` VALUES(3830, 24, 1, 'TUCUMAN', 'LOS POCITOS', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3831, 24, 1, 'TUCUMAN', 'LOS POCITOS', '4103', NULL, NULL);
INSERT INTO `localidades` VALUES(3832, 24, 1, 'TUCUMAN', 'LOS PUESTOS', '4115', NULL, NULL);
INSERT INTO `localidades` VALUES(3833, 24, 1, 'TUCUMAN', 'LOS QUEMADOS', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3834, 24, 1, 'TUCUMAN', 'LOS QUEMADOS', '4113', NULL, NULL);
INSERT INTO `localidades` VALUES(3835, 24, 1, 'TUCUMAN', 'LOS RALOS', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3836, 24, 1, 'TUCUMAN', 'LOS RALOS', '4182', NULL, NULL);
INSERT INTO `localidades` VALUES(3837, 24, 1, 'TUCUMAN', 'LOS ROJOS', '4143', NULL, NULL);
INSERT INTO `localidades` VALUES(3838, 24, 1, 'TUCUMAN', 'LOS SARMIENTOS (TUC)', '4157', NULL, NULL);
INSERT INTO `localidades` VALUES(3839, 24, 1, 'TUCUMAN', 'LOS SAUCES', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3840, 24, 1, 'TUCUMAN', 'LOS SAUCES', '4176', NULL, NULL);
INSERT INTO `localidades` VALUES(3841, 24, 1, 'TUCUMAN', 'LOS SOSAS', '4142', NULL, NULL);
INSERT INTO `localidades` VALUES(3842, 24, 1, 'TUCUMAN', 'LOS SUELDOS', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3843, 24, 1, 'TUCUMAN', 'LOS VILLAGRA', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3844, 24, 1, 'TUCUMAN', 'LOTE DE AGUA DULCE', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3845, 24, 1, 'TUCUMAN', 'LULES', '4128', NULL, NULL);
INSERT INTO `localidades` VALUES(3846, 24, 1, 'TUCUMAN', 'Los Sarmientos', '4157', NULL, NULL);
INSERT INTO `localidades` VALUES(3847, 24, 1, 'TUCUMAN', 'MACOMITA', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3848, 24, 1, 'TUCUMAN', 'MALVINAS', '4129', NULL, NULL);
INSERT INTO `localidades` VALUES(3849, 24, 1, 'TUCUMAN', 'MANCOPA', '4115', NULL, NULL);
INSERT INTO `localidades` VALUES(3850, 24, 1, 'TUCUMAN', 'MANUELA PEDRAZA', '4166', NULL, NULL);
INSERT INTO `localidades` VALUES(3851, 24, 1, 'TUCUMAN', 'MARAPAS', '4158', NULL, NULL);
INSERT INTO `localidades` VALUES(3852, 24, 1, 'TUCUMAN', 'MARCOS PAZ (TUC)', '4107', NULL, NULL);
INSERT INTO `localidades` VALUES(3853, 24, 1, 'TUCUMAN', 'MEDINA', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3854, 24, 1, 'TUCUMAN', 'MERCEDES (TUC)', '4128', NULL, NULL);
INSERT INTO `localidades` VALUES(3855, 24, 1, 'TUCUMAN', 'MIXTA', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3856, 24, 1, 'TUCUMAN', 'MIXTA', '4115', NULL, NULL);
INSERT INTO `localidades` VALUES(3857, 24, 1, 'TUCUMAN', 'MONTE BELLO', '4157', NULL, NULL);
INSERT INTO `localidades` VALUES(3858, 24, 1, 'TUCUMAN', 'MONTE GRANDE', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3859, 24, 1, 'TUCUMAN', 'MONTE GRANDE', '4133', NULL, NULL);
INSERT INTO `localidades` VALUES(3860, 24, 1, 'TUCUMAN', 'MONTE GRANDE', '4162', NULL, NULL);
INSERT INTO `localidades` VALUES(3861, 24, 1, 'TUCUMAN', 'MONTE REDONDO', '4162', NULL, NULL);
INSERT INTO `localidades` VALUES(3862, 24, 1, 'TUCUMAN', 'MONTEAGUDO', '4174', NULL, NULL);
INSERT INTO `localidades` VALUES(3863, 24, 1, 'TUCUMAN', 'MONTEROS', '4142', NULL, NULL);
INSERT INTO `localidades` VALUES(3864, 24, 1, 'TUCUMAN', 'MUJER MUERTA', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3865, 24, 1, 'TUCUMAN', 'NARANJO', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3866, 24, 1, 'TUCUMAN', 'NOGALES', '4103', NULL, NULL);
INSERT INTO `localidades` VALUES(3867, 24, 1, 'TUCUMAN', 'NUEVA ESPERANZA', '4103', NULL, NULL);
INSERT INTO `localidades` VALUES(3868, 24, 1, 'TUCUMAN', 'PACARA', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3869, 24, 1, 'TUCUMAN', 'PACARA PINTADO', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3870, 24, 1, 'TUCUMAN', 'PADILLA (FAMAILLA)', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3871, 24, 1, 'TUCUMAN', 'PALA PALA', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3872, 24, 1, 'TUCUMAN', 'PALO QUEMADO', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3873, 24, 1, 'TUCUMAN', 'PAMPA POZO', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3874, 24, 1, 'TUCUMAN', 'PAPEL DE TUCUMAN', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3875, 24, 1, 'TUCUMAN', 'PILCO', '4142', NULL, NULL);
INSERT INTO `localidades` VALUES(3876, 24, 1, 'TUCUMAN', 'POTRERO GRANDE', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3877, 24, 1, 'TUCUMAN', 'POTRERO GRANDE', '4168', NULL, NULL);
INSERT INTO `localidades` VALUES(3878, 24, 1, 'TUCUMAN', 'PRIMERO DE MAYO', '4142', NULL, NULL);
INSERT INTO `localidades` VALUES(3879, 24, 1, 'TUCUMAN', 'PUEBLO VIEJO', '4164', NULL, NULL);
INSERT INTO `localidades` VALUES(3880, 24, 1, 'TUCUMAN', 'PUESTOS DE UNCOS', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3881, 24, 1, 'TUCUMAN', 'QUEBRACHITO', '4242', NULL, NULL);
INSERT INTO `localidades` VALUES(3882, 24, 1, 'TUCUMAN', 'QUILMES (LEALES)', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3883, 24, 1, 'TUCUMAN', 'QUINTEROS TRES', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3884, 24, 1, 'TUCUMAN', 'RACO', '4105', NULL, NULL);
INSERT INTO `localidades` VALUES(3885, 24, 1, 'TUCUMAN', 'RANCHILLOS', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3886, 24, 1, 'TUCUMAN', 'RAPELLI', '4189', NULL, NULL);
INSERT INTO `localidades` VALUES(3887, 24, 1, 'TUCUMAN', 'REARTE', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3888, 24, 1, 'TUCUMAN', 'RIO CHICO', '4174', NULL, NULL);
INSERT INTO `localidades` VALUES(3889, 24, 1, 'TUCUMAN', 'RIO COLORADO (TUC)', '4166', NULL, NULL);
INSERT INTO `localidades` VALUES(3890, 24, 1, 'TUCUMAN', 'RIO NIO', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3891, 24, 1, 'TUCUMAN', 'RIO SECO (TUC)', '4164', NULL, NULL);
INSERT INTO `localidades` VALUES(3892, 24, 1, 'TUCUMAN', 'RODEO GRANDE', '4174', NULL, NULL);
INSERT INTO `localidades` VALUES(3893, 24, 1, 'TUCUMAN', 'ROMERA POZO', '4115', NULL, NULL);
INSERT INTO `localidades` VALUES(3894, 24, 1, 'TUCUMAN', 'RUMI PUNCO', '4164', NULL, NULL);
INSERT INTO `localidades` VALUES(3895, 24, 1, 'TUCUMAN', 'RUTA 9', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3896, 24, 1, 'TUCUMAN', 'SAN AGUSTIN (TUC)', '4186', NULL, NULL);
INSERT INTO `localidades` VALUES(3897, 24, 1, 'TUCUMAN', 'SAN ANDRES (TUC)', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3898, 24, 1, 'TUCUMAN', 'SAN ANTONIO', '4174', NULL, NULL);
INSERT INTO `localidades` VALUES(3899, 24, 1, 'TUCUMAN', 'SAN CARLOS', '4184', NULL, NULL);
INSERT INTO `localidades` VALUES(3900, 24, 1, 'TUCUMAN', 'SAN FELIPE', '4166', NULL, NULL);
INSERT INTO `localidades` VALUES(3901, 24, 1, 'TUCUMAN', 'SAN FERNANDO', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3902, 24, 1, 'TUCUMAN', 'SAN IGNACIO', '4162', NULL, NULL);
INSERT INTO `localidades` VALUES(3903, 24, 1, 'TUCUMAN', 'SAN IGNACIO', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3904, 24, 1, 'TUCUMAN', 'SAN ISIDRO(TUC)', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3905, 24, 1, 'TUCUMAN', 'SAN JOSE', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3906, 24, 1, 'TUCUMAN', 'SAN JOSE', '4163', NULL, NULL);
INSERT INTO `localidades` VALUES(3907, 24, 1, 'TUCUMAN', 'SAN JOSE', '4186', NULL, NULL);
INSERT INTO `localidades` VALUES(3908, 24, 1, 'TUCUMAN', 'SAN JOSE DE BUENA VISTA', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3909, 24, 1, 'TUCUMAN', 'SAN JOSE DE FLORES', '4134', NULL, NULL);
INSERT INTO `localidades` VALUES(3910, 24, 1, 'TUCUMAN', 'SAN LUIS', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3911, 24, 1, 'TUCUMAN', 'SAN MIGUEL', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3912, 24, 1, 'TUCUMAN', 'SAN MIGUEL', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3913, 24, 1, 'TUCUMAN', 'SAN MIGUEL DE TUCUMAN', '4000', NULL, NULL);
INSERT INTO `localidades` VALUES(3914, 24, 1, 'TUCUMAN', 'SAN PABLO', '4129', NULL, NULL);
INSERT INTO `localidades` VALUES(3915, 24, 1, 'TUCUMAN', 'SAN PEDRO', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3916, 24, 1, 'TUCUMAN', 'SAN PEDRO', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3917, 24, 1, 'TUCUMAN', 'SAN PEDRO', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3918, 24, 1, 'TUCUMAN', 'SAN PEDRO', '4187', NULL, NULL);
INSERT INTO `localidades` VALUES(3919, 24, 1, 'TUCUMAN', 'SAN PEDRO DE COLALAO', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3920, 24, 1, 'TUCUMAN', 'SAN PEDRO MARTIR', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3921, 24, 1, 'TUCUMAN', 'SAN RAFAEL', '4129', NULL, NULL);
INSERT INTO `localidades` VALUES(3922, 24, 1, 'TUCUMAN', 'SAN RAMON', '4149', NULL, NULL);
INSERT INTO `localidades` VALUES(3923, 24, 1, 'TUCUMAN', 'SAN RAMON', '4166', NULL, NULL);
INSERT INTO `localidades` VALUES(3924, 24, 1, 'TUCUMAN', 'SANDOVALES', '4174', NULL, NULL);
INSERT INTO `localidades` VALUES(3925, 24, 1, 'TUCUMAN', 'SANTA ANA (TUC)', '4155', NULL, NULL);
INSERT INTO `localidades` VALUES(3926, 24, 1, 'TUCUMAN', 'SANTA BARBARA (TUC)', '4105', NULL, NULL);
INSERT INTO `localidades` VALUES(3927, 24, 1, 'TUCUMAN', 'SANTA CRUZ', '4149', NULL, NULL);
INSERT INTO `localidades` VALUES(3928, 24, 1, 'TUCUMAN', 'SANTA LUCIA', '4186', NULL, NULL);
INSERT INTO `localidades` VALUES(3929, 24, 1, 'TUCUMAN', 'SANTA ROSA', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3930, 24, 1, 'TUCUMAN', 'SANTA ROSA', '4117', NULL, NULL);
INSERT INTO `localidades` VALUES(3931, 24, 1, 'TUCUMAN', 'SANTA ROSA', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3932, 24, 1, 'TUCUMAN', 'SANTA ROSA DE LEALES', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3933, 24, 1, 'TUCUMAN', 'SARGENTO MOYA', '4144', NULL, NULL);
INSERT INTO `localidades` VALUES(3934, 24, 1, 'TUCUMAN', 'SAUCE HUACHO', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3935, 24, 1, 'TUCUMAN', 'SAUCEYACU', '4122', NULL, NULL);
INSERT INTO `localidades` VALUES(3936, 24, 1, 'TUCUMAN', 'SAUCEYACU', '4162', NULL, NULL);
INSERT INTO `localidades` VALUES(3937, 24, 1, 'TUCUMAN', 'SIMOCA', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3938, 24, 1, 'TUCUMAN', 'TACANAS', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3939, 24, 1, 'TUCUMAN', 'TACANAS', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3940, 24, 1, 'TUCUMAN', 'TACO RALO', '4242', NULL, NULL);
INSERT INTO `localidades` VALUES(3941, 24, 1, 'TUCUMAN', 'TAFI DEL VALLE', '4137', NULL, NULL);
INSERT INTO `localidades` VALUES(3942, 24, 1, 'TUCUMAN', 'TAFI VIEJO', '4103', NULL, NULL);
INSERT INTO `localidades` VALUES(3943, 24, 1, 'TUCUMAN', 'TALA POZO', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3944, 24, 1, 'TUCUMAN', 'TALITA POZO', '4224', NULL, NULL);
INSERT INTO `localidades` VALUES(3945, 24, 1, 'TUCUMAN', 'TAPIA', '4122', NULL, NULL);
INSERT INTO `localidades` VALUES(3946, 24, 1, 'TUCUMAN', 'TENIENTE BERDINA', '4172', NULL, NULL);
INSERT INTO `localidades` VALUES(3947, 24, 1, 'TUCUMAN', 'TICUCHO', '4122', NULL, NULL);
INSERT INTO `localidades` VALUES(3948, 24, 1, 'TUCUMAN', 'TIPAS', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3949, 24, 1, 'TUCUMAN', 'TRANCAS', '4124', NULL, NULL);
INSERT INTO `localidades` VALUES(3950, 24, 1, 'TUCUMAN', 'TRES POZOS', '4178', NULL, NULL);
INSERT INTO `localidades` VALUES(3951, 24, 1, 'TUCUMAN', 'TUSCA POZO', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3952, 24, 1, 'TUCUMAN', 'V B ARAOZ', '4119', NULL, NULL);
INSERT INTO `localidades` VALUES(3953, 24, 1, 'TUCUMAN', 'VICLOS', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3954, 24, 1, 'TUCUMAN', 'VILLA BELGRANO', '4158', NULL, NULL);
INSERT INTO `localidades` VALUES(3955, 24, 1, 'TUCUMAN', 'VILLA CARMELA', '4105', NULL, NULL);
INSERT INTO `localidades` VALUES(3956, 24, 1, 'TUCUMAN', 'VILLA CHICLIGASTA', '4132', NULL, NULL);
INSERT INTO `localidades` VALUES(3957, 24, 1, 'TUCUMAN', 'VILLA DE LEALES', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3958, 24, 1, 'TUCUMAN', 'VILLA FIAD', '4111', NULL, NULL);
INSERT INTO `localidades` VALUES(3959, 24, 1, 'TUCUMAN', 'VILLA MORENO', '4101', NULL, NULL);
INSERT INTO `localidades` VALUES(3960, 24, 1, 'TUCUMAN', 'VILLA NUEVA LA ESPERANZA', '4197', NULL, NULL);
INSERT INTO `localidades` VALUES(3961, 24, 1, 'TUCUMAN', 'VILLA QUINTEROS', '4144', NULL, NULL);
INSERT INTO `localidades` VALUES(3962, 24, 1, 'TUCUMAN', 'VIPOS', '4122', NULL, NULL);
INSERT INTO `localidades` VALUES(3963, 24, 1, 'TUCUMAN', 'YACUCHINA', '4144', NULL, NULL);
INSERT INTO `localidades` VALUES(3964, 24, 1, 'TUCUMAN', 'YANIMAS', '4158', NULL, NULL);
INSERT INTO `localidades` VALUES(3965, 24, 1, 'TUCUMAN', 'YERBA BUENA', '4107', NULL, NULL);
INSERT INTO `localidades` VALUES(3966, 24, 1, 'TUCUMAN', 'YONOPONGO', '4142', NULL, NULL);
INSERT INTO `localidades` VALUES(3967, 24, 1, 'TUCUMAN', 'YUCUMANITA', '4151', NULL, NULL);
INSERT INTO `localidades` VALUES(6028, 25, 2, 'ARTIGAS', 'BALTASAR BRUM', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6029, 25, 2, 'ARTIGAS', 'BELLA UNION', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6030, 25, 2, 'ARTIGAS', 'BERNABE RIVERA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6031, 25, 2, 'ARTIGAS', 'CAINSA', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6032, 25, 2, 'ARTIGAS', 'CAINZA CAMPO 3', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6033, 25, 2, 'ARTIGAS', 'CALNU', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6034, 25, 2, 'ARTIGAS', 'CAMAÑO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6035, 25, 2, 'ARTIGAS', 'CATALAN GRANDE', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6036, 25, 2, 'ARTIGAS', 'CATALAN VOLCAN', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6037, 25, 2, 'ARTIGAS', 'CERRITO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6038, 25, 2, 'ARTIGAS', 'CERRO EJIDO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6039, 25, 2, 'ARTIGAS', 'CERRO SAN EUGENIO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6040, 25, 2, 'ARTIGAS', 'CERRO SIGNORELLI', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6041, 25, 2, 'ARTIGAS', 'CHIFLERO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6042, 25, 2, 'ARTIGAS', 'COLONIA ESPAÑA', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6043, 25, 2, 'ARTIGAS', 'COLONIA ESTRELLA', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6044, 25, 2, 'ARTIGAS', 'COLONIA JOSE ARTIGAS', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6045, 25, 2, 'ARTIGAS', 'COLONIA PALMA', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6046, 25, 2, 'ARTIGAS', 'COLONIA PINTADO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6047, 25, 2, 'ARTIGAS', 'COLONIA VIÑAR', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6048, 25, 2, 'ARTIGAS', 'CORONADO', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6049, 25, 2, 'ARTIGAS', 'CUAREIM', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6050, 25, 2, 'ARTIGAS', 'CUARO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6051, 25, 2, 'ARTIGAS', 'DIEGO LAMAS', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6052, 25, 2, 'ARTIGAS', 'ESTIBA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6053, 25, 2, 'ARTIGAS', 'FAGUNDEZ', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6054, 25, 2, 'ARTIGAS', 'FRANQUIA', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6055, 25, 2, 'ARTIGAS', 'GUYUBIRA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6056, 25, 2, 'ARTIGAS', 'JAVIER DE VIANA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6057, 25, 2, 'ARTIGAS', 'LA BOLSA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6058, 25, 2, 'ARTIGAS', 'LAS PIEDRAS', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6059, 25, 2, 'ARTIGAS', 'LENGUAZO', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6060, 25, 2, 'ARTIGAS', 'MENESES', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6061, 25, 2, 'ARTIGAS', 'MONES QUINTELA', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6062, 25, 2, 'ARTIGAS', 'PAGUERO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6063, 25, 2, 'ARTIGAS', 'PALMA SOLA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6064, 25, 2, 'ARTIGAS', 'PAREDON', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6065, 25, 2, 'ARTIGAS', 'PASO CAMPAMENTO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6066, 25, 2, 'ARTIGAS', 'PASO DE LA CRUZ', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6067, 25, 2, 'ARTIGAS', 'PASO DE LEON', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6068, 25, 2, 'ARTIGAS', 'PASO DE RAMOS', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6069, 25, 2, 'ARTIGAS', 'PASO FARIAS', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6070, 25, 2, 'ARTIGAS', 'PATITAS', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6071, 25, 2, 'ARTIGAS', 'PIEDRA PINTADA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6072, 25, 2, 'ARTIGAS', 'PINTADITO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6073, 25, 2, 'ARTIGAS', 'PINTADO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6074, 25, 2, 'ARTIGAS', 'PINTADO GRANDE', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6075, 25, 2, 'ARTIGAS', 'PORT. DE HIERRO Y CAMPODONICO', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6076, 25, 2, 'ARTIGAS', 'RINCON DE PACHECO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6077, 25, 2, 'ARTIGAS', 'SARANDI DE CUARO', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6078, 25, 2, 'ARTIGAS', 'SARANDI DE YACUY', '50200', NULL, NULL);
INSERT INTO `localidades` VALUES(6079, 25, 2, 'ARTIGAS', 'SEQUEIRA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6080, 25, 2, 'ARTIGAS', 'TAMANDUA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6081, 25, 2, 'ARTIGAS', 'TARUMAN', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6082, 25, 2, 'ARTIGAS', 'TOMAS GOMENSORO', '55100', NULL, NULL);
INSERT INTO `localidades` VALUES(6083, 25, 2, 'ARTIGAS', 'TOPADOR', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6084, 25, 2, 'ARTIGAS', 'ZANJA ARUERA', '55000', NULL, NULL);
INSERT INTO `localidades` VALUES(6085, 26, 2, 'CANELONES', 'AEROPUERTO INTERNACIONAL DE CARRASCO', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6086, 26, 2, 'CANELONES', 'AGUAS CORRIENTES', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6087, 26, 2, 'CANELONES', 'ALTOS DE LA TAHONA', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6088, 26, 2, 'CANELONES', 'ARAMINDA', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6089, 26, 2, 'CANELONES', 'ARENAL', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6090, 26, 2, 'CANELONES', 'ARGENTINO', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6091, 26, 2, 'CANELONES', 'ATLANTIDA', '15200', NULL, NULL);
INSERT INTO `localidades` VALUES(6092, 26, 2, 'CANELONES', 'BARRA DE CARRASCO', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6093, 26, 2, 'CANELONES', 'BARRA DE LA PEDRERA', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6094, 26, 2, 'CANELONES', 'BARRA DEL TALA', '91300', NULL, NULL);
INSERT INTO `localidades` VALUES(6095, 26, 2, 'CANELONES', 'BARRANCAS COLORADAS', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6096, 26, 2, 'CANELONES', 'BARRIO ARTIGAS', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6097, 26, 2, 'CANELONES', 'BARRIO BENZO', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6098, 26, 2, 'CANELONES', 'BARRIO COPOLA', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6099, 26, 2, 'CANELONES', 'BARRIO DEL LIBERTADOR', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6100, 26, 2, 'CANELONES', 'BARRIO LA LUCHA', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6101, 26, 2, 'CANELONES', 'BARRIO LOS PANORAMAS', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6102, 26, 2, 'CANELONES', 'BARRIO MONTERREY', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6103, 26, 2, 'CANELONES', 'BARRIO OBRERO', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6104, 26, 2, 'CANELONES', 'BARRIO PRETTI', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6105, 26, 2, 'CANELONES', 'BARRIO REMANSO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6106, 26, 2, 'CANELONES', 'BARRIO SAN CRISTOBAL', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6107, 26, 2, 'CANELONES', 'BARRIO SANTA RITA', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6108, 26, 2, 'CANELONES', 'BARRIO TRAVERSO', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6109, 26, 2, 'CANELONES', 'BARRIO VILLA MURCIA', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6110, 26, 2, 'CANELONES', 'BARROS BLANCOS', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6111, 26, 2, 'CANELONES', 'BELLO HORIZONTE', '15300', NULL, NULL);
INSERT INTO `localidades` VALUES(6112, 26, 2, 'CANELONES', 'B.H.U.', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6113, 26, 2, 'CANELONES', 'BIARRITZ', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6114, 26, 2, 'CANELONES', 'BLANCO', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6115, 26, 2, 'CANELONES', 'BOLIVAR', '96200', NULL, NULL);
INSERT INTO `localidades` VALUES(6116, 26, 2, 'CANELONES', 'CAMINO DE LA CADENA', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6117, 26, 2, 'CANELONES', 'CAMINO DODERA', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6118, 26, 2, 'CANELONES', 'CAMINO LLOVERAS', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6119, 26, 2, 'CANELONES', 'CAMPO MILITAR', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6120, 26, 2, 'CANELONES', 'CANELON CHICO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6121, 26, 2, 'CANELONES', 'CANELON CHICO AL CENTRO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6122, 26, 2, 'CANELONES', 'CANELON CHICO DE PROGRESO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6123, 26, 2, 'CANELONES', 'CANELONES', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6124, 26, 2, 'CANELONES', 'CANELON GRANDE', '91400', NULL, NULL);
INSERT INTO `localidades` VALUES(6125, 26, 2, 'CANELONES', 'CANELON GRANDE DE PACHECO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6126, 26, 2, 'CANELONES', 'CANELON GRANDE NORTE', '91300', NULL, NULL);
INSERT INTO `localidades` VALUES(6127, 26, 2, 'CANELONES', 'CAÑADA CARDOZO', '91300', NULL, NULL);
INSERT INTO `localidades` VALUES(6128, 26, 2, 'CANELONES', 'CAÑADA DE MONTAÑO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6129, 26, 2, 'CANELONES', 'CAÑADA DE MONTAÑO', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6130, 26, 2, 'CANELONES', 'CAÑADA GRANDE', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6131, 26, 2, 'CANELONES', 'CAÑADA PRUDENCIO', '91100', NULL, NULL);
INSERT INTO `localidades` VALUES(6132, 26, 2, 'CANELONES', 'CAPILLA DE CELLA', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6133, 26, 2, 'CANELONES', 'CARMEL', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6134, 26, 2, 'CANELONES', 'CARRASCO DEL SAUCE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6135, 26, 2, 'CANELONES', 'CASARINO', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6136, 26, 2, 'CANELONES', 'CERRILLOS AL OESTE', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6137, 26, 2, 'CANELONES', 'CERRILLOS AL SUR', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6138, 26, 2, 'CANELONES', 'CITY GOLF', '15200', NULL, NULL);
INSERT INTO `localidades` VALUES(6139, 26, 2, 'CANELONES', 'CIUDAD DE LA COSTA', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6140, 26, 2, 'CANELONES', 'CIUDAD DE LA COSTA', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6141, 26, 2, 'CANELONES', 'COCHENGO', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6142, 26, 2, 'CANELONES', 'COLINAS DE CARRASCO', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6143, 26, 2, 'CANELONES', 'COLINAS DE SOLYMAR', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6144, 26, 2, 'CANELONES', 'COLONIA LAMAS', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6145, 26, 2, 'CANELONES', 'COLONIA NICOLICH', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6146, 26, 2, 'CANELONES', 'COLORADO CHICO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6147, 26, 2, 'CANELONES', 'COLORADO Y BRUJAS', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6148, 26, 2, 'CANELONES', 'COSTA AZUL', '15300', NULL, NULL);
INSERT INTO `localidades` VALUES(6149, 26, 2, 'CANELONES', 'COSTA DEL PANTANOSO', '91400', NULL, NULL);
INSERT INTO `localidades` VALUES(6150, 26, 2, 'CANELONES', 'COSTA DEL SAUCE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6151, 26, 2, 'CANELONES', 'COSTA DEL TALA ESTE', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6152, 26, 2, 'CANELONES', 'COSTA DEL TALA NORTE', '91100', NULL, NULL);
INSERT INTO `localidades` VALUES(6153, 26, 2, 'CANELONES', 'COSTA DE PANDO', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6154, 26, 2, 'CANELONES', 'COSTA DE PANDO OLMOS', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6155, 26, 2, 'CANELONES', 'COSTA DE PANDO SAN BAUTISTA', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6156, 26, 2, 'CANELONES', 'COSTA DE PANDO SAN JACINTO', '91400', NULL, NULL);
INSERT INTO `localidades` VALUES(6157, 26, 2, 'CANELONES', 'COSTAS DEL COLORADO', '91300', NULL, NULL);
INSERT INTO `localidades` VALUES(6158, 26, 2, 'CANELONES', 'COSTAS DEL COLORADO ESTE', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6159, 26, 2, 'CANELONES', 'COSTAS DEL TALA', '91300', NULL, NULL);
INSERT INTO `localidades` VALUES(6160, 26, 2, 'CANELONES', 'COSTAS DE PEDERNAL', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6161, 26, 2, 'CANELONES', 'COSTAS DE SANTA LUCIA', '96200', NULL, NULL);
INSERT INTO `localidades` VALUES(6162, 26, 2, 'CANELONES', 'COSTAS DE SOLIS', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6163, 26, 2, 'CANELONES', 'COSTA Y GUILLAMON', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6164, 26, 2, 'CANELONES', 'CRUZ DE LOS CAMINOS', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6165, 26, 2, 'CANELONES', 'CUCHILLA ALTA', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6166, 26, 2, 'CANELONES', 'CUCHILLA ALTA Y EL GALEON', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6167, 26, 2, 'CANELONES', 'CUCHILLA CABO DE HORNOS', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6168, 26, 2, 'CANELONES', 'CUCHILLA DE MACHIN', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6169, 26, 2, 'CANELONES', 'CUCHILLA DE ROCHA', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6170, 26, 2, 'CANELONES', 'CUCHILLA DE SIERRA', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6171, 26, 2, 'CANELONES', 'CUCHILLA DE ZEBALLOS', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6172, 26, 2, 'CANELONES', 'CUCHILLA VERDE', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6173, 26, 2, 'CANELONES', 'CUEVA DEL TIGRE', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6174, 26, 2, 'CANELONES', 'CUMBRES DE CARRASCO', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6175, 26, 2, 'CANELONES', 'DOCTOR FRANCISCO SOCA', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6176, 26, 2, 'CANELONES', 'ECHEVARRIA', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6177, 26, 2, 'CANELONES', 'EL BOSQUE', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6178, 26, 2, 'CANELONES', 'EL BOSQUE DE LAGOMAR', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6179, 26, 2, 'CANELONES', 'EL BOSQUE DE SOLYMAR', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6180, 26, 2, 'CANELONES', 'EL COLORADO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6181, 26, 2, 'CANELONES', 'EL COLORADO DE MIGUES', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6182, 26, 2, 'CANELONES', 'EL COLORADO SAN BAUTISTA', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6183, 26, 2, 'CANELONES', 'EL CUADRO', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6184, 26, 2, 'CANELONES', 'EL DORADO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6185, 26, 2, 'CANELONES', 'EL GALEON', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6186, 26, 2, 'CANELONES', 'EL PINAR', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6187, 26, 2, 'CANELONES', 'EMPALME DOGLIOTTI', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6188, 26, 2, 'CANELONES', 'EMPALME NICOLICH', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6189, 26, 2, 'CANELONES', 'EMPALME OLMOS', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6190, 26, 2, 'CANELONES', 'EMPALME SAUCE', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6191, 26, 2, 'CANELONES', 'EMPALME SAUCE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6192, 26, 2, 'CANELONES', 'ESQUINA GONZALEZ', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6193, 26, 2, 'CANELONES', 'ESTACION ATLANTIDA', '15200', NULL, NULL);
INSERT INTO `localidades` VALUES(6194, 26, 2, 'CANELONES', 'ESTACION LA FLORESTA', '15300', NULL, NULL);
INSERT INTO `localidades` VALUES(6195, 26, 2, 'CANELONES', 'ESTACION MIGUES', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6196, 26, 2, 'CANELONES', 'ESTACION PEDRERA', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6197, 26, 2, 'CANELONES', 'ESTACION PIEDRAS DE AFILAR', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6198, 26, 2, 'CANELONES', 'ESTACION TAPIA', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6199, 26, 2, 'CANELONES', 'ESTANQUE DE PANDO', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6200, 26, 2, 'CANELONES', 'FELICIANO', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6201, 26, 2, 'CANELONES', 'FORTIN DE SANTA ROSA', '15100', NULL, NULL);
INSERT INTO `localidades` VALUES(6202, 26, 2, 'CANELONES', 'FORTIN DE SANTA ROSA', '15200', NULL, NULL);
INSERT INTO `localidades` VALUES(6203, 26, 2, 'CANELONES', 'FRACC. CAMINO MALDONADO', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6204, 26, 2, 'CANELONES', 'FRACC. CNO. ANDALUZ Y R.84', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6205, 26, 2, 'CANELONES', 'FRACC. PROGRESO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6206, 26, 2, 'CANELONES', 'FRACC. SOBRE RUTA 74', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6207, 26, 2, 'CANELONES', 'GUAZUVIRA', '15300', NULL, NULL);
INSERT INTO `localidades` VALUES(6208, 26, 2, 'CANELONES', 'GUAZUVIRA NUEVO', '15300', NULL, NULL);
INSERT INTO `localidades` VALUES(6209, 26, 2, 'CANELONES', 'HARAS DEL LAGO', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6210, 26, 2, 'CANELONES', 'INSTITUTO ADVENTISTA', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6211, 26, 2, 'CANELONES', 'JARDINES DE PANDO', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6212, 26, 2, 'CANELONES', 'JAUREGUIBERRY', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6213, 26, 2, 'CANELONES', 'JOAQUIN SUAREZ', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6214, 26, 2, 'CANELONES', 'JUANICO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6215, 26, 2, 'CANELONES', 'LA ASUNCION', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6216, 26, 2, 'CANELONES', 'LA CHINCHILLA', '15200', NULL, NULL);
INSERT INTO `localidades` VALUES(6217, 26, 2, 'CANELONES', 'LA FLORESTA', '15300', NULL, NULL);
INSERT INTO `localidades` VALUES(6218, 26, 2, 'CANELONES', 'LAGO JARDIN DEL BOSQUE', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6219, 26, 2, 'CANELONES', 'LAGO JARDIN DEL BOSQUE', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6220, 26, 2, 'CANELONES', 'LAGOMAR', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6221, 26, 2, 'CANELONES', 'LA MONTAÑESA', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6222, 26, 2, 'CANELONES', 'LA PALMITA', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6223, 26, 2, 'CANELONES', 'LA PALOMA', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6224, 26, 2, 'CANELONES', 'LA PAZ', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6225, 26, 2, 'CANELONES', 'LAS BRUJAS', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6226, 26, 2, 'CANELONES', 'LAS HIGUERITAS', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6227, 26, 2, 'CANELONES', 'LAS PIEDRAS', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6228, 26, 2, 'CANELONES', 'LAS RANAS', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6229, 26, 2, 'CANELONES', 'LAS TOSCAS', '15200', NULL, NULL);
INSERT INTO `localidades` VALUES(6230, 26, 2, 'CANELONES', 'LAS VEGAS', '15300', NULL, NULL);
INSERT INTO `localidades` VALUES(6231, 26, 2, 'CANELONES', 'LAS VIOLETAS', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6232, 26, 2, 'CANELONES', 'LA TOTORA', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6233, 26, 2, 'CANELONES', 'LA TOTORA', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6234, 26, 2, 'CANELONES', 'LA TUNA', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6235, 26, 2, 'CANELONES', 'LOMAS DE CARRASCO', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6236, 26, 2, 'CANELONES', 'LOMAS DE SOLYMAR', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6237, 26, 2, 'CANELONES', 'LOMAS DE TOLEDO', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6238, 26, 2, 'CANELONES', 'LOS CEIBOS', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6239, 26, 2, 'CANELONES', 'LOS CERRILLOS', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6240, 26, 2, 'CANELONES', 'LOS HORNOS', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6241, 26, 2, 'CANELONES', 'LOS TITANES', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6242, 26, 2, 'CANELONES', 'MACANA', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6243, 26, 2, 'CANELONES', 'MARGAT', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6244, 26, 2, 'CANELONES', 'MARINDIA', '15100', NULL, NULL);
INSERT INTO `localidades` VALUES(6245, 26, 2, 'CANELONES', 'MATAOJO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6246, 26, 2, 'CANELONES', 'MATA SIETE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6247, 26, 2, 'CANELONES', 'MEDANOS DE SOLYMAR', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6248, 26, 2, 'CANELONES', 'MELGAREJO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6249, 26, 2, 'CANELONES', 'MELILLA', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6250, 26, 2, 'CANELONES', 'MIGUES', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6251, 26, 2, 'CANELONES', 'MIRADOR DE LA TAHONA', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6252, 26, 2, 'CANELONES', 'MONACO DE CARRASCO', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6253, 26, 2, 'CANELONES', 'MONTES', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6254, 26, 2, 'CANELONES', 'MONTES DE SOLYMAR', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6255, 26, 2, 'CANELONES', 'MURIALDO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6256, 26, 2, 'CANELONES', 'NATALY', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6257, 26, 2, 'CANELONES', 'NEPTUNIA', '15100', NULL, NULL);
INSERT INTO `localidades` VALUES(6258, 26, 2, 'CANELONES', 'NUTRIAS', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6259, 26, 2, 'CANELONES', 'OLMOS', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6260, 26, 2, 'CANELONES', 'PANDO', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6261, 26, 2, 'CANELONES', 'PANTANOSO', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6262, 26, 2, 'CANELONES', 'PANTANOSO DEL SAUCE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6263, 26, 2, 'CANELONES', 'PARADA CABRERA', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6264, 26, 2, 'CANELONES', 'PARADOR TAJES', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6265, 26, 2, 'CANELONES', 'PARQUE CARRASCO', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6266, 26, 2, 'CANELONES', 'PARQUE DEL PLATA', '15300', NULL, NULL);
INSERT INTO `localidades` VALUES(6267, 26, 2, 'CANELONES', 'PARQUE DE SOLYMAR', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6268, 26, 2, 'CANELONES', 'PARQUE MIRAMAR', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6269, 26, 2, 'CANELONES', 'PASO ARBELO', '30100', NULL, NULL);
INSERT INTO `localidades` VALUES(6270, 26, 2, 'CANELONES', 'PASO CARRASCO', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6271, 26, 2, 'CANELONES', 'PASO DE CUELLO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6272, 26, 2, 'CANELONES', 'PASO DE LA CADENA', '91300', NULL, NULL);
INSERT INTO `localidades` VALUES(6273, 26, 2, 'CANELONES', 'PASO DE LA PALOMA', '91400', NULL, NULL);
INSERT INTO `localidades` VALUES(6274, 26, 2, 'CANELONES', 'PASO DE LA SALAMANCA', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6275, 26, 2, 'CANELONES', 'PASO DE LAS TOSCAS', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6276, 26, 2, 'CANELONES', 'PASO DEL BOTE', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6277, 26, 2, 'CANELONES', 'PASO DEL COLORADO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6278, 26, 2, 'CANELONES', 'PASO DEL MEDIO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6279, 26, 2, 'CANELONES', 'PASO DE LOS ALAMOS', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6280, 26, 2, 'CANELONES', 'PASO DE LOS DIFUNTOS', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6281, 26, 2, 'CANELONES', 'PASO DE LOS FRANCOS', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6282, 26, 2, 'CANELONES', 'PASO DEL SORDO', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6283, 26, 2, 'CANELONES', 'PASO DE PACHE', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6284, 26, 2, 'CANELONES', 'PASO ESPINOSA', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6285, 26, 2, 'CANELONES', 'PASO PALOMEQUE', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6286, 26, 2, 'CANELONES', 'PASO RIVERO DE VEJIGAS', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6287, 26, 2, 'CANELONES', 'PEDERNAL', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6288, 26, 2, 'CANELONES', 'PEDERNAL CHICO', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6289, 26, 2, 'CANELONES', 'PEDERNAL GRANDE', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6290, 26, 2, 'CANELONES', 'PIEDRA DEL TORO', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6291, 26, 2, 'CANELONES', 'PIEDRAS DE AFILAR', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6292, 26, 2, 'CANELONES', 'PIEDRA SOLA', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6293, 26, 2, 'CANELONES', 'PIEDRITAS', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6294, 26, 2, 'CANELONES', 'PIEDRITAS DE SUAREZ', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6295, 26, 2, 'CANELONES', 'PINAMAR', '15100', NULL, NULL);
INSERT INTO `localidades` VALUES(6296, 26, 2, 'CANELONES', 'PINAMAR - PINEPARK', '15100', NULL, NULL);
INSERT INTO `localidades` VALUES(6297, 26, 2, 'CANELONES', 'PINARES DE SOLYMAR', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6298, 26, 2, 'CANELONES', 'PINE PARK', '15100', NULL, NULL);
INSERT INTO `localidades` VALUES(6299, 26, 2, 'CANELONES', 'PONCE MATA SIETE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6300, 26, 2, 'CANELONES', 'POQUITOS', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6301, 26, 2, 'CANELONES', 'PROGRESO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6302, 26, 2, 'CANELONES', 'PUEBLO CASTELLANOS', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6303, 26, 2, 'CANELONES', 'PUENTE DE BRUJAS', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6304, 26, 2, 'CANELONES', 'PUNTAS DE BRUJAS', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6305, 26, 2, 'CANELONES', 'PUNTAS DE CANELON CHICO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6306, 26, 2, 'CANELONES', 'PUNTAS DE CAÑADA CARDOZO', '91300', NULL, NULL);
INSERT INTO `localidades` VALUES(6307, 26, 2, 'CANELONES', 'PUNTAS DE CAÑADA GRANDE', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6308, 26, 2, 'CANELONES', 'PUNTAS DE COCHENGO', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6309, 26, 2, 'CANELONES', 'PUNTAS DEL ARENAL', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6310, 26, 2, 'CANELONES', 'PUNTAS DE LAS VIOLETAS', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6311, 26, 2, 'CANELONES', 'PUNTAS DE MATA SIETE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6312, 26, 2, 'CANELONES', 'PUNTAS DE PANTANOSO', '91400', NULL, NULL);
INSERT INTO `localidades` VALUES(6313, 26, 2, 'CANELONES', 'PUNTAS DE PANTANOSO ESTE', '91400', NULL, NULL);
INSERT INTO `localidades` VALUES(6314, 26, 2, 'CANELONES', 'PUNTAS DE PEDRERA', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6315, 26, 2, 'CANELONES', 'PUNTAS DE TOLEDO', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6316, 26, 2, 'CANELONES', 'PUNTAS DE VEJIGAS', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6317, 26, 2, 'CANELONES', 'QUINTA LOS HORNEROS', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6318, 26, 2, 'CANELONES', 'QUINTAS DEL BOSQUE', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6319, 26, 2, 'CANELONES', 'RANCHERIOS DE PONCE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6320, 26, 2, 'CANELONES', 'RINCON DE CARRASCO', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6321, 26, 2, 'CANELONES', 'RINCON DEL COLORADO', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6322, 26, 2, 'CANELONES', 'RINCON DEL CONDE', '91100', NULL, NULL);
INSERT INTO `localidades` VALUES(6323, 26, 2, 'CANELONES', 'RINCON DEL GIGANTE', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6324, 26, 2, 'CANELONES', 'RINCON DE PANDO', '15100', NULL, NULL);
INSERT INTO `localidades` VALUES(6325, 26, 2, 'CANELONES', 'RINCON DE PORTEZUELO', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6326, 26, 2, 'CANELONES', 'RINCON DE VELAZQUEZ', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6327, 26, 2, 'CANELONES', 'RINCON DE VIDAL', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6328, 26, 2, 'CANELONES', 'SALINAS', '15100', NULL, NULL);
INSERT INTO `localidades` VALUES(6329, 26, 2, 'CANELONES', 'SAN ANTONIO', '91300', NULL, NULL);
INSERT INTO `localidades` VALUES(6330, 26, 2, 'CANELONES', 'SAN BAUTISTA', '91200', NULL, NULL);
INSERT INTO `localidades` VALUES(6331, 26, 2, 'CANELONES', 'SAN JACINTO', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6332, 26, 2, 'CANELONES', 'SAN JOSE DE CARRASCO', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6333, 26, 2, 'CANELONES', 'SAN LUIS', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6334, 26, 2, 'CANELONES', 'SAN PEDRO', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6335, 26, 2, 'CANELONES', 'SAN RAMON', '91100', NULL, NULL);
INSERT INTO `localidades` VALUES(6336, 26, 2, 'CANELONES', 'SANTA ANA', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6337, 26, 2, 'CANELONES', 'SANTA LUCIA', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(6338, 26, 2, 'CANELONES', 'SANTA LUCIA DEL ESTE', '15400', NULL, NULL);
INSERT INTO `localidades` VALUES(6339, 26, 2, 'CANELONES', 'SANTA ROSA', '91400', NULL, NULL);
INSERT INTO `localidades` VALUES(6340, 26, 2, 'CANELONES', 'SANTA TERESITA', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6341, 26, 2, 'CANELONES', 'SANTOS LUGARES', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6342, 26, 2, 'CANELONES', 'SARANDI DE MIGUES', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6343, 26, 2, 'CANELONES', 'SAUCE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6344, 26, 2, 'CANELONES', 'SAUCE DE SOLIS', '30100', NULL, NULL);
INSERT INTO `localidades` VALUES(6345, 26, 2, 'CANELONES', 'SAUCE SOLO', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6346, 26, 2, 'CANELONES', 'SAUCE SOLO DE MIGUES', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6347, 26, 2, 'CANELONES', 'SAUCE SOLO DE MONTES', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6348, 26, 2, 'CANELONES', 'SEIS HERMANOS', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6349, 26, 2, 'CANELONES', 'SHANGRILA', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6350, 26, 2, 'CANELONES', 'SOFIA SANTOS', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6351, 26, 2, 'CANELONES', 'SOLIS CHICO', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6352, 26, 2, 'CANELONES', 'SOLIS CHICO DE MIGUES', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6353, 26, 2, 'CANELONES', 'SOLYMAR', '15800', NULL, NULL);
INSERT INTO `localidades` VALUES(6354, 26, 2, 'CANELONES', 'SOSA DIAZ', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6355, 26, 2, 'CANELONES', 'TALA', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6356, 26, 2, 'CANELONES', 'TALITA', '91600', NULL, NULL);
INSERT INTO `localidades` VALUES(6357, 26, 2, 'CANELONES', 'TOLEDO', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6358, 26, 2, 'CANELONES', 'TOTORAL DEL SAUCE', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6359, 26, 2, 'CANELONES', 'VEJIGAS', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6360, 26, 2, 'CANELONES', 'VEJIGAS DE SAN RAMON', '91100', NULL, NULL);
INSERT INTO `localidades` VALUES(6361, 26, 2, 'CANELONES', 'VEJIGAS DE TALA', '91800', NULL, NULL);
INSERT INTO `localidades` VALUES(6362, 26, 2, 'CANELONES', 'VIEJO MOLINO SAN BERNARDO', '15600', NULL, NULL);
INSERT INTO `localidades` VALUES(6363, 26, 2, 'CANELONES', 'VILLA AEROPARQUE', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6364, 26, 2, 'CANELONES', 'VILLA AREJO', '90000', NULL, NULL);
INSERT INTO `localidades` VALUES(6365, 26, 2, 'CANELONES', 'VILLA ARGENTINA', '15200', NULL, NULL);
INSERT INTO `localidades` VALUES(6366, 26, 2, 'CANELONES', 'VILLA CRESPO Y SAN ANDRES', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6367, 26, 2, 'CANELONES', 'VILLA EL TATO', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6368, 26, 2, 'CANELONES', 'VILLA ENCANTADA', '90100', NULL, NULL);
INSERT INTO `localidades` VALUES(6369, 26, 2, 'CANELONES', 'VILLA FELICIDAD', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6370, 26, 2, 'CANELONES', 'VILLA FORESTI', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6371, 26, 2, 'CANELONES', 'VILLA FORTUNA', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6372, 26, 2, 'CANELONES', 'VILLA GABI', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6373, 26, 2, 'CANELONES', 'VILLA HADITA', '15500', NULL, NULL);
INSERT INTO `localidades` VALUES(6374, 26, 2, 'CANELONES', 'VILLA HADITA', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6375, 26, 2, 'CANELONES', 'VILLA HUERTOS DE TOLEDO', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6376, 26, 2, 'CANELONES', 'VILLA JUANA', '15100', NULL, NULL);
INSERT INTO `localidades` VALUES(6377, 26, 2, 'CANELONES', 'VILLA JUANITA', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6378, 26, 2, 'CANELONES', 'VILLA LOS ALPES', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6379, 26, 2, 'CANELONES', 'VILLA MARINA', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6380, 26, 2, 'CANELONES', 'VILLA MOLFINO', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6381, 26, 2, 'CANELONES', 'VILLA NUEVA', '91500', NULL, NULL);
INSERT INTO `localidades` VALUES(6382, 26, 2, 'CANELONES', 'VILLA PAZ S.A.', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6383, 26, 2, 'CANELONES', 'VILLA PRADOS DE TOLEDO', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6384, 26, 2, 'CANELONES', 'VILLA SAN CONO', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6385, 26, 2, 'CANELONES', 'VILLA SAN FELIPE', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6386, 26, 2, 'CANELONES', 'VILLA SAN JOSE', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6387, 26, 2, 'CANELONES', 'VILLA VALVERDE', '15700', NULL, NULL);
INSERT INTO `localidades` VALUES(6388, 26, 2, 'CANELONES', 'VINA DEL MAR', '15000', NULL, NULL);
INSERT INTO `localidades` VALUES(6389, 26, 2, 'CANELONES', 'VISTA LINDA', '15900', NULL, NULL);
INSERT INTO `localidades` VALUES(6390, 27, 2, 'CERRO LARGO', 'ACEGUA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6391, 27, 2, 'CERRO LARGO', 'AGUIRRE', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6392, 27, 2, 'CERRO LARGO', 'AMARILLO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6393, 27, 2, 'CERRO LARGO', 'ARACHANIA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6394, 27, 2, 'CERRO LARGO', 'ARBOLITO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6395, 27, 2, 'CERRO LARGO', 'AREVALO', '35300', NULL, NULL);
INSERT INTO `localidades` VALUES(6396, 27, 2, 'CERRO LARGO', 'ARROYO MALO', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6397, 27, 2, 'CERRO LARGO', 'ARROZAL CESARONE', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6398, 27, 2, 'CERRO LARGO', 'ARROZAL ROSALES', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6399, 27, 2, 'CERRO LARGO', 'ASPEREZAS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6400, 27, 2, 'CERRO LARGO', 'BAÑADO DE LAS PAJAS', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6401, 27, 2, 'CERRO LARGO', 'BAÑADO DE MEDINA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6402, 27, 2, 'CERRO LARGO', 'BARRA DEL SAUCE', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6403, 27, 2, 'CERRO LARGO', 'BARRA DEL TACUARI', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6404, 27, 2, 'CERRO LARGO', 'BARRIO LA VINCHUCA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6405, 27, 2, 'CERRO LARGO', 'BARRIO LOPEZ BENITEZ', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6406, 27, 2, 'CERRO LARGO', 'BERACHI', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6407, 27, 2, 'CERRO LARGO', 'BUENA VISTA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6408, 27, 2, 'CERRO LARGO', 'CALERA DE RECALDE', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6409, 27, 2, 'CERRO LARGO', 'CAMPAMENTO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6410, 27, 2, 'CERRO LARGO', 'CAÑADA BRAVA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6411, 27, 2, 'CERRO LARGO', 'CAÑADA DE SANTOS', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6412, 27, 2, 'CERRO LARGO', 'CAÑADA GRANDE', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6413, 27, 2, 'CERRO LARGO', 'CAÑADA SARANDI', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6414, 27, 2, 'CERRO LARGO', 'CAÑITAS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6415, 27, 2, 'CERRO LARGO', 'CASA DE LAS CRONICAS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6416, 27, 2, 'CERRO LARGO', 'CASERIO LAS CAÑAS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6417, 27, 2, 'CERRO LARGO', 'CEMENTERIO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6418, 27, 2, 'CERRO LARGO', 'CENTURION', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6419, 27, 2, 'CERRO LARGO', 'CERRO DE LAS CUENTAS', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6420, 27, 2, 'CERRO LARGO', 'CHACRAS DE MELO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6421, 27, 2, 'CERRO LARGO', 'COIMBRA', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6422, 27, 2, 'CERRO LARGO', 'COLONIA CERES', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6423, 27, 2, 'CERRO LARGO', 'COLONIA MARIA TERESA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6424, 27, 2, 'CERRO LARGO', 'COLONIA OROZCO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6425, 27, 2, 'CERRO LARGO', 'CONVENTOS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6426, 27, 2, 'CERRO LARGO', 'CORRAL DE PIEDRA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6427, 27, 2, 'CERRO LARGO', 'CRUZ DE PIEDRA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6428, 27, 2, 'CERRO LARGO', 'CUCHILLA CAMBOTA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6429, 27, 2, 'CERRO LARGO', 'CUCHILLA DEL CARMEN', '35300', NULL, NULL);
INSERT INTO `localidades` VALUES(6430, 27, 2, 'CERRO LARGO', 'CUCHILLA DEL PARAISO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6431, 27, 2, 'CERRO LARGO', 'CUCHILLA DE MELO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6432, 27, 2, 'CERRO LARGO', 'CUCHILLA PERALTA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6433, 27, 2, 'CERRO LARGO', 'DURAZNERO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6434, 27, 2, 'CERRO LARGO', 'ESCUELA DE AGRONOMIA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6435, 27, 2, 'CERRO LARGO', 'ESPERANZA', '35300', NULL, NULL);
INSERT INTO `localidades` VALUES(6436, 27, 2, 'CERRO LARGO', 'FALDA DE SIERRA DE LOS RIOS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6437, 27, 2, 'CERRO LARGO', 'FRAILE MUERTO', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6438, 27, 2, 'CERRO LARGO', 'GANEN', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6439, 27, 2, 'CERRO LARGO', 'GARAO', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6440, 27, 2, 'CERRO LARGO', 'GRANJA DE ACEGUA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6441, 27, 2, 'CERRO LARGO', 'GRANJA PALLERO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6442, 27, 2, 'CERRO LARGO', 'GUAZUNAMBI', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6443, 27, 2, 'CERRO LARGO', 'HIPODROMO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6444, 27, 2, 'CERRO LARGO', 'INFIERNILLO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6445, 27, 2, 'CERRO LARGO', 'ISIDORO NOBLIA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6446, 27, 2, 'CERRO LARGO', 'LA CORONILLA', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6447, 27, 2, 'CERRO LARGO', 'LA GLORIA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6448, 27, 2, 'CERRO LARGO', 'LAGO MERIN', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6449, 27, 2, 'CERRO LARGO', 'LAGUNA DEL JUNCO', '36100', NULL, NULL);
INSERT INTO `localidades` VALUES(6450, 27, 2, 'CERRO LARGO', 'LA MICAELA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6451, 27, 2, 'CERRO LARGO', 'LA MINA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6452, 27, 2, 'CERRO LARGO', 'LA PEDRERA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6453, 27, 2, 'CERRO LARGO', 'LAS LIMAS', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6454, 27, 2, 'CERRO LARGO', 'LOS CERROS', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6455, 27, 2, 'CERRO LARGO', 'MANGRULLO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6456, 27, 2, 'CERRO LARGO', 'MARIA ISABEL', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6457, 27, 2, 'CERRO LARGO', 'MAZANGANO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6458, 27, 2, 'CERRO LARGO', 'MELO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6459, 27, 2, 'CERRO LARGO', 'MINUANO DE ACEGUA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6460, 27, 2, 'CERRO LARGO', 'MISTERIO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6461, 27, 2, 'CERRO LARGO', 'MONTECITO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6462, 27, 2, 'CERRO LARGO', 'NANDO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6463, 27, 2, 'CERRO LARGO', 'ÑANGAPIRE', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6464, 27, 2, 'CERRO LARGO', 'PANTEON', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6465, 27, 2, 'CERRO LARGO', 'PASO DE LA CRUZ', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6466, 27, 2, 'CERRO LARGO', 'PASO DE LAS TROPAS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6467, 27, 2, 'CERRO LARGO', 'PASO DE LAS YEGUAS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6468, 27, 2, 'CERRO LARGO', 'PASO DE LOS CARROS', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6469, 27, 2, 'CERRO LARGO', 'PASO MELO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6470, 27, 2, 'CERRO LARGO', 'PASO PEREIRA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(6471, 27, 2, 'CERRO LARGO', 'PEÑAROL', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6472, 27, 2, 'CERRO LARGO', 'PICADA DE MAYA', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6473, 27, 2, 'CERRO LARGO', 'PICADA DE SALOME', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6474, 27, 2, 'CERRO LARGO', 'PIEDRA ALTA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(6475, 27, 2, 'CERRO LARGO', 'PIÑEIRO', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6476, 27, 2, 'CERRO LARGO', 'PLACIDO ROSAS', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6477, 27, 2, 'CERRO LARGO', 'POBLADO URUGUAY', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6478, 27, 2, 'CERRO LARGO', 'PRESIDENTE DOCTOR GETULIO VARGAS', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6479, 27, 2, 'CERRO LARGO', 'PUENTE NEGRO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6480, 27, 2, 'CERRO LARGO', 'PUNTAS DE AMARILLO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6481, 27, 2, 'CERRO LARGO', 'PUNTAS DE LA MINA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6482, 27, 2, 'CERRO LARGO', 'PUNTAS DEL SAUCE', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6483, 27, 2, 'CERRO LARGO', 'PUNTAS DE MOLLES', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6484, 27, 2, 'CERRO LARGO', 'PUNTAS DE PALLEROS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6485, 27, 2, 'CERRO LARGO', 'PUNTAS DE TACUARI', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6486, 27, 2, 'CERRO LARGO', 'QUEBRACHO', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6487, 27, 2, 'CERRO LARGO', 'RAMON TRIGO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6488, 27, 2, 'CERRO LARGO', 'RINCON DE CONTRERAS', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6489, 27, 2, 'CERRO LARGO', 'RINCON DE LA URBANA', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6490, 27, 2, 'CERRO LARGO', 'RINCON DE LOS CORONELES', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6491, 27, 2, 'CERRO LARGO', 'RINCON DE LOS OLIVERA', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6492, 27, 2, 'CERRO LARGO', 'RINCON DE PAIVA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6493, 27, 2, 'CERRO LARGO', 'RINCON DE PY', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6494, 27, 2, 'CERRO LARGO', 'RINCON DE SUAREZ', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6495, 27, 2, 'CERRO LARGO', 'RINCON DE TACUARI', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6496, 27, 2, 'CERRO LARGO', 'RIO BRANCO', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6497, 27, 2, 'CERRO LARGO', 'RODRIGUEZ', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6498, 27, 2, 'CERRO LARGO', 'SALDAÑAS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6499, 27, 2, 'CERRO LARGO', 'SANCHEZ', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6500, 27, 2, 'CERRO LARGO', 'SAN DIEGO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6501, 27, 2, 'CERRO LARGO', 'SAN SERVANDO', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6502, 27, 2, 'CERRO LARGO', 'SANTA TERESA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6503, 27, 2, 'CERRO LARGO', 'SARANDI DE ACEGUA', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6504, 27, 2, 'CERRO LARGO', 'SARANDI DE BARCELO', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6505, 27, 2, 'CERRO LARGO', 'SARANDI DE YAGUARON', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6506, 27, 2, 'CERRO LARGO', 'SAUCE DE CONVENTOS', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6507, 27, 2, 'CERRO LARGO', 'SOTO GORO', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6508, 27, 2, 'CERRO LARGO', 'TOLEDO', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6509, 27, 2, 'CERRO LARGO', 'TRES BOLICHES', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6510, 27, 2, 'CERRO LARGO', 'TRES ISLAS', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6511, 27, 2, 'CERRO LARGO', 'TUPAMBAE', '36100', NULL, NULL);
INSERT INTO `localidades` VALUES(6512, 27, 2, 'CERRO LARGO', 'URUGUAY', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(6513, 27, 2, 'CERRO LARGO', 'VILLA VIÑOLES', '37000', NULL, NULL);
INSERT INTO `localidades` VALUES(6514, 27, 2, 'CERRO LARGO', 'WENCESLAO SILVERA', '36200', NULL, NULL);
INSERT INTO `localidades` VALUES(6515, 28, 2, 'COLONIA', 'AGRACIADA', '70700', NULL, NULL);
INSERT INTO `localidades` VALUES(6516, 28, 2, 'COLONIA', 'ARRIVILLAGA', '70500', NULL, NULL);
INSERT INTO `localidades` VALUES(6517, 28, 2, 'COLONIA', 'ARTILLEROS', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6518, 28, 2, 'COLONIA', 'BARKER', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6519, 28, 2, 'COLONIA', 'BARKER NORTE', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6520, 28, 2, 'COLONIA', 'BARRANCAS COLORADAS', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6521, 28, 2, 'COLONIA', 'BARRIO MENDAÑA', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6522, 28, 2, 'COLONIA', 'BARRIO OLIMPICO', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6523, 28, 2, 'COLONIA', 'BELGRANO NORTE', '70700', NULL, NULL);
INSERT INTO `localidades` VALUES(6524, 28, 2, 'COLONIA', 'BELGRANO SUR', '70700', NULL, NULL);
INSERT INTO `localidades` VALUES(6525, 28, 2, 'COLONIA', 'BLANCA ARENA', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6526, 28, 2, 'COLONIA', 'BOCA DEL ROSARIO', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6527, 28, 2, 'COLONIA', 'BOCA DEL ROSARIO OESTE', '70500', NULL, NULL);
INSERT INTO `localidades` VALUES(6528, 28, 2, 'COLONIA', 'BONJOUR', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6529, 28, 2, 'COLONIA', 'BRISAS DEL PLATA', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6530, 28, 2, 'COLONIA', 'BUENA HORA', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6531, 28, 2, 'COLONIA', 'CAMPAMENTO ARTIGAS', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6532, 28, 2, 'COLONIA', 'CAMPANA', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6533, 28, 2, 'COLONIA', 'CARMELO', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6534, 28, 2, 'COLONIA', 'CASERIO EL CERRO', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6535, 28, 2, 'COLONIA', 'CERRO CARMELO', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6536, 28, 2, 'COLONIA', 'CERRO DE LAS ARMAS', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6537, 28, 2, 'COLONIA', 'CERROS DE SAN JUAN', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6538, 28, 2, 'COLONIA', 'CERROS NEGROS', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6539, 28, 2, 'COLONIA', 'CHICO TORINO', '70400', NULL, NULL);
INSERT INTO `localidades` VALUES(6540, 28, 2, 'COLONIA', 'COLONIA ARRUE', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6541, 28, 2, 'COLONIA', 'COLONIA COSMOPOLITA', '70500', NULL, NULL);
INSERT INTO `localidades` VALUES(6542, 28, 2, 'COLONIA', 'COLONIA DEL SACRAMENTO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6543, 28, 2, 'COLONIA', 'COLONIA ESPAÑOLA', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6544, 28, 2, 'COLONIA', 'COLONIA ESTRELLA', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6545, 28, 2, 'COLONIA', 'COLONIA MIGUELETE', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6546, 28, 2, 'COLONIA', 'COLONIA PEIRANO', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6547, 28, 2, 'COLONIA', 'COLONIA QUEVEDO', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6548, 28, 2, 'COLONIA', 'COLONIA SARANDI', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6549, 28, 2, 'COLONIA', 'COLONIA TALICE', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6550, 28, 2, 'COLONIA', 'COLONIA VALDENSE', '70400', NULL, NULL);
INSERT INTO `localidades` VALUES(6551, 28, 2, 'COLONIA', 'CONCHILLAS', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6552, 28, 2, 'COLONIA', 'CONCORDIA', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6553, 28, 2, 'COLONIA', 'COSTA DE COLLA AL ESTE', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6554, 28, 2, 'COLONIA', 'COSTA DEL NAVARRO', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6555, 28, 2, 'COLONIA', 'COSTA DE ROSARIO', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6556, 28, 2, 'COLONIA', 'COSTA DE TARARIRAS', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6557, 28, 2, 'COLONIA', 'COSTA DE VACAS', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6558, 28, 2, 'COLONIA', 'COSTAS DE JUAN GONZALEZ', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6559, 28, 2, 'COLONIA', 'COSTAS DE POLONIA', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6560, 28, 2, 'COLONIA', 'COSTAS DE SAN JUAN', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6561, 28, 2, 'COLONIA', 'CUFRE', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6562, 28, 2, 'COLONIA', 'CURUPI', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6563, 28, 2, 'COLONIA', 'EL BAÑADO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6564, 28, 2, 'COLONIA', 'EL CAÑO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6565, 28, 2, 'COLONIA', 'EL CERRO', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6566, 28, 2, 'COLONIA', 'EL CHILENO', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6567, 28, 2, 'COLONIA', 'EL CUADRO', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6568, 28, 2, 'COLONIA', 'EL ENSUEÑO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6569, 28, 2, 'COLONIA', 'EL FARO', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6570, 28, 2, 'COLONIA', 'EL GENERAL', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6571, 28, 2, 'COLONIA', 'EL QUINTON', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6572, 28, 2, 'COLONIA', 'EL SEMILLERO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6573, 28, 2, 'COLONIA', 'ESTACION EXPERIMENTAL \"LA ESTANZUELA\"', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6574, 28, 2, 'COLONIA', 'ESTANCIA ANCHORENA', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6575, 28, 2, 'COLONIA', 'FLORENCIO SANCHEZ', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(6576, 28, 2, 'COLONIA', 'GIL', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6577, 28, 2, 'COLONIA', 'JUAN CARLOS CASEROS', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6578, 28, 2, 'COLONIA', 'JUAN GONZALEZ', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6579, 28, 2, 'COLONIA', 'JUAN JACKSON', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(6580, 28, 2, 'COLONIA', 'JUAN LACAZE', '70500', NULL, NULL);
INSERT INTO `localidades` VALUES(6581, 28, 2, 'COLONIA', 'LA ESTANZUELA', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6582, 28, 2, 'COLONIA', 'LAGUNA DE LOS PATOS', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6583, 28, 2, 'COLONIA', 'LA HORQUETA', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6584, 28, 2, 'COLONIA', 'LA PAZ', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6585, 28, 2, 'COLONIA', 'LAS CHISPAS', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6586, 28, 2, 'COLONIA', 'LAS FLORES', '70700', NULL, NULL);
INSERT INTO `localidades` VALUES(6587, 28, 2, 'COLONIA', 'LA SIERRA', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6588, 28, 2, 'COLONIA', 'LOMAS DE CARMELO', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6589, 28, 2, 'COLONIA', 'LOS PINOS', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6590, 28, 2, 'COLONIA', 'MANANTIALES', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6591, 28, 2, 'COLONIA', 'MARTIN CHICO', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6592, 28, 2, 'COLONIA', 'MARTIN CHICO DE CONCHILLAS', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6593, 28, 2, 'COLONIA', 'MEDIA AGUA', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6594, 28, 2, 'COLONIA', 'MIGUELETE DE CONCHILLAS', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6595, 28, 2, 'COLONIA', 'MINAS DE NARANCIO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6596, 28, 2, 'COLONIA', 'MINUANO Y SAUCE', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6597, 28, 2, 'COLONIA', 'MOLLES DE MIGUELETE', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6598, 28, 2, 'COLONIA', 'NUEVA HELVECIA', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6599, 28, 2, 'COLONIA', 'NUEVA PALMIRA', '70700', NULL, NULL);
INSERT INTO `localidades` VALUES(6600, 28, 2, 'COLONIA', 'OMBUES DE LAVALLE', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6601, 28, 2, 'COLONIA', 'PARAJE MINUANO', '70500', NULL, NULL);
INSERT INTO `localidades` VALUES(6602, 28, 2, 'COLONIA', 'PASO ANTOLIN', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6603, 28, 2, 'COLONIA', 'PASO BIRRIEL', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(6604, 28, 2, 'COLONIA', 'PASO DE LA QUINTA', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6605, 28, 2, 'COLONIA', 'PASO HOSPITAL', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6606, 28, 2, 'COLONIA', 'PASO HOSPITAL MANANTIALES', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6607, 28, 2, 'COLONIA', 'PASO MORLAN', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6608, 28, 2, 'COLONIA', 'PASO QUICHO', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6609, 28, 2, 'COLONIA', 'PASTOREO', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6610, 28, 2, 'COLONIA', 'PICADA DE BENITEZ', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6611, 28, 2, 'COLONIA', 'PIEDRA CHATA', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(6612, 28, 2, 'COLONIA', 'PIEDRA DE LOS INDIOS', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6613, 28, 2, 'COLONIA', 'PIEDRAS BLANCAS', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6614, 28, 2, 'COLONIA', 'PLAYA AZUL', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6615, 28, 2, 'COLONIA', 'PLAYA BRITOPOLIS', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6616, 28, 2, 'COLONIA', 'PLAYA FOMENTO', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6617, 28, 2, 'COLONIA', 'PLAYA PARANT', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6618, 28, 2, 'COLONIA', 'POLANCOS', '70700', NULL, NULL);
INSERT INTO `localidades` VALUES(6619, 28, 2, 'COLONIA', 'PUERTO CONCORDIA', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6620, 28, 2, 'COLONIA', 'PUERTO INGLES', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6621, 28, 2, 'COLONIA', 'PUERTO PLATERO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6622, 28, 2, 'COLONIA', 'PUERTO ROSARIO', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6623, 28, 2, 'COLONIA', 'PUNTA FRANCESA', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6624, 28, 2, 'COLONIA', 'PUNTAS DE JUAN GONZALEZ', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6625, 28, 2, 'COLONIA', 'PUNTAS DEL RIACHUELO', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6626, 28, 2, 'COLONIA', 'PUNTAS DEL ROSARIO', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6627, 28, 2, 'COLONIA', 'PUNTAS DEL SAUCE', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6628, 28, 2, 'COLONIA', 'PUNTAS DE MELO', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6629, 28, 2, 'COLONIA', 'PUNTAS DE SAN JUAN', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6630, 28, 2, 'COLONIA', 'PUNTAS DE SAN PEDRO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6631, 28, 2, 'COLONIA', 'QUINTON', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6632, 28, 2, 'COLONIA', 'RADIAL HERNANDEZ', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6633, 28, 2, 'COLONIA', 'RADIAL ROSARIO', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6634, 28, 2, 'COLONIA', 'REAL DE VERA', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6635, 28, 2, 'COLONIA', 'REDUCTO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6636, 28, 2, 'COLONIA', 'RESGUARDO CUFRE', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6637, 28, 2, 'COLONIA', 'RIACHUELO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6638, 28, 2, 'COLONIA', 'RINCON DEL REY', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6639, 28, 2, 'COLONIA', 'ROSARIO', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6640, 28, 2, 'COLONIA', 'ROSARIO Y COLLA', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6641, 28, 2, 'COLONIA', 'SAN JUAN', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6642, 28, 2, 'COLONIA', 'SAN LUIS', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6643, 28, 2, 'COLONIA', 'SAN LUIS DE TARARIRAS', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6644, 28, 2, 'COLONIA', 'SAN LUIS SANCHEZ', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6645, 28, 2, 'COLONIA', 'SAN PEDRO', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6646, 28, 2, 'COLONIA', 'SAN PEDRO DE ARRIBA', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6647, 28, 2, 'COLONIA', 'SAN PEDRO NORTE', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6648, 28, 2, 'COLONIA', 'SAN ROQUE', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6649, 28, 2, 'COLONIA', 'SANTA ANA', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6650, 28, 2, 'COLONIA', 'SANTA REGINA', '70300', NULL, NULL);
INSERT INTO `localidades` VALUES(6651, 28, 2, 'COLONIA', 'SANTA ROSA', '70000', NULL, NULL);
INSERT INTO `localidades` VALUES(6652, 28, 2, 'COLONIA', 'SARANDI CAMPANA', '70800', NULL, NULL);
INSERT INTO `localidades` VALUES(6653, 28, 2, 'COLONIA', 'TARARIRAS', '70600', NULL, NULL);
INSERT INTO `localidades` VALUES(6654, 28, 2, 'COLONIA', 'TERMINAL', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6655, 28, 2, 'COLONIA', 'TOMAS BELL', '70500', NULL, NULL);
INSERT INTO `localidades` VALUES(6656, 28, 2, 'COLONIA', 'TRES ESQUINAS', '70200', NULL, NULL);
INSERT INTO `localidades` VALUES(6657, 28, 2, 'COLONIA', 'VIBORAS', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6658, 28, 2, 'COLONIA', 'VIBORAS Y VACAS', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6659, 28, 2, 'COLONIA', 'VILLA PANCHA', '70500', NULL, NULL);
INSERT INTO `localidades` VALUES(6660, 28, 2, 'COLONIA', 'ZAGARZAZU', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(6661, 28, 2, 'COLONIA', 'ZUNIN', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(6662, 29, 2, 'DURAZNO', 'ABELLA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6663, 29, 2, 'DURAZNO', 'AGUAS BUENAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6664, 29, 2, 'DURAZNO', 'ARROYO DE LOS PERROS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6665, 29, 2, 'DURAZNO', 'BARRANCAS COLORADAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6666, 29, 2, 'DURAZNO', 'BARRIO DURAN', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6667, 29, 2, 'DURAZNO', 'BATOVI', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6668, 29, 2, 'DURAZNO', 'BAYGORRIA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6669, 29, 2, 'DURAZNO', 'BLANQUILLO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6670, 29, 2, 'DURAZNO', 'BLANQUILLO AL OESTE', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6671, 29, 2, 'DURAZNO', 'CABALLERO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6672, 29, 2, 'DURAZNO', 'CAPILLA DE FARRUCO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6673, 29, 2, 'DURAZNO', 'CARLOS REYLES', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6674, 29, 2, 'DURAZNO', 'CEIBAL', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6675, 29, 2, 'DURAZNO', 'CERREZUELO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6676, 29, 2, 'DURAZNO', 'CERRO CHATO', '35200', NULL, NULL);
INSERT INTO `localidades` VALUES(6677, 29, 2, 'DURAZNO', 'CERRO CONVENTO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6678, 29, 2, 'DURAZNO', 'CHACRAS DE DURAZNO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6679, 29, 2, 'DURAZNO', 'CHILENO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6680, 29, 2, 'DURAZNO', 'CHILENO CHICO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6681, 29, 2, 'DURAZNO', 'CHILENO GRANDE (AGUERO)', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6682, 29, 2, 'DURAZNO', 'COSTA DE CUADRA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6683, 29, 2, 'DURAZNO', 'CUCHILLA DEL RINCON', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6684, 29, 2, 'DURAZNO', 'CUCHILLA DE RAMIREZ', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6685, 29, 2, 'DURAZNO', 'DE DIOS', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6686, 29, 2, 'DURAZNO', 'DURAZNO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6687, 29, 2, 'DURAZNO', 'ELIAS REGULES', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6688, 29, 2, 'DURAZNO', 'ESTACION CHILENO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6689, 29, 2, 'DURAZNO', 'FELICIANO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6690, 29, 2, 'DURAZNO', 'FONSECA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6691, 29, 2, 'DURAZNO', 'HIGUERAS DE CARPINTERIA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6692, 29, 2, 'DURAZNO', 'LA ALEGRIA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6693, 29, 2, 'DURAZNO', 'LA MAZAMORRA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6694, 29, 2, 'DURAZNO', 'LA PALOMA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6695, 29, 2, 'DURAZNO', 'LAS ACACIAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6696, 29, 2, 'DURAZNO', 'LAS CAÑAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6697, 29, 2, 'DURAZNO', 'LAS PALMAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6698, 29, 2, 'DURAZNO', 'LAS TUNAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6699, 29, 2, 'DURAZNO', 'LOS AGREGADOS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6700, 29, 2, 'DURAZNO', 'LOS TAPES', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6701, 29, 2, 'DURAZNO', 'MAESTRE CAMPO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6702, 29, 2, 'DURAZNO', 'MALBAJAR ESTE', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6703, 29, 2, 'DURAZNO', 'MALBAJAR OESTE', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6704, 29, 2, 'DURAZNO', 'MARIA CEJAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6705, 29, 2, 'DURAZNO', 'MARISCALA', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6706, 29, 2, 'DURAZNO', 'MARISCALA DEL CARMEN', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6707, 29, 2, 'DURAZNO', 'MOLLES CHICO', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(6708, 29, 2, 'DURAZNO', 'MOLLES DE QUINTEROS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6709, 29, 2, 'DURAZNO', 'MOURIÑO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6710, 29, 2, 'DURAZNO', 'MUNICIPIO DE DURAZNO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6711, 29, 2, 'DURAZNO', 'OMBUES DE ORIBE', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6712, 29, 2, 'DURAZNO', 'PALMAR DE PORRUA', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(6713, 29, 2, 'DURAZNO', 'PALMAR DE PORRUA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6714, 29, 2, 'DURAZNO', 'PARADA SUR', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(6715, 29, 2, 'DURAZNO', 'PARISH', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(6716, 29, 2, 'DURAZNO', 'PASO DE AGUIRRE', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6717, 29, 2, 'DURAZNO', 'PASO DE CASTRO', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6718, 29, 2, 'DURAZNO', 'PASO DEL MEDIO LAS PALMAS', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6719, 29, 2, 'DURAZNO', 'PASO RAMIREZ', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6720, 29, 2, 'DURAZNO', 'PASO REAL DE CARPINTERIA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6721, 29, 2, 'DURAZNO', 'PASO TEJERA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6722, 29, 2, 'DURAZNO', 'PUEBLO CENTENARIO', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(6723, 29, 2, 'DURAZNO', 'PUEBLO DE ALVAREZ', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6724, 29, 2, 'DURAZNO', 'PUGLIA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6725, 29, 2, 'DURAZNO', 'PUNTAS DE CARPINTERIA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6726, 29, 2, 'DURAZNO', 'PUNTAS DE HERRERA', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6727, 29, 2, 'DURAZNO', 'PUNTAS DE MALBAJAR', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6728, 29, 2, 'DURAZNO', 'RINCON DE CUADRA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6729, 29, 2, 'DURAZNO', 'RINCON DE LOS TAPES', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6730, 29, 2, 'DURAZNO', 'ROLON', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6731, 29, 2, 'DURAZNO', 'ROSSELL Y RIUS', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6732, 29, 2, 'DURAZNO', 'SALINAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6733, 29, 2, 'DURAZNO', 'SALINAS CHICO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6734, 29, 2, 'DURAZNO', 'SANDE CHICO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6735, 29, 2, 'DURAZNO', 'SANDU CHICO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6736, 29, 2, 'DURAZNO', 'SAN JORGE', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6737, 29, 2, 'DURAZNO', 'SAN JOSE DE LAS CAÑAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6738, 29, 2, 'DURAZNO', 'SANTA BERNARDINA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6739, 29, 2, 'DURAZNO', 'SARANDI DE LA CHINA', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(6740, 29, 2, 'DURAZNO', 'SARANDI DEL YI', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6741, 29, 2, 'DURAZNO', 'SARANDI DE RIO NEGRO', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6742, 29, 2, 'DURAZNO', 'SAUCE DE HERRERA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6743, 29, 2, 'DURAZNO', 'SAUCE DEL YI', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6744, 29, 2, 'DURAZNO', 'TALA DE MARISCALA', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6745, 29, 2, 'DURAZNO', 'TEJERA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6746, 29, 2, 'DURAZNO', 'VERDUN', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6747, 29, 2, 'DURAZNO', 'VILLA DEL CARMEN', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6748, 29, 2, 'DURAZNO', 'VILLASBOAS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6749, 30, 2, 'FLORES', 'AHOGADOS', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6750, 30, 2, 'FLORES', 'ANDRESITO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6751, 30, 2, 'FLORES', 'ARENAL CHICO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6752, 30, 2, 'FLORES', 'ARENAL GRANDE', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6753, 30, 2, 'FLORES', 'ARROYO MALO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6754, 30, 2, 'FLORES', 'CAÑADA AMILIVIA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6755, 30, 2, 'FLORES', 'CERRO COLORADO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6756, 30, 2, 'FLORES', 'CHACRAS', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6757, 30, 2, 'FLORES', 'CHACRAS DE BORGHI', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6758, 30, 2, 'FLORES', 'COLONIA ALEMANA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6759, 30, 2, 'FLORES', 'COSTAS DEL TALA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6760, 30, 2, 'FLORES', 'COSTAS DE SAN JOSE', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6761, 30, 2, 'FLORES', 'CUCHILLA DE VILLASBOAS', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6762, 30, 2, 'FLORES', 'EL CORONILLA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6763, 30, 2, 'FLORES', 'EL TOTORAL', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6764, 30, 2, 'FLORES', 'FERRIZO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6765, 30, 2, 'FLORES', 'ISMAEL CORTINAS', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6766, 30, 2, 'FLORES', 'JUAN JOSE CASTRO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6767, 30, 2, 'FLORES', 'LA ALIANZA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6768, 30, 2, 'FLORES', 'LA CASILLA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6769, 30, 2, 'FLORES', 'LA CORDOBESA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6770, 30, 2, 'FLORES', 'LA GUARDIA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6771, 30, 2, 'FLORES', 'LOS PUENTES', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6772, 30, 2, 'FLORES', 'MARINCHO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6773, 30, 2, 'FLORES', 'PASO  DE LUGO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6774, 30, 2, 'FLORES', 'PASO HONDO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6775, 30, 2, 'FLORES', 'PUEBLO PINTOS', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6776, 30, 2, 'FLORES', 'PUNTAS DE CHAMANGA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6777, 30, 2, 'FLORES', 'PUNTAS DEL CORRAL DE PIEDRA', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6778, 30, 2, 'FLORES', 'PUNTAS DEL SAUCE', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6779, 30, 2, 'FLORES', 'PUNTAS DE MARINCHO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6780, 30, 2, 'FLORES', 'PUNTAS DE SAN JOSE', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6781, 30, 2, 'FLORES', 'PUNTAS DE SARANDI', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6782, 30, 2, 'FLORES', 'RINCON DEL PALACIO', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6783, 30, 2, 'FLORES', 'SAN GREGORIO DE FLORES', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6784, 30, 2, 'FLORES', 'SANTA ADELAIDA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6785, 30, 2, 'FLORES', 'SARANDI', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6786, 30, 2, 'FLORES', 'TALAS DE MACIEL', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6787, 30, 2, 'FLORES', 'TRINIDAD', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6788, 30, 2, 'FLORES', 'VILLA PASTORA', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6789, 30, 2, 'FLORES', 'VILLASBOAS', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(6790, 31, 2, 'FLORIDA', '25 DE AGOSTO', '95400', NULL, NULL);
INSERT INTO `localidades` VALUES(6791, 31, 2, 'FLORIDA', '25 DE MAYO', '95100', NULL, NULL);
INSERT INTO `localidades` VALUES(6792, 31, 2, 'FLORIDA', 'ALEJANDRO GALLINAL', '96500', NULL, NULL);
INSERT INTO `localidades` VALUES(6793, 31, 2, 'FLORIDA', 'ARRAYAN', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6794, 31, 2, 'FLORIDA', 'ARROYO CHAMIZO', '96200', NULL, NULL);
INSERT INTO `localidades` VALUES(6795, 31, 2, 'FLORIDA', 'ARROYO DE LOS NEGROS', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6796, 31, 2, 'FLORIDA', 'ARROYO LATORRE', '96200', NULL, NULL);
INSERT INTO `localidades` VALUES(6797, 31, 2, 'FLORIDA', 'ARROYO MONZON', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6798, 31, 2, 'FLORIDA', 'ARROYO PELADO', '95500', NULL, NULL);
INSERT INTO `localidades` VALUES(6799, 31, 2, 'FLORIDA', 'ARTEAGA', '96500', NULL, NULL);
INSERT INTO `localidades` VALUES(6800, 31, 2, 'FLORIDA', 'BARRA MOLLES DEL TIMOTE', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6801, 31, 2, 'FLORIDA', 'BARRA SAUCE DE MANSAVILLAGRA', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6802, 31, 2, 'FLORIDA', 'BERRONDO', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6803, 31, 2, 'FLORIDA', 'CALLERI', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6804, 31, 2, 'FLORIDA', 'CANDIL', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6805, 31, 2, 'FLORIDA', 'CAPILLA DEL SAUCE', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6806, 31, 2, 'FLORIDA', 'CARDAL', '95200', NULL, NULL);
INSERT INTO `localidades` VALUES(6807, 31, 2, 'FLORIDA', 'CASERIO LA FUNDACION', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6808, 31, 2, 'FLORIDA', 'CASUPA', '96300', NULL, NULL);
INSERT INTO `localidades` VALUES(6809, 31, 2, 'FLORIDA', 'CERRO CHATO', '35200', NULL, NULL);
INSERT INTO `localidades` VALUES(6810, 31, 2, 'FLORIDA', 'CERRO DE LA MACANA', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6811, 31, 2, 'FLORIDA', 'CERROS DE FLORIDA', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6812, 31, 2, 'FLORIDA', 'CHACRAS DE FLORIDA', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6813, 31, 2, 'FLORIDA', 'CHACRAS DEL PINTADO', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6814, 31, 2, 'FLORIDA', 'CHAMIZO', '96100', NULL, NULL);
INSERT INTO `localidades` VALUES(6815, 31, 2, 'FLORIDA', 'CHAMIZO CHICO', '96100', NULL, NULL);
INSERT INTO `localidades` VALUES(6816, 31, 2, 'FLORIDA', 'CHILCAS', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6817, 31, 2, 'FLORIDA', 'CHINGOLAS', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6818, 31, 2, 'FLORIDA', 'COLONIA SANCHEZ', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6819, 31, 2, 'FLORIDA', 'COLONIA TREINTA Y TRES ORIENTALES', '96100', NULL, NULL);
INSERT INTO `localidades` VALUES(6820, 31, 2, 'FLORIDA', 'CORRAL DE PIEDRA', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6821, 31, 2, 'FLORIDA', 'COSTA DE ARIAS', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6822, 31, 2, 'FLORIDA', 'COSTA DE ILLESCAS', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6823, 31, 2, 'FLORIDA', 'COSTA DE LA CRUZ', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6824, 31, 2, 'FLORIDA', 'COSTA DEL TALA', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6825, 31, 2, 'FLORIDA', 'COSTA DE PARANA', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6826, 31, 2, 'FLORIDA', 'COSTAS DE ARIAS', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6827, 31, 2, 'FLORIDA', 'COSTAS DE CHAMIZO', '96100', NULL, NULL);
INSERT INTO `localidades` VALUES(6828, 31, 2, 'FLORIDA', 'COSTAS DE CHAMIZO GRANDE', '96200', NULL, NULL);
INSERT INTO `localidades` VALUES(6829, 31, 2, 'FLORIDA', 'COSTAS DEL AMARILLO', '96300', NULL, NULL);
INSERT INTO `localidades` VALUES(6830, 31, 2, 'FLORIDA', 'COSTAS DEL PINTADO', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6831, 31, 2, 'FLORIDA', 'COSTAS DEL SANTA LUCIA GRANDE', '96100', NULL, NULL);
INSERT INTO `localidades` VALUES(6832, 31, 2, 'FLORIDA', 'COSTAS DE MACIEL', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6833, 31, 2, 'FLORIDA', 'COSTAS DE SANTA LUCIA CHICO', '95200', NULL, NULL);
INSERT INTO `localidades` VALUES(6834, 31, 2, 'FLORIDA', 'CUCHILLA SANTO DOMINGO', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6835, 31, 2, 'FLORIDA', 'DR. A. GALLINAL', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6836, 31, 2, 'FLORIDA', 'ESTACION CAPILLA DEL SAUCE', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6837, 31, 2, 'FLORIDA', 'FERRER', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6838, 31, 2, 'FLORIDA', 'FLORIDA', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6839, 31, 2, 'FLORIDA', 'FRAY MARCOS', '96200', NULL, NULL);
INSERT INTO `localidades` VALUES(6840, 31, 2, 'FLORIDA', 'GOÑI', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6841, 31, 2, 'FLORIDA', 'HERNANDARIAS', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6842, 31, 2, 'FLORIDA', 'ILLESCAS', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6843, 31, 2, 'FLORIDA', 'INDEPENDENCIA', '95300', NULL, NULL);
INSERT INTO `localidades` VALUES(6844, 31, 2, 'FLORIDA', 'JOSE BATLLE Y ORDOÑEZ', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6845, 31, 2, 'FLORIDA', 'JUNCAL', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6846, 31, 2, 'FLORIDA', 'LA CIMBRA', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6847, 31, 2, 'FLORIDA', 'LA CRUZ', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6848, 31, 2, 'FLORIDA', 'LA ESCOBILLA', '96200', NULL, NULL);
INSERT INTO `localidades` VALUES(6849, 31, 2, 'FLORIDA', 'LA MACANA', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6850, 31, 2, 'FLORIDA', 'LA PALMA', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6851, 31, 2, 'FLORIDA', 'LAS PIEDRITAS', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6852, 31, 2, 'FLORIDA', 'LA VICTORIA', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6853, 31, 2, 'FLORIDA', 'MANSAVILLAGRA', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6854, 31, 2, 'FLORIDA', 'MENDOZA CHICO', '95600', NULL, NULL);
INSERT INTO `localidades` VALUES(6855, 31, 2, 'FLORIDA', 'MENDOZA GRANDE', '95500', NULL, NULL);
INSERT INTO `localidades` VALUES(6856, 31, 2, 'FLORIDA', 'MOLLES DEL PESCADO', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6857, 31, 2, 'FLORIDA', 'MOLLES DEL TIMOTE', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6858, 31, 2, 'FLORIDA', 'MONTECORAL', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6859, 31, 2, 'FLORIDA', 'NICO PEREZ', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6860, 31, 2, 'FLORIDA', 'PALERMO', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6861, 31, 2, 'FLORIDA', 'PANTANOSO DE CASTRO', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6862, 31, 2, 'FLORIDA', 'PASO CALLEROS', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6863, 31, 2, 'FLORIDA', 'PASO DE LOS NOVILLOS', '95100', NULL, NULL);
INSERT INTO `localidades` VALUES(6864, 31, 2, 'FLORIDA', 'PASO REAL DE MANSAVILLAGRA', '96500', NULL, NULL);
INSERT INTO `localidades` VALUES(6865, 31, 2, 'FLORIDA', 'PASO VELA', '95100', NULL, NULL);
INSERT INTO `localidades` VALUES(6866, 31, 2, 'FLORIDA', 'PIEDRA CAMPANA', '96400', NULL, NULL);
INSERT INTO `localidades` VALUES(6867, 31, 2, 'FLORIDA', 'PIEDRAS COLORADAS', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6868, 31, 2, 'FLORIDA', 'PINTADO', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6869, 31, 2, 'FLORIDA', 'POLANCO DEL YI', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6870, 31, 2, 'FLORIDA', 'PUEBLO DE LOS MOROCHOS', '35100', NULL, NULL);
INSERT INTO `localidades` VALUES(6871, 31, 2, 'FLORIDA', 'PUENTE DE MENDOZA', '95500', NULL, NULL);
INSERT INTO `localidades` VALUES(6872, 31, 2, 'FLORIDA', 'PUNTAS DE CALLEROS', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6873, 31, 2, 'FLORIDA', 'PUNTAS DE CHAMAME', '96500', NULL, NULL);
INSERT INTO `localidades` VALUES(6874, 31, 2, 'FLORIDA', 'PUNTAS DE CHAMIZO', '96300', NULL, NULL);
INSERT INTO `localidades` VALUES(6875, 31, 2, 'FLORIDA', 'PUNTAS DE ILLESCAS', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6876, 31, 2, 'FLORIDA', 'PUNTAS DE LA ESCOBILLA', '96200', NULL, NULL);
INSERT INTO `localidades` VALUES(6877, 31, 2, 'FLORIDA', 'PUNTAS DEL ARROYO LATORRE', '96200', NULL, NULL);
INSERT INTO `localidades` VALUES(6878, 31, 2, 'FLORIDA', 'PUNTAS DE MACIEL', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6879, 31, 2, 'FLORIDA', 'PUNTAS DE MANSAVILLAGRA', '96500', NULL, NULL);
INSERT INTO `localidades` VALUES(6880, 31, 2, 'FLORIDA', 'PUNTAS DE SARANDI', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6881, 31, 2, 'FLORIDA', 'PUNTAS DE SAUCE DE MACIEL', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6882, 31, 2, 'FLORIDA', 'REBOLEDO', '96400', NULL, NULL);
INSERT INTO `localidades` VALUES(6883, 31, 2, 'FLORIDA', 'RINCON DE LOS CAMILOS', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6884, 31, 2, 'FLORIDA', 'RINCON DE VIGNOLI', '95500', NULL, NULL);
INSERT INTO `localidades` VALUES(6885, 31, 2, 'FLORIDA', 'RINCON SAUCE DEL YI', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6886, 31, 2, 'FLORIDA', 'SAN GABRIEL', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6887, 31, 2, 'FLORIDA', 'SAN GERONIMO', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6888, 31, 2, 'FLORIDA', 'SAN JUAN', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6889, 31, 2, 'FLORIDA', 'SAN PEDRO DE TIMOTE', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6890, 31, 2, 'FLORIDA', 'SANTA CLARA', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6891, 31, 2, 'FLORIDA', 'SANTA TERESA', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6892, 31, 2, 'FLORIDA', 'SARANDI GRANDE', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6893, 31, 2, 'FLORIDA', 'SAUCE DEL YI', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6894, 31, 2, 'FLORIDA', 'SAUCE DE MACIEL', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6895, 31, 2, 'FLORIDA', 'SAUCE DE VILLANUEVA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(6896, 31, 2, 'FLORIDA', 'TABARE', '98000', NULL, NULL);
INSERT INTO `localidades` VALUES(6897, 31, 2, 'FLORIDA', 'TALA DE CASTRO', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6898, 31, 2, 'FLORIDA', 'TALA DE MACIEL', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6899, 31, 2, 'FLORIDA', 'TALITA', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6900, 31, 2, 'FLORIDA', 'TORNERO', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6901, 31, 2, 'FLORIDA', 'URIOSTE', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6902, 31, 2, 'FLORIDA', 'VALENTINES', '35100', NULL, NULL);
INSERT INTO `localidades` VALUES(6903, 31, 2, 'FLORIDA', 'VIGNOLI', '96300', NULL, NULL);
INSERT INTO `localidades` VALUES(6904, 31, 2, 'FLORIDA', 'VILLA HIPICA', '94100', NULL, NULL);
INSERT INTO `localidades` VALUES(6905, 31, 2, 'FLORIDA', 'VILLA VIEJA', '94000', NULL, NULL);
INSERT INTO `localidades` VALUES(6906, 32, 2, 'LAVALLEJA', '19 DE JUNIO', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6907, 32, 2, 'LAVALLEJA', 'ABRA DE ZABALETA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6908, 32, 2, 'LAVALLEJA', 'AGUAS BLANCAS', '30100', NULL, NULL);
INSERT INTO `localidades` VALUES(6909, 32, 2, 'LAVALLEJA', 'ALONSO', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6910, 32, 2, 'LAVALLEJA', 'ARAMENDIA', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6911, 32, 2, 'LAVALLEJA', 'AREQUITA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6912, 32, 2, 'LAVALLEJA', 'ARROYO DEL MEDIO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6913, 32, 2, 'LAVALLEJA', 'ARROYO DE LOS PATOS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6914, 32, 2, 'LAVALLEJA', 'AZUCAR', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6915, 32, 2, 'LAVALLEJA', 'BARRA DE LOS CHANCHOS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6916, 32, 2, 'LAVALLEJA', 'BARRANCAS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6917, 32, 2, 'LAVALLEJA', 'BARRIGA NEGRA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6918, 32, 2, 'LAVALLEJA', 'BARRIO LA CORONILLA - ANCAP', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6919, 32, 2, 'LAVALLEJA', 'BLANES VIALE', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6920, 32, 2, 'LAVALLEJA', 'CAMPANERO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6921, 32, 2, 'LAVALLEJA', 'CANTERAS DEL VERDUN', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6922, 32, 2, 'LAVALLEJA', 'CARNALES', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6923, 32, 2, 'LAVALLEJA', 'CASUPA', '96300', NULL, NULL);
INSERT INTO `localidades` VALUES(6924, 32, 2, 'LAVALLEJA', 'CASUPA CHICO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6925, 32, 2, 'LAVALLEJA', 'CERRO PELADO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6926, 32, 2, 'LAVALLEJA', 'CHAMAME', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6927, 32, 2, 'LAVALLEJA', 'COLON', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6928, 32, 2, 'LAVALLEJA', 'CONSEJO DEL NIÑO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6929, 32, 2, 'LAVALLEJA', 'COSTA DEL LENGUAZO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6930, 32, 2, 'LAVALLEJA', 'COSTAS DE CORRALES', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6931, 32, 2, 'LAVALLEJA', 'COSTAS DEL SOLDADO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6932, 32, 2, 'LAVALLEJA', 'EL ALTO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6933, 32, 2, 'LAVALLEJA', 'EL PERDIDO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6934, 32, 2, 'LAVALLEJA', 'EL SOLDADO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6935, 32, 2, 'LAVALLEJA', 'EL TIGRE', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6936, 32, 2, 'LAVALLEJA', 'ESPUELITAS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6937, 32, 2, 'LAVALLEJA', 'ESTACION ANDREONI', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6938, 32, 2, 'LAVALLEJA', 'ESTACION ORTIZ', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6939, 32, 2, 'LAVALLEJA', 'ESTACION SOLIS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6940, 32, 2, 'LAVALLEJA', 'GAETAN (CUCHILLA DE CARBAJAL)', '96300', NULL, NULL);
INSERT INTO `localidades` VALUES(6941, 32, 2, 'LAVALLEJA', 'GODOY', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6942, 32, 2, 'LAVALLEJA', 'GUTIERREZ', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6943, 32, 2, 'LAVALLEJA', 'HIGUERITAS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6944, 32, 2, 'LAVALLEJA', 'ILLESCAS', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6945, 32, 2, 'LAVALLEJA', 'JOSE BATLLE Y ORDOÑEZ', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6946, 32, 2, 'LAVALLEJA', 'JOSE PEDRO VARELA', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6947, 32, 2, 'LAVALLEJA', 'LA CUCHILLA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6948, 32, 2, 'LAVALLEJA', 'LADRILLOS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6949, 32, 2, 'LAVALLEJA', 'LA PLATA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6950, 32, 2, 'LAVALLEJA', 'LARROSA', '34200', NULL, NULL);
INSERT INTO `localidades` VALUES(6951, 32, 2, 'LAVALLEJA', 'LAS ACHIRAS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6952, 32, 2, 'LAVALLEJA', 'LOS TAPES', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6953, 32, 2, 'LAVALLEJA', 'MANGUERA AZUL', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6954, 32, 2, 'LAVALLEJA', 'MARCO DE LOS REYES', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6955, 32, 2, 'LAVALLEJA', 'MARISCALA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6956, 32, 2, 'LAVALLEJA', 'MARMARAJA', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(6957, 32, 2, 'LAVALLEJA', 'MINAS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6958, 32, 2, 'LAVALLEJA', 'MOLLES DE AIGUA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6959, 32, 2, 'LAVALLEJA', 'MOLLES DE CAÑADA GRANDE', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6960, 32, 2, 'LAVALLEJA', 'MOLLES DEL SAUCE', '34100', NULL, NULL);
INSERT INTO `localidades` VALUES(6961, 32, 2, 'LAVALLEJA', 'OMBUES DE BENTANCOR', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6962, 32, 2, 'LAVALLEJA', 'ORTIZ CASTRO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6963, 32, 2, 'LAVALLEJA', 'PASO ARBELO', '30100', NULL, NULL);
INSERT INTO `localidades` VALUES(6964, 32, 2, 'LAVALLEJA', 'PASO DE LOS TRONCOS', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(6965, 32, 2, 'LAVALLEJA', 'PASO DE MESA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6966, 32, 2, 'LAVALLEJA', 'PIRARAJA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6967, 32, 2, 'LAVALLEJA', 'POLANCO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6968, 32, 2, 'LAVALLEJA', 'POLANCO NORTE', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6969, 32, 2, 'LAVALLEJA', 'POLANCO SUR', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6970, 32, 2, 'LAVALLEJA', 'PORORO', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(6971, 32, 2, 'LAVALLEJA', 'PUENTE DE MARMARAJA', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(6972, 32, 2, 'LAVALLEJA', 'PUNTAS DE BARRIGA NEGRA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6973, 32, 2, 'LAVALLEJA', 'PUNTAS DE LOS CHANCHOS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6974, 32, 2, 'LAVALLEJA', 'PUNTAS DEL PERDIDO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6975, 32, 2, 'LAVALLEJA', 'PUNTAS DE POLANCO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6976, 32, 2, 'LAVALLEJA', 'PUNTAS DE SAN FRANCISCO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6977, 32, 2, 'LAVALLEJA', 'PUNTAS DE SANTA LUCIA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6978, 32, 2, 'LAVALLEJA', 'PUNTAS DE SOLIS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6979, 32, 2, 'LAVALLEJA', 'PUNTAS DE VEJIGAS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6980, 32, 2, 'LAVALLEJA', 'RETAMOSA', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6981, 32, 2, 'LAVALLEJA', 'RINCON DE CEBOLLATI', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6982, 32, 2, 'LAVALLEJA', 'RINCON DE MARISCALA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6983, 32, 2, 'LAVALLEJA', 'RINCON DE SILVA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6984, 32, 2, 'LAVALLEJA', 'ROLDAN', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6985, 32, 2, 'LAVALLEJA', 'SAN FRANCISCO DE LAS SIERRAS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6986, 32, 2, 'LAVALLEJA', 'SANTA LUCIA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6987, 32, 2, 'LAVALLEJA', 'SARANDI DE GUTIERREZ', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(6988, 32, 2, 'LAVALLEJA', 'SAUCE DE AIGUA', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(6989, 32, 2, 'LAVALLEJA', 'SAUCE DE OLIMAR CHICO', '34100', NULL, NULL);
INSERT INTO `localidades` VALUES(6990, 32, 2, 'LAVALLEJA', 'SIERRAS BLANCAS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6991, 32, 2, 'LAVALLEJA', 'SOLDADO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6992, 32, 2, 'LAVALLEJA', 'SOLIS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6993, 32, 2, 'LAVALLEJA', 'SOLIS DE MATAOJO', '30100', NULL, NULL);
INSERT INTO `localidades` VALUES(6994, 32, 2, 'LAVALLEJA', 'SOLIS GRANDE', '91700', NULL, NULL);
INSERT INTO `localidades` VALUES(6995, 32, 2, 'LAVALLEJA', 'TAPES CHICO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6996, 32, 2, 'LAVALLEJA', 'TAPES GRANDE', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6997, 32, 2, 'LAVALLEJA', 'VALLE DE SOLIS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6998, 32, 2, 'LAVALLEJA', 'VEJIGAS', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(6999, 32, 2, 'LAVALLEJA', 'VELAZQUEZ', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(7000, 32, 2, 'LAVALLEJA', 'VERDUN', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(7001, 32, 2, 'LAVALLEJA', 'VILLA DEL ROSARIO', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(7002, 32, 2, 'LAVALLEJA', 'VILLA SERRANA', '30000', NULL, NULL);
INSERT INTO `localidades` VALUES(7003, 32, 2, 'LAVALLEJA', 'ZAPICAN', '34100', NULL, NULL);
INSERT INTO `localidades` VALUES(7004, 33, 2, 'MALDONADO', 'ABRA DE CASTELLANOS', '30100', NULL, NULL);
INSERT INTO `localidades` VALUES(7005, 33, 2, 'MALDONADO', 'ABRA DE PERDOMO', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7006, 33, 2, 'MALDONADO', 'AIGUA', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(7007, 33, 2, 'MALDONADO', 'ALFARO', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7008, 33, 2, 'MALDONADO', 'ALFEREZ', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(7009, 33, 2, 'MALDONADO', 'ARENAS DE JOSE IGNACIO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7010, 33, 2, 'MALDONADO', 'ARROYITO DE MEDINA', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7011, 33, 2, 'MALDONADO', 'BALNEARIO BUENOS AIRES', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7012, 33, 2, 'MALDONADO', 'BARRA DEL SAUCE', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7013, 33, 2, 'MALDONADO', 'BARRA DE PORTEZUELO', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7014, 33, 2, 'MALDONADO', 'BARRIO HIPODROMO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7015, 33, 2, 'MALDONADO', 'BARRIO HIPODROMO', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7016, 33, 2, 'MALDONADO', 'BARRIO KENNEDY', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7017, 33, 2, 'MALDONADO', 'BELLA VISTA', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7018, 33, 2, 'MALDONADO', 'BUENOS AIRES', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7019, 33, 2, 'MALDONADO', 'CANTERAS DE MARELLI', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7020, 33, 2, 'MALDONADO', 'CAÑADA BELLACA', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7021, 33, 2, 'MALDONADO', 'CAÑADA DE LA CRUZ', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7022, 33, 2, 'MALDONADO', 'CARAPE', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7023, 33, 2, 'MALDONADO', 'CARLOS CAL', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7024, 33, 2, 'MALDONADO', 'CERRO PELADO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7025, 33, 2, 'MALDONADO', 'CERROS AZULES', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7026, 33, 2, 'MALDONADO', 'CERROS AZULES', '20300', NULL, NULL);
INSERT INTO `localidades` VALUES(7027, 33, 2, 'MALDONADO', 'CHIHUAHUA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7028, 33, 2, 'MALDONADO', 'COLONIA J. SUAREZ', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7029, 33, 2, 'MALDONADO', 'CORONILLA', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(7030, 33, 2, 'MALDONADO', 'CORTE DE LA LEÑA', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7031, 33, 2, 'MALDONADO', 'COSTAS DE JOSE IGNACIO', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7032, 33, 2, 'MALDONADO', 'EDEN ROCK', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7033, 33, 2, 'MALDONADO', 'EL CHORRO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7034, 33, 2, 'MALDONADO', 'EL EDEN', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7035, 33, 2, 'MALDONADO', 'EL QUIJOTE', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7036, 33, 2, 'MALDONADO', 'EL TESORO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7037, 33, 2, 'MALDONADO', 'FARO JOSE IGNACIO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7038, 33, 2, 'MALDONADO', 'FARO JOSE IGNACIO NORTE', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7039, 33, 2, 'MALDONADO', 'GARZON', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7040, 33, 2, 'MALDONADO', 'GERONA', '20300', NULL, NULL);
INSERT INTO `localidades` VALUES(7041, 33, 2, 'MALDONADO', 'GREGORIO AZNAREZ', '20300', NULL, NULL);
INSERT INTO `localidades` VALUES(7042, 33, 2, 'MALDONADO', 'GUARDIA VIEJA', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7043, 33, 2, 'MALDONADO', 'JOSE IGNACIO', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7044, 33, 2, 'MALDONADO', 'LA BARRA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7045, 33, 2, 'MALDONADO', 'LA CAPUERA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7046, 33, 2, 'MALDONADO', 'LA FALDA', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7047, 33, 2, 'MALDONADO', 'LAGO DE LOS CISNES', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7048, 33, 2, 'MALDONADO', 'LAGUNA BLANCA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7049, 33, 2, 'MALDONADO', 'LAGUNA DEL SAUCE', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7050, 33, 2, 'MALDONADO', 'LA JUANITA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7051, 33, 2, 'MALDONADO', 'LAS CAÑAS', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7052, 33, 2, 'MALDONADO', 'LAS CUMBRES', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7053, 33, 2, 'MALDONADO', 'LAS FLORES', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7054, 33, 2, 'MALDONADO', 'LAS FLORES - ESTACION', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7055, 33, 2, 'MALDONADO', 'LA SIERRA', '20300', NULL, NULL);
INSERT INTO `localidades` VALUES(7056, 33, 2, 'MALDONADO', 'LA SONRISA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7057, 33, 2, 'MALDONADO', 'LOS AROMOS', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7058, 33, 2, 'MALDONADO', 'LOS CEIBOS', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7059, 33, 2, 'MALDONADO', 'LOS CORCHOS', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7060, 33, 2, 'MALDONADO', 'LOS TALAS', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7061, 33, 2, 'MALDONADO', 'MALDONADO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7062, 33, 2, 'MALDONADO', 'MALDONADO', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7063, 33, 2, 'MALDONADO', 'MANANTIALES', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7064, 33, 2, 'MALDONADO', 'MATAOJO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7065, 33, 2, 'MALDONADO', 'MIRAMAR', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7066, 33, 2, 'MALDONADO', 'MOLLES DE GARZON', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7067, 33, 2, 'MALDONADO', 'NUEVA CARRARA', '20300', NULL, NULL);
INSERT INTO `localidades` VALUES(7068, 33, 2, 'MALDONADO', 'OCEAN PARK', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7069, 33, 2, 'MALDONADO', 'PAGO DE LA PAJA', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7070, 33, 2, 'MALDONADO', 'PAN DE AZUCAR', '20300', NULL, NULL);
INSERT INTO `localidades` VALUES(7071, 33, 2, 'MALDONADO', 'PARQUE MEDINA', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7072, 33, 2, 'MALDONADO', 'PARTIDO NORTE', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7073, 33, 2, 'MALDONADO', 'PARTIDO OESTE', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7074, 33, 2, 'MALDONADO', 'PASO DE LA CANTERA', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7075, 33, 2, 'MALDONADO', 'PASO DE LOS TALAS', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(7076, 33, 2, 'MALDONADO', 'PINARES - LAS DELICIAS', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7077, 33, 2, 'MALDONADO', 'PIRIAPOLIS', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7078, 33, 2, 'MALDONADO', 'PLAYA GRANDE', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7079, 33, 2, 'MALDONADO', 'PLAYA HERMOSA', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7080, 33, 2, 'MALDONADO', 'PLAYA VERDE', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7081, 33, 2, 'MALDONADO', 'PORTEZUELO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7082, 33, 2, 'MALDONADO', 'PUEBLO SOLIS', '20300', NULL, NULL);
INSERT INTO `localidades` VALUES(7083, 33, 2, 'MALDONADO', 'PUNTA BALLENA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7084, 33, 2, 'MALDONADO', 'PUNTA COLORADA', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7085, 33, 2, 'MALDONADO', 'PUNTA DEL ESTE', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7086, 33, 2, 'MALDONADO', 'PUNTA DEL ESTE', '20100', NULL, NULL);
INSERT INTO `localidades` VALUES(7087, 33, 2, 'MALDONADO', 'PUNTA FRIA', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7088, 33, 2, 'MALDONADO', 'PUNTA NEGRA', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7089, 33, 2, 'MALDONADO', 'PUNTAS DE JOSE IGNACIO', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7090, 33, 2, 'MALDONADO', 'PUNTAS DE LA SIERRA', '20300', NULL, NULL);
INSERT INTO `localidades` VALUES(7091, 33, 2, 'MALDONADO', 'PUNTAS DEL CAMPANERA', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7092, 33, 2, 'MALDONADO', 'PUNTAS DE MATAOJO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7093, 33, 2, 'MALDONADO', 'PUNTAS DE PAN DE AZUCAR', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7094, 33, 2, 'MALDONADO', 'RINCON DE APARICIO', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7095, 33, 2, 'MALDONADO', 'RINCON DEL INDIO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7096, 33, 2, 'MALDONADO', 'RINCON DE LOS SOSA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7097, 33, 2, 'MALDONADO', 'RUTA 37 Y 9', '20300', NULL, NULL);
INSERT INTO `localidades` VALUES(7098, 33, 2, 'MALDONADO', 'SALAMANCA', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(7099, 33, 2, 'MALDONADO', 'SAN CARLOS', '20400', NULL, NULL);
INSERT INTO `localidades` VALUES(7100, 33, 2, 'MALDONADO', 'SAN FRANCISCO', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7101, 33, 2, 'MALDONADO', 'SAN JUAN DEL ESTE', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7102, 33, 2, 'MALDONADO', 'SAN RAFAEL - EL PLACER', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7103, 33, 2, 'MALDONADO', 'SANTA MONICA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7104, 33, 2, 'MALDONADO', 'SAN VICENTE', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7105, 33, 2, 'MALDONADO', 'SARANDI DE AIGUA', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(7106, 33, 2, 'MALDONADO', 'SARANDI DEL MATAOJO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7107, 33, 2, 'MALDONADO', 'SAUCE DE AIGUA', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(7108, 33, 2, 'MALDONADO', 'SAUCE DE PORTEZUELO', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7109, 33, 2, 'MALDONADO', 'SOLIS', '20200', NULL, NULL);
INSERT INTO `localidades` VALUES(7110, 33, 2, 'MALDONADO', 'VALDIVIA', '20500', NULL, NULL);
INSERT INTO `localidades` VALUES(7111, 33, 2, 'MALDONADO', 'VILLA DELIA', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7112, 33, 2, 'MALDONADO', 'ZANJA DEL TIGRE', '20000', NULL, NULL);
INSERT INTO `localidades` VALUES(7113, 34, 2, 'MONTEVIDEO', 'ABAYUBA', '12400', NULL, NULL);
INSERT INTO `localidades` VALUES(7114, 34, 2, 'MONTEVIDEO', 'AGUADA', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7115, 34, 2, 'MONTEVIDEO', 'AIRES PUROS', '11700', NULL, NULL);
INSERT INTO `localidades` VALUES(7116, 34, 2, 'MONTEVIDEO', 'AIRES PUROS', '12300', NULL, NULL);
INSERT INTO `localidades` VALUES(7117, 34, 2, 'MONTEVIDEO', 'ATAHUALPA', '11700', NULL, NULL);
INSERT INTO `localidades` VALUES(7118, 34, 2, 'MONTEVIDEO', 'ATAHUALPA', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7119, 34, 2, 'MONTEVIDEO', 'BAÑADOS DE CARRASCO', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7120, 34, 2, 'MONTEVIDEO', 'BARRIO SUR', '11100', NULL, NULL);
INSERT INTO `localidades` VALUES(7121, 34, 2, 'MONTEVIDEO', 'BARRIO SUR', '11200', NULL, NULL);
INSERT INTO `localidades` VALUES(7122, 34, 2, 'MONTEVIDEO', 'BELVEDERE', '11900', NULL, NULL);
INSERT INTO `localidades` VALUES(7123, 34, 2, 'MONTEVIDEO', 'BELVEDERE', '12900', NULL, NULL);
INSERT INTO `localidades` VALUES(7124, 34, 2, 'MONTEVIDEO', 'BRAZO ORIENTAL', '11700', NULL, NULL);
INSERT INTO `localidades` VALUES(7125, 34, 2, 'MONTEVIDEO', 'BUCEO', '11300', NULL, NULL);
INSERT INTO `localidades` VALUES(7126, 34, 2, 'MONTEVIDEO', 'BUCEO', '11400', NULL, NULL);
INSERT INTO `localidades` VALUES(7127, 34, 2, 'MONTEVIDEO', 'BUCEO', '11600', NULL, NULL);
INSERT INTO `localidades` VALUES(7128, 34, 2, 'MONTEVIDEO', 'CAPURRO, BELLA VISTA', '11700', NULL, NULL);
INSERT INTO `localidades` VALUES(7129, 34, 2, 'MONTEVIDEO', 'CAPURRO, BELLA VISTA', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7130, 34, 2, 'MONTEVIDEO', 'CARRASCO', '11500', NULL, NULL);
INSERT INTO `localidades` VALUES(7131, 34, 2, 'MONTEVIDEO', 'CARRASCO NORTE', '11500', NULL, NULL);
INSERT INTO `localidades` VALUES(7132, 34, 2, 'MONTEVIDEO', 'CASABO, PAJAS BLANCAS', '12800', NULL, NULL);
INSERT INTO `localidades` VALUES(7133, 34, 2, 'MONTEVIDEO', 'CASAVALLE', '12300', NULL, NULL);
INSERT INTO `localidades` VALUES(7134, 34, 2, 'MONTEVIDEO', 'CASTRO, P. CASTELLANOS', '12000', NULL, NULL);
INSERT INTO `localidades` VALUES(7135, 34, 2, 'MONTEVIDEO', 'CENTRO', '11100', NULL, NULL);
INSERT INTO `localidades` VALUES(7136, 34, 2, 'MONTEVIDEO', 'CENTRO', '11200', NULL, NULL);
INSERT INTO `localidades` VALUES(7137, 34, 2, 'MONTEVIDEO', 'CERRITO', '12300', NULL, NULL);
INSERT INTO `localidades` VALUES(7138, 34, 2, 'MONTEVIDEO', 'CERRO', '12800', NULL, NULL);
INSERT INTO `localidades` VALUES(7139, 34, 2, 'MONTEVIDEO', 'CIUDAD VIEJA', '11000', NULL, NULL);
INSERT INTO `localidades` VALUES(7140, 34, 2, 'MONTEVIDEO', 'CIUDAD VIEJA', '11100', NULL, NULL);
INSERT INTO `localidades` VALUES(7141, 34, 2, 'MONTEVIDEO', 'CIUDAD VIEJA', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7142, 34, 2, 'MONTEVIDEO', 'COLON CENTRO Y NOROESTE', '12400', NULL, NULL);
INSERT INTO `localidades` VALUES(7143, 34, 2, 'MONTEVIDEO', 'COLON CENTRO Y NOROESTE', '12500', NULL, NULL);
INSERT INTO `localidades` VALUES(7144, 34, 2, 'MONTEVIDEO', 'COLON CENTRO Y NOROESTE', '12900', NULL, NULL);
INSERT INTO `localidades` VALUES(7145, 34, 2, 'MONTEVIDEO', 'COLON SURESTE, ABAYUBA', '12400', NULL, NULL);
INSERT INTO `localidades` VALUES(7146, 34, 2, 'MONTEVIDEO', 'CONCILIACION', '12600', NULL, NULL);
INSERT INTO `localidades` VALUES(7147, 34, 2, 'MONTEVIDEO', 'CONCILIACION', '12900', NULL, NULL);
INSERT INTO `localidades` VALUES(7148, 34, 2, 'MONTEVIDEO', 'CORDON', '11200', NULL, NULL);
INSERT INTO `localidades` VALUES(7149, 34, 2, 'MONTEVIDEO', 'CORDON', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7150, 34, 2, 'MONTEVIDEO', 'FLOR DE MAROÑAS', '12000', NULL, NULL);
INSERT INTO `localidades` VALUES(7151, 34, 2, 'MONTEVIDEO', 'FLOR DE MAROÑAS', '12100', NULL, NULL);
INSERT INTO `localidades` VALUES(7152, 34, 2, 'MONTEVIDEO', 'FLOR DE MAROÑAS', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7153, 34, 2, 'MONTEVIDEO', 'ITUZAINGO', '12000', NULL, NULL);
INSERT INTO `localidades` VALUES(7154, 34, 2, 'MONTEVIDEO', 'JACINTO VERA', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7155, 34, 2, 'MONTEVIDEO', 'JARDINES DEL HIPODROMO', '12000', NULL, NULL);
INSERT INTO `localidades` VALUES(7156, 34, 2, 'MONTEVIDEO', 'JARDINES DEL HIPODROMO', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7157, 34, 2, 'MONTEVIDEO', 'LA BLANQUEADA', '11600', NULL, NULL);
INSERT INTO `localidades` VALUES(7158, 34, 2, 'MONTEVIDEO', 'LA COMERCIAL', '11600', NULL, NULL);
INSERT INTO `localidades` VALUES(7159, 34, 2, 'MONTEVIDEO', 'LA COMERCIAL', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7160, 34, 2, 'MONTEVIDEO', 'LA FIGURITA', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7161, 34, 2, 'MONTEVIDEO', 'LA PALOMA, TOMKINSON', '12600', NULL, NULL);
INSERT INTO `localidades` VALUES(7162, 34, 2, 'MONTEVIDEO', 'LA PALOMA, TOMKINSON', '12800', NULL, NULL);
INSERT INTO `localidades` VALUES(7163, 34, 2, 'MONTEVIDEO', 'LARRAÑAGA', '11600', NULL, NULL);
INSERT INTO `localidades` VALUES(7164, 34, 2, 'MONTEVIDEO', 'LAS ACACIAS', '12300', NULL, NULL);
INSERT INTO `localidades` VALUES(7165, 34, 2, 'MONTEVIDEO', 'LAS CANTERAS', '11400', NULL, NULL);
INSERT INTO `localidades` VALUES(7166, 34, 2, 'MONTEVIDEO', 'LAS CANTERAS', '12100', NULL, NULL);
INSERT INTO `localidades` VALUES(7167, 34, 2, 'MONTEVIDEO', 'LAS CANTERAS', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7168, 34, 2, 'MONTEVIDEO', 'LA TEJA', '11900', NULL, NULL);
INSERT INTO `localidades` VALUES(7169, 34, 2, 'MONTEVIDEO', 'LA TEJA', '12800', NULL, NULL);
INSERT INTO `localidades` VALUES(7170, 34, 2, 'MONTEVIDEO', 'LEZICA, MELILLA', '12500', NULL, NULL);
INSERT INTO `localidades` VALUES(7171, 34, 2, 'MONTEVIDEO', 'LEZICA, MELILLA', '12600', NULL, NULL);
INSERT INTO `localidades` VALUES(7172, 34, 2, 'MONTEVIDEO', 'MALVIN', '11400', NULL, NULL);
INSERT INTO `localidades` VALUES(7173, 34, 2, 'MONTEVIDEO', 'MALVIN NORTE', '11400', NULL, NULL);
INSERT INTO `localidades` VALUES(7174, 34, 2, 'MONTEVIDEO', 'MANGA', '12300', NULL, NULL);
INSERT INTO `localidades` VALUES(7175, 34, 2, 'MONTEVIDEO', 'MANGA', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7176, 34, 2, 'MONTEVIDEO', 'MANGA, TOLEDO CHICO', '12300', NULL, NULL);
INSERT INTO `localidades` VALUES(7177, 34, 2, 'MONTEVIDEO', 'MANGA, TOLEDO CHICO', '12400', NULL, NULL);
INSERT INTO `localidades` VALUES(7178, 34, 2, 'MONTEVIDEO', 'MANGA, TOLEDO CHICO', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7179, 34, 2, 'MONTEVIDEO', 'MAROÑAS, PARQUE GUARANI', '12100', NULL, NULL);
INSERT INTO `localidades` VALUES(7180, 34, 2, 'MONTEVIDEO', 'MELILLA', '12500', NULL, NULL);
INSERT INTO `localidades` VALUES(7181, 34, 2, 'MONTEVIDEO', 'MELILLA', '12600', NULL, NULL);
INSERT INTO `localidades` VALUES(7182, 34, 2, 'MONTEVIDEO', 'MERCADO MODELO, BOLIVAR', '11600', NULL, NULL);
INSERT INTO `localidades` VALUES(7183, 34, 2, 'MONTEVIDEO', 'MERCADO MODELO, BOLIVAR', '11700', NULL, NULL);
INSERT INTO `localidades` VALUES(7184, 34, 2, 'MONTEVIDEO', 'MERCADO MODELO, BOLIVAR', '12000', NULL, NULL);
INSERT INTO `localidades` VALUES(7185, 34, 2, 'MONTEVIDEO', 'NUEVO PARIS', '11900', NULL, NULL);
INSERT INTO `localidades` VALUES(7186, 34, 2, 'MONTEVIDEO', 'NUEVO PARIS', '12600', NULL, NULL);
INSERT INTO `localidades` VALUES(7187, 34, 2, 'MONTEVIDEO', 'NUEVO PARIS', '12900', NULL, NULL);
INSERT INTO `localidades` VALUES(7188, 34, 2, 'MONTEVIDEO', 'PAJAS BLANCAS', '12800', NULL, NULL);
INSERT INTO `localidades` VALUES(7189, 34, 2, 'MONTEVIDEO', 'PALERMO', '11200', NULL, NULL);
INSERT INTO `localidades` VALUES(7190, 34, 2, 'MONTEVIDEO', 'PARQUE RODO', '11200', NULL, NULL);
INSERT INTO `localidades` VALUES(7191, 34, 2, 'MONTEVIDEO', 'PARQUE RODO', '11300', NULL, NULL);
INSERT INTO `localidades` VALUES(7192, 34, 2, 'MONTEVIDEO', 'PASO DE LA ARENA', '12600', NULL, NULL);
INSERT INTO `localidades` VALUES(7193, 34, 2, 'MONTEVIDEO', 'PASO DE LA ARENA', '12800', NULL, NULL);
INSERT INTO `localidades` VALUES(7194, 34, 2, 'MONTEVIDEO', 'PASO DE LAS DURANAS', '12900', NULL, NULL);
INSERT INTO `localidades` VALUES(7195, 34, 2, 'MONTEVIDEO', 'PEÑAROL, LAVALLEJA', '12400', NULL, NULL);
INSERT INTO `localidades` VALUES(7196, 34, 2, 'MONTEVIDEO', 'PEÑAROL, LAVALLEJA', '12900', NULL, NULL);
INSERT INTO `localidades` VALUES(7197, 34, 2, 'MONTEVIDEO', 'PIEDRAS BLANCAS', '12300', NULL, NULL);
INSERT INTO `localidades` VALUES(7198, 34, 2, 'MONTEVIDEO', 'PIEDRAS BLANCAS', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7199, 34, 2, 'MONTEVIDEO', 'POCITOS', '11300', NULL, NULL);
INSERT INTO `localidades` VALUES(7200, 34, 2, 'MONTEVIDEO', 'PQUE. BATLLE, V. DOLORES', '11600', NULL, NULL);
INSERT INTO `localidades` VALUES(7201, 34, 2, 'MONTEVIDEO', 'PRADO, NUEVA SAVONA', '11700', NULL, NULL);
INSERT INTO `localidades` VALUES(7202, 34, 2, 'MONTEVIDEO', 'PRADO, NUEVA SAVONA', '11900', NULL, NULL);
INSERT INTO `localidades` VALUES(7203, 34, 2, 'MONTEVIDEO', 'PTA. RIELES, BELLA ITALIA', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7204, 34, 2, 'MONTEVIDEO', 'PUNTA CARRETAS', '11200', NULL, NULL);
INSERT INTO `localidades` VALUES(7205, 34, 2, 'MONTEVIDEO', 'PUNTA CARRETAS', '11300', NULL, NULL);
INSERT INTO `localidades` VALUES(7206, 34, 2, 'MONTEVIDEO', 'PUNTA GORDA', '11400', NULL, NULL);
INSERT INTO `localidades` VALUES(7207, 34, 2, 'MONTEVIDEO', 'REDUCTO', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7208, 34, 2, 'MONTEVIDEO', 'SANTA CATALINA', '12800', NULL, NULL);
INSERT INTO `localidades` VALUES(7209, 34, 2, 'MONTEVIDEO', 'SANTIAGO VAZQUEZ', '12600', NULL, NULL);
INSERT INTO `localidades` VALUES(7210, 34, 2, 'MONTEVIDEO', 'SANTIAGO VAZQUEZ', '12800', NULL, NULL);
INSERT INTO `localidades` VALUES(7211, 34, 2, 'MONTEVIDEO', 'SAYAGO', '12900', NULL, NULL);
INSERT INTO `localidades` VALUES(7212, 34, 2, 'MONTEVIDEO', 'TOLEDO CHICO', '12400', NULL, NULL);
INSERT INTO `localidades` VALUES(7213, 34, 2, 'MONTEVIDEO', 'TOLEDO CHICO', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7214, 34, 2, 'MONTEVIDEO', 'TRES CRUCES', '11200', NULL, NULL);
INSERT INTO `localidades` VALUES(7215, 34, 2, 'MONTEVIDEO', 'TRES CRUCES', '11600', NULL, NULL);
INSERT INTO `localidades` VALUES(7216, 34, 2, 'MONTEVIDEO', 'TRES CRUCES', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7217, 34, 2, 'MONTEVIDEO', 'TRES OMBUES, VICTORIA', '11900', NULL, NULL);
INSERT INTO `localidades` VALUES(7218, 34, 2, 'MONTEVIDEO', 'TRES OMBUES, VICTORIA', '12800', NULL, NULL);
INSERT INTO `localidades` VALUES(7219, 34, 2, 'MONTEVIDEO', 'UNION', '11400', NULL, NULL);
INSERT INTO `localidades` VALUES(7220, 34, 2, 'MONTEVIDEO', 'UNION', '11600', NULL, NULL);
INSERT INTO `localidades` VALUES(7221, 34, 2, 'MONTEVIDEO', 'UNION', '12000', NULL, NULL);
INSERT INTO `localidades` VALUES(7222, 34, 2, 'MONTEVIDEO', 'UNION', '12100', NULL, NULL);
INSERT INTO `localidades` VALUES(7223, 34, 2, 'MONTEVIDEO', 'VILLA ESPAÑOLA', '12000', NULL, NULL);
INSERT INTO `localidades` VALUES(7224, 34, 2, 'MONTEVIDEO', 'VILLA GARCIA, MANGA RUR.', '13000', NULL, NULL);
INSERT INTO `localidades` VALUES(7225, 34, 2, 'MONTEVIDEO', 'VILLA MUÑOZ, RETIRO', '11800', NULL, NULL);
INSERT INTO `localidades` VALUES(7226, 35, 2, 'PAYSANDU', 'AL SUR DE ARROYO SACRA', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7227, 35, 2, 'PAYSANDU', 'ARAUJO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7228, 35, 2, 'PAYSANDU', 'ARBOLITO (TOTORAL)', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7229, 35, 2, 'PAYSANDU', 'ARROYO MALO', '60200', NULL, NULL);
INSERT INTO `localidades` VALUES(7230, 35, 2, 'PAYSANDU', 'ARROYO NEGRO', '60300', NULL, NULL);
INSERT INTO `localidades` VALUES(7231, 35, 2, 'PAYSANDU', 'BEISSO', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7232, 35, 2, 'PAYSANDU', 'BELLA VISTA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7233, 35, 2, 'PAYSANDU', 'CANGUE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7234, 35, 2, 'PAYSANDU', 'CAÑADA DEL PUEBLO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7235, 35, 2, 'PAYSANDU', 'CARUMBE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7236, 35, 2, 'PAYSANDU', 'CASA BLANCA', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7237, 35, 2, 'PAYSANDU', 'CERRO CHATO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7238, 35, 2, 'PAYSANDU', 'CHACRAS DE PAYSANDU', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7239, 35, 2, 'PAYSANDU', 'CHACRAS DE PAYSANDU NORTE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7240, 35, 2, 'PAYSANDU', 'CHACRAS DE PAYSANDU SUR', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7241, 35, 2, 'PAYSANDU', 'CHAPICUY', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7242, 35, 2, 'PAYSANDU', 'COLONIA ARROYO MALO', '60200', NULL, NULL);
INSERT INTO `localidades` VALUES(7243, 35, 2, 'PAYSANDU', 'COLONIA CANGUE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7244, 35, 2, 'PAYSANDU', 'COLONIA JUNCAL', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7245, 35, 2, 'PAYSANDU', 'COLONIA LAS DELICIAS', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7246, 35, 2, 'PAYSANDU', 'COLONIA PAYSANDU', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7247, 35, 2, 'PAYSANDU', 'COLONIA SANTA BLANCA', '60200', NULL, NULL);
INSERT INTO `localidades` VALUES(7248, 35, 2, 'PAYSANDU', 'COLONIA URUGUAYA', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7249, 35, 2, 'PAYSANDU', 'CONSTANCIA', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7250, 35, 2, 'PAYSANDU', 'COSTA DE SACRA', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7251, 35, 2, 'PAYSANDU', 'CUCHILLA DE BURICAYUPI', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7252, 35, 2, 'PAYSANDU', 'CUCHILLA DE FUEGO', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7253, 35, 2, 'PAYSANDU', 'CUCHILLA SAN JOSE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7254, 35, 2, 'PAYSANDU', 'EL CHACO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7255, 35, 2, 'PAYSANDU', 'EL DURAZNAL', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7256, 35, 2, 'PAYSANDU', 'EL EUCALIPTUS', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7257, 35, 2, 'PAYSANDU', 'EL HORNO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7258, 35, 2, 'PAYSANDU', 'EL TARUGO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7259, 35, 2, 'PAYSANDU', 'ESTACION PORVENIR', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7260, 35, 2, 'PAYSANDU', 'ETCHEMENDI', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7261, 35, 2, 'PAYSANDU', 'GALLINAL', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7262, 35, 2, 'PAYSANDU', 'GUAVIYU DE QUEBRACHO', '60200', NULL, NULL);
INSERT INTO `localidades` VALUES(7263, 35, 2, 'PAYSANDU', 'GUAYABOS', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7264, 35, 2, 'PAYSANDU', 'GUICHON', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7265, 35, 2, 'PAYSANDU', 'LA LATA RUTA 3 (KM. 375)', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7266, 35, 2, 'PAYSANDU', 'LA PAZ (RUTA 3 KM. 346)', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7267, 35, 2, 'PAYSANDU', 'LAS FLORES', '60300', NULL, NULL);
INSERT INTO `localidades` VALUES(7268, 35, 2, 'PAYSANDU', 'LAS PALMAS', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7269, 35, 2, 'PAYSANDU', 'LA TENTACION', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7270, 35, 2, 'PAYSANDU', 'LORENZO GEYRES', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7271, 35, 2, 'PAYSANDU', 'MERINOS', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7272, 35, 2, 'PAYSANDU', 'MOLLES GRANDE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7273, 35, 2, 'PAYSANDU', 'MORATO (TRES ARBOLES)', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7274, 35, 2, 'PAYSANDU', 'NUEVO PAYSANDU', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7275, 35, 2, 'PAYSANDU', 'ORGOROSO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7276, 35, 2, 'PAYSANDU', 'PALMAR DEL QUEBRACHO', '60200', NULL, NULL);
INSERT INTO `localidades` VALUES(7277, 35, 2, 'PAYSANDU', 'PARADA DAYMAN', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7278, 35, 2, 'PAYSANDU', 'PARADA PANDULE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7279, 35, 2, 'PAYSANDU', 'PARADA RIVAS', '60200', NULL, NULL);
INSERT INTO `localidades` VALUES(7280, 35, 2, 'PAYSANDU', 'PASO DE LOS CARROS', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7281, 35, 2, 'PAYSANDU', 'PAYSANDU', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7282, 35, 2, 'PAYSANDU', 'PERICO MORENO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7283, 35, 2, 'PAYSANDU', 'PIEDRAS COLORADAS', '60300', NULL, NULL);
INSERT INTO `localidades` VALUES(7284, 35, 2, 'PAYSANDU', 'PIEDRA SOLA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7285, 35, 2, 'PAYSANDU', 'PIÑERA', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7286, 35, 2, 'PAYSANDU', 'PORVENIR', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7287, 35, 2, 'PAYSANDU', 'PUEBLO ALONZO', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7288, 35, 2, 'PAYSANDU', 'PUEBLO ESPERANZA', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7289, 35, 2, 'PAYSANDU', 'PUEBLO FEDERACION', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7290, 35, 2, 'PAYSANDU', 'PUNTAS DE ARROYO NEGRO', '60300', NULL, NULL);
INSERT INTO `localidades` VALUES(7291, 35, 2, 'PAYSANDU', 'PUNTAS DE BACACUA', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7292, 35, 2, 'PAYSANDU', 'PUNTAS DE BURICAYUPI', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7293, 35, 2, 'PAYSANDU', 'PUNTAS DE CANGUE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7294, 35, 2, 'PAYSANDU', 'PUNTAS DE GUALEGUAY', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7295, 35, 2, 'PAYSANDU', 'PUNTAS DE LAS ISLETAS', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7296, 35, 2, 'PAYSANDU', 'QUEBRACHO', '60200', NULL, NULL);
INSERT INTO `localidades` VALUES(7297, 35, 2, 'PAYSANDU', 'QUEGUAYAR', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7298, 35, 2, 'PAYSANDU', 'QUEGUAY GRANDE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7299, 35, 2, 'PAYSANDU', 'RABON', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7300, 35, 2, 'PAYSANDU', 'SAN FELIX', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7301, 35, 2, 'PAYSANDU', 'SAN FRANCISCO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7302, 35, 2, 'PAYSANDU', 'SAN MAURICIO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7303, 35, 2, 'PAYSANDU', 'SAN MIGUEL', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7304, 35, 2, 'PAYSANDU', 'SANTA KILDA', '60200', NULL, NULL);
INSERT INTO `localidades` VALUES(7305, 35, 2, 'PAYSANDU', 'SAUCE DE ABAJO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7306, 35, 2, 'PAYSANDU', 'SAUCE DEL BURICAYUPI', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7307, 35, 2, 'PAYSANDU', 'SAUCE DEL QUEGUAY', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7308, 35, 2, 'PAYSANDU', 'SOTO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7309, 35, 2, 'PAYSANDU', 'TAMBORES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7310, 35, 2, 'PAYSANDU', 'TERMAS DE ALMIRON', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7311, 35, 2, 'PAYSANDU', 'TERMAS DE GUAVIYU', '60200', NULL, NULL);
INSERT INTO `localidades` VALUES(7312, 35, 2, 'PAYSANDU', 'TOMAS PAZ', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7313, 35, 2, 'PAYSANDU', 'TRES BOCAS', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7314, 35, 2, 'PAYSANDU', 'VALDEZ', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7315, 35, 2, 'PAYSANDU', 'VILLA MARIA (TIATUCURA)', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7316, 35, 2, 'PAYSANDU', 'ZEBALLOS', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7317, 36, 2, 'RIO NEGRO', 'ALGORTA', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7318, 36, 2, 'RIO NEGRO', 'ARROYO NEGRO', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7319, 36, 2, 'RIO NEGRO', 'BARRIO ANGLO', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7320, 36, 2, 'RIO NEGRO', 'BELLACO', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7321, 36, 2, 'RIO NEGRO', 'CAÑITAS', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7322, 36, 2, 'RIO NEGRO', 'CARACOLES', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7323, 36, 2, 'RIO NEGRO', 'COLONIA EL OMBU', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7324, 36, 2, 'RIO NEGRO', 'COLONIA JOHN F. KENNEDY', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7325, 36, 2, 'RIO NEGRO', 'DON ESTEBAN', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7326, 36, 2, 'RIO NEGRO', 'EL ABROJAL', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7327, 36, 2, 'RIO NEGRO', 'EL PROGRESO', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7328, 36, 2, 'RIO NEGRO', 'EL SURCO', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7329, 36, 2, 'RIO NEGRO', 'ESTACION FRANCIA', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7330, 36, 2, 'RIO NEGRO', 'ESTANCIA VICHADERO', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7331, 36, 2, 'RIO NEGRO', 'FRAY BENTOS', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7332, 36, 2, 'RIO NEGRO', 'ISLA DE ARGUELLES', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7333, 36, 2, 'RIO NEGRO', 'LA ARENA', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(7334, 36, 2, 'RIO NEGRO', 'LA CORONILLA', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7335, 36, 2, 'RIO NEGRO', 'LA FLORIDA', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7336, 36, 2, 'RIO NEGRO', 'LA PALMA', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7337, 36, 2, 'RIO NEGRO', 'LAS CAÑAS', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7338, 36, 2, 'RIO NEGRO', 'LAS FLORES', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7339, 36, 2, 'RIO NEGRO', 'LAS FRACCIONES', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7340, 36, 2, 'RIO NEGRO', 'LAS MARGARITAS', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7341, 36, 2, 'RIO NEGRO', 'LA UNION', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7342, 36, 2, 'RIO NEGRO', 'LOS ARRAYANES', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7343, 36, 2, 'RIO NEGRO', 'LOS MELLIZOS', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7344, 36, 2, 'RIO NEGRO', 'LOS RANCHOS', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7345, 36, 2, 'RIO NEGRO', 'MATAOJO', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7346, 36, 2, 'RIO NEGRO', 'MENAFRA', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7347, 36, 2, 'RIO NEGRO', 'MERINOS', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7348, 36, 2, 'RIO NEGRO', 'MOLLES DE PORRUA', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7349, 36, 2, 'RIO NEGRO', 'NUEVO BERLIN', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7350, 36, 2, 'RIO NEGRO', 'OMBUCITOS', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7351, 36, 2, 'RIO NEGRO', 'PALMAR GRANDE', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7352, 36, 2, 'RIO NEGRO', 'PASO DE BALBUENA', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7353, 36, 2, 'RIO NEGRO', 'PASO DE LEOPOLDO', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7354, 36, 2, 'RIO NEGRO', 'PASO DE LOS COBRES', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7355, 36, 2, 'RIO NEGRO', 'PASO DE SOCA', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7356, 36, 2, 'RIO NEGRO', 'PASO RAMIREZ', '97000', NULL, NULL);
INSERT INTO `localidades` VALUES(7357, 36, 2, 'RIO NEGRO', 'PAURU', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7358, 36, 2, 'RIO NEGRO', 'PORTON HAEDO', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7359, 36, 2, 'RIO NEGRO', 'PTE. SAN MARTIN', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7360, 36, 2, 'RIO NEGRO', 'PUEBLO GRECCO', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7361, 36, 2, 'RIO NEGRO', 'PUNTAS DE AVERIAS', '60100', NULL, NULL);
INSERT INTO `localidades` VALUES(7362, 36, 2, 'RIO NEGRO', 'ROLON', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7363, 36, 2, 'RIO NEGRO', 'SANCHEZ', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7364, 36, 2, 'RIO NEGRO', 'SANCHEZ CHICO', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7365, 36, 2, 'RIO NEGRO', 'SAN JAVIER', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7366, 36, 2, 'RIO NEGRO', 'SAN LORENZO', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7367, 36, 2, 'RIO NEGRO', 'SANTA ELISA', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7368, 36, 2, 'RIO NEGRO', 'SANTA ISABEL', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7369, 36, 2, 'RIO NEGRO', 'SANTA ROSA', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7370, 36, 2, 'RIO NEGRO', 'SARANDI', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7371, 36, 2, 'RIO NEGRO', 'SARANDI DE NAVARRO', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7372, 36, 2, 'RIO NEGRO', 'SAUCE', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7373, 36, 2, 'RIO NEGRO', 'TRES BOCAS', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7374, 36, 2, 'RIO NEGRO', 'TRES QUINTAS', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7375, 36, 2, 'RIO NEGRO', 'ULESTE', '60000', NULL, NULL);
INSERT INTO `localidades` VALUES(7376, 36, 2, 'RIO NEGRO', 'VALLE DE SOBA', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7377, 36, 2, 'RIO NEGRO', 'VILLA GENERAL BORGES', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7378, 36, 2, 'RIO NEGRO', 'VILLA MARIA', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7379, 36, 2, 'RIO NEGRO', 'YAGUARETE', '65000', NULL, NULL);
INSERT INTO `localidades` VALUES(7380, 36, 2, 'RIO NEGRO', 'YOUNG', '65100', NULL, NULL);
INSERT INTO `localidades` VALUES(7381, 37, 2, 'RIVERA', 'ABROJAL', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7382, 37, 2, 'RIVERA', 'ALBORADA', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7383, 37, 2, 'RIVERA', 'AMARILLO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7384, 37, 2, 'RIVERA', 'ARROYO BLANCO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7385, 37, 2, 'RIVERA', 'ARROYO SAUZAL', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7386, 37, 2, 'RIVERA', 'ATAQUES', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7387, 37, 2, 'RIVERA', 'BAÑADO DEL CHAJA', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7388, 37, 2, 'RIVERA', 'BARRA DE ATAQUES', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7389, 37, 2, 'RIVERA', 'BARRIO RECREO', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7390, 37, 2, 'RIVERA', 'BATOVI', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7391, 37, 2, 'RIVERA', 'BERRUTI', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7392, 37, 2, 'RIVERA', 'BLANQUILLOS', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7393, 37, 2, 'RIVERA', 'BUENA ORDEN AL NORTE', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7394, 37, 2, 'RIVERA', 'BUENA UNION', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7395, 37, 2, 'RIVERA', 'CAPON ALTO', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7396, 37, 2, 'RIVERA', 'CARAGUATA', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7397, 37, 2, 'RIVERA', 'CARPINTERIA', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7398, 37, 2, 'RIVERA', 'CERRILLADA', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7399, 37, 2, 'RIVERA', 'CERRO ALEGRE', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7400, 37, 2, 'RIVERA', 'CERRO BLANCO DE CUÑAPIRU', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7401, 37, 2, 'RIVERA', 'CERRO CAQUEIRO', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7402, 37, 2, 'RIVERA', 'CERRO CHAPEU', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7403, 37, 2, 'RIVERA', 'CERRO CHATO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7404, 37, 2, 'RIVERA', 'CERRO PELADO', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7405, 37, 2, 'RIVERA', 'CERRO PELADO AL ESTE', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7406, 37, 2, 'RIVERA', 'CERROS BLANCOS', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7407, 37, 2, 'RIVERA', 'CERROS DE LA CALERA', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7408, 37, 2, 'RIVERA', 'CERRO SOLITO', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7409, 37, 2, 'RIVERA', 'CHIRCA DE CARAGUATA', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7410, 37, 2, 'RIVERA', 'CORONILLA', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7411, 37, 2, 'RIVERA', 'CORONILLA DE CORRALES', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7412, 37, 2, 'RIVERA', 'COSTAS DE CUÑAPIRU', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7413, 37, 2, 'RIVERA', 'CRUZ DE SAN PEDRO', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7414, 37, 2, 'RIVERA', 'CUCHILLA DE TRES CERROS', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7415, 37, 2, 'RIVERA', 'CUCHILLA DE YAGUARI', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7416, 37, 2, 'RIVERA', 'CUCHILLA MANGUERAS', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7417, 37, 2, 'RIVERA', 'CUÑAPIRU', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7418, 37, 2, 'RIVERA', 'CURTICEIRAS', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7419, 37, 2, 'RIVERA', 'CURTUME', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7420, 37, 2, 'RIVERA', 'EL CEIBO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7421, 37, 2, 'RIVERA', 'EL PALMITO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7422, 37, 2, 'RIVERA', 'GUAVIYU', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7423, 37, 2, 'RIVERA', 'HOSPITAL', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7424, 37, 2, 'RIVERA', 'LA CAILLAVA', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7425, 37, 2, 'RIVERA', 'LA CALERA', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7426, 37, 2, 'RIVERA', 'LA CERRILLADA', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7427, 37, 2, 'RIVERA', 'LA CHILCA', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7428, 37, 2, 'RIVERA', 'LAGOS DEL NORTE', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7429, 37, 2, 'RIVERA', 'LAGUNON', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7430, 37, 2, 'RIVERA', 'LA PALMA', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7431, 37, 2, 'RIVERA', 'LA PEDRERA', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7432, 37, 2, 'RIVERA', 'LAS FLORES', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7433, 37, 2, 'RIVERA', 'LAURELES', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7434, 37, 2, 'RIVERA', 'LOS POTREROS', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7435, 37, 2, 'RIVERA', 'LUNAREJO', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7436, 37, 2, 'RIVERA', 'MANDUBI', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7437, 37, 2, 'RIVERA', 'MANUEL DIAZ', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7438, 37, 2, 'RIVERA', 'MASOLLER', '40200', NULL, NULL);
INSERT INTO `localidades` VALUES(7439, 37, 2, 'RIVERA', 'MINAS DE CORRALES', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7440, 37, 2, 'RIVERA', 'MINAS DE CUÑAPIRU (USINAS)', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7441, 37, 2, 'RIVERA', 'MINAS DE ZAPUCAY', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7442, 37, 2, 'RIVERA', 'MOIRONES', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7443, 37, 2, 'RIVERA', 'PARADA MEDINA', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7444, 37, 2, 'RIVERA', 'PASO AMARILLO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7445, 37, 2, 'RIVERA', 'PASO ATAQUES', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7446, 37, 2, 'RIVERA', 'PASO CASILDO', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7447, 37, 2, 'RIVERA', 'PASO DE ARRIERA', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7448, 37, 2, 'RIVERA', 'PASO DE ATAQUES', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7449, 37, 2, 'RIVERA', 'PASO DE FRONTERA', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7450, 37, 2, 'RIVERA', 'PASO DE GAIRE', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7451, 37, 2, 'RIVERA', 'PASO DE LA ARENA', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7452, 37, 2, 'RIVERA', 'PASO DE LA CALERA', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7453, 37, 2, 'RIVERA', 'PASO DEL LAGUNON', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7454, 37, 2, 'RIVERA', 'PASO DEL PUERTO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7455, 37, 2, 'RIVERA', 'PASO DEL TAPADO', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7456, 37, 2, 'RIVERA', 'PASO LAPUENTE', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7457, 37, 2, 'RIVERA', 'PASO SERPA', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7458, 37, 2, 'RIVERA', 'PIEDRAS BLANCAS', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7459, 37, 2, 'RIVERA', 'PLATON', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7460, 37, 2, 'RIVERA', 'PUEBLO DE LOS SANTOS', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7461, 37, 2, 'RIVERA', 'PUEBLO SOCORRO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7462, 37, 2, 'RIVERA', 'PUNTAS DE ABROJAL', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7463, 37, 2, 'RIVERA', 'PUNTAS DE CORRALES', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7464, 37, 2, 'RIVERA', 'PUNTAS DE CUÑAPIRU', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7465, 37, 2, 'RIVERA', 'PUNTAS DEL SAUZAL', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7466, 37, 2, 'RIVERA', 'PUNTAS DEL YAGUARI', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7467, 37, 2, 'RIVERA', 'RINCON DE AMARILLO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7468, 37, 2, 'RIVERA', 'RINCON DE DINIZ', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7469, 37, 2, 'RIVERA', 'RINCON DE LOS CASTILLOS', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7470, 37, 2, 'RIVERA', 'RINCON DE MORAES', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7471, 37, 2, 'RIVERA', 'RINCON DE RODRIGUEZ', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7472, 37, 2, 'RIVERA', 'RINCON DE ROLAND', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7473, 37, 2, 'RIVERA', 'RINCON DE TRES CERROS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7474, 37, 2, 'RIVERA', 'RINCON DE YAGUARI', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7475, 37, 2, 'RIVERA', 'RIVERA', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7476, 37, 2, 'RIVERA', 'SAN GREGORIO', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7477, 37, 2, 'RIVERA', 'SANTA ERNESTINA', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7478, 37, 2, 'RIVERA', 'SANTA ISABEL', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7479, 37, 2, 'RIVERA', 'SANTA TERESA', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7480, 37, 2, 'RIVERA', 'SAUCE DE BATOVI', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7481, 37, 2, 'RIVERA', 'SAUZAL', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7482, 37, 2, 'RIVERA', 'SEGARRA', '41100', NULL, NULL);
INSERT INTO `localidades` VALUES(7483, 37, 2, 'RIVERA', 'TRANQUERAS', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7484, 37, 2, 'RIVERA', 'TRES CERROS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7485, 37, 2, 'RIVERA', 'TRES CRUCES', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7486, 37, 2, 'RIVERA', 'TRES PUENTES', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7487, 37, 2, 'RIVERA', 'VICHADERO', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7488, 37, 2, 'RIVERA', 'VILLA INDART', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7489, 37, 2, 'RIVERA', 'YAGUARI', '40000', NULL, NULL);
INSERT INTO `localidades` VALUES(7490, 37, 2, 'RIVERA', 'ZANJA HONDA', '41200', NULL, NULL);
INSERT INTO `localidades` VALUES(7491, 37, 2, 'RIVERA', 'ZANJA HONDA DE TRANQUERAS', '40100', NULL, NULL);
INSERT INTO `localidades` VALUES(7492, 38, 2, 'ROCHA', '18 DE JULIO', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7493, 38, 2, 'ROCHA', '19 DE ABRIL', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7494, 38, 2, 'ROCHA', 'ABRA DE ALFEREZ', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7495, 38, 2, 'ROCHA', 'AGUAS DULCES', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7496, 38, 2, 'ROCHA', 'ALFEREZ', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7497, 38, 2, 'ROCHA', 'ANTONIOPOLIS', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7498, 38, 2, 'ROCHA', 'ARACHANIA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7499, 38, 2, 'ROCHA', 'ARBOLITO', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7500, 38, 2, 'ROCHA', 'BALNEARIO PUEBLO NUEVO', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7501, 38, 2, 'ROCHA', 'BARRA DEL CHUY', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7502, 38, 2, 'ROCHA', 'BARRA DE VALIZAS', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7503, 38, 2, 'ROCHA', 'BARRA ISLA NEGRA', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7504, 38, 2, 'ROCHA', 'BARRANCAS DE LA CORONILLA', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7505, 38, 2, 'ROCHA', 'BARRANCAS DE LA PEDRERA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7506, 38, 2, 'ROCHA', 'BARRIO CARDOZO', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7507, 38, 2, 'ROCHA', 'BARRIO PEREIRA', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7508, 38, 2, 'ROCHA', 'BARRIO PORVENIR', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7509, 38, 2, 'ROCHA', 'BARRIO TORRES', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7510, 38, 2, 'ROCHA', 'CABO POLONIO', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7511, 38, 2, 'ROCHA', 'CAPACHO', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7512, 38, 2, 'ROCHA', 'CASTILLOS', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7513, 38, 2, 'ROCHA', 'CEBOLLATI', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7514, 38, 2, 'ROCHA', 'CERRO DE LOS ROCHA', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7515, 38, 2, 'ROCHA', 'CERRO DE PESCADORES', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7516, 38, 2, 'ROCHA', 'CHUY', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7517, 38, 2, 'ROCHA', 'COLONIA GREISSING', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7518, 38, 2, 'ROCHA', 'CORONILLA DEL MAR', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7519, 38, 2, 'ROCHA', 'COSTA AZUL', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7520, 38, 2, 'ROCHA', 'COSTAS DE CEBOLLATI', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7521, 38, 2, 'ROCHA', 'CUCHILLA DE GARZON', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7522, 38, 2, 'ROCHA', 'CUCHILLA DEL ARBOLITO', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7523, 38, 2, 'ROCHA', 'DIAMANTE DE LA PEDRERA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7524, 38, 2, 'ROCHA', 'EL CANELON', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7525, 38, 2, 'ROCHA', 'EL CHIMANGO', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7526, 38, 2, 'ROCHA', 'EMPALME DE VELAZQUEZ', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7527, 38, 2, 'ROCHA', 'FORTIN DE SAN MIGUEL', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7528, 38, 2, 'ROCHA', 'GARZON ABAJO', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7529, 38, 2, 'ROCHA', 'GARZON AL MEDIO', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7530, 38, 2, 'ROCHA', 'GARZON ARRIBA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7531, 38, 2, 'ROCHA', 'INDIA MUERTA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7532, 38, 2, 'ROCHA', 'ISLA NEGRA', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7533, 38, 2, 'ROCHA', 'KILOMETRO 18', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7534, 38, 2, 'ROCHA', 'LA AGUADA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7535, 38, 2, 'ROCHA', 'LA AGUADA Y COSTA AZUL', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7536, 38, 2, 'ROCHA', 'LA CENTINELA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7537, 38, 2, 'ROCHA', 'LA CORONILLA', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7538, 38, 2, 'ROCHA', 'LA CORONILLA FISHING CLUB', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7539, 38, 2, 'ROCHA', 'LA ESMERALDA', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7540, 38, 2, 'ROCHA', 'LA FORTALEZA DE SANTA TERESA', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7541, 38, 2, 'ROCHA', 'LA PEDRERA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7542, 38, 2, 'ROCHA', 'LA RIBIERA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7543, 38, 2, 'ROCHA', 'LASCANO', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7544, 38, 2, 'ROCHA', 'LA SIERRA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7545, 38, 2, 'ROCHA', 'LA TUNA', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7546, 38, 2, 'ROCHA', 'LOMAS', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7547, 38, 2, 'ROCHA', 'LOS AJOS', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7548, 38, 2, 'ROCHA', 'LOS CERRILLOS', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7549, 38, 2, 'ROCHA', 'LOS INDIOS', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7550, 38, 2, 'ROCHA', 'MAR DEL PLATA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7551, 38, 2, 'ROCHA', 'OCEANIA DEL POLONIO', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7552, 38, 2, 'ROCHA', 'ORATORIO', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7553, 38, 2, 'ROCHA', 'PALMAR', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7554, 38, 2, 'ROCHA', 'PALMAR DE CASTILLOS', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7555, 38, 2, 'ROCHA', 'PALMARES DE LA CORONILLA', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7556, 38, 2, 'ROCHA', 'PARALLE', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7557, 38, 2, 'ROCHA', 'PASO DEL BAÑADO', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7558, 38, 2, 'ROCHA', 'PASO DEL OMBU', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7559, 38, 2, 'ROCHA', 'PASO DE LOPEZ', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7560, 38, 2, 'ROCHA', 'PASO DOÑA ROSA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7561, 38, 2, 'ROCHA', 'PEDRERA NORTE', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7562, 38, 2, 'ROCHA', 'PICADA TOLOSA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7563, 38, 2, 'ROCHA', 'PLANO 291', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7564, 38, 2, 'ROCHA', 'PUEBLO NUEVO', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7565, 38, 2, 'ROCHA', 'PUENTE VALIZAS', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7566, 38, 2, 'ROCHA', 'PUERTO DE LOS BOTES', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7567, 38, 2, 'ROCHA', 'PUERTO LA PALOMA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7568, 38, 2, 'ROCHA', 'PUIMAYEN', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7569, 38, 2, 'ROCHA', 'PUNTA CEBOLLATI', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7570, 38, 2, 'ROCHA', 'PUNTA DEL DIABLO', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7571, 38, 2, 'ROCHA', 'PUNTA PALMAR', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7572, 38, 2, 'ROCHA', 'PUNTA RUBIA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7573, 38, 2, 'ROCHA', 'PUNTAS DE DON CARLOS', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7574, 38, 2, 'ROCHA', 'QUEBRACHO', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7575, 38, 2, 'ROCHA', 'RINCON DE LOS OLIVERA', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7576, 38, 2, 'ROCHA', 'RINCON DE VALIZAS', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7577, 38, 2, 'ROCHA', 'ROCHA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7578, 38, 2, 'ROCHA', 'SAMUEL', '27100', NULL, NULL);
INSERT INTO `localidades` VALUES(7579, 38, 2, 'ROCHA', 'SAN ANTONIO', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7580, 38, 2, 'ROCHA', 'SAN LUIS AL MEDIO', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7581, 38, 2, 'ROCHA', 'SAN SEBASTIAN', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7582, 38, 2, 'ROCHA', 'SAN SEBASTIAN DE LA PEDRERA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7583, 38, 2, 'ROCHA', 'SANTA ISABEL DE LA PEDRERA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7584, 38, 2, 'ROCHA', 'SANTA TERESA DE LA CORONILLA 1', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7585, 38, 2, 'ROCHA', 'SANTA TERESA DE LA CORONILLA 2', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7586, 38, 2, 'ROCHA', 'SARANDI DE LA INDIA MUERTA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7587, 38, 2, 'ROCHA', 'SAUCE DE ROCHA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7588, 38, 2, 'ROCHA', 'SIERRA DE LOS ROCHA', '27000', NULL, NULL);
INSERT INTO `localidades` VALUES(7589, 38, 2, 'ROCHA', 'TAJAMARES DE LA PEDRERA', '27400', NULL, NULL);
INSERT INTO `localidades` VALUES(7590, 38, 2, 'ROCHA', 'VELAZQUEZ', '27300', NULL, NULL);
INSERT INTO `localidades` VALUES(7591, 38, 2, 'ROCHA', 'VUELTA DEL PALMAR', '27200', NULL, NULL);
INSERT INTO `localidades` VALUES(7592, 39, 2, 'SALTO', 'ARENITAS BLANCAS', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7593, 39, 2, 'SALTO', 'BALNEARIO ALBISU', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7594, 39, 2, 'SALTO', 'BELEN', '50200', NULL, NULL);
INSERT INTO `localidades` VALUES(7595, 39, 2, 'SALTO', 'BIASSINI', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7596, 39, 2, 'SALTO', 'BORDENAVE', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7597, 39, 2, 'SALTO', 'CAMPO DE TODOS', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7598, 39, 2, 'SALTO', 'CARUMBE', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7599, 39, 2, 'SALTO', 'CELESTE', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7600, 39, 2, 'SALTO', 'CERRILLADA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7601, 39, 2, 'SALTO', 'CERRILLADAS DE SAUCEDO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7602, 39, 2, 'SALTO', 'CERRO CHATO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7603, 39, 2, 'SALTO', 'CERROS DE VERA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7604, 39, 2, 'SALTO', 'CHACRAS DE BELEN', '50200', NULL, NULL);
INSERT INTO `localidades` VALUES(7605, 39, 2, 'SALTO', 'CHACRAS DE CONSTITUCION', '50100', NULL, NULL);
INSERT INTO `localidades` VALUES(7606, 39, 2, 'SALTO', 'COLONIA 18 DE JULIO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7607, 39, 2, 'SALTO', 'COLONIA ITAPEBI', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7608, 39, 2, 'SALTO', 'COLONIA LAVALLEJA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7609, 39, 2, 'SALTO', 'COLONIA OSIMANI', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7610, 39, 2, 'SALTO', 'COLONIA RUBIO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7611, 39, 2, 'SALTO', 'CONSTITUCION', '50100', NULL, NULL);
INSERT INTO `localidades` VALUES(7612, 39, 2, 'SALTO', 'CORRAL DE PIEDRA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7613, 39, 2, 'SALTO', 'CORRALITO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7614, 39, 2, 'SALTO', 'CUCHILLA DE GUAVIYU', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7615, 39, 2, 'SALTO', 'CUCHILLA DEL SALTO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7616, 39, 2, 'SALTO', 'EL ESPINILLAR', '50100', NULL, NULL);
INSERT INTO `localidades` VALUES(7617, 39, 2, 'SALTO', 'EL MELLADO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7618, 39, 2, 'SALTO', 'FERREIRA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7619, 39, 2, 'SALTO', 'GARIBALDI', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7620, 39, 2, 'SALTO', 'GUAVIYU DE ARAPEY', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7621, 39, 2, 'SALTO', 'ITAPEBI', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7622, 39, 2, 'SALTO', 'LA BOLSA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7623, 39, 2, 'SALTO', 'LA BOLSA 02', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7624, 39, 2, 'SALTO', 'LA BOLSA 03', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7625, 39, 2, 'SALTO', 'LA CABALLADA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7626, 39, 2, 'SALTO', 'LAS FLORES', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7627, 39, 2, 'SALTO', 'LAURELES', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7628, 39, 2, 'SALTO', 'LA VITICOLA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7629, 39, 2, 'SALTO', 'LLUVERAS', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7630, 39, 2, 'SALTO', 'LOS ORIENTALES', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7631, 39, 2, 'SALTO', 'MATAOJITO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7632, 39, 2, 'SALTO', 'MATAOJO GRANDE', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7633, 39, 2, 'SALTO', 'NUEVA HESPERIDES', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7634, 39, 2, 'SALTO', 'OLIVERA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7635, 39, 2, 'SALTO', 'OSIMANI Y LLERENA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7636, 39, 2, 'SALTO', 'PALOMAS', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7637, 39, 2, 'SALTO', 'PARADA HERRERIA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7638, 39, 2, 'SALTO', 'PARQUE JOSE LUIS', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7639, 39, 2, 'SALTO', 'PASO CEMENTERIO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7640, 39, 2, 'SALTO', 'PASO DE LAS PIEDRAS DE ARERUNGUA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7641, 39, 2, 'SALTO', 'PASO DEL PARQUE DEL DAYMAN', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7642, 39, 2, 'SALTO', 'PASO DEL POTRERO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7643, 39, 2, 'SALTO', 'PASO DEL TAPADO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7644, 39, 2, 'SALTO', 'PASO FIALHO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7645, 39, 2, 'SALTO', 'PASO NUEVO DEL ARAPEY', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7646, 39, 2, 'SALTO', 'PASO  VALEGA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7647, 39, 2, 'SALTO', 'PEPE NUÑEZ', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7648, 39, 2, 'SALTO', 'PUEBLO CAYETANO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7649, 39, 2, 'SALTO', 'PUEBLO FARIAS', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7650, 39, 2, 'SALTO', 'PUEBLO FERNANDEZ', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7651, 39, 2, 'SALTO', 'PUEBLO QUINTANA', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7652, 39, 2, 'SALTO', 'PUEBLO RAMOS', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7653, 39, 2, 'SALTO', 'PUNTAS DE VALENTIN', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7654, 39, 2, 'SALTO', 'RINCON DE VALENTIN', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7655, 39, 2, 'SALTO', 'RUSSO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7656, 39, 2, 'SALTO', 'SALTO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7657, 39, 2, 'SALTO', 'SAN ANTONIO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7658, 39, 2, 'SALTO', 'SARANDI DE ARAPEY', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7659, 39, 2, 'SALTO', 'SAUCE CHICO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7660, 39, 2, 'SALTO', 'SAUCEDO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7661, 39, 2, 'SALTO', 'SOPAS', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7662, 39, 2, 'SALTO', 'TALAS DE ITAPEBI', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7663, 39, 2, 'SALTO', 'TERMAS DEL ARAPEY', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7664, 39, 2, 'SALTO', 'TERMAS DEL DAYMAN', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7665, 39, 2, 'SALTO', 'TORO NEGRO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7666, 39, 2, 'SALTO', 'TROPEZON', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7667, 39, 2, 'SALTO', 'TROPIEZO', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7668, 39, 2, 'SALTO', 'VALENTIN GRANDE', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7669, 39, 2, 'SALTO', 'YACUY', '50200', NULL, NULL);
INSERT INTO `localidades` VALUES(7670, 39, 2, 'SALTO', 'ZANJA DE ALCAIN', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7671, 39, 2, 'SALTO', 'ZANJA DEL TIGRE', '50000', NULL, NULL);
INSERT INTO `localidades` VALUES(7672, 40, 2, 'SAN JOSE', '18 DE JULIO', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(7673, 40, 2, 'SAN JOSE', 'ARROYO DE LA VIRGEN', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7674, 40, 2, 'SAN JOSE', 'ARROYO LLANO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7675, 40, 2, 'SAN JOSE', 'AUTODROMO', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7676, 40, 2, 'SAN JOSE', 'AUTODROMO NACIONAL', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7677, 40, 2, 'SAN JOSE', 'BAÑADO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7678, 40, 2, 'SAN JOSE', 'BELLA VISTA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7679, 40, 2, 'SAN JOSE', 'BOCA DEL CUFRE', '80300', NULL, NULL);
INSERT INTO `localidades` VALUES(7680, 40, 2, 'SAN JOSE', 'CAGANCHA', '80400', NULL, NULL);
INSERT INTO `localidades` VALUES(7681, 40, 2, 'SAN JOSE', 'CAGANCHA CHICO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7682, 40, 2, 'SAN JOSE', 'CAÑADA GRANDE', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7683, 40, 2, 'SAN JOSE', 'CAPURRO', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(7684, 40, 2, 'SAN JOSE', 'CARRETA QUEMADA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7685, 40, 2, 'SAN JOSE', 'CERAMICAS DEL SUR', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7686, 40, 2, 'SAN JOSE', 'CHAMIZO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7687, 40, 2, 'SAN JOSE', 'CIUDAD DEL PLATA', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7688, 40, 2, 'SAN JOSE', 'COLOLO TINOSA', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7689, 40, 2, 'SAN JOSE', 'COLONIA AMERICA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7690, 40, 2, 'SAN JOSE', 'COLONIA DELTA', '80300', NULL, NULL);
INSERT INTO `localidades` VALUES(7691, 40, 2, 'SAN JOSE', 'COLONIA DR. BERNARDO ETCHEPARE', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(7692, 40, 2, 'SAN JOSE', 'COLONIA FERNANDEZ CRESPO', '80200', NULL, NULL);
INSERT INTO `localidades` VALUES(7693, 40, 2, 'SAN JOSE', 'COLONIA ITALIA', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7694, 40, 2, 'SAN JOSE', 'COLONIA JUAN MARIA PEREZ', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7695, 40, 2, 'SAN JOSE', 'COLONIA SAN JOAQUIN', '80200', NULL, NULL);
INSERT INTO `localidades` VALUES(7696, 40, 2, 'SAN JOSE', 'COLONIA WILSON', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7697, 40, 2, 'SAN JOSE', 'CORONILLA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7698, 40, 2, 'SAN JOSE', 'COSTA DEL MAURICIO', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7699, 40, 2, 'SAN JOSE', 'COSTAS DEL SAUCE', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7700, 40, 2, 'SAN JOSE', 'COSTAS DE PEREIRA', '80200', NULL, NULL);
INSERT INTO `localidades` VALUES(7701, 40, 2, 'SAN JOSE', 'CRUZ DE LOS CAMINOS', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7702, 40, 2, 'SAN JOSE', 'CUCHILLA DEL VICHADERO', '80400', NULL, NULL);
INSERT INTO `localidades` VALUES(7703, 40, 2, 'SAN JOSE', 'CUCHILLA DE PEREIRA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7704, 40, 2, 'SAN JOSE', 'CUCHILLA SECA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7705, 40, 2, 'SAN JOSE', 'DELTA EL TIGRE', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7706, 40, 2, 'SAN JOSE', 'ECILDA PAULLIER', '80300', NULL, NULL);
INSERT INTO `localidades` VALUES(7707, 40, 2, 'SAN JOSE', 'ESCUDERO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7708, 40, 2, 'SAN JOSE', 'ESTACION RODRIGUEZ', '80400', NULL, NULL);
INSERT INTO `localidades` VALUES(7709, 40, 2, 'SAN JOSE', 'FAJARDO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7710, 40, 2, 'SAN JOSE', 'FAJINA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7711, 40, 2, 'SAN JOSE', 'GONZALEZ', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7712, 40, 2, 'SAN JOSE', 'GUAYCURU', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(7713, 40, 2, 'SAN JOSE', 'ITUZAINGO', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(7714, 40, 2, 'SAN JOSE', 'JESUS MARIA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7715, 40, 2, 'SAN JOSE', 'JUAN SOLER', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7716, 40, 2, 'SAN JOSE', 'JUNCAL', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7717, 40, 2, 'SAN JOSE', 'KIYU - ORDEIG', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7718, 40, 2, 'SAN JOSE', 'LA BOYADA', '80300', NULL, NULL);
INSERT INTO `localidades` VALUES(7719, 40, 2, 'SAN JOSE', 'LA CASILLA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7720, 40, 2, 'SAN JOSE', 'LA CUCHILLA', '80400', NULL, NULL);
INSERT INTO `localidades` VALUES(7721, 40, 2, 'SAN JOSE', 'LAUREL', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7722, 40, 2, 'SAN JOSE', 'LIBERTAD', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7723, 40, 2, 'SAN JOSE', 'MAHOMA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7724, 40, 2, 'SAN JOSE', 'MAL ABRIGO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7725, 40, 2, 'SAN JOSE', 'MANGRULLO', '80200', NULL, NULL);
INSERT INTO `localidades` VALUES(7726, 40, 2, 'SAN JOSE', 'MONTE GRANDE', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7727, 40, 2, 'SAN JOSE', 'MUNDO AZUL', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7728, 40, 2, 'SAN JOSE', 'MUNDO AZUL AGUIRRE', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7729, 40, 2, 'SAN JOSE', 'ORILLAS DEL PLATA', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7730, 40, 2, 'SAN JOSE', 'PACHINA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7731, 40, 2, 'SAN JOSE', 'PANTA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7732, 40, 2, 'SAN JOSE', 'PANTANOSO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7733, 40, 2, 'SAN JOSE', 'PARQUE POSTEL', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7734, 40, 2, 'SAN JOSE', 'PARQUE POSTEL CNEL. ADRIAN MEDINA', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7735, 40, 2, 'SAN JOSE', 'PASO BELASTIQUI', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(7736, 40, 2, 'SAN JOSE', 'PASO DE CAMES', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7737, 40, 2, 'SAN JOSE', 'PASO DE LAS PIEDRAS', '80200', NULL, NULL);
INSERT INTO `localidades` VALUES(7738, 40, 2, 'SAN JOSE', 'PASO DEL CARRETON', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7739, 40, 2, 'SAN JOSE', 'PASO DEL GUAYCURU', '85000', NULL, NULL);
INSERT INTO `localidades` VALUES(7740, 40, 2, 'SAN JOSE', 'PASO DEL REY', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7741, 40, 2, 'SAN JOSE', 'PASO DE MAS', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7742, 40, 2, 'SAN JOSE', 'PAVON', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7743, 40, 2, 'SAN JOSE', 'PENINO', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7744, 40, 2, 'SAN JOSE', 'PERICO PEREZ', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7745, 40, 2, 'SAN JOSE', 'PICADA GAMBETTA', '80300', NULL, NULL);
INSERT INTO `localidades` VALUES(7746, 40, 2, 'SAN JOSE', 'PLAYA PASCUAL', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7747, 40, 2, 'SAN JOSE', 'PUEBLO NUEVO', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(7748, 40, 2, 'SAN JOSE', 'PUNTAS DE CAGANCHA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7749, 40, 2, 'SAN JOSE', 'PUNTAS DE CAÑADA GRANDE', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7750, 40, 2, 'SAN JOSE', 'PUNTAS DE CHAMIZO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7751, 40, 2, 'SAN JOSE', 'PUNTAS DE GREGORIO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7752, 40, 2, 'SAN JOSE', 'PUNTAS DE LAUREL', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7753, 40, 2, 'SAN JOSE', 'PUNTAS DE TROPA VIEJA', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7754, 40, 2, 'SAN JOSE', 'PUNTAS DE VALDEZ', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7755, 40, 2, 'SAN JOSE', 'RADIAL RUTA 3', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7756, 40, 2, 'SAN JOSE', 'RAFAEL PERAZZA', '80200', NULL, NULL);
INSERT INTO `localidades` VALUES(7757, 40, 2, 'SAN JOSE', 'RAIGON', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7758, 40, 2, 'SAN JOSE', 'RINCON DE ALBANO', '90200', NULL, NULL);
INSERT INTO `localidades` VALUES(7759, 40, 2, 'SAN JOSE', 'RINCON DE ARAZATI', '80300', NULL, NULL);
INSERT INTO `localidades` VALUES(7760, 40, 2, 'SAN JOSE', 'RINCON DE ARIAS', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7761, 40, 2, 'SAN JOSE', 'RINCON DE BUSCHENTAL', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7762, 40, 2, 'SAN JOSE', 'RINCON DE CUFRE', '80300', NULL, NULL);
INSERT INTO `localidades` VALUES(7763, 40, 2, 'SAN JOSE', 'RINCON DE LA BOLSA', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7764, 40, 2, 'SAN JOSE', 'RINCON DE LA TORRE', '80400', NULL, NULL);
INSERT INTO `localidades` VALUES(7765, 40, 2, 'SAN JOSE', 'RINCON DEL PINO', '80200', NULL, NULL);
INSERT INTO `localidades` VALUES(7766, 40, 2, 'SAN JOSE', 'RINCON DE NAZARETH', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7767, 40, 2, 'SAN JOSE', 'ROCHO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7768, 40, 2, 'SAN JOSE', 'SAFICI', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7769, 40, 2, 'SAN JOSE', 'SAN FERNANDO', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7770, 40, 2, 'SAN JOSE', 'SAN FERNANDO CHICO', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7771, 40, 2, 'SAN JOSE', 'SAN GREGORIO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7772, 40, 2, 'SAN JOSE', 'SAN JOSE DE MAYO', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7773, 40, 2, 'SAN JOSE', 'SANTA MONICA', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7774, 40, 2, 'SAN JOSE', 'SAUCE', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7775, 40, 2, 'SAN JOSE', 'SAUCE CHICO', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7776, 40, 2, 'SAN JOSE', 'SCAVINO', '80300', NULL, NULL);
INSERT INTO `localidades` VALUES(7777, 40, 2, 'SAN JOSE', 'TABAREZ', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7778, 40, 2, 'SAN JOSE', 'TALA DE PEREIRA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7779, 40, 2, 'SAN JOSE', 'TRANQUERA COLORADA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7780, 40, 2, 'SAN JOSE', 'TROPAS VIEJAS', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7781, 40, 2, 'SAN JOSE', 'TROPEZON', '80400', NULL, NULL);
INSERT INTO `localidades` VALUES(7782, 40, 2, 'SAN JOSE', 'VALDEZ CHICO', '80100', NULL, NULL);
INSERT INTO `localidades` VALUES(7783, 40, 2, 'SAN JOSE', 'VILLA MARIA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7784, 40, 2, 'SAN JOSE', 'VILLA OLIMPICA', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7785, 40, 2, 'SAN JOSE', 'VILLA RIVES', '80500', NULL, NULL);
INSERT INTO `localidades` VALUES(7786, 40, 2, 'SAN JOSE', 'ZANJA HONDA', '80000', NULL, NULL);
INSERT INTO `localidades` VALUES(7787, 41, 2, 'SORIANO', 'AGRACIADA', '70700', NULL, NULL);
INSERT INTO `localidades` VALUES(7788, 41, 2, 'SORIANO', 'ALTOS DEL PERDIDO', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7789, 41, 2, 'SORIANO', 'ARENAL CHICO', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7790, 41, 2, 'SORIANO', 'ARROYO DEL MEDIO', '75300', NULL, NULL);
INSERT INTO `localidades` VALUES(7791, 41, 2, 'SORIANO', 'ARROYO GRANDE', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7792, 41, 2, 'SORIANO', 'ASENCIO', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7793, 41, 2, 'SORIANO', 'AZOTEA DE VERA', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7794, 41, 2, 'SORIANO', 'BAJOS DEL PERDIDO', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7795, 41, 2, 'SORIANO', 'BEQUELO', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7796, 41, 2, 'SORIANO', 'BIZCOCHO', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7797, 41, 2, 'SORIANO', 'BUENA VISTA', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7798, 41, 2, 'SORIANO', 'CAÑADA MAGALLANES', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7799, 41, 2, 'SORIANO', 'CAÑADA NIETO', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7800, 41, 2, 'SORIANO', 'CAÑADA PARAGUAYA', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7801, 41, 2, 'SORIANO', 'CARDONA', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7802, 41, 2, 'SORIANO', 'CASTILLOS', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(7803, 41, 2, 'SORIANO', 'CERRO ALEGRE', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7804, 41, 2, 'SORIANO', 'CERRO VERA', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7805, 41, 2, 'SORIANO', 'CHACRAS DE DOLORES', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7806, 41, 2, 'SORIANO', 'CHACRAS DE MERCEDES', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7807, 41, 2, 'SORIANO', 'COLOLO', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7808, 41, 2, 'SORIANO', 'COLONIA CONCORDIA', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7809, 41, 2, 'SORIANO', 'COLONIA DIAZ', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7810, 41, 2, 'SORIANO', 'COLONIA LARRAÑAGA', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7811, 41, 2, 'SORIANO', 'COLONIA SANTA CLARA', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7812, 41, 2, 'SORIANO', 'COLONIA URUGUAYA', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7813, 41, 2, 'SORIANO', 'COQUIMBO', '75500', NULL, NULL);
INSERT INTO `localidades` VALUES(7814, 41, 2, 'SORIANO', 'CORRALITO', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7815, 41, 2, 'SORIANO', 'COSTA DEL AGUILA', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7816, 41, 2, 'SORIANO', 'COSTAS DEL PERDIDO', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7817, 41, 2, 'SORIANO', 'CUATRO BOCAS DE BUENA VISTA', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7818, 41, 2, 'SORIANO', 'CUCHILLA DEL CORRALITO', '75400', NULL, NULL);
INSERT INTO `localidades` VALUES(7819, 41, 2, 'SORIANO', 'CUCHILLA DEL PERDIDO', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7820, 41, 2, 'SORIANO', 'CUEVA DEL TIGRE', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7821, 41, 2, 'SORIANO', 'DOLORES', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7822, 41, 2, 'SORIANO', 'DURAZNITO', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7823, 41, 2, 'SORIANO', 'EGAÑA', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7824, 41, 2, 'SORIANO', 'EL AGUILA', '75500', NULL, NULL);
INSERT INTO `localidades` VALUES(7825, 41, 2, 'SORIANO', 'EL TALA', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7826, 41, 2, 'SORIANO', 'ESPINILLO', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7827, 41, 2, 'SORIANO', 'GARULA', '75500', NULL, NULL);
INSERT INTO `localidades` VALUES(7828, 41, 2, 'SORIANO', 'GRITO DE ASENCIO', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7829, 41, 2, 'SORIANO', 'JOSE ENRIQUE RODO', '75400', NULL, NULL);
INSERT INTO `localidades` VALUES(7830, 41, 2, 'SORIANO', 'LA CONCORDIA', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7831, 41, 2, 'SORIANO', 'LA LAGUNA', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7832, 41, 2, 'SORIANO', 'LA LOMA', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7833, 41, 2, 'SORIANO', 'LA PALMA', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7834, 41, 2, 'SORIANO', 'LARES', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(7835, 41, 2, 'SORIANO', 'LAS MAULAS', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7836, 41, 2, 'SORIANO', 'LA TABLA', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7837, 41, 2, 'SORIANO', 'LATA DEL PERDIDO', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7838, 41, 2, 'SORIANO', 'MACIEL', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7839, 41, 2, 'SORIANO', 'MERCEDES', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7840, 41, 2, 'SORIANO', 'MONZON', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7841, 41, 2, 'SORIANO', 'OLIVERA', '75500', NULL, NULL);
INSERT INTO `localidades` VALUES(7842, 41, 2, 'SORIANO', 'PALMAR', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7843, 41, 2, 'SORIANO', 'PALMITAS', '75500', NULL, NULL);
INSERT INTO `localidades` VALUES(7844, 41, 2, 'SORIANO', 'PALO SOLO', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7845, 41, 2, 'SORIANO', 'PARADA SUAREZ', '75400', NULL, NULL);
INSERT INTO `localidades` VALUES(7846, 41, 2, 'SORIANO', 'PASO DE LA ARENA', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7847, 41, 2, 'SORIANO', 'PASO DE RAMOS', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7848, 41, 2, 'SORIANO', 'PEDRO CHICO', '75500', NULL, NULL);
INSERT INTO `localidades` VALUES(7849, 41, 2, 'SORIANO', 'PERSEVERANO', '70100', NULL, NULL);
INSERT INTO `localidades` VALUES(7850, 41, 2, 'SORIANO', 'PROGRESO', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7851, 41, 2, 'SORIANO', 'PUNTAS DE ARENALES', '70700', NULL, NULL);
INSERT INTO `localidades` VALUES(7852, 41, 2, 'SORIANO', 'PUNTAS DE DURAZNO', '75400', NULL, NULL);
INSERT INTO `localidades` VALUES(7853, 41, 2, 'SORIANO', 'PUNTAS DEL TALA', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7854, 41, 2, 'SORIANO', 'PUNTAS DE SAN SALVADOR', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7855, 41, 2, 'SORIANO', 'RINCON DE CAÑADA NIETO', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7856, 41, 2, 'SORIANO', 'RINCON DE COLOLO', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7857, 41, 2, 'SORIANO', 'RINCON DE RUIZ', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7858, 41, 2, 'SORIANO', 'RISSO', '75200', NULL, NULL);
INSERT INTO `localidades` VALUES(7859, 41, 2, 'SORIANO', 'SAN DIOS', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7860, 41, 2, 'SORIANO', 'SAN MARTIN', '75400', NULL, NULL);
INSERT INTO `localidades` VALUES(7861, 41, 2, 'SORIANO', 'SANTA BLANCA', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7862, 41, 2, 'SORIANO', 'SANTA CATALINA', '75300', NULL, NULL);
INSERT INTO `localidades` VALUES(7863, 41, 2, 'SORIANO', 'SARANDI CHICO', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7864, 41, 2, 'SORIANO', 'UNIDAD COOPERARIA No 1', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7865, 41, 2, 'SORIANO', 'VILLA ALEJANDRINA', '70700', NULL, NULL);
INSERT INTO `localidades` VALUES(7866, 41, 2, 'SORIANO', 'VILLA DARWIN', '75000', NULL, NULL);
INSERT INTO `localidades` VALUES(7867, 41, 2, 'SORIANO', 'VILLA SORIANO', '75100', NULL, NULL);
INSERT INTO `localidades` VALUES(7868, 41, 2, 'SORIANO', 'ZANJA HONDA', '75300', NULL, NULL);
INSERT INTO `localidades` VALUES(7869, 42, 2, 'TACUAREMBO', 'ACHAR', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7870, 42, 2, 'TACUAREMBO', 'ARROYO DEL MEDIO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7871, 42, 2, 'TACUAREMBO', 'ATAQUE', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7872, 42, 2, 'TACUAREMBO', 'BALNEARIO IPORA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7873, 42, 2, 'TACUAREMBO', 'BAÑADO DE CAÑAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7874, 42, 2, 'TACUAREMBO', 'BAÑADO DE ROCHA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7875, 42, 2, 'TACUAREMBO', 'BARRIO LA MATUTINA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7876, 42, 2, 'TACUAREMBO', 'BARRIO LIBERTAD', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7877, 42, 2, 'TACUAREMBO', 'BARRIO LOPEZ', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7878, 42, 2, 'TACUAREMBO', 'BARRIO SANTANGELO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7879, 42, 2, 'TACUAREMBO', 'BARRIO TORRES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7880, 42, 2, 'TACUAREMBO', 'BLANQUILLOS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7881, 42, 2, 'TACUAREMBO', 'CAÑADA DEL ESTADO', '45200', NULL, NULL);
INSERT INTO `localidades` VALUES(7882, 42, 2, 'TACUAREMBO', 'CAÑAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7883, 42, 2, 'TACUAREMBO', 'CARAGUATA AL NORTE', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7884, 42, 2, 'TACUAREMBO', 'CARDOSO', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7885, 42, 2, 'TACUAREMBO', 'CARDOZO CHICO', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7886, 42, 2, 'TACUAREMBO', 'CARPINTERIA', '45200', NULL, NULL);
INSERT INTO `localidades` VALUES(7887, 42, 2, 'TACUAREMBO', 'CERRO BATOVI', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7888, 42, 2, 'TACUAREMBO', 'CERRO CHATO', '45200', NULL, NULL);
INSERT INTO `localidades` VALUES(7889, 42, 2, 'TACUAREMBO', 'CERRO DEL ARBOLITO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7890, 42, 2, 'TACUAREMBO', 'CERRO DE PASTOREO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7891, 42, 2, 'TACUAREMBO', 'CERRO DE PEREIRA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7892, 42, 2, 'TACUAREMBO', 'CERROS DE CLARA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7893, 42, 2, 'TACUAREMBO', 'CHAMBERLAIN', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7894, 42, 2, 'TACUAREMBO', 'CHARATA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7895, 42, 2, 'TACUAREMBO', 'CHURCHILL', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7896, 42, 2, 'TACUAREMBO', 'CINCO SAUCES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7897, 42, 2, 'TACUAREMBO', 'CLARA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7898, 42, 2, 'TACUAREMBO', 'CLAVIJO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7899, 42, 2, 'TACUAREMBO', 'COLMAN', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7900, 42, 2, 'TACUAREMBO', 'COSTAS DE CARAGUATA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7901, 42, 2, 'TACUAREMBO', 'COSTAS DE TRES CRUCES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7902, 42, 2, 'TACUAREMBO', 'COYO MARTINEZ', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7903, 42, 2, 'TACUAREMBO', 'CRUZ DE LOS CAMINOS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7904, 42, 2, 'TACUAREMBO', 'CUCHILLA DE LA CASA DE PIEDRA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7905, 42, 2, 'TACUAREMBO', 'CUCHILLA DE LA PALMA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7906, 42, 2, 'TACUAREMBO', 'CUCHILLA DE LAURELES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7907, 42, 2, 'TACUAREMBO', 'CUCHILLA DEL OMBU', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7908, 42, 2, 'TACUAREMBO', 'CUCHILLA DE PERALTA', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7909, 42, 2, 'TACUAREMBO', 'CURTINA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7910, 42, 2, 'TACUAREMBO', 'EL EMPALME', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7911, 42, 2, 'TACUAREMBO', 'ESTACION MENENDEZ', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7912, 42, 2, 'TACUAREMBO', 'FRIGORIFICO MODELO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7913, 42, 2, 'TACUAREMBO', 'HERIBERTO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7914, 42, 2, 'TACUAREMBO', 'LA ALDEA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7915, 42, 2, 'TACUAREMBO', 'LA BOLSA 01', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7916, 42, 2, 'TACUAREMBO', 'LA BOLSA 02', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7917, 42, 2, 'TACUAREMBO', 'LA HILERA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7918, 42, 2, 'TACUAREMBO', 'LAMBARE', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7919, 42, 2, 'TACUAREMBO', 'LA PALMA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7920, 42, 2, 'TACUAREMBO', 'LA PEDRERA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7921, 42, 2, 'TACUAREMBO', 'LARRAYOS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7922, 42, 2, 'TACUAREMBO', 'LAS ARENAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7923, 42, 2, 'TACUAREMBO', 'LAS CHIRCAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7924, 42, 2, 'TACUAREMBO', 'LAS PAJAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7925, 42, 2, 'TACUAREMBO', 'LAS TOSCAS DE CARAGUATA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7926, 42, 2, 'TACUAREMBO', 'LAURA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7927, 42, 2, 'TACUAREMBO', 'LAURELES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7928, 42, 2, 'TACUAREMBO', 'LOS CERROS', '45200', NULL, NULL);
INSERT INTO `localidades` VALUES(7929, 42, 2, 'TACUAREMBO', 'LOS COITINHOS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7930, 42, 2, 'TACUAREMBO', 'LOS CUADRADOS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7931, 42, 2, 'TACUAREMBO', 'LOS FEOS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7932, 42, 2, 'TACUAREMBO', 'LOS FURTADOS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7933, 42, 2, 'TACUAREMBO', 'LOS GARCIA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7934, 42, 2, 'TACUAREMBO', 'LOS GOMEZ', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7935, 42, 2, 'TACUAREMBO', 'LOS LAURELES', '45200', NULL, NULL);
INSERT INTO `localidades` VALUES(7936, 42, 2, 'TACUAREMBO', 'LOS MALAVARES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7937, 42, 2, 'TACUAREMBO', 'LOS ORTICES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7938, 42, 2, 'TACUAREMBO', 'LOS RODRIGUEZ', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7939, 42, 2, 'TACUAREMBO', 'LOS ROSANOS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7940, 42, 2, 'TACUAREMBO', 'LOS ROSAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7941, 42, 2, 'TACUAREMBO', 'LOS SEMPER', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7942, 42, 2, 'TACUAREMBO', 'LOS VAZQUEZ', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7943, 42, 2, 'TACUAREMBO', 'MARTINOTE', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7944, 42, 2, 'TACUAREMBO', 'MINUANO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7945, 42, 2, 'TACUAREMBO', 'MONTEVIDEO CHICO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7946, 42, 2, 'TACUAREMBO', 'ONCE CERROS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7947, 42, 2, 'TACUAREMBO', 'PAMPA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7948, 42, 2, 'TACUAREMBO', 'PASO BONILLA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7949, 42, 2, 'TACUAREMBO', 'PASO DE CEFERINO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7950, 42, 2, 'TACUAREMBO', 'PASO DE LAS CARRETAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7951, 42, 2, 'TACUAREMBO', 'PASO DE LAS FLORES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7952, 42, 2, 'TACUAREMBO', 'PASO DE LAS TOSCAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7953, 42, 2, 'TACUAREMBO', 'PASO DEL CERRO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7954, 42, 2, 'TACUAREMBO', 'PASO DEL MEDIO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7955, 42, 2, 'TACUAREMBO', 'PASO DE LOS NOVILLOS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7956, 42, 2, 'TACUAREMBO', 'PASO DE LOS TOROS', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7957, 42, 2, 'TACUAREMBO', 'PASO DE PEREZ', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7958, 42, 2, 'TACUAREMBO', 'PASO HONDO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7959, 42, 2, 'TACUAREMBO', 'PASO LIVINDO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7960, 42, 2, 'TACUAREMBO', 'PASO VICTOR', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7961, 42, 2, 'TACUAREMBO', 'PICADA DE CUELLO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7962, 42, 2, 'TACUAREMBO', 'PIEDRA SOLA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7963, 42, 2, 'TACUAREMBO', 'PUEBLO CLAVIJO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7964, 42, 2, 'TACUAREMBO', 'PUEBLO DE ARRIBA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7965, 42, 2, 'TACUAREMBO', 'PUEBLO DEL BARRO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7966, 42, 2, 'TACUAREMBO', 'PUNTA DE CARRETERA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7967, 42, 2, 'TACUAREMBO', 'PUNTAS DE CINCO SAUCES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7968, 42, 2, 'TACUAREMBO', 'PUNTAS DE LAURELES', '45200', NULL, NULL);
INSERT INTO `localidades` VALUES(7969, 42, 2, 'TACUAREMBO', 'RINCON DE FREITAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7970, 42, 2, 'TACUAREMBO', 'RINCON DE GILOCA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7971, 42, 2, 'TACUAREMBO', 'RINCON DE LA ALDEA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7972, 42, 2, 'TACUAREMBO', 'RINCON DE LA BOLSA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7973, 42, 2, 'TACUAREMBO', 'RINCON DE LA LAGUNA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7974, 42, 2, 'TACUAREMBO', 'RINCON DEL BONETE', '45100', NULL, NULL);
INSERT INTO `localidades` VALUES(7975, 42, 2, 'TACUAREMBO', 'RINCON DE LOS MACHADO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7976, 42, 2, 'TACUAREMBO', 'RINCON DE PEREIRA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7977, 42, 2, 'TACUAREMBO', 'RINCON DE ZAMORA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7978, 42, 2, 'TACUAREMBO', 'RIVERA CHICO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7979, 42, 2, 'TACUAREMBO', 'SAN BENITO', '45200', NULL, NULL);
INSERT INTO `localidades` VALUES(7980, 42, 2, 'TACUAREMBO', 'SAN GREGORIO DE POLANCO', '45200', NULL, NULL);
INSERT INTO `localidades` VALUES(7981, 42, 2, 'TACUAREMBO', 'SAN JOAQUIN', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7982, 42, 2, 'TACUAREMBO', 'SAUCE DE BATOVI', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7983, 42, 2, 'TACUAREMBO', 'SAUCE DE TRANQUERAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7984, 42, 2, 'TACUAREMBO', 'SAUCE SOLO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7985, 42, 2, 'TACUAREMBO', 'SAUCE SOLO DEL RIO NEGRO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7986, 42, 2, 'TACUAREMBO', 'TACUAREMBO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7987, 42, 2, 'TACUAREMBO', 'TACUAREMBO CHICO', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7988, 42, 2, 'TACUAREMBO', 'TAMBORES', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7989, 42, 2, 'TACUAREMBO', 'TIERRAS COLORADAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7990, 42, 2, 'TACUAREMBO', 'TRES GUITARRAS', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7991, 42, 2, 'TACUAREMBO', 'TURUPI', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7992, 42, 2, 'TACUAREMBO', 'VALLE EDEN', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7993, 42, 2, 'TACUAREMBO', 'VILLA ANSINA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7994, 42, 2, 'TACUAREMBO', 'ZAMBULLON', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7995, 42, 2, 'TACUAREMBO', 'ZAPARA', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7996, 42, 2, 'TACUAREMBO', 'ZAPUCAY', '45000', NULL, NULL);
INSERT INTO `localidades` VALUES(7997, 43, 2, 'TREINTA Y TRES', 'ACOSTA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(7998, 43, 2, 'TREINTA Y TRES', 'ARRAYANES DE CEBOLLATI', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(7999, 43, 2, 'TREINTA Y TRES', 'ARRAYANES DE CORRAL DE CEBOLLATI', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8000, 43, 2, 'TREINTA Y TRES', 'ARROCERA BONOMO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8001, 43, 2, 'TREINTA Y TRES', 'ARROCERA EL TIGRE', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8002, 43, 2, 'TREINTA Y TRES', 'ARROCERA LA CATUMBERA', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(8003, 43, 2, 'TREINTA Y TRES', 'ARROCERA LA QUERENCIA', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(8004, 43, 2, 'TREINTA Y TRES', 'ARROCERA LAS PALMAS', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8005, 43, 2, 'TREINTA Y TRES', 'ARROCERA LOS CEIBOS', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8006, 43, 2, 'TREINTA Y TRES', 'ARROCERA LOS TEROS', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8007, 43, 2, 'TREINTA Y TRES', 'ARROCERA MINI', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8008, 43, 2, 'TREINTA Y TRES', 'ARROCERA PROCIPA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8009, 43, 2, 'TREINTA Y TRES', 'ARROCERA RINCON', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(8010, 43, 2, 'TREINTA Y TRES', 'ARROCERA SAN FERNANDO', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(8011, 43, 2, 'TREINTA Y TRES', 'ARROCERA SANTA FE', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8012, 43, 2, 'TREINTA Y TRES', 'ARROCERA ZAPATA', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8013, 43, 2, 'TREINTA Y TRES', 'ARROZAL TREINTA Y TRES', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8014, 43, 2, 'TREINTA Y TRES', 'AVESTRUZ CHICO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8015, 43, 2, 'TREINTA Y TRES', 'BAÑADO DE ORO', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8016, 43, 2, 'TREINTA Y TRES', 'BARRIO ABREU', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8017, 43, 2, 'TREINTA Y TRES', 'CAÑADA CHICA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8018, 43, 2, 'TREINTA Y TRES', 'CAÑADA DE LAS PIEDRAS', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8019, 43, 2, 'TREINTA Y TRES', 'CAÑADA DEL SAUCE', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8020, 43, 2, 'TREINTA Y TRES', 'CERRO CHATO', '35200', NULL, NULL);
INSERT INTO `localidades` VALUES(8021, 43, 2, 'TREINTA Y TRES', 'CERRO PELADO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8022, 43, 2, 'TREINTA Y TRES', 'CERROS DE AMARO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8023, 43, 2, 'TREINTA Y TRES', 'CIPA CEBOLLATI', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8024, 43, 2, 'TREINTA Y TRES', 'CIPA OLIMAR', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8025, 43, 2, 'TREINTA Y TRES', 'CIPA SECADOR', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8026, 43, 2, 'TREINTA Y TRES', 'CORRALES DE CEBOLLATI', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(8027, 43, 2, 'TREINTA Y TRES', 'COSTAS DEL ARROYO MALO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8028, 43, 2, 'TREINTA Y TRES', 'COSTAS DEL SARANDI', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8029, 43, 2, 'TREINTA Y TRES', 'COSTAS DE TACUARI', '37100', NULL, NULL);
INSERT INTO `localidades` VALUES(8030, 43, 2, 'TREINTA Y TRES', 'CUCHILLA DE DIONISIO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8031, 43, 2, 'TREINTA Y TRES', 'CUCHILLA DE OLMOS', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8032, 43, 2, 'TREINTA Y TRES', 'CUCHILLA DE OLMOS', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8033, 43, 2, 'TREINTA Y TRES', 'EJIDO DE TREINTA Y TRES', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8034, 43, 2, 'TREINTA Y TRES', 'EL BELLACO', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(8035, 43, 2, 'TREINTA Y TRES', 'EL CARMEN', '35200', NULL, NULL);
INSERT INTO `localidades` VALUES(8036, 43, 2, 'TREINTA Y TRES', 'EL CATETE', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8037, 43, 2, 'TREINTA Y TRES', 'GRAL. ENRIQUE MARTINEZ', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8038, 43, 2, 'TREINTA Y TRES', 'HIGUERONES', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8039, 43, 2, 'TREINTA Y TRES', 'JULIO MARIA SANZ', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8040, 43, 2, 'TREINTA Y TRES', 'LA CALAVERA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8041, 43, 2, 'TREINTA Y TRES', 'LA CALERA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8042, 43, 2, 'TREINTA Y TRES', 'LA LATA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8043, 43, 2, 'TREINTA Y TRES', 'LAS CHACRAS', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8044, 43, 2, 'TREINTA Y TRES', 'LAS PAVAS', '35100', NULL, NULL);
INSERT INTO `localidades` VALUES(8045, 43, 2, 'TREINTA Y TRES', 'LECHIGUANA DE CORRALES', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8046, 43, 2, 'TREINTA Y TRES', 'LOS CEIBOS', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8047, 43, 2, 'TREINTA Y TRES', 'MARIA ALBINA', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(8048, 43, 2, 'TREINTA Y TRES', 'MARIA ISABEL', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8049, 43, 2, 'TREINTA Y TRES', 'MATE DULCE', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8050, 43, 2, 'TREINTA Y TRES', 'MENDIZABAL', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8051, 43, 2, 'TREINTA Y TRES', 'MOLLES DE OLIMAR', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8052, 43, 2, 'TREINTA Y TRES', 'NOQUES DE OLIMAR CHICO', '35100', NULL, NULL);
INSERT INTO `localidades` VALUES(8053, 43, 2, 'TREINTA Y TRES', 'OLIMAR GRANDE', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8054, 43, 2, 'TREINTA Y TRES', 'PALO A PIQUE', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8055, 43, 2, 'TREINTA Y TRES', 'PANTEON', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(8056, 43, 2, 'TREINTA Y TRES', 'PASO ANCHO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8057, 43, 2, 'TREINTA Y TRES', 'PASO DE AVERIAS', '35100', NULL, NULL);
INSERT INTO `localidades` VALUES(8058, 43, 2, 'TREINTA Y TRES', 'PASO DE LA ATAHONA', '35100', NULL, NULL);
INSERT INTO `localidades` VALUES(8059, 43, 2, 'TREINTA Y TRES', 'PASO DE LA LAGUNA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8060, 43, 2, 'TREINTA Y TRES', 'PASO DEL SAUCE', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(8061, 43, 2, 'TREINTA Y TRES', 'PASO DE PIRIZ', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8062, 43, 2, 'TREINTA Y TRES', 'POBLADO ALONZO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8063, 43, 2, 'TREINTA Y TRES', 'PUNTAS DE LEONCHO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8064, 43, 2, 'TREINTA Y TRES', 'PUNTAS DEL ORO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8065, 43, 2, 'TREINTA Y TRES', 'PUNTAS DE LOS CEIBOS', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8066, 43, 2, 'TREINTA Y TRES', 'PUNTAS DEL PARAO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8067, 43, 2, 'TREINTA Y TRES', 'PUNTAS DE QUEBRACHO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8068, 43, 2, 'TREINTA Y TRES', 'RINCON', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8069, 43, 2, 'TREINTA Y TRES', 'RINCON DE GADEA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8070, 43, 2, 'TREINTA Y TRES', 'RINCON DE IGUINI', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8071, 43, 2, 'TREINTA Y TRES', 'RINCON DE LOS FRANCOS', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8072, 43, 2, 'TREINTA Y TRES', 'RINCON DE QUINTANA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8073, 43, 2, 'TREINTA Y TRES', 'RINCON DE URTUBEY', '35100', NULL, NULL);
INSERT INTO `localidades` VALUES(8074, 43, 2, 'TREINTA Y TRES', 'SANTA CLARA DE OLIMAR', '35300', NULL, NULL);
INSERT INTO `localidades` VALUES(8075, 43, 2, 'TREINTA Y TRES', 'SAUCE DE CORRALES', '30300', NULL, NULL);
INSERT INTO `localidades` VALUES(8076, 43, 2, 'TREINTA Y TRES', 'SIERRA DEL YERBAL', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8077, 43, 2, 'TREINTA Y TRES', 'SIETE CASAS', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8078, 43, 2, 'TREINTA Y TRES', 'TREINTA Y TRES', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8079, 43, 2, 'TREINTA Y TRES', 'TUPAMBAE', '36100', NULL, NULL);
INSERT INTO `localidades` VALUES(8080, 43, 2, 'TREINTA Y TRES', 'VALENTINES', '35100', NULL, NULL);
INSERT INTO `localidades` VALUES(8081, 43, 2, 'TREINTA Y TRES', 'VERDE ALTO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8082, 43, 2, 'TREINTA Y TRES', 'VERGARA', '31100', NULL, NULL);
INSERT INTO `localidades` VALUES(8083, 43, 2, 'TREINTA Y TRES', 'VILLA PASSANO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8084, 43, 2, 'TREINTA Y TRES', 'VILLA SARA', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8085, 43, 2, 'TREINTA Y TRES', 'YERBAL CHICO', '33000', NULL, NULL);
INSERT INTO `localidades` VALUES(8086, 43, 2, 'TREINTA Y TRES', 'YERBALITO', '33000', NULL, NULL);

CREATE TABLE IF NOT EXISTS `marcas_producto` (
  `id_marcaproducto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(80) DEFAULT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `texto` longtext,
  `id_imagen` int(10) unsigned DEFAULT NULL,
  `publicado` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `destacado` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `orden` int(4) DEFAULT '9999',
  PRIMARY KEY (`id_marcaproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `mensajes` (
  `id_mensaje` int(10) UNSIGNED NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(16) NOT NULL,
  `visto` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `nombre` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `comentario` longtext NOT NULL,
  `nota` longtext,
  `id_padre` int(16) DEFAULT NULL,
  `id_producto` int(16) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `mensajes` (`id_mensaje`, `fecha`, `ip`, `visto`, `nombre`, `email`, `telefono`, `comentario`, `nota`, `id_padre`, `id_producto`) VALUES(7, '2019-01-25 12:33:00', '190.151.168.72', 0, 'Equipo de Transparent', 'info@transparent.com.ar', '-', 'Bienvenido a Transparent, aquí encontrarás todos tus mensajes.', NULL, NULL, NULL);

CREATE TABLE `newsletters` (
  `id_newsletter` int(10) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `novedades` (
  `id_novedad` int(16) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `copete` longtext DEFAULT NULL,
  `texto` longtext DEFAULT NULL,
  `id_categoria` int(10) DEFAULT 0,
  `autor` varchar(255) DEFAULT NULL,
  `fuente` varchar(255) DEFAULT NULL,
  `enlace` longtext DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `tags` longtext DEFAULT NULL,
  `publicado` int(1) DEFAULT 1,
  `destacado` int(1) DEFAULT 0,
  `fecha` varchar(255) DEFAULT NULL,
  `orden` int(5) DEFAULT 99999,
  `privada` int(1) DEFAULT 0,
  `html` longtext DEFAULT NULL,
  `estilo` int(11) DEFAULT 1,
  PRIMARY KEY (`id_novedad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `paginas` (
  `id_pagina` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identificador` varchar(50) NOT NULL,
  `maqueta` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `nombre` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` mediumtext,
  `texto` longtext,
  `id_imagen` int(10) unsigned DEFAULT NULL,
  `mapa` varchar(255) DEFAULT NULL,
  `publicado` int(1) DEFAULT '0',
  `destacado` int(1) DEFAULT '0',
  `enlace` longtext,
  `target` varchar(255) DEFAULT NULL,
  `html1` longtext,
  `html2` longtext,
  `html3` longtext,
  `html4` longtext,
  `html5` longtext,
  `html6` longtext,
  `id_tema` varchar(255) DEFAULT '2',
  `alineacion` varchar(255) DEFAULT NULL,
  `orden` int(4) DEFAULT '9999',
  `login` int(1) NOT NULL DEFAULT '0',
  `id_usuario` int(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `paginas` VALUES(8, 'terminos', 0, 'TÉRMINOS Y CONDICIONES', '', 'COMPRA SEGURA', 'TÉRMINOS DE USO  Y  CONDICIONES  DE PRIVACIDAD DE NUESTROS CLIENTES', NULL, NULL, 1, 1, '', '_blank', 'PAGOS\nTérminos sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad \nENTREGAS\nTérminos sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad', 'PAGOS\nTérminos sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad \nENTREGAS\nTérminos sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad  sobre uso y condiciones de seguridad', '', '', '', '', '2', NULL, 1, 0, 0);
INSERT INTO `paginas` VALUES(9, 'institucional', 0, 'INSTITUCIONAL', '', 'NUESTRA EMPRESA', 'CREAMOS OPORTUNIDADES PARA EL ÉXITO A TRAVÉS DE SOLUCIONES REALES Y CONFIABLES.', NULL, NULL, 1, 1, '', '_self', '<h3><b>NUESTRA TRAYECTORIA</b><br></h3><div>Más de 15 años atendiendo a nuestros clientes, asesorando y brindando nuestro apoyo incondicional, el cliente siempre tiene la verdad.</div>', '<h3><b>TRANSPARENCIA</b></h3><div>Tenemos una política de precios transparentes, en todo momento podrás conocer los precios sin especulaciones, brindamos informes especializados y publicamos nuestra formación de los mismos.</div>', '', '', '', '', '2', 'center', 2, 0, 0);
INSERT INTO `paginas` VALUES(10, 'seguinosen', 0, 'SEGUINOS EN', '', 'INSTAGRAM', '', NULL, NULL, 1, 1, 'https://www.instagram.com', '_blank', '', '', '', '', '', '', '2', NULL, 3, 0, 0);

CREATE TABLE `paises` (
  `id_pais` int(10) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `notas` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `paises` VALUES(1, 'Argentina', NULL);
INSERT INTO `paises` VALUES(2, 'Uruguay', NULL);
INSERT INTO `paises` VALUES(3, 'España', NULL);
INSERT INTO `paises` VALUES(4, 'México', NULL);
INSERT INTO `paises` VALUES(5, 'Chile', NULL);

CREATE TABLE `pedidos` (
  `id_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  `comentario` longtext DEFAULT NULL,
  `nota` longtext DEFAULT NULL,
  `id_estado` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `cantidad_total` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `importe_total` decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `id_envio` int(10) DEFAULT NULL,
  `importe_envio` decimal(12,2) DEFAULT NULL,
  `mediodepago` varchar(255) DEFAULT NULL,
  `finalizado` int(1) NOT NULL DEFAULT 0,
  `mercadopago` longtext DEFAULT NULL,
  `importe_envio_info` decimal(12,2) DEFAULT NULL,
  `id_cupon` int(12) DEFAULT 0,
  `btc_calculado` decimal(8,8) DEFAULT NULL,
  `btc_cotiza_usd` decimal(10,2) DEFAULT NULL,
  `btc_transaccion` longtext DEFAULT NULL,
  `btc_billetera` varchar(255) DEFAULT NULL,
  `oca_operativa` varchar(255) DEFAULT NULL,
  `sistema_codigo` varchar(255) DEFAULT NULL,
  `sistema_nota` longtext DEFAULT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pedidos_mensajes` (
  `id_pedidomensaje` int(16) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(12) DEFAULT NULL,
  `id_operador` int(12) DEFAULT NULL,
  `id_usuario` int(12) DEFAULT NULL,
  `mensaje` longtext DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `sendgrid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pedidomensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `productos_pedido` (
  `id_productopedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `unitario` decimal(8,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `medida` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `id_cupon` int(12) DEFAULT '0',
  `notas` longtext DEFAULT NULL,
  `id_productovariante` int(16) DEFAULT NULL,
  PRIMARY KEY (`id_productopedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `productos_presupuesto` (
  `id_productopresupuesto` int(10) UNSIGNED NOT NULL,
  `id_presupuesto` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `unitario` decimal(8,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `provincias` (
  `id_provincia` int(10) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `id_pais` int(10) DEFAULT NULL,
  `notas` longtext,
  `codigo_erp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `provincias` VALUES(1, 'BUENOS AIRES', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(2, 'CAPITAL FEDERAL', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(3, 'CATAMARCA', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(4, 'CHACO', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(5, 'CHUBUT', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(6, 'CORDOBA', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(7, 'CORRIENTES', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(8, 'ENTRE RIOS', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(9, 'FORMOSA', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(10, 'JUJUY', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(11, 'LA PAMPA', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(12, 'LA RIOJA', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(13, 'MENDOZA', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(14, 'MISIONES', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(15, 'NEUQUEN', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(16, 'RIO NEGRO', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(17, 'SALTA', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(18, 'SAN JUAN', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(19, 'SAN LUIS', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(20, 'SANTA CRUZ', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(21, 'SANTA FE', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(22, 'SANTIAGO DEL ESTERO', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(23, 'TIERRA DEL FUEGO', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(24, 'TUCUMAN', 1, NULL, NULL);
INSERT INTO `provincias` VALUES(25, 'ARTIGAS', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(26, 'CANELONES', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(27, 'CERRO LARGO', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(28, 'COLONIA', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(29, 'DURAZNO', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(30, 'FLORES', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(31, 'FLORIDA', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(32, 'LAVALLEJA', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(33, 'MALDONADO', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(34, 'MONTEVIDEO', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(35, 'PAYSANDÚ', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(36, 'RIO NEGRO', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(37, 'RIVERA', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(38, 'ROCHA', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(39, 'SALTO', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(40, 'SAN JOSÉ', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(41, 'SORIANO', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(42, 'TACUAREMBÓ', 2, NULL, NULL);
INSERT INTO `provincias` VALUES(43, 'TREINTA Y TRES', 2, NULL, NULL);

CREATE TABLE `registros` (
  `id_registro` int(10) UNSIGNED NOT NULL,
  `id_listado` int(10) UNSIGNED NOT NULL,
  `publicado` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `registros_listado` (
  `id_registrolistado` int(10) UNSIGNED NOT NULL,
  `id_registro` int(10) UNSIGNED NOT NULL,
  `id_campolistado` int(10) UNSIGNED NOT NULL,
  `texto` longtext,
  `entero` int(11) DEFAULT NULL,
  `decimal` decimal(12,2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `slider` (
  `id_slider` int(12) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `copete` varchar(255) DEFAULT NULL,
  `boton` varchar(255) DEFAULT NULL,
  `enlace` longtext,
  `ventana` int(2) DEFAULT NULL,
  `publicado` int(2) NOT NULL DEFAULT '1',
  `alineacion` varchar(255) NOT NULL DEFAULT 'center',
  `animacion` varchar(255) DEFAULT NULL,
  `video` longtext,
  `video_ini` varchar(255) DEFAULT NULL,
  `video_fin` varchar(255) DEFAULT NULL,
  `orden` int(6) DEFAULT '999999',
  `ubicacion` varchar(255) DEFAULT 'home',
  `color_txt1` varchar(50) DEFAULT NULL,
  `color_txt2` varchar(50) DEFAULT NULL,
  `color_txt3` varchar(50) DEFAULT NULL,
  `color_txt4` varchar(50) DEFAULT NULL,
  `color_btn` varchar(50) DEFAULT NULL,
  `color_btn_hover` varchar(50) DEFAULT NULL,
  `nombre_filtro` varchar(255) DEFAULT NULL,
  `opacidad` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `ubicaciones_anuncio` (
  `id_ubicacionanuncio` int(10) UNSIGNED NOT NULL,
  `id_anuncio` int(10) UNSIGNED NOT NULL,
  `sector` varchar(100) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `filtros` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ubicaciones_anuncio` VALUES(1, 1, 'home', 'top', NULL);
INSERT INTO `ubicaciones_anuncio` VALUES(2, 1, 'productos', '', NULL);
INSERT INTO `ubicaciones_anuncio` VALUES(3, 1, 'paginas', '', NULL);
INSERT INTO `ubicaciones_anuncio` VALUES(4, 1, 'contacto', '', NULL);


CREATE TABLE `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `dni` varchar(20) NOT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `localidad` varchar(255) NOT NULL,
  `codigo_postal` varchar(30) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `piso` varchar(255) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) NOT NULL,
  `nota` longtext,
  `observacion` longtext,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `clave` varchar(30) DEFAULT NULL,
  `lista` tinyint(3) unsigned DEFAULT NULL,
  `activo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bloqueado` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alta_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ultimo_ingreso` datetime DEFAULT NULL,
  `ultima_actividad` datetime DEFAULT NULL,
  `entrega_domicilio` varchar(255) DEFAULT NULL,
  `entrega_localidad` varchar(255) DEFAULT NULL,
  `entrega_codpos` varchar(255) DEFAULT NULL,
  `entrega_piso` varchar(255) DEFAULT NULL,
  `entrega_departamento` varchar(255) DEFAULT NULL,
  `entrega_comentarios` varchar(255) DEFAULT NULL,
  `mayorista` int(1) NOT NULL DEFAULT '0',
  `email_valido` int(1) DEFAULT NULL,
  `md5` varchar(255) DEFAULT NULL,
  `email_original` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `bonif` varchar(255) DEFAULT NULL,
  `misc1` varchar(255) DEFAULT NULL,
  `misc2` varchar(255) DEFAULT NULL,
  `misc3` varchar(255) DEFAULT NULL,
  `misc4` varchar(255) DEFAULT NULL,
  `misc5` varchar(255) DEFAULT NULL,
  `id_provincia` int(3) DEFAULT NULL,
  `cond_fiscal` varchar(255) DEFAULT NULL,
  `f1_razsoc` varchar(255) DEFAULT NULL,
  `f1_condfis` varchar(50) DEFAULT NULL,
  `f1_tel` varchar(255) DEFAULT NULL,
  `f1_cuit` varchar(50) DEFAULT NULL,
  `f1_dir` varchar(255) DEFAULT NULL,
  `f1_prov` int DEFAULT NULL,
  `f1_loc` int DEFAULT NULL,
  `f1_codpos` varchar(50) DEFAULT NULL,
  `id_sistema` varchar(255) DEFAULT NULL,
  `id_operador` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000;

CREATE TABLE `valores_campoproducto` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `id_campocategoria` int(10) UNSIGNED NOT NULL,
  `valor` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id_anuncio`);

ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`);

ALTER TABLE `campos_categoriaproducto`
  ADD PRIMARY KEY (`id_campocategoria`);

ALTER TABLE `campos_listado`
  ADD PRIMARY KEY (`id_campolistado`);

ALTER TABLE `categorias_producto`
  ADD PRIMARY KEY (`id_categoriaproducto`);

ALTER TABLE `colores`
  ADD PRIMARY KEY (`id_color`);

ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`);

ALTER TABLE `enlaces`
  ADD PRIMARY KEY (`id_enlace`);

ALTER TABLE `estados_pedido`
  ADD PRIMARY KEY (`id_estadopedido`);

ALTER TABLE `estados_presupuesto`
  ADD PRIMARY KEY (`id_estadopresupuesto`);

ALTER TABLE `galerias`
  ADD PRIMARY KEY (`id_galeria`);

ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`);

ALTER TABLE `inicio`
  ADD PRIMARY KEY (`id_inicio`);

ALTER TABLE `listados`
  ADD PRIMARY KEY (`id_listado`);

ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id_localidad`);

ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`);

ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id_newsletter`);

ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_pais`);

ALTER TABLE `productos` ADD KEY `codigo` (`codigo`);

ALTER TABLE `productos_presupuesto`
  ADD PRIMARY KEY (`id_productopresupuesto`);

ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id_provincia`);

ALTER TABLE `registros`
  ADD PRIMARY KEY (`id_registro`);

ALTER TABLE `registros_listado`
  ADD PRIMARY KEY (`id_registrolistado`);

ALTER TABLE `ubicaciones_anuncio`
  ADD PRIMARY KEY (`id_ubicacionanuncio`);

ALTER TABLE `valores_campoproducto`
  ADD PRIMARY KEY (`id_producto`,`id_campocategoria`);


ALTER TABLE `anuncios`
  MODIFY `id_anuncio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `archivos`
  MODIFY `id_archivo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `campos_categoriaproducto`
  MODIFY `id_campocategoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `campos_listado`
  MODIFY `id_campolistado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `colores`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `enlaces`
  MODIFY `id_enlace` int(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `estados_pedido`
  MODIFY `id_estadopedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `estados_presupuesto`
  MODIFY `id_estadopresupuesto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `formas_envio`
  MODIFY `id_formaenvio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `galerias`
  MODIFY `id_galeria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2699;

ALTER TABLE `inicio`
  MODIFY `id_inicio` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `listados`
  MODIFY `id_listado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `localidades`
  MODIFY `id_localidad` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3968;

ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `newsletters`
  MODIFY `id_newsletter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=556;

ALTER TABLE `novedades`
  MODIFY `id_novedad` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `paises`
  MODIFY `id_pais` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `productos_presupuesto`
  MODIFY `id_productopresupuesto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `provincias`
  MODIFY `id_provincia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `registros`
  MODIFY `id_registro` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `registros_listado`
  MODIFY `id_registrolistado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `ubicaciones_anuncio`
  MODIFY `id_ubicacionanuncio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `categorias_producto` CHANGE `id_categoriaproducto` `id_categoriaproducto` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;


CREATE TABLE IF NOT EXISTS `sucursales` (
  `id_sucursal` int(12) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `horarios` longtext,
  `html` longtext,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `retiro` int(1) DEFAULT '0',
  `orden` int(11) NOT NULL DEFAULT '9999',
  `publicado` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sucursal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

CREATE TABLE  IF NOT EXISTS `smartsearch` (
  `id_smart` INT(12) NOT NULL AUTO_INCREMENT , 
  `system` LONGTEXT NULL , 
  `prompt` LONGTEXT NULL , 
  `response` LONGTEXT NULL , 
  `fecha` DATETIME NULL , 
  `modelo` VARCHAR(255) NULL , 
  `consulta_sql` LONGTEXT NULL , 
  PRIMARY KEY (`id_smart`)) ENGINE = InnoDB;