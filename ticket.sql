-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2023 a las 18:28:32
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ticket`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Depa` (IN `id` INT)   Begin
SET AUTOCOMMIT=0;
START TRANSACTION;
 
UPDATE cliente SET id_departamento=2505 WHERE id_departamento=id;

UPDATE ticket SET idDepartamento = 2505 WHERE idDepartamento = id;
DELETE FROM enviocorreo WHERE correo = id;
DELETE FROM departamento WHERE idDepartamento=id and idDepartamento <> 2505;
commit;
SET AUTOCOMMIT=1;

ROLLBACK;
SET AUTOCOMMIT=1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarUsuario` (IN `id` INT(11), IN `fechaInicio` VARCHAR(20), IN `fechaFin` VARCHAR(20), IN `pen` INT(11), IN `cre` INT(11), IN `res` INT(11), IN `pro` INT(11))   BEGIN 
Declare admin int DEFAULT 0;
Declare tecnico int DEFAULT 0;
Declare aleatorio int DEFAULT 0;
Declare aleatorio2 int DEFAULT 0;
DECLARE rol int DEFAULT 0;
DECLARE departamento varchar(50);
DECLARE nombreCompleto varchar(60);
DECLARE depaUsuDele int DEFAULT 0;

START TRANSACTION;

SET depaUsuDele = (SELECT id_departamento FROM cliente WHERE id_cliente = id);
SET admin=(SELECT id_cliente FROM cliente where id_cliente <> id and (id_rol=5267 AND id_departamento=depaUsuDele) order by fecha_creacion DESC LIMIT 0,1);
UPDATE departamento SET idJefe=admin WHERE idJefe=id;
SET tecnico =(SELECT COUNT(*) FROM ticket WHERE id_atiende = admin AND fecha BETWEEN  CONCAT(fechaInicio, ' 00:00:00') AND CONCAT(fechaFin,' 23:59:59'));              
 
set rol =(SELECT id_rol FROM cliente WHERE id_cliente = id);
set departamento= (SELECT departamento.nombre FROM cliente INNER JOIN departamento ON departamento.idDepartamento = cliente.id_departamento  WHERE cliente.id_cliente= id);
set nombreCompleto = (SELECT nombre_completo FROM cliente WHERE id_cliente = id); 

IF tecnico <=20 THEN 
    UPDATE ticket SET id_atiende = admin WHERE id_atiende = id  AND fecha BETWEEN CONCAT(fechaInicio, ' 00:00:00') AND CONCAT(fechaFin, ' 23:59:59');
	SET aleatorio =(SELECT id_cliente FROM cliente WHERE id_rol= 4046 ORDER BY email_cliente LIMIT 0,1);
    UPDATE ticket SET id_atiende = aleatorio WHERE id_atiende = id AND  fecha NOT BETWEEN CONCAT(fechaInicio, ' 00:00:00') AND CONCAT(fechaFin, ' 23:59:59');
    DELETE FROM ticket WHERE idUsuario = id or id_atiende = id;
      INSERT INTO user_delete (idUsuario,nombre_completo,id_rol,id_departamento,pendiente,creados,resuelto,proceso) VALUES (id,nombreCompleto,rol,departamento,pen,cre,res,pro);
    DELETE FROM cliente WHERE id_cliente = id;
COMMIT;           
ELSEIF tecnico >=20 THEN 
      set aleatorio =(SELECT id_cliente FROM cliente WHERE id_rol= 4046 ORDER BY email_cliente LIMIT 0,1);
       UPDATE ticket SET id_atiende = aleatorio WHERE id_atiende = id AND  fecha NOT BETWEEN CONCAT(fechaInicio, ' 00:00:00') AND CONCAT(fechaFin, ' 23:59:59');
       SET aleatorio2 = (SELECT id_cliente FROM cliente WHERE id_rol= 4046 AND id_cliente<> aleatorio ORDER BY email_cliente LIMIT 0,1);
       UPDATE ticket SET id_atiende = aleatorio2 WHERE id_atiende = id AND  fecha BETWEEN CONCAT(fechaInicio, ' 00:00:00') AND CONCAT(fechaFin, ' 23:59:59');   
       INSERT INTO user_delete (idUsuario,nombre_completo,id_rol,id_departamento,pendiente,creados,resuelto,proceso) VALUES (id,nombreCompleto,rol,departamento,pen,cre,res,pro);
       DELETE FROM ticket WHERE idUsuario = id or id_atiende = id;
       DELETE FROM cliente WHERE id_cliente = id;
COMMIT;
END IF;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NuevoUsuario` (IN `usuario` INT, IN `acciones` VARCHAR(12), IN `fechad` VARCHAR(20), IN `tablad` VARCHAR(15))   BEGIN
Declare usuarioD int;
Declare temporal int;
set usuarioD = (SELECT  id_cliente FROM cliente WHERE id_cliente = usuario);
UPDATE registro_alteraciones set usuario= usuarioD ,idAlterado= usuarioD,accion = acciones WHERE usuario= 0 OR (fecha = fechad AND tabla=tablad);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_alteracionesCliente` (IN `usuario` INT, IN `acciones` VARCHAR(12), IN `fechad` VARCHAR(20), IN `tablad` VARCHAR(15))   BEGIN
Declare usuarioD int;
set usuarioD = (SELECT  id_cliente FROM cliente WHERE id_cliente = usuario);
UPDATE registro_alteraciones set usuario= usuarioD , accion = acciones WHERE usuario= 0 OR (fecha = fechad AND tabla=tablad);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ticket` (IN `id` INT)   Begin
 
DELETE FROM ticket WHERE id = id;  
  
   
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `nombre_admin` varchar(60) NOT NULL,
  `clave` mediumtext NOT NULL,
  `email_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admin`, `nombre_completo`, `nombre_admin`, `clave`, `email_admin`) VALUES
