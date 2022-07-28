-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 11:06 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `education_charity_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `Id` int(11) NOT NULL,
  `PhysicalName` varchar(255) NOT NULL,
  `FriendlyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`Id`, `PhysicalName`, `FriendlyName`) VALUES
(1, 'Home.php', 'home page'),
(2, 'AddInstructor.php', 'Add Instructor'),
(3, 'UploadCourseContent.php', 'Upload Course Content');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `UserTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Email`, `Password`, `FullName`, `UserTypeId`) VALUES
(2, 'mahmoudshaaban414@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Mahmoud Shaaban', 1),
(3, 'amrshaaban975@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Amr Shaaban', 2),
(4, 'ahmedmohamed85@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Ahmed Mohamed', 3),
(5, 'amrshaaban31@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'amr shaaban', 2),
(12, 'aliahmed@gmail.com', '2abd55e001c524cb2cf6300a89ca6366848a77d5', 'Ali Ahmed', 2),
(33, 'shaabanamr975@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Amr', 3);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`Id`, `Name`) VALUES
(1, 'Admin'),
(2, 'Instructor'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `usertypepage`
--

CREATE TABLE `usertypepage` (
  `Id` int(11) NOT NULL,
  `UserTypeId` int(11) NOT NULL,
  `PageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertypepage`
--

INSERT INTO `usertypepage` (`Id`, `UserTypeId`, `PageId`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 1, 2),
(5, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `usertypes` (`UserTypeId`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `usertypepage`
--
ALTER TABLE `usertypepage`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tuser` (`UserTypeId`),
  ADD KEY `pageuser` (`PageId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usertypepage`
--
ALTER TABLE `usertypepage`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `usertypes` FOREIGN KEY (`UserTypeId`) REFERENCES `usertype` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usertypepage`
--
ALTER TABLE `usertypepage`
  ADD CONSTRAINT `pageuser` FOREIGN KEY (`PageId`) REFERENCES `pages` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tuser` FOREIGN KEY (`UserTypeId`) REFERENCES `usertype` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
