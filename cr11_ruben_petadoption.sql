-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 08:58 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_ruben_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_ruben_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_ruben_petadoption`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `aniType` enum('small','large','senior','') NOT NULL,
  `descr` varchar(255) NOT NULL,
  `hobbies` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `age`, `aniType`, `descr`, `hobbies`, `image`, `location`) VALUES
(1, 'Squary', '9 Months', 'small', 'Pets in this department are becoming more and more popular with people of all ages.', 'Jumping', 'img/sm1.jpg', 'Praterstrasse 23'),
(2, 'Crush Jr', '2 Months', 'small', 'Crush Jr will be a character in new Finding Nemo.', 'Swimming /Diving', 'img/sm2.jpg', 'Praterstrasse 23'),
(3, 'Popi', '3 Months', 'small', 'The first hamsters were discovered in Syria, though they also live in Greece ext...', 'Chilling', 'img/sm3.jpg', 'Praterstrasse 23'),
(4, 'Lizzy', '7 Months', 'small', 'seems sweet and nice, but turns out to be a complete b*tch determined to screw up', 'Climbing / Hiding', 'img/sm4.jpg', 'Praterstrasse 23'),
(5, 'Moby', '3 Years', 'large', 'has long played an important role in the lives of humans.', 'hide & seek', 'img/lg1.jpg', 'Praterstrasse 23'),
(6, 'Capoccino', '5 Years', 'large', 'has long necks, long legs, and singular solid hooves on the ends of his feet. ', 'standing /daydreming', 'img/lg2.jpg', 'Praterstrasse 23'),
(7, 'Cudle Pudle', '2 Years', 'large', 'A sheep-like animal of the Andes, Vicugna pacos, in the camel family, closely related to the llama.', 'smiling', 'img/lg3.jpg', 'Praterstrasse 23'),
(8, 'Pinky', '6 Years', 'large', 'Flamingos embody the saying-you are what you eat.', 'eating', 'img/lg4.jpg', 'Praterstrasse 23'),
(9, 'Mobster', '10 Years', 'senior', 'Outdoor Boy, silence but great security against rats', 'scartching', 'img/sn1.jpg', 'Praterstrasse 23'),
(10, 'Goofy', '8 Years', 'senior', 'Slow, friendly dog, eats all and licks all.', 'long walks', 'img/sn2.jpg', 'Praterstrasse 23'),
(11, 'Donker', '11 Years', 'senior', 'kept as calming companion for nervous horses.', 'grassing', 'img/sn3.jpg', 'Praterstrasse 23'),
(12, 'T-Guy', '9 Years', 'senior', 'Your morning alarm and often with fresh eggs.', 'mornig run', 'img/sn4.jpg', 'Praterstrasse 23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(60) DEFAULT NULL,
  `passw` varchar(255) DEFAULT NULL,
  `userType` enum('user','admin','spradmin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `userEmail`, `passw`, `userType`) VALUES
(1, 'mainadmin', 'admin@pet.net', '6ce5d724d32bdd2d72867fc3c7c752ec386ef8a3db6e73c7c3932d41f0519987', 'admin'),
(2, 'userone', 'userone@pet.net', '2c4dca7c5a34feb03d70447f026e9abb304cf2571e0d98a60cf937e5ff5f1512', 'user'),
(3, 'usertwo', 'usertwo@pet.net', '4f70d7279a0bbac77b437ce77d6477b7d3d77d502d8d48b75b78e674677e3109', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