(1, 'Super Administrador', 'Administrador', '2a2e9a58102784ca18e2605a4e727b5f', 'administrador@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `clave` text NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `telefono_celular` varchar(10) DEFAULT NULL,
  `Fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `idEstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_completo`, `nombre_usuario`, `email_cliente`, `clave`, `id_departamento`, `id_rol`, `telefono_celular`, `Fecha_creacion`, `idEstatus`) VALUES
(1, 'LEONARDO SAINOS PÉREZ', 'LeonardoSainos', 'tecnologias.alcomex@gmail.com', '5e8667a439c68f5145dd2fcbecf02209', 2526, 4046, '2228412398', '2023-02-21 15:43:55', 31448),
(29, 'EDSON MONTIEL ALVAREZ', 'EdsonRH', 'alcomex2022@gmail.com', 'e205a48b5fdc022bf2f202897c243f07', 2524, 5267, '2221917939', '2023-03-14 19:26:32', 31448),
(31, 'GIBRAN ANTONIO GARCIA XICOHTENCATL', 'Gibran', 'sistemas@alcomex.mx', 'b171e652897341d6ac679cd76c1b1a8f', 2526, 4046, '2223245928', '2023-03-23 16:45:16', 31448),
(59, 'ANA PATRICIA  ARROYO VIEYRA', 'Patty', 'anapatriciaarroyo7@gmail.com', '1634b5ea562876a8aa28812b2c9961bb', 2531, 5267, '221649581', '2023-04-14 16:07:11', 31448),
(64, 'JOSEPH MISAEL SALDAÑA LEYVA', 'joseph', 'seguridadpatrimonial@alcomex.mx', '2226cb2bd3f2573223d8dd5f90a77364', 2534, 5267, '2225999552', '2023-04-21 18:01:48', 31448),
(65, 'ANA LAURA TREJO MORENO ', 'AnaLau2023', 'ana.trejo@alcomex.mx', '5e3c061fc9f7d18f0bc9b1166823fa7a', 2536, 5267, '2221804412', '2023-04-21 18:02:20', 31448),
(66, 'ALMA HUITZIL ORTIZ', 'Alma', 'enthemar@gmail.com', '3ed7d067901834e62d1b4ddda804a3d7', 2531, 5267, '2227279900', '2023-04-21 18:11:14', 31448),
(67, 'ARACELI JUAREZ HERNANDEZ', 'JUAREZARACELI', 'transporte-logistica@alcomex.mx', '00485c72e98b4556153bfcc6a29c55e3', 2540, 5267, '2211053781', '2023-04-21 18:11:25', 31448),
(68, 'JESSICA MORALES ALARCON', 'moralesjessica', 'facturacion@alcomex.mx', '7aa5754554899c4e61a731d2d3913bb5', 2539, 5267, '2221521783', '2023-04-21 18:12:32', 31448),
(69, 'ALEJANDRO DAMAZO', 'AlejandroD', 'alejandro.damazo@alcomex.mx', 'e955a29b180129018367c8bc8c988b4d', 2532, 5267, '2223342375', '2023-04-21 18:18:59', 31448),
(70, 'JOSUE GONZALEZ HUERTA', 'Monitoreo', 'monitoreo@alcomex.mx', '2dac9d087e6e970067c81c3edd20903c', 2534, 5267, '2228673417', '2023-04-21 18:25:08', 31448),
(71, 'ALEJANDRA VERÓNICA TÉLLEZ SÁNCHEZ', 'ALEJANDRA', 'transporte-logistica@alcomex.mx', '30dcdfabd738069d5f0a06362ed71843', 2535, 5267, '2228131844', '2023-04-21 18:26:02', 31448),
(72, 'MIRIAM LIZBETH ESPINOSA HERNANDEZ', 'MiriamEspinosa', 'lunaazul1688@gmail.com', 'fb6293a9bc14a34d1388a4988998e75d', 2536, 5267, '2225543721', '2023-04-21 18:40:29', 31448),
(73, 'KAREN REYNOSO', 'Karen', 'anakaren.reynoso@alcomex.mx', '34eca06f123e3fe940a0a8cd92ef986d', 2538, 5267, '2223345850', '2023-04-21 18:44:11', 31448),
(74, 'LUIS MANUEL AMARO VAZQUEZ', 'manuel', 'luis.amaro@alcomex.mx', '22536308e001c4b6e553c75310836485', 2536, 5267, '2221542607', '2023-04-21 21:22:59', 31448),
(75, 'BRENDA FLORES', 'BRENDA', 'monitoreo@alcomex.mx', '25f9e794323b453885f5181f1b624d0b', 2534, 5267, '2228673417', '2023-04-22 00:00:31', 31448),
(76, 'CARLOS ALBERTO DIAZ MARTINEZ', 'CONTADOR', 'charlydm20@gmail.com', '7ed863b3e798b5c0708cab0ffe87c999', 2531, 5267, '2225496780', '2023-04-24 15:54:29', 31448);

--
-- Disparadores `cliente`
--
DELIMITER $$
CREATE TRIGGER `Eliminarregistro_alteracionesUsuarios` BEFORE DELETE ON `cliente` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"Eliminar", OLD.id_cliente,"cliente")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `InsertarCliente` AFTER INSERT ON `cliente` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.id_cliente,"cliente")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registro_alteracion_clientes` AFTER UPDATE ON `cliente` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.id_cliente,"cliente")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `correo` varchar(55) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `idEstatus` int(10) DEFAULT NULL,
  `idJefe` int(10) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombre`, `correo`, `descripcion`, `idEstatus`, `idJefe`, `fecha`) VALUES
(2505, 'Sin departamento', '', '', 31448, NULL, '2023-03-09 18:16:27'),
(2524, 'B1 Recursos Humanos', 'alcomex2022@gmail.com', 'Recursos humanos alcomex', 31448, 29, '2023-03-14 19:29:28'),
(2526, 'B1 Soporte técnico', 'tecnologias.alcomex@gmail.com', 'Soporte técnico de sistemas', 31448, 31, '2023-04-11 22:28:06'),
(2528, 'B2 Taller', 'almacen.alcomex@gmail.com', 'Taller de  tractos San Pablo Xochimehuacan', 31448, 31, '2023-04-14 15:37:45'),
(2529, 'B3 Encierro ', 'Jpbrindis@hotmail.com', 'Encierro principal de tractos', 31448, 31, '2023-04-14 15:40:17'),
(2530, 'B4 Gasolinera', 'alcomexB4@gmail.com', 'Gasolinera Amozoc', 31448, 1, '2023-04-14 15:42:23'),
(2531, 'B1 Contabilidad', 'contabilidad2023alcomex@gmail.com', 'Departamento de contabilidad', 31448, 76, '2023-04-14 16:10:16'),
(2532, 'B1 Coordinación tráfico', 'luis.amaro@alcomex.mx', 'Coordinación de tráfico Alcomex', 31448, NULL, '2023-04-14 16:19:36'),
(2533, 'B1 Coordinación de unidades', 'alejandro.damazo@alcomex.mx', 'Coordinación de unidades', 31448, 69, '2023-04-21 18:10:33'),
(2534, 'B1 Seguridad patrimonial', 'seguridadpatrimonial@alcomex.mx', 'Área de monitoreo', 31448, 64, '2023-04-21 18:13:27'),
(2535, 'B1 Cuentas por cobrar', 'transporte-logistica@alcomex.mx', 'Área de cuentas por cobrar', 31448, 71, '2023-04-21 18:16:23'),
(2536, 'B1 Coordinación logística ', 'ana.trejo@alcomex.mx', 'Área encargada de administrar logística ', 31448, 74, '2023-04-21 18:24:47'),
(2537, 'B1 Gerencia de operaciones', 'heribertoalvarez@alcomex.mx', 'Gerencia de operaciones', 31448, 31, '2023-04-21 19:28:50'),
(2538, 'B1 Coordinación logística de C', 'anakaren.reynoso@alcomex.mx', 'Coordinación logística ', 31448, 73, '2023-04-21 22:33:38'),
(2539, 'B1 Facturación', 'facturacion@alcomex.mx', 'Área de facturación', 31448, 68, '2023-04-24 21:50:33'),
(2540, 'B1 Devoluciones', 'transportesalcomex@gmail.com', 'Área de devoluciones', 31448, 67, '2023-04-24 22:01:31');

--
-- Disparadores `departamento`
--
DELIMITER $$
CREATE TRIGGER `Eliminarregistro_alteracionesDepa` BEFORE DELETE ON `departamento` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"Eliminar", OLD.idDepartamento,"departamento")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `InsertarDepartamento` AFTER INSERT ON `departamento` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.idDepartamento,"departamento")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registro_alteracionesDepa` AFTER UPDATE ON `departamento` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.idDepartamento,"departamento")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enviocorreo`
--

CREATE TABLE `enviocorreo` (
  `correo` int(11) NOT NULL,
  `contraseña` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `fecha` varchar(50) DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `enviocorreo`
--

INSERT INTO `enviocorreo` (`correo`, `contraseña`, `fecha`, `id`) VALUES
(2526, '„sä‘ô_ÆÝe/õ«®$´²ÅÒ×ñÔüY)	Qùe', '2023-04-11 16:43:50', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `idEstatus` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`idEstatus`, `Nombre`) VALUES
(19231, 'Temporal'),
(25542, 'Bloqueado'),
(31448, 'Activo'),
(94573, 'Vacaciones'),
(94574, 'PENDIENTE'),
(94575, 'EN PROCESO'),
(94576, 'RESUELTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_alteraciones`
--

