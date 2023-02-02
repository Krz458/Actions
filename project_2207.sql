-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2022 at 09:31 AM
-- Server version: 10.8.3-MariaDB
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_2207`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `login` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(1, 'krzychu', '$2y$10$IG9MOV2mHPtasIUzr4f71OQnVyoU8OBaCB4tULgPG5KetfS.vu76O');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` char(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'electronics'),
(2, 'motoryzation'),
(5, 'decorations'),
(6, 'toys');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `currency` char(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency`) VALUES
(1, 'PLN'),
(2, 'Euro (EUR)'),
(3, 'Pound sterling (GBP)'),
(4, 'Koruna česká (CZK)');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `heading` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contents` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` int(15) NOT NULL,
  `date` date NOT NULL,
  `category` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `user_id`, `heading`, `contents`, `price`, `currency`, `date`, `category`) VALUES
(20, 3, 'AMD A8-5600K', 'This proccesor is well working.\r\nIt has 2 cores and 4 threads.', '400', 1, '2022-07-31', 1),
(59, 1, 'w', 'trt', '1', 1, '2022-08-15', 1),
(63, 14, 'w', 't', '12', 1, '2022-08-20', 1),
(64, 14, 'tes', 'te', '12', 1, '2022-08-21', 1),
(65, 14, 'test', 'tes', '12', 1, '2022-08-21', 1),
(66, 14, 'te', 't', '12', 1, '2022-08-21', 1),
(67, 14, 'tes', 'te', '12', 1, '2022-08-21', 1),
(68, 14, 'test', 'test', '12', 1, '2022-08-21', 1),
(69, 14, 'tes', 'test', '1211', 1, '2022-08-21', 1),
(70, 14, 'test', 'test', '12', 1, '2022-08-21', 1),
(71, 14, 'test', 'test', '12', 1, '2022-08-21', 1),
(72, 14, 't', 'e', '1', 1, '2022-08-21', 1),
(73, 14, 't', 'e', '1', 1, '2022-08-21', 1),
(74, 14, 'test', 't', '2', 1, '2022-08-21', 1),
(75, 14, 'test', 'test', '12', 1, '2022-08-21', 1),
(76, 14, 'test', 'test', '12', 1, '2022-08-21', 1),
(77, 14, 'te', 'rt', '1', 1, '2022-08-21', 1),
(79, 14, 'test', 'test', '12', 1, '2022-08-21', 1),
(80, 14, 'ts', 're', '1', 1, '2022-08-21', 1),
(81, 14, 'test', 'test', '12', 1, '2022-08-21', 1),
(82, 14, 'test111', 'test', '12', 1, '2022-08-21', 1),
(83, 14, 'test', 'test', '12', 1, '2022-08-21', 1),
(84, 14, 'tes', 'et', '1', 1, '2022-08-21', 1),
(85, 14, 't', 'e', '12', 1, '2022-08-21', 1),
(87, 14, 'yr', 're', '11', 1, '2022-08-24', 1),
(88, 14, 'te', 're', '12', 2, '2022-08-24', 5),
(89, 14, 'ttttttttttt', 'ttt', '23', 3, '2022-08-24', 5),
(90, 14, 'test', 'test', '12', 1, '2022-08-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `date`) VALUES
(1, 'kacper@exaple.com', 'kacper212', '$2y$10$89XdhNr8gYXVkN2Ov0nnNuw1fgYIca4Iia/7V92ekWkCHynHBfhUK', '2022-07-24'),
(3, 'exaple@exaple.com', 'krzysiek', '$2y$10$rfLnUcupqA1HUmJSe5FhhuYFRQ2h5Ph0DuoRR4Gr7bnuc.IvokfYa', '2022-07-26'),
(4, 'qwq@dsd.jkh', 'kacper212', '$2y$10$/FWgffql9GYC3wuyjIAsQOhpUXXDgWDUBCUOp/zGEQqHw5hZRYiP.', '2022-07-27'),
(5, 'qwq@dsd.jkh', 'kacper212', '$2y$10$7wOBVaNF.dZU9gL2kk0V5uWYnNE646H8y.9EvHAsPsQT82ReA4wpa', '2022-07-27'),
(6, 'wewe@sdsds.pl', 'kacper212qww', '$2y$10$tKQFotiaOMpxPDOZJmR1s.1T11L03Imt.WJlZ0znxGs3Boolvdete', '2022-07-28'),
(7, 'wewe@sdsds.plqq', 'kacper212qqq', '$2y$10$cGc9hwKuKwvSeVD9pW5B2ubM2G04gCtjtSysaFhl46/tzzWip4Np6', '2022-07-28'),
(8, 'argentyna@onet.pl', 'arbuz123', '$2y$10$2rc/hyjYrnAjTCx/Mg5u8.pHLntdQ.pb4vjSS0b6txkA2oiyKcO3O', '2022-07-31'),
(9, 'kakot4k@protonmail.com', 'krzychu2022', '$2y$10$Xu415Fod/Y2DSPXFBbsn9.XH8K45WLYUUzYB6zzBfphzDnmRvRNX2', '2022-07-31'),
(10, 'ewew@eew.f', 'kacper212222', '$2y$10$STRoLY6D1a3QokXyiDwDxeLEf77WLBXvHN2BeHrAWHtI9lm6/tKNG', '2022-07-31'),
(11, 'erer@sdsd.jke', 'kacper21222', '$2y$10$RGEJyksElPlYI6Cn10hnievv1rp5Gc7QjbWi1OTyJj6XbSOMyOsIa', '2022-07-31'),
(12, 'rerer@rtr.hjq', 'kacper2122211f', '$2y$10$aS66.JEA9Rt6G/K7rUrkxer/Jub4Lgn6tSjvoV3w08yG8U5anacEq', '2022-07-31'),
(13, '34@fdfe.ewewe', 'kacper212hhhh', '$2y$10$CarImMSPwlFGZQiQOPUx0uyEyipqCR7ghggDDzZx3SE7vxTG9DlW6', '2022-08-03'),
(14, 'erer@sdasd.jk', 'jasio123', '$2y$10$DVlMK2Woc9GC3fDbUU5wKOrpFZvmQ9eH3pGZQKvWkVXGCAJ7QOyWe', '2022-08-03'),
(15, 'test@tes3.pl', 'maciek123', '$2y$10$ooh88IPPybdnCV8lWXQ89ecyFuCl3AiLSjQIda6YazWuYtMURHoOi', '2022-08-03'),
(16, 'test@test666.de', 'michal12345', '$2y$10$0WhWXFx0MswNAeB0uoE.Ku9O.Qpxf/aghDBv/nxleyNdfXoHt.0uO', '2022-08-04'),
(17, 'test@test6266.de', 'mariusz1234', '$2y$10$EA03CX5t254aJZMSPU4o1.AZUXbMFcT3vod2AJbuJCfs.5eBEFZHS', '2022-08-04'),
(18, 'erer@sdasd.jksss', 'adas12345', '$2y$10$Dy6BlJnAeKaMRZG4QgcdqOrVyjE.n29iiG.OIIYkDro7pR/H2lFTK', '2022-08-05'),
(19, 'test@supda.dsd', 'heniek12345', '$2y$10$uyqOULx6q/Qb645heyPvX.B.LM0jFtGk/jpPQiW4APtuEPRSZTaX.', '2022-08-05'),
(20, 'rerer@rtr.hjwwq', 'mirek12345', '$2y$10$YmKYNE20yWnyBkuPvkN38uFvXk/QvuVoSEyZ9Ld6N4yZiw2izalAW', '2022-08-05'),
(21, 'sdsds@asa.de', 'antos12345', '$2y$10$XAGB4aaFxzuGfBR5wPzfceR6yWKiX9v5KSWq.QEUCqBC2laxCEVhm', '2022-08-05'),
(22, 'er@er.psdsdsds', 'zenek12345', '$2y$10$1cYy05fn4aCG9eB3DDPWw.i4/b6IPEnMzksYuxy/jBAnMVK3ltrO6', '2022-08-05'),
(23, 'rerer@rtr.hjwwqw', 'krzysiek1234', '$2y$10$7ekRmUb06qk8iX6GVlhbuOgatJDwuHLDWqbUpRNJT1Zy/NtZqlBVW', '2022-08-12'),
(24, 'wwe@ew.hg', 'wqwqwqwqwqwqw1111', '$2y$10$GES0N5Qf9WyIXmXeTuhJN.ax5x.PPMN5NLMYK2T.hDrOnKjSOATGK', '2022-08-24'),
(25, 'errer@wqwwwww.gd', 'jasio1231', '$2y$10$aYWU1/YLG.z3mXepRMPfyuypog0hgaRymWTtWbYgSPngU5M8eHgGC', '2022-08-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
