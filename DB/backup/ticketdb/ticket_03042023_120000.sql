-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ticket
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(100) NOT NULL,
  `nombre_admin` varchar(60) NOT NULL,
  `clave` mediumtext NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `correo` (`email_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'Super Administrador','Administrador','2a2e9a58102784ca18e2605a4e727b5f','administrador@gmail.com');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(100) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `clave` text NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `telefono_celular` varchar(10) DEFAULT NULL,
  `Fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `idEstatus` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `id_num` (`email_cliente`),
  KEY `FK_EST2` (`idEstatus`),
  KEY `FK_ROL` (`id_rol`),
  KEY `FK_CLIENTEDEPA` (`id_departamento`),
  CONSTRAINT `FK_CLIENTEDEPA` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`idDepartamento`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_EST2` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION,
  CONSTRAINT `FK_ROL` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Leonardo Saínos Pérez','LeonardoSainos','leonardosainos@gmail.com','5e8667a439c68f5145dd2fcbecf02209',2505,4046,'2228412398','2023-02-21 15:43:55',31448),(3,'Alondra Sanchez Torivio','Alo250518','alondrasanchez@gmail.com','25d55ad283aa400af464c76d713c07ad',2505,5267,'2228660690','2023-01-30 19:39:32',31448),(5,'Andrés Sebastián Sánchez Cortez','Oaxaco','andressebas@gmail.com','0094bcd09edc457cf5efd7d93ad995f3',2505,5267,'5535291605','2023-02-22 20:37:38',31448),(7,'Luis Enrique Granillo Gamino','Gamino','kikegamino@gmail.com','25d55ad283aa400af464c76d713c07ad',2505,5267,'2222335566','2023-01-18 23:25:39',31448),(8,'Roman Sanchez','Roman08','roman@gmail.com','e2a8423214be5cd507325221dea72022',2505,9947,'2225469883','2023-02-11 18:04:26',31448),(12,'Luis Enrique Granillo Gamino','TecnicoKike','LuisGranillo@gmail.com','ed2b1f468c5f915f3f1cf75d7068baae',2505,4046,'2225277033','2023-02-21 16:44:32',31448),(22,'Bruno Absalon Flores Rosas','PeterGordo','bruno@gmail.com','ed2b1f468c5f915f3f1cf75d7068baae',2505,5267,'2213516726','2023-02-22 17:40:19',19231),(23,'Luis Hernandez Escuela','Escuela@alcomex','schoolmusic@gmail.com','helloworld',2510,4046,'2228526358','2023-03-13 17:05:23',31448),(29,'Edson Montiell Alvarez','EdsonRH','alcomex2022@gmail.com','25d55ad283aa400af464c76d713c07ad',2524,5267,'2221917939','2023-03-14 19:26:32',31448),(30,'Minerva Salas','Miche','mine@gmail.com','113065d2207b574501892641d0383875',9,4046,'2228412399','2023-03-22 15:49:33',25542),(31,'Gibran Antonio Garcia Xicohtencatl','Gibran','sistemas@alcomex.mx','342ef382d282dceaac9bfc51ebd7bae6',2505,4046,'2223245928','2023-03-23 16:45:16',25542),(38,'Jenny Ortega Garcia','Jenny','jennyortega@gmail.com','25d55ad283aa400af464c76d713c07ad',2505,5267,'5566778844','2023-03-27 20:01:07',31448),(40,'Uriel Isai Hernández Hernández ','UriCss','uricss@gmail.com','25d55ad283aa400af464c76d713c07ad',2505,5267,'2491739802','2023-03-28 20:12:27',31448),(50,'Ajax AjaxJquery','Ajax','jquery@gmail.com','',3,4046,' 554657689','2023-03-31 15:41:03',31448);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `InsertarCliente` AFTER INSERT ON `cliente` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.id_cliente,"cliente") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `registro_alteracion_clientes` AFTER UPDATE ON `cliente` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.id_cliente,"cliente") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Eliminarregistro_alteracionesUsuarios` BEFORE DELETE ON `cliente` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"Eliminar", OLD.id_cliente,"cliente") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `correo` varchar(55) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `idEstatus` int(10) DEFAULT NULL,
  `idJefe` int(10) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idDepartamento`),
  UNIQUE KEY `correo` (`correo`),
  KEY `FK_DEPART` (`idEstatus`),
  KEY `Fk_jefes` (`idJefe`),
  CONSTRAINT `FK_DEPART` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION,
  CONSTRAINT `FK_LIDER` FOREIGN KEY (`idJefe`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION,
  CONSTRAINT `Fk_jefe` FOREIGN KEY (`idJefe`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION,
  CONSTRAINT `Fk_jefes` FOREIGN KEY (`idJefe`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2526 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (3,'Prueba','Prueba@gmail.com','esto es una prueba',31448,22,'2023-03-09 18:16:27'),(7,'Talleres','deportes@utpuebla.edu.mx','Talleres deportivos y culturales ',31448,1,'2023-03-09 18:16:27'),(9,'Titulacion','titulacionalcomex@utpuebla.mx','Area encargada del proceso de titulacion',31448,40,'2023-03-09 18:16:27'),(2505,'Sin departamento','','',31448,5,'2023-03-09 18:16:27'),(2506,'Cuentas por cobrar','cuentasporcobrar@alcomex.mx','Departamento del área de finanzas',31448,3,'2023-03-09 18:16:27'),(2507,'Prueba1','correo@gmail.com','Esto es una prueba de CRUD',31448,1,'2023-03-09 20:00:17'),(2510,'Prueba1','correo032@gmail.com','Esto es una prueba de CRUD',31448,1,'2023-03-09 22:38:28'),(2519,'Prueba10','icorreo9@gmail.com','Esto es una prueba de CRUD',31448,1,'2023-03-09 22:38:28'),(2522,'Taller B2','tallerb2@alcomex.mx','Esta área se encarga de dar mantenimiento a los equipos de carga ',31448,3,'2023-03-13 18:55:57'),(2523,'Sistemas','sistemas@alcomex.mx','Soporte técnico  ',31448,1,'2023-03-14 19:27:21'),(2524,'Recursos Humanos','alcomex2022@gmail.com','Recursos humanos alcomex',31448,29,'2023-03-14 19:29:28'),(2525,'Triggers','triggers@gmail.com','Prueba de desencadenadores',31448,40,'2023-03-27 20:14:20');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `InsertarDepartamento` AFTER INSERT ON `departamento` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.idDepartamento,"departamento") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `registro_alteracionesDepa` AFTER UPDATE ON `departamento` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.idDepartamento,"departamento") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Eliminarregistro_alteracionesDepa` BEFORE DELETE ON `departamento` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"Eliminar", OLD.idDepartamento,"departamento") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `enviocorreo`
