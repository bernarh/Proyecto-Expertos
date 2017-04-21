-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2017 a las 03:59:18
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carreras`
--

CREATE TABLE IF NOT EXISTS `tbl_carreras` (
  `id_carrera` int(8) NOT NULL AUTO_INCREMENT,
  `nombre_carrera` varchar(100) NOT NULL,
  `id_facultad` int(8) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_carrera`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tbl_carreras`
--

INSERT INTO `tbl_carreras` (`id_carrera`, `nombre_carrera`, `id_facultad`, `estado`) VALUES
(1, 'INGENIERIA EN SISTEMAS', 1, 1),
(2, 'INGENIERIA INDUSTRIAL', 1, 1),
(5, 'INGENIERIA MECANICA', 1, 2),
(6, 'INGENIERIA ELECTRICA', 1, 0),
(7, 'INGENIERIA ELECTRICA', 1, 0),
(8, 'INGENIERIA ELECTRICA INDUSTRIAL ', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_citas`
--

CREATE TABLE IF NOT EXISTS `tbl_citas` (
  `id_cita` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_cita` int(2) NOT NULL,
  `nro_cuenta` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(2) NOT NULL,
  `id_medico` int(8) NOT NULL,
  PRIMARY KEY (`id_cita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_enfermeria`
--

CREATE TABLE IF NOT EXISTS `tbl_enfermeria` (
  `id_cita` int(11) NOT NULL,
  `temperatura` float NOT NULL,
  `presion` float NOT NULL,
  `pulso` float NOT NULL,
  `peso` float NOT NULL,
  `talla` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_enfermeria`
--

INSERT INTO `tbl_enfermeria` (`id_cita`, `temperatura`, `presion`, `pulso`, `peso`, `talla`) VALUES
(10, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_facultades`
--

CREATE TABLE IF NOT EXISTS `tbl_facultades` (
  `id_facultad` int(8) NOT NULL AUTO_INCREMENT,
  `nombre_facultad` varchar(100) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_facultad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_facultades`
--

INSERT INTO `tbl_facultades` (`id_facultad`, `nombre_facultad`, `estado`) VALUES
(1, 'FACULTAD DE INGENIERIA', 1),
(2, 'FACULTAD DE CIENCIAS MEDICAS', 1),
(3, 'FACULTAD DE CIENNCIAS MAEDICAS 2', 2),
(4, 'FACULTAD DE HUMANIDADES Y ARTE', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_medicos`
--

CREATE TABLE IF NOT EXISTS `tbl_medicos` (
  `id_medico` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_medico` int(11) NOT NULL,
  `nombre_medico` varchar(100) NOT NULL,
  `genero` varchar(2) NOT NULL,
  `estado` varchar(2) NOT NULL,
  PRIMARY KEY (`id_medico`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_medicos`
--

INSERT INTO `tbl_medicos` (`id_medico`, `id_tipo_medico`, `nombre_medico`, `genero`, `estado`) VALUES
(1, 1, 'nombre medico 1', 'M', '1'),
(2, 2, 'nombre medico 2', 'F', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pacientes`
--

CREATE TABLE IF NOT EXISTS `tbl_pacientes` (
  `nro_cuenta` varchar(15) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `genero` varchar(1) NOT NULL,
  `id_carrera` int(8) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`nro_cuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_pacientes`
--

INSERT INTO `tbl_pacientes` (`nro_cuenta`, `nombres`, `apellidos`, `fecha_nacimiento`, `telefono`, `genero`, `id_carrera`, `estado`) VALUES
('123', 'sansita', 'asd', '2017-04-19', '1232', 'F', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_citas`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_citas` (
  `id_tipo_cita` int(2) NOT NULL AUTO_INCREMENT,
  `nombre_cita` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo_cita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_medicos`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_medicos` (
  `id_tipo_medico` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_medico` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo_medico`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_tipo_medicos`
--

INSERT INTO `tbl_tipo_medicos` (`id_tipo_medico`, `nombre_tipo_medico`) VALUES
(1, 'GENERAL'),
(2, 'ODONTOLOGO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_usuario` (
  `id_tipo_usuario` int(8) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_usuario` varchar(50) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_tipo_usuario`
--

INSERT INTO `tbl_tipo_usuario` (`id_tipo_usuario`, `nombre_tipo_usuario`, `estado`) VALUES
(1, 'ADMINISTRADOR', 1),
(2, 'TIPO 2', 2),
(3, 'Nuevo Tipo 2', 2),
(4, 'TIPO 1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `id_usuario` int(8) NOT NULL AUTO_INCREMENT,
  `id_tipo_usuario` int(8) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `estado_usuario` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `id_tipo_usuario`, `usuario`, `password`, `estado_usuario`) VALUES
(1, 2, 'gama2.com', 'asd123', 1),
(2, 0, 'prueba', 'asd', 1),
(3, 1, 'prueba', 'zzzzzzzzzzzz', 2),
(4, 2, 'insertando', 'asd', 2),
(5, 1, 'asd', '1234asdf', 1),
(6, 1, 'asd', 'asdf1234', 2),
(7, 1, 'asdf', '12345678', 1),
(8, 1, 'guty', 'Ã±llllllll', 1),
(9, 2, 'roger', 'asdf1234', 1),
(10, 1, 'bernardo', 'asdf1234', 1),
(11, 3, 'edwin', 'asdf1234', 1),
(12, 2, 'admin', 'fdsa1234', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
