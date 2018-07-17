-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-06-2018 a las 02:10:49
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consorciodb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Consorcio`
--

CREATE TABLE `Consorcio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion_numero` varchar(11) DEFAULT NULL,
  `direccion_calle` varchar(45) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `cod_postal` varchar(6) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `encargado` varchar(100) DEFAULT NULL,
  `condicion` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Consorcio`
--

INSERT INTO `Consorcio` (`id`, `nombre`, `direccion_numero`, `direccion_calle`, `localidad`, `cod_postal`, `telefono`, `email`, `latitud`, `longitud`, `encargado`, `condicion`) VALUES
(1, 'consorcio uno', '123', 'calle uno', 'moron', '1765', '1231325', 'asdfasd@asdfasd', 123, 123, 'juan perushia', 1),
(2, 'nombre', '123', 'direccioon', 'localidad', '213', '1234', 'email@email', NULL, NULL, 'encargado', 1),
(3, 'nombre', '123', 'direccioon', 'localidad', '213', '1234', 'email@email', NULL, NULL, 'encargado', 1),
(4, 'nombre', '123', 'direccioon', 'localidad', '213', '1234', 'email@email', NULL, NULL, 'encargado', 1),
(5, 'Gerardo Palet', '123', 'avenida de mayo 1825', 'ramos mejia', '1704', '1136433247', 'paletgerardo@gmail.com', NULL, NULL, 'Gerardo Palet', 1),
(6, 'nombre', '123', 'direccioon', 'localidad', '213', '1234', 'email@email', NULL, NULL, 'encargado', 1),
(7, 'El Masi', '1', 'la mas cortita', '', '1704', '1136433247', 'paletgerardo@gmail.com', NULL, NULL, 'Gerardo Palet', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoCuenta`
--

CREATE TABLE `EstadoCuenta` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `interes` float DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `propiedad_id` int(11) NOT NULL,
  `expensa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Expensa`
--

CREATE TABLE `Expensa` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `gasto_reclamo_id` int(11) DEFAULT NULL,
  `usuario_proveedor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Item`
--

CREATE TABLE `Item` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `valor` float DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `Expensa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Propiedad`
--

CREATE TABLE `Propiedad` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `metros_cuadrados` float DEFAULT NULL,
  `consorcio_id` int(11) NOT NULL,
  `usuario_propietario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Role`
--

CREATE TABLE `Role` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Role`
--

INSERT INTO `Role` (`id`, `tipo`, `descripcion`) VALUES
(1, 'Administrador', 'acceso total a la cuenta'),
(2, 'operario', 'acceso a determindos modulos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `dni` mediumtext NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `login` varchar(10) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `role_id` int(11) NOT NULL,
  `condicion` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `nombre`, `apellido`, `direccion`, `dni`, `fecha_nacimiento`, `telefono`, `email`, `login`, `clave`, `role_id`, `condicion`) VALUES
(1, 'Gerardo', 'Palet', 'paris 634', '30052723', '1983-03-12', '15-3643-3247', 'paletgerardo@gmail.com', 'gerr', '120383..', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Consorcio`
--
ALTER TABLE `Consorcio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `EstadoCuenta`
--
ALTER TABLE `EstadoCuenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Expensa`
--
ALTER TABLE `Expensa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Item`
--
ALTER TABLE `Item`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Propiedad`
--
ALTER TABLE `Propiedad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo_UNIQUE` (`tipo`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Consorcio`
--
ALTER TABLE `Consorcio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `EstadoCuenta`
--
ALTER TABLE `EstadoCuenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Expensa`
--
ALTER TABLE `Expensa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Item`
--
ALTER TABLE `Item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Propiedad`
--
ALTER TABLE `Propiedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Role`
--
ALTER TABLE `Role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
