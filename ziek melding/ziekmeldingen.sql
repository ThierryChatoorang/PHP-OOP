-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 11:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ziekmeldingen`
--

-- --------------------------------------------------------

--
-- Table structure for table `docenten`
--

CREATE TABLE `docenten` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `docenten`
--

INSERT INTO `docenten` (`id`, `naam`, `email`) VALUES
(1, 'Barry van Helden', 'barry@school.nl'),
(2, 'Wigmans', 'wigmans@school.nl'),
(3, 'Jorgy', 'jorgy@school.nl');

-- --------------------------------------------------------

--
-- Table structure for table `ziekmeldingen`
--

CREATE TABLE `ziekmeldingen` (
  `id` int(11) NOT NULL,
  `docent_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `reden` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ziekmeldingen`
--

INSERT INTO `ziekmeldingen` (`id`, `docent_id`, `datum`, `reden`) VALUES
(6, 1, '2025-05-22', 'Te veel koerden in mijn klas.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `docenten`
--
ALTER TABLE `docenten`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ziekmeldingen`
--
ALTER TABLE `ziekmeldingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docent_id` (`docent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `docenten`
--
ALTER TABLE `docenten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ziekmeldingen`
--
ALTER TABLE `ziekmeldingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ziekmeldingen`
--
ALTER TABLE `ziekmeldingen`
  ADD CONSTRAINT `ziekmeldingen_ibfk_1` FOREIGN KEY (`docent_id`) REFERENCES `docenten` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
