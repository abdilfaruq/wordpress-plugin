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
-- Table structure for table `sd_certificate_domains`
--

CREATE TABLE `sd_certificate_domains` (
  `certificate_name` varchar(100) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `status` enum('created','apache_config_set','cert_registered') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sd_certificate_domains`
--

INSERT INTO `sd_certificate_domains` (`certificate_name`, `domain`, `status`) VALUES
('sert7', 'buahbatu.sideka.id', 'cert_registered'),
('sert8', 'cileunyi.desa.id', 'created'),
('sert5', 'dago.sideka.id', 'cert_registered'),
('sert2', 'kabar.sideka.id', 'cert_registered'),
('sert6', 'lembang.sideka.id', 'cert_registered'),
('sert9', 'margahayu.desa.id', 'created'),
('sert3', 'parahyangan.sideka.id', 'cert_registered'),
('sert4', 'pelajar.sideka.id', 'apache_config_set'),
('sert1', 'sideka.id', 'created');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sd_certificate_domains`
--
ALTER TABLE `sd_certificate_domains`
  ADD PRIMARY KEY (`domain`),
  ADD UNIQUE KEY `sd_certificates_domains_domain_uindex` (`domain`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
