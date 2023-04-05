-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2020 at 08:10 AM
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
-- Database: `ci_portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `features` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `features`, `slug`, `status`, `created_at`) VALUES
(1, 'Home', 'home', 1, '2020-01-04 01:02:04'),
(2, 'Social site', 'social-site', 1, '2019-12-15 17:22:53'),
(3, 'About', 'about', 1, '2019-12-15 17:22:43'),
(4, 'Skills', 'skills', 1, '2019-12-15 17:23:09'),
(5, 'Services', 'services', 1, '0000-00-00 00:00:00'),
(6, 'Resume', 'resume', 1, '2019-12-15 17:23:18'),
(7, 'Review', 'review', 1, '2019-12-15 17:24:42'),
(8, 'Portfolio', 'portfolio', 1, '2019-12-15 17:23:39'),
(9, 'Blog', 'blog', 1, '2020-02-17 00:00:00'),
(10, 'Appointment', 'appointment', 1, '2020-02-16 00:00:00'),
(11, 'Contacts', 'contacts', 1, '2019-12-15 17:24:40'),
(12, 'Teams', 'teams', 1, '0000-00-00 00:00:00'),
(13, 'Facts', 'facts', 1, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
