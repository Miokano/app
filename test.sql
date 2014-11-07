-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2014 a las 15:37:28
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Administracion'),
(2, 'Ventas'),
(3, 'Recursos Humanos'),
(4, 'Contabilidad'),
(5, 'Gerencia'),
(6, 'Robotica'),
(7, 'Artes'),
(8, 'Gatronomia'),
(10, 'Pintura');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `group_id`, `username`, `password`, `age`) VALUES
(1, 'Carlos', 'Alvarez', 'carlos@gmail.com', 1, 'Carlos', '$2a$07$DIGCFFIHG/A93D6GG4G24.IW7AIrUaiQ.0cXygENQp5YM8TETQVsC', 12),
(2, 'Eduardo', 'Poot', 'eduardo@gmail.com', 2, 'Eduardo', '$2a$07$25574H03EAIFJBCA14KICuFRy6KWu2ibQwHp6eTFk9SJef6o4PHa2', 20),
(3, 'Andres', 'Fuentes', 'andres@gmail.com', 5, 'Andres', '$2a$07$4755DH156F73J3H0I1713u.SZdbPPL916anYvieN/XnSB13TDpRT.', 25),
(4, 'Jose', 'Bastos', 'jose@gmail.com', 4, 'Jose', '$2a$07$JJE2G3F9CI0C5A12CHJF8.LMUq9BiyxlXCrZhGyHUKfxolHlELFJy', 37),
(5, 'Santiago', 'Baez', 'santiago@gmail.com', 3, 'Santiago', '$2a$07$9ED553CG0E8B0688DC419uneUVo.einM6yYPJdBcR8TpFbykCrSxG', 23),
(6, 'Cintia', 'Carrillo', 'cintia@gmail.com', 3, 'Cintia', '$2a$07$7C9K5IDJE9DDC7.83DA3AuxVYW7MeehaPLe4SogAHRrgPN6S7P.ra', 33),
(7, 'Bianca', 'Contreras', 'bianca@gmail.com', 2, 'Bianca', '$2a$07$GJB0HE.G0ICD7/EKHG815uQSzGgqAbGlm2pXZ06UCrhkne/uQ6nFS', 18),
(9, 'Alex', 'Cetina', 'alex@gmail.com', 7, 'Alex', '$2a$07$AGBH27KFHE3C9K5B7C2B4.0l9Bsl3MORnmcbmFdJxzu3rM5AncLxW', 23),
(10, 'Ruben', 'Martinez', 'Ruben@gmail.com', 4, 'Ruben', '$2a$07$82749.5146GJK4B6E53J0.kpBZg/u6pGjwqHOa.Q0n8XNeT2YGiGi', 24),
(11, 'Tinoco', 'Martinez', 'tinoco@gmail.com', 3, 'Tinoco', '$2a$07$0DHCAH./.A067G8C8321G.ZphD7/oHvG6IBXsDYHaq17.YxYFNP7G', 18);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
