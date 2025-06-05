-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2025 a las 07:11:08
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
  `id_libro` int(11) DEFAULT NULL,
  `paginas_leidas` int(11) NOT NULL,
  `comentario` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `paginas_totales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `avances`
--

INSERT INTO `avances` (`id_avance`, `num_control`, `id_libro`, `paginas_leidas`, `comentario`, `fecha`, `paginas_totales`) VALUES
(37, 2, 2, 10, 'Casi acabo aaaaaa bbbbbbb aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-06-01', 100),
(39, 2, 1, 110013, 'asdasd sad asdaa', '2025-06-01', 110013),
(42, 2, 8, 0, '', '2025-06-01', 0),
(43, 2, 9, 0, '', '2025-06-02', 0),
(45, 2, 8, 0, '', '2025-06-02', 0),
(46, 85010155, 11, 0, '', '2025-06-03', 0),
(47, 85010155, 11, 500, 'dfghjkzsxdfcgbnkml,szdxfcgbjnmk,cfvgbhnm,', '2025-06-03', 50),
(48, 85010155, 9, 0, '', '2025-06-03', 0),
(49, 85010155, 9, 0, '', '2025-06-03', 0),
(50, 85010155, 9, 0, '', '2025-06-03', 0),
(51, 2, 2, 40, 'cada vez menos', '2025-06-04', 100),
(52, 2, 2, 70, 'otro ', '2025-06-04', 100),
(53, 2, 2, 80, 'mas', '2025-06-04', 100),
(54, 2, 2, 90, 'aun no', '2025-06-04', 100),
(55, 2, 2, 95, 'A1', '2025-06-04', 100),
(56, 2, 14, 0, 'Comencé a leer este libro', '2025-06-04', 0);

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
(11, '1ra Reunion', '2025-06-09', '11:00:00', 'Primera reunion oficial de club', 'Biblioteca del instituto', 'uploads/1raReunion.jpg');

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
(12, 'Veinte Mil Leguas de Viaje Submarino', 'El profesor Aronnax, el arponero Ned Land y su criado Conseil son capturados por el misterioso Capitán Nemo y forzados a viajar a bordo de su submarino, el Nautilus.', 'Julio Verne', 'Novela', 'uploads/VeinteMilLeguasdeViajeSubmarino.jpg'),
(13, 'Cien años de soledad', 'La historia de siete generaciones de la familia Buendía en el pueblo ficticio de Macondo, Colombia...', ' Gabriel García Márquez', 'Novela', 'uploads/Cienañosdesoledad.jpg'),
(14, 'El Principito', 'Es un cuento poético sobre un piloto que se encuentra perdido en el desierto del Sahara y conoce a un niño llamado el Principito, quien proviene de un asteroide muy pequeño.', 'Antoine de Saint-Exupéry', 'Cuento Infantil', 'uploads/ElPrincipito.png');

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
(15, 1, 22010912, 'Holaaa'),
(16, 1, 22010912, 'hola este es un mensaje'),
(25, 14, 2, 'Hola');

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
(13, 2, 1),
(14, 2, 11);

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
(2210969, 'Diegu', 'Morales', 'Vazquez', 'asdasdasdas', '12345', 2, 'uploads/2210969.jpg'),
(22010883, 'Aelyn', 'Acosta', 'Peña', 'asdasdasdas', '12345', 2, 'uploads/u22010883.jpeg'),
(22010912, 'Abraham', 'Garcia', 'Antonio', 'asdasdasdas', '1234', 2, 'uploads/u22010912.jpeg'),
(85010155, 'Patricia', 'Quitl', 'Gonzalez', 'patricia.qg@orizaba.tecnm.mx', 'raton123', 2, 'uploads/u85010155.jpeg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `avances`
--
ALTER TABLE `avances`
  ADD PRIMARY KEY (`id_avance`),
  ADD KEY `libroAvance` (`id_libro`),
  ADD KEY `userAvance` (`num_control`);

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
  MODIFY `id_avance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `participaciones`
--
ALTER TABLE `participaciones`
  MODIFY `id_participacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `libroMensaje` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE,
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
