-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-09-2019 a las 04:37:04
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clontube`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_ID` int(11) NOT NULL,
  `usuarios_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarios_email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuarios_password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuarios_ip` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuarios_ultimo_login` timestamp NULL DEFAULT NULL,
  `usuarios_imagen` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuarios_ID`, `usuarios_fecha`, `usuarios_email`, `usuarios_password`, `usuarios_ip`, `usuarios_ultimo_login`, `usuarios_imagen`) VALUES
(2, '2019-08-31 14:50:27', 'javier@gmail.com', 'df19bce3452360d2c9e29d6f7ea8b441', '::1', '2019-09-09 23:56:02', 'imagenes/pensar.png'),
(3, '2019-08-31 14:52:19', 'jav@gmail.com', 'd137f8fc74', '::1', NULL, '');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usuarios_y_videos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `usuarios_y_videos` (
`usuarios_ID` int(11)
,`usuarios_fecha` timestamp
,`usuarios_email` varchar(60)
,`usuarios_password` varchar(60)
,`usuarios_ip` varchar(30)
,`usuarios_ultimo_login` timestamp
,`usuarios_imagen` varchar(60)
,`videos_ID` int(11)
,`videos_fecha` timestamp
,`videos_url` varchar(200)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `videos_ID` int(11) NOT NULL,
  `videos_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `videos_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `videos_usuarios_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`videos_ID`, `videos_fecha`, `videos_url`, `videos_usuarios_ID`) VALUES
(1, '2019-09-05 00:49:28', 'video/video.mp4', 2),
(2, '2019-09-06 03:44:36', 'qweqwasdas', 2),
(3, '2019-09-06 23:40:57', 'welqwjelkqw', 2);

-- --------------------------------------------------------

--
-- Estructura para la vista `usuarios_y_videos`
--
DROP TABLE IF EXISTS `usuarios_y_videos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usuarios_y_videos`  AS  select `usuarios`.`usuarios_ID` AS `usuarios_ID`,`usuarios`.`usuarios_fecha` AS `usuarios_fecha`,`usuarios`.`usuarios_email` AS `usuarios_email`,`usuarios`.`usuarios_password` AS `usuarios_password`,`usuarios`.`usuarios_ip` AS `usuarios_ip`,`usuarios`.`usuarios_ultimo_login` AS `usuarios_ultimo_login`,`usuarios`.`usuarios_imagen` AS `usuarios_imagen`,`videos`.`videos_ID` AS `videos_ID`,`videos`.`videos_fecha` AS `videos_fecha`,`videos`.`videos_url` AS `videos_url` from (`usuarios` join `videos` on((`usuarios`.`usuarios_ID` = `videos`.`videos_usuarios_ID`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_ID`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`videos_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `videos_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
