-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2017 a las 23:15:03
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_clinica3`
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
  PRIMARY KEY (`id_carrera`),
  KEY `id_facultad` (`id_facultad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_carreras`
--

INSERT INTO `tbl_carreras` (`id_carrera`, `nombre_carrera`, `id_facultad`, `estado`) VALUES
(1, 'ING. EN SISTEMAS', 1, 1),
(2, 'ING. QUIMICA', 1, 1),
(3, 'ING. CIVIL', 1, 1),
(4, 'PEDAGOGIA', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_citas`
--

CREATE TABLE IF NOT EXISTS `tbl_citas` (
  `id_cita` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_cita` int(2) NOT NULL,
  `nro_cuenta` varchar(15) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` int(2) NOT NULL,
  `id_medico` int(8) NOT NULL,
  PRIMARY KEY (`id_cita`),
  KEY `id_tipo_cita` (`id_tipo_cita`),
  KEY `nro_cuenta` (`nro_cuenta`),
  KEY `id_medico` (`id_medico`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tbl_citas`
--

INSERT INTO `tbl_citas` (`id_cita`, `id_tipo_cita`, `nro_cuenta`, `fecha`, `estado`, `id_medico`) VALUES
(1, 1, '20091234178', '2017-05-08 00:00:00', 3, 2),
(2, 2, '20101234177', '2017-05-08 06:11:16', 3, 2),
(3, 1, '20131012145', '2017-05-08 15:13:14', 1, 3),
(4, 2, '20091234178', '2017-05-09 01:15:11', 2, 2),
(5, 1, '20101234177', '2017-05-09 01:17:31', 1, 3),
(6, 1, '20091234178', '2017-05-09 22:24:06', 1, 2);

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
  `talla` float NOT NULL,
  PRIMARY KEY (`id_cita`),
  KEY `id_cita` (`id_cita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_enfermeria`
--

INSERT INTO `tbl_enfermeria` (`id_cita`, `temperatura`, `presion`, `pulso`, `peso`, `talla`) VALUES
(1, 45, 67, 53, 75, 89),
(2, 67, 87, 34, 75, 79),
(3, 45, 67, 21, 68, 78);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_facultades`
--

CREATE TABLE IF NOT EXISTS `tbl_facultades` (
  `id_facultad` int(8) NOT NULL AUTO_INCREMENT,
  `nombre_facultad` varchar(100) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_facultad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_facultades`
--

INSERT INTO `tbl_facultades` (`id_facultad`, `nombre_facultad`, `estado`) VALUES
(1, 'Facultad de Ingenieria', 1),
(2, 'Facultad de Humanidades', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_medicos`
--

CREATE TABLE IF NOT EXISTS `tbl_medicos` (
  `id_medico` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_medico` varchar(100) NOT NULL,
  `apellido_medico` varchar(50) NOT NULL,
  `genero` varchar(2) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_sala` int(8) NOT NULL,
  PRIMARY KEY (`id_medico`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_usuario_2` (`id_usuario`),
  KEY `id_sala` (`id_sala`),
  KEY `id_sala_2` (`id_sala`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_medicos`
--

INSERT INTO `tbl_medicos` (`id_medico`, `nombre_medico`, `apellido_medico`, `genero`, `estado`, `id_usuario`, `id_sala`) VALUES
(2, 'Pedro', 'Galvez', 'M', '1', 3, 1),
(3, 'Marlen', 'Vargas', 'F', '1', 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_medicos_x_tipo_cita`
--

CREATE TABLE IF NOT EXISTS `tbl_medicos_x_tipo_cita` (
  `id_medico` int(11) NOT NULL,
  `id_tipo_cita` int(2) NOT NULL,
  KEY `fk_medicos_tipo_cita` (`id_medico`),
  KEY `fk_tipo_cita_medicos` (`id_tipo_cita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_medicos_x_tipo_cita`
--

INSERT INTO `tbl_medicos_x_tipo_cita` (`id_medico`, `id_tipo_cita`) VALUES
(2, 1),
(2, 2),
(3, 1),
(3, 3);

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
  PRIMARY KEY (`nro_cuenta`),
  KEY `id_carrera` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_pacientes`
--

INSERT INTO `tbl_pacientes` (`nro_cuenta`, `nombres`, `apellidos`, `fecha_nacimiento`, `telefono`, `genero`, `id_carrera`, `estado`) VALUES
('20091234178', 'Maria', 'Lopez', '1991-05-02', '3388976', 'F', 2, 1),
('20101234177', 'Marvin', 'Jimenez', '1990-05-01', '234145544', 'M', 1, 1),
('20131012145', 'Melvin', 'Suarez', '1995-05-09', '33425612', 'M', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salas`
--

CREATE TABLE IF NOT EXISTS `tbl_salas` (
  `id_sala` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sala` varchar(10) NOT NULL,
  `estado_sala` int(1) NOT NULL,
  PRIMARY KEY (`id_sala`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_salas`
--

INSERT INTO `tbl_salas` (`id_sala`, `nombre_sala`, `estado_sala`) VALUES
(1, 'sala 01', 1),
(2, 'sala 02', 1),
(3, 'sala 03', 0),
(4, 'sala 04', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_citas`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_citas` (
  `id_tipo_cita` int(2) NOT NULL AUTO_INCREMENT,
  `nombre_cita` varchar(50) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_tipo_cita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_tipo_citas`
--

INSERT INTO `tbl_tipo_citas` (`id_tipo_cita`, `nombre_cita`, `estado`) VALUES
(1, 'CONSULTA GENERAL', 1),
(2, 'ETS', 1),
(3, 'GINECOLOGIA', 1),
(4, 'ODONTOLOGIA', 1);

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
(2, 'MEDICO', 1),
(3, 'ENFERMERIA', 1),
(4, 'ARCHIVO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tv`
--

CREATE TABLE IF NOT EXISTS `tbl_tv` (
  `id_cita` int(11) NOT NULL,
  `nro_cuenta` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `sala` varchar(15) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tv`
--

INSERT INTO `tbl_tv` (`id_cita`, `nro_cuenta`, `nombre`, `sala`, `fecha`) VALUES
(4, '20091234178', 'Maria', '2', '2017-05-09 22:22:05');

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
  `estado_asignado` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `id_tipo_usuario`, `usuario`, `password`, `estado_usuario`, `estado_asignado`) VALUES
(1, 1, 'admin', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 1, 0),
(2, 4, 'archivo', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 1, 0),
(3, 2, 'MEDICO1', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 1, 1),
(4, 2, 'MEDICO2', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 1, 1),
(5, 3, 'enfermeria', 'f58cf5e7e10f195e21b553096d092c763ed18b0e', 1, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_carreras`
--
ALTER TABLE `tbl_carreras`
  ADD CONSTRAINT `tbl_carreras_ibfk_1` FOREIGN KEY (`id_facultad`) REFERENCES `tbl_facultades` (`id_facultad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_citas`
--
ALTER TABLE `tbl_citas`
  ADD CONSTRAINT `tbl_citas_ibfk_1` FOREIGN KEY (`nro_cuenta`) REFERENCES `tbl_pacientes` (`nro_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_citas_ibfk_2` FOREIGN KEY (`id_tipo_cita`) REFERENCES `tbl_tipo_citas` (`id_tipo_cita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_citas_ibfk_3` FOREIGN KEY (`id_medico`) REFERENCES `tbl_medicos` (`id_medico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_enfermeria`
--
ALTER TABLE `tbl_enfermeria`
  ADD CONSTRAINT `tbl_enfermeria_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `tbl_citas` (`id_cita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_medicos`
--
ALTER TABLE `tbl_medicos`
  ADD CONSTRAINT `fk_medicos_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medicos_sala` FOREIGN KEY (`id_sala`) REFERENCES `tbl_salas` (`id_sala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_medicos_x_tipo_cita`
--
ALTER TABLE `tbl_medicos_x_tipo_cita`
  ADD CONSTRAINT `tbl_medicos_x_tipo_cita_ibfk_1` FOREIGN KEY (`id_tipo_cita`) REFERENCES `tbl_tipo_citas` (`id_tipo_cita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_medicos_x_tipo_cita_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `tbl_medicos` (`id_medico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_pacientes`
--
ALTER TABLE `tbl_pacientes`
  ADD CONSTRAINT `tbl_pacientes_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `tbl_carreras` (`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tbl_tipo_usuario` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
