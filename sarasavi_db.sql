-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2026 at 04:14 PM
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
-- Database: `sarasavi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `b_id` int(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`b_id`, `title`, `author`) VALUES
(1, 'Book 1', 'Author 1'),
(2, 'Book 2', 'Author 2'),
(3, 'Book 3', 'Author 3');

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

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `borrow_id` int(20) NOT NULL,
  `b_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`borrow_id`, `b_id`, `user_id`, `borrow_date`, `return_date`) VALUES
(1, 1, 2, '2026-01-01', '2026-01-10'),
(2, 3, 2, '2026-02-15', NULL),
(3, 2, 3, '2026-03-01', '2026-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','staff') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@sarasavi.com', 'admin123', 'admin', '2026-03-28 15:13:39'),
(2, 'John Doe', 'john@example.com', 'john123', 'user', '2026-03-28 15:13:39'),
(3, 'Staff Member', 'staff@example.com', 'staff123', 'staff', '2026-03-28 15:13:39');

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
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `b_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookstock`
--
ALTER TABLE `bookstock`
  MODIFY `s_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `borrow_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookstock`
--
ALTER TABLE `bookstock`
  ADD CONSTRAINT `bookstock_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`);

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`),
  ADD CONSTRAINT `borrows_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
