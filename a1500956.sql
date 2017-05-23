-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07.12.2016 klo 16:02
-- Palvelimen versio: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a1500956`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `kuljettaja`
--

CREATE TABLE `kuljettaja` (
  `etunimi` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `sukunimi` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `maa` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `kilpanumero` int(2) NOT NULL,
  `syntymavuosi` int(4) NOT NULL,
  `lisatietoja` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `kuljettaja_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `kuljettaja`
--

INSERT INTO `kuljettaja` (`etunimi`, `sukunimi`, `maa`, `kilpanumero`, `syntymavuosi`, `lisatietoja`, `kuljettaja_id`) VALUES
('Teppo', 'Teikäläinen', 'Suomi', 8, 1978, 'Yamaha YZR R1', 1),
('Oscar', 'Andersson', 'Ruotsi', 34, 1982, 'Honda CBR1000RR', 2),
('Einar', 'Hjörleifsson', 'Islanti', 54, 1980, 'Kawasaki ZX-10R', 3),
('Anders', 'Jepsen', 'Tanska', 6, 1977, 'Suzuki GSX-R1000', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kuljettaja`
--
ALTER TABLE `kuljettaja`
  ADD PRIMARY KEY (`kuljettaja_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuljettaja`
--
ALTER TABLE `kuljettaja`
  MODIFY `kuljettaja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
