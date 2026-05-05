-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2026 at 07:26 AM
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
-- Database: `applied web project part 2`
--
CREATE DATABASE IF NOT EXISTS `applied web project part 2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `applied web project part 2`;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `job_ref` int(5) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `reports_to` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `essential_requirements` text NOT NULL,
  `pref_requirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_ref`, `job_title`, `salary`, `reports_to`, `description`, `essential_requirements`, `pref_requirements`) VALUES
(10000, 'AI Implementation Lead', 180000, 'Opperations Manager', 'We are looking for a AI Implementation Lead to work closely with a field deployment team and alongside our existing tech development team to implement a range of AI features into our quickly growing fleet of cameras and monitoring equipment that will be rolled out across a number of local, state and federal governments\r\n', 'A stong and up to date understanding of AI infrustructure , 3 years of senior team leadership , A can do attitude that is able to work around a dynamic team enviroment', 'A background in vibe coding and ai agent coordination , \r\nA vehicle and current license to travel to deployment locations , \r\nThe ability to have a laugh with the team'),
(10001, 'Public Liaison Officer', 62000, 'Public Liason Lead', 'As a Public Liaison Officer, your main responsibilities will include: Scouting of potential future deployment locations, gauging of current public sentiment around AI and safety monitoring systems, reporting to the Public Liaison Lead around methods and tactics to go forth with deployments in a friendly and compelling way taking into about business needs while balancing public feedback.', 'A current and valid driving license , \r\nA working vehicle capable of carrying light equipment such as cameras , \r\n3 years in a public facing role', 'Customer service management , \r\nOffice 365 and adobe suite , \r\nA taste for good jokes and coffee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_ref`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_ref` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
