-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2018 a las 11:58:37
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdexcursiones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuntados`
--

CREATE TABLE `apuntados` (
  `id` int(11) NOT NULL,
  `nickUsuario` varchar(20) NOT NULL,
  `tituloExcursion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `apuntados`
--

INSERT INTO `apuntados` (`id`, `nickUsuario`, `tituloExcursion`) VALUES
(2, 'Narduril', 'Alicante'),
(3, 'Narduril', 'DisneyLand París');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `excursiones`
--

CREATE TABLE `excursiones` (
  `titulo` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `excursiones`
--

INSERT INTO `excursiones` (`titulo`, `fecha`, `descripcion`) VALUES
('Alicante', '2018-02-20', 'Pasaremos el día en Alicante y visitaremos el Castillo de Santa Bárbara.'),
('DisneyLand París', '2017-12-23', 'Podremos ver al Pato Donald en directo.'),
('Isla de Benidorm', '2018-02-14', 'Viajaremos a la Isla de Benidorm en barco y pasaremos el día en este paraje natural.'),
('Tabarca', '2018-01-29', 'Iremos en el Kon Tiki desde el puerto de Alicante.'),
('Terra Mítica', '2018-01-31', 'Excursión al parque de atracciones de Benidorm. Todo el día.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nick` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nombreCompleto` varchar(30) NOT NULL,
  `esProfesor` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nick`, `password`, `nombreCompleto`, `esProfesor`) VALUES
('Narduril', '381989', 'Manuel', 0),
('Neo2k', 'zxcmnb', 'Juan', 0),
('Okuwona', '12345', 'Fran', 0),
('profesor', 'qwerty', 'Manuel Santiago Gavilan', 1),
('Santipezzz', '3181983', 'David', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apuntados`
--
ALTER TABLE `apuntados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nickUsuario` (`nickUsuario`),
  ADD KEY `tituloExcursion` (`tituloExcursion`);

--
-- Indices de la tabla `excursiones`
--
ALTER TABLE `excursiones`
  ADD PRIMARY KEY (`titulo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nick`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apuntados`
--
ALTER TABLE `apuntados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apuntados`
--
ALTER TABLE `apuntados`
  ADD CONSTRAINT `apuntados_ibfk_1` FOREIGN KEY (`nickUsuario`) REFERENCES `usuarios` (`nick`) ON DELETE CASCADE,
  ADD CONSTRAINT `apuntados_ibfk_2` FOREIGN KEY (`tituloExcursion`) REFERENCES `excursiones` (`titulo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
