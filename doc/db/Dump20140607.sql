CREATE DATABASE  IF NOT EXISTS `pen` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pen`;
-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: pen
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.13.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ac_cuadros`
--

DROP TABLE IF EXISTS `ac_cuadros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_cuadros` (
  `id_cuadro` int(11) NOT NULL AUTO_INCREMENT,
  `id_objetivo` int(11) NOT NULL,
  `creado_por` int(11) NOT NULL COMMENT 'id_usuario',
  `titulo` varchar(200) DEFAULT NULL,
  `table_cuadro` varchar(30) DEFAULT NULL COMMENT 'Nombre de la tabla que se generara.\ntable_cuadro_.......',
  `fecha_registro` datetime DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_cuadro`),
  KEY `fk_creador_por_administrador` (`creado_por`),
  KEY `fk_ac_cuadros_ac_objetivos1_idx` (`id_objetivo`),
  CONSTRAINT `fk_creador_por_administrador` FOREIGN KEY (`creado_por`) REFERENCES `ac_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ac_cuadros_ac_objetivos1` FOREIGN KEY (`id_objetivo`) REFERENCES `ac_objetivos` (`id_objetivo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cuadros estadisticos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_cuadros`
--

LOCK TABLES `ac_cuadros` WRITE;
/*!40000 ALTER TABLE `ac_cuadros` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_cuadros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_cuadros_filtros`
--

DROP TABLE IF EXISTS `ac_cuadros_filtros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_cuadros_filtros` (
  `id_cuadro_filtro` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuadro` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `value_data` text COMMENT 'Almacena el filtro que se realiza.\n{key:value}\n{sexo:{1:M, 2:F}, anio:2014}',
  PRIMARY KEY (`id_cuadro_filtro`),
  KEY `fk_ac_cuadros_filtros_ac_cuadros1_idx` (`id_cuadro`),
  CONSTRAINT `fk_ac_cuadros_filtros_ac_cuadros1` FOREIGN KEY (`id_cuadro`) REFERENCES `ac_cuadros` (`id_cuadro`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registro de filtros realizados  por los cuadros estadisticos.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_cuadros_filtros`
--

LOCK TABLES `ac_cuadros_filtros` WRITE;
/*!40000 ALTER TABLE `ac_cuadros_filtros` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_cuadros_filtros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_cuadros_usuarios`
--

DROP TABLE IF EXISTS `ac_cuadros_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_cuadros_usuarios` (
  `id_cuadro_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuadro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL COMMENT 'usuario con absoluto control\nusuario Padre O propietario del cuadro.',
  `usuario_asignado` int(11) DEFAULT NULL,
  `permiso` tinyint(4) DEFAULT '0' COMMENT '-- permiso al usuario asignado.\n1 = Reporte',
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_cuadro_usuario`),
  KEY `fk_ac_cuadros_usuarios_ac_cuadros1_idx` (`id_cuadro`),
  KEY `fk_ac_cuadros_usuarios_ac_usuarios1_idx` (`id_usuario`),
  CONSTRAINT `fk_ac_cuadros_usuarios_ac_cuadros1` FOREIGN KEY (`id_cuadro`) REFERENCES `ac_cuadros` (`id_cuadro`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ac_cuadros_usuarios_ac_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `ac_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lista de usuarios que tienen acceso ah este cuadro\nNOTA : Ojo con la consistencia de los datos.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_cuadros_usuarios`
--

LOCK TABLES `ac_cuadros_usuarios` WRITE;
/*!40000 ALTER TABLE `ac_cuadros_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_cuadros_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_cuadros_variables`
--

DROP TABLE IF EXISTS `ac_cuadros_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_cuadros_variables` (
  `id_cuadro_variable` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuadro` int(11) NOT NULL,
  `id_variable` int(11) NOT NULL,
  `es_lista_multiple` tinyint(4) DEFAULT '0' COMMENT 'selecccion combo:\n0 = simple\n1 = multiple\n',
  PRIMARY KEY (`id_cuadro_variable`),
  KEY `fk_ac_cuadros_variables_ac_cuadros1_idx` (`id_cuadro`),
  KEY `fk_ac_cuadros_variables_ac_variables1_idx` (`id_variable`),
  CONSTRAINT `fk_ac_cuadros_variables_ac_cuadros1` FOREIGN KEY (`id_cuadro`) REFERENCES `ac_cuadros` (`id_cuadro`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ac_cuadros_variables_ac_variables1` FOREIGN KEY (`id_variable`) REFERENCES `ac_variables` (`id_variable`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Creacion del cuadro estadistico\ncuadro + variables\nFORMULARIO PARA EL USUARIO.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_cuadros_variables`
--

LOCK TABLES `ac_cuadros_variables` WRITE;
/*!40000 ALTER TABLE `ac_cuadros_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_cuadros_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_listas`
--

DROP TABLE IF EXISTS `ac_listas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_listas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_variable` int(11) NOT NULL,
  `key` varchar(20) DEFAULT NULL,
  `value` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ac_variables` (`id_variable`) USING BTREE,
  CONSTRAINT `fk_ac_variables` FOREIGN KEY (`id_variable`) REFERENCES `ac_variables` (`id_variable`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='almacena los datos cuando el tipo de variable  es una lista.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_listas`
--

LOCK TABLES `ac_listas` WRITE;
/*!40000 ALTER TABLE `ac_listas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_listas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_objetivos`
--

DROP TABLE IF EXISTS `ac_objetivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_objetivos` (
  `id_objetivo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_objetivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lista de objetivos (6)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_objetivos`
--

LOCK TABLES `ac_objetivos` WRITE;
/*!40000 ALTER TABLE `ac_objetivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_objetivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_usuarios`
--

DROP TABLE IF EXISTS `ac_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
  `email` varchar(75) DEFAULT NULL COMMENT 'correo usado como credencial',
  `pswd` varchar(128) DEFAULT NULL COMMENT 'password usado como credencial	',
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `es_super_usuario` tinyint(4) DEFAULT '0' COMMENT 'Indicador que es el usuario Administrador1 = Administrador0 = No Administrador',
  `activo` tinyint(4) DEFAULT '1' COMMENT '- actividad como usuario del sistema\n- eliminacion logica\n1 = Activado\n0 = Desactivado',
  `fecha_registro` datetime DEFAULT NULL COMMENT 'fecha en el que el usuario fue registrado en la base de datos',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_usuarios`
--

LOCK TABLES `ac_usuarios` WRITE;
/*!40000 ALTER TABLE `ac_usuarios` DISABLE KEYS */;
INSERT INTO `ac_usuarios` VALUES (1,'root@gmail.com','123456',NULL,NULL,1,1,NULL),(2,'usuario@gmail.com','123456','pepe','rios',0,1,'2014-06-07 00:00:00');
/*!40000 ALTER TABLE `ac_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ac_variables`
--

DROP TABLE IF EXISTS `ac_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ac_variables` (
  `id_variable` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `nombre_key` varchar(15) DEFAULT NULL COMMENT 'variable_+id_variable',
  `tipo_variable` enum('ENTERO','REAL','BINARIO','CADENA','LISTA') DEFAULT NULL COMMENT 'tipo de variables para filtros:\n- Entero\n- Real\n- Binario\n- Cadena\n- Lista',
  `value_data` text COMMENT 'Entero = 1\nReal = 1.2\nBinario = 0\nCadena = texto\nLista = {key:value, key:value}',
  `patron_a_validar` varchar(20) DEFAULT NULL COMMENT 'Entero = (1,2,3) (1-3)\nReal = \nBinario =\nCadena = \nLista = \n\n = 0 : No validar\nvalidacion avanzada.\n',
  `table_lista` varchar(28) DEFAULT NULL,
  `es_filtro` tinyint(4) DEFAULT '1',
  `fecha_registro` datetime DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1' COMMENT 'Activo : si esta disponible esta variable\npara asignar a nuevos cuadros estadisticos.\n',
  PRIMARY KEY (`id_variable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lista de variables que se usan para para un cuadros estadisticos.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ac_variables`
--

LOCK TABLES `ac_variables` WRITE;
/*!40000 ALTER TABLE `ac_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `ac_variables` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-07 17:50:38
