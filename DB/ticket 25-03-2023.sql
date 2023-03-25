-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2023 a las 20:55:26
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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
DELETE FROM departamento WHERE idDepartamento=id and idDepartamento <> 2505;
commit;
SET AUTOCOMMIT=1;

ROLLBACK;
SET AUTOCOMMIT=1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarUsuario` (IN `id` INT)   Begin
Declare admin int DEFAULT 0;
SET AUTOCOMMIT=0;
START TRANSACTION;
set admin=(SELECT id_cliente FROM cliente where id_cliente != id and id_rol=4046 order by fecha_creacion ASC LIMIT 0,1);

UPDATE departamento set idJefe=admin where idJefe=id;

DELETE FROM cliente WHERE id_cliente=id;
commit;
SET AUTOCOMMIT=1;

ROLLBACK;
SET AUTOCOMMIT=1;
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
  `nombre_completo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre_admin` varchar(60) NOT NULL,
  `clave` text NOT NULL,
  `email_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `nombre_completo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre_usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email_cliente` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `clave` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `telefono_celular` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `idEstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_completo`, `nombre_usuario`, `email_cliente`, `clave`, `id_departamento`, `id_rol`, `telefono_celular`, `Fecha_creacion`, `idEstatus`) VALUES
(1, 'Leonardo Sainos Perez', 'LeonardoSainos', 'leonardosainos@gmail.com', '5e8667a439c68f5145dd2fcbecf02209', 2505, 4046, '2228412398', '2023-02-21 15:43:55', 19231),
(3, 'Alondra Sanchez Torivio', 'Alo250518', 'alondrasanchez@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2505, 5267, '2228660690', '2023-01-30 19:39:32', 25542),
(5, 'Andres Sebastian Sanchez Cortez', 'Oaxaco', 'andressebas@gmail.com', '0094bcd09edc457cf5efd7d93ad995f3', 2505, 5267, '5535291605', '2023-02-22 20:37:38', 31448),
(7, 'Luis Enrique Granillo Gamino', 'Gamino', 'kikegamino@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2505, 5267, '2222335566', '2023-01-18 23:25:39', 31448),
(8, 'Roman Sanchez', 'Roman08', 'roman@gmail.com', 'e2a8423214be5cd507325221dea72022', 2505, 9947, '2225469883', '2023-02-11 18:04:26', 25542),
(12, 'Luis Enrique Granillo Gamino', 'TecnicoKike', 'LuisGranillo@gmail.com', 'ed2b1f468c5f915f3f1cf75d7068baae', 2505, 4046, '2225277033', '2023-02-21 16:44:32', 31448),
(22, 'Bruno Absalon Flores Rosas', 'PeterGordo', 'bruno@gmail.com', 'ed2b1f468c5f915f3f1cf75d7068baae', 2505, 5267, '2213516726', '2023-02-22 17:40:19', 19231),
(23, 'Luis Hernandez Escuela', 'Escuela@alcomex', 'schoolmusic@gmail.com', 'helloworld', 2510, 4046, '2228526358', '2023-03-13 17:05:23', 31448),
(29, 'Edson Montiell Alvarez', 'EdsonRH', 'alcomex2022@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2524, 5267, '2221917939', '2023-03-14 19:26:32', 31448),
(30, 'Minerva Salas', 'Miche', 'mine@gmail.com', '113065d2207b574501892641d0383875', 9, 4046, '2228412399', '2023-03-22 15:49:33', 31448),
(31, 'Gibran Antonio Garcia Xicohtencatl', 'Gibran', 'sistemas@alcomex.mx', '342ef382d282dceaac9bfc51ebd7bae6', 2505, 4046, '2223245928', '2023-03-23 16:45:16', 31448);

--
-- Disparadores `cliente`
--
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
(3, 'Prueba', 'Prueba@gmail.com', 'esto es una prueba', 31448, 22, '2023-03-09 18:16:27'),
(7, 'Talleres', 'deportes@utpuebla.edu.mx', 'Talleres deportivos y culturales ', 31448, 1, '2023-03-09 18:16:27'),
(9, 'Titulacion', 'titulacionalcomex@utpuebla.mx', 'Area encargada del proceso de titulacion', 31448, 22, '2023-03-09 18:16:27'),
(2505, 'Sin departamento', '', '', 31448, 5, '2023-03-09 18:16:27'),
(2506, 'Cuentas por cobrar', 'cuentasporcobrar@alcomex.mx', 'Departamento del área de finanzas', 31448, 3, '2023-03-09 18:16:27'),
(2507, 'Prueba1', 'correo@gmail.com', 'Esto es una prueba de CRUD', 31448, 1, '2023-03-09 20:00:17'),
(2510, 'Prueba1', 'correo032@gmail.com', 'Esto es una prueba de CRUD', 31448, 1, '2023-03-09 22:38:28'),
(2519, 'Prueba10', 'icorreo9@gmail.com', 'Esto es una prueba de CRUD', 31448, 1, '2023-03-09 22:38:28'),
(2522, 'Taller B2', 'tallerb2@alcomex.mx', 'Esta ?rea se encarga de dar mantenimiento a los equipos de carga ', 31448, 3, '2023-03-13 18:55:57'),
(2523, 'Sistemas', 'sistemas@alcomex.mx', 'Soporte t?cnico', 31448, 1, '2023-03-14 19:27:21'),
(2524, 'Recursos Humanos', 'alcomex2022@gmail.com', 'Recursos humanos alcomex', 31448, 29, '2023-03-14 19:29:28');

--
-- Disparadores `departamento`
--
DELIMITER $$
CREATE TRIGGER `Eliminarregistro_alteracionesDepa` BEFORE DELETE ON `departamento` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"Eliminar", OLD.idDepartamento,"departamento")
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
  `correo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `contraseña` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(284, 1, '2023-03-25 19:37:35', 'Eliminar', 59, 'ticket'),
(285, 1, '2023-03-25 19:37:41', 'Eliminar', 53, 'ticket');

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
  `serie` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `asunto` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mensaje` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `solucion` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `id_atiende` int(11) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `fecha`, `serie`, `asunto`, `mensaje`, `solucion`, `idUsuario`, `idDepartamento`, `idStatus`, `id_atiende`, `fecha_actualizacion`) VALUES
(28, '2023-03-08 22:31:19', 'TK82N11', 'asas', 'asas', 'listo', 1, 3, 94576, 8, '2023-03-10 01:17:39'),
(30, '2023-03-08 22:31:19', 'TK95N13', 'asa', 'asas', '', 1, 3, 94574, 8, '2023-03-08 04:16:05'),
(31, '2023-03-08 22:31:19', 'TK68N14', 'asas', 'sasa', '', 1, 3, 94574, 8, '2023-03-08 04:16:07'),
(32, '2023-03-08 22:31:19', 'TK19N15', 'asas', 'asas', '', 1, 3, 94574, 8, '2023-03-08 04:16:10'),
(33, '2023-03-08 22:31:19', 'TK40N16', 'asa', 'saasa', '', 1, 3, 94574, 8, '2023-03-08 04:16:12'),
(34, '2023-03-08 22:31:19', 'TK85N17', 'asas', 'asas', '', 1, 3, 94574, 8, '2023-03-08 04:16:15'),
(35, '2023-03-08 22:31:19', 'TK14N18', 'asasa', 'asasa', '', 1, 3, 94574, 8, '2023-03-08 04:16:17'),
(39, '2023-03-08 22:31:19', 'TK95N22', 'asasa', 'asasas', '', 1, 3, 94574, 8, '2023-03-08 04:16:29'),
(40, '2023-03-08 22:31:19', 'TK44N23', 'asasa', 'asasa', '', 1, 3, 94574, 8, '2023-03-08 04:16:32'),
(41, '2023-03-08 22:31:19', 'TK05N24', 'asasa', 'asas', '', 1, 3, 94574, 8, '2023-03-08 04:16:35'),
(42, '2023-03-08 22:31:19', 'TK72N25', 'asasa', 'asasas', '', 1, 3, 94574, 8, '2023-03-08 04:16:38'),
(43, '2023-03-08 22:31:19', 'TK72N26', 'asasa', 'asasas', '', 1, 3, 94574, 8, '2023-03-08 04:16:42'),
(45, '2023-03-08 22:31:19', 'TK28N28', 'asasas', 'asasa', '', 1, 3, 94574, 8, '2023-03-08 04:16:48'),
(46, '2023-03-08 22:31:19', 'TK66N29', 'asasa', 'saasas', '', 1, 3, 94574, 8, '2023-03-08 04:16:50'),
(47, '2023-03-08 22:31:19', 'TK80N30', 'asasas', 'asasa', '', 1, 3, 94574, 8, '2023-03-08 04:16:53'),
(48, '2023-03-08 22:31:19', 'TK95N31', 'asasa', 'sasasa', '', 1, 3, 94574, 8, '2023-03-08 04:16:56'),
(49, '2023-03-08 22:31:19', 'TK99N32', 'asasas', 'asasas', '', 1, 3, 94574, 8, '2023-03-08 04:16:59'),
(50, '2023-03-08 22:31:19', 'TK26N33', 'asas', 'asasas', '', 1, 3, 94574, 8, '2023-03-08 04:17:04'),
(51, '2023-03-08 22:31:19', 'TK23N34', 'asasas', 'asasa', '', 1, 3, 94574, 8, '2023-03-08 04:17:07'),
(52, '2023-03-08 22:31:19', 'TK85N35', 'asasa', 'asas', '', 1, 3, 94574, 8, '2023-03-08 04:17:09'),
(55, '2023-03-08 22:31:19', 'TK40N38', 'asas', 'asasas', '', 1, 3, 94574, 8, '2023-03-08 04:17:18'),
(56, '2023-03-08 22:31:19', 'TK18N39', 'asasa', 'asasa', '', 1, 3, 94574, 8, '2023-03-08 04:17:20'),
(57, '2023-03-08 22:31:19', 'TK16N40', 'asasa', 'asasas', '', 1, 3, 94574, 8, '2023-03-08 04:17:22'),
(58, '2023-03-08 22:31:19', 'TK53N41', 'asas', 'asasa', '', 1, 3, 94574, 8, '2023-03-08 04:17:25'),
(60, '2023-03-08 22:31:19', 'TK63N43', 'asa', 'asa', 'asasa', 1, 3, 94576, 12, '2023-03-14 04:04:25'),
(61, '2023-03-08 22:31:19', 'TK25N44', 'asa', 'asa', '', 1, 3, 94574, 12, '2023-03-08 04:34:39'),
(62, '2023-03-08 22:31:19', 'TK27N45', 'asa', 'asa', '', 1, 3, 94574, 12, '2023-03-08 04:34:43'),
(63, '2023-03-08 22:31:19', 'TK38N46', 'aa', 'ASAS', '', 1, 3, 94574, 8, '2023-03-08 04:34:48'),
(65, '2023-03-15 05:34:35', 'TK13N37', 'Tóner', 'Toner para impresora DCP-LC5650DN', 'Pendiente', 29, 2523, 94575, 1, '2023-03-15 05:34:39');

--
-- Disparadores `ticket`
--
DELIMITER $$
CREATE TRIGGER `Eliminarregistro_alteracionesTicket` BEFORE DELETE ON `ticket` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"Eliminar", OLD.id,"ticket")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registro_alteracionesTickets` AFTER UPDATE ON `ticket` FOR EACH ROW INSERT INTO registro_alteraciones (usuario,accion,idAlterado,tabla)   VALUES (0,"", NEW.id,"ticket")
$$
DELIMITER ;

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
  ADD UNIQUE KEY `id_num` (`email_cliente`),
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
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`idEstatus`);

--
-- Indices de la tabla `registro_alteraciones`
--
ALTER TABLE `registro_alteraciones`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `Fk_RegistroAlteraciones` (`usuario`);

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2525;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `idEstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94577;

--
-- AUTO_INCREMENT de la tabla `registro_alteraciones`
--
ALTER TABLE `registro_alteraciones`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9948;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `DEPASTICKET` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TI` FOREIGN KEY (`idUsuario`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TICKETESTATUS` FOREIGN KEY (`idStatus`) REFERENCES `estatus` (`idEstatus`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_atiendes` FOREIGN KEY (`id_atiende`) REFERENCES `cliente` (`id_cliente`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
