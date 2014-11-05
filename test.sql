-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2014 a las 03:27:26
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `test`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Administración'),
(2, 'Ventas'),
(3, 'Recursos Humanos'),
(4, 'Contabilidad'),
(5, 'Gerencia'),
(6, 'Robotica'),
(7, 'Artes'),
(8, 'Gatronomia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `group_id`, `username`, `password`, `age`) VALUES
(1, 'Carlos', 'Alvarez', 'carlos@gmail.com', 1, 'Carlos', 'Carlos1', 0),
(2, 'Eduardo', 'Poot', 'eduardo@gmail.com', 2, 'Eduardo', 'Eduardo2', 0),
(3, 'Andres', 'Fuentes', 'andres@gmail.com', 5, 'Andres', 'Andres3', 0),
(4, 'Jose', 'Bastos', 'jose@gmail.com', 4, 'Jose', 'Jose4', 0),
(5, 'Santiago', 'Benitez', 'santiago@gmail.com', 3, 'Santiago', 'Santiago5', 0),
(6, 'Cintia', 'Cortes', 'cintia@gmail.com', 3, 'Cintia', 'Cintia6', 0),
(7, 'Bianca', 'Controras', 'bianca@gmail.com', 2, 'Bianca', 'Bianca7', 0),
(8, 'Monica', 'Trujillo', 'monica@gmail.com', 1, 'Monica', 'Monica8', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
