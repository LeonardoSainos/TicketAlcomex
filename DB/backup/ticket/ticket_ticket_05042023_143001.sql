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
INSERT INTO `ticket` VALUES (28,'2023-03-08 22:31:19','TK82N11','asas','asas','listo',1,3,94576,8,'2023-03-10 01:17:39'),(30,'2023-03-08 22:31:19','TK95N13','asa','asas','',1,3,94574,8,'2023-03-08 04:16:05'),(31,'2023-03-08 22:31:19','TK68N14','asas','sasa','',1,3,94574,8,'2023-03-08 04:16:07'),(32,'2023-03-08 22:31:19','TK19N15','asas','asas','',1,3,94574,8,'2023-03-08 04:16:10'),(33,'2023-03-08 22:31:19','TK40N16','asa','saasa','',1,3,94574,8,'2023-03-08 04:16:12'),(39,'2023-03-08 22:31:19','TK95N22','asasa','asasas','',1,3,94574,8,'2023-03-08 04:16:29'),(40,'2023-03-08 22:31:19','TK44N23','asasa','asasa','',1,3,94574,8,'2023-03-08 04:16:32'),(41,'2023-03-08 22:31:19','TK05N24','asasa','asas','',1,3,94574,8,'2023-03-08 04:16:35'),(42,'2023-03-08 22:31:19','TK72N25','asasa','asasas','',1,3,94574,8,'2023-03-08 04:16:38'),(43,'2023-03-08 22:31:19','TK72N26','asasa','asasas','',1,3,94574,8,'2023-03-08 04:16:42'),(45,'2023-03-08 22:31:19','TK28N28','asasas','asasa','',1,3,94574,8,'2023-03-08 04:16:48'),(46,'2023-03-08 22:31:19','TK66N29','asasa','saasas','',1,3,94574,8,'2023-03-08 04:16:50'),(47,'2023-03-08 22:31:19','TK80N30','asasas','asasa','',1,3,94574,8,'2023-03-08 04:16:53'),(48,'2023-03-08 22:31:19','TK95N31','asasa','sasasa','',1,3,94574,8,'2023-03-08 04:16:56'),(49,'2023-03-08 22:31:19','TK99N32','asasas','asasas','',1,3,94574,8,'2023-03-08 04:16:59'),(50,'2023-03-08 22:31:19','TK26N33','asas','asasas','',1,3,94574,8,'2023-03-08 04:17:04'),(51,'2023-03-08 22:31:19','TK23N34','asasas','asasa','',1,3,94574,8,'2023-03-08 04:17:07'),(52,'2023-03-08 22:31:19','TK85N35','asasa','asas','',1,3,94574,8,'2023-03-08 04:17:09'),(55,'2023-03-08 22:31:19','TK40N38','asas','asasas','',1,3,94574,8,'2023-03-08 04:17:18'),(56,'2023-03-08 22:31:19','TK18N39','asasa','asasa','',1,3,94574,8,'2023-03-08 04:17:20'),(57,'2023-03-08 22:31:19','TK16N40','asasa','asasas','',1,3,94574,8,'2023-03-08 04:17:22'),(58,'2023-03-08 22:31:19','TK53N41','asas','asasa','',1,3,94574,8,'2023-03-08 04:17:25'),(61,'2023-03-08 22:31:19','TK25N44','asa','asa','',1,3,94574,12,'2023-03-08 04:34:39'),(62,'2023-03-08 22:31:19','TK27N45','asa','asa','',1,3,94574,12,'2023-03-08 04:34:43'),(63,'2023-03-08 22:31:19','TK38N46','aa','ASAS','',1,3,94574,8,'2023-03-08 04:34:48'),(67,'2023-03-27 20:08:23','TK70N29','Prueba','Procedimientos almacenados','',1,3,94574,3,NULL),(68,'2023-03-27 20:13:35','TK49N30','Prueba de base de da','Prueba Triggers','',1,3,94574,29,NULL),(69,'2023-03-28 22:44:01','TK69N31','Fotos infantiles','Mañana iré a dejar mis fotitos','',40,3,94574,3,NULL),(70,'2023-03-28 22:46:57','TK09N32','Tarea Jenny','ada','',40,3,94574,5,NULL),(71,'2023-03-28 22:47:02','TK51N33','1','1','',40,3,94574,3,NULL),(72,'2023-03-28 22:47:06','TK32N34','2','2','',40,3,94574,1,NULL),(73,'2023-03-28 22:47:09','TK75N35','3','3','',40,3,94574,1,NULL),(74,'2023-03-28 22:47:12','TK89N36','4','4','',40,3,94574,1,NULL),(75,'2023-03-28 22:47:15','TK14N37','5','5','',40,3,94574,3,NULL),(76,'2023-03-28 22:47:18','TK60N38','6','6','',40,3,94574,3,NULL),(77,'2023-03-28 22:47:21','TK84N39','7','7','',40,3,94574,3,NULL),(78,'2023-03-28 22:47:23','TK04N40','8','8','',40,3,94574,1,NULL),(79,'2023-03-28 22:47:27','TK64N41','9','9','',40,3,94574,3,NULL),(80,'2023-03-28 22:47:31','TK13N42','10','10','',40,3,94574,3,NULL),(81,'2023-03-28 22:47:34','TK54N43','11','11','',40,3,94574,3,NULL),(82,'2023-03-28 22:47:37','TK60N44','12','12','',40,3,94574,3,NULL),(83,'2023-03-28 22:47:41','TK22N45','13','13','',40,3,94574,3,NULL),(84,'2023-03-28 22:47:44','TK30N46','14','14','',40,3,94574,3,NULL),(85,'2023-03-28 22:47:47','TK20N47','15','15','',40,3,94574,3,NULL),(86,'2023-03-28 22:47:50','TK79N48','16','16','',40,3,94574,3,NULL),(87,'2023-03-28 22:47:54','TK93N49','17','17','',40,3,94574,3,NULL),(88,'2023-03-28 22:47:58','TK58N50','18','18','',40,3,94574,3,NULL),(89,'2023-03-28 22:48:02','TK74N51','19','19','',40,3,94574,3,NULL),(90,'2023-03-28 22:48:06','TK07N52','20','20','',40,3,94574,3,NULL),(91,'2023-03-28 22:48:10','TK55N53','21','21','',40,3,94574,5,NULL),(92,'2023-03-28 22:48:13','TK26N54','22','22','',40,3,94574,5,NULL),(93,'2023-03-28 22:48:16','TK50N55','23','23','',40,3,94574,5,NULL),(94,'2023-03-28 22:48:21','TK08N56','24','24','',40,3,94574,5,NULL),(95,'2023-03-28 22:48:58','TK01N57','25','25','',40,3,94574,5,NULL),(96,'2023-03-28 22:49:03','TK04N58','26','26','',40,3,94574,5,NULL),(97,'2023-03-28 22:49:06','TK72N59','27','27','',40,3,94574,5,NULL),(98,'2023-03-28 22:49:10','TK53N60','28','28','',40,3,94574,5,NULL),(99,'2023-03-28 22:49:13','TK81N61','29','29','',40,3,94574,5,NULL),(100,'2023-03-28 22:49:17','TK83N62','30','30','',40,3,94574,5,NULL),(101,'2023-03-28 22:49:21','TK68N63','31','31','',40,3,94574,5,NULL);
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-05 14:30:01
