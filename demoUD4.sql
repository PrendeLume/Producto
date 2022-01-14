-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Xerado en: 07 de Xan de 2022 ás 14:40
-- Versión do servidor: 10.3.32-MariaDB-0ubuntu0.20.04.1
-- Versión do PHP: 7.4.3

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
-- Estrutura da táboa `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `id_padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A extraer os datos da táboa `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `id_padre`) VALUES
(3, 'Videojuegos', NULL),
(4, 'Microsoft', 3),
(5, 'Nintendo', 3),
(6, 'Xbox Series S/X', 4),
(7, 'Sony', 3),
(13, 'Telefonía', NULL),
(14, 'Android', 13),
(15, 'iOS', 13);

-- --------------------------------------------------------

--
-- Estrutura da táboa `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `operacion` varchar(50) NOT NULL,
  `tabla` varchar(50) NOT NULL,
  `detalle` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A extraer os datos da táboa `log`
--

INSERT INTO `log` (`id_log`, `operacion`, `tabla`, `detalle`) VALUES
(1, 'update', 'usuario', 'Actualizado el sueldo del usuario \"Alexis_Jose_da_Silva_Pereira al valor: 4403');

-- --------------------------------------------------------

--
-- Estrutura da táboa `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(50) NOT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `salarioBruto` float(10,2) DEFAULT NULL,
  `retencionIRPF` float(10,2) DEFAULT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A extraer os datos da táboa `usuario`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `FK_PADRE_CATEGORIA` (`id_padre`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`,`operacion`,`tabla`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricións para os envorcados das táboas
--

--
-- Restricións para a táboa `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `FK_PADRE_CATEGORIA` FOREIGN KEY (`id_padre`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