CREATE TABLE `registro_alteraciones` (
  `id_registro` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `accion` varchar(255) NOT NULL,
  `idAlterado` int(11) DEFAULT NULL,
  `tabla` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `registro_alteraciones`
--

INSERT INTO `registro_alteraciones` (`id_registro`, `usuario`, `fecha`, `accion`, `idAlterado`, `tabla`) VALUES
(871, 29, '2023-04-21 15:55:37', 'Insertar', 123, 'ticket'),
(872, 29, '2023-04-21 15:58:01', 'Insertar', 124, 'ticket'),
(876, 1, '2023-04-21 16:07:39', 'Actualizar', 124, 'ticket'),
(878, 1, '2023-04-21 16:09:19', 'Actualizar', 123, 'ticket'),
(879, 1, '2023-04-21 16:09:55', 'Eliminar', 122, 'ticket'),
(884, 1, '2023-04-21 16:13:39', 'Eliminar', 2527, 'departamento'),
(885, 0, '2023-04-21 16:39:05', 'Eliminar', 62, 'cliente'),
(886, 1, '2023-04-21 16:40:28', 'Actualizar', 124, 'ticket'),
(887, 1, '2023-04-21 16:42:35', 'Actualizar', 123, 'ticket'),
(888, 1, '2023-04-21 17:18:39', 'Actualizar', 123, 'ticket'),
(889, 63, '2023-04-21 17:54:02', 'Insertar', 63, 'cliente'),
(890, 1, '2023-04-21 17:58:33', 'EliminarU', 63, 'cliente'),
(891, 1, '2023-04-21 18:00:25', 'EliminarU', 12, 'cliente'),
(892, 64, '2023-04-21 18:01:48', 'Insertar', 64, 'cliente'),
(893, 65, '2023-04-21 18:02:20', 'Insertar', 65, 'cliente'),
(894, 1, '2023-04-21 18:10:33', 'Insertar', 2533, 'departamento'),
(895, 66, '2023-04-21 18:11:14', 'Insertar', 66, 'cliente'),
(896, 67, '2023-04-21 18:11:25', 'Insertar', 67, 'cliente'),
(897, 68, '2023-04-21 18:12:32', 'Insertar', 68, 'cliente'),
(898, 1, '2023-04-21 18:13:27', 'Insertar', 2534, 'departamento'),
(899, 1, '2023-04-21 18:13:42', 'Actualizar', 64, 'cliente'),
(900, 1, '2023-04-21 18:15:18', 'Actualizar', 2533, 'departamento'),
(901, 1, '2023-04-21 18:15:32', 'Actualizar', 2534, 'departamento'),
(902, 1, '2023-04-21 18:16:23', 'Insertar', 2535, 'departamento'),
(903, 69, '2023-04-21 18:18:59', 'Insertar', 69, 'cliente'),
(904, 1, '2023-04-21 18:19:31', 'Actualizar', 69, 'cliente'),
(905, 1, '2023-04-21 18:24:47', 'Insertar', 2536, 'departamento'),
(906, 70, '2023-04-21 18:25:08', 'Insertar', 70, 'cliente'),
(907, 1, '2023-04-21 18:25:49', 'Actualizar', 66, 'cliente'),
(908, 71, '2023-04-21 18:26:02', 'Insertar', 71, 'cliente'),
(909, 1, '2023-04-21 18:26:08', 'Actualizar', 66, 'cliente'),
(910, 1, '2023-04-21 18:26:47', 'Actualizar', 70, 'cliente'),
(911, 1, '2023-04-21 18:27:41', 'Actualizar', 65, 'cliente'),
(912, 1, '2023-04-21 18:28:43', 'Actualizar', 2536, 'departamento'),
(913, 1, '2023-04-21 18:30:33', 'Actualizar', 67, 'cliente'),
(914, 1, '2023-04-21 18:30:41', 'Actualizar', 68, 'cliente'),
(915, 1, '2023-04-21 18:31:01', 'Actualizar', 59, 'cliente'),
(916, 1, '2023-04-21 18:32:00', 'Actualizar', 71, 'cliente'),
(917, 1, '2023-04-21 18:32:20', 'Actualizar', 65, 'cliente'),
(918, 1, '2023-04-21 18:32:28', 'Actualizar', 59, 'cliente'),
(919, 72, '2023-04-21 18:40:29', 'Insertar', 72, 'cliente'),
(920, 73, '2023-04-21 18:44:11', 'Insertar', 73, 'cliente'),
(921, 1, '2023-04-21 18:48:40', 'Actualizar', 72, 'cliente'),
(922, 29, '2023-04-21 18:50:44', 'Actualizar', 29, 'cliente'),
(923, 1, '2023-04-21 18:55:57', 'Actualizar', 2526, 'departamento'),
(924, 1, '2023-04-21 19:05:03', 'Actualizar', 1, 'cliente'),
(925, 1, '2023-04-21 19:08:19', 'Actualizar', 1, 'cliente'),
(926, 64, '2023-04-21 19:10:10', 'Insertar', 125, 'ticket'),
(927, 1, '2023-04-21 19:11:35', 'Actualizar', 2533, 'departamento'),
(928, 1, '2023-04-21 19:28:50', 'Insertar', 2537, 'departamento'),
(929, 74, '2023-04-21 21:22:59', 'Insertar', 74, 'cliente'),
(930, 1, '2023-04-21 21:57:26', 'Actualizar', 74, 'cliente'),
(931, 1, '2023-04-21 21:57:58', 'Actualizar', 74, 'cliente'),
(932, 1, '2023-04-21 22:19:59', 'EliminarU', 61, 'cliente'),
(933, 1, '2023-04-21 22:33:38', 'Insertar', 2538, 'departamento'),
(934, 1, '2023-04-21 22:34:01', 'Actualizar', 73, 'cliente'),
(935, 1, '2023-04-21 22:48:03', 'Actualizar', 2535, 'departamento'),
(936, 1, '2023-04-21 22:48:26', 'Actualizar', 71, 'cliente'),
(937, 1, '2023-04-21 22:54:51', 'Actualizar', 68, 'cliente'),
(938, 0, '2023-04-21 22:55:06', '', 67, 'cliente'),
(939, 31, '2023-04-21 23:15:19', 'Actualizar', 125, 'ticket'),
(940, 31, '2023-04-21 23:15:30', 'Actualizar', 125, 'ticket'),
(941, 71, '2023-04-21 23:34:42', 'Insertar', 126, 'ticket'),
(942, 31, '2023-04-21 23:35:44', 'Actualizar', 126, 'ticket'),
(943, 1, '2023-04-21 23:55:24', 'Actualizar', 67, 'cliente'),
(944, 75, '2023-04-22 00:00:31', 'Insertar', 75, 'cliente'),
(945, 1, '2023-04-22 00:02:18', 'Actualizar', 75, 'cliente'),
(946, 1, '2023-04-22 00:04:15', 'Actualizar', 75, 'cliente'),
(947, 1, '2023-04-22 00:06:05', 'Actualizar', 75, 'cliente'),
(948, 65, '2023-04-22 20:00:54', 'Insertar', 127, 'ticket'),
(949, 0, '2023-04-22 20:04:08', '', 127, 'ticket'),
(950, 76, '2023-04-24 15:54:29', 'Insertar', 76, 'cliente'),
(951, 64, '2023-04-24 15:55:37', 'Insertar', 128, 'ticket'),
(952, 76, '2023-04-24 15:56:43', 'Insertar', 129, 'ticket'),
(953, 1, '2023-04-24 16:02:16', 'Actualizar', 76, 'cliente'),
(954, 1, '2023-04-24 16:02:39', 'Actualizar', 2531, 'departamento'),
(955, 31, '2023-04-24 16:10:26', 'Actualizar', 128, 'ticket'),
(956, 64, '2023-04-24 16:45:07', 'Insertar', 130, 'ticket'),
(957, 74, '2023-04-24 16:54:58', 'Insertar', 131, 'ticket'),
(958, 31, '2023-04-24 17:26:33', 'Actualizar', 128, 'ticket'),
(959, 31, '2023-04-24 17:28:03', 'Actualizar', 130, 'ticket'),
(960, 31, '2023-04-24 17:28:33', 'Actualizar', 128, 'ticket'),
(961, 31, '2023-04-24 17:28:34', 'Actualizar', 128, 'ticket'),
(962, 69, '2023-04-24 17:43:41', 'Insertar', 132, 'ticket'),
(963, 1, '2023-04-24 18:06:24', 'Actualizar', 132, 'ticket'),
(964, 1, '2023-04-24 21:50:33', 'Insertar', 2539, 'departamento'),
(965, 1, '2023-04-24 21:50:53', 'Actualizar', 68, 'cliente'),
(966, 1, '2023-04-24 22:01:31', 'Insertar', 2540, 'departamento'),
(967, 64, '2023-04-24 22:59:40', 'Insertar', 133, 'ticket'),
(968, 1, '2023-04-24 23:50:02', 'Actualizar', 133, 'ticket'),
(969, 1, '2023-04-24 23:51:40', 'Actualizar', 129, 'ticket'),
(970, 1, '2023-04-24 23:52:08', 'Actualizar', 131, 'ticket'),
(971, 1, '2023-04-24 23:56:19', 'Actualizar', 67, 'cliente'),
(972, 1, '2023-04-24 23:56:43', 'Actualizar', 2536, 'departamento'),
(973, 64, '2023-04-25 18:50:44', 'Insertar', 134, 'ticket'),
(974, 1, '2023-04-25 18:53:54', 'Actualizar', 134, 'ticket'),
(975, 75, '2023-04-25 18:55:15', 'Insertar', 135, 'ticket'),
(976, 1, '2023-04-25 19:08:39', 'Actualizar', 135, 'ticket'),
(977, 1, '2023-04-25 19:58:21', 'Actualizar', 59, 'cliente'),
(978, 59, '2023-04-25 19:59:50', 'Insertar', 136, 'ticket'),
(979, 59, '2023-04-25 20:01:03', 'Actualizar', 59, 'cliente'),
(980, 1, '2023-04-25 20:02:14', 'Actualizar', 136, 'ticket'),
(981, 1, '2023-04-25 20:53:13', 'Actualizar', 127, 'ticket'),
(982, 1, '2023-04-25 20:53:48', 'Actualizar', 131, 'ticket'),
(983, 64, '2023-04-25 21:59:47', 'Insertar', 137, 'ticket'),
(984, 1, '2023-04-25 22:56:15', 'Actualizar', 131, 'ticket'),
(985, 1, '2023-04-25 22:57:31', 'Actualizar', 127, 'ticket'),
(986, 1, '2023-04-25 23:03:10', 'Actualizar', 137, 'ticket'),
(987, 75, '2023-04-26 12:50:48', 'Insertar', 138, 'ticket'),
(988, 1, '2023-04-26 15:29:30', 'Actualizar', 138, 'ticket'),
(989, 1, '2023-04-26 15:37:12', 'Actualizar', 138, 'ticket'),
(990, 1, '2023-04-26 15:39:17', 'Actualizar', 1, 'cliente'),
(991, 1, '2023-04-26 16:09:39', 'EliminarU', 60, 'cliente'),
(992, 1, '2023-04-26 16:16:21', 'Actualizar', 72, 'cliente'),
(993, 64, '2023-04-26 17:03:53', 'Insertar', 139, 'ticket'),
(994, 72, '2023-04-26 17:51:03', 'Insertar', 140, 'ticket'),
(995, 0, '2023-04-26 18:04:11', '', 141, 'ticket'),
(996, 72, '2023-04-26 18:06:14', 'Insertar', 142, 'ticket'),
(997, 1, '2023-04-26 18:20:29', 'Actualizar', 140, 'ticket'),
(998, 1, '2023-04-26 18:21:18', 'Actualizar', 140, 'ticket'),
(999, 1, '2023-04-26 18:23:15', 'Actualizar', 141, 'ticket'),
(1000, 1, '2023-04-26 18:26:08', 'Actualizar', 137, 'ticket'),
(1001, 64, '2023-04-26 19:17:38', 'Insertar', 143, 'ticket'),
(1002, 31, '2023-04-26 19:44:54', 'Actualizar', 139, 'ticket'),
(1003, 31, '2023-04-26 19:45:44', 'Actualizar', 142, 'ticket'),
(1004, 31, '2023-04-26 19:45:53', 'Actualizar', 142, 'ticket'),
(1005, 31, '2023-04-26 19:47:10', 'Actualizar', 143, 'ticket'),
(1006, 31, '2023-04-26 20:11:21', 'Actualizar', 143, 'ticket'),
(1007, 77, '2023-04-26 20:29:20', 'Insertar', 77, 'cliente'),
(1008, 1, '2023-04-26 20:31:15', 'Actualizar', 77, 'cliente'),
(1009, 1, '2023-04-26 20:31:18', 'EliminarU', 77, 'cliente'),
(1010, 1, '2023-04-26 22:22:41', 'Actualizar', 139, 'ticket'),
(1011, 1, '2023-04-26 22:28:02', 'Actualizar', 1, 'cliente'),
(1012, 1, '2023-04-26 22:33:31', 'Actualizar', 1, 'cliente'),
(1013, 1, '2023-04-26 22:41:01', 'Actualizar', 1, 'cliente'),
(1014, 1, '2023-04-26 23:09:49', 'Actualizar', 71, 'cliente'),
(1015, 1, '2023-04-26 23:10:05', 'Actualizar', 69, 'cliente'),
(1016, 1, '2023-04-26 23:10:12', 'Actualizar', 66, 'cliente'),
(1017, 1, '2023-04-26 23:10:20', 'Actualizar', 65, 'cliente'),
(1018, 0, '2023-04-26 23:11:25', '', 31, 'cliente'),
(1019, 0, '2023-04-26 23:11:39', '', 59, 'cliente'),
(1020, 1, '2023-04-26 23:11:47', 'Actualizar', 72, 'cliente'),
(1021, 1, '2023-04-26 23:11:55', 'Actualizar', 74, 'cliente'),
(1022, 1, '2023-04-26 23:12:02', 'Actualizar', 73, 'cliente'),
(1023, 1, '2023-04-26 23:12:12', 'Actualizar', 70, 'cliente'),
(1024, 1, '2023-04-26 23:12:21', 'Actualizar', 64, 'cliente'),
(1025, 1, '2023-04-26 23:12:29', 'Actualizar', 29, 'cliente'),
(1026, 72, '2023-04-26 23:26:09', 'Insertar', 144, 'ticket'),
(1027, 1, '2023-04-26 23:53:43', 'Actualizar', 144, 'ticket'),
(1028, 1, '2023-04-26 23:54:01', 'Actualizar', 144, 'ticket'),
(1029, 72, '2023-04-27 16:12:42', 'Insertar', 145, 'ticket'),
(1030, 1, '2023-04-27 16:13:54', 'Actualizar', 145, 'ticket');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `Nombre`) VALUES
(4046, 'ADMINISTRADOR'),
(5267, 'TÉCNICO'),
(9947, 'CLIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `serie` varchar(100) NOT NULL,
  `asunto` varchar(70) NOT NULL,
  `mensaje` varchar(500) NOT NULL,
  `solucion` varchar(300) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `id_atiende` int(11) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `fecha`, `serie`, `asunto`, `mensaje`, `solucion`, `idUsuario`, `idDepartamento`, `idStatus`, `id_atiende`, `fecha_actualizacion`, `foto`) VALUES
