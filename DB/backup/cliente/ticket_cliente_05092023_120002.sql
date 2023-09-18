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
  `clave` varchar(120) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `telefono_celular` varchar(10) DEFAULT NULL,
  `Fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `idEstatus` int(11) NOT NULL,
  `anydesk` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `FK_EST2` (`idEstatus`),
  KEY `FK_ROL` (`id_rol`),
  KEY `FK_CLIENTEDEPA` (`id_departamento`),
  CONSTRAINT `FK_CLIENTEDEPA` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`idDepartamento`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_EST2` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION,
  CONSTRAINT `FK_ROL` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'LEONARDO SAINOS PÉREZ','LeonardoSainos','tecnologias.alcomex@gmail.com','5e8667a439c68f5145dd2fcbecf02209',2526,4046,'2228412398','2023-02-21 15:43:55',31448,1489642851),(29,'EDSON MONTIEL ALVAREZ','EdsonRH','rhumanos@alcomex.mx','e205a48b5fdc022bf2f202897c243f07',2524,5267,'2221917939','2023-03-14 19:26:32',31448,897345781),(31,'GIBRAN ANTONIO GARCIA XICOHTENCATL','Gibran','sistemas@alcomex.mx','cc3173f9b9818e7507e07c83f7880381',2526,4046,'2223245928','2023-03-23 16:45:16',31448,191636151),(59,'ANA PATRICIA  ARROYO VIEYRA','Patty','anapatriciaarroyo7@gmail.com','1634b5ea562876a8aa28812b2c9961bb',2531,5267,'221649581','2023-04-14 16:07:11',31448,793592225),(64,'JOSEPH MISAEL SALDAÑA LEYVA','joseph','seguridadpatrimonial@alcomex.mxx','2226cb2bd3f2573223d8dd5f90a77364',2534,5267,'2225999552','2023-04-21 18:01:48',25542,720581229),(65,'ANA LAURA TREJO MORENO ','AnaLau2023','ana.trejo@alcomex.mx','c7906231199caf874f6bac22a8494dca',2536,5267,'2221804412','2023-04-21 18:02:20',31448,1016598060),(66,'ALMA HUITZIL ORTIZ','Alma','enthemar@gmail.com','01c961e670b09d58480617cd55e00864',2531,5267,'2227279900','2023-04-21 18:11:14',25542,723604941),(67,'ARACELI JUAREZ HERNANDEZ','JUAREZARACELI','transporte-logistica@alcomex.mx','00485c72e98b4556153bfcc6a29c55e3',2540,5267,'2211053781','2023-04-21 18:11:25',31448,297666162),(68,'JESSICA MORALES ALARCON','moralesjessica','facturacion@alcomex.mx','5d3e0bfdfbc6537e90c315fd9050b7b6',2539,5267,'2221521783','2023-04-21 18:12:32',31448,180064551),(69,'ALEJANDRO DAMAZO','AlejandroD','alejandro.damazo@alcomex.mx','e955a29b180129018367c8bc8c988b4d',2532,5267,'2223342375','2023-04-21 18:18:59',31448,894125622),(70,'JOSUE GONZALEZ HUERTA','Monitoreo','monitoreo@alcomex.mx','2dac9d087e6e970067c81c3edd20903c',2534,5267,'2228673417','2023-04-21 18:25:08',25542,1037551026),(71,'ALEJANDRA VERÓNICA TÉLLEZ SÁNCHEZ','ALEJANDRA','transporte-logistica@alcomex.mx','30dcdfabd738069d5f0a06362ed71843',2535,5267,'2228131844','2023-04-21 18:26:02',31448,853770298),(72,'MIRIAM LIZBETH ESPINOSA HERNANDEZ','MiriamEspinosa','lunaazul1688@gmail.com','fb6293a9bc14a34d1388a4988998e75d',2536,5267,'2225543721','2023-04-21 18:40:29',31448,348503780),(73,'KAREN REYNOSO','Karen','anakaren.reynoso@alcomex.mx','bef8665b78579ea17986c188406d9dc1',2538,5267,'2223345850','2023-04-21 18:44:11',25542,331567128),(74,'LUIS MANUEL AMARO VAZQUEZ','manuel','luis.amaro@alcomex.mx','22536308e001c4b6e553c75310836485',2536,5267,'2221542607','2023-04-21 21:22:59',31448,509775324),(75,'BRENDA FLORES','BRENDA','monitoreo@alcomex.mx','25f9e794323b453885f5181f1b624d0b',2534,5267,'2228673417','2023-04-22 00:00:31',31448,1037551026),(76,'CARLOS ALBERTO DIAZ MARTINEZ','CONTADOR','charlydm20@gmail.com','7ed863b3e798b5c0708cab0ffe87c999',2531,5267,'2225496780','2023-04-24 15:54:29',31448,461346563),(78,'PRUEBA PRUEBA','Prueba','prueba@gmail.com','5e8667a439c68f5145dd2fcbecf02209',2528,9947,'222232323','2023-04-27 19:25:50',31448,222232323),(79,'GISELA HERNANDEZ RAMIREZ','Ghernandez','heriberto.alvarez@alcomex.mx','227808f020c2e11db2c2e203bd3f99e2',2537,5267,'2227075021','2023-04-29 16:42:27',25542,599295171),(80,'JAVIER YOVANI CARCAMO PEREZ ','Yovani','javieryovani.carcamo@gmail.com','e488ba3443fada2b7efcf5aec0dda9f8',2533,5267,'2221107043','2023-05-05 18:24:34',31448,997410199),(81,'KARLA FLORES CONDE','KarlaFC','asistentelogistico.alcomex@gmail.com','136dc48d8b1434a1b2fe5239e670f843',2536,5267,'2221804412','2023-05-09 23:46:02',25542,101659806),(82,'LETICIA JUÁREZ ROMERO','Lety','ir126406@gmail.com','bbd80360a419719fb305d8f88af957d9',2534,5267,'2211344957','2023-05-11 17:25:15',25542,742045693),(83,'JESÚS PÉREZ BRINDIS','Jpb','jesus.transporte@alcomex.mx','198998936df6b9865c0f88ef6a6ec180',2537,5267,'2211197119','2023-05-29 18:54:48',31448,1083375969),(84,'ALEXANDRA GARCÍA','alexa','auxiliarlogistico.alcomex@gmail.com','4203360c987097ddf18a6f97868690fb',2541,5267,'2223106220','2023-05-30 18:38:53',31448,682803391),(85,'ABDIEL CARVAJAL','abdiel','seguridadpatrimonial@alcomex.mx','075aebcab43880b8e968a53c28d0faa0',2534,5267,'222599955','2023-07-27 15:38:19',31448,720581229);
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

-- Dump completed on 2023-09-05 12:00:02
