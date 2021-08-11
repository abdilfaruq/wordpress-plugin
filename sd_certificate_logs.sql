-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 24, 2021 at 06:08 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multisite`
--

-- --------------------------------------------------------

--
-- Table structure for table `sd_certificate_logs`
--

CREATE TABLE `sd_certificate_logs` (
  `id` bigint(20) NOT NULL,
  `message` text,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sd_certificate_logs`
--

INSERT INTO `sd_certificate_logs` (`id`, `message`, `timestamp`) VALUES
(1, 'Domain sideka.desa.id didaftarkan pada sert1', '2022-04-13 16:27:15'),
(2, 'Domain sideka.desa.id didaftarkan pada sert2', '2021-05-27 04:01:36'),
(3, 'Domain sideka.desa.id didaftarkan pada sert3', '2021-05-11 04:47:48'),
(4, 'Domain sideka.desa.id didaftarkan pada sert4', '2021-05-12 02:47:48'),
(5, 'Domain sideka.desa.id didaftarkan pada sert5', '2021-05-13 01:49:13'),
(6, 'Domain sideka.desa.id didaftarkan pada sert6', '2021-05-14 00:49:13'),
(7, 'Domain sideka.desa.id didaftarkan pada sert7', '2021-05-15 08:49:51'),
(8, 'Domain sideka.desa.id didaftarkan pada sert8', '2021-05-16 00:49:51'),
(9, 'Domain sideka.desa.id didaftarkan pada sert9', '2021-05-16 22:50:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sd_certificate_logs`
--
ALTER TABLE `sd_certificate_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sd_certificate_logs`
--
ALTER TABLE `sd_certificate_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
