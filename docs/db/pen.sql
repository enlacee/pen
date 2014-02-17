-- phpMyAdmin SQL Dump
-- version 4.1.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-02-2014 a las 21:22:47
-- Versión del servidor: 5.5.34-0ubuntu0.13.10.1
-- Versión de PHP: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_cuadros`
--

CREATE TABLE IF NOT EXISTS `ac_cuadros` (
  `id_cuadro` int(11) NOT NULL AUTO_INCREMENT,
  `id_objetivo` int(11) NOT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `creado_por_administrador` int(11) NOT NULL COMMENT 'registro solo del super usuario ''Administrador''',
  `table_cuadro` varchar(30) DEFAULT NULL COMMENT 'Nombre de la tabla que se generara.\ntable_cuadro_.......',
  `fecha_registro` datetime DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_cuadro`),
  UNIQUE KEY `titulo_UNIQUE` (`titulo`),
  KEY `fk_creador_por_administrador` (`creado_por_administrador`),
  KEY `fk_ac_cuadros_ac_objetivos1_idx` (`id_objetivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Cuadros estadisticos' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_cuadros_filtros`
--

CREATE TABLE IF NOT EXISTS `ac_cuadros_filtros` (
  `id_cuadro_filtro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `value_data` text COMMENT 'Almacena el filtro que se realiza.\n{key:value}\n{sexo:{1:M, 2:F}, anio:2014}',
  `ac_cuadros_id_cuadro` int(11) NOT NULL,
  PRIMARY KEY (`id_cuadro_filtro`),
  KEY `fk_ac_cuadros_filtros_ac_cuadros1_idx` (`ac_cuadros_id_cuadro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registro de filtros realizados  por los cuadros estadisticos.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_cuadros_usuarios`
--

CREATE TABLE IF NOT EXISTS `ac_cuadros_usuarios` (
  `id_cuadro_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuadro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL COMMENT 'usuario con absoluto control\nusuario Padre O propietario del cuadro.',
  `usuario_asignado` int(11) NOT NULL COMMENT 'usuario q fue asignado \ncon algunos permisos\nsobre el cuadro estadistico',
  `usuario_asignado_permisos` varchar(10) DEFAULT NULL COMMENT 'PERMISOS :\n- CREAR\n- ACTUALIZAR\n- ELIMINAR\n- REPORTE',
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_cuadro_usuario`),
  KEY `fk_ac_cuadros_usuarios_ac_cuadros1_idx` (`id_cuadro`),
  KEY `fk_ac_cuadros_usuarios_ac_usuarios1_idx` (`id_usuario`),
  KEY `fk_ac_cuadros_usuarios_ac_usuarios2_idx` (`usuario_asignado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lista de usuarios que tienen acceso ah este cuadro' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_cuadros_variables`
--

CREATE TABLE IF NOT EXISTS `ac_cuadros_variables` (
  `id_cuadro_variable` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuadro` int(11) NOT NULL,
  `id_variable` int(11) NOT NULL,
  `form_lista_multiple` tinyint(4) DEFAULT '0' COMMENT 'selecccion combo:\n0 = simple\n1 = multiple\n',
  PRIMARY KEY (`id_cuadro_variable`),
  KEY `fk_ac_cuadros_variables_ac_cuadros_usuarios1_idx` (`id_cuadro`),
  KEY `fk_ac_cuadros_variables_ac_variables1_idx` (`id_variable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Creacion del cuadro estadistico\ncuadro + variables' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_objetivos`
--

CREATE TABLE IF NOT EXISTS `ac_objetivos` (
  `id_objetivo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_objetivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='lista de objetivos (6)' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ac_objetivos`
--

INSERT INTO `ac_objetivos` (`id_objetivo`, `titulo`) VALUES
(1, '1 Oportunidades y resultados educativos de igual calidad para todos.'),
(2, '2 Estudiantes e Instituciones que logran aprendizajes pertinentes y de calidad.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_usuarios`
--

CREATE TABLE IF NOT EXISTS `ac_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
  `email` varchar(75) DEFAULT NULL COMMENT 'correo usado como credencial',
  `pswd` varchar(128) DEFAULT NULL COMMENT 'password usado como credencial	',
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `es_super_usuario` bit(1) DEFAULT b'0' COMMENT 'Indicador que es el usuario Administrador\n1 = Administrador\n0 = No Administrador',
  `activo` tinyint(4) DEFAULT '1' COMMENT '- actividad como usuario del sistema\n- eliminacion logica\n1 = Activado\n0 = Desactivado',
  `fecha_registro` datetime DEFAULT NULL COMMENT 'fecha en el que el usuario fue registrado en la base de datos',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ac_usuarios`
--

INSERT INTO `ac_usuarios` (`id_usuario`, `email`, `pswd`, `nombre`, `apellido`, `es_super_usuario`, `activo`, `fecha_registro`) VALUES
(1, 'root@gmail.com', '123456', 'Root', 'Root', b'1', 1, '2014-02-17 00:00:00'),
(2, 'acopitan@gmail.com', '123456', 'ANIBAL', 'COPITAN', b'0', 1, '2014-02-17 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_variables`
--

CREATE TABLE IF NOT EXISTS `ac_variables` (
  `id_variable` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `nombre_key` varchar(15) DEFAULT NULL COMMENT 'variable_+id_variable',
  `tipo_variable` enum('ENTERO','REAL','BINARIO','CADENA','LISTA') DEFAULT NULL COMMENT 'tipo de variables para filtros:\n- Entero\n- Real\n- Binario\n- Cadena\n- Lista',
  `value_data` text COMMENT 'Entero = 1\nReal = 1.2\nBinario = 0\nCadena = texto\nLista = {key:value, key:value}',
  `patron_a_validar` varchar(20) DEFAULT NULL COMMENT 'Entero = (1,2,3) (1-3)\nReal = \nBinario =\nCadena = \nLista = \n\n = 0 : No validar\nvalidacion avanzada.\n',
  `table_lista` varchar(30) DEFAULT NULL,
  `es_filtro` tinyint(4) DEFAULT '1',
  `fecha_registro` datetime DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1' COMMENT 'Activo : si esta disponible esta variable\npara asignar a nuevos cuadros estadisticos.\n',
  PRIMARY KEY (`id_variable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lista de variables que se usan para para un cuadros estadisticos.' AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ac_cuadros`
--
ALTER TABLE `ac_cuadros`
  ADD CONSTRAINT `fk_creador_por_administrador` FOREIGN KEY (`creado_por_administrador`) REFERENCES `ac_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ac_cuadros_ac_objetivos1` FOREIGN KEY (`id_objetivo`) REFERENCES `ac_objetivos` (`id_objetivo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ac_cuadros_filtros`
--
ALTER TABLE `ac_cuadros_filtros`
  ADD CONSTRAINT `fk_ac_cuadros_filtros_ac_cuadros1` FOREIGN KEY (`ac_cuadros_id_cuadro`) REFERENCES `ac_cuadros` (`id_cuadro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ac_cuadros_usuarios`
--
ALTER TABLE `ac_cuadros_usuarios`
  ADD CONSTRAINT `fk_ac_cuadros_usuarios_ac_cuadros1` FOREIGN KEY (`id_cuadro`) REFERENCES `ac_cuadros` (`id_cuadro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ac_cuadros_usuarios_ac_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `ac_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ac_cuadros_usuarios_ac_usuarios2` FOREIGN KEY (`usuario_asignado`) REFERENCES `ac_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ac_cuadros_variables`
--
ALTER TABLE `ac_cuadros_variables`
  ADD CONSTRAINT `fk_ac_cuadros_variables_ac_cuadros_usuarios1` FOREIGN KEY (`id_cuadro`) REFERENCES `ac_cuadros_usuarios` (`id_cuadro_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ac_cuadros_variables_ac_variables1` FOREIGN KEY (`id_variable`) REFERENCES `ac_variables` (`id_variable`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
