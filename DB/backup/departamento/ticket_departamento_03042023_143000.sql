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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-03 14:30:00
