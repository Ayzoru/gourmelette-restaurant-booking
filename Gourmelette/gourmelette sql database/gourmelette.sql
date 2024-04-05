-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 06:31 PM
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
-- Database: `gourmelette`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminEmail` varchar(100) NOT NULL,
  `adminPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminEmail`, `adminPassword`) VALUES
(1, 'gmelette_admin@gmail.com', 'Admin1234'),
(16, 'boss1@gmail.com', 'be2b3300b28ce232b4c1c7eabdc4ecade0595908'),
(18, 'adminBoss@gmail.com', '309be15c9814b2aae695a4c31ecf1e896386691d');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reserv_id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `num_guests` int(11) NOT NULL,
  `num_tables` int(11) NOT NULL,
  `rdate` date NOT NULL,
  `time_zone` text NOT NULL,
  `telephone` text NOT NULL,
  `comment` mediumtext NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_fk` int(11) NOT NULL,
  `table_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reserv_id`, `f_name`, `l_name`, `num_guests`, `num_tables`, `rdate`, `time_zone`, `telephone`, `comment`, `reg_date`, `user_fk`, `table_number`) VALUES
(13, 'aizul', 'fahdli', 1, 1, '2024-04-02', '12:00 - 16:00', '0111111111', 'im hungry', '2024-04-02 00:10:57', 12, 1),
(15, 'dinie', 'syaa', 1, 1, '2024-04-02', '16:00 - 10:00', '0222222222', 'im hungry', '2024-04-02 00:17:42', 2, 5),
(17, 'al danis', 'x black swan', 2, 1, '2024-04-02', '10', '011111111111', 'nak makan', '2024-04-04 18:24:18', 2, 1),
(19, 'Ohio', 'Boss', 2, 1, '2024-04-05', '10:00 - 12:00', '0123424812', 'i am the final boss i want to eat', '2024-04-04 18:38:51', 15, 3),
(22, 'marcoo', 'cartae', 2, 1, '2024-04-08', '16', '019222442', 'keep it clean', '2024-04-04 20:03:47', 16, 1),
(23, 'aara', 'elvyna', 2, 1, '2024-04-06', '12:00 - 16:00', '0112928321', 'bono', '2024-04-05 02:51:42', 2, 1),
(24, 'shirahoshi', 'shishi', 4, 1, '2024-05-03', '16:00 - 10:00', '0292123421', 'im a fish', '2024-04-05 16:07:17', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(5) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `userEmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userPassword`, `userEmail`) VALUES
(1, 'meow', 'hello2', 'heha@gmail.com'),
(2, 'luff1', 'luffy123', 'luffy@gmail.com'),
(12, 'aizul', 'aizul123', 'aizul@gmail.com'),
(15, 'OhioBoss', 'Oh1oBoss!', 'ohio@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reserv_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
