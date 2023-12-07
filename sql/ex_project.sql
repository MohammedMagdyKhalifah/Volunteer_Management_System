-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2023 at 08:32 PM
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
-- Database: `ex_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `password`, `email`, `phone`, `username`, `rate`) VALUES
(1, 'Mahmoud Bukhari', 'e10adc3949ba59abbe56e057f20f883e', 'mabokhari@taibahu.edu.sa', 512345678, 'mbokhari', 10);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `volunteering_hours` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `skills` varchar(400) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `number_v` int(11) NOT NULL,
  `rates` double NOT NULL,
  `rate` double GENERATED ALWAYS AS (`rates` / `number_v`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`id`, `name`, `email`, `password`, `phone`, `volunteering_hours`, `academic_id`, `address`, `skills`, `availability`, `number_v`, `rates`) VALUES
(1, 'Mohammed Khalifah', 'tu4205521@taibahu.edu.sa', '984cefd6d27eb0471fc401a493a4fdff', 541412724, 36, 4205521, '8327 Ganm ben Ahamad hassan al-galodi - AlKhalidah 43270 madina', 'Full stack developer - graphic designer - programmer - Java - JavaScript - HTML - CSS - PHP ', 1, 3, 30),
(2, 'Omar Salamah', 'tu4202143@taibahu.edu.sa', '276506d3704c67d67ff9a500be50dd95', 568600256, 36, 4202143, 'Al-Azizia, Medina', 'HTML , CSS , Java , JavaScript , PHP , MYSQL', 1, 3, 30),
(3, 'Rakan Al-Rashidi', 'tu4102973@taibahu.edu.sa', 'e10adc3949ba59abbe56e057f20f883e', 599412644, 0, 4102973, 'anywhere', 'HTML , CSS , Java , JavaScript , PHP , MYSQL', 1, 0, 0),
(4, 'Yazid Al-Hazmi', 'tu4200000@taibahu.edu.sa', 'e10adc3949ba59abbe56e057f20f883e', 4200000, 0, 4200000, 'Madinah', 'java - c++ - word - PowerPoint - Excel', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Volunteering`
--

CREATE TABLE `Volunteering` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `hours` int(11) NOT NULL,
  `required_skills` varchar(100) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `max_size` int(11) NOT NULL,
  `rate` float DEFAULT NULL,
  `is_rated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Volunteering`
--

INSERT INTO `Volunteering` (`id`, `title`, `description`, `employee_id`, `location`, `start_date`, `end_date`, `hours`, `required_skills`, `availability`, `max_size`, `rate`, `is_rated`) VALUES
(1, 'Preparing laboratory computers', 'Assisting Dr. Mahmoud in preparing the laboratory computers to perform practical testing on the devices', 1, 'Building 105 - lab 9', '2023-11-09', '2023-11-10', 10, 'Anything', 0, 8, 0, 1),
(4, 'Preparing meeting about graduation projects', 'Assisting Dr. Mahmoud Bukhari in preparing a meeting with students on how to prepare complete and distinguished graduation projects', 1, 'Building: 105 Hall: Translate your ideas', '2023-11-22', '2023-11-30', 6, 'Computer sciences student', 0, 5, 0, 1),
(5, 'Assistant Deanship of Information Technology', 'Assisting the Deanship of Information Technology in preparing the new admission and registration system', 1, 'Building: Deanship of Information Technology', '2023-11-23', '2023-11-30', 20, 'html - css - javaScript - python - mangoDB - Bootstrap - React.js - next.js', 0, 4, 0, 1),
(6, 'Create an interactive web engineering lecture', 'Create an interactive web engineering lecture with new and distinctive tools', 1, 'Bulding: 105 lab 9', '2023-12-01', '2023-12-02', 5, 'PowerPoint - HTML - CSS - JavaScript - Bootstrap', 1, 5, 0, 0),
(8, 'test Volunteer opportunity form', 'We are testing volunteer opportunity form', 1, 'Saudi Areabia', '2023-11-14', '2023-11-30', 6, 'Anything you can do', 1, 4, 0, 0),
(9, 'workshop for students on new web technologies', 'Helping Dr. Mahmoud Bukhari to create a workshop for students on new web technologies', 1, 'Deanship of Information Technology', '2023-12-05', '2023-12-30', 10, 'HTML - CSS - JS - PHP - MYSQL - React', 1, 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Volunteering_details`
--

CREATE TABLE `Volunteering_details` (
  `id` int(11) NOT NULL,
  `volunteer_id` int(11) NOT NULL,
  `volunteering_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Volunteering_details`
--

INSERT INTO `Volunteering_details` (`id`, `volunteer_id`, `volunteering_id`) VALUES
(1, 1, 1),
(3, 1, 4),
(4, 2, 1),
(8, 2, 4),
(9, 1, 5),
(13, 1, 6),
(14, 2, 5),
(15, 2, 6),
(16, 2, 8),
(17, 1, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `v_phone` (`phone`),
  ADD UNIQUE KEY `academic-id` (`academic_id`);

--
-- Indexes for table `Volunteering`
--
ALTER TABLE `Volunteering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `Volunteering_details`
--
ALTER TABLE `Volunteering_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `volunteering_id` (`volunteering_id`),
  ADD KEY `volunteer_id` (`volunteer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Volunteering`
--
ALTER TABLE `Volunteering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Volunteering_details`
--
ALTER TABLE `Volunteering_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Volunteering`
--
ALTER TABLE `Volunteering`
  ADD CONSTRAINT `volunteering_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Volunteering_details`
--
ALTER TABLE `Volunteering_details`
  ADD CONSTRAINT `volunteering_details_ibfk_1` FOREIGN KEY (`volunteering_id`) REFERENCES `Volunteering` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `volunteering_details_ibfk_2` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
