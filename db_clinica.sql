-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2017 a las 00:49:54
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_clinica2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carreras`
--

CREATE TABLE `tbl_carreras` (
  `id_carrera` int(8) NOT NULL,
  `nombre_carrera` varchar(100) NOT NULL,
  `id_facultad` int(8) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_citas` (
  `id_cita` int(11) NOT NULL,
  `id_tipo_cita` int(2) NOT NULL,
  `nro_cuenta` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(2) NOT NULL,
  `id_medico` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_citas`
--

INSERT INTO `tbl_citas` (`id_cita`, `id_tipo_cita`, `nro_cuenta`, `fecha`, `estado`, `id_medico`) VALUES
(1, 1, '123', '2017-04-18', 1, 1),
(2, 2, '2012', '2017-04-21', 1, 1),
(3, 3, '2013', '2017-04-21', 1, 2),
(4, 1, '2015', '2017-04-21', 1, 2),
(5, 2, '2016', '2017-04-21', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_enfermeria`
--

CREATE TABLE `tbl_enfermeria` (
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
(1, 23, 55, 67, 43, 89),
(2, 34, 65, 76, 87, 23),
(3, 12, 45, 34, 79, 12),
(4, 56, 65, 12, 24, 32),
(5, 12, 12, 32, 45, 85);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_facultades`
--

CREATE TABLE `tbl_facultades` (
  `id_facultad` int(8) NOT NULL,
  `nombre_facultad` varchar(100) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_medicos` (
  `id_medico` int(11) NOT NULL,
  `id_tipo_medico` int(11) NOT NULL,
  `nombre_medico` varchar(100) NOT NULL,
  `genero` varchar(2) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_medicos`
--

INSERT INTO `tbl_medicos` (`id_medico`, `id_tipo_medico`, `nombre_medico`, `genero`, `estado`) VALUES
(1, 1, 'nombre medico 1', 'M', '1'),
(2, 2, 'nombre medico 2', 'F', '1'),
(3, 1, 'NOMBRE DOCTOR', 'F', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pacientes`
--

CREATE TABLE `tbl_pacientes` (
  `nro_cuenta` varchar(15) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `genero` varchar(1) NOT NULL,
  `id_carrera` int(8) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_pacientes`
--

INSERT INTO `tbl_pacientes` (`nro_cuenta`, `nombres`, `apellidos`, `fecha_nacimiento`, `telefono`, `genero`, `id_carrera`, `estado`) VALUES
('2001559896', 'Roberto', 'Ramirez Lopez', '2017-04-08', '22334455', 'M', 8, 1),
('20018989223', 'Katherine', 'NuÃ±ez', '2017-04-08', '32225567', 'F', 2, 1),
('2012', 'maria', 'suarez', '2017-04-21', '235345', 'F', 1, 1),
('2013', 'carlos', 'jimenez', '2016-11-15', '32342494', 'M', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_citas`
--

CREATE TABLE `tbl_tipo_citas` (
  `id_tipo_cita` int(2) NOT NULL,
  `nombre_cita` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_citas`
--

INSERT INTO `tbl_tipo_citas` (`id_tipo_cita`, `nombre_cita`) VALUES
(1, 'CITA 1'),
(2, 'CITA 2'),
(3, 'CITA3'),
(4, 'CITA4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_medicos`
--

CREATE TABLE `tbl_tipo_medicos` (
  `id_tipo_medico` int(11) NOT NULL,
  `nombre_tipo_medico` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_medicos`
--

INSERT INTO `tbl_tipo_medicos` (`id_tipo_medico`, `nombre_tipo_medico`) VALUES
(1, 'GENERAL'),
(2, 'ODONTOLOGO'),
(3, 'GINECOLOGIA'),
(4, 'VIH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_usuario`
--

CREATE TABLE `tbl_tipo_usuario` (
  `id_tipo_usuario` int(8) NOT NULL,
  `nombre_tipo_usuario` varchar(50) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(8) NOT NULL,
  `id_tipo_usuario` int(8) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `estado_usuario` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(8, 1, 'guty', 'asdf1234', 1),
(9, 2, 'roger', 'asdf1234', 1),
(10, 1, 'bernardo', 'asdf1234', 1),
(11, 3, 'edwin', 'asdf1234', 1),
(12, 2, 'admin', 'fdsa1234', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_carreras`
--
ALTER TABLE `tbl_carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `tbl_citas`
--
ALTER TABLE `tbl_citas`
  ADD PRIMARY KEY (`id_cita`);

--
-- Indices de la tabla `tbl_enfermeria`
--
ALTER TABLE `tbl_enfermeria`
  ADD PRIMARY KEY (`id_cita`);

--
-- Indices de la tabla `tbl_facultades`
--
ALTER TABLE `tbl_facultades`
  ADD PRIMARY KEY (`id_facultad`);

--
-- Indices de la tabla `tbl_medicos`
--
ALTER TABLE `tbl_medicos`
  ADD PRIMARY KEY (`id_medico`);

--
-- Indices de la tabla `tbl_pacientes`
--
ALTER TABLE `tbl_pacientes`
  ADD PRIMARY KEY (`nro_cuenta`);

--
-- Indices de la tabla `tbl_tipo_citas`
--
ALTER TABLE `tbl_tipo_citas`
  ADD PRIMARY KEY (`id_tipo_cita`);

--
-- Indices de la tabla `tbl_tipo_medicos`
--
ALTER TABLE `tbl_tipo_medicos`
  ADD PRIMARY KEY (`id_tipo_medico`);

--
-- Indices de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_carreras`
--
ALTER TABLE `tbl_carreras`
  MODIFY `id_carrera` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tbl_citas`
--
ALTER TABLE `tbl_citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tbl_facultades`
--
ALTER TABLE `tbl_facultades`
  MODIFY `id_facultad` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_medicos`
--
ALTER TABLE `tbl_medicos`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_citas`
--
ALTER TABLE `tbl_tipo_citas`
  MODIFY `id_tipo_cita` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_medicos`
--
ALTER TABLE `tbl_tipo_medicos`
  MODIFY `id_tipo_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  MODIFY `id_tipo_usuario` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
