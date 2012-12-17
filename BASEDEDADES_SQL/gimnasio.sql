-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-12-2012 a las 19:43:27
-- Versión del servidor: 5.5.22
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gimnasio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
  `idActividad` int(10) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(30) NOT NULL DEFAULT '0',
  `precio` float NOT NULL DEFAULT '0',
  `numHoras` int(10) NOT NULL DEFAULT '0',
  `descripcion` varchar(130) NOT NULL,
  `id_Entrenador` int(11) NOT NULL,
  PRIMARY KEY (`idActividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`idActividad`, `actividad`, `precio`, `numHoras`, `descripcion`, `id_Entrenador`) VALUES
(5, 'Actividad0', 0, 0, '0000', 19),
(6, 'actividad50', 1000, 92, '', 0),
(7, 'actividad51', 55, 23, '', 0),
(8, 'actividad53', 74, 21, '', 0),
(11, 'Actividad11', 74, 12, '', 0),
(12, 'actividad33', 432, 21, '', 0),
(13, 'Actividad111', 21, 21, '', 0),
(15, 'ActividadPro', 100, 15, 'panelGay', 4),
(16, 'ActividadFinal', 122, 122, 'ActividadFinalisima', 0),
(17, '0000', 0, 0, '0000', 0),
(18, '1', 1000, 1, '1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_Cliente` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL DEFAULT '0',
  `apellido1` varchar(20) NOT NULL DEFAULT '0',
  `apellido2` varchar(20) NOT NULL DEFAULT '0',
  `direccion` varchar(100) NOT NULL DEFAULT '0',
  `telefono` int(12) NOT NULL DEFAULT '0',
  `fecha` text NOT NULL,
  `tipoCliente` enum('normal','VIP') NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`id_Cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_Cliente`, `nombre`, `apellido1`, `apellido2`, `direccion`, `telefono`, `fecha`, `tipoCliente`) VALUES
(2, 'oro', 'oro', 'oro', 'oro', 91919, '9', 'normal'),
(3, 'oro2', 'oro2', 'oro2', 'oro2', 999999991, '9', 'normal'),
(7, 'EEE', 'EEE', 'EEE', 'EEE', 999, '999', 'normal'),
(8, 'X', 'W', 'w', 'w', 9191919, '12', 'normal'),
(9, 'BB', 'BB', 'BB', 'BB', 99, '99', 'normal'),
(10, 'dfasdfas', 'dfasdfas', 'dfasdfas', 'asdfasd', 131231231, '0.001491053677932405', 'normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenador`
--

CREATE TABLE IF NOT EXISTS `entrenador` (
  `id_Entrenador` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL DEFAULT '0',
  `apellido1` varchar(20) NOT NULL DEFAULT '0',
  `apellido2` varchar(20) NOT NULL DEFAULT '0',
  `telefono` int(12) NOT NULL DEFAULT '0',
  `jornadaCompleta` enum('media','completa') NOT NULL DEFAULT 'media',
  `foto` varchar(1000) DEFAULT '../entrenador/foto/perfil.png',
  PRIMARY KEY (`id_Entrenador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `entrenador`
--

INSERT INTO `entrenador` (`id_Entrenador`, `nombre`, `apellido1`, `apellido2`, `telefono`, `jornadaCompleta`, `foto`) VALUES
(18, 'FGLKJFGLJK', 'JKLFKLJJKL', 'LKJLKJKLJ', 93045856, 'media', '../entrenador/foto/1.png'),
(19, 'EntrenadorPrueva', 'Segundo', 'Segundo', 9191919, 'media', '../entrenador/foto/perfil.png'),
(23, 'dfas', 'dfas', 'adfs', 13, 'media', '../entrenador/foto/perfil.png'),
(24, 'qqqqq', 'qqqqq', 'qqqqq', 999999999, 'media', '../entrenador/foto/perfil.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estaen`
--

CREATE TABLE IF NOT EXISTS `estaen` (
  `idCliente` int(11) NOT NULL,
  `actividad1` int(11) NOT NULL,
  `actividad2` int(11) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estaen`
--

INSERT INTO `estaen` (`idCliente`, `actividad1`, `actividad2`) VALUES
(2, 11, 8),
(6, 6, 5),
(8, 8, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `user` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipo` enum('normal','entrenador','admin') NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user`, `password`, `tipo`) VALUES
('javier', 'javier', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
