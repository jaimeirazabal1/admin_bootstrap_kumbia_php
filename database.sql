-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-10-2015 a las 19:15:47
-- Versión del servidor: 5.5.44-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `admin_bootstrap_kumbia_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE IF NOT EXISTS `contratos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creado_por` int(11) NOT NULL COMMENT 'usuario_id',
  `pertenece_a` int(11) NOT NULL COMMENT 'usuario_id',
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `numero_preforma` text COLLATE utf8_unicode_ci,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `creado_por`, `pertenece_a`, `descripcion`, `numero_preforma`, `created`) VALUES
(1, 1, 1, 'contrato de prueba con documento', '981981981981891', '2015-10-27 20:46:47'),
(2, 1, 2, 'contrato de prueba con  2', '198123132156', '2015-10-27 21:02:20'),
(3, 1, 3, 'contrato de prueba con  2223', '18919819819819819', '2015-10-27 21:02:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contratos_id` int(11) NOT NULL COMMENT 'id del contrato',
  `subido_por` int(11) NOT NULL COMMENT 'usuario_id',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_documento` int(11) NOT NULL COMMENT 'tipos_id',
  `url` text COLLATE utf8_unicode_ci,
  `estado` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dhl` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `contratos_id`, `subido_por`, `created`, `tipo_documento`, `url`, `estado`, `dhl`) VALUES
(1, 1, 1, '2015-10-27 20:46:47', 1, '/files/upload/2015_10_27_16_46_47_Contrato corregido 2.pdf', NULL, NULL),
(2, 2, 1, '2015-10-27 21:02:20', 1, '/files/upload/2015_10_27_17_02_20_Contrato corregido 2.pdf', NULL, NULL),
(3, 3, 1, '2015-10-27 21:02:32', 1, '/files/upload/2015_10_27_17_02_32_Contrato corregido 2.pdf', NULL, NULL),
(6, 2, 1, '2015-10-27 22:52:00', 2, '/files/upload/2015_10_27_18_52_00_workana.pdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `tipo`, `descripcion`) VALUES
(1, 'CONTRATO', 'CONTRATO INICIAL'),
(2, 'Tipo de documento 1', 'descripcion de tipo de documento 1'),
(3, 'Tipo de documento 2', 'descripcion de tipo de documento 2'),
(4, 'Tipo de documento 3', 'descripcion de tipo de documento 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `empresa` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8_unicode_ci,
  `rol` enum('A','U','C','I') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `clave`, `nombre`, `empresa`, `email`, `rol`) VALUES
(1, 'd41d8cd98f00b204e9800998ecf8427e', 'jaimeirazabal1', 'Empresa 1', 'jaimeirazabal1@gmail.com', 'A'),
(2, '25f9e794323b453885f5181f1b624d0b', 'Pepito', 'Empresa 2', 'pepe@gmail.com', 'C'),
(3, 'ffc150a160d37e92012c196b6af4160d', 'victor_empresa', 'Empresa Victor', 'victo_@gmail.com', 'C');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
