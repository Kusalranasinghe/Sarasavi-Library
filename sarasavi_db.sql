-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2026 at 06:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarasavi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `b_id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `author` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `language` varchar(20) NOT NULL,
  `regdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`b_id`, `name`, `author`, `category`, `language`, `regdate`) VALUES
(1, 'c programming', 'david', 'computing', 'english', '2026-01-02 22:02:34'),
(2, 'biology', 'silva', 'science', 'english', '2026-01-02 22:25:47'),
(3, 'maths', 'silva', 'mathematics', 'english', '2026-01-02 22:27:55'),
(4, 'sinhala', 'silva', 'other', 'sinhala', '2026-01-02 22:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `bookstock`
--

CREATE TABLE `bookstock` (
  `s_id` int(20) NOT NULL,
  `b_id` int(20) NOT NULL,
  `copies` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookstock`
--

INSERT INTO `bookstock` (`s_id`, `b_id`, `copies`) VALUES
(1, 1, 10),
(2, 3, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `bookstock`
--
ALTER TABLE `bookstock`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `b_id` (`b_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `b_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookstock`
--
ALTER TABLE `bookstock`
  MODIFY `s_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookstock`
--
ALTER TABLE `bookstock`
  ADD CONSTRAINT `bookstock_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