(123, '2023-04-21 15:55:37', 'TK34N5', 'APOYO CON LICENCIA DE SOFTWARE', 'Tengo problemas con la licencia de Adobe PS. Me marca que está caducado y no me deja trabajar.\r\n\r\nGracias.', 'Vale en un momento eliminamos esa versión para instalar otra', 29, 2524, 94576, 31, '2023-04-21 17:18:39', 'Fotos/PROBLEMA LICENCIA PS.jpeg'),
(124, '2023-04-21 15:58:01', 'TK35N6', 'NO ME PERMITE IMPRIMIR A LA CANON G4010', 'Buen día.\r\n\r\nQuiero imprimir documentos a color y me arroja el mensaje de que la impresora NO está conectada, siendo que sí está prendida y otros compañeros Sí pueden imprimir.\r\n\r\nGracias.', 'Ok lo reviso', 29, 2524, 94576, 31, '2023-04-21 16:40:28', 'Fotos/error impresion.PNG'),
(125, '2023-04-21 19:10:10', 'TK32N3', 'unidad T-35 ', 'la unidad no posiciona se le llama y si regresa mensaje y ubicacion pero en la plataforma de alcomex no posiciona nada sigue en amarillo', 'SE VERIFICA INFORMACION DE CONFIGURACION DE GPS EN PLATAFORMA Y SE DETECTA IMEI ERRONEA; APOYO  BRINDADO POR JOSEPH SALDAÑA', 64, 2526, 94576, 31, '2023-04-21 23:15:30', 'Fotos/ff6c1f87-7164-4586-b08b-8ee15ca2e56c.jpg'),
(126, '2023-04-21 23:34:42', 'TK39N4', 'hasdl jc', 'dvb sdt', 'resolbido', 71, 2526, 94576, 31, '2023-04-21 23:35:44', 'Fotos/error.jp'),
(127, '2023-04-22 20:00:54', 'TK94N5', 'FALLA CORREO ', 'No carga correo cuando lo abro desde el buscador o aplicación y tambien fallas en recepción de correo a mis clientes.', 'Listo. Problema de contraseñas y versión de office', 65, 2526, 94576, 31, '2023-04-25 22:57:31', 'Fotos/error.jp'),
(128, '2023-04-24 15:55:37', 'TK95N6', 'camioneta Ct-19', 'buen dia equipo solicito de su apoyo para que la unida ct-19 no posiciona y carga hoy al medio dia gracias y buen dia.', 'Se revisa unidad, se envian comandos via telefonica y el dispositivo comienza a posicionar, se sospecha que la falla se debe a falta de bateria en la unidad.', 64, 2526, 94576, 31, '2023-04-24 17:28:34', 'Fotos/Captura de pantalla 2023-04-24 095509.png'),
(129, '2023-04-24 15:56:43', 'TK08N7', 'Facturas en mal estado', 'Las facturas presentan errores en el llenado.', 'Listo', 76, 2535, 94576, 67, '2023-04-24 23:51:40', 'Fotos/error.jp'),
(130, '2023-04-24 16:45:07', 'TK31N8', 'gps saveiro', 'buen día equipo solicito de su apoyo para la colocación del gps de la camioneta saveiro VW del Heriberto Alvarez quedo atento sobre este porceso buena tarde.', 'SE INSTALA Y CONFIGURA GPS CON PARO DE MOTOR A DISTANCIA CON IMEI 868166052418787 Y NIMERO SIM: 2212482408 PARA SAVEIRO ADMINISTRATIVA', 64, 2526, 94576, 31, '2023-04-24 17:28:03', 'Fotos/error.jp'),
(131, '2023-04-24 16:54:58', 'TK57N9', 'Correo electrónico ', 'No recibo correos, en automático mi correo rechaza los ingresos a bandeja', 'Resuelto doc, problema de contraseñas y versión de Office', 74, 2526, 94576, 31, '2023-04-25 22:56:15', 'Fotos/WhatsApp Image 2023-04-24 at 10.23.39 AM.jpeg'),
(132, '2023-04-24 17:43:41', 'TK84N10', 'Revision de Memoria.', 'La memoria la coloque en la cpiadora Brother, al momento de volver a abrirla en mi computadora me sale la siguiente imagen.', 'En revisión', 69, 2526, 94575, 1, '2023-04-24 18:06:24', 'Fotos/Captura de pantalla (8).png'),
(133, '2023-04-24 22:59:40', 'TK09N11', 'gps saveiro mariano', 'buena tarde equipo solicito de su apoyo para la colocacion del gps a la camioneta saveiro que esta asignada al señor mariano. quedo atento a cualquier comenmtario sobre la instalacion del equipo buena tarde.', 'Listo, gps instalado. Para cualquier situación el número que queda registrado es 868166052410958 y el número de teléfono  es 2223487962', 64, 2526, 94576, 1, '2023-04-24 23:50:02', 'Fotos/error.jp'),
(134, '2023-04-25 18:50:44', 'TK23N12', 'team wiber ', 'no restablece la coneccion de su apoyo por favor buena tarde. ', 'Listo, conexión restablecida', 64, 2526, 94576, 1, '2023-04-25 18:53:54', 'Fotos/Captura de pantalla 2023-04-24 095509.png'),
(135, '2023-04-25 18:55:15', 'TK32N13', 'ANYDESK', ' NO PERMITE CONECTAR UN SERVIDOR ', 'Gracias por el aviso', 75, 2526, 94576, 1, '2023-04-25 19:08:39', 'Fotos/X.PNG'),
(136, '2023-04-25 19:59:50', 'TK44N14', 'Carpetas Compartidas', 'No puedo acceder a las carpetas compartidas', 'Se restablece la conexión de Switch para  las IP', 59, 2526, 94576, 1, '2023-04-25 20:02:14', 'Fotos/error.jp'),
(137, '2023-04-25 21:59:47', 'TK99N15', 'unidad T-19', 'pido de su apoyo para verificar los motivos por que la unidad t-19 no esta posicionando quedo atento al seguimiento de la unidad.', 'Ya esta posicionando, el motivo de que no posiciona es por que se encontraba en zona con baja cobertura', 64, 2526, 94576, 31, '2023-04-26 18:26:08', 'Fotos/Captura de pantalla 2023-04-25 155801.png'),
(138, '2023-04-26 12:50:48', 'TK40N16', 'plataforma', 'la mayoria de las unidades estan en amarillo', 'Ya quedó', 75, 2526, 94576, 1, '2023-04-26 15:37:12', 'Fotos/error.jp'),
(139, '2023-04-26 17:03:53', 'TK66N17', 'vídeo cámaras', 'solicito de su apoyo solo para poder  visualizar las camaras en el turno del monitorista josue gonzalez huerta, del dia 25 al 26 de abril de 2023.', 'se cita en el site para revisar camaras directamente del grabador', 64, 2526, 94576, 31, '2023-04-26 22:22:41', 'Fotos/error.jp'),
(140, '2023-04-26 17:51:03', 'TK61N18', 'instalacion de Whatsapp web.', 'no me permite abrir whatsapp, con el codigo  QR', 'Se hace actualizaciones de la app por playstore y se borra la memoria cache y comienza a funcionar normal.', 72, 2526, 94576, 1, '2023-04-26 18:21:18', 'Fotos/error.jp'),
(141, '2023-04-26 18:04:11', 'TK93N19', 'excel', 'no me permite hacer anotaciones, ni anexar comentarios en una celda en excel.', 'Para la solución se activa la licencia de office y se hacen actualizaciones para algunas opciones de excel como insertar comentarios', 72, 2526, 94576, 1, '2023-04-26 18:23:15', 'Fotos/error.jp'),
(142, '2023-04-26 18:06:14', 'TK63N20', 'Ruido en mi CPU', 'es incomodo , no deja de sonar y me estresa', 'Se detecta la falla y se realiza cambio de cooler y de case de disco duro, tambien se reajusta disco duro', 72, 2526, 94576, 31, '2023-04-26 19:45:53', 'Fotos/error.jp'),
(143, '2023-04-26 19:17:38', 'TK01N21', 'team wiber', 'pido de su apoyo ya que team wiber no podemos acceder para correr el server.\r\nquedo atento buena tarde.', 'Se revisa la condición de conectividad y se detecta la falla, se da soporte via anydesk, y se colocan como favoritos los accesos a server 1 y server 2', 64, 2526, 94576, 31, '2023-04-26 20:11:21', 'Fotos/Captura de pantalla 2023-04-26 131548.png'),
(144, '2023-04-26 23:26:09', 'TK56N22', 'IMPRESORA', 'ME PODRIAN A POYAR A ANEXAR LAS IMPRESONAS A LA COMPU, PARA PODER IMPRIMIR', 'Se agregaron impresoras canon G4010 y Brother', 72, 2526, 94576, 1, '2023-04-26 23:54:01', 'Fotos/error.jp'),
(145, '2023-04-27 16:12:42', 'TK87N23', 'instalacion de Whatsapp web.', 'NO ME PERMITE ABRIR APLICACION . ', 'Resuelto', 72, 2526, 94576, 1, '2023-04-27 16:13:54', 'Fotos/error.jp');

