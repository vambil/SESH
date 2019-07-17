-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2019 at 11:48 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration_storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `completed_storage`
--

CREATE TABLE `completed_storage` (
  `goal` varchar(200) NOT NULL,
  `contest_type` varchar(30) NOT NULL,
  `field` varchar(20) NOT NULL,
  `online` varchar(10) NOT NULL,
  `target` varchar(600) NOT NULL,
  `entry_type` varchar(30) NOT NULL,
  `promotion_strategy` varchar(400) NOT NULL,
  `team_size` int(11) NOT NULL,
  `partners` varchar(100) NOT NULL,
  `contest_date` date NOT NULL,
  `num_submissions` int(11) NOT NULL,
  `contest_summary` varchar(1000) NOT NULL,
  `contest_sharing` varchar(300) NOT NULL,
  `shared_links` varchar(200) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contest_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `early_storage`
--

CREATE TABLE `early_storage` (
  `goal` varchar(200) NOT NULL,
  `contest_type` varchar(30) NOT NULL,
  `field` varchar(20) NOT NULL,
  `online` varchar(10) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contest_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `early_storage`
--

INSERT INTO `early_storage` (`goal`, `contest_type`, `field`, `online`, `comments`, `email`, `contest_name`) VALUES
('Completed_test_01 -- edits            ', 'Innovation Challenge', 'Social Science', 'No', 'COMPLETE --> EARLY          ', 'joe@sesh.org', 'Completed_test_01');

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `contest_name` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `country` varchar(40) NOT NULL,
  `organization` varchar(30) NOT NULL,
  `stage` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`contest_name`, `email`, `country`, `organization`, `stage`) VALUES
('Completed_test_01', 'joe@sesh.org', 'Afghanistan', ' EDIT Completed_test_01', 'Early'),
('Early_test_01', 'joe@sesh.org', 'Afghanistan', ' EDIT Early_test_01 org', 'Mid'),
('Extra_contest', 'joe@sesh.org', 'Afghanistan', 'Extra_contest', 'Mid'),
('Vibhu_contest', 'vibhu@secured.org', 'Afghanistan', 'Vibhu_contest', 'Mid');

-- --------------------------------------------------------

--
-- Table structure for table `mid_storage`
--

CREATE TABLE `mid_storage` (
  `goal` varchar(200) NOT NULL,
  `contest_type` varchar(30) NOT NULL,
  `field` varchar(20) NOT NULL,
  `online` varchar(10) NOT NULL,
  `target` varchar(600) NOT NULL,
  `entry_type` varchar(30) NOT NULL,
  `promotion_strategy` varchar(400) NOT NULL,
  `team_size` int(11) NOT NULL,
  `partners` varchar(100) NOT NULL,
  `contest_date` date NOT NULL,
  `comments` varchar(200) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contest_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mid_storage`
--

INSERT INTO `mid_storage` (`goal`, `contest_type`, `field`, `online`, `target`, `entry_type`, `promotion_strategy`, `team_size`, `partners`, `contest_date`, `comments`, `email`, `contest_name`) VALUES
('EARLY --> MID             ', 'Innovation Challenge', 'Social Science', 'No', 'EARLY --> MID             ', 'EARLY --> MID             ', 'EARLY --> MID                         ', 1, 'EARLY --> MID             ', '2030-12-31', 'EARLY --> MID                       ', 'joe@sesh.org', 'Early_test_01'),
('Extra_contest             ', 'Hackathon', 'Arts', 'No', 'Extra_contest', 'Extra_contest', 'Extra_contest            ', 1, 'Extra_contest', '2030-12-31', 'Extra_contest          ', 'joe@sesh.org', 'Extra_contest'),
('Vibhu_contest goal Since you have created a challenge, you are now part of the world\'s largest network of crowdsourcing collaborators! </br> Click below to get connected.\"; Since you have created a ch', 'Hackathon', 'Arts', 'No', 'Vibhu-c', 'Vibhu-c', 'Vibhu-c            ', 1, 'Vibhu-c', '2030-12-31', 'Vibhu-c          ', 'vibhu@secured.org', 'Vibhu_contest');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first` varchar(20) NOT NULL,
  `user_last` varchar(30) NOT NULL,
  `user_country` varchar(40) NOT NULL,
  `user_organization` varchar(30) NOT NULL,
  `user_email` varchar(25) NOT NULL,
  `user_pwd` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_country`, `user_organization`, `user_email`, `user_pwd`) VALUES
(1, 'Joe', 'Tucker', 'United Kingdom', 'SESH', 'joe@sesh.org', '$2y$10$OARNm83w4BJFp6AQBTO14e41.f9DJy3R67LdkU/60MuGP6daAKpDq'),
(2, 'Vibhu', 'Ambil', 'United States', 'SECURED', 'vibhu@secured.org', '$2y$10$OybJH0Ej4WgCZmEBEVll6uQVFY0DzJmkAp11o1WlVu8z6C9BjHo1.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `completed_storage`
--
ALTER TABLE `completed_storage`
  ADD UNIQUE KEY `contest_name` (`contest_name`);

--
-- Indexes for table `early_storage`
--
ALTER TABLE `early_storage`
  ADD UNIQUE KEY `contest_name` (`contest_name`);

--
-- Indexes for table `general`
--
ALTER TABLE `general`
  ADD UNIQUE KEY `contest_name` (`contest_name`);

--
-- Indexes for table `mid_storage`
--
ALTER TABLE `mid_storage`
  ADD UNIQUE KEY `contest_name` (`contest_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
