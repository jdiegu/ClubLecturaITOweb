-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2025 a las 18:45:18
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
-- Base de datos: `clublectura`
--
CREATE DATABASE IF NOT EXISTS `clublectura` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `clublectura`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances`
--

CREATE TABLE `avances` (
  `id_avance` int(11) NOT NULL,
  `num_control` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `paginas_leidas` int(11) NOT NULL,
  `comentario` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `paginas_totales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `avances`
--

INSERT INTO `avances` (`id_avance`, `num_control`, `id_libro`, `paginas_leidas`, `comentario`, `fecha`, `paginas_totales`) VALUES
(7, 1, 1, 2, 'si', '2025-05-25', 2),
(8, 1, 1, 0, '', '2025-05-25', 0),
(9, 1, 2, 0, '', '2025-05-26', 0),
(10, 1, 1, 0, '', '2025-05-30', 0),
(11, 1, 1, 0, '', '2025-05-30', 0),
(12, 1, 6, 0, '', '2025-05-31', 0),
(13, 1, 6, 0, '', '2025-05-31', 0),
(14, 1, 1, 0, '', '2025-05-31', 0),
(37, 2, 2, 10, 'Casi acabo aaaaaa bbbbbbb aaaaaaa', '2025-06-01', 100),
(39, 2, 1, 1000, 'asdasd sad asdaa', '2025-06-01', 1100112),
(41, 2, 6, 10, 'Esto es un comentario de avance', '2025-06-01', 40),
(42, 2, 8, 0, '', '2025-06-01', 0),
(43, 2, 9, 0, '', '2025-06-02', 0),
(44, 2, 6, 10, 'apenas empece', '2025-06-02', 500),
(45, 2, 8, 0, '', '2025-06-02', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `horario` time NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `lugar` varchar(60) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `nombre`, `fecha`, `horario`, `descripcion`, `lugar`, `imagen`) VALUES
(1, 'Inicio de actividades', '2025-05-14', '12:00:00', 'Inicio de las actividades del club de lectura en el ciclo 2029', 'Biblioteca del instituto', 'media/prueba.jpg'),
(5, 'Reunion extraoficial', '2025-06-03', '16:04:00', 'algo de descripcion desccriptiva', 'Aqui y alla', ''),
(7, 'Libro de prueba', '2025-06-18', '10:25:00', 'sfghj', 'Aqui', 'media/prueba.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `portada` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `nombre`, `descripcion`, `autor`, `genero`, `portada`) VALUES
(1, 'Pedro Paramo', 'La historia de Juan Preciado, quien viaja al pueblo ficticio de Comala en busca de su padre, Pedro Paramo.', 'Juan Rulfo', 'Novela', 'media/pedroparamo.jpg'),
(2, 'La Odisea', 'La epopeya griega de Homero que narra el viaje de regreso a Ítaca del héroe Odiseo después de la Guerra de Troya.', 'Homero', 'Epopeya', 'media/odisea.jpg'),
(6, 'Libro de prueba', 'asdasdas', 'Yo', 'Epica', 'media/portada.jpg'),
(8, 'Cien años de soledad', 'La historia de la familia Buendía en el pueblo ficticio de Macondo, a través de siete generaciones.', 'Gabriel Garcia Marquez', 'Novela', 'uploads/Cienañosdesoledad.jpg'),
(9, 'Veinte mil leguas de viaje submarino', 'LAs aventuras a bordo del submarino Nautilus, comandado por el misterioso Capitán Nemo.', 'Julio Verne', 'Novela', 'uploads/Veintemilleguasdeviajesubmarino.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `num_control` int(11) NOT NULL,
  `mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `id_libro`, `num_control`, `mensaje`) VALUES
(4, 1, 2, 'hola este es un mensaje a todos los autobots que estan ocultos en las estrellas'),
(8, 2, 2, 'HOla'),
(9, 2, 2, 'as'),
(10, 2, 2, 'ESOOOOOO'),
(12, 2, 2, '\"hola\"'),
(14, 8, 2, 'Hola'),
(15, 1, 22010912, 'Holaaa'),
(16, 1, 22010912, 'hola este es un mensaje'),
(19, 8, 2, 'HOla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participaciones`
--

CREATE TABLE `participaciones` (
  `id_participacion` int(11) NOT NULL,
  `num_control` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `participaciones`
--

INSERT INTO `participaciones` (`id_participacion`, `num_control`, `id_evento`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 1, 5),
(6, 1, 5),
(7, 1, 1),
(8, 1, 5),
(9, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `num_control` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ap_paterno` varchar(50) NOT NULL,
  `ap_materno` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1= Administrador\r\n2 = usuario ',
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`num_control`, `nombre`, `ap_paterno`, `ap_materno`, `correo`, `contrasena`, `tipo`, `imagen`) VALUES
(1, 'Diego', 'Morales', 'Vazquez', 'exampe@gmail.com', '1234', 1, 'media/perfil.jpg'),
(2, 'usuarioNormal', 'algo', 'algo2', 'example@correo.com', '1234', 2, 'media/prueba.jpg'),
(5, 'Diegu1', 'Morales', 'Vazquez', 'asdasdasdas', '1234', 2, ''),
(12, 'Abraham', 'Garcia', 'Antonio', 'asdasdasdas', '1234', 2, ''),
(20, 'Abraham', 'Garcia', 'Antonio', 'asdasdasdas', '1234', 2, ''),
(22, 'Abraham', 'Garcia', 'Antonio', 'asdasdasdas', '1234', 2, ''),
(2210969, 'Diegu', 'Morales', 'Vazquez', 'asdasdasdas', '12345', 2, 'uploads/2210969.jpg'),
(22010883, 'Aelyn', 'Acosta', 'Peña', 'asdasdasdas', '12345', 2, 'uploads/u22010883.jpeg'),
(22010912, 'Abraham', 'Garcia', 'Antonio', 'asdasdasdas', '1234', 2, 'uploads/u22010912.jpeg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `avances`
--
ALTER TABLE `avances`
  ADD PRIMARY KEY (`id_avance`),
  ADD KEY `userAvance` (`num_control`),
  ADD KEY `libroAvance` (`id_libro`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `userMensaje` (`num_control`),
  ADD KEY `libroMensaje` (`id_libro`);

--
-- Indices de la tabla `participaciones`
--
ALTER TABLE `participaciones`
  ADD PRIMARY KEY (`id_participacion`),
  ADD KEY `userPaticipa` (`num_control`),
  ADD KEY `eventoParticipa` (`id_evento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`num_control`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `avances`
--
ALTER TABLE `avances`
  MODIFY `id_avance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `participaciones`
--
ALTER TABLE `participaciones`
  MODIFY `id_participacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `avances`
--
ALTER TABLE `avances`
  ADD CONSTRAINT `libroAvance` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `userAvance` FOREIGN KEY (`num_control`) REFERENCES `usuarios` (`num_control`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `libroMensaje` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  ADD CONSTRAINT `userMensaje` FOREIGN KEY (`num_control`) REFERENCES `usuarios` (`num_control`);

--
-- Filtros para la tabla `participaciones`
--
ALTER TABLE `participaciones`
  ADD CONSTRAINT `eventoParticipa` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`),
  ADD CONSTRAINT `userPaticipa` FOREIGN KEY (`num_control`) REFERENCES `usuarios` (`num_control`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