--
-- Disparadores `ticket`
--
DELIMITER $$
CREATE TRIGGER `Eliminarregistro_alteracionesTicket` BEFORE DELETE ON `ticket` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"Eliminar", OLD.id,"ticket")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `InsertarTicket` AFTER INSERT ON `ticket` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.id,"ticket")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registro_alteracionesTickets` AFTER UPDATE ON `ticket` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.id,"ticket")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_delete`
--

CREATE TABLE `user_delete` (
  `folio_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_departamento` varchar(60) DEFAULT NULL,
  `pendiente` int(11) DEFAULT NULL,
  `creados` int(11) DEFAULT NULL,
  `resuelto` int(11) DEFAULT NULL,
  `proceso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `user_delete`
--

INSERT INTO `user_delete` (`folio_id`, `fecha`, `idUsuario`, `nombre_completo`, `id_rol`, `id_departamento`, `pendiente`, `creados`, `resuelto`, `proceso`) VALUES
(1, '2023-03-27 14:40:38', 5, 'Andrés Sebastián Sánchez Cortez', 4046, 'Sin departamento', 5, 0, 1, 2),
(4, '2023-03-28 18:03:11', 41, 'Javier  Antonio Carrillo', 9947, 'Prueba', 0, 0, 0, 0),
(5, '2023-03-29 11:18:00', 42, 'Taller B2 Hernandez Escuela', 9947, 'Prueba', 0, 0, 0, 0),
(6, '2023-03-29 11:21:42', 43, 'Taller B2 dsaad', 4046, 'Prueba', 0, 0, 0, 0),
(7, '2023-03-29 11:29:09', 44, 'xdsfsdfsdf adasdasdasds', 5267, 'Prueba', 0, 0, 0, 0),
(8, '2023-03-29 11:45:25', 45, 'Policia .', 9947, 'Sin departamento', 0, 0, 0, 0),
(10, '2023-03-29 11:47:48', 35, 'Gabriela Prueba Sainos', 9947, 'Prueba', 0, 0, 0, 1),
(11, '2023-03-29 11:47:48', 46, 'Gabriela Prueba Sainos', 9947, 'Talleres', 0, 0, 0, 0),
(12, '2023-03-29 11:50:57', 48, 'asa adasdasdasdsasas', 4046, 'Prueba1', 0, 0, 0, 0),
(13, '2023-03-29 11:50:57', 47, 'asa asas', 4046, 'Prueba', 0, 0, 0, 0),
(14, '2023-03-31 09:40:37', 49, 'Ajax AjaxJquery', 4046, 'Prueba', 0, 0, 0, 0),
(15, '2023-04-01 11:29:00', 51, 'Taller B2 Hernandez Escuela', 9947, 'Prueba', 0, 0, 0, 0),
(16, '2023-04-13 18:48:51', 50, 'Ajax AjaxJquery', 9947, 'Prueba', 0, 0, 0, 0),
(17, '2023-04-13 18:48:51', 52, 'Prueba buscador buscador', 9947, 'Talleres', 0, 0, 0, 0),
(18, '2023-04-13 18:48:51', 54, 'Reseteo de contraseña Contraseña', 9947, 'Recursos Humanos', 0, 0, 0, 0),
(19, '2023-04-13 18:48:51', 53, 'Taller B2assa asasa', 9947, 'Sin departamento', 0, 0, 0, 0),
(20, '2023-04-13 18:49:12', 30, 'Minerva Salas', 4046, 'Titulacion', 0, 0, 0, 0),
(21, '2023-04-13 19:02:10', 3, 'Alondra Sanchez Torivio', 5267, 'Sin departamento', 18, 0, 0, 0),
(22, '2023-04-14 09:44:09', 38, 'Jenny Ortega Garcia', 5267, 'Sin departamento', 0, 0, 0, 0),
(23, '2023-04-14 09:44:09', 7, 'Luis Enrique Granillo Gamino', 5267, 'Sin departamento', 0, 0, 0, 0),
(24, '2023-04-14 09:44:23', 22, 'Bruno Absalon Flores Rosas', 5267, 'Sin departamento', 0, 0, 0, 0),
(25, '2023-04-14 09:45:56', 57, 'Jose Perez Hernandez', 9947, 'Sin departamento', 0, 0, 0, 0),
(26, '2023-04-14 09:45:56', 56, 'Juan Perez Garcia', 9947, 'Sin departamento', 0, 0, 0, 0),
(27, '2023-04-14 09:45:56', 8, 'Roman Sanchez', 9947, 'Sin departamento', 22, 0, 0, 0),
(28, '2023-04-14 09:46:17', 23, 'Luis Hernandez Escuela', 4046, 'Sin departamento', 0, 0, 0, 0),
(29, '2023-04-14 10:20:32', 5, 'Andrés Sebastián Sánchez Cortez', 5267, 'Sin departamento', 12, 0, 0, 0),
(30, '2023-04-20 17:56:13', 40, 'Uriel Isai Hernández Hernández ', 5267, 'Sin departamento', 0, 0, 0, 0),
(31, '2023-04-21 10:11:34', 55, 'Alondra   Sanchez Torivio', 5267, 'B1 Sistemas', 0, 0, 0, 0),
(32, '2023-04-21 10:12:22', 58, 'Ernesto Sainos Hernandez', 9947, 'Sin departamento', 0, 0, 0, 0),
(33, '2023-04-21 11:58:33', 63, 'Registro prueba', 9947, 'Sin departamento', 0, 0, 0, 0),
(34, '2023-04-21 12:00:25', 12, 'Luis Enrique Granillo Gamino', 4046, 'B1 Soporte técnico', 0, 0, 0, 0),
(35, '2023-04-21 16:19:59', 61, 'Luis Manuel Amaro Vazquez', 5267, 'B1 Coordinación tráfico', 0, 0, 0, 0),
(36, '2023-04-26 10:09:39', 60, 'Carlos Alberto  Diaz Martinez', 5267, 'B1 Contabilidad', 0, 0, 0, 0),
(37, '2023-04-26 14:31:18', 77, 'ALEXA SANCHEZ HELLO', 9947, 'B1 Devoluciones', 0, 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `correo` (`email_admin`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `FK_EST2` (`idEstatus`),
  ADD KEY `FK_ROL` (`id_rol`),
  ADD KEY `FK_CLIENTEDEPA` (`id_departamento`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `FK_DEPART` (`idEstatus`),
  ADD KEY `Fk_jefes` (`idJefe`);

--
-- Indices de la tabla `enviocorreo`
--
ALTER TABLE `enviocorreo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_enviocorreo` (`correo`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`idEstatus`);

--
-- Indices de la tabla `registro_alteraciones`
--
ALTER TABLE `registro_alteraciones`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serie` (`serie`),
  ADD KEY `FK_TI` (`idUsuario`),
  ADD KEY `DEPASTICKET` (`idDepartamento`),
  ADD KEY `FK_TICKETESTATUS` (`idStatus`),
  ADD KEY `FK_atiendes` (`id_atiende`);

--
-- Indices de la tabla `user_delete`
--
ALTER TABLE `user_delete`
  ADD PRIMARY KEY (`folio_id`),
  ADD KEY `Fk_rolDelete` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2541;

--
-- AUTO_INCREMENT de la tabla `enviocorreo`
--
ALTER TABLE `enviocorreo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `idEstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94577;

--
-- AUTO_INCREMENT de la tabla `registro_alteraciones`
--
ALTER TABLE `registro_alteraciones`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1031;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9948;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de la tabla `user_delete`
--
ALTER TABLE `user_delete`
  MODIFY `folio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_CLIENTEDEPA` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`idDepartamento`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_EST2` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_ROL` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `FK_DEPART` FOREIGN KEY (`idEstatus`) REFERENCES `estatus` (`idEstatus`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_LIDER` FOREIGN KEY (`idJefe`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION,
  ADD CONSTRAINT `Fk_jefe` FOREIGN KEY (`idJefe`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_jefes` FOREIGN KEY (`idJefe`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `enviocorreo`
--
ALTER TABLE `enviocorreo`
  ADD CONSTRAINT `Fk_enviocorreo` FOREIGN KEY (`correo`) REFERENCES `departamento` (`idDepartamento`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `DEPASTICKET` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TI` FOREIGN KEY (`idUsuario`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TICKETESTATUS` FOREIGN KEY (`idStatus`) REFERENCES `estatus` (`idEstatus`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_atiendes` FOREIGN KEY (`id_atiende`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user_delete`
--
ALTER TABLE `user_delete`
  ADD CONSTRAINT `Fk_rolDelete` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
