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
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `serie` varchar(100) NOT NULL,
  `asunto` varchar(120) NOT NULL,
  `mensaje` varchar(500) NOT NULL,
  `solucion` varchar(500) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `id_atiende` int(11) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto` varchar(256) DEFAULT NULL,
  `respuestafoto` varchar(256) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (123,'2023-04-21 15:55:37','TK34N5','APOYO CON LICENCIA DE SOFTWARE','Tengo problemas con la licencia de Adobe PS. Me marca que está caducado y no me deja trabajar.\r\n\r\nGracias.','Vale en un momento eliminamos esa versión para instalar otra',29,2524,94576,31,'2023-04-21 17:18:39','Fotos/PROBLEMA LICENCIA PS.jpeg',NULL),(124,'2023-04-21 15:58:01','TK35N6','NO ME PERMITE IMPRIMIR A LA CANON G4010','Buen día.\r\n\r\nQuiero imprimir documentos a color y me arroja el mensaje de que la impresora NO está conectada, siendo que sí está prendida y otros compañeros Sí pueden imprimir.\r\n\r\nGracias.','Ok lo reviso',29,2524,94576,31,'2023-04-21 16:40:28','Fotos/error impresion.PNG',NULL),(125,'2023-04-21 19:10:10','TK32N3','unidad T-35 ','la unidad no posiciona se le llama y si regresa mensaje y ubicacion pero en la plataforma de alcomex no posiciona nada sigue en amarillo','SE VERIFICA INFORMACION DE CONFIGURACION DE GPS EN PLATAFORMA Y SE DETECTA IMEI ERRONEA; APOYO  BRINDADO POR JOSEPH SALDAÑA',64,2526,94576,31,'2023-04-21 23:15:30','Fotos/ff6c1f87-7164-4586-b08b-8ee15ca2e56c.jpg',NULL),(126,'2023-04-21 23:34:42','TK39N4','hasdl jc','dvb sdt','resolbido',71,2526,94576,31,'2023-04-21 23:35:44','Fotos/error.jp',NULL),(127,'2023-04-22 20:00:54','TK94N5','FALLA CORREO ','No carga correo cuando lo abro desde el buscador o aplicación y tambien fallas en recepción de correo a mis clientes.','Listo. Problema de contraseñas y versión de office',65,2526,94576,31,'2023-04-25 22:57:31','Fotos/error.jp',NULL),(128,'2023-04-24 15:55:37','TK95N6','camioneta Ct-19','buen dia equipo solicito de su apoyo para que la unida ct-19 no posiciona y carga hoy al medio dia gracias y buen dia.','Se revisa unidad, se envian comandos via telefonica y el dispositivo comienza a posicionar, se sospecha que la falla se debe a falta de bateria en la unidad.',64,2526,94576,31,'2023-04-27 17:29:31','Fotos/Captura de pantalla 2023-04-24 095509.png','Respuesta/error.jp'),(129,'2023-04-24 15:56:43','TK08N7','Facturas en mal estado','Las facturas presentan errores en el llenado.','Listo',76,2535,94576,67,'2023-04-24 23:51:40','Fotos/error.jp',NULL),(130,'2023-04-24 16:45:07','TK31N8','gps saveiro','buen día equipo solicito de su apoyo para la colocación del gps de la camioneta saveiro VW del Heriberto Alvarez quedo atento sobre este porceso buena tarde.','SE INSTALA Y CONFIGURA GPS CON PARO DE MOTOR A DISTANCIA CON IMEI 868166052418787 Y NIMERO SIM: 2212482408 PARA SAVEIRO ADMINISTRATIVA',64,2526,94576,31,'2023-04-24 17:28:03','Fotos/error.jp',NULL),(131,'2023-04-24 16:54:58','TK57N9','Correo electrónico ','No recibo correos, en automático mi correo rechaza los ingresos a bandeja','Resuelto doc, problema de contraseñas y versión de Office',74,2526,94576,31,'2023-04-25 22:56:15','Fotos/WhatsApp Image 2023-04-24 at 10.23.39 AM.jpeg',NULL),(132,'2023-04-24 17:43:41','TK84N10','Revision de Memoria.','La memoria la coloque en la cpiadora Brother, al momento de volver a abrirla en mi computadora me sale la siguiente imagen.','En revisión',69,2526,94575,78,'2023-05-02 23:31:01','Fotos/Captura de pantalla (8).png','respuesta/64519d294a9160.02933294.png'),(133,'2023-04-24 22:59:40','TK09N11','gps saveiro mariano','buena tarde equipo solicito de su apoyo para la colocacion del gps a la camioneta saveiro que esta asignada al señor mariano. quedo atento a cualquier comenmtario sobre la instalacion del equipo buena tarde.','Listo, gps instalado. Para cualquier situación el número que queda registrado es 868166052410958 y el número de teléfono  es 2223487962',64,2526,94576,1,'2023-04-24 23:50:02','Fotos/error.jp',NULL),(134,'2023-04-25 18:50:44','TK23N12','team wiber ','no restablece la coneccion de su apoyo por favor buena tarde. ','Listo, conexión restablecida',64,2526,94576,1,'2023-04-27 18:12:02','Fotos/Captura de pantalla 2023-04-24 095509.png','respuesta/error.jpg'),(135,'2023-04-25 18:55:15','TK32N13','ANYDESK',' NO PERMITE CONECTAR UN SERVIDOR ','Gracias por el aviso',75,2526,94576,1,'2023-04-25 19:08:39','Fotos/X.PNG',NULL),(136,'2023-04-25 19:59:50','TK44N14','Carpetas Compartidas','No puedo acceder a las carpetas compartidas','Se restablece la conexión de Switch para  las IP',59,2526,94576,1,'2023-04-25 20:02:14','Fotos/error.jp',NULL),(137,'2023-04-25 21:59:47','TK99N15','unidad T-19','pido de su apoyo para verificar los motivos por que la unidad t-19 no esta posicionando quedo atento al seguimiento de la unidad.','Ya esta posicionando, el motivo de que no posiciona es por que se encontraba en zona con baja cobertura',64,2526,94576,31,'2023-04-27 17:26:20','Fotos/Captura de pantalla 2023-04-25 155801.png',NULL),(138,'2023-04-26 12:50:48','TK40N16','plataforma','la mayoria de las unidades estan en amarillo','Ya quedó',75,2526,94576,1,'2023-04-26 15:37:12','Fotos/error.jp',NULL),(139,'2023-04-26 17:03:53','TK66N17','vídeo cámaras','solicito de su apoyo solo para poder  visualizar las camaras en el turno del monitorista josue gonzalez huerta, del dia 25 al 26 de abril de 2023.','se cita en el site para revisar camaras directamente del grabador',64,2526,94576,31,'2023-04-26 22:22:41','Fotos/error.jp',NULL),(140,'2023-04-26 17:51:03','TK61N18','instalacion de Whatsapp web.','no me permite abrir whatsapp, con el codigo  QR','Se hace actualizaciones de la app por playstore y se borra la memoria cache y comienza a funcionar normal.',72,2526,94576,1,'2023-04-26 18:21:18','Fotos/error.jp',NULL),(141,'2023-04-26 18:04:11','TK93N19','excel','no me permite hacer anotaciones, ni anexar comentarios en una celda en excel.','Para la solución se activa la licencia de office y se hacen actualizaciones para algunas opciones de excel como insertar comentarios',72,2526,94576,1,'2023-04-26 18:23:15','Fotos/error.jp',NULL),(142,'2023-04-26 18:06:14','TK63N20','Ruido en mi CPU','es incomodo , no deja de sonar y me estresa','Se detecta la falla y se realiza cambio de cooler y de case de disco duro, tambien se reajusta disco duro',72,2526,94576,31,'2023-04-26 19:45:53','Fotos/error.jp',NULL),(143,'2023-04-26 19:17:38','TK01N21','team wiber','pido de su apoyo ya que team wiber no podemos acceder para correr el server.\r\nquedo atento buena tarde.','Se revisa la condición de conectividad y se detecta la falla, se da soporte via anydesk, y se colocan como favoritos los accesos a server 1 y server 2',64,2526,94576,31,'2023-04-26 20:11:21','Fotos/Captura de pantalla 2023-04-26 131548.png',NULL),(144,'2023-04-26 23:26:09','TK56N22','IMPRESORA','ME PODRIAN A POYAR A ANEXAR LAS IMPRESONAS A LA COMPU, PARA PODER IMPRIMIR','Se agregaron impresoras canon G4010 y Brother',72,2526,94576,1,'2023-04-26 23:54:01','Fotos/error.jp',NULL),(145,'2023-04-27 16:12:42','TK87N23','instalacion de Whatsapp web.','NO ME PERMITE ABRIR APLICACION . ','Resuelto',72,2526,94576,1,'2023-04-27 18:18:29','Fotos/error.jp','respuesta/error.jpg'),(147,'2023-04-27 19:45:07','TK82N25','unidad R-21','pido de su apoyo para verificar que la unidad no esta posicionando en la plataforma de alcomex. Quedo atento de cualquier imformacion buena tarde.','Posiciona de manera normal',64,2526,94576,1,'2023-04-27 23:36:35','foto/Captura de pantalla 2023-04-27 134310.png',''),(148,'2023-04-27 20:08:35','TK64N26','INSTALACIÓN DE IMPRESORA ','Buen día Ing. \r\nMe apoyas instalando la impresora a la computadora del contador para que realice la impresión a color que necesita. \r\nGracias. ','Instalado va',59,2526,94576,1,'2023-04-27 20:50:49','','respuesta/Captura de pantalla 2023-04-27 141107.png'),(149,'2023-04-28 18:37:33','TK98N26','garrafones','Me pueden apoyar a subir dos garrafones de agua... uno, a cocina.. por favor','RESOLBIDO',72,2526,94576,31,'2023-04-28 18:43:49','',''),(150,'2023-04-29 16:44:32','TK76N27','Problemas con excel','No podía utilizar copiar y pegar ','SE REVISA ESTATUS DE LICENCIA OFFICE Y ESTABA VENCIDA; SE REACTIVA MEDIANTE KMSPICO',79,2526,94576,1,'2023-04-29 18:16:09','',''),(151,'2023-04-29 17:09:12','TK96N28','Acceso a carpeta','Se requiere el acceso a la carpeta de viajes \r\npor favor','SE ACTUALIZAN PERMISOS Y DIRECTIVAS DE CARPETA COMPARTIDA Y SE OTORGA ACCESO A CARPETA SOLICITADA',73,2526,94576,1,'2023-05-02 15:46:28','',''),(154,'2023-04-29 18:16:29','TK19N31','instalacion de Carpeta compartida','NO TENGO LA CARPETA DE ANDREA Y LA OCUPO PARA SUBIR LAS COMPROBACIONES DE GASOLINA\r\n','Resuelto, asignación de permisos a carpeta solicitada',72,2526,94576,1,'2023-04-29 19:26:31','','respuesta/Captura de pantalla 2023-04-29 132504.png'),(155,'2023-04-29 18:44:42','TK23N30','WHATSSAP','POR FAVOR NO SE ENVIA UN DOC. EN WHATSSAP WEB\r\n','Resuelto',72,2526,94576,1,'2023-04-29 19:19:21','',''),(156,'2023-05-02 17:25:46','TK88N31','facturas','Buen día, Ana. \nSolicito los folios de la transferencia, del fecha 21 DE MARZO, por un monto de $29,367.00. \nAdjunto tabla como referencia, para que no dupliquen los folios \n','',59,2538,94576,73,'2023-05-04 23:05:32','Fotos/EL REY .jpg',''),(157,'2023-05-02 17:29:04','TK63N32','facturas2','Buen día, Ana. \r\nSolicito los folios de la transferencia hecha el día 28/03/2023\r\npor: $27,487.50.  a MÁS QUE LITRO \r\nAdjunto imagen como referencia. ','',59,2538,94576,73,'2023-05-04 23:05:11','Fotos/MAS QUE LITRO .jpg',''),(158,'2023-05-02 17:33:05','TK46N33','CARPETAS','SE TRABO... ',' SE REVISA EXPLORADOR DE ARCHIVOS Y SE REINICIA, SE RESUELVE AL MOMENTO',72,2526,94576,31,'2023-05-02 19:21:27','','respuesta/Captura de pantalla 2023-05-02 132118.png'),(162,'2023-05-03 15:42:31','TK58N34','instalacion de Correo ','por favor me apoyan con la instalacion del Correo que tenia la compañera Laura, en la maquina que ocupo.','SE INSTALA Y CONFIGURA EN EL EQUIPO DE MIRIAM ESPINOZA LA CUENTA DE ANA.TREJO@ALCOMEX.MX',72,2526,94576,31,'2023-05-03 15:59:26','',''),(163,'2023-05-03 18:44:18','TK99N35','servidor 2','no nos deja anydesck ingrasar para correr el servidor 2 solicito de su apoyo gracias y buena tarde','Se restablece conexión a Internet vía anydesk y team viewer',64,2526,94576,31,'2023-05-03 18:49:33','','respuesta/6452acbd95f895.89083519.jpg'),(164,'2023-05-04 17:49:18','TK58N36','MANTENIMIENTO DE IMPRESORAS','TENGO DETALLE CON LA IMPRESORA DE COLOR, LAS IMPRESIONES NO SON CLARAS Y LAS COPIAS YA NO SE VEN BIEN AL IGUAL QUE LA IMPRESORA BROTHER. POR FAVOR.','Se revisa, estamos en espera de compra de consumibles',67,2526,94576,31,'2023-05-04 19:03:43','',''),(165,'2023-05-04 18:15:46','TK21N37','Impresora no imprime','Dejo de imprimir, solo me saco una sola impresion, pero ya al querer hacer mas ya no impimio la Brother','Resuelto, gracias por su reporte ',69,2526,94576,1,'2023-05-04 19:02:08','',''),(166,'2023-05-05 20:38:25','TK08N38','instacion de aplicacion','me apoyan a intalar una aplicacion en el movil para poder ver.. km de viajes. ','La plataforma no cuenta con una app móvil, pero se procede a instalar una extensión de la app-',72,2526,94576,1,'2023-05-05 21:38:13','',''),(167,'2023-05-06 16:47:19','TK51N39','unidad t28','DE SU APOYO YA QUE LA UNIDAD t-28 NO ESTA POSICIONANDO EN LA PLATAFORMA DE ALCOMEX, VALIDAR EL GPS DE LA UNIDAD QUEDO ATENTO DEL SEGUIMIENTO.','',64,2526,94574,31,'2023-05-06 16:47:19','Fotos/64568497cc5b58.75407743.png',NULL);
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

-- Dump completed on 2023-05-06 12:00:01
