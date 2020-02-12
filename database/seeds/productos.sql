-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-02-2020 a las 18:29:50
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `galletas`
--

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `tipo_productos_id`, `tipo_displays_id`, `marca_displays_id`, `unidades_id`, `cantidad_x_display`, `cantidad`, `peso`, `descripcion`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 1.60, 1.00, 1.60, NULL, 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(2, 1, 1, 1, 2, 1.20, 1.00, 1.20, NULL, 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(3, 1, 1, 2, 2, 1.05, 1.00, 1.05, NULL, 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(4, 1, 2, 2, 2, 5.00, 1.00, 0.95, NULL, 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(5, 1, 2, 1, 2, 5.00, 1.00, 0.95, NULL, 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(6, 1, 2, 1, 2, 5.00, 1.00, 0.70, NULL, 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(7, 1, 2, 1, 2, 10.00, 1.00, 1.70, NULL, 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(8, 1, 2, 1, 2, 10.00, 1.00, 1.40, NULL, 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(9, 1, 2, 2, 2, 10.00, 1.00, 1.65, NULL, 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(10, 3, 3, 1, 1, 1.00, 1.00, 1.00, 'Blanco', 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(11, 3, 3, 1, 1, 1.00, 1.00, 1.00, 'Integral', 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(12, 4, 4, 1, 1, 1.00, 1.00, 1.00, '', 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(13, 4, 5, 2, 1, 1.00, 1.00, 1.00, '', 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18'),
(14, 1, 1, 1, 2, 1.00, 1.00, 1.20, '', 1, '2020-02-11 17:21:18', '2020-02-11 17:21:18');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
