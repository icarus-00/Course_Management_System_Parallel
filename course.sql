-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 01:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `playlist_id` varchar(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `video` varchar(50) NOT NULL,
  `image` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `user_id`, `playlist_id`, `title`, `description`, `video`, `image`, `date`, `status`) VALUES
(3, 1, '3', 'sd', 'ad', 'https://youtu.be/_lZcJuw0hn4?si=qByXvxwU-r6ABJUn', '663d5ad7b7a13.png', '2024-05-10', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `user_id`, `title`, `description`, `image`, `date`, `status`) VALUES
(3, '1', 'ewpt course', 'hello', '663d39ab43db0.png', '2024-05-10', 'active'),
(4, '1', 'ewptx', 'by killua', '663d39f97f8eb.jpg', '2024-05-10', 'deactive'),
(5, '1', 'ecir', 'ecir', '663d3a09c5d3b.jpeg', '2024-05-10', 'active'),
(6, '1', 'eCDFp', 'by killua', '663d3a1e6e8b7.jpeg', '2024-05-10', 'active'),
(7, '1', 'OS', 'by killua', '663d3a3163fad.jpg', '2024-05-10', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `FullName`, `Password`, `GroupID`) VALUES
(1, '0xkillua', 'Elsayed@mail.com', '', 'ab165cb90d19598f610a669dfe4798f4cd049a6a', 1),
(2, 'omar', 'omar@mail.com', '', 'ab165cb90d19598f610a669dfe4798f4cd049a6a', 0),
(3, 'mohamed', 'mo@mail.com', '', 'ab165cb90d19598f610a669dfe4798f4cd049a6a', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
