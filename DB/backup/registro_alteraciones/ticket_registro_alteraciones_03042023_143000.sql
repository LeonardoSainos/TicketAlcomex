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
) ENGINE=InnoDB AUTO_INCREMENT=502 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_alteraciones`
--

LOCK TABLES `registro_alteraciones` WRITE;
/*!40000 ALTER TABLE `registro_alteraciones` DISABLE KEYS */;
INSERT INTO `registro_alteraciones` VALUES (284,1,'2023-03-25 19:37:35','Eliminar',59,'ticket'),(285,1,'2023-03-25 19:37:41','Eliminar',53,'ticket'),(286,1,'2023-03-27 19:16:56','Actualizar',3,'cliente'),(287,1,'2023-03-27 19:18:46','Actualizar',8,'cliente'),(288,1,'2023-03-27 19:19:20','Actualizar',30,'cliente'),(293,1,'2023-03-27 19:29:17','Actualizar',30,'cliente'),(296,1,'2023-03-27 19:37:54','Insertar',35,'cliente'),(297,1,'2023-03-27 19:55:53','Insertar',36,'cliente'),(298,37,'2023-03-27 19:57:13','Insertar',1,'cliente'),(299,38,'2023-03-27 20:01:07','Insertar',38,'cliente'),(302,1,'2023-03-27 20:06:02','Actualizar',2506,'departamento'),(303,36,'2023-03-27 20:06:51','Actualizar',65,'ticket'),(304,1,'2023-03-27 20:07:11','Eliminar',60,'ticket'),(305,1,'2023-03-27 20:13:35','Insertar',68,'ticket'),(306,1,'2023-03-27 20:14:20','Insertar',2525,'departamento'),(307,1,'2023-03-27 20:58:48','Actualizar',33,'cliente'),(308,0,'2023-03-27 20:58:54','Eliminar',33,'cliente'),(309,0,'2023-03-27 21:02:54','Eliminar',34,'cliente'),(310,1,'2023-03-27 21:03:17','Actualizar',36,'cliente'),(315,0,'2023-03-27 21:05:11','Eliminar',36,'cliente'),(316,1,'2023-03-27 21:07:40','Insertar',39,'cliente'),(369,1,'2023-03-28 20:08:32','Actualizar',2506,'departamento'),(370,0,'2023-03-28 20:10:42','',5,'cliente'),(371,40,'2023-03-28 20:12:27','Insertar',40,'cliente'),(372,0,'2023-03-28 20:21:18','',2506,'departamento'),(373,1,'2023-03-28 20:21:44','Actualizar',2523,'departamento'),(374,0,'2023-03-28 20:23:32','',2523,'departamento'),(375,1,'2023-03-28 20:23:46','Actualizar',2523,'departamento'),(376,1,'2023-03-28 20:38:53','Actualizar',2522,'departamento'),(377,1,'2023-03-28 20:39:01','Actualizar',2522,'departamento'),(378,1,'2023-03-28 20:39:08','Actualizar',2522,'departamento'),(379,1,'2023-03-28 20:41:23','Actualizar',2522,'departamento'),(380,1,'2023-03-28 20:42:24','Actualizar',2522,'departamento'),(381,1,'2023-03-28 20:43:44','Actualizar',2523,'departamento'),(382,1,'2023-03-28 21:29:14','Actualizar',2523,'departamento'),(383,1,'2023-03-28 21:29:19','Actualizar',2523,'departamento'),(384,1,'2023-03-28 21:29:24','Actualizar',2523,'departamento'),(385,1,'2023-03-28 21:32:42','Actualizar',2523,'departamento'),(386,1,'2023-03-28 21:46:38','Actualizar',2506,'departamento'),(387,1,'2023-03-28 21:46:49','Actualizar',2506,'departamento'),(388,1,'2023-03-28 21:47:22','Actualizar',2506,'departamento'),(389,1,'2023-03-28 21:59:42','Actualizar',2506,'departamento'),(390,1,'2023-03-28 22:07:56','Actualizar',2506,'departamento'),(391,1,'2023-03-28 22:12:46','Actualizar',2506,'departamento'),(392,1,'2023-03-28 22:12:57','Actualizar',2506,'departamento'),(393,1,'2023-03-28 22:13:48','Actualizar',2506,'departamento'),(394,1,'2023-03-28 22:14:11','Actualizar',1,'cliente'),(395,1,'2023-03-28 22:14:32','Actualizar',1,'cliente'),(396,1,'2023-03-28 22:17:04','Actualizar',2506,'departamento'),(397,1,'2023-03-28 22:17:14','Actualizar',2506,'departamento'),(398,1,'2023-03-28 22:17:36','Actualizar',1,'cliente'),(399,1,'2023-03-28 22:18:02','Actualizar',1,'cliente'),(400,0,'2023-03-28 22:19:01','',1,'cliente'),(401,1,'2023-03-28 22:31:48','Actualizar',2506,'departamento'),(402,1,'2023-03-28 22:32:12','Actualizar',2506,'departamento'),(403,1,'2023-03-28 22:33:25','Actualizar',2506,'departamento'),(404,1,'2023-03-28 22:35:36','Actualizar',2506,'departamento'),(405,1,'2023-03-28 22:37:29','Actualizar',2506,'departamento'),(406,1,'2023-03-28 22:37:48','Actualizar',2506,'departamento'),(407,1,'2023-03-28 22:40:11','Actualizar',1,'cliente'),(408,1,'2023-03-28 22:40:42','Actualizar',2523,'departamento'),(409,1,'2023-03-28 22:40:53','Actualizar',2522,'departamento'),(410,40,'2023-03-28 22:41:48','Actualizar',40,'cliente'),(411,40,'2023-03-28 22:44:01','Insertar',69,'ticket'),(412,40,'2023-03-28 22:46:57','Insertar',70,'ticket'),(413,40,'2023-03-28 22:47:02','Insertar',71,'ticket'),(414,40,'2023-03-28 22:47:06','Insertar',72,'ticket'),(415,40,'2023-03-28 22:47:09','Insertar',73,'ticket'),(416,40,'2023-03-28 22:47:12','Insertar',74,'ticket'),(417,40,'2023-03-28 22:47:15','Insertar',75,'ticket'),(418,40,'2023-03-28 22:47:18','Insertar',76,'ticket'),(419,40,'2023-03-28 22:47:21','Insertar',77,'ticket'),(420,40,'2023-03-28 22:47:23','Insertar',78,'ticket'),(421,40,'2023-03-28 22:47:27','Insertar',79,'ticket'),(422,40,'2023-03-28 22:47:31','Insertar',80,'ticket'),(423,40,'2023-03-28 22:47:34','Insertar',81,'ticket'),(424,40,'2023-03-28 22:47:37','Insertar',82,'ticket'),(425,40,'2023-03-28 22:47:41','Insertar',83,'ticket'),(426,40,'2023-03-28 22:47:44','Insertar',84,'ticket'),(427,40,'2023-03-28 22:47:47','Insertar',85,'ticket'),(428,40,'2023-03-28 22:47:50','Insertar',86,'ticket'),(429,40,'2023-03-28 22:47:54','Insertar',87,'ticket'),(430,40,'2023-03-28 22:47:58','Insertar',88,'ticket'),(431,40,'2023-03-28 22:48:02','Insertar',89,'ticket'),(432,40,'2023-03-28 22:48:06','Insertar',90,'ticket'),(433,40,'2023-03-28 22:48:10','Insertar',91,'ticket'),(434,40,'2023-03-28 22:48:13','Insertar',92,'ticket'),(435,40,'2023-03-28 22:48:16','Insertar',93,'ticket'),(436,40,'2023-03-28 22:48:21','Insertar',94,'ticket'),(437,40,'2023-03-28 22:48:58','Insertar',95,'ticket'),(438,40,'2023-03-28 22:49:03','Insertar',96,'ticket'),(439,40,'2023-03-28 22:49:06','Insertar',97,'ticket'),(440,40,'2023-03-28 22:49:10','Insertar',98,'ticket'),(441,40,'2023-03-28 22:49:13','Insertar',99,'ticket'),(442,40,'2023-03-28 22:49:17','Insertar',100,'ticket'),(443,40,'2023-03-28 22:49:21','Insertar',101,'ticket'),(444,1,'2023-03-28 22:49:58','Actualizar',2525,'departamento'),(445,1,'2023-03-28 22:50:30','Actualizar',40,'cliente'),(446,40,'2023-03-28 22:52:06','Actualizar',35,'ticket'),(447,0,'2023-03-28 23:00:30','',78,'ticket'),(448,1,'2023-03-28 23:12:11','Actualizar',1,'cliente'),(449,0,'2023-03-28 23:16:06','',1,'cliente'),(451,1,'2023-03-28 23:41:51','Actualizar',9,'departamento'),(453,1,'2023-03-28 23:53:56','Insertar',41,'cliente'),(454,0,'2023-03-29 00:03:11','Eliminar',41,'cliente'),(455,1,'2023-03-29 17:17:54','Insertar',42,'cliente'),(456,1,'2023-03-29 17:18:00','EliminarU',42,'cliente'),(457,1,'2023-03-29 17:18:07','Actualizar',40,'cliente'),(458,1,'2023-03-29 17:21:27','Insertar',43,'cliente'),(459,1,'2023-03-29 17:21:42','EliminarUsua',43,'cliente'),(460,1,'2023-03-29 17:22:37','Insertar',44,'cliente'),(461,1,'2023-03-29 17:24:07','Actualizar',44,'cliente'),(462,1,'2023-03-29 17:24:07','Actualizar',44,'cliente'),(463,1,'2023-03-29 17:24:10','Actualizar',44,'cliente'),(464,1,'2023-03-29 17:29:09','EliminarUsua',44,'cliente'),(465,1,'2023-03-29 17:30:08','Actualizar',7,'cliente'),(466,1,'2023-03-29 17:30:18','Actualizar',7,'cliente'),(467,1,'2023-03-29 17:30:28','Actualizar',29,'cliente'),(468,1,'2023-03-29 17:30:28','Actualizar',7,'cliente'),(469,1,'2023-03-29 17:30:33','Actualizar',29,'cliente'),(470,1,'2023-03-29 17:30:33','Actualizar',7,'cliente'),(471,1,'2023-03-29 17:32:26','Actualizar',40,'cliente'),(472,1,'2023-03-29 17:45:13','Insertar',45,'cliente'),(473,1,'2023-03-29 17:45:25','EliminarU',45,'cliente'),(474,1,'2023-03-29 17:46:52','Insertar',46,'cliente'),(477,1,'2023-03-29 17:47:23','Actualizar',35,'cliente'),(478,1,'2023-03-29 17:47:33','Actualizar',46,'cliente'),(479,1,'2023-03-29 17:47:48','EliminarU',65,'ticket'),(480,1,'2023-03-29 17:47:48','EliminarU',35,'cliente'),(481,1,'2023-03-29 17:47:48','EliminarU',46,'cliente'),(482,1,'2023-03-29 17:50:07','Insertar',47,'cliente'),(483,1,'2023-03-29 17:50:43','Insertar',48,'cliente'),(484,1,'2023-03-29 17:50:57','EliminarU',48,'cliente'),(485,1,'2023-03-29 17:50:57','EliminarU',47,'cliente'),(486,1,'2023-03-29 23:36:34','Actualizar',1,'cliente'),(487,0,'2023-03-30 15:35:23','',1,'cliente'),(488,1,'2023-03-30 16:09:22','Actualizar',31,'cliente'),(489,1,'2023-03-31 15:40:24','Insertar',49,'cliente'),(490,1,'2023-03-31 15:40:37','EliminarU',49,'cliente'),(491,1,'2023-03-31 15:41:03','Insertar',50,'cliente'),(492,1,'2023-03-31 18:37:04','Actualizar',1,'cliente'),(493,1,'2023-03-31 23:07:10','Actualizar',1,'cliente'),(494,1,'2023-04-01 17:28:44','Insertar',51,'cliente'),(495,1,'2023-04-01 17:29:00','EliminarU',51,'cliente'),(496,1,'2023-04-01 17:57:12','Eliminar',65,'ticket'),(497,1,'2023-04-01 17:58:10','Actualizar',38,'cliente'),(498,1,'2023-04-01 18:36:16','Actualizar',1,'cliente'),(499,1,'2023-04-03 18:24:29','Actualizar',50,'cliente'),(500,1,'2023-04-03 18:28:23','Eliminar',34,'ticket'),(501,1,'2023-04-03 19:36:54','Actualizar',1,'cliente');
/*!40000 ALTER TABLE `registro_alteraciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-03 14:30:00
