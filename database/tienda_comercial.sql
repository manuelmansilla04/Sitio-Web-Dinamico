-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 03:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda_comercial`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'Difusores de aromas', 'Dispersa fragancias en el aire para crear un ambiente agradable y relajante.'),
(2, 'Perfumes Textiles', 'Se usa para perfumar telas y ambientes, creando una sensación de bienestar. Se recomienda agitar.'),
(3, 'Jabones Liquidos', 'Agente limpiador en formato fluido, normalmente ofrecido a través de un dispensador.');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `fecha_alta` date NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `descripcion`, `precio`, `stock`, `fecha_alta`, `id_categoria`) VALUES
(1, 'Difusor Aromatico Wood', '<desc>', 34610.00, 100, '2015-09-01', 1),
(2, 'Difusor Aromatico Milk', '...', 21770.00, 100, '2015-09-02', 1),
(3, 'Difusor Aromatico', '...', 28490.00, 100, '2016-09-01', 1),
(4, 'Difusor Aromatico Coffee Cream', '...', 26390.00, 100, '2015-09-03', 1),
(5, 'Difusor Aromatico Pepper Citrus', '...', 26390.00, 100, '2016-09-01', 1),
(6, 'Difusor Aromatico Sustentable', '...', 19090.00, 100, '2015-09-02', 1),
(7, 'Difusor Aromatico This Is Love', '...', 28490.00, 100, '2016-09-08', 1),
(8, 'Difusor Aromatico This Is Fresh', '...', 28490.00, 100, '2015-09-02', 1),
(9, 'Difusor Aromatico Fresh Vetiver', '...', 33.65, 100, '2015-09-01', 1),
(10, 'Aromatizador de Ambiente This Is Love', '...', 17550.00, 100, '2016-09-08', 2),
(11, 'Aromatizador de Ambiente This Is Fresh', '...', 17550.00, 100, '2016-09-07', 2),
(12, 'Aromatizador de Ambiente This is Peace', '...', 17550.00, 100, '2015-09-18', 2),
(13, 'Aromatizador de Ambiente Tropical Fruits', '...', 12690.00, 100, '2015-09-17', 2),
(14, 'Aromatizador de Ambiente Coco & Lima', '...', 12690.00, 100, '2015-09-10', 2),
(15, 'Aromatizador de Ambiente Sensual Rose', '...', 12690.00, 100, '2016-09-09', 2),
(16, 'Aromatizador de Ambiente Fresh Vetiver', '...', 13670.00, 100, '2015-09-12', 2),
(17, 'Aromatizador de Ambiente Fresh Gardenia', '...', 13670.00, 100, '2015-09-09', 2),
(18, 'Aromatizador de Ambiente Sustentable', '...', 12690.00, 100, '2015-09-01', 2),
(19, 'Jabon Liquido Fresh Gardenia', '...', 11640.00, 100, '2015-09-05', 3),
(20, 'Jabon Liquido Dual Coco', '...', 10310.00, 100, '2015-09-03', 3),
(21, 'Jabon Liquido This is Peace', '...', 11530.00, 100, '2015-09-02', 3),
(22, 'Jabon Liquido This Is Love', '...', 11530.00, 100, '2015-09-25', 3),
(23, 'Jabon Liquido This Is Fresh', '...', 11530.00, 100, '2015-09-02', 3),
(24, 'Jabon Liquido Fresh Vetiver', '...', 11640.00, 100, '2015-09-11', 3),
(25, 'Jabon Liquido Dual Sustentable', '...', 8680.00, 100, '2015-09-03', 3),
(26, 'Aromatizador de Ambiente Black Wood', '...', 18550.00, 100, '2025-09-03', 2),
(27, 'Difusor Black Wood', '...', 42760.00, 100, '2025-09-04', 1),
(28, 'Jabon Liquido Black Wood', '...', 12790.00, 100, '2025-09-05', 3),
(29, 'Black Wood Refill', '...', 23.42, 100, '2025-09-06', 2),
(30, 'Aromatizador de Ambiente White', '...', 18.55, 100, '2025-09-01', 2),
(31, 'Jabon Liquido White', '...', 12.79, 100, '2025-09-07', 3);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(255) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID`, `user_name`, `password`) VALUES
(1, 'Juan', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `UC_categoria` (`nombre`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `UC_producto` (`nombre`),
  ADD KEY `FK_producto_categoria` (`id_categoria`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
