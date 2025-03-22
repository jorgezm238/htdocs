-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2025 a las 15:47:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `diabetesdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comida`
--

CREATE TABLE `comida` (
  `tipo_comida` varchar(30) NOT NULL,
  `gl_1h` int(11) NOT NULL,
  `gl_2h` int(11) NOT NULL,
  `raciones` int(11) NOT NULL,
  `insulina` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comida`
--

INSERT INTO `comida` (`tipo_comida`, `gl_1h`, `gl_2h`, `raciones`, `insulina`, `fecha`, `id_usu`) VALUES
('', 11, 11, 11, 11, '2025-01-13', 1),
('', 111, 111, 111, 111, '2025-02-26', 1),
('Cena', 5, 5, 6, 7, '2025-02-25', 1),
('Cena', 111, 111, 111, 111, '2025-02-26', 1),
('Comida', 11, 11, 11, 11, '2025-01-13', 1),
('Comida', 11, 11, 11, 11, '2025-01-28', 1),
('Comida', 5, 5, 6, 7, '2025-02-25', 1),
('Comida', 222, 222, 222, 222, '2025-02-27', 1),
('Desayuno', 11, 11, 11, 11, '2025-01-28', 1),
('Desayuno', 12, 12, 12, 12, '2025-02-12', 1),
('Desayuno', 11, 11, 11, 11, '2025-02-19', 1),
('Desayuno', 5, 5, 6, 7, '2025-02-25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_glucosa`
--

CREATE TABLE `control_glucosa` (
  `fecha` date NOT NULL,
  `deporte` int(11) NOT NULL,
  `lenta` int(11) NOT NULL,
  `id_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `control_glucosa`
--

INSERT INTO `control_glucosa` (`fecha`, `deporte`, `lenta`, `id_usu`) VALUES
('2025-01-13', 11, 11, 1),
('2025-01-28', 11, 11, 1),
('2025-02-12', 12, 12, 1),
('2025-02-19', 11, 11, 1),
('2025-02-25', 3, 4, 1),
('2025-02-26', 111, 1111, 1),
('2025-02-27', 1111, 1111, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hiperglucemia`
--

CREATE TABLE `hiperglucemia` (
  `glucosa` int(11) NOT NULL,
  `hora` time NOT NULL,
  `correccion` int(11) NOT NULL,
  `tipo_comida` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `id_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hiperglucemia`
--

INSERT INTO `hiperglucemia` (`glucosa`, `hora`, `correccion`, `tipo_comida`, `fecha`, `id_usu`) VALUES
(2, '03:33:00', 333, 'Cena', '2025-02-25', 1),
(11111, '19:32:00', 113, 'Cena', '2025-02-26', 1),
(2, '03:33:00', 333, 'Comida', '2025-02-25', 1),
(2, '03:33:00', 333, 'Desayuno', '2025-02-25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hipoglucemia`
--

CREATE TABLE `hipoglucemia` (
  `glucosa` int(11) NOT NULL,
  `hora` time NOT NULL,
  `tipo_comida` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `id_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hipoglucemia`
--

INSERT INTO `hipoglucemia` (`glucosa`, `hora`, `tipo_comida`, `fecha`, `id_usu`) VALUES
(11, '11:11:00', '', '2025-01-13', 1),
(111, '11:11:00', '', '2025-02-26', 1),
(11, '11:11:00', 'Comida', '2025-01-13', 1),
(11, '11:11:00', 'Comida', '2025-01-28', 1),
(222, '21:31:00', 'Comida', '2025-02-27', 1),
(11, '11:11:00', 'Desayuno', '2025-01-28', 1),
(12, '12:21:00', 'Desayuno', '2025-02-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `contra` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `fecha_nacimiento`, `nombre`, `apellidos`, `usuario`, `contra`) VALUES
(1, '2025-02-04', 'david', 'perez', 'usu', '$2y$10$Kq4w1jT.ghjXw.DQW6vApOgQhqEm3n4k49/PLb3eNARJ7ASEH9HKi'),
(4, '2004-01-26', 'Jorge', 'Zardain', 'jorgeeee', '$2y$10$TqpQAO7UCjBcY13bIlnVpOF0HNw1X69JZsdebuiX/eWC1d1xfFGhK'),
(5, '2000-12-10', 'Daniel', 'Freite', 'danieeeeel', '$2y$10$wG9DByfVH5hTVrsIYusu3uNtf2I.kVVN36HHaNfvDt/M4yao8Efvq');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comida`
--
ALTER TABLE `comida`
  ADD PRIMARY KEY (`tipo_comida`,`fecha`,`id_usu`),
  ADD KEY `fecha` (`fecha`,`id_usu`);

--
-- Indices de la tabla `control_glucosa`
--
ALTER TABLE `control_glucosa`
  ADD PRIMARY KEY (`fecha`,`id_usu`),
  ADD KEY `id_usu` (`id_usu`);

--
-- Indices de la tabla `hiperglucemia`
--
ALTER TABLE `hiperglucemia`
  ADD PRIMARY KEY (`tipo_comida`,`fecha`,`id_usu`);

--
-- Indices de la tabla `hipoglucemia`
--
ALTER TABLE `hipoglucemia`
  ADD PRIMARY KEY (`tipo_comida`,`fecha`,`id_usu`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comida`
--
ALTER TABLE `comida`
  ADD CONSTRAINT `comida_ibfk_1` FOREIGN KEY (`fecha`,`id_usu`) REFERENCES `control_glucosa` (`fecha`, `id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `control_glucosa`
--
ALTER TABLE `control_glucosa`
  ADD CONSTRAINT `control_glucosa_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hiperglucemia`
--
ALTER TABLE `hiperglucemia`
  ADD CONSTRAINT `hiperglucemia_ibfk_1` FOREIGN KEY (`tipo_comida`,`fecha`,`id_usu`) REFERENCES `comida` (`tipo_comida`, `fecha`, `id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hipoglucemia`
--
ALTER TABLE `hipoglucemia`
  ADD CONSTRAINT `hipoglucemia_ibfk_1` FOREIGN KEY (`tipo_comida`,`fecha`,`id_usu`) REFERENCES `comida` (`tipo_comida`, `fecha`, `id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
