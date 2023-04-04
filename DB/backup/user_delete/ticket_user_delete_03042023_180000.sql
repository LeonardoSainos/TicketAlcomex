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

-- Dump completed on 2023-04-03 18:00:00
