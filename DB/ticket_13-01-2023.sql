-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2023 a las 20:28:27
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
(1, 'Leonardo Sainos Perez', 'LeonardoSainos', 'leonardosainos@gmail.com', '8c53d46d0b6bffe80bf72a042788f4de', NULL, NULL, NULL, '2023-01-13 17:09:26', 0);

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
(2505, 'Sin departamento', '', '', 3, 5);

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
(94573, 'Vacaciones');

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
(9947, 'COMUN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `serie` varchar(100) NOT NULL,
  `estado_ticket` varchar(60) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `email_cliente` varchar(60) NOT NULL,
  `departamento` varchar(70) NOT NULL,
  `asunto` varchar(70) NOT NULL,
  `mensaje` text NOT NULL,
  `solucion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `fecha`, `serie`, `estado_ticket`, `nombre_usuario`, `email_cliente`, `departamento`, `asunto`, `mensaje`, `solucion`) VALUES
(6, '2023-01-10 23:30:41', 'TK25N6', 'Abierto', 'Alondra Sanchez', 'alondraSanchez@gmail.com', 'Sistemas', 'No funciona la impresora', 'Prueba', 'Cambiarla'),
(9, '2023-01-11 22:48:20', 'TK26N3', 'Pendiente', 'Super Administrador', 'administrador@gmail.com', 'Ventas', 'asa', 'asas', ''),
(10, '2023-01-11 22:49:05', 'TK21N4', 'Pendiente', 'Super Administrador', 'administrador@gmail.com', 'Ventas', 'asa', 'asas', ''),
(11, '2023-01-11 22:49:10', 'TK66N5', 'Pendiente', 'Super Administrador', 'administrador@gmail.com', 'Ventas', 'Prueba', 'sadsd', ''),
(12, '2023-01-11 23:16:46', 'TK65N5', 'Pendiente', '', 'administrador@gmail.com', 'Ventas', '', 'PRUEBA', ''),
(13, '2023-01-11 23:17:03', 'TK55N6', 'Pendiente', '', 'administrador@gmail.com', 'Ventas', '', 'PRUEBA', '');

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
  ADD KEY `FK_ROL` (`id_rol`);

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
  ADD UNIQUE KEY `serie` (`serie`);

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2506;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `idEstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94574;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9948;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
