-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2020 m. Geg 18 d. 15:28
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salys`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `miestai`
--

CREATE TABLE `miestai` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `area` int(11) NOT NULL,
  `population` bigint(20) NOT NULL,
  `postal_code` varchar(50) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `add_date` date NOT NULL,
  `fk_salys` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `miestai`
--

INSERT INTO `miestai` (`id`, `name`, `area`, `population`, `postal_code`, `add_date`, `fk_salys`) VALUES
(1, 'Zepita', 8683632, 81, '706', '2019-06-01', 7),
(2, 'Tawala', 7965297, 8, '471', '2019-07-29', 4),
(3, 'Zarichchya', 7726817, 19, '423', '2020-04-23', 3),
(4, 'Smiřice', 8857061, 51, '327', '2020-02-09', 5),
(5, 'Srono', 3638339, 88, '571', '2019-12-10', 8),
(6, 'Tunggulsari', 4529456, 35, '251', '2020-03-22', 1),
(7, 'Pedraza La Vieja', 5607087, 76, '397', '2020-02-21', 3),
(8, 'Ambelókipoi', 4313454, 41, '119', '2019-06-10', 11),
(9, 'Évora', 719857, 7, '491', '2019-10-06', 7),
(10, 'Shangyong', 3672239, 82, '952', '2019-11-29', 3),
(11, 'Otan Aiyegbaju', 2521469, 1, '877', '2019-06-26', 2),
(12, 'Faeanak Dua', 4001271, 91, '443', '2019-07-20', 11),
(13, 'Aguitu', 6402368, 32, '610', '2019-12-17', 9),
(14, 'Gangba', 8978951, 72, '423', '2020-04-20', 3),
(15, 'Fort Abbās', 2921183, 1, '652', '2020-02-06', 12),
(16, 'Las Mesas', 2151121, 93, '135', '2020-02-16', 5),
(17, 'Hujiaying', 6923973, 24, '294', '2019-05-18', 6),
(18, 'Řečany nad Labem', 9045939, 45, '973', '2019-10-25', 8),
(19, 'Jaguaruana', 6921120, 98, '268', '2020-01-06', 11),
(20, 'Stochov', 5749168, 22, '367', '2020-05-03', 4),
(21, 'Ranong', 4318788, 1, '532', '2019-07-08', 7),
(22, 'Doko', 9728153, 19, '576', '2020-04-26', 2),
(23, 'Karagach', 7533747, 78, '631', '2020-02-28', 3),
(24, 'Al Qiţena', 6509255, 34, '268', '2019-11-10', 6),
(25, 'Tireman Timur', 2155482, 81, '845', '2020-01-25', 8),
(26, 'Kuafeu', 1087518, 89, '912', '2020-04-27', 12),
(27, 'Krosno Odrzańskie', 6870078, 27, '860', '2019-06-18', 7),
(28, 'Kudowa-Zdrój', 3531487, 94, '443', '2020-01-11', 8),
(29, 'Mosul', 4456188, 100, '292', '2019-06-21', 11),
(30, 'Florestópolis', 8849592, 61, '720', '2020-01-23', 6),
(31, 'Idalolong', 8582855, 66, '406', '2019-09-11', 7),
(32, 'San Pedro', 9688884, 93, '621', '2019-09-27', 9),
(33, 'Concepción', 6664348, 67, '655', '2019-09-04', 7),
(34, 'Bangkal', 1080583, 65, '787', '2020-04-12', 3),
(35, 'Zoumachang', 8025624, 36, '316', '2020-01-12', 3),
(36, 'Mistřice', 3592234, 15, '610', '2019-06-19', 3),
(37, 'Sosnovyy Bor', 819877, 35, '151', '2019-09-05', 7),
(38, 'CITYNAME', 45, 456, '33125', '2020-05-18', 12);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `šalys`
--

CREATE TABLE `šalys` (
  `name` varchar(50) COLLATE utf8mb4_lithuanian_ci NOT NULL,
  `area` bigint(20) NOT NULL,
  `population` bigint(20) NOT NULL,
  `phone_nr` int(11) NOT NULL,
  `add_date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `šalys`
--

INSERT INTO `šalys` (`name`, `area`, `population`, `phone_nr`, `add_date`, `id`) VALUES
('Cuba', 293836, 27, 399, '2019-08-08', 1),
('China', 6689594, 68, 880, '2019-12-03', 2),
('Indonesia', 7135328, 65, 576, '2020-02-24', 3),
('Germany', 1196901, 65, 167, '2019-06-20', 4),
('Philippines', 3227517, 30, 393, '2020-04-03', 5),
('Japan', 3621848, 93, 940, '2019-11-25', 6),
('Pakistan', 1021943, 48, 402, '2020-04-14', 7),
('Mongolia', 2656588, 80, 668, '2019-12-30', 8),
('United States', 6139873, 21, 802, '2019-06-20', 9),
('France', 3578368, 89, 972, '2019-09-13', 10),
('Peru', 5933843, 25, 750, '2019-06-15', 11),
('Bolivia', 5145132, 85, 461, '2019-06-08', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `miestai`
--
ALTER TABLE `miestai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `šalys`
--
ALTER TABLE `šalys`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `miestai`
--
ALTER TABLE `miestai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `šalys`
--
ALTER TABLE `šalys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
