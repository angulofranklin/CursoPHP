# phpMyAdmin MySQL-Dump
# version 2.3.2
# http://www.phpmyadmin.net/ (download page)
#
# servidor: localhost
# Tiempo de generaci�n: 03-02-2004 a las 23:49:27
# Versi�n del servidor: 4.00.12
# Versi�n de PHP: 4.3.1
# Base de datos : `lindavista`
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `usuarios`
#

CREATE TABLE usuarios (
  id smallint(5) unsigned NOT NULL auto_increment,
  usuario varchar(20) NOT NULL default '',
  clave varchar(20) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Usuarios registrados de la Inmobiliaria Lindavista';

#
# Volcar la base de datos para la tabla `usuarios`
#

INSERT INTO usuarios VALUES (1, 'mariano', 'matOq4wkFsob6');

    