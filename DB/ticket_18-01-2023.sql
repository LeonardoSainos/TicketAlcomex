-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2023 a las 19:25:00
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
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
  `nombre_completo` varchar(100) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `clave` text NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `telefono_celular` varchar(10) DEFAULT NULL,
  `Fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idEstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_completo`, `nombre_usuario`, `email_cliente`, `clave`, `id_departamento`, `id_rol`, `telefono_celular`, `Fecha_creacion`, `idEstatus`) VALUES
(1, 'Leonardo Sainos Perez', 'LeonardoSainos', 'leonardosainos@gmail.com', '8c53d46d0b6bffe80bf72a042788f4de', 10, 4046, '2228412398', '2023-01-17 17:19:58', 19231),
(3, 'Alondra Sanchez Torivio', 'Alo250518', 'alondrasanchez@gmail.com', '12345678', 8, 9947, '2228660690', '2023-01-17 18:28:23', 31448),
(4, 'Gabriela Perez Anselmo', 'GabyPerez', 'gabyperez@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2506, 9947, '2225469884', '2023-01-17 20:37:32', 31448);

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
  `idJefe` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombre`, `correo`, `descripcion`, `idEstatus`, `idJefe`) VALUES
(3, 'Prueba', 'Prueba@gmail.com', 'esto es una prueba', 3, 21),
(7, 'Talleres', 'deportes@utpuebla.edu.mx', 'Talleres deportivos y culturales ', 3, 21),
(8, '      Servicios', 'alexis@gmail.com', 'Esto  es una prueba ', 3, 5),
(9, 'Titulacion', 'titulacion@utpuebla.mx', 'Esta es el area de titulacion ', 3, 21),
(10, 'Laboratorios', 'leonardosainos@gmail.com', 'Laboratorios', 2, 21),
(2505, 'Sin departamento', '', '', 3, 5),
(2506, 'Cuentas por cobrar', 'cuentasporcobrar@alcomex.mx', 'Departamento del área de finanzas', 31448, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enviocorreo`
--

CREATE TABLE `enviocorreo` (
  `correo` varchar(200) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL
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
(1324, 'ANONIMO'),
(4046, 'ADMINISTRADOR'),
(5267, 'AGENTE'),
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
  `mensaje` text NOT NULL,
  `solucion` text NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `fecha`, `serie`, `asunto`, `mensaje`, `solucion`, `idUsuario`, `idDepartamento`, `idStatus`) VALUES
(6, '2023-01-10 23:30:41', 'TK25N6', 'No funciona la impresora', 'Prueba', 'Bien ', 1, 3, 94576),
(9, '2023-01-11 22:48:20', 'TK26N3', 'asa', 'asas', 'AASASA', 1, 10, 94576),
(10, '2023-01-11 22:49:05', 'TK21N4', 'asa', 'asas', 'ASASA', 1, 9, 94576),
(11, '2023-01-11 22:49:10', 'TK66N5', 'Prueba', 'sadsd', 'cAMBIAR', 1, 10, 94574),
(12, '2023-01-11 23:16:46', 'TK65N5', 'ASDDFGHJK', 'PRUEBA', 'ASDFGH', 1, 3, 25542),
(13, '2023-01-11 23:17:03', 'TK55N6', 'PRUEBA', 'PRUEBA', 'PRUEBA', 1, 3, 94575),
(14, '2023-01-13 19:56:36', 'TK62N7', 'Prueba de base de datos', 'Prueba de base de datos', 'Prueba 12:19', 1, 3, 94576),
(15, '2023-01-13 23:53:49', 'TKN22', 'Prueba nuevas tablas', 'lo mismo', '', 1, 10, 19231);

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
  ADD KEY `FK_TICKETESTATUS` (`idStatus`);

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2507;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `idEstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94577;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9948;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `FK_TICKETESTATUS` FOREIGN KEY (`idStatus`) REFERENCES `estatus` (`idEstatus`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
