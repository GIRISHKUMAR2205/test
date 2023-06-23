-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 06:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(9) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `createdat`) VALUES
('1', 'admin', '$2y$10$N0SuzEi9iT49Y01YMqIsMOm5OFRkjwiXA4KDf5Ct/nUhRx6VgQCCa', '2023-06-23 01:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `ttype` varchar(13) NOT NULL,
  `seatno` int(5) NOT NULL,
  `flightname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `username`, `fname`, `lname`, `ttype`, `seatno`, `flightname`) VALUES
(1, '', 'Vertigo', 'KUMAR', 'Adult', 0, 'Vertigo'),
(3, '', 'Indigo', 'KUMAR', 'Adult', 26, 'Vertigo'),
(4, '', 'Indigo', 'KUMAR', 'Adult', 26, 'Vertigo'),
(5, 'girish', 'Indigo', 'KUMAR', 'Adult', 26, ''),
(6, 'girish', 'Indigo', 'KUMAR', 'Adult', 26, '');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flightname` varchar(100) NOT NULL,
  `start` varchar(255) NOT NULL,
  `stop` varchar(255) NOT NULL,
  `departure` time NOT NULL,
  `arrival` time NOT NULL,
  `date` varchar(255) NOT NULL,
  `seats` int(3) NOT NULL,
  `fare` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flightname`, `start`, `stop`, `departure`, `arrival`, `date`, `seats`, `fare`) VALUES
(11, 'Indigo', 'chennai', 'banglore', '12:00:00', '04:00:00', '2023-06-25', 60, 5000),
(12, 'TATA', 'chennai', 'banglore', '00:00:00', '02:00:00', '2023-06-26', 60, 7000),
(13, 'Vertigo', 'chennai', 'banglore', '08:00:00', '10:00:00', '2023-06-26', 60, 4000),
(14, 'Vertigo', 'banglore', 'chennai', '04:00:00', '06:00:00', '2023-06-26', 60, 7500);

-- --------------------------------------------------------

--
-- Table structure for table `newusers`
--

CREATE TABLE `newusers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newusers`
--

INSERT INTO `newusers` (`id`, `name`, `Email`, `username`, `Password`) VALUES
(1, 'THATAVARTHI GIRISH KUMAR', 'girishkumarthatavarthi@gmail.com', 'girish', '$2y$10$tMTBe3Hg7NbsdYXCZQ51qOwKuvkHyChX2TVPRqYqCXctb2gP/5q72');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newusers`
--
ALTER TABLE `newusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `newusers`
--
ALTER TABLE `newusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
