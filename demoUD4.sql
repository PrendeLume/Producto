-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-02-2022 a las 13:35:02
-- Versión del servidor: 10.3.32-MariaDB-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `demoUD4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `id_padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `id_padre`) VALUES
(3, 'Videojuegos', NULL),
(4, 'Microsoft', 3),
(5, 'Nintendo', 3),
(7, 'Sony', 3),
(13, 'Telefonía', NULL),
(14, 'Android', 13),
(15, 'iOS', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `operacion` varchar(50) NOT NULL,
  `tabla` varchar(50) NOT NULL,
  `detalle` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id_log`, `operacion`, `tabla`, `detalle`) VALUES
(1, 'update', 'usuario', 'Actualizado el sueldo del usuario \"Alexis_Jose_da_Silva_Pereira al valor: 4403');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `proveedor` varchar(9) NOT NULL,
  `coste` decimal(10,0) NOT NULL,
  `margen` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `iva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `cif` varchar(9) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`cif`, `codigo`, `nombre`, `direccion`, `website`, `pais`, `email`, `telefono`) VALUES
('A5000002E', 'test', 'test', 'test', 'http://test.org', 'Portugal', 'test@test.org', '999999999'),
('A5000003E', 'test', 'test', 'test', 'http://test.org', 'Portugal', 'test@test.org', '999999999'),
('A5000031E', 'PROV000031', 'PROVEEDOR 000031', 'Calle Test Num. 581', 'http://test.org', 'España', 'proveedor30@test.org', NULL),
('A5009999E', 'test', 'test', 'test', 'http://test.org', 'Portugal', 'test@test.org', NULL),
('A6000061I', 'PROV000061', 'PROVEEDOR 000061', 'Calle Test Num. 321', 'http://test.org', 'España', 'proveedor60@test.org', NULL),
('A6000071S', 'PROV000071', 'PROVEEDOR 000071', 'Calle Test Num. 382', 'http://test.org', 'España', 'proveedor70@test.org', NULL),
('A6000081C', 'PROV000081', 'PROVEEDOR 000081', 'Calle Test Num. 81', 'http://test.org', 'España', 'proveedor80@test.org', NULL),
('A7000041O', 'PROV000041', 'PROVEEDOR 000041', 'Calle Test Num. 643', 'http://test.org', 'España', 'proveedor40@test.org', NULL),
('A8000011K', 'PROV000011', 'PROVEEDOR 000011', 'Calle Test Num. 578', 'http://test.org', 'España', 'proveedor10@test.org', NULL),
('A8000021U', 'PROV000021', 'PROVEEDOR 000021', 'Calle Test Num. 400', 'http://test.org', 'España', 'proveedor20@test.org', NULL),
('A8000051Y', 'PROV000051', 'PROVEEDOR 000051', 'Calle Test Num. 367', 'http://test.org', 'España', 'proveedor50@test.org', NULL),
('A8000091M', 'PROV000091', 'PROVEEDOR 000091', 'Calle Test Num. 727', 'http://test.org', 'España', 'proveedor90@test.org', NULL),
('B1000062J', 'PROV000062', 'PROVEEDOR 000062', 'Calle Test Num. 265', 'http://test.org', 'España', 'proveedor61@test.org', NULL),
('B3000092N', 'PROV000092', 'PROVEEDOR 000092', 'Calle Test Num. 825', 'http://test.org', 'España', 'proveedor91@test.org', NULL),
('B4000052Z', 'PROV000052', 'PROVEEDOR 000052', 'Calle Test Num. 998', 'http://test.org', 'España', 'proveedor51@test.org', NULL),
('B5000042P', 'PROV000042', 'PROVEEDOR 000042', 'Calle Test Num. 719', 'http://test.org', 'España', 'proveedor41@test.org', NULL),
('B5000082D', 'PROV000082', 'PROVEEDOR 000082', 'Calle Test Num. 534', 'http://test.org', 'España', 'proveedor81@test.org', NULL),
('B6000072T', 'PROV000072', 'PROVEEDOR 000072', 'Calle Test Num. 982', 'http://test.org', 'España', 'proveedor71@test.org', NULL),
('B7000002B', 'PROV000002', 'PROVEEDOR 000002', 'Calle Test Num. 874', 'http://test.org', 'España', 'proveedor1@test.org', NULL),
('B8000012L', 'PROV000012', 'PROVEEDOR 000012', 'Calle Test Num. 928', 'http://test.org', 'España', 'proveedor11@test.org', NULL),
('B8000022V', 'PROV000022', 'PROVEEDOR 000022', 'Calle Test Num. 56', 'http://test.org', 'España', 'proveedor21@test.org', NULL),
('B9000032F', 'PROV000032', 'PROVEEDOR 000032', 'Calle Test Num. 173', 'http://test.org', 'España', 'proveedor31@test.org', NULL),
('C1000013M', 'PROV000013', 'PROVEEDOR 000013', 'Calle Test Num. 600', 'http://test.org', 'España', 'proveedor12@test.org', NULL),
('C1000083E', 'PROV000083', 'PROVEEDOR 000083', 'Calle Test Num. 796', 'http://test.org', 'España', 'proveedor82@test.org', NULL),
('C2000003C', 'PROV000003', 'PROVEEDOR 000003', 'Calle Test Num. 193', 'http://test.org', 'España', 'proveedor2@test.org', NULL),
('C3000023W', 'PROV000023', 'PROVEEDOR 000023', 'Calle Test Num. 428', 'http://test.org', 'España', 'proveedor22@test.org', NULL),
('C3000033G', 'PROV000033', 'PROVEEDOR 000033', 'Calle Test Num. 837', 'http://test.org', 'España', 'proveedor32@test.org', NULL),
('C4000043Q', 'PROV000043', 'PROVEEDOR 000043', 'Calle Test Num. 542', 'http://test.org', 'España', 'proveedor42@test.org', NULL),
('C6000063K', 'PROV000063', 'PROVEEDOR 000063', 'Calle Test Num. 783', 'http://test.org', 'España', 'proveedor62@test.org', NULL),
('C6000073U', 'PROV000073', 'PROVEEDOR 000073', 'Calle Test Num. 641', 'http://test.org', 'España', 'proveedor72@test.org', NULL),
('C9000053A', 'PROV000053', 'PROVEEDOR 000053', 'Calle Test Num. 116', 'http://test.org', 'España', 'proveedor52@test.org', NULL),
('C9000093O', 'PROV000093', 'PROVEEDOR 000093', 'Calle Test Num. 68', 'http://test.org', 'España', 'proveedor92@test.org', NULL),
('D1000044R', 'PROV000044', 'PROVEEDOR 000044', 'Calle Test Num. 967', 'http://test.org', 'España', 'proveedor43@test.org', NULL),
('D1000074V', 'PROV000074', 'PROVEEDOR 000074', 'Calle Test Num. 172', 'http://test.org', 'España', 'proveedor73@test.org', NULL),
('D2000034H', 'PROV000034', 'PROVEEDOR 000034', 'Calle Test Num. 543', 'http://test.org', 'España', 'proveedor33@test.org', NULL),
('D3000014N', 'PROV000014', 'PROVEEDOR 000014', 'Calle Test Num. 338', 'http://test.org', 'España', 'proveedor13@test.org', NULL),
('D3000024X', 'PROV000024', 'PROVEEDOR 000024', 'Calle Test Num. 205', 'http://test.org', 'España', 'proveedor23@test.org', NULL),
('D3000064L', 'PROV000064', 'PROVEEDOR 000064', 'Calle Test Num. 764', 'http://test.org', 'España', 'proveedor63@test.org', NULL),
('D3000094P', 'PROV000094', 'PROVEEDOR 000094', 'Calle Test Num. 507', 'http://test.org', 'España', 'proveedor93@test.org', NULL),
('D7000084F', 'PROV000084', 'PROVEEDOR 000084', 'Calle Test Num. 51', 'http://test.org', 'España', 'proveedor83@test.org', NULL),
('D9000004D', 'PROV000004', 'PROVEEDOR 000004', 'Calle Test Num. 822', 'http://test.org', 'España', 'proveedor3@test.org', NULL),
('D9000054B', 'PROV000054', 'PROVEEDOR 000054', 'Calle Test Num. 168', 'http://test.org', 'España', 'proveedor53@test.org', NULL),
('E1000025Y', 'PROV000025', 'PROVEEDOR 000025', 'Calle Test Num. 82', 'http://test.org', 'España', 'proveedor24@test.org', NULL),
('E1000035I', 'PROV000035', 'PROVEEDOR 000035', 'Calle Test Num. 11', 'http://test.org', 'España', 'proveedor34@test.org', NULL),
('E1000055C', 'PROV000055', 'PROVEEDOR 000055', 'Calle Test Num. 987', 'http://test.org', 'España', 'proveedor54@test.org', NULL),
('E1000085G', 'PROV000085', 'PROVEEDOR 000085', 'Calle Test Num. 583', 'http://test.org', 'España', 'proveedor84@test.org', NULL),
('E2000005E', 'PROV000005', 'PROVEEDOR 000005', 'Calle Test Num. 676', 'http://test.org', 'España', 'proveedor4@test.org', NULL),
('E5000065M', 'PROV000065', 'PROVEEDOR 000065', 'Calle Test Num. 633', 'http://test.org', 'España', 'proveedor64@test.org', NULL),
('E5000095Q', 'PROV000095', 'PROVEEDOR 000095', 'Calle Test Num. 910', 'http://test.org', 'España', 'proveedor94@test.org', NULL),
('E6000015O', 'PROV000015', 'PROVEEDOR 000015', 'Calle Test Num. 95', 'http://test.org', 'España', 'proveedor14@test.org', NULL),
('E7000045S', 'PROV000045', 'PROVEEDOR 000045', 'Calle Test Num. 323', 'http://test.org', 'España', 'proveedor44@test.org', NULL),
('E8000075W', 'PROV000075', 'PROVEEDOR 000075', 'Calle Test Num. 699', 'http://test.org', 'España', 'proveedor74@test.org', NULL),
('F1000036J', 'PROV000036', 'PROVEEDOR 000036', 'Calle Test Num. 413', 'http://test.org', 'España', 'proveedor35@test.org', NULL),
('F2000026Z', 'PROV000026', 'PROVEEDOR 000026', 'Calle Test Num. 109', 'http://test.org', 'España', 'proveedor25@test.org', NULL),
('F2000066N', 'PROV000066', 'PROVEEDOR 000066', 'Calle Test Num. 373', 'http://test.org', 'España', 'proveedor65@test.org', NULL),
('F3000086H', 'PROV000086', 'PROVEEDOR 000086', 'Calle Test Num. 590', 'http://test.org', 'España', 'proveedor85@test.org', NULL),
('F4000016P', 'PROV000016', 'PROVEEDOR 000016', 'Calle Test Num. 151', 'http://test.org', 'España', 'proveedor15@test.org', NULL),
('F6000076X', 'PROV000076', 'PROVEEDOR 000076', 'Calle Test Num. 5', 'http://test.org', 'España', 'proveedor75@test.org', NULL),
('F9000006F', 'PROV000006', 'PROVEEDOR 000006', 'Calle Test Num. 91', 'http://test.org', 'España', 'proveedor5@test.org', NULL),
('F9000046T', 'PROV000046', 'PROVEEDOR 000046', 'Calle Test Num. 484', 'http://test.org', 'España', 'proveedor45@test.org', NULL),
('F9000056D', 'PROV000056', 'PROVEEDOR 000056', 'Calle Test Num. 746', 'http://test.org', 'España', 'proveedor55@test.org', NULL),
('F9000096R', 'PROV000096', 'PROVEEDOR 000096', 'Calle Test Num. 506', 'http://test.org', 'España', 'proveedor95@test.org', NULL),
('G1000027A', 'PROV000027', 'PROVEEDOR 000027', 'Calle Test Num. 234', 'http://test.org', 'España', 'proveedor26@test.org', NULL),
('G1000057E', 'PROV000057', 'PROVEEDOR 000057', 'Calle Test Num. 296', 'http://test.org', 'España', 'proveedor56@test.org', NULL),
('G2000087I', 'PROV000087', 'PROVEEDOR 000087', 'Calle Test Num. 315', 'http://test.org', 'España', 'proveedor86@test.org', NULL),
('G3000067O', 'PROV000067', 'PROVEEDOR 000067', 'Calle Test Num. 229', 'http://test.org', 'España', 'proveedor66@test.org', NULL),
('G3000097S', 'PROV000097', 'PROVEEDOR 000097', 'Calle Test Num. 623', 'http://test.org', 'España', 'proveedor96@test.org', NULL),
('G4000017Q', 'PROV000017', 'PROVEEDOR 000017', 'Calle Test Num. 945', 'http://test.org', 'España', 'proveedor16@test.org', NULL),
('G5000007G', 'PROV000007', 'PROVEEDOR 000007', 'Calle Test Num. 634', 'http://test.org', 'España', 'proveedor6@test.org', NULL),
('G5000037K', 'PROV000037', 'PROVEEDOR 000037', 'Calle Test Num. 600', 'http://test.org', 'España', 'proveedor36@test.org', NULL),
('G7000077Y', 'PROV000077', 'PROVEEDOR 000077', 'Calle Test Num. 634', 'http://test.org', 'España', 'proveedor76@test.org', NULL),
('G9000047U', 'PROV000047', 'PROVEEDOR 000047', 'Calle Test Num. 359', 'http://test.org', 'España', 'proveedor46@test.org', NULL),
('H2000028B', 'PROV000028', 'PROVEEDOR 000028', 'Calle Test Num. 484', 'http://test.org', 'España', 'proveedor27@test.org', NULL),
('H2000058F', 'PROV000058', 'PROVEEDOR 000058', 'Calle Test Num. 799', 'http://test.org', 'España', 'proveedor57@test.org', NULL),
('H2000088J', 'PROV000088', 'PROVEEDOR 000088', 'Calle Test Num. 571', 'http://test.org', 'España', 'proveedor87@test.org', NULL),
('H3000008H', 'PROV000008', 'PROVEEDOR 000008', 'Calle Test Num. 873', 'http://test.org', 'España', 'proveedor7@test.org', NULL),
('H3000048V', 'PROV000048', 'PROVEEDOR 000048', 'Calle Test Num. 911', 'http://test.org', 'España', 'proveedor47@test.org', NULL),
('H5000068P', 'PROV000068', 'PROVEEDOR 000068', 'Calle Test Num. 699', 'http://test.org', 'España', 'proveedor67@test.org', NULL),
('H7000078Z', 'PROV000078', 'PROVEEDOR 000078', 'Calle Test Num. 253', 'http://test.org', 'España', 'proveedor77@test.org', NULL),
('H8000098T', 'PROV000098', 'PROVEEDOR 000098', 'Calle Test Num. 520', 'http://test.org', 'España', 'proveedor97@test.org', NULL),
('H9000018R', 'PROV000018', 'PROVEEDOR 000018', 'Calle Test Num. 641', 'http://test.org', 'España', 'proveedor17@test.org', NULL),
('H9000038L', 'PROV000038', 'PROVEEDOR 000038', 'Calle Test Num. 487', 'http://test.org', 'España', 'proveedor37@test.org', NULL),
('I1000009I', 'PROV000009', 'PROVEEDOR 000009', 'Calle Test Num. 421', 'http://test.org', 'España', 'proveedor8@test.org', NULL),
('I2000089K', 'PROV000089', 'PROVEEDOR 000089', 'Calle Test Num. 743', 'http://test.org', 'España', 'proveedor88@test.org', NULL),
('I3000019S', 'PROV000019', 'PROVEEDOR 000019', 'Calle Test Num. 790', 'http://test.org', 'España', 'proveedor18@test.org', NULL),
('I3000029C', 'PROV000029', 'PROVEEDOR 000029', 'Calle Test Num. 499', 'http://test.org', 'España', 'proveedor28@test.org', NULL),
('I3000039M', 'PROV000039', 'PROVEEDOR 000039', 'Calle Test Num. 142', 'http://test.org', 'España', 'proveedor38@test.org', NULL),
('I4000099U', 'PROV000099', 'PROVEEDOR 000099', 'Calle Test Num. 540', 'http://test.org', 'España', 'proveedor98@test.org', NULL),
('I6000049W', 'PROV000049', 'PROVEEDOR 000049', 'Calle Test Num. 332', 'http://test.org', 'España', 'proveedor48@test.org', NULL),
('I7000079A', 'PROV000079', 'PROVEEDOR 000079', 'Calle Test Num. 533', 'http://test.org', 'España', 'proveedor78@test.org', NULL),
('I8000059G', 'PROV000059', 'PROVEEDOR 000059', 'Calle Test Num. 114', 'http://test.org', 'España', 'proveedor58@test.org', NULL),
('I8000069Q', 'PROV000069', 'PROVEEDOR 000069', 'Calle Test Num. 850', 'http://test.org', 'España', 'proveedor68@test.org', NULL),
('J1000060H', 'PROV000060', 'PROVEEDOR 000060', 'Calle Test Num. 721', 'http://test.org', 'España', 'proveedor59@test.org', NULL),
('J2000030D', 'PROV000030', 'PROVEEDOR 000030', 'Calle Test Num. 644', 'http://test.org', 'España', 'proveedor29@test.org', NULL),
('J2000050X', 'PROV000050', 'PROVEEDOR 000050', 'Calle Test Num. 54', 'http://test.org', 'España', 'proveedor49@test.org', NULL),
('J2000080B', 'PROV000080', 'PROVEEDOR 000080', 'Calle Test Num. 296', 'http://test.org', 'España', 'proveedor79@test.org', NULL),
('J3000090L', 'PROV000090', 'PROVEEDOR 000090', 'Calle Test Num. 847', 'http://test.org', 'España', 'proveedor89@test.org', NULL),
('J6000040N', 'PROV000040', 'PROVEEDOR 000040', 'Calle Test Num. 673', 'http://test.org', 'España', 'proveedor39@test.org', NULL),
('J7000020T', 'PROV000020', 'PROVEEDOR 000020', 'Calle Test Num. 689', 'http://test.org', 'España', 'proveedor19@test.org', NULL),
('J7000070R', 'PROV000070', 'PROVEEDOR 000070', 'Calle Test Num. 489', 'http://test.org', 'España', 'proveedor69@test.org', NULL),
('J8000010J', 'PROV000010', 'PROVEEDOR 000010', 'Calle Test Num. 263', 'http://test.org', 'España', 'proveedor9@test.org', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(50) NOT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `salarioBruto` float(10,2) DEFAULT NULL,
  `retencionIRPF` float(10,2) DEFAULT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`username`, `rol`, `salarioBruto`, `retencionIRPF`, `activo`) VALUES
