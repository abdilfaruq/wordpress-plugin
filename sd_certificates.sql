-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 24, 2021 at 06:07 AM
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
-- Table structure for table `sd_certificates`
--

CREATE TABLE `sd_certificates` (
  `name` varchar(100) NOT NULL,
  `expired` date DEFAULT NULL,
  `status` enum('OK','ERROR') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sd_certificates`
--

INSERT INTO `sd_certificates` (`name`, `expired`, `status`) VALUES
('sert1', '2022-04-13', 'OK'),
('sert2', '2021-06-16', 'OK'),
('sert3', '2021-06-09', 'OK'),
('sert4', '2021-06-16', 'OK'),
('sert5', '2021-06-23', 'OK'),
('sert6', '2021-06-23', 'ERROR'),
('sert7', '2021-06-30', 'ERROR'),
('sert8', '2021-06-16', 'OK'),
('sert9', '2021-05-20', 'ERROR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sd_certificates`
--
ALTER TABLE `sd_certificates`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `sd_certificates_name_uindex` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
