-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2026 at 03:14 PM
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
  `b_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`b_id`, `title`, `author`, `cover_image`) VALUES
(6, 'Mango Friends', 'T.B.Ilangarathne', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9YbAU8Uzr3sddSkL0bfj4Cr2Wzh_Qwt-e2A&s'),
(7, 'The Lord of the Rings', 'J.R.R. Tolkien', 'https://m.media-amazon.com/images/I/71lKy8RoFUL._AC_UF1000,1000_QL80_.jpg'),
(8, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'https://m.media-amazon.com/images/M/MV5BNTU1MzgyMDMtMzBlZS00YzczLThmYWEtMjU3YmFlOWEyMjE1XkEyXkFqcGc@._V1_.jpg'),
(9, 'To Kill a Mockingbird', 'Harper Lee', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg/250px-To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg'),
(10, '1984', 'George Orwell', 'https://m.media-amazon.com/images/I/715WdnBHqYL._UF1000,1000_QL80_.jpg'),
(11, 'Pride and Prejudice ', 'Jane Austen', 'https://m.media-amazon.com/images/M/MV5BMTA1NDQ3NTcyOTNeQTJeQWpwZ15BbWU3MDA0MzA4MzE@._V1_.jpg'),
(12, 'The Little Prince', 'Antoine de Saint-Exupéry', 'https://upload.wikimedia.org/wikipedia/en/0/05/Littleprince.JPG'),
(13, 'The Hobbit', 'J.R.R. Tolkien', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScVBUXG-XRcok0a0PJtesuNuWCSJZ8PThaDQ&s'),
(14, 'Don Quixote', 'Miguel de Cervantes', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWSujFxtAAJCdMNFitxe9VWsQly_vj0LgASA&s'),
(15, 'A Tale of Two Cities', 'Charles Dickens', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRazqOY5RguRHU-SPLt6OBjq24OC2UETCLgNA&s');

-- --------------------------------------------------------

--
-- Table structure for table `bookstock`
--

CREATE TABLE `bookstock` (
  `s_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `copies` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookstock`
--

INSERT INTO `bookstock` (`s_id`, `b_id`, `copies`, `created_at`, `updated_at`) VALUES
(6, 6, 20, '2026-03-31 12:49:50', '2026-03-31 12:49:50'),
(7, 7, 10, '2026-03-31 13:05:21', '2026-03-31 13:05:21'),
(8, 8, 5, '2026-03-31 13:06:34', '2026-03-31 13:06:34'),
(9, 9, 6, '2026-03-31 13:07:26', '2026-03-31 13:07:26'),
(10, 10, 3, '2026-03-31 13:08:10', '2026-03-31 13:08:10'),
(11, 11, 6, '2026-03-31 13:08:48', '2026-03-31 13:08:48'),
(12, 12, 7, '2026-03-31 13:09:25', '2026-03-31 13:09:25'),
(13, 13, 9, '2026-03-31 13:12:41', '2026-03-31 13:12:41'),
(14, 14, 19, '2026-03-31 13:13:27', '2026-03-31 13:13:27'),
(15, 15, 8, '2026-03-31 13:14:18', '2026-03-31 13:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `borrow_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` enum('pending','approved','declined') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`borrow_id`, `b_id`, `user_id`, `borrow_date`, `return_date`, `status`, `created_at`, `updated_at`) VALUES
(6, 6, 15, '2026-04-01', '2026-04-10', 'pending', '2026-03-31 13:10:36', '2026-03-31 13:10:36'),
(7, 7, 15, '2026-04-02', '2026-04-12', 'pending', '2026-03-31 13:10:36', '2026-03-31 13:10:36'),
(8, 8, 16, '2026-04-03', '2026-04-13', 'pending', '2026-03-31 13:10:36', '2026-03-31 13:10:36'),
(9, 9, 16, '2026-04-04', '2026-04-14', 'approved', '2026-03-31 13:10:36', '2026-03-31 13:11:28'),
(10, 10, 17, '2026-04-05', '2026-04-15', 'pending', '2026-03-31 13:10:36', '2026-03-31 13:10:36'),
(11, 6, 17, '2026-04-06', '2026-04-16', 'approved', '2026-03-31 13:10:36', '2026-03-31 13:11:32'),
(12, 7, 18, '2026-04-07', '2026-04-17', 'approved', '2026-03-31 13:10:36', '2026-03-31 13:11:36'),
(13, 8, 18, '2026-04-08', '2026-04-18', 'pending', '2026-03-31 13:10:36', '2026-03-31 13:10:36'),
(14, 9, 19, '2026-04-09', '2026-04-19', 'pending', '2026-03-31 13:10:36', '2026-03-31 13:10:36'),
(15, 10, 19, '2026-04-10', '2026-04-20', 'approved', '2026-03-31 13:10:36', '2026-03-31 13:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nic` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('user','admin','super_admin') DEFAULT 'user',
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `nic`, `address`, `role`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Super Admin', 'superadmin@sarasavi.com', 'super123$', '0771234567', '123456789V', 'Colombo', 'super_admin', 'approved', '2026-03-31 12:54:55', '2026-03-31 12:54:55'),
(12, 'Admin User', 'admin@sarasavi.com', 'admin123$', '0772345678', '987654321V', 'Galle', 'admin', 'approved', '2026-03-31 12:54:55', '2026-03-31 12:54:55'),
(13, 'Sathira Pending', 'spending@example.com', 'spending123$', '0774567890', '741258963V', 'Panadura', 'user', 'pending', '2026-03-31 12:54:55', '2026-03-31 12:54:55'),
(14, 'Sathira Sugeesvara', 'sathirasugeesvara@gamil.com', 'sathira123$', '0764627089', '200303411820', 'Matugama', 'user', 'approved', '2026-03-31 12:54:55', '2026-03-31 12:55:51'),
(15, 'Alice Johnson', 'alice@example.com', 'alice123$', '0771111111', '111111111V', 'Colombo', 'user', 'approved', '2026-03-31 13:02:15', '2026-03-31 13:02:15'),
(16, 'Bob Perera', 'bob@example.com', 'bob123$', '0772222222', '222222222V', 'Galle', 'user', 'approved', '2026-03-31 13:02:15', '2026-03-31 13:02:15'),
(17, 'Chamara Silva', 'chamara@example.com', 'chamara123$', '0773333333', '333333333V', 'Kandy', 'user', 'approved', '2026-03-31 13:02:15', '2026-03-31 13:02:15'),
(18, 'Dilani Fernando', 'dilani@example.com', 'dilani123$', '0774444444', '444444444V', 'Matara', 'user', 'approved', '2026-03-31 13:02:15', '2026-03-31 13:02:15'),
(19, 'Eshan Wijesinghe', 'eshan@example.com', 'eshan123$', '0775555555', '555555555V', 'Panadura', 'user', 'approved', '2026-03-31 13:02:15', '2026-03-31 13:02:15');

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
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bookstock`
--
ALTER TABLE `bookstock`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookstock`
--
ALTER TABLE `bookstock`
  ADD CONSTRAINT `bookstock_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`) ON DELETE CASCADE;

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `books` (`b_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrows_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