('administrador', 'administrador', 5000.00, 30.00, b'1'),
('Alexis_Jose_Alvarez_Araujo', 'standard', 4399.00, 30.00, b'1'),
('Alexis_Jose_da_Silva_Oset', 'standard', 3355.00, 20.00, b'1'),
('Alexis_Jose_da_Silva_Pereira', 'standard', 4403.00, 30.00, b'1'),
('Alexis_Jose_Giraldez_Oset', 'standard', 4410.00, 30.00, b'1'),
('Alexis_Jose_Gonzalez_Carrera', 'standard', 4125.00, 30.00, b'1'),
('Alexis_Jose_Gonzalez_Pereira', 'standard', 1587.00, 18.00, b'1'),
('Alexis_Jose_Juncal_Carrera', 'standard', 4578.00, 30.00, b'1'),
('Alexis_Jose_Montes_Araujo', 'standard', 3754.00, 20.00, b'1'),
('Alexis_Jose_Montes_Sanchez', 'standard', 3264.00, 20.00, b'1'),
('Alexis_Jose_Sanchez_Gonzalez', 'standard', 4046.00, 30.00, b'1'),
('Carlos_Alvarez_Vilas', 'standard', 1632.00, 18.00, b'1'),
('Carlos_Casas_Oset', 'standard', 2883.00, 18.00, b'1'),
('Carlos_Casas_Sanchez', 'standard', 1605.00, 18.00, b'1'),
('Carlos_da_Silva_Iglesias', 'standard', 4499.00, 30.00, b'1'),
('Carlos_Dominguez_Cerqueira', 'standard', 4983.00, 30.00, b'1'),
('Carlos_Montes_Carrera', 'standard', 1576.00, 18.00, b'1'),
('Carlos_Sanchez_Oset', 'standard', 3394.00, 20.00, b'1'),
('Cristopher_Candeira_Carrera', 'standard', 1014.00, 18.00, b'1'),
('Cristopher_Fernandez_Iglesias', 'standard', 3805.00, 20.00, b'1'),
('Cristopher_Ferreira_Oset', 'standard', 2045.00, 18.00, b'1'),
('Cristopher_Giraldez_Abeledo', 'standard', 2012.00, 18.00, b'1'),
('Cristopher_Giraldez_Fernandez', 'standard', 3075.00, 20.00, b'1'),
('Cristopher_Montes_Iglesias', 'standard', 4010.00, 30.00, b'1'),
('Cristopher_Sanchez_Fernandez', 'standard', 2384.00, 18.00, b'1'),
('Cristopher_Sanchez_Pereira', 'standard', 2792.00, 18.00, b'1'),
('Cristopher_Suarez_Fernandez', 'standard', 1324.00, 18.00, b'1'),
('desarrollador', 'dev', 3000.00, 20.00, b'1'),
('Erik_Candeira_Sanchez', 'standard', 3064.00, 20.00, b'1'),
('Erik_Dominguez_Abeledo', 'standard', 4500.00, 30.00, b'1'),
('Erik_Fernandez_Gonzalez', 'standard', 4045.00, 30.00, b'1'),
('Erik_Ferreira_Carrera', 'standard', 2290.00, 18.00, b'1'),
('Erik_Giraldez_Araujo', 'standard', 1757.00, 18.00, b'1'),
('Erik_Giraldez_Carrera', 'standard', 2005.00, 18.00, b'1'),
('Erik_Giraldez_Pereira', 'standard', 1163.00, 18.00, b'1'),
('Erik_Sanchez_Gonzalez', 'standard', 4960.00, 30.00, b'1'),
('Erik_Suarez_Pereira', 'standard', 2916.00, 18.00, b'1'),
('Francisco_Dominguez_Araujo', 'standard', 2269.00, 18.00, b'1'),
('Francisco_Dominguez_Pereira', 'standard', 4675.00, 30.00, b'1'),
('Francisco_Fernandez_Araujo', 'standard', 1557.00, 18.00, b'1'),
('Francisco_Fernandez_Carrera', 'standard', 4364.00, 30.00, b'1'),
('Francisco_Gonzalez_Sanchez', 'standard', 1274.00, 18.00, b'1'),
('Iv__n_Alvarez_Groba', 'standard', 3119.00, 20.00, b'1'),
('Iv__n_da_Silva_Sanchez', 'standard', 1794.00, 18.00, b'1'),
('Iv__n_Dominguez_Iglesias', 'standard', 4647.00, 30.00, b'1'),
('Iv__n_Juncal_Groba', 'standard', 2300.00, 18.00, b'1'),
('Iv__n_Juncal_Oset', 'standard', 2775.00, 18.00, b'1'),
('Iv__n_Montes_Carrera', 'standard', 4673.00, 30.00, b'1'),
('Iv__n_Sanchez_Araujo', 'standard', 2030.00, 18.00, b'1'),
('Iv__n_Sanchez_Groba', 'standard', 3519.00, 20.00, b'1'),
('Iv__n_Suarez_Cerqueira', 'standard', 3975.00, 20.00, b'1'),
('Jose_Simon_Alvarez_Sanchez', 'standard', 2779.00, 18.00, b'1'),
('Jose_Simon_Casas_Fernandez', 'standard', 2251.00, 18.00, b'1'),
('Jose_Simon_Casas_Sanchez', 'standard', 3773.00, 20.00, b'1'),
('Jose_Simon_Fernandez_Gonzalez', 'standard', 3259.00, 20.00, b'1'),
('Jose_Simon_Ferreira_Vilas', 'standard', 4049.00, 30.00, b'1'),
('Jose_Simon_Giraldez_Pereira', 'standard', 3325.00, 20.00, b'1'),
('Jose_Simon_Giraldez_Vilas', 'standard', 1995.00, 18.00, b'1'),
('Jose_Simon_Gonzalez_Cerqueira', 'standard', 3244.00, 20.00, b'1'),
('Jose_Simon_Juncal_Sanchez', 'standard', 4320.00, 30.00, b'1'),
('Jose_Simon_Sanchez_Iglesias', 'standard', 2935.00, 18.00, b'1'),
('Jose_Simon_Suarez_Groba', 'standard', 1842.00, 18.00, b'1'),
('Marcos_Alvarez_Araujo', 'standard', 4401.00, 30.00, b'1'),
('Marcos_da_Silva_Vilas', 'standard', 1972.00, 18.00, b'1'),
('Marcos_Montes_Oset', 'standard', 1116.00, 18.00, b'1'),
('Marcos_Sanchez_Sanchez', 'standard', 4625.00, 30.00, b'1'),
('Marcos_Suarez_Cerqueira', 'standard', 4412.00, 30.00, b'1'),
('Marcos_Suarez_Sanchez', 'standard', 1339.00, 18.00, b'1'),
('Mauricio_Casas_Sanchez', 'standard', 2545.00, 18.00, b'1'),
('Mauricio_da_Silva_Oset', 'standard', 2919.00, 18.00, b'1'),
('Mauricio_Ferreira_Groba', 'standard', 3364.00, 20.00, b'1'),
('Mauricio_Ferreira_Oset', 'standard', 2995.00, 18.00, b'1'),
('Mauricio_Ferreira_Pereira', 'standard', 1109.00, 18.00, b'1'),
('Mauricio_Giraldez_Cerqueira', 'standard', 2490.00, 18.00, b'1'),
('Mauricio_Giraldez_Sanchez', 'standard', 2293.00, 18.00, b'1'),
('Mauricio_Gonzalez_Araujo', 'standard', 4769.00, 30.00, b'1'),
('Mauricio_Gonzalez_Sanchez', 'standard', 4565.00, 30.00, b'1'),
('Miguel_Dominguez_Fernandez', 'standard', 2129.00, 18.00, b'1'),
('Miguel_Ferreira_Cerqueira', 'standard', 2823.00, 18.00, b'1'),
('Miguel_Giraldez_Cerqueira', 'standard', 3857.00, 20.00, b'1'),
('Miguel_Juncal_Cerqueira', 'standard', 3049.00, 20.00, b'1'),
('Miguel_Suarez_Fernandez', 'standard', 4883.00, 30.00, b'1'),
('Nuria_Maria_Alvarez_Cerqueira', 'standard', 4449.00, 30.00, b'1'),
('Nuria_Maria_Alvarez_Oset', 'standard', 2160.00, 18.00, b'1'),
('Nuria_Maria_Alvarez_Vilas', 'standard', 4157.00, 30.00, b'1'),
('Nuria_Maria_Candeira_Gonzalez', 'standard', 1318.00, 18.00, b'1'),
('Nuria_Maria_Fernandez_Fernandez', 'standard', 2133.00, 18.00, b'1'),
('Nuria_Maria_Ferreira_Groba', 'standard', 1581.00, 18.00, b'1'),
('Nuria_Maria_Giraldez_Groba', 'standard', 2153.00, 18.00, b'1'),
('Nuria_Maria_Gonzalez_Oset', 'standard', 1851.00, 18.00, b'1'),
('Nuria_Maria_Gonzalez_Pereira', 'standard', 4834.00, 30.00, b'1'),
('Nuria_Maria_Juncal_Oset', 'standard', 2286.00, 18.00, b'1'),
('Nuria_Maria_Montes_Pereira', 'standard', 2716.00, 18.00, b'1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `FK_PADRE_CATEGORIA` (`id_padre`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`,`operacion`,`tabla`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`cif`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `FK_PADRE_CATEGORIA` FOREIGN KEY (`id_padre`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
