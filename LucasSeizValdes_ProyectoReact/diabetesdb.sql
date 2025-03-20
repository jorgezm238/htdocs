-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2025 a las 18:53:02
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
  `id_comida` int(11) NOT NULL,
  `tipo_comida` varchar(30) NOT NULL,
  `gl_1h` int(11) NOT NULL,
  `gl_2h` int(11) NOT NULL,
  `raciones` int(11) NOT NULL,
  `insulina` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_usu` int(11) NOT NULL,
  `fecha_comida` varchar(50) GENERATED ALWAYS AS (concat(`fecha`,'-',`tipo_comida`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comida`
--

INSERT INTO `comida` (`id_comida`, `tipo_comida`, `gl_1h`, `gl_2h`, `raciones`, `insulina`, `fecha`, `id_usu`) VALUES
(1, 'Desayuno', 1, 1, 1, 1, '2025-02-20', 1),
(2, 'Comida', 2, 2, 2, 2, '2025-02-20', 1),
(3, 'Cena', 3, 3, 3, 2, '2025-02-20', 1),
(4, 'Desayuno', 1, 1, 1, 1, '2025-02-21', 1),
(5, 'Desayuno', 1, 1, 1, 1, '2025-02-24', 3),
(6, 'Desayuno', 1, 1, 1, 1, '2025-02-25', 3),
(7, 'Comida', 1, 1, 1, 1, '2025-02-24', 3),
(8, 'Cena', 3, 3, 3, 3, '2025-02-24', 3),
(9, 'Desayuno', 12, 24, 2, 2, '2025-02-25', 4),
(10, 'Desayuno', 1, 1, 1, 1, '2025-02-28', 4);

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
('2025-02-20', 1, 1, 1),
('2025-02-21', 1, 1, 1),
('2025-02-24', 15, 2, 3),
('2025-02-25', 20, 8, 3),
('2025-02-25', 1, 100, 4),
('2025-02-28', 1, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hiperglucemia`
--

CREATE TABLE `hiperglucemia` (
  `id_hiper` int(11) NOT NULL,
  `glucosa` int(11) NOT NULL,
  `hora` time NOT NULL,
  `correccion` int(11) NOT NULL,
  `tipo_comida` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `id_usu` int(11) NOT NULL,
  `fecha_comida` varchar(50) GENERATED ALWAYS AS (concat(`fecha`,'-',`tipo_comida`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hipoglucemia`
--

CREATE TABLE `hipoglucemia` (
  `id_hipo` int(11) NOT NULL,
  `glucosa` int(11) NOT NULL,
  `hora` time NOT NULL,
  `tipo_comida` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `id_usu` int(11) NOT NULL,
  `fecha_comida` varchar(50) GENERATED ALWAYS AS (concat(`fecha`,'-',`tipo_comida`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hipoglucemia`
--

INSERT INTO `hipoglucemia` (`id_hipo`, `glucosa`, `hora`, `tipo_comida`, `fecha`, `id_usu`) VALUES
(1, 1, '11:11:00', 'Desayuno', '2025-02-20', 1),
(2, 2, '22:22:00', 'Comida', '2025-02-20', 1),
(3, 3, '03:03:00', 'Cena', '2025-02-20', 1),
(4, 1, '11:11:00', 'Desayuno', '2025-02-21', 1),
(5, 2, '18:44:00', 'Desayuno', '2025-02-24', 3),
(6, 1, '18:45:00', 'Desayuno', '2025-02-25', 3),
(7, 1, '18:45:00', 'Comida', '2025-02-24', 3),
(8, 3, '22:52:00', 'Cena', '2025-02-24', 3),
(9, 10, '16:41:00', 'Desayuno', '2025-02-25', 4),
(10, 1, '11:11:00', 'Desayuno', '2025-02-28', 4);

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
  `contra` varchar(255) NOT NULL,
  `rol` enum('usuario','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `fecha_nacimiento`, `nombre`, `apellidos`, `usuario`, `contra`, `rol`) VALUES
(1, '2025-02-20', 'usu', 'usu', 'usu', 'con', 'usuario'),
(2, '2025-02-20', 'mesi', 'mesi', 'mesi', 'mesi', 'usuario'),
(3, '2025-02-24', 'Lucas', 'Seiz Valdes', 'Lucascomsv', '$2y$10$0Z3P9jVbPcqgMSJDoULc9e6mko5TI3KeJchQqx4ecioVFmO8GIyP6', 'usuario'),
(4, '2025-02-25', 'lucas', 'seiz', '1', '$2y$10$VFCYyBiRQ71KRaFYfrMayOppiiXoQ4JdxUUAImnnj4jXQrbEmByDS', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comida`
--
ALTER TABLE `comida`
  ADD PRIMARY KEY (`id_comida`),
  ADD UNIQUE KEY `idx_comida_fecha_comida_id` (`fecha_comida`,`id_usu`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `fecha` (`fecha`,`id_usu`);

--
-- Indices de la tabla `control_glucosa`
--
ALTER TABLE `control_glucosa`
  ADD PRIMARY KEY (`fecha`,`id_usu`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `idx_fecha_id_usu` (`fecha`,`id_usu`);

--
-- Indices de la tabla `hiperglucemia`
--
ALTER TABLE `hiperglucemia`
  ADD PRIMARY KEY (`id_hiper`),
  ADD UNIQUE KEY `uniq_hiper_fecha_comida` (`fecha_comida`,`id_usu`);

--
-- Indices de la tabla `hipoglucemia`
--
ALTER TABLE `hipoglucemia`
  ADD PRIMARY KEY (`id_hipo`),
  ADD UNIQUE KEY `uniq_hipo_fecha_comida` (`fecha_comida`,`id_usu`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comida`
--
ALTER TABLE `comida`
  MODIFY `id_comida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `hiperglucemia`
--
ALTER TABLE `hiperglucemia`
  MODIFY `id_hiper` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hipoglucemia`
--
ALTER TABLE `hipoglucemia`
  MODIFY `id_hipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comida`
--
ALTER TABLE `comida`
  ADD CONSTRAINT `comida_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id_usu`),
  ADD CONSTRAINT `comida_ibfk_2` FOREIGN KEY (`fecha`,`id_usu`) REFERENCES `control_glucosa` (`fecha`, `id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `control_glucosa`
--
ALTER TABLE `control_glucosa`
  ADD CONSTRAINT `control_glucosa_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hiperglucemia`
--
ALTER TABLE `hiperglucemia`
  ADD CONSTRAINT `hiperglucemia_ibfk_1` FOREIGN KEY (`fecha_comida`,`id_usu`) REFERENCES `comida` (`fecha_comida`, `id_usu`) ON DELETE CASCADE;

--
-- Filtros para la tabla `hipoglucemia`
--
ALTER TABLE `hipoglucemia`
  ADD CONSTRAINT `hipoglucemia_ibfk_1` FOREIGN KEY (`fecha_comida`,`id_usu`) REFERENCES `comida` (`fecha_comida`, `id_usu`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
