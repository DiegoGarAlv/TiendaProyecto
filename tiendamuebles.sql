-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2018 a las 21:52:44
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP DATABASE IF EXISTS tiendamuebles;
CREATE DATABASE tiendamuebles;
USE tiendamuebles;
--
-- Base de datos: `tiendamuebles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`dni`, `nombre`, `direccion`, `usuario`, `password`) VALUES
('1', 'diego', 'calle1', 'admin', 'admin'),
('2', 'adrian', 'calle2', 'adrian', 'adrian'),
('3', 'ivan', 'calle3', 'ivan', 'ivan'),
('4', 'david', 'calle4', 'david', 'david');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `cod` varchar(6) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`cod`, `nombre`) VALUES
('1', 'escritorio'),
('2', 'silla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `num_pedido` int(4) NOT NULL,
  `num_linea` int(11) NOT NULL,
  `producto` varchar(12) NOT NULL,
  `unidades` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`num_pedido`, `num_linea`, `producto`, `unidades`) VALUES
(1, 1, '9', 2),
(2, 1, '4', 1),
(3, 1, '5', 3),
(4, 1, '7', 1),
(5, 1, '3', 5),
(1, 2, '1', 1),
(2, 2, '7', 1),
(3, 2, '8', 1),
(4, 2, '6', 1),
(2, 3, '9', 1),
(3, 3, '3', 1),
(4, 3, '10', 1),
(3, 4, '6', 2),
(4, 4, '8', 1),
(4, 5, '9', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `num_pedido` int(4) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `fecha` date NOT NULL,
  `total_pedido` decimal(9,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`num_pedido`, `dni`, `fecha`, `total_pedido`) VALUES
(1, '2', '2018-01-14', '750'),
(2, '2', '2018-01-14', '700'),
(3, '3', '2018-01-14', '820'),
(4, '4', '2018-01-14', '659'),
(5, '4', '2018-01-14', '500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `cod` varchar(12) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `nombre_corto` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `PVP` decimal(10,2) NOT NULL,
  `familia` varchar(6) NOT NULL,
  `stock` int(3) NOT NULL,
  `imagen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`cod`, `nombre`, `nombre_corto`, `descripcion`, `PVP`, `familia`, `stock`, `imagen`) VALUES
('1', 'Micke', 'mic', 'Escritorio confortable de conglomerado', '250.00', '1', 10, '1.jpg'),
('10', 'Volmar', 'vol', 'Silla con altura regulable ', '49.00', '2', 10, '10.jpg'),
('2', 'Thyge', 'thy', 'Escritorio con altura regulable', '150.00', '1', 10, '2.jpg'),
('3', 'Bekant', 'bek', 'Para oficinas pequeñas este es tu escritorio', '100.00', '1', 10, '3.jpg'),
('4', 'Brusali', 'bru', 'Estilo moderno y diseño vanguardista', '300.00', '1', 10, '4.jpg'),
('5', 'Luns', 'lun', 'Simple y minimalista con madera de calidad', '150.00', '1', 10, '5.jpg'),
('6', 'Tobias', 'tob', 'Confortable y juvenil', '60.00', '2', 10, '6.jpg'),
('7', 'Agam', 'aga', 'Estilo elegante sin dejar de lado la comodidad', '150.00', '2', 10, '7.jpg'),
('8', 'Renberget', 'ren', 'Para los que la comodidad es lo más importante', '150.00', '2', 10, '8.jpg'),
('9', 'Millberget', 'mil', 'Clásica y de grandes dimensiones, ideal para ejecutivos', '250.00', '2', 10, '9.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`num_linea`,`num_pedido`) USING BTREE,
  ADD KEY `lineas_fk_2` (`producto`),
  ADD KEY `lineas_fk_1` (`num_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`num_pedido`),
  ADD KEY `pedidos_fk_1` (`dni`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `producto_fk_1` (`familia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `num_pedido` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD CONSTRAINT `lineas_fk_1` FOREIGN KEY (`num_pedido`) REFERENCES `pedidos` (`num_pedido`),
  ADD CONSTRAINT `lineas_fk_2` FOREIGN KEY (`producto`) REFERENCES `producto` (`cod`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_fk_1` FOREIGN KEY (`dni`) REFERENCES `clientes` (`dni`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_fk_1` FOREIGN KEY (`familia`) REFERENCES `familia` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
