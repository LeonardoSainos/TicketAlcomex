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
INSERT INTO `cliente` VALUES (1,'Leonardo Saínos Pérez','LeonardoSainos','leonardosainos@gmail.com','5e8667a439c68f5145dd2fcbecf02209',2505,9947,'2228412398','2023-02-21 15:43:55',31448),(3,'Alondra Sanchez Torivio','Alo250518','alondrasanchez@gmail.com','25d55ad283aa400af464c76d713c07ad',2505,5267,'2228660690','2023-01-30 19:39:32',31448),(5,'Andrés Sebastián Sánchez Cortez','Oaxaco','andressebas@gmail.com','0094bcd09edc457cf5efd7d93ad995f3',2505,5267,'5535291605','2023-02-22 20:37:38',31448),(7,'Luis Enrique Granillo Gamino','Gamino','kikegamino@gmail.com','25d55ad283aa400af464c76d713c07ad',2505,5267,'2222335566','2023-01-18 23:25:39',31448),(8,'Roman Sanchez','Roman08','roman@gmail.com','e2a8423214be5cd507325221dea72022',2505,9947,'2225469883','2023-02-11 18:04:26',31448),(12,'Luis Enrique Granillo Gamino','TecnicoKike','LuisGranillo@gmail.com','ed2b1f468c5f915f3f1cf75d7068baae',2505,4046,'2225277033','2023-02-21 16:44:32',31448),(22,'Bruno Absalon Flores Rosas','PeterGordo','bruno@gmail.com','ed2b1f468c5f915f3f1cf75d7068baae',2505,5267,'2213516726','2023-02-22 17:40:19',19231),(23,'Luis Hernandez Escuela','Escuela@alcomex','schoolmusic@gmail.com','helloworld',2510,4046,'2228526358','2023-03-13 17:05:23',31448),(29,'Edson Montiell Alvarez','EdsonRH','alcomex2022@gmail.com','25d55ad283aa400af464c76d713c07ad',2524,5267,'2221917939','2023-03-14 19:26:32',31448),(30,'Minerva Salas','Miche','mine@gmail.com','113065d2207b574501892641d0383875',9,4046,'2228412399','2023-03-22 15:49:33',25542),(31,'Gibran Antonio Garcia Xicohtencatl','Gibran','sistemas@alcomex.mx','342ef382d282dceaac9bfc51ebd7bae6',2505,4046,'2223245928','2023-03-23 16:45:16',25542),(38,'Jenny Ortega Garcia','Jenny','jennyortega@gmail.com','25d55ad283aa400af464c76d713c07ad',2505,5267,'5566778844','2023-03-27 20:01:07',31448),(40,'Uriel Isai Hernández Hernández ','UriCss','uricss@gmail.com','25d55ad283aa400af464c76d713c07ad',2505,5267,'2491739802','2023-03-28 20:12:27',31448),(50,'Ajax AjaxJquery','Ajax','jquery@gmail.com','',3,9947,' 554657689','2023-03-31 15:41:03',31448);
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-03 19:00:00
