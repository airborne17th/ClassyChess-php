-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2020 at 12:16 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classychess`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(4) NOT NULL,
  `image` varchar(256) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `userID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `comment`, `userID`) VALUES
(6, '../img/gallery_uploads/5fb03cc7205366cd005197dc2d36c663d9a1dcdf3ac6e.jpg', 'Picture', 72030),
(7, '../img/gallery_uploads/5fb03d3f51018coffee-2306471_1920.jpg', 'Coffee at the shop', 72030),
(8, '../img/gallery_uploads/5fb03d6817915chess-2489553_1920.jpg', 'No Comment', 72030);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `player1_name` varchar(128) NOT NULL,
  `player1_id` int(11) NOT NULL,
  `player1_opening` varchar(3) DEFAULT NULL,
  `player2_name` varchar(128) NOT NULL,
  `player2_id` int(11) NOT NULL,
  `player2_opening` varchar(3) DEFAULT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `recorder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `player1_name`, `player1_id`, `player1_opening`, `player2_name`, `player2_id`, `player2_opening`, `winner_id`, `recorder_id`) VALUES
(6, 'Gates', 83729, 'E4', 'Gudgel', 90405, 'E4', 83729, 72030),
(7, 'Kyker', 72030, 'NA', 'Mathews', 1, 'NA', 72030, 72030),
(12, 'Lotterman', 99552, 'E3', 'Vess', 27753, 'E1', 99552, 72030),
(13, 'Mathews', 1, 'D4', 'Gudgel', 90405, 'D4', 1, 72030),
(16, 'Kyker', 72030, 'F3', 'Vess', 27753, 'F3', 72030, 72030),
(19, 'Kyker', 72030, 'E4', 'Gudgel', 90405, 'E4', 72030, 72030),
(20, 'Gates', 83729, 'D4', 'Gudgel', 90405, 'D4', 90405, 72030),
(21, 'Gates', 83729, 'E4', 'Mathews', 1, 'E4', NULL, 72030),
(22, 'Gates', 83729, 'E4', 'Mathews', 1, 'E4', NULL, 72030),
(23, 'Lotterman', 99552, 'F4', 'Vess', 27753, 'F4', NULL, 72030);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `user_id` int(6) NOT NULL,
  `usertype` int(4) NOT NULL DEFAULT 1,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `win` int(6) NOT NULL DEFAULT 0,
  `total` int(6) NOT NULL DEFAULT 0,
  `newsletter` tinyint(1) NOT NULL DEFAULT 0,
  `elo` int(5) DEFAULT 1000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `user_id`, `usertype`, `email`, `password`, `win`, `total`, `newsletter`, `elo`) VALUES
(1, 'Sandra', 'Mathews', 1, 1, 'smathews@NebrWesleyan.edu', '$2y$10$Z46ZGt6pL64/O.fEEzhp5uLGEwL/azzkCinKIegETw.B.6eo9T4ui', 1, 4, 0, 1000),
(2, 'John', 'Kyker', 72030, 3, 'acepilotjohn@hotmail.com', '$2y$10$nZMlgfIRCqq8JTv177gmc.pr/1Th/CgJIhnP5naMOGVgYNPK6OcK2', 3, 3, 0, 1200),
(3, 'Jordan', 'Lotterman', 99552, 3, 'bestbuy@gmail.com', '$2y$10$W7EOYaVkq2kmuXajaL7VieLIYd7pj3.sGPb5b1IVZdQlnaKnixDcC', 1, 2, 0, 1050),
(4, 'Bill', 'Gates', 83729, 1, 'billygates@icloud.com', '$2y$10$h6/yE5rQs2NuZFJ4Z1M5OeSgiIgPWOEqwuU9HKVCTd34ZhL2QNc8O', 1, 4, 1, 1000),
(5, 'Mark', 'Gudgel', 90405, 1, 'wolf300@icloud.com', '$2y$10$Br/VtmK409x9ZtGdrdlaTe7mji9yVxiHeeG0k9V5BHdqnrG20KYb6', 1, 4, 1, 1000),
(6, 'Liliana', 'Vess', 27753, 1, 'lilyoftheveil@gmail.com', '$2y$10$pqkZ3uMFLI4XhT9MfClfiO2ylWTyESx069OxqHqYT6GarjcNLp8vq', 0, 3, 0, 1050);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
