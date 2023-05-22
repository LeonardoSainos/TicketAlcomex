-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ticket
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
  KEY `FK_EST2` (`idEstatus`),
  KEY `FK_ROL` (`id_rol`),
  KEY `FK_CLIENTEDEPA` (`id_departamento`),
  CONSTRAINT `FK_CLIENTEDEPA` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`idDepartamento`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_EST2` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION,
  CONSTRAINT `FK_ROL` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'LEONARDO SAINOS PÉREZ','LeonardoSainos','tecnologias.alcomex@gmail.com','5e8667a439c68f5145dd2fcbecf02209',2526,4046,'2228412398','2023-02-21 15:43:55',31448),(29,'EDSON MONTIEL ALVAREZ','EdsonRH','alcomex2022@gmail.com','e205a48b5fdc022bf2f202897c243f07',2524,5267,'2221917939','2023-03-14 19:26:32',31448),(31,'GIBRAN ANTONIO GARCIA XICOHTENCATL','Gibran','sistemas@alcomex.mx','bbb03f029ea33822f0e424b81a7909fa',2526,4046,'2223245928','2023-03-23 16:45:16',31448),(59,'ANA PATRICIA  ARROYO VIEYRA','Patty','anapatriciaarroyo7@gmail.com','1634b5ea562876a8aa28812b2c9961bb',2531,5267,'221649581','2023-04-14 16:07:11',31448),(64,'JOSEPH MISAEL SALDAÑA LEYVA','joseph','seguridadpatrimonial@alcomex.mx','2226cb2bd3f2573223d8dd5f90a77364',2534,5267,'2225999552','2023-04-21 18:01:48',31448),(65,'ANA LAURA TREJO MORENO ','AnaLau2023','ana.trejo@alcomex.mx','5e3c061fc9f7d18f0bc9b1166823fa7a',2536,5267,'2221804412','2023-04-21 18:02:20',25542),(66,'ALMA HUITZIL ORTIZ','Alma','enthemar@gmail.com','3ed7d067901834e62d1b4ddda804a3d7',2531,5267,'2227279900','2023-04-21 18:11:14',31448),(67,'ARACELI JUAREZ HERNANDEZ','JUAREZARACELI','transporte-logistica@alcomex.mx','00485c72e98b4556153bfcc6a29c55e3',2540,5267,'2211053781','2023-04-21 18:11:25',31448),(68,'JESSICA MORALES ALARCON','moralesjessica','facturacion@alcomex.mx','7aa5754554899c4e61a731d2d3913bb5',2539,5267,'2221521783','2023-04-21 18:12:32',31448),(69,'ALEJANDRO DAMAZO','AlejandroD','alejandro.damazo@alcomex.mx','e955a29b180129018367c8bc8c988b4d',2532,5267,'2223342375','2023-04-21 18:18:59',31448),(70,'JOSUE GONZALEZ HUERTA','Monitoreo','monitoreo@alcomex.mx','2dac9d087e6e970067c81c3edd20903c',2534,5267,'2228673417','2023-04-21 18:25:08',31448),(71,'ALEJANDRA VERÓNICA TÉLLEZ SÁNCHEZ','ALEJANDRA','transporte-logistica@alcomex.mx','30dcdfabd738069d5f0a06362ed71843',2535,5267,'2228131844','2023-04-21 18:26:02',31448),(72,'MIRIAM LIZBETH ESPINOSA HERNANDEZ','MiriamEspinosa','lunaazul1688@gmail.com','fb6293a9bc14a34d1388a4988998e75d',2536,5267,'2225543721','2023-04-21 18:40:29',31448),(73,'KAREN REYNOSO','Karen','anakaren.reynoso@alcomex.mx','bef8665b78579ea17986c188406d9dc1',2538,5267,'2223345850','2023-04-21 18:44:11',31448),(74,'LUIS MANUEL AMARO VAZQUEZ','manuel','luis.amaro@alcomex.mx','22536308e001c4b6e553c75310836485',2536,5267,'2221542607','2023-04-21 21:22:59',31448),(75,'BRENDA FLORES','BRENDA','monitoreo@alcomex.mx','25f9e794323b453885f5181f1b624d0b',2534,5267,'2228673417','2023-04-22 00:00:31',31448),(76,'CARLOS ALBERTO DIAZ MARTINEZ','CONTADOR','charlydm20@gmail.com','7ed863b3e798b5c0708cab0ffe87c999',2531,5267,'2225496780','2023-04-24 15:54:29',31448),(78,'PRUEBA PRUEBA','Prueba','prueba@gmail.com','5e8667a439c68f5145dd2fcbecf02209',2528,4046,'222232323','2023-04-27 19:25:50',31448),(79,'GISELA HERNANDEZ RAMIREZ','Ghernandez','heriberto.alvarez@alcomex.mx','227808f020c2e11db2c2e203bd3f99e2',2537,5267,'2227075021','2023-04-29 16:42:27',31448);
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

-- Dump completed on 2023-05-04 12:00:02
