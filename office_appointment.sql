-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2020 at 08:05 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `office_appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `timeslots` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `email`, `date`, `timeslots`) VALUES
(1, 'Stephen Kamau', 'stevekamahertz@gmail.com', '2020-05-03', ''),
(2, 'Steve', 'bizstevekama@gmail.com', '2020-05-11', ''),
(3, 'cate', 'catekinyanjui@gmail.com', '2020-05-31', ''),
(4, 'Steve', 'stevekamahert@gmail.com', '0000-00-00', '07:00AM-07:30AM'),
(5, 'test', 'test@gmail.com', '0000-00-00', '08:30AM-09:00AM'),
(6, 'test', 'test@gmail.com', '2020-05-06', '09:30AM-10:00AM'),
(7, 'test', 'test@gmail.com', '2020-05-06', '09:30AM-10:00AM'),
(8, 'test', 'test@gmail.com', '2020-05-06', '13:00PM-13:30PM'),
(10, 'test', 'test@test.com', '2020-05-13', '07:00AM-07:30AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
