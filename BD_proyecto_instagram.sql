-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-10-2023 a las 00:51:21
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_instagram`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `image_id` int NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_User` (`user_id`),
  KEY `id_Image` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `image_id`, `content`, `created_at`, `updated_at`) VALUES
(10, 4, 8, 'Buena imagen', '2023-10-24 02:46:42', '2023-10-24 02:46:42'),
(11, 5, 8, 'Que imagen mas loca!!!', '2023-10-24 02:47:20', '2023-10-24 02:47:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_User` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `user_id`, `image_path`, `description`, `created_at`, `updated_at`) VALUES
(4, 1, '1695948293frutas.jpg', 'Varias frutas', '2023-09-29 00:00:00', '2023-09-29 00:00:00'),
(5, 1, '1695948302naturaleza.jpg', 'Naturaleza', '2023-09-29 00:00:00', '2023-09-29 00:00:00'),
(6, 1, '1695948312paisaje.jpg', 'Primer paisaje', '2023-09-29 00:00:00', '2023-09-29 00:00:00'),
(7, 1, '1695948321paisaje2.jpg', 'Segundo paisaje', '2023-09-29 00:00:00', '2023-09-29 00:00:00'),
(8, 1, '1697047455aa.png', 'Imagen Optica', '2023-09-29 00:00:00', '2023-10-11 00:00:00'),
(9, 4, '1698108808Imagen1.jpg', 'Diseño N°1', '2023-10-24 00:00:00', '2023-10-24 00:00:00'),
(12, 4, '1698115536Imagen2.jpg', 'Diseño N°2', '2023-10-24 02:45:36', '2023-10-24 02:45:36'),
(13, 4, '1698115582Imagen3.jpg', 'Diseño N°3', '2023-10-24 02:46:22', '2023-10-24 02:46:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `image_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_User` (`user_id`),
  KEY `id_Image` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `image_id`, `created_at`, `updated_at`) VALUES
(15, 1, 7, '2023-10-11 00:00:00', '2023-10-11 00:00:00'),
(17, 1, 6, '2023-10-11 00:00:00', '2023-10-11 00:00:00'),
(18, 1, 8, '2023-10-11 00:00:00', '2023-10-11 00:00:00'),
(19, 4, 4, '2023-10-24 00:00:00', '2023-10-24 00:00:00'),
(20, 4, 5, '2023-10-24 00:00:00', '2023-10-24 00:00:00'),
(22, 4, 8, '2023-10-24 02:46:48', '2023-10-24 02:46:48'),
(23, 5, 8, '2023-10-24 02:47:02', '2023-10-24 02:47:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('gonzalomasson@hotmail.com.ar', '$2y$10$m9LqRWRJ/hXKOnRhVz2xVeBUOV0MI8AUI6IqCrsLBrS3ut9.vDuUS', '2023-10-27 00:43:51'),
('gonzalomasson993@gmail.com', '$2y$10$H36wj8I8fUk6lsZ8IUSZNe9WVkLthdgrzi/EtoPBdTit5DKTUnTNa', '2023-10-27 00:45:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nick` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `remember_Token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `nick`, `email`, `password`, `image`, `created_at`, `updated_at`, `remember_Token`) VALUES
(1, NULL, 'Admin', 'Server', 'Administrador', 'admin@hotmail.com.ar', '$2y$10$7sFewzKml0DhDND1FIIpSOCXyfZf2suAjAs4UhHVMno4vQC/.PNwK', '1695922058lol2.jpg', '2023-09-23 00:00:00', '2023-09-28 00:00:00', NULL),
(4, 'Usuario', 'Fernando', 'Aquiles', 'fer56', 'fernando@hotmail.com.ar', '$2y$10$dvXzCktK9AnUGW9LSNKMl.BwEpdmPlGxXzJVwNGExuy9FRAvIDDwO', '1698108775fotoPerfilFernando.jpg', '2023-10-24 00:00:00', '2023-10-24 00:00:00', NULL),
(5, 'Usuario', 'Manuel', 'Ress', 'manuRess', 'manuelress@gmail.com.ar', '$2y$10$I/zKMlpWZhtlzwtdNl9tNOV.3M7ilN5wispPcXt8JlwPMqDX/jTcq', '1698111175fotoPerfilManuel.jpg', '2023-10-24 00:00:00', '2023-10-24 00:00:00', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