--

DROP TABLE IF EXISTS `enviocorreo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enviocorreo` (
  `correo` varchar(200) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enviocorreo`
--

LOCK TABLES `enviocorreo` WRITE;
/*!40000 ALTER TABLE `enviocorreo` DISABLE KEYS */;
/*!40000 ALTER TABLE `enviocorreo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estatus`
--

DROP TABLE IF EXISTS `estatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estatus` (
  `idEstatus` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idEstatus`)
) ENGINE=InnoDB AUTO_INCREMENT=94577 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estatus`
--

LOCK TABLES `estatus` WRITE;
/*!40000 ALTER TABLE `estatus` DISABLE KEYS */;
INSERT INTO `estatus` VALUES (19231,'Temporal'),(25542,'Bloqueado'),(31448,'Activo'),(94573,'Vacaciones'),(94574,'PENDIENTE'),(94575,'EN PROCESO'),(94576,'RESUELTO');
/*!40000 ALTER TABLE `estatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_alteraciones`
--

DROP TABLE IF EXISTS `registro_alteraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro_alteraciones` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `accion` varchar(255) NOT NULL,
  `idAlterado` int(11) DEFAULT NULL,
  `tabla` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_registro`)
) ENGINE=InnoDB AUTO_INCREMENT=499 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_alteraciones`
--

LOCK TABLES `registro_alteraciones` WRITE;
/*!40000 ALTER TABLE `registro_alteraciones` DISABLE KEYS */;
INSERT INTO `registro_alteraciones` VALUES (284,1,'2023-03-25 19:37:35','Eliminar',59,'ticket'),(285,1,'2023-03-25 19:37:41','Eliminar',53,'ticket'),(286,1,'2023-03-27 19:16:56','Actualizar',3,'cliente'),(287,1,'2023-03-27 19:18:46','Actualizar',8,'cliente'),(288,1,'2023-03-27 19:19:20','Actualizar',30,'cliente'),(293,1,'2023-03-27 19:29:17','Actualizar',30,'cliente'),(296,1,'2023-03-27 19:37:54','Insertar',35,'cliente'),(297,1,'2023-03-27 19:55:53','Insertar',36,'cliente'),(298,37,'2023-03-27 19:57:13','Insertar',1,'cliente'),(299,38,'2023-03-27 20:01:07','Insertar',38,'cliente'),(302,1,'2023-03-27 20:06:02','Actualizar',2506,'departamento'),(303,36,'2023-03-27 20:06:51','Actualizar',65,'ticket'),(304,1,'2023-03-27 20:07:11','Eliminar',60,'ticket'),(305,1,'2023-03-27 20:13:35','Insertar',68,'ticket'),(306,1,'2023-03-27 20:14:20','Insertar',2525,'departamento'),(307,1,'2023-03-27 20:58:48','Actualizar',33,'cliente'),(308,0,'2023-03-27 20:58:54','Eliminar',33,'cliente'),(309,0,'2023-03-27 21:02:54','Eliminar',34,'cliente'),(310,1,'2023-03-27 21:03:17','Actualizar',36,'cliente'),(315,0,'2023-03-27 21:05:11','Eliminar',36,'cliente'),(316,1,'2023-03-27 21:07:40','Insertar',39,'cliente'),(369,1,'2023-03-28 20:08:32','Actualizar',2506,'departamento'),(370,0,'2023-03-28 20:10:42','',5,'cliente'),(371,40,'2023-03-28 20:12:27','Insertar',40,'cliente'),(372,0,'2023-03-28 20:21:18','',2506,'departamento'),(373,1,'2023-03-28 20:21:44','Actualizar',2523,'departamento'),(374,0,'2023-03-28 20:23:32','',2523,'departamento'),(375,1,'2023-03-28 20:23:46','Actualizar',2523,'departamento'),(376,1,'2023-03-28 20:38:53','Actualizar',2522,'departamento'),(377,1,'2023-03-28 20:39:01','Actualizar',2522,'departamento'),(378,1,'2023-03-28 20:39:08','Actualizar',2522,'departamento'),(379,1,'2023-03-28 20:41:23','Actualizar',2522,'departamento'),(380,1,'2023-03-28 20:42:24','Actualizar',2522,'departamento'),(381,1,'2023-03-28 20:43:44','Actualizar',2523,'departamento'),(382,1,'2023-03-28 21:29:14','Actualizar',2523,'departamento'),(383,1,'2023-03-28 21:29:19','Actualizar',2523,'departamento'),(384,1,'2023-03-28 21:29:24','Actualizar',2523,'departamento'),(385,1,'2023-03-28 21:32:42','Actualizar',2523,'departamento'),(386,1,'2023-03-28 21:46:38','Actualizar',2506,'departamento'),(387,1,'2023-03-28 21:46:49','Actualizar',2506,'departamento'),(388,1,'2023-03-28 21:47:22','Actualizar',2506,'departamento'),(389,1,'2023-03-28 21:59:42','Actualizar',2506,'departamento'),(390,1,'2023-03-28 22:07:56','Actualizar',2506,'departamento'),(391,1,'2023-03-28 22:12:46','Actualizar',2506,'departamento'),(392,1,'2023-03-28 22:12:57','Actualizar',2506,'departamento'),(393,1,'2023-03-28 22:13:48','Actualizar',2506,'departamento'),(394,1,'2023-03-28 22:14:11','Actualizar',1,'cliente'),(395,1,'2023-03-28 22:14:32','Actualizar',1,'cliente'),(396,1,'2023-03-28 22:17:04','Actualizar',2506,'departamento'),(397,1,'2023-03-28 22:17:14','Actualizar',2506,'departamento'),(398,1,'2023-03-28 22:17:36','Actualizar',1,'cliente'),(399,1,'2023-03-28 22:18:02','Actualizar',1,'cliente'),(400,0,'2023-03-28 22:19:01','',1,'cliente'),(401,1,'2023-03-28 22:31:48','Actualizar',2506,'departamento'),(402,1,'2023-03-28 22:32:12','Actualizar',2506,'departamento'),(403,1,'2023-03-28 22:33:25','Actualizar',2506,'departamento'),(404,1,'2023-03-28 22:35:36','Actualizar',2506,'departamento'),(405,1,'2023-03-28 22:37:29','Actualizar',2506,'departamento'),(406,1,'2023-03-28 22:37:48','Actualizar',2506,'departamento'),(407,1,'2023-03-28 22:40:11','Actualizar',1,'cliente'),(408,1,'2023-03-28 22:40:42','Actualizar',2523,'departamento'),(409,1,'2023-03-28 22:40:53','Actualizar',2522,'departamento'),(410,40,'2023-03-28 22:41:48','Actualizar',40,'cliente'),(411,40,'2023-03-28 22:44:01','Insertar',69,'ticket'),(412,40,'2023-03-28 22:46:57','Insertar',70,'ticket'),(413,40,'2023-03-28 22:47:02','Insertar',71,'ticket'),(414,40,'2023-03-28 22:47:06','Insertar',72,'ticket'),(415,40,'2023-03-28 22:47:09','Insertar',73,'ticket'),(416,40,'2023-03-28 22:47:12','Insertar',74,'ticket'),(417,40,'2023-03-28 22:47:15','Insertar',75,'ticket'),(418,40,'2023-03-28 22:47:18','Insertar',76,'ticket'),(419,40,'2023-03-28 22:47:21','Insertar',77,'ticket'),(420,40,'2023-03-28 22:47:23','Insertar',78,'ticket'),(421,40,'2023-03-28 22:47:27','Insertar',79,'ticket'),(422,40,'2023-03-28 22:47:31','Insertar',80,'ticket'),(423,40,'2023-03-28 22:47:34','Insertar',81,'ticket'),(424,40,'2023-03-28 22:47:37','Insertar',82,'ticket'),(425,40,'2023-03-28 22:47:41','Insertar',83,'ticket'),(426,40,'2023-03-28 22:47:44','Insertar',84,'ticket'),(427,40,'2023-03-28 22:47:47','Insertar',85,'ticket'),(428,40,'2023-03-28 22:47:50','Insertar',86,'ticket'),(429,40,'2023-03-28 22:47:54','Insertar',87,'ticket'),(430,40,'2023-03-28 22:47:58','Insertar',88,'ticket'),(431,40,'2023-03-28 22:48:02','Insertar',89,'ticket'),(432,40,'2023-03-28 22:48:06','Insertar',90,'ticket'),(433,40,'2023-03-28 22:48:10','Insertar',91,'ticket'),(434,40,'2023-03-28 22:48:13','Insertar',92,'ticket'),(435,40,'2023-03-28 22:48:16','Insertar',93,'ticket'),(436,40,'2023-03-28 22:48:21','Insertar',94,'ticket'),(437,40,'2023-03-28 22:48:58','Insertar',95,'ticket'),(438,40,'2023-03-28 22:49:03','Insertar',96,'ticket'),(439,40,'2023-03-28 22:49:06','Insertar',97,'ticket'),(440,40,'2023-03-28 22:49:10','Insertar',98,'ticket'),(441,40,'2023-03-28 22:49:13','Insertar',99,'ticket'),(442,40,'2023-03-28 22:49:17','Insertar',100,'ticket'),(443,40,'2023-03-28 22:49:21','Insertar',101,'ticket'),(444,1,'2023-03-28 22:49:58','Actualizar',2525,'departamento'),(445,1,'2023-03-28 22:50:30','Actualizar',40,'cliente'),(446,40,'2023-03-28 22:52:06','Actualizar',35,'ticket'),(447,0,'2023-03-28 23:00:30','',78,'ticket'),(448,1,'2023-03-28 23:12:11','Actualizar',1,'cliente'),(449,0,'2023-03-28 23:16:06','',1,'cliente'),(451,1,'2023-03-28 23:41:51','Actualizar',9,'departamento'),(453,1,'2023-03-28 23:53:56','Insertar',41,'cliente'),(454,0,'2023-03-29 00:03:11','Eliminar',41,'cliente'),(455,1,'2023-03-29 17:17:54','Insertar',42,'cliente'),(456,1,'2023-03-29 17:18:00','EliminarU',42,'cliente'),(457,1,'2023-03-29 17:18:07','Actualizar',40,'cliente'),(458,1,'2023-03-29 17:21:27','Insertar',43,'cliente'),(459,1,'2023-03-29 17:21:42','EliminarUsua',43,'cliente'),(460,1,'2023-03-29 17:22:37','Insertar',44,'cliente'),(461,1,'2023-03-29 17:24:07','Actualizar',44,'cliente'),(462,1,'2023-03-29 17:24:07','Actualizar',44,'cliente'),(463,1,'2023-03-29 17:24:10','Actualizar',44,'cliente'),(464,1,'2023-03-29 17:29:09','EliminarUsua',44,'cliente'),(465,1,'2023-03-29 17:30:08','Actualizar',7,'cliente'),(466,1,'2023-03-29 17:30:18','Actualizar',7,'cliente'),(467,1,'2023-03-29 17:30:28','Actualizar',29,'cliente'),(468,1,'2023-03-29 17:30:28','Actualizar',7,'cliente'),(469,1,'2023-03-29 17:30:33','Actualizar',29,'cliente'),(470,1,'2023-03-29 17:30:33','Actualizar',7,'cliente'),(471,1,'2023-03-29 17:32:26','Actualizar',40,'cliente'),(472,1,'2023-03-29 17:45:13','Insertar',45,'cliente'),(473,1,'2023-03-29 17:45:25','EliminarU',45,'cliente'),(474,1,'2023-03-29 17:46:52','Insertar',46,'cliente'),(477,1,'2023-03-29 17:47:23','Actualizar',35,'cliente'),(478,1,'2023-03-29 17:47:33','Actualizar',46,'cliente'),(479,1,'2023-03-29 17:47:48','EliminarU',65,'ticket'),(480,1,'2023-03-29 17:47:48','EliminarU',35,'cliente'),(481,1,'2023-03-29 17:47:48','EliminarU',46,'cliente'),(482,1,'2023-03-29 17:50:07','Insertar',47,'cliente'),(483,1,'2023-03-29 17:50:43','Insertar',48,'cliente'),(484,1,'2023-03-29 17:50:57','EliminarU',48,'cliente'),(485,1,'2023-03-29 17:50:57','EliminarU',47,'cliente'),(486,1,'2023-03-29 23:36:34','Actualizar',1,'cliente'),(487,0,'2023-03-30 15:35:23','',1,'cliente'),(488,1,'2023-03-30 16:09:22','Actualizar',31,'cliente'),(489,1,'2023-03-31 15:40:24','Insertar',49,'cliente'),(490,1,'2023-03-31 15:40:37','EliminarU',49,'cliente'),(491,1,'2023-03-31 15:41:03','Insertar',50,'cliente'),(492,1,'2023-03-31 18:37:04','Actualizar',1,'cliente'),(493,1,'2023-03-31 23:07:10','Actualizar',1,'cliente'),(494,1,'2023-04-01 17:28:44','Insertar',51,'cliente'),(495,1,'2023-04-01 17:29:00','EliminarU',51,'cliente'),(496,1,'2023-04-01 17:57:12','Eliminar',65,'ticket'),(497,1,'2023-04-01 17:58:10','Actualizar',38,'cliente'),(498,1,'2023-04-01 18:36:16','Actualizar',1,'cliente');
/*!40000 ALTER TABLE `registro_alteraciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=9948 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (4046,'ADMINISTRADOR'),(5267,'TÉCNICO'),(9947,'CLIENTE');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `serie` varchar(100) NOT NULL,
  `asunto` varchar(70) NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `solucion` varchar(300) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `id_atiende` int(11) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `serie` (`serie`),
  KEY `FK_TI` (`idUsuario`),
  KEY `DEPASTICKET` (`idDepartamento`),
  KEY `FK_TICKETESTATUS` (`idStatus`),
  KEY `FK_atiendes` (`id_atiende`),
  CONSTRAINT `DEPASTICKET` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_TI` FOREIGN KEY (`idUsuario`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_TICKETESTATUS` FOREIGN KEY (`idStatus`) REFERENCES `estatus` (`idEstatus`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_atiendes` FOREIGN KEY (`id_atiende`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (28,'2023-03-08 22:31:19','TK82N11','asas','asas','listo',1,3,94576,8,'2023-03-10 01:17:39'),(30,'2023-03-08 22:31:19','TK95N13','asa','asas','',1,3,94574,8,'2023-03-08 04:16:05'),(31,'2023-03-08 22:31:19','TK68N14','asas','sasa','',1,3,94574,8,'2023-03-08 04:16:07'),(32,'2023-03-08 22:31:19','TK19N15','asas','asas','',1,3,94574,8,'2023-03-08 04:16:10'),(33,'2023-03-08 22:31:19','TK40N16','asa','saasa','',1,3,94574,8,'2023-03-08 04:16:12'),(34,'2023-03-08 22:31:19','TK85N17','asas','asas','',1,3,94574,8,'2023-03-08 04:16:15'),(35,'2023-03-08 22:31:19','TK14N18','asasa','asasa','aun en proceso\r\n',1,3,94575,40,'2023-03-28 22:52:06'),(39,'2023-03-08 22:31:19','TK95N22','asasa','asasas','',1,3,94574,8,'2023-03-08 04:16:29'),(40,'2023-03-08 22:31:19','TK44N23','asasa','asasa','',1,3,94574,8,'2023-03-08 04:16:32'),(41,'2023-03-08 22:31:19','TK05N24','asasa','asas','',1,3,94574,8,'2023-03-08 04:16:35'),(42,'2023-03-08 22:31:19','TK72N25','asasa','asasas','',1,3,94574,8,'2023-03-08 04:16:38'),(43,'2023-03-08 22:31:19','TK72N26','asasa','asasas','',1,3,94574,8,'2023-03-08 04:16:42'),(45,'2023-03-08 22:31:19','TK28N28','asasas','asasa','',1,3,94574,8,'2023-03-08 04:16:48'),(46,'2023-03-08 22:31:19','TK66N29','asasa','saasas','',1,3,94574,8,'2023-03-08 04:16:50'),(47,'2023-03-08 22:31:19','TK80N30','asasas','asasa','',1,3,94574,8,'2023-03-08 04:16:53'),(48,'2023-03-08 22:31:19','TK95N31','asasa','sasasa','',1,3,94574,8,'2023-03-08 04:16:56'),(49,'2023-03-08 22:31:19','TK99N32','asasas','asasas','',1,3,94574,8,'2023-03-08 04:16:59'),(50,'2023-03-08 22:31:19','TK26N33','asas','asasas','',1,3,94574,8,'2023-03-08 04:17:04'),(51,'2023-03-08 22:31:19','TK23N34','asasas','asasa','',1,3,94574,8,'2023-03-08 04:17:07'),(52,'2023-03-08 22:31:19','TK85N35','asasa','asas','',1,3,94574,8,'2023-03-08 04:17:09'),(55,'2023-03-08 22:31:19','TK40N38','asas','asasas','',1,3,94574,8,'2023-03-08 04:17:18'),(56,'2023-03-08 22:31:19','TK18N39','asasa','asasa','',1,3,94574,8,'2023-03-08 04:17:20'),(57,'2023-03-08 22:31:19','TK16N40','asasa','asasas','',1,3,94574,8,'2023-03-08 04:17:22'),(58,'2023-03-08 22:31:19','TK53N41','asas','asasa','',1,3,94574,8,'2023-03-08 04:17:25'),(61,'2023-03-08 22:31:19','TK25N44','asa','asa','',1,3,94574,12,'2023-03-08 04:34:39'),(62,'2023-03-08 22:31:19','TK27N45','asa','asa','',1,3,94574,12,'2023-03-08 04:34:43'),(63,'2023-03-08 22:31:19','TK38N46','aa','ASAS','',1,3,94574,8,'2023-03-08 04:34:48'),(67,'2023-03-27 20:08:23','TK70N29','Prueba','Procedimientos almacenados','',1,3,94574,3,NULL),(68,'2023-03-27 20:13:35','TK49N30','Prueba de base de da','Prueba Triggers','',1,3,94574,29,NULL),(69,'2023-03-28 22:44:01','TK69N31','Fotos infantiles','Mañana iré a dejar mis fotitos','',40,3,94574,3,NULL),(70,'2023-03-28 22:46:57','TK09N32','Tarea Jenny','ada','',40,3,94574,5,NULL),(71,'2023-03-28 22:47:02','TK51N33','1','1','',40,3,94574,3,NULL),(72,'2023-03-28 22:47:06','TK32N34','2','2','',40,3,94574,3,NULL),(73,'2023-03-28 22:47:09','TK75N35','3','3','',40,3,94574,3,NULL),(74,'2023-03-28 22:47:12','TK89N36','4','4','',40,3,94574,3,NULL),(75,'2023-03-28 22:47:15','TK14N37','5','5','',40,3,94574,3,NULL),(76,'2023-03-28 22:47:18','TK60N38','6','6','',40,3,94574,3,NULL),(77,'2023-03-28 22:47:21','TK84N39','7','7','',40,3,94574,3,NULL),(78,'2023-03-28 22:47:23','TK04N40','8','8','',40,3,94574,1,NULL),(79,'2023-03-28 22:47:27','TK64N41','9','9','',40,3,94574,3,NULL),(80,'2023-03-28 22:47:31','TK13N42','10','10','',40,3,94574,3,NULL),(81,'2023-03-28 22:47:34','TK54N43','11','11','',40,3,94574,3,NULL),(82,'2023-03-28 22:47:37','TK60N44','12','12','',40,3,94574,3,NULL),(83,'2023-03-28 22:47:41','TK22N45','13','13','',40,3,94574,3,NULL),(84,'2023-03-28 22:47:44','TK30N46','14','14','',40,3,94574,3,NULL),(85,'2023-03-28 22:47:47','TK20N47','15','15','',40,3,94574,3,NULL),(86,'2023-03-28 22:47:50','TK79N48','16','16','',40,3,94574,3,NULL),(87,'2023-03-28 22:47:54','TK93N49','17','17','',40,3,94574,3,NULL),(88,'2023-03-28 22:47:58','TK58N50','18','18','',40,3,94574,3,NULL),(89,'2023-03-28 22:48:02','TK74N51','19','19','',40,3,94574,3,NULL),(90,'2023-03-28 22:48:06','TK07N52','20','20','',40,3,94574,3,NULL),(91,'2023-03-28 22:48:10','TK55N53','21','21','',40,3,94574,5,NULL),(92,'2023-03-28 22:48:13','TK26N54','22','22','',40,3,94574,5,NULL),(93,'2023-03-28 22:48:16','TK50N55','23','23','',40,3,94574,5,NULL),(94,'2023-03-28 22:48:21','TK08N56','24','24','',40,3,94574,5,NULL),(95,'2023-03-28 22:48:58','TK01N57','25','25','',40,3,94574,5,NULL),(96,'2023-03-28 22:49:03','TK04N58','26','26','',40,3,94574,5,NULL),(97,'2023-03-28 22:49:06','TK72N59','27','27','',40,3,94574,5,NULL),(98,'2023-03-28 22:49:10','TK53N60','28','28','',40,3,94574,5,NULL),(99,'2023-03-28 22:49:13','TK81N61','29','29','',40,3,94574,5,NULL),(100,'2023-03-28 22:49:17','TK83N62','30','30','',40,3,94574,5,NULL),(101,'2023-03-28 22:49:21','TK68N63','31','31','',40,3,94574,5,NULL);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `InsertarTicket` AFTER INSERT ON `ticket` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.id,"ticket") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `registro_alteracionesTickets` AFTER UPDATE ON `ticket` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.id,"ticket") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Eliminarregistro_alteracionesTicket` BEFORE DELETE ON `ticket` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"Eliminar", OLD.id,"ticket") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user_delete`
--

DROP TABLE IF EXISTS `user_delete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_delete` (
  `folio_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_departamento` varchar(60) DEFAULT NULL,
  `pendiente` int(11) DEFAULT NULL,
  `creados` int(11) DEFAULT NULL,
  `resuelto` int(11) DEFAULT NULL,
  `proceso` int(11) DEFAULT NULL,
  PRIMARY KEY (`folio_id`),
  KEY `Fk_rolDelete` (`id_rol`),
  CONSTRAINT `Fk_rolDelete` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_delete`
