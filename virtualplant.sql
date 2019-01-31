-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 27, 2018 at 12:29 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtualplant`
--

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastfed` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `stage` int(1) NOT NULL DEFAULT '0',
  `status` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'dry',
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `name`, `created`, `lastfed`, `stage`, `status`, `uid`) VALUES
(1, 'rose', '2018-07-22 11:51:40', '2018-07-27 09:44:53', 7, 'moist', 3),
(2, 'lirio', '2018-07-22 07:30:37', '2018-07-27 12:05:56', 7, 'moist', 3),
(3, 'erikas', '2018-07-23 13:58:36', '2018-07-27 12:33:25', 7, 'moist', 3),
(8, 'nicolas', '2018-07-24 17:22:30', '2018-07-27 12:15:24', 6, 'moist', 3),
(10, 'alex', '2018-07-25 08:21:17', '2018-07-27 09:44:55', 5, 'moist', 3),
(11, 'isabella', '2018-07-25 08:24:24', '2018-07-27 09:44:41', 5, 'moist', 3),
(12, 'ponyo', '2018-07-25 08:40:37', '2018-07-27 12:24:07', 5, 'moist', 3),
(16, 'new bee', '2018-07-25 09:30:03', '2018-07-27 12:05:49', 5, 'moist', 3),
(20, 'name', '2018-07-25 10:00:46', '2018-07-27 10:43:22', 5, 'moist', 3),
(21, 'teste', '2018-07-25 10:02:28', '2018-07-27 10:37:54', 5, 'moist', 3),
(22, 'ponyshia', '2018-07-25 10:12:33', '2018-07-27 10:41:36', 5, 'moist', 3),
(23, 'dani', '2018-07-25 12:13:17', '2018-07-24 09:03:24', 2, 'wet', 4),
(24, 'bea', '2018-07-25 12:13:34', '2018-07-26 02:03:28', 2, 'wet', 4),
(27, 'BABY', '2018-07-26 20:29:10', '2018-07-27 09:44:47', 2, 'moist', 3),
(28, 'ola', '2018-07-27 08:05:48', '2018-07-27 10:16:09', 1, 'moist', 13),
(29, 'hallo', '2018-07-27 08:06:06', '2018-07-27 10:16:24', 1, 'moist', 13),
(39, '', '2018-07-27 10:05:08', '2018-07-27 12:18:15', 1, 'moist', 3),
(40, '', '2018-07-27 10:13:47', '2018-07-27 10:13:47', 1, 'moist', 3),
(41, 'Friday', '2018-07-27 10:14:08', '2018-07-27 10:14:08', 1, 'moist', 3),
(42, 'Friday 1', '2018-07-27 10:14:43', '2018-07-27 10:14:43', 1, 'moist', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `passcode` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `passcode`) VALUES
(3, 'Patrick Lehmann', 'patrick@lehmann.de', 'ponyo2121'),
(4, 'renata', 'renata@faccenda.de', 'antonia'),
(5, 'bea', 'bea@rodrigues.br', 'beabea'),
(13, 'dani', 'dani@brilhantes.de', 'danesetudo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `plants_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
