-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 04:34 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `port_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `time_zone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `country_name`, `currency_code`, `icon`, `time_zone`) VALUES
(1, 'Argentinian Peso', 'ARS', '&#36;', ''),
(2, 'Australian Dollar', 'AUD', '&#36;', ''),
(3, 'Brazilian Real', 'BRL', '&#36;', ''),
(4, 'Canadian Dollar', 'CAD', '	&#36;', ''),
(5, 'Swiss Franc', 'CHF', '&#67', ''),
(6, 'Czech Koruna', 'CZK', '&#75;&#269;', ''),
(7, 'Danish Krone', 'DKK', '&#107;&#114;', ''),
(8, 'Euro ', 'EUR', '&#8364;', ''),
(9, 'British Pound', 'GBP', '	&#163;', ''),
(10, 'Hong Kong Dollar', 'HKD', '&#36;', ''),
(11, 'Hungarian Forint', 'HUF', '&#70;&#116;', ''),
(12, 'Indian Rupee', 'INR', '&#8377;', ''),
(13, 'Israeli New Shekel', 'ILS', '	&#8362;', ''),
(14, 'Japanese Yen', 'JPY', '	&#165;', ''),
(15, 'Mexican Peso', 'MXN', '&#36;', ''),
(16, 'Malaysian Ringgit ', 'MYR', '&#82;&#77;', ''),
(17, 'Norwegian Krone', 'NOK', '	&#107;&#114;', ''),
(18, 'New Zealand Dollar', 'NZD', '	&#36;', ''),
(19, 'Philippine Peso', 'PHP', '&#8369;', ''),
(20, 'Polish Zloty', 'PLN', '&#122;&#322;', ''),
(21, 'Russian Ruble', 'RUB', '&#1088;&#1091;&#1073;', ''),
(22, 'Swedish Krona ', 'SEK', '	&#107;&#114;', ''),
(23, 'Singapore Dollar', 'SGD', '	&#36;', ''),
(24, 'Thai Baht', 'THB', '&#3647;', ''),
(25, 'Taiwan New Dollar', 'TWD', '&#78;&#84;&#36;', ''),
(26, 'United States Dollar', 'USD', '	&#36;', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
