-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 05:08 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `control`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ccomercial`
--

CREATE TABLE `Ccomercial` (
  `id_Ccomercial` int(11) NOT NULL,
  `Ccomercial_razonSocial` varchar(60) NOT NULL,
  `Ccomercial_email` varchar(100) NOT NULL,
  `Ccomercial_nit` varchar(100) NOT NULL,
  `Ccomercial_password` varchar(255) NOT NULL,
  `Ccomercial_created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ccomercial`
--

INSERT INTO `Ccomercial` (`id_Ccomercial`, `Ccomercial_razonSocial`, `Ccomercial_email`, `Ccomercial_nit`, `Ccomercial_password`, `Ccomercial_created_at`) VALUES
(1, 'Centro Comercial La Casona', 'ccomercial@lacasona.co', '41542544', '$2y$10$pQEmsp2xEb/7zaOupZZez.FcV6.XXnhySc4Ho./J9O/MrQO587qqW', '2021-07-09 10:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `Ingreso`
--

CREATE TABLE `Ingreso` (
  `id_Ingreso` int(11) NOT NULL,
  `Ccomercial_id` int(11) NOT NULL,
  `Persona_id` int(11) NOT NULL,
  `Ingreso_hora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ingreso`
--

INSERT INTO `Ingreso` (`id_Ingreso`, `Ccomercial_id`, `Persona_id`, `Ingreso_hora`) VALUES
(1, 1, 1, '2021-07-09 10:07:17'),
(2, 1, 1, '2021-07-09 10:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `Persona`
--

CREATE TABLE `Persona` (
  `id_Persona` int(11) NOT NULL,
  `Persona_nombre` varchar(50) NOT NULL,
  `Persona_apellido` varchar(50) NOT NULL,
  `Persona_email` varchar(100) NOT NULL,
  `Persona_documento` varchar(100) NOT NULL,
  `Persona_positivo` int(1) NOT NULL DEFAULT 0,
  `Persona_created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Persona`
--

INSERT INTO `Persona` (`id_Persona`, `Persona_nombre`, `Persona_apellido`, `Persona_email`, `Persona_documento`, `Persona_positivo`, `Persona_created_at`) VALUES
(1, 'Juan Carlos', 'Martinez', 'john_doe@example.com', '5457741', 0, '2021-07-09 10:06:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ccomercial`
--
ALTER TABLE `Ccomercial`
  ADD PRIMARY KEY (`id_Ccomercial`);

--
-- Indexes for table `Ingreso`
--
ALTER TABLE `Ingreso`
  ADD PRIMARY KEY (`id_Ingreso`);

--
-- Indexes for table `Persona`
--
ALTER TABLE `Persona`
  ADD PRIMARY KEY (`id_Persona`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ccomercial`
--
ALTER TABLE `Ccomercial`
  MODIFY `id_Ccomercial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Ingreso`
--
ALTER TABLE `Ingreso`
  MODIFY `id_Ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Persona`
--
ALTER TABLE `Persona`
  MODIFY `id_Persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
