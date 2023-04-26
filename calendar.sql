-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 10:29 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(10) NOT NULL,
  `joinersId` int(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `duration` int(10) NOT NULL COMMENT ' in minutes',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `joinersId`, `title`, `duration`, `start_date`, `end_date`, `created_by`, `created_on`) VALUES
(2, 2, 'All hands meet', 30, '2023-04-27 00:19:00', '2023-04-27 00:39:00', 1, '2023-04-26 15:28:48'),
(3, 3, 'All hands meet', 60, '2023-04-27 01:19:00', '2023-04-27 02:19:00', 1, '2023-04-26 19:44:10'),
(4, 2, 'All hands meet', 60, '2023-04-27 01:19:00', '2023-04-27 02:19:00', 1, '2023-04-26 16:37:08'),
(5, 2, 'All hands meet', 60, '2023-04-28 01:19:00', '2023-04-28 02:19:00', 1, '2023-04-26 16:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `age` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `age`, `created_on`) VALUES
(1, 'Admin', 'admin@yopmail.com', 20, '2023-04-26 18:52:51'),
(2, 'Suraj', 'suraj@yopmail.com', 24, '2023-04-26 14:28:54'),
(3, 'Sam', 'sam@yopmail.com', 24, '2023-04-26 19:27:19'),
(4, 'Suraj', 'suraj@yopmail.com', 24, '2023-04-26 14:34:28'),
(5, 'Suraj', 'suraj@yopmail.com', 24, '2023-04-26 14:45:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_FK_1` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `books_FK_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