--

LOCK TABLES `user_delete` WRITE;
/*!40000 ALTER TABLE `user_delete` DISABLE KEYS */;
INSERT INTO `user_delete` VALUES (1,'2023-03-27 14:40:38',5,'Andrés Sebastián Sánchez Cortez',4046,'Sin departamento',5,0,1,2),(4,'2023-03-28 18:03:11',41,'Javier  Antonio Carrillo',9947,'Prueba',0,0,0,0),(5,'2023-03-29 11:18:00',42,'Taller B2 Hernandez Escuela',9947,'Prueba',0,0,0,0),(6,'2023-03-29 11:21:42',43,'Taller B2 dsaad',4046,'Prueba',0,0,0,0),(7,'2023-03-29 11:29:09',44,'xdsfsdfsdf adasdasdasds',5267,'Prueba',0,0,0,0),(8,'2023-03-29 11:45:25',45,'Policia .',9947,'Sin departamento',0,0,0,0),(10,'2023-03-29 11:47:48',35,'Gabriela Prueba Sainos',9947,'Prueba',0,0,0,1),(11,'2023-03-29 11:47:48',46,'Gabriela Prueba Sainos',9947,'Talleres',0,0,0,0),(12,'2023-03-29 11:50:57',48,'asa adasdasdasdsasas',4046,'Prueba1',0,0,0,0),(13,'2023-03-29 11:50:57',47,'asa asas',4046,'Prueba',0,0,0,0),(14,'2023-03-31 09:40:37',49,'Ajax AjaxJquery',4046,'Prueba',0,0,0,0),(15,'2023-04-01 11:29:00',51,'Taller B2 Hernandez Escuela',9947,'Prueba',0,0,0,0);
/*!40000 ALTER TABLE `user_delete` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-03 12:00:00